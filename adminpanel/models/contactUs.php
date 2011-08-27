<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-22
Purpose    :Contact us  Page
**************************************************************************************/
class contactUs extends modelclass
	{
		
		public function contactUsListing()
			{
				if($this->permissionCheck("View",1))
					{	
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
							$sqlCond	.=	$this->dbSearchCond("like", "name", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "email", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "subject", "%".$searchData["keyword"]."%");
							$sqlCond	.=	") ";
						}
						$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
						$sql		=	"select * from 	vod_contactus where 1  $sqlCond";
						$spage		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
						$data		=	$this->getdbcontents_sql($spage->finalSql());
						if(!$data)		$this->setPageError("No records found !");
						$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
						$searchData["searchCombo"]	=	$searchCombo; 
						$searchData["sortData"]		=	$sortData;
						
						return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
					}
				else return false;
			}	
		public function contactUsReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}	
		public function contactUsSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function contactUsCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function contactUsEditform()
			{
				if($this->permissionCheck("Reply",1))
					{	
						$data		=	$this->getData("get");
						$contactObj	=	new contact();
						$dataArr	=	end($contactObj->getAllcontacts("id='".$data["id"]."'"));
						if(!$dataArr)
							{
								$this->setPageError("Invalid data");
								$this->clearData();
								return $this->executeAction(false,"Listing",true);
							}
						return array("combo"=>$dropDwon,"data"=>$this->getHtmlData($dataArr));
					}
			}
		public function contactUsSenddata()
			{
				if($this->permissionCheck("Reply"))
					{	
						$contactObj	=	new contact();
						$data		=	$this->getData("request");
						$dataIns	=	$this->populateDbArray("vod_contactus",$data);
						if($contactObj->updatecontactUs($dataIns,$data["id"]))	
							{
								$from		=	GLB_SITE_EMAIL;
								$cmsObj		=	new cms();
								$dataArry	=	end($contactObj->getAllcontacts($this->dbSearchCond("=", "id",$data["id"])));
								$to			=	$dataArry["email"];
								$subject	=	"Re-".$dataArry["subject"];
								
								$varArr							=	array();
								$varArr["{TPL_NAME}"]			=	$dataArry['name'];
								$varArr["{TPL_REPLY_MESSAGE}"]	=	$dataArry["reply_message"];
								$varArr["{TPL_ORGINAL_MESSAGE}"]=	$dataArry['message'];
								$send							=	$cmsObj->sendMailCMS("15",$to,$from,$subject,$varArr,5); 
								$this->setPageError("Mail Sent Successfully");
								$this->clearData("Editform");						
								return $this->executeAction(false,"Listing",true,true);
							}
						else
							{
								$this->setPageError($contactObj->getPageError());
								$this->executeAction(false,"Editform",true,true);
							}
					}
				else return $this->executeAction(false,"Listing",true);	
				
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
