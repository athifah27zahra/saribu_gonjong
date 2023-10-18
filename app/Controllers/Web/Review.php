<?php

namespace App\Controllers\Web;
use App\Models\ReviewModel;
use CodeIgniter\I18n\Time;

use App\Controllers\BaseController;

class Review extends BaseController
{
    protected $reviewModel;
    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }

    public function add()
    {
        $request = $this->request->getPost();
        $requestData = [
            'id' => $this->reviewModel->get_new_id_api(),
            'comment' => $request['comment'],
            'date' => Time::now(),
            'rating' => $request['rating'],
            'user_id' => user()->id,
        ];
        if (substr($request['object_id'], 0, 1) == 'R') {
            $requestData['rumah_gadang_id'] = $request['object_id'];
            $addReview = $this->reviewModel->add_review_api($requestData);
            if ($addReview) {
                return redirect()->to(base_url('web/rumahGadang') . '/' . $requestData['rumah_gadang_id'] . '#reviews');
            }
        }
        
        $requestData['tourism_package_id'] = $request['object_id'];
        $addReview = $this->reviewModel->add_review_api($requestData);
        if ($addReview) {
            return redirect()->to(base_url('web/tourismPackage') . '/' . $requestData['tourism_package_id'] . '#reviews');
        }
        return redirect()->to(base_url('web'));
    }
}
