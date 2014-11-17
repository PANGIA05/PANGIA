<?php
class StaticController extends AppController {
	var $name = 'Static';
	//var $helpers = array('Html', 'Session', 'Form', 'Javascript','Ajax','Fck');
	var $components = array('Email');
	var $uses	= array('User','Admin','StaticPage','Articlecategory','Article','Banner','Articlecategorie','Setting','Category','Question','Help','Commonquestion','Socialsetting');
	//var $layout	= 'home';

	function beforeFilter() {
		$this->getManuSelected();
	}

	function index()
	{	 
		$flagForHomePafe2	= false;
		$pagename= $this->params['url']['url'];
		//$this->set('title_for_layout', 'Error');

		if($pagename == '/' || $pagename == 'redirect:/app/webroot/index.php'){
			$this->layout	= 'home';
			$pagename	= 'index';
			$this->set('title_for_layout', 'Home');
		}
		if($pagename==null)
		{
			$this->layout	= 'homesubCategory';	
			 $this->set('title_for_layout', 'Home');
			$this->redirect('index');
			
		}

		$query = $this->StaticPage->find('first',array('conditions'=>array('alias'=>$pagename,'status'=>'1')));
		if(!empty($query)){
			$this->layout = 'static'; 
			
		}
			$query = $this->StaticPage->find('first',array('conditions'=>array('alias'=>$pagename,'status'=>'1')));
			$this->set('alias',$query['StaticPage']['alias']);
			$this->set('title',$query['StaticPage']['page_title']);
			$this->set('title_for_layout', $query['StaticPage']['page_title']);
			$this->set('meta_keywords',$query['StaticPage']['meta_keyword']);
			$this->set('meta_description',$query['StaticPage']['meta_description']);
			$this->set('page_description',$query['StaticPage']['page_description']);
			 
		}
		 
    /*  opening a event page from Menu link */
	function event(){	
		$this->layout	= 'home';
	}
	
  /*  opening a Contact page from Menu link */	
	function contact(){
		$this->layout = 'home';
	}
	/*  opening a Login page and validating the admin from Menu link */	
	function login(){
		$this->layout='admin';
		if(empty($this->data) == false){ 
			
			if(($user = $this->Admin->validateAdmin($this->data['Admin'])) == true){
				 $this->Session->write('Admin', $user);
				 $this->Session->setFlash('You have successfully logged in.');
				 $this->Session->setFlash('You have successfully logged in.', 'default', array('class' => 'errMsgLogin'));
				 $this->redirect('/');
				exit();
			}
			else{ $this->Session->setFlash('Please enter valid Username/Password', 'default', array('class' => 'errMsgLogin'));  }  	
		}	
	}
	/*  opening a about us page from Menu link */	
	function about(){
		$this->layout="home";
		
	}
	
	/*  opening a  Event Edit Page page from Menu link */
	function eventEdit(){		
		$this->layout='home';
	}
	
	/*  opening a  Event Member Page page from Menu link */
	function members(){
		$this->layout="home";		
	}
	/*  opening a  Edit Event Member Page page from Menu link */
	function editMembers(){
		$this->layout='home';
	}
	 function category()
	{
				$category = $this->Category->find('all', array('conditions' => array('Category.parent_id' => 0,'Category.status' => 1), 'order' => array('Category.category ASC')));
				//pr($category);die('her');
				return($category);
				
			}
	function getsubcategory($id=null)
	
			{
				$subcategory = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$id)));
				return($subcategory);
				
			}			
	function getcategory()
			{
				$getcategory = $this->Articlecategory->find('all', array('conditions' => array('Articlecategory.type' => 'ALL CATEGORIES','Articlecategory.status' => 1)));
				return($getcategory);
				
			}
	function getcategorycomman()
			{
				
				$getcategorycomman = $this->Articlecategory->find('all', array('conditions' => array('Articlecategory.type' => 'MOST COMMON','Articlecategory.status' => 1)));
				return($getcategorycomman);
			}		
	function getarticle()
			{
				$getarticle = $this->Article->find('all', array('conditions' => array('Article.status' => 1),'order' => array('Article.id' => 'desc'),'limit'=>'9'));
				//pr($getarticle);
				return($getarticle);
			}
	function getpopulerarticle()
			{
				$getarticle = $this->Article->find('all', array('conditions' => array('Article.status' => 1),'order' => array('Article.totaldonation' => 'desc'),'limit'=>'9'));
				//pr($getarticle);
				return($getarticle);
			}
	function getlivearticle()
			{
				$getarticle = $this->Article->find('all', array('conditions' => array('Article.status' => 1),'order' => array('Article.id' => 'desc'),'limit'=>'9'));
				//pr($getarticle);
				return($getarticle);
			}				
	function getbanner()
			{
				$getbanner = $this->Banner->find('all', array('order' => array('Banner.order ASC')));
				//pr($getbanner);die('here');
				return($getbanner);
			}	
	function footer()
			{
				$footerdata = $this->Setting->find('first', array('conditions' => array('Setting.type' => 'Footer')));
			
				return($footerdata);
			}		
			
			
	function getcats($id=null)
			{
				
				$details = $this->Articlecategorie->find('first', array('conditions' => array('Articlecategorie.id' => $id)));
				$res=$details['Articlecategorie']['name'];
				return $res;		
				
			}
		/*
		* Name : zipnamesearch
		* Description : This is used for serch the zip,category,title
		*/		
				
	function zipnamesearch()
		{
			$this->layout = false;
			$q=$_REQUEST['searchword'];
			//pr($q);die;
			//$search = $this->Article->find('all',array('conditions'=>array('User.zip'=>$q,'Article.publicprivate'=>8)));
			//pr($search);die;
			$search = $this->Article->find('all',
								array('conditions'=>
								array('Article.publicprivate'=>0,'Article.status'=>1,'OR'=>
								array('Category.category'=>$q,
										'User.zip'=>$q,
										'Admin.zip'=>$q,
										'Article.title LIKE'=>'%'.$q.'%'))));
			//echo "<pre>"; print_r($search);
			$this->set('search',$search);
			$this->set('q',$q);
			$html=$this->render();
			echo $html;
			die;					
		
			
		}
		/*
		* Name : zipnamesearch
		* Description : This is used for serch the zip,category,title
		*/		
				
	function titlesearch()
		{
			$this->layout = false;
			$q=$_REQUEST['searchword'];
			$search = $this->Article->find('all',
								array('conditions'=>
								array('Article.publicprivate'=>0,'Article.status'=>1,'OR'=>
								array('Article.title LIKE'=>'%'.$q.'%'))));
			//echo "<pre>"; print_r($search);
			$this->set('search',$search);
			$this->set('q',$q);
			$html=$this->render();
			echo $html;
			die;					
		
			
		}	
			/*
		* Name : zipsearch
		* Description : This is used for serch the zip
		*/		
				
	function zipsearch()
		{
			$this->layout = false;
			$q=$_REQUEST['searchword'];
			$search = $this->Article->find('all',
								array('conditions'=>
								array('Article.publicprivate'=>0,'Article.status'=>1,'OR'=>
								array(
										'User.zip'=>$q,
										'Admin.zip'=>$q
										))));
			//echo "<pre>"; print_r($search);
			$this->set('search',$search);
			$this->set('q',$q);
			$html=$this->render();
			echo $html;
			die;					
		
			
		}
			/*
		* Name : zipnamesearch
		* Description : This is used for serch the zip,category,title
		*/		
				
	function categorysearch()
		{
			$this->layout = false;
			$q=$_REQUEST['searchword'];
			$search = $this->Article->find('all',
								array('conditions'=>
								array('Article.publicprivate'=>0,'Article.status'=>1,'OR'=>
								array('Category.category'=>$q))));
			//echo "<pre>"; print_r($search);
			$this->set('search',$search);
			$this->set('q',$q);
			$html=$this->render();
			echo $html;
			die;					
		
			
		}
		
		/*
		* Name : viewarticle
		* Description : This is fatching all the record from serach keyword.
		*/	
	function viewarticle($type=null)
		{	
			$this->layout = 'comman';
			$final_title=str_replace('_',' ', $type);
			$articles = $this->Article->find('all',
								array('conditions'=>
								array('Article.publicprivate'=>0,'Article.status' =>1,array('OR'=>array('Category.category'=>$type,'User.zip'=>$type,'Admin.zip'=>$type,
								'Article.title'=>$final_title))),'limit'=>'9'));
								 
			$this->set('article',$articles);
	
		}	
		/*
		* Name : getcat
		* Description : This is used for fatching the record on the bases of category
		*/
	function getcat($cat=null)
		{	
			$this->layout = 'comman';
			$catName = $_GET['cat'];
			
			$categoryname=str_replace('_',' ', $catName);
			$articledata=$this->Article->find('all',array('conditions'=>array('Category.category'=>$categoryname,'Article.status' => 1,'Article.publicprivate'=>0),'order' => 'RAND()','limit'=>'9'));
			$this->set('article',$articledata);
		}
			/*
		* Name : contact
		* Description : This is used for Showing the Dropdown for FAQ 
		*/
	function contact1($cat=null)
		{	
			$this->layout = 'comman';
			$contactData=$this->Question->find('all',array('conditions'=>array('Question.parent_id'=>0)));
			//pr($contactData);die('here');
			$contactDrop=array();
			$contactDrop['0']='Please make a select..';		
			if(!empty($contactData)){
				
				foreach($contactData as $key=>$val)
				{
					$contactDrop[$val['Question']['id']]=$val['Question']['title'];
				}
			}
			$this->set('contactDrop',$contactDrop); 
			//pr($contactDrop);die('here');	
		}
	/*
		* Name : getquestion
		* Description : This is used for Showing the Dropdown for Question Category List in FAQ
		*/	
	function getquestion($qId = "")
	{
		$this->layout = '';
		if(!empty($qId)){
			$questionData = $this->Question->find('all',array('conditions'=>array('OR'=>array('Question.parent_id'=>$qId,'Question.id'=>$qId))));
			//pr($questionData);
			$questionDrop=array();
			$questionDrop['0']='Please make a select..';		
			if(!empty($questionData)){
				foreach($questionData as $key=>$val)
				{
					$questionDrop[$val['Question']['id']]=$val['Question']['question'];
				}
				$this->set('questionDropAjax',$questionDrop);
			}
		}
		return true;
	}
		/*
		* Name : getquestionanswer
		* Description : This is used for Showing Questions and answer list In FAQ
		*/
	function getquestionanswer($Id = "")
	{//die('here');
		$this->layout = '';
		if(!empty($Id)){
			$qesansData = $this->Question->find('first',array('conditions'=>array('Question.id'=>$Id)));
			//pr($qesansData);
			$this->set('qesansData',$qesansData);	
		
		}
		return true;
	}
	
		function subCategory($id = null)
			{//pr($id);die;
			$this->layout = '';
				if(!empty($id)){
				$subcategoryData = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$id)));
				//pr($qesansData);
				$this->set('subcatData',$subcategoryData);
				$this->set('id',$id);	
 
				}
				return true;
				}
		
				
	
	/*
	* Name : nl2p
	* Description : This is used for paragraph spaning 		*/		
		function nl2p($str) {
			$arr=explode("\n",$str);
			$out='';

		for($i=0;$i<count($arr);$i++) {
			if(strlen(trim($arr[$i]))>0)
			$out.='<p>'.trim($arr[$i]).'</p>';
			}
			return $out;
		}
	/*
	* Name : contactus
	* Description : This is used for user contact to admin Regarding any Query 		*/		
		
	function contactus($qusID = ""){	
			$this->layout = 'comman';
			if(!empty($this->data))
				{
					$data=$this->data;
					$str=$data['Help']['message'];
					$data['Help']['message']= $this->nl2p($str);
					$data['Help']['qus_id']=$qusID;
						if ($this->User->validates()) {
							if($this->Help->save($data)){//pr($data);die;
								$this->set('helpDetails', $data['Help']);
								$this->Email->to = CLIENT_Email;
								$this->Email->subject = $data['Help']['subject'];
								$this->Email->replyTo = EMAIL_REPLY;
								$this->Email->from = $data['Help']['email'];
								$this->Email->template = 'help_contactus'; 
								$this->Email->sendAs = 'both';
							if($this->Email->send()){
								$this->Session->setFlash('Message sent successfully.', 'default', array('class' => 'errMsgLogin'));
							}
						$this->redirect('helpThanks');
						}
						else{
							$this->Session->setFlash('Unable to sent message.', 'default', array('class' => 'errMsgLogin'));
							$this->redirect('contactus/'.$qusID);
						}
					}else
						{
							$this->Session->setFlash('Unable to sent message.', 'default', array('class' => 'errMsgLogin'));
						}
				}
			}
	function helpThanks(){
		$this->layout = 'staticpages';
	}
	
	/*
	* Name : faq
	* Description : This is used for show the rating for the asked questions*/		
		
		function faq(){
		$this->layout = 'comman';
		$faqData = $this->Question->find('all', array('conditions' => array('Question.status' => 1)));
		$totalHelpCount = count($this->Help->find('all'));
		$this->set('totalHelpCountt',$totalHelpCount);
				foreach($faqData as $key=>$val)
						{
							$helpCount=count($val['Help']);
							$vals[$key]['Count']=$helpCount;
							$vals[$key]['id']=$val['Question']['id'];
							$vals[$key]['title']=$val['Question']['title'];
							$vals[$key]['question']=$val['Question']['question'];
							$vals[$key]['answer']=$val['Question']['answer'];
						}
						
						array_multisort($vals, SORT_DESC, $faqData);
						$this->set('faq',$vals);
						//pr($vals);die('here');
					}
		/*
	* Name : faq
	* Description : This is used for show the rating for the asked questions*/	
	function questions()
	{
		$this->layout = 'comman';
		$CommonQuestion = $this->Commonquestion->find('all', array('conditions' => array('Commonquestion.status' => 1)));
		$this->set('CommonQuestions',$CommonQuestion);
	}
	
	/*fatch record for social setting*/
	function socailLink(){
			$socialDetail = $this->Socialsetting->find('all');
			return($socialDetail);
				
			}	
	/*function subCategory($id)
		{
			$this->layout= false;
			pr($id);die('here');
		}	*/
		
		/*
		* Name : getquestion
		* Description : This is used for Showing the Dropdown for Question Category List in FAQ
		*/	
	function getzipcategory()
		{
		$zip = $_GET['zip'];
		$catName = $_GET['cat'];
		$this->layout = 'comman';
		if((!empty($zip)) && (!empty($catName))){
			$searchResult = $this->Article->find('all',
								array('conditions'=>
								array('Article.publicprivate'=>0,'Article.status'=>1,'Category.category'=>$catName,'OR'=>
								array(	
										'User.zip'=>$zip,
										'Admin.zip'=>$zip
										)),'limit'=>'9'));
				$this->set('searchResult',$searchResult);
			
		} 
		if((!empty($zip)) && (empty($catName)))
		{
			$searchResult = $this->Article->find('all',
								array('conditions'=>
								array('Article.publicprivate'=>0,'Article.status'=>1,'OR'=>
								array(	'User.zip'=>$zip,
										'Admin.zip'=>$zip
										)),'limit'=>'9'));
				$this->set('searchResult',$searchResult);
		}if ((empty($zip)) && (!empty($catName)))
		{
			
			$searchResult = $this->Article->find('all',
								array('conditions'=>
								array('Article.publicprivate'=>0,'Article.status'=>1,'Category.category'=>$catName),'limit'=>'9'));
				$this->set('searchResult',$searchResult);
		}
		
	}	
			/*
		* Name : allpopulerarticle
		* Description : This is used for Showing all the populer article
		*/
	function allpopulerarticle()
		{
			$this->layout = '';
			
				$populerArticle = $this->Article->find('all',array('order' => array('Article.totaldonation' => 'desc')));
				//pr($populerArticle);
				$this->set('populerArticle',$populerArticle);	
			
			
			return true;
		}
				/*
		* Name : getquestionanswer
		* Description : This is used for Showing all the live article
		*/
	function alllivearticle()
		{
			$this->layout = '';
			
				$liveArticle = $this->Article->find('all',array('order' => array('Article.id' => 'desc')));
				//pr($liveArticle);
				$this->set('liveArticle',$liveArticle);	
			return true;
		}
}
