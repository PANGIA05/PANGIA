 <?php 
 class Article extends AppModel {

	var $name = 'Article';
	
 	var $belongsTo = array(
				'User' => array(
				'className'=> 'User',
				'foreignKey'=> 'user_id' ,
			),
				'Category' => array(
				'className'=> 'Category',
				'foreignKey'=> 'category' ,
			),
				'Admin' => array(
				'className'=> 'Admin',
				'foreignKey'=> 'user_id' ,
			)
	); 
	var $hasMany = array(
			'Donation' => array(
				'className'=> 'Donation',
				'foreignKey'=> 'article_id' ,
			),
			'Updatedmessage' => array(
				'className'=> 'Updatedmessage',
				'foreignKey'=> 'article_idd' ,
			)
	);
	 var $validate = array(
		'amount' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Fundrise Amount can not be empty.',
				)
			), 
			
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title can not be empty.',
				)
		),
		'category' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Category can not be empty.',
				)
		),
		'summary' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Summary can not be empty.',
				)
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Description can not be empty.',
				)
		),
		
		
		
		
		'tmp_name' => array(
        'rule' => array('fileSize', '<=', '1MB'),
        'message' => 'Image must be less than 1MB'
		),
		'image' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Image can not be empty.',
				),
		'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg','')),
        'allowEmpty' => true,
        'message' => 'Please upload a valid image.'
   
		 					
			)

);
}
    ?>

