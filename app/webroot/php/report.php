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




//print_r($_POST);

//print_r($_SESSION);
		
	//print_r($_SESSION);// die('okak');
	
	$uid=$_SESSION['User']['id'];
	$repid=$_POST['id'];   
//print_r($_POST); die('kk');
	$sql="insert into reportarticles (uid,repid) values('$uid','$repid')";
	//echo "insert into posts (uid,text,photo_id,activity_text,share_video) values('$uid','$postext','$image_id','$statustext','$tubeurl')";
	$result=mysql_query($sql);
	if($result)
		{
			
			echo "0";
			
		} else {

			echo "00";
			}

?>
