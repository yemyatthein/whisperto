var countRecipient = 0;
$(document).ready(function(){		
	$(".container").corner("15px");
	$('a[@rel*=facebox]').facebox();
	$('#for_real_container').hide();	
	$('.whisper_just_for_show').click(function () {	
		$('.whisper_just_for_show').hide();
		$('#for_real_container').show('slow');
	});
	
	$('#discard').click(function () {	
		$('.whisper_just_for_show').show();
		$('#for_real_container').hide();		
		$("form#wh_form INPUT[@name='data[VT][VT][ ]'][type='checkbox']").attr('checked', false);		
		var count = $("form#wh_form INPUT[@name='data[VT][VT][ ]'][type='checkbox']").length;		
		for(var i=0; i<count; i++){
			$('img[name=img_user_' + i + ']').css('border', 'solid');
			$('img[name=img_user_' + i + ']').css('border-width', '2px');
			$('img[name=img_user_' + i + ']').css('border-color', 'gray');			
		}
		countRecipient = 0;
		updateNumberOfRecipient();
		$('.facebox_effect').html('');
		$('.whisper_for_real').val('');
	});
	
});
function selectToPeople(idChk, idImage, name){
	if($('#' + idChk).is(':checked'))
	{
		countRecipient--;
		checkRecipentCheckboxes(idChk, idImage, "uncheck");
		$('#tmp_for_' + idChk).remove();
	}
	else{
		countRecipient++;
		checkRecipentCheckboxes(idChk, idImage, "check");
		addToTempCanvas(idChk, idImage, name);
	}
	updateNumberOfRecipient();
}
function checkRecipentCheckboxes(idChk, idImage, flag){
	if(flag == 'check'){
		$('#' + idChk).attr('checked', true);
		$('#' + idImage).css('border', 'solid');
		$('#' + idImage).css('border-width', '2px');
		$('#' + idImage).css('border-color', 'red');
	}
	else if(flag == 'uncheck'){
		$('#' + idChk).attr('checked', false);
		$('#' + idImage).css('border', 'solid');
		$('#' + idImage).css('border-width', '2px');
		$('#' + idImage).css('border-color', 'gray');		
	}
}
function updateNumberOfRecipient(){
	if(countRecipient < 2){
		$('#count_recipient').html(countRecipient + ' Recipient');
	}
	else{
		$('#count_recipient').html(countRecipient + ' Recipients');
	}
}
function addToTempCanvas(idChk, idImage, name){
	var data = '<a id="tmp_for_' + idChk + '" href="#" onclick="deleteRecipient(this, \'' + idChk + '\', \'' + idImage + '\')"><span class="mail_style">' + name + '</span></a>';	
	$('.facebox_effect').append(' ' + data);
}
function deleteRecipient(el, idChk, idImage){
	$(el).remove();	
	countRecipient--;
	$('#' + idChk).attr('checked', false);
	$('#' + idImage).css('border', 'solid');
	$('#' + idImage).css('border-width', '2px');
	$('#' + idImage).css('border-color', 'gray');		
}