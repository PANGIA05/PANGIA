<?php
class Question extends AppModel{
	var $name= 'Question';
	var $actsAs = array('Containable');
	var $hasMany = array(
			'Help' => array(
				'className'=> 'Help',
				'foreignKey'=> 'qus_id',
			)
		);
	
	var $validate = array(
		'question' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Question can not be empty.',
				)			
			),
	   'title' => array(
		'isUnique' => array(
			'on'   => 'update',
			'rule' => 'isUnique',
			'message' => 'Title already in exists.',
			),
		),	
		'answer' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Answer can not be empty.',
				)			
			),	
		'title' => array(
			'checktitle'  => array('rule' =>'checkTitle','message' => 'Either Add Question Category or Select Question Category')		
			)		
		
	);
	
	function checkExistingCategory($catId,$name = '', $flag){
		if(isset($name) && !empty($name)){//pr($catId);
		$categoryDesc = $this->find('first', array('conditions' => array('Question.title' => $name))); 
		//pr($categoryDesc);
		if(isset($categoryDesc['Question']['title']) && !empty($categoryDesc['Question']['title'])){
			 if($flag == 1){ 
			  if($categoryDesc['Question']['id'] == $catId )
			  {
				  //die('here0ok');
					return 0;
			  }else
					{
					//die('here1');
					return 1;
				  }
			}
			else{
			    if(!empty($categoryDesc)){ 
						return 1;
					}
					else{ 
							return 0;
						}
				}  
		    }
		}
	}
		function checkTitle(){//pr($this->data);
			if(!empty($this->data))
			{
				$data=$this->data;
				if($data['Question']['title']=='' && $data['Question']['parent_id']==0)
				{//die('0');
					return 0;
				}
				else
				{//die('1');
					return 1;
				}
			}
		
	}


}
