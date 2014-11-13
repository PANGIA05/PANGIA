<?php 
session_name("CAKEPHP");
session_start();
//include('inc/header.php');
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


$sConsumerKey    = 'Xndv00ECCXBsrRqmtZIM4nWLV';
$sConsumerSecret = '2Opxyimjq5b1kxsHDOzDpV88yqBMizAtvffSqZhKAwa41EwyPm';


//print_r($_POST); 
//print_r($_SESSION);
	$iffacebook=$_POST['fbshareid'];
	$iftwitter=$_POST['twshareid'];
	$postext=$_POST['postext'];
	//die('okaoka');
	//print_r($_POST);
	
	//print_r($_POST); die('opkoka');
	/************************************   Start Post share on facebook **********************************/
	
	
	class Facebook
			{
			/**
			 * @var The page id to edit
			 */
			 
			private $page_id =0;

			/**
			 * @var the page access token given to the application above
			 */
			private $page_access_token = '';

			/**
			 * @var The back-end service for page's wall
			 */
			private $post_url = '';

			/**
			 * Constructor, sets the url's
			 */
			public function Facebook()
			{
				
				$uid=$_SESSION['User']['id'];
				$getrss=mysql_query("select * from fbaccesstokens where uid='$uid'");
				$row=mysql_fetch_array($getrss);
				//print_r($row);
				$myid =$row['fbid'];
				$this->page_id = $myid;
				$this->page_access_token = $row['accesstoken'];
				
				$this->post_url = 'https://graph.facebook.com/'.$this->page_id.'/feed';
				
				
			}

			/**
			 * Manages the POST message to post an update on a page wall
			 *
			 * @param array $data
			 * @return string the back-end response
			 * @private
			 */
			public function message($data)
			{
				// need token
				$data['access_token'] = $this->page_access_token;

				// init
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, $this->post_url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				// execute and close
				$return = curl_exec($ch);
				curl_close($ch);

				// end
				return $return;
			}
			}
			
			
		if(!empty($iffacebook))
				{
	
			$facebook = new Facebook();

			$facebook->message(array( 'message'	 => $postext,
								  'link'		=> 'http://staging.softprodigy.in/iWrestled/users/socialmat',
								  'picture'	 => 'http://staging.softprodigy.in/iWrestled/images/iwrestle-logo.png',
								  'name'		=> 'iWrestle Social Mat Share Post',
								  'description' => 'Social Mat Post' ) );
								  
								  
				}					  
								  
	
	/************************************   End Post share on facebook **********************************/
	
	
		
	$uid=$_SESSION['User']['id'];
	$image_id=$_POST['image_id'];
	$statustext=$_POST['statustext'];
	if(empty($statustext))
		{
			$statustext='null';
		}
	$tubeurl=$_POST['tubeurl'];
		if(empty($tubeurl))
		{
			$tubeurl='null';
		}
		
	   

	$sql="insert into posts (uid,text,photo_id,activity_text,share_video) values('$uid','$postext','$image_id','$statustext','$tubeurl')";
	//echo "insert into posts (uid,text,photo_id,activity_text,share_video) values('$uid','$postext','$image_id','$statustext','$tubeurl')";
	$result=mysql_query($sql);
	if($result)
		{


		/***********************************   Start Post Share on Twitter **********************************/
	
		if(!empty($iftwitter))
		{
			$getinsertdata=mysql_query("select * from atwitter_oauth_users where uid=$uid");

				while($aRequestToken=mysql_fetch_array($getinsertdata))
					{	
					$_SESSION['oauth_token']= $aRequestToken['oauth_token'];
					$_SESSION['oauth_secret']= $aRequestToken['oauth_secret'];
					}


    				global $sConsumerKey, $sConsumerSecret;

   			 require_once('inc/twitteroauth.php');
   			 $oTweet = new TwitterOAuth($sConsumerKey, $sConsumerSecret, $_SESSION['oauth_token'],
			 $_SESSION['oauth_secret']);
   			 $oTweet->post('statuses/update', array('status' => $postext));
    			return true;

			}	
	
			/***********************************   End  Post Share on Twitter **********************************/
		
			echo "0";
			
		} else {

			echo "00";
			}

?>
