<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use CodeIgniter\API\ResponseTrait;

class Profile extends ResourceController
{
    use ResponseTrait;
    protected $auth;

    protected $config;
    
    /**
     * @var Session
     */
    protected $session;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

     protected $helpers = ['auth', 'filesystem'];
    
    public function __construct()
    {
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');
        
        $this->config = config('Auth');
        $this->auth = service('authentication');
    }
    
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }

    public function logout()
    {
        if ($this->auth->check())
        {
            $this->auth->logout();
        }
    
        $response = [
            'status' => 200,
            'message' => [
                "Successfully logged out"
            ]
        ];
        return $this->respond($response, 200);
    }
}
