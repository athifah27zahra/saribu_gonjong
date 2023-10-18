<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use App\Models\FacilityTourismPackageModel;

class FacilityTourismPackage extends ResourcePresenter
{
    use ResponseTrait;
    
    protected $facilityTourismPackageModel; 
    
    public function __construct()
    {
        $this->facilityTourismPackageModel = new FacilityTourismPackageModel();
    }
    public function index()
    {
        $contents = $this->facilityTourismPackageModel->get_list_fc_api()->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of facility"
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
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        //
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
        $id = $this->facilityTourismPackageModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
        ];
        $addFC = $this->facilityTourismPackageModel->add_fc_api($requestData);
        if ($addFC) {
            $response = [
                'status' => 201,
                'message' => [
                    "Success create new service"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail create new service",
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
        $request = $this->request->getRawInput();
        $requestData = [
            'name' => $request['name'],
        ];
        $updateFC = $this->facilityTourismPackageModel->update_fc_api($id, $requestData);
        if ($updateFC) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success update service"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail update service",
                ]
            ];
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
        $deleteFC = $this->facilityTourismPackageModel->delete(['id' => $id]);
        if($deleteFC) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success delete service"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 404,
                'message' => [
                    "service not found"
                ]
            ];
            return $this->failNotFound($response);
        }
    }
}
