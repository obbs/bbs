<?php
	class Configure_model extends CI_Model{
		
		function configureInsertRoom($roomArray){
			foreach($roomArray as $row){
				$query = "INSERT INTO `rooms`(name,location,building,level,type,capacity,incharge,status,permission) 
							VALUES(?,?,?,?,?,?,?,?,?)";
				$this->db->query($query, array($row['name'],$row['location'],$row['building'],$row['level'],$row['type'],$row['capacity'],$row['incharge'],$row['status'],$row['permissions']));
			}
		}
		
	}
?>