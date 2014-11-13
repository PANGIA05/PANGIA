<?php 
$string ='';
$string .= '<html xmlns="http://www.w3.org/1999/xhtml">
	<head></head>
<body>
<fieldset>
<legend>Registration message</legend>
<div  style="height:15px; width: 100%; float:left;">
	<div class="logo">
		<a href="'.LIVE_SITE.'">
			
		</a>
	</div>
</div>

<div  style="width: 100%; float:left;margin-top:15px;" id="Contents">';
$string .= '<table>
				<tr>
					<td>
						Hi <b>'.$userDetails['username'].'</b>,
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td><td>&nbsp;</td>
				</tr>';
$string .= '<tr>
				<td>WePay is a GoFundMe partner that helps you safely and easily access your money.</td>
				<td>&nbsp;</td>
			</tr>
			</table>';
$string .= '<tr>
				<td>In order to process gifts to your GoGundMe fundraiser, please confirm your email address with WePay.</td>
				<td>&nbsp;</td>
			</tr>
			</table>';


$string .= '<table>
				<tr><td>Please click below link and make your account on wepay</td></tr>
			</table>';
$string .= '<table>
				<tr>
					<td><a href="'.$userDetails['confirm_link'].'"></a></td>
					<td>&nbsp;</td>
				</tr>
				<tr><td>Thanks!</td><td>&nbsp;</td></tr>
			</table>
</div>
		<div  style="height:20px; background-color:#0082C5; width: 100%; float:left;"></div>
</div>
</fieldset>
</body>
</html>';
echo $string;
?>
