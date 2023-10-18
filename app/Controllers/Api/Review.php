<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\ReviewModel;

class Review extends ResourcePresenter
{
    use ResponseTrait;

    protected $reviewModel;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
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
        $request = $this->request->getPost();
        $requestData = [
            'id' => $this->reviewModel->get_new_id_api(),
            'rumah_gadang_id' => $request['rumah_gadang_id'],
            'tourism_package_id' => $request['tourism_package_id'],
            'comment' => $request['comment'],
            'date' => Time::now(),
            'rating' => $request['rating'],
            'user_id' => $request['user_id'],
        ];
        $addReview = $this->reviewModel->add_review_api($requestData);
        if($addReview) {
            $response = [
                'status' => 201,
                'message' => [
                    "Success create new review"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail create new review"
                ]
            ];
            return $this->fail($response);
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
