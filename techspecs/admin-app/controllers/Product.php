<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	
	
	
	public function __construct()
	{
	 	parent::__construct();
		$this->chk_login();
		$this->load->model('Model_basic');
		$this->table 			= TABLE_PREFIX.'product';
		$this->categoryTable 	= TABLE_PREFIX.'category';
		$this->images_table 	= TABLE_PREFIX.'product_image';
		$this->attribute_table 	= TABLE_PREFIX.'attribute';
		$this->productAttribute_table 	= TABLE_PREFIX.'product_attribute';
		$this->controller 	= 'Product';
		$this->viewFolder 	= 'product';
		$this->controller_url = BACKEND_URL.'product/';
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
		
		$data['data_list'] 		= $this->Model_basic->getValues_conditions($this->table);
		$data['add_link'] 		= $this->controller_url."add/";
		$data['edit_link'] 		= $this->controller_url."edit/{ID}/";
		$data['delete_link'] 	= $this->controller_url."delete/{ID}/";
		$data['status_link'] 	= $this->controller_url."change_status";
		$data['addimage_link'] 	= $this->controller_url."add_image/{ID}/";
		$data['attribute_link'] = $this->controller_url."add_attribute/{ID}/{CATID}";
		
		$attribute_list = $this->Model_basic->getValues_conditions($this->table);
		
		$this->basic('list',$data);
	}
	
	public function add()
	{
		$data = array();
		$data['parent_category'] =  $this->Model_basic->getValues_conditions($this->categoryTable,'','',"parent_id = 0 and status = 'Active' ");
		
		
		if($this->input->post('action') == 'Process')
		{
		
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
			$this->form_validation->set_rules('product_code', 'Product Code', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
				
			
			if ($this->form_validation->run() == TRUE)
			{
				//echo "aaa"; die();
				$parentCategory = $this->input->post('parent_category');
				$category = $this->input->post('category');
				$product_name = $this->input->post('product_name');	
				$product_code = $this->input->post('product_code');	
				$product_description = $this->input->post('description');			
				$status = $this->input->post('status');
				
					$slug = $this->Model_basic->create_unique_slug($product_name,$this->table);
					
					$insArr['category_id'] = $category;
					$insArr['parent_id'] = $parentCategory;
					$insArr['product_name'] = addslashes($product_name);
					$insArr['product_code'] = addslashes($product_code);
					$insArr['description'] = addslashes($product_description);
					$insArr['slug'] = addslashes($slug);
					$insArr['status'] = $status;
					$insArr['created_at']= date('Y-m-d H:i:s');				
					
					$this->Model_basic->insertIntoTable($this->table,$insArr);
					
					$this->session->set_userdata('succmsg' , 'Record Added Successfully');
					redirect($this->controller_url);		
			
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
		$data['parent_category'] =  $this->Model_basic->getValues_conditions($this->categoryTable,'','',"parent_id = 0 and status = 'Active' ");
		$data['category_list'] =  $this->Model_basic->getValues_conditions($this->categoryTable,'','',"parent_id = ".$data['info']['parent_id']." and status = 'Active' ");
		
		if($this->input->post('action') == 'Process')
		{
				
		$this->form_validation->set_rules('parent_category', 'Parent Category', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
				
			if ($this->form_validation->run() == TRUE)
			{

				

				$parentCategory = $this->input->post('parent_category');
				$category = $this->input->post('category');
				$product_name = $this->input->post('product_name');	
				$product_code = $this->input->post('product_code');	
				$product_description = $this->input->post('description');
				$is_featured = $this->input->post('is_featured');	

				$status = $this->input->post('status');

				$slug = $this->Model_basic->create_unique_slug($product_name,$this->table,'slug','id',$id);
			
					$insArr['category_id'] = $category;
					$insArr['parent_id'] = $parentCategory;
					$insArr['product_name'] = addslashes($product_name);
					$insArr['product_code'] = addslashes($product_code);
					$insArr['description'] = addslashes($product_description);
					$insArr['slug'] = addslashes($slug);
					$insArr['is_featured'] = $is_featured;
					$insArr['status'] = $status;		
					
					$condition = "id = ".$id;
					$this->Model_basic->recordUpdate($this->table,$insArr,$condition);
					
					$this->session->set_userdata('succmsg' , 'Record Updated Successfully');

					redirect($this->controller_url);
				
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

    public function add_image(){
		$data 			= array();
		$id 			= $this->uri->segment(3,0);
		$data['info'] 		= $this->Model_basic->getSingle($this->table,'id='.$id);
		$data['details'] 	= $this->Model_basic->getValues_conditions($this->images_table,"","",'product_id='.$id,'id','DESC');
		if($this->input->post('action') == 'Process')
		{

				$image_name  = '';
				if ($_FILES['image_name']['name'] != "" && $_FILES['image_name']['tmp_name'] != "" )
				{
					$upload_arr['field_name']			= 'image_name';
					$upload_arr['file_upload_path'] 		= FILE_UPLOAD_ABSOLUTE_PATH.'product/';
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
				//pr($image_name);
				if(is_array($image_name))
				{
					$condition = 'product_id='.$id;
					$check = $this->Model_basic->isRecordExist($this->images_table,$condition);
					foreach($image_name as $k=>$img)
					{
						if($check == 0 && $k == 0)
						{
							$insArr['is_featured'] = 'Yes';
						}
						else
						{
							$insArr['is_featured'] = 'No';
						}
						$insArr['image_name'] 		= $img;
						$insArr['product_id']		= $id;
						$insArr['created_at']		= date('Y-m-d H:i:s');
						$this->Model_basic->insertIntoTable($this->images_table,$insArr);
					}
				}
								
				
				$url = $this->controller_url."add_image/".$id;
				redirect($url);
			//}
		}
		

		$url = $this->controller_url;
		$data['return_url'] = $url;
		
		$data['return_url'] = $this->controller_url;
		$data['featured_link'] = $this->controller_url."is_featured";
		$this->basic('add_image',$data);
	}
	public function delete_image(){
		$id 		= $this->uri->segment(3,0);
		$product_id 	= $this->uri->segment(4,0);
		$page 		= $this->uri->segment(5,0);
		$condition 	= "id = ".$id;
		$info 		= $this->Model_basic->getSingle($this->images_table,$condition);
		
		if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'product/'.$info['image_name']) && $info['image_name'] != ''){
			unlink(FILE_UPLOAD_ABSOLUTE_PATH.'product/'.$info['image_name']);
		}
		if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'product/thumb/'.$info['image_name']) && $info['image_name'] != ''){
			unlink(FILE_UPLOAD_ABSOLUTE_PATH.'product/thumb/'.$info['image_name']);
		}
		$this->Model_basic->deleteData($this->images_table,$condition);
		
		
		$condition = 'product_id='.$product_id;
		$check = $this->Model_basic->isRecordExist($this->images_table,$condition);
		$imginfo = $this->Model_basic->getSingle($this->images_table,$condition);
		if($check > 0)
		{
			$updateArr['is_featured'] = 'Yes';			     
			$idArr      = array('id' => $imginfo['id']);		     
			$ret   = $this->Model_basic->updateIntoTable($this->images_table,$idArr, $updateArr);
		}
		
		
		$this->session->set_userdata('succmsg' , 'Record Deleted Successfully');
		if($page>0)
		{
			$url = $this->controller_url."add_image/".$product_id.'/'.$page;
		}
		else{
			$url = $this->controller_url."add_image/".$product_id;
		}
		redirect($url); 
	}
	public function is_featured(){
		$id 		= $this->input->post('id');
		$product_id 	= $this->input->post('article_id');
		
		$updateArr  	=  array('is_featured' => 'No');			
		$idArr      	= array('product_id' => $product_id);	
		$ret   		= $this->Model_basic->updateIntoTable($this->images_table,$idArr, $updateArr);
		
		$updateArr  	=  array('is_featured' => 'Yes');			
		$idArr      	= array('id' => $id);	
		$ret   		= $this->Model_basic->updateIntoTable($this->images_table,$idArr, $updateArr);
		
	}

	public function add_attribute()
	{
		$product_id = $this->uri->segment(3,0);
		$category_id = $this->uri->segment(4,0);

		$parentCatId = $this->Model_basic->getParentCategoryId($category_id);

		$data = array();
		$attrArr = array();
		//$attribute_list = $this->Model_basic->getValues_conditions($this->attribute_table,'','',"category_id=".$parentCatId." AND parent_id = 0"); 	
		$attribute_list = $this->Model_basic->getValues_conditions($this->attribute_table,'','',"parent_id = 0");	
		//pr($attribute_list);
		if(is_array($attribute_list))
		{
			foreach ($attribute_list as $key => $value) {
				$attrArr[$value['attribute_name']] = $this->Model_basic->getValues_conditions($this->attribute_table,'','',"parent_id = ".$value['id']);
			}
		}

		$productAttributeList = $this->Model_basic->getValues_conditions($this->productAttribute_table,'','',"product_id=".$product_id);
		$productAttributeArr = array();
		if(is_array($productAttributeList))
		{
			foreach ($productAttributeList as $key => $value) {
				$productAttributeArr[] = $value['attribute_id'];
			}
		}

		$data['attribute_list'] = $attrArr;
		$data['return_url'] = $this->controller_url;
		$data['productAttributeArr'] = $productAttributeArr;

		if($this->input->post('action') == 'Process')
		{
			$this->Model_basic->deleteData($this->productAttribute_table,"product_id=".$product_id);
			$attr_id = $this->input->post('attr_id');
			if(count($attr_id)>0)
			{
				$insArr = array();
				foreach ($attr_id as $key => $value) {
					$insArr['product_id'] = $product_id;
					$insArr['attribute_id']= $value;				
					
					$this->Model_basic->insertIntoTable($this->productAttribute_table,$insArr);
				}
			}

			$this->session->set_userdata('succmsg' , 'Attribute added Successfully');		
			$url = $this->controller_url;
			redirect($url);
		}

		$this->basic('attribute',$data);
	}

	public function ajax_category()
	{
		$cat_id = $this->input->post('cat_id');
		$category_list =  $this->Model_basic->getValues_conditions($this->categoryTable,'','',"parent_id = ".$cat_id." and status = 'Active' ");
		$select = '<option value="">--Select--</option>';

		if(count($category_list) > 0)
		{
			foreach ($category_list as $key => $category) {
				$select .= '<option value="'.$category['id'].'">'.$category['category_name'].'</option>';
			}
		}
		echo $select;
	}

	

	
}