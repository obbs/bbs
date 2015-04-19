<?php if($step==1){ ?>
<div class="row no-padding-LR">
	<div class="col-md-12 no-padding-LR">
		<div class="wiz-body div-cont" id="wizMainGrid">
			 
			 <div class="wiz_div" >
				<strong class="section-heading">Search Room</strong>
				<div class="wiz-inner-container wiz_search_form">
					<form>
						<div class="row">
							<div class="col-md-4 no-padding-LR">
								<label>Booking Date</label>
								<input type="text" class="form-control" placeholder="dd-mm-yy" id="homeSearch-bookingDate" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 no-padding-LR bootstrap-timepicker">
								<label>Booking Start Time</label>
								<input type="text" class="form-control" placeholder="hour:minutes" id="homeSearch-bookingStartTime"/>
							</div>
							<div class="col-md-4 no-padding-LR">
								<label>Duration</label>
								<select id="homeSearch-bookingDuration" class="form-control">
									<?php
										$temp='';
										$i=1;
										while($i<=6){
											$hrLabel='hours';
											if($i==1){$hrLabel='hour';}
											$temp .= '<option value="'.$i.'">'.number_format($i,1).' '.$hrLabel.'</option>';
											$i = $i+0.5;
										}
										echo $temp;
									?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 no-padding-LR">
								<label>Capacity</label>
								<input type="text" class="form-control" placeholder="e.g. 20, etc." id="homeSearch-bookingCapacity"/>
							</div>
							<div class="col-md-4 no-padding-LR">
								<label>Room Type</label>
								<select id="homeSearch-bookingType" class="form-control">
									<option value="-1">Any</option>
									<option value="1">Lecture Room</option>
									<option value="2">Practical Lab</option>
									<option value="3">Meeting Rooms</option>
									<option value="4">Computer Rooms</option>
								</select>
							</div>
						</div>
						<div style="padding: 5px 0px;">&nbsp;</div>
						<div class="row">
							<div class="col-ms-12">
								<button type="button" class="btn btn-success btn-sm" onclick="searchRoomHome(2);">
									Search Room <i class="icon-chevron-right"></i>
								</button>&nbsp;&nbsp;
								<span class="no-err" id="homeSearchRoom-Err"></span>
							</div>
						</div>
					</form>
				</div>
			</div>
			 
		</div>
	</div>
</div>
<?php }else if($step==2){ ?>
<div class="row no-padding-LR">
	<div class="col-md-12 no-padding-LR">
		
		<div class="wiz-body div-cont">
			<div class="wiz_div">
				<div class="row">
					<div class="col-md-6">
						<strong class="section-heading">Details Searched</strong>
						<div class="wiz-inner-container">
							<form class="step-2-form">
							<div class="row">
								<div class="col-xs-4"><label>Room : </label></div>
								<?php $roomName = $roomDetails['name'].' - '.$roomDetails['building'].' Building'; ?>
								<div class="col-xs-8">
									<input type="text" class="form-control" value="<?php echo $roomName; ?>"/>
									<input type="hidden" id="wiz_s2_roomId" value="<?php echo $roomId; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-4"><label>Booking Date: </label></div>
								<div class="col-xs-8"><input type="text" id="wiz_s2_bookingDate" class="form-control" value="<?php echo $bookingDate; ?>"/></div>
							</div>
							<div class="row">
								<div class="col-xs-4"><label>Booking Time : </label></div>
								<div class="col-xs-8"><input type="text" id="wiz_s2_startTime" class="form-control" value="<?php echo $startTime; ?>"/></div>
							</div>
							<div class="row">
								<div class="col-xs-4"><label>Duration : </label></div>
								<div class="col-xs-8">
									<input type="text" id="wiz_s2_duration" value="<?php echo $duration; ?>" class="form-control duration-field" /> hour
								</div>
							</div>
							<div class="row">
								<div class="col-xs-4"><label>Purpose : </label></div>
								<div class="col-xs-8"><textarea class="form-control" id="wiz_s2_purPose" placeholder="Enter Booking Purpose (Optional)"></textarea></div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<strong class="section-heading">Room Info</strong>
						<div>
							<div class="row">
								<div class="col-xs-12">
									<div class="wiz-inner-container wiz_book_info">
										<?php 
											$incharge = trim($roomDetails['incharge']);
											$note = trim($roomDetails['note']);
											if($incharge=="" || $incharge==null || $incharge=='Null'){ $incharge = '--'; }
											if($note=="" || $note==null){ $note = '--'; }
										?>
										<p><strong>Location: </strong><span><?php echo $roomDetails['location']; ?></span></p>
										<p><strong>Room Level: </strong><span><?php echo $roomDetails['level']; ?></span></p>
										<p><strong>Room Type: </strong><span><?php echo $roomDetails['type']; ?></span></p>
										<p><strong>Room Capacity: </strong><span><?php echo $roomDetails['capacity']; ?></span></p>
										<p><strong>Incharge: </strong><span><?php echo $incharge; ?></span></p>
										<p><strong>Additional Info: </strong><span><?php echo $note; ?></span></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr class="wiz_divider">
			<div class="wiz_div">
				<div class="row wiz_action_row">
					<div class="col-md-6">
						<p class="wiz_strip_info">
							<strong>NOTE: </strong>
							<span>
								<?php
									$roomInfo = '';
									$btnLabel = 'BOOK NOW';
									if($roomDetails['permission']==0){
										$roomInfo = $roomName.' is available for booking, <br/>Click BOOK NOW to book the room.';
									}else{
										$roomInfo = $roomName.' require permission for booking, <br/>Click SEND REQUEST to send booking request to the persons resposnible (incharge).';
										$btnLabel = 'SEND REQUEST';
									}
									echo $roomInfo;	
								?>
							</span>
						</p>
					</div>
					<div class="col-md-6" style="text-align: right;">
						<span class="no-err"></span>
						&nbsp;&nbsp;&nbsp;
						<a type="button" href="<?php echo base_url(); ?>index.php/book_room/" class="btn btn-sm btn-grey"><i class="icon-chevron-left"></i> Back to Search Rooms</a>
						<button type="button" onclick="submitBooking();" class="btn btn-sm btn-success"><?php echo $btnLabel; ?> <i class="icon-chevron-right"></i></button>
					</div>
				</div>
			</div>
			</form>
		</div>
		
	</div>
</div>
<?php }else if($step==3){ ?>
<div class="row no-padding-LR">
	<div class="col-md-12 no-padding-LR">
		
		<div class="wiz-body div-cont">
			<div class="wiz_div">
				<?php $this->load->view('bookingReciept'); ?>
			</div>
		</div>
		
	</div>
</div>
<?php }else{} ?>
<script type="text/javascript">
	$(document).ready(function () { 
	     $('.wiz-inner-container .step-2-form input').attr('disabled','disabled');
	     $('.wiz-inner-container .step-2-form select').attr('disabled','disabled');
	});
</script>

<?php include ('kit/scripts/pluginScript_js.php'); ?> <!--Plugin Script-->


