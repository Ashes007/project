<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {

	var $table 		= 'ts_cms';
	var $controller 	= 'Cms';
	var $viewFolder 	= 'cms';
	
	
	public function __construct()
	{
	 	parent::__construct();
		$this->chk_login();
		$this->load->model('Model_basic');
		$this->controller_url = BACKEND_URL.'cms/';
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
		$data 					= array();
		$page 					= $this->uri->segment(3,0);
		$config['base_url'] 			= $this->controller_url."index/";
		$config['per_page'] 			= 10;
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
		$data['edit_link'] 	= $this->controller_url."edit/{ID}";
		
		$this->basic('list',$data);
	}
		
	public function edit()
	{
	
		$data = array();
		$id = $this->uri->segment(3,0);
		$data['info'] = $this->Model_basic->getSingle($this->table,'id='.$id);
		
		if($this->input->post('action') == 'Process')
		{
			$this->form_validation->set_rules('cms_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('cms_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('cms_meta_title', 'Meta Title', 'trim|required');
			$this->form_validation->set_rules('cms_meta_key', 'Meta Keyword', 'trim|required');
			$this->form_validation->set_rules('cms_meta_desc', 'Meta Description', 'trim|required');
				
			if ($this->form_validation->run() == TRUE) 
			{
				$cms_title 			= trim(addslashes($this->input->post('cms_title')));
				$cms_slug			= $this->Model_basic->create_unique_slug($cms_title,$this->table,'slug','id',$id);
				$cms_content 			= trim(addslashes($this->input->post('cms_content')));
				$cms_meta_title 		= trim(addslashes($this->input->post('cms_meta_title')));
				$cms_meta_key 			= trim(addslashes($this->input->post('cms_meta_key')));
				$cms_meta_desc 			= trim(addslashes($this->input->post('cms_meta_desc')));
				
				$insArr['cms_title'] 			= $cms_title;
				$insArr['slug'] 				= $cms_slug;
				$insArr['cms_content'] 			= $cms_content;
				$insArr['cms_meta_title'] 		= $cms_meta_title;
				$insArr['cms_meta_key'] 		= $cms_meta_key;
				$insArr['cms_meta_desc'] 		= $cms_meta_desc;
				$condition = "id = ".$id;
				$this->Model_basic->recordUpdate($this->table,$insArr,$condition);
				
				$this->session->set_userdata('succmsg' , 'Record Updated Successfully');
				redirect($this->controller_url);
			}			
				
		}
		$data['return_url'] = $this->controller_url;		
		$this->basic('edit',$data);
	}
	
}