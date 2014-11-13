<?php ?>
 <div class="col-md-3 col-sm-3 b-right">
                    <div class="leftsidebar">
                    <h4 class="page-title tUpper t-grey tBold dP-all-s noMargin">IMPORTANT PAGES</h4>
                       <ul class="nav">
						<?php $url=$_GET['url'];
							$newurl=explode("/",$url);
							$seturl=$newurl[1];
							//pr($seturl);
						?>
							<?php if($seturl=='tour')
								{ ?>
							   <li class="active"><a href="<?php echo LIVE_SITE.'/tour'?>">How it works</a></li>
								<?php } else { ?>
									<li><a href="<?php echo LIVE_SITE.'/tour'?>">How it works</a></li>
									<?php } ?>
							<?php if($seturl=='success')
								{ ?>
							   <li class="active"><a href="<?php echo LIVE_SITE.'/users/success'?>">Success stories</a></li>
								<?php } else { ?>
									<li><a href="<?php echo LIVE_SITE.'/users/success'?>">Success stories</a></li>
									<?php } ?>
							<?php if($seturl=='faq')
								{ ?>
							    <li class="active"><a href="<?php echo LIVE_SITE.'/static/faq'?>">Help</a></li>
								<?php } else { ?>
									 <li><a href="<?php echo LIVE_SITE.'/static/faq'?>">Help</a></li>
									<?php } ?>
							<?php if($seturl=='questions')
								{ ?>
							    <li class="active"><a href="<?php echo LIVE_SITE.'/static/questions'?>">Questions</a></li>
								<?php } else { ?>
									 <li><a href="<?php echo LIVE_SITE.'/static/questions'?>">Questions</a></li>
									<?php } ?>						
							<?php if($seturl=='about_us')
								{ ?>
							    <li class="active"><a href="<?php echo LIVE_SITE.'/about_us'?>">About Us</a></li>
								<?php } else { ?>
									<li><a href="<?php echo LIVE_SITE.'/about_us'?>">About Us</a></li>
									<?php } ?>			
									
						
                       </ul>
                    </div>
                </div>

