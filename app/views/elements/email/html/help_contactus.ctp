<?php //pr($helpDetails);die('here');

/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 
Hi (new users name here), we just wanted to thank you for joining the Cukie team. Your membership gives you access to a wide range of consultants and businesses to choose from that best suits your needs, among many other great features. We would also like to take this time to remind you that you can refer other business professionals such as yourself and in return get discounts on your future upgrade purchases. Click here to learn more. (hyperlink to referral  box on “here”)


*/
?>
<?php $string = '';
$string .= '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

<body>
<div  style="height:15px; background-color:#0082C5; width: 100%; float:left;"></div>
		<div  style="width: 100%; float:left;" id="Contents">';
$string = 'Hi, My name is <b>'.$helpDetails['name'].'</b>'.' '.' i need help regarding:<br/><br/><br/>   ';
$string .= '<b>Meaasge: </b>'.$helpDetails['message'].' <br/>';
$string .= '

</div>
		<div  style="height:20px; background-color:#0082C5; width: 100%; float:left;"></div>
	</div>
</body>
</html>';
echo $string;
?>
		 
		