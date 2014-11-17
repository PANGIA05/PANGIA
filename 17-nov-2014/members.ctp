<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Pangia : : Members Edit Page</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<script>     
$("#myModal").on({
	popupbeforeposition: function () {
	$('.modal').off();
	}
});
</script>
<script>
$(document).ready(function(){ 
 var userimage='';
function showUploadedItem (source) {
	 userimage.css({width : '152px',height : '152px'}).attr('src',source);
 }
if (window.FormData) {
	formdata = new FormData();
}
	  $(".test").change(function(){
		var imgId=$(this).attr("id");
	   var chk=$(this).attr("data-chek");
	   userimage=$("#img"+imgId);
	  var i = 0, len = this.files.length, img, reader, file;
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
		   $("#imgname"+imgId).val(file.name);
	  }
	//}
	}
	if(formdata){
   $.ajax({
	url:'<?php echo LIVE_SITE;?>/admins/uploadEventImage',
	type: "POST",
	data: formdata,
	processData: false,
	contentType:false, 
	cache: false,  
	success: function (data){ }
	});
	}
		});
 });
</script> 
<script type="text/javascript">
function updateMembers(id){
	var descId="member_description"+id;
	var desc=CKEDITOR.instances[descId].getData();
	 var data1 = $('#members'+id).closest("form").serialize();
     var img=$('#imgname'+id).val();
	 $.ajax({
		type: 'POST',
		url:'<?php echo LIVE_SITE;?>/admins/updateMembers',
		data:data1+'&id='+id+'&dec='+desc+'&img='+img,
		success: function (response) {
			desc='';
			 
		   alert("Record saved successfully..!!");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			 console.log(xhr);
		},
		complete:function(){
		  window.location.href='<?php echo LIVE_SITE;?>/admins/members';
		}
	});
	
}
</script> 
        
    </head>
    <body>
       
 <!-- Modal popup html CREATIN G dYNAMICALLY --> 
 <?php foreach($members as $mem){
	  $id= $mem['Members']['id'];
	  echo $this->Form->create("member$id",array('onsubmit' => "return updateMembers($id);",'id'=>"members$id",'enctype'=>"multipart/form-data"));
	  ?>
<div class="modal fade" id="myModal<?php echo $mem['Members']['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-edit-mode">
    <div class="modal-content">
      <div class="modal-body noPadding">
       <div class="s-event-mid02 s-event-mid03">
            <div class="container modal-container">
                <div class="row">
                    <div class="col-md-4 left-edit-section">
                     <div class="upload-image upload-image01">
                       <div class="media media-member  noBorder noPadding">
                  <a href="#">
                   <p>  <img class="media-object" src="<?php echo LIVE_SITE.'/img/upload_userImages/'.$mem['Members']['image']?> " alt="..." id="img<?php echo $id;?>"> </p>
                  </a>
                   
                  </div>
                      <div class="form-group">
					<input type="file" id="<?php echo $mem['Members']['id'] ?>" class="test" data-chek="members">
					</div>
					<div class="form-group">
					<?php echo $this->Form->input('name', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$mem['Members']['name'])); 
					echo $this->Form->input('img ', array('type'=>'hidden','label'=>false,'class'=>'teststs',
					'id'=>"imgname$id",'value'=>$mem['Members']['image'] )); 
					?>
					
                     </div>
					 
                     </div>
                   </div>
                    <div class="col-md-8 edit-section-right">
                     <img src="<?php echo LIVE_SITE;?>/img/edit_controls.jpg" class="img-responsive">
                     <div class="member-edit-text">
				   
                      <h3>
	<?php echo $this->Form->input('member_description',array('label'=>false,'id'=>"member_description$id",'type'=>'textarea','class'=>'form-control','placeholder'=>'Specify the description for your fundraiser','row'=>'10','cols'=>'80',
	'value'=> $mem['Members']['description']));
							?>
                              <script>
                
                            CKEDITOR.replace("member_description<?php echo $id ?>");
                
							</script> 
					 </div>
                      <div class="member_rating">
                      </div>
                       <div class="edit-buttons">
                     <button type="submit" class="btn btn-default edit-btn-blue " data-dismiss="modal" aria-hidden="true">Cancel</button>
                     <button type="submit" class="btn btn-default edit-btn-red">Save</button>
                     </div>   
                    </div>
                </div>
            </div>
        </div>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo $this->Form->end(); ?>
<!-- Pop UP Ends here -->
 <?PHP } ?>
 
  <!--eND Modal popup html CREATIN G dYNAMICALLY --> 
       
        
        
        
        <!-- Show on Device -->
        
        <div class="s-top s-top-device">
         <div class="container">
           <div class="row">
           <div class="col-md-3 col-sm-3 col-xs-9">
              <div class="logo"> <a href="#"><img src="<?php echo LIVE_SITE;?>/img/logo_01.png" class="img-responsive" alt=""></a>
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
           <li><a href="event.html">EVENTS</a></li>
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
                    <img src="<?php echo LIVE_SITE;?>/img/members_banner.jpg" class="members_banner img-responsive">
                    </div>
                </div>
            </div>
        </div> 
        
       <!--<div class="s-event-mid01 s-members-mid01"> 
            <div class="container">
                <div class="row">
                   <div class="col-md-12"> 
                    <div class="edit-event-detail"> 
                   <div class="media media-member">
                  <a class="pull-left" href="#">
                   <p> <button type="button" class="btn btn-default profile-btn">Full Profile</button>
                   <img class="media-object" src="<?php echo LIVE_SITE;?>/img/member001.png" alt="..."> </p>
                  </a>
                  <div class="media-body member-contents">
                    <h4 class="media-heading">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</h4>
                  <div class="member_rating">
                   <p>Alina Homes</p> <div class="stars"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> </div>
                  </div>
                  </div>
                </div>
                    <div class="edit-buttons edit-buttons-member">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>
                     </div>
                   </div>  
                </div>
            </div>
        </div>
        
               
         <div class="s-event-mid01 s-members-mid02">
            <div class="container">
                <div class="row">
                   <div class="col-md-12"> 
                      <div class="edit-event-detail"> 
                   <div class="media media-member media-member-right">
                  <a class="pull-right" href="#">
                   <p> <button type="button" class="btn btn-default profile-btn">Full Profile</button>
                   <img class="media-object" src="<?php echo LIVE_SITE;?>/img/member002.png" alt="..."> </p>
                  </a>
                  <div class="media-body member-contents01">
                    <h4 class="media-heading">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</h4>
                  <div class="member_rating">
                   <p>Candice Eden</p> <div class="stars"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> </div>
                  </div>
                  </div>
                </div>
                      <div class="edit-buttons edit-buttons-member">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>
                   </div>  
                </div>
            </div>
        </div>
        </div>
        
        <div class="s-event-mid01 s-members-mid02">
            <div class="container">
                <div class="row">
                   <div class="col-md-12"> 
                     <div class="edit-event-detail">
                   <div class="media media-member">
                  <a class="pull-left" href="#"> 
                   <p><button type="button" class="btn btn-default profile-btn">Full Profile</button>
                   <img class="media-object" src="<?php echo LIVE_SITE;?>/img/member003.png" alt="..."> </p>
                  </a>
                  <div class="media-body member-contents">
                    <h4 class="media-heading">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</h4>
                  <div class="member_rating">
                   <p>Jade Robinson</p> <div class="stars"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>img/blue_star.png"> <img src="/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> </div>
                  </div>
                  </div>
                </div>
                       <div class="edit-buttons edit-buttons-member">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>
                   </div>  
                </div>
            </div>
        </div>
        </div>
               
         <div class="s-event-mid01 s-members-mid02">
            <div class="container">
                <div class="row">
                   <div class="col-md-12"> 
                     <div class="edit-event-detail">
                   <div class="media media-member media-member-right">
                  <a class="pull-right" href="#">
                   <p> <button type="button" class="btn btn-default profile-btn">Full Profile</button>
                   <img class="media-object" src="<?php echo LIVE_SITE;?>/img/member004.png" alt="..."> </p>
                  </a>
                  <div class="media-body member-contents01">
                    <h4 class="media-heading">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</h4>
                  <div class="member_rating">
                   <p>mark wahlberg</p> <div class="stars"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> </div>
                  </div>
                  </div>
                </div>
                     <div class="edit-buttons edit-buttons-member">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>
                   </div>  
                </div>
            </div>
        </div>
        </div>
        
        <div class="s-event-mid01 s-members-mid02">
            <div class="container">
                <div class="row">
                   <div class="col-md-12"> 
                    <div class="edit-event-detail">
                   <div class="media media-member">
                  <a class="pull-left" href="#">
                   <p> <button type="button" class="btn btn-default profile-btn">Full Profile</button>
                   <img class="media-object" src="<?php echo LIVE_SITE;?>/img/member001.png" alt="..."> </p>
                  </a>
                  <div class="media-body member-contents">
                    <h4 class="media-heading">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</h4>
                  <div class="member_rating">
                   <p>Janine Oosthuizen</p> <div class="stars"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> </div>
                  </div>
                  </div>
                </div>
                     <div class="edit-buttons edit-buttons-member">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>
                   </div>  
                </div>
            </div>
        </div>
        </div>
               
         <div class="s-event-mid01 s-members-mid02">
            <div class="container">
                <div class="row">
                   <div class="col-md-12"> 
                      <div class="edit-event-detail">
                   <div class="media media-member media-member-last">
                  <a class="pull-right" href="#"> 
                   <p><button type="button" class="btn btn-default profile-btn">Full Profile</button>
                   <img class="media-object" src="img/member003.png" alt="..."> </p>
                  </a>
                  <div class="media-body member-contents01">
                    <h4 class="media-heading">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</h4>
                  <div class="member_rating">
                   <p>Alex Cutler</p> <div class="stars"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> </div>
                  </div>
                  </div>
                </div>
                      <div class="edit-buttons edit-buttons-member">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>
                   </div>  
                </div>
            </div>
        </div>
        </div> -->
                 
           <?php   $i=2;foreach($members as $mem){
				  ?>
            <div class="s-event-mid01 s-members-mid02">
            <div class="container">
                <div class="row">
                   <div class="col-md-12"> 
                      <div class="edit-event-detail"> 
                   <div class="media media-member media-member-right">
                  <a href="#" class="<?php echo (($i++%2=='0')?'pull-left':'pull-right')?>">
                   <p> <button class="btn btn-default profile-btn" type="button">Full Profile</button>
                   <img alt="..." src="<?php  echo LIVE_SITE.'/img/upload_userImages/'.$mem['Members']['image']?>" class="media-object"> </p>
                  </a>
                  <div class="media-body member-contents01">
                    <h4 class="media-heading"><?php echo $mem['Members']['description']?></h4>
                  <div class="member_rating">
                   <p><?php echo $mem['Members']['name']?></p> <div class="stars"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> <img src="<?php echo LIVE_SITE;?>/img/blue_star.png"> </div>
                  </div>
                  </div>
                </div>
                <?php if($this->Session->check('Admin')=='true'){
						?>
                      <div class="edit-buttons edit-buttons-member">
                     <button data-target="#myModal<?php echo $mem['Members']['id'];?>" data-toggle="modal" class="btn btn-default edit-btn-blue" type="submit">Edit</button>
                     <button data-target="#myModal<?php echo $mem['Members']['id'];?>" data-toggle="modal" class="btn btn-default edit-btn-red" type="submit">Delete</button>
                     </div>
                     <?php } ?>
                   </div>  
                </div>
            </div>
        </div>
        </div>       
                   
                   
              <?php } ?>                
                   
       
                
         
    </body>
</html>
