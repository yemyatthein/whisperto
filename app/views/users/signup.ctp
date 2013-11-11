<?php e($html->script("js_user_signup")); ?>
<style>
	div#signup_inv{
		margin-left: 10px;
		margin-top: 10px;
	}
	td.spc{
		padding-top: 10px;
	}
	div#login_box{
		border: none;
		border-width: 1px;
		border-color: #6E6E6E;
		width: 570px;		
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
		padding-left: 20px;
		background-color: #FFF;
		//margin: 10px;
	}
	div#login_submit{
		margin-top: 15px;
		text-align: right;
	}
</style>
<div style='background-color:#FFF'>
<div id='login_box'>
<div id='login_content'>
	<div class='general_title'>Sign Up</div>
	<? e($form->create('User', array('action'=>'signup', 'type' => 'file'))); ?>
		<table border='0' width='525'>
			<tr>
				<td valign='top'>
					
					<table border='0'>
						<tr>
							<td class='spc'>
								<label class='mini_instructions'>Username (Email): </label>
								<br/>
								<? e($form->text('username', array('id'=>'username', 'class'=>'login_textbox', 'value'=>$email))); ?>
							</td>
						</tr>
						<tr>
							<td class='spc'>
								<label class='mini_instructions'>Password: </label>
								<br/>
								<? e($form->password('password', array('class'=>'login_textbox'))); ?>
							</td>
						</tr>
						<tr>
							<td class='spc'>
								<label class='mini_instructions'>Retype Password: </label>
								<br/>
								<? e($form->password('password2', array('class'=>'login_textbox'))); ?>
							</td>
						</tr>
						<tr>
							<td class='spc'>
								<label class='mini_instructions'>First Name: </label>
								<br/>
								<? e($form->text('firstname', array('class'=>'login_textbox'))); ?>
							</td>
						</tr>
						<tr>
							<td class='spc'>
								<label class='mini_instructions'>Last Name: </label>
								<br/>
								<? e($form->text('secondname', array('class'=>'login_textbox'))); ?>
							</td>
						</tr>
						<tr>
							<td class='spc'>
								<label class='mini_instructions'>Gender: </label>
								<br/>
								<?php
									$options = array('Male'=>"Male", 'Female'=>"Female");
									$attributes = array('id'=>'gender', 'legend'=>false, 'name'=>'data[User][gender]', 'class'=>'radio_btn', 'label'=>'sp');
								?>
								<? e($form->radio('Gender', $options, $attributes)); ?>
							</td>
						</tr>
						<tr>
							<td class='spc'>
								<label class='mini_instructions'>Birth Date: </label>
								<br/>
								<? e($form->input('User.birthdate', array('type'=>'date','minYear'=>1930, 'label'=>''))); ?>
							</td>
						</tr>
						<tr>
							<td class='spc'>
								<label class='mini_instructions'>Profile picture:</label>
								<br/>
								<?php e($form->file('File.Photo')); ?>
							</td>
						</tr>
						<tr>
							<td class='spc'>
								<div id='login_submit'>
									<? e($form->submit('Signup')); ?>
								</div>
							</td>
						</tr>
						<tr>
						</tr>
					</table>
				</td>
				<td width='220' valign='top'>
					<div style='background-color:#FFF'>
					<div id='users' style='min-height:440px; background-color:#FFF; border:solid thin; border-color:#BDBDBD; margin-top:0px'>
						<div class='general_title' style='margin-top:10px; margin-left:10px;'>Users who invited you.</div>
						<div id='signup_inv'>
							<table width='180' border='0'>
								<? for($i=0; $i<count($users); $i++){ ?>
								<tr>
									<td width='50' valign='top'>
										<?php echo $html->image('users/'.$users[$i]['User']['profile_image'], array('width'=>'50', 'height'=>'50')); ?>
									</td>
									<td style='padding-left:3px; padding-top:5px; height:55px' valign='top'>
										<b><?php e($users[$i]['User']['firstname'].' '.$users[$i]['User']['secondname']); ?></b><br/>
										<span class='time_display'><?php e($users[$i]['User']['username']); ?></span>
									</td>
								</tr>
								<? } ?>
							</table>
						</div>
					</div>
					</div>
				</td>
			</tr>
		</table>
		
	<? e($form->end()); ?>
</div>
</div>
</div>