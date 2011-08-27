<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-11-24
Purpose		:	Manage Customers
****************************************************************************************/
class customers extends modelclass  
	{
		public function customersListing()
			{
				$this->permissionCheck("View",1); 
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$customerObj	=	new customer;
				$dealObj		=	new deals();
				
				//country drop down
				$terObj			=	new territory();
				$countryData	=	$terObj->getAllCountries("1 order by preference asc");
				$countryData	=	$this->get_combo_arr("sel_country",$countryData,"id","country",$searchData["sel_country"],"style='width:100px;' onchange='getStates(this.value,\"id_search_state\")'","Any Country");
				
				//State drop down
				$stateData	=	$terObj->getAllStates("country_id =".$searchData["sel_country"]." order by preference asc");
				$stateData	=	$this->get_combo_arr("sel_state",$stateData,"id","state",$searchData["sel_state"],"","Any State");
				
				//Application combo
				$masterObj		=	new masters();
				$appCombo		=	$masterObj->getAllDetails("vod_site_apps");
				$appCombo		=	$this->get_combo_arr("sel_apps",$appCombo,"id","apps",$searchData["sel_apps"],"","All");
				
				//cat combo
				$catCombo		=	$dealObj->getOptGroup('sel_opt_cat[]','style="width:170px;height:150px;"',$searchData["sel_opt_cat"]);
				
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"cu.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				//searching conditions.... enter at your own risk !!
				if(trim($searchData["keyword"]))
					{ 
						$sqlFilter["cond"]	.=	" And ( ";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "concat(cu.fname,' ',cu.lname)", "%".trim($searchData["keyword"])."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "cu.email", "%".trim($searchData["keyword"])."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "cu.mobile", "%".trim($searchData["keyword"])."%");
						$sqlFilter["cond"]	.=	") ";
					}
				if(trim($searchData["sel_country"])!="")		
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "cu.country_id",$searchData["sel_country"]);
						$sqlFilter["join"]	.=	" left join vod_country as cntry on cntry.id = cu.country_id ";
						$sqlFilter["selc"]	.=	" ,cntry.country ";
					}
				if(trim($searchData["sel_state"])!="")			
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "cu.state_id",$searchData["sel_state"]);
						$sqlFilter["join"]	.=	" left join vod_country_state as state on state.id = cu.state_id ";
						$sqlFilter["selc"]	.=	" ,state.state ";
					}
				if(trim($searchData["sel_amount_field_from"])=="votes"	||	trim($searchData["sel_amount_field_to"])=="votes"	||	in_array("votes", $searchData["sel_filter_users"]))			
					{
						$sqlFilter["join"]	.=	" left join (select count(*) as totalvotes,customer_id  from vod_customer_votes group by customer_id) as cv on cv.customer_id = cu.id ";
						$sqlFilter["selc"]	.=	" ,totalvotes ";
					}
				/*if(trim($searchData["sel_amount_field_from"])=="sitecredits"	||	trim($searchData["sel_amount_field_to"])=="sitecredits"	||	in_array("sitecredit", $searchData["sel_filter_users"]))			
					{
						$sqlFilter["join"]	.=	" left join vod_customer_sitecredits as cs on cs.customer_id = cu.id ";
						$sqlFilter["selc"]	.=	" ,cs.total_credit";
					}*/
				if(trim($searchData["sel_amount_field_from"])=="referrals"	||	trim($searchData["sel_amount_field_to"])=="referrals"	||	in_array("referrals", $searchData["sel_filter_users"]))			
					{
						$sqlFilter["join"]	.=	" left join (select count(*) as totalreferrals,customer_id  from vod_customer_invites group by customer_id) as ci on ci.customer_id = cu.id ";
						$sqlFilter["selc"]	.=	" ,totalreferrals ";
					}
				if(trim($searchData["sel_amount_field_from"])=="deals"	||	trim($searchData["sel_amount_field_to"])=="deals"	||	in_array("productive", $searchData["sel_filter_users"]))			
					{
						$sqlFilter["join"]	.=	" left join (select count(*) as totaldeals,customer_id  from vod_deal_order where paid_status=".GLB_DEAL_PAID." group by customer_id) as cd on cd.customer_id = cu.id ";
						$sqlFilter["selc"]	.=	" ,totaldeals ";
					}
				if(trim($searchData["sel_amount_field_from"])=="ecom"	||	trim($searchData["sel_amount_field_to"])=="ecom"	||	in_array("ecom", $searchData["sel_filter_users"]))			
					{
						$sqlFilter["join"]	.=	" left join (select count(*) as totalecomorders,customer_id  from vod_ecomm_order where paid_status=".GLB_ECOM_PAID." group by customer_id) as cecom on cecom.customer_id = cu.id ";
						$sqlFilter["selc"]	.=	" ,totalecomorders ";
					}
				if($searchData["sel_opt_cat"])
					{
						$sqlFilter["join"]	.=	" left join (select count(*) as totalinterests,customer_id  from vod_customer_interest where subcategory_id in(".implode(",",$searchData["sel_opt_cat"]).") group by customer_id) as cint on cint.customer_id = cu.id ";
						$sqlFilter["selc"]	.=	" ,totalinterests ";
					}
				
				if(trim($searchData["txt_customerId"]))			
					{
						$sqlFilter["cond"]	.=	" and(".$this->dbSearchCond("=", "cu.id",$searchData["txt_customerId"])." or ".$this->dbSearchCond("=", "cu.email",$searchData["txt_customerId"]).")";	
					}
				if(trim($searchData["txt_join_from"]))			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(cu.date_added)",$searchData["txt_join_from"]);
				if(trim($searchData["txt_join_to"]))			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(cu.date_added)",$searchData["txt_join_to"]);
				if(trim($searchData["sel_status"])!="")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "cu.status",$searchData["sel_status"]);
				if(trim($searchData["sel_apps"])!="")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "cu.apps_id",$searchData["sel_apps"]);
					
				if(trim($searchData["sel_amount_field_from"])=="votes")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "totalvotes",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="points")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "cu.total_points",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="sitecredits")	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "cs.total_credit",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="referrals")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "totalreferrals",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="deals")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "totaldeals",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="ecom")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "totalecomorders",$searchData["txt_amount_field_from"]);

				if(trim($searchData["sel_amount_field_to"])=="votes")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "totalvotes",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="points")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "cu.total_points",$searchData["txt_amount_field_to"]);
/*				if(trim($searchData["sel_amount_field_to"])=="sitecredits")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "cs.total_credit",$searchData["txt_amount_field_to"]);
*/				if(trim($searchData["sel_amount_field_to"])=="referrals")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "totalreferrals",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="deals")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "totaldeals",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="ecom")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "totalecomorders",$searchData["txt_amount_field_to"]);
				
				if(in_array("productive", $searchData["sel_filter_users"]))		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "totaldeals","0");
				if(in_array("ecom", $searchData["sel_filter_users"]))			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "totalecomorders","0");
				if(in_array("facebook", $searchData["sel_filter_users"]))		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "cu.from_fb","1");
				if(in_array("votes", $searchData["sel_filter_users"]))			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "totalvotes","0");
				if(in_array("sitepoints", $searchData["sel_filter_users"]))		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "cu.total_points","0");
				if(in_array("sitecredit", $searchData["sel_filter_users"]))		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "cs.total_credit","0");
				if(in_array("referrals", $searchData["sel_filter_users"]))		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "totalreferrals","0");
				
				if($searchData["sel_opt_cat"])									$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "totalinterests",count($searchData["sel_opt_cat"]));
				
				if($hveCond)		$hveCond	=	"having 1 $hveCond";
				$orderBy			=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				=	"SELECT cu.*,concat(fname,' ',lname) as fullname
										".$sqlFilter["selc"]."
										from vod_customer as cu
										".$sqlFilter["join"]."
										where 1 ".$sqlFilter["cond"]." $orderBy";
				
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				 		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				 		=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)	$this->setPageError("No records found !");
				$searchData			 		=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				
				$searchData["country_combo"]	=	$countryData; 
				$searchData["state_combo"]		=	$stateData; 
				$searchData["cat_application"]	=	$appCombo;	
				$searchData["sel_opt_cat"]		=	$catCombo;	
				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function customersGetcsv() 
			{	
				$sqlData		=	$this->getData("post","Listing",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('FIRST NAME','LAST NAME','EMAIL','MOBILE','ZIP','STATUS');
						$fieldArr		=	array('fname','lname','email','mobile','zip','status');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"CustomersList");						
					}
			}	
		public function customersCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function customersReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function customersGetstatecombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$terObj				=	new territory();
				$stateData			=	$terObj->getAllStates("country_id=".$data["cid"]);
				echo $stateData		=	$this->get_combo_arr("sel_state",$stateData,"id","state",$searchData["sel_state"],"","Any State");
				exit;
			}	
		public function customersEditform()
			{
				$data				=	$this->getData("get");
				$customerObj		=	new customer();
				$dealObj			=	new deals();
				$masterObj			=	new masters();
				$dataArr			=	end($customerObj->getCustomerPersonalDetails($data["id"]));
				$subcat_id			=	$customerObj->getCustomerInterests($data["id"]);
				foreach($subcat_id as $key=>$val)		$intrstArr[]	=	$val["subcategory_id"];	
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$subcat_combo		=	$dealObj->getOptGroup('subcategory_id[]','style="width:190px;height:150px;"',$intrstArr);
				//$subcat_combo		=	$this->get_combo_multiple("subcategory_id[]",$dealObj->getAllSubCategories(),"id","subcategory",$subcat_ids,'style="width:170px;height:150px;"');
				$country_combo		=	$this->get_combo_arr("country_id",$masterObj->getAllDetails("vod_country","status='1' order by preference"),"id","country",$dataArr["country_id"],"'valtype='emptyCheck-please select a country' onchange=\"getcombo(this.value,'stateDivId');\"");
				$state_combo		=	$this->get_combo_arr("state_id",$masterObj->getAllDetails("vod_country_state","status='1' and country_id=".$dataArr["country_id"]."  order by preference"),"id","state",$dataArr["state_id"],"valtype='emptyCheck-please select a state'");
				return array("data"=>$this->getHtmlData($dataArr),"country_combo"=>$country_combo,"state_combo"=>$state_combo,"subcat_combo"=>$subcat_combo);
			}
		public function customersViewform()
			{
				$this->permissionCheck("View",1);
				$data				=	$this->getData("get");
				$customerObj		=	new customer();
				$dealObj			=	new deals();
				$masterObj			=	new masters();
				$dataArr			=	end($customerObj->getCustomerPersonalDetails($data["id"]));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				
				$catData			=	$customerObj->getCatAndSubCatInterests($data["id"]);
				$dataArr["catData"]	=	$catData;
				
				$country_name		=	$masterObj->getName("vod_country","country","id=".$dataArr['country_id']);
				$state_name			=	$masterObj->getName("vod_country_state","state","id=".$dataArr['state_id']);	
				$refdata			=	$customerObj->getCustomerInviteEmailCounts($dataArr['id']);
				$custorders			=	$customerObj->getCustomerOrderCount($dataArr['id']);
				$sitepoints			=	$customerObj->getcustomerSitePointsSum($dataArr['id']);
				$sitecredit			=	$customerObj->getCustomerSiteCredits($dataArr['id']);
				$vote				=	$customerObj->getCountOfCustomerVotes($dataArr['id']);
				$ecomData			=	$customerObj->getCustomerEcomTotall($dataArr['id']);
				$customerQstnArry	=	$customerObj->getCustomerQuestionnaire($dataArr['id']);
				$tot_ref			=	$this->getdbcontents_sql("select count(referred_by) as count from vod_customer where referred_by=3");
				
				return array("data"=>$this->getHtmlData($dataArr),"country"=>$country_name,"state"=>$state_name,"refdata"=>$refdata,"custorders"=>$custorders,"sitepoints"=>$sitepoints,"sitecredit"=>$sitecredit[0],"vote"=>$vote,"ecomData"=>$ecomData,"questncount"=>$customerQstnArry,"tot_ref"=>$tot_ref[0]["count"]);
					
			}
		public function customersSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
				
		public function customersUpdatedata()
			{
				$customerObj		=	new customer();
				$defaultObj			=	new defaults();
				$data				=	$this->getData("request");
				$data				=	$this->getData("files");
				if($data[fileImage][name])
					{
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
						$adimg		=	$upObj->copy("fileImage","../images/customers",2);
						if($adimg)		$upObj->img_resize("100","120","../images/customers/thumb");
						else 			$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data						=	$this->getData("request");	
				$dataIns['customer']		=	$this->populateDbArray("vod_customer",$data);				
				$dataIns["customerinterest"]=	$_POST["subcategory_id"];	
				if(!$data["email_update"])	$dataIns['customer']["email_update"]	= 0;
				if(!$data["sms_update"])	$dataIns['customer']["sms_update"]		= 0;			
			
				if($customerObj->updateCustomer($dataIns,$data["id"]))	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true);
					}
				else
					{
						$this->setPageError($customerObj->getPageError());
						$this->executeAction(false,"Editform",true,true);
					}	
			
			}
		public function customersStauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");	
				if($this->statusChange("vod_customer",$data["id"],"status"))
					{
					
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','status,id');
					}
			}
			
		public function customersSendmail()
			{	
				$customerObj	=	new customer();
				$data			=	$this->getData("request");					
				$custdetail 	=	end($customerObj->getCustomerPersonalDetails($data["id"]));
				if($custdetail)
					{
						$to								=	$custdetail['email'];
						$from							=	GLB_SITE_EMAIL;
						$subject						=	"Voteondeals.com - Customer Membership Activation";
						$cmsObj							=	new cms();
						$custArr						=	array();
						$custArr["{TPL_NAME}"]			=	$custdetail['fname'];
						$custArr["{TPL_ACTIVATION_LINK}"]=	ROOT_URL.'activation-Statuschange-'.$custdetail["customercode"]."/";
						$send							=	$cmsObj->sendMailCMS("9",$to,$from,$subject,$custArr,5); 
						if($send)
							{
								$this->setPageError("An activation link has been sent to the customer's email address");
								$this->clearData();											
								return $this->executeAction(false,"Listing",true,true,'','id');
							}
					}
				else
					{
						$this->setPageError("Invalid Customer");
						$this->executeAction(false,"Listing",true,true,'','id');
					}
			}
		public function customersLinktotalref()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","customerReferals.php");
				$this->addData(array("cusId"=>$data['id']),"post","Search",false,"customerReferals.php");
				$this->executeAction(false,"Search",true,false,"","","customerReferals.php");
			}
		public function customersLinktotaljnd()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","customerReferals.php");
				$this->addData(array("cusId"=>$data['id'],"sel_status"=>1),"post","Search",false,"customerReferals.php");
				$this->executeAction(false,"Search",true,false,"","","customerReferals.php");
			}
		public function customersLinktotalnotjnd()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","customerReferals.php");
				$this->addData(array("cusId"=>$data['id'],"sel_status"=>2),"post","Search",false,"customerReferals.php");
				$this->executeAction(false,"Search",true,false,"","","customerReferals.php");
			}
		public function customersLinktopurchsdeal()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","dealOrderAll.php");
				$this->addData(array("txt_customerId"=>$data['id'],"sel_pay_status"=>1),"post","Search",false,"dealOrderAll.php");
				$this->executeAction(false,"Search",true,false,"","","dealOrderAll.php");
			}
		public function customersLinktocouponredmd()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","dealOrderAll.php");
				$this->addData(array("txt_customerId"=>$data['id'],"sel_redeem_option"=>1),"post","Search",false,"dealOrderAll.php");
				$this->executeAction(false,"Search",true,false,"","","dealOrderAll.php");
			}
		public function customersLinktocoupontbredmd()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","dealOrderAll.php");
				$this->addData(array("txt_customerId"=>$data['id'],"sel_redeem_option"=>0),"post","Search",false,"dealOrderAll.php");
				$this->executeAction(false,"Search",true,false,"","","dealOrderAll.php");
			}
		public function customersLinktocouponshrd()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","dealOrderAll.php");
				$this->addData(array("txt_customerId"=>$data['id'],"sel_coupon_shared"=>"shared"),"post","Search",false,"dealOrderAll.php");
				$this->executeAction(false,"Search",true,false,"","","dealOrderAll.php");
			}
		public function customersLinktositepoints()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","customerSitePoints.php");
				$this->addData(array("cusId"=>$data['id']),"post","Search",false,"customerSitePoints.php");
				$this->executeAction(false,"Search",true,false,"","","customerSitePoints.php");
			}
		public function customersLinktositecredits()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","customerSiteCredit.php");
				$this->addData(array("cusId"=>$data['id']),"post","Search",false,"customerSiteCredit.php");
				$this->executeAction(false,"Search",true,false,"","","customerSiteCredit.php");
			}
		public function customersLinktovotes()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","customerVotes.php");
				$this->addData(array("cusId"=>$data['id']),"post","Search",false,"customerVotes.php");
				$this->executeAction(false,"Search",true,false,"","","customerVotes.php");
			}
		public function customersLinktoecomData()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","");
				$this->addData(array("cusId"=>$data['id']),"post","Search",false,"");
				$this->executeAction(false,"Search",true,false,"","","");
			}
		public function customersLinktoquestionnaire()
			{
				$data	=	$this->getData("request");
				$this->clearData("Search","post","customerQuestionnaire.php");
				$this->addData(array("cusId"=>$data['id']),"post","Search",false,"customerQuestionnaire.php");
				$this->executeAction(false,"Search",true,false,"","","customerQuestionnaire.php");
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
