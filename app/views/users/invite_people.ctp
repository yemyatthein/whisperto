<?php e($html->script("js_inv")); ?>
<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>'invitation'))); ?>
		</td>
		<td valign='top' align='center' class='center_td_border'>
			<div class='read_item_in_whisper_list'>
				<div class='general_title' style='margin-top:10px; margin-left:10px;'>The person being invited will be in your network when he/she creates an account.</div>
				<div id='inv_box'  style='margin-top:20px; margin-bottom:20px; border:solid thin; border-color:grey' class='edit_intenal'>
					<div class='input_field_sep'>
						<? e($form->create('User', array('action'=>'send_invitation'))); ?>
						<label class='mini_instructions'>Email Address: </label>
						&nbsp;
						<? e($form->text('mail', array('id'=>'mail', 'name'=>'data[User][email]', 'class'=>'login_textbox', 'style'=>'height:23px;'))); ?>
						&nbsp;
						<?php e($this->Form->button('Send Invitation', array('class'=>'buttons'))); ?>
						<? e($form->end()); ?>
					</div>
				</div>
			</div>
		</td>
	</tr>			
</table>