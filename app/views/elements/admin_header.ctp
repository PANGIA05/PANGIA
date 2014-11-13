<div id="container">
	<div id="header">
	<h1><a href="<?php echo $this->webroot; ?>admins/dashboard">GoFundMe</a></h1>
	<div id="wphead-info">
		<div id="user_info">

		<p><span style="font-weight:bold; color:white;">Welcome</span>, 
		<a title="Edit your profile" href="<?php echo $this->webroot ?>admins/myProfile/<?php echo $this->Session->read('userid'); ?>">Me(<?php echo $this->Session->read('Admin.username'); ?>)</a>
		<span class="turbo-nag hidden" style="display: inline;"> |</span> 
		<a title="Logout" href="<?php echo $this->webroot ?>admins/logout">Logout</a></p>
		</div>
	</div>
</div>





