<?php

class User extends CI_Controller {
  
  public function User() {
    
    parent::__construct();
  }
  
  public function index() {
    // if posted with a username, validate login or generate error message
    if (isset($_POST['username'])) {
      
      $this->load->model('MUser', '', TRUE);
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      if ($this->MUser->authenticate_user($username, $password, $uid, $groups) ) {
	$this->session->set_userdata('uid', $uid);
	$this->session->set_userdata('groups', $groups);
	redirect('/', 'refresh');
      } else {
	$data['error_message'] = '<p>Incorrect Username and / or Password</p>';
      }
    }
    
    // if not posted (or a authentication error), simply load the form
    
    $this->load->helper('form');
    
    // display information for the view
    $data['title'] = "Classroom: User Login";
    $data['headline'] = "User Login";
    $data['include'] = 'user_login';
    $data['uid'] = $this->session->userdata('uid');
    $data['groups'] = $this->session->userdata('groups');
    
    $this->load->view('template', $data);
  }

  public function register() {
    // if posted with a username, validate login or generate error message
    if (isset($_POST['username'])) {
      $this->load->model('MUser', '', TRUE);
      $username = $this->input->post('username');
      $password = $this->input->post('password');
	
      $this->load->library('form_validation');
      
      $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
      $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
	
      $has_error = FALSE;
      $data['error_message'] = NULL;
      if ($this->MUser->username_exists($username)) {
	$has_error = TRUE;
	$data['error_message'] .= '<p>That Username is already taken. Please choose another.</p>';
      }
      if ($this->form_validation->run() == FALSE) {
	$has_error = TRUE;
	$data['error_message'] .= validation_errors();
      }
      if ( ! $has_error) {
	$this->MUser->add_user($username, $password, $uid);
	$this->session->set_userdata('uid', $uid);
	
	$data['success_message'] = '<p>Congratulations! Your registration was successful.</p>';
	$data['register_success'] = TRUE;
	$data['username'] = $username;
	$data['password'] = $password;
      }
    }
    
    // if not posted (or a authentication error), simply load the form
    
    $this->load->helper('form');
    
    // display information for the view
    $data['title'] = "Classroom: User Registration";
    $data['headline'] = "User Registration";
    $data['include'] = 'user_register';
    $data['uid'] = $this->session->userdata('uid');
    
    $this->load->view('template', $data);
  }
  
  public function logout() {
    $this->session->sess_destroy();
    redirect('/', 'refresh');
  }
  
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */