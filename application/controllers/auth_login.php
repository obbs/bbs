<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class auth_login extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this -> load -> model('login_model');
		}

		function index() {
			$requestType = $this->common->sys_checkRequestType();
			$userName = trim($requestType['userName']);
			$password = trim($requestType['userPassword']);
			
			$rememberMe = 0;
			if(isset($requestType['userRememberMe'])){
				$rememberMe = trim($requestType['userRememberMe']);
			}
			
			if($userName=="" || $password==""){
				$data['cookie']['cookieUsername']=$data['cookie']['cookiePassword']=$data['cookie']['cookieRemember']='';
				$data['errors'] = "* Incomplete Login Details";
				$data['old_al_userName'] = $userName;
				$data['old_al_password'] = $password;
				$this->load->view('login', $data);
			}else{
				$password = md5($password);
				$rtnArr = $this->login_model->validateUser($userName,$password);
				$cnt = count($rtnArr);
				if($cnt<=0){
					$data['cookie']['cookieUsername']=$data['cookie']['cookiePassword']=$data['cookie']['cookieRemember']='';
					$data['errors'] = "* Invalid Login Details";
					$data['old_al_userName'] = $userName;
					$data['old_al_password'] = $password;
					$this->load->view('login', $data);
				}else{
					$this->common->sys_setSession('userId', $rtnArr[0]['userId']);
					$this->common->sys_setSession('name', $rtnArr[0]['name']);
					$this->common->sys_setSession('emailId', $rtnArr[0]['emailId']);
					$this->common->sys_setSession('roleId', $rtnArr[0]['roleId']);
					
					$cookieName="BBS_username";
					$cookiePass="BBS_password";
					$cookieRem="BBS_remember";
					if($rememberMe==1){
						setcookie($cookieName,$userName, strtotime( '+30 days' ), "/", $_SERVER['HTTP_HOST']);
						setcookie($cookiePass,$password, strtotime( '+30 days' ), "/", $_SERVER['HTTP_HOST']);
						setcookie($cookieRem,$rememberMe, strtotime( '+30 days' ), "/", $_SERVER['HTTP_HOST']);
					}else{
						setcookie($cookieName,"", strtotime( '+30 days' ), "/", $_SERVER['HTTP_HOST']);
						setcookie($cookiePass,"", strtotime( '+30 days' ), "/", $_SERVER['HTTP_HOST']);
						setcookie($cookieRem,"", strtotime( '+30 days' ), "/", $_SERVER['HTTP_HOST']);
					}
					
					/*
					$agent='';
					if($this->agent->is_browser()){ $agent = $this->agent->browser().' '.$this->agent->version(); }
					else if($this->agent->is_robot()){ $agent = $this->agent->robot(); }
					else if($this->agent->is_mobile()){ $agent = $this->agent->mobile(); }
					else{ $agent = 'Unidentified User Agent'; }
					$ipAddress=$_SERVER['REMOTE_ADDR'];
					$platform =  $this->agent->platform();
					
					$loginLogId = $this->login_model->setLoginLogs($rtnArr[0]['userId'],$agent,$platform,$ipAddress,1);
					$this->common->sys_setSession('loginLogId', $loginLogId);
					 *
					 */
					redirect(base_url().'index.php/home');
				}
			}
			
		}

	}

?>
