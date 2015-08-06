<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends TD_Controller
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
        
        $this->auth_middle = 'home'; // passing middle to function. change this for different views.
        $this->auth_layout();
    }
    
    public function search() {
    	
    	$data = array('latitude' => $this->input->post('lat'), 'langitude' => $this->input->post('long'));
    	//echo "<pre>"; print_r($data); exit;
    	$this->load->view('search', $data);
    }
}
