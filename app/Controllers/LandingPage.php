<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use CodeIgniter\RESTful\ResourcePresenter;

class LandingPage extends BaseController
{
    public function index()
    {
        return view('landing_page');
    }
}
