<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-09-26
Purpose    :Install CMS Module
**************************************************************************************/
require_once	(dirname(__FILE__)."/init.php");
/***************************Menu Starts*************************************************/

$menus[]	=	array(
				"menuName"		=>	"manageModuleCMS",
				"menuTitle"		=>	"Manage CMS",
				"menuEnable"	=>	true
				);

/***************************Menu Ends*************************************************/


/****************************************Pages Starts******************************************/
$pages[]	=	array(
				"menu" => "manageModuleCMS",
				"page"=>"contentManagement.php",
				"title"=>"CMS",
				"description"=>"Content management",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

$pages[]	=	array(
				"menu" => "manageModuleCMS",
				"page"=>"masterCmsSections.php",
				"title"=>"CMS Category",
				"description"=>"Content management Category",
				"actions"=>array("View","Add","Edit","Delete","Status"),
				"menuView"=>true);

/**********************************Pages ends****************************************************/


/***************************SQL Commands starts *************************************************/

$queries[constant("CONST_MODULE_ADMIN_PERMS_TABLE_ACTIONS")]	=	"

CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_ADMIN_PERMS_TABLE_ACTIONS")."` (
  `id` bigint(11) NOT NULL auto_increment,
  `action` varchar(300) NOT NULL,
  `preference` bigint(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Admin functionalities' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `php_admin_actions`
--

INSERT INTO `php_admin_actions` (`id`, `action`, `preference`, `status`) VALUES
(1, 'Add', 1, 1),
(2, 'Edit', 2, 1),
(3, 'View', 3, 1),
(4, 'Status', 4, 1),
(5, 'Delete', 5, 1),
(6, 'Reply', 6, 1);
";
				


$queries[constant("CONST_MODULE_CMS_TABLE_SECTION")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_CMS_TABLE_SECTION")."` (
`id` int(11) NOT NULL auto_increment,
`cms_category` varchar(300) NOT NULL,
`preference` bigint(11) NOT NULL default '1',
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8  COMMENT='Master table- CMS Section' AUTO_INCREMENT=1 ;";
/***************************SQL Commands ends*************************************************/
?>
