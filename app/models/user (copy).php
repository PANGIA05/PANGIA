 <?php 
 class User extends AppModel {

	var $name = 'User';
  	
 public $validate = array(
       /* 'uname' => array(
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'The username has already been taken.',
            ),

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        ),*/
        'name' => array(
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
								'allowEmpty' => false,
								'message' => 'Password Can not be kept empty'
							),
						'passwordlength' => array('rule' => array('between', 3, 8),
												  'message' => 'Enter 3-8 chars'),
						),	
        /*'phone' => array(
        'numeric' => array(
            'rule' => 'numeric',
            'message' => 'Numbers only'
        ),
			'rule' => array('minLength', 10),
			'message' => 'Phone number should be of 10 digits'
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
			)*/
    );
   
/*function checkpassword(){
	if(strcmp($this->data['User']['password'],$this->data['User']['confirm_password']) ==0){
		return true;
	}
	return false;
}
 function validateFrontendUser($data){
//pr($data); //die;
		$user = $this->find(array('email' => $data['email'],'password' => ($data['password'])), array('id','username','email','password','confirm_password','phone','image'));
			if(empty($user) == false){
//echo "success";
$user['User']['redirect_url']=$data['hidden_redirect'];
				return $user['User'];
			}
	}
	
	function checkExistingUser($userEmail = ''){
		if(isset($userEmail) && !empty($userEmail)){
			$userDesc = $this->find('first', array('conditions' => array('User.email' => $userEmail)));
			if(isset($userDesc['User']['email']) && !empty($userDesc['User']['email'])){
				if($userDesc['User']['email'] == $userEmail){
					return 1;
					
				}
				else
				{
					return 0;
					}
			}
		}
	} */
}
    ?>

