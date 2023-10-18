<?php

namespace App\Controllers\Api;
use App\Models\GallerySouvenirPlaceModel;
use App\Models\SouvenirPlaceModel;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\RESTful\ResourcePresenter;

class SouvenirPlace extends ResourcePresenter
{
    use ResponseTrait;

    protected $souvenirPlaceModel;
    protected $gallerySouvenirPlaceModel;

    public function __construct()
    {
        $this->souvenirPlaceModel = new SouvenirPlaceModel();
        $this->gallerySouvenirPlaceModel = new GallerySouvenirPlaceModel();

    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->souvenirPlaceModel->get_list_sp_api()->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of Souvenir Place"
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
        $souvenir_place = $this->souvenirPlaceModel->get_sp_by_id_api($id)->getRowArray();

        $list_gallery = $this->gallerySouvenirPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }

        $souvenir_place['gallery'] = $galleries;

        $response = [
            'data' => $souvenir_place,
            'status' => 200,
            'message' => [
                "Success display detail information of Souvenir Place"
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
        $contents = $this->souvenirPlaceModel->get_all()->getResultArray();
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
        $id = $this->souvenirPlaceModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'address' => $request['address'],
            'contact_person' => $request['contact_person'],
            'description' => $request['description'],
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geojson'];
        $addSP = $this->souvenirPlaceModel->add_sp_api($requestData, $geojson);
        $gallery = $request['gallery'];
        $addGallery = $this->gallerySouvenirPlaceModel->add_gallery_api($id, $gallery);
        if ($addSP &&  $addGallery) {
            $response = [
                'status' => 201,
                'message' => [
                    "Success create new Souvenir Place"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail create new Souvenir Place",
                    "Add Worship Place: {$addSP}",
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
            'description' => $request['description'],
        ];
        $geojson = $request['geojson'];
        $updateSP = $this->souvenirPlaceModel->update_sp_api($id, $requestData, $geojson);
        $gallery = $request['gallery'];
        $updateGallery = $this->gallerySouvenirPlaceModel->update_gallery_api($id, $gallery);
        if($updateSP && $updateGallery) {
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
                    "Fail update Souvenir Place",
                    "Update Souvenir Place: {$updateSP}",
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
        $deleteSP = $this->souvenirPlaceModel->delete(['id' => $id]);
        if ($deleteSP) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success delete Souvenir Place"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 404,
                'message' => [
                    "Souvenir Place not found"
                ]
            ];
            return $this->failNotFound($response);
        }
    }

    public function findByRadius()
    {
        $request = $this->request->getPost();
        $contents = $this->souvenirPlaceModel->get_sp_by_radius_api($request)->getResult();
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
