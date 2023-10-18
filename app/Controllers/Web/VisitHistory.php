<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\AccountModel;
use App\Models\VisitHistoryModel;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;

class VisitHistory extends BaseController
{
    protected $accountModel;
    protected $visitHistoryModel;
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
        $this->visitHistoryModel = new VisitHistoryModel();
        
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');
        
        $this->config = config('Auth');
        $this->auth = service('authentication');
    }

    public function visitHistory()
    {
        $user_id = user()->id;
        $visit = $this->visitHistoryModel->getVisitByUser($user_id);

        $data = [
            'title' => 'Visit History',
            'visit' => $visit,
        ];
        return view('web/visit_history', $data);
    }
    
    public function addVisitHistory()
    {
        $data = [
            'title' => 'Visit History',
        ];
        return view('web/add_visit_history', $data);
    }
}
