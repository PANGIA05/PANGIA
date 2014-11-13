 <?php 
 class Updatedmessage extends AppModel {

	var $name = 'Updatedmessage';
	
 	/*var $belongsTo = array(
			'User' => array(
				'className'=> 'User',
				'foreignKey'=> 'user_id' ,
			),
			'Articlecategory' => array(
				'className'=> 'Articlecategory',
				'foreignKey'=> 'category' ,
			)
	); 
	var $hasMany = array(
			'Donation' => array(
				'className'=> 'Donation',
				'foreignKey'=> 'article_id' ,
			)
	);*/
	 var $validate = array(
		
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Message can not be empty.',
				)
		)

);
}
    ?>

