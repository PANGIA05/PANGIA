 <!--    Added New Html -->
 <div class="s-top-edit">
<div class="container-fullWidth">
<div class="row">
<div class="col-md-6">
<div class="login-top">
<?php $data = $this->Session->read('Admin');
		if(empty($data['id']))
		{
?>
<div class="edit-btn-top"> 
<a href="<?php echo LIVE_SITE; ?>/admins/login" class="btn btn-default edit-btn">Log in</a>
</div>
<?php }else
{?>
	<div class="edit-btn-top"> 
<a href="<?php echo LIVE_SITE; ?>/admins/logout" class="btn btn-default edit-btn">Log out</a>
</div>
	<?php }?>
</div>
</div>
</div>
</div>
</div>
 
 
 
 <!-- End New Html -->
  
  <div class="s-top">
         <div class="container">
           <div class="row">
           <div class="col-md-3 col-sm-3">
              <div class="logo"> <a href="<?php echo LIVE_SITE; ?>"><img src="<?php echo LIVE_SITE; ?>/img/logo_01.png" class="img-responsive" alt=""></a>
                 </div>
           </div>
                      <div class="col-md-9 col-sm-9  noPadding">
                  
   <nav class="navbar navbar-default navbar-custom" role="navigation">
  <div class="container-fluid">
<div class="navbar-header navbar-header-custom">
      <button type="button" class="navbar-toggle navbar-toggle-custom" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-collapse-custom" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav nav-custom">
        <li><a href="<?php echo LIVE_SITE; ?>/static/about">ABOUT US</a></li>
        <li><a href="#">MENU</a></li>
         <li><a href="#">GALLERY</a></li>
          <li><a href="#">VOUCHERS</a></li>
           <li><a href="<?php echo LIVE_SITE; ?>/admins/eventEdit">EVENTS</a></li>
            <li><a href="#">BLOG</a></li>
            <li><a href="<?php echo LIVE_SITE;?>/static/contact">CONTACT </a></li>
        
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

                               </div>
                                </div>
                                 </div>   
                                   </div>

                  </div>
