<?php
/**************************************************************************************
Created by :Maria
Created on :2011-09-26
Purpose    :Manage Category Section
**************************************************************************************/
require_once	(dirname(__FILE__)."/init.php");
/***************************Menu Starts*************************************************/

$menus[]	=	array(
				"menuName"		=>	"manageModuleCategory",
				"menuTitle"		=>	"Manage Products ",
				"menuEnable"	=>	true
				);

/***************************Menu Ends*************************************************/


/****************************************Pages Starts******************************************/
$pages[]	=	array(
				"menu" => "manageModuleCategory",
				"page"=>"categories.php",
				"title"=>"Category",
				"description"=>"Category management",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);
$pages[]	=	array(
				"menu" => "manageModuleCategory",
				"page"=>"products.php",
				"title"=>"Product",
				"description"=>"Product",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);


/**********************************Pages ends****************************************************/


/***************************SQL Commands starts *************************************************/

$queries[constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")."` (
`id` bigint(11) NOT NULL auto_increment,
`parent_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_CATEGORY_TABLE_GROUP").".id',
`category` varchar(300) NOT NULL,
`description` longtext NOT NULL,
`image` varchar(300) NOT NULL,
`date_added` datetime NOT NULL,
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This is for content managing' AUTO_INCREMENT=1 ;";

$queries[constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT")."` (
`id` bigint(11) NOT NULL auto_increment,
`category_id` bigint(11) NOT NULL,
`brand_id` bigint(11) NOT NULL ,
`product` varchar(300) NOT NULL,
`model_no` varchar(300) NOT NULL,
`price`  bigint(11) NOT NULL,
`image` varchar(300) NOT NULL,
`date_added` datetime NOT NULL,
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This is for content managing' AUTO_INCREMENT=1 ;";

/***************************SQL Commands ends*************************************************/
?>
