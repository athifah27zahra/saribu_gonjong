<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use App\Models\HistoryPlaceModel;
use App\Models\GalleryHistoryPlaceModel;

class HistoryPlace extends ResourcePresenter
{
    use ResponseTrait;

    protected $historyPlaceModel;
    protected $galleryHistoryPlaceModel;

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
        $contents = $this->historyPlaceModel->get_list_hp_api()->getResult();
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
        $history_place = $this->historyPlaceModel->get_hp_by_id_api($id)->getRowArray();

        $list_gallery = $this->galleryHistoryPlaceModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }

        $history_place['gallery'] = $galleries;
        //$history_place['contact_person'] = null;

        $response = [
            'data' => $history_place,
            'status' => 200,
            'message' => [
                "Success display detail information of History Place"
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
        $contents = $this->historyPlaceModel->get_all()->getResultArray();
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
        //
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
        //
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
        $deleteSP = $this->historyPlaceModel->delete(['id' => $id]);
        if ($deleteSP) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success delete History Place"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 404,
                'message' => [
                    "History Place not found"
                ]
            ];
            return $this->failNotFound($response);
        }
    }

    public function findByRadius()
    {
        $request = $this->request->getPost();
        $contents = $this->historyPlaceModel->get_hp_by_radius_api($request)->getResult();
        foreach((array)$contents as $dtk=>$dt) {
            $geom = $contents[$dtk]->geoJson;
            $contents[$dtk]->geoJson = json_decode($geom);

        }
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success find History Place by radius"
            ]
        ];
        return $this->respond($response);
    }
}
