<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Login extends CI_Controller{
			
		function __construct(){
			parent::__construct();
			if($this->common->sys_getSession('userId')){
				redirect(base_url().'index.php/home');
			}
		}
		
		function index(){
			$this->load->view('login');
		}
		
		
	}
?>