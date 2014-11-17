<!DOCTYPE html>
 
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
 
 <meta http-equiv="content-type" content="text/html; charset=UTF-8">
 <title>Pangia : : Event-Edit Page</title>
 <meta name="description" content="">
 <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function(){ 
	 var userimage=$(".evntimage");
	function showUploadedItem (source) {
		userimage.css({width : '152px',height : '152px'}).attr('src',source);
	 }
	if (window.FormData) {
		formdata = new FormData();
	}
	$(".test").change(function(){
	var i = 0, len = this.files.length, img, reader, file;
	//for ( ; i < len; i++ ) {
	//file = this.files[i];
	file = this.files[i];
	var type=file.type;
	if (file.type.match(/image.*/)) {
	if ( window.FileReader ) {
		reader = new FileReader();
		reader.onloadend = function (e) {
			
			showUploadedItem(e.target.result, file.fileName);
		};
		reader.readAsDataURL(file);
	}
   if (formdata) {
		  formdata.append("images", file);
		  $("#eventImageName").val(file.name);
		  $("#evtimg2").val(file.name);
		  $("#evtimg3").val(file.name);
	}
	//}
	}
	if(formdata){
	console.log(formdata);
	$.ajax({
	url:'<?php echo LIVE_SITE;?>/admins/uploadEventImage',
	type: "POST",
	data: formdata,
	processData: false,
	contentType:false, 
	cache: false,  
	success: function (data){}
	});
	}
	});
 });
</script>
<script type='text/javascript'>
 function saveEvent(id){
	  //var data1 = $('#event'+id+'EventEditForm').closest("form").serialize();
	   var htmlDesc = CKEDITOR.instances.PageDescription.document.getBody().getHtml();
	   //var img=1;
	   $.ajax({
		  type: 'POST',
		  url:'<?php echo LIVE_SITE;?>/admins/saveEvents',
		  data:data1+'&desc='+htmlDesc+'&img='+img+'&id='+id,
		   success: function (response) {
			// alert(response);
			 $("#eventImageName").val("");
				alert("Record saved successfully..!!");
			},
			error: function (xhr, ajaxOptions, thrownError) {
				 console.log(xhr);
			 }
	});
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

<!-- Pop UP Starts here  hard coded-->


<!-- Modal  1Event-->
<div class="modal fade md1" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-edit-mode">
    <div class="modal-content">
      
     <div class="modal-body noPadding">
       <div class="s-event-mid02 s-event-mid03">
            <div class="container modal-container">
                <div class="row">
				 <?php
				      $id=$event1['Events']['id'];
					  echo $this->Form->create('event',array('onsubmit' => "return Checkform($id);",'id'=>"createarticle$id",'enctype'=>"multipart/form-data"));
				    echo $this->Form->input('image_name', array('type'=>'hidden','value'=>'')); 
				   ?>
                  <div class="col-md-4 left-edit-section">
                     <div class="upload-image">
                      <img src="<?php echo LIVE_SITE."/img/upload_userImages/".$event1['Events']['event_image']?>" id="evntimage$id" class="evntimage">
                      <div class="form-group">
						<?php echo $this->Form->input('event_image',array('id'=>'image','label'=>false,'type'=>'file','class'=>'test'));  ?>
				     </div>
                     </div>
                     <div class="date-time">
                      <label for="exampleInputFile">Event Date</label>
                      <div class="date-select">  
                      <div class="form-control1"> 
						<?php echo $this->Form->input('event_date', array(
								'type' => 'date',
								'label' => 'Date of Birth:<span>*</span>',
								'dateFormat' => 'MDY',
								'minYear' => date('Y')-130,
								'maxYear' => date('Y'),
								'options' => array('1','2'),
								'selected' =>$event1['Events']['event_date'],
							));
 
					  ?>
					  </div>
                     <!--<div class="form-control1">
						 <?php echo $this->Form->input('day', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					</div>
                    <div class="form-control">
						<?php echo $this->Form->input('month', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					 </div>
					 <div class="form-control">
						<?php echo $this->Form->input('year', array('type'=>'select','options'=>$year,'label'=>false)); ?>
					</div>-->
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
						echo $this->Form->radio('event_type',$options,$attributes);
					?>
                     
                    <div class="form-group event-cost">
                    <label for="exampleInputEmail1">Event Cost (for paid event only)</label>
                    <?php echo $this->Form->input('event_cost', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event1['Events']['event_cost'])); ?>
                     
                  </div>
                  <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Event Capacity (How many seats)</label>
                    <?php echo $this->Form->input('event_capacity', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event1['Events']['event_capacity'])); ?>
                 
                  </div>
                    <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Title</label>
                    <?php echo $this->Form->input('event_title', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event1['Events']['event_title'])); ?>
                 
                  </div>
                    <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Address</label>
                    <?php echo $this->Form->input('event_address', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event1['Events']['event_address'])); ?>
                 
                  </div>
                   
                     </div>
                    </div>
                    <div class="col-md-8 edit-section-right">
						<?php echo $this->Form->input('event_description',array('label'=>false,'id'=>'PageDescription1','type'=>'textarea','class'=>'form-control','placeholder'=>'Specify the description for your fundraiser','row'=>'10','cols'=>'80','value'=>$event1['Events']['event_description']));
							?>
                              <script>
                
                            CKEDITOR.replace( 'PageDescription1' );
                
							</script> 
							<div class="edit-buttons">
                    <!-- <button type="submit" class="btn btn-default edit-btn-blue">Cancel</button>-->
                     <button type="submit" class="btn btn-default edit-btn-red">Save</button>
                      <a href="#" class="btn btn-default edit-btn-blue edit-btn" id="<?php echo $id; ?>">Cancel</a>
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

<!-- Pop UP Ends here --  loop-->

<!-- Modal  2Event-->
<div class="modal fade md2" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-edit-mode">
    <div class="modal-content">
      
     <div class="modal-body noPadding">
       <div class="s-event-mid02 s-event-mid03">
            <div class="container modal-container">
                <div class="row">
				 <?php
				      $id=$event2['Events']['id'];
					  echo $this->Form->create('event',array('onsubmit' => "return Checkform($id);",'id'=>"createarticle$id",'enctype'=>"multipart/form-data"));
				    echo $this->Form->input('image_name', array('type'=>'hidden','value'=>'','id'=>'evtimg'.$id,'value'=>$event2['Events']['event_image'])); 
				   ?>
                  <div class="col-md-4 left-edit-section">
                     <div class="upload-image">
                      <img src="<?php echo LIVE_SITE."/img/upload_userImages/".$event2['Events']['event_image']?>" id="<?php echo 'evntimage'.$id;?>" class="evntimage">
                      <div class="form-group">
						<?php echo $this->Form->input('event_image',array('id'=>'image','label'=>false,'type'=>'file','class'=>'test','url'=>"<?php echo LIVE_SITE; ?>"));  ?>
				     </div>
                     </div>
                     <div class="date-time">
                      <label for="exampleInputFile">Event Date</label>
                      <div class="date-select">  
                      <div class="form-control1"> 
						<?php echo $this->Form->input('event_date', array(
								'type' => 'date',
								'label' => 'Date of Birth:<span>*</span>',
								'dateFormat' => 'MDY',
								'minYear' => date('Y')-130,
								'maxYear' => date('Y'),
								'options' => array('1','2'),
								'selected' =>$event2['Events']['event_date'],
							));
 
					  ?>
					  </div>
                     <!--<div class="form-control1">
						 <?php echo $this->Form->input('day', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					</div>
                    <div class="form-control">
						<?php echo $this->Form->input('month', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					 </div>
					 <div class="form-control">
						<?php echo $this->Form->input('year', array('type'=>'select','options'=>$year,'label'=>false)); ?>
					</div>-->
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
						echo $this->Form->radio('event_type',$options,$attributes);
					?>
                     
                    <div class="form-group event-cost">
                    <label for="exampleInputEmail1">Event Cost (for paid event only)</label>
                    <?php echo $this->Form->input('event_cost', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event2['Events']['event_cost'])); ?>
                     
                  </div>
                  <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Event Capacity (How many seats)</label>
                    <?php echo $this->Form->input('event_capacity', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event2['Events']['event_capacity'])); ?>
                 
                  </div>
                    <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Title</label>
                    <?php echo $this->Form->input('event_title', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event2['Events']['event_title'])); ?>
                 
                  </div>
                    <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Address</label>
                    <?php echo $this->Form->input('event_address', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event2['Events']['event_address'])); ?>
                 
                  </div>
                   
                     </div>
                    </div>
                    <div class="col-md-8 edit-section-right">
						<?php echo $this->Form->input('event_description',array('label'=>false,'id'=>'PageDescription2','type'=>'textarea','class'=>'form-control','placeholder'=>'Specify the description for your fundraiser','row'=>'10','cols'=>'80','value'=>$event2['Events']['event_description']));
							?>
                              <script>
                
                            CKEDITOR.replace( 'PageDescription2' );
                
							</script> 
							<div class="edit-buttons">
                    <!-- <button type="submit" class="btn btn-default edit-btn-blue">Cancel</button>-->
                     <button type="submit" class="btn btn-default edit-btn-red">Save</button>
                      <a href="#" class="btn btn-default edit-btn-blue edit-btn" id="<?php echo $id; ?>">Cancel</a>
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

<!-- Pop UP Ends here --  loop>
<!-- Modal  3Event-->
<div class="modal fade md3" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-edit-mode">
    <div class="modal-content">
      
     <div class="modal-body noPadding">
       <div class="s-event-mid02 s-event-mid03">
            <div class="container modal-container">
                <div class="row">
				 <?php
				      $id=$event3['Events']['id'];
					  echo $this->Form->create('event',array('onsubmit' => "return Checkform($id);",'id'=>"createarticle$id",'enctype'=>"multipart/form-data"));
				    echo $this->Form->input('image_name', array('type'=>'hidden','value'=>'','id'=>'evtimg'.$id,'value'=>$event2['Events']['event_image'])); 
				   ?>
                  <div class="col-md-4 left-edit-section">
                     <div class="upload-image">
                      <img src="<?php echo LIVE_SITE."/img/upload_userImages/".$event3['Events']['event_image']?>" id="<?php echo 'evntimage'.$id;?>" class="evntimage">
                      <div class="form-group">
						<?php echo $this->Form->input('event_image',array('id'=>'image','label'=>false,'type'=>'file','class'=>'test','url'=>''));  ?>
				     </div>
                     </div>
                     <div class="date-time">
                      <label for="exampleInputFile">Event Date</label>
                      <div class="date-select">  
                      <div class="form-control1"> 
						<?php echo $this->Form->input('event_date', array(
								'type' => 'date',
								'label' => 'Date of Birth:<span>*</span>',
								'dateFormat' => 'MDY',
								'minYear' => date('Y')-130,
								'maxYear' => date('Y'),
								'options' => array('1','2'),
								'selected' =>$event3['Events']['event_date'],
							));
 
					  ?>
					  </div>
                     <!--<div class="form-control1">
						 <?php echo $this->Form->input('day', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					</div>
                    <div class="form-control">
						<?php echo $this->Form->input('month', array('type'=>'select','options'=>$data,'label'=>false)); ?>
					 </div>
					 <div class="form-control">
						<?php echo $this->Form->input('year', array('type'=>'select','options'=>$year,'label'=>false)); ?>
					</div>-->
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
						echo $this->Form->radio('event_type',$options,$attributes);
					?>
                     
                    <div class="form-group event-cost">
                    <label for="exampleInputEmail1">Event Cost (for paid event only)</label>
                    <?php echo $this->Form->input('event_cost', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event3['Events']['event_cost'])); ?>
                     
                  </div>
                  <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Event Capacity (How many seats)</label>
                    <?php echo $this->Form->input('event_capacity', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event3['Events']['event_capacity'])); ?>
                 
                  </div>
                    <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Title</label>
                    <?php echo $this->Form->input('event_title', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event3['Events']['event_title'])); ?>
                 
                  </div>
                    <div class="form-group event-cost">
                    <label for="exampleInputPassword1">Address</label>
                    <?php echo $this->Form->input('event_address', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$event3['Events']['event_address'])); ?>
                 
                  </div>
                   
                     </div>
                    </div>
                    <div class="col-md-8 edit-section-right">
						<?php echo $this->Form->input('event_description',array('label'=>false,'id'=>'PageDescription3','type'=>'textarea','class'=>'form-control','placeholder'=>'Specify the description for your fundraiser','row'=>'10','cols'=>'80','value'=>$event3['Events']['event_description']));
							?>
                              <script>
                
                            CKEDITOR.replace( 'PageDescription3' );
                
							</script> 
							<div class="edit-buttons">
                    <!-- <button type="submit" class="btn btn-default edit-btn-blue">Cancel</button>-->
                     <button type="submit" class="btn btn-default edit-btn-red">Save</button>
                      <a href="javascript:void(0)" class="btn btn-default edit-btn-blue  edit-btn" id="<?php echo $id;?>">Cancel</a>
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

<!-- Pop UP Ends here --  loop-->













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
        
        
     <!----  Showing Data event 1    ---> 
   <div class="s-event-mid01">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="edit-event-detail">
                     <h1><?php echo $event1['Events']['event_name'] ?></h1>
                     <h4><?php echo $event1['Events']['event_date'] ?></h4>
                     <h5><?php echo $event1['Events']['event_address'] ?></h5>
                     <p><?php echo $event1['Events']['event_description'] ?></p>
                      <?php if($this->Session->check('Admin')=='true'){
						?>
                     <div class="edit-buttons">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal<?php echo $event1['Events']['id']?>">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal<?php echo $event1['Events']['id']?>">Delete</button>
                     </div>
                     <?php }?>
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
    <!----  Showing End Data event 1    --->         
  <!----  Showing End Data event 2   --->  
   <div class="s-event-mid02">
            <div class="container">
                <div class="row">
                   <div class="edit-event-detail">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="m-about-mid01-left">
                        <!--<img src="<?php echo LIVE_SITE.'/img/'.$event2['Events']['event_image']?>" class="img-responsive">-->
                        <img src="<?php echo LIVE_SITE."/img/upload_userImages/".$event2['Events']['event_image'] ?>" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="m-about-mid01-right">
                        <h1><?php echo $event2['Events']['event_title']?></h1>
                        <div><?php echo $event2['Events']['event_description']?></div>
                         </div>
                        </div>
                       <?php if($this->Session->check('Admin')=='true'){
						?>
                     <div class="edit-buttons">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal<?php echo $event2['Events']['id']?>">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>  
                     <?php } ?> 
                    </div>
                </div>
            </div>
        </div> 
     <!----  Showing End Data event 2    --->  
     <!----  Showing End Data event 3    --->  
   <div class="s-event-mid02 s-event-mid03">
            <div class="container">
                <div class="row">
                    <div class="edit-event-detail">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="m-about-mid02-left">
                                <h1><?php echo $event3['Events']['event_title'] ?></h1>
                                <!--<h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </h2>

                     <h3> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not </h3>-->
								<div><?php echo $event3['Events']['event_description'] ?></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="m-event-mid02-right">
                        <!--<img src="<?php echo LIVE_SITE.'/img/'.$event3['Events']['event_image']?>" class="img-responsive test3">-->
						<img src="<?php echo LIVE_SITE.'/img/upload_userImages/'.$event3['Events']['event_image']?>" class="img-responsive test3">
                        </div>
                    </div>
                    <?php if($this->Session->check('Admin')=='true'){
						?>
                  <div class="edit-buttons">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal<?php echo $event3['Events']['id']?>">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div> 
                     <?php } ?>  
                </div>
                </div>
            </div>
        </div>
   <!----  Showing End Data event 3    --->     
   
<script>
function Checkform(id){  
	 var data1 = $('#createarticle'+id).closest("form").serialize();
	  if(id==1){
		  var htmlDesc = CKEDITOR.instances.PageDescription1.document.getBody().getHtml(); 
	  }else if(id==2){
		  var htmlDesc = CKEDITOR.instances.PageDescription2.document.getBody().getHtml();  
	  }else if(id==3){
		  var htmlDesc = CKEDITOR.instances.PageDescription3.document.getBody().getHtml();  
	  }
	  // var img=$("#evntimage2").val();
	  var img=$("#evtimg"+id).val();
	 //  var img=''; 
	 //  var img=''; 
	$.ajax({
	  type: 'POST',
	  url:'<?php echo LIVE_SITE;?>/admins/saveEvents',
	  data:data1+'&desc='+htmlDesc+'&img='+img+'&id='+id,
	  success: function (response) {
		  alert(response);
		 alert("Record saved successfully..!!");
	  },
		error: function (xhr, ajaxOptions, thrownError) {
			 console.log(xhr);
		},
		complete:function(){
		  window.location.href='<?php echo LIVE_SITE;?>/admins/eventEdit';
		}
	 });
 }
 
</script>              
 </body>
</html>
