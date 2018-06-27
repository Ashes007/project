<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->chk_login();
		$this->data = '';
		$this->templatelayout->get_header();
		$brdArr[] = array('link'=>BACKEND_URL,'title'=>'Home','status'=>'Active','right'=>'true');
		//$this->templatelayout->get_breadcrump($brdArr);
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='dashboard/dashboard';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout/layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		//$this->load->view('dashboard/dashboard');
	}
}
