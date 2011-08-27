<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Category Managing Section
**************************************************************************************/
class category extends modelclass
	{
		public function categoryListing()
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
						$sqlCond	.=	$this->dbSearchCond("like", "category", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "usertype", $searchData["sel_search_group"]);
					}
				$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql		=	"select * from 	vod_category where 1  $sqlCond";
				$spage		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)		$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function categoryReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function categorySearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function categoryAddformbtn()
			{
				$this->executeAction(false,"Addform",true,true);	
			}
		public function categoryCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function categoryEditform()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$dealObj	=	new deals();
				$dataArr	=	end($dealObj->getAllCategories("id='".$data["id"]."'"));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
					return array("data"=>$dataArr);
			}
		public function categoryAddform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$dealObj	=	new deals();
			}
		public function categorySavedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("files");
				if($data[fileImage][name])
					{
							$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
							$adimg		=	$upObj->copy("fileImage","../images/category",2);
							if($adimg)		
								{
									$upObj->img_resize("100","120","../images/category/thumb");
									$upObj->img_resize("190","80","../images/category/thumb190x80");
								}
							else 			$this->setPageError($upObj->get_status());
							$this->addData(array("image"=>$adimg),"request");
					}
				else
					{
						$this->setPageError("Please insert an image");
						$this->executeAction(true,"Addform",true);
					}
				$data				=	$this->getData("request");
				$dataIns			=	$this->populateDbArray("vod_category",$data);
				$dataIns["preference"]			=	$this->getMaxPreference();
				$dealObj			=	new deals();
				if(!$this->getPageError())
					{
						if($dealObj->InsertCategory($dataIns))	
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
		public function categoryUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("files");
				$dealObj	=	new deals();
				if($data["fileImage"]["name"])
					{
						$data		=	$this->getData("request");
						$id=$data["id"];
						$details=$dealObj->getAllCategories("id=".$id);
						$image_path=$details[0][image];
						@unlink("../images/category/".$image_path);
						@unlink("../images/category/thumb/".$image_path);
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
						$adimg		=	$upObj->copy("fileImage","../images/category",2);
						if($adimg)		
							{
								$upObj->img_resize("100","120","../images/category/thumb");
								$upObj->img_resize("190","80","../images/category/thumb190x80");	
							}
						else 			$this->setPageError($upObj->get_status());
						if($adimg)		$this->addData(array("image"=>$adimg),"request");
					}
				$data			=	$this->getData("request");
				$dataIns		=	$this->populateDbArray("vod_category",$data);
				if($dealObj->updateCategory($dataIns,$data["id"]))	
					{
						$this->sortingRecords("vod_category ",$data["id"],$data["txtpreference"]);
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
		public function categoryStauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");	
				if($this->statusChange("vod_category",$data["id"],"status"))
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
