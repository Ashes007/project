<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_basic extends CI_Model
{
	var $settingstable = 'ts_sitesettings';
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	public function isRecordExist($tableName = '', $condition = '', $idField = '', $idValue = ''){
		
		$cnt = 0;
		if($condition == '') $condition = 1;
		
		$sql = "SELECT COUNT(*) as CNT FROM ".$tableName." WHERE ".$condition."";
		
		if($idValue > 0 && $idValue <> '')
		{
			$sql .=" AND ".$idField." <> '".$idValue."'";
		}
		
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$rec = $rs->row();
		$cnt = $rec->CNT;

		return $cnt;
	}
	public function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL) {
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;

		if($key)$params["$key !="] = $value;
		while ($t->db->where($params)->get($table)->num_rows()) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			$params [$field] = $slug;
		}
		return $slug;
	}
	
	
	public function getValues_conditions($TableName, $FieldNames='', $AliasFieldName = '', $Condition='', $OrderBy='', $OrderType='', $Limit=0) {
	    if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    
	    if($FieldNames && is_array($FieldNames))
		$select = implode(",", $FieldNames);
	    
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition;
		
	    if($OrderBy != '') {
		$sql .= " ORDER BY ".$OrderBy." ".$OrderType;
	    }
	    if($Limit > 0 ) {
		$sql .= " LIMIT 0, $Limit";
	    }
	    
	    $rec = FALSE;
	    $rs = $this->db->query($sql);
	    if($rs->num_rows()) {
			    $rec = $rs->result_array();
	    }else{
		$rec = FALSE;
	    }
		
	    return $rec;
	}	

    
    	
	public function get_settings( $id = '' ){
		$sql = "SELECT id, sitesettings_name, sitesettings_value FROM ".$this->settingstable." WHERE id in (".$id.") ";
		//echo $sql; exit;
		$query = $this->db->query($sql);
		$rec = false;
		if ($query->num_rows() > 0){
		    foreach ($query->result_array() as $row){
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];
		    }
		    //pr($rec);
		    return $rec;
		}
		return false;
 	}
	
	
	public function deleteData($table, $where) {
		$sql	= "DELETE FROM ".$table." WHERE ".$where;
		//echo $sql;exit();
		$rec 	= $this->db->query($sql);
		return $rec;
	}


	public function insertIntoTable($tableName,$insertArr)
	{
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if($insertArr && is_array($insertArr))
		{
			$this->db->insert($tableName, $insertArr);
			$ret = $this->db->insert_id(); 
		}
		
		return $ret;
	}
	
	public function updateIntoTable($tableName, $idArr, $updateArr)
	{
		
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		if( $updateArr && is_array($updateArr) )
		{
			$this->db->update($tableName, $updateArr, $idArr);
			//echo $this->db->last_query(); die;
			$ret = $this->db->affected_rows();
			
		}
		//echo $this->db->last_query();
		return $ret;
	}
	
	public function recordUpdate($tableName,$data = array(),$condition){
		$fields = "";
		if(is_array($data) && count($data) > 0){
			foreach($data as $k => $v){
				$fields	.= $k . ' = "' . $v . '", ';
			}
			$fields		= substr($fields, 0, strlen($fields)-2);
			
		}
		
		$sql = "UPDATE " .$tableName.  " SET ". $fields." WHERE ".$condition ;
	
		//echo $sql; die();
		$rec = false;
		if($this->db->query($sql))
		{
			$rec = true;
		}
		
		return $rec;
	}
	
	public function changeStatus($tableName, $pagearray, $setfieldName, $fieldStatus, $updateFieldName)
	{ 
		$error		= false;		
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($pagearray)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){			
			$sql = "UPDATE ".$tableName."
				SET ".$setfieldName." = '".$fieldStatus."'
				WHERE FIND_IN_SET(".$updateFieldName.", '".implode(",", $pagearray)."')";
			$this->db->query($sql);
		}
		if($fieldStatus == 'active') {
			return 'inactive';	
		} else {
			return 'active';	
		}
	}

	public function getSingle($tableName, $whereCondition=''){
		if(is_array($whereCondition)){
			$this->db->where($whereCondition);
			$query = $this->db->get($tableName);
		}
		elseif($whereCondition <> '')
		{
			$where = " WHERE ".$whereCondition;
			$sql = "SELECT * FROM ".$tableName." ".$where." ";
			$query = $this->db->query($sql);
		}
		
		//echo $this->db->last_query(); exit();
		if($query->num_rows()){
		    $rec = $query->row_array();
		    return $rec;			
		}
		return false;
	}
	
	public function getName($tableName, $fieldName, $whereCondition=''){
		if(is_array($whereCondition)){
			$this->db->where($whereCondition);
			$query = $this->db->get($tableName);
		}
		else
		{
			$whereCondition = array('id'=>$whereCondition);
		}
		
		$this->db->where($whereCondition);
				
		$query = $this->db->get($tableName);
		if($query->num_rows()){
		    $rec = $query->row();
		    return $rec->$fieldName;			
		}
		
	}
	
	public function dataSearch($searchFieldArr,$databaseFieldArr,$sessionName)
	{
		$sessionArr	= $this->session->userdata($sessionName);
		//pr($sessionArr);
		$condition = ' 1 ';
		foreach($searchFieldArr as $sf)
		{
			$data[$sf] = '';			
		}
		
		if($this->input->post('search_action') == 'Process')
		{
			for($i=0;$i<count($searchFieldArr);$i++)
			{
				$search_key = $this->input->post($searchFieldArr[$i]);
				if($search_key != ''){
					//$condition .= " AND ".$databaseFieldArr[$i]."= ".$search_key;
					$condition .= " AND FIND_IN_SET(".$search_key.",".$databaseFieldArr[$i].")";
				}
				$searchArr[$searchFieldArr[$i]] = $search_key;
				$this->session->set_userdata($sessionName, $searchArr);
				$data[$searchFieldArr[$i]] = $search_key;
				$sessionArr[$searchFieldArr[$i]] = $search_key;
			}
			
		}
		else
		{
			
			for($i=0;$i<count($searchFieldArr);$i++)
			{
				if($sessionArr[$searchFieldArr[$i]] != '')
				{
					//$condition .= " AND ".$databaseFieldArr[$i]." = ".$sessionArr[$searchFieldArr[$i]];
					$condition .= " AND FIND_IN_SET(".$sessionArr[$searchFieldArr[$i]].",".$databaseFieldArr[$i].")";
					$data[$searchFieldArr[$i]] = $sessionArr[$searchFieldArr[$i]];
				}
			}
			
			
		}
		$return_arr['condition']= $condition;
		$return_arr['data']= $data;
		
		return $return_arr;
		
	}
	
	public function checkNamePairExists($tableName,$name,$fieldName,$id){
		if($id > 0){
			$this->db->where($fieldName,$name);
			
			$this->db->where('id <> ',$id);
		}else{			
			$this->db->where($fieldName,$name);
		}
		
		$query = $this->db->get($tableName);
		//echo $this->db->last_query();exit();
		if ($query->num_rows() > 0){
		    return false;
		}else{
		    return true;
		}
	}

	public function getCategoryName($id)
	{
		$name = $this->getName('ts_category','category_name',$id);		
		return  $name;
	}

	public function getParentCategory($id)
	{
		$parent = $this->getSingle('ts_category','id='.$id);	
		$parentId = $parent['parent_id'];
		$parent = array();
		$parent['name'] = $this->getCategoryName($parentId);
		$parent['id'] 	= $parentId;
		return  $parent;
	}

	public function getParentCategoryId($id)
	{
		$parent = $this->getSingle('ts_category','id='.$id);	
		$parentId = $parent['parent_id'];
		return  $parentId;
	}

	public function getParentCategoryName($id)
	{
		$parent = $this->getSingle('ts_category','id='.$id);	
		$parentId = $parent['parent_id'];
		$name = $this->getCategoryName($parentId);
		return  $name;
	}

	public function getAttributeName($id)
	{

		$name = $this->getName('ts_attribute','attribute_name',$id);		
		return  $name;
	}
	
	
}