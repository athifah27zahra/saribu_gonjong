<?php

namespace App\Controllers\Web;
use App\Models\AccountModel;
use App\Models\TourismPackageModel;
use App\Models\DetailFacilityPackageModel;
use App\Models\FacilityRumahGadangModel;
use App\Models\FacilityTourismPackageModel;
use App\Models\RumahGadangModel;
use App\Models\MyBookingModel;
use App\Models\WorshipPlaceModel;
use App\Models\UmkmPlaceModel;
use App\Models\HistoryPlaceModel;
use App\Models\SouvenirPlaceModel;
use App\Models\PackageActivitiesModel;
use App\Models\TourismObjectModel; 
use App\Models\StudyModel; 

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $rumahGadangModel;
    protected $tourismPackageModel;
    protected $detailFacilityPackageModel;
    protected $facilityModel;
    protected $facilityTourismPackageModel;
    protected $accountModel;
    protected $myBookingModel;
    protected $worshipPlaceModel;
    protected $historyPlaceModel;
    protected $umkmPlaceModel;
    protected $souvenirPlaceModel;
    protected $activityModel;
    protected $tourismObjectModel;
    protected $studyModel;
    protected $helpers = ['auth'];
    protected $session;
    
    public function __construct()
    {
        $this->rumahGadangModel = new RumahGadangModel();
        $this->tourismPackageModel = new TourismPackageModel();   
        $this->detailFacilityPackageModel = new DetailFacilityPackageModel();
        $this->facilityModel = new FacilityRumahGadangModel();
        $this->facilityTourismPackageModel = new FacilityTourismPackageModel();
        $this->accountModel = new AccountModel();
        $this->myBookingModel = new MyBookingModel();
        $this->worshipPlaceModel = new WorshipPlaceModel();
        $this->umkmPlaceModel = new UmkmPlaceModel();
        $this->historyPlaceModel = new HistoryPlaceModel();
        $this->souvenirPlaceModel = new SouvenirPlaceModel();
        $this->activityModel = new PackageActivitiesModel();
        $this->tourismObjectModel = new TourismObjectModel();
        $this->studyModel = new StudyModel();
        $this->session = service('session');
        // parent::__constructor();
    }

    public function index()
    {
        if (in_groups("admin")) {
            return redirect()->to(base_url('/dashboard/users'));
        } 
        return redirect()->to(base_url('/web'));
    }

    public function rumahGadang()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->rumahGadangModel->get_list_rg_api()->getResultArray();
        }
        
        $data = [
            'title' => 'Manage Rumah Gadang',
            'category' => 'Rumah Gadang',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function tourismPackage()
    {
        $contents = [];
        $custom = isset($_GET['custom'])?$_GET['custom']:0;
        if (in_groups('admin')) {
            
            $contents = $this->tourismPackageModel->get_list_tp_by_cus($custom)->getResultArray();
        }        
        $data = [
            'title' => 'Manage Tourism Package',
            'category' => 'Tourism Package',
            'custom' => $custom,
            'data' => $contents,
        ];
        return view('dashboard/manage_tp', $data);
    }

    public function worshipPlace()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->worshipPlaceModel->get_list_wp_api()->getResultArray();
        } 
        
        $data = [
            'title' => 'Manage Worship Place',
            'category' => 'Worship Place',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function umkmPlace()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->umkmPlaceModel->get_list_up_api()->getResultArray();
        } 
        
        $data = [
            'title' => 'Manage UMKM Place',
            'category' => 'UMKM Place',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function souvenirPlace()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->souvenirPlaceModel->get_list_sp_api()->getResultArray();
        } 
        
        $data = [
            'title' => 'Manage Souvenir Place',
            'category' => 'Souvenir Place',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function historyPlace()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->historyPlaceModel->get_list_hp_api()->getResultArray();
        } 
        
        $data = [
            'title' => 'Manage History Place',
            'category' => 'History Place',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function packageActivities()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->activityModel->get_all()->getResultArray();
        } 
        
        $data = [
            'title' => 'Manage Tourism Activity',
            'category' => 'Tourism Activity',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function tourismObject()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->tourismObjectModel->get_all()->getResultArray();
        } 
        
        $data = [
            'title' => 'Manage Tourism Object',
            'category' => 'Tourism Object',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function study()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->studyModel->get_all()->getResultArray();
        } 
        
        $data = [
            'title' => 'Manage Study Place',
            'category' => 'Study Place',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function myBooking()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->myBookingModel->getList();
        } 
        
        $data = [
            'title' => 'Manage Booking Package',
            'titlehead' => 'Booking Package',
            'data' => $contents,
        ];
        return view('dashboard/booking_dash', $data);
    }

    function bookingDetail($packageid,$date,$user_id) {
        $load = $this->myBookingModel->getBookDetail($packageid,$date,$user_id);
        $request = [];
        if ($this->request->getMethod() == 'post') {
            $request = $this->request->getPost();
        }

        //echo var_dump($load);
        if(empty($load)) {
            return redirect()->to(base_url('dashboard/myBooking'));
        }

        if(isset($request['editbook'])) {
            $dtupd = [
                "date" => $date,
                "tourism_package_id" => $packageid,
                "user_id" => $user_id,
                "status" => $request['status'],
            ];
            $execute = $this->myBookingModel->updateStatus($dtupd);
            if($execute) {
                $this->session->setFlashdata('success', 'Updated Successfully');
                return redirect()->to(base_url('dashboard/bookingDetail/'."$packageid/$date/$user_id"));
            } else {
                $this->session->setFlashdata('danger', 'Updated Failed');
                return redirect()->to(base_url('dashboard/bookingDetail/'."$packageid/$date/$user_id"));
            }
        }

        if(isset($request['editpack'])) {
            $tourismupd = [
                "price" => $request['price']
            ];
            $execute = $this->tourismPackageModel->new03('tourism_package', $tourismupd, $packageid);
            $this->session->setFlashdata('success', 'Updated Successfully');
            return redirect()->to(base_url('dashboard/bookingDetail/'."$packageid/$date/$user_id"));
        }

        $datapackage = $this->tourismPackageModel->get_tp_by_id_api($load[0]['tourism_package_id'])->getRowArray();

        $detail_package = model('tourismPackageModel')->detail_package($load[0]['tourism_package_id']);

        $package_day = model('tourismPackageModel')->package_day($load[0]['tourism_package_id']);

        $lf = $this->detailFacilityPackageModel->get_facility_by_tp_api1($load[0]['tourism_package_id'])->getResultArray();
        $se = [];
        foreach ($lf as $af) {
            $se[] = [
                "service_package_id" => $af['id'],
                "service_package_name" => $af['name']
            ];
        }
        $lnf = $this->detailFacilityPackageModel->get_facility_by_tp_api2($load[0]['tourism_package_id'])->getResultArray();
        $sn = [];
        foreach ($lnf as $af) {
            $sn[] = [
                "service_package_id" => $af['id'],
                "service_package_name" => $af['name']
            ];
        }
        $detail = [];
        foreach((array)$detail_package as $dp) {
            $detail[$dp['package_day_day']][] = [
                "id_object" => $dp['id_object'],
                "activity" => $dp['activity'],
                "activity_type" => $dp['activity_type'],
                "description" => $dp['description']
            ];
        }

        $data = [
            'title' => 'Detail Booking Package',
            'titlehead' => 'Detail Booking Package',
            "booking" => $load,
            'data' => [
                'idpackage' => $load[0]['tourism_package_id'],
                'package'=>$datapackage,
                'package_day' => $package_day,
                'package_det' => $detail,
                "service" => $se,
                "servnon" => $sn,                
            ],
        ];
        return view('dashboard/booking_detail', $data);
    }

    function bookingHapus() {
        $packageid = isset($_GET['package'])?$_GET['package']:'';
        $date = isset($_GET['date'])?$_GET['date']:'';
        $user = isset($_GET['user'])?$_GET['user']:'';
    }

    function bookingPackage($price) {
        $request = [];
        if ($this->request->getMethod() == 'post') {
            $request = $this->request->getPost();
        }


    }

    function bookingUpdate($packageid,$date,$user_id) {
        $request = [];
        if ($this->request->getMethod() == 'post') {
            $request = $this->request->getPost();
        }

        
    }

    public function facilityRumahGadang()
    {
        $contents = $this->facilityModel->get_list_fc_api()->getResultArray();
        $data = [
            'title' => 'Manage Facility',
            'category' => 'Facility',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }

    public function facilityTourismPackage()
    {
        $contents = $this->facilityTourismPackageModel->get_list_fc_api()->getResultArray();
        $data = [
            'title' => 'Manage Service Package',
            'category' => 'Service Package',
            'data' => $contents,
        ];
        return view('dashboard/manage_sp', $data);
    }
    
    public function users()
    {
        $contents = $this->accountModel->get_list_user_api()->getResultArray();
        $data = [
            'title' => 'Manage Users',
            'category' => 'Users',
            'data' => $contents,
        ];
        return view('dashboard/manage', $data);
    }
    
    public function recommendation()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->rumahGadangModel->get_list_recommendation_api()->getResultArray();
        } 
        
        $recommendations = $this->rumahGadangModel->get_recommendation_data_api()->getResultArray();
        $data = [
            'title' => 'Manage Recommendation',
            'category' => 'Recommendation',
            'data' => $contents,
            'recommendations' => $recommendations,
        ];
        return view('dashboard/recommendation', $data);
    }
}
