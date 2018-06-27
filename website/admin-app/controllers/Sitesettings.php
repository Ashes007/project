<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitesettings extends MY_Controller {

	var $table 			= 'ts_sitesettings';
	var $controller 	= 'Sitesettings';
	var $viewFolder 	= 'sitesettings';
	
	
	public function __construct()
	{
	 	parent::__construct();
		$this->chk_login();
		$this->load->model('Model_basic');
		$this->controller_url = BACKEND_URL.'sitesettings/';
	}
	
	public function basic($page,$data='',$brdArr = '')
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
		$page = $this->uri->segment(3,0);
		$config['base_url'] 			= $this->controller_url."index/";
		$config['per_page'] 			= 15;
		$config['uri_segment']  		= 3;
		$config['num_links'] 			= 20;
		$config['page_query_string'] 		= false;
		$config['extra_params'] 		= "";

		$this->pagination->setAdminPaginationStyle($config);
		$config['total_rows'] = $this->Model_basic->isRecordExist($this->table);
		$this->pagination->initialize($config);
		
		$start = 0;		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
			
		$end 			= $config['per_page'];
		$data['start'] 		= $start;
		$data['list'] 		= $this->Model_basic->getValues_conditions($this->table,'*',''," 1 LIMIT ".$start.",".$end);
		
		if($page > 0)
			$data['edit_link'] 	= $this->controller_url."edit/{ID}/".$page;
		else
			$data['edit_link'] 	= $this->controller_url."edit/{ID}";
		
		$brdArr[] = array('link'=>BACKEND_URL,'title'=>'Home','right'=>'true');
		$brdArr[] = array('link'=>BACKEND_URL.'sitesettings','title'=>'Sitesettings','right'=>'true');
		$brdArr[] = array('link'=>'javascript:void(0);','title'=>'List','right'=>'');
		
		$this->basic('list',$data,$brdArr);
	}
	public function edit()
	{
	
		$data 		= array();
		$id 		= $this->uri->segment(3,0);
		$page 		= $this->uri->segment(4,0);
		$data['info'] 	= $this->Model_basic->getSingle($this->table,'id='.$id);
		
		if($this->input->post('action') == 'Process')
		{

			if (isset($_FILES['image_name']['name']) &&  $_FILES['image_name']['name'] != "" && $_FILES['image_name']['tmp_name'] != "" )
					{
					
					
						$file  		= FILE_UPLOAD_ABSOLUTE_PATH.'sitesettings/'.$data['info']['sitesettings_value'];
						$tmp_file 	= FILE_UPLOAD_ABSOLUTE_PATH.'sitesettings/thumb/'.$data['info']['sitesettings_value'];
					
						 if (file_exists($file)) {
							unlink($file);	
							unlink($tmp_file);						
						  } 
					
						$upload_arr['field_name']			= 'image_name';
						$upload_arr['file_upload_path'] 		= FILE_UPLOAD_ABSOLUTE_PATH.'sitesettings/';
						$upload_arr['max_size']				= '';
						$upload_arr['max_width']			= '';
						$upload_arr['max_height']			= '';
						$upload_arr['allowed_types']			= '*';
						$upload_arr_thumb['thumb_create']		= true;
						$upload_arr_thumb['thumb_file_upload_path']	= 'thumb/';
						$upload_arr_thumb['thumb_width']		= '200';	
						$upload_arr_thumb['thumb_height']		= '150';	
						
						$image_name 					= image_upload($upload_arr, $upload_arr_thumb);			
						
						$insArr['sitesettings_value'] 		= addslashes($image_name);		
					} else {
					
					$this->form_validation->set_rules('sitesettings_value', 'Sitesettings Value', 'trim|required');
					
							$sitesettings_value 			= $this->input->post('sitesettings_value');	
							$insArr['sitesettings_value'] 		= addslashes($sitesettings_value);
					}
					$condition = "id = ".$id;
					$this->Model_basic->recordUpdate($this->table,$insArr,$condition);
					
					$this->session->set_userdata('succmsg' , 'Record Updated Successfully');
					if($page>0)
					{
						$url = $this->controller_url."index/".$page;
					}
					else{
						$url = $this->controller_url;
					}
					
					redirect($url);
				}	
			
		//}
		if($page>0)
		{
			$url = $this->controller_url."index/".$page;
		}
		else{
			$url = $this->controller_url;
		}
		$data['return_url'] = $url;
		$brdArr[] = array('link'=>BACKEND_URL,'title'=>'Home','right'=>'true');
		$brdArr[] = array('link'=>BACKEND_URL.'sitesettings','title'=>'Sitesettings','right'=>'true');
		$brdArr[] = array('link'=>'javascript:void(0);','title'=>'Edit','right'=>'');
		
		$this->basic('edit',$data,$brdArr);
	}
}