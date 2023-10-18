<?php

namespace App\Controllers\Web;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\UmkmPlaceModel;
use App\Models\GalleryUmkmPlaceModel;
use CodeIgniter\Files\File;

class UmkmPlace extends ResourcePresenter
{
    protected $umkmPlaceModel;
    protected $galleryUmkmPlaceModel;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->umkmPlaceModel = new UmkmPlaceModel();
        $this->galleryUmkmPlaceModel = new GalleryUmkmPlaceModel();
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
        $umkmPlace = $this->umkmPlaceModel->get_up_by_id_api($id)->getRowArray();
        if (empty($umkmPlace)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $list_gallery = $this->galleryUmkmPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        $umkmPlace['gallery'] = $galleries;

        $data = [
            'title' => $umkmPlace['name'],
            'data' => $umkmPlace,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_umkm_place', $data);
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
            'title' => 'New UMKM Place',
        ];
        return view('dashboard/umkm_form', $data);
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
        $id = $this->umkmPlaceModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'address' => $request['address'],
            'contact_person' => $request['contact_person'],    
            'capacity' => $request['capacity'],
            'open' => $request['open'],
            'close' => $request['close'],
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
        $addUP = $this->umkmPlaceModel->add_up_api($requestData, $geojson);

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
            $this->galleryUmkmPlaceModel->add_gallery_api($id, $gallery);
        }

        if ($addUP) {
            return redirect()->to(base_url('dashboard/umkmPlace') . '/' . $id);
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
        $umkmPlace = $this->umkmPlaceModel->get_up_by_id_api($id)->getRowArray();
        if (empty($umkmPlace)) {
            return redirect()->to('dashboard/umkmPlace');
        }

        $list_gallery = $this->galleryUmkmPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }

        $umkmPlace['gallery'] = $galleries;
        $data = [
            'title' => 'Edit UMKM Place',
            'data' => $umkmPlace,
        ];
        return view('dashboard/umkm_form', $data);
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
            'capacity' => $request['capacity'],
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
        $updateUP = $this->umkmPlaceModel->update_up_api($id, $requestData, $geojson);
    
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
            $this->galleryUmkmPlaceModel->update_gallery_api($id, $gallery);
        } else {
            $this->galleryUmkmPlaceModel->delete_gallery_api($id);
        }
    
        if ($updateUP) {
            return redirect()->to(base_url('dashboard/umkmPlace') . '/' . $id);
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
