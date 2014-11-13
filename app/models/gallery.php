<?php
class Gallery extends AppModel {
	var $name = 'Gallery';
	
	var $belongsTo = array(
			'User' => array(
				'className'=> 'User',
				'foreignKey'=> 'uid' ,
			)
	); 
}
