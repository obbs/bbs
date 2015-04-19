<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Bookings extends CI_Controller{
			
		function __construct(){
			parent::__construct();
			$this->common->checkLoggedIn();
			$this->load->model('site_model');
		}
		
		function index(){
			$this->common->sys_setSession('page','bookings');
			$userId = $this->common->sys_getSession('userId');
			$data['bookings'] = $this->site_model->getUserBookings($userId);
			$data['domain'] = 2;
			$this->common->com_header();
			$this->load->view('bookings',$data);
			$this->common->com_footer();
		}
		
		function cancelBooking(){
			$requestType = $this->common->sys_checkRequestType();
			$bookingId = trim($requestType['bookingId']);
			$this->site_model->cancelBooking($bookingId);
		}
		
	}
	
?>
