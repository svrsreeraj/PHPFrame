<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-12-02
Purpose		:	Manage Customer Sitecredits
************************************************************************* ***************/
class customerSiteCredit extends modelclass
	{
		public function customerSiteCreditListing()
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
							$sqlCond	.=	$this->dbSearchCond("like", "concat(b.fname,' ',b.lname)", "%".$searchData["keyword"]."%");
							$sqlCond	.=	") ";
						}
				if(trim($searchData["txt_date_from"]))
						{
							$sqlCond	.=	"and ".$this->dbSearchCond(">=", "date(a.date_added)",$searchData["txt_date_from"]);
						}
				if(trim($searchData["txt_date_to"]))
						{
							$sqlCond	.=	"and ".$this->dbSearchCond("<=", "date(a.date_added)",$searchData["txt_date_to"]);
						}
				if(trim($searchData["cusId"]))
						{
							$sqlCond	.=	" And(".$this->dbSearchCond("=", "a.customer_id",$searchData["cusId"])." or ".$this->dbSearchCond("=", "b.email",$searchData["cusId"]);
							$sqlCond	.=	") ";
						}
				if($sortData["sortField"]	==	"fullname" || $sortData["sortField"]	==	"action" )
				$sqlCond			.=	" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				else
				$sqlCond			.=	"order by a.".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				 =	"select a . * ,concat(b.fname,' ',b.lname) as fullname,b.email from vod_customer_sitepoint_trans as a, vod_customer as b where a.customer_id = b.id $sqlCond";
				$this->addData(array("sql"=>$sql),"post");
				$spage				 =	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				 =	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				$searchData			 =	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;				
				foreach($data	as $key=>$val)
					{
						$creditPopUp					=	$this->getPopUpTable(array("Deal CouponId","Ecom OrderId","Points","Credits"),array(array($val['dealcoupon_id'],$val['ecomm_orderid'],$val['paid_point'],"$".$val['used_credit'])),"300");
						$data[$key]["creditPopUp"]		=	$creditPopUp;
					}
				$sql1				=	"select sum(b.total_points) as total,sum(b.used_points) as used,sum(b.balance_points) as balance from vod_customer_sitepoint_trans as a, vod_customer as b where a.customer_id = b.id $sqlCond";
				$data_all			=	end($this->getdbcontents_sql($sql1));
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"headname"=>$data[0]['fullname'],"result"=>$data_all);
			}
		public function customerSitecreditGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false); 
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('CUSTOMER NAME','USED CREDIT','USED DATE');
						$fieldArr		=	array('fullname','used_credit','date_added');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"CustomersiteCreditList");						
					}
			}	
		public function customerSiteCreditCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function customerSiteCreditReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function customerSiteCreditSearch()
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
