 <?php 
 class Tempdonation extends AppModel {

	var $name = 'Tempdonation';
	var $belongsTo = array(
			'Article' => array(
				'className'=> 'Article',
				'foreignKey'=> 'article_id' ,
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
			
		'firstname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'First name can not be empty.',
				)
		),
		'lastname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Last name can not be empty.',
				)
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Email can not be empty.',
				)
		),
		'country' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Country can not be empty.',
				)
		),
		'zip' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Zip code can not be empty.',
				)
		)

);
}
    ?>

