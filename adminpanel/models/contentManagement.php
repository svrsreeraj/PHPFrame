<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Content Mangagement Model Page
**************************************************************************************/
class contentManagement extends modelclass
	{
		public function contentManagementListing()
			{
				$this->permissionCheck("View",1);
				$cmsObj				=	new cms();
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$searchCombo		=	$this->get_combo_arr("sel_search_group",$cmsObj->getCMSSectionData("1"),"id","section",$searchData["sel_search_group"],"","Any Group");
				if(!trim($sortData["sortField"]))
						{
							$this->addData(array("sortField"=>"vs.id"),"request","Search");
							$this->addData(array("sortMethod"=>"desc"),"request","Search");
							$sortData	=	$this->getData("request","Search");//refreshing the variable
						}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "vs.description", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "vs.title", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "vs.date_added", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "vod.section", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "vs.section_id", $searchData["sel_search_group"]);
					}
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				=	"SELECT  vs.*,vod.section	FROM  vod_cms_section  vod,vod_cms  vs where  vs.section_id  = vod.id $sqlCond";
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
		public function contentManagementAddformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(false,"Addform",true,true);
			}
		public function contentManagementCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function contentManagementEditform()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$cmsObj	=	new cms();
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
		public function contentManagementAddform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$cmsObj		=	new cms();
				$dropDwon	=	$this->get_combo_arr("section_id",$cmsObj->getCMSSectionData("status=1"),"id","section",$data["section_id"], "valtype='emptyCheck-please select a section'");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function contentManagementSavedata()
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
				$dataIns			=	$this->populateDbArray("vod_cms",$data);
				$cmsObj				=	new cms();
				if(!$this->getPageError())
					{
						if($cmsObj->insertCMS($dataIns))	
							{
								$this->setPageError("Inserted Successfully");
								$this->clearData("Savedata");
								$this->clearData("Addform");						
								return $this->executeAction(false,"Listing",true);
							}
						else
							{
								$this->setPageError($cmsObj->getPageError());
								$this->executeAction(true,"Addform",true);
							}
					}
			}
		public function contentManagementSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function contentManagementReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function contentManagementUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("files");
				if($data[fileImage][name])
					{
						$data		=	$this->getData("request");
						$id			=	$data["id"];
						$cms_obj	=	new cms();
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
				$cmsObj		=	new cms();
				$dataIns	=	$this->populateDbArray("vod_cms",$data);
				$dealObj	=	new deals();
				if($cmsObj->updateCMS($dataIns,$data["id"]))	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError($cmsObj->getPageError());
						$this->executeAction(false,"Editform",true,true);
					}	
			}
		public function contentManagementStauschange()
				{	
					$this->permissionCheck("Status");					
					$data		=	$this->getData("request");						
					if($this->statusChange("vod_cms",$data["id"]))
						{
							$this->setPageError("Status Changed Successfully");
							$this->clearData();											
							return $this->executeAction(false,"Listing",true,true,'','status,id');
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
