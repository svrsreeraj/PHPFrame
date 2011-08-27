<?php
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-30 
Purpose    :Sales Payment Tranaction Details
**************************************************************************************/
class salesPaymentDetail extends modelclass
	{
		public function salesPaymentDetailListing()
			{
				$this->permissionCheck("View",1);
				$getData			=	$this->getData("get");	
				$searchData			=	$this->getData("post","Search");
				$sortData			=	$this->getData("request","Search");
				
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"d.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}

				if(trim($searchData["from_date"]))
					$sqlCond	.=	" And ".$this->dbSearchCond(">=", "dp.date_updated",$searchData["from_date"]);
									
				if(trim($searchData["to_date"]))					
					$sqlCond	.=	" And ".$this->dbSearchCond("<=", "dp.date_updated", $searchData["to_date"].' 23:59:59');
					
							
				$sqlCond			.=	" ORDER BY ".$sortData["sortField"]." ".$sortData["sortMethod"];		
				
				$cooldown			=	GLB_DEAL_COOLDOWN;
				$expired			=	GLB_DEAL_EXPIRED;
				
				$sql				=	"SELECT d.id as did,dp.id as pid,d.name,dp.total_comm_sales AS total, 
										dp.used_comm_sales AS used, dp.balance_comm_sales AS balance,dp.date_updated,d.saleagent_id
										FROM vod_deal as d,vod_deal_payments AS dp WHERE d.id=dp.deal_id  
										and (d.status='$cooldown' or d.status='$expired') and d.saleagent_id >0 and d.saleagent_id='$getData[sid]'
										$sqlCond ";
										 
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());				
				
				foreach($data as $key=>$val)
					{
						$pid					=	$val["pid"];
						$detailArr				=	$this->getdbcontents_sql("SELECT * FROM  `vod_deal_payments_trans` WHERE deal_payment_id='$pid' and saleagent_id = '$getData[sid]' order by id desc");
						if($detailArr)	$data[$key]["payment"]	=	$this->get_popup($detailArr);

					}
				if(!$data)	$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));				 
				$searchData["sortData"]		=	$sortData;	
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function get_popup($arr)
			{						
				if($arr)
					{
						$str			=	'<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTablePopUp">
											<tr align="center" valign="middle">
												<th>Paid Date</th>										
												<th>Updated By</th>
												<th>Paid Amount</th>
											</tr>';
						$userObj			=	new adminUser();
						foreach($arr as $key=>$val)
							{
								$upId	=	$val["updated_by"];
								$upUser	=	end($userObj->getAdminUsers("id='$upId'"));											
								$netTot	=	$netTot+$val["amount"];
								$str	.=	'<tr align="center" valign="middle">
													<td>'.$val["payment_date"].'</td>											
													<td >'.$upUser["fullname"].'</td>
													<td><div align="right">$'.$val["amount"].'</div></td>
												</tr>';								
							}
							
						$str			.=	'<tr align="center" valign="middle">
																							
													<td  colspan="2"><div align="right"> Net Paid Commission</div></td>
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
		public function salesPaymentDetailBack()
			{
				$this->executeAction(false,"Listing",true,false,'','sid','salesPayment.php');	
			}
		public function salesPaymentDetailSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function salesPaymentDetailReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
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
