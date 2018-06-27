<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of templatelayout
 */
class templatelayout {
     
     var $obj;
    
     public function __construct()
     {
        $this->obj =& get_instance();
     }

   
     public function get_header()
     {
       $this->obj->load->model('Model_basic');   
	  $this->header = array();
     
	  $this->obj->elements['header']='layout/header';
	  $this->obj->elements_data['header'] = $this->header;	  
     }
     
     
     public function get_breadcrump($brdArr = array())
     {
	  $this->breadcrump = array();
	  $this->breadcrump['breadcrump'] = $brdArr;
	  $this->obj->elements['breadcrump']='layout/breadcrump';
	  $this->obj->elements_data['breadcrump'] = $this->breadcrump;
     }
     
     public function get_leftmenu($active = '')
     {
	  $this->leftmenu = '';
	  $this->sidebar['active'] = $active;
	  $this->obj->elements['leftmenu']='layout/leftmenu';
	  $this->obj->elements_data['leftmenu'] = $this->leftmenu;
     }       
 
     
     public  function get_footer()
     {
	  $this->footer = '';
	  $this->obj->elements['footer']='layout/footer';
	  $this->obj->elements_data['footer'] = $this->footer;
     }

     public function get_meta($og_title = "", $og_desc = "", $og_image = "",$og_url='' )
     {
      $this->meta               = array();
  
      $this->meta['og_title']       = (($og_title != '')?$og_title:'Techspecs');
      $this->meta['og_desc']        = (($og_desc != '')?$og_desc:'Techspecs');
      $this->meta['og_image']       = (($og_image != '')?$og_image:'Techspecs');
      $this->meta['og_url']         = (($og_url != '')?$og_url:'Techspecs');
      $this->obj->elements['meta']      = 'layout/meta';
      $this->obj->elements_data['meta']     = $this->meta;    
     }
     
     
	
}
?>