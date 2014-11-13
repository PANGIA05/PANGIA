<?php
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<?php
	//echo $this->Html->script('ajaxsbmt.js');
	
?>
<?php //echo $javascript->link('fckeditor/fckeditor'); ?> 
	<title>
		<?php __('Pangia'); ?>
		<?php $pagename = $this->params['url'];
			   $title = (explode("/",$pagename['url']));
			   $final_title = ucfirst($title[1]);
         ?>
		<?php echo $final_title; ?></title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');
		echo $this->Html->script('ckeditor.js');
		//echo $this->Html->css('jquery.fancybox-1.3.4.css');
		echo $scripts_for_layout;
	?>
	<script>
            // Remove advanced tabs for all editors.
            CKEDITOR.config.removeDialogTabs = 'image:advanced;link:advanced;flash:advanced;creatediv:advanced;editdiv:advanced';
        </script>
<style>
.logout a{text-decoration:none;padding-left:15px;}
#divResult{-moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: white;
    border-bottom-color: #DEDEDE;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-image-outset: 0 0 0 0;
    border-image-repeat: stretch stretch;
    border-image-slice: 100% 100% 100% 100%;
    border-image-source: none;
    border-image-width: 1 1 1 1;
    border-left-color-ltr-source: physical;
    border-left-color-rtl-source: physical;
    border-left-color-value: #DEDEDE;
    border-left-style-ltr-source: physical;
    border-left-style-rtl-source: physical;
    border-left-style-value: solid;
    border-left-width-ltr-source: physical;
    border-left-width-rtl-source: physical;
    border-left-width-value: 1px;
    border-right-color-ltr-source: physical;
    border-right-color-rtl-source: physical;
    border-right-color-value: #DEDEDE;
    border-right-style-ltr-source: physical;
    border-right-style-rtl-source: physical;
    border-right-style-value: solid;
    border-right-width-ltr-source: physical;
    border-right-width-rtl-source: physical;
    border-right-width-value: 1px;
    border-top-color: #51B470;
    border-top-style: solid;
    border-top-width: 3px;
    box-shadow: 0 0 5px #999999;
    display: none;
    margin-top: -1px;
    overflow-x: hidden;
    overflow-y: hidden;
    position: absolute;
    width: 230px;
    z-index: 9999;}
 #divResult .display_box:hover
        {
                background:#51B470;
                color:#FFFFFF;
                cursor:pointer;
        }
</style>

<style>
#loading-image {
    border-radius: 10px 10px 10px 10px;
    color: white;
    height: 35px;
    position: fixed;
    right: 582px;
    text-align: center;
    top: 300px;
    width: 76px;
    z-index: 1;
}
</style>	
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<?php
	
	echo $this->Html->script('jquery.mousewheel-3.0.4.pack.js');
	//echo $this->Html->script('jquery.fancybox-1.3.4.pack.js');
	echo $this->Html->css('imgareaselect-default.css');
	//echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('custom_code.js');
?>
<!--Calender-->
<?php
	echo $this->Html->script('datepicker.js');
	echo $this->Html->css('datepicker.css');
?>
<!--Ends here-->

<!--Image Slider-->
<!--<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
-->
	
<?php
	//echo $this->Html->script('jquery-1.7.1.min.js');
	echo $this->Html->script('jquery.nivo.slider.js');
	echo $this->Html->css('default_slider.css');
	echo $this->Html->css('nivo-slider.css');
	
	
?>


<!--Ends here-->
<noscript type="text/javascript">
function show_confirm()
{
	var r=confirm("Are you sure ?");
	if (r==true)
	  {
	  <!--alert("You pressed OK!");-->
	  return true;
	  }
	else
	  {
	  <!--alert("You pressed Cancel!");-->
	  return false;
	  }
}
</noscript>
<script type="text/javascript">
$(document).ready(function(){
	setTimeout(function(){
		$('#flashMessage').fadeOut('slow',function(){
			$(this).remove();		
		});	
	},2000);
});
</script>
</script>

<!-- check all script -->
<SCRIPT language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
       
 
    });
    
    
});
$(document).ready(function(){
		$("#removeAll").click(function(){
				var selectedIds = new Array();
				var n = $("input:checked").length;
				if(n > 0){
				var r = confirm('Are you sure you want to delete?');
				if(r==true)
					{
						$("input.case:checked").each(function(){
							selectedIds.push($(this).attr("id"));
						});
						//alert(selectedIds);
						$('#idArr').val(selectedIds); //return false;
						$("#priceForm").submit(); 
					}
					else{
							return false;
					}  
				}

		});
});
			

/* jQuery(window).load(function() {
	jQuery('#loading-image').hide();
}); */

$(document).ready(function(){
    $("#loading-image").show("fast");
	setTimeout(function(){
		$('#content').fadeTo(150,1,function(){
			$("#loading-image").hide();
		});	
	},200);
	
	$("h3.hndle").click(function(){
		$(this).next(".inside").slideToggle("slow");
	});
	$(".handlediv").click(function(){
		$(this).next().next(".inside").slideToggle("slow");
	});
});

</SCRIPT>
</head>
<body>
<?php echo $this->element('admin_header'); ?>
		<div id="content" class="wp-first-item current menu-top menu-top-first menu-top-last" style="opacity:0.3">
		<?php echo $this->element('admin_left'); ?>
			
			<div id="bebody">
			<?php echo $this->Session->flash(); ?>
			<div id="loading-image">
				<img src="<?php echo $this->webroot; ?>/images/ajax-loader.gif" alt="Loading..." />
			</div>
			<?php echo $content_for_layout; ?>
			</div>
		</div>
		<?php ?>
	</div>
	<?php  //echo $this->element('admin_footer'); ?>
	</div>
	
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
