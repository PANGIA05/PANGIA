<?php
class Commonquestion extends AppModel{
	var $name= 'Commonquestion';
	var $validate = array(
		'question' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Please Enter question.',
			),
										
					
		),
		'answer' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Please Enter Answer.',
			),
										
					
		)
	);


}
