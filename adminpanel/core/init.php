<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	10-10-2011
Purpose		:	Initial functions
****************************************************************************************/
require_once	(dirname(__FILE__)."/../init.php");
require_once	(CONST_SITE_ABSOLUTE_PATH.'adminpanel/core/conf/coreConfig.php');

$currentModulePath			=	moduleclass::getModulePath(__FILE__);
$currentModuleURL			=	moduleclass::getModuleURL(__FILE__,CONST_SITE_ABSOLUTE_PATH,CONST_SITE_ADDRESS);
$currentModuleFolderName	=	moduleclass::getModuleFolderName(__FILE__);

//file Includes
require_once $currentModulePath.'classes/coreAdminUser.php';

//constants
if(!defined("GLB_PAGE_CNT"))	define("GLB_PAGE_CNT",25);
?>
