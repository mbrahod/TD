<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends TD_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array(
                'ion_auth',
                'form_validation'
        ));
    }
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http://example.com/index.php/welcome
     * - or -
     * http://example.com/index.php/welcome/index
     * - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * 
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        
        $this->checkLogin();
        
        $this->middle = 'dashboard/index'; // passing middle to function. change this for different views.
        $this->data['menu_item'] = 'index';
        $this->layout();
    }
    
    public function profile() {
    
        $this->checkLogin();
        
        $this->middle = 'dashboard/profile'; // passing middle to function. change this for different views.
        $this->data['menu_item'] = 'profile';
        $this->layout();
    }
    
    public function friends() {
    
        $this->checkLogin();
        
        $this->middle = 'dashboard/friends'; // passing middle to function. change this for different views.
        $this->data['menu_item'] = 'friends';
        $this->layout();
    }
    
    public function notifications() {
    
        $this->checkLogin();
        
        $this->middle = 'dashboard/notifications'; // passing middle to function. change this for different views.
        $this->data['menu_item'] = 'notifications';
        $this->layout();
    }
    
    public function messages() {
    
        $this->checkLogin();
        
        $this->middle = 'dashboard/messages'; // passing middle to function. change this for different views.
        $this->data['menu_item'] = 'messages';
        $this->layout();
    }
    
    public function checkLogin() {
        
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('login', 'refresh');
        }
    }
}
