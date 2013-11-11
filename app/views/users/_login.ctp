<h1>Log In</h1>
<?php e($form->create('User', array('action' => 'login')));?>
<fieldset>
	<label for="UserUsername"><span>Your Email</span></label>
	<?php e($form->text('username')); ?>
	<label for="UserPassword"><span>Password</span></label>
	<?php e($form->password('password')); ?>
	<?php e($form->submit('Login')); ?>
</fieldset>
<?php e($form->end()); ?>