<?php
/****************************************************************************************
Created by 		:Sreeraj
Created on 		:2010-11-10
Purpose			:Header area
****************************************************************************************/
$objCls     		= new adminUser();
if(!$objCls->check_session())
	{
		$_SESSION['sess_message'] 				=	"To access this page, you have to login";
		$_SESSION['adminLoginRedirectLink']	=	ROOT_CURRENT_URL;
		$objCls->getPageError("To access this page, you have to login"); 
		header("location:index.php");
		exit;
	}	
$userObj	=	new adminUser();
$userSess 	=	end($userObj->get_user_data());	
$sql		=	"id=".$userSess[usertype];
$usertype	=	$userObj->getAllUsertypes($sql)	;
define("CONST_ADMIN_URL",constant("CONST_SITE_ADDRESS")."adminpanel/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo _HEAD_TITLE;?></title>
<link href="<?php echo constant("CONST_ADMIN_URL");?>style.css" rel="stylesheet" type="text/css" />
<link rel="SHORTCUT ICON" href="<?php echo constant("CONST_ADMIN_URL");?>images/favicon.ico">
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_ADMIN_URL");?>js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_ADMIN_URL");?>js/jquery_facebook.alert.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_ADMIN_URL");?>js/tooltip.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_ADMIN_URL");?>js/jquery.tooltip/tooltip.jquery.js"></script>

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="84" align="right" valign="middle" bgcolor="#FFFFFF" style="background-image:url(<?php echo constant("CONST_ADMIN_URL");?>images/admin_03.jpg); background-position:left top; background-repeat:no-repeat; padding-right:15px;"><table width="45%" border="0" cellspacing="5" cellpadding="0">
            <tr>
              <td align="right" valign="middle"><table width="20%" border="0" cellspacing="0" cellpadding="0">
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
								echo '<tr><a href="adminHome.php" class="letnav" title="Click here to logout">Home</a>&nbsp;<a href="logout.php" class="letnav" title="Click here to logout">Logout</a></tr>';
								echo "</td>";
						}
					?>
					</td>
					
				  </tr>
              </table></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="head">Administrative Area </td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top" bgcolor="#0FA1DA"><img src="<?php echo constant("CONST_ADMIN_URL");?>images/space.jpg" width="3" height="5" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" align="left" valign="top" 
	style="background-image:url(<?php echo constant("CONST_ADMIN_URL");?>images/inner_11.gif); background-position:left top; background-repeat:repeat-y; padding-top:20px;">
		
		
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="20%" align="left" valign="top"  style="background-image:url(<?php echo constant("CONST_ADMIN_URL");?>images/inner_11.gif);
			 background-position:left top; background-repeat:repeat-y; padding-top:2px;">
			
			
			<?php echo $objCls->get_leftmenu(); ?>
			</td>
			</tr>   
          
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table></td>
        <td class="contentArea">
