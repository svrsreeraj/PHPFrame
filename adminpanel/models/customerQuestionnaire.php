<?php
/****************************************************************************************
Created by	:	hari krishna
Created on	:	2010-11-30
Purpose		:	Manage Customer Questuionnaire
****************************************************************************************/
class customerQuestionnaire extends modelclass
	{
		public function customerQuestionnaireListing()
			{
				$this->permissionCheck("View",1);
				$searchData				=	$this->getData("post","Search");
				$sortData				=	$this->getData("request","Search");		
				$customerObj			=	new customer;						
				$dealObj				=	new deals();						
				if(!trim($sortData["sortField"]))						
						{
							$this->addData(array("sortField"=>"id"),"request","Search");
							$this->addData(array("sortMethod"=>"desc"),"request","Search");
							$sortData	=	$this->getData("request","Search");
						}
				if(trim($searchData["keyword"]))
						{
							$sqlCond	.=	" and ( ";
							$sqlCond	.=	$this->dbSearchCond("like", "concat(c.fname,' ',c.lname)", "%".$searchData["keyword"]."%"). " or";				
							$sqlCond	.=	$this->dbSearchCond("like", "q.question", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "qo.options", "%".$searchData["keyword"]."%");
							$sqlCond	.=	") ";
						}
				if(trim($searchData["txt_date_from"]) && trim($searchData["txt_date_to"]))
						{
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("between", "date(q.date_added)",$searchData["txt_date_from"]."'"." and "."'".$searchData["txt_date_to"]);
							$sqlCond	.=	") ";
						}
				if(trim($searchData["sel_status"]))
						{	
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("=", "q.status",$searchData["sel_status"]);
							$sqlCond	.=	") ";
						}
				if(trim($searchData["cusId"]))
						{
							
							$cusId		 =	$searchData["cusId"];
							$sqlCond	.=	" And ( ";
							$sqlCond	.=	$this->dbSearchCond("=", "c.id",$searchData["cusId"]);
							$sqlCond	.=	" or " ;
							$sqlCond	.=	$this->dbSearchCond("=", "c.email",$cusId);
							$sqlCond	.=	") ";
						}
				if($sortData["sortField"]==	"fname")
				$sqlCond				.=	" GROUP BY cq.`customer_id` , cq.`question_id` order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				else
				$sqlCond				.=	" GROUP BY cq.`customer_id` , cq.`question_id` order by q.".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql					 =	"SELECT concat(c.fname,' ',c.lname) as fullname, q.question, qo.options, q.choice, group_concat( qo.options ) AS opt
FROM `vod_customer_questionnaire` AS cq JOIN vod_questionnaire AS q ON cq.`question_id` = q.id  JOIN vod_customer AS c ON c.id = cq.`customer_id` JOIN vod_questionnaire_options AS qo ON qo.id = cq.`option_id` ".$sqlCond;
				$this->addData(array("sql"=>$sql),"post");
				$spage					 =	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data					 =	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)					$this->setPageError("No records found !");
				$searchData				 =	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]=	$searchCombo; 
				$searchData["sortData"]	 =	$sortData;
				//print_r($data);
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"headname"=>$data[0]['fullname']);
			}
		public function customerQuestionnaireGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		 =	array('NAME','QUESTION','QUESTION TYPE','OPTION');
						$fieldArr		 =	array('fullname','question','choice','opt');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"CustomerQuestionnaire");						
					}
			}	
		public function customersCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function customerQuestionnaireReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function customerQuestionnaireSearch()
			{
				$this->executeAction(false,"Listing",true,false);	
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
