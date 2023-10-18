<?php

namespace App\Controllers\Web;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\TourismPackageModel;
use App\Models\MyBookingModel;
use App\Models\GalleryTourismPackageModel;
use App\Models\PackageActivitiesModel;
use App\Models\DetailPackageActivitiesModel;
//use App\Models\ReviewModel;
use App\Models\DetailFacilityPackageModel;
use App\Models\RumahGadangModel;
use App\Models\UmkmPlaceModel;
use App\Models\SouvenirPlaceModel;
use App\Models\WorshipPlaceModel;
use App\Models\HistoryPlaceModel;
use App\Models\StudyModel;
use App\Models\TourismObjectModel;
use App\Models\FacilityPackageModel;
use CodeIgniter\Files\File;
use CodeIgniter\Session\Session;

class TourismPackage extends ResourcePresenter
{
  protected $tourismPackageModel;
  protected $myBookingModel;
  protected $tourismActivityModel;
  protected $detailPackageActivitiesModel;
  //protected $reviewModel;
  protected $detailFacilityPackageModel;
  protected $rumahGadangModel;
  protected $umkmPlaceModel;
  protected $historyPlaceModel;
  protected $souvenirPlaceModel;
  protected $worshipPlaceModel;
  protected $studyModel;
  protected $tourismObjectModel;
  protected $galleryTourismPackageModel;
  protected $facilityPackageModel;

  protected $helpers = ['auth', 'url', 'filesystem'];
  /**
     * @var Session
     */
    protected $session;

  public function __construct()
  {
    $this->tourismPackageModel = new TourismPackageModel();
    $this->myBookingModel = new MyBookingModel();
    $this->galleryTourismPackageModel = new GalleryTourismPackageModel();
    $this->tourismActivityModel = new PackageActivitiesModel();
    $this->detailPackageActivitiesModel = new DetailPackageActivitiesModel();
    //$this->reviewModel = new ReviewModel();
    $this->detailFacilityPackageModel = new DetailFacilityPackageModel();
    $this->rumahGadangModel = new RumahGadangModel();
    $this->umkmPlaceModel = new UmkmPlaceModel();
    $this->souvenirPlaceModel = new SouvenirPlaceModel();
    $this->worshipPlaceModel = new WorshipPlaceModel();
    $this->historyPlaceModel = new HistoryPlaceModel();
    $this->studyModel = new StudyModel();
    $this->tourismObjectModel = new TourismObjectModel();
    $this->facilityPackageModel = new FacilityPackageModel();

    $this->session = service('session');
  }
  public function index()
  {
    $contents = $this->tourismPackageModel->get_List_tp_api_noncus()->getResultArray();
    $data = [
      'title' => 'Tourism Package',
      'category' => 'Tourism Package',
      'data' => $contents,
    ];
    return view('web/list_tourism_package', $data);
  }

  /**
   * Present a view to present a specific resource object
   *
   * @param mixed $id
   *
   * @return mixed
   */
  public function show($id= null, $day = null, $tourism_package_id = null)
  {
    $this->session->set("booking","direct");
    $tourismPackage = $this->tourismPackageModel->get_tp_by_id_api($id)->getRowArray();
    if (empty($tourismPackage)) {
      return redirect()->to(substr(current_url(), 0, -strlen($id)));
    }

    //$avg_rating = $this->reviewModel->get_rating('tourism_package_id', $id)->getRowArray()['avg_rating'];
    //$list_review = $this->reviewModel->get_review_object_api('tourism_package_id', $id)->getResultArray();
    $rating = $this->myBookingModel->getRating($id);

    $list_gallery = $this->galleryTourismPackageModel->get_gallery_api($id)->getResultArray();
    $galleries = array();
    foreach ($list_gallery as $gallery) {
      $galleries[] = $gallery['url'];
    }

    $lf = $this->detailFacilityPackageModel->get_facility_by_tp_api1($id)->getResultArray();
    $f = array();
    foreach ($lf as $af) {
      $f[] = $af['name'];
    }

    $lnf = $this->detailFacilityPackageModel->get_facility_by_tp_api2($id)->getResultArray();
    $nf = array();
    foreach ($lnf as $anf) {
      $nf[] = $anf['name'];
    }

    $tourismPackage['gallery'] = $galleries;
    //$tourismPackage['reviews'] = $list_review;
    //$tourismPackage['avg_rating'] = $avg_rating;
    $tourismPackage['f'] = $f;
    $tourismPackage['nf'] = $nf;

    $data = [
      'title' => $tourismPackage['name'],
      'data' => $tourismPackage,
      'rating' => $rating,
    ];
    if (url_is('*dashboard*')) {
      return view('dashboard/detail_tourism_package', $data);
  }
  return view('web/detail_tourism_package', $data);
  }

  /**
   * Present a view to present a new single resource object
   *
   * @return mixed
   */
  public function new()
  {
    $rumah_gadang = $this->rumahGadangModel->get_all()->getResultArray();
    $umkm = $this->umkmPlaceModel->get_all()->getResultArray();
    $souvenir = $this->souvenirPlaceModel->get_all()->getResultArray();
    $worship = $this->worshipPlaceModel->get_all()->getResultArray();
    $study = $this->studyModel->get_all()->getResultArray();
    $tourism_object = $this->tourismObjectModel->get_all()->getResultArray();
    $history = $this->historyPlaceModel->all_in()->getResultArray();
    $tourism_activity = $this->tourismActivityModel->get_all()->getResultArray();
    $facility_package = $this->facilityPackageModel->get_all()->getResultArray();
    $data = [
      'title' => 'New Tourism Package',
      'rumah_gadang' => $rumah_gadang,
      'umkm' => $umkm,
      'souvenir' => $souvenir,
      'worship' => $worship,
      'study' => $study,
      'history' => $history,
      'tourism_object' => $tourism_object,
      'tourism_activity' => $tourism_activity,
      'object' => array_merge($rumah_gadang, $umkm, $souvenir, $worship, $study, $history, $tourism_object, $tourism_activity),
      'facility_package' => $facility_package
    ];
    //echo var_dump(array_merge($rumah_gadang, $umkm, $souvenir, $worship, $study, $tourism_object));
    return view('dashboard/tourism_package_form', $data);
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
    $id = $this->tourismPackageModel->get_new_id_api();
    $this->tourismPackageModel->clearDataPackage($id);
    $requestData = [
      'id' => $id,
      'name' => $request['name'],
      'price' => empty($request['price']) ? "0" : $request['price'],
      'capacity' => $request['capacity'],
      'contact_person' => $request['contact_person'],
      'description' => $request['description'],
      'custom' => '0',
    ];
    foreach ($requestData as $key => $value) {
      if ($value=='') {
        unset($requestData[$key]);
      }
    }
    
    $addTP = $this->tourismPackageModel->add_tp_api($requestData);

    $a_id_activity = isset($request['a_id_activity'])?$request['a_id_activity']:[];
    //echo var_dump($_POST);
    foreach ((array)$a_id_activity as $id_activity) {
      $a_day = isset($request['a_day'.$id_activity])?$request['a_day'.$id_activity]:'';
      $a_description = isset($request['a_description'.$id_activity])?$request['a_description'.$id_activity]:'';
      $package_day['description'] = $a_description;
      $package_day['day'] = $a_day;
      $package_day['tourism_package_id'] = $id;
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
        $detail_package['package_day_tourism_package_id'] = $id;
        $this->tourismPackageModel->new02('detail_package', $detail_package);
        // print_r($detail_package);
      }
    }

    $f_id_facility = isset($request['f_id_facility'])?$request['f_id_facility']:[];
    $f_facility_package_id = isset($request['f_facility_package_id'])?$request['f_facility_package_id']:[];
    $f_status = isset($request['f_status'])?$request['f_status']:[];

    foreach ((array)$f_id_facility as $id_facility) {
      $detail_facility_package['tourism_package_id'] = $id;
      $detail_facility_package['service_package_id'] = $f_facility_package_id[$id_facility];
      $detail_facility_package['status'] = $f_status[$id_facility];
      $this->tourismPackageModel->new02('detail_service_package', $detail_facility_package);
      // print_r($detail_facility_package);
    }
    
    if (isset($request['gallery'])) {
      $folders = $request['gallery'];
      $gallery = array();
      foreach ($folders as $folder) {
        $filepath = WRITEPATH . 'uploads/' . $folder;
        $filenames = get_filenames($filepath);
        $fileImg = new File($filepath . '/' . $filenames[0]);
        $fileImg->move(FCPATH . 'media/photos');
        delete_files($filepath);
        rmdir($filepath);
        $gallery[] = $fileImg->getFilename();
      }
      $this->galleryTourismPackageModel->add_gallery_api($id, $gallery);
    }

    if ($addTP) {
      return redirect()->to(base_url('dashboard/tourismPackage') . '/' . $id);
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
    $tourismPackage = $this->tourismPackageModel->get_tp_by_id_api($id)->getRowArray();
    if (empty($tourismPackage)) {
      return redirect()->to('dashboard/tourismPackage');
    }

    $list_gallery = $this->galleryTourismPackageModel->get_gallery_api($id)->getResultArray();
    $galleries = array();
    foreach ($list_gallery as $gallery) {
      $galleries[] = $gallery['url'];
    }

    $f = $this->detailFacilityPackageModel->get_facility_by_tp_api1e($id)->getResultArray();
    $nf = $this->detailFacilityPackageModel->get_facility_by_tp_api2e($id)->getResultArray();

    $tourismPackage['gallery'] = $galleries;
    $tourismPackage['f'] = $f;
    $tourismPackage['nf'] = $nf;

    $rumah_gadang = $this->rumahGadangModel->get_all()->getResultArray();
    $umkm = $this->umkmPlaceModel->get_all()->getResultArray();
    $souvenir = $this->souvenirPlaceModel->get_all()->getResultArray();
    $worship = $this->worshipPlaceModel->get_all()->getResultArray();
    $history = $this->historyPlaceModel->all_in()->getResultArray();
    $study = $this->studyModel->get_all()->getResultArray();
    $tourism_object = $this->tourismObjectModel->get_all()->getResultArray();
    $tourism_activity = $this->tourismActivityModel->get_all()->getResultArray();
    $facility_package = $this->facilityPackageModel->get_all()->getResultArray();
    $data = [
      'title' => 'Edit Tourism Package',
      'data' => $tourismPackage,
      'rumah_gadang' => $rumah_gadang,
      'umkm' => $umkm,
      'souvenir' => $souvenir,
      'worship' => $worship,
      'study' => $study,
      'history' => $history,
      'tourism_object' => $tourism_object,
      'tourism_activity' => $tourism_activity,
      'object' => array_merge($rumah_gadang, $umkm, $souvenir, $worship, $study, $history, $tourism_object, $tourism_activity),
      'facility_package' => $facility_package
    ];
    return view('dashboard/tourism_package_form', $data);
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
    $tourism_package = [
      'name' => $request['name'],
      'price' => empty($request['price']) ? "0" : $request['price'],
      'capacity' => $request['capacity'],
      'contact_person' => $request['contact_person'],
      'description' => $request['description']
    ];
    
    foreach ($tourism_package as $key => $value) {
      if (empty($value)) {
        unset($requestData[$key]);
      }
    }
    if (isset($request['video'])) {
      $folder = $request['video'];
      $filepath = WRITEPATH . 'uploads/' . $folder;
      $filenames = get_filenames($filepath);
      echo $filepath;
      $vidFile = new File($filepath . '/' . $filenames[0]);
      $vidFile->move(FCPATH . 'media/videos');
      delete_files($filepath);
      rmdir($filepath);
      $requestData['video_url'] = $vidFile->getFilename();
    }

    $this->tourismPackageModel->new03('tourism_package', $tourism_package, $id);
    $this->tourismPackageModel->new04($id);

    $a_id_activity = isset($request['a_id_activity'])?$request['a_id_activity']:[];
    foreach ((array)$a_id_activity as $id_activity) {
      $a_day = isset($request['a_day'.$id_activity])?$request['a_day'.$id_activity]:'';
      //echo var_dump($a_day);
      $a_description = isset($request['a_description'.$id_activity])?$request['a_description'.$id_activity]:'';
      $package_day['description'] = $a_description;
      $package_day['day'] = $a_day;
      $package_day['tourism_package_id'] = $id;
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
        $detail_package['package_day_tourism_package_id'] = $id;
        $this->tourismPackageModel->new02('detail_package', $detail_package);
        // print_r($detail_package);
      }
    }

    $f_id_facility = isset($request['f_id_facility'])?$request['f_id_facility']:[];
    $f_facility_package_id = isset($request['f_facility_package_id'])?$request['f_facility_package_id']:[];
    $f_status = isset($request['f_status'])?$request['f_status']:[];

    foreach ((array)$f_id_facility as $id_facility) {
      $detail_facility_package['tourism_package_id'] = $id;
      $detail_facility_package['service_package_id'] = $f_facility_package_id[$id_facility];
      $detail_facility_package['status'] = $f_status[$id_facility];
      $this->tourismPackageModel->new02('detail_service_package', $detail_facility_package);
      // print_r($detail_facility_package);
    }

    if (isset($request['gallery'])) {
      $folders = $request['gallery'];
      $gallery = array();
      foreach ($folders as $folder) {
        $filepath = WRITEPATH . 'uploads/' . $folder;
        $filenames = get_filenames($filepath);
        $fileImg = new File($filepath . '/' . $filenames[0]);
        $fileImg->move(FCPATH . 'media/photos');
        delete_files($filepath);
        rmdir($filepath);
        $gallery[] = $fileImg->getFilename();
      }
      $this->galleryTourismPackageModel->add_gallery_api($id, $gallery);
    }
    return redirect()->to(base_url('dashboard/tourismPackage') . '/' . $id);
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
