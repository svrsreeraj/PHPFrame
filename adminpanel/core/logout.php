<?php
/**************************************************************************************
Page name	:	logout.php
Author		:	Sreeraj
Date		:	08-02-2009
Description	:	This is  for logging out
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
session_destroy();err_status("sessions destroyed");
session_start();
$_SESSION['sess_message'] =  "You have successfully signed out";
header("location:index.php");exit;
?>
