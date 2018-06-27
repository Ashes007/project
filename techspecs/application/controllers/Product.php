<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_basic');

		$this->productTable 			= TABLE_PREFIX.'product';
		$this->attribute_table 			= TABLE_PREFIX.'attribute';
		$this->productAttribute_table 	= TABLE_PREFIX.'product_attribute';
		$this->category_table 			= TABLE_PREFIX.'category';
	}

	public function index()
	{
		$data = array();
		$search = "";
		$searchKey = $this->input->get('s');
		$cat = $this->input->get('cat');
		$data['cat_id'] = '';
		$data['searchKey'] = "";
		$data['searchType'] = "";
		if($cat != '')
		{
			$cat_id = $this->Model_basic->getCategoryIdBySlug($cat);
			$search .= " AND parent_id = ".$cat_id;
			$data['cat_id'] = $cat_id;
			$data['searchType'] = $cat;
		}

		$brand = $this->input->get('brand');
		$data['brand_id'] = '';
		if($brand != '')
		{
			$brand_id = $this->Model_basic->getCategoryIdBySlug($brand);
			$search .= " AND category_id = ".$brand_id;
			$data['brand_id'] = $brand_id;
			$data['searchType'] = $brand;
		}

		if($searchKey)
		{
			$search .= " AND product_name LIKE '%".$searchKey."%' ";
			$insArr['search_key'] = $searchKey;
			$this->Model_basic->insertIntoTable('ts_search_key',$insArr);
			$data['searchKey'] = $searchKey;
		}
		
		$productList =  $this->Model_basic->getValues_conditions($this->productTable,'','',"status = 'Active' ".$search);

		$categoryList =  $this->Model_basic->getValues_conditions($this->category_table,'','',"status = 'Active' AND parent_id = 0 ");
		//pr($productList);
		$productArr = array();
		if(is_array($productList))
		{
			foreach ($productList as $key => $product) {
				$productArr[$product['parent_id']][$key]['product_id'] 		= $product['id'];
				$productArr[$product['parent_id']][$key]['product_name'] 	= $product['product_name'];
				$productArr[$product['parent_id']][$key]['slug'] 			= $product['slug'];
				$productArr[$product['parent_id']][$key]['product_code'] 	= $product['product_code'];
				$productArr[$product['parent_id']][$key]['description'] 	= $product['description'];
			}
		}
		$attrArr = array();
		
		$attribute_list = $this->Model_basic->getValues_conditions($this->attribute_table,'',''," parent_id = 0"); 		

		if(is_array($attribute_list))
		{
			foreach ($attribute_list as $key => $value) {
				$attrArr[$value['id']] = $this->Model_basic->getValues_conditions($this->attribute_table,'',''," parent_id = ".$value['id']);
			}
		}
		
		$data['attrArr'] = $attrArr;
		$data['productArr']  = $productArr;
		
		$data['category_list'] = $categoryList;
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->elements['middle']='product';			
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('welcome_message');
	}

	public function details($slug)
	{
		$data = array();
		$product_info = $this->Model_basic->getSingle($this->productTable,"slug='".$slug."'");

		if(!is_array($product_info))
		{
			echo "No record foud"; //die();
		}
		$data['product_images'] = $this->Model_basic->getValues_conditions('ts_product_image','','',"product_id=".$product_info['id']);
		$data['product_info'] = $product_info;
		$productList =  "SELECT A.* FROM ts_product_attribute AS PA LEFT JOIN ts_attribute AS A ON PA.attribute_id = A.id WHERE PA.product_id = ".$product_info['id'];
		$rs = $this->db->query($productList);
		$productAttribute = $rs->result_array();		
		$productArr = array();
		if(is_array($productAttribute))
		{
			foreach ($productAttribute as $key => $product) {
				$productArr[$product['parent_id']][$key]['id'] 		= $product['id'];
				$productArr[$product['parent_id']][$key]['attribute_name'] 	= $product['attribute_name'];
				$productArr[$product['parent_id']][$key]['attribute_value'] = $product['attribute_value'];
				$productArr[$product['parent_id']][$key]['attribute_details'] = $product['attribute_details'];
			
			}
		}
		$data['productArr']  = $productArr;
		$image_path_main = $this->Model_basic->getProductImage($product_info['id']);
		 
		$readMoreLink = FRONTEND_URL.'product/details/'.$product_info['slug'];
		$this->templatelayout->get_meta(stripslashes($product_info['product_name']),stripslashes($product_info['description']),$image_path_main,$readMoreLink);
		$data['readMoreLink'] = $readMoreLink;
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->elements['middle']='product_details';			
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('welcome_message');
	}

	public function ajax_product()
	{
		$searchKey = $this->input->post('search');
		$attrId = $this->input->post('attr_id');
		$catId = $this->input->post('cat_id');
		$brandId = $this->input->post('brand_id');
		$sort_by = $this->input->post('sort_by',"ASC");

		$search = " WHERE status = 'Active' ";

		if($catId != '')
		{
			$search .= "  AND parent_id = ".$catId." ";
		}
		if($brandId != '')
		{
			$search .= "  AND category_id = ".$brandId." ";
		}

		if(count($attrId) > 0)
		{
			$search .= " AND id in( SELECT DISTINCT(product_id) FROM `ts_product_attribute` WHERE `attribute_id` in (".implode(",",$attrId).")) ";
		}

		if($searchKey != '')
		{
			$search .= " AND product_name LIKE '%".$searchKey."%' ";
		}



		$sql = "SELECT * FROM ".$this->productTable.$search." ORDER BY product_name ".$sort_by;

		$qry = $this->db->query($sql);
		$productList = $qry->result_array();

		$productArr = array();
		if(is_array($productList))
		{
			foreach ($productList as $key => $product) {
				$productArr[$product['parent_id']][$key]['product_id'] 		= $product['id'];
				$productArr[$product['parent_id']][$key]['product_name'] 	= $product['product_name'];
				$productArr[$product['parent_id']][$key]['slug'] 			= $product['slug'];
				$productArr[$product['parent_id']][$key]['product_code'] 	= $product['product_code'];
				$productArr[$product['parent_id']][$key]['description'] 	= $product['description'];
			}
		}

		$data['productArr']  = $productArr;
		if(count($productList)>0){
		$this->load->view('ajax_product',$data);
		} else { 
			echo '<div class="no_product"> No Record Found</div>';

		} 


	}

	public function ajax_attribute()
	{
		$attrArr = array();
		$catId = $this->input->post('catId');
		$search = ' parent_id = 0 ';
		if($catId != '')
			$search .= " AND category_id = ".$catId;
		$attribute_list = $this->Model_basic->getValues_conditions($this->attribute_table,'','',$search); 		
		//pr($attribute_list);
		if(is_array($attribute_list))
		{
			foreach ($attribute_list as $key => $value) {
				$attrArr[$value['id']] = $this->Model_basic->getValues_conditions($this->attribute_table,'',''," parent_id = ".$value['id']);
			}
		}
		
		$data['attrArr'] = $attrArr;
		$this->load->view('ajax_attribute',$data);
	}

	public function autocomplete()
	{
		$search = $this->input->get('q');
		$sql = "SELECT product_name as name FROM ".$this->productTable." WHERE product_name LIKE '%".$search."%' LIMIT 10" ;
		$qry = $this->db->query($sql);
		$arr = $qry->result_array();
		// if(count($arr) == 0)
		// {
		// 	$arr[0]['id'] = $search;
		// 	$arr[0]['name'] = $search;
		// }
		pr($arr);
		$json_response = json_encode($arr);
		echo $json_response;
	}

	public function summery()
	{
		$data = array();

		$productList =  $this->Model_basic->getValues_conditions($this->productTable,'','',"status = 'Active'");

		$categoryList =  $this->Model_basic->getValues_conditions($this->category_table,'','',"status = 'Active' AND parent_id = 0 ");

		$sql = "SELECT * FROM ".$this->category_table." GROUP BY category_name HAVING status = 'Active' AND parent_id != 0";
		$rs = $this->db->query($sql);
		$brandList =  $rs->result_array();

		$data['product_list'] = $productList;
		$data['category_list'] = $categoryList;

		$data['brand_list'] = $brandList;
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->elements['middle']= 'product_summery';			
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}


}
