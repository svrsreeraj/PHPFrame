<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2012-07-18
Purpose    :This file will be executed in each call
**************************************************************************************/

require_once	(dirname(__FILE__)."/../init.php");

//tables - admin permission & users
define("CONST_ADMIN_CORE_TABLE_ADMIN_ACTIONS",constant("CONST_DB_TABLE_PREFIX")."core_admin_actions");
define("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS",constant("CONST_DB_TABLE_PREFIX")."core_admin_menus");
define("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES",constant("CONST_DB_TABLE_PREFIX")."core_admin_pages");
define("CONST_ADMIN_CORE_TABLE_ADMIN_PAGE_ACTIONS",constant("CONST_DB_TABLE_PREFIX")."core_admin_page_actions");
define("CONST_ADMIN_CORE_TABLE_ADMIN_PERMISSION",constant("CONST_DB_TABLE_PREFIX")."core_admin_permission");
define("CONST_ADMIN_CORE_TABLE_ADMIN_USERS",constant("CONST_DB_TABLE_PREFIX")."core_admin_users");
define("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE",constant("CONST_DB_TABLE_PREFIX")."core_admin_usertype");
define("CONST_ADMIN_CORE_TABLE_DB_RULES",constant("CONST_DB_TABLE_PREFIX")."core_admin_db_rules");
define("CONST_ADMIN_CORE_TABLE_DB_MANDATORY",constant("CONST_DB_TABLE_PREFIX")."core_admin_db_mandatory");


//creating dbRules Data
$dBaseRules			=	array();
global $dBaseRules;
$coreAdminUserObj	=	new coreAdminUser();
$dbRulesModel		=	$coreAdminUserObj->getAllDbRules();
foreach($dbRulesModel	as	$key=>$val)
	{
		$dBaseRules["{$val['table_name']}"]["{$val['field_name']}"][]	=	array("{$val['method_name']}","{$val['min_length']}","{$val['max_length']}","{$val['message']}");
	}


//creating dbMandatory fields
$dBaseMandatory			=	array();
global $dBaseMandatory;
$coreAdminUserObj	=	new coreAdminUser();
$dbMandModel		=	$coreAdminUserObj->getAllDbMandatoryRows();
foreach($dbMandModel	as	$key=>$val)
	{
		$dBaseMandatory["{$val['table_name']}"]["{$val['field_name']}"][]	=	array("{$val['min_length']}","{$val['max_length']}","{$val['message']}");
	}
?>
