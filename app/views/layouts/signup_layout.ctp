<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WhisperTo | <?php echo $title_for_layout; ?></title>
	<?php echo $scripts_for_layout; ?>
	<?php echo $html->css('style'); ?>	
	<?php echo $html->css('/js/facebox/facebox'); ?>
	<?php echo $this->Html->script('jquery'); ?>	
	<?php echo $this->Html->script('jquery.corner'); ?>
	<?php echo $this->Html->script('facebox/facebox'); ?>	
	<?php echo $this->Html->script('jquery.elastic'); ?>	
</head>

<body>
	<div align='center'>
	<div style='margin-top:20px; border:none; width:630px; padding-left:0px; margin-left:0px'>
	<div style='width:570px; text-align:left;'><?php echo $html->link($html->image('logo.png'), '#', array('escape'=>false)); ?></div>
	
	
	<?php echo $content_for_layout; ?>
	
	<div style='text-align:left; margin-top:20px; width:340px;'>
		<a href=''>About us</a>&nbsp;&nbsp;&nbsp;
		<a href=''>Contact us</a>&nbsp;&nbsp;&nbsp;
		<a href=''>Feedback</a>&nbsp;&nbsp;&nbsp;
		<a href=''>Terms of Service</a>&nbsp;&nbsp;&nbsp;<br/>
		<div style='text-align:center; margin-top:10px;'>
			<!--2010 All rights reserved.-->
		</div>
	</div>
	</div>

</body>
</html>