<?php

namespace App\Controllers\Api;

// use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\VillageModel;
use CodeIgniter\API\ResponseTrait;

class Village extends ResourcePresenter
{
    use ResponseTrait;
    protected $villageModel;
    public function __construct(){
        $this->villageModel = new VillageModel();
    }

    public function getData(){
        $request = $this->request->getPost();
        $village = $request['village'];
        if ($village == '1') {
            $vilProperty = $this->villageModel->get_desa_wisata_api()->getRowArray();
            $geoJson = json_decode($this->villageModel->get_geoJson_api($village)->getRowArray()['geoJson']);
            $content = [
                'type' => 'Feature',
                'geometry' => $geoJson,
                'properties' => [
                    'id' => $vilProperty['id'],
                    'name' => $vilProperty['name'],
                ]
            ];
            $response = [
                'data' => $content,
                'status' => 200,
                'message' => [
                    "Success display data of Saribu Gonjong "
                ]
            ];
            return $this->respond($response);
        }
    }
}