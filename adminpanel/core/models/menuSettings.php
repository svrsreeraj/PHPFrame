<?php 
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-15
Purpose    :Left Menus Model Page
**************************************************************************************/
class menuSettingsModel extends modelclass
	{
		public function Listing()
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
				
				$sql			=	"select * from ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS")." where 1  $sqlCond";
				$spage			=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data			=	$this->getdbcontents_sql($spage->finalSql());	
				if(!$data)	$this->setPageError("No records found !");
				
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));				 
				$searchData["sortData"]		=	$sortData;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}		
		public function menuSettingsSearch()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
			}
		public function Reset()
			{
				$this->clearData("Search");
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
			}	
		public function Stauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange(constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS"),$data["id"]))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true,"excludeParams"=>"status,id"));
					}
			}
		public function Enablechange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange(constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS"),$data["id"],"menable"))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true,"excludeParams"=>"status,id"));
					}					
			}				
		public function Addformbtn()
			{				
				$this->permissionCheck("Add",1);					
				$this->executeAction(array("action"=>"Addform","navigate"=>true,"sameParams"=>true));
			}
		public function Cancel()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
			}
		public function Editform()
			{				
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$userObj	=	new coreAdminUser();
				$dataArr	=	end($userObj->getAllMenus("id='".$data["id"]."'"));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(array("action"=>"Listing","navigate"=>true));
					}				
				return array("data"=>$this->getHtmlData($dataArr));	
			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);					
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				return array("data"=>$data);
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("post");
				$dataIns	=	$this->populateDbArray(constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS"),$data);
				$dataIns["preference"]	=	$this->getMaxPreference(constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS"));	
				$userObj	=	new coreAdminUser();
				if($userObj->insertMenu($dataIns))	
					{
						$this->setPageError("Inserted Successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
						return $this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
				else
					{
						$this->setPageError($userObj->getPageError());
						$this->executeAction(array("action"=>"Addform","navigate"=>true));
					}
			}
		public function Updatedata()
			{
				$this->permissionCheck("Edit",1);
				$this->permissionCheck("Edit",1);	
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray(constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS"),$data);
				$userObj	=	new coreAdminUser();				
				if($userObj->updateMenu($dataIns,$data["id"]))	
					{
						$this->sortingRecords(constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS"),$data["id"],$data["txtpreference"]);
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				else
					{
						$this->setPageError($userObj->getPageError());
						return $this->executeAction(array("action"=>"Editform","navigate"=>true,"sameParams"=>true));
					}
			}
	}
