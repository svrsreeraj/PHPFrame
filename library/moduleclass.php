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
		
		
		public $user_type_id			=	1;
		
		public $moduleLocation			=	"adminpanel/modules/";
		public $moduleConfFile			=	"moduleConfig.php";
		
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
		public	function getModulePathByName($module)
			{
				$path		=	constant("CONST_SITE_ABSOLUTE_PATH").$this->moduleLocation.$module."/";
				$confFile	=	$path.$this->moduleConfFile;
				if(is_file($confFile))	return $confFile;
				else 					return false;
			}	
		public function installModule($module)
			{
				if(!$confFile = $this->getModulePathByName($module))	$this->errorArray[]	=	"Module $module Configuration file not found";
				require $confFile;
				if($this->errorArray)	exit("Module Configuration file not found");
				
				$installFailedFlag	=	0;
				if($installFailedFlag	==	0) //validating module
					{
						$this->findErrorsInModule($module);
						if($this->errorArray)	$installFailedFlag	=	1;
						else					$this->statusArray[]	=	"No Validation Error in Module";
					}
				if($installFailedFlag	==	0)//installing queries- creating tables
					{
						$this->installQueires($queries); 
						if($this->errorArray)	$installFailedFlag	=	1;
						else 					$this->statusArray[]	=	"Tables inserted successfully";
					}
				if($installFailedFlag	==	0)//Inserting Menu
					{
						$this->insertMenus($menus); //installing menus
						if($this->errorArray)	$installFailedFlag	=	1;
						else 					$this->statusArray[]	=	"Menus inserted successfully";
					}
				if($installFailedFlag	==	0)//Insert into pages
					{
						$this->insertPages($pages,$module);
						if($this->errorArray)	$installFailedFlag	=	1;
						else 					$this->statusArray[]	=	"Pages inserted successfully";
					}
				if($installFailedFlag	==	0)//insert in to Page actions
					{
						$this->insertPageActions($menus,$pages);
						if($this->errorArray)	$installFailedFlag	=	1;
						else 					$this->statusArray[]	=	"Page Actions inserted successfully";
					}
				if($installFailedFlag	==	0)//insert in to Admin Permissions
					{
						$this->insertAdminPermissions($menus);
						if($this->errorArray)	$installFailedFlag	=	1;
						else 					$this->statusArray[]	=	"Admin Permissions inserted successfully";
					}
				
					
				if($installFailedFlag	==	1)
					{
						$this->uninstallModule($module);
						$this->statusArray[]	=	"Module Uninstalled. :(";
					}
			}
		public function getmenuId($menu)
			{
				$insData	=	$this->getdbcontents_sql("select * from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus." where menuname='".mysql_real_escape_string($menu["menuName"])."'");
				if(is_array($insData))
					{
						if(is_array(end($insData)))
							{
								$menuData	=	end($insData);
								$menuId		=	$menuData["id"];
							}
					}
				return $menuId;
			}
		public function getPages($menu)
			{
				$menuId		=	$this->getmenuId($menu);
				if($menuId)
					{
						$insData	=	$this->getdbcontents_sql("select * from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_pages." where menuid='".$menuId."'");
					}
				return $insData;
			}
		public function getActionIds($pageName,$pages)
			{
				$currentActions	=	array();
				$newActions		=	array();
				foreach ($pages	as	$key=>$val)
					{
						if($val["page"]	==	$pageName)
							{
								$currentActions	=	array_unique($val["actions"]);
								break;	
							}		
					}
				if(!$currentActions)	return array();
				foreach ($currentActions	as	$key=>$val)
					{
						$checkData	=	$this->getdbcontents_sql("select * from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_actions." where action='".mysql_real_escape_string($val) ."'");
						if(is_array($checkData))	if($checkData["0"]["id"])	$newActions[]	=		$checkData["0"]["id"];	
					}
				if(count($currentActions)	==	count($newActions))	return $newActions;
				else												return array();
			}
		public function getPageActions($menu)
			{
				$pages		=	$this->getPages($menu);
				$ids		=	array();
				foreach ($pages	as $key=>$val)	$ids[]	=	$val["id"];
				if($ids)
					{
						$insData	=	$this->getdbcontents_sql("select * from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_page_actions." where pageid in(".implode(",",$ids).")");
					}
				return $insData;
			}
		public function insertAdminPermissions($menus)
			{
				$err			=	false;
				foreach($menus as $mnuKey=>$mnuVal)
					{
						$pageActions	=	$this->getPageActions($mnuVal);
						if($pageActions)
							{
								foreach ($pageActions	as $key=>$val)
									{
										$data		=	array("usertypeid"=>$this->user_type_id,"pactionid"=>$val["id"]);
										$insData	=	$this->db_insert(constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_permission,$data);
										if(!$insData)	$err	=	true;
									}	
							}
						else	$err	=	true;
					}
			}
		public function insertPageActions($menus,$pages)
			{
				$err		=	false;
				foreach($menus as $mnukey=>$mnuval)
					{
						$insPages	=	$this->getPages($mnuval);
						if($insPages)
							{
								foreach($insPages	as $key=>$val)
									{
										$InsActions	=	$this->getActionIds($val["page"],$pages);
										if(!$InsActions)	$err	=	true;
										foreach($InsActions	as $key1=>$val1)
											{
												$data		=	array("pageid"=>$val["id"],"actionid"=>$val1);
												$insData	=	$this->db_insert(constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_page_actions,$data);
												if(!$insData)	$err	=	true;
											}
									}
							}
						else $err	=	true;
						if($err)	break;
					}
				if($err)	$this->errorArray[]	=	"Page actions are not installed. Something went wrong :(";
				
			}
		public function insertPages($pages,$moduleFolder)
			{
				$err	=	false;
				foreach($pages as $val)
					{
						$menuId	=	$this->getmenuId(array("menuName"=>$val["menu"]));		
						if($menuId)
							{
								if(trim($val["page"]))
									{
										$preference	=	$this->getMaxPreference(constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_pages);
										$data		=	array("menuid"=>$menuId,"module"=>$moduleFolder,"page"=>$val["page"],
										"pagetitle"=>$val["title"],"description"=>$val["description"],"status"=>1,
										"penable"=>intval($val["menuView"]),"preference"=>$preference);
										$insData	=	$this->db_insert(constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_pages,$data);
										if(!$insData)	$err	=	true;
									}
								else	$err	=	true;
							}
						else	$err	=	true;	
						if($err)	break;
					}
				if($err)	$this->errorArray[]	=	"Pages are not installed. Something went wrong :(";
			}
		public function insertMenus($menus)
			{
				foreach($menus as	$key=>$menu)
					{
						$preference	=	$this->getMaxPreference(constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus);
						$data		=	array("menuname"=>$menu["menuName"],"menutitle"=>$menu["menuTitle"],"preference"=>$preference);
						$insData	=	$this->db_insert(constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus,$data);
						if(!$insData)	
							{
								$this->errorArray[]	=	"Menu not installed. Something went wrong :(";
								break;
							}
					}
			}
		public function installQueires($queries=array())
			{
				$err	=	false;
				foreach($queries	as	$key=>$val)
					{
						if(!$this->db_query($val))	
							{
								$this->errorArray[]	=	"table $key is not created ! Rolling back..";
								$err	=	true;
								break;
							}
					}
			}
		public function findErrorsInModule($module)
			{
				if(!$confFile = $this->getModulePathByName($module))	$this->errorArray[]	=	"Module $module Configuration file not found";
				require $confFile;
				if($this->errorArray)	exit("Module Configuration file not found");
				
				$modulePath	=	constant("CONST_SITE_ABSOLUTE_PATH").$this->moduleLocation.$module."/";
				
				foreach($menus	as $key=>$menu)
					{
						//checking whether menuname is availabe
						if(!trim($menu["menuName"]))	$this->errorArray[]	=	"Not a valid menu name";
						else
							{
								$sql	=	"select * from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus." where menuname = '".mysql_real_escape_string($menu["menuName"])."'";
								if($this->getdbcount_sql($sql))		$this->errorArray[]	=	"Menu Name is already exist in the database :(";
							}
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
		public function uninstallModule($module)
			{	
				if(!$confFile = $this->getModulePathByName($module))	exit("Module Configuration file not found");
				require $confFile;
				$this->rollBackTables($queries);
				$this->deleteAdminPermissions($menus);
				$this->deletePageActions($menus);
				$this->deletePages($menus);
				$this->deleteMenus($menus);				
			}
		public function rollBackTables($queries)
			{
				foreach($queries	as	$key=>$val)	$this->db_query("DROP TABLE `$key`");
			}
		public function deleteAdminPermissions($menus)
			{
				foreach($menus as $mnukey=>$mnuval)
					{
						$pageActions	=	$this->getPageActions($mnuval);
						if($pageActions)
							{
								foreach ($pageActions	as $key=>$val)
									{
										$sql =	"delete from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_permission." where usertypeid='".$this->user_type_id."' and pactionid ='".$val["id"]."'";
										$this->db_query($sql);
									}	
							}
					}
			}
		public function deletePageActions($menus)
			{
				foreach($menus as $mnukey=>$mnuval)
					{
						$insPages	=	$this->getPages($mnuval);
						foreach($insPages	as	$key=>$val)
							{
								$sql =	"delete from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_page_actions." where pageid='".$val["id"]."'";
								$this->db_query($sql);
							}
					}
			}
		public function deletePages($menus)
			{
				foreach($menus as $mnukey=>$mnuval)
					{
						$menuId	=	$this->getmenuId($mnuval);
						if($menuId)
							{
								$sql =	"delete from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_pages." where menuid='".$menuId."'";
								$this->db_query($sql);
							}
					}
			}
		public function deleteMenus($menus)
			{
				foreach($menus as	$key=>$menu)
					{
						$sql =	"delete from ".constant("CONST_DB_TABLE_PREFIX").$this->tbl_admin_menus." where menuname='".$menu["menuName"]."'";
						$this->db_query($sql);
					}
			}
			

	}
?>