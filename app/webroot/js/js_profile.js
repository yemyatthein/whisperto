$(document).ready(function(){
	$('#add_as_friend').click(function(e){
		var tg = $('#user_of_interest').val();
		$.ajax({
			type: 'POST',
			url: '/whisperto/users/ajax_friendship_cases',
			data: 'tg=' + tg + '&action=add',
			success: function(response){
				window.location.reload();
			}
		});
	});
	$('#clear_invite').click(function(e){
		var tg = $('#user_of_interest').val();
		$.ajax({
			type: 'POST',
			url: '/whisperto/users/ajax_friendship_cases',
			data: 'tg=' + tg + '&action=remove_invitaton',
			success: function(response){
				window.location.reload();
			}
		});
	});
	$('#accept_invite').click(function(e){
		var tg = $('#user_of_interest').val();
		$.ajax({
			type: 'POST',
			url: '/whisperto/users/ajax_friendship_cases',
			data: 'tg=' + tg + '&action=accept_invitaton',
			success: function(response){
				$('#msg').hide();
				var data_json = $.parseJSON(response);
				//alert('Whisper to ' + data_json.relInfo.User.firstname);
				$('#invitee').html('<a href="/whisperto/whispers/new_whisper/' + data_json.relInfo.User.id + '">Whisper ' + data_json.relInfo.User.firstname + ' ' + data_json.relInfo.User.secondname + '</a>');
			}
		});
	});
});