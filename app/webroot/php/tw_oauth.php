<?php
require_once('inc/header.php');
require_once('inc/twitteroauth.php');

global $sConsumerKey, $sConsumerSecret;

$uid=$_SESSION['User']['id'];



if (! empty($_GET['oauth_verifier']) && ! empty($_SESSION['oauth_token']) && ! empty($_SESSION['oauth_token_secret'])) {
} else { // some params missed, back to login page
    header('Location: http://staging.softprodigy.in/iWrestled/users/profile');
}

$oTwitterOauth = new TwitterOAuth($sConsumerKey, $sConsumerSecret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

$aAccessToken = $oTwitterOauth->getAccessToken($_GET['oauth_verifier']); // get access tokens

$_SESSION['access_token'] = $aAccessToken; // saving access token to sessions

$oUserInfo = $oTwitterOauth->get('account/verify_credentials'); // get account details

if(isset($oUserInfo->error)){
    header('Location: http://staging.softprodigy.in/iWrestled/users/profile'); // in case of any errors - back to login page
} else {

    //global $sDbName, $sDbUserName, $sDbUserPass;
   // $vLink = mysql_connect('localhost', $sDbUserName, $sDbUserPass);
   // mysql_select_db($sDbName);

    $vOAuth1 = mysql_query("SELECT * FROM `atwitter_oauth_users` WHERE `oauth_provider` = 'twitter' AND uid='$uid'"); // searching for user in database
    $aOauthUserInfo = mysql_fetch_array($vOAuth1);

    if (empty($aOauthUserInfo)) { // if user info not present - add them into database

        mysql_query("INSERT INTO `atwitter_oauth_users` (`uid`,`oauth_provider`, `oauth_uid`, `username`, `oauth_token`, `oauth_secret`) VALUES ('{$uid}','twitter', {$oUserInfo->id}, '{$oUserInfo->screen_name}', '{$aAccessToken['oauth_token']}', '{$aAccessToken['oauth_token_secret']}')");


	$_SESSION['id']=mysql_insert_id();

        $vOAuth2 = mysql_query("SELECT * FROM `atwitter_oauth_users` WHERE `id` = '" . mysql_insert_id() . "'");
        $aOauthUserInfo = mysql_fetch_array($vOAuth2);
    } else {


        mysql_query("UPDATE `atwitter_oauth_users` SET `oauth_token` = '{$aAccessToken['oauth_token']}', `oauth_secret` = '{$aAccessToken['oauth_token_secret']}' WHERE `oauth_provider` = 'twitter' AND `uid` = '{$uid}'"); // update tokens
   
   }

    $_SESSION['oauth_id'] = $aOauthUserInfo['id'];
    $_SESSION['oauth_username'] = $aOauthUserInfo['username'];
    $_SESSION['oauth_uid'] = $aOauthUserInfo['oauth_uid'];
    $_SESSION['oauth_provider'] = $aOauthUserInfo['oauth_provider'];
    $_SESSION['oauth_token'] = $aOauthUserInfo['oauth_token'];
    $_SESSION['oauth_secret'] = $aOauthUserInfo['oauth_secret'];

    mysql_close($vLink);

    header('Location: http://staging.softprodigy.in/iWrestled/users/profile');
}

if(!empty($_SESSION['oauth_username'])){
    header('Location: http://staging.softprodigy.in/iWrestled/users/profile'); // already logged, back to our main page
}
?>
