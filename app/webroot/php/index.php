<?php 
header('location:http://staging.softprodigy.in/iWrestled/users/profile');
/*
// set error reporting level
if (version_compare(phpversion(), "5.3.0", ">=") == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);

require_once('inc/header.php');

session_start();

echo '<link rel="stylesheet" href="templates/css/main.css" type="text/css" />';

// cross posting
if($_POST['post']) {
    $sPostingRes = "<h3><div class='success'>Your tweet not posted to Twitter (error happen)</div></h3>";

    $bPostRes = performTwitterPost($_POST['message']);

    if ($bPostRes) {
        $sPostingRes = "<h3><div class='success'>Your tweet has posted to Twitter</div></h3>";
    }
    echo $sPostingRes;
}
*/
/*
if ($_SESSION['oauth_username'] != '') {

    $aTmplWidgValues = array(
        '__twitter_name__' => $_SESSION['oauth_username']
    );
    $sFileWidgContent = file_get_contents('templates/twitter_widget.html');
    $aWidgKeys = array_keys($aTmplWidgValues);
    $aWidgValues = array_values($aTmplWidgValues);
    echo str_replace($aWidgKeys, $aWidgValues, $sFileWidgContent); // draw widget

    $aTmplFormValues = array(
        '__twitter_name__' => $_SESSION['oauth_username']
    );
    $aFormKeys = array_keys($aTmplFormValues);
    $sFileFormContent = file_get_contents('templates/twitter_post.html');
    $aFormValues = array_values($aTmplFormValues);
    echo str_replace($aFormKeys, $aFormValues, $sFileFormContent); // draw posting form

} else {
    require_once('templates/twitter_login.html'); // draw login
} 

echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
die('okoko');

*/
/*
$sMessage='hello softprodigy how are you.';
require_once('inc/header.php');

global $sDbName, $sDbUserName, $sDbUserPass;
    $vLink = mysql_connect('localhost', $sDbUserName, $sDbUserPass);
    mysql_select_db($sDbName);
$getid=$_SESSION['id'];
$getinsertdata=mysql_query("select * from atwitter_oauth_users where uid=14");

while($aRequestToken=mysql_fetch_array($getinsertdata))
	{
	
	$_SESSION['oauth_token']= $aRequestToken['oauth_token'];
	$_SESSION['oauth_secret']= $aRequestToken['oauth_secret'];
	}

 


    global $sConsumerKey, $sConsumerSecret;

    require_once('inc/twitteroauth.php');
    $oTweet = new TwitterOAuth($sConsumerKey, $sConsumerSecret, $_SESSION['oauth_token'], $_SESSION['oauth_secret']);
    $oTweet->post('statuses/update', array('status' => $sMessage));
    return true;


?>  
<?php  /*
<?php $var= "hi friends this is my first post on twitter and am happy with this post";?>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>   
<a href="javascript:return false;" rel="nofollow" onclick="window.open('https://twitter.com/share?text=<?php echo $var;?>', 'Twitter', 'toolbar=0,status=0,width=626,height=436')">Twitter</a> */?>
<?php

    /* echo "hello";

    require_once 'oauth/twitteroauth.php';

     

    $message = $_POST['feed']; #actual message to twitter

     

    define("CONSUMER_KEY", "618kS4H4j1mMZOxomZL6g");

    define("CONSUMER_SECRET", "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");

    define("OAUTH_TOKEN", "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");

    define("OAUTH_SECRET", "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");

     

    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_SECRET);

  

    $content = $connection->post('statuses/update', array('status' => $message));

    var_dump($content);



     

    $connection->post('statuses/update', array('status' => $message));
*/
    ?>



