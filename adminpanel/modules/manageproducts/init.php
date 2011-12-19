<?php
/**************************************************************************************
Created By 	:	Maria
Created On	:	17-12-2011
Purpose		:	Initial functions
****************************************************************************************/
require_once	(dirname(__FILE__)."/../../init.php");
$currentModulePath			=	moduleclass::getModulePath(__FILE__);
$currentModuleURL			=	moduleclass::getModuleURL(__FILE__,CONST_SITE_ABSOLUTE_PATH,CONST_SITE_ADDRESS);
$currentModuleFolderName	=	moduleclass::getModuleFolderName(__FILE__);

//tables
define("CONST_MODULE_CATEGORY_TABLE_CATEGORY",constant("CONST_DB_TABLE_PREFIX")."module_category");
define("CONST_MODULE_PRODUCT_TABLE_PRODUCT",constant("CONST_DB_TABLE_PREFIX")."module_product");

//file Includes
require_once $currentModulePath.'classes/categoryModule.php';
require_once $currentModulePath.'classes/productModule.php';

?>
