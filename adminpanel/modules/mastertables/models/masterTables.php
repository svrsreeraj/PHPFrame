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
				$childArry			=	end($this->getdbcontents_sql("SELECT id,ms_table_section FROM ".constant("CONST_MODULE_MASTER_TABLE_SECTION")." WHERE parent_id = ".$parentArry["section_id"].""));
				if($parentArry["section_id"])
					{
						$this->addData(array("section_id"=>$parentArry["section_id"]),"request");
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "mst.section_id", $parentArry["section_id"]);
						if($parentArry["parent_id"])
							{
								$this->addData(array("parent_id"=>$parentArry["parent_id"]),"request");
								$sqlCond	.=	" And ". $this->dbSearchCond("=", "mst.parent_id", $parentArry["parent_id"]);
							}
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
								$sqlCond	.=	$this->dbSearchCond("like", "sect.ms_table_section", "%".$searchData["keyword"]."%");
								$sqlCond	.=	") ";
							}
						$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
						$sql				=	"SELECT  mst.*,sect.ms_table_section FROM  ".constant("CONST_MODULE_MASTER_TABLE_SECTION")."  sect,".constant("CONST_MODULE_MASTER_TABLE")."  mst where  mst.section_id  = sect.id $sqlCond";
						$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
						$data				=	$this->getdbcontents_sql($spage->finalSql());
		
						if(!$data)						$this->setPageError("No records found !");
						$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
						$searchData["searchCombo"]	=	$searchCombo; 
						$searchData["sortData"]		=	$sortData;
						
						$masArry					= 	array();
						$masArry["childId"]			= 	$childArry["id"];
						$masArry["child"]			=	$childArry["ms_table_section"];
						$masArry["parentId"]		=	$parentArry["parent_id"];
						$masArry["sectionId"]		=	$parentArry["section_id"];
						
						return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"masters" => $masterTables ,"msloop" => $masArry);
					}
				else
					{
						return array("masters" => $masterTables);
					}
			}
		public function GetSection($section_id)
			{
				$sectionArry	=	end($this->getdbcontents_sql("SELECT ms_table_section FROM ".constant("CONST_MODULE_MASTER_TABLE_SECTION")." WHERE id = $section_id"));
				return $sectionArry["ms_table_section"];
			}
		public function GetParent($parent_id)
			{
				$parentArry		=	end($this->getdbcontents_sql("SELECT name FROM ".constant("CONST_MODULE_MASTER_TABLE")." WHERE id = $parent_id"));
				return $parentArry["name"];
			}
		public function GetFlow($sectionId,$parentId)
			{
				if($parentId)
					{
						do
							{
								$parentArry		=	end($this->getdbcontents_sql("SELECT id,name,section_id,parent_id FROM ".constant("CONST_MODULE_MASTER_TABLE")." WHERE id = $parentId"));
								$childSect		=	end($this->getdbcontents_sql("SELECT id FROM ".constant("CONST_MODULE_MASTER_TABLE_SECTION")." WHERE parent_id = ".$parentArry["section_id"].""));
								$url			=	"masterTables.php?actionvar=Listing&section_id=".$childSect["id"]."&parent_id=".$parentArry["id"]."";
								$strData[]		=	"<a href='$url'>".$parentArry["name"]."</a>";	
								$parentId		=	$parentArry["parent_id"];
							}			
						while($this->getdbcount_sql("SELECT id FROM ".constant("CONST_MODULE_MASTER_TABLE")." WHERE id = $parentId") >0);
						
						$strData				=	implode(" >> ",array_reverse($strData));
						return $strData." >> ";
					}
				if($sectionId)
					{
						do
							{
								$parentArry		=	end($this->getdbcontents_sql("SELECT id,ms_table_section,parent_id FROM ".constant("CONST_MODULE_MASTER_TABLE_SECTION")." WHERE id = $sectionId"));
								$url			=	"masterTables.php?actionvar=Listing&section_id=".$parentArry["id"];
								$strData[]		=	"<a href='$url'>".$parentArry["ms_table_section"]."</a>";	
								$sectionId		=	$parentArry["parent_id"];
							}			
						while($this->getdbcount_sql("SELECT * FROM ".constant("CONST_MODULE_MASTER_TABLE_SECTION")." WHERE id = $sectionId") >0);
						
						$strData				=	implode(" >> ",array_reverse($strData));
						return $strData." >> ";
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
				
				return array("data"=>$this->getHtmlData($dataArr));
			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("request");
				$masterObj	=	new masterModule();
				$dropDwon	=	$this->get_combo_arr("section_id",$masterObj->getMasterSectionData("status=1"),"id","ms_table_section",$data["section_id"],"valtype='emptyCheck-please select a section'","Any Group");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data					=	$this->getData("request","",false);
				$masterObj				=	new masterModule();
				$txt_add				= 	$data["txt_add"];
				$cnt					=	0;
				for($i=0;$i<count($txt_add);$i++)
					{
						if(!$this->getdbcount_cond(constant("CONST_MODULE_MASTER_TABLE"),"name ='".mysql_real_escape_string($txt_add[$i])."'"))
							{
								if(trim($txt_add[$i]))
									{
										$dataAraay					=	array();
										$pref_cnt					=	$this->getdbcontents_sql("SELECT max(`preference`)+1 as maxpref FROM `".constant("CONST_MODULE_MASTER_TABLE")."` where section_id = ".$data["section_id"]."");
										$pref_cnt					=	$pref_cnt[0]["maxpref"];
										$dataAraay["name"]			=	$txt_add[$i];
										$dataAraay["preference"]	=	$pref_cnt;
										if($data["parent_id"])
											{
												$dataAraay["parent_id"]			=	$data["parent_id"];
												$psection						=	end($this->getdbcontents_sql("SELECT section_id FROM ".constant("CONST_MODULE_MASTER_TABLE")." WHERE id = ".$data["parent_id"].""));
												$dataAraay["parent_section_id"]	=	$psection["section_id"];
											}
										$dataAraay["section_id"]		=	$data["section_id"];
										if(!$masterObj->insertMasterDetails($dataAraay))
											{
												$tempErr	.=	implode("<br>",$masterObj->getDbErrors());
											}
										else	$cnt++;
									}
							}
					}
				$this->setPageError("$cnt Details Inserted. <br> $tempErr");
				$this->clearData("Savedata");
				$this->clearData("Addform");						
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
			}
		public function Search()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
			}
		public function Reset()
			{
				$this->clearData("Search");
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
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
