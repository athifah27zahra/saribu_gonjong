<?php

namespace App\Controllers\Api;
use App\Models\UmkmPlaceModel;
use App\Models\GalleryUmkmPlaceModel;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\RESTful\ResourcePresenter;

class UmkmPlace extends ResourcePresenter
{
    use ResponseTrait;

    protected $umkmPlaceModel;
    protected $galleryUmkmPlaceModel;

    public function __construct()
    {
        $this->umkmPlaceModel = new UmkmPlaceModel();
        $this->galleryUmkmPlaceModel = new GalleryUmkmPlaceModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index($id = null)
    {
        $contents = $this->umkmPlaceModel->get_up_by_id_api($id)->getResultArray();
        // foreach ($contents as $content) {
        //     $list_gallery = $this->galleryRumahGadangModel->get_gallery_api($content->id)->getResultArray();
        //     $galleries = array();
        //     foreach ($list_gallery as $gallery) {
        //         $galleries[] = $gallery['url'];
        //     }
        //     $content->gallery = $galleries[0];
        //     $rumahGadang[] = $content;
        // }
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of Rumah Gadang"
            ]
        ];

        return $this->respond($response);
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
        $umkm_place = $this->umkmPlaceModel->get_up_by_id_api($id)->getResultArray();

        if(isset($umkm_place[0])) {
            $umkm_place = $umkm_place[0];
        }

        $list_gallery = $this->galleryUmkmPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        
        $umkm_place['gallery'] = $galleries;

        $response = [
            'data' => $umkm_place,
            'status' => 200,
            'message' => [
                "Success display detail information of UMKM Place"
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $contents = $this->umkmPlaceModel->get_all()->getResultArray();
        $contents = mb_convert_encoding($contents, 'UTF-8', 'UTF-8');
        // $contents = json_encode($contents);
        // print_r($contents);
        return $this->respond($contents);
        // return $contents;
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $request = $this->request->getJSON(true);
        $id = $this->umkmPlaceModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'address' => $request['address'],
            'contact_person' => $request['contact_person'],
            'capacity' => $request['capacity'],
            'open' => $request['open'],
            'close' => $request['close'],
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geojson'];
        $addUP = $this->umkmPlaceModel->add_up_api($requestData, $geojson);
        $gallery = $request['gallery'];
        $addGallery = $this->galleryUmkmPlaceModel->add_gallery_api($id, $gallery);
        if ($addUP &&  $addGallery) {
            $response = [
                'status' => 201,
                'message' => [
                    "Success create new UMKM Place"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail create new UMKM Place",
                    "Add Worship Place: {$addUP}",
                    "Add Gallery: {$addGallery}",
                ]
            ];
            return $this->respond($response, 400);
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
        //
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
        $request = $this->request->getJSON(true);
        $requestData = [
            'name' => $request['name'],
            'address' => $request['address'],
            'contact_person' => $request['contact_person'],
            'capacity' => $request['capacity'],
            'open' => $request['open'],
            'close' => $request['close'],
        ];
        $geojson = $request['geojson'];
        $updateUP = $this->umkmPlaceModel->update_up_api($id, $requestData, $geojson);
        $gallery = $request['gallery'];
        $updateGallery = $this->galleryUmkmPlaceModel->update_gallery_api($id, $gallery);
        if($updateUP && $updateGallery) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success update UMKM Place"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail update UMKM Place",
                    "Update UMKM Place: {$updateUP}",
                    "Update Gallery: {$updateGallery}",
                ]
            ];
            return $this->respond($response, 400);
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
        $deleteUP = $this->umkmPlaceModel->delete(['id' => $id]);
        if ($deleteUP) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success delete UMKM Place"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 404,
                'message' => [
                    "UMKM Place not found"
                ]
            ];
            return $this->failNotFound($response);
        }
    }

    public function findByRadius()
    {
        $request = $this->request->getPost();
        $contents = $this->umkmPlaceModel->get_up_by_radius_api($request)->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success find UMKM PLace by radius"
            ]
        ];
        return $this->respond($response);
    }
}
