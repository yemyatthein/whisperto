<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		Whisper To
		<?php //echo $title_for_layout; ?>
	</title>
	<?php
		//echo $html->meta('icon');				
	?>
	<?php echo $scripts_for_layout; ?>
	<?php echo $html->css('style'); ?>	
	<?php echo $html->css('/js/facebox/facebox'); ?>
	<?php echo $this->Html->script('jquery'); ?>
	<?php echo $this->Html->script('jquery.corner'); ?>
	<?php echo $this->Html->script('facebox/facebox'); ?>	
</head>
<body>
	<div id="container">
		
		<div id="content">
			<?php 
				echo '<div class="session_flash">';
				echo $session->flash(); 
				echo '</div>';
			?>			
			<?php echo $content_for_layout; ?>
		</div>
		
	</div>
</body>
</html>