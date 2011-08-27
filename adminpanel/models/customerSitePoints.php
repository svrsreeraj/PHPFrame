<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-12-02
Purpose		:	Manage Customer SitePoints
****************************************************************************************/
class customerSitePoints extends modelclass
	{
		public function customerSitePointsListing()
			{
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$customerObj	=	new customer;
				$dealObj		=	new deals();
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"sp.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				if(trim($searchData["keyword"]))
						{
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("like", "concat(cu.fname,' ',cu.lname)", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "sa.action", "%".$searchData["keyword"]."%")."or";
							$sqlCond	.=	$this->dbSearchCond("like", "d.name", "%".$searchData["keyword"]."%");
							$sqlCond	.=	") ";
						}
				if(trim($searchData["txt_date_from"]))
						{
							$sqlCond	.=	"and ".$this->dbSearchCond(">=", "date(sp.date_added)",$searchData["txt_date_from"]);
						}
				if(trim($searchData["txt_date_to"]))	
						{	
							$sqlCond	.=	"and".$this->dbSearchCond("<=", "date(sp.date_added)",$searchData["txt_date_to"]);
						}
						
				if(trim($searchData["action_id"]))
						{	
							$status		 =	$searchData["action_id"];
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("=", "sp.action_id", $status);
							$sqlCond	.=	") ";
						}
				if(trim($searchData["cusId"]))
						{
							$sqlCond	.=	" And(".$this->dbSearchCond("=", "sp.customer_id",$searchData["cusId"])." or ".$this->dbSearchCond("=", "cu.email",$searchData["cusId"]);
							$sqlCond	.=	") ";
						}
				if($sortData["sortField"]	==	"fullname" || $sortData["sortField"]	==	"action" )
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				else
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				 =	"select sp.*,concat(cu.fname,' ',cu.lname) as fullname,
										cu.total_points,cu.used_points, 			 										 	    									cu.balance_points,sa.action,d.name from
 										vod_customer_sitepoints as sp
 										join vod_customer as cu on sp.customer_id=cu.id
										join vod_sitepoint_action as sa on sa.id=sp.action_id
										left join vod_deal as d on d.id=sp.deal_id where 1 $sqlCond";
										
				$point_sql			=	"SELECT sum(sp.point) as sum
										FROM vod_customer_sitepoints AS sp
										JOIN vod_customer AS cu ON sp.customer_id = cu.id
										JOIN vod_sitepoint_action AS sa ON sa.id = sp.action_id
										LEFT JOIN vod_deal AS d ON d.id = sp.deal_id
										WHERE 1 $sqlCond";
				$resultArry			=	$this->getdbcontents_sql($point_sql);
				
				$this->addData(array("sql"=>$sql),"post");
				$spage				 =	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				 =	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				$searchData			 =	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				$searchCombo				=	$this->get_combo_arr("action_id",$customerObj->getAllSitecreditAction(),"id","action",$searchData['action_id'],"style='width:100px;'");
				foreach($data	as $key=>$val)
					{
						$sitePntPopUp				=	$this->getPopUpTable(array("Total Points","Used Points","Balance Points"),array(array($val['total_points'],$val['used_points'],$val['balance_points'])),"250");
						$data[$key]["sitePntPopUp"]	=	$sitePntPopUp;
					}
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"searchCombo"=>$searchCombo,"headname"=>$data[0]['fullname'],"sitepoints"=>$resultArry[0]["sum"]);
			}
		public function customerSitePointsGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false); 
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('NAME','CUSTOMER ACTION','SITE POINTS','ADDED DATE');
						$fieldArr		=	array('fullname','action','point','date_added');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"CustomerReferalsList");						
					}
			}	
	
		public function customerSitePointsCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function customerSitePointsReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function customerSitePointsSearch()
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
