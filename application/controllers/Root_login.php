<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Root_login extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
	}

	public function auth()
	{
	    
        if($_POST['uname'] != null && $_POST['pass'] != null) {
        
            $email_exists = $this->model_auth->check_email($this->input->post('uname'));
    
           	if(!empty($email_exists)) {
           	    $login = $this->db->get_where('users', array('email' => $this->input->post('uname')))->row_array();
           	    // $login = $this->model_auth->login($this->input->post('uname'), $this->input->post('pass'));
           	    
           		if($this->input->post('pass') == $login['password']) {

           			$logged_in_sess = array(
           				'id' => $login['id'],
           				'role' => $login['role'],
    			        'username'  => $login['username'],
    			        'email'     => $login['email'],
    			        'login_account' => 'tiffinbox',
    			        'logged_in' => TRUE
    				);
    
    				$this->session->set_userdata($logged_in_sess);
           			redirect('dashboard', 'refresh');
           		} else {
           			header("Location:https://signin.business360.co.in?err=10");
           		}
           	} else {
           		header("Location:https://signin.business360.co.in?err=10");
           	}
           
        } else {
            header("Location:https://signin.business360.co.in?err=11");
        }
    	
	}

    public function auth_api()
    {
        $uname = $this->input->post('uname');
        $pass = $this->input->post('pass');
        
        $userdata = $this->db->get_where("users", array('email' => $uname, 'password' => $pass))->row_array();
        
        if(!empty($userdata)) {
            $res['status'] = 1;
            $res['message'] = 'success';
            $res['userdata'] = $userdata;
        } else {
            $res['status'] = 0;
            $res['message'] = 'no data found';
            $res['userdata'] = array();
        }
    
        echo json_encode($res);
    }



}
