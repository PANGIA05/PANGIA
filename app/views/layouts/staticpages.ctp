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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php __('GoFundMe'); ?>
		<?php echo $title_for_layout; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;">
		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
			<?php
				echo $this->Html->css('normalize.css');
				echo $this->Html->css('vendor/bootstrap.css');
				echo $this->Html->css('inner-pages.css');
				echo $this->Html->css('main.css');
				echo $this->Html->css('validationEngine.jquery');
				echo $this->Html->css('vendor/jcarousel.connected-carousels.css');
				echo $this->Html->script('vendor/bootstrap.js');
				echo $this->Html->script('vendor/modernizr-2.6.2.min.js');
				echo $this->Html->script('plugins.js');
				echo $this->Html->script('main.js');
				echo $this->Html->script('custom_code.js');
				echo $this->Html->script('jquery.validationEngine');
				echo $this->Html->script('jquery.validationEngine-en');
				//echo $this->Html->script('vendor/html5shiv.js');
				//echo $this->Html->script('vendor/respond.js');
				echo $this->Html->css('styles.css');
			?>

		<script type="text/javascript">
			$(document).ready(function(){
			setTimeout(function(){
				$('#flashMessage').fadeOut('slow',function(){
					$(this).remove();		
				});	
			},5000);
			});
		</script>

</head>
<body>

	<!-- /* Header area starts / Section 1 */ -->
		 <div class="is-section is-top-most-section">
        <div class="navbar navbar-default top_header" role="navigation">
		<?php echo $this->element('gofundme_front_header'); ?>  
		</div>
    </div>  <!-- /* Header area ends */ -->

<section id="main-al" class="main-content">
<div class="container">
	
<div class="grid-container">
<div id="hm-ss" class="cf">



</div><!-- /hm-ws -->
<div id="al-boxes" class="cf">
<?php 
/***********get Page Url*************/

		//~ function curPageURL() {
			//~ $pageURL = 'http';
			//~ if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				//~ $pageURL .= "://";
				//~ if ($_SERVER["SERVER_PORT"] != "80") {
					//~ $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
					//~ } else {
						//~ $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
					//~ }
				//~ return $pageURL;
			//~ }
				//~ $url=curPageURL();
				//~ $newurl=explode("/",$url);
				//~ $seturl=$newurl[4];
				//~ ?>

<div class="static-cont">
<?php echo $this->Session->flash(); ?>
<?php echo $content_for_layout; ?>  

</div><!-- /right-sec -->
</div><!-- /al-boxes --> 



</div><!-- /grid-container -->   
</div><!-- /container --> 
</section>
<!-- main-content -->

<!-- /* Footer section starts / Section last */ -->
    <div class="is-section is-footer-section">
      <?php echo $this->element('gofundme_front_footer'); ?> 
    </div><!-- /* Footer section ends / Section 7 */ -->
 <link href='http://fonts.googleapis.com/css?family=Raleway:400,700,800' rel='stylesheet' type='text/css'>
<?php 
echo $this->Html->css('developer.css'); 
?>
</body>
</html>
