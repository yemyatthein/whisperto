<?php if($results != NULL){ ?>
	<?php foreach($results as $elem){ ?>
		<?php e($elem['CreatedBy']['name'].': '); ?>
		<?php e('<b>'.$presentation->hyperlinkAdding($elem['Whisper']['content']).'</b>'); ?>
		<?php e($html->link('[View]', array('controller' => 'whispers', 'action' => 'view', $elem['Whisper']['id']))); ?>
		<?php e('<br/>'); ?>
	<? } ?>
<? } ?>