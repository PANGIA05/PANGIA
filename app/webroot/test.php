<?php
//echo phpinfo();

/******************************************other mthod***********************************************/
//require_once("src/facebook.php");
/*$appid = '254320684771178';
$appsecret = 'cab1f05d709f6513c21ae9d343275255';
$pageId = '313719295445218';*/
 class Facebook
	{
	/**
	 * @var The page id to edit
	 */
	private $page_id = '100001682750709';
 
	/**
	 * @var the page access token given to the application above
	 */
	private $page_access_token = 'CAADbZCfiEzO8BAKBGD8rMc8zQd7vVdNaGXHboDDlYdkV9U5ZBF6Livt0PZBPsMwIGdcTUnqaRZAOZAqxMQViYcX5RbGZAL496ZCiCWj5CfnZCAZCiyo5PYxdOBXbWE5ZAZAJAoz9ZBi6Vq23wuLkQGFCV2LpDuf2VZBaQ8AY6lErq82J8ItG5eH6zf4BpgflueHHEHu8ZD';
 
	/**
	 * @var The back-end service for page's wall
	 */
	private $post_url = '';
 
	/**
	 * Constructor, sets the url's
	 */
	public function Facebook()
	{
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
 
$facebook = new Facebook();
 
$facebook->message(array( 'message'	 => 'testing g 22',
						  'link'		=> 'http://theurltopoint.to',
						  'picture'	 => 'http://thepicturetoinclude.jpg',
						  'name'		=> 'Name of the picture, shown just above it',
						  'description' => 'Full description explaining whether the header or the picture' ) );


/******************************other method************************************/
/*


require_once("src/facebook.php");
$config = array();
$config['appId'] = '254320684771178';
$config['secret'] = 'cab1f05d709f6513c21ae9d343275255';
$config['fileUpload'] = false; // optional
 
$fb = new Facebook($config);
 
// define your POST parameters (replace with your own values)
$params = array(
  "access_token" => "CAACEdEose0cBAL0ZBZAK9ZAjiQ9GgZAowOxPyknUufOxZBlaECWONbb1bkhY53l7hItCKOEmyK2P6imkLkrwQIZB1DyyUKhTn4CZBvdNkZC96W1TuHbluDBLpjNDvZA0rZAecu28XZBAA75hkVZCDH34c7uUTBTkwa9uJU53gZBerKIqMzxQ4ydRGLgDfFZBTQIZB7GbZCZBiMRIFCG64sQZDZD", // see: https://developers.facebook.com/docs/facebook-login/access-tokens/
  "message" => "Here is a blog post about auto posting on Facebook using PHP #php #facebook",
  "link" => "http://www.pontikis.net/blog/auto_post_on_facebook_with_php",
  "picture" => "http://i.imgur.com/lHkOsiH.png",
  "name" => "How to Auto Post on Facebook with PHP",
  "caption" => "www.pontikis.net",
  "description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
);
 
// post to Facebook
// see: https://developers.facebook.com/docs/reference/php/facebook-api/
try {
  $ret = $fb->api('/313719295445218/feed', 'POST', $params);
  echo 'Successfully posted to Facebook';
} catch(Exception $e) {
  echo $e->getMessage();
}*/
?>
