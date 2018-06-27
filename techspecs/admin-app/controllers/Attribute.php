<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attribute extends MY_Controller {

	public function __construct()
	{
	 	parent::__construct();
		$this->chk_login();
		$this->load->model('Model_basic');
		$this->table 		= TABLE_PREFIX.'attribute';
		$this->categorytable= TABLE_PREFIX.'category';
		$this->controller 	= 'Attribute';
		$this->viewFolder 	= 'attribute';
		$this->controller_url = BACKEND_URL.'attribute/';
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
		$data['parent_attribute'] =  $this->Model_basic->getValues_conditions($this->table,'','','parent_id=0');
		$data['parent_category'] =  $this->Model_basic->getValues_conditions($this->categorytable,'','','parent_id=0');
		if($this->input->post('action') == 'Process')
		{
			//$this->form_validation->set_rules('category_id', 'Category', 'trim|required');
			//$this->form_validation->set_rules('attribute_name', 'Attribute Name', 'trim|required');
					
			
			//if ($this->form_validation->run() == TRUE)
			//{
				//echo "aaa"; die();
				$view_type = $this->input->post('view_type');
				$parent_attribute = $this->input->post('parent_attribute');
				$attribute_name = $this->input->post('attribute_name');
				$attribute_value = $this->input->post('attribute_value');	
				$attribute_details = $this->input->post('attribute_details');			
				$status = $this->input->post('status');
				
				$isExists = $this->Model_basic->isRecordExist($this->table,"parent_id = '".$parent_attribute."' AND attribute_name = '".$attribute_name."'");
				 if($isExists>0 && $attribute_name !='')
				{
					$this->session->set_userdata('errmsg' , 'Record already exists');
				}
				else
				{
					
					$insArr['view_type'] = $view_type;
					$insArr['parent_id'] = $parent_attribute;
					$insArr['attribute_name'] = addslashes($attribute_name);
					$insArr['attribute_value'] = addslashes($attribute_value);
					$insArr['attribute_details'] = addslashes($attribute_details);
					$insArr['created_at ']= date('Y-m-d H:i:s');				
					
					$this->Model_basic->insertIntoTable($this->table,$insArr);
					
					$this->session->set_userdata('succmsg' , 'Record Added Successfully');
					redirect($this->controller_url);
				}
			
			//}
				
		}
		
		$data['return_url'] = $this->controller_url;
		$this->basic('add',$data);
		
	}
	
	public function edit()
	{
		
		$data = array();
		$id = $this->uri->segment(3,0);

		$data['info'] = $this->Model_basic->getSingle($this->table,'id='.$id);
		$data['parent_attribute'] =  $this->Model_basic->getValues_conditions($this->table,'','','parent_id=0 AND id !='.$id);
		$data['parent_category'] =  $this->Model_basic->getValues_conditions($this->categorytable,'','','parent_id=0');
		
		if($this->input->post('action') == 'Process')
		{				
			//$this->form_validation->set_rules('category_id', 'Category', 'trim|required');
			//$this->form_validation->set_rules('attribute_name', 'Attribute Name', 'trim|required');
		
				
			//if ($this->form_validation->run() == TRUE)
			//{

				$view_type = $this->input->post('view_type');
				$parent_attribute = $this->input->post('parent_attribute');
				$attribute_name = $this->input->post('attribute_name');
				$attribute_value = $this->input->post('attribute_value');
				$attribute_details = $this->input->post('attribute_details');

				$isExists = $this->Model_basic->isRecordExist($this->table," parent_id = '".$parent_attribute."' AND attribute_name = '".$attribute_name."' AND id !=".$id);

				if($isExists>0 && $attribute_name !='')
				{
					$this->session->set_userdata('errmsg' , 'Record already exists');
				}
				else
				{
					
					$insArr['view_type'] = $view_type;
					$insArr['parent_id'] = $parent_attribute;
					$insArr['attribute_name'] = addslashes($attribute_name);
					$insArr['attribute_value'] = addslashes($attribute_value);
					$insArr['attribute_details'] = addslashes($attribute_details);		
					
					$condition = "id = ".$id;
					$this->Model_basic->recordUpdate($this->table,$insArr,$condition);					
					$this->session->set_userdata('succmsg' , 'Record Updated Successfully');

					redirect($this->controller_url);
				}
			//}
			
				
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

    
    
		public function ajax_attribute()
		{
			$cat_id = $this->input->post('cat_id');
			$attribute_list =  $this->Model_basic->getValues_conditions($this->table,'','',"category_id = ".$cat_id." and parent_id = 0 ");
			$select = '<option value="">--Select--</option>';

			if(count($attribute_list) > 0)
			{
				foreach ($attribute_list as $key => $attribute) {
					$select .= '<option value="'.$attribute['id'].'">'.$attribute['attribute_name'].'</option>';
				}
			}
			echo $select;
		}
	
}

//ALTER TABLE `ts_attribute` ADD `view_type` ENUM('Normal','Color','Box Type','Double Column') NOT NULL DEFAULT 'Normal' AFTER `attribute_details`;