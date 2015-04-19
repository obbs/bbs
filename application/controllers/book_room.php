<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Book_room extends CI_Controller{
			
		function __construct(){
			parent::__construct();
			$this->common->checkLoggedIn();
			$this->load->model('site_model');
		}
		
		function index(){
			$this->common->sys_setSession('page','bookRoom');
			$this->common->com_header();
			$this->load->view('bookRoom');
			$this->common->com_footer();
		}
		
		function wizardHeader(){
			$requestType = $this->common->sys_checkRequestType();
			$data['step'] = trim($requestType['step']);
			$this->load->view('wizardHeader',$data);
		}
		
		function wizardBody(){
			$requestType = $this->common->sys_checkRequestType();
			$data['step'] = trim($requestType['step']);
			$data['roomId'] = trim($requestType['roomId']);
			$data['bookingDate'] = trim($requestType['bookingDate']);
			$data['startTime'] = trim($requestType['startTime']);
			$data['duration'] = trim($requestType['duration']);
			$data['bookingId'] = trim($requestType['bookingId']);
			if($data['roomId']!=0){
				$roomDetailsArr = $this->site_model->getRoomDetails($data['roomId']);
				if(count($roomDetailsArr)>0){
					$data['roomDetails'] = $roomDetailsArr[0];
				}
			}
			$this->load->view('wizardBody',$data);
		}
		
		function submitBooking(){
			$response = array();
			$userId = $this->common->sys_getSession('userId');
			$requestType = $this->common->sys_checkRequestType();
			$roomId = trim($requestType['roomId']);
			$bookingDate = trim($requestType['bookingDate']);
			$startTime = trim($requestType['startTime']);
			$duration = trim($requestType['duration']);
			$purpose = trim($requestType['purpose']);
			
			$bookingDate = date('Y-m-d',strtotime($bookingDate));
			$startTime = date('H:i:s',strtotime($startTime));
			$hour = floor($duration);
			$min = round(60*($duration - $hour));
			$endTime = date('H:i:s',strtotime($startTime . "+$hour hours +$min minutes"));
			
			$roomPermissionArr = $this->site_model->getRoomPermission($roomId);
			$permission = $roomPermissionArr[0]['permission'];
			$status=0;
			$approvedBy = 'admin';
			$initiatedOn=$bookedOn=date('Y-m-d H:i:s');
			if($permission==0){
				$status=1;
			}else{
				$bookedOn='0000-00-00 00:00:00';
				$approvedBy='';
			}
			$bookingId = $this->site_model->insertBookingRow($userId,$roomId,$bookingDate,$startTime,$endTime,$status,$purpose,$approvedBy,$initiatedOn,$bookedOn);
			$response['status']=1;
			$response['bookingId']=$bookingId;
			echo json_encode($response);
		}
		
	}
	
?>
