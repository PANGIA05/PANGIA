<?php
class Refer extends AppModel {
	var $name = 'Refer';
	
	var $belongsTo = array(
			'User' => array(
				'className'=> 'User',
				'foreignKey'=> 'userid' ,
			)
	); 



//Function to Prevent existing user, with same useremail in refer table
	function checkExistingUser($userEmail = ''){
		if(isset($userEmail) && !empty($userEmail)){
			$userDesc = $this->find('first', array('conditions' => array('Refer.email' => $userEmail)));
			if(isset($userDesc['Refer']['email']) && !empty($userDesc['Refer']['email'])){
				if($userDesc['Refer']['email'] == $userEmail){
					return 1;
				}else{
					return 0;
				}
			}
		}
	}
//Ends here


}
