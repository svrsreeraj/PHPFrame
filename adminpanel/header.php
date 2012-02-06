<?php
/****************************************************************************************
Created by 		:Sreeraj
Created on 		:2010-11-10
Purpose			:Header area
****************************************************************************************/
$objCls     		= new coreAdminUser();
if(!$objCls->check_session())
	{
		$_SESSION['sess_message'] 			=	"To access this page, you have to login";
		$_SESSION['adminLoginRedirectLink']	=	substr(constant("CONST_HOST_ADDRESS"),0,strlen(constant("CONST_HOST_ADDRESS"))-1).$_SERVER["REQUEST_URI"];
		$objCls->getPageError("To access this page, you have to login"); 
		header("location:".constant("CONST_SITE_ADMIN_CORE_ADDRESS")."index.php");
		exit;
	}	
$userObj	=	new coreAdminUser();
$userSess 	=	end($userObj->get_user_data());	
$sql		=	"id=".$userSess[usertype];
$usertype	=	$userObj->getAllUsertypes($sql)	;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo _HEAD_TITLE;?></title>
<link href="<?php echo constant("CONST_SITE_ADMIN_ADDRESS");?>style.css" rel="stylesheet" type="text/css" />
<link rel="SHORTCUT ICON" href="<?php echo constant("CONST_SITE_ADMIN_ADDRESS");?>images/favicon.ico">
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_SITE_ADMIN_ADDRESS");?>js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_SITE_ADMIN_ADDRESS");?>js/jquery_facebook.alert.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_SITE_ADMIN_ADDRESS");?>js/tooltip.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_SITE_ADMIN_ADDRESS");?>js/jquery.tooltip/tooltip.jquery.js"></script>



</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right" valign="middle" class="header">
        	<div class="logo"><h1><a href="#">Site Name</a></h1></div>
        	<table width="45%" border="0" cellspacing="5" cellpadding="0">
            <tr>
              <td align="right" valign="middle">
              	<table width="20%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="middle">
					<?php if(!$objCls->check_session()) 
					{
						echo '<a href="#" class="letnav">Login</a>';
					}
					?>
					</td>
                    <td align="center" valign="middle">
					<?php if($objCls->check_session()) 
						{
								echo "<td>";
								echo "<tr>Welcome <b>".$userSess[fname]." ".$userSess[lname]." (".$usertype[0]['typename'].") </b></tr>";
								echo '<tr><a href="'.constant("CONST_SITE_ADMIN_CORE_ADDRESS").'adminHome.php" class="letnav" title="Click here to logout">Home</a>&nbsp;<a href="'.constant("CONST_SITE_ADMIN_CORE_ADDRESS").'logout.php" class="letnav" title="Click here to logout">Logout</a></tr>';
								echo "</td>";
						}
					?>
					</td>
				  </tr>
              	</table>
              </td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="head">Administrative Area </td>
            </tr>
        </table>
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="wrapper-main">
      <tr>
        <td width="200" align="left" valign="top" class="left-aside">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="20%" align="left" valign="top">
			
			
			<?php echo $objCls->get_leftmenu(); ?>
			</td>
			</tr>   
        </table></td>
        <td class="contentArea">

