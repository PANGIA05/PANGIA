<style type="text/css">  
#selector input{ color:red }
input:-moz-placeholder{ color:green }  
</style>

<?php $olist=$this->requestAction('users/occupationList'); ?>
<?php $slist=$this->requestAction('users/specialtyList'); ?>
<?php $sslist=$this->requestAction('users/subSpecialtyList'); ?>
<?php $countryList=$this->requestAction('users/getCountry'); ?>

<?php echo $this->Form->create('User',array('url'=>'register/', 'class'=>'form-horizontal','id'=>'registerCreateForm')); ?>
<?php //echo $this->Form->input('id',array('type'=>'hidden','label'=>false, 'value'=>$uid)); ?>
<?php //echo $this->Form->input('user_agreement',array('label'=>false, 'id'=>'user_agreement','type'=>'hidden', 'value'=>'1')); ?>

<!-- BOC - REGISTER STEP -->
	<div id="register" style="display:block;">
<!-- /* Content area starts */ -->
        <div class="container relative" style="top:-15px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="displayB inner-wrap solid-all xRound dP-all-l">
                    <?php echo $this->Session->flash(); ?>
                        <div class="extra-padding solid-all noBorderLeft noBorderRight noBorderTop dMxxx">
                            <h4 class="page-title large aCenter blue">Create Your Account</h4>
                            <p class="aCenter">Bacon ipsum dolor sit amet turkey biltong boudin<br> short ribs pork chop, tail rump bacon jerky. Prosciutto andouille t-bone capicola pork belly.</p>
                        </div>
                        
                        <!-- /* Centered form starts */ -->
                        <div class="container" style="max-width:500px;">
                            <div class="row">
                                <div class="col-md-12">
                                	<div class="displayB">
                                    
                                       <?php //echo $this->Form->create('User',array('url'=>'register/', 'class'=>'form-horizontal','id'=>'register','name'=>'register','onSubmit'=>'return validateRegister();')); ?>
                                       <?php if(!empty($rid)){ 
													echo $this->Form->hidden('rid', array('value'=>$rid,'label'=>false)); } ?>
													
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label custom-label">Email address<span style="color:red">*</span> </label>
                                                <div class="col-sm-8">
													<?php echo $this->Form->input('email',array('label'=>false, 'type'=>'text','required'=>false, 'id'=>'email','class'=>'form-control','placeholder'=>'Email')); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-4 control-label custom-label">Create Password<span style="color:red">*</span></label>
                                                <div class="col-sm-8">
													<?php echo $this->Form->input('password',array('label'=>false, 'required'=>false, 'type'=>'password','id'=>'password','class'=>'form-control','placeholder'=>'Create password')); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-4 control-label custom-label">Confirm Password<span style="color:red">*</span></label>
                                                <div class="col-sm-8">
                                                <?php echo $this->Form->input('repassword',array('label'=>false, 'id'=>'repassword', 'required'=>false,'type'=>'password','class'=>'form-control','placeholder'=>'Confirm password')); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-4 control-label custom-label">User Agreement<span style="color:red">*</span></label>
                                                <div class="col-sm-8">
                                                	<div class="checkbox">
                                                        <label class="custom-label">
                                                        	<!--input type="checkbox"--> 
                                                        	<?php echo $this->Form->input('user_agreement',array('label'=>false, 'id'=>'user_agreement','type'=>'checkbox','div'=>false)); ?>
                                                        	<span id="error_checbox1"></span>
                                                        	By Checking this box, You agree to the terms in our user agreement.
                                                        </label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div><!-- /* Centered form ends */ -->
                        
                        <div class="dP-all-l solid-all noBorderLeft noBorderRight noBorderBottom dMxxx">
                            <div class="form-group aCenter">
                            	<a href="javascript:void(0)" id="registerNext" class="btn btn-primary btn-custom">Next</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div><!-- /* Content area ends */ -->
    </div>
<!-- EOC - REGISTER STEP --> 



<!-- BOC - CREATE STEP-I --> 
<div id="stepOne" style="display:none;">
        <div class="container relative" style="top:-15px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="displayB inner-wrap solid-all xRound dP-all-l">
                   
                        <div class="extra-padding solid-all noBorderLeft noBorderRight noBorderTop dMxxx">
							
                            <h4 class="page-title large aCenter blue">Create Your Medicine 24x7 Account </h4>
                            <p class="aCenter">Bacon ipsum dolor sit amet turkey biltong boudin<br> short ribs pork chop, tail rump bacon jerky. Prosciutto andouille t-bone capicola pork belly.</p>
                        </div>
							<div class="row">
								<div class="col-md-6" style="border-right:1px solid #E2E2E2;">
									<div class="displayB">
									<h4 class="page-title medium aLeft blue">Name & Occupation</h4>
									
									
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Prefix<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php $prefix = array('Dr.'=>'Dr.','Miss'=>'Miss','Mr.'=>'Mr.','Mrs.'=>'Mrs.','Ms.'=>'Ms.','Prof.'=>'Prof.'); ?>
													<?php echo $this->Form->input('prefix',array('label'=>false, 'id'=>'prefix','class'=>'form-control','type'=>'select', 'options'=>$prefix)); ?>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">First Name<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php echo $this->Form->input('first_name',array('label'=>false, 'id'=>'first_name','class'=>'form-control','placeholder'=>'First name','type'=>'text')); ?>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Middle Name</label>
												<div class="col-md-8">
													<?php echo $this->Form->input('middle_name',array('label'=>false, 'id'=>'prefix','class'=>'form-control','placeholder'=>'Middle Name')); ?>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Last Name<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php echo $this->Form->input('last_name',array('label'=>false, 'id'=>'last_name','class'=>'form-control','placeholder'=>'Last name','type'=>'text')); ?>
												</div>
											</div>
											
											
											
											
											
											
											
											
											
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Gender<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php 
													$options = array(
															'M' => 'Male',
															'F' => 'Female'
														);

														$attributes = array(
															'legend' => false,
															'label' => array('class'=>'custom-label'),
															'div' => false,
															'default'=>'M'														
															);
														echo $this->Form->radio('gender', $options, $attributes);
													?>
													
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Occupation<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php $olist[0] = 'Select Occupation'; ?>
													<?php echo $this->Form->input('occupation',array('label'=>false,'id'=>'occupation','width' => 100, 'class'=>'form-control select-custom occupation','value'=>0,'type'=>'select', 'width' => 100, 'options'=>$olist)); ?>
													
												</div>
											</div>

											<div id="regSplField" style="display:none">
												<div class="form-group">
													<label for="inputPassword3" class="col-md-4 control-label custom-label">Speciality<span style="color:red;">*</span></label>
													<div class="col-md-8" id="specialitydata" >
														<?php echo $this->Form->input('specility',array('id'=>'specility', 'label' => '', 'class'=>'form-control select-custom','placeholder'=>'Please select occupation first', 'disabled')); ?>

														</div>
												</div>
												
												<div class="form-group">
													<label for="inputPassword3" class="col-md-4 control-label custom-label">Sub Speciality</label>
													<div class="col-md-8" id="subSpecialityData">
														<?php echo $this->Form->input('sub-specility',array('id'=>'subSpeciality', 'label' => '', 'class'=>'form-control','placeholder'=>'Please select speciality first', 'disabled')); ?>
													</div>
												</div>
											
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Title Practice</label>
												<div class="col-md-8">
													<?php echo $this->Form->input('title_practice',array('label'=>false, 'id'=>'title_practice','class'=>'form-control','placeholder'=>'eg. Family, Medicine')); ?>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Degree<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php echo $this->Form->input('degree',array('label'=>false, 'id'=>'degree','class'=>'form-control','placeholder'=>'eg. MD, BDS')); ?>
												</div>
											</div>
																			   
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="displayB">
									 <h4 class="page-title medium aLeft blue">Office Information</h4>
									
											<div class="form-group">
												<label for="inputEmail3" class="col-md-4 control-label custom-label">Street Address<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php echo $this->Form->input('address',array('type'=>'textarea', 'label' => false, 'rows'=>'5', 'class'=>'form-control')); ?>
													
												</div>
											</div>
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Suite (Optional)</label>
												<div class="col-md-8">
													<?php echo $this->Form->input('suite',array('label'=>false, 'id'=>'suite','class'=>'form-control')); ?>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Zip Code<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php echo $this->Form->input('zipcode',array('label'=>false, 'type'=>'text', 'id'=>'zipcode','class'=>'form-control')); ?>
												</div>
											</div>
											
											 <div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Office Phone<span style="color:red;">*</span></label>
												<div class="col-md-8">
													<?php echo $this->Form->input('phone',array('label'=>false, 'id'=>'phone','class'=>'form-control')); ?>
												</div>
												
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Extension</label>
												<div class="col-md-8">
													<?php echo $this->Form->input('ext',array('label'=>false,'type'=>'text', 'id'=>'ext','class'=>'form-control')); ?>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputPassword3" class="col-md-4 control-label custom-label">Office Fax</label>
												<div class="col-md-8">
													<?php echo $this->Form->input('fax',array('label'=>false, 'id'=>'fax','class'=>'form-control')); ?>
												</div>
											</div>
									</div>
								</div>
							</div>
						
							<div class="dP-all-l solid-all noBorderLeft noBorderRight noBorderBottom dMxxx">
								<div class="form-group aCenter">
									<a href="javascript:void(0)" id="stepOnePrev" class="btn btn-default btn-custom">Previous</a>
									<a href="javascript:void(0)" id="stepOneNext" class="btn btn-primary btn-custom">Next</a>
									<!--button id="stepOneNext" class="btn btn-primary btn-custom">Next</button-->
								</div>
							</div>
			            </div>
                </div>
            </div>
        </div>
	</div>
<!-- EOC - CREATE STEP-I -->
<!-- BOC - CREATE STEP-II -->
<div id="stepTwo" style="display:none">
<div class="container relative" style="top:-15px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="displayB inner-wrap solid-all xRound dP-all-l">
                    
                        <div class="extra-padding solid-all noBorderLeft noBorderRight noBorderTop dMxxx">
                            <h4 class="page-title large aCenter blue">Create Your Account</h4>
                            <p class="aCenter">Bacon ipsum dolor sit amet turkey biltong boudin<br> short ribs pork chop, tail rump bacon jerky. Prosciutto andouille t-bone capicola pork belly.</p>
                        </div>
                        
                        <!-- /* Centered form starts */ -->
                        <div class="container" style="max-width:580px;">
                            <div class="row">
                                <div class="col-md-12">
                                	<div class="displayB">
                                    <h4 class="page-title large aCenter blue">Professional Verification</h4>
                                                                                    
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label custom-label">Medical School Country<span style="color:red;">*</span></label>
                                                <div class="col-sm-8">
												<?php $countryList[0] = 'Select Country..'?>	
												<?php echo $this->Form->input('country',array('type'=>'select', 'id'=>'country', 'options'=>$countryList,'value'=>0, 'label' => '', 'class'=>'country form-control select-custom')); ?>
                                                </div>
                                            </div>
                                            
                                        <div id="stateCollegeYear" style="display:none">
                                            
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label custom-label">State<span style="color:red;">*</span></label>
                                                <div class="col-sm-8" id="stateListAjax">
												<?php echo $this->Form->input('state',array('type'=>'text', 'id'=>'state', 'label' => '', 'class'=>'form-control select-custom', 'placeholder'=>'Please select country', 'disabled')); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label custom-label">School/College<span style="color:red;">*</span></label>
                                                <div class="col-sm-8" id="collegesData">
												<?php echo $this->Form->input('school-college',array('id'=>'school-college', 'label' => '', 'class'=>'form-control','placeholder'=>'Please select State first', 'disabled')); ?>
												
												<?php //echo $this->Form->input('school-college',array('id'=>'school-college', 'label' => '', 'class'=>'form-control','placeholder'=>'Please select State first', 'disabled')); ?>
                                                </div>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label custom-label">Passout Year/Session<span style="color:red;">*</span></label>
                                                <div class="col-sm-8" id="collegesData">
												<?php echo $this->Form->year('class-year', date('Y') - 63, date('Y') - 0, array('empty' => 'Passout Year','class'=>'form-control select-custom', 'id'=>'passoutYear' ) ); ?>
                                                </div>
                                            </div>
                                         
                                        </div>    
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label custom-label">Date of Birth<span style="color:red;">*</span></label>
                                                <div class="col-sm-8">
                                                   <div class="row">
                                                       <div class="col-md-3">
														<?php echo $this->Form->day('dob', array('empty' => 'Day','class'=>'form-control select-custom inline-margin')); ?>
                                                       </div>
                                                       
                                                       <div class="col-md-5">
														<?php echo $this->Form->month('dob', array('empty' => 'Month','class'=>'form-control select-custom inline-margin')); ?>
                                                       </div>

                                                       <div class="col-md-4">
														<?php echo $this->Form->year('dob', date('Y') - 63, date('Y') - 1, array('empty' => 'Year','class'=>'form-control select-custom' ) ); ?>
                                                       </div>
                                                   </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label custom-label">Medical licence Number<span style="color:red;">*</span></label>
                                                <div class="col-sm-8">
												<?php echo $this->Form->input('licence',array('label'=>false, 'id'=>'licence','class'=>'form-control','placeholder'=>'Medical licence Number')); ?>
                                                 </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label custom-label">Home Zip<span style="color:red;">*</span></label>
                                                <div class="col-sm-8">
												<?php echo $this->Form->input('home-zip',array('label'=>false, 'id'=>'home-zip','class'=>'form-control','placeholder'=>'Home Zip')); ?>
                                                </div>
                                            </div>
										</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="dP-all-l solid-all noBorderLeft noBorderRight noBorderBottom dMxxx tMxx">
                            <div class="form-group aCenter">
								<!--button id="stepTwoPrev" class="btn btn-default btn-custom">Previous</button>
                                <button id="stepTwoNext" class="btn btn-primary btn-custom">Next</button-->
                                <a href="javascript:void(0)" id="stepTwoPrev" class="btn btn-default btn-custom">Previous</a>
                                <a href="javascript:void(0)" id="stepTwoNext" class="btn btn-primary btn-custom">Save</a>
                                
                                <!--button class="btn btn-primary btn-custom"  id="stepTwoNext">Save</button-->
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
	</div>    
	<!-- EOC - CREATE STEP-II -->
    <?php $this->Form->end(); ?>
