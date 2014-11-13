
<?php
require_once('inc/header.php');
require_once('inc/twitteroauth.php');

global $sConsumerKey, $sConsumerSecret;

session_start();

$oTwitterOauth = new TwitterOAuth($sConsumerKey, $sConsumerSecret);
$aRequestToken = $oTwitterOauth->getRequestToken('http://staging.softprodigy.in/iWrestled/php/tw_oauth.php'); // getting authentication tokens


// saving token params into the session
$_SESSION['oauth_token'] = $aRequestToken['oauth_token'];
$_SESSION['oauth_token_secret'] = $aRequestToken['oauth_token_secret'];

if($oTwitterOauth->http_code==200) { // in case of success
    $sUrl = $oTwitterOauth->getAuthorizeURL($aRequestToken['oauth_token']); // generate authorization url
    header('Location: '. $sUrl); // redirecting
} else {
    die('Error happened due authorization');
}

?>
