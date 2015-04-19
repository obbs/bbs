<?php $this->common->sys_header(); ?>
<link href="<?php echo base_url(); ?>kit/css/loginStyle.css" rel="stylesheet" type="text/css"/>

<?php
	$old_userName = $old_password = $errorMsg = "";
	if(isset($errors)){
		$errorMsg = $errors;
		$old_userName = $old_al_userName;
		$old_password = $old_al_password;
	}
?>

<div class="row">
	<div class="col-md-12">
		
		<div class="login-grid">
			<div class="row">
				<div class="col-md-12">
					<strong>Welcome to <br/>Brookes Booking System</strong>
					<small>Please enter PIP details</small>
				</div>
			</div>
			<br/><br />
			<form class="login-form" action="<?php echo base_url(); ?>index.php/auth_login" method="post">
				<div class="row">
					<div class="col-md-12">
						<!-- <label>Username</label> -->
						<input type="text" placeholder="Username" id="userName" name="userName" autocomplete="off" value="<?php echo $old_userName; ?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<!-- <label>Password</label> -->
						<input type="password" placeholder="Password" id="userPassword" name="userPassword" autocomplete="off" value="<?php echo $old_password; ?>"/>
					</div>
				</div>
				
				<!--<div class="row">
					<div class="col-md-12 rememberMeBlock">
						<input type="checkbox" id="userRememberMe" name="userRememberMe" value="1"/> Remember Me
					</div>
				</div>-->
				
				<div class="row">
					<div class="col-md-12">
						<span class="no-err" id="errorBox" style="margin-top: 10px; display: block;">
							<?php echo $errorMsg; ?>
						</span>
						<button type="submit" class="btn btn-sm btn-primary">Log In</button>
					</div>
				</div>
			</form>
		</div>
		<div class="login-copyright">
			Project BBS | Software Production (Group 1)<br/>
			Alhadi Bashir, Jo Clarke, Naif Filemban, Sahil David, William Joshua<br/>
			Feb 2015 - May 2015
		</div>
		
	</div>
</div>

<?php $this->common->sys_footer(); ?>

<script type="text/javascript">
	jQuery(document).ready(function() {
		$("#userName").focus();
	});
</script>
