<?php
class StaticPagesController extends AppController{
	var $name = "StaticPages";
	var $uses = array('StaticPage','User','Admin');  
	var $helpers = array('Html', 'Form', 'Javascript','Ajax','Fck');
	var $components = array('Email','RequestHandler', 'JqImgcrop'); 
	var $paginate = array('limit'=>'10');
	
	
	function beforeFilter()
	{
		$this->disableCache();
		$this->__validateLoginStatus();  
		$this->getManuSelected();                                          
	}
	
	
	function __validateLoginStatus()
    {
        if($this->action != 'login' && $this->action != 'logout' && $this->action != 'forgetPassword')
        {
            if($this->Session->check('Admin') == false && $this->Session->check('User') == false)
            {
				$this->Session->setFlash('The URL you have followed requires you login.');
               $this->redirect(array('controller' => 'Admins', 'action' => 'login'));               
            }
        }
    }
    
    /*
	 * Function to list static pages..
	 * */
	function managePage($id = null){
		$this->layout = 'admin';
		$pages = $this->paginate('StaticPage');
		$this->set('pages',$pages);
	}//Ends here

    
    
    /*
	 * Function to add pages
	 * */
	function addPage() {
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		if($this->data){
			$this->StaticPage->set($this->data);

			if ($this->StaticPage->validates()) {
			if(empty($this->data['StaticPage']['alias']))
			{
				$page_alias=strtolower(str_replace(" ","_",$this->data['StaticPage']['page_title']));				
				$this->data['StaticPage']['alias']=$page_alias;	
			}
			else
			{
				$this->data['StaticPage']['alias']=strtolower($this->data['StaticPage']['alias']);				
			}
			if ($this->StaticPage->save($this->data)) {
				
				$this->Session->setFlash('The page has been saved', 'default', array('class' => 'errMsgLogin'));
				$this->redirect('managePage');
			} else {
				$this->Session->setFlash('The page could not be saved', 'default', array('class' => 'errMsgLogin'));
			}
		}
		else {
						
				//die('in else');		// do nothing
					}
		}		
	}
	

	function editPage($id = ''){
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		$this->set('id',$id);
		$this->layout = 'admin';
		$this->StaticPage->id = $id;
		if(!empty($this->data)){
			    $this->StaticPage->set($this->data);
			    if ($this->StaticPage->validates()) {
			
				if(empty($this->data['StaticPage']['alias']))
				{
					$page_alias=strtolower(str_replace(" ","_",$this->data['StaticPage']['page_title']));				
					$this->data['StaticPage']['alias']=$page_alias;	
				}
				else
				{
					$this->data['StaticPage']['alias']=strtolower($this->data['StaticPage']['alias']);				
				}

					$this->StaticPage->save($this->data);
					$this->Session->setFlash('Page updated Successfully.', 'default', array('class' => 'errMsgLogin'));
					$this->redirect('managePage');
				}else{
					$this->render();
				}
		}{
			$this->StaticPage->id=$id;
			$this->data	= $this->StaticPage->read();	


		}		
	}
	/*
	 * Deleting selected records
	 * */
	 function removePage(){
			
		if(isset($this->data['StaticPage']['idArr']) && !empty($this->data['StaticPage']['idArr'])){
			$idArr = explode(",", $this->data['StaticPage']['idArr']);
		}
	if(isset($idArr[1]) && !empty($idArr[1])){
		$message = 'Selected Pages removed Successfully.';
	}else{
		$message = 'Selected Pages removed Successfully.';
	}
		$this->StaticPage->recursive = 0;
		
		if($this->StaticPage->deleteAll(array('id'=>$idArr))){	
			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('managePage');
		}else{
			die('not deleted');
		}
	 }
	 //Ends here
	//Ends here
	
	function activatePage(){
		
		if(!empty($this->data['StaticPage']['id'])){
			$existingStatus = $this->StaticPage->find('first', array('conditions' => array('StaticPage.id' => $this->data['StaticPage']['id'])));
			$status = $existingStatus['StaticPage']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->StaticPage->id = $this->data['StaticPage']['id'];
			$data['StaticPage']['status'] = $finalStatus;
			if($this->StaticPage->save($data)){
				echo $data['StaticPage']['status']; 
				die;
			}
		}
	}//Ends here

}
