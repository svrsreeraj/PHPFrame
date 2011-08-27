<?php
/**************************************************************************************
Created by 		:	Jitha
Created on 		:	2010-12-29
Purpose    		:	Bulk email managing
**************************************************************************************/
class bulkEmail extends modelclass
	{
		public function bulkEmailListing()
			{
				$this->permissionCheck("view",1);
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "v1.email", "%".$searchData["keyword"]."%")." or";
						$sqlCond	.=	$this->dbSearchCond("like", "v1.name", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "usertype", $searchData["sel_search_group"]);
					}
					
				$sqlCond					.=	"order by v1.".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql						=	"select v1.*,v2.category from vod_bulk_email v1 
												join vod_bulk_email_category v2 on v1.email_cat_id=v2.id where 1  $sqlCond";
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage						=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data						=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)		$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["sortData"]		=	$sortData;
				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
			
		public function bulkEmailGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('EMAIL CATEGORY','NAME','EMAIL');
						$fieldArr		=	array('category','name','email');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"BulkEmails");						
					}
			}
			
		public function bulkEmailUploadcsv()
			{
				$this->executeAction(false,"Uploadform",true,true);
			}
		
		public function bulkEmailUploadform()
			{
				$emailtempobj		=	new emailTemplate();
				$emailcategoryCombo	=	$this->get_combo_arr("email_cat_id", $emailtempobj->getAllEmailCategories("1"), "id", "category", '',"valtype='emptyCheck-please select a category'");
				$data				=	$this->getHtmlData($this->getData("post","Addform",false));
				$data['emailcombo']	=	$emailcategoryCombo;
				return array("data"=>$data);
			}
			
		public function bulkEmailUploaddata()
			{
				$data			=	$this->getData("files");
				$dataForm		=	$this->getData("request","",false);
				$name			=	$dataForm['nameIndex'];
				$email			=	$dataForm['emailIndex'];
				$emailtempobj	=	new emailTemplate();
				$checkCsv		=	$emailtempobj->checkCsvExt($data[fileCsv][name]);
				if($checkCsv==1)
					{
						$file		=	$data[fileCsv][tmp_name];
						$fp 		= 	fopen("$file", "r");
						while (($csv = fgetcsv($fp, 1000, ",")) !== FALSE)
							{
								$status			=	$this->getdbcount_cond('vod_bulk_email',"email like '%".$csv[$email]."%' and email_cat_id = ".$dataForm['email_cat_id']);
								if($this->validateEmail($csv[$email]))
									{
										if($status<=0)
										{
											$emailCatId		=	$this->checkfields('vod_bulk_email_category','category',$csv[0],'id');
											$fieldArr		=	array("email_cat_id","name","email","date_added");
											$valueArr		=	array($dataForm['email_cat_id'],$csv[$name],$csv[$email],date("Y-m-d H:i:s"));
											$dataArr		=	$emailtempobj->setArray($fieldArr,$valueArr);
											$insert			=	$this->db_insert('vod_bulk_email',$dataArr);
										}
									}
							}
						fclose($fp);
						$this->setPageError("Uploaded Successfully");
						$this->clearData("Uploaddata");
						$this->clearData("Uploadform");						
						return $this->executeAction(false,"Listing",true);
					}
				else
					{
						$this->setPageError("File Format is Invalid");
						$this->executeAction(true,"Uploadform",true);
					}
			}
		
		public function bulkEmailSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
			
		public function bulkEmailReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true);
			}
			
		public function bulkEmailCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
			
		public function bulkEmailAddformbtn()
			{
				$this->executeAction(false,"Addform",true,true);
			}
			
		public function bulkEmailAddform()
			{
				$this->permissionCheck("Add",1);
				$emailtempobj		=	new emailTemplate();
				$emailcategoryCombo	=	$this->get_combo_arr("email_cat_id", $emailtempobj->getAllEmailCategories("1"), "id", "category", '',"valtype='emptyCheck-please select a category'");
				$data				=	$this->getHtmlData($this->getData("post","Addform",false));
				$data['catcombo']	=	$emailcategoryCombo;
				return array("data"=>$data);
			}
			
		public function bulkEmailSavedata()
			{
				$this->permissionCheck("Add",1);
				$data				=	$this->getData("request");
				$dataIns			=	$this->populateDbArray("vod_bulk_email",$data);
				$emailtempobj		=	new emailTemplate();
				if(!$this->getPageError())
					{
						if($emailtempobj->InsertCategoryEmails($dataIns))	
							{
								$this->setPageError("Inserted Successfully");
								$this->clearData("Savedata");
								$this->clearData("Addform");						
								return $this->executeAction(false,"Listing",true);
							}
						else
							{
								$this->setPageError("Email already existing");
								$this->executeAction(true,"Addform",true);
							}	
					}
			}
			
		public function bulkEmailEditform()
			{
				$this->permissionCheck("Edit",1);
				$data					=	$this->getData("get");
				$emailtempobj			=	new emailTemplate();
				$dataArr				=	end($emailtempobj->getAllEmails("id='".$data["id"]."'"));
				$emailcategoryCombo		=	$this->get_combo_arr("email_cat_id", $emailtempobj->getAllEmailCategories("1"), "id", "category", $dataArr['email_cat_id'],"valtype='emptyCheck-please select a category'");
				$dataArr['catcombo']	=	$emailcategoryCombo;
				
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
					return array("data"=>$dataArr);
			}
			
		public function bulkEmailUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$emailtempobj	=	new emailTemplate();
				$data			=	$this->getData("request");
				$dataIns		=	$this->populateDbArray("vod_bulk_email",$data);
				if($emailtempobj->updateEmail($dataIns,$data["id"]))	
					{
						$this->sortingRecords("vod_bulk_email ",$data["id"],$data["txtpreference"]);
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
					
						$this->setPageError("Some error occured durinn updation");
						$this->executeAction(false,"Editform",true,true);
					}
			}
			
		public function bulkEmailStatuschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");	
				if($this->statusChange("vod_bulk_email",$data["id"],"status"))
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