<?php 
App::import('Sanitize');
class UsersController extends AppController 
{ 
var $name = 'Users';
//var $helpers = array('Html', 'Session');
var $helpers = array('Html', 'Session', 'Form', 'Javascript','Ajax','Fck');
var $components = array('JqImgcrop','Email');	
var $uses = array('User','Articlecategory','Article','Setting','Donation','Country','Wishlist','Updatedmessage','Category','Tempdonation');	
	function beforeFilter() {
		//$this->sociallink();
		//$this->getAdBanner();
	 
	}

	function register($fromfbid=null){  
		  $this->layout='comman';
		  if($this->Session->read('User.id'))
			{
				$this->redirect(array('controller'=>'users','action'=>"profile"));
				}
		if($this->data) 
			{ 
				$data = $this->data;
				//$uploaded = $this->JqImgcrop->uploadImage($data['User']['image'], PROFILE_UPLOAD_URL.'upload_userImages/', 'user_'.time().'_'); 
				//$data['User']['image'] = $uploaded['imageName'];		
				$data['User']['confirm_link'] = LIVE_SITE.'/users/activateAccount/'.base64_encode($data['User']['email']);	
				$this->set('userDetails', $data['User']);
				$data['User']['orgpassword'] = $data['User']['password'];
				$data['User']['password'] = md5($data['User']['password'] );
				$data['User']['confirm_password'] = md5($data['User']['confirm_password'] );
				//$data = Sanitize::clean($data, array('remove' => true));
				//$dataa = mysql_escape_string($data);
				//pr($dataa);
			if($this->User->save($data))
			{	
				$lastinsertid= $this->User->getInsertID();
				$this->Email->to = $data['User']['email'];
				$this->Email->subject = 'Welcome to GoFundMe';
				$this->Email->replyTo = EMAIL_REPLY;
				$this->Email->from = 'GoFundMe admin<norepley@softprodigy.com>';
				$this->Email->template = 'basic'; 
				$this->Email->sendAs = 'both';
				if($this->Email->send()){
								$this->Session->setFlash('Registration completed. Please verify your account from your email id.', 'default', array('class' => 'errMsgLogin'));
								
							}			
			$this->redirect(array('controller'=>'users','action'=>"login"));
			}
			else
			{
				$this->Session->setFlash('Registration can not completed.', 'default', array('class' => 'errMsgLogin'));
			}
			
		} 
	}
		/*Function Name: activateAccount
		 * Functionality : activateAccount function is used active the account when user confirm his email id through line send in email.
		 * */	
		function activateAccount($confirmationCode=null)
		{
			
			if(!empty($confirmationCode))
			{	//pr($confirmationCode);die;
				$email=base64_decode($confirmationCode);
				$user = $this->User->find('first',array('conditions'=>array('User.email'=>$email))); 
				//pr($email);die;
				if($this->Session->check('User')){
					if($this->Session->read('User.userID') != $user['User']['id'])
					{
						$this->Session->delete('User');
						$this->Session->destroy();
					}
				}
				if(!empty($user))
					{ 
					if($user['User']['email_confirmation'] != 1){
						$this->data['User']['id']=$user['User']['id'];
						$this->data['User']['email_confirmation']=1;
						$this->data['User']['status']=1;
						if($this->User->save($this->data))
						{
							$this->Session->setFlash('Thanks for the Confirmation.', 'default', array('class' => 'errMsgLogin'));
							if($this->Session->check('User.userID')){
								$this->redirect('/users/login');
							}else{
								$this->redirect('/users/login');
							}
						}
					}else{
						$this->Session->setFlash('Email confirmation link has been expired.', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('/users/login');
					}
				}		
				
			}
			die;
		}
			
			
		function login() {
	
				$this->layout='comman';
				if($this->Session->read('User.id'))
					{
						$this->redirect(array('controller'=>'users','action'=>"profile"));
					}
				if(($user = $this->User->checkAuthorization($this->data['User'])) == true){
					$this->Session->write('User.id', @$user['id']);
					$this->Session->write('User.username', @$user['username']);
					$this->Session->write('User.email', @$user['email']);
				}
					if($this->data){//pr($this->data);die;
						if($this->data['User']['email']=='' && $this->data['User']['password']==''){
							$this->Session->setFlash('Please enter email and password', 'default', array('class' => 'errMsgLogin'));
				}else if ($this->data['User']['email'] !='' && $this->data['User']['password']==''){
					$this->Session->setFlash('Please enter password', 'default', array('class' => 'errMsgLogin'));
					
				}else if ($this->data['User']['email'] =='' && $this->data['User']['password'] !=''){
					$this->Session->setFlash('Please enter email', 'default', array('class' => 'errMsgLogin'));
					
				}else{
					if($this->data['User']['email'] !='' && $this->data['User']['password'] !=''){ 
						$user = $this->User->checkAuthorization($this->data['User']);
						if($user){
							if($user != 1 && $user != 2){
								$this->Session->write('User.id', @$user['id']);
								$this->Session->write('User.username', @$user['username']);
								$this->Session->write('User.email', @$user['email']);
								$this->redirect('profile');
								
							}
							else if($user == 2){
								$this->Session->setFlash('Your account has been disabled by super admin.', 'default', array('class' => 'errMsgLogin'));		
							}else if($user == 1){
									$this->Session->setFlash('Please verify your email address and then login again.', 'default', array('class' => 'errMsgLogin'));		
							}
						}else{
							$this->Session->setFlash('Please enter valid email/Password.', 'default', array('class' => 'errMsgLogin'));
						}  	
					}
				}
			}

		}
		/*
		* Name : profile
		* Description : used to show user profile page.	
		*/
		function profile(){
			$this->layout	= 'comman'; 
				if (!$this->Session->read('User.id')) {
					$this->redirect(array('action'=>'login'));
				}
					$id=$this->Session->read('User.id');
			if(empty($id))
				{
					$this->Session->write('User.id',$_SESSION['id']);	
				}
			if(($id=$this->Session->read('User.id'))){
				$email=$this->Session->read('User.email');
				$details = $this->User->find('first', array('conditions' => array('User.id' => $id)));
				$this->set('userdetail',$details);
				} else {
					$this->redirect(array('action'=>'login'));
					}
			}
			/*
		* Name : editprofile
		* Description : used to edit user profile
		*/
		
		
		function editprofile($aid = null){
			$this->layout	= 'comman'; 
			if (!$this->Session->read('User.id')) {
				$this->redirect(array('action'=>'login'));
			}
				$id=$this->Session->read('User.id');
				
				$details = $this->User->find('first', array('conditions' => array('User.id' => $id)));
				$this->set('userdetail',$details);
				if($this->data){
					if ($this->User->validates()) {//die('here');
						$data=$this->data;
						$this->User->id=$id;
			        if($this->User->save($data)){
						$this->Session->setFlash('Profile updated Successfully.', 'default', array('class' => 'errMsgLogin'));
						$this->redirect(array('controller'=>'users','action'=>"profile"));	
					}	
				}
				else
				{
					$this->render();
				}
			}
				
			}
					/*
		* Name : changepass
		* Description : used to update user Password
		*/
	
			function changepass()
			{
				$id=$this->Session->read('User.id');
				$oldp=$_POST['oldpassword'];
				$new=$_POST['newpassword'];
				$md5new=md5($_POST['newpassword']);
				$this->data['User']['orgpassword']=$_POST['newpassword'];
				$this->data['User']['password']=md5($_POST['newpassword']);
				$this->User->id=$id;
				$datas = $this->User->find('first', array('conditions' => array('User.id' => $id,'User.orgpassword' => $oldp)));
					if($datas)
						{	
							$res=mysql_query("UPDATE users SET password ='$md5new',orgpassword='$new' WHERE id = '$id'");
							$this->Session->setFlash('Password updated Successfully.', 'default', array('class' => 'errMsgLogin'));
							echo "1";
						} else {
								
							echo "2";
						
						  }
					die;	  
				}
			/*
		* Name : nl2p
		* Description : This is used for paragraph spaning 		*/		
			function nl2p($str) {
				$arr=explode("\n",$str);
				$out='';

			for($i=0;$i<count($arr);$i++) {
				if(strlen(trim($arr[$i]))>0)
				$out.='<p>'.trim($arr[$i]).'</p>';
				}
				return $out;
			}	
			
			
				function nl2p1($str1) {
				$arr=explode("\n",$str1);
				$out='';

			for($i=0;$i<count($arr);$i++) {
				if(strlen(trim($arr[$i]))>0)
				$out.='<p>'.trim($arr[$i]).'</p>';
				}
				return $out;
			}		
					
		/*
		* Name : createarticle
		* Description : This is used for creating article
		*/
		function createarticle(){
			App::import('Vendor','wepay');
			$client_id = CLIENTID;
			$client_secret = CLIENTSECRET;
			Wepay::useStaging($client_id, $client_secret);
			$wepay = new WePay($accessToken = null);
			$this->layout='comman';
			if (!$this->Session->read('User.id')) {
				$this->redirect(array('action'=>'login'));
			}
			else
			{   $aid = $this->Session->read('User.id');
				$details = $this->User->find('first', array('conditions' => array('User.id' => $aid)));
				$this->set('userdetail',$details);
				if(empty($details['User']['address']) && empty($details['User']['address']))
				{
					$this->Session->setFlash('Please provide your details before creating article.', 'default', array('class' => 'errMsgLogin'));
					$this->redirect(array('controller'=>'users','action'=>'editprofile/'.$aid));
				}
			}
			if(!empty($this->data))
				{
					$data=$this->data;
					$id=$this->Session->read('User.id');
					$details = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
					$this->set('userDetails', $details['User']);
					$email = $details['User']['email'];
					$data['Article']['user_id']=$details['User']['id']; 
					$uploaded = $this->JqImgcrop->uploadImage($data['Article']['image'], PROFILE_UPLOAD_URL.'upload_bannerImages/', 'Article'.time().'_'); 
					$data['Article']['image'] = $uploaded['imageName'];	
					$data['Article']['author'] = 'user';
						$response = $wepay->request('user/register/', array(
						'client_id'        => $client_id,
						'client_secret'    => $client_secret,
						'email'            => $email,
						'scope'            => 'manage_accounts,collect_payments,view_user,manage_subscriptions,preapprove_payments,send_money',
						'first_name'       => $details['User']['firstname'],
						'last_name'        => $details['User']['lastname'],
						'original_ip'      => $_SERVER['SERVER_ADDR'],
						'original_device'  => $_SERVER['HTTP_USER_AGENT']
						));
						$data['User']['wepayUserID'] = $response->user_id;
						$data['User']['wepayAccesstoken'] = $response->access_token;
						$wepay = new WePay($data['User']['wepayAccesstoken']);
						$responseNew = $wepay->request('account/create/', array(
						'name'         => $data['Article']['title'],
						'description'  => $data['Article']['description']
						));
						$data['User']['wepayAccountID'] = $responseNew->account_id;
						$data['User']['wepayState'] = $responseNew->state;
						if($data['User']['wepayState'] == 'pending')
						{
						$responseFinal = $wepay->request('user/resend_confirmation/', array(
						'email_message' => 'WePay is a GoFundMe partner that helps you safely and easily access your money.
											In order to process gifts to your GoGundMe fundraiser, please confirm your email address with WePay.'
						)); 
						//pr($data['User']['wepayState']);
						$this->User->id = $id;
						if($this->User->save($data))
							{
								if($this->Article->save($data))
									{
										$this->Session->setFlash('Article cretated succesfully.please check your email for details.', 'default', array('class' => 'errMsgLogin'));
										$this->redirect(array('controller'=>'users','action'=>"createarticle"));
									}
							}
						}else if($data['User']['wepayState'] == 'action_required')
						{
									$this->User->id = $id;
									if($this->User->save($data))
										{
										if($this->Article->save($data))
											{
												$this->Session->setFlash('Article cretated succesfully.', 'default', array('class' => 'errMsgLogin'));
												$this->redirect(array('controller'=>'users','action'=>"createarticle"));
								}
							}
						}
			}
		}
		
		/*
		* Name : Edit Article
		* Description : This is used for editing the article created by user
		*/
		function editarticle($aid=''){//pr($aid);die;
			$this->layout='comman';
			$sessionId = $this->Session->read('User.id');
			if (!$sessionId) {
				$this->redirect(array('action'=>'login'));
			}
			$articleinfo=$this->Article->find('first',array('conditions'=>array('Article.id'=>$aid)));
			//pr($articleinfo);
			if($sessionId == $articleinfo['User']['id'])
			{
			$this->set('articleinfo',$articleinfo);	
			if(!empty($this->data))
				{
					$data=$this->data;
					if(isset($data['Article']['image']['name']) && !empty($data['Article']['image']['name'])){	//pr('ok1');die;
						$uploaded = $this->JqImgcrop->uploadImage($data['Article']['image'], PROFILE_UPLOAD_URL.'upload_bannerImages/', 'Article'.time().'_'); 
						$this->set('uploaded',$uploaded); 
						$data['Article']['image'] = $uploaded['imageName'];
					}
					else{
						$data['Article']['image'] = $articleinfo['Article']['image'];
					}
					if(isset($articleinfo['Article']['image']['name']) && !empty($articleinfo['Article']['image']))//die('ok1');
						$imageToUnlik = PROFILE_UPLOAD_URL.'upload_bannerImages/'.$articleinfo['Article']['image'];
					if(isset($imageToUnlik) && !empty($data['Article']['image']['name'])){
						@unlink($imageToUnlik);//die('ok');
					}
	
					$id=$this->Session->read('User.id');
					$details=$this->User->find('first',array('conditions'=>array('User.id'=>$id)));
					$this->set('userDetails', $details['User']);
					$email=$details['User']['email'];
					$data['Article']['user_id']=$details['User']['id']; 
					$data['Article']['zip']=$details['User']['zip'];
					$data['Article']['username']=$details['User']['username'];
					$data['Article']['author'] = 'user';	
				//pr($data);die;
				$this->Article->id=$aid;
				if($sessionId == $articleinfo['User']['id'])
				{
					if($this->Article->save($data))
						{
									$this->Session->setFlash('Article updated succesfully', 'default', array('class' => 'errMsgLogin'));
									$this->redirect(array('controller'=>'users','action'=>"viewmyarticle"));
							}
					}else
						{
							$this->Session->setFlash('You are not valid user to update this article', 'default', array('class' => 'errMsgLogin'));
						}
			
					}
			}else
			{
				$this->redirect(array('controller'=>'users','action'=>"404"));
			}
			}
		/*
		* Name : updatemessage
		* Description : This is used for updatemessage for any article created by user.
		*/
		function updatemessage($aid){//pr($aid);
			$this->layout='comman';
			if (!$this->Session->read('User.id')) {
				$this->redirect(array('action'=>'login'));
			}
			$articleinfo=$this->Article->find('first',array('conditions'=>array('Article.id'=>$aid)));
			//pr($articleinfo);die('here');
			$this->set('articleinfo',$articleinfo);	
			if(!empty($this->data))
				{
					$data=$this->data;
					//pr($data);
					/*if(isset($data['Updatedmessage']['image']['name']) && !empty($data['Updatedmessage']['image']['name'])){	//pr('ok1');die;
						$uploaded = $this->JqImgcrop->uploadImage($data['Updatedmessage']['image'], PROFILE_UPLOAD_URL.'upload_bannerImages/', 'Article'.time().'_'); 
						$this->set('uploaded',$uploaded); 
						$data['Updatedmessage']['image'] = $uploaded['imageName'];
					}*/
						$str=$data['Updatedmessage']['description'];
						$data['Updatedmessage']['description']=$this->nl2p($str);
						$data['Updatedmessage']['article_idd']=$aid;
						//pr($data);die;
						if($this->Updatedmessage->save($data))
							{
								$this->Session->setFlash('Message added succesfully', 'default', array('class' => 'errMsgLogin'));
								$this->redirect(array('controller'=>'users','action'=>'editarticle/'.$aid));
							/*}*/
						
					}
				}
			}
		function articlecategory()
						{
							$articlecategory = $this->Category->find('all', array('conditions' => array('Category.status' => 1), 'order' => array('Category.category ASC')));
							//pr($articlecategory);
							$newList[null]="Select Category";
							foreach($articlecategory as $articles){
								$newList[$articles['Category']['id']] = $articles['Category']['category'];
							}
							return($newList);
						}
						
					
		function viewmyarticle(){//die('sdf');
			$this->layout='comman';
			if (!$this->Session->read('User.id')) {
				$this->redirect(array('action'=>'login'));
			}
			$id=$this->Session->read('User.id');
			$this->paginate=array(
							'conditions' => array('Article.user_id' => $id,'Article.status' => 1),
							'limit' => 12,
							'order'=>array('Article.id'=>'DESC')
							);	
			$myarticle = $this->paginate('Article');
			$this->set('myarticles',$myarticle);				
			$this->paginate=array(
							'conditions' => array('Article.user_id' => $id,'Article.status' => 0),
							'limit' => 12,
							'order'=>array('Article.id'=>'DESC')
							);		
			$myarticled = $this->paginate('Article');
			$this->set('myarticlesd',$myarticled);
			
			$this->paginate=array(
							'conditions' => array('Wishlist.user_id' => $id,'Article.status' => 1),
							'limit' => 12,
							'order'=>array('Wishlist.id'=>'DESC')
							);		
			$wishlistarticle = $this->paginate('Wishlist');
			//pr($wishlistarticle);die('fdsfds');
			$this->set('wishlistarticles',$wishlistarticle);						
			
		}
		
		/*
		* Name : deleteArticle
		* Description : This is used for deleteArticle cretaed  by its author
		*/
	
		
		function deleteArticle($articleid=null){//pr($articleid);die('sdf');
			$this->layout='comman';
			if (!$this->Session->read('User.id')) {
				$this->redirect(array('action'=>'login'));
			}
			$this->Article->delete(array('Article.id'=>$articleid));
			die();
			
		}
			/*
		* Name : deleteWishlist
		* Description : This is used for delete Wishlist created  by its author
		*/
	
		
		function deleteWishlist($wisglistid=null){//pr($wisglistid);die('sdf');
			$this->layout='comman';
			if (!$this->Session->read('User.id')) {
				$this->redirect(array('action'=>'login'));
			}
			$this->Wishlist->delete(array('Wishlist.id'=>$wisglistid));
			die();
			
		}
		
		
		/*
		* Name : deactivateArticle
		* Description : This is used for deactivateArticle by its author
		*/
		
		function deactivateArticle($id=null)
			{
				if (!$this->Session->read('User.id')) 
					{
						$this->redirect(array('action'=>'login'));
					}
				if(!empty($id))
					{
						$existingStatus = $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
						$status = $existingStatus['Article']['status'];
					if($status == 1)
						{
							$finalStatus = 0;
					}else{
						$finalStatus = 1;
					}
						$this->Article->id = $id;
						$data['Article']['status'] = $finalStatus;
						if($this->Article->save($data)){
						die;
						}
					}
				}
		/*
		* Name : activateArticle
		* Description : This is used for deactivateArticle bu user
		*/
		
		function activateArticle($id=null)
			{
				if (!$this->Session->read('User.id')) 
				{
					$this->redirect(array('action'=>'login'));
				}
				if(!empty($id))
				{
					$existingStatus = $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
					$status = $existingStatus['Article']['status'];
					if($status == 1)
						{
							$finalStatus = 0;
					}else{
						$finalStatus = 1;
					}
						$this->Article->id = $id;
						$data['Article']['status'] = $finalStatus;
						if($this->Article->save($data)){
						die;
					}
				}
			}

		/*
		* Name : wishlist
		* Description : This is used for add article to wishlist List bu user
		*/
		function wishlist($id=null)
			{
				$session_uid=$this->Session->read('User.id');
				$createtime=date('Y-m-d H:i:s');
				$updatetime=date('Y-m-d H:i:s');
			if(!empty($session_uid))
			{
				$wishdata=$this->Article->find('first', array('conditions' => array('Article.id' => $id)));
				$update = $this->Wishlist->find('first', array('conditions' => array('Wishlist.user_id' =>$session_uid,'Wishlist.article_id' => $id)));
				if(!empty($update))
				{
					
					echo "404";
					die;
				}
				else
				{
					$wishdata['Wishlist']['user_id']=$session_uid;
					$wishdata['Wishlist']['author_id']=$wishdata['Article']['user_id'];
					$wishdata['Wishlist']['article_id']=$id;
					$wishdata['Wishlist']['created']=$createtime;
					//pr($wishdata);die('create');
					$this->Wishlist->save($wishdata);
					die;
				}
			}
			else
			{
				echo "405";
				die;
			}
		}
	
		/*
		* Name : success
		* Description : This is used for listing all the article that has successfully completed.
		*/
		function success()
			{
				$this->layout='comman';
				$sucess = $this->Article->query("select * , month(date) as cmonth from articles where totaldonation > amount order by month(date) DESC");
				$this->set('sucessdata',$sucess);
			}	
	
		function articledetail($id){//die('dssdf');
			$this->layout='articledetailpage';
			$articledetail = $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
			//pr($articledetail);die;
			$this->set('articledetail',$articledetail);
			
			$this->paginate=array('conditions' => 
							array('Donation.article_id' => $id),
								'order'=>array('Donation.id'=>'DESC'));
			$donationdetail = $this->paginate('Donation');
			$this->set('donationdetail',$donationdetail);
				$vals = null;
				//pr($donationdetail);
				foreach($donationdetail as $key=>$val)
						{//echo $key;die('here');
							$time = strtotime($val['Donation']['date']);
							$vals[$key]['Donation']['id']=$val['Donation']['id'];
							$vals[$key]['Donation']['article_id']=$val['Donation']['article_id'];
							$vals[$key]['Donation']['amount']=$val['Donation']['amount'];
							$vals[$key]['Donation']['firstname']=$val['Donation']['firstname'];
							$vals[$key]['Donation']['lastname']=$val['Donation']['lastname'];
							$vals[$key]['Donation']['hideinfo']=$val['Donation']['hideinfo'];
							$vals[$key]['Donation']['email']=$val['Donation']['email'];
							$vals[$key]['Donation']['country']=$val['Donation']['country'];
							$vals[$key]['Donation']['zip']=$val['Donation']['zip'];
							$vals[$key]['Donation']['image']=$val['Donation']['image'];
							$vals[$key]['Donation']['comment']=$val['Donation']['comment'];
							$vals[$key]['Donation']['time']= $this->elapstime($time);
						}
			$this->set('vals',$vals);
			$this->paginate=array('conditions' => 
							array('Donation.article_id' => $id),
								'order'=>array('Donation.amount'=>'DESC'));
			$donationdetailHigest = $this->paginate('Donation');
			$this->set('donationdetailHigest',$donationdetailHigest);
				$valsHigest = null;
				foreach($donationdetailHigest as $key=>$valHigest)
						{
							$time = strtotime($valHigest['Donation']['date']);
							$valsHigest[$key]['Donation']['id']=$valHigest['Donation']['id'];
							$valsHigest[$key]['Donation']['article_id']=$valHigest['Donation']['article_id'];
							$valsHigest[$key]['Donation']['amount']=$valHigest['Donation']['amount'];
							$valsHigest[$key]['Donation']['firstname']=$valHigest['Donation']['firstname'];
							$valsHigest[$key]['Donation']['lastname']=$valHigest['Donation']['lastname'];
							$valsHigest[$key]['Donation']['hideinfo']=$valHigest['Donation']['hideinfo'];
							$valsHigest[$key]['Donation']['email']=$valHigest['Donation']['email'];
							$valsHigest[$key]['Donation']['country']=$valHigest['Donation']['country'];
							$valsHigest[$key]['Donation']['zip']=$valHigest['Donation']['zip'];
							$valsHigest[$key]['Donation']['image']=$valHigest['Donation']['image'];
							$valsHigest[$key]['Donation']['comment']=$valHigest['Donation']['comment'];
							$valsHigest[$key]['Donation']['time']= $this->elapstime($time);
						}
			$this->set('valsHigest',$valsHigest);
			$articleupdate = $this->Updatedmessage->find('all', array('conditions' => array('Updatedmessage.article_idd' => $id),'order'=>array('Updatedmessage.id'=>'DESC')));
			$valss = null;
			foreach($articleupdate as $key=>$vall)
						{	//pr($vall);
							$time = strtotime($vall['Updatedmessage']['date']);
							$valss[$key]['Updatedmessage']['id']=$vall['Updatedmessage']['id'];
							$valss[$key]['Updatedmessage']['article_idd']=$vall['Updatedmessage']['article_idd'];
							$valss[$key]['Updatedmessage']['description']=$vall['Updatedmessage']['description'];
							$valss[$key]['Updatedmessage']['time']= $this->elapstime($time);
						}
			
			$this->set('articleupdates',$valss);
			
		}
		function elapstime ($time)
			{//pr($time);die('sd');
				$time = time() - $time; // to get the time since that moment
				$tokens = array (
				31536000 => 'year',
				2592000 => 'month',
				604800 => 'week',
				86400 => 'day',
				3600 => 'hour',
				60 => 'min',
				1 => 'sec'
				);
					foreach ($tokens as $unit => $text) 
						{
							if ($time < $unit) continue;
							$numberOfUnits = floor($time / $unit);
							//pr($numberOfUnits);die;
							return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
							
						}
			}
		
		/*
		* Name : getCountry
		* Description : Used for listing the country.	
		*/
			
		function getCountry(){
		$order = array('order'=>array('Country.countryCode'=>'ASC'));
		$countrys = $this->Country->find('all',$order); 
		$countryList = array();
		//pr($countrys);die;
		foreach($countrys as $cntry){ 
			$countryList[$cntry['Country']['idCountry']] = $cntry['Country']['countryName'];
		} 
		return $countryList;
	}	
		
		/*
		* Name : donation
		* Description : Used for DONATION ON ARTICLE.	
		*/ 
		 function donation($id){//pr($this->data);
			$data = $this->data;
			$this->layout='articledetailpage';
			if ($this->Session->read('User.id')) {
				$userid			= $this->Session->read('User.id');
				$userinfo 		= $this->User->find('first', array('conditions' => array('User.id' => $userid)));
				$this->set('userinfo',$userinfo);
				$articledetail 	= $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
				$this->set('articledetail',$articledetail);
				if($this->data) 
						{ 	
							$data = $this->data;
							
							/*if(!empty($data['Tempdonation']['image']['name']))
							{
								$uploaded = $this->JqImgcrop->uploadImage($data['Tempdonation']['image'], PROFILE_UPLOAD_URL.'upload_userImages/', 'user_'.time().'_'); 
								$data['Tempdonation']['image'] = $uploaded['imageName'];
							}
							else
							{
								$data['Tempdonation']['image']='';
							}*/
								$data['Tempdonation']['article_id']=$id;
								//pr($data);die('here');
								if($this->Tempdonation->save($data))
									{	
									$lastid = $this->Tempdonation->getLastInsertId();
									//pr($lastid);die;
									$this->redirect(array('controller'=>'users','action'=>'payment/'.$id.'/'.$lastid));
								}
						}
			}
				else{
					$articledetail 	= $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
					$this->set('articledetail',$articledetail);
					if($this->data) 
						{ 	
							$data = $this->data;
								$data['Tempdonation']['article_id']=$id;
								//pr($data);die('here');
								if($this->Tempdonation->save($data))
									{	
									$lastid = $this->Tempdonation->getLastInsertId();
									//pr($lastid);die;
									$this->redirect(array('controller'=>'users','action'=>'payment/'.$id.'/'.$lastid));
								}
						}
					}
				}
		
		
		/*
		* Name : facebooklogin
		* Description : Used for facebook login.	
		*/       
		function fblogin() {
		App:: import('Vendor', '/src/facebook');
		$facebook = new Facebook(array( 'appId'  => FB_APP_ID, 'secret' => FB_APP_SECRET, 'cookie' => true, ));
		$uid = $facebook->getUser();
		$profile = null;
		if($uid){
			try {
					$profile = $facebook->api('/me');                                 
					$access_token = $facebook->getAccessToken();       
			} catch (FacebookApiException $e) {
					$fberror = serialize($e);
					$errortext = urlencode($fberror);
					$uid=null;
			}
		}
		$fb_data = array('me' => $profile, 'uid' => $uid, 'loginUrl' => $facebook->getLoginUrl(array( 'scope'=> 'read_stream,user_hometown,user_location,email,read_insights,publish_stream,user_photos,read_friendlists,friends_online_presence,offline_access,user_activities,friends_activities,user_work_history' )), 'logoutUrl' => $facebook->getLogoutUrl(), );  
		if(isset($fb_data['me']) && !empty($fb_data['me'])) {
		$me         =        $fb_data; 
		$userId		=      $me['uid'];
		$userEmail=$me['me']['email'];
		$userName=$me['me']['name'];
		$userDetail = $this->User->find('first',array('conditions'=>
					array( 
						'OR'=>array(
						'User.fbUniqueID' => $userId,
						'User.email' => $userEmail
						  ))));
		if($userDetail)
		    {
		    $this->Session->write('User.id', @$userDetail['User']['id']);
		    $this->redirect(array('controller'=>'users','action'=>'profile'));			   
		    }		
  
		//$status = $this->User->checkExistingUser($me['me']['email']);
		if(!empty($userDetail))         // email not exist on database
		{

			$this->Session->setFlash('User allready exist!', 'default', array('class' => 'errMsgLogin'));
		}
		else
		{			
			$fname=$me['me']['first_name'];
			$lname=$me['me']['last_name'];
			$username=$me['me']['name'];
			$email=$me['me']['email'];
			$gender=$me['me']['gender'];
			$address=$me['me']['location']['name'];
			$fbuniqid=$me['uid'];
			$password='000';
			$zipcode='000';
			$contact='000';
			//$image='null';
			$status=1;
			$emailverification=1;
			
			$fbpic =  'https://graph.facebook.com/'.$fbuniqid.'/picture?width=350&height=350'; // //Fetch The facebook profile picture
			//pr($fbpic);die;
			$imgfileName = 'fb_'.$fbuniqid.'_pic.jpg';
			$content = file_get_contents($fbpic);
			//pr ($content);die;
			
			file_put_contents(PROFILE_UPLOAD_URL."upload_userImages/$imgfileName", $content);
			$image=$imgfileName;
		    $events=$this->User->query("insert into users(firstname,lastname,username,email,gender,address,password,zip,contact,image,status,email_confirmation,fbUniqueID,twUniqueID,isFBorTwitter) values
		('$fname','$lname','$username','$email','$gender','$address','$password','$zipcode','$contact','$image','$status','$emailverification','$fbuniqid','null','facebook')");
		     $sessid= mysql_insert_id();
			if($events)
			    {
			    $this->Session->write('User.id', @$sessid);
			    $this->redirect(array('controller'=>'users','action'=>'profile'));			   
			  } else {
			     $this->redirect(array('controller'=>'users','action'=>'register'));
			      }
		}
		
	}
		else {

		$loginUrl = $facebook->getLoginUrl(array(
		'scope'=> 'read_stream,user_hometown,user_location,email,read_insights,publish_stream,user_photos,read_friendlists,friends_online_presence,offline_access,user_activities,friends_activities,user_work_history'
		));
		$this->redirect($loginUrl);

		}
		}
		
		/*
		* Name : update
		* Description : This function is used for updating the user profile.	
		*/		
		function update(){  
			$this->layout='comman';
			$id=$this->Session->read('User.id');
			$details = $this->User->find('first', array('conditions' => array('User.id' => $id)));
			$this->set('userdetail',$details);
			if($this->data){
				$this->User->id=$id;
			        //unset($this->User->validate['username']);
			        if($this->User->save($this->data)){
					$this->redirect(array('controller'=>'users','action'=>"profile"));	
					}	
				}
				else
					{
					//die('test');	
					}
				}
		// end here
		/*
		* Name : logout
		* Description : This function is used for distroy the session and logout user .	
		*/
		function logout(){
			$this->Session->destroy();
			$this->Session->setFlash('You have successfully logged out.', 'default', array('class' => 'errMsgLogin'));
			$this->redirect('/users/login');
			}
		// end here

		/*
		* Name : createRandomPassword
		* Description : This function is used for Creating the random password.	
		*/
		function createRandomPassword(){
			$chars = "abcdefghijkmnopqrstuvwxyz023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;
			while ($i <= 7){
				$num = rand() % 33;

							$tmp = substr($chars, $num, 1);

							$pass = $pass . $tmp;

							$i++;
							}
							return $pass;
						}
		// end here	
		
		/*
		* Name : forgotPassword
		* Description : This function is used for Sending user new password.	
		*/
		function forgotPassword(){
			$this->layout='comman';
			//$this->getuserAds();
			if($this->Session->read('User.id'))
					{
						$this->redirect(array('controller'=>'users','action'=>"profile"));
					}
			if(!empty($this->data)){
			$data = $this->data;
			$email = $data['User']['email'];
			$userDetail = $this->User->find('first',array('conditions'=>array("User.email "=> $email)));
			if($email==null){
				echo $email;
				$this->Session->setFlash('Please enter your email!', 'default', array('class' => 'errMsgLogin'));
			}
			else{ 
				$userID = $userDetail['User']['id'];
             			$data = $this->data;
				$email_to = $data['User']['email'];
				if($userDetail['User']['email'] == ($email)){
					$password= $this->createRandomPassword();
					$new_password=md5($password);
					$this->User->id = $userID;
					$this->data['User']['password'] = trim($new_password);
					$this->data['User']['orgpassword'] = trim($password);
					unset($this->User->validate['password']);
 					unset($this->User->validate['confirm_password']);
					if($this->User->save($this->data)){
						//Default Mail component is called, to send mail. We are setting the variables for sending email
						$this->Email->to = $email_to;
						//$this->Email->bcc = array($adminEmail);
						$this->Email->subject = 'Your password here';
						$this->Email->replyTo = EMAIL_REPLY;
						$this->Email->from = "GoFundMe admin <".EMAIL_REPLY.">";
						//Here, the element in /views/elements/email/html/ is called to create the HTML body
						$this->Email->template = 'simple_message'; // note no '.ctp'
						//Send as 'html', 'text' or 'both' (default is 'text')
						$this->Email->sendAs = 'both'; // because we like to send pretty mail
						//Set view variables as normal
						$this->set('userDetail', $userDetail);
						$this->set("password", $password);
						//Do not pass any args to send()
						if($this->Email->send()){
							$this->Session->setFlash('Password Sent Successfully!', 'default', array('class' => 'errMsgLogin'));
							$this->redirect(array('controller'=>'users','action'=>"forgotpassword"));
						}
					}
				}
				else{ 
					$this->Session->setFlash('Please enter valid email', 'default', array('class' => 'errMsgLogin'));
				}
			}
		} 
	}
		
		function home(){
			
			}

		/*
		* Name : viewprofile
		* Description : This is used for showing the user profile.
		*/
		function viewprofile($upid=null){
			$this->layout='comman';
			$id=$upid;
			
			$session_data = $this->Session->read('User.id');
			
			$this->set('loggeduid',$session_data);
				
			$viewprofile = $this->User->find('first', array('conditions' => array('User.id' => $id)));
			$this->User->id = $id;
			
			$this->set('viewprofile',$viewprofile);
			
			}
	
		
		/*
		* Name : viewusers
		* Description : This is used for all the users list to wich you send the invitations.
		*/
		function viewusers(){
			$this->layout='comman';
		//	$this->getuserAds();
		
			if (!$this->Session->read('User.id')) {
				$this->redirect(array('action'=>'login'));
			}
			$sess_data = $this->Session->read('User.id');
			//pr($sess_data);die;
			//$userId = $sess_data['User']['id'];
			//pr($sess_data);die;
			$this->set('loggeduid',$sess_data);
			$searchword=trim($this->data['User']['searchword']);
		
			$users= $this->User->find('all',array('conditions'=>array('User.status'=>'1','User.id !='=>$this->Session->read('User.id'),'OR'=>array('User.firstname LIKE'=>"%$searchword%",'User.lastname like'=>'%$searchword%','User.email like'=>'%$searchword%')), 'group' => 'User.id'));

			$this->set('users',$users);
		}
		// end here

	
	
		function updateimage(){			
			$file = isset($_FILES['uploadFile']['name']) ? $_FILES['uploadFile'] : '';
			$fileArr = explode("." , $file["name"]);
			$ext = $fileArr[count($fileArr)-1];
			$allowed = array("jpg", "jpeg", "png", "gif", "bmp");
 			$name = USER_IMAGE.$_FILES['uploadFile']['name'];
			//print_r($name);die('here');
			$id=$this->Session->read('User.id');
			$data['id'] = $id;
			$data['image'] = $_FILES['uploadFile']['name'];
			$this->User->save($data);
			move_uploaded_file($_FILES['uploadFile']['tmp_name'],$name);
			echo $_FILES['uploadFile']['name'];
			die;
			}
		// end here
		


		/*
		* Name : searchforuser
		* Description : This is used for searching user.
		*/
		function searchforuser(){	
			$this->layout = false;
			$id=$this->Session->read('User.id');
			$q=$_REQUEST['searchword'];
			//pr($q);die;
			$search=$this->User->query("select id,firstname,lastname,email,image from users where(firstname like '%$q%' or lastname like '%$q%' or email like '%$q%') and (status=1) order by id LIMIT 5");
		//pr($search); die;
		$this->set('search',$search);
		$this->set('q',$q);
		$html=$this->render();
		echo $html;
		die;
	}
					
			function getuserdetail()
						{
							$id=$this->Session->read('User.id');
							$getdata = $this->User->find('first', array('conditions' => array('User.id' => $id)));
							return($getdata);
							$articlesCount=count($this->Article->find('all', array('conditions' => array('Article.user_id' => $id))));
							return($articlesCount);
						}
			function getArticleCount()
			{
				$id=$this->Session->read('User.id');
				$articlesCount=count($this->Article->find('all', array('conditions' => array('Article.user_id' => $id))));
				return($articlesCount);
			}
		
		/********Setting End*********/
			/***************Start Payment integration*************************/
	function payment($aid,$lid)
		{ 	
			$this->layout='articledetailpage';
			App::import('Vendor','wepay');
			$client_id = CLIENTID;
			$client_secret = CLIENTSECRET;
			$articledetail 	= $this->Article->find('first', array('conditions' => array('Article.id' => $aid)));
			$this->set('articledetail',$articledetail);
			$access_token = $articledetail['User']['wepayAccesstoken'];
			$account_id = $articledetail['User']['wepayAccountID'];
			$lastid = $this->Tempdonation->getLastInsertId();
			$pdetail=$this->Tempdonation->find('first',array('conditions' => array('Tempdonation.id' => $lid,'Tempdonation.article_id' => $aid)));
			$amount = $pdetail['Tempdonation']['amount'];
			$name=$pdetail['Tempdonation']['firstname'].' '.$pdetail['Tempdonation']['lastname'];
			Wepay::useStaging($client_id, $client_secret);
			$wepay = new WePay($access_token);
			try {
					$checkout= $wepay->request('/checkout/create', array(
					'account_id' => $account_id, // ID of the account that you want the money to go to
					'amount' => $amount, // dollar amount you want to charge the user
					'short_description' => "this is a test payment", // a short description of what the payment is for
					'type' => "donation", // the type of the payment - choose from GOODS SERVICE DONATION or PERSONAL
					'redirect_uri'=> LIVE_SITE.'/users/thanks/'.$aid.'/'.$lid,
					'mode' => "iframe" // put iframe here if you want the checkout to be in an iframe, regular if you want the user to be sent to WePay
					//'fee' => '0'
					//'app_fee'=>'5'
					//'shipping_fee'=>'3'
					//'payer_name'=>$name
					)
				);
			}
				catch (WePayException $e) { // if the API call returns an error, get the error message for display later
				$error = $e->getMessage();
			}
			$this->set('checkoutnews',$checkout); 
		
}

	function payment1($aid,$lid)
		{ 	
			$this->layout='articledetailpage';
			App::import('Vendor','wepay');
			$client_id = "103580";
			$client_secret = "a14ba07f98";
			$access_token = "STAGE_2278b624608b1b6c0f0f383ff71c18b4c9b40d938cceadae5b152ae5f071eed5";
			$account_id = "175250328"; 
			$articledetail 	= $this->Article->find('first', array('conditions' => array('Article.id' => $aid)));
			$this->set('articledetail',$articledetail);
			$lastid = $this->Tempdonation->getLastInsertId();
			$pdetail=$this->Tempdonation->find('first',array('conditions' => array('Tempdonation.id' => $lid,'Tempdonation.article_id' => $aid)));
			$amount=$pdetail['Tempdonation']['amount'];
			$name=$pdetail['Tempdonation']['firstname'].' '.$pdetail['Tempdonation']['lastname'];
			Wepay::useStaging($client_id, $client_secret);
			$wepay = new WePay($access_token);
			try {
					$checkout= $wepay->request('/checkout/create', array(
					'account_id' => $account_id, // ID of the account that you want the money to go to
					'amount' => $amount, // dollar amount you want to charge the user
					'short_description' => "this is a test payment", // a short description of what the payment is for
					'type' => "donation", // the type of the payment - choose from GOODS SERVICE DONATION or PERSONAL
					'redirect_uri'=> LIVE_SITE.'/users/thanks/'.$aid.'/'.$lid,
					'mode' => "iframe" // put iframe here if you want the checkout to be in an iframe, regular if you want the user to be sent to WePay
					//'fee' => '0'
					//'app_fee'=>'5'
					//'shipping_fee'=>'3'
					//'payer_name'=>$name
					)
				);
			}
				catch (WePayException $e) { // if the API call returns an error, get the error message for display later
				$error = $e->getMessage();
			}
			pr($checkout);die('here');
			$this->set('checkoutnews',$checkout); 
		
}

	function thanks($id,$lid)
		{	//pr($id);pr($lid);
			//die('here');
			$this->layout='articledetailpage';
			$detail=$this->Tempdonation->find('first',array('conditions' => array('Tempdonation.id' => $lid,'Tempdonation.article_id' => $id)));
			$Donationdata['Donation']['article_id'] = $detail['Tempdonation']['article_id'] ;
			$Donationdata['Donation']['amount'] = $detail['Tempdonation']['amount'];
			$Donationdata['Donation']['firstname'] = $detail['Tempdonation']['firstname'];
			$Donationdata['Donation']['lastname'] = $detail['Tempdonation']['lastname'];
			$Donationdata['Donation']['hideinfo'] = $detail['Tempdonation']['hideinfo'];
			$Donationdata['Donation']['email'] = $detail['Tempdonation']['email'];
			$Donationdata['Donation']['country'] = $detail['Tempdonation']['country'];
			$Donationdata['Donation']['zip'] = $detail['Tempdonation']['zip'];
			$Donationdata['Donation']['image'] = $detail['Tempdonation']['image'] ;
			$Donationdata['Donation']['comment'] = $detail['Tempdonation']['comment'];
			if($this->Donation->saveAll($Donationdata))
				{
						$checkExistingdonation	= $this->Article->findById($id);
						$prevdonation=$checkExistingdonation['Article']['totaldonation'];
						$reqdata['Article']['totaldonation']=$Donationdata['Donation']['amount']+$prevdonation;	
						$this->Article->id 		=$id;
						//pr($reqdata);
						$this->Article->save($reqdata);
							$this->set('userDetails', $Donationdata);
							$this->Email->to = $Donationdata['Donation']['email'];
							$this->Email->subject = 'Thank you for donation';
							$this->Email->replyTo = EMAIL_REPLY;
							$this->Email->from = 'GoFundMe admin<norepley@softprodigy.com>';
							$this->Email->template = 'donation_thanks_message'; 
							$this->Email->sendAs = 'both';
							if($this->Email->send()){
								$this->Session->setFlash('Thank You For donation.', 'default', array('class' => 'errMsgLogin'));
								$this->redirect(array('controller'=>'users','action'=>'articledetail/'.$id));
							}
			

					}
			else
			{
				$this->Session->setFlash('Something get wrong.', 'default', array('class' => 'errMsgLogin'));
			}
}
/***************End Payment integration*************************/
		
	
		
}
						
?>

	