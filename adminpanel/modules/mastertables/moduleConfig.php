<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-09-26
Purpose    :Install CMS Module
**************************************************************************************/
require_once	(dirname(__FILE__)."/init.php");
/***************************Menu Starts*************************************************/

$menus[]	=	array(
				"menuName"		=>	"manageModuleMasterTables",
				"menuTitle"		=>	"Master Tables",
				"menuEnable"	=>	true
				);

/***************************Menu Ends*************************************************/


/****************************************Pages Starts******************************************/
$pages[]	=	array(
				"menu" => "manageModuleMasterTables",
				"page"=>"masterTables.php",
				"title"=>"Master Tables",
				"description"=>"Master Table management",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

$pages[]	=	array(
				"menu" => "manageModuleMasterTables",
				"page"=>"masterTableSections.php",
				"title"=>"Master Table Category",
				"description"=>"Master Table Category",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

/**********************************Pages ends****************************************************/


/***************************SQL Commands starts *************************************************/

$queries[constant("CONST_MODULE_MASTER_TABLE")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_MASTER_TABLE")."` (
`id` bigint(11) NOT NULL auto_increment,
`section_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_MASTER_TABLE_SECTION").".id',
`name` varchar(500) NOT NULL,
`parent_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_MASTER_TABLE").".id',
`parent_section_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_MASTER_TABLE").".section_id',
`preference` bigint(11) NOT NULL default '1',
`date_added` datetime NOT NULL,
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive,1=active',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='This is for master table values managing' AUTO_INCREMENT=1 ;";
				


$queries[constant("CONST_MODULE_MASTER_TABLE_SECTION")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_MASTER_TABLE_SECTION")."` (
`id` int(11) NOT NULL auto_increment,
`ms_table_section` varchar(300) NOT NULL,
`parent_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_MASTER_TABLE").".id',
`preference` bigint(11) NOT NULL default '1',
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8  COMMENT='Master table- Section' AUTO_INCREMENT=1 ;";
/***************************SQL Commands ends*************************************************/
?>