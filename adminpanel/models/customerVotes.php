<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-12-03
Purpose		:	Manage Customer Sitecredits
****************************************************************************************/
class customerVotes extends modelclass
	{
		public function customerVotesListing()
			{
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$customerObj	=	new customer;
				$dealObj		=	new deals();
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"cv.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				if(trim($searchData["cusId"]))
						{
							$sqlCond	.=	" And(".$this->dbSearchCond("=", "cv.customer_id",$searchData["cusId"])." or ".$this->dbSearchCond("like", "cu.email", "%".$searchData["cusId"]."%");
							$sqlCond	.=	") ";
						}
				if(trim($searchData["keyword"]))
						{
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("like", "concat(cu.fname,' ',cu.lname)", "%".trim($searchData["keyword"])."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "cd.name", "%".trim($searchData["keyword"])."%");
							$sqlCond	.=	") ";
						}
				if(trim($searchData["txt_date_from"]))
						{
							$sqlCond	.=	"and ".$this->dbSearchCond(">=", "date(cv.date_added)",$searchData["txt_date_from"]);
						}
				if(trim($searchData["txt_date_to"]))
						{
							$sqlCond	.=	"and".$this->dbSearchCond("<=", "date(cv.date_added)",$searchData["txt_date_to"]);
						}
				if($searchData["sel_paid_status"]!= 0)
						{
							if($searchData["sel_paid_status"]	==	1) $status	=1; else $status	=	0;	
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("=", "co.paid_status", $status);
							$sqlCond	.=	") ";
						}
				if($searchData["sel_redeem_status"]!= 0)
						{	
							if($searchData["sel_redeem_status"]	==	1) $status	=1; else $status	=	0;	
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("=", "co.redeem_status", $status);
							$sqlCond	.=	") ";
						}
							$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql					 =	"select concat(cu.fname,' ',cu.lname) as fullname,cu.email,cd.name,cv.*
											from vod_customer_votes as cv
											join vod_customer as cu on cu.id=cv.customer_id
											left join vod_deal_order as co on co.deal_id=cv.deal_id and co.customer_id=cv.customer_id
											join vod_deal as cd on cd.id = cv. deal_id where 1 $sqlCond";
				$this->addData(array("sql"=>$sql),"post");
				$spage				 =	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				 =	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				$searchData			 =	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				foreach($data	as $key=>$val)
					{
						$dealPopUp			=	$this->getPopUpTable(array("Quantity","Unit Price","Total Amount"),array(array($val['quantity'],$val['unit_price'],$val['total_amount'])),"300");
						$paymntStatusPopUp	=	$this->getPopUpTable(array("Payed Status","Redeem Status","paid Date","Order Date","Redeem Date"), array($val['paid_status'],$val['redeem_status'],$val['orderDate'],$val['orderDate'].$val['redeem_date']),"300");
						$data[$key]["dealPopUp"]			=	$dealPopUp;
						$data[$key]["paymntStatusPopUp"]	=	$paymntStatusPopUp;
					}
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"headname"=>$data[0]['fullname'],"count"=>$spage->totcnt);
			}
		public function customerVotesGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false); 
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('CUSTOMER NAME','DEAL NAME','VOTED DATE');
						$fieldArr		=	array('fullname','name','date_added');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"CustomersiteCreditList");						
					}
			}	
		public function customerVotesCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function customerVotesReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function customerVotesSearch()
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
