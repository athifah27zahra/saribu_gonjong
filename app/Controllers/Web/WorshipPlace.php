<?php

namespace App\Controllers\Web;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\WorshipPlaceModel;
use App\Models\GalleryWorshipPlaceModel;
use CodeIgniter\Files\File;

class WorshipPlace extends ResourcePresenter
{
    protected $worshipPlaceModel;
    protected $galleryWorshipPlaceModel;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */

     protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->worshipPlaceModel = new WorshipPlaceModel();
        $this->galleryWorshipPlaceModel = new GalleryWorshipPlaceModel();
    }

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
        $worshipPlace = $this->worshipPlaceModel->get_wp_by_id_api($id)->getRowArray();
        if (empty($worshipPlace)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $list_gallery = $this->galleryWorshipPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        $worshipPlace['gallery'] = $galleries;

        $data = [
            'title' => $worshipPlace['name'],
            'data' => $worshipPlace,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_worship_place', $data);
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
            'title' => 'New Worship Place',
        ];
        return view('dashboard/worship_form', $data);
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
        $id = $this->worshipPlaceModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'address' => $request['address'],
            'building_size' => $request['building_size'],    
            'capacity' => $request['capacity'],
            'description' => $request['description'],
            'lat' => $request['lat'],
            'lng' => $request['lng'],
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geo-json'];
        if (isset($request['video'])) {
            $folder = $request['video'];
            $filepath = WRITEPATH . 'uploads/' . $folder;
            $filenames = get_filenames($filepath);
            $vidFile = new File($filepath . '/' . $filenames[0]);
            $vidFile->move(FCPATH . 'media/videos');
            delete_files($filepath);
            rmdir($filepath);
            $requestData['video_url'] = $vidFile->getFilename();
        }
        $addWP = $this->worshipPlaceModel->add_wp_api($requestData, $geojson);

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
            $this->galleryWorshipPlaceModel->add_gallery_api($id, $gallery);
        }

        if ($addWP) {
            return redirect()->to(base_url('dashboard/worshipPlace') . '/' . $id);
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
        $worshipPlace = $this->worshipPlaceModel->get_wp_by_id_api($id)->getRowArray();
        if (empty($worshipPlace)) {
            return redirect()->to('dashboard/worshipPlace');
        }

        $list_gallery = $this->galleryWorshipPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }

        $worshipPlace['gallery'] = $galleries;
        $data = [
            'title' => 'Edit Worship Place',
            'data' => $worshipPlace,
        ];
        return view('dashboard/worship_form', $data);
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
            'building_size' => $request['building_size'],
            'capacity' => $request['capacity'],
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
        $updateWP = $this->worshipPlaceModel->update_wp_api($id, $requestData, $geojson);
    
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
            $this->galleryWorshipPlaceModel->update_gallery_api($id, $gallery);
        } else {
            $this->galleryWorshipPlaceModel->delete_gallery_api($id);
        }
    
        if ($updateWP) {
            return redirect()->to(base_url('dashboard/worshipPlace') . '/' . $id);
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
