<?php
/**************************************************************************************
Created by :hari krishna
Created on :2010-11-16
Purpose    :Admin Home Model Page
******************* *******************************************************************/
class adminHome extends modelclass 
	{
		public function adminHomeListing()
			{
				$data1							=	$this->getUnlockDealDetails();
				$data2							=	$this->getCustomersDet();
				$data3							=	$this->getEcommerce();
				$data4							=	$this->getVendors();
				$data5							=	$this->getAllDealCount();
				$data6							=	$this->getOrders();
				return array("data1"=>$data1,"data2"=>$data2,"data3"=>$data3,"data4"=>$data4,"data6"=>$data6);
			}
		public function adminHomeupdateData()
			{
				ob_clean();
				$data1							=	array();
				$data1["UnlockDealDetails"]		=	$this->getUnlockDealDetails();
				$data1["getCustomersDet"]		=	$this->getCustomersDet();
				$data1["getEcommerce"]			=	$this->getEcommerce();
				$data1["getVendors"]			=	$this->getVendors();
				$data1["getOrders"]				=	$this->getOrders();
				echo json_encode($data1);
				exit;
			}
		
		public function adminHomeToecomm()
			{
				$getData				=	$this->getData("request");
				if		($getData['inneraction']=="totalorder")			$this->executeAction(false,"Search",true,false,"","","ecommReportAll.php");
				else if ($getData['inneraction']=="totalpoints")		$this->executeAction(false,"Transcomplete",true,false,"","","ecommReportAll.php");
				else if ($getData['inneraction']=="todaysorder")	
					{
						$date	=	date("Y-m-d");
						$this->addData(array("txt_order_from"=>$date,"txt_order_to"=>$date),"post","Transallsearch",false,"ecommReportAll.php");
						$this->executeAction(false,"Search",true,false,"","","ecommReportAll.php");
					}
				else if ($getData['inneraction']=="todaytotalpoints")
					{
						$date	=	date("Y-m-d");
						$this->addData(array("txt_order_from"=>$date,"txt_order_to"=>$date),"post","Transcompletesearch",false,"ecommReportAll.php");
						$this->executeAction(false,"Transcomplete",true,false,"","","ecommReportAll.php");
					
					}
					
			}	
			
		public function  adminHomeTovendor()
			{
				$getData				=	$this->getData("request");
				if($getData['inneraction']	==	"allVendor")
				$this->executeAction(false,"Daily",true,false,"","","vendorReport.php");	
				if($getData['inneraction']	==	"allVendortoday")
					{
						$date	=	date("Y-m-d");
						$this->addData(array("txt_join_from"=>$date,"txt_order_to"=>$date),"post","Transdailysearch",false,"vendorReport.php");
						$this->executeAction(false,"Daily",true,false,"","","vendorReport.php");
					}
			}
		public function  adminHomeToorder()
			{
				$getData				=	$this->getData("request");
				if($getData['inneraction']	==	"allOrder")
				$this->executeAction(false,"Daily",true,false,"","","dealOrderAll.php");	
				
				if($getData['inneraction']	==	"allOrdertoday")
					{
						$date	=	date("Y-m-d");
						$this->addData(array("txt_order_from"=>$date,"txt_order_from"=>$date),"post","Transdailysearch",false,"dealOrderAll.php");
						$this->executeAction(false,"Transdailysearch",true,false,"","","dealOrderAll.php");
					}	
			}	
			
		public function adminHomeTodeals()
			{
				$getData				=	$this->getData("request");
				$this->addData(array("sel_status"=>$getData['status']),"post","Search",false,"dealsList.php");
				$this->executeAction(false,"Listing",true,false,"","","dealsList.php");
			
			}
		public function adminHomeTocustomer()
			{
				$getData				=	$this->getData("request");
				if($getData['inneraction']	==	"allcustomers")				$this->executeAction(false,"",true,false,"","","customers.php");
				if($getData['inneraction']	==	"allcustomersproductive")	
					{
						$this->addData(array("sel_filter_users[]"=>"productive"),"post","Search",false,"customers.php");
					}
				if($getData['inneraction']	==	"todaycustomer")	
					{
						$date	=	date("Y-m-d");
						$this->addData(array("txt_join_from"=>$date,"txt_join_to"=>$date),"post","Search",false,"customers.php");
						$this->executeAction(false,"",true,false,"","","customers.php");
					}
			}
			
		public function getVendors()
			{
				$date							= 	date("Y-m-d") ;
				$vendor							=	array();	
				$sql							=	"select COUNT(id) as num from vod_vendor ".LOGGEDIN_ID." and status=1";
				$data							=	end($this->getdbcontents_sql($sql));
				$vendor['vendor_count']			= 	$data[num]  ;
				$sql							=	"select COUNT(id) as num from vod_vendor ".LOGGEDIN_ID." and  status=1 and DATE(vod_vendor.date_added)='$date'";
				$data							=	end($this->getdbcontents_sql($sql));
				if($data["num"]==0)
					{
						$vendor['vendorCountToday']	="No new Vendors today";	
					}
				else 	$vendor['vendorCountToday']	=$data["num"];
				
				return $vendor;	
			}
			
			
		public function getEcommerce()
			{
				$date							= 	date("Y-m-d") ;
				$ecom							=	array();	
				$paid							=	GLB_ECOM_PAID;
				$sql							=	"select SUM(paid_point) as totalAmount,count(*) as totalOrders from  vod_ecomm_order where paid_status=$paid";
				$data							=	end($this->getdbcontents_sql($sql));
				$sql1							=	"select SUM(paid_point) as todayAmount,count(*) as todayOrders from  vod_ecomm_order where paid_status=$paid  and DATE(vod_ecomm_order.order_date)='$date' ";
				$data1							=	end($this->getdbcontents_sql($sql1));
				if($data['totalAmount']=="")		$ecom['total']	=	"0.00";
				else	$ecom['total']			=	$data['totalAmount'];	 
				$ecom['count']					= 	$data['totalOrders'];
				
				if(!$data1)
					{
						$ecom['totalAmount']	=	"0.00";
						$ecom['todaydeal']		=	"No Oders for today";	
					}
				else 
					{
						if($data1['todayAmount']=="")		$ecom['totalAmount']	=	"0.00";
						else	$ecom['totalAmount']	=	$data1['todayAmount'];
						$ecom['todaydeal']				=	$data1['todayOrders'];
					}
				return $ecom;
			}
		public function getAllDealCount()
			{
				$sql							=	"select count(id) from vod_deal where 1";
				$number							=	end($this->getdbcontents_sql($sql));
				return $number;
			}
		public function getOrders()
			{
				
				$date							= 	date("Y-m-d") ;
				$order							=	array();	
				$sql							=	"select COUNT(id) as num from vod_deal_order ".LOGGEDIN_ID."";
				$data							=	end($this->getdbcontents_sql($sql)); 
				$order['order_count']			= 	$data[num]  ;
				$sql							=	"select COUNT(id) as num from vod_deal_order ".LOGGEDIN_ID." and DATE(vod_deal_order.orderDate)='$date'";
				$data							=	end($this->getdbcontents_sql($sql));
				if($data["num"]==0)
					{
						$order['orderCountToday']	="No new Orders today";	
					}
				else 	$order['orderCountToday']	=$data["num"];
				
				return $order;	
			}	
		public function getUnlockDealDetails()
			{
				$sql							=	"select count(*) as total from vod_deal ".LOGGEDIN_ID;
				$dealcount['total']				=	end($this->getdbcontents_sql($sql));
				
				$sql							=	"select count(*) as total_under_review   from vod_deal ".LOGGEDIN_ID." and status=0";
				$dealcount['total_under_review']=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*) as total_queue from vod_deal ".LOGGEDIN_ID." and status=1";
				$dealcount['total_queue']		=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*) as total_rejected from vod_deal ".LOGGEDIN_ID." and status=2";
				$dealcount['total_rejected']	=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*)as total_locked from vod_deal ".LOGGEDIN_ID. " and status=3";
				$dealcount['total_locked']		=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*)  as total_unlocked from vod_deal ".LOGGEDIN_ID." and status=4";
				$dealcount['total_unlocked']	=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*)as total_cooldown from vod_deal ".LOGGEDIN_ID." and status=5";
				$dealcount['total_cooldown']	=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*) as total_expired from vod_deal ".LOGGEDIN_ID." and status=6";
				$dealcount['total_expired']		=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*) as total_running from vod_deal ".LOGGEDIN_ID." and (status=3 or status=4)";
				$dealcount['total_running']		=	end($this->getdbcontents_sql($sql));
				
			return $dealcount;
		}
		
		
		
		public function getCustomersDet()
			{
				$date							= 	date("Y-m-d") ;
				$sql							=	"select count(*) as customertot from vod_customer  where status=1";
				$data							=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*) as countprd from vod_customer  as vc, vod_deal_order as vdo where vdo.customer_id=vc.id" ;
				$prodcust						=	end($this->getdbcontents_sql($sql));
				$sql							=	"select count(*) as customertottoday from vod_customer  where status=1 and DATE(vod_customer.date_added)='$date' ";
				$custtoday						=	end($this->getdbcontents_sql($sql));
				$Customers						=	array();
				$customers['totcount']			=	$data['customertot'];
				$customers['countprd']			=	$prodcust['countprd'];
				$customers['totcusttoday']		=	$custtoday['customertottoday'];	
				$prodcust						=	0;	
			return $customers;
			
			}
		public function __construct()
			{
				$adminNew						=		new adminUser();			
				$logedin						=		end($adminNew->get_user_data());
				if($logedin['usertype']==2)				
				{
					define('LOGGEDIN_ADMIN_USER',$logedin['usertype']);
					define('LOGGEDIN_ID'," where saleagent_id=".$logedin['id']);
					define ('SALESID',$logedin['id']);
				}
				else if ($logedin['usertype']==1)		define('LOGGEDIN_ID',"where 1");
				define('LOGGEDIN_ADMIN_USER',$logedin['usertype']);
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
