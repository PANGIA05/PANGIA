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
$string = "Hi $username,<br/><br/>";
$string .= $new_user.' has registered on site. Visit site to Connect with him/her.';
$string .= '</b>';
$string .= '<br/><br/>Thanks!

</div>
		<div  style="height:20px; background-color:#0082C5; width: 100%; float:left;"></div>
	</div>
</body>
</html>';
echo $string;
?>