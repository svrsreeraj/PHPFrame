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
define("CONST_MODULE_MASTER_TABLE",constant("CONST_DB_TABLE_PREFIX")."module_ms_table");
define("CONST_MODULE_MASTER_TABLE_SECTION",constant("CONST_DB_TABLE_PREFIX")."module_ms_table_section");


//file Includes
require_once $currentModulePath.'classes/mastertableModule.php';
?>
