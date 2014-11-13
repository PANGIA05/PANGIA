<?php ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<?php echo $this->Html->charset(); ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php __('GoFundMe'); ?>
		<?php echo $title_for_layout; ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<?php
 //echo $this->Html->script('main.1.js'); 
 echo $this->Html->css('normalize.css'); 
 echo $this->Html->css('main.css'); 
 echo $this->Html->css('styles.css');
 echo $this->Html->css('responsive.css'); 
//echo $this->Html->css('style_front.css');
 echo $this->Html->css('validationEngine.jquery');
 //echo $this->Html->css('bootstrap.min.css');
 echo $this->Html->css('jquery.fileupload');
 echo $this->Html->css('jquery.fileupload-ui');
 echo $this->Html->script('jquery.validationEngine');
 echo $this->Html->script('jquery.validationEngine-en');
 echo $this->Html->script('vendor/modernizr-2.6.2.min.js');
 echo $this->Html->script('unslider.min.js');
 echo $this->Html->script('jquery.event.swipe.js');
 echo $this->Html->script('jQuery-custom-input-file'); 
 echo $this->Html->script('jquery.upload');
 echo $this->Html->script('custom_code.js');	
 echo $this->Html->script('jquery.customSelect.min.js');	
 //echo $this->Html->script('jquery.min');
 //echo $this->Html->css('style_front.css'); 
?>

<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">-->
<!-- Generic page styles -->

<link rel="stylesheet" href="css/style.css">
<!-- blueimp Gallery styles -->

<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->

<link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>

<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>

<script type="text/javascript">
$(document).ready(function(){
setTimeout(function(){
		$('#flashMessage').fadeOut('slow',function(){
			$(this).remove();		
		});	
	},2000);
});
</script>
<!--[if IE 8]>
<link rel="stylesheet" href="css/ie-only.css" type="text/css">
<script type="text/javascript">
    old_ie = true;
</script>
<![endif]-->
<style>
/* Firefox slider fix */
@-moz-document url-prefix(){@media only screen and (min-width : 1025px){.slider{left:-87.5%;}}}
</style>

<!-- Force latest IE rendering engine or ChromeFrame if installed -->
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta charset="utf-8">
<title>jQuery File Upload iWrestle</title>
<!-- Bootstrap styles -->
<?php?>

<script>
function deleteimg(imgid)
{
$.ajax({
	url:"<?php echo LIVE_SITE.'/users/deleteimg/'; ?>"+imgid,
	type:'post',
});
}
</script>
</head>
<body>

<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<header id="header" class="pr">
<?php echo $this->element('iWrestled_front_header'); ?>
  <!-- /container --> 
</header>
<!-- /header -->


	<section class="fixed-top">
  <div class="container">
<article class="right_side_inner">
			 <?php echo $this->element('adsprofile_right'); ?>
			</article>
	<?php echo $content_for_layout; ?>  
<?php echo $this->element('adsbar_left'); ?>
	</div>
</section>

<!-- main-content -->

<footer id="footer">
   <?php echo $this->element('iwrestled_front_footer'); ?>
  <!-- /container --> 
</footer>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> --> 
<!--script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script--> 


<!-- The template to display files available for upload -->

<!-- The template to display files available for download -->

<![endif]-->
</body>
</html>
