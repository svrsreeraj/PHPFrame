<?php
/****************************************************************************************
Created by	:	Sreeraj
Created on	:	2010-12-02
Purpose		:	Report - Deal Orders All transactions
****************************************************************************************/
class dealOrderAll extends modelclass
	{
		public function dealOrderAllListing()
			{
				$this->executeAction(false,"Transall",true,true);	
			}
		public function dealOrderAllTransall()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transallsearch");
				$sortData		=	$this->getData("request","Transallsearch");
				
				$sData			=	$this->dealOrderAllDotheSearch("Transall",$searchData,$sortData);
				extract($sData); 
				
				$sql			= "SELECT o.*,d.name as dealname,
								cu.fname as customerfname, cu.lname as customerlname,
								v.business_name as vendorname
								".$sqlFilter["selc"]."
								from vod_deal_order as o 
								join vod_deal as d on o.deal_id = d.id 
								join vod_customer as cu on cu.id = o.customer_id
								join vod_vendor as v on v.id = d.vendor_id
								".$sqlFilter["join"]."
								where 1 ".$sqlFilter["cond"].$sqlFilter["orderBy"];
				
				$this->addData(array("sql"=>$sql),"post","Transall",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT,15);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");

				$searchData			=	$this->getHtmlData($searchData,$exceptions=array("sales_combo","cat_combo","subcat_combo","sortData","cat_application"));
				foreach($data	as $key=>$val)
					{
						$amtPopUp	=	$this->getPopUpTable(array("Quantity","Unit Price","Total Amount"),array(array($val['quantity'],$val['unit_price'],$val['total_amount'])),"300");
						$dealPopUp	=	$this->getPopUpTable(array("Deal","Vendor","Sales Agent"), array($val['dealname'],$val['vendorname'],$val['s_agent_fname'].$val['s_agent_lname']),"300");
						$data[$key]["amountPopUp"]	=	$amtPopUp;
						$data[$key]["dealPopUp"]	=	$dealPopUp;
					}
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function dealOrderAllTransdaily()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transdailysearch");
				$sortData		=	$this->getData("request","Transdailysearch");
				$sData	=	$this->dealOrderAllDotheSearch("Transdaily",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by date(o.orderDate)";
				
				$sql		 =	"SELECT o.*, d.name as dealname,
									cu.fname as customerfname, cu.lname as customerlname,
									count(o.id) as tot_orders,
									count(distinct o.deal_id) as tot_deals,
									sum(o.quantity) as tot_quantity,
									sum(o.total_amount) as tot_total_amount,
									count(distinct o.customer_id) as tot_customer_id,
									sum(o.paid_status) as tot_paid,
									sum(o.used_coupons) as totredeemed,
									v.business_name as vendorname
									".$sqlFilter["selc"]."
									from vod_deal_order as o 
									join vod_deal as d on o.deal_id = d.id 
									join vod_customer as cu on cu.id = o.customer_id
									join vod_vendor as v on v.id = d.vendor_id
									".$sqlFilter["join"]."
									where 1 ".$sqlFilter["cond"].$sqlFilter["group"].$sqlFilter["orderBy"];
				
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT,15);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");

				$searchData			=	$this->getHtmlData($searchData,$exceptions=array("sales_combo","cat_combo","subcat_combo","sortData","cat_application"));
				foreach($data	as $key=>$val)
					{
						$amtPopUp	=	$this->getPopUpTable(array("Quantity","Unit Price","Total Amount"),array(array($val['quantity'],$val['unit_price'],$val['total_amount'])),"300");
						$dealPopUp	=	$this->getPopUpTable(array("Deal","Vendor","Sales Agent"), array($val['dealname'],$val['vendorname'],$val['s_agent_fname'].$val['s_agent_lname']),"300");
						$data[$key]["amountPopUp"]	=	$amtPopUp;
						$data[$key]["dealPopUp"]	=	$dealPopUp;
					}
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function dealOrderAllTransmonthly()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transmonthlysearch");
				$sortData		=	$this->getData("request","Transmonthlysearch");
				$sData	=	$this->dealOrderAllDotheSearch("Transmonthly",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by MONTHNAME(o.orderDate)";
				
				$sql		 =		"SELECT o.*,MONTHNAME(o.orderDate) as dealmonth,YEAR(o.orderDate) as dealyear,d.name as dealname,
									cu.fname as customerfname, cu.lname as customerlname,
									count(o.id) as tot_orders,
									count(distinct o.deal_id) as tot_deals,
									sum(o.quantity) as tot_quantity,
									sum(o.total_amount) as tot_total_amount,
									count(distinct o.customer_id) as tot_customer_id,
									sum(o.paid_status) as tot_paid,
									sum(o.used_coupons) as totredeemed,
									v.business_name as vendorname
									".$sqlFilter["selc"]."
									from vod_deal_order as o 
									join vod_deal as d on o.deal_id = d.id 
									join vod_customer as cu on cu.id = o.customer_id
									join vod_vendor as v on v.id = d.vendor_id
									".$sqlFilter["join"]."
									where 1 ".$sqlFilter["cond"].$sqlFilter["group"].$sqlFilter["orderBy"];
				
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT,15);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");

				$searchData			=	$this->getHtmlData($searchData,$exceptions=array("sales_combo","cat_combo","subcat_combo","sortData","cat_application"));
				foreach($data	as $key=>$val)
					{
						$amtPopUp	=	$this->getPopUpTable(array("Quantity","Unit Price","Total Amount"),array(array($val['quantity'],$val['unit_price'],$val['total_amount'])),"300");
						$dealPopUp	=	$this->getPopUpTable(array("Deal","Vendor","Sales Agent"), array($val['dealname'],$val['vendorname'],$val['s_agent_fname'].$val['s_agent_lname']),"300");
						$data[$key]["amountPopUp"]	=	$amtPopUp;
						$data[$key]["dealPopUp"]	=	$dealPopUp;
					}
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function dealOrderAllViewdealdetails()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("txt_dealId"=>$getData["id"]),"post","Search",true,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function dealOrderAllTransyearly()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transyearlysearch");
				$sortData		=	$this->getData("request","Transyearlysearch");
				$sData	=	$this->dealOrderAllDotheSearch("Transyearly",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by YEAR(o.orderDate)";
				
				$sql		 =		"SELECT o.*,YEAR(o.orderDate) as dealyear, d.name as dealname,
									cu.fname as customerfname, cu.lname as customerlname,
									count(o.id) as tot_orders,
									count(distinct o.deal_id) as tot_deals,
									sum(o.quantity) as tot_quantity,
									sum(o.total_amount) as tot_total_amount,
									count(distinct o.customer_id) as tot_customer_id,
									sum(o.paid_status) as tot_paid,
									sum(o.used_coupons) as totredeemed,
									v.business_name as vendorname
									".$sqlFilter["selc"]."
									from vod_deal_order as o 
									join vod_deal as d on o.deal_id = d.id 
									join vod_customer as cu on cu.id = o.customer_id
									join vod_vendor as v on v.id = d.vendor_id
									".$sqlFilter["join"]."
									where 1 ".$sqlFilter["cond"].$sqlFilter["group"].$sqlFilter["orderBy"];
				
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");

				$searchData			=	$this->getHtmlData($searchData,$exceptions=array("sales_combo","cat_combo","subcat_combo","sortData","cat_application"));
				foreach($data	as $key=>$val)
					{
						$amtPopUp	=	$this->getPopUpTable(array("Quantity","Unit Price","Total Amount"),array(array($val['quantity'],$val['unit_price'],$val['total_amount'])),"300");
						$dealPopUp	=	$this->getPopUpTable(array("Deal","Vendor","Sales Agent"), array($val['dealname'],$val['vendorname'],$val['s_agent_fname'].$val['s_agent_lname']),"300");
						$data[$key]["amountPopUp"]	=	$amtPopUp;
						$data[$key]["dealPopUp"]	=	$dealPopUp;
					}
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);				
			}
		public function dealOrderAllTranscomplete()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transcompletesearch");
				$sortData		=	$this->getData("request","Transcompletesearch");
				$sData			=	$this->dealOrderAllDotheSearch("Transcomplete",$searchData,$sortData);
				
				$tempSearch		=	"";
				if($searchData["txt_dealId"])		$tempSearch	.=	",group_concat(distinct d.name) as dealname";
				if($searchData["sales_agents"]) 	$tempSearch	.=	",group_concat(distinct au.fname) as s_agent_fname, group_concat(distinct au.lname) as s_agent_lname";
				if($searchData["deal_cat"] || $searchData["deal_sub_cat"])	$tempSearch	.=	",group_concat(distinct dc.category) as category,group_concat(distinct dsc.subcategory) as sub_cat";
				if($searchData["sel_apps"])			$tempSearch	.=	",group_concat(distinct apps.apps) as application";
				if($searchData["txt_vendorId"]) 	$tempSearch	.=	",group_concat(distinct v.business_name) as vendorname";
				if($searchData["txt_customerId"])	$tempSearch	.=	",group_concat(distinct cu.fname) as customerfname,group_concat(distinct cu.lname) as customerlname";

				extract($sData); 
				$sql			=	"SELECT count(d.name) as dealname_count,count(distinct o.customer_id) as tot_customers,
									 count(o.id) as tot_orders, count(distinct o.deal_id) as tot_deals,
									 sum(o.quantity) as tot_quantity, sum(o.total_amount) as total_amount,
									 sum(o.paid_status) as tot_paid, sum(o.used_coupons) as totredeemed,sum(o.balance_coupons) as totnotredeemed,count(v.id) as tot_vendors,
									 sum(o.paid_sitecredit) as tot_sitecredit,
									 sum(o.paid_cardamount) as tot_cardamount,
									 sum(o.gift_order)as tot_giftorder,
									 count(distinct v.saleagent_id) as tot_salesagents,
									 sum(d.vendor_commision*o.quantity) as tot_vendor_commsn,
									 sum(d.site_commision*o.quantity) as tot_site_commsn,
									 sum(d.sales_commision*o.quantity) as tot_sales_commsn
									 ".$tempSearch."
									 
									 from vod_deal_order as o
									 join vod_deal as d on o.deal_id = d.id 
									 join vod_customer as cu on cu.id = o.customer_id
									 join vod_vendor as v on v.id = d.vendor_id
									 ".$sqlFilter["join"]."
									 where 1".$sqlFilter["cond"].$sqlFilter["orderBy"];
				
				$dataArr				=	$this->getdbcontents_sql($sql);
				if(!$dataArr)				$this->setPageError("No Direct Access !!");
				$searchData				=	$this->getHtmlData($searchData,$exceptions=array("sales_combo","cat_combo","subcat_combo","sortData","cat_application"));
				return array("data"=>$dataArr,"searchdata"=>$searchData);
			}
		public function dealOrderAllGotoyearlyreport()
			{
				$data		=	$this->getData("request");
				$searchData	=	$this->getData("post","Transcompletesearch");
				$this->clearData("Transyearlysearch");
				$this->addData($searchData,"post","Transyearlysearch",false);
				$this->executeAction(false,"Transyearly",true,false);
			}
		public function dealOrderAllTransview()
			{
				$data		=	$this->getData("get","",true);	
				$sql		=	"SELECT o.*, d.name as dealname,
								d.coupon_status as coupon_status,
								vc.country,vs.state, 
								cu.fname as customerfname, 
								cu.lname as customerlname, 
								cu.email as customeremail,
								v.business_name as vendorname , 
								au.fname as s_agent_fname, au.lname as s_agent_lname ,
								dc.category,dsc.subcategory,
								d.vendor_comm_rate,d.vendor_commision,
								d.site_comm_rate, d.site_commision,
								d.sales_comm_rate,d.sales_commision,
								d.saleagent_id,d.vendor_id,
								d.cost,d.deal_price,d.offer_rate,
								apps.apps

								from vod_deal_order as o
								join vod_deal as d on o.deal_id = d.id
								join vod_customer as cu on cu.id = o.customer_id
								join vod_vendor as v on v.id = d.vendor_id
								left join vod_admin_users as au on au.id = d.saleagent_id
								left join vod_site_apps as apps on apps.id=o.apps_id 
								join vod_category_sub as dsc on dsc.id = d.subcategory_id 
								join vod_category as dc on dc.id = dsc.category_id 
								left join vod_country as vc on vc.id=o.billing_country
								left join vod_country_state as vs on vs.id=o.billing_state
								where 1 and o.id='".$data["id"]."'";
				
				$dataArr				=	$this->getdbcontents_sql($sql);
				if(!$dataArr)				$this->setPageError("No Direct Access !!");
				return array("data"=>$this->getHtmlData(end($dataArr)));
			}
		public function dealOrderAllTranscoupon()
			{
				$data		=	$this->getData("get","",true);	
				$sql		=	"select es.*,eo.customer_id as firstOwner,eo.coupon_code,
								eo.current_owner as currentOwner 
								from vod_deal_sendfriend as es 
								left join vod_deal_order eo on eo.id=es.dealcoupon_id 
								where 1 and es.dealcoupon_id='".$data["id"]."'";
				$dataArr	=	$this->getdbcontents_sql($sql);
				return array("data"=>$this->getHtmlData($dataArr),"coupon_code"=>$dataArr[0]['coupon_code'],"firstOwner"=>$dataArr[0]['firstOwner'],"currentOwner"=>$dataArr[0]['currentOwner']);
			}	
		public function dealOrderAllDotheSearch($action,$searchData,$sortData)
			{
				//setting default values
				if($searchData["sel_pay_status"]	==	"")	$searchData["sel_pay_status"]	=	"1";	
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"o.orderDate"),"request",$action);
						$this->addData(array("sortMethod"=>"desc"),"request",$action);
						$sortData	=	$this->getData("request",$action);
					}
				
				//sales agent combo
				$adminObj		=	new adminUser();
				$userSess 		=	end($adminObj->get_user_data());					
				$utId	 		=	$userSess["usertype"];
				$utypeid		=	GLB_SAGENT_UTYPEID;	
							
				if($utId		==	$utypeid)	$cond	=	" and id=".$userSess["id"];
				else							$cond	=	"";
				
				$salesAgents	=	$adminObj->getAdminUsers("usertype=".GLB_SAGENT_UTYPEID.$cond);
				$salesAgents	=	$this->get_combo_arr("sales_agents",$salesAgents,"id","fullname",$searchData["sales_agents"],"style='width:100px';");
				
				//Category combo
				$dealObj		=	new deals();
				$dealCat		=	$dealObj->getAllCategories();
				$dealCat		=	$this->get_combo_arr("deal_cat",$dealCat,"id","category",$searchData["deal_cat"],"style='width:100px'; onchange='getsubcat(this.value,\"id_search_subcat\")'","All Category");
				
				//subcategory combo
				$dealSubCat		=	$dealObj->getAllSubCategories("category_id=".$searchData["deal_cat"]);
				$dealSubCat		=	$this->get_combo_arr("deal_sub_cat",$dealSubCat,"id","subcategory",$searchData["deal_sub_cat"],"","All Sub Category");
				
				//Application combo
				$masterObj		=	new masters();
				$appCombo		=	$masterObj->getAllDetails("vod_site_apps");
				$appCombo		=	$this->get_combo_arr("sel_apps",$appCombo,"id","apps",$searchData["sel_apps"],"","All");
				
				$searchData["sortData"]			=	$sortData;
				$searchData["sales_combo"]		=	$salesAgents; 
				$searchData["cat_application"]	=	$appCombo;
				$searchData["cat_combo"]		=	$dealCat;
				$searchData["subcat_combo"]		=	$dealSubCat;
				
				if(trim($searchData["sales_agents"]))			
					{
						$sqlFilter["join"]	.=	" left join	 vod_admin_users as au on au.id = d.saleagent_id ";
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "d.saleagent_id",$searchData["sales_agents"]);
						$sqlFilter["selc"]	.=	" ,au.fname as s_agent_fname, au.lname  as s_agent_lname ";	
					}
				if(trim($searchData["deal_sub_cat"])	||	trim($searchData["deal_cat"]))			
					{
						$sqlFilter["join"]	.=	"  join vod_category_sub as dsc on dsc.id = d.subcategory_id join vod_category as dc on dc.id = dsc.category_id   ";
						$sqlFilter["selc"]	.=	" ,dc.category,dsc.subcategory ";
					}
				if(trim($searchData["sel_apps"]))				
					{
						$sqlFilter["join"]	.=	" left join vod_site_apps as apps on apps.id=o.apps_id ";
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "o.apps_id",$searchData["sel_apps"]);
						$sqlFilter["selc"]	.=	" ,apps.apps as application";
					}
				if(trim($searchData["sel_amount_field_from"])	&&	trim($searchData["txt_amount_field_from"]))
					{
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond(">=",$searchData["sel_amount_field_from"],$searchData["txt_amount_field_from"]);
					}
				if(trim($searchData["sel_amount_field_to"])	&&	trim($searchData["txt_amount_field_to"]))
					{
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("<=",$searchData["sel_amount_field_to"],$searchData["txt_amount_field_to"]);
					}
				if(trim($searchData["txt_customerId"]))			
					{
						$sqlFilter["cond"]	.=	" and(".$this->dbSearchCond("=", "cu.id",$searchData["txt_customerId"])." or ".$this->dbSearchCond("=", "cu.email",$searchData["txt_customerId"]).")";	
					}
				if(trim($searchData["txt_vendorId"]))			
					{
						$sqlFilter["cond"]	.=	" and(".$this->dbSearchCond("=", "v.id",$searchData["txt_vendorId"])." or ".$this->dbSearchCond("=", "v.email",$searchData["txt_vendorId"]).")";	
					}
				if(trim($searchData["sel_coupon_shared"])==	"shared")			
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("!=", "o.current_owner","o.last_owner",true);	
					}	
				if(trim($searchData["sel_coupon_shared"])==	"notshared")			
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "o.current_owner","o.last_owner",true);	
					}	
										
				if($utId		==	$utypeid)					$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "d.saleagent_id",$userSess["id"]);
				
				//search conditions
				if(trim($searchData["txt_orderId"]))			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "o.id",$searchData["txt_orderId"]);
				if(trim($searchData["sel_pay_status"])>=0)		$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "o.paid_status",$searchData["sel_pay_status"]);
				if(trim($searchData["sel_redeem_option"])!="")	$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "o.redeem_status",$searchData["sel_redeem_option"]);
				if(trim($searchData["sel_coupon_status"])!="")	$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "d.coupon_status",$searchData["sel_coupon_status"]);
				if(trim($searchData["deal_cat"]))				$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "dc.id",$searchData["deal_cat"]);
				if(trim($searchData["deal_sub_cat"]))			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "dsc.id",$searchData["deal_sub_cat"]);
				if(trim($searchData["sel_pay_option"])!="")		$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "o.pay_option",$searchData["sel_pay_option"]);
				
				if(trim($searchData["txt_order_from"]))			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond(">=", "date(o.orderDate)",$searchData["txt_order_from"]);
				if(trim($searchData["txt_order_to"]))			$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("<=", "date(o.orderDate)",$searchData["txt_order_to"]);
				if(trim($searchData["txt_dealId"]))				$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "o.deal_id",$searchData["txt_dealId"]);
					
				$sqlFilter["orderBy"]		.=	" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$searchData["dqlFilter"]	=	$sqlFilter;
				return array("searchData"=>$searchData,"sortData"=>$sortData,"sqlFilter"=>$sqlFilter);
			}
		public function dealOrderAllTransallcsv()
			{	
				$sqlData		=	$this->getData("post","Transall",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Order Id','Order Date','Deal Name','Amount','Customer Name','Total Coupons','Redeemed Coupons','Billing Fname','Billing Lname','Billing Address','Billing City','Billing Zip');
						$fieldArr		=	array('id','orderDate','dealname','total_amount','customerfname','quantity','used_coupons','billing_fname','billing_lname','billing_address','billing_city','billing_zip');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"DealOrdersAll");						
					}
			}	
		public function dealOrderAllTransdailycsv()
			{	
				$sqlData		=	$this->getData("post","Transdaily",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Date','Orders','Deals','Total Coupons','Total Amount','Customers','Paid','Redeemed Coupons','Billing Fname','Billing Lname','Billing Address','Billing City','Billing Zip');
						$fieldArr		=	array('orderDate','tot_orders','tot_deals','tot_quantity','tot_total_amount','tot_customer_id','tot_paid','totredeemed','billing_fname','billing_lname','billing_address','billing_city','billing_zip');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"DealOrdersDaily");						
					}
			}	
		public function dealOrderAllTransmonthlycsv()
			{	
				$sqlData		=	$this->getData("post","Transmonthly",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Month','Orders','Deals','Total Coupons','Redeemed Coupons','Total Amount','Customers','Paid');
						$fieldArr		=	array('dealyear','dealmonth','tot_orders','tot_deals','tot_quantity','totredeemed','tot_total_amount','tot_customer_id','tot_paid');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"DealOrdersMonthly");						
					}
			}	
		public function dealOrderAllTransyearlycsv()
			{	
				$sqlData		=	$this->getData("post","Transyearly",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Orders','Deals','Total Coupons','Redeemed Coupons','Total Amount','Customers','Paid');
						$fieldArr		=	array('dealyear','tot_orders','tot_deals','tot_quantity','totredeemed','tot_total_amount','tot_customer_id','tot_paid');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"DealOrdersYearly");						
					}
			}	
			
		public function dealOrderAllCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function dealOrderAllSetpaid()
			{
				$data		=	$this->getData("post","",true);
				$checkone	=	implode(",", $data["checkone"]);
				$datVals	=	array("paid_date"=>"escape now() escape","paid_status"=>GLB_DEAL_PAID);
				$this->db_update("vod_deal_order",$datVals,"id in($checkone)");
				if($this->getDbErrors())	$this->setPageError($this->getDbErrors());
				else 						$this->setPageError("status changed to paid for ".mysql_affected_rows()." records");
				$this->executeAction(false,"Transall",true,true);
			}
		public function dealOrderAllSetnotpaid()
			{
				$data		=	$this->getData("post","",true);
				$checkone	=	implode(",", $data["checkone"]);
				$datVals	=	array("paid_status"=>GLB_DEAL_NOT_PAID);
				$this->db_update("vod_deal_order",$datVals,"id in($checkone)");
				if($this->getDbErrors())	$this->setPageError($this->getDbErrors());
				else 						$this->setPageError("status changed to not paid for ".mysql_affected_rows()." records");
				$this->executeAction(false,"Transall",true,true);
			}
		public function dealOrderAllGetsubcatcombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$dealObj			=	new deals();
				$dealSubCat			=	$dealObj->getAllSubCategories("category_id=".$data["cid"]);
				echo $dealSubCat	=	$this->get_combo_arr("deal_sub_cat",$dealSubCat,"id","subcategory","","","All Sub Category");
				exit;
			}
		public function dealOrderAllGotransall()
			{
				$data		=	$this->getData("request");
				$searchData	=	$this->getData("post","Transdailysearch");
				$this->clearData("Transallsearch");
				$this->addData($searchData,"post","Transallsearch",false);
				$this->addData(array("txt_order_from"=>$data['datesearch'],"txt_order_to"=>$data['datesearch']),"post","Transallsearch",false);
				$this->executeAction(false,"Transall",true,false);
			}
		public function dealOrderAllGotransdaily()
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
		public function dealOrderAllGotransmonthly()
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
		public function dealOrderAllTransallsearch()
			{
				$this->executeAction(false,"Transall",true);
			}	
		public function dealOrderAllTransdailysearch()
			{
				$this->executeAction(false,"Transdaily",true);
			}	
		public function dealOrderAllTransmonthlysearch()
			{
				$this->executeAction(false,"Transmonthly",true);
			}	
		public function dealOrderAllTransyearlysearch()
			{
				$this->executeAction(false,"Transyearly",true);
			}	
		public function dealOrderAllTranscompletesearch()
			{
				$this->executeAction(false,"Transcomplete",true);
			}	
		public function dealOrderAllTransallreset()
			{
				$this->clearData("Transallsearch");
				$this->executeAction(false,"Transall",true,false);	
			}	
		public function dealOrderAllTransdailyreset()
			{
				$this->clearData("Transdailysearch");
				$this->executeAction(false,"Transdaily",true,false);	
			}	
		public function dealOrderAllTransmonthlyreset()
			{
				$this->clearData("Transmonthlysearch");
				$this->executeAction(false,"Transmonthly",true,false);	
			}	
		public function dealOrderAllTransyearlyreset()
			{
				$this->clearData("Transyearlysearch");
				$this->executeAction(false,"Transyearly",true,false);	
			}
		public function dealOrderAllTranscompletereset()
			{
				$this->clearData("Transcompletesearch");
				$this->executeAction(false,"Transcomplete",true,false);	
			}	
		public function getCustomerPersonalDetails($id,$args="1")
			{
				$customer	=	new customer();
				return end($customer->getCustomerPersonalDetails($id,$args));
			} 
		public function dealOrderAllLinktodealdetails()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","dealsList.php");
				$this->addData(array("sales_agents"=>$data['sales_agent']),"post","Search",false,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function dealOrderAllLinktovendordetails()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","vendors.php");
				$this->addData(array("userId"=>$data['vendor_id']),"post","Search",false,"vendors.php");
				$this->executeAction(false,"Search",true,false,"","","vendors.php");
			}
		public function dealOrderAllLinktocustomerdetails()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","customers.php");
				$this->addData(array("txt_customerId"=>$data['customer_id']),"post","Search",false,"customers.php");
				$this->executeAction(false,"Search",true,false,"","","customers.php");
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
