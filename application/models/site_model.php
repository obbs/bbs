<?php
	class Site_model extends CI_Model{
		
		function getBookedRoomsDate($bookingDate,$startTime,$endTime){
			$query = "SELECT GROUP_CONCAT(roomId) AS bookedRooms FROM `room_booking` 
						WHERE bookingDate=? AND status IN(0,1)
						AND (
							('$startTime' >= startTime AND '$startTime' < endTime) 
							OR ('$endTime' > startTime AND '$endTime' <= endTime) 
							OR ('$startTime' < startTime AND '$endTime' > endTime)
						)";
			$execQuery = $this->db->query($query,array($bookingDate));
			$rtnArr = $execQuery->result_array();
			return $rtnArr;
		}
			
		function getSearchFreeRoom($bookingDate,$capacity,$type,$startTime,$endTime){
			$roomsTakenArr = $this->getBookedRoomsDate($bookingDate,$startTime,$endTime);
			$roomsTaken = $roomsTakenArr[0]['bookedRooms'];
			$cond=$orderBy= "";
			if(trim($roomsTaken != "")){ $cond .= 'AND rm.roomId NOT IN('.$roomsTaken.') '; }
			if($capacity != ""){ $cond .= 'AND rm.capacity > '.$capacity.' '; $orderBy .= 'ORDER BY rm.capacity ASC'; }
			if($type != -1){ $cond .= 'AND rm.type='.$type.' ';}
			$query = "SELECT rm.roomId AS roomId, rm.name AS name, rm.location AS location,
						rm.building AS building, rl.levelName AS level, rt.type AS type,
						rm.capacity AS capacity, rm.incharge AS incharge,ui.name AS inchargeName,rm.permission AS permission, rm.note AS note
						FROM `rooms` rm 
						LEFT JOIN `room_level` rl ON rl.levelId=rm.level
						LEFT JOIN `room_type` rt ON rt.typeId=rm.type 
						LEFT JOIN `user_info` ui ON rm.incharge=ui.userName  
						WHERE rm.status=1 AND rl.status=1 AND rt.status=1
						$cond $orderBy";
			$execQuery = $this->db->query($query);
			$rtnArr = $execQuery->result_array();
			return $rtnArr;
		}
		
		function getUserBookings($userId){
			$query = "SELECT rb.bookingId AS bookingId,rm.name AS roomName,rm.building AS building, 
						DATE_FORMAT(rb.bookingDate,'%d-%b-%y') AS bookingDate, DATE_FORMAT(rb.startTime,'%H:%i') AS startTime, 
						DATE_FORMAT(rb.endTime,'%H:%i') AS endTime, rb.status AS status, rb.purpose AS purpose
						FROM room_booking rb
						LEFT JOIN rooms rm ON rm.roomId=rb.roomId
						WHERE rb.userId=? AND rb.status NOT IN(-2)
						ORDER BY bookingId DESC";
			$execQuery = $this->db->query($query,array($userId));
			$rtnArr = $execQuery->result_array();
			return $rtnArr;
		}
		
		function cancelBooking($bookingId){
			$query = "UPDATE room_booking SET status=-1 WHERE bookingId=?";
			$this->db->query($query,array($bookingId));
		}
		
		function getRoomDetails($roomId){
			$query = "SELECT rm.roomId AS roomId, rm.name AS name, rm.location AS location,
						rm.building AS building, rl.levelName AS level, rt.type AS type,
						rm.capacity AS capacity, ui.name AS incharge,rm.permission AS permission, rm.note AS note
						FROM `rooms` rm 
						LEFT JOIN `room_level` rl ON rl.levelId=rm.level
						LEFT JOIN `room_type` rt ON rt.typeId=rm.type  
						LEFT JOIN `user_info` ui ON ui.userName=rm.incharge
						WHERE rm.roomId=?";
			$execQuery = $this->db->query($query, array($roomId));
			$rtnArr = $execQuery->result_array();
			return $rtnArr;
		}
		
		function getRoomPermission($roomId){
			$query = "SELECT rm.permission AS permission 
						FROM `rooms` rm  
						WHERE rm.roomId=?";
			$execQuery = $this->db->query($query, array($roomId));
			$rtnArr = $execQuery->result_array();
			return $rtnArr;
		}
		
		function insertBookingRow($userId,$roomId,$bookingDate,$startTime,$endTime,$status,$purpose,$approvedBy,$initiatedOn,$bookedOn){
			$query = "INSERT INTO room_booking(userId,roomId,bookingDate,startTime,endTime,status,purpose,approvedBy,initiatedOn,bookedOn) 
						VALUES(?,?,?,?,?,?,?,?,?,?)";
			$this->db->query($query, array($userId,$roomId,$bookingDate,$startTime,$endTime,$status,$purpose,$approvedBy,$initiatedOn,$bookedOn));
			$bookingId = mysql_insert_id();
			return $bookingId;
		}
		
		function requestAsAdmin($userId,$tab){
			$rtnArr = array();
			$cond='';
			if($tab==1){$cond = 'rm.incharge=?';}
			else if($tab==2){$cond = 'rb.userId=?';}
			else{
				return $rtnArr;
			}
			$query = "SELECT rb.bookingId AS bookingId,rb.userId AS clientId,ui.name AS clientName, 
						rb.roomId AS roomId, rm.name AS roomName, rm.building AS building, 
						rb.bookingDate AS bookingDate, rb.startTime AS startTime, rb.endTime AS endTime, rb.status AS status,
						rb.purpose AS purpose, rm.incharge AS incharge
						FROM room_booking rb
						LEFT JOIN rooms rm ON rm.roomId=rb.roomId
						LEFT JOIN user_info ui ON ui.userName=rb.userId
						WHERE rb.status=0 AND $cond ORDER BY rb.bookingId DESC";
			$execQuery = $this->db->query($query, array($userId));
			$rtnArr = $execQuery->result_array();
			return $rtnArr;
		}
		
		function getInchargeName($roomId){
			$query = "SELECT ui.name AS incharge FROM user_info ui
						LEFT JOIN rooms rm ON rm.incharge=ui.userName WHERE rm.roomId=?";
			$execQuery = $this->db->query($query, array($roomId));
			$rtnArr = $execQuery->result_array();
			return $rtnArr;
		}
		
	}
?>





