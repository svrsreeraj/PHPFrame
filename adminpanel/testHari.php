<?php
/**************************************************************************************
Created by :hari krishna
Created on :2010-11-04
Purpose    :This is for testing purpose only
**************************************************************************************/
//require_once 'init.php';err_status("init.php included");
//require_once '../library/siteclass.php';err_status("init.php included");
//require_once '../classes/defaults.php';err_status("init.php included");
//require_once '../classes/cms.php';err_status("init.php included");

//------------------population values for vod_admin_user----------------------------//
//populatong values for sales agent
/*
for($i=0;$i<2000;$i++)
{
	$sql					=	"insert into vod_admin_users (id,usertype,username,password,fname,lname,email,mobile,address,preference,ip,date_added,status) 
								values('','2','username$i','password.$i','fname.$i','lname.$i','email.$i','123456!.$i','address.$i','1','192.168.65.$i',NOW(),'1')";
	$vod_admin_user_insert	=	mysql_query($sql);
	if(!vod_admin_user_insert) die("could not insert into admin user at $i");
	
}

//--------------------populating values into vendor-----------------------------------//

for ($i=0; $i<=2500;$i++)
	{
		$sql				=	"insert into vod_vendor(id,apps_id,vendorcode,saleagent_id,business_name,contact_person,email,password,address,country_id,state_id,zip,mobile,latitude,longitude,tax,email_update,sms_update,ip,date_added,mobile_status,status) 
								values('','1','vendorcode.$i',(select id from vod_admin_users where usertype=2 order by rand() limit 1),'bussinesname.$i','contact_person.$i','email.$i','password.$i','address.$i',(select id from vod_country where status=1 order by rand() limit 1),'1','682024.$i','9809412384.$i','1024.$i','1254.$i','1.$i','1','1','192.168.0',now(),'1','1')";
		$insert_vendor		=	mysql_query($sql);
		if(!insert_vendor) die("could not insert at $i");
	}
DIE();
/*
//-------------------inser into category-----------------------
for($i=0;$i<=2000;$i++)
	{
		$sql				=	"INSERT INTO `vod_category` (`id` ,`category` ,`image` ,`preference` ,`status`)VALUES (NULL ,'category$i','image','1','1')";
		$insert_category	=	mysql_query($sql);
		if(!$insert_category) die("could not insert into category at $i");
	}

//-----------------insert into subcatogory-------------------
for($i=0;$i<=2000;$i++)
	{
		$sql				=	"INSERT INTO  `voteondeal`.`vod_category_sub` (`id` ,`category_id` ,`subcategory` ,`image` ,`preference` ,`status`) 
									VALUES (NULL ,(select id from vod_category where status=1 order by rand() limit 1 ),  'subcatogory$i',  'imgsubcat',  '1',  '1')";
		$insert_subcategory	=	mysql_query($sql);
		if(!$insert_subcategory) die("failed insering into subcategory at $i");
		
	}

//------------------inserting a  new deal---------------------s

for($i=0;$i<100;$i++)
{
	$dealprice		=	rand(100,500);	//the price at which the product is sold in site
	$dealcost		=	$dealprice-100;	// actual price 
	$offer_rate		=	floor($dealprice*100/$dealcost);	
	$vendorcommrate	=	rand(5,15);		//vendor comm
	$vendorcomm		=	floor($dealprice*$vendorcommrate/100);
	$sitecommrate	=	rand(5,10);		//vendor comm
	$sitecomm		=	floor($dealprice*$sitecommrate/100);
	$salescommrate	=	rand(5,10);		//vendor comm
	$salescomm		=	floor($dealprice*$salescommrate/100);
	$unlockvotes	=	rand(500,10000);
	$votes			=	rand(500,10000);
	$totalquantity	=	rand(3000,10000);
	$soldquantity	=	rand(0,$totalquantity);
	$balance		=	$totalquantity-$soldquantity;
	$custmaxbuy		=	rand(100,300);
	$custmaxbuygift	=	rand(100,300);
	$deal_days		=	rand(30,120);
	$cooldown		=	rand(20,35);
	$cooldowndate  	= 	mktime(0, 0, 0, date("m")  , date("d")+$cooldown, date("Y"));
	$expiredays		=	mktime(0, 0, 0, date("m")  , date("d")+$deal_days, date("Y"));		
	$status		=	rand(0,6);


	$sql="INSERT INTO `voteondeal`.`vod_deal` (`id`, `apps_id`, `vendor_id`, `saleagent_id`, `subcategory_id`, `name`, `caption`, `description`, `deal_price`, `cost`, `offer_rate`, `vendor_comm_rate`, `vendor_commision`, `site_comm_rate`, `site_commision`, `sales_comm_rate`, `sales_commision`, `unlockvote`, `votes`, `activation_date`, `total_quantity`, `sold_quantity`, `balance_quantity`, `cust_maxbuy`, `cust_maxbuy_gift`, `deal_days`, `rules`, `image`, `cooldown_days`, `ip`, `date_added`,`unlocked_date`, `cooldown_date`, `expired_date`, `status`)
							VALUES (NULL, '1',(select id from vod_vendor where status =1 order by rand() limit 1), 
														(select saleagent_id from vod_vendor where status =1 order by rand() limit 1),
														(select id from  vod_category_sub where status=1 order by rand() limit 1), 'DealName$i', 'DealCaption.$i', 'Dealdescription.$i',$dealprice , $dealcost, $offer_rate, $vendorcommrate, $vendorcomm, $sitecommrate, $sitecomm, $salescommrate, $salescomm, $unlockvotes, $votes, NOW(), $totalquantity, $soldquantity, $balance,	$custmaxbuy, $custmaxbuygift, $deal_days, 'rules.$i', 'image.$i', $cooldown, '2342342.$i',now(),now(),now(),now(),$status)";
		echo $sql;
	$deal=mysql_query($sql);
	if(!$deal)die("deal could not be inserted at $i");

}
die();
/*
//------------------------------populate customer ----------------------

for($i=0;$i<2000;$i++)
{
	$totpoints					=	rand(0,1200);
	$usedpoint					=	rand(0,$totpoints);	
	$balancepoints				=	$totpoints-$usedpoint;
	$sql					=	"insert into vod_customer (id,apps_id,customercode,fname,lname,email,image,country_id,zip,mobile,email_update,sms_update,total_points,used_points,balance_points,date_added,mobile_status,status) 
								values('','1','customercode$i','fname.$i','lname.$i','email.$i','image',(select id from vod_country where status=1 order by rand() limit 1),'682024','9809412382.$i',1,1,$totpoints,$usedpoint,$balancepoints,now(),1,1)";
	$vod_admin_user_insert	=	mysql_query($sql);
	if(!vod_admin_user_insert) die("could not insert into admin user at $i");
	
}

//------------------------vod_customer_votes-----------------------------------
for ($i=0;$i<2000;$i++)
{
	$sql	=	"insert into vod_customer_votes (id,apps_id,customer_id,deal_id,ip,date_added) values ('','1',(select id from vod_customer where status=1 order by rand() limit 1),(select id from vod_deal where status=3 order by rand() limit 1),'192.168.0.1',now())";
	$votes	=	mysql_query($sql);
	if(!$votes) die("there was an error inserting vod_customer_votes at $i" );
}


//----------------INSERTING INTO vod_deal_order---------------
for($i=0;$i<5000;$i++)
{
	$paidopt	=	rand(0,2);
	$qantity	=	rand(0,200);
	$price		=	rand(20,200);	
	$totprice	=	$qantity*$price;
	$paidsitecr	=	rand(0,200);
	$paid_camt	=	rand(0,500);
	$rand		=	rand(0,1);
	$owner		=	rand(0,1800);
	$sql		=	"insert into vod_deal_order VALUES
		(NULL, '1',(select id from vod_deal where status=4 or status=6 order by rand() limit 1)  ,$owner,$owner, '1', $paidopt, $qantity, $price, $totprice, $paidsitecr, $paid_camt, $rand, $rand, CURRENT_TIMESTAMP, now(), $qantity,$rand, now(), $rand, $rand,'192.168.0.8')";



				mysql_query($sql);
}

//------------------insert into site credit-----------------
for($i=0;$i<=500;$i++)
{
	$credit		=	rand(0,2000);
	$creditused	= rand(0,2000);
	$balance	=$credit-$creditused;
	$cutomer		=	rand(0,1800);
	$sql="INSERT INTO  `voteondeal`.`vod_customer_sitecredits` (`id` ,`customer_id` ,`total_credit` ,`used_credit` ,`balance_credit` ,
	`date_updated`
	)
	VALUES (
	NULL , $cutomer ,  $credit,  $creditused,  $balance, 
	CURRENT_TIMESTAMP
	)";

for($i=0;$i<1000;$i++)
{
	$paidsitecr	=	rand(0,200);
	$paid_camt	=	rand(0,500);
	$qantity	=	rand(0,200);
	$shipamount	=	rand(0,200);
	$total	=	rand(0,200);
	$phone	=	rand(987654321,999999999);
	$cutomer		=	rand(0,1800);
	$sql="INSERT INTO  `vod_ecomm_order` (
	`id` ,
	`apps_id` ,
	`customer_id` ,
	`ship_fname` ,
	`ship_lname` ,
	`ship_addr1` ,
	`ship_addr2` ,
	`ship_phone` ,
	`ship_state` ,
	`ship_country` ,
	`ship_zip` ,
	`bill_fname` ,
	`bill_lname` ,
	`bill_addr1` ,
	`bill_addr2` ,
	`bill_phone` ,
	`bill_state` ,
	`bill_country` ,
	`bill_zip` ,
	`quantity` ,
	`pay_opton` ,
	`payment_type` ,
	`paid_sitecredit` ,
	`paid_cardamount` ,
	`total_amount` ,
	`discount_amount` ,
	`ship_amount` ,
	`grand_total` ,
	`ip` ,
	`paid_date` ,
	`paid_status` ,
	`deliver_date` ,
	`deliver_status` ,
	`order_date`
	)
	VALUES (
	NULL ,  '1',  $cutomer,'ship_fname.$i',  'ship_lname.$i', 'ship_addr1$i', 'ship_addr2.$i',  $phone,  (select id from vod_country where status=1 order by rand() limit 1), 682024,  'bill_fname.$i'	,  'bill_lname',  'bill_addr1',  'bill_addr2',  '9809412384',  '1',  (select id from vod_country where status=1 order by rand() limit 1),  '682024',  '$qantity',  '1',  '1',  $paidsitecr, $paid_camt,  $paid_camt,  $qantity, $paid_camt,$shipamount, $total, '192.168.0.8',now(),  '1',  now(),  '1',  now())";

mysql_query($sql);
}



for($i=0;$i<=3000;$i++)
{
		$sold	=	rand(0,200);
		$unitamt	=	rand(0,100);
		$totamt=$unitamt*$sold;
		$unit_comm_vendor=rand(0,50);
		$unit_comm_site=rand(0,50);
		$unit_comm_sales=rand(0,50);
		$usercomm1=rand(0,500);
		$usercomm2=rand(0,500);
		$usercomm3=rand(0,500);
		$balancecommvendor=$total_comm_vendor-$usercomm1;
		$balancecommsite=$total_comm_site-$usercomm2;
		$balancecommsales=$total_comm_sales-$usercomm3;
		$total_comm_vendor=$unit_comm_vendor*$sold;
		$total_comm_site=$unit_comm_site*$sold;
		$total_comm_sales=$unit_comm_sales*$sold;
		$sql="INSERT INTO  `voteondeal`.`vod_deal_payments` (
		`id` ,
		`apps_id` ,
		`deal_id` ,
		`sold_quantity` ,
		`unit_amount` ,
		`total_amount` ,
		`unit_comm_vendor` ,
		`unit_comm_site` ,
		`unit_comm_sales` ,
		`total_comm_vendor` ,
		`total_comm_site` ,
		`total_comm_sales` ,
		`used_comm_vendor` ,
		`used_comm_site` ,
		`used_comm_sales` ,
		`balance_comm_vendor` ,
		`balance_comm_site` ,
		`balance_comm_sales` ,
		`date_updated`
		)
		VALUES (
		NULL ,  '1',  (select id from vod_deal where status=3 order by rand() limit 1),  $sold,  $unitamt, $totamt,
		  $unit_comm_vendor,  $unit_comm_site, $unit_comm_sales,$total_comm_vendor, $total_comm_site,  $total_comm_sales,  $usercomm1,  $usercomm2,  $usercomm3,  $balancecommvendor,  $balancecommsite,  $balancecommsales, now())";
		 
		 mysql_query($sql);
		 $vendor=rand(0,5000); 
		 $admin=rand(0,2000);

		 $id = mysql_insert_id();
		$sql="INSERT INTO  `voteondeal`.`vod_deal_payments_trans` (
		`id` ,
		`apps_id` ,
		`deal_payment_id` ,
		`payment_date` ,
		`vendor_id` ,
		`admin_id` ,
		`saleagent_id` ,
		`amount` ,
		`ip` ,
		`date_added` ,
		`updated_by`
		)
		VALUES (
		NULL ,  '1',  $id,now(),  $vendor,  $admin,  (select id from vod_admin_users where status=1 and usertype=2 order by rand() limit 1), $totamt,  '192.168.0.8', 
		CURRENT_TIMESTAMP ,  '(select id from vod_admin_users where status=1 and usertype=2 order by rand() limit 1)'
		)";

		mysql_query($sql);
}


for($i=0;$i<2000;$i++)
{
	$sold	=	rand(0,200);
	$productamt	=	rand(0,100);
	$discountamt	=	rand(0,100);
	$totamt=$productamt-$discountamt;
	$ship=rand(0,50);
	$grand=$totamt+$ship;
	$sql="INSERT INTO  `voteondeal`.`vod_ecomm_cart` (
	`id` ,
	`apps_id` ,
	`customer_id` ,
	`quantity` ,
	`prod_amount` ,
	`discount_amount` ,
	`ship_amount` ,
	`grand_total` ,
	`ship_fname` ,
	`ship_addr1` ,
	`ship_addr2` ,
	`ship_phone` ,
	`ship_state` ,
	`ship_country` ,
	`ship_zip` ,
	`ip` ,
	`date_added`
	)
	VALUES (
	NULL ,  '1',  (select id from vod_admin_users where status=1 and usertype=2 order by rand() limit 1),  $sold	
	,  $productamt,  $discountamt, $ship,  $grand,  'ship_fname.$i', 'ship_addr1.$i',  'ship_addr2.$i',  '9809412384',  $ship,'(select id from vod_country where status=1)',  '682024',  '192.168.0.8',CURRENT_TIMESTAMP)";
	mysql_query($sql);
}
for($i=0;$i<200;$i++)
{
	$sql="INSERT INTO  `voteondeal`.`vod_ecomm_prodcategory` (
	`id` ,
	`category` ,
	`preference` ,
	`status`
	)
	VALUES (
	NULL ,  'catogory.$i',  '1',  '1'
	)";
mysql_query($sql);
}

for($i=0;$i<50;$i++)
{
	$sql="INSERT INTO  `voteondeal`.`vod_product` (
	`id` ,
	`product` ,
	`preference` ,
	`status`
	)
	VALUES (
	NULL ,  ' vod_product.$i ',  '1',  '1'
	)";
mysql_query($sql);
}


?>
<?php 




for($i=2159;$i<=2261;$i++)
{
	$sold_quantity		=	rand(40,200);
	$unit_amount		=	rand(10,200);
	$total_amount		=	$sold_quantity*$unit_amount;
	$unit_comm_vendor	=	$unit_amount*rand(1,15)/100;
	$unit_comm_site		=	$unit_amount*rand(1,15)/100;
	$unit_comm_sales	=	$unit_amount*rand(1,15)/100;
	$total_comm_vendor	=	$unit_comm_vendor*$sold_quantity;
	$total_comm_site	=	$unit_comm_site*$sold_quantity;
	$total_comm_sales	=	$unit_comm_sales*$sold_quantity;
	$used_comm_vendor	=	rand(0,$total_comm_vendor);
	$used_comm_site		=	rand(0,$total_comm_site);
	$used_comm_sales	=	rand(0,$total_comm_sales);
	$balance_comm_vendor=	$total_comm_vendor-$used_comm_vendor;
	$balance_comm_site	=	$total_comm_site-$used_comm_site;
	$balance_comm_sales	=	$total_comm_sales-$used_comm_sales;
	
	
$sql = " INSERT INTO  vod_deal_payments 
	(
		`id` ,
`apps_id` ,
`deal_id` ,
`sold_quantity` ,
`unit_amount` ,
`total_amount` ,
`unit_comm_vendor` ,
`unit_comm_site` ,
`unit_comm_sales` ,
`total_comm_vendor` ,
`total_comm_site` ,
`total_comm_sales` ,
`used_comm_vendor` ,
`used_comm_site` ,
`used_comm_sales` ,
`balance_comm_vendor` ,
`balance_comm_site` ,
`balance_comm_sales` ,
`date_updated`
	)
	VALUES( NULL ,'1',  '$i',  
	'$sold_quantity',  '$unit_amount',  '$total_amount',  '$unit_comm_vendor', '$unit_comm_site',  '$unit_comm_sales',  '$total_comm_vendor',  '$total_comm_site',  '$total_comm_sales', '$used_comm_vendor',  '$used_comm_site',  '$used_comm_sales',  '$balance_comm_vendor',  '$balance_comm_site','$balance_comm_sales',now())";
	
mysql_query($sql);
}

	
	
	
	
	
	
	
	
	
	
	
?>