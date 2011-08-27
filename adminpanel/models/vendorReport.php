<?php
/****************************************************************************************
Created by	:	hari krishna
Created on	:	2010-12-29
Purpose		:	Manage Vendor Report
****************************************************************************************/
class vendorReport extends modelclass
	{
		public function vendorReportListing()
			{
				$this->executeAction(false,"Yearly",true,true);	
			}
		public function vendorReportYearly()
			{
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Transyearlysearch");
				$sortData			=	$this->getData("request","Transyearlysearch");
				$sData				=	$this->vendorReportDotheSearch("Transyearlysearch",$searchData,$sortData,true);
				extract($sData); 
				$sql				=	"SELECT count( vv.id ) AS total,
										sum( vv.status ) AS activevendor,
										date_format( vv.`date_added` , '%Y' ) AS year,
										sum( vv.`email_update` ) AS emailactive,
										sum( vv.`sms_update` ) AS smsactive FROM vod_vendor AS vv 
										".$sqlFilter['join']." where 1 "
										.$sqlFilter["cond"]." group by year".$sqlFilter["orderBy"];

				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function vendorReportConsolidated()
			{
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Transconsolidatedsearch");
				$sortData			=	$this->getData("request","Transconsolidatedsearch");
				$sData				=	$this->vendorReportDotheSearch("Transconsolidatedsearch",$searchData,$sortData);
				extract($sData); 
				$sql				=	"SELECT sum( tbl.total ) AS ttotal, sum( tbl.activevendor )
										AS tactivetotal, sum( tbl.emailactive ) AS temailactive, sum( tbl.smsactive ) AS 
										tsmsactive FROM (SELECT count( vv.id ) AS total,
										sum( vv.status ) AS activevendor,
										date_format( vv.`date_added` , '%Y' ) AS year,
										sum( vv.`email_update` ) AS emailactive,
										sum( vv.`sms_update` ) AS smsactive FROM vod_vendor AS vv 
										".$sqlFilter['join']." where 1 "
										.$sqlFilter["cond"]." group by year".$sqlFilter["orderBy"]." )as tbl";
									
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				
				if(!$data)				$this->setPageError("No records found !");
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);	
			}
		public function vendorReportMonthly()
			{
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Transmonthlysearch");
				$sortData			=	$this->getData("request","Transmonthlysearch");
				$sData				=	$this->vendorReportDotheSearch("Transmonthlysearch",$searchData,$sortData);
				extract($sData); 
				$sql				=	"SELECT count( vv.id ) AS total, 
										sum( vv.status ) AS activevendor, 
										date_format( vv.`date_added` , '%Y-%M' )
										AS month,date_format( vv.`date_added` , '%Y-%m' )
										AS tosearch,
										sum( vv.`email_update` ) AS emailactive,
										sum( vv.`sms_update` ) AS smsactive FROM vod_vendor AS vv "
										.$sqlFilter['join']." where 1 "
										.$sqlFilter["cond"]." group by month".$sqlFilter["orderBy"];
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);	
			}
		public function vendorReportDaily()
			{
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Transdailysearch");
				$sortData			=	$this->getData("request","Transdailysearch");
				$sData				=	$this->vendorReportDotheSearch("Transdailysearch",$searchData,$sortData);
				extract($sData); 
				$sql				=	"SELECT count( vv.id ) AS total,
										 sum( vv.status ) AS activevendor, 
										 date_format( vv.`date_added` , '%d-%M-%Y' ) 
										 AS day,date_format( vv.`date_added` , '%Y-%m-%d' ) 
										 AS search,
										 sum( vv.`email_update` ) AS emailactive,
										 sum( vv.`sms_update` ) AS smsactive FROM vod_vendor AS vv "
										 .$sqlFilter['join']." where 1 "
										.$sqlFilter["cond"]." group by day".$sqlFilter["orderBy"];
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				
				if(!$data)				$this->setPageError("No records found !");
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);			
			}
		
		public function vendorReportGotoyearlyreport()
			{
				$data				=	$this->getData("request");
				$searchData			=	$this->getData("post","Transcompletesearch");
				$this->clearData("Transyearlysearch");
				$this->addData($searchData,"post","Transyearlysearch",false);
				$this->executeAction(false,"Transyearly",true,false);
			}
		public function vendorReportDotheSearch($action,$searchData,$sortData)
			{
				
				//country cobo
				$territoryObj		=	new territory;
				$countryArry		=	$territoryObj->getAllCountries("1");
				$dropDwon_ship_country	=	$this->get_combo_arr("sel_ship_country",$countryArry,"id","country",$searchData["sel_ship_country"]," style='width:120px;' onchange='getStates(this.value,\"sel_ship_state\",\"id_search_ship_state\")'","Select Country");
				$dropDwon_bill_country	=	$this->get_combo_arr("sel_bill_country",$countryArry,"id","country",$searchData["sel_bill_country"],"style='width:120px;' onchange='getStates(this.value,\"sel_bill_state\",\"id_search_bill_state\")'","Select Country");
				
				//state combo
				$territoryObj		=	new territory;
				$shipstateArry		=	$territoryObj->getAllStates("country_id=".$searchData["sel_ship_country"]);
				$billstateArry		=	$territoryObj->getAllStates("country_id=".$searchData["sel_bill_country"]);
				$dropDwon_ship_state=	$this->get_combo_arr("sel_ship_state",$shipstateArry,"id","state",$searchData["sel_ship_state"],"","All States");
				$dropDwon_bill_state=	$this->get_combo_arr("sel_bill_state",$billstateArry,"id","state",$searchData["sel_bill_state"]," ","All States");
				
				//sales team combo	
				
				$adminObj			=	new adminUser();
				$userSess 			=	end($adminObj->get_user_data());					
				$utId	 			=	$userSess["usertype"];
				$utypeid			=	GLB_SAGENT_UTYPEID;	
							
				if($utId			==	$utypeid)	$cond	=	" and id=".$userSess["id"];
				else								$cond	=	"";
				$salesAgents		=	$adminObj->getAdminUsers("usertype=".GLB_SAGENT_UTYPEID." and status='1'".$cond);	
				$dropDwon			=	$this->get_combo_arr("sel_search_group",$salesAgents,"id","fullname",$searchData["sel_search_group"],"style='width:100px;'",'Select Agent');
				
				$searchData["sortData"]			=	$sortData;
				$searchData["bill_country"]		=	$dropDwon_bill_country;
				$searchData["bill_state"]		=	$dropDwon_bill_state;
				$searchData["salesagent"]		=	$dropDwon;
				if(trim($searchData["keyword"]))
					{
						$sqlFilter["cond"]	.= " and (".$this->dbSearchCond("like", "vv.vendorcode","%".$searchData["keyword"]."%");
						$sqlFilter["cond"]	.= " or ".$this->dbSearchCond("like", "vv.business_name","%".$searchData["keyword"]."%");
						$sqlFilter["cond"]	.= " or ".$this->dbSearchCond("like", "vv.address","%".$searchData["keyword"]."%");	
						$sqlFilter["cond"]	.= " or ".$this->dbSearchCond("like", "vv.contact_person","%".$searchData["keyword"]."%");
						$sqlFilter["cond"]	.= " or ".$this->dbSearchCond("like", "vv.mobile","%".$searchData["keyword"]."%");	
						$sqlFilter["cond"]	.= " )";
					}
				if(trim($searchData["userId"]))
					{
						$sqlFilter["cond"]	.= " and (".$this->dbSearchCond("like", "vv.email","%".$searchData["userId"]."%");
						$sqlFilter["cond"]	.= " or ".$this->dbSearchCond("=", "vv.id",$searchData["userId"]);		
						$sqlFilter["cond"]	.= " )";
					}
				
				if(trim($searchData['sel_search_group']))
					{
						$sqlFilter["cond"]	.= " and ".$this->dbSearchCond("=", " vv.`saleagent_id`",$searchData["sel_search_group"]);
					}
				if(trim($searchData['sel_status']))
					{	
						if($searchData['sel_status']==1)
						$sqlFilter["cond"]	.= " and ".$this->dbSearchCond("=", "vv.status",$searchData["sel_status"]);
						if($searchData['sel_status']==2)
						$sqlFilter["cond"]	.= " and ".$this->dbSearchCond("=", "vv.status",'0');
					}
				if(trim($searchData['sel_bill_country'])) 				$sqlFilter["cond"]	.= " and ".$this->dbSearchCond("=", "vv.country_id",$searchData["sel_bill_country"]);
					
				if(trim($searchData['sel_bill_state']))					$sqlFilter["cond"]	.= " and ".$this->dbSearchCond("=", "vv.state_id",$searchData["sel_bill_state"]);
					
				if(trim($searchData['sel_application']))				$sqlFilter["cond"]	.= " and ".$this->dbSearchCond("=", "vv.apps_id",$searchData["sel_application"]);
						
				//search conditions
							
				if(trim($searchData["txt_join_from"]))					$sqlFilter["cond"]	.=	" and".$this->dbSearchCond(">=", "date( vv.`date_added`)",$searchData["txt_join_from"]);
				if(trim($searchData["txt_join_to"]))					$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("<=", "date( vv.`date_added`)",$searchData["txt_join_to"]);
				if($utId		==	$utypeid)							$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "vv.saleagent_id",$userSess["id"]);


				// with deal 
				if (in_array("running", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and ( ".$this->dbSearchCond("=", "vod.status",3);
						$sqlFilter["cond"]	.=	" or ".$this->dbSearchCond("=", "vod.status",4)." ) ";
					}
					
				if (in_array("queud", $searchData[sel_filter_users]))	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",1);
					
				if (in_array("review", $searchData[sel_filter_users]))	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",0);
					
				if (in_array("cooldown", $searchData[sel_filter_users]))$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",5);
									
				if (in_array("locked", $searchData[sel_filter_users]))	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",3);
					
				
				if (in_array("unlocked", $searchData[sel_filter_users]))$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",4);
					
				
				if (in_array("sold", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and (".$this->dbSearchCond("=", "vod.status",5);
						$sqlFilter["cond"]	.=	" or ".$this->dbSearchCond("=", "vod.status",6)." ) ";
						$flag=1;
					}
				// filter 2 
				
				if (in_array("pending", $searchData[sel_filter_users2]))$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "vdp.balance_comm_vendor",0);
					
				if (in_array("reciving", $searchData[sel_filter_users2]))$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "vdp.used_comm_vendor",0);
					
				if (in_array("email_update", $searchData[sel_filter_users2]))$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vd.email_update",1);
					
				if (in_array("sms_update", $searchData[sel_filter_users2]))	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vd.email_update",1);
					
				
				if(count($sqlFilter)!=0)	
					{
						$sqlFilter["join"]		.=	" left join vod_deal as vod on vod.vendor_id 	= vv.id ";
						$sqlFilter["join"]		.=	" left join vod_deal_payments as vdp on vdp.deal_id 		= vod.id ";
						if($flag==1)
						$sqlFilter["join"]		.=	" right join vod_deal_order as vdo on vdo.deal_id = vod.id ";
					}
						$sqlCond				.=	" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				    	$sql					=	"SELECT vd.* FROM vod_vendor as vd
													".$sqlFilter["selc"]."
													".$sqlFilter["join"]."
													where 1 ".$sqlFilter["cond"]."  $sqlCond $orderBy   ";
				
				if($sortData["sortField"]) $sqlFilter["orderBy"]	   .=	" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				return array("searchData"=>$searchData,"sortData"=>$sortData,"sqlFilter"=>$sqlFilter);
			}
		public function vendorReportTransallcsv()
			{	
				$sqlData		=	$this->getData("post","Transall",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Order Id','Order Date','Grand Total','Customer Name','Paid','Delivered');
						$fieldArr		=	array('id','order_date','grand_total','fullname','paid_status','deliver_status');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"EcomOrdersAll");						
					}
			}	
		public function vendorReportTransdailycsv()
			{	
				$sqlData		=	$this->getData("post","Daily",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Date','Total Vendors','Active Vendors','Email Active','Sms Active');
						$fieldArr		=	array('year','total','activevendor','emailactive','smsactive');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"vendorReportDaily");						
					}
			}	
		public function vendorReportTransmonthlycsv()
			{	
				$sqlData		=	$this->getData("post","Monthly",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Date','Total Vendors','Active Vendors','Email Active','Sms Active');
						$fieldArr		=	array('year','total','activevendor','emailactive','smsactive');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"vendorReportMonthly");						
					}
			}	
		public function vendorReportTransyearlycsv()
			{	
				$sqlData		=	$this->getData("post","Transyearly",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Total Order','Total Quantity','Grand Total','Customers','Paid','Delivered');
						$fieldArr		=	array('ecomyear','total_order','tot_quantity','total_amount','total_customers','total_paid','total_delivered');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"EcomOrdersYearly");						
					}
			}	
		public function vendorReportCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function vendorReportGetstatecombo()
			{
				ob_clean();
				$data					=	$this->getData("request");
				$territoryObj			=	new territory;
				$stateArry				=	$territoryObj->getAllStates("country_id=".$data["cid"]);
				echo $dropDwon_state	=	$this->get_combo_arr($data["sid"],$stateArry,"id","state","","","All States");
				exit;
			}
		public function vendorReportGoToDeal()
			{
				$getData				=	$this->getData("get");
				$this->addData(array("txt_join_from"=>$getData["datesearch"],"txt_join_to"=>$getData["datesearch"]),"post","Search",true,"vendors.php");
				$this->executeAction(false,"Search",true,false,"","","vendors.php");
			}	
		public function vendorReportGetproductscombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$ecomObj			=	new ecommProducts();
				$ecomProducts		=	$ecomObj->getAllEcommProducts("category_id=".$data["cid"]);
				echo $ecomProducts	=	$this->get_combo_arr("sel_product",$ecomProducts,"id","product","","","All Products");
				exit;
			}
		public function vendorReportGotransall()
			{
				$data		=	$this->getData("request");
				$searchData	=	$this->getData("post","Transdailysearch");
				$this->clearData("Transallsearch");
				$this->addData($searchData,"post","Transallsearch",false);
				$this->addData(array("txt_order_from"=>$data['datesearch'],"txt_order_to"=>$data['datesearch']),"post","Transallsearch",false);
				
				$this->executeAction(false,"Transall",true,false);
			}
		public function vendorReportGotransdaily()
			{
				$data		=	$this->getData("request");
				$date		=	explode("-",$data['datesearch']);
				$firstDay	=	$this->firstOfMonth($date[1], $date[0]);
				$lastDay	=	$this->lastOfMonth($date[1], $date[0]);
				$searchData	=	$this->getData("post","Transmonthlysearch");
				$this->clearData("Transdailysearch");
				$this->addData($searchData,"post","Transdailysearch",false);
				$this->addData(array("txt_join_from"=>$firstDay,"txt_join_to"=>$lastDay),"post","Transdailysearch",false);
				$this->executeAction(false,"Daily",true,false);
			}
		public function vendorReportGotransmonthly()
			{
				$data		=	$this->getData("request");
				$date		=	explode("-",$data['datesearch']);
				$firstDay	=	$this->firstOfMonth("1", $date[0]);
				$lastDay	=	$this->lastOfMonth("12", $date[0]);
				$searchData	=	$this->getData("post","Transyearlysearch");
				$this->clearData("Transmonthlysearch");
				$this->addData($searchData,"post","Transmonthlysearch",false);
				$this->addData(array("txt_join_from"=>$firstDay,"txt_join_to"=>$lastDay),"post","Transmonthlysearch",false);
				$this->executeAction(false,"Monthly",true,false);
			}
			
		public function vendorReportTransdailysearch()
			{
				$this->executeAction(false,"Daily",true);
			}
		public function vendorReportTransconsolidatedsearch()
			{
				$this->executeAction(false,"Consolidated",true);
			}	
		public function vendorReportTransmonthlysearch()
			{
				$this->executeAction(false,"Monthly",true);
			}	
		public function vendorReportTransyearlysearch()
			{
				$this->executeAction(false,"Yearly",true);
			}	
		public function vendorReportTransyearlyreset()
			{
				$this->clearData("Transyearlysearch");
				$this->executeAction(false,"Yearly",true,false);	
			}
		public function vendorReportTransmonthlyreset()
			{
				$this->clearData("Transmonthlysearch");
				$this->executeAction(false,"Monthly",true,false);	
			}	
			
		public function vendorReportTransConsolidatedreset()
			{
				$this->clearData("Transconsolidatedsearch");
				$this->executeAction(false,"Consolidated",true,false);	
			}	
		public function vendorReportTransdailyreset()
			{
				$this->clearData("Transdailysearch");
				$this->executeAction(false,"Daily",true,false);	
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
