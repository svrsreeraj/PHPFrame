<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-11-10
Purpose    :Core Queries
**************************************************************************************/

require	(dirname(__FILE__)."/../init.php");

//tables - admin permission & users
define("CONST_ADMIN_CORE_TABLE_ADMIN_ACTIONS",constant("CONST_DB_TABLE_PREFIX")."admin_actions");
define("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS",constant("CONST_DB_TABLE_PREFIX")."admin_menus");
define("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES",constant("CONST_DB_TABLE_PREFIX")."admin_pages");
define("CONST_ADMIN_CORE_TABLE_ADMIN_PAGE_ACTIONS",constant("CONST_DB_TABLE_PREFIX")."admin_page_actions");
define("CONST_ADMIN_CORE_TABLE_ADMIN_PERMISSION",constant("CONST_DB_TABLE_PREFIX")."admin_permission");
define("CONST_ADMIN_CORE_TABLE_ADMIN_USERS",constant("CONST_DB_TABLE_PREFIX")."admin_users");
define("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE",constant("CONST_DB_TABLE_PREFIX")."admin_usertype");


/***************************SQL Commands starts TABLE Structure*************************************************/
$queries["tables"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_ACTIONS")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_ACTIONS")."` (
`id` bigint(11) NOT NULL auto_increment,
`action` varchar(300) NOT NULL,
`preference` bigint(11) NOT NULL,
`status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin functionalities';";

$queries["tables"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS")."` (
  `id` bigint(11) NOT NULL auto_increment,
  `menuname` varchar(225) default NULL,
  `menutitle` varchar(255) default NULL,
  `menable` tinyint(1) NOT NULL default '1',
  `status` tinyint(1) NOT NULL default '1',
  `preference` bigint(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='listing of leftmenu headings';";

$queries["tables"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES")."` (
  `id` bigint(11) NOT NULL auto_increment,
  `menuid` bigint(11) NOT NULL COMMENT 'refrence ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS")."',
  `module` varchar(300) NOT NULL COMMENT 'module name if any',
  `page` varchar(250) NOT NULL,
  `pagetitle` varchar(225) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `penable` tinyint(1) NOT NULL default '0',
  `preference` bigint(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='listng of submenus under leftmenu headings';";

$queries["tables"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGE_ACTIONS")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGE_ACTIONS")."` (
  `id` bigint(11) NOT NULL auto_increment,
  `pageid` bigint(11) NOT NULL COMMENT 'refers  ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES").".id',
  `actionid` bigint(11) NOT NULL COMMENT 'refers  ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_ACTIONS").".id',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin permission pages actions';";

$queries["tables"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_PERMISSION")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PERMISSION")."` (
  `id` bigint(11) NOT NULL auto_increment,
  `usertypeid` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE").".id',
  `pactionid` bigint(11) NOT NULL COMMENT 'refers  ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGE_ACTIONS").".id',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin permission pages';";

$queries["tables"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS")."` (
  `id` bigint(11) NOT NULL auto_increment,
  `usertype` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE").".id',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(300) NOT NULL,
  `lname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `mobile` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `preference` bigint(11) NOT NULL,
  `ip` varchar(225) NOT NULL,
  `date_added` datetime NOT NULL,
  `status` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='Admin side users';";


$queries["tables"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE")]	=	"
CREATE TABLE IF NOT EXISTS `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE")."` (
  `id` bigint(11) NOT NULL auto_increment,
  `typename` varchar(255) NOT NULL,
  `preference` bigint(11) NOT NULL default '1',
  `status` tinyint(1) NOT NULL default '1' COMMENT '1=active,0=inactive',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin side user types';";


/***************************SQL Commands ends*************************************************/

/***************************SQL Commands starts Insertng data*************************************************/
$queries["insert"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_ACTIONS")]	=	"
INSERT INTO `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_ACTIONS")."` (`id`, `action`, `preference`, `status`) VALUES
(1, 'Add', 1, 1),
(2, 'Edit', 2, 1),
(3, 'View', 3, 1),
(4, 'Status', 4, 1),
(5, 'Delete', 5, 1),
(6, 'Reply', 6, 1);";

$queries["insert"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS")]	=	"
INSERT INTO `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS")."` (`id`, `menuname`, `menutitle`, `menable`, `status`, `preference`) VALUES
(2, 'permission', 'Manage Permission', 1, 1, 2),
(3, 'admin', 'Manage Admin', 1, 1, 3);";

$queries["insert"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES")]	=	"
INSERT INTO `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES")."` (`id`, `menuid`, `module`, `page`, `pagetitle`, `description`, `status`, `penable`, `preference`) VALUES
(4, 2, 'core', 'menuSettings.php', 'Menu Settings', 'Menu Settings', 1, 1, 5),
(5, 2, 'core', 'pageSettings.php', 'Page Settings', 'Page Settings corresponding to each menu', 1, 1, 6),
(6, 2, 'core', 'adminPermission.php', 'Set Permission', 'Set Permission', 1, 1, 4),
(7, 3, 'core', 'masterAdminUserType.php', 'User Types', 'User Types', 1, 1, 7),
(8, 3, 'core', 'adminUsers.php', 'Admin Users', 'Admin Users', 1, 1, 8),
(18, 3, 'core', 'adminHome.php', 'Admin Home', 'Admin Home', 1, 0, 17),
(24, 2, 'core', 'masterPageActions.php', 'Page Actions', 'Page Actions', 1, 1, 23),
(37, 3, 'core', 'changePassword.php', 'Change Password', 'Change Password', 1, 1, 38);
";

$queries["insert"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGE_ACTIONS")]	=	"
INSERT INTO `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGE_ACTIONS")."` (`id`, `pageid`, `actionid`) VALUES
(14, 4, 1),(15, 4, 2),(16, 4, 3),(17, 4, 4),(18, 5, 1),(19, 5, 2),(20, 5, 3),
(21, 5, 4),(22, 6, 1),(23, 6, 2),(24, 6, 3),(25, 7, 1),(26, 7, 2),(27, 7, 3),
(28, 7, 4),(29, 8, 1),(30, 8, 2),(31, 8, 3),(32, 8, 4),(74, 18, 3),(97, 24, 1),
(98, 24, 2),(99, 24, 3),(100, 24, 4),(147, 37, 2),(148, 37, 3);";

$queries["insert"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_PERMISSION")]	=	"
INSERT INTO `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PERMISSION")."` (`usertypeid`, `pactionid`) VALUES
(1, 148),(1, 147),(1, 74),(1, 32),(1, 31),(1, 30),(1, 29),(1, 28),(1, 27),
(1, 26),(1, 25),(1, 100),(1, 99),(1, 98),(1, 97),(1, 21),(1, 20),(1, 19),
(1, 18),(1, 17),(1, 16),(1, 15),(1, 14),(1, 24),(1, 23),(1, 22);";

$queries["insert"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS")]	=	"
INSERT INTO `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS")."` (`id`, `usertype`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `address`, `preference`, `ip`, `date_added`, `status`) VALUES
(1, 1, 'admin', 'admin', 'Admin', '', 'admin@mysite.com', '', '', 1, '', '', 1);
";

$queries["insert"][constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE")]	=	"
INSERT INTO `".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE")."` (`id`, `typename`, `preference`, `status`) VALUES
(1, 'Administrator', 1, 1);";

/***************************SQL Commands ends*************************************************/
?>
