$(document).ready(function(){		
	$('.comment_for_real').hide();
	$(".container").corner("15px");
	$('a[@rel*=facebox]').facebox();
	$('.comment_for_show').click(function(){
		$('.comment_for_real').show();
		$('.comment_for_show').hide();
    });	
	$("body").click(function(e){		
		if(e.target.className != 'comment_for_show' && e.target.className != 'comment_container' && e.target.className != 'comment_button_container' && e.target.className != 'comment_for_real' && e.target.className != 'comment_button')
		{
			$(".comment_for_real").hide();
			$('.comment_for_show').show();
		}
	});
});