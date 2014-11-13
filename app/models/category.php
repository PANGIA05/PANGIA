<?php
class Category extends AppModel{
	var $name= 'Category';
	var $actsAs = array('Containable');
	
	var $validate = array(
		'category' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Please Enter Category Name.',
			),
					'allowedCharacters'=> array(
						'rule' => '|^[a-zA-Z ]*$|',
						'message' => 'Category Name can only be letters.'
					),						
					
		)
	);
	
	function checkExistingCategory($catId,$name = '', $flag){
		if(isset($name) && !empty($name)){
		$categoryDesc = $this->find('first', array('conditions' => array('Category.category' => $name))); 
		//pr($hospitalDesc); echo $hosId; die;
		if(isset($categoryDesc['Category']['category']) && !empty($categoryDesc['Category']['category'])){
			 if($flag == 1){ 
			  if($categoryDesc['Category']['id'] == $catId){
				 return 0;
			  }else{
				  return 1;
				  }
			}else{
			    if(!empty($categoryDesc)){ return 1;}else{ return 0;}
			}  
		    }
		}
	}


}
