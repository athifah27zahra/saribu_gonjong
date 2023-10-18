<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\PackageActivitiesModel;
use CodeIgniter\API\ResponseTrait;

class TourismActivity extends ResourcePresenter
{
    use ResponseTrait;

    protected $tourismActivityModel;

    public function __construct()
    {
        $this->tourismActivityModel = new PackageActivitiesModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {

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
        $tourismActivity = $this->tourismActivityModel->get_id($id)->getRowArray();
        $tourismActivity = mb_convert_encoding($tourismActivity, 'UTF-8', 'UTF-8');
        $response = [
            'data' => $tourismActivity,
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
        $contents = $this->tourismActivity->get_all()->getResultArray();
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
        //
    }
}
