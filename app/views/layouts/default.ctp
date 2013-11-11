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
	<? //e($session->flash()); ?>
	<div align='center'>
		<?php e($this->element('header')); ?>
		<?php echo $content_for_layout; ?>
	</div>
	<?php e($this->element('bottom')); ?>
</body>
</html>