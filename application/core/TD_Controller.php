<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TD_Controller extends CI_Controller
{
   //set the class variable.
   var $template  = array();
   var $data      = array();
   
   function __construct()
   {
       parent::__construct();
       $this->load->library(array(
               'ion_auth',
       ));
   }
   
   //Load layout   
   public function layout() {
     // making temlate and send data to view.
     $this->template['header'] = $this->load->view('layout/header', $this->data, true);
     
     if ($this->ion_auth->logged_in()) {
        $this->template['left']   = $this->load->view((isset($this->left) ? $this->left : 'layout/left'), $this->data, true);
     }
     $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
     $this->template['footer'] = $this->load->view('layout/footer', $this->data, true);
     
     $this->load->view('layout/index', $this->template);
   }
   
   /**
    * Auth pages layout
    */
   public function auth_layout() {
   	// making temlate and send data to view.
   	$this->template['auth_header'] = $this->load->view('layout/auth_header', $this->data, true);
   	$this->template['auth_middle'] = $this->load->view($this->auth_middle, $this->data, true);
   	$this->template['auth_footer'] = $this->load->view('layout/auth_footer', $this->data, true);
   	 
   	$this->load->view('layout/auth_index', $this->template);
   }
}