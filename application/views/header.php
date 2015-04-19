<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="en" class="no-js"> <!--<![endif]-->
	
	<!-- Begin Global Header -->
	<head>
		<meta charset="utf-8" />
		<title>BBS | Oxford Brookes University</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=0.50">
		<!-- <meta content="width=device-width, initial-scale=1.0" name="viewport" /> -->
		<meta content="" name="" />
		<meta content="" name="" />
		<meta name="MobileOptimized" content="320">
		
		<!--Begin Styles-->
		<script src="<?php echo base_url(); ?>kit/js/jquery-2.1.3.min.js" type="text/javascript"></script>
		<link href="<?php echo base_url(); ?>kit/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>kit/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>kit/plugins/datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>kit/plugins/datepicker/less/datepicker.less" rel="stylesheet/less" type="text/css"/>
		<link href="<?php echo base_url(); ?>kit/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>kit/css/style.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>kit/css/custom.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>kit/css/custom-responsive.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>kit/css/design.css" rel="stylesheet" type="text/css"/>
		
		<script type="text/javascript" src="<?php echo base_url(); ?>kit/plugins/datepicker/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>kit/plugins/timepicker/js/bootstrap-timepicker.js"></script>
		<!-- <link href="<?php echo base_url(); ?>assets/css/custom-responsive.css" rel="stylesheet" type="text/css"/> -->
		<!--End Styles-->
		
		<link rel="icon" type="image/ico" href="<?php echo base_url(); ?>kit/img/icon_title.png" /> <!--Favicon-->
	</head>
	<!--End Global Header -->
	
	<!--Begin Body -->
	<body>
		
		<div class="row">
			<div class="col-md-12">
				<div class="login-top-layer">
					<div class="container">
						<div class="row">
							<div class="col-xs-6">
								<img src="<?php echo base_url(); ?>kit/img/obu.png" />
							</div>
							<div class="col-xs-6">
								<div class="header-top-link">
									<?php
										if($this->common->sys_getSession('userId')){
											echo '<strong>'.$this->common->sys_getSession('name').'</strong><br/>';
											echo '<a href="'.base_url().'index.php/logout">Sign Out</a>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>

		
	