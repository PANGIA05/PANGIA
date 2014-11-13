<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		 <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php __('Pangia : Home'); ?>
		<?php //echo $title_for_layout; ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
       
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <?php 
			echo $this->Html->css('normalize.css');
			echo $this->Html->css('bootstrap.css');
			echo $this->Html->css('jcarousel.responsive.css');
			echo $this->Html->css('main.css');
			echo $this->Html->script('vendor/bootstrap.js');
			echo $this->Html->script('vendor/respond.src.js');
			echo $this->Html->script('vendor/modernizr-2.6.2.min.js');
			echo $this->Html->script('vendor/jquery.js');
			echo $this->Html->script('vendor/jcarousel.responsive.js');
			echo $this->Html->script('vendor/jquery.jcarousel.min.js');
			echo $this->Html->script('vendor/swipe.js');
			echo $this->Html->script('plugins.js');
			echo $this->Html->script('main.js');
			echo $this->Html->script('ckeditor.js');
			//~ echo $this->Html->script('vendor/html5shiv.js');
			//~ echo $this->Html->script('vendor/respond.js');
			//~ echo $this->Html->script('custom_code.js');
			//~ echo $this->Html->script('jquery.placeholder.js');
        ?>
        <script>
            // Remove advanced tabs for all editors.
            CKEDITOR.config.removeDialogTabs = 'image:advanced;link:advanced;flash:advanced;creatediv:advanced;editdiv:advanced';
        </script>
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
			
		 <script>
$(document).ready(function() {
	Slider = $('#slider').Swipe({
		auto: 3000,
		continuous: true
	}).data('Swipe');

	$('.next').on('click', Slider.next);
	$('.prev').on('click', Slider.prev);
});
</script>	
    </head>
     <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

		<?php echo $this->element('header'); ?>
		<?php echo $content_for_layout; ?>
		<?php echo $this->element('footer'); ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
        
      

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    
    </body>
</html>
