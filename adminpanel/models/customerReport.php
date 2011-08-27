<?php
/****************************************************************************************
Created by	:	hari kirishna
Created on	:	2010-12-07
Purpose		:	Manage customer report
****************************************************************************************/
class customerReport extends modelclass
	{
		public function customerReportListing()
			{
				$this->executeAction(false,"Yearly",true,true);	
			}
		public function customerReportTranscomplete()
			{
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Transcompletesearch");
				$sortData			=	$this->getData("request","Transcompletesearch");
				$sData				=	$this->customerReportDotheSearch("Transcomplete",$searchData,$sortData);
				extract($sData); 
				$sql				=	"select count(vc.id) as totalcustomers, sum(mobile_status) as moblieactive, sum(status) as active,sum(email_update) as emailactive, sum(sms_update) as smsactive,sum(from_fb) as fromfacebook  from 
										vod_customer vc  ".$sqlFilter["join"]." where 1 ".$sqlFilter["cond"].$sqlFilter["orderBy"];
				
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	end($this->getdbcontents_sql($spage->finalSql()));
			
				if(!$data)				$this->setPageError("No records found !");
				return array("data"=>$data,"searchdata"=>$searchData);			
		
			}	
			
			
		public function customerReportYearly()
			{
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Transyearlysearch");
				$sortData			=	$this->getData("request","Transyearlysearch");
				$sData				=	$this->customerReportDotheSearch("Yearly",$searchData,$sortData);
				extract($sData); 
				$sql				=	"select  date_format(vc.`date_added`,'%Y') as year,date_format(vc.`date_added`,'%Y-%m') as searchyear,
										count(vc.id) as totalcustomers, sum(vc.`status`) as activecustomers,
										sum(vc.`email_update`) as emailactive, sum(vc.`sms_update`) as smsactive,
										sum(vc.`from_fb`) as facebook,sum(vc.`mobile_status`) as mobileactive  from 
										vod_customer vc  ".$sqlFilter["join"]." where 1 ".$sqlFilter["cond"]." group by year ".$sqlFilter["orderBy"]; 
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function customerReportDaily()
			{
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Transdailysearch");
				$sortData			=	$this->getData("request","Transdailysearch");
				$sData				=	$this->customerReportDotheSearch("Daily",$searchData,$sortData);
				extract($sData); 
				$sql				=	"select  date_format(vc.`date_added`,'%d-%M-%Y') as year,date_format(vc.`date_added`,'%Y-%m-%d') as searchyear,
										count(vc.id) as totalcustomers, sum(vc.`status`) as activecustomers,
										sum(vc.`email_update`) as emailactive, sum(vc.`sms_update`) as smsactive,
										sum(vc.`from_fb`) as facebook,sum(vc.`mobile_status`) as mobileactive  from 
										vod_customer vc  ".$sqlFilter["join"]." where 1 ".$sqlFilter["cond"]." group by year ".$sqlFilter["orderBy"]; 
					
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);	
			}
		public function customerReportMonthly()
			{
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Transmonthlysearch");
				$sortData			=	$this->getData("request","Transmonthlysearch");
				
				$sData				=	$this->customerReportDotheSearch("Daily",$searchData,$sortData);
				extract($sData); 
				$sql				=	"select  date_format(vc.`date_added`,'%M-%Y') as year,date_format(vc.`date_added`,'%Y-%m') as searchyear,
										count(vc.id) as totalcustomers, sum(vc.`status`) as activecustomers,
										sum(vc.`email_update`) as emailactive, sum(vc.`sms_update`) as smsactive,
										sum(vc.`from_fb`) as facebook,sum(vc.`mobile_status`) as mobileactive  from 
										vod_customer vc  ".$sqlFilter["join"]." where 1 ".$sqlFilter["cond"]." group by year ".$sqlFilter["orderBy"]; 
					
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				
				if(!$data)				$this->setPageError("No records found !");
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);	
			}
	
		public function customerReportDotheSearch($action,$searchData,$sortData)
			{
				$territoryObj			=	new territory;
				$countryArry			=	$territoryObj->getAllCountries("1");
				$dropDwon_ship_country	=	$this->get_combo_arr("sel_ship_country",$countryArry,"id","country",$searchData["sel_ship_country"],"style='width:100px' onchange='getStates(this.value,\"sel_ship_state\",\"id_search_ship_state\")'","Select Country");
				
				//state combo
				$territoryObj			=	new territory;
				$shipstateArry			=	$territoryObj->getAllStates("country_id=".$searchData["sel_ship_country"]);
				$billstateArry			=	$territoryObj->getAllStates("country_id=".$searchData["sel_bill_country"]);
				$dropDwon_ship_state	=	$this->get_combo_arr("sel_ship_state",$shipstateArry,"id","state",$searchData["sel_ship_state"],"","All States");
				
				//Application combo
				$masterObj				=	new masters();
				$appCombo				=	$masterObj->getAllDetails("vod_site_apps");
				$appCombo				=	$this->get_combo_arr("sel_apps",$appCombo,"id","apps",$searchData["sel_apps"],"","All");
				
				$searchData["sortData"]			=	$sortData;
				$searchData["bill_country"]		=	$dropDwon_bill_country;
				$searchData["bill_state"]		=	$dropDwon_bill_state;
				$searchData["ship_country"]		=	$dropDwon_ship_country;
				$searchData["ship_state"]		=	$dropDwon_ship_state;
				$searchData["cat_application"]	=	$appCombo;
				$searchData["prod_cat"]			=	$prodCat;
				$searchData["product"]			=	$ecomProducts;

			
				if(trim($searchData["txt_order_from"]))
					{
						$sqlFilter["cond"]		.=	" and".$this->dbSearchCond(">=",date_added,$searchData["txt_order_from"]);
					}
				if(trim($searchData["txt_order_to"]))
					{
						$sqlFilter["cond"]		.=	" and".$this->dbSearchCond("<=",date_added,$searchData["txt_order_to"]);
					}	
				if(trim($searchData["sel_ship_country"]))
					{
						$sqlFilter["cond"]		.=	" and".$this->dbSearchCond("=",country_id,$searchData["sel_ship_country"]);
					}
				if(trim($searchData["sel_ship_state"]))
					{
						$sqlFilter["cond"]		.=	" and".$this->dbSearchCond("=",state_id,$searchData["sel_ship_state"]);
					}
				if(trim($searchData["sel_apps"]))
					{
						$sqlFilter["cond"]		.=	" and".$this->dbSearchCond("=",apps_id,$searchData["sel_apps"]);
					}		
				if(trim($sortData["sortField"]))
					{
						$sqlFilter["orderBy"]	=	" order by ".$sortData["sortField"];
					}
				if(trim($sortData["sortMethod"]))
					{
						$sqlFilter["orderBy"]	.=	" ".$sortData["sortMethod"];
					}	
				if((in_array("facebook", $searchData[sel_filter_users])))
					{
						$sqlFilter["cond"]		.=	" and".$this->dbSearchCond("=",from_fb,1);
					}	
				if((in_array("ecom", $searchData[sel_filter_users])))
					{
						$sqlFilter["join"]		=	"  join vod_deal_order as vdo on vdo.customer_id=vc.id ";
					}	
				if((in_array("productive", $searchData[sel_filter_users])))
					{
						$sqlFilter["join"]		=	"  join vod_ecomm_order as veo on veo.customer_id=vc.id ";
					}		
											
				$searchData["dqlFilter1"]		=	$sqlFilter;
			
				return array("searchData"=>$searchData,"sortData"=>$sortData,"sqlFilter"=>$sqlFilter);
			}
		public function customerReportTransdailycsv()
			{
				$sqlData		=	$this->getData("post","Daily",false);
				
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Totalcustomers','Active customers','Email active','Sms active','From facebook','Mobile active ');
						$fieldArr		=	array('year','totalcustomers','activecustomers','emailactive','smsactive','facebook','mobileactive');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"customerReportDaily");						
					}
		
			}
		public function customerReportTransmonthlycsv()
			{	
				$sqlData		=	$this->getData("post","Monthly",false);
				
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Totalcustomers','Active customers','Email active','Sms active','From facebook','Mobile active ');
						$fieldArr		=	array('year','totalcustomers','activecustomers','emailactive','smsactive','facebook','mobileactive');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"customerReportMonthly");						
					}
			}	
		public function customerReportTransyearlycsv()
			{	
				$sqlData		=	$this->getData("post","Yearly",false);
				
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Totalcustomers','Active customers','Email active','Sms active','From facebook','Mobile active ');
						$fieldArr		=	array('year','totalcustomers','activecustomers','emailactive','smsactive','facebook','mobileactive');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"customerReportYearly");						
					}
			}	
			
		public function customerReportTranscompletecsv()
			{
				$sqlData		=	$this->getData("post","Transcomplete",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Total customers','Active customers','Email active','Sms active','From facebook','Mobile active ');
						$fieldArr		=	array('totalcustomers','active','emailactive','smsactive','fromfacebook','moblieactive',);
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"customerReportYearly");						
					}
			}
		
		public function customerReportCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function customerReportgoToCustomerPage()
			{
				$var					=	$_REQUEST['datesearch'];
				$this->addData(array("txt_join_from"=>$var,"txt_join_to"=>$var),"post","Search",true,"customers.php");
				$this->executeAction(false,"Search",true,false,"","","customers.php");
			}
			
		public function customerReportgetcountry()
			{
				$territoryObj			=	new territory;
				$countryArry			=	$territoryObj->getAllCountries("1");
				$dropDwon_ship_country	=	$this->get_combo_arr("sel_ship_country",$countryArry,"id","country",$searchData["sel_ship_country"],"onchange='getStates(this.value,\"sel_ship_state\",\"id_search_ship_state\")'","Select Country");
			}	
		public function customerReportGetstatecombo()
			{
				ob_clean();
				$data					=	$this->getData("request");
				$territoryObj			=	new territory;
				$stateArry				=	$territoryObj->getAllStates("country_id=".$data["cid"]);
				echo $dropDwon_state	=	$this->get_combo_arr($data["sid"],$stateArry,"id","state","","","All States");
				exit;
			}
		public function customerReportGetproductscombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$ecomObj			=	new ecommProducts();
				$ecomProducts		=	$ecomObj->getAllEcommProducts("category_id=".$data["cid"]);
				echo $ecomProducts	=	$this->get_combo_arr("sel_product",$ecomProducts,"id","product","","","All Products");
				exit;
			}
		public function customerReportGotransall()
			{
				$data				=	$this->getData("request");
				$searchData			=	$this->getData("post","Transdailysearch");
				$this->clearData("Transallsearch");
				$this->addData($searchData,"post","Transallsearch",false);
				$this->addData(array("txt_order_from"=>$data['datesearch'],"txt_order_to"=>$data['datesearch']),"post","Transallsearch",false);
				
				$this->executeAction(false,"Transall",true,false);
			}
		public function customerReportGotransdaily()
			{
				$data		=	$this->getData("request");
				$date		=	explode("-",$data['datesearch']);
				$firstDay	=	$this->firstOfMonth($date[1], $date[0]);
				$lastDay	=	$this->lastOfMonth($date[1], $date[0]);
				$searchData	=	$this->getData("post","Transmonthlysearch");
				$this->clearData("Transdailysearch");
				$this->addData($searchData,"post","Transdailysearch",false);
				$this->addData(array("txt_order_from"=>$firstDay,"txt_order_to"=>$lastDay),"post","Transdailysearch",false);
				$this->executeAction(false,"Daily",true,false);
			}
		public function customerReportGotransmonthly()
			{
				$data		=	$this->getData("request");
				$date		=	explode("-",$data['datesearch']);
				$firstDay	=	$this->firstOfMonth("1", $date[0]);
				$lastDay	=	$this->lastOfMonth("12", $date[0]);
				$searchData	=	$this->getData("post","Transyearlysearch");
				$this->clearData("Transmonthlysearch");
				$this->addData($searchData,"post","Transmonthlysearch",false);
				$this->addData(array("txt_order_from"=>$firstDay,"txt_order_to"=>$lastDay),"post","Transmonthlysearch",false);
				$this->executeAction(false,"Monthly",true,false);
			}
		public function customerReportSetpaid()
			{
				$data		=	$this->getData("post","",true);
				$checkone	=	implode(",", $data["checkone"]);
				$datVals	=	array("paid_date"=>"escape now() escape","paid_status"=>GLB_DEAL_PAID);
				$this->db_update("vod_ecomm_order",$datVals,"id in($checkone)",true);
				if($this->getDbErrors())	$this->setPageError($this->getDbErrors());
				else 						$this->setPageError("status changed to paid for ".mysql_affected_rows()." records");
				$this->executeAction(false,"Transall",true,true);
			}
		public function customerReportSetnotpaid()
			{
				$data		=	$this->getData("post","",true);
				$checkone	=	implode(",", $data["checkone"]);
				$datVals	=	array("paid_status"=>GLB_DEAL_NOT_PAID);
				$this->db_update("vod_ecomm_order",$datVals,"id in($checkone)");
				if($this->getDbErrors())	$this->setPageError($this->getDbErrors());
				else 						$this->setPageError("status changed to not paid for ".mysql_affected_rows()." records");
				$this->executeAction(false,"Transall",true,true);
			}
					
		public function customerReportTransdailysearch()
			{
				$this->executeAction(false,"Daily",true);
			}	
		public function customerReportTransmonthlysearch()
			{
				$this->executeAction(false,"Monthly",true);
			}	
		public function customerReportTransyearlysearch()
			{
				$this->executeAction(false,"Yearly",true);
			}	
		public function customerReportTranscompletesearch()
			{
				$this->executeAction(false,"Transcomplete",true);
			}	
		
		public function customerReportTransdailyreset()
			{
				$this->clearData("Transdailysearch");
				$this->executeAction(false,"Daily",true,false);	
			}
		public function customerReportTransmonthlyreset()
			{
				$this->clearData("Transmonthlysearch");
				$this->executeAction(false,"Monthly",true,false);	
			}	
		public function customerReportTransyearlyreset()
			{
				$this->clearData("Transyearlysearch");
				$this->executeAction(false,"Transyearly",true,false);	
			}
		public function customerReportTranscompletereset()
			{
				$this->clearData("Transcompletesearch");
				$this->executeAction(false,"Transcomplete",true,false);	
			}	
		
		public function __construct()
			{
				$this->setClassName();
			}
		public function executeAction($loadData=true,$action="",$navigate=false,$sameParams=false,$newParams="",$excludParams="",$page="")
			{
				if(trim($action))
				$this->setAction($action);//forced action
				$methodName		=		(method_exists($this,$this->getMethodName()))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
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
