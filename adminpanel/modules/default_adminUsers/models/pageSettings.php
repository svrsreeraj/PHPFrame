<?php 
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-15
Purpose    :Left Menus Model Page
**************************************************************************************/
class pageSettings extends modelclass
	{
		public function pageSettingsListing()
			{
				$this->permissionCheck("View",1);
				$userObj			=	new adminUser();
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$searchCombo		=	$this->get_combo_arr("sel_search_menu",$userObj->getAllMenus(" status='1'"),"id","menutitle",$searchData["sel_search_menu"],"style='width:100px;'","Any Menu");
				
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"p.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "p.page", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "p.pagetitle", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "p.description", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}	
				if(trim($searchData["sel_search_menu"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "p.menuid", $searchData["sel_search_menu"]);
					}				
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];				
				
				$sql				=	"select p.*, m.menutitle from wp_admin_pages as p, wp_admin_menus as m
										 where 1 and p.menuid=m.id  $sqlCond";								 
				
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());	
				if(!$data)	$this->setPageError("No records found !");				
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));				 
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}		
		public function pageSettingsSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function pageSettingsReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}	
		public function pageSettingsStauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange("wp_admin_pages",$data["id"]))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','status,id');
					}
			}
		public function pageSettingsEnablechange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange("wp_admin_pages",$data["id"],"penable"))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','status,id');
					}					
			}				
		public function pageSettingsAddformbtn()
			{				
				$this->permissionCheck("Add",1);					
				$this->executeAction(false,"Addform",true,true);
			}
		public function pageSettingsCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function pageSettingsEditform()
			{				
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$userObj	=	new adminUser();
				$dataArr	=	end($userObj->getAllPages("id='".$data["id"]."'"));
				$actArr		=	$userObj->getAllPageActions("pageid='".$data["id"]."'");				
				foreach($actArr as $key=>$val)  $actid[]	=	$val['actionid'];
				$pactids	=	implode(",",$actid);
				if($pactids)	
					{
						$act_vals	= 	$userObj->getAllActions("id not in ($pactids) and status='1'");
						$act_sel	= 	$userObj->getAllActions("id  in ($pactids) and status='1'");
					}					
				else 	$act_vals	= 	$userObj->getAllActions(" status='1'");
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$dropDwon	=	$this->get_combo_arr("menuid",$userObj->getAllMenus(" status='1' "),"id","menutitle",$dataArr["menuid"],"style='width:140px;'");
				return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr),"actions"=>$act_vals,"actionSel"=>$act_sel);

			}
		public function pageSettingsAddform()
			{
				$this->permissionCheck("Add",1);					
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$userObj	=	new adminUser();
				$dropDwon	=	$this->get_combo_arr("menuid",$userObj->getAllMenus(" status='1' "),"id","menutitle",$data["menuid"],"style='width:100px;'valtype='emptyCheck-Please select a menu'");
				$actionArr	=	$userObj->getAllActions("status='1' ORDER BY preference asc");
				return array("combo"=>$dropDwon,"data"=>$data,"actionArr"=>$actionArr);
			}
		public function pageSettingsSavedata()
			{
				$this->permissionCheck("Add",1);
				$data					=	$this->getData("post");
				$dataIns				=	$this->populateDbArray("wp_admin_pages",$data);
				$dataIns["preference"]	=	$this->getMaxPreference("wp_admin_pages");	
				$pageArr["page"]		=	$dataIns;	
				$pageArr["actions"]		=	$data["actions"];					
				$userObj	=	new adminUser();
				if($userObj->insertPage($pageArr))	
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
		public function pageSettingsUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$data				=	$this->getData("request");
				$dataIns			=	$this->populateDbArray("wp_admin_pages",$data);
				$pageArr["page"]	=	$dataIns;	
				$pageArr["actions"]	=	$data["actions"];	
				$userObj			=	new adminUser();				
				if($userObj->updatePage($pageArr,$data["id"]))	
					{
						$this->sortingRecords("wp_admin_pages",$data["id"],$data["txtpreference"]);
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
