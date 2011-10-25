<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Content Mangagement Model Page
**************************************************************************************/
class masterTablesModel extends modelclass
	{
		public function Listing()
			{
				$this->permissionCheck("View",1);
				$masterObj			=	new masterModule();
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$parentArry			=	$this->getData("request");
				$masterTables		=	$this->getdbcontents_sql("select * from ".constant("CONST_MODULE_MASTER_TABLE_SECTION")." where parent_id=0");
				
				if($parentArry["section_id"])
					{
						$this->addData(array("section_id"=>$parentArry["section_id"]),"request");
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "mst.section_id", $parentArry["section_id"]);
						if($parentArry["parent_id"])
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "mst.parent", $parentArry["parent_id"]);
						if(!trim($sortData["sortField"]))
								{
									$this->addData(array("sortField"=>"mst.id"),"request","Search");
									$this->addData(array("sortMethod"=>"desc"),"request","Search");
									$sortData	=	$this->getData("request","Search");//refreshing the variable
								}
						if(trim($searchData["keyword"]))
							{
								$sqlCond	.=	" And ( ";
								$sqlCond	.=	$this->dbSearchCond("like", "mst.name", "%".$searchData["keyword"]."%"). " or";
								$sqlCond	.=	$this->dbSearchCond("like", "cms.date_added", "%".$searchData["keyword"]."%"). " or";
								$sqlCond	.=	$this->dbSearchCond("like", "sect.ms_table_section", "%".$searchData["keyword"]."%");
								$sqlCond	.=	") ";
							}
						$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
						$sql				=	"SELECT  mst.*,sect.ms_table_section FROM  ".constant("CONST_MODULE_MASTER_TABLE_SECTION")."  sect,".constant("CONST_MODULE_MASTER_TABLE")."  mst where  mst.section_id  = sect.id $sqlCond";
						$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
						$data				=	$this->getdbcontents_sql($spage->finalSql(),true);

						if(!$data)						$this->setPageError("No records found !");
						$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
						$searchData["searchCombo"]	=	$searchCombo; 
						$searchData["sortData"]		=	$sortData;

						return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"masters" => $masterTables);
					}
				else
					{
						return array("masters" => $masterTables);
					}
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
				$dataArr	=	end($masterObj->getMasterDetails($data["id"]));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$dropDwon	=	$this->get_combo_arr("section_id",$masterObj->getMasterSectionData("status=1"),"id","ms_table_section",$dataArr["section_id"],"valtype='emptyCheck-please select a Table Name'");
				
				return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr));
			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$masterObj	=	new masterModule();
				$dropDwon	=	$this->get_combo_arr("section_id",$masterObj->getMasterSectionData("status=1"),"id","ms_table_section",$data["section_id"],"valtype='emptyCheck-please select a section'","Any Group");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data					=	$this->getData("request","",false);
				$dataIns				=	$this->populateDbArray(constant("CONST_MODULE_MASTER_TABLE"),$data);
				$dataIns["preference"]	=	$this->getMaxPreference(constant("CONST_MODULE_MASTER_TABLE"));	
				$masterObj			=	new masterModule();
				if(!$this->getPageError())
					{
						if($masterObj->insertMasterDetails($dataIns))	
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
				$dataIns	=	$this->populateDbArray(constant("CONST_MODULE_MASTER_TABLE"),$data);
				if($masterObj->updateMasterDetails($dataIns,$data["id"]))	
					{
						$this->sortingRecords(constant("CONST_MODULE_MASTER_TABLE"),$data["id"],$data["preference"]);
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				else
					{
						$this->setPageError($cmsObj->getPageError());
						$this->executeAction(array("action"=>"Editform","navigate"=>true,"sameParams"=>true));
					}	
			}
		public function Stauschange()
				{	
					$this->permissionCheck("Status");					
					$data		=	$this->getData("request");						
					if($this->statusChange(constant("CONST_MODULE_MASTER_TABLE"),$data["id"]))
						{
							$this->setPageError("Status Changed Successfully");
							$this->clearData("Stauschange");											
							return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true,"excludeParams"=>"status,id"));
						}
				}
	}
