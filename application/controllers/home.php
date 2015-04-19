<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Home extends CI_Controller{
			
		function __construct(){
			parent::__construct();
			$this->common->checkLoggedIn();
			$this->load->model('site_model');
		}
		
		function index(){
			$this->common->sys_setSession('page','home');
			$userId = $this->common->sys_getSession('userId');
			$data['bookings'] = $this->site_model->getUserBookings($userId);
			$data['domain'] = 1;
			$this->common->com_header();
			$this->load->view('home',$data);
			$this->common->com_footer();
		}
		
		function homeSearch(){
			$response = array();
			$requestType = $this->common->sys_checkRequestType();
			$bookingDate = trim($requestType['bookingDate']);
			if($bookingDate==""){
				$response['status']=-1;
				$response['msg']='Please Select Booking Date *';
			}else{
				$startTime = trim($requestType['startTime']);
				if($startTime==""){
					$response['status']=-1;
					$response['msg']='Please Select Booking Start Time *';
				}else{
					$nowTime = date('Y-m-d H:i:s');
					$bookingDate = date('Y-m-d',strtotime($bookingDate));
					$startTime = date('H:i:s',strtotime($startTime));
					$enterStartTime = $bookingDate.' '.$startTime;
					if(strtotime($nowTime) > strtotime($enterStartTime)){
						$response['status']=-1;
						$response['msg']='Invalid Time (Select Future Time)';
					}else{
						$duration = trim($requestType['duration']);
						$hour = floor($duration);
    					$min = round(60*($duration - $hour));
						$endTime = date('H:i:s',strtotime($startTime . "+$hour hours +$min minutes"));
						$capacity = trim($requestType['capacity']);
						$type = trim($requestType['type']);
						if($capacity != "" && !ctype_digit($capacity)){
							$response['status']=-1;
							$response['msg']='Invalid Capacity (Should be number)*';
						}else{
							$freeRoomArray = $this->site_model->getSearchFreeRoom($bookingDate,$capacity,$type,$startTime,$endTime);
							$response['status']=1;
							$response['msg']=$freeRoomArray;
						}
					}
				}
			}
			echo json_encode($response);
		}
		
		function test(){
			$pass = '123';
			echo md5($pass);
		}
		
	}
	
?>
