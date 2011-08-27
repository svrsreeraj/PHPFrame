<?php
/**************************************************************************************
Created by 		:	Jitha
Created on 		:	2010-12-30
Purpose    		:	Managing cron for Bulk emails
**************************************************************************************/
class bulkEmailSend extends modelclass
	{
		public function bulkEmailSendListing()
			{
				$this->permissionCheck("view",1);
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$emailtempobj		=	new emailTemplate();
				$tempcategoryCombo	=	$this->get_combo_arr("template_id", $emailtempobj->getAllEmailTemplateCategories("1"), "id", "category", '',"");

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
				if(trim($searchData["template_id"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "v1.template_id", $searchData["template_id"]);
					}
					
				$sqlCond					.=	"order by v1.".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql						=	"SELECT v1.id, v3.category as template_cat, v2.title, 
													v1.email_cat_id as email_cat_id, v1.total_send,
												v4.category as email_cat , 	v1.active_cron
												FROM `vod_bulk_email_cron` v1 
												JOIN vod_bulk_email_tpl v2 ON v1.template_id = v2.id left
												JOIN vod_bulk_email_tpl_category v3 ON v3.id = v2.temp_cat_id 
												JOIN vod_bulk_email_category v4 ON v1.email_cat_id = v4.id where 1 $sqlCond";
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage						=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data						=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)		$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["sortData"]		=	$sortData;
				$searchData["searchCombo"]	=	$tempcategoryCombo;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
			
		public function bulkEmailSendSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
			
		public function bulkEmailSendReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true);
			}
			
		public function bulkEmailSendCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
			
		public function bulkEmailSendAddformbtn()
			{
				$this->executeAction(false,"Addform",true,true);
			}
			
		public function bulkEmailSendGetcombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$emailtempobj		=	new emailTemplate();
				echo $this->get_combo_arr("template_id",$emailtempobj->getAllEmailTemplates("temp_cat_id ='".$data["id"]."' and status='1'"),"id","title",$dataArr["subcategory_id"],"id=\"template_idId\"  valtype=\"emptyCheck-please select the template\" style=\"width:130px;\"");
				exit;
			}

		public function bulkEmailSendAddform()
			{
				$this->permissionCheck("Add",1);
				$emailtempobj		=	new emailTemplate();
								
				$emailcategoryCombo	=	$this->get_combo_arr("email_cat_id", $emailtempobj->getAllEmailCategories("1"), "id", "category", '',"valtype='emptyCheck-please select an email category'");
				
				$tempcategoryCombo	=	$this->get_combo_arr("id", $emailtempobj->getAllEmailTemplateCategories("1"), "id", "category","", "onchange=\"getcombo(this.value,'subDivId');\" id=\"email_cat_idId\" valtype=\"emptyCheck-please select the template category\" style=\"width:130px;\"");
				
				$subtempcategoryCombo	=	$this->get_combo_arr("template_id", "", "id", "category","", "valtype=\"emptyCheck-please select the template\" style=\"width:130px;\"");
				
				$data				=	$this->getHtmlData($this->getData("post","Addform",false));
				$data['catcombo']	=	$emailcategoryCombo;
				$data['tempcatcombo']	=	$tempcategoryCombo;
				$data['tempcombo']	=	$subtempcategoryCombo;
				return array("data"=>$data);
			}
			
		public function bulkEmailSendSavedata()
			{
				$this->permissionCheck("Add",1);
				$data				=	$this->getData("request");
				$dataIns			=	$this->populateDbArray("vod_bulk_email_cron",$data);
				$emailtempobj		=	new emailTemplate();
				if(!$this->getPageError())
					{
						if($emailtempobj->InsertEmailCron($dataIns))	
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
			
		public function bulkEmailSendStatuschange()
			{	
				$this->permissionCheck("Status",1);					
				$data				=	$this->getData("request");
				$emailtempobj		=	new emailTemplate();
				$statusAll			=	$emailtempobj->StatusChangeAll("vod_bulk_email_cron",$data["id"],"active_cron");
				if($this->statusChange("vod_bulk_email_cron",$data["id"],"active_cron"))
					{
					
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','status,id');
					}
			}
			
		public function bulkEmailSendEditform()
			{
				$this->permissionCheck("Edit",1);
				$data					=	$this->getData("get");
				$emailtempobj			=	new emailTemplate();
				$dataArr				=	end($emailtempobj->getAllEmailCron("id='".$data["id"]."'"));
				
				$tempArr				=	end($emailtempobj->getAllEmailTemplates("id='".$dataArr["template_id"]."'"));
				$emailcategoryCombo	=	$this->get_combo_arr("email_cat_id", $emailtempobj->getAllEmailCategories("1"), "id", "category", $dataArr['email_cat_id'],"valtype='emptyCheck-please select the email category'");
				
				$tempcategoryCombo	=	$this->get_combo_arr("tempid", $emailtempobj->getAllEmailTemplateCategories("1"), "id", "category",$tempArr['temp_cat_id'], "onchange=\"getcombo(this.value,'subDivId');\" id=\"email_cat_idId\" valtype=\"emptyCheck-please select the template category\" style=\"width:130px;\"");

				$subtempcategoryCombo	=	$this->get_combo_arr("template_id", $emailtempobj->getAllEmailTemplates("temp_cat_id ='".$tempArr['temp_cat_id']."' and status='1'"), "id", "title",$dataArr['template_id'], "valtype=\"emptyCheck-please select the template\" style=\"width:130px;\"");
				
				$dataArr['catcombo']	=	$emailcategoryCombo;
				$dataArr['tempcatcombo']=	$tempcategoryCombo;
				$dataArr['tempcombo']	=	$subtempcategoryCombo;

				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
					return array("data"=>$dataArr);
			}
			
		public function bulkEmailSendUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$emailtempobj	=	new emailTemplate();
				$data			=	$this->getData("request");
				$dataIns		=	$this->populateDbArray("vod_bulk_email_cron",$data);
				if($emailtempobj->updateEmailCron($dataIns,$data["id"]))	
					{
						$this->sortingRecords("vod_bulk_email_cron",$data["id"],$data["txtpreference"]);
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

			
		public function bulkEmailSendGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('TEMPLATE CATEGORY','TEMPLATE','EMAIL CATEGORY');
						$fieldArr		=	array('template_cat','title','email_cat');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"Cronlist");						
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