<link href="<?php echo base_url(); ?>kit/css/custom.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>kit/js/jquery-1.10.2.min.js" type="text/javascript"></script>

<iframe class="display-none" name="uploadStFile"></iframe>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form method="post" target="_blank" enctype="multipart/form-data"
					id="upload_file" name="upload_file" 
					action="<?php echo base_url(); ?>index.php/system_configuration_script/csUploadFile/">
				Student File: <input type="file" name="studentFile" id="studentFile"/><br/>
				Staff File: <input type="file" name="staffFile" id="staffFile"/><br/>
				Room File: <input type="file" name="roomFile" id="roomFile"/><br/>
				<input type="button" value="Configure" onclick="cs_submitFile();"/>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
	
	//Initializing function for wizard template, draft check, form binding for upload file
	jQuery(document).ready(function() {
		var wiz_uploadData = {
			success:   wiz_toggle_CSVModal_wrapper
		};
		$('#upload_file').ajaxForm(wiz_uploadData);
	});
	
	function cs_submitFile(){
		$('#msgErrUploadCSV').html('');
		var fileField = $('#roomFile').val(); 
		var dotPos = fileField.lastIndexOf(".");
		var len = fileField.length;
		var str = fileField.substring(dotPos,len);
		
		if(str!=".csv" && str!=".txt"){
			alert('in');
			$('#wiz_uploadStatus').html('Invalid File | Try Again');
			return false;
		}
		$("#upload_file").submit();
	}
	
	
</script>
