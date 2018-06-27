<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {

	public function __construct()
	{
	 	parent::__construct();
		$this->chk_login();
		$this->load->model('Model_basic');
		$this->table 		= TABLE_PREFIX.'category';
		$this->controller 	= 'Category';
		$this->viewFolder 	= 'category';
		$this->controller_url = BACKEND_URL.'category/';
	}
	
	public function basic($page,$data='')
	{
		$data['succmsg'] = $this->session->userdata('succmsg');
		$data['errmsg'] = $this->session->userdata('errmsg');
		$this->session->set_userdata('succmsg','');
		$this->session->set_userdata('errmsg','');
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']= $this->viewFolder.'/'.$page;	
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function index()
	{
		$data = array();
	
		$data['data_list'] =  $this->Model_basic->getValues_conditions($this->table);
		$data['add_link'] = $this->controller_url."add/";
		$data['edit_link'] = $this->controller_url."edit/{ID}/";
		$data['delete_link'] = $this->controller_url."delete/{ID}/";
		$data['status_link'] = $this->controller_url."change_status";
		
		
		$this->basic('list',$data);
	}
	
	public function add()
	{
		$data = array();
		$data['parent_category'] =  $this->Model_basic->getValues_conditions($this->table,'','','parent_id=0');
		
		if($this->input->post('action') == 'Process')
		{
		
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
				
			
			if ($this->form_validation->run() == TRUE)
			{
				//echo "aaa"; die();
				$parent_category = $this->input->post('parent_category');
				$category_name = $this->input->post('category_name');				
				$status = $this->input->post('status');

				$parentCheck = '';
				if($parent_category != '')
				{
					$parentCheck = " AND parent_id=".$parent_category;
				}
				
				$isExists = $this->Model_basic->isRecordExist($this->table,"category_name = '".$category_name."' ".$parentCheck);
				if($isExists>0)
				{
					$this->session->set_userdata('errmsg' , 'Record already exists');
				}
				else
				{
					$slug = $this->Model_basic->create_unique_slug($category_name,$this->table);
					$image_name = '';
					if ($_FILES['image_name']['name'] != "" && $_FILES['image_name']['tmp_name'] != "" )
					{
						$upload_arr['field_name']			= 'image_name';
						$upload_arr['file_upload_path'] 	= FILE_UPLOAD_ABSOLUTE_PATH.'category/';
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

					$insArr['parent_id'] 		= $parent_category;
					$insArr['category_name'] 	= addslashes($category_name);
					$insArr['slug'] 			= addslashes($slug);
					$insArr['status'] 			= $status;
					$insArr['image_name'] 		= $image_name[0];
					$insArr['added_date']		= date('Y-m-d H:i:s');				
					
					$this->Model_basic->insertIntoTable($this->table,$insArr);

					

					
					$this->session->set_userdata('succmsg' , 'Record Added Successfully');
					redirect($this->controller_url);
				}
			
			}
				
		}

		
		$data['return_url'] = $this->controller_url;
		$this->basic('add',$data);
		
	}
	
	public function edit()
	{
	
		$data = array();
		$id = $this->uri->segment(3,0);
		$data['info'] = $this->Model_basic->getSingle($this->table,'id='.$id);
		$data['parent_category'] =  $this->Model_basic->getValues_conditions($this->table,'','','parent_id=0 and id !='.$id);
		
		if($this->input->post('action') == 'Process')
		{
				
		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
				
			if ($this->form_validation->run() == TRUE)
			{

			$parent_category = $this->input->post('parent_category');
			$parentCheck = '';
			if($parent_category != '')
			{
				$parentCheck = "AND parent_id=".$parent_category;
			}
			$category_name = $this->input->post('category_name');				
			$status = $this->input->post('status');
			$isExists = $this->Model_basic->isRecordExist($this->table,"category_name = '".$category_name."' ".$parentCheck." AND id !=".$id);
				if($isExists>0)
				{
					$this->session->set_userdata('errmsg' , 'Record already exists');
				}
				else
				{
					$slug = $this->Model_basic->create_unique_slug($category_name,$this->table,'slug','id',$id);
					$insArr['parent_id'] = $parent_category;
					$insArr['category_name'] = addslashes($category_name);
					$insArr['slug'] = addslashes($slug);
					$insArr['status'] = $status;		
					
					if ($_FILES['image_name']['name'] != "" && $_FILES['image_name']['tmp_name'] != "" )
					{
						$upload_arr['field_name']			= 'image_name';
						$upload_arr['file_upload_path'] 	= FILE_UPLOAD_ABSOLUTE_PATH.'category/';
						$upload_arr['max_size']				= '';
						$upload_arr['max_width']			= '';
						$upload_arr['max_height']			= '';
						$upload_arr['allowed_types']			= '*';
						$upload_arr_thumb['thumb_create']		= true;
						$upload_arr_thumb['thumb_file_upload_path']	= 'thumb/';
						$upload_arr_thumb['thumb_width']	= '250';	
						$upload_arr_thumb['thumb_height']	= '250';
						$image_name 						= multiple_image_upload($upload_arr, $upload_arr_thumb);
						$insArr['image_name'] 				= $image_name[0];
					}

					$condition = "id = ".$id;
					$this->Model_basic->recordUpdate($this->table,$insArr,$condition);
					
					$this->session->set_userdata('succmsg' , 'Record Updated Successfully');
					redirect($this->controller_url);
				}
			}
			
				
		}
		$data['return_url'] = $this->controller_url;
		
		$this->basic('edit',$data);
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3,0);
		$condition = "id = ".$id." or parent_id=".$id;
		$this->Model_basic->deleteData($this->table,$condition);

		//echo $this->db->last_query(); die();
		
		$this->session->set_userdata('succmsg' , 'Record Deleted Successfully');
		
		$url = $this->controller_url;
		redirect($url); 
		
	}
	public function change_status(){
		$id 		= $this->input->post('id');
		$field_name	= 'status';
		$alias		= '';
		$condition	= "id = '".$id."'";
		$rec 		= $this->model_basic->getValues_conditions($this->table, '', $alias, $condition);
		if(is_array($rec) and count($rec)>0){
			$rec =$rec[0];
			$status = $rec['status'];
			$new_status ='';
			if($status=='Active'){
				$new_status = 'Inactive';
			}
			else if($status=='Inactive'){
				$new_status = 'Active';
			}
		   
			$updateArr  =  array('status' => $new_status);
			     
			$idArr      = array('id' => $id);
	     
			$ret   = $this->Model_basic->updateIntoTable($this->table,$idArr, $updateArr);
			
			echo $new_status;
	}
    }

	
}