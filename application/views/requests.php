<link href="<?php echo base_url(); ?>kit/css/requestStyle.css" rel="stylesheet" type="text/css"/>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			
			<div class="row no-padding-LR">
				<div class="container no-padding-LR">
					
					<div class="col-xs-3" id="req_tabs">shd</div>
					<div class="col-xs-9" id="req_body"></div>
					
				</div>
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		var roleId = '<?php echo $this->common->sys_getSession('roleId'); ?>';
		if(roleId==3){
			$('#req_tabs').remove();
			$('#req_body').removeClass('col-xs-9');
			$('#req_body').addClass('col-md-12');
			displayRequestBody(2);
		}else{
			displayRequestTabs();
			displayRequestBody(1);
		}
	});
</script>