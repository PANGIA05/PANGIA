<?php

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
 

Hi there, I just joined this amazing platform that allows you to post your consulting services for 
businesses to see or search for consultants for your business, for free! You can help me get a large 
discount on a fantastic upgrade package by following this link and becoming a member with me.
(hyperlink to registration on “link”) */

?>
<?php $string = '';
$string .= '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

<body>
<div  style="height:15px; background-color:#0082C5; width: 100%; float:left;"></div>
		<div  style="width: 100%; float:left;" id="Contents">';

$string ='Hi there, I just joined this amazing platform that allows you to post your consulting services for businesses to see or search for consultants for your business, for free! You can help me get a large discount on a fantastic upgrade package by following this <a href="'.LIVE_SITE.'/users/register">link</a> and becoming a member with me.';

$string .= '

</div>
		<div  style="height:20px; background-color:#0082C5; width: 100%; float:left;"></div>
	</div>
</body>
</html>';
echo $string;
?>
		 
		
