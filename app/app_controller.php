<?php
class AppController extends Controller {

	var $components = array('Auth', 'Common', 'Session');
	var $helpers = array('Form', 'Html', 'Time', 'Presentation', 'Session', 'Utility');
	var $uses = array('User', 'Notification');
	
	function beforeFilter(){
		$current_user = $this->Auth->user();
		
		$this->Auth->loginRedirect = 'whispers/list_whispers/incoming';
		$this->Auth->allow('signup','login');
		$this->Auth->authorize = 'controller';		
		
		$this->set('userdata', array('userid' => $this->Auth->user('id'), 'firstname' => $this->Auth->user('firstname'), 'secondname' => $this->Auth->user('secondname'), 'username' => $this->Auth->user('username'), 'profile_image' => $this->Auth->user('profile_image')));
		
		
		$result1 = $this->User->CanSee->find('all', array(
				'conditions' => array(
					'CanSee.user_id' => $current_user['User']['id'],
					'CanSee.seen' => '0'
				)
			)
		);
		$count_new_in = count($result1);
		$result2 = $this->User->BeNotified->find('all', array(
				'conditions' => array(
					'BeNotified.user_id' => $current_user['User']['id']
				)
			)
		);
		$count_new_resp = count($result2);		
		
		$ntf = $this->Notification->find('all', array(
						'conditions' => array(
							'Notification.user_to' => $current_user['User']['id'],
							'Notification.seen' => 0
						)
					)
				);
		$count_ntf = count($ntf);		
				
		$this->set(array('inboxcount' => $count_new_in, 'responsecount' => $count_new_resp, 'notificationcount' => $count_ntf));
		
	}
	
	function isAuthorized() {
		return true;
	}
}
?>