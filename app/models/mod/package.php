<?php
class Package extends AppModel {
	var $name = 'Package';
	
	var $primaryKey="pkgid";

	var $validate = array(
		'yearlyprice' => array(
					'allowedCharacters'=> array(
						'rule' => '|^\d*[.]?\d+$|',
						'message' => 'Price should be numeric.'
					),						
					),
		'monthlyprice' => array(
					'allowedCharacters'=> array(
						'rule' => '|^\d*[.]?\d+$|',
						'message' => 'Price should be numeric.'
					),						
					),
		
);




}
