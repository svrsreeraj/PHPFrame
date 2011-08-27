<?php
/**************************************************************************************
Created by 		:	Jitha
Created on 		:	2010-12-30
Purpose    		:	Bulk email templates managing
**************************************************************************************/
class bulkEmailTemplate extends modelclass
	{
		public function bulkEmailTemplateListing()
			{
				$this->permissionCheck("view",1);
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$emailtempobj		=	new emailTemplate();
				$tempcategoryCombo	=	$this->get_combo_arr("temp_cat_id", $emailtempobj->getAllEmailTemplateCategories("1"), "id", "category", '',"");

				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "title", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "template", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["temp_cat_id"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "temp_cat_id", $searchData["temp_cat_id"]);
					}
					
				$sqlCond					.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql						=	"select * from 	vod_bulk_email_tpl where 1  $sqlCond";
				$spage						=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data						=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)		$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["sortData"]		=	$sortData;
				$searchData["searchCombo"]	=	$tempcategoryCombo;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
			
		public function bulkEmailTemplateSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
			
		public function bulkEmailTemplateReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true);
			}
			
		public function bulkEmailTemplateCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
			
		public function bulkEmailTemplateAddformbtn()
			{
				$this->executeAction(false,"Addform",true,true);
			}
			
		public function bulkEmailTemplateAddform()
			{
				$this->permissionCheck("Add",1);
				$emailtempobj		=	new emailTemplate();
				$tempcategoryCombo	=	$this->get_combo_arr("temp_cat_id", $emailtempobj->getAllEmailTemplateCategories("1"), "id", "category", '',"valtype='emptyCheck-please select a category'");
				$data				=	$this->getHtmlData($this->getData("post","Addform",false));
				$data['tempcombo']	=	$tempcategoryCombo;
				return array("data"=>$data);
			}
			
		public function bulkEmailTemplateSavedata()
			{
				$this->permissionCheck("Add",1);
				$data				=	$this->getData("request");
				$dataIns			=	$this->populateDbArray("vod_bulk_email_tpl",$data);
				$emailtempobj		=	new emailTemplate();
				if(!$this->getPageError())
					{
						if($emailtempobj->InsertEmailTemplates($dataIns))	
							{
								$this->setPageError("Inserted Successfully");
								$this->clearData("Savedata");
								$this->clearData("Addform");						
								return $this->executeAction(false,"Listing",true);
							}
						else
							{
								$this->setPageError("Some error occured during insertion");
								$this->executeAction(true,"Addform",true);
							}	
					}
			}
			
		public function bulkEmailTemplateEditform()
			{
				$this->permissionCheck("Edit",1);
				$data					=	$this->getData("get");
				$emailtempobj			=	new emailTemplate();
				$dataArr				=	end($emailtempobj->getAllEmailTemplates("id='".$data["id"]."'"));
				$tempcategoryCombo		=	$this->get_combo_arr("temp_cat_id", $emailtempobj->getAllEmailTemplateCategories("1"), "id", "category", $dataArr['temp_cat_id'],"valtype='emptyCheck-please select a category'");
				$dataArr['tempcombo']	=	$tempcategoryCombo;
				
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
					return array("data"=>$dataArr);
			}
			
		public function bulkEmailTemplateUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$emailtempobj	=	new emailTemplate();
				$data			=	$this->getData("request");
				$dataIns		=	$this->populateDbArray("vod_bulk_email_tpl",$data);
				if($emailtempobj->updateEmailTemplate($dataIns,$data["id"]))	
					{
						$this->sortingRecords("vod_bulk_email_tpl ",$data["id"],$data["txtpreference"]);
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError("Some error occured during updation");
						$this->executeAction(false,"Editform",true,true);
					}
			}
			
		public function bulkEmailTemplateStatuschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");	
				if($this->statusChange("vod_bulk_email_tpl",$data["id"],"status"))
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
?>