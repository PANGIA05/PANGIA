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



$uid=$_SESSION['User']['id'];
error_reporting(0);
define ("MAX_SIZE","9000"); 
function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}


$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
{
	

	//echo $dir = dirname(__file__);
    $uploaddir = MYPHOTO."/uploads/"; //a directory inside
		?>

	
	<?php 
	if(empty($_SESSION['id']))
		{
		$i=1;
		} else {

			$i=$_SESSION['id'];
			}

		

    foreach ($_FILES['photos']['name'] as $name => $value)
    {
	
        $filename = stripslashes($_FILES['photos']['name'][$name]);
        $size=filesize($_FILES['photos']['tmp_name'][$name]);
        //get the extension of the file in a lower case format
          $ext = getExtension($filename);
          $ext = strtolower($ext);
     	 
         if(in_array($ext,$valid_formats))
         {
	       if ($size < (MAX_SIZE*1024))
	       {
		   $image_name=time().$filename;
		    ?>
		  <?php /* <tr>
			<td style="width:100px;" ><?php 
					$count[] = $i;
					$image=$uploaddir.$image_name;
					sort($count, SORT_NATURAL | SORT_FLAG_CASE);
					sort($image, SORT_NATURAL | SORT_FLAG_CASE);
					echo end($count);
					?></td> */?>
							<div style="width:140px;float:left;"><?php echo "<img style='width:80px;height:60px;' src='".$image."' class='imgList'>";?></div>
	
					<?php /*<td style="width:100px;">Delete</td>
		   </tr>*/?>
			
		  <?php 
		  $newname=$uploaddir.$image_name;
           		//echo $newname;die;		
           if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) 
           {
	       $time=time();
		//$size=173039;
	       mysql_query("INSERT INTO galleries(uid,image_name,size) VALUES('$uid','$image_name','$size')");
	       }
	       else
	       {
		
	        echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
            }

	       }
		   else
		   {
			echo '<span class="imgList">You have exceeded the size limit!</span>';
          
	       }
       
          }
          else
         { 
	     	echo '<span class="imgList">Unknown extension!</span>';
           
	     }
      $i++;
	 $_SESSION['id']=$i;         
     }
 	
}

?>
