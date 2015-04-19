<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Logout extends CI_Controller{
		function __construst(){
			parent::__construct();
		}
		function index(){
			$userId = $this->common->sys_getSession('userId');
			//$loginLogId = $this->common->sys_getSession('loginLogId');
			//$this->load->model('login_model');
			//$this->login_model->setLogoutLogs($userId,$loginLogId);	
			if($this->common->sys_getSession('userId')){
				$this->common->sys_unsetSession();
			}
			redirect(base_url());
		}
	}
?>