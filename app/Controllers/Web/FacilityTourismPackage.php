<?php

namespace App\Controllers\Web;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\FacilityTourismPackageModel;

class FacilityTourismPackage extends ResourcePresenter
{
    protected $facilityTourismPackageModel;
    
    protected $helpers = ['auth', 'url', 'filesystem'];
    
    public function __construct()
    {
        $this->facilityTourismPackageModel = new FacilityTourismPackageModel();
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

    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $id = $this->facilityTourismPackageModel->get_new_id_api();
        $data = [
            'title' => 'New Service',
            'id' => $id
        ];
        return view('dashboard/service_form', $data);
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
        $requestData = [
            'id' => $request['id'],
            'name' => $request['name'],
        ];
        $addFC = $this->facilityTourismPackageModel->add_fc_api($requestData);
        if ($addFC) {
            return redirect()->to(base_url('dashboard/facilityTourismPackage'));
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
        $facility = $this->facilityTourismPackageModel->get_fc_by_id_api($id)->getRowArray();
        $data = [
            'title' => 'Edit Service',
            'data' => $facility
        ];
        return view('dashboard/service_form', $data);
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
        ];
        $updateFC = $this->facilityTourismPackageModel->update_fc_api($id, $requestData);
        if ($updateFC) {
            return redirect()->to(base_url('dashboard/facilityTourismPackage'));
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
