<?php
class Banner extends AppModel {
	var $name = 'Banner';
	 var $validate = array(
		'category' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Category can not be empty.',
				)			
			),	
		'title' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title can not be empty.',
				)			
			),
		'discription' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Discription can not be empty.',
				)			
			),
		'order' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Order can not be empty.',
				)			
			),
		'image' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Image can not be empty.',
				)
		 					
			),
	
		);
	
	
}
