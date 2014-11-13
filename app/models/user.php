 <?php 
 class User extends AppModel {
	var $name = 'User';

/*var $hasMany = array(
			'Friend' => array(
				'className'=> 'Friend',
				'foreignKey'=> 'sid' ,
			)


);*/
  	
 public $validate = array(//die('model');

     'firstname' => array(
                'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        ),
	'lastname' => array(
                'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        ),
        'username' => array(
            'isUnique' => array(
				'rule' => 'isUnique',
                'message' => 'The username has already been taken.',
            ),

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        ),
        'email' => array(
            'email' => array(
                'on'   => 'create',
                'rule' => 'email',
                'message' => 'Please enter a valid Email Address.',
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Email address already in use.',
            ),
        ),
       'password' => array(
						
						'notempty' => array(
								'rule' => array('notEmpty'),
								'on'=>'create',
								'allowEmpty' => false,
								'message' => 'Password Can not be kept empty'
							),
						'passwordlength' => array('rule' => array('between', 3, 32),'on'=>'create',
												  'message' => 'Password must be between 3 and 32 characters'),
				'passwordequal'  => array('rule' =>'checkpassword','message' => 'Password and confirm password do not match')
		),	
		/*'zip' => array(
        'rule' => array('postal', null, 'us'),
        'message' => 'Invalid Zipcode.',
		),*/
		 'address'=>array(
				 'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
				),
               
                 ),
		'year' => array(
                        'valid' => array(
        'rule' => array('vDob'),
        'message' => 'Must be above 18 years old.'
				),
                ) ,
      /*	'image' => array(
        'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Something went wrong with the file upload',
				'required' => FALSE,
				'allowEmpty' => TRUE,
			),
        'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg','')),
        'allowEmpty' => true,
        'message' => 'Please upload a valid image.'
    ),	*/		
		'contact' => array(
        'rule' => array('phone', null, 'all'),
        'message' => 'Invalid Phone Number'
    ),
        
        
        'image' => array(
        'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Something went wrong with the file upload',
				'required' => FALSE,
				'allowEmpty' => TRUE,
			),
        'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg','')),
        'allowEmpty' => true,
        'message' => 'Please upload a valid image.'
    ),
        'processUpload' => array(
				'rule' => 'processUpload',
				'message' => 'Something went wrong processing your file',
				'required' => FALSE,
				'allowEmpty' => TRUE,
				'last' => TRUE,
			)
    );
   
		
		function checkpassword(){
			if(strcmp($this->data['User']['password'],$this->data['User']['confirm_password']) ==0){
			return true;
		}
			return false;
		}
		
		
		function checkExistingUser($userEmail = ''){
		if(isset($userEmail) && !empty($userEmail)){
			$userDesc = $this->find('first', array('conditions' => array('User.email' => $userEmail)));
			if(isset($userDesc['User']['email']) && !empty($userDesc['User']['email'])){
				if($userDesc['User']['email'] == $userEmail){
					return 1;
				}else{
					return 0;
				}
			}
		}
	}
		function checkAuthorization($data){
		//pr($data);die;
		$user = $this->find(array('email' => trim($data['email']), 'password' => md5($data['password'])), array('id', 'username','email','firstname','lastname','status','email_confirmation'));
		//	pr($user);die;
			if(empty($user) == false){
				if($user['User']['status'] == 1 && $user['User']['email_confirmation'] == 1){
					return $user['User'];
				}else if($user['User']['email_confirmation'] == 0){
					return 1;
				}else if($user['User']['email_confirmation'] == 1 && $user['User']['status'] == 0){
					return 2;
				}
			
	}
}
		function checkExistingEditUser($userEmail = '',$userId=''){//die('hehe');
		if(isset($userEmail) && !empty($userEmail)){
			$userDesc = $this->find('first', array('conditions' => array('User.email' => $userEmail,'User.id'=>$userId)));
			//pr($userDesc);die;
			if(isset($userDesc['User']['email']) && !empty($userDesc['User']['email'])){//pr($userDesc);die;
				if($userDesc['User']['email'] == $userEmail){
					
					return 0;
					
				}else{
					return 1;
					
				     }
				}
				else
				{
				$usernewDesc = $this->find('first', array('conditions' => array('User.email' => $userEmail)));	
					//pr($usernewDesc);die;
					if(isset($usernewDesc['User']['email']) && !empty($usernewDesc['User']['email'])){
					if($usernewDesc['User']['email'] == $userEmail){
					
						return 1;
			
					}else{
						return 0;
			
				     }
				}
			}
		}

	}
	
}
    ?>
