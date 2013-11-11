<?php foreach($data as $item){ ?>
<?php e('<p>'.$item['Whisper']['content'].'</p>') ?>
<?php } ?>
<?php e($paginator->prev()); ?> &nbsp;
<?php e($paginator->numbers()); ?> &nbsp;
<?php e($paginator->next()); ?>