<?php
class Photo extends AppModel{
          var $name = "Photo";
		 var $validate = array(
			'album_name' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'required' => false,
					'message' => 'Album name required.',
				), 
				 'maxLength'=> array(
					'rule' => array('maxLength', 20),
					'message' => 'Album name can not be longer than 20 characters.'
				 )
				)
			
		);
		public $hasMany = array(
        'Photoimage' => array(
            'className'     => 'Photoimage',
            'foreignKey'    => 'album_id'
            
        )
       );
		

}
?>
