<?php ?>
<script>
	function confirmfrmSubmit()
	{	
	$("#UserContactus").validationEngine('attach', { maxErrorsPerField:1});
	if(jQuery("#UserContactus").validationEngine('validate'))
	{	
		return true;
	}
	else
	{
		return false;
	}
		}
	
	</script>
<div class="is-section is-banner-section article-detail">
        <div class="container-fluid">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo LIVE_SITE.'/img/category-listing-banner.png'?>" alt="image 1">
                    <div class="banner-head">
                       <h2>Contact Us</h2>
                       <p>Bacon ipsum dolor sit amet pancetta frankfurter swine spare ribs drumstick, andouille pastrami turkey pig brisket short loin filet mignon ball tip.
                       </p>
                </div>
                
            </div>
            </div>
        </div>
    </div>
    </div>
    
    <!-- /* Content section starts */ -->
    <div class="is-section is-content-section">
        <div class="container help">
        	<div class="row">
                <div class="col-md-12">
                	
                </div>
            </div> 
            <div class="row">
             <?php echo $this->Element('static_right'); ?>
                
                
                <div class="col-md-9 col-sm-9">
                    <!-- /* Content area start */ -->
                    <div class="contact-us2">
                    	<div class="content-area">
					<?php   $pageurl=$_SERVER['REQUEST_URI'];
						$url=(explode('/',$pageurl));
						$finalurl=$url[4];
					?>	
					<?php echo $this->Form->create('Help',array('onSubmit' => 'return confirmfrmSubmit();','url'=>'contactus/'.$finalurl,'id'=>'UserContactus', "enctype" => "multipart/form-data",'class' => 's-free-gap-form')); ?>	

					<div class="form-group">
                                	<label for="exampleInputEmail1">Your Name</label>
                                	<?php echo $this->Form->input('name',array('id'=>'name','class'=>'validate[required],textbox form-control','label'=>false,'placeholder'=>'Your Name')); ?>
                                	
                              	</div>
                              	<div class="form-group">
                                	<label for="exampleInputPassword1">Your Email</label>
                                	<?php echo $this->Form->input('email',array('id'=>'email','class'=>'validate[required,custom[email]],textbox form-control','label'=>false,'placeholder'=>'Your Email')); ?>
                                	
                              	</div>   
                                <div class="form-group">
                                	<label for="exampleInputEmail1">Confirm Email</label>
                                	<?php echo $this->Form->input('confirmemail',array('id'=>'confirmemail','class'=>'validate[required,custom[email],equals1[email]],textbox form-control' ,'label'=>false,'placeholder'=>'Confirm Email')); ?>
                                	
                              	</div>
                              	<div class="form-group">
                                	<label for="exampleInputPassword1">Message Subject</label>
                                	<?php echo $this->Form->input('subject',array('id'=>'subject','class'=>'validate[required],textbox form-control','label'=>false,'placeholder'=>'Message Subject')); ?>
                                	
                              	</div>  
                                <div class="form-group"> 
                                	<label for="exampleInputPassword1">Your Message</label> 
                                	<?php echo $this->Form->input('message',array('type'=>'textbox','id'=>'message','class'=>'validate[required],textbox form-control','label'=>false,'row'=>"5")); ?>
                                	
                                </div>
                                
                                <div class="form-group cst-frm">
                                    <div class=" col-sm-10 aLeft noPadding">
                                      <button type="submit" class="btn btn-default btn-send">Send</button>
                                    </div>
                                 </div>
                           <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                    <!-- /* Content area ends */ -->
                </div> 
                
                                
            </div>            
        </div>
    </div>
    <!-- /* Content section ends  */ -->
    
    
    
    <!--<div class="is-section is-bottom-section">
        <div class="container"> 
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="displayB campaign-fb">
                        <h4>Easily Find Campaigns</h4>
                        <p>See what your friends support and help spread the word!</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6">
                    <div class="displayB campaign-btn">
                        <a href=""><img src="img/funded-by-friends.png" class="img-responsive"></a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>-->
