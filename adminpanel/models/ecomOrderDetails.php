<?php
/****************************************************************************************
Created by	:	Mahinsha T.K
Created on	:	2010-12-02
Purpose		:	Manage Ecomm Ordes
****************************************************************************************/
class ecomOrderDetails extends modelclass
	{
		
	public function ecomOrderDetailsListing()
			{
				$this->executeAction(false,"Transall",true,true);	
			}
	public function  ecomOrderDetailsTransall()
			{
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
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
							$sqlCond	.=	$this->dbSearchCond("like", "name", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "caption", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "description", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "email", "%".$searchData["keyword"]."%"). " or";
							$sqlCond	.=	$this->dbSearchCond("=", "deal_price", $searchData["keyword"]). " or";
							$sqlCond	.=	$this->dbSearchCond("=", "cost", $searchData["keyword"]). " or";
							$sqlCond	.=	$this->dbSearchCond("like", "rules", "%".$searchData["keyword"]."%");
							$sqlCond	.=	") ";
						}
				
				$sqlOrder			=	" ORDER BY ".$sortData["sortField"]." ".$sortData["sortMethod"];
			 $sql					=	"SELECT eo.id,vc.fname,vc.lname,eod.quanity,eo.order_date,eo.total_amount FROM vod_ecomm_order eo   
										INNER JOIN vod_ecomm_orderdetail  eod ON eo.id =eod.order_id 
										INNER JOIN vod_customer vc ON eo.customer_id =vc.id 
										where 1  group by(eo.id) $sqlOrder"; 
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				foreach($data as $key=>$val)
					{
						 	$ecomm_order_id					=	$val["id"];
							$detailArr				=	$this->getdbcontents_sql("SELECT p.product from vod_ecomm_product  p 
													INNER JOIN vod_ecomm_orderdetail  eod ON eod.ecomm_prodid =p.id
														where eod.order_id=$ecomm_order_id $sqlCond");
							if($detailArr)	
								{
									$data[$key]["product"]	=	$this->get_popup($detailArr,"product");
								}

					}
			
					if(!$data)	$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));				 
				$searchData["searchCombo"]	=	$searchCombo;
				$searchData["searchCombo1"]	=	$searchCombo1; 
				$searchData["sortData"]		=	$sortData;				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
			public function get_popup($arr,$type)
			{						
				if($arr)
					{
						$dealObj			=	new deals();
						if($type	==	"product")			$thead	=	"product";							
						
						
						$str			=	'<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTablePopUp">
											<tr align="center" valign="middle">
												<th>Ordered Products</th>										
												
											</tr>';
						foreach($arr as $key=>$val)
							{										
								if($type	==	"product")			$product	=	$val["product"];						
								
								$str	.=	'<tr align="center" valign="middle">
													<td >'.$val["product"].'</td>										
													
												</tr>';								
							}
							
						$str			.=	'</table>';
						$str		=	str_replace("\n","",$str);
						$str		=	str_replace("\r","",$str);
						$str		=	str_replace('"','\"',$str);
						$str		=	str_replace('"','&quot;',$str);
						return $str;
					}			
			}
		public function ecomOrderDetailsGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('NAME','CAPTION','DESCRIPTION','RULES','DEAL PRICE','COST');
						$fieldArr		=	array('name','caption','description','rules','deal_price','cost');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"dealList");						
					}
			}
		public function ecomOrderDetailsSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function ecomOrderDetailsCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function ecomOrderDetailsReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function ecomOrderDetailsGetcombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$dealObj			=	new deals();
				echo $this->get_combo_arr("subcategory_id",$dealObj->getAllSubCategories("category_id ='".$data["id"]."' and status='1' order by preference"),"id","subcategory",$dataArr["subcategory_id"],"","Select Subcategory");
				exit;
			}						
		public function ecomOrderDetailsEditform()
			{
				$data				=	$this->getData("get");
				$dealObj			=	new deals();
				$userObj			=	new adminUser();
				$vendorObj			=	new vendor();
				$masterObj			=	new masters();
				$dataArr			=	end($dealObj->getAllDealDetails(" id = $data[id] "));				
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$vendor		=	$this->get_combo_arr("vendor_id",$vendorObj->getDetails("status='1' order by business_name"),"id","business_name",$dataArr["vendor_id"],"","Select Vendor");
				$sagent		=	$this->get_combo_arr("saleagent_id",$userObj->getAdminUsers(" usertype='2' and  status='1' order by fullname"),"id","fullname",$dataArr["saleagent_id"],"","Select Sales Agent");
				
				$category	=	$this->get_combo_arr("category_id",$dealObj->getAllCategories("status='1' order by preference"),"id","category",$dataArr["category_id"],"onchange=\"getcombo(this.value,'subcatDivId');\"","Select Category");
				$subcat		=	$this->get_combo_arr("subcategory_id",$dealObj->getAllSubCategories("category_id ='".$dataArr["category_id"]."' and status='1' order by preference"),"id","subcategory",$dataArr["subcategory_id"],"","Select Subcategory");
				
				$combo["vendor"]	=	$vendor;
				$combo["sagent"]	=	$sagent;
				$combo["category"]	=	$category;
				$combo["subcat"]	=	$subcat;
				
				return array("data"=>$this->getHtmlData($dataArr),"combo"=>$combo);
			}
		public function ecomOrderDetailsViewform()
			{
				$this->permissionCheck("View",1);
				$data				=	$this->getData("get");
				$ecommObj			=	new ecommProducts();
				$dataArr			=	$ecommObj->getEcommOrderDetails($data[id]);	
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
					
				$teritory_obj=new territory();
				$ship_country			=	$teritory_obj->getAllCountries("id=".$dataArr['ship_country']);
				$dataArr['ship_country']=	$ship_country[0]['country'];
				$ship_state=$teritory_obj->getAllStates("id=".$dataArr['ship_state']);
				$dataArr['ship_state']	=	$ship_state[0]['state'];
				$bill_country			=	$teritory_obj->getAllCountries("id=".$dataArr['bill_country']);
				$dataArr['bill_country']=	$ship_country[0]['country'];
				$bill_state=$teritory_obj->getAllStates("id=".$dataArr['bill_state']);
				$dataArr['bill_state']	=	$ship_state[0]['state'];
				return array("data"=>$this->getHtmlData($dataArr));
					
			}
			public function ecomOrderDetailsStauschange()
			{	
				
				//	$this->permissionCheck("Status",1);					
					$data		=	$this->getData("request");	
					if($this->statusChange("vod_ecomm_order",$data["id"],"paid_status"))
						{
						
							$this->setPageError("Paid Status Changed Successfully");
							$this->clearData();											
							return $this->executeAction(false,"viewform",true,true,'','paid_status,$data["id"]');
						}
			}
		public function ecomOrderDetailsViewvendorpay()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("keyword"=>$getData["deal"]),"post","Search",true,"vendorPayment.php");
				$this->executeAction(false,"Search",true,false,"","","vendorPayment.php");
			}
		public function ecomOrderDetailsViewsalespay()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("keyword"=>$getData["deal"]),"post","Search",true,"salesPayment.php");
				$this->executeAction(false,"Search",true,false,"","","salesPayment.php");
			}
		
		public function ecomOrderDetailsUpdatedata()
			{
				$this->permissionCheck("Status",1);
				$data						=	$this->getData("request");
				$ecomObj				=	new ecommProducts();
				$dataIns		=	$this->populateDbArray("vod_ecomm_order",$data);
				if($ecomObj->updateEcommOrder($dataIns,$data["id"]))	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();
						$this->clearData("Editform");						
						return $this->executeAction(false,"Viewform",true,true);
					}
				else
					{
						$this->setPageError($ecomObj->getPageError());
						$this->executeAction(false,"Viewform",true,true);
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
