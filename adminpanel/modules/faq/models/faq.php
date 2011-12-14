<?php
/**************************************************************************************
Created by :Maria
Created on :2010-12-12
Purpose    :Faq
**************************************************************************************/
class faqModel extends modelclass
	{
		public function Listing()
			{
				$this->permissionCheck("View",1);
				$searchData	=	$this->getData("post","Search");
			//	print_r($searchData);exit;
				$sortData	=	$this->getData("request","Search");	
				$defaultObj	=	new faqModule();
				$searchCombo=	$this->get_combo_arr("sel_search_group", $defaultObj->getAllFaqGroup("1"), "id", "group", $searchData["sel_search_group"],"Any Group");
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"fg.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
					
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "fg.question", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "fg.answer", "%".$searchData["keyword"]."%")." or";
						$sqlCond	.=	$this->dbSearchCond("like", "f.group", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "fg.group_id", $searchData["sel_search_group"]);
					}
				$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
	
				 $sql		=	"select fg.*, f.group from ".constant("CONST_MODULE_FAQ_TABLE_SECTION")." as f, ".constant("CONST_MODULE_FAQ_TABLE_FAQ")." as fg
								 where 1 and fg.group_id=f.id  $sqlCond";
				$spage		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
				$arrcnt		=	-1;
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
		public function Addformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(array("action"=>"Addform","navigate"=>true,"sameParams"=>true));
			}
		public function Cancel()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
			}
		public function Reset()
			{
				$this->clearData("Search");
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
			}
		public function Search()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
			}
		public function Editform()
			{
				$this->permissionCheck("Edit",1);
				$data		=	$this->getData("get");
				$defaultObj	=	new faqModule();
				$dataArr	=	end($defaultObj->getFaqById($data["id"]));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				$dropDwon	=	$this->get_combo_arr("group_id",$defaultObj->getAllFaqGroup("1"),"id","group",$dataArr["group_id"],"valtype='emptyCheck-please select a group'");
				return array("data"=>$this->getHtmlData($dataArr),"faq_combo"=>$dropDwon);
			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$defaultObj	=	new faqModule();
				$dropDwon	=	$this->get_combo_arr("group_id",$defaultObj->getAllFaqGroup("1"),"id","group",$data["group_id"] ,"valtype='emptyCheck-please select a group'");
				return array("data"=>$data,"faq_combo"=>$dropDwon);
			}
		public function Stauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange(constant("CONST_MODULE_FAQ_TABLE_FAQ"),$data["id"]))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();		
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("post");
				$data['ip']	=	$_SERVER['REMOTE_ADDR'];
				$data		=	$this->getData("request","",false);
			//	$pre		=	new siteclass();
				$defaultObj	=	new faqModule();
				$data['preference']=$defaultObj->getMaxPreference(constant("CONST_MODULE_FAQ_TABLE_FAQ"));
			//	print_r($data['preference']);exit;
				$dataIns	=	$this->populateDbArray(constant("CONST_MODULE_FAQ_TABLE_FAQ"),$data);
				
				if($defaultObj->insertfaq($dataIns))	
					{
						$this->setPageError("Inserted Successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");
						$this->executeAction(array("action"=>"Listing","navigate"=>true));	
					}
				else
					{
						$this->setPageError($defaultObj->getPageError());
						$this->executeAction(true,"Addform",true);
					}	
			}
		public function Updatedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("request");
				
				$dataIns	=	$this->populateDbArray(constant("CONST_MODULE_FAQ_TABLE_FAQ"),$data);
				$defaultObj	=	new faqModule();
				if($defaultObj->updatefaq($dataIns,$data["id"]))	
					{
						$this->sortingRecords(constant("CONST_MODULE_FAQ_TABLE_FAQ"),$data["id"],$data["txtpreference"]);
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");	
						$this->executeAction(array("action"=>"Listing","navigate"=>true));					
						//return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError($defaultObj->getPageError());
						$this->executeAction(array("action"=>"Editform","navigate"=>true));
					//$this->executeAction(false,"Editform",true,true);
					}	
											
			}
		public function Delete()
			{
				if($this->permissionCheck("Delete",1))
					{
						$data		=	$this->getData("post");
						if($data["checkone"])	
							{
								 $this->db_delete_combo(constant("CONST_MODULE_FAQ_TABLE_FAQ"),"id",$data["checkone"]);
								$this->setPageError("Deleted Successfully");
								$this->executeAction(array("action"=>"Listing","navigate"=>true));	
							}
						else	$this->setPageError("No records selected");	
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
						//return $this->executeAction(false,"Listing",true,true);
					}
			}
		
	}
