<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\TourismPackageModel;
use App\Models\GalleryPackageModel;
use App\Models\PackageActivitiesModel;
use App\Models\ReviewModel;
use App\Models\DetailFacilityPackageModel;
use CodeIgniter\API\ResponseTrait;

class TourismPackage extends ResourcePresenter
{
    use ResponseTrait;

    protected $tourismPackageModel;
    protected $galleryPackageModel;
    protected $packageActivitiesModel;
    protected $detailFacilityPackageModel;
    protected $reviewModel;
    
    public function __construct()
    {
        $this->tourismPackageModel = new TourismPackageModel();
        $this->galleryPackageModel = new GalleryPackageModel();
        $this->packageActivitiesModel = new PackageActivitiesModel();
        $this->detailFacilityPackageModel = new DetailFacilityPackageModel();
        $this->reviewModel = new ReviewModel();
    }

    public function index()
    {
        $contents = $this->tourismPackageModel->get_list_tp_api()->getResultArray();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of Tourism Package"
            ]
        ];
        return $this->respond($response);
    }

    public function show($id = null)
    {
        $tourismPackage = $this->tourismPackageModel->get_list_tp_api($id)->getRowArray();

        $avg_rating = $this->reviewModel->get_rating('tourism_package_id', $id)->getRowArray()['avg_rating'];
        $list_review = $this->reviewModel->get_review_object_api('tourism_package_id', $id)->getResultArray();

        $list_gallery = $this->galleryPackageModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }

        $list_facility = $this->detailFacilityPackageModel->get_facility_by_tp_api($id)->getResultArray();
        $facilities = array();
        foreach ($list_facility as $facility) {
            $facilities[] = $facility['facility'];
        }

        $tourismPackage['gallery'] = $galleries;
        $tourismPackage['reviews'] = $list_review;
        $tourismPackage['avg_rating'] = $avg_rating;
        $tourismPackage['facilities'] = $facilities;

        $response = [
            'data' => $tourismPackage,
            'status' => 200,
            'message' => [
                "Success display detail information of Tourism Package"
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
        $deleteTP = $this->tourismPackageModel->delete(['id' => $id]);
        if($deleteTP) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success delete Tourism Package"
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
