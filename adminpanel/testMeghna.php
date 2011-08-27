<?php
/**************************************************************************************
Created By 	:	Meghna
Created On	:	2010-11-04
Description	:	This is mainly for testing purpose Ver1.0
 ************************** ************************************************************/
require_once 'init.php';err_status("init.php included");
$obj					=	new customer();

$dataArr				= array();
$dataArr["agree"]		= "1";
$dataArr["password"]	= "123456";
$dataArr["repassword"]	= "123456";
//$res		=	$obj->customerSignUpApi($dataArr);
//$res		=	$obj->createDeal($dataArr);
echo $res;

/*$obj		=	new deals();
$data					=	array();
$data["deal_id"]		=	8;
$data["coupon_code"]	=	"iw2p26z";
$data["order_id"]		=	1001;
//$res					=	$obj->getUnlockedDealsDetails();
//$res					=	$obj->getMyPurchasedDeals(1001);


$dataArr["fname"]		=	 "test";
$dataArr["lname"]		=	 "reubro";
$dataArr["email"]		=	 "test@reubro.com";
$dataArr["password"]	=	 "testgfjyjtit";
$dataArr["repassword"]	=	 "testgfjyjtit";
$dataArr["mobile"]		=	 "9979986666";
$dataArr["country_id"]	=	 2;
$dataArr["state_id"]	=	 5;
$dataArr["email_update"]=	 0;
$dataArr["sms_update"]	=	 1;
$dataArr["agree"]		=	 1;
//$res					=	$obj->customerSignUpApi($dataArr);*/
$res					=	$obj->getCustomerPointsApi(1000);
//$dataArr				=	array("testreubro1@gmail.com","testreubro1@gmail.com");
//$res					=	$obj->insertCustomerInviteEmails($dataArr,1000);
print_r($res);
?>