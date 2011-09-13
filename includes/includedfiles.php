<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2010-11-04
Purpose    :Including Classes
**************************************************************************************/
require_once	CONST_SITE_ABSOLUTE_PATH.'classes/defaults.php';
require_once	CONST_SITE_ABSOLUTE_PATH.'classes/adminUser.php';
require_once	CONST_SITE_ABSOLUTE_PATH.'classes/faq.php';
require_once	CONST_SITE_ABSOLUTE_PATH.'classes/masters.php';

//Default Value Settings
$defaultsObj	=	new defaults();
$defaultsObj->defineConstants();

?>