<?php
/****************************************************************************************
Created by 		:Sreeraj
Created on 		:2010-12-20
Purpose			:Header area
****************************************************************************************/
$objCls = new customer();
global	$cls_site;

$userSess 	=	end($objCls->get_user_data());
if(function_exists("curl_init"))
	{
		require_once 'libs/facebook/src/facebook.php';
		$facebook 	= new Facebook(array( 'appId'  => GLB_FACEBOOK_APPID, 'secret' => GLB_FACEBOOK_SECRET, 'cookie' => true));
		$F_session 	= $facebook->getSession();
		if($F_session)
			{
				$jsdata	=	json_encode($F_session);
				if(!$userSess)
					{
						if($cls_site->getPageName()	!=	"signIn.php")
							{
								header("location:".ROOT_HTTP_URL."login/");
								exit;			
							}
					}
			}
		$jsdata	=	json_encode($F_session);
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" language="javascript" src="<?php echo ROOT_URL;?>js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ROOT_URL;?>js/jquery_facebook.alert.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ROOT_URL;?>js/jquery.tooltip/tooltip.jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ROOT_URL;?>js/config.js"></script>

<link rel="SHORTCUT ICON" href="<?php echo ROOT_URL;?>images/favicon.ico">
<link href="<?php echo ROOT_URL;?>style.css" rel="stylesheet" type="text/css" />
<title><?php echo GLB_CUSTOMER_HEADER_TITLE;?> <?php echo _HEAD_TITLE;?></title>

</head>
<body>
<div id="bd_outer">
  <div id="main">
   
   