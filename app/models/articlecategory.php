<?php
class Articlecategory extends AppModel {
	var $name = 'Articlecategory';


	 var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Category name can not be empty.',
			),
			'isUnique' => array(
				'on' => 'create',
                'rule' => 'isUnique',
                'message' => 'This article category has already been created.',
            )
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Category title can not be empty.',
				)			
			),
		'type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Category type can not be empty.',
				),			
			)		

	
	);







}

