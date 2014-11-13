<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination


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


// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');
	print_r($_FILES);
echo $_FILES['vasPhoto_uploads']['name'];

die('okaka singh');
if (!empty($_FILES)) {
	//print_r($_FILES);
	$filename=$_FILES["upl"]["name"];
	$file_temp_name=$_FILES["upl"]["tmp_name"];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);	
    	if (in_array(strtolower($ext),$allowed)) 
		{
	$date=date('y_m_d_s');
	//echo "here we are ";/var/www/html/iWrestled/app/webroot/img/matuploads
        if(move_uploaded_file($file_temp_name, WEBROOT.'/app/webroot/img/uploads_photos/'.'pic_'.$date.$_FILES["upl"]["name"]))
			{
				$uid=$_POST['userid'];
				$date=date('y-m-d');
				$sql="insert into matphotoimages (images,user_id,date) values('$imgname',$uid,$date)";
				mysql_query($sql);
				$lastid=mysql_insert_id();
				echo $lastid;
			}
			else
			{
				echo "00";
			}
		} else {	
				echo "0";
			}
}

?>
