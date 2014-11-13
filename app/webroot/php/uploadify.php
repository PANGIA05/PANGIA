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


$targetFolder = 'uploads_photos'; // Relative to the root

if (!empty($_FILES)) {
		
		
    //print_r($_FILES);
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = WEBROOT.'/app/webroot/img/'.$targetFolder;
    $imgname='pic_'.time().'_'.$_FILES['Filedata']['name'];
    $targetFile = rtrim($targetPath,'/') . '/' . $imgname;
    // Validate the file type
    $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
    $fileParts = $_FILES['Filedata']['name'];
	$exts = pathinfo($fileParts, PATHINFO_EXTENSION);
	//echo $exts;
	//echo "<hr>";
	 $ext=strtolower($exts);
	// echo $targetFile;
	// echo "<hr>";
	// echo $tempFile;
    if (in_array($ext,$fileTypes)) {
    if(move_uploaded_file($tempFile,$targetFile))
	{
	//echo 'okkka'.$ext;
	$uid=$_POST['userid'];
	$date=date('y-m-d');
	$sql="insert into tempphotoimages (images,user_id,date) values('$imgname',$uid,$date)";
	mysql_query($sql);
	$lastid=mysql_insert_id();
	echo $lastid;
	//echo "hello amit singh";
	}
	else
	{
	 echo  "1";
	}
    } else {
        echo  "2";
    }
} 





?>
