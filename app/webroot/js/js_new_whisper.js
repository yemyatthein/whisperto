var recipients = new Array();
$(document).ready(function(){		

	$('#show_friends').hide();
	$('#friends').hide();
	$('#whisper_content').focus();
	$('a[rel*=facebox]').facebox();
	$('.whisper_content_input').elastic();

	$('#browse_friends').click(function(e){	
		
		var keywords = "_all_";
		$('#friends_name').val('');
		$('#friends').html('');
		if(recipients.length <= 5){
			$.ajax({
				type: 'POST',
				url: '/whisperto/users/ajax_get_user_friend',
				data: 'keyword=' + keywords,
				success: function(response){
					var data_json = $.parseJSON(response);
					var content = "";
					if(data_json!=null && response != '[]')
					{
						var data_length = data_json.length;
						content = "<div class='search_friends_result_box'>";
						
						content += "<table>";					
						content += "<tr>"
						for(var i=0; i<data_length; i++){
							if(i!=0 && i%9 == 0){
								content += "</tr>";
								content += "<tr>";
							}				
							content += "<td>";						
							content += "<div style='border:none; width: 50px; margin:1px; padding-top:3px; padding-bottom:3px; text-align:center;'>";
							content += "<a href='#' onclick='add_temporary(\"" + data_json[i].u.id + "\", \"" + data_json[i].u.firstname + "\", \"" + data_json[i].u.secondname + "\")'>" + "<img style='border:solid thin; border-color:gray;' src='/whisperto/app/webroot/img/users/" + data_json[i].u.profile_image + "' width='40' height='40' />" + "</a>";
							content += "<div style='font-size:10px;'>";
							content += "<a href=''>" + data_json[i].u.firstname + "</a>";
							content += "</div>";
							content += "</div>";
							content += "</td>";
							if(i==data_length-1){
								content += "</tr>";
							}
						}
						content += "</table>";
						
						
						content += "</div>";
						
						$('#friends').html(content);
					}
					else{
						content += "<div class='general_title' align='center'>";
						content += "Search returns 0 result.";
						content += "</div>";
						$('#friends').html(content);
					}
					$('#show_friends').click();
				}
			});	
		}
		else{
			alert('Maximum number of recipients is five.');
		}
	});
	
	$('#search_friends').click(function(e){	
		
		var keywords = $('#friends_name').val();
		$('#friends_name').val('');
		$('#friends').html('');
		if(recipients.length <= 5){
			$.ajax({
				type: 'POST',
				url: '/whisperto/users/ajax_get_user_friend',
				data: 'keyword=' + keywords,
				success: function(response){
					var data_json = $.parseJSON(response);
					var content = "";
					if(data_json!=null && response != '[]')
					{
						var data_length = data_json.length;
						content = "<div class='search_friends_result_box'>";
						
						content += "<table>";					
						content += "<tr>"
						for(var i=0; i<data_length; i++){
							if(i!=0 && i%9 == 0){
								content += "</tr>";
								content += "<tr>";
							}				
							content += "<td>";						
							content += "<div style='border:none; width: 50px; margin:1px; padding-top:3px; padding-bottom:3px; text-align:center;'>";
							content += "<a href='#' onclick='add_temporary(\"" + data_json[i].u.id + "\", \"" + data_json[i].u.firstname + "s\", \"" + data_json[i].u.secondname + "s\")'>" + "<img style='border:solid thin; border-color:gray;' src='/whisperto/app/webroot/img/users/" + data_json[i].u.profile_image + "' width='40' height='40' />" + "</a>";
							content += "<div style='font-size:10px;'>";
							content += "<a href=''>" + data_json[i].u.firstname + "</a>";
							content += "</div>";
							content += "</div>";
							content += "</td>";
							if(i==data_length-1){
								content += "</tr>";
							}
						}
						content += "</table>";
						
						
						content += "</div>";
						
						$('#friends').html(content);
					}
					else{
						content += "<div class='general_title' align='center'>";
						content += "Search returns 0 result.";
						content += "</div>";
						$('#friends').html(content);
					}
					$('#show_friends').click();
				}
			});	
		}
		else{
			alert('Maximum number of recipients is five.');
		}
	});
	
	$('#whisper_submit').click(function(e){
		$('#new_whisper_form').submit();
	});
	
});

function add_data_submit(){
	for(var i = 0; i < recipients.length; i++) {
		$('<input />').attr('type', 'hidden').attr('name', 'recipients[]').attr('value', recipients[i]).appendTo('#new_whisper_form');	
	}	
};

function add_temporary(idChk, fname, sname){
	if(!checkContains(idChk)){
		recipients.push(idChk);
		$('#zero_recipient_message').hide();
		var data = "<div id='temp_recipient_" + idChk + "' style='border:solid thin; padding:3px; background-color:#DBECF5; margin:5px;'>";
		data += "<table width='100%'><tr>";
		data += "<td>";
		data += "<a href='#'>" + fname + " " + sname + "</a>";	
		data += "</td><td align='right'>";
		data += "<a href='#'>View Profile</a>";
		data += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		data += "<a href='#' onclick='removeItemFromArray(\"" + idChk + "\")'>Remove</a>";
		data += "</td>";
		data += "</tr></table>";
		data += "</div>";
		$('#recipient_area').append(' ' + data);
	}
}

function checkContains(tg){
	for(var i = 0; i < recipients.length; i++) {
		if(recipients[i] == tg){
		  return true;
		}
	}
	return false;
}

function removeItemFromArray(tg){		
	for(var i = 0; i < recipients.length; i++) {
		if(recipients[i] == tg){
		  recipients.splice(i, 1);
		  $('#temp_recipient' + '_' + tg).remove();
		  if(recipients.length == 0){
			$('#zero_recipient_message').show();
		  }
		  break;
		}
	}
}