<?php

namespace App\Controllers\Web;
use App\Models\GalleryStudyModel;
use App\Models\StudyModel;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\RESTful\ResourcePresenter;

class Study extends ResourcePresenter
{
    use ResponseTrait;

    protected $studyModel;

    public function __construct()
    {
        $this->studyModel = new StudyModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
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
        $souvenirPlace = $this->studyModel->get_s_by_id_api($id)->getRowArray();
        if (empty($souvenirPlace)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $data = [
            'title' => $souvenirPlace['name'],
            'data' => $souvenirPlace,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_study_place', $data);
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
            'title' => 'New Study Place',
        ];
        return view('dashboard/study_form', $data);
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
        $id = $this->studyModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'lat' => $request['lat'],
            'lng' => $request['lng'],
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geo-json'];
        $addUP = $this->studyModel->add_s_api($requestData, $geojson);

        if ($addUP) {
            return redirect()->to(base_url('dashboard/study') . '/' . $id);
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
        $umkmPlace = $this->studyModel->get_s_by_id_api($id)->getRowArray();
        // if (empty($tourismObjectModel)) {
        //     return redirect()->to('dashboard/tourismObject');
        // }

        $data = [
            'title' => 'Edit Study Place',
            'data' => $umkmPlace,
        ];
        return view('dashboard/study_place_form', $data);
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
            'lat' => $request['lat'],
            'lng' => $request['lng'],
        ];
        foreach ($requestData as $key => $value) {
            if(empty($value)) {
                unset($requestData[$key]);
            }
        }
        $geojson = $request['geo-json'];
        $updateUP = $this->studyModel->update_to_api($id, $requestData, $geojson);
    
        if ($updateUP) {
            return redirect()->to(base_url('dashboard/study') . '/' . $id);
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
