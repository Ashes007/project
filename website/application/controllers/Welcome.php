<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_basic');

		$this->table = TABLE_PREFIX.'post';
		$this->sitesettingTable = TABLE_PREFIX.'sitesettings';
		

	}

	public function index()
	{

		$data = array();
		//$data['parent_category'] =  $this->Model_basic->getValues_conditions($this->categoryTable,'','',"parent_id = 0 and status = 'Active' LIMIT 5");

		$data['sitesetting'] =  $this->Model_basic->getSingle($this->sitesettingTable,"id = '2' ");
		//echo $data['sitesetting']['sitesettings_value'];
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->elements['middle']='home';			
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('welcome_message');
	}

	public function createpost()
	{

		$data = array();

		$data['sitesetting'] =  $this->Model_basic->getSingle($this->sitesettingTable,"id = '2' ");
		//echo $data['sitesetting']['sitesettings_value'];


		if($this->input->post('action') == 'Process')
		{
		
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('price', 'price', 'trim|required');
			$this->form_validation->set_rules('location', 'location', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required');
				
			
			if ($this->form_validation->run() == TRUE)
			{
				//echo "aaa"; die();
				$title = $this->input->post('title');
				$description = $this->input->post('description');				
				$price = $this->input->post('price');
				$location = $this->input->post('location');
				$email = $this->input->post('email');

				
					$image_name = '';
					if ($_FILES['image_name']['name'] != "" && $_FILES['image_name']['tmp_name'] != "" )
					{
						$upload_arr['field_name']			= 'image_name';
						$upload_arr['file_upload_path'] 	= FILE_UPLOAD_ABSOLUTE_PATH.'post/';
						$upload_arr['max_size']				= '';
						$upload_arr['max_width']			= '';
						$upload_arr['max_height']			= '';
						$upload_arr['allowed_types']			= '*';
						$upload_arr_thumb['thumb_create']		= true;
						$upload_arr_thumb['thumb_file_upload_path']	= 'thumb/';
						$upload_arr_thumb['thumb_width']		= '250';	
						$upload_arr_thumb['thumb_height']		= '250';
						$image_name 					= multiple_image_upload($upload_arr, $upload_arr_thumb);
					}

					$insArr['title'] 		= $title;
					$insArr['description'] 	= addslashes($description);
					$insArr['price'] 		= $price;
					$insArr['location'] 	= $location;
					$insArr['email'] 		= $email;
					$insArr['image_name'] 	= $image_name[0];
					$insArr['created_at']	= date('Y-m-d H:i:s');				
					
					$this->Model_basic->insertIntoTable($this->table,$insArr);

					$this->session->set_userdata('succmsg' , 'Record Added Successfully');
					//redirect($this->controller_url);
							
			}
				
		}
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->elements['middle']='createpost';			
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('welcome_message');
	}


}
