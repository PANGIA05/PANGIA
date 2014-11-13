<?php
class Photoimage extends AppModel{
          var $name = "Photoimage";
		var $validate = array(
			'image' => array(
				'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
					'allowEmpty' => true,
					'message' => 'Please supply a valid image.'
				)
		);
		var $hasMany   = array('Phototag'=>array('className' => 'Phototag',
				'foreignKey' => 'imgid'));

		

}
?>
