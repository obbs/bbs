<script type="text/javascript">
	
	function searchRoomHome(source){
		$('#homeSearchRoom-Err').html('Working | Please Wait...');
		var bookingDate = $('#homeSearch-bookingDate').val();
		var bookingStartTime = $('#homeSearch-bookingStartTime').val();
		var bookingDuration = $('#homeSearch-bookingDuration').val();
		var capacity = $('#homeSearch-bookingCapacity').val();
		var type = $('#homeSearch-bookingType').val();
		$.ajax({
			url: "<?php echo base_url().'index.php/home/homeSearch'; ?>", 
			type: 'POST', 
			data: ({
				bookingDate: bookingDate,
				startTime: bookingStartTime,
				duration: bookingDuration,
				capacity: capacity,
				type: type
			}),
			success: function(msg){
				$('#homeSearchRoom-Err').html('');
				var data = $.parseJSON(msg);
				if(data['status']==-1){
					$('#homeSearchRoom-Err').html(data['msg']);
					return false;
				}else{
					var roomArr = data['msg'];
					if(roomArr.length==0){
						$('#homeSearchRoom-Err').html('* No Rooms Available for this query');
						return false;
					}else{
						$('#homeSearchRoom-Err').html('');
						//activateMenu('searchMenu');
						var temp = '<div class="div-cont">';
						temp += '<strong class="section-heading">Search Result(s) for '+bookingDate+'</strong>';
						temp += '<div class="table-grid">';
						temp += '<table class="table">';
						temp += '<thead><tr>';
						temp += '<th>#</th><th>Room</th><th>Building</th><th>Level</th><th>Type</th><th>Capacity</th>';
						temp += '<th>Incharge</th><th>&nbsp;</th>';
						temp += '</thead><tbody>';
						var cc=1;
						//var roleId = '<?php echo $this->common->sys_getSession('roleId'); ?>';
						for(var i=0;i<roomArr.length;i++){
							var perTag='';
							var perClass='btn-primary';
							var perLabel='Proceed to Book';
							if(roomArr[i]['inchargeName']==null){ roomArr[i]['inchargeName']='--';}
							if(roomArr[i]['permission']==1){perTag='Permission Required'; perClass='btn-info'; perLabel='Request Booking';}
							var perBtn = '<button type="button" class="btn btn-xs '+perClass+'" onclick="bookRoomWiz('+roomArr[i]['roomId']+',\''+bookingDate+'\',\''+bookingStartTime+'\','+bookingDuration+');">'+perLabel+'</button>';
							temp += '<tr><td>'+cc+'</td>';
							temp += '<td>'+roomArr[i]['name']+'</td>';
							temp += '<td>'+roomArr[i]['building']+'</td>';
							temp += '<td>'+roomArr[i]['level']+'</td>';
							temp += '<td>'+roomArr[i]['type']+'</td>';
							temp += '<td>'+roomArr[i]['capacity']+'</td>';
							temp += '<td>'+roomArr[i]['inchargeName']+'</td>';
							temp += '<td>'+perBtn+'<br><small>'+perTag+'</small></td>';
							temp += '</tr>';
							cc++;
						}
						temp += '</tbody></table>';
						temp += '</div>';
						temp += '</div>';
						var idChange = '';
						if(source==1){idChange='homeMainGrid';}
						else if(source==2){idChange='wizMainGrid';}
						$('#'+idChange).html(temp);
					}
				}
			} 
		}); 
	}
	
	function bookRoomWiz(roomId,bookingDate,startTime,duration){
		activateMenu('bookMenu');
		wizardHeader(2,roomId,bookingDate,startTime,duration,0);
		var temp = '<div class="col-md-12" id="wiz-title">&nbsp;</div><div class="col-md-12" id="wiz-body">&nbsp;</div>';
		$('#homeMainGrid').html(temp);
	}
	
	function activateMenu(menuItem){
		$('.bbs-menu-bar ul li').removeClass('active-menu');
		$('#'+menuItem).addClass('active-menu');
	}
	
	function initializeWizard(){
		wizardHeader(1,0,0,0,0,0);
	}
	
	function wizardHeader(step,roomId,bookingDate,startTime,duration,bookingId){
		$.ajax({
			url: "<?php echo base_url().'index.php/book_room/wizardHeader'; ?>", 
			type: 'POST', 
			data: ({
				step: step
			}),
			success: function(msg){
				$('#wiz-title').html(msg);
				wizardBody(step,roomId,bookingDate,startTime,duration,bookingId);
			}
		}); 
	}
	
	function wizardBody(step,roomId,bookingDate,startTime,duration,bookingId){
		$.ajax({
			url: "<?php echo base_url().'index.php/book_room/wizardBody'; ?>", 
			type: 'POST', 
			data: ({
				step: step,
				roomId: roomId,
				bookingDate: bookingDate,
				startTime: startTime,
				duration: duration,
				bookingId: bookingId
			}),
			success: function(msg){
				$('#wiz-body').html(msg);
			}
		}); 
	}
	
	function confirmBookingCancel(bookingId,roomName,bookingDay,bookingTime){
		var tempBody = '<span>Sure about cancelling the booking for<br/>';
		tempBody += '<b>'+roomName+'</b> on <b>'+bookingDay+'</b>, <b>'+bookingTime+'</b><br/><br/>';
		tempBody += 'Once cancelled, it cannot be undone</span>';
		var tempBtn = '<span class="no-err" id="bbs-modal-err"></span>&nbsp;&nbsp;<button onclick="finalConfirmBooking('+bookingId+');" class="btn btn-sm btn-danger">Cancel Booking</button>&nbsp;';
		tempBtn += '<button class="btn btn-sm" data-dismiss="modal" aria-hidden="true">Close</button>';
		$('#bbs-modal-header strong').html('Confirmation');
		$('#bbs-modal-body').html(tempBody);
		$('#bbs-modal-footer').html(tempBtn);
		$('#bbs-modal').modal('show');
	}
	
	function finalConfirmBooking(bookingId){
		$('#bbs-modal-err').html('Working | Please Wait');
		$.ajax({
			url: "<?php echo base_url().'index.php/bookings/cancelBooking'; ?>", 
			type: 'POST', 
			data: ({
				bookingId: bookingId
			}),
			success: function(msg){
				$('#bbs-modal-err').html();
				$('#bbs-modal').modal('hide');
				$('#'+bookingId+'_bookingRow').addClass('deActivate');
				$('#'+bookingId+'_bookingRow .status_cell').html('<span class="label label-inverse">Cancelled</span> <b><small>Just Now</small></b>');
				$('#'+bookingId+'_bookingRow .booking-msg-tag').html('--');
			}
		}); 
	}
	
	function submitBooking(){
		var roomId = $('#wiz_s2_roomId').val();
		var bookingDate = $('#wiz_s2_bookingDate').val();
		var startTime = $('#wiz_s2_startTime').val();
		var duration = $('#wiz_s2_duration').val();
		var purpose = $('#wiz_s2_purPose').val();
		$('#bbs-modal-err').html('Working | Please Wait');
		$.ajax({
			url: "<?php echo base_url().'index.php/book_room/submitBooking'; ?>", 
			type: 'POST', 
			data: ({
				roomId: roomId,
				bookingDate: bookingDate,
				startTime: startTime,
				duration: duration,
				purpose: purpose
			}),
			success: function(msg){
				var data = $.parseJSON(msg);
				if(data['status']==1){
					var bookingId = data['bookingId'];
					wizardHeader(3,0,0,0,0,bookingId);
				}
			}
		}); 
	}
	
	function displayRequestTabs(){
		var tabHtml = '<div class="div-cont request-tabs">';
		tabHtml += '<button type="button" class="btn btn-default" id="request-admin-tab" onclick="displayRequestBody(1);">Booking Request</button>';
		tabHtml += '<button type="button" class="btn btn-default" id="request-client-tab" onclick="displayRequestBody(2);">Your Requests</button>';
		tabHtml += '</div>';
		$('#req_tabs').html(tabHtml);
	}
	
	function displayRequestBody(tab){
		var page='<?php echo $this->common->sys_getSession('page'); ?>';
		var reqTab='';
		if(tab==1){ reqTab='request-admin-tab'; }
		else{ reqTab='request-client-tab'; }
		$('.request-tabs button').removeClass('btn-grey');
		$('#'+reqTab).addClass('btn-grey');
		$.ajax({
			url: "<?php echo base_url().'index.php/requests/displayRequestBody'; ?>", 
			type: 'POST', 
			data: ({
				tab: tab
			}),
			success: function(msg){
				var tabHeading='Your Booking Requests';
				if(tab==1){ tabHeading='Booking Requests by Other Users'; }
				var data = $.parseJSON(msg);
				var temp = '<div class="div-cont">';
				temp += '<strong class="section-heading">'+tabHeading;
				if(page=='home'){
					temp+='<span><a href="<?php echo base_url(); ?>index.php/requests/">View All Requests</a></span>';
				}
				temp+='</strong>';
				if(data['totalCount']==0){
					temp += '<div class="no-record-grid" style="padding: 50px 5px;">No Requests for Bookings</div>';
				}else{
					data = data['data'];
					temp += '<div class="table-grid">';
					temp += '<table class="table">';
					temp += '<thead><tr>';
					temp += '<th>#</th><th>Room</th>';
					if(tab==1){ temp += '<th>Request By</th>';}
					temp += '<th>Date</th><th>Time</th>';
					if(page!="home"){ temp += '<th>Purpose</th>'; }
					temp += '<th>Status</th>';
					if(tab==2){ temp += '<th>Incharge</th>'; }
					if(tab==1){ temp += '<th>&nbsp;</th>'; }
					temp += '</tr></thead><tbody>';
					var cc=1;
					
					for(var i=0;i<data.length;i++){
						var axnBtn='';
						var statusTag='--';
						if(data[i]['status']==0){
							var statusLabel = 'Approval Required';
							if(tab==2){ statusLabel = 'Approval Pending'; }
							statusTag = '<span class="label label-info">'+statusLabel+'</span>';
							axnBtn += '<button class="btn btn-xs btn-success" onclick="underConstruction();" alt="Approve" title="Approve"><i class="icon-ok"></i></button>&nbsp;';
							axnBtn += '<button class="btn btn-xs btn-danger" onclick="underConstruction();" alt="Decline" title="Decline"><i class="icon-remove-sign"></i></button>';
						}else if(data[i]['status']==-1 || data[i]['status']==1){
							statusTag = '<span class="label label-inverse">Expired</span>';
							axnBtn = '--';
						}else{
							statusTag='--';
							axnBtn = '--';
						}
							
						temp += '<tr><td>'+cc+'</td>';
						temp += '<td>'+data[i]['roomName']+' ('+data[i]['building']+')</td>';
						if(tab==1){ temp += '<td>'+data[i]['clientName']+'</td>';}
						temp += '<td>'+data[i]['bookingDate']+'</td>';
						temp += '<td>'+data[i]['bookingTime']+'</td>';
						if(page!="home"){ temp += '<td>'+data[i]['purpose']+'</td>'; }
						temp += '<td>'+statusTag+'</td>';
						if(tab==2){temp += '<td>'+data[i]['incharge']+'</td>';}
						if(tab==1){temp += '<td>'+axnBtn+'</td>';}
						temp += '</tr>';
						cc++;
						if(page=="home"){
							if(cc>3){ break; }
						}
					}
					temp += '</tbody></table>';
					temp += '</div>';
				}
				temp += '</div>';
				$('#req_body').html(temp);
			}
		}); 
	}
	
	function requestAdminBar(){
		$.ajax({
			url: "<?php echo base_url().'index.php/requests/displayRequestBody'; ?>", 
			type: 'POST', 
			data: ({
				tab: 1
			}),
			success: function(msg){
				var data = $.parseJSON(msg);
				var len = data['totalCount'];
				var temp = '<div class="div-cont home-request-banner">';
				if(len==0){
					temp += '<label>No Booking Requests</label>';
				}else{
					temp += '<strong>'+len+'</strong> Booking Requests ';
					temp += '<a class="btn btn-xs btn-warning" href="<?php echo base_url(); ?>index.php/requests/">View Requests</a>';
				}
				temp += '</div>';
				$('#req_body').before(temp);
			}
		}); 
	}
	
	function underConstruction(){
		alert('Under Construction | Try Again Later');
	}
	
</script>




