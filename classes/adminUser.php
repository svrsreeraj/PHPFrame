<?php
/**************************************************************************************
Created By 	:	hari krishna
Created On	:	5th march 2011
Purpose		:	managing admin users
**************************************************************************************/
class adminUser extends siteclass 
	{ 
		public	$error			=	array();
		private	$user_session	=	"";
		private	$usertable		=	"";
		public 	$adminId		=	"";
		
		//constructor		
		function __construct($user_session="",$usertable="")
			{
				if(!$user_session)		$user_session	=	"sess_admin";
				if(!$usertable)			$usertable		=	"vod_admin_users";			
				$this->user_session						=	$user_session;
				$this->usertable						=	$usertable;
			}
		
		function setError($err)
			{
				$this->error[]	=	$err;
			}
			
		function getError()
			{
				if($this->error)	return implode("<br>",$this->error);
			}
		//methods for sessname
		function set_sessname($sessname)
			{
				$this->user_session	=	$sessname;
			}
		function get_sessname()
			{
				return $this->user_session;
			}
		//getting the members data(logged in user)
		function get_user_data()
			{
				if($_SESSION[$this->get_sessname()]	<>	"")
					{
						return $this->getdbcontents_id($this->usertable,$_SESSION[$this->get_sessname()]);
					}
			}
		//to check whether a user logged in or not
		function check_session()
			{
				if($_SESSION[$this->get_sessname()]	<>	"")
					{
						return $_SESSION[$this->get_sessname()];
					}
			}
		 //return true if the provided details are correct
		public function validateAdminUser($username,$password)
			{				
				$cond			=	$this->dbSearchCond("=","email",$username)." and ".$this->dbSearchCond("=","password",$password)." and status='1'";
				$data			=	$this->getdbcontents_cond('vod_admin_users',$cond);
				if($data)			return $data;						
				else 				return false;			  
			}
		public function getDetails($id="")
			{	
				if(!$id)	$id					=	$this->adminid;
							$resultArry			=	$this->getdbcontents_cond('vod_admin_users',"id=".$id);
							return $resultArry;
			}
		//return the curresponding admin details from all related tables
		public function getAdminDetails($id="")
			{	
				if(!$id)	$id						=	$this->adminid;
				$resultArry	['admin_details']		=	$this->getdbcontents_cond('vod_admin_users',"id=".$id,true);
				$resultArry['vendor']				=	$this->getSalesTeamVendors($id);
				$resultArry['deals']				=	$this->getSalesTeamDeals($id);
				return $resultArry;
			}
		public function getAdminUsers($args="1")
			{	
				$sql				=	"select *,concat(fname,\" \",lname) as fullname from vod_admin_users where $args";
				$resultArry			=	$this->getdbcontents_sql($sql);	
				return $resultArry;
			}
		
		//return vendors related to sales agent team 
		public function getSalesTeamVendors($adminId,$args="1")
			{				
				$condn								=	$this->dbSearchCond("=","saleagent_id",$adminId)."and $args";
				$resultArry							=	$this->getdbcontents_cond('vod_vendor',$condn,true);
				return $resultArry;
			}
		//return deals related to sales agent team 		
		public function getSalesTeamDeals($adminId,$args="")
			{					
				$resultArry							=	array();
				$vendorArr							=	$this-> getSalesTeamVendors($adminId,"status='1'");				
				foreach($vendorArr as $key=>$val)
					{
						if($this->getdbcount_cond('vod_deal','vendor_id='.$val['id']))						
							{
								$resultArry[]		=	$this->getdbcontents_cond('vod_deal','vendor_id='.$val['id']);
							}
					}
				return $resultArry;								
			}
			
		public function getSalesTeamPayments($args="1")
			{					
				$resultArry							=	array();
				$vendorArr							=	$this-> getSalesTeamVendors($adminId,"status='1'");				
				foreach($vendorArr as $key=>$val)
					{
						if($this->getdbcount_cond('vod_deal','vendor_id='.$val['id']))						
							{
								$resultArry[]		=	$this->getdbcontents_cond('vod_deal','vendor_id='.$val['id']);
							}
					}
				return $resultArry;								
			}
			//===================================================From Mahins================================//
		 public function getTotalSiteCommision($adminId,$args="1")
			{				
			
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd 
				where pd.deal_payment_id=p.id and ".$this->dbSearchCond("=","pd.admin_id",$adminId)."and $args";
				$result									=	$this->getdbcontents_sql($sql);
				foreach($result as $data)
					{
						$total_site_Commision			=	$total_site_Commision+$data['total_comm_site'];
					}
				return $total_site_Commision;
			}
		public function getSiteCommisionByVendor($adminId,$vendorID="")
			{				
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd
				 where pd.deal_payment_id=p.id and ".$this->dbSearchCond("=","pd.admin_id",$adminId)."and ".$this->dbSearchCond("=","pd.vendor_id",$adminId)."='$vendorID'";
				$result									=	$this->getdbcontents_sql($sql);
				foreach($result as $data)
					{
						$total_site_Commision			=	$total_site_Commision+$data['total_comm_site'];
					}
				return $total_site_Commision;
			}	
		public function getSiteCommisionByDeal($adminId="",$dealID="")
			{				
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd
				 where pd.deal_payment_id=p.id and ".$this->dbSearchCond("=","pd.admin_id",$adminId)." and ".$this->dbSearchCond("=","p.deal_id",$dealID);
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
					$total_site_Commision				=	$total_site_Commision+$data['total_comm_site'];
					}
				return $total_site_Commision;
			}	
		public function getTotalSalesCommision($adminId,$args="1")
			{	
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd 
														 	where pd.deal_payment_id=p.id and ".$this->dbSearchCond("=","pd.admin_id",$adminId)."and $args";
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$total_comm_sales				=	$total_site_Commision+$data['total_comm_sales'];
					}
				return $total_comm_sales;			
				
			}
		public function getSalesCommisionByDeal($adminId="",$dealID="")
			{				
					$sql								=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd
					 where pd.deal_payment_id=p.id and ".$this->dbSearchCond("=","pd.admin_id",$adminId)." and ".$this->dbSearchCond("=","p.deal_id",$dealID);
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$total_comm_sales				=	$total_site_Commision+$data['total_comm_sales'];
					}
				return $total_comm_sales;
			}	
		public function getSalesCommisionByVendor($adminId="",$vendorID="")
			{				
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd 
				where pd.deal_payment_id=p.id and ".$this->dbSearchCond("=","pd.admin_id",$adminId)." and ".$this->dbSearchCond("=","pd.vendor_id",$vendorID);
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$total_comm_sales				=	$total_site_Commision+$data['total_comm_sales'];
					}
				return $total_comm_sales;
			}	
			
		public function getPaidSitePayment($args="1")
			{
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans 
																pd where pd.deal_payment_id=p.id  and $args";
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$used_comm_site					=	$unit_comm_site+$data['used_comm_site'];
					}
				return $used_comm_site;
				//to get details of paid payments to site admins(meghna pls chk fiel is correct.if else pls change)
			}
		public function getPaidSalesPayment($args="1")
			{
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd 
															where pd.deal_payment_id=p.id  and $args";
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$used_comm_sales				=	$unit_comm_site+$data['used_comm_sales'];
					}
				return $used_comm_sales;
			}
		public function getPaidVendorPayment($args="1")
			{
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans  pd 
															where pd.deal_payment_id=p.id  and $args";
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$used_comm_vendor				=	$unit_comm_site+$data['used_comm_vendor'];
					}
				return $used_comm_vendor;
			}	
			
		public function getBalanceSitePayment($args="1")
			{
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans
			                                                  pd where pd.deal_payment_id=p.id  and $args";
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$balance_comm_site				=	$unit_comm_site+$data['balance_comm_site'];
					}
				return $balance_comm_site;
			}
		public function getBalanceSalesPayment($args="")
			{
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd  
																where pd.deal_payment_id=p.id  and $args";
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$balance_comm_sales				=	$unit_comm_site+$data['balance_comm_sales'];
					}
				return $balance_comm_sales;
			}
		public function getBalanceVendorPayment($args="")
			{
				$sql									=	"select p.*,pd.*  from vod_deal_payments p,vod_deal_payments_trans pd
															 where pd.deal_payment_id=p.id  and $args";
				$result									=	$this->getdbcontents_sql($sql);
				
				foreach($result as $data)
					{
						$balance_comm_vendor			=	$unit_comm_site+$data['balance_comm_vendor'];
					}
				return $balance_comm_vendor;
			}
			
		public function createSitePayment($dataArr)
			{
				$id										=	$this->db_insert('vod_admin_users',$dataArr);
				if(!id)
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else	return $id;
			}
		public function createSalesPayment($dataArr)
			{
				$id										=	$this->db_insert('vod_admin_users',$dataArr);
				if(!id)
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else	return $id;	
			}
		public function createVendorPayment($dataArr)
			{
				$id											=	$this->db_insert('vod_admin_users',$dataArr);
				if(!id)
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else	return $id;
			}		
		public function createAdminUser($dataArr)
			{
				$date					=	"escape now() escape";
				$dataArr['date_added']	=	$date;
				$adminid			 	=	$this->db_insert('vod_admin_users',$dataArr,true);				
				if(!$adminid)
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else	return $adminid;
			}
	
		public function updateAdminUser($dataArr,$id)
			{	
				/*$pswd					=	$dataArr['password'];
				$dataArr['password']	=	"escape password('$pswd') escape";*/
				$data					=	$this->db_update('vod_admin_users',$dataArr,"id=".$id,true);				
				if(!$data) 		
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else	return true;
			}
		
		public function deleteAdminUser($id)
			{
				$vendor									=	$this->getdbcount_cond('vod_vendor',"saleagent_id =".$id);
				$payments								=	$this->getdbcount_cond('vod_deal_payments_trans',"saleagent_id =".$id);
				if((!$vendor)||(!$payments))
					 {
						$this->dbDelete_cond('vod_admin_users',$cond);
						return true;
					 }				 
			}
		
		//*************************************LEFT MENU & PERMISSION********************************BY ANITH********//
			
		public function getAllUsertypes($args="")
			{
				$sql					=	"SELECT * FROM vod_admin_usertype WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}		
			
		public function getAllActions($args="")
			{
				$sql					=	"SELECT * FROM vod_admin_actions WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}	
			
		public function getAllPageActions($args="")
			{
				$sql					=	"SELECT * FROM vod_admin_page_actions WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		 public function get_pageActions($pageid)
			{
				$pageid		=	$this->getRealEscapeData($pageid);
				$actionarr	=	$this->getAllPageActions("pageid='$pageid'");
				foreach($actionarr as $key=>$val)  $actid[]	=	$val['id'];
				$res		=	implode(",",$actid);
					
				return $res;
			}	
		public function getAllMenus($args="")
			{
				$sql					=	"SELECT * FROM vod_admin_menus WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
			
		public function getAllPages($args="")
			{
				$sql					=	"SELECT * FROM vod_admin_pages WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}	
			
		public function getPageDetails($args="1")	
			{
				$sql					=	"SELECT pg.*,act.id as actid FROM `vod_admin_pages` as pg, `vod_admin_page_actions` as
											 act WHERE pg.id=act.pageid and $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		public function getPageActionId($pageid,$actionid)
			{
				$pact		=	$this->getPageDetails($this->dbSearchCond("=","pg.id",$pageid)." and ".$this->dbSearchCond("=","act.actionid",$actionid));
				$pactid		=	$pact[0]["actid"];
				return $pactid;
			}
		public function getPageActionDetails($args="1")	
			{
				$sql					=	"SELECT pg.*,act.action FROM `vod_admin_page_actions` as pg, `vod_admin_actions` as
											 act WHERE act.id=pg.actionid and $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		public function getPermission($args="1")	
			{
				$sql					=	"SELECT * FROM `vod_admin_permission`  WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		
		public function insertMenu($dataArr)
			{
				$menuid			 =	$this->db_insert('vod_admin_menus',$dataArr);
				if(!$menuid)	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else 		return $menuid;
			}
		
		public function insertPage($dataArr)
			{
				$this->dbStartTrans();
				$pageArr						=	$dataArr['page'];
				$actionArr						=	$dataArr['actions'];
				$pageid							=	$this->db_insert('vod_admin_pages',$pageArr);
				
				if($pageid)
					{
						foreach($actionArr as $key=>$val)
							{
								$act_arr['actionid']	=	$val;
								$act_arr['pageid']		=	$pageid;
								$result					=	$this->db_insert('vod_admin_page_actions',$act_arr);
								if(!$result)
									{	$this->dbRollBack();
										$this->setPageError($this->getDbErrors());
										return false;										
									}	
							}	
						return $pageid;
					}
				else
					{ 						
						$this->setPageError($this->getDbErrors());
						return false;
					}
		
			}
		public function insertPermission($dataArr)
			{
				$pid			 =	$this->db_insert('vod_admin_permission',$dataArr);							
				if(!$pid) 
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $pid;
			}
			
		public function updateMenu($dataArr,$id)
			{
				$data		=	$this->db_update('vod_admin_menus',$dataArr,"id=".$id);
				if(!$data) 		
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return true;
			}
			
		public function updatePage($dataArr,$id)
			{
				$pageArr						=	$dataArr['page'];
				$actionArr						=	$dataArr['actions'];
				$data							=	$this->db_update('vod_admin_pages',$pageArr,"id=".$id);
				if(!$data) 		
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else 
					{
						if($actionArr)
							{
								foreach($actionArr as $key=>$val)
									{
										$act_arr['actionid']	=	$val;
										$act_arr['pageid']		=	$id;
										$result					=	$this->db_insert('vod_admin_page_actions',$act_arr);
										if(!$result)
											{
												$this->setPageError($this->getDbErrors());
												return false;										
											}	
									}										
							}
						
						return true;
					}
			}	
			
		//************************************* PERMISSION ***********************************/
		public function head_menu($title,$id,$selected)
			{
				$selStyle	=	($id == $selected) ? 'LeftMenuHeadCurrent':'';
				return	 '<div class="LeftMenuHead  '.$selStyle.'">'.$title.'</div>';
			}
			    
		public function head_page($title,$link,$id,$selected)
			{
				$selStyle	=	($id == $selected) ? 'letnavCurrent':'';
				return	 '<a href="'.$link.'" class="letnav '.$selStyle.'">'.$title.'</a>';
			}
	  	public function get_usertype()
			{
				$aid		=	$this->get_user_data();
				$utypeid	=	$aid['0']['usertype'];		
				return $utypeid;
			}	
		 public function get_menuid($menu)
			{				
				$menulist	=	$this->getAllMenus(" menuname='$menu' and menable=1 order by preference asc");
				$mid		=	$menulist['0']['id'];	
				return $mid;
			}	
		 public function get_menutitle($menu)
			{
				$menulist	=	$this->getAllMenus("menuname='$menu' and menable=1 	order by preference asc");				
				$mtitle		=	$this->ucwords($menulist['0']['menutitle']);	
				return $mtitle;
			}
		public function get_singlePageId($pagenm)
			{
				$pageid		=	$this->getAllPages("page ='$pagenm'");
				$pid		=	$pageid['0']['id'];
				return $pid;
			}	
		 public function get_pageid($pagenm)
			{
				$pageid		=	$this->getAllPages("page like'$pagenm%'");	//order by length(`page`) desc			
				if(count($pageid)>1)	
					{
						$qString	=	$this->getPageQueryString();
						if(!$qString)	$pid	=	$this->get_singlePageId($pagenm);							
						else 
							{
								/*$fullPage	=	$pagenm."?".$qString;								
								foreach($pageid as $key=>$val)
									{
										$pages	=	$val["page"];
										$result	=	stristr($fullPage,$pages);
										if($result)  return $pid	=	$val['id'];
										else  return $pid	=	$this->get_singlePageId($pagenm);										
									}*/
								$qArr		=	explode("&",$qString);
								$pageid		=	$this->getAllPages("page ='".$pagenm."?".$qArr[0]."'");								
								if(!$pageid)   $pid	=	$this->get_singlePageId($pagenm);
								else  $pid	=	$pageid['0']['id'];
							}
					}
				else	 $pid	=	$pageid['0']['id'];
				return $pid;
			}
				
		public function getpermission_page()
			{			
				$utypeid	=	$this->get_usertype();				
				$pagenm		=	$this->getPageName();
				$pid		=	$this->get_pageid($pagenm);	
				$actids		=	$this->get_pageActions($pid);						
				$status		=	$this->getPermission($this->dbSearchCond("=","usertypeid",$utypeid)." and ".$this->dbSearchCond("in","pactionid",$actids));
				if($status)		return "1";
				else			return "0";	
			}
					
		
		public function getmenu_permission($menu)
			{		
				$utid		=	$this->get_usertype();	
				$mid		=	$this->get_menuid($menu);			
				$pageids	=	$this->getAllPages($this->dbSearchCond("=","menuid",$mid)." and penable=1 order by preference asc");
				
				foreach ($pageids  as $key =>	$val)
					{
						$pid			=	$val["id"];
						$actids			=	$this->get_pageActions($pid);						
						if($actids)
						$permstat		=	$this->getPermission($this->dbSearchCond("=","usertypeid",$utid)." and pactionid in ($actids)");
						if($permstat)
							{
								$flag	=	1;
								break;
							}
					}
				if($flag)		return "1";
				else			return "0";	
			}	
			
		public function getsubmenu_list($menu)
			{
				$utid		=	$this->get_usertype();
				
				$pagenm		=	$this->getPageName();
				$selpid		=	$this->get_pageid($pagenm);	 //selected Page
				$pageArr	=	$this->getAllPages(" id ='$selpid'");
				$selMenu	=	$pageArr[0]["menuid"];	 //selected Menu			
				$mid		=	$this->get_menuid($menu);
				$mtitles	=	$this->get_menutitle($menu);
				$pagelist	=	$this->getAllPages($this->dbSearchCond("=","menuid",$mid)."and penable=1 order by preference asc");
				$str		.=   $this->head_menu($mtitles,$mid,$selMenu);
				if($pagelist) $str		.= 	'<div class="leftMenuBody">';
				foreach ($pagelist  as $key =>	$val)
					{
						$pid			=	$val["id"];
						$page			=	$val["page"];
						$ptitle			=	ucwords($val["pagetitle"]);
						$actids			=	$this->get_pageActions($pid);						
						$permstat		=	$this->getPermission($this->dbSearchCond("=","usertypeid",$utid)."and pactionid in ($actids) ");						
						if($permstat)
							{
								$str	.=	$this->head_page($ptitle,$page,$pid,$selpid);
							}
					}
				if($pagelist)	$str	.= '</div>';
				return $str;	
				
			}
		public function get_leftmenu()
			{
				$menulist	=	$this->getAllMenus(" status=1 and menable=1 order by preference asc");
				$list		=	'<div class="LeftMmenuList" id="idLeftMenu">';
				foreach($menulist as $key	=>	$val)
					{
						$menus		=	$val['menuname'];
						if ($this->getmenu_permission($menus))		$list	.=	$this->getsubmenu_list($menus);
					}
				$list		.=	'</div>';
				$list		.=	'<script type="text/javascript">
							$("#idLeftMenu div.LeftMenuHead").click(function()
							{
								$(this).next("div.leftMenuBody").slideDown(200).siblings("div.leftMenuBody").slideUp("slow");
							});
							$("#idLeftMenu div.LeftMenuHeadCurrent").next("div.leftMenuBody").show();
	
							</script>';
				return $list;
			}
		public function getpermission_options($action)
			{
				$utid		=	$this->get_usertype();	
				$pagenm		=	$this->getPageName();
				$pid		=	$this->get_pageid($pagenm);	
				$pactid		=	$this->getPageActionId($pid,$action); 
				if($pactid)	
					$status	=	$this->getPermission($this->dbSearchCond("=","usertypeid",$utid)." and pactionid='$pactid'");
				else
					{
						 
						$pact		=	$this->getAllActions("action = '$action'");						
						if($pact)
						$actid		=	$pact[0]["id"];	
						$pactid		=	$this->getPageActionId($pid,$actid); 
						$status		=	$this->getPermission($this->dbSearchCond("=","usertypeid",$utid)." and pactionid='$pactid'");			
					}
				
				if($status)		return true;
				else			return false;
			}
		public function permissionMenuCheck($action,$redirect="")
			{
				if($this->getpermission_options($action)) return true;
				else
					{
						if($redirect)	
							{
								header("location:noPermission.php");exit;	
							}
						else return false;
					}
			}
		public function getPagePermission()
			{
				$utid		=	$this->get_usertype();	
				$pagenm		=	$this->getPageName();
				$pid		=	$this->get_pageid($pagenm);	
				$pgArr		=	$this->getPageDetails("pg.id='$pid'"); 		
				
				foreach($pgArr as $key=>$val)  $pactid[]	=	$val['actid'];
				$pactids	=	implode(",",$pactid);
				
				if($pactids)					
						$status	=	$this->getPermission($this->dbSearchCond("=","usertypeid",$utid)." and pactionid in ($pactids)");				
				if($status)	return true;
				else			
					{	
						header("location:noPermission.php");exit;	
					}
			}
		
	}
?>