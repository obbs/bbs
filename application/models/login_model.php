<?php
	class Login_model extends CI_Model{
		
		function validateUser($userName,$password){
			$query = 'SELECT ul.userName AS userId, ul.roleId AS roleId, 
						uin.name AS name, uin.emailId AS emailId
						FROM `user_login` ul 
						LEFT JOIN `roles` rl ON rl.roleId=ul.roleId
						LEFT JOIN `user_info` uin ON uin.userName=ul.userName 
						WHERE ul.userName=? AND ul.password=? AND ul.status=1 AND rl.status=1';
			$rtnArr = $this->db->query($query,array($userName,$password));
			return $rtnArr->result_array();
		}
		
		
		function setLoginLogs($userId,$agent,$platform,$ipAddress,$type){
			$query = "INSERT INTO `login_logs`(userId,logInTime,type,status,browser,operatingSystem,ipAddress) VALUES(?,now(),?,1,?,?,?)";
			$this->db->query($query, array($userId,$type,$agent,$platform,$ipAddress));
			$loginLogId = mysql_insert_id();
			return $loginLogId;
		}
		
		function setLogoutLogs($userId,$loginLogId){
			$query = "UPDATE `login_logs` SET logOutTime=now(),status=0 WHERE userId=? AND loginId=?";
			$this->db->query($query, array($userId,$loginLogId));	
		} 
		
	}
?>