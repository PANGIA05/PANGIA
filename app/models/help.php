 <?php 
 class Help extends AppModel {

	var $name = 'Help';
	var $belongsTo = array(
			'Question' => array(
				'className'=> 'Question',
				'foreignKey'=> 'qus_id' ,
			)
	);
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Name can not be empty.',
				)
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Name can not be empty.',
				),
            'email' => array(
                'rule' => 'email',
                'message' => 'Please enter a valid Email Address.',
            ),
        ),
		'confirmemail' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'confirm email can not be empty.',
				)
		),
		'subject' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Message subject can not be empty.',
				)
		),
		'message' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Message can not be empty.',
				)
		)

);
}
    ?>

