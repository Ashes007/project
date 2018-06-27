<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_adminuser');
		$this->load->model('model_basic');
	}

	public function index()
	{
		$this->chk_not_login();
		$this->load->view('login');
	}

	public function do_login()
	{
		$email		=  trim( $this->input->get_post('email') );
		$password	=  trim( $this->input->get_post('password') );	
		$arrUser 	= $this->model_adminuser->getSingle($email, $password);
		if(count($arrUser) > 0)
		{
			redirect(BACKEND_URL."dashboard");
		}
                else
		{
			$this->session->set_userdata('msg', 'Invalid email id or password');
			redirect(BACKEND_URL);
                }
	}

	public function forgotpassword()
	{
		$this->chk_not_login();
		
		$data['msg'] = $this->session->userdata('msg');
		$this->session->set_userdata('msg', '');
		$this->load->view('forgotpassword',$data);
		
	}
        
        public function do_forgotpassword()
        {
	    $this->chk_not_login();	
            $this->load->library('email');
            $email = $this->input->get_post('email');
            
            	if(isset($email) && !empty($email))
		{
			$arrUser 	= $this->model_adminuser->getUserByEmail($email);
			if(count($arrUser) > 0){
				$name 		= $arrUser[0]['name'];	
				$password 	= $arrUser[0]['password'];					
				$settings 	= $this->model_basic->get_settings('1');				
                                
				$to		= $arrUser[0]['email'];
				///$to 		= 'nasmin.begam12@gmail.com';
				
				$from		= $settings['webmaster_email'];
				$from_name	= 'TechSpecs';
				
				$subject	= "Password Recovery at ".BACKEND_URL;
				$ConfigMail['message'] = '<html><body>';
                                $ConfigMail['message'].= 'Hello '.$name;
                                $ConfigMail['message'].= '</br>';
                                $ConfigMail['message'].= '<p> Please note down your password for admin panel : '.$password.'</p>';
                                $ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p>Thanks, </p>';
                                $ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p>Team '.$settings['sitename'].'</p>';
                                $ConfigMail['message'].= '</br>';
                                $ConfigMail['message'].= '<a href="'.BACKEND_URL.'">'.BACKEND_URL.'</a>';
                                $ConfigMail['message'].= '</body></html>';	
				$mail 		= send_email($to,$from,$from_name,$subject,$ConfigMail['message']);
				if($mail)	
				{	
					$msg = 'Password sent to your mail address. Please check.';	
				}
			}else{
				$msg = stripslashes($email) . ' was not found in our database';
			}
		}
		else
		{
			$msg = 'Please enter mail address';			
		}
		
		$this->session->set_userdata('msg', $msg);
		redirect(BACKEND_URL.'login/forgotpassword');
		return true;   
        }

	public function logout()
	{
		session_destroy();
		redirect(BACKEND_URL);
	}
}
