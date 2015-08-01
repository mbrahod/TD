<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends TD_Controller
{

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
        
        $this->middle = 'dashboard/index'; // passing middle to function. change this for different views.
        $this->layout();
    }
    
    public function profile() {
    
        $this->middle = 'dashboard/profile'; // passing middle to function. change this for different views.
        $this->layout();
    }
    
    public function friends() {
    
        $this->middle = 'dashboard/friends'; // passing middle to function. change this for different views.
        $this->layout();
    }
    
    public function notifications() {
    
        $this->middle = 'dashboard/notifications'; // passing middle to function. change this for different views.
        $this->layout();
    }
    
    public function messages() {
    
        $this->middle = 'dashboard/messages'; // passing middle to function. change this for different views.
        $this->layout();
    }
}
