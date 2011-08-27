<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-12-07
Purpose		:	Manage Ecommerce Report
****************************************************************************************/
class ecommReportAll extends modelclass
	{
		public function ecommReportAllListing()
			{
				$this->executeAction(false,"Transall",true,true);	
			}
		public function ecommReportAllTransall()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transallsearch");
				$sortData		=	$this->getData("request","Transallsearch");
				
				$sData			=	$this->ecommReportAllDotheSearch("Transall",$searchData,$sortData);
				extract($sData); 
				
			 	$sql			=	"SELECT eo.*,concat(cu.fname,'',cu.lname) as fullname,cu.email
									FROM vod_ecomm_order as eo
									".$sqlFilter["selc"]."
									join vod_customer as cu on cu.id=eo.customer_id
									".$sqlFilter["join"]."
									where 1 ".$sqlFilter["cond"].$sqlFilter["orderBy"];
				
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage			=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data			=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)			$this->setPageError("No records found !");

				$searchData		=	$this->getHtmlData($searchData,$exceptions=array("prod_cat","product","ship_country","bill_country","ship_state","bill_state","sortData","cat_application"));
				foreach($data	as $key=>$val)
					{
						$amtPopUp					=	$this->getPopUpTable(array("Total Amount"),array(array($val['paid_point'])),"300");
						$data[$key]["amountPopUp"]	=	$amtPopUp;
					}
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function ecommReportAllupdatedelivery($id)
			{
				$id						=	$this->getData("get","updatedelivery");
				$cond					=	 "id = '".$id['id']."'";
				$data					=	array();
				$data['deliver_date']	=	"escape now() escape";
				$data['deliver_status']	=	1;
				$insert=$this->db_update("vod_ecomm_order",$data,$cond);
				if($insert) $this->setPageError("Devilery status updated !");
				else 	$this->setPageError("No records found !");
				$this->executeAction(false,"Transall",true,false);
			}
		public function ecommReportAllTransdaily()
			{
				$this->permissionCheck("View",1);

				$searchData			=	$this->getData("post","Transdailysearch");
				$sortData			=	$this->getData("request","Transdailysearch");
				
				$sData				=	$this->ecommReportAllDotheSearch("Transdaily",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by date(eo.order_date)";
				
				$sql				=	"SELECT eo.order_date,concat(cu.fname,'',cu.lname) as fullname,
										sum(eo.paid_status) as total_paid,
										sum(eo.deliver_status) as total_delivered,
										count(distinct eo.customer_id) as total_customers,
										count(eo.id) as total_order,sum(eo.paid_point) as total_amount,
										sum(eo.quantity) as tot_quantity
										FROM vod_ecomm_order AS eo
										".$sqlFilter["selc"]."
										left join vod_customer as cu on cu.id=eo.customer_id
										".$sqlFilter["join"]."
										where 1 ".$sqlFilter["cond"].$sqlFilter["group"].$sqlFilter["orderBy"];
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");

				$searchData			=	$this->getHtmlData($searchData,$exceptions=array("prod_cat","product","ship_country","bill_country","ship_state","bill_state","sortData","cat_application"));
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);	
			}
		public function ecommReportAllTransmonthly()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transmonthlysearch");
				$sortData		=	$this->getData("request","Transmonthlysearch");
				$sData			=	$this->ecommReportAllDotheSearch("Transmonthly",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by MONTHNAME(eo.order_date)";
				
				$sql		 =		"SELECT eo.*,MONTHNAME(eo.order_date) as ecommonth,YEAR(eo.order_date) as 	                       				 ecomyear,concat(cu.fname,'',cu.lname) as fullname,
									 sum(eo.paid_status) as total_paid,
									 sum(eo.deliver_status) as total_delivered,
									 count(distinct eo.customer_id) as total_customers,
									 count(eo.id) as total_order,sum(eo.paid_point) as total_amount,
									 sum(eo.quantity) as tot_quantity
									 FROM vod_ecomm_order AS eo
									".$sqlFilter["selc"]."
									left join vod_customer as cu on cu.id=eo.customer_id
									".$sqlFilter["join"]."
									where 1 ".$sqlFilter["cond"].$sqlFilter["group"].$sqlFilter["orderBy"];
				
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT,15);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");

				$searchData			=	$this->getHtmlData($searchData,$exceptions=array("prod_cat","product","ship_country","bill_country","ship_state","bill_state","sortData","cat_application"));
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function ecommReportAllTransyearly()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transyearlysearch");
				$sortData		=	$this->getData("request","Transyearlysearch");
				$sData			=	$this->ecommReportAllDotheSearch("Transyearly",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by YEAR(eo.order_date)";
				
				$sql		 =		"SELECT eo.*,YEAR(eo.order_date) as ecomyear,
									 concat(cu.fname,'',cu.lname) as fullname,
									 sum(eo.paid_status) as total_paid,
									 sum(eo.deliver_status) as total_delivered,
									 count(distinct eo.customer_id) as total_customers,
									 count(eo.id) as total_order,sum(eo.paid_point) as total_amount,
									 sum(eo.quantity) as tot_quantity
									 FROM vod_ecomm_order AS eo
									".$sqlFilter["selc"]."
									left join vod_customer as cu on cu.id=eo.customer_id
									".$sqlFilter["join"]."
									where 1 ".$sqlFilter["cond"].$sqlFilter["group"].$sqlFilter["orderBy"];
				
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");

				$searchData			=	$this->getHtmlData($searchData,$exceptions=array("prod_cat","product","ship_country","bill_country","ship_state","bill_state","sortData","cat_application"));
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function ecommReportAllTransview()
			{
				$this->permissionCheck("View",1);
				$data		=	$this->getData("get","",true);	
				$sql		=	"SELECT eo.*,concat(cu.fname,'',cu.lname) as fullname,
								cu.email,cu.apps_id as customer_appid
								FROM vod_ecomm_order as eo 
								join vod_customer as cu on cu.id=eo.customer_id
								where eo.id=".$data['id']."";
				
				$dataArr				=	$this->getdbcontents_sql($sql);
				if(!$dataArr)				$this->setPageError("No Direct Access !!");
				$ecomObj				=	new ecommProducts();
				$productarr				=	$ecomObj->getAllEcommProductsByOrder($data['id']);
				return array("data"=>$this->getHtmlData(end($dataArr)),"prod"=>$productarr);
			}
		public function ecommReportAllTranscomplete()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transcompletesearch");
				$sortData		=	$this->getData("request","Transcompletesearch");
				$sData			=	$this->ecommReportAllDotheSearch("Transcomplete",$searchData,$sortData);
				
				$tempSearch		=	"";
				if($searchData["txt_customerId"])	$tempSearch	=	",group_concat(distinct concat(cu.fname,'',cu.lname)) as fullname";
				
				extract($sData);
				$sql			=	"SELECT count(eo.id) as count,
									count(eo.`customer_id`) as tot_customers,
									sum(`paid_status`) as paid,sum(`deliver_status`) as delivered,
									sum(`paid_point`) as tot_amount,sum(`quantity`) as total_quantity
									 ".$tempSearch."
									 
									FROM vod_ecomm_order as eo
									join vod_customer as cu on cu.id=eo.customer_id
								".$sqlFilter["join"]." where 1".$sqlFilter["cond"]."";
				
				$dataArr				=	$this->getdbcontents_sql($sql);
				if(!$dataArr)				$this->setPageError("No Direct Access !!");
				$searchData				=	$this->getHtmlData($searchData,$exceptions=array("prod_cat","product","ship_country","bill_country","ship_state","bill_state","sortData","cat_application"));
				$ecomObj				=	new ecommProducts();
				$productcount			=	$ecomObj->getAllEcommProductscount();
				return array("data"=>$dataArr,"prod_count"=>$productcount,"searchdata"=>$searchData);
			}
		public function ecommReportAllGotoyearlyreport()
			{
				$data		=	$this->getData("request");
				$searchData	=	$this->getData("post","Transcompletesearch");
				$this->clearData("Transyearlysearch");
				$this->addData($searchData,"post","Transyearlysearch",false);
				$this->executeAction(false,"Transyearly",true,false);
			}
		public function ecommReportAllDotheSearch($action,$searchData,$sortData)
			{
				//setting default values
				if(!isset($searchData["sel_pay_status"]))	$searchData["sel_pay_status"]	=	"1";	
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"eo.order_date"),"request",$action);
						$this->addData(array("sortMethod"=>"desc"),"request",$action);
						$sortData	=	$this->getData("request",$action);
					}
				//country cobo
				$territoryObj			=	new territory;
				$countryArry			=	$territoryObj->getAllCountries("1");
				$dropDwon_ship_country	=	$this->get_combo_arr("sel_ship_country",$countryArry,"id","country",$searchData["sel_ship_country"]," style='width:120px;' onchange='getStates(this.value,\"sel_ship_state\",\"id_search_ship_state\")'","Select Country");

				//state combo
				$territoryObj			=	new territory;
				$shipstateArry			=	$territoryObj->getAllStates("country_id=".$searchData["sel_ship_country"]);
				$dropDwon_ship_state	=	$this->get_combo_arr("sel_ship_state",$shipstateArry,"id","state",$searchData["sel_ship_state"],"","All States");
				
				//Product Category combo
				$ecomObj			=	new ecommProducts();
				$prodCat			=	$ecomObj->getAllEcommProductCategory();
				$prodCat			=	$this->get_combo_arr("sel_prod_cat",$prodCat,"id","category",$searchData["sel_prod_cat"],"onchange='getproducts(this.value,\"id_search_products\")'","All Category");
				
				
				//Application combo
				$masterObj			=	new masters();
				$appCombo			=	$masterObj->getAllDetails("vod_site_apps");
				$appCombo			=	$this->get_combo_arr("sel_apps",$appCombo,"id","apps",$searchData["sel_apps"],"style='width:80px;'","All");
				
				$searchData["sortData"]			=	$sortData;
				$searchData["ship_country"]		=	$dropDwon_ship_country;
				$searchData["ship_state"]		=	$dropDwon_ship_state;
				$searchData["cat_application"]	=	$appCombo;
				$searchData["prod_cat"]			=	$prodCat;
				$searchData["product"]			=	$ecomProducts;

				if(trim($searchData["sel_prod_cat"])	||	trim($searchData["sel_product"]))			
					{
					
						if(trim($searchData["sel_prod_cat"]))	$tempCond	=	"ep.category_id='".trim($searchData["sel_prod_cat"])."'";
						if(trim($searchData["sel_product"]))	$tempCond	=	"ed.ecomm_prodid='".trim($searchData["sel_product"])."'";
						$sqlFilter["join"]	.=	"join 	(
													SELECT ed.order_id as orderId,ed.ecomm_prodid,ep.product,ep.category_id 
													FROM `vod_ecomm_orderdetail` as ed 
													join vod_ecomm_product as ep on  ep.id=ed.ecomm_prodid
													where $tempCond
															) as en on en.orderId=eo.id
												";
					}
				if(trim($searchData["txt_amount_field_from"]))
					{
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond(">=","eo.paid_point",$searchData["txt_amount_field_from"]);
					}
				if(trim($searchData["txt_amount_field_to"]))
					{
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("<=","eo.paid_point",$searchData["txt_amount_field_to"]);
					}
				if(trim($searchData["txt_customerId"]))			
					{
						$sqlFilter["cond"]	.=	" and(".$this->dbSearchCond("=", "cu.id",$searchData["txt_customerId"])." or ".$this->dbSearchCond("like", "cu.email",$searchData["txt_customerId"]).")";	
					}
				if(trim($searchData["txt_orderId"]))			
					{
						$sqlFilter["cond"]	.=	" and(".$this->dbSearchCond("=", "eo.id",$searchData["txt_orderId"]).")";	
					}
										
				//search conditions
				if(trim($searchData["sel_ship_country"]))		$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "eo.ship_country",$searchData["sel_ship_country"]);
				if(trim($searchData["sel_ship_state"]))			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "eo.ship_state",$searchData["sel_ship_state"]);
				
				if(trim($searchData["txt_orderId1"]))			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "eo.id",$searchData["txt_orderId"]);
				if(trim($searchData["sel_pay_status"])!="")		$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "eo.paid_status",$searchData["sel_pay_status"]);
				if(trim($searchData["sel_deliver_option"])!="")	$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "eo.deliver_status",$searchData["sel_deliver_option"]);
				if(trim($searchData["sel_apps"])!="")			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "eo.apps_id",$searchData["sel_apps"]);
				
				if(trim($searchData["txt_order_from"]))			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond(">=", "date(eo.order_date)",$searchData["txt_order_from"]);
				if(trim($searchData["txt_order_to"]))			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("<=", "date(eo.order_date)",$searchData["txt_order_to"]);
					
				$sqlFilter["orderBy"]	   .=	" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$searchData["dqlFilter1"]	=	$sqlFilter;
				return array("searchData"=>$searchData,"sortData"=>$sortData,"sqlFilter"=>$sqlFilter);
			}
		public function ecommReportAllTransallcsv()
			{	
				$sqlData		=	$this->getData("post","Transall",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Order Id','Order Date','Grand Total','Customer Name','Paid','Delivered');
						$fieldArr		=	array('id','order_date','total_amount','fullname','paid_status','deliver_status');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"EcomOrdersAll");						
					}
			}	
		public function ecommReportAllTransdailycsv()
			{	
				$sqlData		=	$this->getData("post","Transdaily",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Order Date','Total Order','Total Quantity','Grand Total','Customers','Paid','Delivered');
						$fieldArr		=	array('order_date','total_order','tot_quantity','total_amount','total_customers','total_paid','total_delivered');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"EcomOrdersDaily");						
					}
			}	
		public function ecommReportAllTransmonthlycsv()
			{	
				$sqlData		=	$this->getData("post","Transmonthly",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Month','Total Order','Total Quantity','Grand Total','Customers','Paid','Delivered');
						$fieldArr		=	array('ecomyear','ecommonth','total_order','tot_quantity','total_amount','total_customers','total_paid','total_delivered');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"EcomOrdersMonthly");						
					}
			}	
		public function ecommReportAllTransyearlycsv()
			{	
				$sqlData		=	$this->getData("post","Transyearly",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Total Order','Total Quantity','Grand Total','Customers','Paid','Delivered');
						$fieldArr		=	array('ecomyear','total_order','tot_quantity','total_amount','total_customers','total_paid','total_delivered');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"EcomOrdersYearly");						
					}
			}	
		public function ecommReportAllCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function ecommReportAllGetstatecombo()
			{
				ob_clean();
				$data					=	$this->getData("request");
				$territoryObj			=	new territory;
				$stateArry				=	$territoryObj->getAllStates("country_id=".$data["cid"]);
				echo $dropDwon_state	=	$this->get_combo_arr($data["sid"],$stateArry,"id","state","","","All States");
				exit;
			}
		public function ecommReportAllGetproductscombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$ecomObj			=	new ecommProducts();
				$ecomProducts		=	$ecomObj->getAllEcommProducts("category_id=".$data["cid"]);
				echo $ecomProducts	=	$this->get_combo_arr("sel_product",$ecomProducts,"id","product","","","All Products");
				exit;
			}
		public function ecommReportAllGotransall()
			{
				$data		=	$this->getData("request");
				$searchData	=	$this->getData("post","Transdailysearch");
				$this->clearData("Transallsearch");
				$this->addData($searchData,"post","Transallsearch",false);
				$this->addData(array("txt_order_from"=>$data['datesearch'],"txt_order_to"=>$data['datesearch']),"post","Transallsearch",false);
				
				$this->executeAction(false,"Transall",true,false);
			}
		public function ecommReportAllGotransdaily()
			{
				$data		=	$this->getData("request");
				$date		=	explode("-",$data['datesearch']);
				$firstDay	=	$this->firstOfMonth($date[1], $date[0]);
				$lastDay	=	$this->lastOfMonth($date[1], $date[0]);
				$searchData	=	$this->getData("post","Transmonthlysearch");
				$this->clearData("Transdailysearch");
				$this->addData($searchData,"post","Transdailysearch",false);
				$this->addData(array("txt_order_from"=>$firstDay,"txt_order_to"=>$lastDay),"post","Transdailysearch",false);
				$this->executeAction(false,"Transdaily",true,false);
			}
		public function ecommReportAllGotransmonthly()
			{
				$data		=	$this->getData("request");
				$date		=	explode("-",$data['datesearch']);
				$firstDay	=	$this->firstOfMonth("1", $date[0]);
				$lastDay	=	$this->lastOfMonth("12", $date[0]);
				$searchData	=	$this->getData("post","Transyearlysearch");
				$this->clearData("Transmonthlysearch");
				$this->addData($searchData,"post","Transmonthlysearch",false);
				$this->addData(array("txt_order_from"=>$firstDay,"txt_order_to"=>$lastDay),"post","Transmonthlysearch",false);
				$this->executeAction(false,"Transmonthly",true,false);
			}
		public function ecommReportAllSetpaid()
			{
				$data		=	$this->getData("post","",true);
				$checkone	=	implode(",", $data["checkone"]);
				$datVals	=	array("paid_date"=>"escape now() escape","paid_status"=>GLB_DEAL_PAID);
				$this->db_update("vod_ecomm_order",$datVals,"id in($checkone)",true);
				if($this->getDbErrors())	$this->setPageError($this->getDbErrors());
				else 						$this->setPageError("Status changed to paid for ".mysql_affected_rows()." records");
				$this->executeAction(false,"Transall",true,true);
			}
		public function ecommReportAllSetnotpaid()
			{
				$data		=	$this->getData("post","",true);
				$checkone	=	implode(",", $data["checkone"]);
				$datVals	=	array("paid_status"=>GLB_DEAL_NOT_PAID);
				$this->db_update("vod_ecomm_order",$datVals,"id in($checkone)");
				if($this->getDbErrors())	$this->setPageError($this->getDbErrors());
				else 						$this->setPageError("Status changed to not paid for ".mysql_affected_rows()." records");
				$this->executeAction(false,"Transall",true,true);
			}
		public function ecommReportAllTransallsearch()
			{
				$this->executeAction(false,"Transall",true);
			}	
		public function ecommReportAllTransdailysearch()
			{
				$this->executeAction(false,"Transdaily",true);
			}	
		public function ecommReportAllTransmonthlysearch()
			{
				$this->executeAction(false,"Transmonthly",true);
			}	
		public function ecommReportAllTransyearlysearch()
			{
				$this->executeAction(false,"Transyearly",true);
			}	
		public function ecommReportAllTranscompletesearch()
			{
				$this->executeAction(false,"Transcomplete",true);
			}	
		public function ecommReportAllTransallreset()
			{
				$this->clearData("Transallsearch");
				$this->executeAction(false,"Transall",true,false);	
			}	
		public function ecommReportAllTransdailyreset()
			{
				$this->clearData("Transdailysearch");
				$this->executeAction(false,"Transdaily",true,false);	
			}
		public function ecommReportAllTransmonthlyreset()
			{
				$this->clearData("Transmonthlysearch");
				$this->executeAction(false,"Transmonthly",true,false);	
			}	
		public function ecommReportAllTransyearlyreset()
			{
				$this->clearData("Transyearlysearch");
				$this->executeAction(false,"Transyearly",true,false);	
			}
		public function ecommReportAllTranscompletereset()
			{
				$this->clearData("Transcompletesearch");
				$this->executeAction(false,"Transcomplete",true,false);	
			}	
		public function Getsearchname($name,$id)
			{
				$ecomObj			=	new ecommProducts();
				$territoryObj			=	new territory;
				if(trim($name	==	"country"))
				{
					$countryname			=	$territoryObj->getCountryName("id=".$id);
					return $countryname;exit;
				}
				elseif(trim($name	==	"apps"))
				{
				$masterObj			=	new masters();
				$appsname			=	$masterObj->getName("vod_site_apps","apps","id=".$id);
				return $appsname;exit;
				}
				elseif(trim($name	==	"productcat"))
				{
				$prodCat			=	$ecomObj->getProductCatName("id=".$id);
				return $prodCat;exit;
				}
				elseif(trim($name	==	"state"))
				{
				$statename			=	$territoryObj->getStateName("id=".$id);
				return $statename;exit;
				}
				else
				{
				$prodName			=	$ecomObj->getProductName("id=".$id);
				return $prodName;
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
