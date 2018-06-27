<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_basic');

		$this->categoryTable = TABLE_PREFIX.'category';
		$this->sitesettingTable = TABLE_PREFIX.'sitesettings';
		

	}

	public function index()
	{
		$data = array();
		$data['parent_category'] =  $this->Model_basic->getValues_conditions($this->categoryTable,'','',"parent_id = 0 and status = 'Active' LIMIT 5");

		$data['sitesetting'] =  $this->Model_basic->getSingle($this->sitesettingTable,"id = '2' ");
		//echo $data['sitesetting']['sitesettings_value'];

		$this->templatelayout->get_header();
		$this->elements['middle']='home';			
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('welcome_message');
	}

	public function request_device()
	{
		$email 		= $this->input->post('email');
		$device 	= $this->input->post('device');
		$category 	= $this->input->post('category');

		$sitesetting =  $this->Model_basic->getSingle($this->sitesettingTable,"id = '1' ");
		$admin_email = $sitesetting['sitesettings_value'];

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.$admin_email.'>' . "\r\n";

		$subject = "Request Device";
		$message = "Category: ".$category." Device: ".$device;
		$user_message = "Thank you for your interest.";
		send_email($admin_email,$admin_email,"Tech Admin",$subject,$message);
		send_email($email,$admin_email,"Tech Admin",$subject,$user_message);
		
		//echo mail($email,$subject,$message,$headers);
		if($send)
		{
			echo "Mail Send Successfully.";
		}
		else
		{
			echo "Mail Not Send";
		}

	}

	public function ajax_alpha()
	{
		$alpha = $this->input->post('alpha');

		$data['category_list'] = $this->Model_basic->getValues_conditions('ts_category',array('id','slug','category_name'),''," status = 'Active' AND category_name LIKE '".$alpha."%'");

		if(is_array($data['category_list'])){
			
			$this->load->view('ajax_alpha',$data);
		}
		else
		{
			echo "<p class='no_msg'>No Record Found</p>";
		}
	}
}
