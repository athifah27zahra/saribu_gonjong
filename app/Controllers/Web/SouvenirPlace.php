<?php

namespace App\Controllers\Web;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\SouvenirPlaceModel;
use App\Models\GallerySouvenirPlaceModel;
use CodeIgniter\Files\File;

class SouvenirPlace extends ResourcePresenter
{
    protected $souvenirPlaceModel;
    protected $gallerySouvenirPlaceModel;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */

     protected $helpers = ['auth', 'url', 'filesystem'];

     public function __construct()
     {
         $this->souvenirPlaceModel = new SouvenirPlaceModel();
         $this->gallerySouvenirPlaceModel = new GallerySouvenirPlaceModel();
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
        $souvenirPlace = $this->souvenirPlaceModel->get_sp_by_id_api($id)->getRowArray();
        if (empty($souvenirPlace)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $list_gallery = $this->gallerySouvenirPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        $souvenirPlace['gallery'] = $galleries;

        $data = [
            'title' => $souvenirPlace['name'],
            'data' => $souvenirPlace,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_souvenir_place', $data);
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
            'title' => 'New Souvenir Place',
        ];
        return view('dashboard/souvenir_form', $data);
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
        $id = $this->souvenirPlaceModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'address' => $request['address'],
            'contact_person' => $request['contact_person'], 
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
        $addSP = $this->souvenirPlaceModel->add_sp_api($requestData, $geojson);

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
            $this->gallerySouvenirPlaceModel->add_gallery_api($id, $gallery);
        }

        if ($addSP) {
            return redirect()->to(base_url('dashboard/souvenirPlace') . '/' . $id);
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
        $souvenirPlace = $this->souvenirPlaceModel->get_sp_by_id_api($id)->getRowArray();
        if (empty($souvenirPlace)) {
            return redirect()->to('dashboard/souvenirPlace');
        }

        $list_gallery = $this->gallerySouvenirPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }

        $souvenirPlace['gallery'] = $galleries;
        $data = [
            'title' => 'Edit Souvenir Place',
            'data' => $souvenirPlace,
        ];
        return view('dashboard/souvenir_form', $data);
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
            'contact_person' => $request['contact_person'],
            'lat' => $request['lat'],
            'lng' => $request['lng'],
            'description' => $request['description'],
        ];
        foreach ($requestData as $key => $value) {
            if(empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geo-json'];
        $updateSP = $this->souvenirPlaceModel->update_sp_api($id, $requestData, $geojson);
    
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
            $this->gallerySouvenirPlaceModel->update_gallery_api($id, $gallery);
        } else {
            $this->gallerySouvenirPlaceModel->delete_gallery_api($id);
        }
    
        if ($updateSP) {
            return redirect()->to(base_url('dashboard/souvenirPlace') . '/' . $id);
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
