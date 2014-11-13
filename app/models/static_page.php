<?php
class StaticPage extends AppModel{
	var $name = "StaticPage";
    var $useTable = "static_pages";
    
    var $validate = array(
		'page_title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Page title can not be empty',
			),
					'allowedCharacters'=> array(
						'rule' => '|^[a-zA-Z ]*$|',
						'message' => 'Page title can only be letters.'
					),						
					'maxLength'=> array(
						'rule' => array('maxLength', 20),
						'message' => 'Page title can not be longer than 20 characters.'
					)
		),
		'alias' => array('allowedCharacters'=> array(
						'rule' => '|^[a-zA-Z_0-9 ]*$|',
						'message' => 'Alias can only be letters'
					),						
					'maxLength'=> array(
						'rule' => array('maxLength', 20),
						'message' => 'Alias title can not be longer than 20 characters.'
					)
		),
		'page_description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Page Description can not be empty.',
				),			
			),		

	
	);

}
