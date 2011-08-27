<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :SubCategory Model Page
**************************************************************************************/
class subCategory extends modelclass
	{
		public function subCategoryListing() 
			{
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$dealObj	=	new deals();
				$searchCombo	=	$this->get_combo_arr("sel_search_group",$dealObj->getAllCategories("1"),"id","category",$searchData["sel_search_group"],"style='width:130px;","Any Category");
				if(!trim($sortData["sortField"]))
					{
							$this->addData(array("sortField"=>"vs.id"),"request","Search");
							$this->addData(array("sortMethod"=>"desc"),"request","Search");
							$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
				if(trim($searchData["keyword"]))
					{
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("like", "vc.category", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "vs.subcategory", "%".$searchData["keyword"]."%");
							$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
							$sqlCond	.=	" And ". $this->dbSearchCond("=", "vc.id ", $searchData["sel_search_group"]);
					}
				$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
			 	$sql		=	"SELECT  vs.*,vc.category	FROM  vod_category  vc,vod_category_sub vs where  
				vs.category_id =vc.id  $sqlCond";
				$spage		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)		$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function subCategoryReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function subCategorySearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function subCategoryAddformbtn()
			{
				$this->executeAction(false,"Addform",true,true);	
			}
		public function subCategoryCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function subCategoryEditform()
			{
				$this->permissionCheck("Edit",1);
				$data				=	$this->getData("get");
						$dealObj	=	new deals();
						$dataArr	=	end($dealObj->getAllSubCategories("id='".$data["id"]."'"));
						if(!$dataArr)
							{
								$this->setPageError("Invalid Id");
								$this->clearData();
								return $this->executeAction(false,"Listing",true);
							}
						$dropDwon	=	$this->get_combo_arr("category_id",$dealObj->getAllCategories("1"),"id","category",$dataArr["category_id"],"style='width:100px;' valtype='emptyCheck-please enter a Category'","select Category");
						return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr));
			}
		public function subCategoryAddform()
			{			
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$dealObj	=	new deals();
				$dropDwon	=	$this->get_combo_arr("category_id",$dealObj->getAllCategories("1"),"id","category",$data["category_id"],"style='width:100px;'valtype='emptyCheck-please enter a Subcategory'");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function subCategorySavedata()
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
				else
					{
						$this->setPageError("Please insert an image");
						$this->executeAction(true,"Addform",true);
					}	
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray("vod_category_sub",$data);
				$dataIns["preference"]			=	$this->getMaxPreference();
				$dealObj	=	new deals();
				if(!$this->getPageError())
					{
						if($dealObj->InsertSubCategory($dataIns))	
							{
							$this->setPageError("Inserted Successfully");
							$this->clearData("Savedata");
							$this->clearData("Addform");						
							return $this->executeAction(false,"Listing",true);
							}
						else
							{
							$this->setPageError($dealObj->getPageError());
							$this->executeAction(true,"Addform",true);
							}	
					}
				}
		public function subCategoryUpdatedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("files");
							
				if($data["fileImage"]["name"])
					{
						$data		=	$this->getData("request");
						$dealObj	=	new deals();
						$id			=	$data["id"];
						$details	=	$dealObj->getAllSubCategories("id=".$id);
						$image_path	=	$details[0][image];
						@unlink("../images/subcategory/".$image_path);
						@unlink("../images/subcategory/thumb/".$image_path);
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
						$adimg		=	$upObj->copy("fileImage","../images/subcategory",2);
						if($adimg)		
							{
								$upObj->img_resize("100","120","../images/subcategory/thumb");
								$upObj->img_resize("190","80","../images/subcategory/thumb190x80");	
							}
						else 			$this->setPageError($upObj->get_status());
						if($adimg)		$this->addData(array("image"=>$adimg),"request");
						else 			
						{
							$this->setPageError($upObj->get_status());
							$this->addData(array("image"=>$adimg),"request");
							$this->executeAction(false,"Editform",true,true);
						}
					}
			else
					{
						$this->setPageError("Please insert an image");
						$this->executeAction(true,"Addform",true);
					}
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray("vod_category_sub",$data);
				$dealObj	=	new deals();
				if($dealObj->updateSubCategory($dataIns,$data["id"]))	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError($dealObj->getPageError());
						$this->executeAction(false,"Editform",true,true);
					}	
			}
		public function subCategoryStauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");	
				if($this->statusChange("vod_category_sub",$data["id"],"status"))
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
