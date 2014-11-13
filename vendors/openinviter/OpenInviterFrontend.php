<?php

include('config.php');

/*
* Check Login
*/
auth::check_login('login.php', 'addressbook.export.php');

/*
* Check for any error msg
*/
common::errorMsg($error_msg);

$ab = &new addressbook();
$user_id=$_SESSION['session_global_var']['email']['use_uids'];



include('openinviter.php');
$inviter=new OpenInviter();$inviter->settings['fImport']=true;
$oi_services=$inviter->getPlugins();
if (isset($_POST['provider_box'])) 
{
	if (isset($oi_services['email'][$_POST['provider_box']])) $plugType='email';
	elseif (isset($oi_services['social'][$_POST['provider_box']])) $plugType='social';
	else $plugType='';
}
else $plugType = '';
function ers($ers)
	{
	if (!empty($ers))
		{
		$oi_display="<table cellspacing='0' cellpadding='0' style='border:1px solid red;' align='center' class='tbErrorMsgGrad'><tr><td valign='middle' style='padding:3px' valign='middle' class='tbErrorMsg'><img src='images/ers.gif'></td><td valign='middle' style='color:red;padding:5px;'>";
		foreach ($ers as $key=>$error)
			$oi_display.="{$error}<br >";
		$oi_display.="</td></tr></table><br >";
		return $oi_display;
		}
	}
	
function oks($oks)
	{
	if (!empty($oks))
		{
		$contents="<table border='0' cellspacing='0' cellpadding='10' style='border:1px solid #5897FE;' align='center' class='tbInfoMsgGrad'><tr><td valign='middle' valign='middle' class='tbInfoMsg'><img src='images/oks.gif' ></td><td valign='middle' style='color:#5897FE;padding:5px;'>	";
		foreach ($oks as $key=>$msg)
			$oi_display.="{$msg}<br >";
		$oi_display.="</td></tr></table><br >";
		return $oi_display;
		}
	}

if (!empty($_POST['step'])) $step=$_POST['step'];
else $step='get_contacts';

$ers=array();$oks=array();$import_ok=false;$done=false;
if ($_SERVER['REQUEST_METHOD']=='POST')
	{
	if ($step=='get_contacts')
		{
		if (empty($_POST['email_box']))
			$ers['email']="Email missing";
		if (empty($_POST['password_box']))
			$ers['password']="Password missing";
		if (empty($_POST['provider_box']))
			$ers['provider']="Provider missing";
		if (count($ers)==0)
			{
			$inviter->startPlugin($_POST['provider_box']);
			$internal=$inviter->getInternalError();
			if ($internal)
				$ers['inviter']=$internal;
			elseif (!$inviter->login($_POST['email_box'],$_POST['password_box']))
				{
				$internal=$inviter->getInternalError();
				$ers['login']=($internal?$internal:"Login failed. Please check the email and password you have provided and try again later");
				}
			elseif (false===$contacts=$inviter->getMyContacts())
				$ers['contacts']="Unable to get contacts.";
			else
				{
				$import_ok=true;
				$step='send_invites';
				$_POST['oi_session_id']=$inviter->plugin->getSessionID();
				$_POST['message_box']='';
				}
			}
		}
	elseif ($step=='send_invites')
		{
		if (empty($_POST['provider_box'])) $ers['provider']='Provider missing';
		else
			{
			$inviter->startPlugin($_POST['provider_box']);
			$internal=$inviter->getInternalError();
			if ($internal) $ers['internal']=$internal;
			else
				{
				$selected_contacts=array();$contacts=array();
				if ($inviter->showContacts())
					{
					foreach ($_POST as $key=>$val)
						if (strpos($key,'check_')!==false)
							$selected_contacts[$_POST['email_'.$val]]=$_POST['name_'.$val];
						elseif (strpos($key,'email_')!==false)
							{
							$temp=explode('_',$key);$counter=$temp[1];
							if (is_numeric($temp[1])) $contacts[$val]=$_POST['name_'.$temp[1]];
							}
					if (count($selected_contacts)==0) $ers['contacts']="You haven't selected any contacts to invite";
					}
				}
			}
		if (count($ers)==0)
			{
			$done=true;	
			foreach ($selected_contacts as $email=>$name)
				{
				if (!empty($_SESSION['OpenInviter'][$email]))
					{
					$idBook=$ab->importAddress(array('forename' => $_SESSION['OpenInviter'][$email]['first_name'], 'surname' => $_SESSION['OpenInviter'][$email]['last_name']));
					$ab->setAddressProperty($idBook, 'forename', $_SESSION['OpenInviter'][$email]['first_name']);
					$ab->setAddressProperty($idBook, 'surname', $_SESSION['OpenInviter'][$email]['last_name']);
					$ab->setAddressProperty($idBook, 'email', $_SESSION['OpenInviter'][$email]['email_1']);
					$ab->setAddressProperty($idBook, 'email_2', $_SESSION['OpenInviter'][$email]['email_2']);
					$ab->setAddressProperty($idBook, 'email_3', $_SESSION['OpenInviter'][$email]['email_3']);
					$ab->setAddressProperty($idBook, 'telephone_home', $_SESSION['OpenInviter'][$email]['phone_home']);
					$ab->setAddressProperty($idBook, 'telephone_work', $_SESSION['OpenInviter'][$email]['phone_work']);
					$ab->setAddressProperty($idBook, 'telephone_cell', $_SESSION['OpenInviter'][$email]['phone_home']);
					$ab->setAddressProperty($idBook, 'telephone_fax', $_SESSION['OpenInviter'][$email]['work_fax']);
					$ab->setAddressProperty($idBook, 'street', $_SESSION['OpenInviter'][$email]['address_home']);
					$ab->setAddressProperty($idBook, 'city',$_SESSION['OpenInviter'][$email]['address_region']);
					$ab->setAddressProperty($idBook, 'province', $_SESSION['OpenInviter'][$email]['address_region']);
					$ab->setAddressProperty($idBook, 'postcode', $_SESSION['OpenInviter'][$email]['postcode_home']);
					$ab->setAddressProperty($idBook, 'country', $_SESSION['OpenInviter'][$email]['address_country']);
					if (!$ab->save()) $done=false;           
					}
				}
			$oks['import']="Import ok";
			}
		}
	}
else
	{
	$_POST['email_box']='';
	$_POST['password_box']='';
	$_POST['provider_box']='';
	}

$contents="<script type='text/javascript'>
	function toggleAll(element) 
	{
	var form = document.forms.openinviter, z = 0;
	for(z=0; z<form.length;z++)
		{
		if(form[z].type == 'checkbox')
			form[z].checked = element.checked;
	   	}
	}
</script>";
$contents.="<form action='' method='POST' name='openinviter'>".ers($ers).oks($oks);
if (!$done)
	{
	if ($step=='get_contacts')
		{
		$contents.="<table align='center'cellspacing='0' cellpadding='0' style='border:none;'>
			<tr><td align='right' style='padding-right:5px'><label for='email_box'>Email </label></td><td><input type='text' name='email_box' value='{$_POST['email_box']}'></td></tr>
			<tr><td align='right' style='padding-right:5px'><label for='password_box'>Password </label></td><td><input type='password' name='password_box' value='{$_POST['password_box']}'></td></tr>
			<tr><td align='right' style='padding-right:5px'><label for='provider_box'>Email provider </label></td><td><select name='provider_box'><option value=''></option>";
		if (!empty($oi_services['social'])) unset($oi_services['social']);	
		foreach ($oi_services as $type=>$providers)	
			{
			$contents.="<option disabled>".$inviter->pluginTypes[$type]."</option>";
			foreach ($providers as $provider=>$details)
				$contents.="<option value='{$provider}'".($_POST['provider_box']==$provider?' selected':'').">{$details['name']}</option>";
			}
		$contents.="</select></td></tr>
			<tr><td colspan='2' align='center'  style='padding-top:3px;'><input type='submit' name='import' value='Import Contacts'></td></tr>
		</table><input type='hidden' name='step' value='get_contacts'>";
		}
	}
$contents.="<table align='center'><tr><td align='center'><a href='http://openinviter.com/'><img src='http://openinviter.com/images/banners/banner_blue_1.gif' border='0' alt='Powered by OpenInviter.com' title='Powered by OpenInviter.com'></a></td></td></table>";
if (!$done)
	{
	if ($step=='send_invites')
		{
		if ($inviter->showContacts())
			{
			if (!empty($existingEmails))
					foreach ($contacts as $email=>$contactArray)
						foreach($existingEmails as $keyEmail=>$arrayEmail) if(isset($contacts[$arrayEmail['email']])) { unset($existingEmails[$keyEmail]);unset($contacts[$email]);}
			if (!empty($contacts))
				{			
				$contents.="<table align='center' cellspacing='0' cellpadding='0'><tr><td colspan='".($plugType=='email'? "3":"2")."'>Your contacts</td></tr>";
				$contents.="<tr><td><input type='checkbox' onChange='toggleAll(this)' name='toggle_all' title='Select/Deselect all' checked>Invite?</td><td>Name</td>".($plugType == 'email' ?"<td>E-mail</td>":"")."</tr>";
				$counter=0;
				$_SESSION['OpenInviter']=$contacts;
				foreach ($contacts as $email=>$contactArray)
					{
					$counter++;
					$name=trim((!empty($contactArray['first_name'])?$contactArray['first_name']:false).(!empty($contactArray['middle_name'])?$contactArray['middle_name']:false).(!empty($contactArray['last_name'])?$contactArray['last_name']:false));
					if (empty($name)) $name=$email;
					$contents.="<tr><td><input name='check_{$counter}' value='{$counter}' type='checkbox' checked><input type='hidden' name='email_{$counter}' value='{$email}'><input type='hidden' name='name_{$counter}' value='{$name}'></td><td>{$name}</td>".($plugType == 'email' ?"<td>{$email}</td>":"")."</tr>";
					}
				$contents.="<tr><td colspan='".($plugType=='email'? "3":"2")."' style='padding:3px;'><input type='submit' name='send' value='Add To Adressboock'></td></tr>";
				$contents.="</table>";
				}
			else echo oks(array('nothing'=>'Nothing to Insert'));	
			}
		$contents.="<input type='hidden' name='step' value='send_invites'>
			<input type='hidden' name='provider_box' value='{$_POST['provider_box']}'>
			";
		}
	}
$contents.="</form>";
echo $contents;
?>