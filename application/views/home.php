<link href="<?php echo base_url(); ?>kit/css/homeStyle.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>kit/css/bookStyle.css" rel="stylesheet" type="text/css"/>
<div class="row">
	<div class="container">
		<div class="col-md-12" id="homeMainGrid">
			
			<div class="row">
				<div class="col-md-7 no-padding-LR leftgrid">
					<?php $this->load->view('bookingView'); ?>

					<div id="req_body">
						<div class="div-cont">
							<strong class="section-heading">Booking Requests</strong>
							<div class="no-record-grid" style="padding: 50px 5px;">No Requests for Bookings</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-5 home-sidebar">
					<div class="div-cont sidebar-search-form">
						<strong class="section-heading">Search Room</strong>
						<div class="home-search-form">
							<form>
								<div class="row">
									<div class="col-md-12 no-padding-LR">
										<label>Booking Date (*)</label>
										<input type="text" placeholder="dd-mm-yy" id="homeSearch-bookingDate" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 no-padding-LR hm-frm-left bootstrap-timepicker">
										<label>Booking Start Time (*)</label>
										<input type="text" placeholder="hour:minutes" id="homeSearch-bookingStartTime"/>
									</div>
									<div class="col-md-6 no-padding-LR hm-frm-right">
										<label>Duration (*)</label>
										<select id="homeSearch-bookingDuration">
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
									<div class="col-xs-4 no-padding-LR hm-frm-left">
										<label>Capacity</label>
										<input type="text" placeholder="e.g. 20, etc." id="homeSearch-bookingCapacity"/>
									</div>
									<div class="col-xs-8 no-padding-LR hm-frm-right">
										<label>Room Type</label>
										<select id="homeSearch-bookingType">
											<option value="-1">Any</option>
											<option value="1">Lecture Room</option>
											<option value="2">Practical Lab</option>
											<option value="3">Meeting Rooms</option>
											<option value="4">Computer Rooms</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-ms-12">
										<button type="button" class="btn btn-primary btn-sm" onclick="searchRoomHome(1);">
											Search Room
										</button>&nbsp;&nbsp;
										<span class="no-err" id="homeSearchRoom-Err"></span>
									</div>
								</div>
							</form>
						</div>
					</div>
					
					<div id="workbench"></div>
				</div>
				
			</div>
			
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var roleId = '<?php echo $this->common->sys_getSession('roleId'); ?>';
		if(roleId!=3){
			requestAdminBar();
		}
		displayRequestBody(2);
	});
</script>
<?php include ('kit/scripts/pluginScript_js.php'); ?> <!--Plugin Script-->
