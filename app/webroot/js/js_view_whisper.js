$(document).ready(function(){
	$('.comment_content_input').elastic();
	$('.input_comment_item_container').hide();
	$('#inbox_update').html('s');
	
	$('#show_response').click(function(){
		$('.input_comment_item_container').toggle();
		$('#comment_data').focus();
		$("html").animate({ scrollTop: $(document).height() }, "slow");
		return false;
	});
	
	$('#ignore_whisper').click(function(){
		var whisper_id = $('#whisper_id').val();
				
		$.ajax({
			type: 'POST',
			url: '/whisperto/whispers/ajax_ignore_whisper',
			data: 'whisper_id=' + whisper_id,
			success: function(response){				
				if(response=='0'){
					$('#ignore_whisper').html('Don\'t Ignore');
				}
				else if(response=='1'){
					$('#ignore_whisper').html('Ignore');
				}
			}
		});
	});
	
	$("#comment_data").keydown(function(event){
		if(event.keyCode == 13 && !event.shiftKey){
			var comment = $('#comment_data').val();
			var whisper_id = $('#whisper_id').val();
			
			$('#comment_data').val('');
			$('.input_comment_item_container').hide();
			if(comment != ''){
				$.ajax({
					type: 'POST',
					url: '/whisperto/comments/ajax_add_comment',
					data: 'comment=' + comment + '&whisper_id=' + whisper_id,
					success: function(response){
						var data_json = $.parseJSON(response);	
						if(data_json!=null && response != '[]')
						{
							var content = "<div class='comment_item_container'>";
							content += "<table border='0' cellspacing='0'>";
							content += "<tr>";
							content += "<td valign='top'>";
							content += "<img src='/whisperto/img/users/" + data_json.user_image + "' width='40' height='40' alt='' />";
							content += "</td>";
							content += "<td valign='top'>";
							content += "<a href='/whisperto/users/profile/" + data_json.user_id + "'>" + data_json.username + "</a>: " + data_json.content;
							content += "<div class='comment_time_display'>";
							content += "<span class='time_display'>" + data_json.time_display + "</span>";
							content += "</div>";
							content += "</td>";
							content += "</tr>";
							content += "</table>";
							content += "</div>";
							$('#additional_comment_container').append(content);
						}
					}
				});
			}
		}
	});
	
});