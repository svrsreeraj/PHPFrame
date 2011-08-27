<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Defaults Model Page
**************************************************************************************/
class defaultValues extends modelclass
	{
		public function defaultValuesListing()
			{ 
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$defaultObj		=	new defaults();
				$searchCombo	=	$this->get_combo_arr("sel_search_group", $defaultObj->getAllGroups("1"), "id", "group", $searchData["sel_search_group"],"Any Group");
				
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"g.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
					
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "g.group", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "d.caption", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "d.value", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "d.group_id", $searchData["sel_search_group"]);
					}
					
				$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				
				$sql		=	"select d.*, g.group from vod_defaults as d, vod_defaults_group as g
								 where 1 and d.group_id=g.id  $sqlCond";
				$spage		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
			
				
				if(!$data)		$this->setPageError("No records found !");
				
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		
		public function defaultValuesAddformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(false,"Addform",true,true);
			}
		public function defaultValuesCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function defaultValuesReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function defaultValuesSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function defaultValuesEditform()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get"); 
				$defaultObj	=	new defaults();
				$dataArr	=	end($defaultObj->getAllConstants("id='".$data["id"]."'"));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true); 
					}
				$dropDwon	=	$this->get_combo_arr("group_id",$defaultObj->getAllGroups("1"),"id","group",$dataArr["group_id"],"valtype='emptyCheck-please select a group'");
				return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr));
			}
		public function defaultValuesAddform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$defaultObj	=	new defaults();
				$dropDwon	=	$this->get_combo_arr("group_id",$defaultObj->getAllGroups("1"),"id","group",$data["group_id"] ,"valtype='emptyCheck-please select a group'");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function defaultValuesSavedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("post");
				$dataIns	=	$this->populateDbArray("vod_defaults",$data);
				$defaultObj	=	new defaults();
				if($defaultObj->insertDefaults($dataIns))	
					{
						$this->setPageError("Inserted Successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
						return $this->executeAction(false,"Listing",true);
					}
				else
					{
						$this->setPageError($defaultObj->getPageError());
						$this->executeAction(true,"Addform",true);
					}	
			}
		
		public function defaultValuesUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray("vod_defaults",$data);
				$defaultObj	=	new defaults();
				if($defaultObj->updateDefaults($dataIns,$data["id"]))	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError($defaultObj->getPageError());
						$this->executeAction(false,"Editform",true,true);
					}	
			}
		public function defaultValuesDelete()
			{
				$this->permissionCheck("Delete",1);
				$data	=	$this->getData("post");
				if($data["checkone"])	
					{
						$this->db_delete_combo("vod_faq","id",$data["checkone"]);
						$this->setPageError("Deleted Successfully");
					}
				else	$this->setPageError("No records selected");	
				return $this->executeAction(false,"Listing",true,true);
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
