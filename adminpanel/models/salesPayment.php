<?php
/**************************************************************************************
Created by :hari krishna s
Created on :2010-11-16 
Updated by :M S Anith on 2010-11-29
Purpose    :Sales Payment Tranaction
**************************************************************************************/
class salesPayment extends modelclass
	{ 
		public function salesPaymentListing()
			{
				$this->permissionCheck("View",1);
				$userObj			=	new adminUser();
				$dealObj			=	new deals();
				
				$userSess 			=	end($userObj->get_user_data());					
				$utId	 			=	$userSess["usertype"];
				
				
				$utypeid			=	GLB_SAGENT_UTYPEID;
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				$cooldown			=	GLB_DEAL_COOLDOWN;
				$expired			=	GLB_DEAL_EXPIRED;
				
				if($utId			==	$utypeid)	$cond	=	" and id=".$userSess["id"];
				else								$cond	=	"";
				$searchCombo		=	$this->get_combo_arr("salesagent",$userObj->getAdminUsers("usertype='$utypeid' and  status='1' ".$cond." order by fullname"),"id","fullname",$searchData["salesagent"],"style='width:130px;' 'onchange=\"getcombo(this.value,'dealDiv');\"","All Sales Agent");
				$saleAgent			=	$searchData["salesagent"];
				$searchCombo1		=	$this->get_combo_arr("deals",$dealObj->getAllDealDetails("saleagent_id='$saleAgent'  and (status='$cooldown' or  status='$expired') order by name"),"id","name",$searchData["deals"],"","All Deals");
				
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"d.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "concat(s.fname,' ',s.lname)", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "d.name", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "d.caption", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "d.description", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}	
				if(trim($searchData["salesagent"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "d.saleagent_id", $searchData["salesagent"]);
					}	
				if(trim($searchData["deals"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "d.id", $searchData["deals"]);
					}				
				$sqlOrder			=	" ORDER BY ".$sortData["sortField"]." ".$sortData["sortMethod"];		
				
				
				$sql				=	"SELECT d.saleagent_id,d.id AS dealid,d.name,d.vendor_id,dp.id AS dpid,
										sum(dp.unit_comm_sales) AS units, sum(dp.total_comm_sales) AS total, 
										sum(dp.used_comm_sales) AS used, sum(dp.balance_comm_sales) AS balance, 
										concat(s.fname,' ',s.lname)  as salesagentname
										FROM vod_deal as d,vod_deal_payments AS dp,vod_admin_users as s WHERE
										 d.id=dp.deal_id and d.saleagent_id = s.id
										and (d.status='$cooldown' or d.status='$expired') and d.saleagent_id >0 $sqlCond 
										GROUP BY d.saleagent_id $sqlOrder";
										 
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				
				foreach($data as $key=>$val)
					{
						$sid					=	$val["saleagent_id"];
						
						$detailArr				=	$this->getdbcontents_sql("SELECT d.name,dp.total_comm_sales AS total, 
													dp.used_comm_sales AS used, dp.balance_comm_sales AS balance,dp.date_updated,
													concat(s.fname,' ',s.lname)  as salesagentname
													FROM vod_deal as d,vod_deal_payments AS dp,vod_admin_users as s 
													 WHERE d.id=dp.deal_id  and d.saleagent_id = s.id
													and (d.status='$cooldown' or d.status='$expired') and d.saleagent_id >0
													 and d.saleagent_id='$sid' $sqlCond ");
						if($detailArr)	
							{
								$data[$key]["totDet"]	=	$this->get_popup($detailArr,"tot");
								$data[$key]["payDet"]	=	$this->get_popup($detailArr,"pays");
								$data[$key]["balDet"]	=	$this->get_popup($detailArr,"bal");
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
		public function salesPaymentAddformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(false,"Addform",true,true);
			}
		
		public function salesPaymentCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function salesPaymentSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function salesPaymentReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}	
		public function salesPaymentAddform()
			{	
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("get");
				$userObj	=	new adminUser();
				$utypeid	=	GLB_SAGENT_UTYPEID;
				$dropDown	=	$this->get_combo_arr("salesagent",$userObj->getAdminUsers("usertype='$utypeid' and  status='1' order by fullname"),"id","fullname",$data["salesagent"],"onchange=\"getcombo(this.value,'dealDivId');\"","Select Sales Agent");				
				if(!$dropDown)
					{
						$this->setPageError("No records");
						$this->clearData();
						return $this->executeAction(false,"Addform",true);
					}
				else	return array("combo"=>$dropDown);
								
			}	
		public function salesPaymentGetcombo()
			{
				ob_clean();
				$sagentId	=	$_REQUEST['id'];
				$searchData	=	$this->getData("post");
				$dealObj	=	new deals();
				$cooldown	=	GLB_DEAL_COOLDOWN;
				$expired	=	GLB_DEAL_EXPIRED;
				$dealsdata	=	$dealObj->getAllDealDetails("saleagent_id='$sagentId'  and (status='$cooldown' or  status='$expired') order by name");
				$dropDwon	=	$this->get_combo_arr("deals",$dealsdata,"id","name",$searchData['deals'],"onchange=\"return displaypayment(this.value,'paymentdtails');\"","All Deal");	
				echo $dropDwon;
				exit;
			}
			
		public function salesPaymentGetcombodeal()
			{
				ob_clean();
				$dealObj	=	new deals();
				$rqstData	=	$this->getData("request");
				$dealsData	=	end($dealObj->getAllPaymentdetails($rqstData["dealid"]));
				$list		=	'<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">';
				$list		.=	'<tr><td width="150"><strong>Payment Details</strong></td><td></td></tr>';
				$list		.=	'<tr><td>Total Commision:</td><td>'.  $dealsData["total_comm_sales"].'</td></tr>';
				$list		.=	'<tr><td>Paid Commision :</td><td>'.$dealsData["used_comm_sales"].'</td></tr>';
				$list		.=	'<tr><td>Balance to Pay  :</td><td>'.$dealsData["balance_comm_sales"].'</td></tr>';
				
				if($dealsData['balance_comm_sales'] >0)
					{
						$list		.='<input type="hidden" name="dealid" value="'.$rqstData["dealid"].'"/>';
						$list		.=	'<tr><td> Make a Payment </td>';
						$list		.='<td><input type="text" name="payAmount" id="payAmountId" value=""></td></tr>';
						$list		.='<tr><td>&nbsp;</td>
											<td><input type="submit" class="butsubmit"  name="actionvar" value="Pay Now"   id="saveDataId" /> 
											<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
										</td></tr>';
					}
				$list		.=	'</table>';
				echo $list;
				exit;
			}
			
		public function salesPaymentPay()
			{
				$this->permissionCheck("Add",1);
				$postedValue			=	$this->getData("post");					
				$dealObj				=	new deals();
				$userObj				=	new adminUser();
				$userSess 				=	$userObj->get_user_data();
				
				$deal_id				=	$postedValue["deals"];
				$saleagent_id			=	$postedValue["salesagent"];
				$amount					=	$postedValue["payAmount"];			
				$dealsPayData			=	end($dealObj->getAllPaymentdetails($deal_id));
				$deal_payment_id		=	$dealsPayData["id"];
				$balanceComm			=	$dealsPayData["balance_comm_sales"];
				$cooldown				=	GLB_DEAL_COOLDOWN;
				$expired				=	GLB_DEAL_EXPIRED;
				$dealsData				=	$dealObj->getAllDealDetails("saleagent_id='$saleagent_id'  and (status='$cooldown' or  status='$expired') and id='$deal_id'");
				if($dealsData)
					{
						if(($amount	 	<=	$balanceComm)  && ($amount >0) )	
							{	
								$dataArr					=	array();
								$dataArr['deal_payment_id']	=	$deal_payment_id;
								$dataArr['payment_date']	=	date("Y-m-d");
								$dataArr['saleagent_id']	=	$saleagent_id;
								$dataArr['amount']			=	$amount;
								$dataArr['ip']				=	$_SERVER['REMOTE_ADDR'];
								$dataArr['date_added']		=	"escape now() escape";
								$dataArr['updated_by']		=	$userSess[0]["id"] ;
								$insTrans					=	$dealObj->insertVodDealPaymentTrans($dataArr,"sales");
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
