<?php

$root = explode('/',$_SERVER['REQUEST_URI']);
$rootPath = $root[1];
define("HTTP_HOST","http://".$_SERVER['HTTP_HOST']."/");
define('HOME_PAGE',"http://".$_SERVER['HTTP_HOST']."/$rootPath/");

$documentroot	= $_SERVER['DOCUMENT_ROOT'];
 
 $webrootpath=$documentroot.''.$rootPath;
 
 
define("LIVE_SITE",'http://'.$_SERVER['HTTP_HOST']."/$rootPath");
define("WEBROOT","$webrootpath");
define("PROFILE_IMAGE_URL",LIVE_SITE.'/img/');
define("PROFILE_IMAGE_WEBROOT",WEBROOT.'/img/');
define("PROFILE_UPLOAD_URL",WEBROOT.'/app/webroot/img/');

define("IMAGE_URL",LIVE_SITE.'/app/webroot/img/');
//define("UPLOAD_URL",LIVE_SITE.'app/webroot/uploadcsv/');
define("MEMBER_FILE_UPLOAD_URL",WEBROOT.'app/webroot/memberfiles/');
define("FILE_UPLOAD_URL",WEBROOT.'app/webroot/img/upload_userImages/');
define("USER_IMAGE",'/var/www/html/PANGIA/app/webroot/img/upload_userImages/');
define("WALL_POST_MESSAGE",'Invitation on GoFundMe application');
define("WALL_POST_NAME",'GoFundMe');
define("WALL_POST_CAPTION",'GoFundMe');
define("WALL_POST_DESCRIPTION",'Test Description on GoFundMe');
define("WALL_POST_PROMT_MESSAGE",'Test Promt message on GoFundMe');
define('EMAIL_REPLY','consult@GoFundMe.is'); 
define('CLIENT_Email','ashwanik.softprodigy@gmail.com');
define("FB_APP_ID",'589547944486426');
define("FB_APP_SECRET",'dc8628eee0ceb189da831adbe1656399');

define('SOCIALMAT_REC_PER_PAGE','4');
define("LOADMORECOUNT","9");
define("CLIENTID","103580");
define("CLIENTSECRET","a14ba07f98");
define("accesstoken","STAGE_2278b624608b1b6c0f0f383ff71c18b4c9b40d938cceadae5b152ae5f071eed5");

?>
