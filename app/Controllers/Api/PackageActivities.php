<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\PackageActivitiesModel;
use CodeIgniter\API\ResponseTrait;

class PackageActivities extends ResourcePresenter
{
    use ResponseTrait;
    protected $packageActivitiesModel;

    public function __construct()
    {
        $this->packageActivitiesModel = new PackageActivitiesModel();
    }

    public function index()
    {
        $contents = $this->packageActivitiesModel->get_all()->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of package activities"
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
        $souvenir_place = $this->packageActivitiesModel->get_pa_by_id_api($id)->getRowArray();  

        $response = [
            'data' => $souvenir_place,
            'status' => 200,
            'message' => [
                "Success display detail information of Tourism Activity"
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
        $contents = $this->packageActivitiesModel->get_all()->getResultArray();
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
        $id = $this->packageActivitiesModel->get_new_id_api();
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
        $addUP = $this->packageActivitiesModel->add_pa_api($requestData, $geojson);
        if ($addUP) {
            $response = [
                'status' => 201,
                'message' => [
                    "Success create new Tourism Activity"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail create new Tourism Activity",
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
        $updateUP = $this->packageActivitiesModel->update_pa_api($id, $requestData, $geojson);
        if($updateUP) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success update Tourism Activity"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail update Tourism Activity",
                    "Update Tourism Activity: {$updateUP}",
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
        $deleteWP = $this->packageActivitiesModel->delete(['id' => $id]);
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
}
