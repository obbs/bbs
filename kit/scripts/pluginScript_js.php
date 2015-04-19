<script type="text/javascript">
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	 
	var checkin = $('#homeSearch-bookingDate').datepicker({
		format: 'dd-mm-yyyy',
	  onRender: function(date) {
	    return date.valueOf() < now.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  /*(if (ev.date.valueOf() > checkout.date.valueOf()) {
	    var newDate = new Date(ev.date)
	    newDate.setDate(newDate.getDate() + 1);
	    checkout.setValue(newDate);
	  }*/
	  checkin.hide();
	  //$('#dpd2')[0].focus();
	}).data('datepicker');
	//$('#homeSearch-bookingStartTime').timepicker();
	 $(document).ready(function () { 
         $('#homeSearch-bookingStartTime').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: true
        });
    });
</script>