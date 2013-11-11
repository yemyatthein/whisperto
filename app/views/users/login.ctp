<?php e($html->script("js_user_login")); ?>
<style>
	div#login_box{
		border: none;
		border-width: 1px;
		border-color: #6E6E6E;
		width: 400px;		
		margin-top: 20px;
		text-align: left;
		background-color: #CCC;
		padding:5px;
	}
	div#login_content{		
		//margin-bottom: 10px;
		text-align: left;
		//margin-left: 10px;
		//margin-right: 10px;
		border: solid;
		border-width: 1px;
		border-color: #6E6E6E;
		padding: 20px;
		background-color: #FFF;
		//margin: 10px;
	}
	div#login_submit{
		margin-top: 15px;
	}
</style>
<div style='background-color:#FFF'>
<div id='login_box'>
<div id='login_content'>
<div class='general_title'>Log In</div>
<?php e($form->create('User', array('action' => 'login')));?>
	<table border='0' style='margin-top:10px;' cellspacing='0'>
		<tr>
			<td>
				<label class='mini_instructions' for="UserUsername"><span>Your Email</span></label>&nbsp;&nbsp;&nbsp;<br/><br/>
			</td>
			<td>
				&nbsp;&nbsp;<?php e($form->text('username', array('id'=>'username', 'class'=>'login_textbox'))); ?><br/><br/>
			</td>
		</tr>
		<tr>
			<td>
				<label class='mini_instructions' for="UserPassword"><span>Password</span></label>&nbsp;&nbsp;&nbsp;
			</td>
			<td>
				&nbsp;&nbsp;<?php e($form->password('password', array('class'=>'login_textbox'))); ?>
			</td>
		</tr>
		<tr>	
			<td>
				
			</td>
			<td align='right'>
				<div id='login_submit'>
					<input type='submit' value='Sign in' />
				</div>
			</td>
		</tr>
	</table>
	
	
	
	
	
<?php e($form->end()); ?>
</div>
</div>
</div>