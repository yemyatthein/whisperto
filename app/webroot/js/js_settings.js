$(document).ready(function(){
	
	$('#aboutme_edit').corner();
	$('#pdata_edit').corner();
	$('#picture_edit').corner();
	
	$('#aboutme_edit').hide();
	$('#pdata_edit').hide();
	$('#picture_edit').hide();
	
	$('#ed_about').click(function(e){
		var content = $('#abm').html();
		$('#abm_content').val(content);
		$('#pdata_edit').hide();
		$('#picture_edit').hide();
		$('#aboutme_edit').show();
	});
	
	$('#ed_pdata').click(function(e){
		var fname = $('#fn').html();
		var sname = $('#sn').html();
		var gender = 'Gender' + $('#gender').html();
		var bd = $('#bd').html();
		
		var bdata = bd.split('-');
		var byear = bdata[0];
		var bmonth = bdata[1];
		var bdate = bdata[2];
		
		$('#fname').val(fname);
		$('#sname').val(sname);
		$('#UserBirthdateYear').val(byear);
		$('#UserBirthdateMonth').val(bmonth);
		$('#UserBirthdateDay').val(bdate);
		$('#' + gender).attr('checked', 'checked');
		
		$('#aboutme_edit').hide();
		$('#picture_edit').hide();
		$('#pdata_edit').show();
	});
	
	$('#ed_pict').click(function(e){
		$('#aboutme_edit').hide();
		$('#pdata_edit').hide();
		$('#picture_edit').show();
	});
	
});