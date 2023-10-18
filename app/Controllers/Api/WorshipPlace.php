<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\WorshipPlaceModel;
use App\Models\GalleryWorshipPlaceModel;
use CodeIgniter\API\ResponseTrait;

class WorshipPlace extends ResourcePresenter
{
    use ResponseTrait;

    protected $worshipPlaceModel;
    protected $galleryWorshipPlaceModel;

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
        $worship_place = $this->worshipPlaceModel->get_wp_by_id_api($id)->getRowArray();

        $list_gallery = $this->galleryWorshipPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        
        $worship_place['gallery'] = $galleries;

        $response = [
            'data' => $worship_place,
            'status' => 200,
            'message' => [
                "Success display detail information of Worship Place"
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
        $contents = $this->worshipPlaceModel->get_all()->getResultArray();
        $contents = mb_convert_encoding($contents, 'UTF-8', 'UTF-8');
        return $this->respond($contents);
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
        $id = $this->worshipPlaceModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'address' => $request['address'],
            'building_size' => $request['building_size'],
            'capacity' => $request['capacity'],
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geojson'];
        $addWP = $this->worshipPlaceModel->add_wp_api($requestData, $geojson);
        $gallery = $request['gallery'];
        $addGallery = $this->galleryWorshipPlaceModel->add_gallery_api($id, $gallery);
        if ($addWP &&  $addGallery) {
            $response = [
                'status' => 201,
                'message' => [
                    "Success create new Worship Place"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail create new Worship Place",
                    "Add Worship Place: {$addWP}",
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
            'building_size' => $request['building_size'],
            'capacity' => $request['capacity'],
        ];
        $geojson = $request['geojson'];
        $updateWP = $this->worshipPlaceModel->update_wp_api($id, $requestData, $geojson);
        $gallery = $request['gallery'];
        $updateGallery = $this->galleryWorshipPlaceModel->update_gallery_api($id, $gallery);
        if($updateWP && $updateGallery) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success update Worship Place"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail update Worship Place",
                    "Update Worship Place: {$updateWP}",
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
        $deleteWP = $this->worshipPlaceModel->delete(['id' => $id]);
        if ($deleteWP) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success delete Worship Place"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 404,
                'message' => [
                    "Worship Place not found"
                ]
            ];
            return $this->failNotFound($response);
        }
    }

    public function findByRadius()
    {
        $request = $this->request->getPost();
        $contents = $this->worshipPlaceModel->get_wp_by_radius_api($request)->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success find Rumah Gadang by radius"
            ]
        ];
        return $this->respond($response);
    }
}
