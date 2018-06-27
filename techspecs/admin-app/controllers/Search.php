<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {

	var $table 		= 'ts_search_key';
	var $controller 	= 'Search';
	var $viewFolder 	= 'search';
	
	
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
		$config['per_page'] 			= 2;
		$config['uri_segment']  		= 3;
		$config['num_links'] 			= 20;
		$config['page_query_string'] 	= false;
		$config['extra_params'] 		= "";
		

		$sql = "SELECT search_key,COUNT(*) as cnt FROM `ts_search_key` GROUP BY search_key ";
		$rs = $this->db->query($sql);

		$this->pagination->setAdminPaginationStyle($config);
		$config['total_rows'] = $rs->num_rows();
		$this->pagination->initialize($config);
		
		$start = 0;		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
			
		$end 			= $config['per_page'];

		//$sql .= " LIMIT ".$start.",".$end;
		$res = $this->db->query($sql);

		$data['start'] 		= $start;
		$data['list'] 		= $res->result_array();
		$data['edit_link'] 	= $this->controller_url."edit/{ID}";
		
		$this->basic('list',$data);
	}
		
	
	
}