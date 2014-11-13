<?php
class Tournament extends AppModel {
	var $name = 'Tournament';
	
	var $belongsTo = array(
			'User' => array(
				'className'=> 'User',
				'foreignKey'=> 'uid' ,
			)
	); 

	public $validate = array(
        'tournamentname' => array(
                'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        ),
	  'tournamentdis' => array(
                'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
            ),
        ),
	 'email' => array(
            'email' => array(
                'on'   => 'create',
                'rule' => 'email',
                'message' => 'Please enter a valid Email Address.',
            ),
           
        ),
	   'image' => array(
        'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Something went wrong with the file upload.',
				'required' => FALSE,
				'allowEmpty' => TRUE,
			),
        'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg','')),
        'allowEmpty' => true,
        'message' => 'Please upload a valid image.'
    ),
        'processUpload' => array(
				'rule' => 'processUpload',
				'message' => 'Something went wrong processing your file.',
				'required' => FALSE,
				'allowEmpty' => TRUE,
				'last' => TRUE,
			)
    );
   
}
