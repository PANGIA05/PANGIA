<?php
class Socialsetting extends AppModel {
	var $name = 'Socialsetting';
		var $validate = array(
		'name' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Page Name can not be empty.',
				)			
			),	
		'url' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Page Url content can not be empty.',
				)			
			),
	
		); 
}

