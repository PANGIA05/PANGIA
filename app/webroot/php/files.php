<?php
session_name("CAKEPHP");
session_start();


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

	//print_r($_SESSION);

if(empty($_SESSION['img_id']))
		{
			// $random_ids = substr(number_format(time() * rand(),0,'',''),0,10);
			 $random_ids = time();
			 $_SESSION['img_id']=$random_ids;
		     $random_id=$_SESSION['img_id'];
		} else {
			 $random_id=$_SESSION['img_id'];
                       }


/* For delete uploaded photo */

	if($_POST['type']='delete')
		{
		$id=$_POST['id'];
		$del=mysql_query("delete from mattempphotoimages where id='$id'");
		if($del)
			{
			  // echo "0";
			} else {
				//echo "00";
			       }	
		}

/* End here For delete uploaded photo */
for( $i = 0; $i < count( $_FILES ); $i++ ) {
	
	$tmp_filepath = $_FILES[ 'file' ]['tmp_name'];
		
	if ( $tmp_filepath != "" ) {
			
		/*if( ! file_exists( './uploads' ))
			mkdir( './uploads' );*/
		$date=time();
	
		$target = "/var/www/local/iWrestled/app/webroot/img/matuploads/".$date.$_FILES[ 'file' ]['name'];
		$fileParts = $date.$_FILES[ 'file' ]['name'];
		$ext = pathinfo($fileParts, PATHINFO_EXTENSION);
		$fileTypes = array('jpg','jpeg','gif','png');
		if (in_array(strtolower($ext),$fileTypes)) {
		if( move_uploaded_file( $tmp_filepath, $target) ) 
				{					
					$uid=$_GET['id'];
					//$dates=date('y-m-d');
					//echo $random_id; 
					$sql="insert into mattempphotoimages (image,unique_img_id,user_id) values('$fileParts','$random_id',$uid)";
					//echo "insert into mattempphotoimages (image,unique_img_id,user_id) values('$fileParts','$random_id',$uid)";
					mysql_query($sql);
					$lastid=mysql_insert_id();					
					?>
					<input type="hidden" name="image_id" class="imgid" value="<?php echo $random_id;?>">
					<img id="del_<?php echo $lastid;?>" title="<?php echo $random_id;?>" style="width:80px;height:50px;" 					
					src="http://staging.softprodigy.in/iWrestled/app/webroot/img/matuploads/<?php echo $date.$_FILES[ 'file' ]['name'];?>">
					<span style="color: #FFFFFF;position: absolute;background:orange;border-radius:24px;">
					<a href="javascript:void(0)" onclick="setsVals(this.id)" id="<?php echo $lastid;?>">X</a></span>
					<?php
				}
		
			else  {
				echo "Status: ". display_error( $_FILES[ 'file' ]['error'] ) .  "<br />";
			     }
		}
	}

}
	

function display_error( $errno ) {

	switch( $errno ) {
		case UPLOAD_ERR_OK:
			$response = 'There is no error, the file uploaded with success.';
			break;
		case UPLOAD_ERR_INI_SIZE:
			$response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
			break;
		case UPLOAD_ERR_FORM_SIZE:
			$response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
			break;
		case UPLOAD_ERR_PARTIAL:
			$response = 'The uploaded file was only partially uploaded.';
			break;
		case UPLOAD_ERR_NO_FILE:
			$response = 'No file was uploaded.';
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
			break;
		case UPLOAD_ERR_EXTENSION:
			$response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
			break;
		default:
			$response = 'Unknown error';
			break;
	}
	return $response;
} 

?>
