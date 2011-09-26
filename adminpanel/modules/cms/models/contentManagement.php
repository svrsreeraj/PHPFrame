<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Content Mangagement Model Page
**************************************************************************************/
class contentManagementModel extends modelclass
	{
		public function Listing()
			{
				$this->permissionCheck("View",1);
				$cmsObj				=	new cmsModule();
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$searchCombo		=	$this->get_combo_arr("sel_search_group",$cmsObj->getCMSSectionData("1"),"id","section",$searchData["sel_search_group"],"","Any Group");
				if(!trim($sortData["sortField"]))
						{
							$this->addData(array("sortField"=>"cms.id"),"request","Search");
							$this->addData(array("sortMethod"=>"desc"),"request","Search");
							$sortData	=	$this->getData("request","Search");//refreshing the variable
						}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "cms.description", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "cms.title", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "cms.date_added", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "sect.section", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "cms.section_id", $searchData["sel_search_group"]);
					}
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				=	"SELECT  cms.*,sect.section	FROM  ".constant("CONST_MODULE_CMS_TABLE_SECTION")."  sect,".constant("CONST_MODULE_CMS_TABLE_CMS")."  cms where  cms.section_id  = sect.id $sqlCond";
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
				$cmsObj	=	new cmsModule();
				$dataArr	=	end($cmsObj->getCMSData("id='".$data["id"]."'"));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$dropDwon	=	$this->get_combo_arr("section_id",$cmsObj->getCMSSectionData("status=1"),"id","section",$dataArr["section_id"],"valtype='emptyCheck-please select a section'");
				
				return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr));
			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$cmsObj		=	new cmsModule();
				$dropDwon	=	$this->get_combo_arr("section_id",$cmsObj->getCMSSectionData("status=1"),"id","section",$data["section_id"], "valtype='emptyCheck-please select a section'");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("files");
					if($data[fileImage] [name])
					{
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
						$adimg		=	$upObj->copy("fileImage","../images/subcategory",2);
						if($adimg)		$upObj->img_resize("100","120","../images/subcategory/thumb");
						else 			$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data				=	$this->getData("request","",false);
				$dataIns			=	$this->populateDbArray(constant("CONST_MODULE_CMS_TABLE_CMS"),$data);
				$cmsObj				=	new cmsModule();
				if(!$this->getPageError())
					{
						if($cmsObj->insertCMS($dataIns))	
							{
								$this->setPageError("Inserted Successfully");
								$this->clearData("Savedata");
								$this->clearData("Addform");						
								$this->executeAction(array("action"=>"Listing","navigate"=>true));
							}
						else
							{
								$this->setPageError($cmsObj->getPageError());
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
				$data		=	$this->getData("files");
				if($data[fileImage][name])
					{
						$data		=	$this->getData("request");
						$id			=	$data["id"];
						$cms_obj	=	new cmsModule();
						$details	=	$cms_obj->getCMSData("id=".$id);
						$image_path	=	$details[0][image];
						@unlink("../images/cms/".$image_path);
						@unlink("../images/cms/thumb/".$image_path);
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
						$adimg		=	$upObj->copy("fileImage","../images/cms",2);
						if($adimg)		$upObj->img_resize("100","120","../images/cms/thumb");
						else 			$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data		=	$this->getData("request","",false);
				$cmsObj		=	new cmsModule();
				$dataIns	=	$this->populateDbArray(constant("CONST_MODULE_CMS_TABLE_CMS"),$data);
				if($cmsObj->updateCMS($dataIns,$data["id"]))	
					{
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
					if($this->statusChange(constant("CONST_MODULE_CMS_TABLE_CMS"),$data["id"]))
						{
							$this->setPageError("Status Changed Successfully");
							$this->clearData();											
							return $this->executeAction(false,"Listing",true,true,'','status,id');
							return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true,"excludeParams"=>"status,id"));
						}
				}
	}
