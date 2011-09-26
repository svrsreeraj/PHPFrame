<?php
/**
 * @author	Sreeraj
 * @Date	2011-09-26
 * @file	moduleclass.php	
 */
class moduleclass extends siteclass
	{
		//admin user built in module
		public $tbl_admin_actions		=	"admin_actions";
		public $tbl_admin_menus			=	"admin_menus";
		public $tbl_admin_pages			=	"admin_pages";
		public $tbl_admin_page_actions	=	"admin_page_actions";
		public $tbl_admin_permission	=	"admin_permission";
		public $tbl_admin_users			=	"admin_users";
		public $tbl_admin_usertype		=	"admin_usertype";
		
		//error array
		public $errorArray				=	array();
		public $statusArray				=	array();	
		
		public function getModulePath($file)
			{
				return dirname($file).DIRECTORY_SEPARATOR;
			}		
		public function getModuleURL($file,$siteAbsPath,$siteAddress)
			{
				$slices	=	explode(DIRECTORY_SEPARATOR,str_replace($siteAbsPath, "", $file));
				array_pop($slices);
				return $siteAddress.implode("/",$slices)."/";
			}
		public function getModuleFolderName($file)
			{
				return end(explode(DIRECTORY_SEPARATOR,dirname($file)));
			}	
		public function installModule($argsArray=array())
			{
				$defaultArray	=	array("menu"=>array(),"pages"=>array(),
									"queries"=>array(),"modulePath"=>"","moduleFolder"=>"");
				$mergedArray	=	array_merge($defaultArray, $argsArray);
				extract($mergedArray);
				
				$installFailedFlag	=	0;
				if($installFailedFlag	==	0)
					{
						$this->findErrorsInModule($argsArray); //validating module
						if($this->errorArray)	$installFailedFlag	=	1;
						else					$this->statusArray[]	=	"No Validation Error in Module";
					}
				if($installFailedFlag	==	0)
					{
						$this->installQueires($queries); //installing queries
						if($this->errorArray)	$installFailedFlag	=	1;
						else 					$this->statusArray[]	=	"Tables inserted successfully";
					}
				if($installFailedFlag	==	0)
					{
						$this->insertMenu($menu); //installing menus
						if($this->errorArray)	$installFailedFlag	=	1;
						else 					$this->statusArray[]	=	"Menu inserted successfully";
					}
				
				//Insert into pages
				
				
				//insert in to Page actions
					
				if($installFailedFlag	==	1)
					{
						$this->uninstallModule($argsArray);
						$this->statusArray[]	=	"Module Uninstalled. :(";
					}
					
			}
		public function insertMenu($menu)
			{
				$preference	=	$this->getMaxPreference(constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus);
				$data		=	array("menuname"=>$menu["menuName"],"menutitle"=>$menu["menuTitle"],"preference"=>$preference);
				$insData	=	$this->db_insert(constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus,$data);
				if(!$insData)	$this->errorArray[]	=	"Menu not installed. Something went wrong :(";
			}
		public function installQueires($queries=array())
			{
				$dropFlag	=	0;
				foreach($queries	as	$key=>$val)
					{
						if(!$this->db_query($val))	
							{
								$this->errorArray[]	=	"table $key is not created ! Rolling back..";
								$dropFlag			=	1;
								break;
							}
					}
				if($dropFlag	==	1)	$this->rollBackTables($queries);
			}
		public function findErrorsInModule($argsArray=array())
			{
				$defaultArray	=	array("menu"=>array(),"pages"=>array(),
									"queries"=>array(),"modulePath"=>"","moduleFolder"=>"");
				$mergedArray	=	array_merge($defaultArray, $argsArray);
				extract($mergedArray);

				//checking whether menuname is availabe
				if(!trim($menu["menuName"]))	$this->errorArray[]	=	"Not a valid menu name";
				else
					{
						$sql	=	"select * from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus." where menuname = '".mysql_real_escape_string($menu["menuName"])."'";
						if($this->getdbcount_sql($sql))		$this->errorArray[]	=	"Menu Name is already exist in the database :(";
					}
					
				foreach($pages as	$key=>$val)//checking existance of pages
					{
						if(!trim($val["page"]))	$this->errorArray[]	=	"Found empty filename";
						elseif(!is_file($modulePath.$val["page"]))	$this->errorArray[]	=	$val["page"] . " not exisits !!";
					}

				$newArray	=	array();
				foreach($pages	as 	$key=>$val)
					{
						foreach($val["actions"]	as	$key1=>$val1)	$newArray[]	=	$val1;
					}
				$newArray	=	array_unique($newArray);
				foreach($newArray	as $key=>$val)
					{
						$sql	=	"select * from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_actions	." where action = '".mysql_real_escape_string($val)."'";
						if(!$this->getdbcount_sql($sql))		$this->errorArray[]	=	"'$val' action is not available in the database";	
					}
			}	
		public function uninstallModule($argsArray=array())
			{	
				$defaultArray	=	array("menu"=>array(),"pages"=>array(),
									"queries"=>array(),"modulePath"=>"","moduleFolder"=>"");
				$mergedArray	=	array_merge($defaultArray, $argsArray);
				extract($mergedArray);
				$this->rollBackTables($queries);
			}
		public function rollBackTables($queries)
			{
				foreach($queries	as	$key=>$val)	$this->db_query("DROP TABLE `$key`");
			}
		public function deleteMenu($menu)
			{
				$sql =	"delete from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus." where menuname='".$menu["menuName"]."'";
				$this->db_query($sql);
			}
			

	}
?>