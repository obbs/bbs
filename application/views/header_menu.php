<?php
	$home=$bookRoom=$searchRoom=$bookings=$requests=$configure="";
	$pageName = $this->common->sys_getSession('page');
	if($pageName=="home"){ $home="active-menu"; }
	if($pageName=="bookRoom"){ $bookRoom="active-menu"; }
	if($pageName=="searchRoom"){ $searchRoom="active-menu"; }
	if($pageName=="bookings"){ $bookings="active-menu"; }
	if($pageName=="requests"){ $requests="active-menu"; }
	if($pageName=="configure"){ $configure="active-menu"; }
	$roleId = $this->common->sys_getSession('roleId');
?>
<div class="row menu-row">
	<div class="container">
		<div class="col-xs-12 no-padding-LR">
			<div class="bbs-menu-bar">
				<ul>
					<li class="<?php echo $home; ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
					<?php if($roleId==2 || $roleId==3){ ?>
					<li id="bookMenu" class="<?php echo $bookRoom; ?>"><a href="<?php echo base_url(); ?>index.php/book_room/">Book Room</a></li>
					<!-- <li id="searchMenu" class="<?php echo $searchRoom; ?>"><a href="<?php echo base_url(); ?>index.php/search_room/">Search Room</a></li> -->
					<?php } ?>
					<li class="<?php echo $bookings; ?>"><a href="<?php echo base_url(); ?>index.php/bookings/">View Bookings</a></li>
					<li class="<?php echo $requests; ?>"><a href="<?php echo base_url(); ?>index.php/requests/">Booking Requests</a></li>
					<?php if($roleId==1){ ?>
					<li class=""><a href="#">Add Records</a></li>
					<li class="<?php echo $configure; ?>"><a href="<?php echo base_url(); ?>index.php/system_configuration_script/">Configuration</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>

