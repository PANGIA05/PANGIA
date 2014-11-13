<?php
class AdminsController extends AppController{
	var $name = "Admins";
	var $uses = array('Admin','User','Articlecategory','Setting','Metatag','Article','Banner','Donation','Category','Question','Commonquestion','Socialsetting','Help','Events');  
	var $helpers = array('Html', 'Form', 'Javascript','Ajax','Fck');
	var $components = array('Email','RequestHandler', 'JqImgcrop'); 
	var $paginate = array('order' => array ('User.	modified'=>'DESC'), 'limit'=>'10');
	
	function beforeFilter()
	{   
	$this->getManuSelected();                                  
	}

    function __validateLoginStatus()
    {
        if($this->action != 'login' && $this->action != 'logout' && $this->action != 'forgotPassword')
        {
            if($this->Session->check('Admin') == false && $this->Session->check('User') == false)
            {
				//$this->Session->setFlash('The URL you have followed requires you login.');
//                $this->redirect('login');     
$this->redirect(array('controller'=>'admins','action'=>'login'));           
            }
        }
	else if($this->action == 'login' || $this->action == 'forgotPassword')
        {

            if($this->Session->check('Admin') == true)
            {
				//$this->Session->setFlash('You cannot access that page.');
//                $this->redirect('manageUsers');    
$this->redirect(array('controller'=>'admins','action'=>'dashboard'));                       
            }
        }
    }
	
	function index(){
		$this->redirect('login');
	}
    function __isLoggedIn(){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
	}
	/*
	 * Using For admin Login */ 
	
	function login(){
	  $this->layout = 'login';
	   if(empty($this->data) == false){ 
		  	if(($user = $this->Admin->validateAdmin($this->data['Admin'])) == true){
				  $this->Session->write('Admin', $user);
				 //$this->Session->setFlash('You have successfully logged in.');
				 $this->Session->setFlash('You have successfully logged in.', 'default', array('class' => 'errMsgLogin'));
				 $this->redirect('/');
				exit();
			}
			else{
				$this->Session->setFlash('Please enter valid Username/Password', 'default', array('class' => 'errMsgLogin'));
		    }  	
		}	
	} 
	function eventEdit(){		
		$this->layout='home';
		// $detail = $this->Events->find('all','conditions'=>array('Events'));
		 $event1 = $this->Events->find('first', array('conditions' => array('Events.id' =>'1')));
		$event2 = $this->Events->find('first', array('conditions' => array('Events.id' =>'2')));
		$event3 = $this->Events->find('first', array('conditions' => array('Events.id' =>'3')));	
		 // $details = $this->Events->find('all');
		//pr($details);
		  $this->set('event1',$event1);
		  $this->set('event2',$event2);
 	    	   $this->set('event3',$event3);
		 // print_r($eventDetails);
	}
	function getEventDetail(){
		  
		   
	   }
	function uploadEventImage(){
		 $this->layout = false;
		// print_r($_FILES);
		 $name = USER_IMAGE.$_FILES['images']['name'];
		 move_uploaded_file($_FILES["images"]["tmp_name"],$name);
		 die();
	}
	function saveEvents(){
		$this->layout = false;
 		$id = $_REQUEST['id'];
 		//echo $id;
 
		//print_r($_REQUEST);
//die();
  
		$eventData = $_REQUEST['data']['event'];
		$eventDescription = $_REQUEST['desc'];
		$data['Events']['event_name']='';
	    	$data['Events']['id']=$id;
		$data['Events']['event_cost']=$eventData['event_cost'];
		$data['Events']['event_capacity']=$eventData['event_capacity'];
		$data['Events']['event_type']=$eventData['event_type'];
		$data['Events']['event_title']=$eventData['event_title'];
		$data['Events']['event_address']=$eventData['event_address'];
		$data['Events']['event_description']=$eventDescription;
		$data['Events']['event_date']=$eventData['event_date']['year'].'-'.$eventData['event_date']['month'].'-'.$eventData['event_date']['day'];
		$data['Events']['event_image']=$_REQUEST['img'];
		//$data['Events']['event_image']=$eventData['image_name'];
		//pr($data);

		if($this->Events->save($data))
		{
			//echo "cdsssss";
		}else
		
		{
				//echo "tegete";
		}
die(" ");
	   
	   }
	   
	   
	
	
	
	
	
	
	
	
	function dashboard(){
		$this->layout = 'admin';
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}		
	}
	
	/**  The function to edit the details of a user logged in currently
	*/
	
		function myProfile($id = ''){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->layout = 'admin';
			$id = $this->Session->read("Admin.id");
			$details=$this->Admin->find('first', array('conditions' => array('Admin.id' => $id)));
		if(!empty($this->data)){
			$data = $this->data;
			$this->Admin->set($this->data);
			unset($this->Admin->validate['password']);
		   if ($this->Admin->validates()) {
				
			if(!empty($data['Admin']['password']) && !empty($data['Admin']['repassword']) && $data['Admin']['repassword'] != $data['Admin']['password']){
				$this->Session->setFlash('Entered password not matched!', 'default', array('class' => 'errMsg'));
				$this->redirect('myProfile/'.$id);	
			}
			if(!empty($data['Admin']['password'])){
				$data['Admin']['password'] = md5($data['Admin']['password']);
				}else{
				$data['Admin']['password'] = $details['Admin']['password']; 
			}
				$this->Admin->id=$id;
				$this->Admin->save($data);
				$this->Session->setFlash('Account updated Successfully', 'default', array('class' => 'errMsgLogin'));
				$this->redirect('myProfile/'.$id);
				
						//$this->User->save($this->data);
					} else {
						
						$this->render();
					}
				}
				{
			$this->Admin->id=$id;
			$this->data	= $this->Admin->read();	


		}	
				
			} 
	
	/*Function to activate/deactivate user*/
	function activateUser(){
		
		if(!empty($this->data['Admin']['id'])){
			$existingStatus = $this->User->find('first', array('conditions' => array('User.id' => $this->data['Admin']['id'])));
			$status = $existingStatus['User']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->User->id = $this->data['Admin']['id'];
			$data['User']['status'] = $finalStatus;
			if($this->User->save($data)){
				echo $data['User']['status']; 
				die;
			}
		}
	}//Ends here
	
	/*Function to activate/deactivate email*/
	function activateUserEmail(){
		
		if(!empty($this->data['Admin']['id'])){
			$existingStatus = $this->User->find('first', array('conditions' => array('User.id' => $this->data['Admin']['id'])));
			$emailstatus = $existingStatus['User']['email_confirmation'];
			if($emailstatus == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->User->id = $this->data['Admin']['id'];
			$data['User']['email_confirmation'] = $finalStatus;
			if($this->User->save($data)){
				echo $data['User']['email_confirmation']; 
				die;
			}
		}
	}
	 
	
	function editUser($id = ''){
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		$this->layout = 'admin';
		if(!empty($id)){
			$userDesc = $this->User->find('first', array('conditions' => array('User.id' => $id)));
			//pr($userDesc);die;
			$User	= array();
		foreach($userDesc as $key=>$value):
			$User[$key]	= $value;
		endforeach;
			$this->set("info", $User['User']);
		}
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->User->id = $id;
		$data=$this->data;
		//print_r($data); die('okokoa');
		if($data){
			if(!empty($data['User']['password']))
			{
				if($data['User']['password']!=$data['User']['confirm_password'])
				{
					$this->Session->setFlash('Password and Repassword do not match!', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('/admins/editUser/'.$id);
				}
			}
			    $this->User->set($data);
				    if ($this->User->validates()) {
						$user = $this->User->checkExistingEditUser($data['User']['email'],$id);
						if(!$user){
						if(isset($data['User']['image']['name']) && !empty($data['User']['image']['name'])){	
							$uploaded = $this->JqImgcrop->uploadImage($data['User']['image'], PROFILE_UPLOAD_URL.'upload_userImages/', 'user_'.time().'_'); 
							$this->set('uploaded',$uploaded); 
							//pr($uploaded);die;
							$data['User']['image'] = $uploaded['imageName'];
							//pr($data['User']['image']);die;
						}
						
						if(isset($userDesc['User']['image']['name']) && !empty($userDesc['User']['image']))//die('ok1');
							$imageToUnlik = PROFILE_UPLOAD_URL.'upload_userImages/'.$userDesc['User']['image'];
						if(isset($imageToUnlik) && !empty($data['User']['image']['name'])){
							@unlink($imageToUnlik);//die('ok');
						}
						
						$userPassword = $data['User']['password'];
						$this->Email->to = $data['User']['email'];
						$this->Email->subject = 'Account Details Changed';
						$this->Email->replyTo = EMAIL_REPLY;
						$this->Email->from = "GoFundMe Admin <".EMAIL_REPLY.">";
						$this->Email->template = 'user_edited_message'; // note no '.ctp'
						$this->Email->sendAs = 'both'; // because we like to send pretty mail
						$this->set('userDetails', $data['User']);
						$this->set("password", $userPassword);
						$user = $this->User->checkExistingUser($data['User']['email']);
						if($this->Email->send())
						{
							$this->Session->setFlash('Password Sent Successfully!', 'default', array('class' => 'errMsgLogin'));
						}
						
						if(empty($data['User']['password']))
						{
							$data['User']['password'] = $userDesc['User']['password'];
							$data['User']['confirm_password'] = $userDesc['User']['password'];
							$data['User']['orgpassword'] = $userDesc['User']['orgpassword'];
						}
						else
						{
							$data['User']['orgpassword'] = $data['User']['password'];
							$data['User']['confirm_password'] = $data['User']['password'] = md5($data['User']['password']);
							
						}
						
						
						 
						$checkimage=$data['User']['image']['name'];
						 if(empty($checkimage))
							{
							 $data['User']['image']=$userDesc['User']['image'];
							} else {
								$data['User']['image']=$data['User']['image'];
								}
						/*if(empty($data['User']['image']['name']))
						{
								$data['User']['image']=$userDesc['User']['image'];
							
						}
						else 
						{
							$data['User']['image']=$data['User']['image'];
						}
						pr($data);die;*/
						
						
						if($this->User->save($data))
						{
						$this->Session->setFlash('User updated Successfully!', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('manageUsers');
						}
						else
						{
						echo "<pre>"; print_r($this->User); die;
						}
						
					}else{
						$this->Session->setFlash('Email already exists!', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('/admins/editUser/'.$id);
					}
					} else{
					$this->render();
				}
		}
		{
			$this->User->id=$id;
			$this->data	= $this->User->read();	


		}			
		
	}//Ends here
		
	
	/*
	 * Function to destroy user's session and redirect user to log in page
	 * */
	function logout(){
		$this->Session->delete('UserAccount');
		$this->Session->destroy();
		$this->Session->setFlash('You have successfully logged out.', 'default', array('class' => 'errMsgLogin'));
		$this->redirect('login');
		die;
		
		
		
	}//ends here
	
	/*
	 * Deleting selected records
	 * */
	 function removeUser(){//pr($this->data);die;
		 if(isset($this->data['Admin']['idArr']) && !empty($this->data['Admin']['idArr'])){
			$idArr = explode(",", $this->data['Admin']['idArr']);
			//pr($idArr);die;
		}
	if(isset($idArr[1]) && !empty($idArr[1])){
		$message = 'Selected Users removed successfully';
	}else{
		$message = 'Selected User removed successfully';
	}
	
		foreach($idArr as $ids){
			$userDesc = $this->User->find('first', array('conditions' => array('User.id' => $ids)));
			$arr[] = $ids;
			if(isset($userDesc['User']['user_image']) && !empty($userDesc['User']['user_image'])){
				$imageToUnlik = PROFILE_UPLOAD_URL.'upload_userImages/'.$userDesc['User']['user_image'];
				unlink($imageToUnlik);
			}
			//
		} 
		
		$this->User->recursive = 0;
		
		if($this->User->deleteAll(array('id'=>$arr))){	
			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageUsers');
		}else{
			die('not deleted');
		}
	 }
	 //Ends here
	/*
	* Forget Password. Creates random password and returns the created string
	*/

	function createRandomPassword() 
	{
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 7) 
		{

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;
		}
  		return $pass;
	}//Ends here	
	/*
	 * Function to send the randomly created password, to user;s email address. Defauls Cake PHP mail component is used to send mail.
	 * */
	function forgotPassword(){
		if($this->Session->read('Admin')){
			$this->redirect('manageUsers');
		}
		$this->layout = 'login';
		if(!empty($this->data)){
			$data = $this->data;
			$email = $data['Admin']['email'];
			//Checks for existing email
			$userDetail = $this->Admin->find('first',array('conditions'=>array("Admin.email "=> $email)));
			if($email==null){
				echo $email;
				$this->Session->setFlash('Please enter email', 'default', array('class' => 'errMsgLogin'));
			}
			else{ 
				$userID = $userDetail['Admin']['id'];
             	$data = $this->data;
				$email_to = $data['Admin']['email'];
				if($userDetail['Admin']['email'] == ($email)){
					$password= $this->createRandomPassword();
					$new_password=md5($password);
					$this->Admin->id = $userID;
					$this->data['Admin']['password'] = trim($new_password);
					if($this->Admin->save($this->data)){
						//Default Mail component is called, to send mail. We are setting the variables for sending email
						$this->Email->to = $email_to;
						//$this->Email->bcc = array($adminEmail);
						$this->Email->subject = 'Your password here';
						$this->Email->replyTo = EMAIL_REPLY;
						$this->Email->from = "GofundMe Admin <".EMAIL_REPLY.">";
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
							$this->redirect('forgotPassword');
						}
					}
				}
				else{ 
					$this->Session->setFlash('Please enter valid email', 'default', array('class' => 'errMsgLogin'));
				}
			}
		} 
	} 
		/*
	 	* Function to add users
	 	* */
	function addUser(){//die('sads');
		
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
			if($this->data){
			
			    $this->User->set($this->data);
				    if ($this->User->validates()) {
						//pr($this->data); die;
						$user = $this->User->checkExistingUser($this->data['User']['email']);
						//echo $user;die;
						if(!$user){	
							$userPassword = $this->data['User']['password'];
							$this->data['User']['password'] = md5($this->data['User']['password']);
							$this->data['User']['confirm_password'] = md5($this->data['User']['confirm_password'] );
							if(isset($this->data['User']['image']['name']) && !empty($this->data['User']['image']['name'])){
							$uploaded = $this->JqImgcrop->uploadImage($this->data['User']['image'], PROFILE_UPLOAD_URL.'upload_userImages/', 'user_'.time().'_'); 
								$this->set('uploaded',$uploaded); 
								$this->data['User']['image'] = $uploaded['imageName'];
							}else{
								$this->data['User']['image'] = '';
							}
							//pr($this->data);die;
							$this->Email->to = $this->data['User']['email'];
							$this->Email->subject = 'User Created Successfully';
							$this->Email->replyTo = EMAIL_REPLY;
							$this->Email->from = "GoFundMe Admin <".EMAIL_REPLY.">";
							$this->Email->template = 'user_created_message'; // note no '.ctp'
							$this->Email->sendAs = 'both'; // because we like to send pretty mail
							$this->set('userDetails', $this->data['User']);
							$this->set("password", $userPassword);
							//pr($this->data);die();
							if($this->User->save($this->data)){//die('fdsf');
								
								if($this->Email->send())
								{
									$this->Session->setFlash('User added successfully','default',array('class' => 'errMsgLogin'));
									$this->redirect('manageUsers');
								}
							}
						}
					     else{
							$this->Session->setFlash('Email already exists!', 'default', array('class' => 'errMsgLogin'));
						} 
					
					}else {
						
						// do nothing
					}
		}		
	}
	
	
		function manageUsers($id = null){
			if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
		}
		
		$this->layout = 'admin';
		$this->paginate=(array('order'=>array('User.id'=>'desc')));
		
		if(!empty($this->data) && trim($this->data['User']['name']) != 'Search User Name'){
			$condition="User.firstname LIKE '%".trim($this->data['User']['username'])."%' || User.lastname LIKE '%".trim($this->data['User']['username'])."%' || User.email LIKE '%".trim($this->data['User']['username'])."%'";
			$this->paginate=(array('conditions' => $condition,'order'=>array('User.firstname'=>'ASC')));
			$users = $this->paginate('User');
		}else{
			$this->paginate=(array('order'=>array('User.firstname'=>'ASC')));
			$users = $this->paginate('User');
		}	
		$this->set('users',$users);
		$this->set('totalRecords',$this->User->find('count'));
		}
			/*
		* Name : searchforuser
		* Description : This is used for searching user.
		*/
		function searchforadminuser(){	//die('here');
			$this->layout = false;
			$id=$this->Session->read('User.id');
			$q=$_REQUEST['searchword'];
			//pr($q);die;
			$search=$this->User->query("select id,firstname,lastname,email,image from users where(firstname like '%$q%' or lastname like '%$q%' or email like '%$q%') order by id LIMIT 3");
		//pr($search); die;
		$this->set('search',$search);
		$this->set('q',$q);
		$html=$this->render();
		echo $html;
		die;
	}
	
			/*
		* Name : viewuser
		* Description : This return the searched user
		*/
		function viewuser($upid=null){
			$this->layout='admin';
			$id=$upid;
			$this->paginate = array('conditions' => array('User.id' => $id));
			$users = $this->paginate('User');
			$this->User->id = $id;
			$this->set('users',$users);
		}
			
			
				/*
		* Name : searchforuser
		* Description : This is used for searching user.
		*/
		function searchadminarticle(){	//die('here');
			$this->layout = false;
			//$id=$this->Session->read('User.id');
			$q=$_REQUEST['searchword'];
			//pr($q);die;
			$search=$this->Article->query("select id,user_id,amount,title,category,summary,description,image,totaldonation from articles where(title like '%$q%') order by id LIMIT 3");
		//pr($search); die('here');
		$this->set('search',$search);
		$this->set('q',$q);
		$html=$this->render();
		echo $html;
		die;
	}	
			/*
		* Name : viewarticle
		* Description : This return the searched article
		*/
		function viewarticle($aid=null){
			$this->layout='admin';
			$id=$aid;
			$this->paginate = array('conditions' => array('Article.id' => $id));
			$article = $this->paginate('Article');
			$this->Article->id = $id;
			$this->set('article',$article);
		}

	/* function manageCategory($id = null){
			if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
		}
		$this->layout	= 'admin';
		$this->paginate = array('limit'=>'10',"order"=>'Articlecategory.id');
		$Articlecategory = $this->paginate('Articlecategory');
		$this->set('Articlecategory',$Articlecategory);
		}


		function addCategory() {
			$this->layout	= 'admin';
			$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
			$this->set('statusArray', $statusArray);
			
		if(!empty($this->data)){
			//pr($this->data); die;
			    $this->Articlecategory->set($this->data);
			    if ($this->Articlecategory->validates()) {
			
					$this->Articlecategory->save($this->data);
					$this->Session->setFlash('Article Category added Successfully!', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('manageCategory');
				}else{
					$this->render();
				}
		}	
	}
		function editCategory($id = '')
		{
			$this->layout	= 'admin';
			$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
			$this->set('statusArray', $statusArray);
			
			$this->set('id',$id);
			$this->Articlecategory->id = $id;

		if(!empty($this->data)){
			    $this->Articlecategory->set($this->data);
			    if ($this->Articlecategory->validates()) {//die('here');
			
					$this->Articlecategory->save($this->data);
					$this->Session->setFlash('Article Category updated Successfully!', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('manageCategory');
				}else{
					$this->render();
				}
		}
			{
				$this->Articlecategory->id=$id;
				$this->data	= $this->Articlecategory->read();	


		}	
	}

		 function removeCategory(){
//die('here');
//pr($this->data);die;
		 if(isset($this->data['Articlecategory']['idArr']) && !empty($this->data['Articlecategory']['idArr'])){
			$idArr = explode(",", $this->data['Articlecategory']['idArr']);
		}

	if(isset($idArr[1]) && !empty($idArr[1])){
		$message = 'Selected Article category removed successfully';
	}else{
		$message = 'Selected Article category removed successfully';
	}
//	$this->Ad->unBindModel(array('belongsTo' => array('User')));
		if($this->Articlecategory->deleteAll(array('Articlecategory.id'=>$idArr))){	

			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageCategory');
		}else{
			die('Article Category not deleted');
		}
	 }
	 	// Ad Status Activate/ Deactivate 	
	function activateCategory(){
		
		if(!empty($this->data['Articlecategory']['id'])){
			$existingStatus = $this->Articlecategory->find('first', array('conditions' => array('Articlecategory.id' => $this->data['Articlecategory']['id'])));
			$status = $existingStatus['Articlecategory']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->Articlecategory->id = $this->data['Articlecategory']['id'];
			$data['Articlecategory']['status'] = $finalStatus;
			if($this->Articlecategory->save($data)){
				echo $data['Articlecategory']['status']; 
				die;
			}
		}
	}*/
	function manageCategory($id = null){
		//$this->__permissionsAccess();
		
		$this->layout = 'admin';
		$this->set('setTab','Manage Categories');
		$this->set('setTitle','manageJob');
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
			$this->set('statusArray', $statusArray);
		
		$catname = $this->Category->find('all',array('conditions'=>array("Category.parent_id"=>'0')));
		//pr($catname);die;
		$parentArray['']="Select Menu";
		foreach($catname as $k=>$v)
		{
			$parentArray[$v['Category']['id']]=$v['Category']['category'];
		}
		$this->set('parentArray',$parentArray);
		
		if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
			
		}
		$this->layout = 'admin';
		
			$this->paginate=(array('order'=>array('Category.category'=>'ASC')));
			$Category = $this->paginate('Category');
		/*ADD NEW INDEX FOR PARENT VALUE START*/
			foreach($Category as $parentVal)
			{
				$cond="Category.id=".$parentVal['Category']['parent_id'];
				$parent[]=$this->Category->find('first',array('conditions'=>$cond));
			}
			if(!empty($parent))
			{				
				foreach($parent as $k=>$pname){
					if(!empty($pname['Category']['category'])){
					$Category[$k]['ParentID']=$pname['Category']['id'];
					$Category[$k]['ParentName']=$pname['Category']['category'];
					}else{
					$Category[$k]['ParentName']="No Parent";
					}
				}
			}
		$this->set('categoriesList',$Category);
		
	}//Ends here
	
	/* 
	 * Function name : addCategory
	 * Description : To add new Category.
	 */
	function getCategory($id = null){
		
		$catname = $this->Category->find('all',array('conditions'=>array("Category.parent_id"=>'0')));
		$parentArray['']="Select Menu";
		foreach($catname as $k=>$v)
		{
			$parentArray[$v['Category']['id']]=$v['Category']['category'];
		}
		$this->set('parentArray',$parentArray);
		if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
			
		}
		
		$this->layout = 'admin';
		if(!empty($this->data['Category']['catName']) && $this->data['Category']['catName'] != "Enter Category Name"){
			$condition="Category.category LIKE '%".$this->data['Category']['catName']."%'";
			$this->paginate=(array('conditions' => $condition,'order'=>array('Category.category'=>'ASC')));
			$Category = $this->paginate('Category');
		}else if(!empty($this->data['Category']['parentName'])){
			$condition="Category.parent_id =".$this->data['Category']['parentName'];
			$this->paginate=(array('conditions' => $condition,'order'=>array('Category.category'=>'ASC')));
			$Category = $this->paginate('Category');
		}else
		{
			$this->paginate=(array('order'=>array('Category.category'=>'ASC')));
			$Category = $this->paginate('Category');
		}
		
		
		/*ADD NEW INDEX FOR PARENT VALUE START*/
			foreach($Category as $parentVal)
			{
				$cond="Category.id=".$parentVal['Category']['parent_id'];
				$parent[]=$this->Category->find('first',array('conditions'=>$cond));
			}
			if(!empty($parent))
			{				
				foreach($parent as $k=>$pname){
					if(!empty($pname['Category']['category'])){
					$Category[$k]['ParentID']=$pname['Category']['id'];
					$Category[$k]['ParentName']=$pname['Category']['category'];
					}else{
					$Category[$k]['ParentName']="No Parent";
					}
				}
			}
		/*ADD NEW INDEX FOR PARENT VALUE END*/
		$this->set('Category',$Category);
		
		
	}//Ends here
			
	function addCategory(){ 
		$this->layout = 'admin';
		//$this->set('setTab','Add Category');
		//$this->set('setTitle','manageJob');
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		
		
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$conditions="Category.parent_id = 0";
		$catDropValue=$this->Category->find('all',array('conditions'=>$conditions,'fields'=>'id,category','order'=>'Category.category ASC'));
		$categoryDrop=array();
		$categoryDrop['0']='Select Parent';		
		if(!empty($catDropValue)){
			
			foreach($catDropValue as $key=>$val)
			{
				$categoryDrop[$val['Category']['id']]=$val['Category']['category'];
			}
			
		}
		$this->set('categoryDrop',$categoryDrop); 
		if($this->data){			
				$catId = "";
				$categoryCheck = $this->Category->checkExistingCategory($catId , $this->data['Category']['category'],0);
				if(!$categoryCheck){
					if($this->Category->save($this->data)){
						$this->Session->setFlash('Category added successfully', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('manageCategory');
					}
				}else{
					$this->Session->setFlash('Category has been Already Exist !!', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('addCategory');
				}
			 
			}else {
				
				// do nothing
			}
	
	}//Ends here
	
	/*Edit categories*/
	function editCategory($id = ''){
		$this->layout = 'admin';
		$this->set('setTab','Edit Category');
		$this->set('setTitle','manageJob');
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		
		if(!empty($id)){
			$userDesc = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
			//pr($userDesc['Category']); die;
			$this->set("info", $userDesc['Category']);
		}


		$position=array("T"=>"Top","L"=>"Left","F"=>"Footer");
		$this->set('menus_position',$position);
		$conditions="Category.id !=".$id."";
		$catDropValue=$this->Category->find('all',array('conditions'=>$conditions,'fields'=>'id,category','order'=>'Category.category ASC'));
		$categoryDrop=array();
		$categoryDrop['0']='Select Parent';		
		//pr($catDropValue);
		if(!empty($catDropValue)){
			
			foreach($catDropValue as $key=>$val)
			{
				$categoryDrop[$val['Category']['id']]=$val['Category']['category'];
			}
			
		}
		$this->set('categoryDrop',$categoryDrop); 
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->Category->id = $id;
		if($this->data){ 
			    $this->Category->set( $this->data);
				   
						$categoryCheck = $this->Category->checkExistingCategory($id , $this->data['Category']['category'],1);
						if(!$categoryCheck){
							$this->Category->id = $id;
							if($this->Category->save($this->data)){
								$this->Session->setFlash('Category updated successfully!', 'default', array('class' => 'errMsgLogin'));
								$this->redirect('manageCategory');
							
							} 
						}else{
							$this->Session->setFlash('Category has been Already Exist !!', 'default', array('class' => 'errMsgLogin'));
							$this->redirect('editCategory/'.$id);
						}
					
				}		
	}
	

		function removeCategory(){
			if(isset($this->data['Category']['idArr']) && !empty($this->data['Category']['idArr'])){
			$idArr = explode(",", $this->data['Category']['idArr']);
		}

		if(isset($idArr[1]) && !empty($idArr[1])){
			$message = 'Selected Article category removed successfully';
		}else{
			$message = 'Selected Article category removed successfully';
		}
		//	$this->Ad->unBindModel(array('belongsTo' => array('User')));
		if($this->Category->deleteAll(array('Category.id'=>$idArr))){	

			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageCategory');
		}else{
			die('Article Category not deleted');
		}
		}
	 	/* category Status Activate/ Deactivate */	
	function activateCategory(){
		if(!empty($this->data['Category']['id'])){
			$existingStatus = $this->Category->find('first', array('conditions' => array('Category.id' => $this->data['Category']['id'])));
			$status = $existingStatus['Category']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->Category->id = $this->data['Category']['id'];
			$data['Category']['status'] = $finalStatus;
			if($this->Category->save($data)){
				echo $data['Category']['status']; 
				die;
			}
		}
	}
	// Ad Status Activate/ Deactivate 
		function viewUserDetails($id = ''){
			 $this->layout = 'admin';
				if($id){//pr($id);die;
				$userDetails = $this->User->find('first', array('conditions' => array('User.id' => $id)));
				//pr($userDetails);die;
				$User	= array();
				foreach($userDetails as $key=>$value):
					$User[$key]	= $value;
					endforeach;
					$this->set("info", $User['User']);
				}
			 }
	
		
		function getuserdetail($id=null)
		{
			$userDetails = $this->User->find('first', array('conditions' => array('User.id' => $id)));
				if($userDetails)
						{
						return $userDetails;
						}
			}
				





	

	function manageArticle()
		{
			$this->layout	= 'admin';
		$this->paginate = array('limit'=>'10',"order"=>'Article.id DESC');
			
		$Article = $this->paginate('Article');
		$this->set('Article',$Article);
		}
	
	function addArticle()
	{	$this->layout	= 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		$adminDetail=$this->Session->read('Admin', $user);
		
		if(!empty($this->data)){
				if(isset($this->data['Article']['image']['name']) && !empty($this->data['Article']['image']['name'])){
							$uploaded = $this->JqImgcrop->uploadImage($this->data['Article']['image'], PROFILE_UPLOAD_URL.'upload_bannerImages/', 'Article'.time().'_'); 
								$this->set('uploaded',$uploaded); 
								$this->data['Article']['image'] = $uploaded['imageName'];
							}else{
								$this->data['Article']['image'] = '';
							}
			    $this->Article->set($this->data);
			    if ($this->Article->validates()) {
					$this->data['Article']['user_id']=$adminDetail['id'];
					$this->data['Article']['author']=$adminDetail['username'];
					$this->Article->save($this->data);
					$this->Session->setFlash('Article added Successfully!', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('manageArticle');
				}else{
					$this->render();
				}
		}	
	}
	/* Add Article */

	/* Edit Article */
		function editArticle($id=null){
			$this->layout = 'admin';
			$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
			$this->set('statusArray', $statusArray);	
			$this->set('id',$id);
			$this->Article->id=$id;	
			$userDesce = $this->Article->find('first', array('conditions' => array('Article.id' => $id)));
				if($this->data){//pr($this->data);die;
					
					if(isset($this->data['Article']['image']['name']) && !empty($this->data['Article']['image']['name'])){	//pr('ok1');die;
							
							$uploaded = $this->JqImgcrop->uploadImage($this->data['Article']['image'], PROFILE_UPLOAD_URL.'upload_bannerImages/', 'Article'.time().'_'); 
						
							$this->set('uploaded',$uploaded); 
							//pr($uploaded);die;
							$this->data['Article']['image'] = $uploaded['imageName'];
							//pr($this->data['User']['image']);die;
						}
						else{
								$this->data['Article']['image'] = $userDesce['Article']['image'];
							}
						
						if(isset($userDesce['Article']['image']['name']) && !empty($userDesce['Article']['image']))//die('ok1');
							$imageToUnlik = PROFILE_UPLOAD_URL.'upload_bannerImages/'.$userDesce['Article']['image'];
						//pr($imageToUnlik);die;
						if(isset($imageToUnlik) && !empty($this->data['Article']['image']['name'])){
							@unlink($imageToUnlik);//die('ok');
						}
							$this->Article->id=$id;
							//pr($this->data);die;
							if($this->Article->save($this->data))
							{
							$this->Session->setFlash('Article updated Successfully.', 'default', array('class' => 'errMsgLogin'));
							$this->redirect('manageArticle');	
						}
					
								
						}
						$this->data= $this->Article->read();
						$this->set('userDesce',$userDesce);
	
					}
			
	function activateArticle(){
		
		if(!empty($this->data['Article']['id'])){
			$existingStatus = $this->Article->find('first', array('conditions' => array('Article.id' => $this->data['Article']['id'])));
			$status = $existingStatus['Article']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->Article->id = $this->data['Article']['id'];
			$data['Article']['status'] = $finalStatus;
			if($this->Article->save($data)){
				echo $data['Article']['status']; 
				die;
			}
		}
	}
	/* Article Status Activate/ Deactivate */	


/*
	 * Deleting selected Article
	 * */
	 function removeArticle(){
//die('here');
		 if(isset($this->data['Article']['idArr']) && !empty($this->data['Article']['idArr'])){
			$idArr = explode(",", $this->data['Article']['idArr']);
		}

	if(isset($idArr[1]) && !empty($idArr[1])){
		$message = 'Selected Articles removed successfullyyyy';
	}else{
		$message = 'Selected Article removed successfully..';
	}
		if($this->Article->deleteAll(array('Article.id'=>$idArr))){	

			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageArticle');
		}else{
			die('Article not deleted');
		}
	 }
	
	
	 /*
	 * Listing Donation /*today-------------
	 * */
	 
	 	function manageDonation(){
			$this->layout	= 'admin';
			$this->paginate = array('limit'=>'10',"order"=>'Donation.article_id');
			$donation = $this->paginate('Donation');
			//	pr($donation);die;
			$this->set('donations',$donation);
		}
	
				
				
		/* Funtion 	get a single  album  images */
		
		function donationlist($id=null)
			{
				$this->layout	= 'admin';
				$this->paginate = array('conditions' => array('Donation.article_id' => $id),'limit'=>'10',"order"=>'Donation.article_id');
				$donationlist = $this->paginate('Donation');
				$this->set('donationlists',$donationlist);
				$this->set('donationid',$id);
			}
		
		function removedonationlist($id=null){
			//pr($this->data);die('here');
		if(isset($this->data['Donation']['idArr']) && !empty($this->data['Donation']['idArr'])){
			$idArr = explode(",", $this->data['Donation']['idArr']);
		}

		if(isset($idArr[1]) && !empty($idArr[1])){
			$message = 'Selected Donation removed successfully.';
			}else{
				$message = 'Selected Donation removed successfully.';
			}
		if($this->Donation->deleteAll(array('Donation.id'=>$idArr))){	

			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('donationlist/'.$this->data['Donation']['donationid']);
			//$this->redirect('albumdetail/'.$this->data['Donation']['albumid']);
				}else{
			die('Image not deleted');
			}
		}
		
		
		 function donationDetails($id = ''){
			 $this->layout = 'admin';
				$donationDetail = $this->Donation->find('first', array('conditions' => array('Donation.id' => $id)));
				$time = strtotime($donationDetail['Donation']['date']);
				//pr($time);
				$timeago= $this->elapstime($time);
				//pr($timeago);die('here');
				$this->set('timeagos', $timeago);
				$this->set('donationDetails', $donationDetail);
				
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

	 /*today-------------*/
	 
	 
	 
	 
	 
	 //Ends here
	 function manageBanners($id = null){
			if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
		}
		$this->layout	= 'admin';
		$this->paginate = array('limit'=>'10',"order"=>'Banner.id');
		$banner = $this->paginate('Banner');
		$this->set('banner',$banner);
		}
	function addBanner() {
	
		$this->layout	= 'admin';
		if(!empty($this->data)){
			$data = $this->data;
			if(isset($data['Banner']['image']['name']) && !empty($data['Banner']['image']['name'])){
				$uploaded = $this->JqImgcrop->uploadImage($data['Banner']['image'], PROFILE_UPLOAD_URL.'upload_bannerImages/', 'banner_'.time().'_'); 
					$this->set('uploaded',$uploaded); 
					$data['Banner']['image'] = $uploaded['imageName'];
				}else{
					$data['Banner']['image'] = '';
				}	
				$image=IMAGE_URL.'upload_bannerImages/'.$data['Banner']['image'];
				$checkSize = list($width, $height) = getimagesize(IMAGE_URL.'upload_bannerImages/'.$data['Banner']['image']);
				//pr($checkSize);die;
				//pr($checkSize);die('herdsfe');
				$checkWidth=$checkSize[0];
				$checkheight=$checkSize[1];
				if($checkWidth >=1440 && $checkheight >=550)
						{
					if ($this->Banner->validates()) 
							{//pr($data);die;
								$this->Banner->create();
								if($this->Banner->save($data))
								{
								$this->Session->setFlash('Banner added Successfully.', 'default', array('class' => 'errMsgLogin'));
								$this->redirect('manageBanners');
							}	
						}
					else
						{
					$this->Session->setFlash('Banner does not added Successfully.', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('addBanner');
					}
	
				
				}
				else
					{
						@unlink(IMAGE_URL.'upload_bannerImages/'.$this->data['Banner']['image']);
						$this->Session->setFlash("Image Size invalid, you are try to uploading image with  width = $checkWidth, height = $checkheight", 'default', array('class' => 'errMsgLogin'));
			}	
		}
	}
		
		function editBanner($id=null){
			$this->layout = 'admin';	
			$this->set('id',$id);
			$this->Banner->id=$id;
			$userDesce = $this->Banner->find('first', array('conditions' => array('Banner.id' => $id)));
			$this->set('bdata',$userDesce);
				if(!empty($this->data)){
				$data = $this->data;	
					if(isset($data['Banner']['image']['name']) && !empty($data['Banner']['image']['name']))
				{	$uploaded = $this->JqImgcrop->uploadImage($data['Banner']['image'], PROFILE_UPLOAD_URL.'upload_bannerImages/', 'banner_'.time().'_'); 
					$this->set('uploaded',$uploaded); 
					$data['Banner']['image'] = $uploaded['imageName'];
				}
				else{
						$data['Banner']['image'] = $userDesce['Banner']['image'];
					}
					if(isset($userDesce['Banner']['image']['name']) && !empty($userDesce['Banner']['image']))//die('ok1');
						$imageToUnlik = PROFILE_UPLOAD_URL.'upload_bannerImages/'.$userDesce['Banner']['image'];
						if(isset($imageToUnlik) && !empty($data['Banner']['image']['name']))
						{
							@unlink($imageToUnlik);//die('ok');
						}
				$checkSize = list($width, $height) = getimagesize(IMAGE_URL.'upload_bannerImages/'.$data['Banner']['image']);
				// pr($checkSize);die('herdsfe');
				 $checkWidth=$checkSize[0];
				$checkheight=$checkSize[1];
				if($checkWidth >=1440 && $checkheight >=550)
					{
						if ($this->Banner->validates()) 
							{
									$this->Banner->id=$id;
									if($this->Banner->save($data))
									{
											$this->Session->setFlash('Banner updated Successfully.', 'default', array('class' => 'errMsgLogin'));
										$this->redirect('manageBanners');
									}	
							}
						else
							{
								$this->Session->setFlash('Banner does not updated Successfully.', 'default', array('class' => 'errMsgLogin'));
								$this->redirect('addBanner');
							}
					}
					else
						{
						@unlink(IMAGE_URL.'upload_bannerImages/'.$this->data['Banner']['image']);
						$this->Session->setFlash("Image Size invalid, you are try to uploading image with  width = $checkWidth, height = $checkheight", 'default', array('class' => 'errMsgLogin'));
						}
					}
						//$this->data= $this->Banner->read();
	
				}

		 function removeBanner(){

		 if(isset($this->data['Banner']['idArr']) && !empty($this->data['Banner']['idArr'])){
			$idArr = explode(",", $this->data['Banner']['idArr']);
		}

	if(isset($idArr[1]) && !empty($idArr[1])){
		$message = 'Selected Banners removed successfully';
	}else{
		$message = 'Selected Banners removed successfully';
	}
//	$this->Ad->unBindModel(array('belongsTo' => array('User')));
		if($this->Banner->deleteAll(array('Banner.id'=>$idArr))){	

			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageBanners');
		}else{
			die('Banners not deleted');
		}
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
			
	 
	 function reply()
	 {	//pr($this->data);die;
		$this->layout = 'admin';
		 if(!empty($this->data))
		 {
			$data=$this->data;
			$str=$data['User']['message'];
			$data['User']['message']=$this->nl2p($str);
			$this->Email->to = $data['User']['to'];
			$this->Email->subject = 'Thank you for donation.';
			$this->Email->replyTo = $data['User']['from'];
			$this->Email->from = "GoFundMe Admin <".$data['User']['from'].">";
			$this->Email->template = 'donation_reply_message'; 
			$this->Email->sendAs = 'both'; 
			$this->set('data', $data['User']);
			if($this->Email->send())
			{
				$this->Session->setFlash('Message send Successfully!', 'default', array('class' => 'errMsgLogin'));
				$this->redirect('donationlist/'.$data['User']['aid']);
			}
		}
	 } 
		/**********************************Start ASk Questions Grid(help)**************************************/ 
		/*
		* Name : manageQuestion
		* Description : This function manage the questions/answers	
		*/
	
	
		function manageQuestion($id = null){
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
			$this->set('statusArray', $statusArray);
		
		$catname = $this->Question->find('all',array('conditions'=>array("Question.parent_id"=>'0')));
		//pr($catname);die;
		$parentArray['']="Select Menu";
		foreach($catname as $k=>$v)
		{
			$parentArray[$v['Question']['id']]=$v['Question']['title'];
		}
		$this->set('parentArray',$parentArray);
		
		if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
			
		}
		$this->layout = 'admin';
		
			$this->paginate=(array('order'=>array('Question.title'=>'ASC')));
			$Category = $this->paginate('Question');
		/*ADD NEW INDEX FOR PARENT VALUE START*/
			foreach($Category as $parentVal)
			{
				$cond="Question.id=".$parentVal['Question']['parent_id'];
				$parent[]=$this->Question->find('first',array('conditions'=>$cond));
			}
			if(!empty($parent))
			{				
				foreach($parent as $k=>$pname){
					if(!empty($pname['Question']['title'])){
					$Category[$k]['ParentID']=$pname['Question']['id'];
					$Category[$k]['ParentName']=$pname['Question']['title'];
					}else{
					$Category[$k]['ParentName']="No Parent";
					}
				}
			}
		$this->set('questionList',$Category);
		
	}
		
		/*start*/
		function addQuestion(){ 
			$this->layout = 'admin';
			$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
			$this->set('statusArray', $statusArray);
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
			$conditions="Question.parent_id = 0";
			$catDropValue=$this->Question->find('all',array('conditions'=>$conditions,'fields'=>'id,title','order'=>'Question.title ASC'));
			$categoryDrop=array();
			$categoryDrop['0']='Select Category';		
		if(!empty($catDropValue)){
			
			foreach($catDropValue as $key=>$val)
			{
				$categoryDrop[$val['Question']['id']]=$val['Question']['title'];
			}
			
		}
		$this->set('categoryDrop',$categoryDrop); 
		if($this->data){			
				$catId = "";
				$categoryCheck = $this->Question->checkExistingCategory($catId , $this->data['Question']['title'],0);
				if(!$categoryCheck){
					if($this->data['Question']['title']=='')
					{
						$tid=$this->data['Question']['parent_id'];
						$category=$this->Question->find('first',array('conditions'=>array('Question.id'=>$tid)));
						$this->data['Question']['title']=$category['Question']['title'];
					}
					else
					{
						$this->data['Question']['title']=$this->data['Question']['title'];
					}
					//pr($this->data);die;
					if($this->Question->save($this->data)){
						$this->Session->setFlash('Question added successfully', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('manageQuestion');
					}
				}else{
					$this->Session->setFlash('Question category has been Already Exist .', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('addQuestion');
				}
			 
			}else {
				
				// do nothing
			}
	
	}//Ends here
	
	/*Edit editQuestion*/
	function editQuestion($id = ''){
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		
		if(!empty($id)){
			$userDesc = $this->Question->find('first', array('conditions' => array('Question.id' => $id)));
			//pr($userDesc['Category']); die;
			$this->set("info", $userDesc['Question']);
		}
		//$conditions="Question.id !=".$id."";
		$conditions="Question.parent_id = 0";
		$catDropValue=$this->Question->find('all',array('conditions'=>$conditions,'fields'=>'id,title','order'=>'Question.title ASC'));
		//pr($catDropValue);die;
		$categoryDrop=array();
		$categoryDrop['0']='Select Category';		
		if(!empty($catDropValue)){
			
			foreach($catDropValue as $key=>$val)
			{
				$categoryDrop[$val['Question']['id']]=$val['Question']['title'];
			}
		}
		$this->set('categoryDrop',$categoryDrop); 
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->Question->id = $id;
		if($this->data){ 
			    $this->Question->set( $this->data);
				   /*	$categoryCheck = $this->Question->checkExistingCategory($id,$this->data['Question']['title'],1);
						if(!$categoryCheck){*/
							$this->Question->id = $id;
							//pr($this->data);die;
							if($this->Question->save($this->data)){
								$this->Session->setFlash('Question updated successfully!', 'default', array('class' => 'errMsgLogin'));
								$this->redirect('manageQuestion');
							
							} 
						/*}else{
							$this->Session->setFlash('Question category has been already exist .', 'default', array('class' => 'errMsgLogin'));
							$this->redirect('editQuestion/'.$id);
						}*/
					
				}		
	}
		
			/*
		* Name : activateQuestions
		* Description : This function activate/deactivate the questions/answers	
		*/
		function activateQuestion(){
		if(!empty($this->data['Question']['id'])){
			$existingStatus = $this->Question->find('first', array('conditions' => array('Question.id' => $this->data['Question']['id'])));
			$status = $existingStatus['Question']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->Question->id = $this->data['Question']['id'];
			$data['Question']['status'] = $finalStatus;
			if($this->Question->save($data)){
				echo $data['Question']['status']; 
				die;
			}
		}
	}
		
			/*
		* Name : removeQuestion
		* Description : This function remove the FAQ questions
		*/
		function removeQuestion(){//pr($this->data);die;
			if(isset($this->data['Question']['idArr']) && !empty($this->data['Question']['idArr'])){
			$idArr = explode(",", $this->data['Question']['idArr']);
		}

		if(isset($idArr[1]) && !empty($idArr[1])){
			$message = 'Selected Question removed successfullyyyy';
		}else{
			$message = 'Selected Question removed successfully..';
		}
		if($this->Question->deleteAll(array('Question.id'=>$idArr))){	

			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageQuestion');
		}else{
		die('Question not deleted');
		}
		}
		/*
		* Name : userlist
		* Description : This function Used for listing the Users who has any query. 	
		*/
		function userlist($id=null)
			{
				$this->layout	= 'admin';
				$this->paginate = array('conditions' => array('Help.qus_id' => $id),'limit'=>'10',"order"=>'Help.qus_id');
				$userlist = $this->paginate('Help');
				//pr($userlist);die;
				$this->set('userlists',$userlist);
				$this->set('userid',$id);
			}
/**********************************End ASk Questions Grid(help)**************************************/


	 
/**********************************Start Comman Questions Grid**************************************/
	/*
		* Name : addQuestions
		* Description : This function add the questions/answers	
		*/	
	 function manageCommonQuestion($id = null){
			if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
		}
		$this->layout	= 'admin';
		$this->paginate = array('limit'=>'10',"order"=>'Commonquestion.id');
		$questionList = $this->paginate('Commonquestion');
		$this->set('questionList',$questionList);
		}	
		/*
		* Name : addQuestions
		* Description : This function add the questions/answers	
		*/
	function addCommonQuestion()
	{	$this->layout	= 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		if(!empty($this->data)){
				$this->Commonquestion->set($this->data);
			    if ($this->Commonquestion->validates()) {
					//pr($this->data);
					$this->Commonquestion->save($this->data);
					$this->Session->setFlash('Question added Successfully!', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('manageCommonQuestion');
				}else{
					$this->render();
				}
		}	
	}
		/*
		* Name : editCommonQuestion
		* Description : This function edit the questions/answers	
		*/
			function editCommonQuestion($id=null){
			$this->layout = 'admin';
			$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
			$this->set('statusArray', $statusArray);	
			$this->set('id',$id);
			$this->Commonquestion->id=$id;	
			$userDesce = $this->Commonquestion->find('first', array('conditions' => array('Commonquestion.id' => $id)));
				if($this->data){
						if($this->Commonquestion->save($this->data))
							{
								$this->Session->setFlash('Question updated Successfully.', 'default', array('class' => 'errMsgLogin'));
								$this->redirect('manageCommonQuestion');	
							}
						}
							$this->data= $this->Commonquestion->read();
							$this->set('userDesce',$userDesce);
	
					}
		
			/*
		* Name : activateQuestions
		* Description : This function activate/deactivate the questions/answers	
		*/
		function activateCommonQuestion(){
		if(!empty($this->data['Commonquestion']['id'])){
			$existingStatus = $this->Commonquestion->find('first', array('conditions' => array('Commonquestion.id' => $this->data['Commonquestion']['id'])));
			$status = $existingStatus['Commonquestion']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->Commonquestion->id = $this->data['Commonquestion']['id'];
			$data['Commonquestion']['status'] = $finalStatus;
			if($this->Commonquestion->save($data)){
				echo $data['Commonquestion']['status']; 
				die;
			}
		}
	}
		
			/*
		* Name : removeQuestion
		* Description : This function activate/deactivate the questions/answers	
		*/
		function removeCommonQuestion(){//pr($this->data);die;
			if(isset($this->data['Commonquestion']['idArr']) && !empty($this->data['Commonquestion']['idArr'])){
			$idArr = explode(",", $this->data['Commonquestion']['idArr']);
		}

		if(isset($idArr[1]) && !empty($idArr[1])){
			$message = 'Selected Question removed successfully';
		}else{
			$message = 'Selected Question removed successfully.';
		}
		if($this->Commonquestion->deleteAll(array('Commonquestion.id'=>$idArr))){	

			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageCommonQuestion');
		}else{
		die('Question not deleted');
		}
		}	 
/**********************************End comman ASk Questions Grid**************************************/	 

	 
/**Manage social setting Start**/
	function manageSocialSetting()
		{
			$this->layout	= 'admin';
			$this->paginate = array('limit'=>'10',"order"=>'Socialsetting.id');
			$social = $this->paginate('Socialsetting');
			$this->set('social',$social);
			}
	/**Manage Tutorial End**/

	/* Add Tutorial */
	function addSocialSetting()
	{	$this->layout	= 'admin';
			if(!empty($this->data)){//pr($this->data);die('here');
				//$thumbimage='http://img.youtube.com/vi/YbT0xy_Jai0/0.jpg';
				//pr ($thumbimage);die;
			    $this->Socialsetting->set($this->data);
			    if ($this->Socialsetting->validates()) {
			
					$this->Socialsetting->save($this->data);
					$this->Session->setFlash('Social Site added Successfully!', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('manageSocialSetting');
				}else{
					$this->render();
				}
		}	
	}
	/* Add Tutorial */

	/* Edit Tutorial */
	function editSocialSetting($id = '')
	{
		$this->layout	= 'admin';
		
		$this->set('id',$id);
		$this->Socialsetting->id = $id;

		if(!empty($this->data)){
			    $this->Socialsetting->set($this->data);
			    if ($this->Socialsetting->validates()) {
			
					$this->Socialsetting->save($this->data);
					$this->Session->setFlash('Socialsetting updated Successfully!', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('manageSocialSetting');
				}else{
					$this->render();
				}
		}{
			$this->Socialsetting->id=$id;
			$this->data	= $this->Socialsetting->read();	


		}	
	}
	/* Edit Tutorial */




/*
	 * Deleting selected Tutorial
	 * */
	 function removeSocialSetting(){
//die('here');
		 if(isset($this->data['Socialsetting']['idArr']) && !empty($this->data['Socialsetting']['idArr'])){
			$idArr = explode(",", $this->data['Socialsetting']['idArr']);
		}

	if(isset($idArr[1]) && !empty($idArr[1])){
		$message = 'Selected Socialsettings removed successfully';
	}else{
		$message = 'Selected Socialsetting removed successfully';
	}
		if($this->Socialsetting->deleteAll(array('Socialsetting.id'=>$idArr))){	

			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageSocialSetting');
		}else{
			die('SocialSetting not deleted');
		}
	 }
	

	
/***************************************Manage setting Start*******************************************/
	function manageSetting()
		{
			$this->layout	= 'admin';
			$this->paginate = array('limit'=>'10',"order"=>'Setting.id');
			$setting = $this->paginate('Setting');
			$this->set('setting',$setting);
		}
	/**Manage setting End**/

	/* Add addSetting */
	function addSetting()
		{	
			$this->layout	= 'admin';
				if(!empty($this->data)){
					$this->Setting->set($this->data);
					if ($this->Setting->validates()) {
				
						$this->Setting->save($this->data);
						$this->Session->setFlash('Record added Successfully!', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('manageSetting');
					}else{
						$this->render();
					}
			}	
		}
	/* Add addSetting */

	/* Edit editSetting */
	function editSetting($id = '')
		{
			$this->layout	= 'admin';
			
			$this->set('id',$id);
			$this->Setting->id = $id;

			if(!empty($this->data)){
					$this->Setting->set($this->data);
					if ($this->Setting->validates()) {
				
						$this->Setting->save($this->data);
						$this->Session->setFlash('Record updated Successfully!', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('manageSetting');
					}else{
						$this->render();
					}
			}{
				$this->Setting->id=$id;
				$this->data	= $this->Setting->read();	


			}	
		}
	/* Edit editSetting */




	/* Deleting selected Setting * */
	 function removeSetting()
		{
			if(isset($this->data['Setting']['idArr']) && !empty($this->data['Setting']['idArr'])){
				$idArr = explode(",", $this->data['Setting']['idArr']);
			}
			if(isset($idArr[1]) && !empty($idArr[1]))
					{
						$message = 'Selected Record removed successfully';
					}
				else{
						$message = 'Selected Record removed successfully';
					}
			if($this->Setting->deleteAll(array('Setting.id'=>$idArr)))
				{	
					$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
					$this->redirect('manageSetting');
				}
			else{
				die('Setting not deleted');
			}
		}
	 
	/***************************************Manage setting End*******************************************/

	

}


