<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$ers		=	array();									
$oks		=	array();							
$import_ok	=	false;						
$done		=	false;
require_once('openinviter.php');		
$inviter	=	new OpenInviter();				
$oi_services=$inviter->getPlugins();	

if($_POST['step']!="")
	{
		$step					=			$_POST['step'];	
		if($step=="ready")
			ready();
		if($step=="signIn")
			signIn();
	}


function signIn()
	{
		$sender							=	array();
		if (empty($_POST['email_box']))	$ers['email']="Email missing !";
		else	$sender['emaiid']		=	$_POST['email_box'];
		if (empty($_POST['password_box']))$ers['password']="Password missing !";
		if (empty($_POST['provider_box']))$ers['provider']="Provider missing !";
		else	$sender['provider']	=	$_POST['email_box'];
		if (count($ers)==0)
			{
				$inviter			=		new OpenInviter();
				$inviter->startPlugin($_POST['provider_box']);		//start the plugin for tha provider
				$internal=$inviter->getInternalError();
				if ($internal)	$ers['inviter']=$internal;
				elseif (!$inviter->login($_POST['email_box'],$_POST['password_box']))
					{
						$internal		=		$inviter->getInternalError();
						$ers['login']	=	($internal?$internal:"Login failed. Please check the email and password you have provided and try again later !");
					}
				elseif (false===$contacts=$inviter->getMyContacts())
				$ers['contacts']	=	"Unable to get contacts !";
				else
					{
						$import_ok	=	true;
						$step='send_invites';
						$_POST['oi_session_id']=$inviter->plugin->getSessionID();
						getMailList($contacts,$sender);
					}
			}
		
	}	
	
 function getMailList($contacts,$sender)
	{
		$content		.=	"<script type='text/javascript'>
								$(document).ready(function(){
									$('#checkall').change(function(){
										$('.email').attr('checked', this.checked);
										});
									$('#selectedmail').click(function(){
										$.unblockUI();
										var arrReq		=	$('#area input:checked').map(function(){ return jQuery(this).val();}).get().join(',');
										var data	=	$('#textarea').val();
										$('#textarea').val(arrReq);
										return false;
										});
		
									})</script>";
		$content		.=		"<div id='selection' style='text-align:left;width:100; height:200; float:left;'><input type='checkbox' id='checkall' />Check all<br/></div>";
		$content		.=		"<div id='area' style= 'align:left;width:300px;height:150px	;overflow:scroll;'>";
		$content		.=		"<form  id='maillist'>";
		$content		.=		"<input type='button' id='selectedmail' value='send mail'>";
		$content		.=		"<p>Please select </p> <br/>";
		
		foreach($contacts as $email=>$name)
			$content	.=		"<input type='checkbox' class='email' name='email[]' value='$email'/> $name<br/>";
			
		$content		.=		"<input type='hidden' name='action' value='getallmail'><br/>";
		$content		.=		"<input type='hidden' name='senderemail' value='{$sender['emaiid']}' ><br/>";
		$content		.=		"<input type='hidden' name='provider' value='{$sender['provider']}' ><br/>";
		$content		.=		"<input type='hidden' name='step' value='sendmail' ><br/></form>";
		$content		.=		"</div>";

		
		
		echo ($content);	
	}

	
function sendMail()
	{
		if (empty($_POST['senderemail'])) $ers['inviter']			=		'Inviter information missing !';
		if (empty($_POST['provider'])) $ers['session_id']			=		'No active session !';
		if (empty($_POST['email'])) $ers['message_body']			=		'You didnot select any contacts!';
		if (empty($_POST['message_box'])) $ers['message_body']		=		'Message missing !';
		else $_POST['message_box']									=		strip_tags($_POST['message_box']);
		
		
	}

function ready()
		{	
			
			$inviter		=	new OpenInviter();				
			$oi_services	=	$inviter->getPlugins();
			//$contents		.=	"<style='text/css' src='../../style.css'></style>";
			$contents		.=	"<div id='pop_up' style=' display:none;'>
			
			<div class='top'>
				<h2>Invite Friends</h2>
				<div class='close'><a href='#'><img src='../../images/close.png' alt='Vote on deal' title='Vote on deal' id='closePopup'/></a></div>
			</div>
			<form action='' method='POST'>
			<div id='detail'>
				<table id='table' >
					  <tr>
						<td width='150' >Email</td>
						<td><input  id='email_box' type='text' name='email_box' class='tfl_small' ></td>
					  </tr>
					  <tr>
						<td width='150' >Password</td>
						<td><input  id='password_box' type='password' name='password_box' class='tfl_small'   ></td>	
					  </tr>
					  <tr>
						<td width='150' >Provider</td>";
						$contents		.=	"<td><select class='tfl_small' id='optgroup' name='provider_box'><option value=''>Select</option>";
								foreach ($oi_services as $type=>$providers)	
								{
									$contents.="<optgroup  label='{$inviter->pluginTypes[$type]}'>";
									foreach ($providers as $provider=>$details)
									$contents.="<option value='{$provider}'".($_POST['provider_box']==$provider?' selected':'').">{$details['name']}</option>";
									$contents.="</optgroup>";
								}
					$contents	.=	"</select></td>";
					$contents		.="</tr>
					 
					  <tr>
						<td><input type='button' id='cancelbtn' value='Cancel' class='bu_common'/></td>
						<td><input id='thButton'  type='button' name='import' value='Import Contacts' class='bu_common'  ></td>
					  </tr>
				</table>
			</div>
			</form>
			
			<div class='bottom'><img src='.../../images/pop_btm_bg.png' alt='Vote on deal' title='Vote on deal' /></div>
													
		</div>";
			
			echo $contents;
			die()	;				
			
		}
		
	
?>

