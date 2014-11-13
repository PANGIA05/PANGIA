<?php
class Player extends AppModel{
          var $name = "Player";
          
         var $validate = array(
		'players' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Player category can not be empty.',
			), 
			
			'numeric' => array(
           			'rule' => 'numeric',
            			'message' => 'Please enter only numerics.'),
			'isUnique' => array(
				'on' => 'create',
                'rule' => 'isUnique',
                'message' => 'This player category has already been created.',
            )
		)
		
);
 
}
