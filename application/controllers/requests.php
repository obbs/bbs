<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Requests extends CI_Controller{
			
		function __construct(){
			parent::__construct();
			$this->common->checkLoggedIn();
			$this->load->model('site_model');
		}
		
		function index(){
			$this->common->sys_setSession('page','requests');
			
			$this->common->com_header();
			$this->load->view('requests');
			$this->common->com_footer();
		}
		
		function displayRequestBody(){
			$data = array();
			$userId = $this->common->sys_getSession('userId');
			$requestType = $this->common->sys_checkRequestType();
			$tab = trim($requestType['tab']);
			$reqArr = array();
			$reqArr = $this->site_model->requestAsAdmin($userId,$tab);
			$data = $this->rectifyArr($reqArr);
			echo json_encode($data);
		}
		
		function rectifyArr($arr){
			$finalArr = array();
			$i=0;
			$totalCount=0;
			foreach($arr as $row){
				$finalArr[$i] = $row;
				$statusBit = $this->common->checkDateStatus($row['bookingDate'],$row['startTime'],$row['endTime']);
				if($statusBit!=0){$finalArr[$i]['status']=$statusBit;}
				else{$totalCount++;}
				$finalArr[$i]['bookingDate']=date('d-M-y',strtotime($row['bookingDate']));
				$finalArr[$i]['bookingTime']=date('H:i',strtotime($row['startTime'])).' - '.date('H:i',strtotime($row['endTime']));
				if($row['purpose']==""){ $finalArr[$i]['purpose']='--';}
				$getInchargeName = $this->site_model->getInchargeName($row['roomId']);
				if(count($getInchargeName)>0){
					$finalArr[$i]['incharge']=$getInchargeName[0]['incharge'];
				}else{
					$finalArr[$i]['incharge']='--';
				}
				$i++;
			}
			$response['data'] = $finalArr;
			$response['totalCount']=$totalCount;
			return $response;
		}
		
	}
	
?>
