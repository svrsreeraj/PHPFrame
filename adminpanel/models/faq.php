<?php
/**************************************************************************************
Created by :hari krishna s
Created on :2010-11-16
Purpose    :faq
**************************************************************************************/
class faq extends modelclass
	{
		public function faqListing()
			{
				$this->permissionCheck("View",1);
				$searchData	=	$this->getData("post","Search");
				$sortData	=	$this->getData("request","Search");	
				$defaultObj	=	new faq_class();
				$searchCombo=	$this->get_combo_arr("sel_search_group", $defaultObj->getAllFaqGroups("1"), "id", "group", $searchData["sel_search_group"],"Any Group");
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"f.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
					
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "f.question", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "f.answer", "%".$searchData["keyword"]."%")." or";
						$sqlCond	.=	$this->dbSearchCond("like", "fg.group", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "f.group_id", $searchData["sel_search_group"]);
					}
				$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql		=	"select f.*, fg.group from vod_faq as f, vod_faq_group as fg
								 where 1 and f.group_id=fg.id  $sqlCond";
				$spage		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
				$arrcnt				=	-1;
				foreach($data as $key=>$value)
						{
							foreach($value as $innerkey=>$description)
								{
									$temp[$innerkey]		=	strip_tags($description);
								}
							$data[$key]				=		$temp;
						}
				$links		=	$spage->s_get_links();
				if(!$data)	$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function faqAddformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(false,"Addform",true,true);
			}
		public function faqCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function faqReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function faqSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function faqEditform()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$defaultObj	=	new faq_class();
				$dataArr	=	end($defaultObj->getFaqById($data["id"]));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$dropDwon	=	$this->get_combo_arr("group_id",$defaultObj->getAllFaqGroups("1"),"id","group",$dataArr["group_id"],"valtype='emptyCheck-please select a group'");
				return array("data"=>$this->getHtmlData($dataArr),"faq_combo"=>$dropDwon);
			}
		public function faqAddform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$defaultObj	=	new faq_class();
				$dropDwon	=	$this->get_combo_arr("group_id",$defaultObj->getAllFaqGroups("1"),"id","group",$data["group_id"] ,"valtype='emptyCheck-please select a group'");
				return array("data"=>$data,"faq_combo"=>$dropDwon);
			}
		public function faqStauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange("vod_faq",$data["id"]))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','status,id');
					}
			}
		public function faqSavedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("post");
				$data['ip']	=	$_SERVER['REMOTE_ADDR'];
				$pre=new siteclass();
				$data['preference']=$pre->getMaxPreference('vod_faq');
				$dataIns	=	$this->populateDbArray("vod_faq",$data);
				$defaultObj	=	new faq_class();
				if($defaultObj->insertfaq($dataIns))	
					{
						$this->setPageError("Inserted Successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
						return $this->executeAction(false,"Listing",true);
					}
				else
					{
						$this->setPageError($defaultObj->getPageError());
						$this->executeAction(true,"Addform",true);
					}	
			}
		public function faqUpdatedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("request");
				
				$dataIns	=	$this->populateDbArray("vod_faq",$data);
				$defaultObj	=	new faq_class();
				if($defaultObj->updatefaq($dataIns,$data["id"]))	
					{
						$this->sortingRecords("vod_faq",$data["id"],$data["txtpreference"]);
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError($defaultObj->getPageError());
						$this->executeAction(false,"Editform",true,true);
					}	
											
			}
		public function faqDelete()
			{
				if($this->permissionCheck("Delete",1))
					{
						$data		=	$this->getData("post");
						if($data["checkone"])	
							{
								$this->db_delete_combo("vod_faq","id",$data["checkone"]);
								$this->setPageError("Deleted Successfully");
							}
						else	$this->setPageError("No records selected");	
						return $this->executeAction(false,"Listing",true,true);
					}
			}
		public function __construct()
			{
				$this->setClassName();
			}
		public function executeAction($loadData=true,$action="",$navigate=false,$sameParams=false,$newParams="",$excludParams="",$page="")
			{
				if(trim($action))	$this->setAction($action);//forced action
				$methodName	=	(method_exists($this,$this->getMethodName()))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
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
