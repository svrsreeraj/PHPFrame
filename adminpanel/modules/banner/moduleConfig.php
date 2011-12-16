<?php
/**************************************************************************************
Created by :Maria
Created on :2011-09-26
Purpose    :Install Banner Module
**************************************************************************************/
require_once	(dirname(__FILE__)."/init.php");
/***************************Menu Starts*************************************************/

$menus[]	=	array(
				"menuName"		=>	"manageModuleBanner",
				"menuTitle"		=>	"Manage Banner ",
				"menuEnable"	=>	true
				);

/***************************Menu Ends*************************************************/


/****************************************Pages Starts******************************************/
$pages[]	=	array(
				"menu" => "manageModuleBanner",
				"page"=>"addBannerAdds.php",
				"title"=>"Banner",
				"description"=>"Banner management",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

$pages[]	=	array(
				"menu" => "manageModuleBanner",
				"page"=>"masterBannerGroups.php",
				"title"=>"Banner Group",
				"description"=>"Banner Group",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

/**********************************Pages ends****************************************************/


/***************************SQL Commands starts *************************************************/

$queries[constant("CONST_MODULE_BANNER_TABLE_BANNER")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_BANNER_TABLE_BANNER")."` (
`id` bigint(11) NOT NULL auto_increment,
`category_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_BANNER_TABLE_GROUP").".id',
`types` int(11) NOT NULL,
`name` varchar(300) NOT NULL,
`image` varchar(300) NOT NULL,
`link` varchar(300) NOT NULL,
`code` longtext NOT NULL,
`smarty_code` longtext NOT NULL,
`height` bigint(11) NOT NULL,
`width` bigint(11) NOT NULL,
`impression` bigint(11) NOT NULL,
`clicks` bigint(11) NOT NULL,
`ip` varchar(300) NOT NULL,
`date_added` datetime NOT NULL,
`status` tinyint(4) NOT NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='This is for content managing' AUTO_INCREMENT=1 ;";

$queries[constant("CONST_MODULE_BANNER_TABLE_GROUP")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_BANNER_TABLE_GROUP")."` (
`id` int(11) NOT NULL auto_increment,
`category` varchar(300) NOT NULL,
`preference` bigint(11) NOT NULL default '1',
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8  COMMENT='Master table- DEFAULT Section' AUTO_INCREMENT=1 ;";
/***************************SQL Commands ends*************************************************/
?>