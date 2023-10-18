<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MyBookingModel;
use CodeIgniter\API\ResponseTrait;

class Booking extends ResourceController
{
    use ResponseTrait;

    protected $myBookingModel;
    
    public function __construct()
    {
        $this->myBookingModel = new MyBookingModel();
    }

    public function index()
    {
        return '';
    }
    
    public function bookingHapus()
    {
        $packageid = isset($_GET['package'])?$_GET['package']:'';
        $date = isset($_GET['date'])?$_GET['date']:'';
        $user = isset($_GET['user'])?$_GET['user']:'';
        $data = [
            'tourism_package_id' => $packageid,
            'date' => $date,
            'user_id' => $user,
        ];
        $deleteBook = $this->myBookingModel->deleteBook($data);
        if($deleteBook) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success delete Booking"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 404,
                'message' => [
                    "Tourism Package not found"
                ]
            ];
            return $this->failNotFound($response['message']);
        }
    }
}
