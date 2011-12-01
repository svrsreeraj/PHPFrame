<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	25-10-2010
Purpose		:	Initial functions
****************************************************************************************/
require_once	(dirname(__FILE__)."/../../init.php");
$currentModulePath			=	moduleclass::getModulePath(__FILE__);
$currentModuleURL			=	moduleclass::getModuleURL(__FILE__,CONST_SITE_ABSOLUTE_PATH,CONST_SITE_ADDRESS);
$currentModuleFolderName	=	moduleclass::getModuleFolderName(__FILE__);

//tables
define("CONST_MODULE_DEFAULT_TABLE_DEFAULT",constant("CONST_DB_TABLE_PREFIX")."module_defaults");
define("CONST_MODULE_DEFAULT_TABLE_GROUP",constant("CONST_DB_TABLE_PREFIX")."module_defaults_group");


//file Includes
require_once $currentModulePath.'classes/defaultModule.php';
?>
