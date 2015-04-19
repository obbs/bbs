<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class System_configuration_script extends CI_Controller{
			
		function __construct(){
			parent::__construct();
			$this -> load -> model('configure_model');
		}
		
		function index(){
			$this->common->sys_setSession('page','configure');
			
			$this->common->com_header();
			$this->load->view('configureScreen');
			$this->common->com_footer();
		}
		
		// function writeFile(){
			// $str='';
			// $no=1111111111;
			// for($i=1;$i<101;$i++){
				// $str .= 'student'.$i.',pass'.$i.',student'.$i.',student'.$i.'@brookes.ac.uk';
				// $str .= ','.$no.',1'.PHP_EOL;
				// $no++;
			// }
			// $filename = 'student_dummy_data.txt';
			// $file = fopen($filename,"w");
			// fwrite($file,$str);
			// fclose($file);
		// }
		
		function csUploadFile(){
			/*$studentFile = $_FILES['studentFile']['tmp_name'];
			$studentTempArray = file($studentFile);
			$staffFile = $_FILES['staffFile']['tmp_name'];
			$staffTempArray = file($staffFile);*/
			$roomFile = $_FILES['roomFile']['tmp_name'];
			$roomTempArray = file($roomFile);
			//$studentArray = $this->parseStudentRecord($studentTempArray);
			//$staffArray = $this->parseStaffRecord($staffTempArray);
			echo 'Processing<br/>';
			$roomArray = $this->parseRoomRecord($roomTempArray);
			
			if(count($roomArray)>0){
				$this->insertDB($roomArray,3);
			}
			echo 'Configuration Complete';
			echo '<pre>';
			echo 'Summary<br/>=====================================<br/>';
			//echo 'Files Uploaded: 2<br/>';
			//echo 'Student Records: '.count($studentArray).'<br/>';
			//echo 'Staff Records: '.count($staffArray).'<br/>';
			echo 'Room Records: '.count($roomArray).'<br/>';
			echo '=====================================<br/><br/>';
			//echo 'Records<br/>=====================================<br/>';
			//print_r($studentArray);
			//print_r($staffArray);
			//print_r($roomArray);
		}
		
		function parseStudentRecord($studentTempArray){
			$finalArray = array();
			$cc=0;
			foreach ($studentTempArray as $row => $newLine) {
				$flag=0;	
				$newLine = str_replace("\"", "", $newLine);
				$newLine = str_replace("\t", ",", $newLine);
				if(trim($newLine)!=""){
					$tmpArr = explode(",", $newLine);
					$finalArray[$cc]['studentNumber'] = trim($tmpArr[0]);
					$finalArray[$cc]['password'] = trim($tmpArr[1]);
					$finalArray[$cc]['name'] = trim($tmpArr[2]);
					$finalArray[$cc]['emailId'] = trim($tmpArr[3]);
					$finalArray[$cc]['contact'] = trim($tmpArr[4]);
					$finalArray[$cc]['status'] = trim($tmpArr[5]);
					$finalArray[$cc]['roleId'] = 3;
					$cc++;
				}
			}
			return $finalArray;
		}
		
		function parseStaffRecord($staffTempArray){
			$finalArray = array();
			$cc=0;
			foreach ($staffTempArray as $row => $newLine) {
				$flag=0;	
				$newLine = str_replace("\"", "", $newLine);
				$newLine = str_replace("\t", ",", $newLine);
				if(trim($newLine)!=""){
					$tmpArr = explode(",", $newLine);
					$finalArray[$cc]['staffNumber'] = trim($tmpArr[0]);
					$finalArray[$cc]['password'] = trim($tmpArr[1]);
					$finalArray[$cc]['name'] = trim($tmpArr[2]);
					$finalArray[$cc]['emailId'] = trim($tmpArr[3]);
					$finalArray[$cc]['contact'] = trim($tmpArr[4]);
					$finalArray[$cc]['department'] = trim($tmpArr[5]);
					$finalArray[$cc]['office'] = trim($tmpArr[6]);
					$finalArray[$cc]['status'] = trim($tmpArr[7]);
					$finalArray[$cc]['roleId'] = 2;
					$cc++;
				}
			}
			return $finalArray;
		}
		
		function parseRoomRecord($roomTempArray){
			$finalArray = array();
			$cc=0;
			foreach ($roomTempArray as $row => $newLine) {
				$flag=0;	
				$newLine = str_replace("\"", "", $newLine);
				$newLine = str_replace("\t", ",", $newLine);
				if(trim($newLine)!=""){
					$tmpArr = explode(",", $newLine);
					$finalArray[$cc]['name'] = trim($tmpArr[0]);
					$finalArray[$cc]['location'] = trim($tmpArr[2]);
					$finalArray[$cc]['building'] = trim($tmpArr[3]);
					$finalArray[$cc]['type'] = trim($tmpArr[4]);
					$finalArray[$cc]['level'] = trim($tmpArr[5]);
					$finalArray[$cc]['capacity'] = trim($tmpArr[6]);
					$finalArray[$cc]['incharge'] = trim($tmpArr[7]);
					$finalArray[$cc]['status'] = 1;
					$finalArray[$cc]['permissions'] = 0;
					$finalArray[$cc]['notes'] = trim($tmpArr[10]);;
					$cc++;
				}
			}
			return $finalArray;
		}
		
		function insertDB($roomArray,$type){
			if($type==3){
				$this->configure_model->configureInsertRoom($roomArray);
			}
		}
		
	}
?>