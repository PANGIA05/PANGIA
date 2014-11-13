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
				echo $this->Html->css('vendor/jcarousel.connected-carousels.css');
				echo $this->Html->script('vendor/bootstrap.js');
				echo $this->Html->script('vendor/modernizr-2.6.2.min.js');
				echo $this->Html->script('plugins.js');
				echo $this->Html->script('main.js');
				echo $this->Html->script('vendor/html5shiv.js');
				echo $this->Html->script('custom_code.js');
				echo $this->Html->css('styles.css');
				echo $this->Html->css('validationEngine.jquery');
				echo $this->Html->css('jquery.custom-scrollbar.css');
				echo $this->Html->css('jquery.fileupload');
				echo $this->Html->css('jquery.fileupload-ui');
				echo $this->Html->script('jquery.validationEngine');
				echo $this->Html->script('jquery.validationEngine-en');
				echo $this->Html->script('jquery.customSelect.min.js');
				echo $this->Html->script('jquery.magnific-popup.min.js');
				echo $this->Html->script('jquery.placeholder.js');
				echo $this->Html->script('jquery-1.3.2.js');
				echo $this->Html->script('jquery-ui-1.7.2.custom.min.js');
				echo $this->Html->script('ckeditor.js');
				 echo $this->Html->css('jqueryui/ui-lightness/jquery-ui-1.7.2.custom.css');
        
			?>
		<script>
            // Remove advanced tabs for all editors.
            CKEDITOR.config.removeDialogTabs = 'image:advanced;link:advanced;flash:advanced;creatediv:advanced;editdiv:advanced';
        </script>
		<script>
			// To test the @id toggling on password inputs in browsers that don’t support changing an input’s @type dynamically (e.g. Firefox 3.6 or IE), uncomment this:
			// $.fn.hide = function() { return this; }
			// Then uncomment the last rule in the <style> element (in the <head>).
			$(function() {
				// Invoke the plugin
				$('input, textarea').placeholder();
				// That’s it, really.
				// Now display a message if the browser supports placeholder natively
				
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function(){
			setTimeout(function(){
				$('#flashMessage').fadeOut('slow',function(){
					$(this).remove();		
				});	
			},5000);
			});
		</script>
		<script>

			$(document).on("click",function(){
			$("#divResult").fadeOut(); 
			});

		</script>
		<!--[if lt IE 9]>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>			
        <![endif]-->
</head>
<body>
		<!-- /* Header area starts / Section 1 */ -->
		 <div class="is-section is-top-most-section">
        <div class="navbar navbar-default top_header" role="navigation">
		<?php echo $this->element('gofundme_front_header'); ?>  
		</div>
    </div>  <!-- /* Header area ends */ -->


	<?php echo $content_for_layout; ?>  

<!-- main-content -->

    <!-- /* Footer section starts / Section last */ -->
    <div class="is-section is-footer-section">
      <?php echo $this->element('gofundme_front_footer'); ?> 
    </div><!-- /* Footer section ends / Section 7 */ -->
 <link href='http://fonts.googleapis.com/css?family=Raleway:400,700,800' rel='stylesheet' type='text/css'>
<?php 
echo $this->Html->css('developer.css'); 
?>
