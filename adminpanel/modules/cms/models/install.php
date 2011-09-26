<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-09-26
Purpose    :Install CMS Module
**************************************************************************************/
class installModel extends modelclass
	{
		public $quries		=	array();
		public $dbEngine	=	"MyISAM";
		public $charSet		=	"utf8";
		public function Listing()
			{
				$this->Install();
			}
		public function Install()
			{
				global $currentModulePath,$currentModuleFolderName;
				$moduleClass	=	new moduleclass();
				$moduleClass->installModule(array(
				"pages"=>$this->GetPages(),
				"queries"=>$this->GetQueries(),
				"menu"=>$this->getMenu(),
				"modulePath" => $currentModulePath,
				"moduleFolder" => $currentModuleFolderName,
				));
				print_r($moduleClass->errorArray);
			}
		public function getMenu()
			{
				return $this->returnVal(array("menuName"=>"manageModuleCMS","menuTitle"=>"Manage CMS","menuEnable"=>true));	
			}
		public function GetPages()
			{
				$pages[]	=	array("page"=>"contentManagement.php","actions"=>array("View","Add","Edit","Delete","Status"),"menuView"=>true);
				$pages[]	=	array("page"=>"masterCmsSections.php","actions"=>array("View","Add","Edit","Delete","Status"),"menuView"=>true);
				return $this->returnVal($pages);
			}
		public function GetQueries()
			{
				$queries[constant("CONST_MODULE_CMS_TABLE_CMS")]	=	"
									CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_CMS_TABLE_CMS")."` (
								  `id` bigint(11) NOT NULL auto_increment,
								  `section_id` bigint(11) NOT NULL COMMENT 'refers ".constant("CONST_MODULE_CMS_TABLE_SECTION").".id',
								  `title` varchar(500) NOT NULL,
								  `image` varchar(200) NOT NULL,
								  `description` longtext NOT NULL,
								  `date_added` datetime NOT NULL,
								  `status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive,1=active',
								  PRIMARY KEY  (`id`)
								) ENGINE=".$this->dbEngine." DEFAULT CHARSET=".$this->charSet." COMMENT='This is for content managing' AUTO_INCREMENT=1 ;
								";
				$queries[constant("CONST_MODULE_CMS_TABLE_SECTION")]	=	"
								CREATE TABLE IF NOT EXISTS `".constant("CONST_MODULE_CMS_TABLE_SECTION")."` (
								  `id` int(11) NOT NULL auto_increment,
								  `cms_category` varchar(300) NOT NULL,
								  `preference` bigint(11) NOT NULL default '1',
								  `status` tinyint(1) NOT NULL default '1' COMMENT '0=inactive 1=active',
								  PRIMARY KEY  (`id`)
								) ENGINE=".$this->dbEngine." DEFAULT CHARSET=".$this->charSet."  COMMENT='Master table- CMS Section' AUTO_INCREMENT=1 ;
								";
				return $this->returnVal($queries);
			}
	}
