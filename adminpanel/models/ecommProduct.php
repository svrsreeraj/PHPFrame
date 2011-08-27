<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Ecomm Products Model Page
**************************************************************************************/
class ecommProduct extends modelclass
	{
		public function ecommProductListing()
			{
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$ecommObj		=	new ecommProducts();
				$searchCombo	=	$this->get_combo_arr("sel_search_group",$ecommObj->getAllEcommProductCategory("1"),"id","category",$searchData["sel_search_group"],"","Any Category");
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"pd.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "pd.product", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "pd.description", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("=", "pd.price", $searchData["keyword"]). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "p.category", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "pd.category_id ", $searchData["sel_search_group"]);
					}
				$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql		=	"SELECT  pd.*,p.category FROM  vod_ecomm_product pd, vod_ecomm_prodcategory p
								 where p.id=pd.category_id $sqlCond";
				$spage		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)		$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function ecommProductReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function ecommProductSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function ecommProductAddformbtn()
			{
				$this->permissionCheck("Add",1);
					{	
						$this->executeAction(false,"Addform",true,true);	
					}
			}
		public function ecommProductCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function ecommProductEditform()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$ecommObj	=	new ecommProducts();
				$dataArr	=	end($ecommObj->getAllEcommProducts("id='".$data["id"]."'"));
				if(!$dataArr)
					{
						
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$dropDwon	=	$this->get_combo_arr("category_id",$ecommObj->getAllEcommProductCategory("1"),"id","category",$dataArr["category_id"],"valtype='emptyCheck-please select a category'");						
				return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr));
			}
		public function ecommProductAddform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$this->clearData("Addform");						
				$ecommObj	=	new ecommProducts();
				$dropDwon	=	$this->get_combo_arr("category_id",$ecommObj->getAllEcommProductCategory("status=1"),"id","category",$data["category_id"],"style='width:100px;'valtype='emptyCheck-Please select a catogory' ");
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function ecommProductSavedata()
			{
				$this->permissionCheck("Add",1);
				$ecommObj	=	new ecommProducts();
				$data		=	$this->getData("files");
				if($data[fileImage][name])
					{
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
						$adimg		=	$upObj->copy("fileImage","../images/ecomProducts",2);
						if($adimg)		
							{
								$upObj->img_resize("100","120","../images/ecomProducts/thumb");
								$upObj->img_resize("186","196","../images/ecomProducts/thumb186x196");
								$upObj->img_resize("376","333","../images/ecomProducts/thumb376x333");
								$upObj->img_resize("47","50","../images/ecomProducts/thumb47x50");
							}
						else 			$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data		=	$this->getData("request");
				$data["balance_quantity"]	=	$data["total_quantity"];
				$dataIns	=	$this->populateDbArray("vod_ecomm_product",$data);
				if(!$this->getPageError())
					{
						if($ecommObj->insertEcommProduct($dataIns))	
							{
								$this->setPageError("Inserted Successfully");
								$this->clearData("Savedata");
								$this->clearData("Addform");						
								return $this->executeAction(false,"Listing",true);
							}
						else
							{
								$this->setPageError($ecommObj->getPageError());
								return $this->executeAction(true,"Addform",true,true);
							}	
					}
				else
					{
								$this->setPageError($ecommObj->getPageError());
								return $this->executeAction(true,"Addform",true,true);
					}
			}
		public function ecommProductStauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");	
				if($this->statusChange("vod_ecomm_product",$data["id"],"status"))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Editform",true,true);
					}
			}
		public function ecommProductUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$ecommObj	=	new ecommProducts();
				$data		=	$this->getData("files");
				if($data[fileImage][name])
					{	
							$data		=	$this->getData("request");
							$id			=	$data["id"];
							$dealObj	=	new deals();
							$details	=	$dealObj->getAllSubCategories("id=".$id);
							$image_path	=	$details[0][image];
							@unlink("../images/ecomProducts/".$image_path);
							@unlink("../images/ecomProducts/thumb/".$image_path);
							@unlink("../images/ecomProducts/thumb186x196/".$image_path);
							@unlink("../images/ecomProducts/thumb376x333/".$image_path);
							@unlink("../images/ecomProducts/thumb47x50/".$image_path);
							$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
							$adimg		=	$upObj->copy("fileImage","../images/ecomProducts",2);
							if($adimg)		
								{
									$upObj->img_resize("100","120","../images/ecomProducts/thumb");
									$upObj->img_resize("186","196","../images/ecomProducts/thumb186x196");
									$upObj->img_resize("376","333","../images/ecomProducts/thumb376x333");	
									$upObj->img_resize("47","50","../images/ecomProducts/thumb47x50");									
								}
							else 			$this->setPageError($upObj->get_status());
							$this->addData(array("image"=>$adimg),"request");
					}
				if(!$this->getPageError())
					{
						$adminUserObj	=	new ecommProducts();
						$data			=	$this->getData("request");
						$dataIns		=	$this->populateDbArray("vod_ecomm_product",$data);
						if($adminUserObj->updateEcommProduct($dataIns,$data["id"]))	
							{
								$this->setPageError("Updated Successfully");
								$this->clearData();
								$this->clearData("Editform");						
								return $this->executeAction(false,"Listing",true,true);
							}
						else
							{
								$this->setPageError($adminUserObj->getPageError());
								$this->executeAction(false,"Editform",true,true);
							}

					}
				else
					{
						$adminUserObj	=	new ecommProducts();
						$this->setPageError($adminUserObj->getPageError());
						$this->executeAction(false,"Editform",true,true);
					}
					
			}
		public function redirectAction($errMessage,$action,$url="")	
			{
				$this->setPageError($errMessage);
				$this->executeAction(true,$action,$url);	
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
