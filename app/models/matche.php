<?php
class Matche extends AppModel {
	var $name = 'Matche';
	var $belongsTo = array(
			'User' => array(
				'className'=> 'User',
				'foreignKey'=> 'playerId' ,
			),
			'OpponentPlayer' => array(
				'className'=> 'User',
				'foreignKey'=> 'OpponentPlayerId' ,
			)
	);
	
	
}

