<?
class WhispersController extends AppController{
	
	var $name = 'Whispers';
	var $helpers = array('Form');
	var $uses = array('Whisper', 'User', 'Comment', 'Response');
	var $components = array('RequestHandler');
	var $paginate = array(
		'Comment' => array(
			'limit' => 20,
			'order' => array(
				'Comment.time_created' => 'desc'
			)
		),
		'Whisper' => array(
			'limit' => 20,
			'order' => array(
				'Whisper.time_created' => 'desc'
			)
		)
    );
		
	function ajax_ignore_whisper(){
		$current_user = $this->Auth->user();
		App::import('Helper', 'Time');
		$time = new TimeHelper();
		if($this->RequestHandler->isAjax()) {
			$whisper_id = $_POST['whisper_id'];
			$query = 'select uw.interested from users_whispers as uw where uw.user_id="'.$current_user['User']['id'].'" and uw.whisper_id="'.$whisper_id.'"';
			$data = $this->Whisper->VisibleTo->query($query);
			$flag = $data[0]['uw']['interested'];
			$new = '0';
			if($flag==0){
				$new = '1';
			}
			$query = 'update users_whispers set interested="'.$new.'" where user_id="'.$current_user['User']['id'].'" and whisper_id="'.$whisper_id.'"';
			$this->Whisper->VisibleTo->query($query);
			echo $new;
		}
		$this->autoRender = false;
	}
	
	function new_whisper($id=null){
		$this->set('title_for_layout', 'New Whisper');
		$current_user = $this->Auth->user();
		if($id != null){
			$query = 'select * from users as u, users_users as uu where u.id=uu.user_id_2 and uu.user_id_1="'.$current_user['User']['id'].'" and uu.user_id_2="'.$id.'" and uu.status="1"';
			$res = $this->User->query($query);
			$this->set(array('selected'=>$res));
		}
		else{
			$this->set(array('selected'=>null));
		}
	}
	
	function responses(){
		$current_user = $this->Auth->user();
		$query = 'select w.id from whispers as w, users_whispers as uw where w.id=uw.whisper_id and uw.user_id="'.$current_user['User']['id'].'" and uw.interested="1"';
		$related_whispers = $this->Whisper->query($query);
		
		$list_related_whispers = array();
		for($i=0; $i<count($related_whispers);$i++){
			array_push($list_related_whispers, $related_whispers[$i]['w']['id']);
		}
		
		
		//$query = 'select * from comments as c, whispers as w where c.whisper_id=w.id and c.user_id<>"'.$current_user['User']['id'].'" and w.id in ('.implode(",", $list_related_whispers).') order by c.time_created desc';
		$this->Whisper->recursive = 1;
		$responses = $this->paginate('Comment', array(
							'Comment.user_id <> ' => $current_user['User']['id'],
							'Comment.whisper_id' => $list_related_whispers
						)
					);
	
				
		$commenters = array();
		$new = array();
		$whisper_creators = array();
		
		for($i=0; $i<count($responses);$i++){
			$cid = $responses[$i]['Comment']['id'];
			$wid = $responses[$i]['Comment']['whisper_id'];
			
			$query = 'select * from comments as c, users as u where c.user_id=u.id and c.id="'.$cid.'"';
			$data = $this->Whisper->Comment->query($query);
			$commenters[$cid] = $data;
			
			$query = 'select * from users as u, whispers as w where u.id=w.user_id and w.id="'.$wid.'"';
			$data = $this->Whisper->query($query);
			$whisper_creators[$cid] = $data;
			
			$query = 'select comment_id from responses where user_id="'.$current_user['User']['id'].'" and comment_id="'.$cid.'"';			
			$data2 = $this->Response->query($query);
			if(count($data2)>0){
				$new[$i] = $data2;
			}
		}
		
		$new_set = array();
		for($i=0; $i<count($new);$i++){
			array_push($new_set, $new[$i][0]['responses']['comment_id']);
		}
		
		$this->set(array('responses'=>$responses, 'commenters'=>$commenters, 'new'=>$new_set, 'whisper_creators'=>$whisper_creators));
		
	}
	
	function add_new_whisper(){
		if(!empty($_POST['content'])){
			$current_user = $this->Auth->user();
			$content = $_POST['content'];
			$time_created = date("Y-m-d H:i:s",time()-date("Z"));
			$user_created = $current_user['User']['id'];
			if(!empty($_POST['recipients']) && count($_POST['recipients'])>0){
				$recipients = $_POST['recipients'];
				$data = array('content'=>$content, 'time_created'=>$time_created, 'user_id'=>$user_created);
				$this->Whisper->save($data);
				$whisper_id = $this->Whisper->id;
				for($i=0; $i<count($recipients); $i++){
					$item = $recipients[$i];
					$for_cake = $whisper_id."-".$item;
					$data = array('whisper_id'=>$whisper_id, 'user_id'=>$item, 'seen'=>0, 'interested'=>1, 'for_cake'=>$for_cake);
					$this->Whisper->VisibleTo->save($data);
				}
				
				$item = $user_created;
				$for_cake = $whisper_id."-".$item;
				$data = array('whisper_id'=>$whisper_id, 'user_id'=>$item, 'seen'=>1, 'interested'=>1, 'for_cake'=>$for_cake);
				$this->Whisper->VisibleTo->save($data);
				$this->redirect(array('controller' => 'whispers', 'action' => 'view', $whisper_id));
			}
			else{
				e('Error');
				$this->redirect(array('controller' => 'whispers', 'action' => 'new_whisper'));
			}
		}
		$this->autoRender = false;
	}
	
	function view($id){
		$current_user = $this->Auth->user();
		
		$query = 'select * from whispers w, users as u where w.user_id=u.id and w.id="'.$id.'" order by w.id desc';
		$whisper = $this->Whisper->query($query);
		if(count($whisper)>0){
			$creator_id = $whisper[0]['w']['user_id'];
			
			$query = 'select * from users_whispers uw, users as u where uw.user_id=u.id and uw.whisper_id="'.$id.'" and uw.user_id<>"'.$creator_id.'"';
			$to = $this->Whisper->VisibleTo->query($query);
			
			$query = 'select interested from users_whispers uw, users as u where uw.user_id=u.id and uw.whisper_id="'.$id.'" and uw.user_id="'.$current_user['User']['id'].'"';
			$ignore = $this->Whisper->VisibleTo->query($query);
				
			$query = 'select * from comments as c, users as u where c.user_id=u.id and c.whisper_id="'.$id.'"';
			$comments = $this->Whisper->Comment->query($query);
			
			$comment_id_colection = array();
			for($i=0; $i<count($comments); $i++){
				array_push($comment_id_colection, $comments[$i]['c']['id']);
			}
			
			if(count($comment_id_colection)>0){
				$query = 'delete from responses where user_id="'.$current_user['User']['id'].'" and comment_id in ('.implode(',', $comment_id_colection).')';
				$this->Response->query($query);
			}
			
			$query = 'update users_whispers set seen="1" where whisper_id="'.$id.'" and user_id="'.$current_user['User']['id'].'"';
			$this->Whisper->VisibleTo->query($query);
			
			$updates =  $this->Common->updateCounts();
			
			$this->set(array('whisper'=>$whisper, 'to'=>$to, 'ignore'=>$ignore, 'comments'=>$comments, 'inboxcount'=>$updates['inboxcount'], 'responsecount'=>$updates['responsecount']));
		}
	}
	
	function list_whispers($select='incoming'){
		$current_user = $this->Auth->user();
		if($select == 'incoming'){
			//$query = 'select * from whispers w, users_whispers as uw where w.id=uw.whisper_id and w.user_id<>"'.$current_user['User']['id'].'" and uw.user_id="'.$current_user['User']['id'].'" order by w.id desc';
			//$whispers = $this->Whisper->query($query);
			
			$query = 'select whisper_id from users_whispers where user_id='.$current_user['User']['id'].' and interested=1';
			$data = $this->User->Friend->query($query);
			$collection = $this->Common->singleColumnQueryResultIntoArray($data);
			
			$this->Whisper->recursive = 1;
			$whispers = $this->paginate('Whisper', array(
							'Whisper.user_id <> ' => $current_user['User']['id'],
							'Whisper.id' => $collection
						)
					);
			$ic = 0;
			foreach($whispers as $item){
				$vt = $item['VisibleTo'];
				foreach($vt as $vtitem){
					$ucmp = $vtitem['user_id'];
					if($ucmp == $current_user['User']['id']){
						$whispers[$ic]['VisibleTo'] = array('seen'=>'');
						$whispers[$ic]['VisibleTo']['seen'] = $vtitem['seen'];
						$ic++;
						break;
					}
				}
			}
			//var_dump($whispers[1]);
			$comments = array();
			$creators = array();
			$appreciates = array();
			for($i=0; $i<count($whispers); $i++){
				$wid = $whispers[$i]['Whisper']['id'];
				$wcid = $whispers[$i]['Whisper']['user_id'];
				
				$query = 'select count(*) as comment_count from comments where whisper_id="'.$wid.'"';
				$comment_counts = $this->Whisper->Comment->query($query);
				$comments[$wid] = $comment_counts;
								
				$query = 'select * from users where id="'.$wcid.'"';
				$creator = $this->Whisper->VisibleTo->query($query);
				$creators[$wid] = $creator;
			}
			$this->set(array('whispers' => $whispers, 'comments' => $comments, 'creators' => $creators));
			$this->render('inbox');
		}
		else if($select == 'outgoing'){
			//$query = 'select * from whispers w, users_whispers as uw where w.id=uw.whisper_id and w.user_id="'.$current_user['User']['id'].'" and uw.user_id="'.$current_user['User']['id'].'" order by w.id desc';
			//$whispers = $this->Whisper->query($query);
			
			$query = 'select whisper_id from users_whispers where user_id='.$current_user['User']['id'].' and interested=1';
			$data = $this->User->Friend->query($query);
			$collection = $this->Common->singleColumnQueryResultIntoArray($data);
			
			$this->Whisper->recursive = 1;
			$whispers = $this->paginate('Whisper', array(
							'Whisper.user_id ' => $current_user['User']['id'],
							'Whisper.id' => $collection
						)
					);
			$ic = 0;
			foreach($whispers as $item){
				$vt = $item['VisibleTo'];
				foreach($vt as $vtitem){
					$ucmp = $vtitem['user_id'];
					if($ucmp == $current_user['User']['id']){
						$whispers[$ic]['VisibleTo'] = array('seen'=>'');
						$whispers[$ic]['VisibleTo']['seen'] = $vtitem['seen'];
						$ic++;
						break;
					}
				}
			}
			
			$comments = array();
			$creators = array();
			$appreciates = array();
			for($i=0; $i<count($whispers); $i++){
				$wid = $whispers[$i]['Whisper']['id'];
				$wcid = $whispers[$i]['Whisper']['user_id'];
				
				$query = 'select count(*) as comment_count from comments where whisper_id="'.$wid.'"';
				$comment_counts = $this->Whisper->Comment->query($query);
				$comments[$wid] = $comment_counts;
				
				$query = 'select * from users where id="'.$wcid.'"';
				$creator = $this->Whisper->VisibleTo->query($query);
				$creators[$wid] = $creator;
			}
			$this->set(array('whispers' => $whispers, 'comments' => $comments, 'creators' => $creators));
			$this->render('outbox');
		}
	}
	
	function whisper_to(){
		$current_user = $this->Auth->user();		
		if(!empty($this->data)){
			$current = date("Y-m-d H:i:s",time()-date("Z"));
			$this->data['Whisper']['user_id'] = $this->Auth->user('id');
			$this->data['Whisper']['time_created'] = $current;						
			$this->data['Photo']['user_id'] = $this->Auth->user('id');			
			if(array_key_exists('VT', $this->data) != null && $this->data['Whisper']['content'] != null){
				
				if($this->Whisper->save($this->data)){
				
					$toWhom = $this->data['VT']['VT'];					
					$this->Whisper->VisibleTo->create();
					$whisper_id = $this->Whisper->id;
					$data = array( 'whisper_id' => $whisper_id, 'user_id' => $current_user['User']['id'], 'seen' => '1', 'interested' => '1' );
					$this->Whisper->VisibleTo->save($data);
					
					for($i=0; $i<count($toWhom); $i++){						
						$this->Whisper->VisibleTo->create();
						$whisper_id = $this->Whisper->id;
						$user_id = $toWhom[$i];
						$data = array( 'whisper_id' => $whisper_id, 'user_id' => $user_id, 'seen' => '0', 'interested' => '1' );
						$this->Whisper->VisibleTo->save($data);
					}
										
					$this->Session->setFlash('You have just whispered to your friends');					
				}
				else{
					$this->Session->setFlash('Problem Occured');
					
				}
			}
			else{
				if($this->data['Whisper']['content'] == null){
					$this->Session->setFlash('Write the message');
				}
				else{
					$this->Session->setFlash('Choose whom to whisper');
				}
			}
			$this->redirect(array('controller' => 'users', 'action' => 'home'));
		}		
	}	
	
	function view_original($id){
		$current_user = $this->Auth->user();
		$this->Whisper->recursive = 3;
					
		$result = $this->Whisper->find('all', array(
										'conditions' => array(
											'Whisper.id' => $id
										)
									)
								);
		if($result != NULL){			
			$whisper_id = $result[0]['Whisper']['id'];
			$query = 'select * from whispers as Whisper, users_whispers as UsersWhisper where Whisper.id=UsersWhisper.whisper_id and UsersWhisper.whisper_id="'.$whisper_id.'" and (Whisper.user_id="'.$current_user['User']['id'].'" OR UsersWhisper.user_id="'.$current_user['User']['id'].'")';
			$data = $this->Whisper->query($query);
			if($data != NULL){
				$this->Whisper->VisibleTo->updateAll(array('seen' => '"1"'), array('whisper_id' => $whisper_id, 'user_id' => $current_user['User']['id']));
				$this->Response->deleteAll(array('Response.user_id' => $current_user['User']['id']),false);
				
				$this->set('results',$result);
				$this->set('current_user', $current_user);
			}
			else{
				$this->set('results',NULL);
			}			
		}
		else{
			$this->set('results',NULL);
		}	
	}
	
	function whisper_list($sortingOrder = 'all')
	{
		$current_user = $this->Auth->user();
		if($sortingOrder == 'all'){			
			$this->Whisper->recursive = 0;
						
			$result = $this->Whisper->find('all', array(
											'fields' => array( 'DISTINCT id', 'content', 'time_created', 'user_id', 'CreatedBy.username', 'CreatedBy.name' ),
											'conditions' => array(												
												'OR' => array(
													'VisibleTo.user_id' => $current_user['User']['id'],
													'Whisper.user_id' => $current_user['User']['id']
												)
											),
											'joins' => array(
												array(
													'table' => 'users_whispers',
													'alias' => 'VisibleTo',											
													'conditions' => array(
														'Whisper.id = VisibleTo.whisper_id'
													)
												)
											)
										)
									);
			$this->set('results',$result);
		}
		else if($sortingOrder == 'incoming'){
			$this->Whisper->recursive = 0;
						
			$result = $this->Whisper->find('all', array(
											'fields' => array( 'DISTINCT id', 'content', 'time_created', 'user_id', 'CreatedBy.username', 'CreatedBy.email' ),
											'conditions' => array(												
												'OR' => array(
													'VisibleTo.user_id' => $current_user['User']['id']
												)
											),
											'joins' => array(
												array(
													'table' => 'users_whispers',
													'alias' => 'VisibleTo',											
													'conditions' => array(
														'Whisper.id = VisibleTo.whisper_id'
													)
												)
											)
										)
									);
			$this->set('results',$result);
		}
		else if($sortingOrder == 'sent'){
			$this->Whisper->recursive = 0;
						
			$result = $this->Whisper->find('all', array(
											'conditions' => array(	
												'Whisper.user_id' => $current_user['User']['id']
											)
										)
									);
			$this->set('results',$result);
		}
		else{
			$this->set('results',null);
		}
	}
	
	function _pagination(){
		$data = $this->paginate('Whisper');
		$this->set(compact('data'));
	}
	
}
?>