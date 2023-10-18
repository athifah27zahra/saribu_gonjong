<?php

namespace App\Controllers\Web;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\HistoryPlaceModel;
use App\Models\GalleryHistoryPlaceModel;
use CodeIgniter\Files\File;

class HistoryPlace extends ResourcePresenter 
{
    protected $historyPlaceModel;
    protected $galleryHistoryPlaceModel;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */

     protected $helpers = ['auth', 'url', 'filesystem'];

     public function __construct()
     {
         $this->historyPlaceModel = new HistoryPlaceModel();
         $this->galleryHistoryPlaceModel = new GalleryHistoryPlaceModel();
     }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $historyPlace = $this->historyPlaceModel->get_hp_by_id_api($id)->getRowArray();
        if (empty($historyPlace)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $list_gallery = $this->galleryHistoryPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        $historyPlace['gallery'] = $galleries;

        $data = [
            'title' => $historyPlace['name'],
            'data' => $historyPlace,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_history_place', $data);
        }
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $data = [
            'title' => 'New History Place',
        ];
        return view('dashboard/history_form', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $request = $this->request->getPost();
        $id = $this->historyPlaceModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'address' => $request['address'],
            'open' => $request['open'],
            'close' => $request['close'],
            'lat' => $request['lat'],
            'lng' => $request['lng'],
            'description' => $request['description'],
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geo-json'];
        $addSP = $this->historyPlaceModel->add_hp_api($requestData, $geojson);

        if (isset($request['gallery'])) {
            $folders = $request['gallery'];
            $gallery = array();
            foreach ($folders as $folder) {
                $filepath = WRITEPATH . 'uploads/' . $folder;
                $filenames = get_filenames($filepath);
                $fileImg = new File($filepath . '/' . $filenames[0]);
                $fileImg->move(FCPATH . 'media/photos');
                delete_files($filepath);
                rmdir($filepath);
                $gallery[] = $fileImg->getFilename();
            }
            $this->galleryHistoryPlaceModel->add_gallery_api($id, $gallery);
        }

        if ($addSP) {
            return redirect()->to(base_url('dashboard/historyPlace') . '/' . $id);
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $historyPlace = $this->historyPlaceModel->get_hp_by_id_api($id)->getRowArray();
        if (empty($historyPlace)) {
            return redirect()->to('dashboard/historyPlace');
        }

        $list_gallery = $this->galleryHistoryPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }

        $historyPlace['gallery'] = $galleries;
        $data = [
            'title' => 'Edit History Place',
            'data' => $historyPlace,
        ];
        return view('dashboard/history_form', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $request = $this->request->getPost();
        $requestData = [
            'name' => $request['name'],
            'address' => $request['address'],
            'open' => $request['open'],
            'close' => $request['close'],
            'description' => $request['description'],
            'lat' => $request['lat'],
            'lng' => $request['lng'],
        ];
        foreach ($requestData as $key => $value) {
            if(empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geo-json'];
        $updateUP = $this->historyPlaceModel->update_hp_api($id, $requestData, $geojson);
    
        if (isset($request['gallery'])) {
            $folders = $request['gallery'];
            $gallery = array();
            foreach ($folders as $folder) {
                $filepath = WRITEPATH . 'uploads/' . $folder;
                $filenames = get_filenames($filepath);
                $fileImg = new File($filepath . '/' . $filenames[0]);
                $fileImg->move(FCPATH . 'media/photos');
                delete_files($filepath);
                rmdir($filepath);
                $gallery[] = $fileImg->getFilename();
            }
            $this->galleryHistoryPlaceModel->update_gallery_api($id, $gallery);
        } else {
            $this->galleryHistoryPlaceModel->delete_gallery_api($id);
        }
    
        if ($updateUP) {
            return redirect()->to(base_url('dashboard/historyPlace') . '/' . $id);
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
