<?php

namespace App\Controllers\Web;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\AccountModel;
use App\Models\MyBookingModel;
use App\Models\TourismPackageModel;
use App\Models\DetailFacilityPackageModel;
use App\Models\PackageActivitiesModel;
use App\Models\DetailPackageActivitiesModel;
use App\Models\ReviewModel;
use App\Models\RumahGadangModel;
use App\Models\UmkmPlaceModel;
use App\Models\SouvenirPlaceModel;
use App\Models\HistoryPlaceModel;
use App\Models\WorshipPlaceModel;
use App\Models\StudyModel;
use App\Models\TourismObjectModel;
use App\Models\FacilityPackageModel;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;

class MyBooking extends ResourcePresenter
{
    protected $accountModel;
    protected $myBookingModel;
    protected $tourismPackageModel;
    protected $detailFacilityPackageModel;
    protected $tourismActivityModel;
    protected $detailPackageActivitiesModel;
    protected $reviewModel;
    protected $rumahGadangModel;
    protected $umkmPlaceModel;
    protected $souvenirPlaceModel;
    protected $worshipPlaceModel;
    protected $studyModel;
    protected $historyModel;
    protected $tourismObjectModel;
    protected $galleryTourismPackageModel;
    protected $facilityPackageModel;
    protected $auth;
    
    /**
     * @var AuthConfig
     */
    protected $config;
    
    /**
     * @var Session
     */
    protected $session;
    
    public function __construct()
    {
        $this->accountModel = new AccountModel();
        $this->myBookingModel = new MyBookingModel();
        $this->tourismPackageModel = new TourismPackagemodel();   
        $this->detailFacilityPackageModel = new DetailFacilityPackageModel();
        $this->rumahGadangModel = new RumahGadangModel();
        $this->umkmPlaceModel = new UmkmPlaceModel();
        $this->souvenirPlaceModel = new SouvenirPlaceModel();
        $this->worshipPlaceModel = new WorshipPlaceModel();
        $this->studyModel = new StudyModel();
        $this->tourismObjectModel = new TourismObjectModel();
        $this->historyModel = new HistoryPlaceModel();
        $this->tourismActivityModel = new PackageActivitiesModel();
        $this->facilityPackageModel = new FacilityPackageModel();

        
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');
        
        $this->config = config('Auth');
        $this->auth = service('authentication');
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */

    static function _setStatus($num) {
        $status = [
            1 => "Pending",
            2 => "Confirmed",
            3 => "Unavailable",
            4 => "Finished",
            // 4 => "Finished",
        ];
        if(array_key_exists($num,$status)) {
            return $status[$num];
        } else {
            return $status[1];
        }
    }

    function list() {
        $load = $this->myBookingModel->getListByUser(user()->id);
        
        $data = [
             'title' => 'My Booking',
             'data' => $load,
         ];
        
        
        return view('booking/my_booking', $data);
    }

    function detail($packageid, $date) {
        $load = $this->myBookingModel->getBookDetail($packageid,$date,user()->id);

        $request = [];
        if ($this->request->getMethod() == 'post') {
            $request = $this->request->getPost();
        }

        if(isset($request['kirim_rating'])) {
            $dtupd = [
                "date" => $date,
                "tourism_package_id" => $packageid,
                "user_id" => user()->id,
                "rating" => $request['rating'],
                "review" => $request['review'],
            ];
            $execute = $this->myBookingModel->updateRating($dtupd);
            if($execute) {
                $this->session->setFlashdata('success', 'You have successfully done a rating and review');
                return redirect()->to(base_url('booking/detail/'.$packageid."/".$date));
            } else {
                $this->session->setFlashdata('danger', 'You have failed to do rating and review');
                return redirect()->to(base_url('booking/detail/'.$packageid."/".$date));
            }
        }

        if(empty($load)) {
            $data = [
                "title" => "Detail Booking",
                "titlehead" => "Detail booking not found"
            ];
            return view('booking/bk_not_found_detail', $data);
        } else {
            $datapackage = $this->tourismPackageModel->get_tp_by_id_api($load[0]['tourism_package_id'])->getRowArray();
            
            if (empty($datapackage)) {
                return redirect()->to(base_url()."booking/my");
            }

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

            //echo var_dump($detail_package);
            
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
                "title" => "Detail Booking",
                "titlehead" => "Detail Booking",
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

            return view('booking/bk_detail', $data);
        }
        //echo var_dump($load);
    }

    function editData($packageid,$date) {
        $load = $this->myBookingModel->getBookDetail($packageid,$date,user()->id);

        $request = [];
        if ($this->request->getMethod() == 'post') {
            $request = $this->request->getPost();
        }

        if(isset($request['editbook'])) {
            $dtupd = [
                "date" => $date,
                "tourism_package_id" => $packageid,
                "user_id" => user()->id,
                "datenew" => $request['book_tanggal'],
                "comment" => $request['book_keterangan'],
                "total_member" => $request['book_anggota'],
            ];
            $execute = $this->myBookingModel->updateBook($dtupd);
            if($execute) {
                $this->session->setFlashdata('success', 'Berhasil diperbaharui');
                return redirect()->to(base_url('booking/detail/'.$packageid."/".$request['book_tanggal']));
            } else {
                $this->session->setFlashdata('danger', 'Gagal diperbaharui');
                return redirect()->to(base_url('booking/detail/'.$packageid."/".$date));
            }
        }

        if(isset($request['editpack'])) {
            $tourismupd = [
                "contact_person" => $request['contact_person']
            ];
            $execute = $this->tourismPackageModel->new03('tourism_package', $tourismupd, $packageid);
                $this->session->setFlashdata('success', 'Berhasil diperbaharui');
                return redirect()->to(base_url('booking/detail/'.$packageid."/".$date));
        }

        if(isset($request['editdetail'])) {
            $this->tourismPackageModel->clearDataPackage($packageid);

            $a_id_activity = isset($request['a_id_activity'])?$request['a_id_activity']:[];
            foreach ((array)$a_id_activity as $id_activity) {
                $a_day = isset($request['a_day'.$id_activity])?$request['a_day'.$id_activity]:'';
                //echo var_dump($a_day);
                $a_description = isset($request['a_description'.$id_activity])?$request['a_description'.$id_activity]:'';
                $package_day['description'] = $a_description;
                $package_day['day'] = $a_day;
                $package_day['tourism_package_id'] = $packageid;
                $this->tourismPackageModel->new02('package_day', $package_day);
                // print_r($package_day);

                $d_id_detail = isset($request['d_id_detail' . $id_activity])?$request['d_id_detail' . $id_activity]:[];
                $d_activity = isset($request['d_activity' . $id_activity])?$request['d_activity' . $id_activity]:[];
                $d_activity_type = isset($request['d_activity_type' . $id_activity])?$request['d_activity_type' . $id_activity]:[];
                $d_description = isset($request['d_description' . $id_activity])?$request['d_description' . $id_activity]:[];
                $d_id_object = isset($request['d_id_object' . $id_activity])?$request['d_id_object' . $id_activity]:[];
                //print_r($d_id_detail);
                foreach((array)$d_id_detail as $id_detail) {
                    $detail_package['activity'] = $d_activity[$id_detail];
                    $detail_package['activity_type'] = $d_activity_type[$id_detail];
                    $detail_package['description'] = $d_description[$id_detail];
                    $detail_package['id_object'] = $d_id_object[$id_detail];
                    $detail_package['package_day_day'] = $a_day;
                    $detail_package['package_day_tourism_package_id'] = $packageid;
                    $this->tourismPackageModel->new02('detail_package', $detail_package);
                    // print_r($detail_package);
                }
            }

            $f_id_facility = isset($request['f_id_facility'])?$request['f_id_facility']:[];
            $f_facility_package_id = isset($request['f_facility_package_id'])?$request['f_facility_package_id']:[];
            $f_status = isset($request['f_status'])?$request['f_status']:[];

            foreach ((array)$f_id_facility as $id_facility) {
                $detail_facility_package['tourism_package_id'] = $packageid;
                $detail_facility_package['service_package_id'] = $f_facility_package_id[$id_facility];
                $detail_facility_package['status'] = $f_status[$id_facility];
                $this->tourismPackageModel->new02('detail_service_package', $detail_facility_package);
                // print_r($detail_facility_package);
            }
            $this->session->setFlashdata('success', 'Berhasil diperbaharui');
            return redirect()->to(base_url('booking/detail/'.$packageid."/".$date));
        }

        if(empty($load)) {
            $data = [
                "title" => "Detail Booking",
                "titlehead" => "Detail booking not found"
            ];
            return view('booking/bk_not_found_detail', $data);
        } else {
            //echo var_dump($load);
            $datapackage = $this->tourismPackageModel->get_tp_by_id_api($load[0]['tourism_package_id'])->getRowArray();
            
            if (empty($datapackage)) {
                return redirect()->to(base_url()."booking/my");
            }

            $rumah_gadang = $this->rumahGadangModel->get_all()->getResultArray();
            $umkm = $this->umkmPlaceModel->get_all()->getResultArray();
            $souvenir = $this->souvenirPlaceModel->get_all()->getResultArray();
            $worship = $this->worshipPlaceModel->get_all()->getResultArray();
            $history = $this->historyModel->all_in()->getResultArray();
            $study = $this->studyModel->get_all()->getResultArray();
            $tourism_activity = $this->tourismActivityModel->get_all()->getResultArray();
            $tourism_object = $this->tourismObjectModel->get_all()->getResultArray();
            $facility_package = $this->facilityPackageModel->get_all()->getResultArray();

            $detail_package = model('tourismPackageModel')->detail_package($load[0]['tourism_package_id']);
            $package_day = model('tourismPackageModel')->package_day($load[0]['tourism_package_id']);
            $lf = $this->detailFacilityPackageModel->get_facility_by_tp_api1($load[0]['tourism_package_id'])->getResultArray();
            $se = [];
            foreach ($lf as $af) {
                $se[] = [
                    "service_package_id" => $af['id'],
                    "service_package_name" => $af['name'],
                    "service_package_stat" => $af['status']
                ];
            }
            $lnf = $this->detailFacilityPackageModel->get_facility_by_tp_api2($load[0]['tourism_package_id'])->getResultArray();
            $sn = [];
            foreach ($lnf as $af) {
                $sn[] = [
                    "service_package_id" => $af['id'],
                    "service_package_name" => $af['name'],
                    "service_package_stat" => $af['status']
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
                "title" => "Edit Booking",
                "titlehead" => "Edit Booking",
                "booking" => $load,
                "package" => $datapackage,
                'rumah_gadang' => $rumah_gadang,
                'umkm' => $umkm,
                'souvenir' => $souvenir,
                'worship' => $worship,
                'study' => $study,
                'tourism_object' => $tourism_object,
                'history' => $history,
                'tourism_activity' => $tourism_activity,
                'object' => array_merge($rumah_gadang, $umkm, $souvenir, $worship, $history, $study, $tourism_object, $tourism_activity),
                'facility_package' => $facility_package,
                'data' => [
                    'idpackage' => $packageid,
                    'package'=>$datapackage,
                    'package_day' => $package_day,
                    'package_det' => $detail,
                    "service" => $se,
                    "servnon" => $sn,
                ],
            ];
            

            return view('booking/bk_edit', $data);
        }
    }
    
    function checkout() {
        $request = [];
        if ($this->request->getMethod() == 'post') {
            $request = $this->request->getPost();
        }
        $this->session->set("form",json_encode($request));

        if(isset($request['order'])) {
            $packageid = $request['idpackage'];
            if($this->session->get('booking')=='custom') {
                $id = $this->tourismPackageModel->get_new_id_api();
                $package_day = json_decode($this->session->get("package_day"),true);
                $package_cus = json_decode($this->session->get("package_cus"),true);
                $package_ser = json_decode($this->session->get("package_ser"),true);
                $package_detail = json_decode($this->session->get("package_detail"),true);
                //echo var_dump($package_cus);
                $requestData = [
                    'id' => $id,
                    'name' => $package_cus['name'],
                    'price' => empty($package_cus['price']) ? "0" : $package_cus['price'],
                    'capacity' => $package_cus['capacity'],
                    'contact_person' => $package_cus['contact_person'],
                    'description' => $package_cus['description'],
                    'custom' => $package_cus['custom'],
                ];
                $this->tourismPackageModel->clearDataPackage($id);
                $addTP = $this->tourismPackageModel->add_tp_api($requestData);

                foreach((array)$package_day as $pd) {
                    $pd['tourism_package_id'] = $id;
                    $this->tourismPackageModel->new02('package_day', $pd);
                }
                foreach((array)$package_detail as $pdday) {
                    foreach((array)$pdday as $pde) {
                        $pde['package_day_tourism_package_id'] = $id;
                        //echo var_dump($pde);
                        $this->tourismPackageModel->new02('detail_package', $pde);
                    }
                }
                foreach((array)$package_ser as $ps) {
                    unset($ps['name']);
                    $ps['tourism_package_id'] = $id;
                    $this->tourismPackageModel->new02('detail_service_package', $ps);
                }
                $packageid = $id;
            }

            $date = isset($request['book_tanggal'])?$request['book_tanggal']:date("Y-m-d");
            $user_id = user()->id;

            $load = $this->myBookingModel->getBookDetail($packageid,$date,$user_id);

            if(!empty($load)) {
                $this->session->setFlashdata('danger', 'Already made a booking with the same date and package!');
                return redirect()->to(base_url('booking/my'));
            }

            if($packageid!='') {
                $total_member = isset($request['book_anggota'])?$request['book_anggota']:"1";
                $comment = isset($request['book_keterangan'])?$request['book_keterangan']:"";
                
                $savedata = [
                    "tourism_package_id" => $packageid,
                    "total_member" => $total_member,
                    "comment" => $comment,
                    "date" => $date,
                    "user_id" => $user_id
                ];

                $execute = $this->myBookingModel->insertBook($savedata);
                if($execute) {
                    $this->session->setFlashdata('success', 'Pemesanan Anda Berhasil Disimpan');
                    $this->session->remove('form');
                    return redirect()->to(base_url('booking/my'));
                } else {
                    $this->session->setFlashdata('danger', 'Pemesanan Gagal disimpan');
                    return redirect()->to(base_url('booking/keranjang/'.$packageid));
                }
            } else if(!empty($load)) {
                $data = [
                    "title" => "Booking Gagal",
                    "titlehead" => "Anda telah pernah memesan ditanggal yang sama",
                    "idpackage" => $request['idpackage'],
                    "form" => $request,
                ];
            } else {    
                $data = [
                    "title" => "Booking Gagal",
                    "titlehead" => "Package tidak ditemukan",
                    "idpackage" => $request['idpackage'],
                    "form" => $request,
                ];
            }
        } else {
            //echo var_dump($_SESSION);
            $data = [
                "title" => "Booking Gagal",
                "titlehead" => "Lembar Booking Tidak Ditemukan",
                "idpackage" => $request['idpackage'],
                "form" => $request,
            ];
        }

        $this->session->set("form",json_encode($request));            
        return view('booking/bk_not_found', $data);
        //echo var_dump(user()->id);

    }
    
    function keranjang($packageid) {
        //echo var_dump($_SESSION);
        $datapackage = $this->tourismPackageModel->get_tp_by_id_api($packageid)->getRowArray();
        if (empty($datapackage)) {
            return redirect()->to(base_url()."/web/tourismPackage");
        }

        // untuk form data booking
        $prev = $this->session->get("form");
        $formdata = [];
        if($prev!=NULL) {
            $formdata = json_decode($prev,true);
        }
        //echo var_dump($formdata);
        
        if ($this->session->get("booking")=='custom') {
            $request = [];
            if ($this->request->getMethod() == 'post') {
                $request = $this->request->getPost();
            }
            //echo var_dump($request);

            if(isset($request['create_custom'])) {
                $activityin = isset($request['a_id_activity'])?$request['a_id_activity']:[];

                if(empty($activityin)) {
                    return $this->redirectTo("user_custom",$packageid);
                }

                $ppac = $datapackage;
                $ppac['contact_person'] = isset($request['contact_person'])?$request['contact_person']:'';
                $ppac['price'] = 0;
                $ppac['custom'] = '1';
                $ppac['name'] = user()->username;
                
                $pday = [];
                $pdet = [];
                $pser = [];
                foreach($activityin as $id_activity) {
                    $a_day = isset($request['a_day'.$id_activity])?$request['a_day'.$id_activity]:[''];
                    $a_description = isset($request['a_description'.$id_activity])?$request['a_description'.$id_activity]:[''];

                    $package_day['description'] = $a_description[0];
                    $package_day['day'] = $a_day[0];
                    $package_day['tourism_package_id'] = '';
                    $pday[] = $package_day;

                    //echo var_dump($a_day[0]);

                    $d_id_detail = isset($request['d_id_detail' . $id_activity])?$request['d_id_detail' . $id_activity]:[];
                    $d_activity = isset($request['d_activity' . $id_activity])?$request['d_activity' . $id_activity]:[];
                    $d_activity_type = isset($request['d_activity_type' . $id_activity])?$request['d_activity_type' . $id_activity]:[];
                    $d_description = isset($request['d_description' . $id_activity])?$request['d_description' . $id_activity]:[];
                    $d_id_object = isset($request['d_id_object' . $id_activity])?$request['d_id_object' . $id_activity]:[];
                    //print_r($d_id_detail);
                    foreach((array)$d_id_detail as $id_detail) {
                        $detail_package['activity'] = $d_activity[$id_detail];
                        $detail_package['activity_type'] = $d_activity_type[$id_detail];
                        $detail_package['description'] = $d_description[$id_detail];
                        $detail_package['id_object'] = $d_id_object[$id_detail];
                        $detail_package['package_day_day'] = $a_day[0];
                        $detail_package['package_day_tourism_package_id'] = '';
                        //echo var_dump($detail_package);
                        $pdet[$a_day[0]][] = $detail_package;
                        // print_r($detail_package);
                    }
                }
                $f_id_facility = isset($request['f_id_facility'])?$request['f_id_facility']:[];
                $f_facility_package_id = isset($request['f_facility_package_id'])?$request['f_facility_package_id']:[];
                $f_status = isset($request['f_status'])?$request['f_status']:[];
                $f_name_facility = isset($request['f_name_facility'])?$request['f_name_facility']:[];

                foreach ((array)$f_id_facility as $id_facility) {
                    $detail_facility_package['tourism_package_id'] = '';
                    $detail_facility_package['service_package_id'] = $f_facility_package_id[$id_facility];
                    $detail_facility_package['status'] = $f_status[$id_facility];
                    $detail_facility_package['name'] = $f_name_facility[$id_facility];
                    $pser[] = $detail_facility_package;
                    // print_r($detail_facility_package);
                }

                $this->session->set("package_cus",json_encode($ppac));
                $this->session->set("package_day",json_encode($pday));
                $this->session->set("package_ser",json_encode($pser));
                $this->session->set("package_detail",json_encode($pdet));

                return $this->redirectTo("user_keranjang",$packageid);
            } else {
                $package_day = json_decode($this->session->get("package_day"),true);
                $package_cus = json_decode($this->session->get("package_cus"),true);
                $package_ser = json_decode($this->session->get("package_ser"),true);
                $package_detail = json_decode($this->session->get("package_detail"),true);
                $se = [];
                $sn = [];
                //echo var_dump($package_ser);
                foreach ($package_ser as $af) {
                    if($af['status']==1) {
                        $se[] = [
                            "service_package_id" => $af['service_package_id'],
                            "service_package_name" => $af['name']
                        ];
                    } else {
                        $sn[] = [
                            "service_package_id" => $af['service_package_id'],
                            "service_package_name" => $af['name']
                        ];
                    }
                    
                }
                
            }
            $data = [
                'title' => 'My Booking',
                'titlehead' => "Booking",
                'data' => [
                    'idpackage' => $packageid,
                    'package'=>$package_cus,
                    'package_day' => $package_day,
                    'package_det' => $package_detail,
                    "service" => $se,
                    "servnon" => $sn,
                ],
                "form" => $formdata,
            ];
            return view('booking/bk_keranjang_cu', $data);
        } else if($this->session->get("booking")=='direct') { 
            $detail_package = model('tourismPackageModel')->detail_package($packageid);

            $package_day = model('tourismPackageModel')->package_day($packageid);

            $lf = $this->detailFacilityPackageModel->get_facility_by_tp_api1($packageid)->getResultArray();
            $se = [];
            foreach ($lf as $af) {
                $se[] = [
                    "service_package_id" => $af['id'],
                    "service_package_name" => $af['name']
                ];
            }
            $lnf = $this->detailFacilityPackageModel->get_facility_by_tp_api2($packageid)->getResultArray();
            $sn = [];
            foreach ($lnf as $af) {
                $sn[] = [
                    "service_package_id" => $af['id'],
                    "service_package_name" => $af['name']
                ];
            }

            //echo var_dump($detail_package);
            
            $detail = [];
            foreach((array)$detail_package as $dp) {
                $detail[$dp['package_day_day']][] = [
                    "id_object" => $dp['id_object'],
                    "activity" => $dp['activity'],
                    "activity_type" => $dp['activity_type'],
                    "description" => $dp['description']
                ];
            }

            //echo var_dump($datapackage);            
            $data = [
                'title' => 'My Booking',
                'titlehead' => "Booking",
                'data' => [
                    'idpackage' => $packageid,
                    'package'=>$datapackage,
                    'package_day' => $package_day,
                    'package_det' => $detail,
                    "service" => $se,
                    "servnon" => $sn,
                    
                ],
                "form" => $formdata,
                
            ];

            return view('booking/bk_keranjang_nc', $data);
        } else {
            return redirect()->to(base_url()."/web/tourismPackage");
        }
    }

    function custom($packageid) {
        $this->session->set("booking","custom");
        if($this->session->get("cus_id")==null) {
            $this->session->set("cus_id",$packageid);
        }

        $datapackage = $this->tourismPackageModel->get_tp_by_id_api($packageid)->getRowArray();
            
        if (empty($datapackage)) {
            return redirect()->to(base_url()."/web/tourismPackage");
        }


        $rumah_gadang = $this->rumahGadangModel->get_all()->getResultArray();
        $umkm = $this->umkmPlaceModel->get_all()->getResultArray();
        $souvenir = $this->souvenirPlaceModel->get_all()->getResultArray();
        $worship = $this->worshipPlaceModel->get_all()->getResultArray();
        $study = $this->studyModel->get_all()->getResultArray();
        $tourism_object = $this->tourismObjectModel->get_all()->getResultArray();
        $history = $this->historyModel->all_in()->getResultArray();
        $tourism_activity = $this->tourismActivityModel->get_all()->getResultArray();
        $facility_package = $this->facilityPackageModel->get_all()->getResultArray();

        $detail_package = model('tourismPackageModel')->detail_package($packageid);
        $package_day = model('tourismPackageModel')->package_day($packageid);
        $lf = $this->detailFacilityPackageModel->get_facility_by_tp_api1($packageid)->getResultArray();
        $se = [];
        foreach ($lf as $af) {
            $se[] = [
                "service_package_id" => $af['id'],
                "service_package_name" => $af['name'],
                "service_package_stat" => $af['status']
            ];
        }
        $lnf = $this->detailFacilityPackageModel->get_facility_by_tp_api2($packageid)->getResultArray();
        $sn = [];
        foreach ($lnf as $af) {
            $sn[] = [
                "service_package_id" => $af['id'],
                "service_package_name" => $af['name'],
                "service_package_stat" => $af['status']
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
            "title" => "Custom Package",
            "titlehead" => "Create Custom Package",
            "package" => $datapackage,
            'rumah_gadang' => $rumah_gadang,
            'umkm' => $umkm,
            'souvenir' => $souvenir,
            'worship' => $worship,
            'study' => $study,
            'tourism_object' => $tourism_object,
            'tourism_activity' => $tourism_activity,
            'history' => $history,
            'object' => array_merge($rumah_gadang, $umkm, $souvenir, $worship, $study, $history, $tourism_object, $tourism_activity),
            'facility_package' => $facility_package,
            'data' => [
                'idpackage' => $packageid,
                'package'=>$datapackage,
                'package_day' => $package_day,
                'package_det' => $detail,
                "service" => $se,
                "servnon" => $sn,
            ],
        ];
        return view('booking/bk_custom', $data);
        
    }

    public function myBooking() {
         
         $data = [
             'title' => 'My Booking',
         ];
         if ($this->request->getMethod() == 'post') {
             $request = $this->request->getPost();
             $request = $this->request->getPost();
             $requestData = [
                 'id' => $this->tourismPackageModel->get_new_id_api(),
                 'user_id' => user()->username,
                //  'object_id' => $request['object_id'],
                //  'category' => $request['category'],
                //  'date_visit' => $request['date_visit'],
             ];
             $this->myBookingModel->insert($requestData);
             return redirect()->to(base_url('web/myBooking'));
         }
        //  $list_visit = $this->visitHistoryModel->get_visit_history_by_id_api(user()->id)->getResultArray();
        //  $list_object = $this->visitHistoryModel->get_visited_object_api($list_visit);
        //  $data['data'] = $list_object;
         return view('web/my_booking', $data);
     }

    function bookDel($packageid,$date) {
        $request = [];
        if ($this->request->getMethod() == 'post') {
            $request = $this->request->getPost();
        }

        $load = $this->myBookingModel->getBookDetail($packageid,$date,user()->id);
            
        if (empty($load)) {
            return redirect()->to(base_url()."/booking/my");
        }

        $datapackage = $this->tourismPackageModel->get_tp_by_id_api($packageid)->getRowArray();

        $detail_package = model('tourismPackageModel')->detail_package($packageid);

        $package_day = model('tourismPackageModel')->package_day($packageid);

        $lf = $this->detailFacilityPackageModel->get_facility_by_tp_api1($packageid)->getResultArray();
        $se = [];
        foreach ($lf as $af) {
            $se[] = [
                "service_package_id" => $af['id'],
                "service_package_name" => $af['name'],
                "service_package_stat" => $af['status']
            ];
        }
        $lnf = $this->detailFacilityPackageModel->get_facility_by_tp_api2($packageid)->getResultArray();
        $sn = [];
        foreach ($lnf as $af) {
            $sn[] = [
                "service_package_id" => $af['id'],
                "service_package_name" => $af['name'],
                "service_package_stat" => $af['status']
            ];
        }

        //echo var_dump($detail_package);
        
        $detail = [];
        foreach((array)$detail_package as $dp) {
            $detail[$dp['package_day_day']][] = [
                "id_object" => $dp['id_object'],
                "activity" => $dp['activity'],
                "activity_type" => $dp['activity_type'],
                "description" => $dp['description']
            ];
        }

        // hapus data
        $error = '';
        if(isset($request['submit'])) {
            $deldata = [
                "tourism_package_id" => $packageid,
                "date" => $date,
                "user_id" => user()->id,
            ];
            $result = $this->myBookingModel->deleteBook($deldata);
            
            if($result) {
                $this->session->setFlashdata('success', 'Pemesanan Anda Berhasil Dihapus');
                    return redirect()->to(base_url('booking/my'));
            } else {
                $error = "Gagal menghapus data Booking";
            }
        }

        $data = [
            "title" => "Hapus Booking Data",
            "titlehead" => "Hapus Booking?",
            "booking" => $load,
            "idpackage" => $packageid,
            'data' => [
                'idpackage' => $packageid,
                'package'=>$datapackage,
                'package_day' => $package_day,
                'package_det' => $detail,
                "service" => $se,
                "servnon" => $sn,
                
            ],
            "error" => $error,
        ];

        return view('booking/bk_delete', $data);
    }

    function redirectTo($type,$val) {
        switch($type) {
            case 'user_mypackage' :
                return redirect()->to(base_url()."/web/tourismPackage");
                break;
            case 'user_custom' :
                return redirect()->to(base_url()."/booking/ubahpaket/$val");
                break;
            case 'user_keranjang' :
                return redirect()->to(base_url()."/booking/keranjang/$val");
                break;
        }
    }

    function invoice($packageid, $date) {
        $load = $this->myBookingModel->getBookDetail($packageid,$date,user()->id);

        $data = [
            "title" => "Invoice",
            "titlehead" => "Invoice",
            "booking" => $load,
            'data' => [
                'idpackage' => $load[0]['tourism_package_id'],
            ],
        ];      

        $datapackage = $this->tourismPackageModel->get_tp_by_id_api($load[0]['tourism_package_id'])->getRowArray();
        $data['data']['package'] = $datapackage;
        $package_day = model('tourismPackageModel')->package_day($load[0]['tourism_package_id']);
        $data['data']['package_day'] = $package_day;
        $detail_package = model('tourismPackageModel')->detail_package($load[0]['tourism_package_id']);
        $detail = [];
        foreach((array)$detail_package as $dp) {
            $detail[$dp['package_day_day']][] = [
                "id_object" => $dp['id_object'],
                "activity" => $dp['activity'],
                "activity_type" => $dp['activity_type'],
                "description" => $dp['description']
            ];
        }
        $data['data']['package_det'] = $detail;
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
        $data['data']['service'] = $se;
        $data['data']['servnon'] = $sn;
        
        return view('booking/bk_invoice', $data);
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
        //
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function editA($id = null)
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
