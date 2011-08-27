<?php
/**************************************************************************************
Created By 	:	Mahinsha  T.K
Created On	:	2010-11-04
Description	:	This is mainly for testing purpose Ver1.0
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");

$deal_obj=new deals();
	$data_array=array();
	$data_array['deal_id']=1;
	$data_array['deal_price']=1;
	$data_array['vendor_commision']=100;
	
	$data_array['site_commision']=100; 
	$data_array['sales_commision']=100;
	$a=$deal_obj->getTotalcommnVendor(1);
	print_r($a);
	
//=================================================================Ecommerce Section==================================	//
/*include("../classes/ecommProducts.php");
	$ecomm_obj=new ecommProducts();*/
	/*$a=$ecomm_obj->getAllEcommProductCategory(1);
	print_r($a);
	die();
	
	$a=$ecomm_obj->getAllEcommProductCategory("status=1");
	//$data_array=array();
	$data_array['category']="Fashion";
	$data_array['preference']=3;
	$data_array['status']=1;
	$a=$ecomm_obj->updateEcommProductCategory($data_array,1); 
	print_r($a);
	echo $a;
		die();
	die();*/
	
	/*$data_array['category_id']=1;
	$data_array['product']="Axe";
	$data_array['price']=200;
	$data_array['total_quantity']=100;
	$data_array['sold_quantity']=10;
	$data_array['balance_quantity']=90;
	$data_array['preference']=1;
	$data_array['status']=1;
	$a=$ecomm_obj->insertEcommProduct($data_array); 
	print_r($a);
	echo $a;
		die();
*/
	
		/*$a=$ecomm_obj->deleteEcommProduct(3);
		echo $a;*/


/*	$data_array['cart']['customer_id']=1;
	$data_array['cart']['quantity']=222221111111111111111111111;
	$data_array['cart']['prod_amount']=2002222;
	$data_array['cart']['discount_amount']=10222;
	$data_array['cart']['ship_amount']=90222;
	$data_array['cart']['grand_total']=9022;
	$data_array['cart']['ship_fname']=9022;
	$data_array['cart']['ship_addr1']=9022;
	$data_array['cart']['ship_addr2']=9022;
	$data_array['cart']['ship_phone']=9022;
	$data_array['cart']['ship_state']=222;
	$data_array['cart']['ship_country']=21;
	$data_array['cart']['ship_zip']=122;
	$data_array['cart']['ip']=122;
	$data_array['cartDetails']['ecomm_prodid']=2;
	$data_array['cartDetails']['quanity']=2;
	$data_array['cartDetails']['unit_price']=2;
	$data_array['cartDetails']['prod_price']=2;
	$a=$ecomm_obj->updateEcommCart($data_array,1); 
	print_r($a);
	echo $a;
		die();*/

/*	$a=$ecomm_obj->getAllCartByProductCategory(1);
	print_r($a);*/
	
	/*$data_array['order']['customer_id']=1;
	$data_array['order']['ship_fname']=222221111111111111111111111;
	$data_array['order']['ship_lname']=2002222;
	$data_array['order']['ship_addr1']=10222;
	$data_array['order']['ship_addr2']=90222;
	$data_array['order']['ship_phone']=9022;
	$data_array['order']['ship_state']=9022;
	$data_array['order']['ship_country']=9022;
	$data_array['order']['ship_zip']=9022;
	$data_array['order']['bill_fname']=9022;
	$data_array['order']['bill_lname']=222;
	$data_array['order']['bill_addr1']=21;
	$data_array['order']['bill_addr2']=122;
	$data_array['order']['bill_addr2']=122;
	$data_array['order']['bill_phone']=122;
	$data_array['order']['bill_state']=122;
	$data_array['order']['bill_country']=122;
	$data_array['order']['bill_zip']=122;	
	$data_array['order']['pay_opton']=2;
	$data_array['order']['paid_sitecredit']=100;
	$data_array['order']['paid_cardamount']=122;
	$data_array['order']['total_amount']=122;
	$data_array['order']['discount_amount']=122;
	$data_array['order']['ship_amount']=122;
	$data_array['order']['grand_total']=122;
	$data_array['order']['ip']=122;
	$data_array['order']['paid_date']=122;
	$data_array['order']['paid_status']=1;
	$data_array['order']['deliver_date']=122;
	$data_array['orderDetails']['ecomm_prodid']=2;
	$data_array['orderDetails']['quanity']=2;
	$data_array['orderDetails']['unit_price']=2;
	$data_array['orderDetails']['prod_price']=2;
	$a=$ecomm_obj->addEcommOrders($data_array,1); 
	echo $a;
	print_r($a);
	echo $a;
		die();
*/

		/*$a=$ecomm_obj->getEcommDetails();
		print_r($a);	*/
		//===========================================================End oF ecomerce section=====================================//



//==================================================================Vendor Section//=============================================//
//include("../classes/vendor.php");
/*$ecomm_obj=new vendors();

	$data_array['vendor']['vendorcode']=2002222;
	$data_array['vendor']['saleagent_id']=10222;
	$data_array['industyData'][0]=1;
	$data_array['industyData'][1]=2;
	$data_array['industyData'][2]=3;
	$data_array['productData']['product_id']=5;
	$a=$ecomm_obj->getVendorIndustries(2);
		print_r($a);*/
		
		
//=================================================================End Of Vendor section//=======================================//
//==================================================================Customer  Section//=============================================//

/*include("../classes/customer.php");
	$customer_obj=new customer();*/
	/*$data_array['customer']['referred_by']=1;
	$data_array['customer']['customercode']="Axe";
	$data_array['customer']['fname']="AxeDenim";
	$data_array['customer']['password']="mahin";
	
	$data_array['customer']['lname']="AxeDenim";
	$data_array['customer']['email']="shamahin@yahoo.com";
	$data_array['customer']['country_id']=11;
	$data_array['customer']['state_id']=1;
	$data_array['customer']['zip']=1;
	$data_array['customer']['mobile']=1;
	$data_array['customer']['question_area']=1;
	$data_array['customer']['email_update']=1;
	$data_array['customer']['sms_update']=1;
	$data_array['customer']['total_points']=1;
	$data_array['customer']['used_points']=1;
	$data_array['customer']['balance_points']=1;
	$data_array['customer']['from_fb']=1;
	$data_array['customer']['fb_id']=1;
	$data_array['customer']['fb_data']=1;



	$data_array['customer']['ip']=1;
	
	$data_array['customer']['status']=1;
	$data_array['customerinterest']['subcategory_id']=1;
	$a=$customer_obj->createCustomer($data_array); 
	print_r($a);*/
	
/*	$data_array['dealcoupon_id']=1;
	$data_array['sent_from']=15;
	$data_array['sent_to']=1;
	$data_array['sent_toemail']=1;
	$a=$customer_obj->insertDealSharing($data_array); 
	print_r($a);*/
	/*$a=$customer_obj->getCustomerPurchasedSendtoFriendDeals(15); 
	print_r($a);*/
	

//=================================================================End Of Vendor section//=======================================//

//==================================================================Admin user Section Start//==================================//
/*include("../classes/adminUser.php");

$admin_obj=new adminUser();
$result=$admin_obj->getPaidSitePayment("p.id=1");
print_r($result);*/

	
?>
