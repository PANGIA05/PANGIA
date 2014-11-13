<?php

require 'twitteroauth.php';
require 'twconfig.php';
require 'function.php';
session_name("CAKEPHP");
session_start();

/*echo "session is <br>";
print_r($_SESSION);
echo "<hr>";
echo print_r($_GET);
echo "<hr>";
*/
if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
    /*echo '<pre>';
    print_r($user_info);
    echo '</pre><br/>';
	echo "<hr>";*/
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: http://staging.softprodigy.in/iWrestled/users/register');
    } else {
        $uid = $user_info->id;
        $username = $user_info->name;
        $user = new User();
        $userdata = $user->checkUser($uid, 'twitter', $username);
//print_r($userdata);die('okaoka');
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
	    $_SESSION['oauth_id'] = $uid;
            $_SESSION['username'] = $userdata['username'];
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
	    header('Location: http://staging.softprodigy.in/iWrestled/users/profile');
           // header('Location: http://google.com');
        } else {
		   header('Location: http://staging.softprodigy.in/iWrestled/users/register');
		}
    }
} else {
    // Something's missing, go back to square 1
    header('Location: http://staging.softprodigy.in/iWrestled/users/register');
}
?>
