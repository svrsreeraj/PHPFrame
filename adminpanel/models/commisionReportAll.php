<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-12-16
Purpose		:	Commision Report
****************************************************************************************/
class commisionReportAll extends modelclass
	{
		public function commisionReportAllListing()
			{
				$this->executeAction(false,"Transall",true,true);	
			}
		public function commisionReportAllTransall()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transallsearch");
				$sortData		=	$this->getData("request","Transallsearch");
				
				$sData			=	$this->commisionReportAllDotheSearch("Transall",$searchData,$sortData);
				extract($sData); 
				
				$sql		 =	"SELECT vc.*,o.customer_id,o.orderDate,d.name as dealname,
								cu.fname as customerfname, cu.lname as customerlname,
								v.business_name as vendorname,o.quantity,
								au.fname as s_agent_fname, au.lname  as s_agent_lname 
								".$sqlFilter["selc"]."
								from vod_deal_commision as vc
								join vod_deal_order o on o.id=vc.order_id
								join vod_deal as d on o.deal_id = d.id 
								join vod_customer as cu on cu.id = o.customer_id
								join vod_vendor as v on v.id = d.vendor_id
								left join vod_admin_users as au on au.id = d.saleagent_id 
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
						$dealPopUp	=	$this->getPopUpTable(array("Deal","Vendor","Sales Agent"), array($val['dealname'],$val['vendorname'],$val['s_agent_fname']."".$val['s_agent_lname']),"300");
						$data[$key]["amountPopUp"]	=	$amtPopUp;
						$data[$key]["dealPopUp"]	=	$dealPopUp;
					}
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);	
			}
		public function commisionReportAllTransdaily()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transdailysearch");
				$sortData		=	$this->getData("request","Transdailysearch");
				$sData	=	$this->commisionReportAllDotheSearch("Transdaily",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by date(o.orderDate)";
				
				$sql		 =		"SELECT sum(vc.vendor_commision)as tot_commsn_vendor,
									sum(vc.site_commision)as tot_commsn_site,
									sum(vc.sales_commision)as tot_commsn_sales,
									o.orderDate,sum(o.quantity) as tot_quantity,
									o.customer_id,count(o.id) as tot_orders,count(d.id) as tot_deals,
									d.name as dealname,count(distinct o.customer_id) as tot_customers,
									cu.fname as customerfname, cu.lname as customerlname,
									v.business_name as vendorname,
									au.fname as s_agent_fname, au.lname  as s_agent_lname 
									".$sqlFilter["selc"]."
									from vod_deal_commision as vc
									join vod_deal_order o on o.id=vc.order_id
									join vod_deal as d on o.deal_id = d.id 
									join vod_customer as cu on cu.id = o.customer_id
									join vod_vendor as v on v.id = d.vendor_id
									left join vod_admin_users as au on au.id = d.saleagent_id 
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
		public function commisionReportAllTransmonthly()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transmonthlysearch");
				$sortData		=	$this->getData("request","Transmonthlysearch");
				$sData	=	$this->commisionReportAllDotheSearch("Transmonthly",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by MONTHNAME(o.orderDate)";
				
				$sql		 =		"SELECT MONTHNAME(o.orderDate) as dealmonth,YEAR(o.orderDate) as dealyear,
									sum(vc.vendor_commision)as tot_commsn_vendor,o.orderDate,
									sum(vc.site_commision)as tot_commsn_site,
									sum(vc.sales_commision)as tot_commsn_sales,
									sum(o.quantity) as tot_quantity,
									o.customer_id,count(o.id) as tot_orders,count(d.id) as tot_deals,
									d.name as dealname,count(distinct o.customer_id) as tot_customers,
									cu.fname as customerfname, cu.lname as customerlname,
									v.business_name as vendorname,
									au.fname as s_agent_fname, au.lname  as s_agent_lname 
									".$sqlFilter["selc"]."
									from vod_deal_commision as vc
									join vod_deal_order o on o.id=vc.order_id
									join vod_deal as d on o.deal_id = d.id 
									join vod_customer as cu on cu.id = o.customer_id
									join vod_vendor as v on v.id = d.vendor_id
									left join vod_admin_users as au on au.id = d.saleagent_id 
									".$sqlFilter["join"]."
									where 1  ".$sqlFilter["cond"].$sqlFilter["group"].$sqlFilter["orderBy"];
				
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
		public function commisionReportAllTransyearly()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transyearlysearch");
				$sortData		=	$this->getData("request","Transyearlysearch");
				$sData			=	$this->commisionReportAllDotheSearch("Transyearly",$searchData,$sortData);
				extract($sData);
				
				$sqlFilter["group"]	=	"group by YEAR(o.orderDate)";
				
				$sql		 =		"SELECT YEAR(o.orderDate) as dealyear,
									sum(vc.vendor_commision)as tot_commsn_vendor,sum(o.quantity),
									sum(vc.site_commision)as tot_commsn_site,o.orderDate,
									sum(vc.sales_commision)as tot_commsn_sales,sum(o.quantity) as tot_quantity,
									o.customer_id,count(o.id) as tot_orders,count(d.id) as tot_deals,
									d.name as dealname,count(distinct o.customer_id) as tot_customers,
									cu.fname as customerfname, cu.lname as customerlname,
									v.business_name as vendorname,
									au.fname as s_agent_fname, au.lname  as s_agent_lname 
									".$sqlFilter["selc"]."
									from vod_deal_commision as vc
									join vod_deal_order o on o.id=vc.order_id
									join vod_deal as d on o.deal_id = d.id 
									join vod_customer as cu on cu.id = o.customer_id
									join vod_vendor as v on v.id = d.vendor_id
									left join vod_admin_users as au on au.id = d.saleagent_id 
									".$sqlFilter["join"]."
									where 1".$sqlFilter["cond"].$sqlFilter["group"].$sqlFilter["orderBy"];
				
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
		public function commisionReportAllTranscomplete()
			{
				$this->permissionCheck("View",1);
				
				$searchData		=	$this->getData("post","Transcompletesearch");
				$sortData		=	$this->getData("request","Transcompletesearch");
				$sData			=	$this->commisionReportAllDotheSearch("Transcomplete",$searchData,$sortData);
				
				$tempSearch		=	"";
				if($searchData["txt_dealId"])		$tempSearch	.=	",group_concat(distinct d.name) as dealname";
				if($searchData["sales_agents"]) 	$tempSearch	.=	",group_concat(distinct au.fname) as s_agent_fname, group_concat(distinct au.lname) as s_agent_lname";
				if($searchData["deal_cat"] || $searchData["deal_sub_cat"])	$tempSearch	.=	",group_concat(distinct dc.category) as category,group_concat(distinct dsc.subcategory) as sub_cat";
				if($searchData["sel_apps"])			$tempSearch	.=	",group_concat(distinct apps.apps) as application";
				if($searchData["txt_vendorId"]) 	$tempSearch	.=	",group_concat(distinct v.business_name) as vendorname";
				if($searchData["txt_customerId"])	$tempSearch	.=	",group_concat(distinct cu.fname) as customerfname,group_concat(distinct cu.lname) as customerlname";
				
				extract($sData); 
				$sql			=	"SELECT count(o.id) as tot_order,sum(vc.vendor_commision) as tot_vendor_commsn,
									sum(vc.site_commision) as tot_site_commsn,sum(vc.sales_commision) as tot_sales_commsn,
									count(distinct o.customer_id) as tot_customers,count(distinct o.deal_id) as tot_deals,
									sum(o.redeem_status) as tot_redeemed,sum(o.quantity) as tot_quantity
									 ".$tempSearch."
									
									FROM vod_deal_commision as vc 
									join `vod_deal_order` as o on o.id=vc.order_id
									join vod_deal as d on o.deal_id = d.id 
									join vod_customer as cu on cu.id = o.customer_id
									join vod_vendor as v on v.id = d.vendor_id
									left join vod_admin_users as au on au.id = d.saleagent_id 
									".$sqlFilter["join"]."
									where 1".$sqlFilter["cond"].$sqlFilter["orderBy"];
									 
				$dataArr				=	$this->getdbcontents_sql($sql);
				if(!$dataArr)				$this->setPageError("No Direct Access !!");
				$searchData				=	$this->getHtmlData($searchData,$exceptions=array("sales_combo","cat_combo","subcat_combo","sortData","cat_application"));
				return array("data"=>$dataArr,"searchdata"=>$searchData);
			}
		public function commisionReportAllGotoyearlyreport()
			{
				$data		=	$this->getData("request");
				$searchData	=	$this->getData("post","Transcompletesearch");
				$this->clearData("Transyearlysearch");
				$this->addData($searchData,"post","Transyearlysearch",false);
				$this->executeAction(false,"Transyearly",true,false);
			}
		public function commisionReportAllDotheSearch($action,$searchData,$sortData)
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
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "d.saleagent_id",$searchData["sales_agents"]);
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
		public function commisionReportAllTransallcsv()
			{	
				$sqlData		=	$this->getData("post","Transall",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Order Id','Order Date','quantity','Deal Name','Customer Name','Vendor Commision','Site Commision ','Sales Commision');
						$fieldArr		=	array('id','orderDate','quantity','dealname','customerfname','vendor_commision','site_commision','sales_commision');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"commisionReportAll");						
					}
			}	
		public function commisionReportAllTransdailycsv()
			{	
				$sqlData		=	$this->getData("post","Transdaily",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Order Date','Orders','total Quantity','Deals','Customers','Vendor Commision','Site Commision','Sales Commision');
						$fieldArr		=	array('orderDate','tot_orders','tot_quantity','tot_deals','tot_customers','tot_commsn_vendor','tot_commsn_site','tot_commsn_sales');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"commisionReportDaily");						
					}
			}	
		public function commisionReportAllTransmonthlycsv()
			{	
				$sqlData		=	$this->getData("post","Transmonthly",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Month','Orders','total Quantity','Deals','Customers','Vendor Commision','Site Commision','Sales Commision');
						$fieldArr		=	array('dealyear','dealmonth','tot_orders','tot_quantity','tot_deals','tot_customers','tot_commsn_vendor','tot_commsn_site','tot_commsn_sales');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"commisionReportMonthly");						
					}
			}	
		public function commisionReportAllTransyearlycsv()
			{	
				$sqlData		=	$this->getData("post","Transyearly",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('Year','Orders','total Quantity','Deals','Customers','Vendor commision','Site Commision','Sales Commision');
						$fieldArr		=	array('dealyear','tot_orders','tot_quantity','tot_deals','tot_customers','tot_commsn_vendor','tot_commsn_site','tot_commsn_sales');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"commisionReportYearly");						
					}
			}	
			
		public function commisionReportAllCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function commisionReportAllGetsubcatcombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$dealObj			=	new deals();
				$dealSubCat			=	$dealObj->getAllSubCategories("category_id=".$data["cid"]);
				echo $dealSubCat	=	$this->get_combo_arr("deal_sub_cat",$dealSubCat,"id","subcategory","","","All Sub Category");
				exit;
			}
		public function commisionReportAllGotransall()
			{
				$data				=	$this->getData("request");
				$searchData			=	$this->getData("post","Transdailysearch");
				$this->clearData("Transallsearch");
				$this->addData($searchData,"post","Transallsearch",false);
				$this->addData(array("txt_order_from"=>$data['datesearch'],"txt_order_to"=>$data['datesearch']),"post","Transallsearch",false);
				$this->executeAction(false,"Transall",true,false);
			}
		public function commisionReportAllGotransdaily()
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
		public function commisionReportAllGotransmonthly()
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
		public function commisionReportAllTransallsearch()
			{
				$this->executeAction(false,"Transall",true);
			}	
		public function commisionReportAllTransdailysearch()
			{
				$this->executeAction(false,"Transdaily",true);
			}	
		public function commisionReportAllTransmonthlysearch()
			{
				$this->executeAction(false,"Transmonthly",true);
			}	
		public function commisionReportAllTransyearlysearch()
			{
				$this->executeAction(false,"Transyearly",true);
			}	
		public function commisionReportAllTranscompletesearch()
			{
				$this->executeAction(false,"Transcomplete",true);
			}	
		public function commisionReportAllTransallreset()
			{
				$this->clearData("Transallsearch");
				$this->executeAction(false,"Transall",true,false);	
			}	
		public function commisionReportAllTransdailyreset()
			{
				$this->clearData("Transdailysearch");
				$this->executeAction(false,"Transdaily",true,false);	
			}	
		public function commisionReportAllTransmonthlyreset()
			{
				$this->clearData("Transmonthlysearch");
				$this->executeAction(false,"Transmonthly",true,false);	
			}	
		public function commisionReportAllTransyearlyreset()
			{
				$this->clearData("Transyearlysearch");
				$this->executeAction(false,"Transyearly",true,false);	
			}
		public function commisionReportAllTranscompletereset()
			{
				$this->clearData("Transcompletesearch");
				$this->executeAction(false,"Transcomplete",true,false);	
			}	
		public function getCustomerPersonalDetails($id)
			{
				$customer	=	new customer();
				return end($customer->getCustomerPersonalDetails($id));
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
