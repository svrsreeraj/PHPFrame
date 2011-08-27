<?php
/****************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Vendors Model Page
********************************************************************************/	
class vendors extends modelclass
	{
		public function vendorsListing()
			{
				$this->permissionCheck("View",1);
				$searchData				=	$this->getData("post","Search");
				$sortData				=	$this->getData("request","Search");
				$vendorObj				=	new vendor;
				$territoryObj			=	new territory;
				
				$adminObj				=	new adminUser();
				$userSess 				=	end($adminObj->get_user_data());					
				$utId	 				=	$userSess["usertype"];
				$utypeid				=	GLB_SAGENT_UTYPEID;	
							
				if($utId				==	$utypeid)	$cond	=	" and id=".$userSess["id"];
				else									$cond	=	"";
				
				$salesAgents			=	$adminObj->getAdminUsers("usertype=".GLB_SAGENT_UTYPEID." and status='1' ".$cond);
				$searchCombo			=	$this->get_combo_arr("sel_search_group",$salesAgents,"id","fullname",$searchData["sel_search_group"],"style='width:100px;'","Select Agent");
				
				$sel_search_country		=	$territoryObj->getAllCountries("1 order by preference asc");
				$sel_search_country		=	$this->get_combo_arr("sel_search_country",$sel_search_country,"id","country",$searchData["sel_search_country"],"style='width:100px;' onchange='getStates(this.value,\"id_search_state\")'","Any Country");
				$state_combo			=	$territoryObj->getAllStates("country_id =".$searchData["sel_search_country"]." order by preference asc");
				$state_combo			=	$this->get_combo_arr("state_combo",$state_combo,"id","state",$searchData["sel_state"],"style='width:100px;'valtype='emptyCheck-Please select a sales agent' ","Any State");
				
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"vd.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				
				if(trim($searchData["userId"]))
					{						
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("=", "vd.id", $searchData["userId"]) . " or";
						$sqlCond		.=	$this->dbSearchCond("=", "vd.email", $searchData["userId"]);
						$sqlCond		.=	") ";
					}
				if(trim($searchData["sel_status"]))
					{						
						$sqlCond		.=	" And ( ";
						if($searchData["sel_status"]==2)
							$sqlCond	.=	$this->dbSearchCond("=", "vd.status", 0) ;
						else	
							$sqlCond	.=	$this->dbSearchCond("=", "vd.status", $searchData["sel_status"]) ;
							$sqlCond	.=	") ";
					}					
				
				if(trim($searchData["keyword"]))
					{
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.business_name", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.email", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.date_added", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.business_name", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.contact_person", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.address", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.zip", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.latitude", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.longitude", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.tax", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.ip", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "vd.mobile", "%".trim($searchData["keyword"])."%");
						$sqlCond		.=	") ";
					}
				 
				
				if(trim($searchData["txt_join_from"]))			
					{	
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond(">=", "date(vd.date_added)",$searchData["txt_join_from"])." ) ";
					}
				if(trim($searchData["txt_join_to"]))			
					{	
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("<=", "date(vd.date_added)",$searchData["txt_join_to"])." ) ";
					}
				if(trim($searchData["sel_application"]))			
					{	
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("=", "vd.apps_id",$searchData["sel_application"])." ) ";
					}
				
				if(trim($searchData["sel_search_country"]))
					{
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("=", "vd.country_id", $searchData["sel_search_country"]).") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("=", "vd.saleagent_id", $searchData["sel_search_group"]).") ";
					}	
				if (in_array("running", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and ( ".$this->dbSearchCond("=", "vod.status",3);
						$sqlFilter["cond"]	.=	" or ".$this->dbSearchCond("=", "vod.status",4)." ) ";
					}
					
				if (in_array("queud", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",1);
							
					}
				if (in_array("review", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",0);
					}
				if (in_array("cooldown", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",5);
					}
				
				if (in_array("locked", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",3);
					}	
				
				if (in_array("unlocked", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vod.status",4);
					}
					
				if (in_array("pending", $searchData[sel_filter_users2]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "vdp.balance_comm_vendor",0);
						
					}
					
				if (in_array("reciving", $searchData[sel_filter_users2]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">", "vdp.used_comm_vendor",0);
					}
				if (in_array("email_update", $searchData[sel_filter_users2]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vd.email_update",1);
					}
				if (in_array("sms_update", $searchData[sel_filter_users2]))
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vd.email_update",1);
					}
				if (in_array("sold", $searchData[sel_filter_users]))
					{
						$sqlFilter["cond"]	.=	" and (".$this->dbSearchCond("=", "vod.status",5);
						$sqlFilter["cond"]	.=	" or ".$this->dbSearchCond("=", "vod.status",6)." ) ";
						$flag=1;
					}	
					
				if($utId	==	$utypeid)	$sqlFilter["cond"]	.=	" and vd.saleagent_id=".$userSess["id"];		
				if(count($sqlFilter)!=0)	
					{
						$sqlFilter["join"]		.=	" left join vod_deal as vod on vod.vendor_id 	= vd.id ";
						$sqlFilter["join"]		.=	" left join vod_deal_payments as vdp on vdp.deal_id 		= vod.id ";
						if($flag==1)
						$sqlFilter["join"]		.=	" right join vod_deal_order as vdo on vdo.deal_id = vod.id ";
					}
						$sqlCond				.=	" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				  $sql					=	"SELECT vd.* FROM vod_vendor as vd
													".$sqlFilter["selc"]."
													".$sqlFilter["join"]."
													where 1 ".$sqlFilter["cond"]."  $sqlCond $orderBy   ";
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage							=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data							=	$this->getdbcontents_sql($spage->finalSql());
				foreach($data as $key=>$val)
					{
						$dealObj	=	new deals(); 
						$cooldown	=	GLB_DEAL_COOLDOWN;
						$expired	=	GLB_DEAL_EXPIRED;
						$vid		=	$val["id"];								
						if($dealObj->canCreateDeal($vid))	$data[$key]["vendorPost"]	=	1;
						else  								$data[$key]["vendorPost"]	=	0;
						
						
						
						$cond		=	" (".$this->dbSearchCond("=", "vendor_id",$vid).")";	
						$dealsdata	=	$dealObj->getAllDealDetails($cond."  and (status='$cooldown' or  status='$expired')");
						
						if($dealsdata)	$data[$key]["vendorPays"]	=	1;
						else  			$data[$key]["vendorPays"]	=	0;
						
						
					}
				
				if(!$data)		$this->setPageError("No records found !");
				$searchData						=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]		=	$searchCombo; 
				$searchData["dropDwon_state"]	=	$dropDwon_state; 
				$searchData["sel_search_country"]	=	$sel_search_country;
				$searchData["state_combo"]		=	$state_combo;
				$searchData["sortData"]			=	$sortData;
				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function vendorsGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false);
				if(trim($sqlData["sql"]))
					{						
						$headArr				=	array('BUSINESS NAME','CONTACT PERSON','EMAIL','MOBILE','ADDRESS','ZIP');
						$fieldArr				=	array('business_name','contact_person','email','mobile','address','zip');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"VendorsList");						
					}
			}
		public function vendorsGetstatecombo()
			{
				ob_clean();
				$data							=	$this->getData("request");
				$terObj							=	new territory();
				$stateData						=	$terObj->getAllStates("country_id=".$data["cid"]);
				echo $stateData					=	$this->get_combo_arr("sel_state",$stateData,"id","state",$searchData["sel_state"],"style='width:100px;' valtype='emptyCheck-Please select a state'","Any State");
				exit;
			}	
		public function vendorsReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function vendorsSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function vendorsAddformbtn()
			{
				$this->executeAction(false,"Addform",true,true);	
			}
		public function vendorsCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function vendorsEditform()
			{
				$this->permissionCheck("Edit",1);
				$data			=	$this->getData("get");
				$vendorObj		=	new vendor;
				$territoryObj	=	new territory;
				$dataArr		=	end($vendorObj->getVendorDetails($data["id"]));
				$industrie_array=array();
				foreach($dataArr['industry'] as $data)
					{
						$industrie_array[]=$data['industry_id'];
					}
				$industrie_ids=implode(",", $industrie_array);
				foreach($dataArr['products'] as $data)
					{
						$product_array[]=$data['product_id'];
					}
				$product_ids=implode(",", $product_array);
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$adminObj					=	new adminUser();
				$salesAgents				=	$adminObj->getAdminUsers("usertype=".GLB_SAGENT_UTYPEID." and status='1'");	
				$dropDwon					=	$this->get_combo_arr("sel_search_group",$salesAgents,"id","fullname",$dataArr['vendor'][0]["saleagent_id"],"style='width:100px;'valtype='emptyCheck-Please select a sales agent'","Select Agent");
				$dropDwon_country			=	$this->get_combo_arr("country_id",$territoryObj->getAllCountries("1"),"id","country",$dataArr['vendor'][0]["country_id"],"style='width:100px;' 'valtype='emptyCheck-Please select a country' onchange=\"getcombo(this.value,'stateDivId');\"");
				$dropDwon_state				=	$this->get_combo_arr("state_id",$territoryObj->getAllStates("1"),"id","state",$dataArr['vendor'][0]["state_id"],"valtype='emptyCheck-Please select a state'");
				$dropDwon_product			=	$this->get_combo_multiple("product_id[]",$vendorObj->getAllProducts("1"),"id","product",$product_ids,"style='width:200px;height:175px';");
				$dropDwon_industries		=	$this->get_combo_multiple("industry_id[]",$vendorObj->getAllIndustries("1"),"id","industry",$industrie_ids,"style='width:200px;height:175px';");
				return array("combo"=>$dropDwon,"combo_industries"=>$dropDwon_industries,"combo_products"=>$dropDwon_product,"country_combo"=>$dropDwon_country,"country_state"=>$dropDwon_state,"data"=>$this->getHtmlData($dataArr['vendor'][0]));
			}
		public function vendorsViewform()
			{
				$this->permissionCheck("View",1);
				$data					=	$this->getData("get");
				$vendorObj				=	new vendor;
				$territoryObj			=	new territory;
				$adminObj				=	new adminUser();
				$dataArr				=	$vendorObj->getVendorDetails($data["id"]);
				$dataArr['salesAgent']	=	$vendorObj->getVendorSalesTeam($data["id"]);
				$deal_details			=	$vendorObj->getVendorDealsCount($data["id"]);
				$deal_purchased			=	$vendorObj->getSoldDealsPurchaseDetails($data["id"]);
				$vendor_payment			=	$vendorObj->getVendorPayment($data["id"]);
				$industrie_array		=	array();
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$dropDwon_country		=	$territoryObj->getAllCountries("id=".$dataArr['vendor'][0]["country_id"]);
				$dropDwon_country		=	$dropDwon_country[0][country];
				$dropDwon_state			=	$territoryObj->getAllStates("id=".$dataArr['vendor'][0]["state_id"]);
				$dropDwon_state			=	$dropDwon_state[0][state];
				foreach($dataArr['products'] as $data)
					{
						$dropDwon_product2[]=$vendorObj->getProductsName("id=".$data['product_id']);
					}
				$c=count($dropDwon_product2);
				for($i=0;$i<$c;$i++)
					{
						$dropDwon_product3[]=$dropDwon_product2[$i][0]['product'];
					}
				$dropDwon_product=implode(",", $dropDwon_product3);
				foreach($dataArr['industry'] as $data)
					{
						$dropDwon_industry2[]	=	$vendorObj->getIndustriesDetails($data['industry_id']);
					}
				$c=count($dropDwon_industry2);
				for($i=0;$i<$c;$i++)
					{
						$dropDwon_industry3[]=$dropDwon_industry2[$i][0]['industry'];
					
					}
				$dropDwon_industries=implode(",", $dropDwon_industry3);
			
				return array("combo"=>$dropDwon,"vendor_payment"=>$vendor_payment,"deal_purchased"=>$deal_purchased,"coupan_details"=>$coupan_details,"combo_industries"=>$dropDwon_industries,"deal_votes"=>$deal_votes,"deal_details"=>$deal_details,"combo_products"=>$dropDwon_product,"country_combo"=>$dropDwon_country,"country_state"=>$dropDwon_state,"salesagent"=>$this->getHtmlData($dataArr['salesAgent'][0]),"data"=>$this->getHtmlData($dataArr['vendorDetails']['vendor'][0]));
			}
		public function vendorsStauschange()
			{	
					$this->permissionCheck("Status",1);					
					$data				=	$this->getData("request");	
					if($this->statusChange("vod_vendor",$data["id"],"status"))
						{
						
							$this->setPageError("Status Changed Successfully");
							$this->clearData();											
							return $this->executeAction(false,"Listing",true,true,'','status,id');
						}
			}
			
		public function vendorsDealpost()
			{
				$this->permissionCheck("Add",1);
				$getData				=	$this->getData("get");
				$this->addData(array("vendor_id"=>$getData["id"]),"post","Addform","","dealsList.php");
				$this->executeAction(true,"Addform",true,true,"","","dealsList.php");
			}
			
		public function vendorsCommisionpay()
			{
				$this->permissionCheck("Add",1);
				$getData				=	$this->getData("get");
				$this->addData(array("vendor"=>$getData["id"]),"post","Addform","","vendorPayment.php");
				$this->executeAction(true,"Addform",true,"","","","vendorPayment.php");
			}	
		public function vendorsViewrunningdeal()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("txt_vendorId"=>$getData["id"],"sel_status"=>'3,4'),"post","Search",true,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function vendorsViewRejecteddeal()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("txt_vendorId"=>$getData["id"],"sel_status"=>2),"post","Search",true,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function vendorsViewqueueddeal()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("txt_vendorId"=>$getData["id"],"sel_status"=>1),"post","Search",true,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function vendorsViewcooldowndeal()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("txt_vendorId"=>$getData["id"],"sel_status"=>5),"post","Search",true,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function vendorsViewlockeddeal()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("txt_vendorId"=>$getData["id"],"sel_status"=>3),"post","Search",true,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function vendorsViewUnlockeddeal()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("txt_vendorId"=>$getData["id"],"sel_status"=>4),"post","Search",true,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function vendorsViewexpireddeal()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("txt_vendorId"=>$getData["id"],"sel_status"=>6),"post","Search",true,"dealsList.php");
				$this->executeAction(false,"Search",true,false,"","","dealsList.php");
			}
		public function vendorsViewtotalcommision()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("vendor.php"=>$getData["id"]),"post","Search",true,"vendorPayment.php");
				$this->executeAction(false,"Search",true,false,"","","vendorPayment.php");
			}
		public function vendorsViewbalancecommision()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("vendor.php"=>$getData["id"]),"post","Search",true,"vendorPayment.php");
				$this->executeAction(false,"Search",true,false,"","","vendorPayment.php");
			}
		public function vendorsViewtotalearnedcommision()
			{
				$this->permissionCheck("View",1);
				$getData				=	$this->getData("get");
				$this->addData(array("vendor.php"=>$getData["id"]),"post","Search",true,"vendorPayment.php");
				$this->executeAction(false,"Search",true,false,"","","vendorPayment.php");
			}								
		public function vendorsUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$vendorObj				=	new vendor;
				$data					=	$this->getData("request");
				if(!$data["email_update"])	$data["email_update"]	= 0;
				if(!$data["sms_update"])	$data["sms_update"]		= 0;				
				$dataIns['vendor']		=	$this->populateDbArray("vod_vendor",$data);
				
				$dataIns['product']		=	$this->populateDbArray("vod_vendor_product ",$data['product_id']);
				$dataIns['industry']	=	$this->populateDbArray("vod_vendor_industry ",$data['industry_id']);
				if(count($data['product_id'])>0)
				{
					
					$sql=("DELETE FROM vod_vendor_product  WHERE vendor_id=".$data['id']);
					mysql_query($sql);
					
					foreach ($data['product_id'] as $products)
						{
							$fullvalue						=	array();
							$fullvalue['vendor_id']			=	$data['id'];
							$fullvalue['product_id']		=	$products;
							$this->populateDbArray("vod_vendor_product",$fullvalue);
							$insert=$this->db_insert("vod_vendor_product",$fullvalue,1);	
						}
					$sql=("DELETE FROM vod_vendor_industry   WHERE vendor_id=".$data['id']);
					mysql_query($sql);
				}
				if(	count($data['industry_id'])>0)
				{
					foreach ($data['industry_id'] as $industry)
						{
							$fullvalue						=	array();
							$fullvalue['vendor_id']			=	$data['id'];
							$fullvalue['industry_id']		=	$industry;
							$this->populateDbArray("vod_vendor_industry",$fullvalue);
							$insert=$this->db_insert("vod_vendor_industry",$fullvalue,1);	
						}
					
					
				}
				if($vendorObj->updateVendor($dataIns,$data["id"]))	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();
						$this->clearData("Editform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError($vendorObj->getPageError());
						$this->executeAction(false,"Editform",true,true);
					}	
			}
		public function vendorsDeleteform()
			{
				$vendorObj				=	new vendor;
				$data					=	$this->getData("request");
				if($vendorObj->deleteVendor($data["id"]))	
					{
						$this->setPageError("Deleted Successfully");
						$this->clearData();
						$this->clearData("deleteform");						
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->setPageError($vendorObj->getPageError());
						$this->executeAction(false,"Deleteform",true,true);
					}	
			}
		public function vendorsGetcombo()
			{
				ob_clean();
				$data		=	$this->getData("request");
				$territoryObj=	new territory;
				echo $this->get_combo_arr("state_id",$territoryObj->getAllStates("country_id=".$data['id']),"id","state",$dataArr['vendor'][0]["state_id"]);
				exit;
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
