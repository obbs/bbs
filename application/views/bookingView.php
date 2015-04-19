<div class="div-cont">
	<strong class="section-heading">
		<?php 
			$hTemp='';
			if($domain==1){
				$hTemp .= 'Recent Bookings'; 
				$hTemp .= '<span><a href="'.base_url().'index.php/bookings/">View All Bookings</a></span>';
			}else{
				$hTemp .= 'All Bookings'; 
			}
			echo $hTemp
		?>
	</strong>
	
	<?php if(count($bookings)==0){ ?>
		<div class="no-record-grid">No Recent Booking Found</div>
	<?php }else{ ?>
		<div class="table-grid">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Room</th>
						<th>Booking Date</th>
						<th>Booking Timing</th>
						<th>Status</th>
						<?php if($domain==2){ ?>
						<th>Purpose</th>
						<th>&nbsp;</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$temp=''; $cc=1;
						$nowDate = date('Y-m-d H:i:s');
						foreach($bookings as $row){
							if($row['status']!=0){
								$bookTime = $row['startTime'].' - '.$row['endTime'];
								$statusLabel=$axnBtn='--';
								$xtraTrClass='';
								$cancelBtn = '<button class="btn btn-xs" onclick="confirmBookingCancel('.$row['bookingId'].',\''.$row['roomName'].'\',\''.$row['bookingDate'].'\',\''.$bookTime.'\');" alt="Cancel Booking" title="Cancel Booking"><i class="icon-remove-sign"></i></button>';
								$editBtn = '<button class="btn btn-xs" onclick="underConstruction();" alt="Edit Booking" title="Edit Booking"><i class="icon-pencil"></i></button>';
								if($row['status']==-1){
									$statusLabel = '<span class="label label-inverse">Cancelled</span>';
									$xtraTrClass='deActivate';
								}else if($row['status']==1){
									$statusLabel = '<span class="label label-success">Booking Confirmed</span>';
									$axnBtn = $cancelBtn.' '.$editBtn;
								}else if($row['status']==0){
									$statusLabel = '<span class="label label-info">Request Pending</span>';
									$axnBtn = $cancelBtn;
								}else{
									$statusLabel='--';
								}
								if($row['purpose']==''){ $row['purpose']='--'; }
								
								$sDate = date('Y-m-d',strtotime($row['bookingDate'])).' '.date('H:i:s',strtotime($row['startTime']));
								$eDate = date('Y-m-d',strtotime($row['bookingDate'])).' '.date('H:i:s',strtotime($row['endTime']));
								$bMsg='--';
								
								if((strtotime($nowDate) < strtotime($sDate)) && (strtotime($nowDate) < strtotime($eDate))){
									if($row['status']==1){	
										$bMsg = $axnBtn;
									}
								}else if((strtotime($nowDate) > strtotime($sDate)) && (strtotime($nowDate) > strtotime($eDate))){
									if($row['status']!=-1 && $row['status']!=-3){
										if($row['status']==0){
											$statusLabel = '<span class="label label-danger">Request Expired</span>';
										}else{
											$statusLabel = '<span class="label label-warning">Booking Expired</span>';
										}
										$xtraTrClass='deActivate';
									}
								}else if((strtotime($nowDate) > strtotime($sDate)) && (strtotime($nowDate) < strtotime($eDate))){
									$statusLabel = '<span class="label label-notify">Booking In Use</span>';
									$xtraTrClass='acActivate';
									
								}else{
									$bMsg = '--';
								}
								
								
								$temp .= '<tr id="'.$row['bookingId'].'_bookingRow" class="'.$xtraTrClass.'">';
								$temp .= '<td>'.$cc.'</td>';
								$temp .= '<td>'.$row['roomName'].' - '.$row['building'].' Block</td>';
								$temp .= '<td>'.$row['bookingDate'].'</td>';
								$temp .= '<td>'.$bookTime.'</td>';
								$temp .= '<td class="status_cell">'.$statusLabel.'</td>';
								if($domain==2){
									$temp .= '<td>'.$row['purpose'].'</td>';
									$temp .= '<td class="booking-msg-tag">'.$bMsg.'</td>';
								}
								$temp .= '</tr>';
								$cc++;
								if($domain==1){
									if($cc>4){ break; }
								}
							}
						}
						echo $temp;
					?>
				</tbody>
			</table>
		</div>
	<?php } ?>
	
</div>