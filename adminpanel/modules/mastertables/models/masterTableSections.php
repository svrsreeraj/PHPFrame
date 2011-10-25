<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Content Mangagement Model Page
**************************************************************************************/
class masterTableSectionsModel extends modelclass
	{
		public function Listing()
			{
				$this->permissionCheck("View",1);
				$masterObj			=	new masterModule();
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$dropDwon			=	$this->get_combo_arr("sel_search_group",$masterObj->getMasterSectionData("status=1"),"id","ms_table_section",$searchData["sel_search_group"],"","Any Group");
				if(!trim($sortData["sortField"]))
						{
							$this->addData(array("sortField"=>"id"),"request","Search");
							$this->addData(array("sortMethod"=>"desc"),"request","Search");
							$sortData	=	$this->getData("request","Search");//refreshing the variable
						}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "ms_table_section", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "parent_id", $searchData["sel_search_group"]);
					}
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				=	"SELECT * FROM  ".constant("CONST_MODULE_MASTER_TABLE_SECTION")." where 1 $sqlCond";
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				
				if(!$data)				$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["sortData"]		=	$sortData;
				$searchData["combo"]		=	$dropDwon;
				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function Addformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(array("action"=>"Addform","navigate"=>true,"sameParams"=>true));
			}
		public function cCancel()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
			}
		public function Editform()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$masterObj	=	new masterModule();
				$dataArr	=	end($masterObj->getCMSSection($data["id"]));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$dropDwon	=	$this->get_combo_arr("parent_id",$masterObj->getMasterSectionData("status=1"),"id","ms_table_section",$dataArr["parent_id"]);
				
				return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr));
			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$masterObj	=	new masterModule();
				$dropDwon	=	$this->get_combo_arr("parent_id",$masterObj->getMasterSectionData("status=1"),"id","ms_table_section",$data["parent_id"],"","Any Group");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data					=	$this->getData("request","",false);
				$dataIns				=	$this->populateDbArray(constant("CONST_MODULE_MASTER_TABLE_SECTION"),$data);
				$dataIns["preference"]	=	$this->getMaxPreference(constant("CONST_MODULE_MASTER_TABLE_SECTION"));	
				$masterObj			=	new masterModule();
				if(!$this->getPageError())
					{
						if($masterObj->insertCMSSection($dataIns))	
							{
								$this->setPageError("Inserted Successfully");
								$this->clearData("Savedata");
								$this->clearData("Addform");						
								$this->executeAction(array("action"=>"Listing","navigate"=>true));
							}
						else
							{
								$this->setPageError($masterObj->getPageError());
								$this->executeAction(array("loadData"=>true,"action"=>"Addform","navigate"=>true));
							}
					}
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
		public function Updatedata()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("request","",false);
				$masterObj	=	new masterModule();
				$dataIns	=	$this->populateDbArray(constant("CONST_MODULE_MASTER_TABLE_SECTION"),$data);
				if($masterObj->updateCMSSection($dataIns,$data["id"]))	
					{
						$this->sortingRecords(constant("CONST_MODULE_MASTER_TABLE_SECTION"),$data["id"],$data["preference"]);
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				else
					{
						$this->setPageError($masterObj->getPageError());
						$this->executeAction(array("action"=>"Editform","navigate"=>true,"sameParams"=>true));
					}	
			}
		public function Stauschange()
				{	
					$this->permissionCheck("Status");					
					$data		=	$this->getData("request");						
					if($this->statusChange(constant("CONST_MODULE_MASTER_TABLE_SECTION"),$data["id"]))
						{
							$this->setPageError("Status Changed Successfully");
							$this->clearData("Stauschange");											
							return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true,"excludeParams"=>"status,id"));
						}
				}
	}
