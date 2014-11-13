<?php
//pr($user_detail); die;
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<!-- Set the viewport width to device width for mobile -->
<meta http-equiv="X-UA-Compatible" content="IE=9" >
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
<title>
		<?php __('GoFundMe'); ?>
		<?php echo $title_for_layout; ?>
</title>

  <meta property="og:title" content="GoFundMe"/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content="<?php echo LIVE_SITE; ?>/images/logo.png"/>
    <meta property="og:description" content=""/>
    <meta property="og:site_name" content="GoFundMe.is"/>
    <meta property="og:type" content="website"/>
	<?php echo $this->Html->meta('keywords',@$meta_keywords);?>
	<?php echo $this->Html->meta('description',@$meta_description);?>
	<?php echo $this->Html->css('style_front'); ?>
	<?php echo $this->Html->css('media'); ?>
	<?php //echo $this->Html->css('rating'); ?>
	<?php //echo $this->Html->script('rating_jquery_min'); ?>
<!--[if lt IE 9]>
<script src="<?php echo LIVE_SITE; ?>/js/html5shiv.js"></script>
<link href="<?php echo LIVE_SITE; ?>/OCP/css/ie9.css" type="text/css" rel="stylesheet">
<![endif]-->
<?php //echo @$user_detail['User']['analytic'] ?>
</head>

<body>
	 <?php echo $this->element('front_header'); ?>
	

	<section class="mid_part_container">
		<section class="mid_part">
			<article class="right_side_inner">
			</article>
			<article class="left_side_inner">
	 		 <?php echo $this->Session->flash(); ?>
             <?php //pr($user_info); 
$_SESSION['username']=$this->Session->read('User.username'); 
//echo count($mymessages['Message']); 
//die;
 ?>

<!--  <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->

  	<?php echo $this->Html->script('jquery-ui'); ?>


<?php echo $this->Html->css('jquery-ui.css');
 ?>
  
<div class = "refer_msg_success"></div>
<div class="social_icons" style="margin-bottom:10px;">
<div style="float:left; width:80px;">
<div id="fb-root"></div>
<!--<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fcukie.is%2F&amp;width=450&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
</div>
<div style="float:left; width:88px;">
<!--Code For twitter  starts here-->
	<!--	<a href="https://twitter.com/share" class="twitter-share-button" data-url="cukie.is" data-text="Had to share this great platform I just joined; want to consult or looking for a consultant? Than you need to check out this site! Cukie.is">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!--Code For twitter  ends here-->
</div>
<div style="float:left; width:101px;">
<!--Code For linkedin  starts here-->
		<!--<script src="//platform.linkedin.com/in.js" type="text/javascript">
		 lang: en_US
		</script>
		<script type="IN/Share" data-url="http://cukie.is/" data-title ="Had to share this great platform I just joined; want to consult or looking for a consultant? Than you need to check out this site! Cukie.is
" data-counter="right"></script>
<!--Code For linkedin  Ends here-->
</div>

<div style="float:left; width:60px;">
<!--Code For Google+ starts here-->
		<!-- Place this tag where you want the share button to render. -->
		<!--<div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://cukie.is/"></div>

		<!-- Place this tag after the last share tag. -->
		<script type="text/javascript">
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
<!--Code For Google+ ends here-->
</div>
</div>
<div id="tabs" class="top_Tabs <?php if(($user_info['User']['mem_type'])=='BPM'){echo 'no_border';} ?>">

   <div id="tabs-1">
	  
    <script src='http://connect.facebook.net/en_US/all.js'></script>
  <script>
    FB.init({appId: "<?php echo FB_APP_ID; ?>", status: true, cookie: true});
  function fbpost(title, picture, desc)
	  {
	  var descriptiontopost = "Cukie";
	  
	  var obj = {
	    method: 'feed',
	    link: "<?php echo LIVE_SITE; ?>",
	    picture: picture,
	    name: descriptiontopost,
	    caption: '',
	    description: desc
	  };
    FB.ui(obj, callback);
      }

	  function callback(response) {
	  // document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
	  }

      
  </script>


<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php echo $this->Html->script('niceforms.js');
echo $this->Html->css('niceforms-default.css');
?>
<script type="text/javascript">
//SI.Files.stylizeAll();
//SI.Files.stylizeById('input-id');
</script>
<script>
function ValidPassword()
{
	var curr_pass=document.getElementById('UserCurrentPassword').value;
	var new_pass=document.getElementById('UserPassword').value;
	var newre_pass=document.getElementById('UserRepassword').value;
	if(curr_pass!="")
	{
		if(new_pass=="")
		{
			alert('Please enter new password');
			return false;
		}
		else if(newre_pass=="")
		{
			alert('Please re enter password');
			return false;
		}
		else
		{
			return true;
		}

	}
	else if(new_pass!="")
	{
		if(curr_pass=="")
		{
			alert('Please enter your current password');
			return false;
		}
		else if(newre_pass=="")
		{
			alert('Please re enter password');
			return false;
		}
		else
		{
			return true;
		}
	}
	else if(newre_pass!="")
	{
		if(curr_pass=="")
		{
			alert('Please enter your current password');
			return false;
		}
		else if(new_pass=="")
		{
			alert('Please your new password');
			return false;
		}
		else
		{
			return true;
		}
	}
	return true;
	
}

function gotodbpage()
{
		window.location.href='<?php echo LIVE_SITE; ?>/users/database/';
}

function auto_save_profile(){


	var i = 0;
	// var isError = true;
	var isError = true;
	var curr_pass=document.getElementById('UserCurrentPassword').value;
	var new_pass=document.getElementById('UserPassword').value;
	var newre_pass=document.getElementById('UserRepassword').value;

if(newre_pass!="")
	{
		if(curr_pass=="")
		{
			alert('Please enter your current password');
		
		}
		else if(new_pass=="")
		{
			alert('Please your new password');
		
		}
		else
		{
			if(isError)
			{
			dataForm = $("#profile_personal").serialize();
			$.ajax({
			'type':'post',
			'data': dataForm,
			'url':'<?php echo LIVE_SITE; ?>/users/autosave'

		
			}).done(function(data){
			//			alert(data);
			$('#profile_formdata').html(data);

			});
			}
		}
	}
	else
	{
		if(isError)
			{
				

   var formData = new FormData($('form#profile_personal')[0]);
				    $.ajax({
					url: '<?php echo LIVE_SITE; ?>/users/autosave',  //Server script to process data
					type: 'POST',
					xhr: function() {  // Custom XMLHttpRequest
					    var myXhr = $.ajaxSettings.xhr();
					    if(myXhr.upload){ // Check if upload property exists
					//	myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
					    }
					    return myXhr;
					},
					//Ajax events
				
					
					// Form data
					data: formData,
					//Options to tell jQuery not to process data or worry about content-type.
					cache: false,
					contentType: false,
					processData: false
				    }).done(function(data){
				//			alert(data);
				$('#profile_formdata').html(data);
				NFInit();
	
				});





			}	
	}
		
}

$(function() {
  $('#profile_personal').click(function() {
var fileval=$('.NFText').val();
	if((fileval==""))
	{
//		alert('empty');
	
	}
	else
	{
	auto_save_profile();		
	}

  });
});

</script>
<h2>Personal Information</h2>
<div id="profile_formdata">
	 		 <?php echo $content_for_layout; ?>
</div>


  </div>
 
</div>
 <script>
  
//    $( "#tabs" ).tabs();

$(function() {
    $( "#tabs" ).tabs(  );
    $('#tabs ul li a').click(function(){
                var link = $(this).attr('href');
                        //alert(link);
                        window.location = '<?php echo LIVE_SITE; ?>/users/profile'+link;
                        location.reload();
                });
  });

  
  </script>

<style>
iframe.twitter-hashtag-button{
width: 115px!important;
margin-left: 3px!important;
}
</style>



			</article>
		    
			
		    
		</section>	
	</section>
		
	
  <?php echo $this->element('front_footer'); ?>
  <?php //echo $this->element('sql_dump'); ?>
</body>
</html>
