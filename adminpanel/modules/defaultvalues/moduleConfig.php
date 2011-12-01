<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-09-26
Purpose    :Install CMS Module
**************************************************************************************/
require_once	(dirname(__FILE__)."/init.php");
/***************************Menu Starts*************************************************/

$menus[]	=	array(
				"menuName"		=>	"manageModuleDefaults",
				"menuTitle"		=>	"Manage Default Values",
				"menuEnable"	=>	true
				);

/***************************Menu Ends*************************************************/


/****************************************Pages Starts******************************************/
$pages[]	=	array(
				"menu" => "manageModuleDefaults",
				"page"=>"defaultValues.php",
				"title"=>"Default Values",
				"description"=>"Default Value management",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

$pages[]	=	array(
				"menu" => "manageModuleDefaults",
				"page"=>"masterDefaultGroup.php",
				"title"=>"Default Group",
				"description"=>"Default Group",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

/**********************************Pages ends****************************************************/


/***************************SQL Commands starts *************************************************/

$queries[constant("CONST_MODULE_DEFAULT_TABLE_DEFAULT")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_DEFAULT_TABLE_DEFAULT")."` (
`id` bigint(11) NOT NULL auto_increment,
`group_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_DEFAULT_TABLE_GROUP").".id',
`name` varchar(300) NOT NULL,
`value` longtext NOT NULL,
`caption` varchar(300) NOT NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='This is for content managing' AUTO_INCREMENT=1 ;";
				


$queries[constant("CONST_MODULE_DEFAULT_TABLE_GROUP")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_DEFAULT_TABLE_GROUP")."` (
`id` int(11) NOT NULL auto_increment,
`group` varchar(300) NOT NULL,
`preference` bigint(11) NOT NULL default '1',
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8  COMMENT='Master table- DEFAULT Section' AUTO_INCREMENT=1 ;";
/***************************SQL Commands ends*************************************************/
?>