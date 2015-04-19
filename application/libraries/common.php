<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class CI_Common{
		
		function checkLoggedIn(){
			$CI =& get_instance();
			if(!$CI->common->sys_getSession('userId')){
				redirect(base_url());
				die;
			}
		}
		
		function sys_header(){
			$CI =& get_instance();
 			$CI->load->view('header');			
		}
		
		function com_header(){
			$CI =& get_instance();
			$CI->common->sys_header();
			$CI->load->view('header_menu');		
		}
		
		function sys_footer(){
			$CI =& get_instance();
			$CI->load->view('footer');
		}
		
		function com_footer(){
			$CI =& get_instance();
			$CI->load->view('footer_menu');		
			$CI->common->sys_footer();
		}
		
		function sys_setSession($key,$value){
			$_SESSION[SESS_PREFIX.$key]=$value;
		}
		
		function sys_getSession($key){
			if(isset($_SESSION[SESS_PREFIX.$key])){
				return $_SESSION[SESS_PREFIX.$key];
			}else{
				return FALSE;
			}
		}
		
		function sys_unsetSession(){
			$CI =& get_instance();
			$CI->common->sys_setSession('userId', '');
			//session_destroy();
		}
		
		function sys_checkRequestType(){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$requestType = $_POST;
			}else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
				$requestType = $_GET;
			}
			return $requestType;
		}
		
		function is_mob($mobileNo){
			$str=substr($mobileNo,0,1);
			if ((strlen($mobileNo)==10 || strlen($mobileNo)==11) && (ctype_digit($mobileNo))){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		function checkDateStatus($bookingDate,$startTime,$endTime){
			$statusBit=0;
			$nowDate = date('Y-m-d H:i:s');
			$sDate = date('Y-m-d',strtotime($bookingDate)).' '.date('H:i:s',strtotime($startTime));
			$eDate = date('Y-m-d',strtotime($bookingDate)).' '.date('H:i:s',strtotime($endTime));
			if((strtotime($nowDate) > strtotime($sDate)) && (strtotime($nowDate) > strtotime($eDate))){
				$statusBit = -1;
			}else if((strtotime($nowDate) > strtotime($sDate)) && (strtotime($nowDate) < strtotime($eDate))){
				$statusBit = 1;
			}else{
				$statusBit=0;
			}
			return $statusBit;	
		}
		
		function sendEmail($arr){
			$userEmail = 'sahildavid268@gmail.com';
			$sub = $arr['subject'];
			$data = $arr['details'];
			$key = $arr['key'];
			
			$CI =& get_instance();
			$CI->load->library('email');
			$config['charset'] = 'iso-8859-1';
			$config['mailtype'] = 'html';
			
			$CI->email->initialize($config);
			$CI->email->from('info@akgdriving.co.uk', 'AKG Admin');
			$CI->email->to($userEmail);
			$CI->email->subject($sub);
			$msg='';
			if($key==1){
				$msg=$CI->load->view('emails/addStudent',$data,TRUE);
			}
			$CI->email->message($msg);
			$CI->email->send();	
			//echo $CI->email->print_debugger();
		}
		
	}
?>