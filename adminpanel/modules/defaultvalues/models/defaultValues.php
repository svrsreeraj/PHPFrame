<?php
/**************************************************************************************
Created by :Meghna
Created on :2011-11-18
Purpose    :Content Mangagement Model Page
**************************************************************************************/
class defaultValuesModel extends modelclass
	{
		public function Listing()
			{
				$this->permissionCheck("View",1);
				$defaultObj			=	new defaultModule();
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$searchCombo		=	$this->get_combo_arr("sel_search_group",$defaultObj->getDefaultGroupData("1"),"id","group",$searchData["sel_search_group"],"","Any Group");
				if(!trim($sortData["sortField"]))
						{
							$this->addData(array("sortField"=>"def.id"),"request","Search");
							$this->addData(array("sortMethod"=>"desc"),"request","Search");
							$sortData	=	$this->getData("request","Search");//refreshing the variable
						}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "def.caption", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "def.value", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "dgroup.group", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "def.group_id", $searchData["sel_search_group"]);
					}
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				=	"SELECT  def.*,dgroup.group	FROM  ".constant("CONST_MODULE_DEFAULT_TABLE_GROUP")."  dgroup,".constant("CONST_MODULE_DEFAULT_TABLE_DEFAULT")."  def where  def.group_id  = dgroup.id $sqlCond";
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				
				$arrcnt				=	-1;
				foreach($data as $key=>$value)
						{
							foreach($value as $innerkey=>$description)
								{
									$temp[$innerkey]		=	strip_tags($description);
								}
							$data[$key]				=		$temp;
						}
				if(!$data)				$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
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
				$defaultObj	=	new defaultModule();
				$dataArr	=	end($defaultObj->getDefaultData("id='".$data["id"]."'"));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				$dropDwon	=	$this->get_combo_arr("group_id",$defaultObj->getDefaultGroupData("status=1"),"id","group",$dataArr["group_id"],"valtype='emptyCheck-please select a group'");
				
				return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr));
			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$defaultObj	=	new defaultModule();
				$dropDwon	=	$this->get_combo_arr("group_id",$defaultObj->getDefaultGroupData("status=1"),"id","group",$data["group_id"], "valtype='emptyCheck-please select a group'");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data				=	$this->getData("request","",false);
				$dataIns			=	$this->populateDbArray(constant("CONST_MODULE_DEFAULT_TABLE_DEFAULT"),$data);
				$defaultObj			=	new defaultModule();
				if(!$this->getPageError())
					{
						if($defaultObj->insertDefaultValue($dataIns))	
							{
								$this->setPageError("Inserted Successfully");
								$this->clearData("Savedata");
								$this->clearData("Addform");						
								$this->executeAction(array("action"=>"Listing","navigate"=>true));
							}
						else
							{
								$this->setPageError($defaultObj->getPageError());
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
				$defaultObj	=	new defaultModule();
				$dataIns	=	$this->populateDbArray(constant("CONST_MODULE_DEFAULT_TABLE_DEFAULT"),$data);
				if($defaultObj->updateDefaultValue($dataIns,$data["id"]))	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				else
					{
						$this->setPageError($defaultObj->getPageError());
						$this->executeAction(array("action"=>"Editform","navigate"=>true,"sameParams"=>true));
					}	
			}
	}
