<?php 
session_name("CAKEPHP");
session_start();

include('../../config/database.php');
include('../../config/settings.php');
$DBobj        = new DATABASE_CONFIG();
//echo $DBobj->default['host'];
define ('DB_SERVER',$DBobj->default['host']);
define ('DB_USERNAME',$DBobj->default['login']);
define ('DB_PASSWORD',$DBobj->default['password']);
define ('DB_DATABASE',$DBobj->default['database']);

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());

## Server's date and time. Converting it as per local time.
$date = date('Y-m-d H:i:s');
$date = date('c', strtotime($date));

$uid=$_SESSION['User']['id'];
$post_id=$_POST['post_id'];
$type=$_POST['type'];
$comment=$_POST['comment'];
$upmsg=$_POST['upmsg'];
$commentid=$_POST['commentid'];
//print_r($_POST); die('okaoma');


if($_POST['type']=='getmorecom')
	{ ?>
		
									<script>
											function editcomment(id)
														{
															$('.commenthide_'+id).hide();
															$('.commentshow_'+id).show();
														}

											function DeleteComent(id,pid){
											var answer = confirm ("Are you sure you want to delete comment?");
											if(answer){
											var getoldcom=$('#allcom_'+pid).text();
											var totaocoms=parseInt(getoldcom)-1;
											$.ajax({
											type:'POST',
											data:'Commentid='+id,
											url:'<?php echo LIVE_SITE;?>/users/deletepostComment',
											success:function(msg){
											$('#allcom_'+pid).text(totaocoms);
											$('.main_'+id).hide();
											//alert(msg);
											}
											});
											}
											}
											
											
											$(document).ready(function(){
											$('.upedit').click(function(){
											var getid = $(this).attr('id');
											var hideid=getid.split("_");
											var ids=hideid[1];
											$('.commenthide_'+ids).hide();
											$('.commentshow_'+ids).show();
											//$('#comedit_'+ids).show();													
											});
												
											});
											
											
										/* Like functionality */
											function likepost(postid)
											{
												var type="like";
												var ltype="like";
												var status='1';
												$('#like_'+postid).hide();	
												$('#unlike_'+postid).show();	
												var tex=$('#getcount_'+postid).text();
												if(tex=='')
														{
														var totaolike=1+tex;	
															
														} else {
																var totaolike = +1 + +tex;
															}
												var totaolikes=$('#getcount_'+postid).text(totaolike);
												$.ajax({
												type: "POST",
												url: "<?php echo LIVE_SITE;?>/php/likes.php?like",
												data: { post_id:postid,type:type,status:status,ltype:ltype }
												})
												.done(function( msg ) {
													//alert(msg);
												});
											}
											
											function unlikepost(postid)
											{
												
												var type="like";
												var ltype="unlike";
												var status='0';
												$('#unlike_'+postid).hide();	
												$('#like_'+postid).show();	
												var tex=$('#getcount_'+postid).text();
												var totaolike=parseInt(tex)-1;
												if (totaolike==0)
														{
															totaolike='';
														}
												var totaolikes=$('#getcount_'+postid).text(totaolike);
												$.ajax({
												type: "POST",
												url: "<?php echo LIVE_SITE;?>/php/likes.php?unlike",
												data: { post_id:postid,type:type,status:status,ltype:ltype }
												})
												.done(function( msg ) {
													//alert(msg);
												});
												
											}	
											
											var upmsg = ".upd_comm";
											var type='comment';																						
											$(upmsg).keydown(function(event) {
													if (event.keyCode == 13) {
														var id = $(this).attr('id');
														var commentid = $(this).attr('rel');
														var postid = id.split("_")
														var pid=postid[1];
														var comment = $(this).val();
														if(comment=='')
															{
																var ids='com_'+pid;
																 document.getElementById('ids').focus();
															}
														$.ajax({
														type: "POST",
														url: "<?php echo LIVE_SITE;?>/php/comment.php",
														data: { post_id:pid,type:type,comment:comment,upmsg:upmsg,commentid:commentid }
														})
														.done(function( msg ) {
														if(msg!='')
															{
															$('#comment_'+postid).val('');
															$('#res_'+postid).empty(msg);
															$('.commenthide_'+commentid).show();	
															$('.changetext_'+commentid).html(comment);	
															$('.commentshow_'+commentid).hide();
															$('#res_'+postid).append(msg);	
																															
															}
														
														});

													}
											});
											
											
													
										/* End Like functionality here */
										</script>
										
										
										<?php 	$sql = mysql_query("select * from comments where post_id='$post_id'");
											while($rows=mysql_fetch_array($sql))
											{ 
											$commentid=$rows['id'];
											$getid=$rows['uid'];
											$comment=$rows['comment'];
											$userqry="select * from users where id='$getid'";
											$uquery = mysql_query($userqry);
											$userdata=mysql_fetch_array($uquery);
											$uname=$userdata['firstname'].''.$userdata['lastname'];
											$uimg=$userdata['image'];
											
											?>
												
												
										<div class="one-comment cf main_<?php echo $commentid;?>">
										<div class="ca-ua fl">
										<a href="#">
										<?php if(empty($uimg)) { ?> 
										<img src="img/no-image.jpg">
										<?php } else { ?>
										<img style="width:30px;" src="<?php echo LIVE_SITE .'/img/upload_userImages/'.$uimg;?>">
										<?php } ?></a>
										</div><!-- /ca-ua -->

										<div class="comment-text fl commenthide_<?php echo $commentid;?>  ac-input fl grid-w9">
										<span class="user-name db"><a href="#"><?php echo $uname;?></a></span>
										<span class="ct changetext_<?php echo $commentid;?>"><p><?php echo $comment; ?></p></span>

										<?php if($uid==$getid)
										{ ?>
										
										<a href="javascript:void(0)"  id="comedit_<?php echo $commentid;?>" onclick="return editcomment(<?php echo $commentid;?>)" class="edit">  Edit</a>
										<a href="javascript:void(0)" onclick="DeleteComent(<?php echo $commentid;?>,<?php echo $post_id; ?>)"  id="delete_<?php echo $commentid;?>" class="delete">  Delete</a>
										
										<?php } ?>
										</div><!-- /comment-text -->



				
						<!-------------- edit comment start here ---------------------->
									<div id="uphide_<?php echo $commentid;?>" style="display:none;" class="comment-text fl commentshow_<?php echo $commentid;?> ac-input fl grid-w9">
									<textarea style="border:1px solid gray;" class="text-holder upd_comm" value="" id="edit_<?php echo $post_id; ?>"
									 rel="<?php echo $commentid;?>" placeholder="Contribute.."><?php echo $comment; ?> </textarea>
									</div>
										
										</div><!-- /comment-text -->
				
									
							<!-------------- edit comment end here ----------------------->
	
					<?php } ?>
					
					<div id="res_<?php echo $post_id;?>">	
					
					 
					 
	<?php 	} else  if($_POST)		
			{
		if(empty($upmsg))
			{
		$sql = "insert into comments (post_id,uid,type,comment,date) values ($post_id,$uid,$type,'".mysql_real_escape_string($comment)."', NOW())";
		$query = mysql_query($sql);
		$commentid=mysql_insert_id();
		$compareid=mysql_query("select uid from comments where id='$commentid'");
		$getid=mysql_fetch_array($compareid);
		
			if($query)
				{ 


				$userqry="select * from users where id=$uid";
				$uquery = mysql_query($userqry);
				$userdata=mysql_fetch_array($uquery);
				//echo "<pre>"; print_r($userdata); die;
				$uname=$userdata['firstname'].''.$userdata['lastname'];
				$uimg=$userdata['image'];
				
				?>
									<script>
											function editcomment(id)
														{
															$('.commenthide_'+id).hide();
															$('.commentshow_'+id).show();
														}

											function DeleteComent(id,pid){
											var answer = confirm ("Are you sure you want to delete comment?");
											if(answer){
											var getoldcom=$('#allcom_'+pid).text();
											var totaocoms=parseInt(getoldcom)-1;	
											$.ajax({
											type:'POST',
											data:'Commentid='+id,
											url:'<?php echo LIVE_SITE;?>/users/deletepostComment',
											success:function(msg){
											$('#allcom_'+pid).text(totaocoms);
											$('.main_'+id).hide();
											//alert(msg);
											}
											});
											}
											}
											
											
											$(document).ready(function(){
											$('.upedit').click(function(){
											var getid = $(this).attr('id');
											var hideid=getid.split("_");
											var ids=hideid[1];
											$('.commenthide_'+ids).hide();
											$('.commentshow_'+ids).show();
											//$('#comedit_'+ids).show();													
											});
												
											});
											
											
										/* Like functionality */
											function likepost(postid)
											{
												var type="like";
												var ltype="like";
												var status='1';
												$('#like_'+postid).hide();	
												$('#unlike_'+postid).show();	
												var tex=$('#getcount_'+postid).text();
												if(tex=='')
														{
														var totaolike=1+tex;	
															
														} else {
																var totaolike = +1 + +tex;
															}
												var totaolikes=$('#getcount_'+postid).text(totaolike);
												$.ajax({
												type: "POST",
												url: "<?php echo LIVE_SITE;?>/php/likes.php?like",
												data: { post_id:postid,type:type,status:status,ltype:ltype }
												})
												.done(function( msg ) {
													//alert(msg);
												});
											}
											
											function unlikepost(postid)
											{
												
												var type="like";
												var ltype="unlike";
												var status='0';
												$('#unlike_'+postid).hide();	
												$('#like_'+postid).show();	
												var tex=$('#getcount_'+postid).text();
												var totaolike=parseInt(tex)-1;
												if (totaolike==0)
														{
															totaolike='';
														}
												var totaolikes=$('#getcount_'+postid).text(totaolike);
												$.ajax({
												type: "POST",
												url: "<?php echo LIVE_SITE;?>/php/likes.php?unlike",
												data: { post_id:postid,type:type,status:status,ltype:ltype }
												})
												.done(function( msg ) {
													//alert(msg);
												});
												
											}	
											
											var upmsg = ".upd_comm";
											var type='comment';																						
											$(upmsg).keydown(function(event) {
													if (event.keyCode == 13) {
														var id = $(this).attr('id');
														var commentid = $(this).attr('rel');
														var postid = id.split("_")
														var pid=postid[1];
														var comment = $(this).val();
														if(comment=='')
															{
																var ids='com_'+pid;
																 document.getElementById('ids').focus();
															}
														$.ajax({
														type: "POST",
														url: "<?php echo LIVE_SITE;?>/php/comment.php",
														data: { post_id:pid,type:type,comment:comment,upmsg:upmsg,commentid:commentid }
														})
														.done(function( msg ) {
														if(msg!='')
															{
															$('#comment_'+postid).val('');
															$('#res_'+postid).empty(msg);
															$('.commenthide_'+commentid).show();	
															$('.changetext_'+commentid).html(comment);	
															$('.commentshow_'+commentid).hide();
															$('#res_'+postid).append(msg);	
																															
															}
														
														});

													}
											});
											
											
													
										/* End Like functionality here */
										</script>
										<div class="one-comment cf main_<?php echo $commentid;?>">
										<div class="ca-ua fl">
										<a href="#">
										<?php if(empty($uimg)) { ?> 
										<img src="img/no-image.jpg">
										<?php } else { ?>
										<img style="width:30px;" src="<?php echo LIVE_SITE .'/img/upload_userImages/'.$uimg;?>">
										<?php } ?></a>
										</div><!-- /ca-ua -->

										<div class="comment-text fl commenthide_<?php echo $commentid;?>  ac-input fl grid-w9">
										<span class="user-name db"><a href="#"><?php echo $uname;?></a></span>
										<span class="ct changetext_<?php echo $commentid;?>"><p><?php echo $comment; ?></p></span>

										<?php if($uid==$getid['uid'])
										{ ?>
										
										<a href="javascript:void(0)"  id="comedit_<?php echo $commentid;?>" onclick="return editcomment(<?php echo $commentid;?>)" class="edit">  Edit</a>
										<a href="javascript:void(0)" onclick="DeleteComent(<?php echo $commentid;?>,<?php echo $post_id; ?>)"  id="delete_<?php echo $commentid;?>" class="delete">  Delete</a>
										
										<?php } ?>
										</div><!-- /comment-text -->



				
				<!-------------- edit comment start here ---------------------->
									<div id="uphide_<?php echo $commentid;?>" style="display:none;" class="comment-text fl commentshow_<?php echo $commentid;?> ac-input fl grid-w9">
									<textarea style="border:1px solid gray;" class="text-holder upd_comm" value="" id="edit_<?php echo $post_id; ?>"
									 rel="<?php echo $commentid;?>" placeholder="Contribute.."><?php echo $comment; ?> </textarea>
									</div>
										
										</div><!-- /comment-text -->
				
									
			<!-------------- edit comment end here ----------------------->
				
				
				
				<?php }								
				
			
		} else {
			

			$sql = "update comments set comment='".mysql_real_escape_string($comment)."' where id='$commentid'";
			$query = mysql_query($sql);
			if($query)
				{ 
		
			$upcompareid=mysql_query("select uid from comments where id='$commentid'");
			$upgetid=mysql_fetch_array($upcompareid);



				$userqry="select * from users where id=$uid";
				$uquery = mysql_query($userqry);
				$userdata=mysql_fetch_array($uquery);
				//echo "<pre>"; print_r($userdata); die;
				$uname=$userdata['firstname'].''.$userdata['lastname'];
				$uimg=$userdata['image'];
				
				?>
			
					<script>
											
											function updatecomment(id)
														{
															$('.commenthide_'+id).hide();
															$('.commentshow_'+id).show();
															
														}
											
											function DeleteComent(id,pid){
											var answer = confirm ("Are you sure you want to delete comment?");
											if(answer){
											$.ajax({
											type:'POST',
											data:'Commentid='+id,
											url:'<?php echo LIVE_SITE;?>/users/deletepostComment',
											success:function(msg){
											$('.main_'+id).hide();
											//alert(msg);
											}
											});
											}
											}
											
											
											$(document).ready(function(){
											$('.upedit').click(function(){
											var getid = $(this).attr('id');
											var hideid=getid.split("_");
											var ids=hideid[1];
											$('.commenthide_'+ids).hide();
											$('.commentshow_'+ids).show();
											//$('#comedit_'+ids).show();													
											});
												
											});
											
											
										/* Like functionality */
											function likepost(postid)
											{
												var type="like";
												var ltype="like";
												var status='1';
												$('#like_'+postid).hide();	
												$('#unlike_'+postid).show();	
												var tex=$('#getcount_'+postid).text();
												if(tex=='')
														{
														var totaolike=1+tex;	
															
														} else {
																var totaolike = +1 + +tex;
															}
												var totaolikes=$('#getcount_'+postid).text(totaolike);
												$.ajax({
												type: "POST",
												url: "<?php echo LIVE_SITE;?>/php/likes.php?like",
												data: { post_id:postid,type:type,status:status,ltype:ltype }
												})
												.done(function( msg ) {
													//alert(msg);
												});
											}
											
											function unlikepost(postid)
											{
												
												var type="like";
												var ltype="unlike";
												var status='0';
												$('#unlike_'+postid).hide();	
												$('#like_'+postid).show();	
												var tex=$('#getcount_'+postid).text();
												var totaolike=parseInt(tex)-1;
												if (totaolike==0)
														{
															totaolike='';
														}
												var totaolikes=$('#getcount_'+postid).text(totaolike);
												$.ajax({
												type: "POST",
												url: "<?php echo LIVE_SITE;?>/php/likes.php?unlike",
												data: { post_id:postid,type:type,status:status,ltype:ltype }
												})
												.done(function( msg ) {
													//alert(msg);
												});
												
											}	
											
											var upmsg = ".upd_comm";
											var type='comment';																						
											$(upmsg).keydown(function(event) {
													if (event.keyCode == 13) {
														var id = $(this).attr('id');
														var commentid = $(this).attr('rel');
														var postid = id.split("_")
														var pid=postid[1];
														var comment = $(this).val();
														if(comment=='')
															{
																var ids='com_'+pid;
																 document.getElementById('ids').focus();
															}
														$.ajax({
														type: "POST",
														url: "<?php echo LIVE_SITE;?>/php/comment.php",
														data: { post_id:pid,type:type,comment:comment,upmsg:upmsg,commentid:commentid }
														})
														.done(function( msg ) {
															//alert('okaoka');
														alert(msg); 
														if(msg!='')
															{
															$('#comment_'+postid).val('');
															$('#res_'+postid).empty(msg);
															$('.commenthide_'+commentid).show();	
															$('.changetext_'+commentid).html(comment);	
															$('.commentshow_'+commentid).hide();
															$('#res_'+postid).append(msg);
																
															}
														
														});

													}
											});
																								
										/* End Like functionality here */
										</script>
										
										<div class="one-comment cf main_<?php echo $commentid;?>">
										<div class="ca-ua fl">
										<a href="#">
										<?php if(empty($uimg)) { ?> 
										<img src="img/no-image.jpg">
										<?php } else { ?>
										<img style="width:30px;" src="<?php echo LIVE_SITE .'/img/upload_userImages/'.$uimg;?>">
										<?php } ?></a>
										</div><!-- /ca-ua -->
										<div class="comment-text fl commenthide_<?php echo $commentid;?> ac-input fl grid-w9">
										<span class="user-name db"><a href="#"><?php echo $uname;?></a></span>
										<span class="ct changetext_<?php echo $commentid;?>"><p><?php echo $comment; ?></p></span>
										
										<?php if($uid==$upgetid['uid'])
										{ ?>
										
										<a href="javascript:void(0)"  id="comedit_<?php echo $commentid;?>" onclick="return editcomment(<?php echo $commentid;?>)" class="edit">  Edit</a>
										<a href="javascript:void(0)" onclick="DeleteComent(<?php echo $commentid;?>,<?php echo $post_id; ?>)"  id="delete_<?php echo $commentid;?>" class="delete">  Delete</a>
										
										<?php } ?>
										</div>
										
										
										<?php /*
										<div class="one-comment cf main_<?php echo $commentid;?>">
										<div class="comment-text fl commenthide_<?php echo $commentid;?>">
										<span class="user-name db"><a href="#"><?php echo $uname;?></a></span>
										<span class="ct"><p><?php echo $comment; ?></p></span>

										<?php if($uid==$getid['uid'])
										{ ?>
										
										<a href="javascript:void(0)"  id="comedit_<?php echo $commentid;?>" onclick="return editcomment(<?php echo $commentid;?>)" class="edit">  Edit</a>
										<a href="javascript:void(0)" onclick="DeleteComent(<?php echo $commentid;?>,<?php echo $post_id; ?>)"  id="delete_<?php echo $commentid;?>" class="delete">  Delete</a>
										
										<?php } ?>
										</div> */?><!-- /comment-text -->



				
				<!-------------- edit comment start here ---------------------->
									<div id="uphide_<?php echo $commentid;?>" style="display:none;" class="comment-text fl commentshow_<?php echo $commentid;?> ac-input fl grid-w9">
									<textarea style="border:1px solid gray;" class="text-holder upd_comm" value="" id="edit_<?php echo $post_id; ?>"
									 rel="<?php echo $commentid;?>" placeholder="Contribute.."><?php echo $comment; ?> </textarea>
									</div>
										</div>
										<!-- /comment-text -->
				
									
			<!-------------- edit comment end here ----------------------->
										
	
		<?php }
	
}

}
	
?>
