<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pangia : : About Us</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<!-- Can use it Lator -->
<!--script>
	$(document).ready(function(){ 
	 var userimage='';
	function showUploadedItem (source) {
		alert(source);
		 userimage.css({width : '152px',height : '152px'}).attr('src',source);
	 }
	if (window.FormData) {
		formdata = new FormData();
	}
	$(".test").change(function(){
		var imgId=$(this).attr("id");
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
</script--> 
<script type="text/javascript">
function updateAboutus(id){
	 var descId='';
	 var desc='';
	  descId="aboutus_description"+id;
	  desc=CKEDITOR.instances[descId].getData();
	  
	var data1 = $('#aboutus'+id).closest("form").serialize();
	var img=$('#imgname'+id).val();
	//alert(img);
	 $.ajax({
		type: 'POST',
		url:'<?php echo LIVE_SITE;?>/admins/updateAboutUs',
		data:data1+'&id='+id+'&dec='+desc+'&img='+img,
		success: function (response) {
		},
		error: function (xhr, ajaxOptions, thrownError) {
			 console.log(xhr);
		},
		complete:function(){
		  window.location.href='<?php echo LIVE_SITE;?>/admins/about';
		}
	});
	
}
</script> 

 </head>
 <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
   <div class="s-top">
       <div class="container">
          <div class="row">
             <div class="col-md-9 col-sm-9  noPadding"></div>
		   </div>   
		 </div>
  </div>
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
    <div class="collapse navbar-collapse navbar-collapse-custom " id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav nav-custom">
        <li><a href="about.html" class="active">ABOUT US</a></li>
        <li><a href="#">MENU</a></li>
         <li><a href="#">GALLERY</a></li>
          <li><a href="#">VOUCHERS</a></li>
           <li><a href="event.html">EVENTS</a></li>
            <li><a href="#">BLOG</a></li>
            <li><a href="contact.html">CONTACT </a></li>
      </ul>
      <ul class="nav navbar-nav nav-custom">
      </ul>

    </div><!-- /.navbar-collapse -->                     
                                 </div>   
                                   </div>
		</div>
        
        <!-- Show on Device -->          
        
        
      <!--  <div class="s-about-mid01">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="m-about-mid01-left">
                        <img src="<?php echo LIVE_SITE;?>/img/about01.jpg" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="m-about-mid01-right">
                        <h1>About us</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since                          the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five                          centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of                          Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of</p>
                        <p class="paddingTop-25">Lorem Ipsum. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45                           BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more                           obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the                           undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by </p> 
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
        <div class="s-about-mid02">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         <div class="m-about-mid02-left">
                                 <h1>Neque porro</h1>
                                 <h2>Quisquam</h2>
                                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text                                    ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not</p>
                                  <h2>Voluptatem</h2>
                                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text                                    ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not</p>
                                  <h2>Consequuntur</h2>
                                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text                                    ever since the 1500s, when an unknown printer took a galley of type   </p>
   
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="m-about-mid02-right">
                         <img src="<?php echo LIVE_SITE;?>/img/about02.png" class="img-responsive">
               
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
              
    <?php  $i=2; foreach($data as $value){
	  ?>
		<div class="s-about-mid01">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 <?php echo (($i++%2=='0')?'pull-left':'pull-right')?>">
                         <div class="m-about-mid01-left">
                        <img class="img-responsive" src="<?php echo LIVE_SITE.'/img/upload_userImages/'.$value['Abouts']['image'];?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <div class="m-about-mid01-right">
                        <h1><?php echo $value['Abouts']['name'];?></h1>
                        <div class=''><?php echo $value['Abouts']['description']?></div>
                      </div>
                       <?php if($this->Session->check('Admin')=='true'){
						?>
                      <div class="edit-buttons edit-buttons-member">
                     <button type="submit" class="btn btn-default edit-btn-blue" data-toggle="modal" data-target="#myModal<?php echo $value['Abouts']['id']?>">Edit</button>
                     <button type="submit" class="btn btn-default edit-btn-red" data-toggle="modal" data-target="#myModal">Delete</button>
                     </div>
                     <?php } ?>
                    </div>
                     
                </div>
            </div>
        </div>
<?php } ?>



 <!-- Modal popup html CREATIN G dYNAMICALLY --> 
 <?php foreach($data as $value){
	  $id= $value['Abouts']['id'];
	echo $this->Form->create("aboutus$id",array('onsubmit' => "return updateAboutus($id);",'id'=>"aboutus$id",'enctype'=>"multipart/form-data"));
	  ?>
<div class="modal fade" id="myModal<?php echo  $value['Abouts']['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-edit-mode">
    <div class="modal-content">
      <div class="modal-body noPadding">
       <div class="s-event-mid02 s-event-mid03">
            <div class="container modal-container">
                <div class="row">
                    <div class="col-md-4 left-edit-section  ">
                     <div class="upload-image upload-image01">
                       <div class="media media-member  noBorder noPadding">
						<a href="#">
						<p>  <img class="media-object" src="<?php echo LIVE_SITE.'/img/upload_userImages/'.$value['Abouts']['image']?>"     id="img<?php echo $id;?>" style="width:100%;";> </p>
						</a>
						</div>
                     </div>
                      <div class="form-group">
					<input type="file" id="<?php echo $value['Abouts']['id'] ?>" class="test" data-chek="members">
					</div>
					 <div class="form-group">
					<?php echo $this->Form->input('aboutname', array('type'=>'text','label'=>false,'class'=>'form-control','value'=>$value['Abouts']['name'])); 
					 echo $this->Form->input('img', array('type'=>'hidden','label'=>false,'class'=>'test',
					'id'=>"imgname$id",'value'=>$value['Abouts']['image'] )); 
					?>
					</div>
                   </div>
                    <div class="col-md-8 edit-section-right">
                     <img src="<?php echo LIVE_SITE;?>/img/edit_controls.jpg" class="img-responsive">
                     <div class="member-edit-text">
				   
                      <h3>
						<?php echo $this->Form->input('about_description',array('label'=>false,'id'=>"aboutus_description$id",'type'=>'textarea','class'=>'form-control','placeholder'=>'Specify the description for your fundraiser','row'=>'10','cols'=>'80',
						'value'=>$value['Abouts']['description']));
							?>
                              <script>
                
                            CKEDITOR.replace("aboutus_description<?php echo $id ?>");
                
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
    </body>
</html>
