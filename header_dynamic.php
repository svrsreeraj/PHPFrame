<?php
/****************************************************************************************
Created by 		:Anith M S
Created on 		:2010-12-20
Purpose			:Header area
****************************************************************************************/
$objCls     	= new customer();
if(!$objCls->check_session())
	{
		$_SESSION['sess_message'] = "To access this page, you have to login";
		$objCls->getPageError("To access this page, you have to login");
		$_SESSION['clientLoginRedirectLink']	=	ROOT_CURRENT_URL;
		header("location:".ROOT_HTTP_URL."login/");
		exit;
	}
require_once 'header.php';err_status("header.php included"); 

?>