<?php
/****************************************************************************************
Created by 		:Sreeraj
Created on 		:2010-11-10
Purpose			:Header area
****************************************************************************************/
if(!$_SESSION["reu_dev_sess"])
	{
		header("location:index.php");
		exit;		
	}
define("CONST_DEVELOPER_URL",constant("CONST_SITE_ADDRESS")."developer/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo _HEAD_TITLE;?></title>
<link href="<?php echo constant("CONST_DEVELOPER_URL")?>style.css" rel="stylesheet" type="text/css" />
<link rel="SHORTCUT ICON" href="<?php echo constant("CONST_SITE_ADDRESS")?>/images/favicon.ico">
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_SITE_ADDRESS")?>js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_SITE_ADDRESS")?>js/jquery_facebook.alert.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_SITE_ADDRESS")?>js/tooltip.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo constant("CONST_SITE_ADDRESS")?>js/jquery.tooltip/tooltip.jquery.js"></script>

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="84" align="right" valign="middle" bgcolor="#8ADEF8" style="background-position:left top; padding-right:15px;"><table width="45%" border="0" cellspacing="5" cellpadding="0">
            <tr>
              <td align="right" valign="middle"><table width="20%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="middle">
				
					
					</td>
                    <td align="center" valign="middle">
					
					</td>
					
				  </tr>
              </table></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><b>Developer Area</b>
              <?php 
              if($_SESSION["reu_dev_safe_mode"]	==	true)	echo "(Safe Mode)";
              ?> 
              <a title="Click here to logout" class="letnav" href="<?php echo constant("CONST_DEVELOPER_URL")?>logout.php">Logout</a>
              </td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top" bgcolor="#0FA1DA"><img src="<?php echo constant("CONST_DEVELOPER_URL")?>images/space.jpg" width="3" height="5" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" align="left" valign="top" 
	style="background-image:url(<?php echo constant("CONST_DEVELOPER_URL")?>images/inner_11.gif); background-position:left top; background-repeat:repeat-y; padding-top:20px;">
		
		
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="20%" align="left" valign="top"  style="background-image:url(<?php echo constant("CONST_DEVELOPER_URL")?>images/inner_11.gif);
			 background-position:left top; background-repeat:repeat-y; padding-top:2px;">
			
			
			<div class="LeftMmenuList" id="idLeftMenu">
				<div class="LeftMenuHead LeftMenuHeadCurrent">Manage Website</div>
				<div class="leftMenuBody">
					<a href = "developerHome.php"  class="letnav">Developer Home</a>
					<a href = "config.php"  class="letnav">Basic Config</a>
					<a href="logout.php" class="letnav ">Logout</a>
				</div>
			</div>
			<script type="text/javascript">
							$("#idLeftMenu div.LeftMenuHead").click(function()
							{
								$(this).next("div.leftMenuBody").slideDown(200).siblings("div.leftMenuBody").slideUp("slow");
							});
							$("#idLeftMenu div.LeftMenuHeadCurrent").next("div.leftMenuBody").show();
	
			</script>
			</td>
			</tr>   
          
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table></td>
        <td class="contentArea">