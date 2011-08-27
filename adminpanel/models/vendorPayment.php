<?php
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-30
Purpose    :Vendor Payment Tranaction
**************************************************************************************/
class vendorPayment extends modelclass
	{ 
		public function vendorPaymentListing()
			{
				
				$this->permissionCheck("View",1);
				$userObj			=	new vendor();
				$dealObj			=	new deals();
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$cooldown			=	GLB_DEAL_COOLDOWN;
				$expired			=	GLB_DEAL_EXPIRED;			
				
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"d.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "v.business_name", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("=", "v.vendorcode", $searchData["keyword"]). " or";
						$sqlCond	.=	$this->dbSearchCond("=", "v.mobile", $searchData["keyword"]). " or";
						$sqlCond	.=	$this->dbSearchCond("=", "v.zip", $searchData["keyword"]). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "v.contact_person", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "v.address", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "v.email", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "d.name", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "d.caption", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "d.description", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}	
				if(trim($searchData["vendor"]))
					{
						$sqlCond		.=	" And(".$this->dbSearchCond("=", "d.vendor_id",$searchData["vendor"])." or ".$this->dbSearchCond("=", "v.email",$searchData["vendor"]).")";	
					}	
						
				$sqlOrder			=	" ORDER BY ".$sortData["sortField"]." ".$sortData["sortMethod"];		
				
				
				$sql				=	"SELECT d.vendor_id,d.id AS dealid,d.name,d.vendor_id,dp.id AS dpid,
										sum(dp.unit_comm_vendor) AS units, sum(dp.total_comm_vendor) AS total, 
										sum(dp.used_comm_vendor) AS used, sum(dp.balance_comm_vendor) AS balance,v.business_name 
										FROM vod_deal as d,vod_deal_payments AS dp,vod_vendor as v WHERE d.id=dp.deal_id  
										and d.block_status=0 and (d.status='$cooldown' or d.status='$expired') and d.vendor_id >0 and d.vendor_id=v.id $sqlCond 
										GROUP BY d.vendor_id $sqlOrder";
										 
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				
				foreach($data as $key=>$val)
					{
						$vid					=	$val["vendor_id"];
						
						$detailArr				=	$this->getdbcontents_sql("SELECT d.name,dp.total_comm_vendor AS total, 
													dp.used_comm_vendor AS used, dp.balance_comm_vendor AS balance,dp.date_updated,v.business_name
													FROM vod_deal as d,vod_deal_payments AS dp,vod_vendor as v WHERE d.id=dp.deal_id  
													and (d.status='$cooldown' or d.status='$expired') and d.vendor_id >0 and d.vendor_id=v.id and d.vendor_id='$vid' $sqlCond ");
						if($detailArr)	
							{
								$data[$key]["totDet"]	=	$this->get_popup($detailArr,"tot");
								$data[$key]["payDet"]	=	$this->get_popup($detailArr,"pays");
								$data[$key]["balDet"]	=	$this->get_popup($detailArr,"bal");
							}
							$totalAmt				=	 $totalAmt + $val["total"];
							$totalPaid				=	 $totalPaid + $val["used"];
							$totalBal				=	 $totalBal + $val["balance"];
					}
					
				if(!$data)	$this->setPageError("No records found !");
				else
					{
						$consol["total"]		=	$totalAmt;
						$consol["paid"]			=	$totalPaid;
						$consol["balance"]		=	$totalBal;
					}
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));				 
				$searchData["sortData"]		=	$sortData;				
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"consol"=>$consol);
			}
			
		public function get_popup($arr,$type)
			{						
				if($arr)
					{
						$dealObj			=	new deals();
						if($type	==	"tot")			$thead	=	"Total";							
						else if($type	==	"pays")		$thead	=	"Paid";
						else							$thead	=	"Balance";
						
						$str			=	'<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTablePopUp">
											<tr align="center" valign="middle">
												<th>Updated Date</th>										
												<th>Deal</th>
												<th>'.$thead.' Amount</th>
											</tr>';
						foreach($arr as $key=>$val)
							{											
								if($type	==	"tot")			$amount	=	$val["total"];						
								else if($type	==	"pays")		$amount	=	$val["used"];
								else							$amount	=	$val["balance"];
								
								$netTot	=	$netTot+$amount;
								$str	.=	'<tr align="center" valign="middle">
													<td>'.$dealObj->displayDate($val["date_updated"]).'</td>											
													<td >'.$val["name"].'</td>
													<td><div align="right">$'.$amount.'</div></td>
												</tr>';								
							}
							
						$str			.=	'<tr align="center" valign="middle">
																							
													<td  colspan="2"><div align="right"> Net '.$thead.' Commission</div></td>
													<td><strong><div align="right">$'.$netTot.'</div></strong></td>
											</tr>';				
						$str			.=	'</table>';
						
						$str		=	str_replace("\n","",$str);
						$str		=	str_replace("\r","",$str);
						$str		=	str_replace('"','\"',$str);
						$str		=	str_replace('"','&quot;',$str);
						return $str;
					}			
			}
		public function vendorPaymentAddformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(false,"Addform",true,true);
			}
		public function vendorPaymentFetchcancel()
			{
				$this->executeAction(false,"Addform",true,true);	
			}
		public function vendorPaymentCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function vendorPaymentSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function vendorPaymentReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}	
		public function vendorPaymentAddform()
			{	
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("post");				
				return array("data"=>$this->getHtmlData($data));
			}
		public function vendorPaymentCommisionpay()
			{
				$this->permissionCheck("Add",1);
				$getData				=	$this->getData("get");
				$this->addData(array("vendor"=>$getData["id"]),"post","Addform");
				$this->executeAction(true,"Addform",true,"","","","vendorPayment.php");
			}		
				
		public function vendorPaymentFetch()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("request");
				$dealObj	=	new deals();
				$cooldown	=	GLB_DEAL_COOLDOWN;
				$expired	=	GLB_DEAL_EXPIRED;
				
				if(trim($data["vendor"]))			
					{
						$cond	=	" (".$this->dbSearchCond("=", "vendor_id",$data["vendor"]).")";	//  or ".$this->dbSearchCond("=", "v.email",$data["vendor"]).
					}
				$dealsdata	=	$dealObj->getAllDealDetails($cond."  and (status='$cooldown' or  status='$expired') order by name");
				$dropDown	=	$this->get_combo_arr("deals",$dealsdata,"id","name",$data['deals'],"onchange=\"return displaypayment(this.value,'paymentdtails');\"","All Deal");	
				if($dealsdata)	return array("vdata"=>$this->getHtmlData($dealsdata),"dcombo"=>$dropDown);
				else
					{
						$this->setPageError("There is no payment details or deals to display");
						$this->clearData();
						return $this->executeAction(false,"Addform",true);
					}	
			}
		public function vendorPaymentGetcombodeal()
			{
				ob_clean();
				$dealObj	=	new deals();
				$rqstData	=	$this->getData("request");
				$dealsData	=	end($dealObj->getAllPaymentdetails($rqstData["dealid"]));
				$list		=	'<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="formTable">';
				if($dealsData)
					{
						
						$list		.=	'<tr><td colspan="2"><strong>Payment Details</strong></td></tr>';
						$list		.=	'<tr><td width="100">Total Commision:</td><td>$'.$dealsData["total_comm_vendor"].'</td></tr>';
						$list		.=	'<tr><td>Paid Commision :</td><td>$'.$dealsData["used_comm_vendor"].'</td></tr>';
						$list		.=	'<tr><td>Balance to Pay  :</td><td>$'.$dealsData["balance_comm_vendor"].'</td></tr>';
						
						if($dealsData['balance_comm_vendor'] >0)
							{
								$list		.='<input type="hidden" name="dealid" value="'.$rqstData["dealid"].'"/>';
								$list		.=	'<tr><td> Make a Payment </td>';
								$list		.='<td><input type="text" name="payAmount" id="payAmountId" value=""></td></tr>';
								$list		.='<tr><td>&nbsp;</td>
													<td><input type="submit" class="butsubmit"  name="actionvar" value="Pay Now"   id="saveDataId" /> 
													<input type="submit" class="butsubmit"  name="actionvar" value="Back"   id="backId" />
													<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
												</td></tr>';
							}
						
					}
				else	
					{
						$list		.=	'<tr><td class="errorMessage" colspan="2"><strong>There is no payment details available for this deal</strong></td></tr>';
						$list		.='<tr><td width="100">&nbsp; </td>
													<td align="left"><input type="submit" class="butsubmit"  name="actionvar" value="Back"   id="backId" /> 
													<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
												</td></tr>';
					}
				$list		.=	'</table>';
				echo $list;
				exit;
			}
			
		public function vendorPaymentPay()
			{
				$this->permissionCheck("Add",1);
				$postedValue			=	$this->getData("post");					
				$dealObj				=	new deals();
				$userObj				=	new adminUser();
				$userSess 				=	$userObj->get_user_data();				
				$deal_id				=	$postedValue["deals"];
				$vendor_id				=	$dealObj->getVendorIdByDeal($deal_id);
				$amount					=	$postedValue["payAmount"];			
				$dealsPayData			=	end($dealObj->getAllPaymentdetails($deal_id));
				$deal_payment_id		=	$dealsPayData["id"];
				$balanceComm			=	$dealsPayData["balance_comm_vendor"];
				$cooldown				=	GLB_DEAL_COOLDOWN;
				$expired				=	GLB_DEAL_EXPIRED;
				$cond					=	" (".$this->dbSearchCond("=", "vendor_id",$vendor_id).")";
				$dealsData				=	$dealObj->getAllDealDetails("vendor_id='$vendor_id'  and (status='$cooldown' or  status='$expired') and id='$deal_id'");
				if($dealsData)
					{
						if(($amount	 	<=	$balanceComm)  && ($amount >0) )	
							{	
								$dataArr					=	array();
								$dataArr['deal_payment_id']	=	$deal_payment_id;
								$dataArr['payment_date']	=	date("Y-m-d");
								$dataArr['vendor_id']		=	$vendor_id;
								$dataArr['amount']			=	$amount;
								$dataArr['ip']				=	$_SERVER['REMOTE_ADDR'];
								$dataArr['date_added']		=	"escape now() escape";
								$dataArr['updated_by']		=	$userSess[0]["id"] ;
								$insTrans					=	$dealObj->insertVodDealPaymentTrans($dataArr,"vendor");
								if($insTrans)	$this->redirectAction("Payment has been added successfully","Listing");									
								else			$this->redirectAction("Payment adding failed","Addform");
							}
						else $this->redirectAction("Please enter a valid amount","Addform");
					}
				else $this->redirectAction("Please enter valid details","Addform");
						
			}
		public function redirectAction($errMessage,$action)	
			{	
				$this->setPageError($errMessage);
				$this->clearData($action);
				$this->executeAction(false,$action,true);	
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
