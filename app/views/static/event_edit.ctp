<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pangia : : Event-Edit Page</title>
        <meta name="description" content="">
       <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <script type='text/javascript'>
        function saveEvent(){
			 var data1=$("#eventEventEditForm").closest("form").serialize();
			 var message = $('textarea#content').val();
			 alert(message);
			 var desc=$("#PageDescription").html();
			 alert(desc);
			  $.ajax({
				  type: 'POST',
				  url:'<?php echo LIVE_SITE;?>/admins/saveEvents',
				  data:data1+'&desc='+'hello',
				 //  dataType: 'json',
				  success: function (response) {
					  alert(response);
						alert("Record saved successfully..!!");
					},
					error: function (xhr, ajaxOptions, thrownError) {
						 console.log(xhr);
						 
					}
			});
			alert("Save");
		 }
        </script>
        
     
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
<div class="s-top-edit">
<div class="container-fullWidth">
<div class="row">
<div class="col-md-6">
<div class="edit-btn-top"> 

<!-- Pop UP Starts here -->

 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-edit-mode">
    <div class="modal-content">
      
      <div class="modal-body noPadding">
       <div class="s-event-mid02 s-event-mid03">
            <div class="container modal-container">
                <div class="row">
				 <?php
					echo $this->Form->create('event',array('autocomplete'=>'off', 'class' =>'adminLogin','url'=>'admins/saveEvents'));		
				  ?>
                    <div class="col-md-4 left-edit-section">
                     <div class="upload-image">
                      <img src="<?php echo LIVE_SITE;?>/img/upload_image.jpg">
                      <div class="form-group">
						<?php echo $this->Form->input('event_image', array('type'=>'file')); ?>
				     </div>
                     </div>
                     <div class="date-time">
                      <label for="exampleInputFile">Event Date</label>
                      <div class="date-select">  
                    <!-- <select class="form-control">
                      <option>Day</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>-->
                     <?php
						for($i=1;$i<=30;$i++){
								$data[]=$i;
						}
					  ?>
                     <div class="form-control1">
						 <?php echo $this->Form->input('day', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					</div>
                    <div class="form-control">
						<?php echo $this->Form->input('month', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					 </div>
					 <div class="form-control">
						<?php echo $this->Form->input('year', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					</div>
                    </div>
                     </div>
                     
                     <div class="event-type">
                       <div class="form-group">
                      <label for="exampleInputEmail1">Event Type</label>
                      </div>
                     <div class="radio Mtop-5"></div>
                     <?php
						$options=array('rsvp'=>'RSVP Events','paid'=>'Paid Events','noindicate'=>'No Indicate');
						$attributes=array('legend'=>false,'class'=>'radio Mtop-5',);
						echo $this->Form->radio('gender',$options,$attributes);
					?>
                    <!--<div class="radio">
                      <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                        Paid Event
                      </label>
                      </div>
                      <div class="radio">
                      <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                        No Indicator
                      </label>
                    </div>
                    -->
                    <div class="form-group event-cost">
                    <label for="exampleInputEmail1">Event Cost (for paid event only)</label>
                    <?php echo $this->Form->input('event_cost', array('type'=>'text','label'=>false,'class'=>'form-control')); ?>
                    <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="">-->
                  </div>
                  <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Event Capacity (How many seats)</label>
                    <?php echo $this->Form->input('event_capacity', array('type'=>'text','label'=>false,'class'=>'form-control')); ?>
                 
                  </div>
                     </div>
                    </div>
                    <div class="col-md-8 edit-section-right">
						<?php echo $this->Form->input('event_description',array('label'=>false,'id'=>'PageDescription','type'=>'textarea','class'=>'form-control','placeholder'=>'Specify the description for your fundraiser','row'=>'10','cols'=>'80'));
							?>
                              <script>
                
                            CKEDITOR.replace( 'PageDescription' );
                
							</script> 
							<div class="edit-buttons">
                     <button type="submit" class="btn btn-default edit-btn-blue">Cancel</button>
                     <button type="submit" class="btn btn-default edit-btn-red">Save</button>
                     </div>  
<!--
                     <img src="<?php echo LIVE_SITE;?>/img/edit_controls.jpg" class="img-responsive">
                      <h1>Quis autem vel eum iure</h1>
                      <h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</h2>
                      <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining</h3>
                        
-->
                    </div>
                     <?php echo $this->Form->end(); ?>
                </div>
               
            </div>
        </div>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Pop UP Ends here -->

</div>
</div>
 
</div>
</div>
</div>
</div>        
        
        <!-- Show on Device -->
        
        <div class="s-top s-top-device">
         <div class="container">
           <div class="row">
           <div class="col-md-3 col-sm-3 col-xs-9">
              <div class="logo"> <a href="<?php echo LIVE_SITE; ?>"><img src="<?php echo LIVE_SITE;?>/img/logo_01.png" class="img-responsive" alt=""></a>
                 </div>
           </div>
                      <div class="col-md-9 col-sm-9 col-xs-3  noPadding">
                  
   <nav class="navbar navbar-default navbar-custom" role="navigation">
  <div class="container-fluid">
<div class="navbar-header navbar-header-custom">
      <button type="button" class="navbar-toggle navbar-toggle-custom" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    
  </div><!-- /.container-fluid -->
</nav>

                               </div>
                                </div>
           
           <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-collapse-custom" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav nav-custom">
        <li><a href="about.html">ABOUT US</a></li>
        <li><a href="#">MENU</a></li>
         <li><a href="#">GALLERY</a></li>
          <li><a href="#">VOUCHERS</a></li>
           <li><a href="event.html" class="active">EVENTS</a></li>
            <li><a href="#">BLOG</a></li>
            <li><a href="contact.html">CONTACT </a></li>
        
      </ul>

    </div><!-- /.navbar-collapse -->                     
                                 </div>   
                                   </div>

                  </div>
        
        <!-- Show on Device -->          
        
        
        <div class="s-event-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <img src="<?php echo LIVE_SITE;?>/img/event_banner.jpg" class="img-responsive">
                    </div>
                </div>
            </div>
        </div> 
        
        <div class="s-event-mid01">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="edit-event-detail">
                     <h1>Voluptates Repudiandae</h1>
                     <h4>April 10, 2014</h4>
                     <h5>1234 Street Road,City Name IN 567890.</h5>
                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker versions  </p>
                     <div class="edit-buttons">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="join_section">
                      <div class="join_form">
                        <h1>Are you going to join ?</h1>
                        <div class="radio radio-custom">
                      <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                        Yes
                      </label>
                    </div>
                    <div class="radio radio-custom">
                      <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                        No
                      </label>
                    </div>
                     <div class="radio radio-custom">
                      <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                        Not Sure
                      </label>
                    </div>
                     <div class="join_btn"> 
               <button type="submit" class="btn btn-default btn-default-custom">Submit</button>
               </div>
                      </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
               
        <div class="s-event-mid02">
            <div class="container">
                <div class="row">
                   <div class="edit-event-detail">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="m-about-mid01-left">
                        <img src="<?php echo LIVE_SITE;?>/img/event_01.jpg" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="m-about-mid01-right">
                        <h1>Quis autem vel eum iure</h1>
                                <h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </h2>

                     <h3> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </h3>
                          </div>
                        </div>
                     <div class="edit-buttons">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>   
                    </div>
                </div>
            </div>
        </div> 
        
        <div class="s-event-mid02 s-event-mid03">
            <div class="container">
                <div class="row">
                    <div class="edit-event-detail">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="m-about-mid02-left">
                                <h1>Neque porro quisquam est</h1>
                                <h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </h2>

                     <h3> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </h3>
   
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="m-event-mid02-right">
                         <img src="<?php echo LIVE_SITE;?>/img/event_02.jpg" class="img-responsive">
               
                        </div>
                    </div>
                  <div class="edit-buttons">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>   
                </div>
                </div>
            </div>
        </div>
                
                
                       <div class="footer foot-border">
                         <div class="col-md-12">
                             <div class="row">
                                <div class="container">
                                  <div class="row">
                                   <div class="footer_contents">
                                   <div class="col-md-3 col-sm-3 col-xs-6">
                                     <h1>ADDRESS</h1>
                                     <p>The Company Name Inc.
                                        1234 Street Road,City Name,
                                        IN 567890.</p>
                                   </div>
                                   <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h1 class="foot_line01">SOCIAL</h1>
                                    <ul>
                                      <li><a href="https://www.facebook.com/pages/Gifted-Ideas-LLC/1447208335538476"> <img src="<?php echo LIVE_SITE; ?>/img/facebook.png"></a></li>
                                      <li><a href="#"> <img src="<?php echo LIVE_SITE; ?>/img/twitter.png"></a></li>
                                      <li><a href="#"> <img src="<?php echo LIVE_SITE; ?>/img/g_plus.png"></a></li>
                                      <li><a href="#"> <img src="<?php echo LIVE_SITE; ?>/img/pintrest.png"></a></li>
                                      <li><a href="#"> <img src="<?php echo LIVE_SITE; ?>/img/instagram.png"></a></li>
                                    </ul>
                                   </div>
                                   <div class="col-md-3 col-sm-3 col-xs-6">
                                    <h1  class="foot_line02">CALL US</h1>
                                     <p> <a href="tel:7039443335">703-944-3335</a> <br></p>
                                     
                                   </div>
                                   <div class="col-md-3 col-sm-3 col-xs-6">
                                   <h1 class="foot_line03">OUR EMAIL</h1>
                                   <a href="mailto:emmanueljones@pangiadev.com ">emmanueljones@pangiadev.com </a>
                                      
                                   </div>
                                </div>
                                  </div>
                                  
                                  <div class="row">
                         <div class="col-md-3 col-sm-4 col-xs-12">
                          <p class="copy-right">Copyright &copy; company 2014</p>
                         </div>
                         <div class="col-md-3 col-sm-4 col-xs-12 pull-right">
                         <div class="newsletter ">
                                     <h2>Stay Connected!</h2>
                                      <div class="input-group">
                                      <form action="contact.html">
                                     <input type="text" value="Enter your Email" onfocus="if(this.value  == 'Enter your Email') { this.value = ''; } " onblur="if(this.value == '') { this.value = 'Enter your Email'; }"  class="form-control input-custom">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default btn-custom" type="submit">Go!</button>
                                      </span>
                                      
                                      </form>
                                    </div>
                                    </div>
                         </div>           
                          </div>
                             </div>
                         </div>
                         
                         
                                    
                       </div>
                       </div>
                       
                       
    	              
                   
                   
      
    </body>
</html>
