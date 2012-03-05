<?php
/**************************************************************************************
Created by :Maria
Created on :2011-09-26
Purpose    :Install Banner Module
**************************************************************************************/
require_once	(dirname(__FILE__)."/init.php");
/***************************Menu Starts*************************************************/

$menus[]	=	array(
				"menuName"		=>	"manageModuleCampaign",
				"menuTitle"		=>	"Manage Campaign ",
				"menuEnable"	=>	true
				);

/***************************Menu Ends*************************************************/


/****************************************Pages Starts******************************************/
$pages[]	=	array(
				"menu" => "manageModuleCampaign",
				"page"=>"addCampaignAdds.php",
				"title"=>"Campaign Ads",
				"description"=>"Campaign Ads",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

$pages[]	=	array(
				"menu" => "manageModuleCampaign",
				"page"=>"addCampaign.php",
				"title"=>"Campaign",
				"description"=>"Campaign management",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

$pages[]	=	array(
				"menu" => "manageModuleCampaign",
				"page"=>"masterCampaignGroups.php",
				"title"=>"Campaign Group",
				"description"=>"Campaign Group",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);



/**********************************Pages ends****************************************************/


/***************************SQL Commands starts *************************************************/
$queries[constant("CONST_MODULE_CAMPAIGN_ADS")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_CAMPAIGN_ADS")."` (
`id` bigint(11) NOT NULL auto_increment,
`campaign_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_CAMPAIGN_TABLE").".id',
`ads_type` int(11) NOT NULL,
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
`status` tinyint(4) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='This is for content managing' AUTO_INCREMENT=1 ;";



$queries[constant("CONST_MODULE_CAMPAIGN_TABLE")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_CAMPAIGN_TABLE")."` (
`id` bigint(11) NOT NULL auto_increment,
`category_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_CAMPAIGN_TABLE_GROUP").".id',
`name` varchar(300) NOT NULL,
`description` longtext NOT NULL,
`start_date` datetime NOT NULL,
`end_date` datetime NOT NULL,
`target_users` varchar(300) NOT NULL,
`target_zip` varchar(300) NOT NULL,
`target_latitude` varchar(300) NOT NULL,
`target_longitude` varchar(300) NOT NULL,
`target_distance` varchar(300) NOT NULL,
`date_added` datetime NOT NULL,
`date_updated` datetime NOT NULL,
`status` tinyint(4) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='This is for content managing' AUTO_INCREMENT=1 ;";

$queries[constant("CONST_MODULE_CAMPAIGN_TABLE_GROUP")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_CAMPAIGN_TABLE_GROUP")."` (
`id` int(11) NOT NULL auto_increment,
`category` varchar(300) NOT NULL,
`preference` bigint(11) NOT NULL default '1',
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8  COMMENT='Master table- DEFAULT Section' AUTO_INCREMENT=1 ;";
/***************************SQL Commands ends*************************************************/
?>
