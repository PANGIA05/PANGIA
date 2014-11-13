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
		$getdatalike=mysql_query("select post_id,uid from likes where post_id='$post_id' and uid='$uid'");
		$postidlike = mysql_fetch_array($getdatalike);
		if(!empty($postidlike))
			{
				$sqls="UPDATE likes SET status='1' WHERE post_id ='$post_id' AND uid ='$uid'";
				$res=mysql_query($sqls);
				if($res)
					echo "0";
				else
					echo "00";
			} 
			else
			{
			$sql="insert into likes (post_id,uid,type,status) values('$post_id','$uid','$type','$stauts')";		
			$result=mysql_query($sql);
			
				if($result)
					echo "0";
				else
					echo "00";
			
		  }	
	}
	
	else 
	{
		$getdatalike=mysql_query("select post_id,uid,status from likes where post_id='$post_id' and uid='$uid'");
		$postidlike = mysql_fetch_array($getdatalike);
		//print_r($postidlike);
		if($postidlike['status']==1)
			{
				$sqls="UPDATE likes SET status='0' WHERE post_id ='$post_id' AND uid ='$uid'";
				//echo "UPDATE likes SET status='0' WHERE post_id ='$post_id' AND uid ='$uid'";
				$res=mysql_query($sqls);
				if($res)
					echo "0";
				else
					echo "00"; 
		   }		
	}	
}	

	
?>
