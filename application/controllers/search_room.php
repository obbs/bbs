<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Search_room extends CI_Controller{
			
		function __construct(){
			parent::__construct();
			$this->common->checkLoggedIn();
			$this->load->model('site_model');
		}
		
		function index(){
			$this->common->sys_setSession('page','searchRoom');
			
			$this->common->com_header();
			$this->load->view('searchRoom');
			$this->common->com_footer();
		}
		
	}
	
?>
