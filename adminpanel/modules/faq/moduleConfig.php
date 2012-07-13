<?php
/**************************************************************************************
Created by : Maria
Created on : 2011-12-12
Purpose    : Install FAQ Module
**************************************************************************************/
require_once	(dirname(__FILE__)."/init.php");
/***************************Menu Starts*************************************************/

$menus[]	=	array(
				"menuName"		=>	"manageModuleFAQ",
				"menuTitle"		=>	"Manage FAQ",
				"menuEnable"	=>	true
				);

/***************************Menu Ends*************************************************/


/****************************************Pages Starts******************************************/
$pages[]	=	array(
				"menu" => "manageModuleFAQ",
				"page"=>"faq.php",
				"title"=>"FAQ",
				"description"=>"Ferquently Asking Questions ",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

$pages[]	=	array(
				"menu" => "manageModuleFAQ",
				"page"=>"masterFaqGroup.php",
				"title"=>"FAQ Category",
				"description"=>"Ferquently Asking Questions Category",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

/**********************************Pages ends****************************************************/


/***************************SQL Commands starts *************************************************/

$queries[constant("CONST_MODULE_FAQ_TABLE_FAQ")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_FAQ_TABLE_FAQ")."` (
`id` bigint(11) NOT NULL auto_increment,
`group_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_FAQ_TABLE_SECTION").".id',
`question` varchar(500) NOT NULL,
`answer` longtext NOT NULL,
`ip` varchar(500) NOT NULL,
`date_added` datetime NOT NULL,
`preference` bigint(11) NOT NULL,
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive,1=active',
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This is for content managing' AUTO_INCREMENT=1 ;";
				


$queries[constant("CONST_MODULE_FAQ_TABLE_SECTION")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_FAQ_TABLE_SECTION")."` (
`id` int(11) NOT NULL auto_increment,
`group` varchar(300) NOT NULL,
`preference` bigint(11) NOT NULL default '1',
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='Master table- FAQ Section' AUTO_INCREMENT=1 ;";
/***************************SQL Commands ends*************************************************/
?>
