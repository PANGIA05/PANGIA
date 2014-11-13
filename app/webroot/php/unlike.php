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

$uid=$_SESSION['User']['id'];
$post_id=$_POST['post_id'];
$type=$_POST['type'];
$ltype=$_POST['ltype'];
$stauts=$_POST['status'];

if($_POST)		
{
	if($ltype=='like')	
	{
		$sql="insert into likes (post_id,uid,type,status) values('$post_id','$uid','$type','$stauts')";		

		$result=mysql_query($sql);
		if($result)
			echo "0";
		else
			echo "00";
	}
	
	else 
	{
		$sql="update likes set  status='0' where post_id='$post_id' and uid='$uid')";		
		$result=mysql_query($sql);
		if($result)
			echo "0";
		else
			echo "00";
		
		
	}	
}	

	
?>
