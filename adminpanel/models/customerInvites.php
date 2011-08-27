<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-11-30
Purpose		:	Manage Customer Referals
****************************************************************************************/
class customerInvites extends modelclass
	{
		public function customerInvitesListing()
			{
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$customerObj	=	new customer;
				$dealObj		=	new deals();
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				if(trim($searchData["keyword"]))
						{
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("like", "concat(b.fname,' ',b.lname)", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "a.invite_email", "%".$searchData["keyword"]."%");
							$sqlCond	.=	") ";
						}
				if(trim($searchData["txt_date_from"]))
						{
							$sqlCond	.=	"and ".$this->dbSearchCond(">=", "date(a.date_added)",$searchData["txt_date_from"]);
						}
				if(trim($searchData["txt_date_to"]))
						{
							$sqlCond	.="and ".$this->dbSearchCond("<=", "date(a.date_added)",$searchData["txt_date_to"]);
						}
				if( $searchData["sel_status"] != "")
						{	
							if($searchData["sel_status"]	==	1) $status	= 1; else $status	= 0;
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("=", "a.join_status", $status);
							$sqlCond	.=	") ";
						}
				if(trim($searchData["cusId"]))
						{
							$sqlCond	.=	" And(".$this->dbSearchCond("=", "a.customer_id",$searchData["cusId"])." or ".$this->dbSearchCond("=", "a.invite_email",$searchData["cusId"]);
							$sqlCond	.=	") ";
						}
				if($sortData["sortField"]	==	"fullname")
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				else
				$sqlCond			.=	"order by a.".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				 =	"select a . * ,concat(b.fname,' ',b.lname) as fullname from`vod_customer_invites` as a, vod_customer as b where a.customer_id = b.id $sqlCond";
				$this->addData(array("sql"=>$sql),"post");
				$spage				 =	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				 =	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				$searchData			 =	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"headname"=>$data[0]['fullname']);
			}
		public function customerInvitesGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false); 
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('NAME','INVITE EMAIL','JOIN STATUS','ADDED DATE');
						$fieldArr		=	array('fullname','invite_email','join_status','date_added');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"customerInvitesList");						
					}
			}	
	
		public function customerInvitesCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function customerInvitesReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function customerInvitesSearch()
			{
				$this->executeAction(false,"Listing",true);
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
