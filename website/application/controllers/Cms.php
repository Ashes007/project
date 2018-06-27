<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_basic');

		$this->cmsTable 	= TABLE_PREFIX.'cms';
	}

	public function basic($data)
	{				
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->elements['middle']='cms';			
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('welcome_message');
	}

	public function about_us()
	{
		$data['record'] =  $this->Model_basic->getSingle($this->cmsTable,"id = 1 ");
		$this->basic($data);
	}

	public function term()
	{
		$data['record'] =  $this->Model_basic->getSingle($this->cmsTable,"id = 2 ");
		$this->basic($data);
	}

	public function privecy_pocily()
	{
		$data['record'] =  $this->Model_basic->getSingle($this->cmsTable,"id = 3 ");
		$this->basic($data);
	}
	
	public function contact_us()
	{
		$data['record'] =  $this->Model_basic->getSingle($this->cmsTable,"id = 4 ");
		$this->basic($data);
	}



	

}
