<?php
class Setting extends AppModel {
	var $name = 'Setting';
		var $validate = array(
		'type' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Type can not be empty.',
				)			
			),
		'name' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Name can not be empty.',
				)			
			),	
		'discription' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Discription content can not be empty.',
				)			
			),
	
		); 
}

