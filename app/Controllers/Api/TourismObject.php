<?php

namespace App\Controllers\Api;

use App\Models\GalleryTourismObjectModel;
use App\Models\TourismObjectModel;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\RESTful\ResourcePresenter;

class TourismObject extends ResourcePresenter
{
    use ResponseTrait;

    protected $tourismObjectModel;

    public function __construct()
    {
        $this->tourismObjectModel = new TourismObjectModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->tourismObjectModel->get_all()->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of Tourism Object"
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
        $tourism_object = $this->tourismObjectModel->get_id($id)->getRowArray();
        $tourism_object = mb_convert_encoding($tourism_object, 'UTF-8', 'UTF-8');
        $response = [
            'data' => $tourism_object,
            'status' => 200,
            'message' => [
                "Success display detail information of Tourism Object"
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
        $contents = $this->tourismObjectModel->get_all()->getResultArray();
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
        $id = $this->tourismObjectModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geojson'];
        $addUP = $this->tourismObjectModel->add_to_api($requestData, $geojson);
        if ($addUP) {
            $response = [
                'status' => 201,
                'message' => [
                    "Success create new Tourism Object"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail create new Tourism Object",
                    "Add Tourism Activity: {$addUP}",
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
        ];
        $geojson = $request['geojson'];
        $updateUP = $this->tourismObjectModel->update_to_api($id, $requestData, $geojson);
        if($updateUP) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success update Tourism Object"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail update Tourism Object",
                    "Update Tourism Object: {$updateUP}",
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
        $deleteWP = $this->tourismObjectModel->delete(['id' => $id]);
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
        $contents = $this->tourismObjectModel->get_sp_by_radius_api($request)->getResult();
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
