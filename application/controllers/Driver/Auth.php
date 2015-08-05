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
        
        // Facebook login cradential
        $this->app_id = $this->config->item('app_id', 'ion_auth');
        $this->app_secret = $this->config->item('app_secret', 'ion_auth');
        $this->scope = $this->config->item('scope', 'ion_auth');
        $this->return_fields = $this->config->item('return_fields', 'ion_auth');
        
        if($this->config->item('redirect_uri', 'ion_auth') === '' ) {
        	$this->my_url = site_url('home');
        } else {
        	$this->my_url = $this->config->item('redirect_uri', 'ion_auth');
        }
        
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
            
            $this->auth_middle = 'driver/login';
            $this->auth_layout();
        }
    }
    
    /**
     * Facebook login
     */
    public function fb_login() {
    	
    	// null at first
    	$code = $this->input->get('code');
    	
    	// if is not set go make a facebook connection
    	if(!$code) {
    	
    		// create a unique state
    		$this->session->set_userdata('state', md5(uniqid(rand(), TRUE)));
    	
    		// redirect to facebook oauth page
    		$url_to_redirect =  "https://www.facebook.com/dialog/oauth?client_id="
    				.$this->app_id
    				."&redirect_uri=".urlencode($this->my_url)
    				."&state=".$this->session->userdata('state').'&scope='.$this->scope;
    	
    		redirect($url_to_redirect);
    	
    	} else {
    	
    		// check if session state is equal to the returned state
    		
    		if($this->session->userdata('state') && ($this->session->userdata('state') === $this->input->get('state'))) {
    	
    	
    			$token_url = "https://graph.facebook.com/oauth/access_token?"
    					. "client_id=" . $this->app_id . "&redirect_uri=" . urlencode($this->my_url)
    					. "&client_secret=" . $this->app_secret . "&code=" . $code;
    	
    			$response = file_get_contents($token_url);
    			
    			$params = null;
    	
    			parse_str($response, $params);
    	
    			$this->session->set_userdata('access_token', $params['access_token']);
    	
    			$graph_url = "https://graph.facebook.com/me?access_token=".$params['access_token'].'&fields='.$this->return_fields;
    			
    			$user = json_decode(file_get_contents($graph_url));
    	
    			// check if this user is already registered
    			if(!$this->ion_auth_model->identity_check($user->email)){
    				$name = explode(" ", $user->name);
    				$userId = $this->ion_auth->register($user->name, 'facebookdoesnothavepass123', $user->email, array('first_name' => $name[0], 'last_name' => $name[1]));
					
    				if ($userId !== false) {
    					if ($this->ion_auth->login($user->email, 'facebookdoesnothavepass123', false)) {
    						// if the login is successful
    						// redirect them back to the home page
    						$this->session->set_flashdata('message', $this->ion_auth->messages());
    						redirect('dashboard', 'refresh');
    					} else {
    						// if the login was un-successful
    						// redirect them back to the login page
    						$this->session->set_flashdata('message', $this->ion_auth->errors());
    						redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
    					}
    				}
    			} else { 
    				// Get user infor from database
    				$user = $this->ion_auth->where('email', $user->email)->users()->row();
    				
                    $this->ion_auth->set_session($user);
                    
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

                    redirect('dashboard', 'refresh');
    			}
    	
    			return true;
    		}
    		else {
    			return false;
    		}
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
    		
    		$this->auth_middle = 'driver/forgot_password';
    		$this->auth_layout();
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
    
    function change_password()
    {
    	$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
    	$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
    	$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
    
    	if (! $this->ion_auth->logged_in()) {
    		redirect('auth/login', 'refresh');
    	}
    
    	$user = $this->ion_auth->user()->row();
    
    	if ($this->form_validation->run() == false) {
    		// display the form
    		// set the flash data error message if there is one
    		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
    
    		$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
    		$this->data['old_password'] = array(
    				'name' => 'old',
    				'id' => 'old',
    				'type' => 'password'
    		);
    		$this->data['new_password'] = array(
    				'name' => 'new',
    				'id' => 'new',
    				'type' => 'password',
    				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$'
    		);
    		$this->data['new_password_confirm'] = array(
    				'name' => 'new_confirm',
    				'id' => 'new_confirm',
    				'type' => 'password',
    				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$'
    		);
    		$this->data['user_id'] = array(
    				'name' => 'user_id',
    				'id' => 'user_id',
    				'type' => 'hidden',
    				'value' => $user->id
    		);
    
    		// render
    		$this->_render_page('auth/change_password', $this->data);
    	} else {
    		$identity = $this->session->userdata('identity');
    
    		$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
    
    		if ($change) {
    			// if the password was successfully changed
    			$this->session->set_flashdata('message', $this->ion_auth->messages());
    			$this->logout();
    		} else {
    			$this->session->set_flashdata('message', $this->ion_auth->errors());
    			redirect('auth/change_password', 'refresh');
    		}
    	}
    }
    
    /**
     * reset password - final step for forgotten password
     * 
     * @param string $code
     */
    public function reset_password($code = NULL)
    {
    	if (! $code) {
    		show_404();
    	}
    
    	$user = $this->ion_auth->forgotten_password_check($code);
    	
    	if ($user) {
    		// if the code is valid then display the password reset form
    
    		$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
    		$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');
    
    		if ($this->form_validation->run() == false) {
    			// display the form
    
    			// set the flash data error message if there is one
    			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
    
    			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
    			$this->data['new_password'] = array(
    					'name' => 'new',
    					'id' => 'new',
    					'type' => 'password',
    					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$'
    			);
    			$this->data['new_password_confirm'] = array(
    					'name' => 'new_confirm',
    					'id' => 'new_confirm',
    					'type' => 'password',
    					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$'
    			);
    			$this->data['user_id'] = array(
    					'name' => 'user_id',
    					'id' => 'user_id',
    					'type' => 'hidden',
    					'value' => $user->id
    			);
    			$this->data['csrf'] = $this->_get_csrf_nonce();
    			$this->data['code'] = $code;
    
    			// render
    			$this->_render_page('driver/reset_password', $this->data);
    		} else {
    			// do we have a valid request?
    			if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {
    
    				// something fishy might be up
    				$this->ion_auth->clear_forgotten_password_code($code);
    
    				show_error($this->lang->line('error_csrf'));
    			} else {
    				// finally change the password
    				$identity = $user->{$this->config->item('identity', 'ion_auth')};
    
    				$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
    
    				if ($change) {
    					// if the password was successfully changed
    					$this->session->set_flashdata('message', $this->ion_auth->messages());
    					redirect("login", 'refresh');
    				} else {
    					$this->session->set_flashdata('message', $this->ion_auth->errors());
    					redirect('reset_password/' . $code, 'refresh');
    				}
    			}
    		}
    	} else {
    		// if the code is invalid then send them back to the forgot password page
    		$this->session->set_flashdata('message', $this->ion_auth->errors());
    		redirect("forgot_password", 'refresh');
    	}
    }
    
    // create a new user
    function create_user()
    {
    	$this->data['title'] = "Create User";
    
    	$tables = $this->config->item('tables', 'ion_auth');
    
    	// validate form input
    	$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
    	$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
    	$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
    	$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
    	$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
    	$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
    
    	if ($this->form_validation->run() == true) {
    		$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
    		$email = strtolower($this->input->post('email'));
    		$password = $this->input->post('password');
    
    		$additional_data = array(
    				'first_name' => $this->input->post('first_name'),
    				'last_name' => $this->input->post('last_name'),
    				'phone' => $this->input->post('phone')
    		);
    	}
    	if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data)) {
    		// check to see if we are creating the user
    		// redirect them back to the admin page
    		$this->session->set_flashdata('message', $this->ion_auth->messages());
    		redirect("login", 'refresh');
    	} else {
    		// display the create user form
    		// set the flash data error message if there is one
    		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->messages_array() ? $this->ion_auth->messages_array() : $this->session->flashdata('message')));

    		$this->data['first_name'] = array(
    				'name' => 'first_name',
    				'id' => 'first_name',
    				'type' => 'text',
    				'value' => $this->form_validation->set_value('first_name')
    		);
    		$this->data['last_name'] = array(
    				'name' => 'last_name',
    				'id' => 'last_name',
    				'type' => 'text',
    				'value' => $this->form_validation->set_value('last_name')
    		);
    		$this->data['email'] = array(
    				'name' => 'email',
    				'id' => 'email',
    				'type' => 'text',
    				'value' => $this->form_validation->set_value('email')
    		);
    		$this->data['phone'] = array(
    				'name' => 'phone',
    				'id' => 'phone',
    				'type' => 'text',
    				'value' => $this->form_validation->set_value('phone')
    		);
    		$this->data['password'] = array(
    				'name' => 'password',
    				'id' => 'password',
    				'type' => 'password',
    				'value' => $this->form_validation->set_value('password')
    		);
    		$this->data['password_confirm'] = array(
    				'name' => 'password_confirm',
    				'id' => 'password_confirm',
    				'type' => 'password',
    				'value' => $this->form_validation->set_value('password_confirm')
    		);
    
    		$this->auth_middle = 'driver/register'; // passing middle to function. change this for different views.
    		$this->auth_layout();
    		
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
