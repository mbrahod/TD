<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends TD_Controller
{
	/**
	 * Constructor for Driver Auth class
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array(
            'ion_auth',
            'form_validation'
        ));
        $this->load->helper(array(
            'url',
            'language'
        ));
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
        $this->lang->load(array('auth', 'driver'));
    }
    
    /**
     * Driver login action
     */
    function login()
    {
        $this->data['title'] = lang('login_title');
        
        // validate form input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == true) {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool) $this->input->post('remember');
            
            if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)) {
                // if the login is successful
                // redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('/', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            
            $this->data['identity'] = array(
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity')
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password'
            );
            
            $this->_render_page('login', $this->data);
        }
    }
    
    /**
     * Driver logout action
     */
    function logout()
    {
        $this->data['title'] = "Logout";
        
        // log the user out
        $logout = $this->ion_auth->logout();
        
        // redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('login', 'refresh');
    }
    
    /**
     * Driver forgot password
     */
    function forgot_password()
    {
    	$this->data['title'] = lang('forgot_password_heading');
    	
    	// setting validation rules by checking wheather identity is username or email
    	if ($this->config->item('identity', 'ion_auth') == 'username') {
    		$this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
    	} else {
    		$this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
    	}
    
    	if ($this->form_validation->run() == false) {
    		// setup the input
    		$this->data['email'] = array(
    				'name' => 'email',
    				'id' => 'email'
    		);
    
    		if ($this->config->item('identity', 'ion_auth') == 'username') {
    			$this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
    		} else {
    			$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
    		}
    
    		// set any errors and display the form
    		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
    		$this->_render_page('forgot_password', $this->data);
    	} else {
    		// get identity from username or email
    		if ($this->config->item('identity', 'ion_auth') == 'username') {
    			$identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))
    			->users()
    			->row();
    		} else {
    			$identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))
    			->users()
    			->row();
    		}
    		if (empty($identity)) {
    
    			if ($this->config->item('identity', 'ion_auth') == 'username') {
    				$this->ion_auth->set_message('forgot_password_username_not_found');
    			} else {
    				$this->ion_auth->set_message('forgot_password_email_not_found');
    			}
    
    			$this->session->set_flashdata('message', $this->ion_auth->messages());
    			redirect("forgot_password", 'refresh');
    		}
    
    		// run the forgotten password method to email an activation code to the user
    		$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
    
    		if ($forgotten) {
    			// if there were no errors
    			$this->session->set_flashdata('message', $this->ion_auth->messages());
    			redirect("login", 'refresh'); // we should display a confirmation page here instead of the login page
    		} else {
    			$this->session->set_flashdata('message', $this->ion_auth->errors());
    			redirect("forgot_password", 'refresh');
    		}
    	}
    }
    
    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);
        
        return array(
            $key => $value
        );
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $render = false)
    {
        $this->viewdata = (empty($data)) ? $this->data : $data;
        
        $view_html = $this->load->view($view, $this->viewdata, $render);
        
        if (! $render)
            return $view_html;
    }
}
