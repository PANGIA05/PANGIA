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
//print_r($_POST);
$uid=$_SESSION['User']['id'];
$update=$_POST['getid'];
$updatecheck=$_POST['getcheckid'];
$setval=$_POST['setval'];

if(!empty($update))
		{
		if($update=='wrestlerName1') {
				
				$rest=mysql_query("update userprivacies set wrestlerName='$setval' where uid='$uid'");
				
			} else if($update=='fullName1'){
				
				$rest=mysql_query("update userprivacies set fullName='$setval' where uid='$uid'");
				
			} else if($update=='weight1') {
				
				$rest=mysql_query("update userprivacies set weight='$setval' where uid='$uid'");
				
			} else if($update=='email1') {
				
				$rest=mysql_query("update userprivacies set email='$setval' where uid='$uid'");
				
			} else if($update=='dateOfBirth1') {
				
				$rest=mysql_query("update userprivacies set dateOfBirth='$setval' where uid='$uid'");
				
			} else if($update=='gender1') {
				
				$rest=mysql_query("update userprivacies set gender='$setval' where uid='$uid'");
				
			} else if($update=='address1') {
				
				$rest=mysql_query("update userprivacies set address='$setval' where uid='$uid'");
			}
	}	
	
		

	
?>
