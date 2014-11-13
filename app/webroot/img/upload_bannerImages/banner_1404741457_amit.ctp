<?php
class WebServiceController extends AppController {

	var $name = 'WebService';
	var $components = array('JqImgcrop','Email');
	var $helpers = array('Html', 'Session');	
	var $layout = '';	
	var $uses = array('User','Friend');
	
	function __dataDecode(){
		    $this->data = file_get_contents("php://input");
			
			//echo "Contents from  file_get_contents('php://input')----->";
			$this->data = preg_replace("/[\n\r]/","",$this->data);
			$this->data = json_decode($this->data);
			//
			if(empty($this->data)){//pr($this->data);die('okkkak singh');
				$this->data['User']	= $_REQUEST;
			}
			
			foreach($this->data['User'] as $k=>$v){
				if(trim($v) == ''){
					$response['error']		= 1;
					$response['response']['message']	= 'Please specify '.ucwords($k).'.';
					echo  json_encode($response);
					die();
				}
			}
	}
   	
   	
   	/******************************************************************************************************
	 *
	 * function is use to check that email is valid is not
	 * 
	 *******************************************************************************************************/

   	
   		function validateUSAZip($zip_code)
			{
	  		if(preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$zip_code))
	    			return true;
	  		else
	   			 return false;
			}
		/*
		* Name : register
		* Description : This function is used for register the user account.
		*/
		function register(){
			$this->__dataDecode();
				$data = $this->data;
				$username = $data['User']['userName'];
				$response	= array();
				$emptyuserName = $this->User->findByUsername($username);
			    	$emptyEmail = $this->User->findByEmail($this->data['User']['email']);
			
			    	
			if(isset($this->data['User']['password']))
			{
				$this->data['User']['confirm_password'] = $this->data['User']['password'] 	= md5($this->data['User']['password']);
				$this->data['User']['email_confirmation']	= 1;
				$this->data['User']['status']			= 1;
				$data = $this->data;
				$data['User']['firstname']=$this->data['User']['firstName'];
				$data['User']['lastname']=$this->data['User']['lastName'];
				$data['User']['username']=$this->data['User']['userName'];
				}

			if(!($this->__validEmail($this->data['User']['email'])) && !empty($this->data['User']['email']))
			{
				$response['error']		= 1;
				$response['response']['message']	= 'Please enter a valid email.';
				$this->set('response', $response);
				echo  json_encode($response);
				die();
		    	}
			if(!empty($emptyuserName) && !empty($data['User']['username']))
			{
				$response['error']		= 1;
				$response['response']['message']	= 'userName Already Exists';
				$this->set('response', $response);
				echo  json_encode($response);
				die();

			}
			if(!empty($emptyuserName)  && !empty($data['User']['username']))
			{
				$response['error']		= 1;
				$response['response']['message']	= 'userName Already Exists';
				$this->set('response', $response);
				echo  json_encode($response);
				die();
			}
		
			if(!empty($emptyEmail) && !empty($this->data['User']['email']))
			{
				$response['error']		= 1;
				$response['response']['message']	= 'Email Already Exists';
				$this->set('response', $response);
				echo  json_encode($response);
				die();

			}
			if(!empty($emptyemail)  && !empty($this->data['User']['email']))
			{
				$response['error']		= 1;
				$response['response']['message']	= 'email Already Exists';
				$this->set('response', $response);
				echo  json_encode($response);
				die();
			}
			if(!($this->validateUSAZip($this->data['User']['zip'])) && !empty($this->data['User']['zip']))
			{
				$response['error']		= 1;
				$response['response']['message']	= 'Please enter a valid Zip Code.';
				$this->set('response', $response);
				echo  json_encode($response);
				die();
		    	}
		
			else if($this->User->save($data))
			{
				$message	= "registered successfully";
				$response['error']	= 0;
				$response['response']['result']  = 'success';
				$response['response']['message']  = 'registered successfully';
				$this->set('response', $response);			
				echo  json_encode($response);
				die();
			}
			
			else
			{
			
				$response['error']		= 1;
				$response['response']['result']  = 'failure';
				$response['response']['message']	= 'registered unsuccessfully';
				$this->set('response', $response);
				echo  json_encode($response);
				die();
			}
		
			echo  json_encode($response);
			die();
		}
	
	
		/*
		* Name : createRandomToken
		* Description : This function is used for creating randon token into application.
		*/
		function createRandomToken(){
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


		function loginUser(){
			$this->__dataDecode();
			$data = $this->data;
			//pr($data);die;
			$username = $data['User']['userName'];
			$response	= array();
			$user = $this->User->find('first', array('conditions' => array('User.userName' => trim($username),'User.password' => md5($data['User']['password']))));
			$playerID = $user['User']['id'];
			if(!empty($user))
				{	
					$token= $this->createRandomToken();
					//pr($token);die;
					$this->data['User']['secToken'] = $token;
					if(empty($user['User']['secToken']) && !empty($user) )
						{
							unset($this->User->validate['password']);
 							unset($this->User->validate['confirm_password']);
							unset($this->data['User']['password']);
 							unset($this->data['User']['confirm_password']);
							$this->User->id=$playerID;
							//pr($this->data);die;
							if($this->User->save($this->data)){//die;
								$response['error']			= 0;
								$response['response']['result']  	= 'success';
								$response['response']['message']	= 'signed in successfully';
								$response['response']['playerId']  	= $playerID;
								$response['response']['secToken']  	= $token;
								$this->set('response', $response);
								echo  json_encode($response); 
								die();
					}
				}
				else if(!empty($user['User']['secToken']))
					{
							unset($this->User->validate['password']);
 							unset($this->User->validate['confirm_password']);
							unset($this->data['User']['password']);
 							unset($this->data['User']['confirm_password']);
							$this->User->id=$playerID;
							//pr($this->data);die;
							if($this->User->save($this->data)){//die;
								$response['error']			= 0;
								$response['response']['result']  	= 'success';
								$response['response']['message']	= 'signed in successfully';
								$response['response']['playerId']  	= $playerID;
								$response['response']['secToken']  	= $token;
								$this->set('response', $response);
								echo  json_encode($response); 
								die();
					}
						}
			}
			else
				{
				$response['error']			= 1;
					$response['response']['result']  	= 'failure';
					$response['response']['message']	= 'userName and Password does not Match';
					$this->set('response', $response);
					echo  json_encode($response);
					die();
					}		
					echo  json_encode($response);
					die();	
		}
		
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
			
		
		/*
		* Name : forgotPassword
		* Description : This function is used for Sending user new password.	
		*/
		function forgotPassword(){
			$this->__dataDecode();
			if(!empty($this->data)){
			$data = $this->data;
			$username = $data['User']['userName'];
			$userDetail = $this->User->find('first',array('conditions'=>array("User.username "=> $username)));
			if($username==null){
				echo $username;
				$response['error']			= 1;
				$response['response']['result']  	= 'failure';
				$response['response']['message']	= 'please Enter userName';
				$this->set('response', $response);
				echo  json_encode($response);
				die();
			}
			else{ 
				$userID = $userDetail['User']['id'];
				$data = $this->data;
				$email_to = $userDetail['User']['email'];
				if($userDetail['User']['username'] == ($username)){
					$password= $this->createRandomPassword();
					$new_password=md5($password);
					$this->User->id = $userID;
					$this->data['User']['password'] = trim($new_password);
					unset($this->User->validate['password']);
 					unset($this->User->validate['confirm_password']);
					if($this->User->save($this->data)){
						//Default Mail component is called, to send mail. We are setting the variables for sending email
						$this->Email->to = $email_to;
						//$this->Email->bcc = array($adminEmail);
						$this->Email->subject = 'Your password here';
						$this->Email->replyTo = EMAIL_REPLY;
						$this->Email->from = "iWrestled admin <".EMAIL_REPLY.">";
						//Here, the element in /views/elements/email/html/ is called to create the HTML body
						$this->Email->template = 'simple_message'; // note no '.ctp'
						//Send as 'html', 'text' or 'both' (default is 'text')
						$this->Email->sendAs = 'both'; // because we like to send pretty mail
						//Set view variables as normal
						$this->set('userDetail', $userDetail);
						$this->set("password", $password);
						//Do not pass any args to send()
						if($this->Email->send()){
							$response['error']			= 0;
							$response['response']['result']  	= 'success';
							$response['response']['message']	= 'Password send to your email id';
							$this->set('response', $response);
							echo  json_encode($response);
							die();
						}
					}
				}
				else{ 
					$response['error']			= 1;
							$response['response']['result']  	= 'failure';
							$response['response']['message']	= 'Password Enter valid email id';
							$this->set('response', $response);
							echo  json_encode($response);
							die();
				}
			}
		} 
	}
		/*
		* Name : updateProfile
		* Description : This function is used for update user profile.	
		*/
		function updateProfile(){
				$this->__dataDecode();
				//pr($this->data);die;
				
				if(!empty($this->data)){
					$data['User']['firstname'] = $this->data['User']['firstName'];
					$data['User']['wieght'] = $this->data['User']['wieght'];
					$data['User']['school'] = $this->data['User']['school'];
					$data['User']['id'] = $this->data['User']['playerId'];
					$data['User']['secToken'] = $this->data['User']['secToken'];
			$details = $this->User->find('first', array('conditions' => array('User.id' => $data['User']['id'],'User.secToken' => $data['User']['secToken'])));//pr($details);die;
				if(!empty($details)){
						if($this->User->save($data)){
							$response['error']			= 0;
							$response['response']['result']  	= 'success';
							$response['response']['message']	= 'Profile updated successfully.';
							$this->set('response', $response);
							echo  json_encode($response);
							die();
						}
						else
							{
							$response['error']			= 1;
							$response['response']['result']  	= 'failure';
							$response['response']['message']	= 'Profile does not updated successfully.';
							$this->set('response', $response);
							echo  json_encode($response);
							die();
							}
					}
						else
{
							$response['error']			= 1;
							$response['response']['result']  	= 'failure';
							$response['response']['message']	= 'UnAuthorized User';
							$this->set('response', $response);
							echo  json_encode($response);
							die();
}
}
			}
	
		/*
		* Name : getProfile
		* Description : This function is used for geting user profile information.
		*/
		function getProfile(){
				$this->__dataDecode();
				$data=$this->data;
				$playerId = $data['User']['playerId'];
				$token = $data['User']['secToken'];
				//pr($token);die('ok');
				$playerdetails = $this->User->find('first', array('conditions' => array('User.id' => $playerId,'User.secToken' => $token)));
						//pr($playerdetails);die;	
						if($playerdetails)
							{					
						$response['error']			= 0;
						$response['response']['firstName']  	= $playerdetails['User']['firstname'];
						$response['response']['wieght']  	= $playerdetails['User']['wieght'];
						$response['response']['school']  	= $playerdetails['User']['school'];
						$response['response']['profilePicture'] = LIVE_SITE.'/img/upload_userImages/'.$playerdetails['User']['image'];
						$this->set('response', $response);
						echo  json_encode($response);
						die();
			}
						else
							{
							$response['error']			= 1;
							$response['response']['result']  	= 'failure';
							$response['response']['message']	= 'UnAuthorized User';
							$this->set('response', $response);
							echo  json_encode($response);
							die();

}
}
		/*
		* Name : setProfilePicture
		* Description : This function is used for create Image from string.
		*/

		function createImage($string){
		//pr($string);die('okszzz');
		$data	= base64_decode($string);
		//echo ($data);die('oksss');
		
		$db_img = imagecreatefromstring($data); 
		//.pr($db_img);die;
		$type = "jpg";
		$name	= '';
		if ($db_img !== false) {
			switch ($type) {
			case "jpg":
			$rand 	= rand(0000, 9999);
			$name	= $rand."user.jpg";
			
			imagejpeg($db_img,$name, '100');
			$img = imagejpeg($db_img,$name, '100');
			break;
			
		}
		

		}
		return $name;
	
	
	}

		/*
		* Name : createThumbnail
		* Description : This function is used for create Thumbnail Image.
		*/
		function createThumbnail($imageDirectory, $imageName, $thumbDirectory, $thumbWidth)
		{
			$imgType	= explode('.',$imageName);
			
			
			 switch ($imgType[1])
			{
				case 'jpg' : $srcImg = imagecreatefromjpeg("$imageName"); break;
				case 'jpeg' : $srcImg = imagecreatefromjpeg("$imageName"); break;
				case 'gif': $srcImg = imagecreatefromgif("$imageName");  break; // best quality
				case 'png' : $srcImg = imagecreatefrompng("$imageName"); break;// no compression
				case 'bmp': $srcImg = imagecreatefromwbmp("$imageName"); break; // no compression
				default: $srcImg = imagecreatefromjpeg("$imageName"); break;
			}
			
			
			
			$origWidth = imagesx($srcImg);
			$origHeight = imagesy($srcImg);
			//echo "owidth $origWidth <br/>";
			//echo "ohight $origHeight";

			$ratio = $origHeight/ $origWidth;
			$thumbHeight = $thumbWidth * $ratio;

		
			$thumbImg = imagecreatetruecolor($thumbWidth, $thumbHeight);


			imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbWidth, $origWidth, $origHeight);
			 switch ($imgType[1])
			{
				case 'jpg' : imagejpeg($thumbImg, "$thumbDirectory/$imageName"); break;
				case 'jpeg' : imagejpeg($thumbImg, "$thumbDirectory/$imageName"); break;
				case 'gif': imagegif($thumbImg, "$thumbDirectory/$imageName");  break; // best quality
				case 'png': imagepng($thumbImg, "$thumbDirectory/$imageName"); break; // no compression
				case 'bmp': imagewbmp($thumbImg, "$thumbDirectory/$imageName"); break; // no compression
				default: imagejpeg($thumbImg, "$thumbDirectory/$imageName"); break;
			}
			imagedestroy($srcImg); 
			imagedestroy($thumbImg); 	
			//imagejpeg($thumbImg, "$thumbDirectory/$imageName");
		}
		
		/*
		* Name : setProfilePicture
		* Description : This function is used for Update user profile picture.
		*/
		function setProfilePicture(){ 
				$this->__dataDecode();
				$data=$this->data;
				pr($this->data);
				pr($data); 
				//print_R($this->data)
				echo $this->webroot.'/webroot/images/adv1.jpg';
				$string	= base64_encode(file_get_contents('http://softprodigy.in/iWrestled/webroot/images/adv1.jpg'));
				$playerId = $data['User']['playerId'];
				$token = $data['User']['secToken'];
			
				pr($string);die;
				if(isset($string) && $string !='' && $string !='NULL'){//pr('ok');die;
					$imageName		= $this->createImage($string);
					$imageDirectory		= '';
					$thumbDirectory		= 'img/upload_userImages';
					$thumbWidth			= 300;
					$this->createThumbnail($imageDirectory, $imageName, $thumbDirectory, $thumbWidth);
					$requiredData['profilePicture']	= 	$imageName;
					unlink($imageName);
					//pr($token);die('ok');
					$data['User']['id'] = $this->data['User']['playerId'];
					$data['User']['secToken'] = $this->data['User']['secToken'];
					$details = $this->User->find('first', array('conditions' => array('User.id' => $data['User']['id'],'User.secToken' => $data['User']['secToken'])));//pr($details);die;
					if(!empty($details)){
					
					$query		= "UPDATE users set image = '".$requiredData['profilePicture']."' WHERE id = '".$playerId."' and secToken = '".$token."' ";
	//pr($query);die;
					$resource	= mysql_query($query);
					if($resource){
						$response['error']		= 0;
						$response['response']['msg']	= "profilePicture Successfully changed.";
						$response['response']['profilePicture']	= PROFILE_IMAGE_URL.'upload_userImages/'.$requiredData['profilePicture'];				$response['response']['message']	= 'setProfilePicture successfully';
						$this->set('response', $response);
						echo  json_encode($response);
						die();

					}else{
				
						$response['error']		= 1;
						$response['response']['message']	= "setProfilePicture Un-successfully";
						$this->set('response', $response);
						echo  json_encode($response);
						die();	
					}
			
				}	else{
				
							$response['error']			= 1;
							$response['response']['result']  	= 'failure';
							$response['response']['message']	= 'UnAuthorized User';
							$this->set('response', $response);
							echo  json_encode($response);
							die();
					}
				}
				die;		
			}


		function getFriends(){
			$this->__dataDecode();
			$data=$this->data;
			$playerId=$data['User']['playerId'];
			$token = $data['User']['secToken'];
			//pr($token);die;
			$data['User']['id'] = $this->data['User']['playerId'];
					$data['User']['secToken'] = $this->data['User']['secToken'];
					$details = $this->User->find('first', array('conditions' => array('User.id' => $data['User']['id'],'User.secToken' => $data['User']['secToken'])));//pr($details);die;
					if(!empty($details)){
			$friends = $this->Friend->find('all',array('conditions'=>array('Friend.sid'=> $playerId,'Friend.status'=> '1')));//die('ok');
			if(!empty($friends))
				{	//pr($friends);die;
				$friendsArray	= array();
				foreach($friends as $key=>$val){
						//$friendDetail			= $this->getDetails($val->friend_id);
						if($val['Friend']['socialNetwork'] == 0){	
						$friendsArray[$key]['contactFriends']['firstName']	= $val['User']['firstname'];
						$friendsArray[$key]['contactFriends']['email']		= $val['User']['email'];
						//echo ($friendsArray[$key]['firstName']);die;
						if($val['User']['image'] !=''){
							$friendsArray[$key]['contactFriends']['profilePicture']	= PROFILE_IMAGE_URL.'upload_userImages/'.$val['User']['image'];
						}else{
							$friendsArray[$key]['contactFriends']['profilePicture']	= PROFILE_IMAGE_URL.'upload_userImages/'.'sample.png';
						}
						$friendsArray[$key]['contactFriends']['playerId']		= $val['User']['id'];
						$friendsArray[$key]['contactFriends']['socialNetwork']	= $val['Friend']['socialNetwork'];					
					}					
						if($val['Friend']['socialNetwork'] == 1){	
						$friendsArray[$key]['twitterFriends']['firstName']	= $val['User']['firstname'];
						$friendsArray[$key]['twitterFriends']['email']		= $val['User']['email'];
						//echo ($friendsArray[$key]['firstName']);die;
						if($val['User']['image'] !=''){
							$friendsArray[$key]['twitterFriends']['profilePicture']	= PROFILE_IMAGE_URL.'upload_userImages/'.$val['User']['image'];
						}else{
							$friendsArray[$key]['twitterFriends']['profilePicture']	= PROFILE_IMAGE_URL.'upload_userImages/'.'sample.png';
						}
						$friendsArray[$key]['twitterFriends']['playerId']		= $val['User']['id'];
						$friendsArray[$key]['twitterFriends']['socialNetwork']	= $val['Friend']['socialNetwork'];
					}
					if($val['Friend']['socialNetwork'] == 2){	
						$friendsArray[$key]['facebookFriends']['firstName']	= $val['User']['firstname'];
						$friendsArray[$key]['facebookFriends']['email']		= $val['User']['email'];
						//echo ($friendsArray[$key]['firstName']);die;
						if($val['User']['image'] !=''){
							$friendsArray[$key]['facebookFriends']['profilePicture']	= PROFILE_IMAGE_URL.'upload_userImages/'.$val['User']['image'];
						}else{
							$friendsArray[$key]['facebookFriends']['profilePicture']	= PROFILE_IMAGE_URL.'upload_userImages/'.'sample.png';
						}
						$friendsArray[$key]['facebookFriends']['playerId']		= $val['User']['id'];
						$friendsArray[$key]['facebookFriends']['socialNetwork']	= $val['Friend']['socialNetwork'];					
					}
				}
				
				$response['error']			= 0;
				$response['response']['friends']	= $friendsArray;
				$this->set('response', $response);
				echo  json_encode($response);
				die();
			
			}else{
				$response['error']		= 1;
				$response['response']['error']	='No friend found.';
				$this->set('response', $response);
				echo  json_encode($response);
				die();
			}
			}
			else{
				
							$response['error']			= 1;
							$response['response']['result']  	= 'failure';
							$response['response']['message']	= 'UnAuthorized User';
							$this->set('response', $response);
							echo  json_encode($response);
							die();
					}
		}
		
	
		
}
?>
