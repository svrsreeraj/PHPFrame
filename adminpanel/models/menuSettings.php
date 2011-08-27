<?php 
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-15
Purpose    :Left Menus Model Page
**************************************************************************************/
class menuSettings extends modelclass
	{
		public function menuSettingsListing()
			{
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "menuname", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "menutitle", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}					
				$sqlCond		.=	" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];				
				
				$sql			=	"select * from vod_admin_menus where 1  $sqlCond";
				$spage			=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data			=	$this->getdbcontents_sql($spage->finalSql());	
				if(!$data)	$this->setPageError("No records found !");
				
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));				 
				$searchData["sortData"]		=	$sortData;				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}		
		public function menuSettingsSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function menuSettingsReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}	
		public function menuSettingsStauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange("vod_admin_menus",$data["id"]))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','status,id');
					}
			}
		public function menuSettingsEnablechange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange("vod_admin_menus",$data["id"],"menable"))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','status,id');
					}					
			}				
		public function menuSettingsAddformbtn()
			{				
				$this->permissionCheck("Add",1);					
				$this->executeAction(false,"Addform",true,true);
			}
		public function menuSettingsCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function menuSettingsEditform()
			{				
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$userObj	=	new adminUser();
				$dataArr	=	end($userObj->getAllMenus("id='".$data["id"]."'"));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}				
				return array("data"=>$this->getHtmlData($dataArr));	
			}
		public function menuSettingsAddform()
			{
				$this->permissionCheck("Add",1);					
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				return array("data"=>$data);
			}
		public function menuSettingsSavedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("post");
				$dataIns	=	$this->populateDbArray("vod_admin_menus",$data);
				$dataIns["preference"]	=	$this->getMaxPreference("vod_admin_menus");	
				$userObj	=	new adminUser();
				if($userObj->insertMenu($dataIns))	
					{
						$this->setPageError("Inserted Successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
						return $this->executeAction(false,"Listing",true);
					}
				else
					{
						$this->setPageError($userObj->getPageError());
						$this->executeAction(true,"Addform",true);
					}
			}
		public function menuSettingsUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$this->permissionCheck("Edit",1);	
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray("vod_admin_menus",$data);
				$userObj	=	new adminUser();				
				if($userObj->updateMenu($dataIns,$data["id"]))	
					{
						$this->sortingRecords("vod_admin_menus",$data["id"],$data["txtpreference"]);
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError($userObj->getPageError());
						$this->executeAction(false,"Editform",true,true);
					}
			}
		public function __construct()
			{
				$this->setClassName();
			}
		public function executeAction($loadData=true,$action="",$navigate=false,$sameParams=false,$newParams="",$excludParams="",$page="")
			{
				if(trim($action))	$this->setAction($action);//forced action
				$methodName	=		(method_exists($this,$this->getMethodName()))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
				$this->actionToBeExecuted($loadData,$methodName,$action,$navigate,$sameParams,$newParams,$excludParams,$page);
				$this->actionReturn		=	call_user_func(array($this, $methodName));				
				$this->actionExecuted($methodName);
				return $this->actionReturn;
			}
		public function __destruct()
			{
				parent::childKilled($this);
			}
	}
