<?php 
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-15
Purpose    :Left Menus Model Page
**************************************************************************************/
class pageSettingsModel extends modelclass
	{
		public function Listing()
			{
				$this->permissionCheck("View",1);
				$userObj			=	new coreAdminUser();
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
				
				$sql				=	"select p.*, m.menutitle from ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES")." as p, ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_MENUS")." as m
										 where 1 and p.menuid=m.id  $sqlCond";								 
				
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());	
				if(!$data)	$this->setPageError("No records found !");				
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));				 
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}		
		public function Search()
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
				if($this->statusChange(constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES"),$data["id"]))
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
				if($this->statusChange(constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES"),$data["id"],"penable"))
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
						return $this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
				$dropDwon	=	$this->get_combo_arr("menuid",$userObj->getAllMenus(" status='1' "),"id","menutitle",$dataArr["menuid"],"style='width:140px;'");
				return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr),"actions"=>$act_vals,"actionSel"=>$act_sel);

			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);					
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$userObj	=	new coreAdminUser();
				$dropDwon	=	$this->get_combo_arr("menuid",$userObj->getAllMenus(" status='1' "),"id","menutitle",$data["menuid"],"style='width:100px;'valtype='emptyCheck-Please select a menu'");
				$actionArr	=	$userObj->getAllActions("status='1' ORDER BY preference asc");
				return array("combo"=>$dropDwon,"data"=>$data,"actionArr"=>$actionArr);
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data					=	$this->getData("post");
				$dataIns				=	$this->populateDbArray(constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES"),$data);
				$dataIns["preference"]	=	$this->getMaxPreference(constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES"));	
				$pageArr["page"]		=	$dataIns;	
				$pageArr["actions"]		=	$data["actions"];					
				$userObj	=	new coreAdminUser();
				if($userObj->insertPage($pageArr))	
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
				$data				=	$this->getData("request");
				$dataIns			=	$this->populateDbArray(constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES"),$data);
				$pageArr["page"]	=	$dataIns;	
				$pageArr["actions"]	=	$data["actions"];	
				$userObj			=	new coreAdminUser();				
				if($userObj->updatePage($pageArr,$data["id"]))	
					{
						$this->sortingRecords(constant("CONST_ADMIN_CORE_TABLE_ADMIN_PAGES"),$data["id"],$data["txtpreference"]);
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
