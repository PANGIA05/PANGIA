<?php
include_once("inc/facebook.php"); //include facebook SDK
 
######### edit details ##########
$appId = '245778598958597'; //Facebook App ID
$appSecret = '73ec2219d2c8da53504dfc4075cdcee2'; // Facebook App Secret
$return_url = 'http:google.com';  //return url (url to script)
$homeurl = 'http://staging.softprodigy.in/iWrestled/users/socialmat';  //return to home
$fbPermissions = 'publish_stream,manage_pages';  //Required facebook permissions
##################################

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));

$fbuser = $facebook->getUser();
?>
