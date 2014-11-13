<?php
/* App Controller, This controller are execute very first from all controller*/
 class AppController extends Controller {
		var $helpers 	= array('Html','Javascript','Ajax','Session','Form');
		var $page=0;
		//var $uses	= array('Socialsetting');
		var $disable_login	= 0;
				
		function beforeFilter(){
			
		}
			/* Function for use get Manu Name for home page menu */	
		function getManuSelected(){//pr('ok');die;

			$url		= explode('/',$this->params['url']['url']);
			
			if($url){
				if(count($url)>1)
				{
				$url	= $url[1];
				}
				else
				{
				$url	= $url[0];
				}
			}
			$controller = strtolower($this->params['controller']);

			$publicMenuBar	= array('profile','database','connect','upgrade','about_us','terms','home','','dashboard','viewUserDetails','viewuser','myProfile','manageUsers','manageArticle','addArticle','editArticle','addCategory','managePage','editUser','editPage','addPage','addUser','manageCategory','addCategory','editCategory','donationlist','manageBanners','addBanner','editBanner','donationDetails','manageSetting','addSetting','editSetting','manageQuestion','addQuestion','editQuestion','manageCommonQuestion','addCommonQuestion','editCommonQuestion','manageSocialSetting','editSocialSetting','addSocialSetting','userlist');
			if(in_array($url,$publicMenuBar))
				{
				
					$this->set("is".$url,'current');	
				}else{
					$this->set("iscurrent",'df');	
				}

		}
		
		function getdateFormat($date)
		{
			return date('m.d.Y', strtotime($date));
		}
		
		/*Function for use remove last elements from array*/
		function removePrefferNotToAnswer($category)
		{
			if(!empty($category) && is_array($category))
			{
				array_pop($category);
				return $category;
			}
		}
}
?>
