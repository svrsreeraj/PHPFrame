<?php

$contents	="<script type='text/javascript'>$(document).ready(function(){
		$('#checkall').change(function(){
			$('.email').attr('checked', this.checked);
		});
		
		$('#selectedmail').click(function(){
			var arrReq		=	jQuery('#area input:checked').map(function(){ return jQuery(this).val();}).get().join(',');
			$.unblockUI();
			var data	=	$('#textarea').val();
			$('#textarea').val(arrReq);
			return false;</script>
	});
	
	});
		";
echo $contents;
include('openinviter.php');
$inviter=new OpenInviter();	
$oi_services=$inviter->getPlugins();	



//geta all error messages
function oks($oks)						
	{
	if (!empty($oks))
		{
			foreach ($oks as $key=>$msg)
			$contents.="{$msg}<br >";
			return $contents;
		}
	}

if (!empty($_POST['step']))	
 $step			=			$_POST['step'];					
 else $step		=			'get_contacts';	

 
 
$ers=array();									
$oks=array();							
$import_ok=false;						
$done=false;	


//function to login and get all the adress detials
if ($_SERVER['REQUEST_METHOD']=='POST')			// if there s a submit
	{
		if ($step=='get_contacts')
			{
				if (empty($_POST['email_box']))
				$ers['email']="Email missing !";
				if (empty($_POST['password_box']))
				$ers['password']="Password missing !";
				if (empty($_POST['provider_box']))
				$ers['provider']="Provider missing !";
				
				if (count($ers)==0)
					{
						
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
								$import_ok=true;
								$step='send_invites';
								$_POST['oi_session_id']=$inviter->plugin->getSessionID();
								$_POST['message_box']='';
							}

						
					}
			}
	
	//function to take all the data and send email to all
	
	elseif ($step=='send_invites')
		{
				if (empty($_POST['provider_box'])) $ers['provider']='Provider missing !';
				else
				{
					$inviter->startPlugin($_POST['provider_box']);
					$internal=$inviter->getInternalError();	
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
	}
else
	{
		$_POST['email_box']='';
		$_POST['password_box']='';
		$_POST['provider_box']='';
	}






	