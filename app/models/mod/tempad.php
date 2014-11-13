<?php
class Tempad extends AppModel {
	var $name = 'Tempad';
	var $belongsTo = array(
			'User' => array(
				'className'=> 'User',
				'foreignKey'=> 'id' ,
			)
	); 

	 var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Ad name can not be empty.',
			),
					'allowedCharacters'=> array(
						'rule' => '|^[a-zA-Z0-9 ]*$|',
						'message' => 'Ad name can only be letters.'
					),						
					'maxLength'=> array(
						'rule' => array('maxLength', 20),
						'message' => 'Ad name can not be longer than 20 characters.'
					)
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Ad content can not be empty.',
				),			
			)		

	
	);







}

