<?php
class Admin extends AppModel{
          var $name = "Admin";
          
         var $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Username can not be empty.',
			), 
			 'maxLength'=> array(
				'rule' => array('maxLength', 20),
				'message' => 'Username can not be longer than 20 characters.'
			 )
		),
		'firstname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'First name can not be empty.',
				)
		),
		'lastname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'First name can not be empty.',
				)
		),
		'contact' => array(
        		'numeric' => array(
           			'rule' => 'numeric',
            			'message' => 'Numbers only.'
       		 ),
			'rule' => array('minLength', 10),
			'message' => 'Phone number should be of 10 digits.'
        ),
		'lastname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Last name can not be empty.',
				)
		),
		
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Address can not be empty.',
				)
		),
		'zip' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'zip code can not be empty.',
				)
		),
		'password' => array(
			'notempty' => array(
			'rule' => array('notEmpty'),
			'message' => 'Password Can not be kept empty.'
		)
	),	
		'email' => array(
			 'notempty' => array(
             'rule' => array('email'),
             'allowEmpty' => false,
             'message' => 'Please Enter a valid Email Address.'
				)
		),
		'image' => array(
    		    'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Something went wrong with the file upload.',
				'required' => FALSE,
				'allowEmpty' => TRUE,
			),
        'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg','')),
        'allowEmpty' => true,
        'message' => 'Please upload a valid image.'
    ),
        'processUpload' => array(
				'rule' => 'processUpload',
				'message' => 'Something went wrong processing your file.',
				'required' => FALSE,
				'allowEmpty' => TRUE,
				'last' => TRUE,
			)
		/*'status'=> array(
			 'notempty' => array(
             'rule' => array('notEmpty'),
             'allowEmpty' => false,
             'message' => 'Please Enter a Status'
				)
		),*/
);
    //Function to validate admin
	function validateAdmin($data){
		$user = $this->find(array('username' => $data['username'], 'password' => md5($data['password'])), array('id', 'username'));
	    if(empty($user) == false)
            return $user['Admin'];
        return false;
    }
	//Ends here
}
