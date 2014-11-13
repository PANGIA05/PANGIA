 <?php

/*
	@! Facebook comments system
	@@ Using PHP, jQuery, and AJAX
*/

session_name("CAKEPHP");
session_start();
//echo "<pre>"; print_r($_SESSION['token']);  die;
//echo "<pre>"; print_r($_SESSION); die;
//include('/var/www/html/genshare/app/webroot/php/functions.php');
 include('../../config/database.php');
 include('../../config/settings.php');
include(WEBROOT.'/app/webroot/php/functions.php');
$DBobj        = new DATABASE_CONFIG();
//echo $DBobj->default['host'];
define ('DB_SERVER',$DBobj->default['host']);
define ('DB_USERNAME',$DBobj->default['login']);
define ('DB_PASSWORD',$DBobj->default['password']);
define ('DB_DATABASE',$DBobj->default['database']);
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());



error_reporting(0);
$ids=$_POST['mydelid'];
	
$del = '';
foreach($ids as $kay=>$id)	
	{
		$del = $del.$id.',';
	}
		$deleteid= substr($del,0,-1);
		$deleteid =str_replace("ok,","",$deleteid);
$dels="delete from galleries where id IN ($deleteid)";
$result=mysql_query($dels);
if($result)
	{
	echo "0";
	} else
		{
		echo "1";
		}
?>
