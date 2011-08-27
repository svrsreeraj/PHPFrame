<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$ers		=	array();									
$oks		=	array();							
$import_ok	=	false;						
$done		=	false;
	
require_once('openinviter.php');		//include		
$inviter=new OpenInviter();				//create object
$oi_services=$inviter->getPlugins();	//get all plugin

if (isset($_POST['provider_box'])) 		//if there is a provider like gmail	 
	{
		if (isset($oi_services['email'][$_POST['provider_box']])) $plugType='email';			//decide the plugin according to provider
		elseif (isset($oi_services['social'][$_POST['provider_box']])) $plugType='social';
		else $plugType='';
	}
else $plugType = '';			//if non provide no plugin

if (!empty($_POST['step']))
	{
		$step			=			$_POST['step'];					
		$step();
	}
else
	{
		$step					=			"ready";	
		$_POST['email_box']		=			"";
		$_POST['password']		=			"";
		$_POST['provider']		=			"";
	}	
function signIn()
	{
		if (empty($_POST['email_box']))
		$ers['email']="Email missing !";
		if (empty($_POST['password_box']))
		$ers['password']="Password missing !";
		if (empty($_POST['provider_box']))
		$ers['provider']="Provider missing !";
	
		if (count($ers)==0)
			{
				$inviter=new OpenInviter();
				$inviter->startPlugin($_POST['provider_box']);		//start the plugin for tha provider
				$internal=$inviter->getInternalError();
				if ($internal)	$ers['inviter']=$internal;
				// if no errors try to login
				elseif (!$inviter->login($_POST['email_box'],$_POST['password_box']))
				{
					$internal=$inviter->getInternalError();
					$ers['login']=($internal?$internal:"Login failed. Please check the email and password you have provided and try again later !");
				}
				//ry to get addresss
				elseif (false===$contacts=$inviter->getMyContacts())
				$ers['contacts']="Unable to get contacts !";
				
				// if all the above are corect then go for SEND MAIL
				else
					{
						print_r($contacts);
						$import_ok=true;
						$step='send_invites';
						$_POST['oi_session_id']=$inviter->plugin->getSessionID();
						$_POST['message_box']='';
						sendMail();
					
					}

				
			}
		else printErors($ers);
						
	}	
 function sendMail()
	{
		
		if (empty($_POST['provider_box'])) $ers['provider']='Provider missing !';
		else
		{
			$inviter->startPlugin($_POST['provider_box']);
			$internal=$inviter->getInternalError();	
			print_r($internal);
			
			if ($internal) $ers['internal']=$internal;
			else
				{	
					if (empty($_POST['email_box'])) $ers['inviter']='Inviter information missing !';
					if (empty($_POST['oi_session_id'])) $ers['session_id']='No active session !';
					if (empty($_POST['message_box'])) $ers['message_body']='Message missing !';
					else $_POST['message_box']=strip_tags($_POST['message_box']);
				
			
			
					$selected_contacts=array();	//get the contacts into this array
					$contacts=array();
					
					$message=array('subject'=>$inviter->settings['message_subject'],'body'=>$inviter->settings['message_body'],'attachment'=>"\n\rAttached message: \n\r".$_POST['message_box']);
					
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
							if (count($selected_contacts)==0) $ers['contacts']="You haven't selected any contacts to invite !";
						}
					print_r($contacts);
					die();		
				}
		}
			
		if (count($ers)==0)
		{
				//SEND MESSEGES
				$sendMessage=$inviter->sendMessage($_POST['oi_session_id'],$message,$selected_contacts);
				$inviter->logout();
				if ($sendMessage===-1)
					{
						$message_footer="\r\n\r\n This mai was send via voteondeals.com.";
						$message_subject=$_POST['email_box'].$message['subject'];
						$message_body=$message['body'].$message['attachment'].$message_footer; 
						$headers="From: {$_POST['email_box']}";
						foreach ($selected_contacts as $email=>$name)
							{
								mail($email,$message_subject,$message_body,$headers);
								$oks['mails']="Mails sent successfully to".$_POST['email_box'];
							}
					}
				elseif ($sendMessage===false)
					{
						$internal=$inviter->getInternalError();
						$ers['internal']=($internal?$internal:"There were errors while sending your invites.<br>Please try again later!");
					}
				else $oks['internal']="Invites sent successfully!";
				$done=true;	
		}

	}

function printErors($error)
	{
		print_r($error);
	}

	
function oks($oks)						
	{
	
	}

if($step=="ready")
		{
					
			$contents		=	"<form action='' method='POST'><br/>
								Email<br/><input class='thTextbox' type='text' name='email_box' value='{$_POST['email_box']}'><br/>
								Password<br/><input class='thTextbox' type='password' name='password_box' value='{$_POST['password_box']}'><br/>
								<br/><select class='thSelect' name='provider_box'><option value=''></option>";
									
								foreach ($oi_services as $type=>$providers)	
										{
											$contents.="<optgroup label='{$inviter->pluginTypes[$type]}'>";
											foreach ($providers as $provider=>$details)
											$contents.="<option value='{$provider}'".($_POST['provider_box']==$provider?' selected':'').">{$details['name']}</option>";
											$contents.="</optgroup>";
										}
								$contents.="</select></td></tr>
												<tr class='thTableImportantRow'><td colspan='2' align='center'><input class='thButton' type='submit' name='import' value='Import Contacts'></td></tr>
												</table><input type='hidden' name='step' value='signIn'></form>";
			echo  $contents;
			
			
		}
		
	
?>

