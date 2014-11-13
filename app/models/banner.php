<?php
class Banner extends AppModel {
	var $name = 'Banner';
	 var $validate = array(
		'category' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Category can not be empty.',
				)			
			),	
		'title' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title can not be empty.',
				)			
			),
		'content' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Content can not be empty.',
				)			
			),
		'order' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Order can not be empty.'
			),
					'allowedCharacters'=> array(
						'rule' => '|^[0-9 ]*$|',
						'message' => 'Order should be Numeric only.'
					),
					'unique'=>array(
						'rule'=>'isUnique',
						'message'=>'Order must be uniqe.'
					)						
					
		),
		
		
		
		
		
		
		/*'order' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Category can not be empty.',
			),
			'allowedCharacters' => array(
						'rule' => 'numeric',
							'message' => 'Please enter only numerics.'
						),	
						'isUnique' => array(
							'on' => 'create',
							'rule' => 'isUnique',
							'message' => 'Order must be unique.',
						)
		),*/
		'image' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Image can not be empty.',
				),
		'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg','')),
        'allowEmpty' => true,
        'message' => 'Please upload a valid image.'
   
		 					
			),
	
		);
	
	
}
 
