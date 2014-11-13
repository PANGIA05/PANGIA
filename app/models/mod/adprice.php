<?php
class Adprice extends AppModel {
	var $name = 'Adprice';
	
	var $validate = array(
		'yearlyprice' => array(
					'allowedCharacters'=> array(
						'rule' => '|^\d*[.]?\d+$|',
						'message' => 'Yearly Price should be numeric!'
					),						
					),
		'monthlyprice' => array(
					'allowedCharacters'=> array(
						'rule' => '|^\d*[.]?\d+$|',
						'message' => 'Monthly Price should be numeric!'
					),						
					),
		'extrayearlyprice' => array(
					'allowedCharacters'=> array(
						'rule' => '|^\d*[.]?\d+$|',
						'message' => 'Extra Yearly Price should be numeric!'
					),						
					),
		'extramonthlyprice' => array(
					'allowedCharacters'=> array(
						'rule' => '|^\d*[.]?\d+$|',
						'message' => 'Extra Monthly Price should be numeric!'
					),						
					),
		
);


}

