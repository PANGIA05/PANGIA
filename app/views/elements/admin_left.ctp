<?php ?>
<ul id="adminmenu">
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'dashboard'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		
		<?php echo $html->link('DashBoard', array('controller'=>'admins', 'action' => 'dashboard'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$isdashboard, 'tabindex' => 1)); ?>
		
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image-admin"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'myProfile'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<?php echo $html->link('My Details', array('controller'=>'admins', 'action' => 'myProfile'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismyProfile, 'tabindex' => 1)); ?>
		
	
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image4"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'manageUsers'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
	
		
		<?php echo $html->link('Manage Users', array('controller'=>'admins', 'action' => 'manageUsers'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanageUsers.' '.@$iseditUser.' '.@$isaddUser.' '.@$isviewUserDetails.' '.@$isviewuser, 'tabindex' => 1)); ?>
		
		
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'manageCategory'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		
		<?php echo $html->link('Manage Category', array('controller'=>'admins', 'action' => 'manageCategory'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanageCategory.' '.@$iseditCategory.' '.@$isaddCategory, 'tabindex' => 1)); ?>
	</li>
	
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'manageArticle'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		
		<?php echo $html->link('Manage Article', array('controller'=>'admins', 'action' => 'manageArticle'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanageArticle.' '.@$iseditArticle.' '.@$isaddArticle.' '.@$isdonationlist.' '.@$isdonationDetails, 'tabindex' => 1)); ?>
	</li>
		<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'manageBanners'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		
		<?php echo $html->link('Manage Banners', array('controller'=>'admins', 'action' => 'manageBanners'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanageBanners.' '.@$iseditBanner.' '.@$isaddBanner.' '.@$iseditadPrice, 'tabindex' => 1)); ?>
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'static_pages', 'action' => 'managePage'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>

		
		<?php echo $html->link('Manage Pages', array('controller'=>'static_pages', 'action' => 'managePage'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanagePage.' '.@$iseditPage.' '.@$isaddPage, 'tabindex' => 1)); ?>
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'manageQuestion'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>

		
		<?php echo $html->link('Manage FAQ', array('controller'=>'admins', 'action' => 'manageQuestion'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanageQuestion.' '.@$iseditQuestion.' '.@$isaddQuestion, 'tabindex' => 1)); ?>
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'manageCommonQuestion'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>

		
		<?php echo $html->link('Common Question', array('controller'=>'admins', 'action' => 'manageCommonQuestion'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanageCommonQuestion.' '.@$iseditCommonQuestion.' '.@$isaddCommonQuestion, 'tabindex' => 1)); ?>
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'manageSetting'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<?php echo $html->link('Manage Setting', array('controller'=>'admins', 'action' => 'manageSetting'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanageSetting.' '.@$iseditSetting.' '.@$isaddSetting, 'tabindex' => 1)); ?>
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'manageSocialSetting'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
	
		
		<?php echo $html->link('Social Setting', array('controller'=>'admins', 'action' => 'manageSocialSetting'), array('escape' => false, 'class' => 'wp-first-item currentcl menu-top menu-top-first menu-top-last gap '.@$ismanageSocialSetting.' '.@$iseditSocialSetting.' '.@$isaddSocialSetting.' '.@$isuserlist, 'tabindex' => 1)); ?>
		
		
	</li>
	


	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><?php echo $html->link('<br>', array('controller'=>'admins', 'action' => 'logout'), array('escape' => false)); ?></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<a tabindex="1" class="wp-first-item currentcl menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>admins/logout">Logout</a>
	</li>
</ul>
