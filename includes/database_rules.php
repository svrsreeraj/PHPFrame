<?php
/**************************************************************************************
Created by :Anith
Created on :2010-11-04
Purpose    :defining database rules
**************************************************************************************/
$dBaseRules	=	array();


//***********************  POD RULES ***************************************/

//POD COUPON
$dBaseRules["pod_coupon"]["vendor_id"]						=	array(array("emptyCheck",0,0,"Please select a vendor"),array("idCheck",1,0,"Please select a valid vendor"));
$dBaseRules["pod_coupon"]["subcategory_id"]					=	array(array("emptyCheck",0,0,"Please select a sub-category"),array("idCheck",1,0,"Please select a sub-category"));
$dBaseRules["pod_coupon"]["name"]							=	array(array("emptyCheck",0,0,"Please enter a coupon name"),array("nameCheck",2,200,"Please enter a valid coupon name"));
$dBaseRules["pod_coupon"]["caption"]						=	array(array("emptyCheck",0,0,"Please enter a coupon caption"),array("captionCheck",2,500,"Please enter a valid coupon caption"));
//$dBaseRules["vod_deal"]["description"]					=	array(array("emptyCheck",0,0,""),array("descriptCheck",10,0,""));
//$dBaseRules["pod_coupon"]["cost"]							=	array(array("emptyCheck",0,0,"Please enter a coupon cost"),array("priceCheck",1,15,"Please enter a valid coupon cost"));
$dBaseRules["pod_coupon"]["activation_date"]				=	array(array("emptyCheck",0,0,"Please enter an activation date"),array("dateCheck","","","Please enter a valid activation date"));
$dBaseRules["pod_coupon"]["coupon_days"]					=	array(array("emptyCheck",0,0,"Please enter number of coupon days"),array("numberCheck",1,15,"Please enter a valid number of coupon days"));
//$dBaseRules["vod_deal"]["rules"]							=	array(array("descriptCheck",1,0,"Please enter valid rules"));
//$dBaseRules["vod_deal"]["highlights"]						=	array(array("descriptCheck",1,0,"Please enter valid highlights"));
$dBaseRules["pod_coupon"]["image"]							=	array(array("emptyCheck",0,0,"Please upload a coupon image"),array("imageCheck",4,0,"Please upload a valid coupon image"));
$dBaseRules["pod_coupon"]["expired_date"]					=	array(array("emptyCheck",0,0,"Please enter expiry date"));
$dBaseRules["pod_coupon"]["coupon_expiry_date"]				=	array(array("emptyCheck",0,0,"Please enter coupon expiry date"),array("dateCheck","","","Please enter a valid coupon expiry date"));
$dBaseRules["pod_coupon"]["vod_deal_id"]					=	array(array("idCheck",1,0,"Please select a deal"));


//POD COUPON PAYMENT
$dBaseRules["pod_coupon_payments"]["coupon_id"]				=	array(array("emptyCheck",0,0,"Please select a coupon"),array("idCheck",1,0,"Please select a valid coupon"));
$dBaseRules["pod_coupon_payments"]["vendor_id"]				=	array(array("emptyCheck",0,0,"Please select a vendor"),array("idCheck",1,0,"Please select a valid vendor"));
$dBaseRules["pod_coupon_payments"]["amount"]				=	array(array("emptyCheck",0,0,"Please enter a coupon amount"),array("priceCheck",1,0,"Please enter a valid coupon amount"));

//POD COUPON PAYMENT LOG
$dBaseRules["pod_payment_log"]["vendor_id"]					=	array(array("emptyCheck",0,0,"Please select a vendor"),array("idCheck",1,0,"Please select a valid vendor"));
$dBaseRules["pod_payment_log"]["payment_amount"]			=	array(array("emptyCheck",0,0,"Please enter a coupon pay amount"),array("priceCheck",1,0,"Please enter a valid coupon pay amount"));
$dBaseRules["pod_payment_log"]["coupon_id"]					=	array(array("emptyCheck",0,0,"Please select a coupon"),array("idCheck",1,0,"Please select a valid coupon"));
$dBaseRules["pod_payment_log"]["fname"]						=	array(array("emptyCheck",0,0,"Please enter a billing first name"),array("fnameCheck",1,40,"Please enter a valid billing first name"));
$dBaseRules["pod_payment_log"]["lname"]						=	array(array("emptyCheck",0,0,"Please enter a billing last name"),array("lnameCheck",1,40,"Please enter a valid billing last name"));
$dBaseRules["pod_payment_log"]["Bill_add"]					=	array(array("emptyCheck",0,0,"Please enter a billing address"),array("addressCheck",1,0,"Please enter a valid billing address"));
$dBaseRules["pod_payment_log"]["city"]						=	array(array("emptyCheck",0,0,"Please enter a billing city"),array("nameCheck",1,0,"Please enter a valid billing city"));
$dBaseRules["pod_payment_log"]["State_id"]					=	array(array("emptyCheck",0,0,"Please select a billing state"),array("idCheck",1,0,"Please select a valid billing state"));
$dBaseRules["pod_payment_log"]["Country_id"]				=	array(array("emptyCheck",0,0,"Please select a billing country"),array("idCheck",1,0,"Please select a valid billing country"));
$dBaseRules["pod_payment_log"]["zip"]						=	array(array("emptyCheck",0,0,"Please enter a billing zip code"),array("numberCheck",5,10,"Please enter a valid billing zip code"));
$dBaseRules["pod_payment_log"]["coupon_id"]					=	array(array("emptyCheck",0,0,"Please select a coupon"),array("idCheck",1,0,"Please select a valid coupon"));



//***********************  VOD RULES ***************************************/

//ADMIN ACTIONS
$dBaseRules["vod_admin_actions"]["action"]					=	array(array("emptyCheck",'0','0','Please enter an action name'),array("nameCheck",2,15,"Please enter a valid action"),array("uniqueCheck","","","Action name already exist in the database"));

//ADMIN MENUS
$dBaseRules["vod_admin_menus"]["menuname"]					=	array(array("emptyCheck",'0','0','Please enter a valid menu name'),array("fnameCheck",2,25,"Please enter a valid menu name. Only alphabets possible with charcter limit of 2 to 25"),array("uniqueCheck","","","Menu name already exist in the database"));
$dBaseRules["vod_admin_menus"]["menutitle"]					=	array(array("emptyCheck",'0','0','Please enter a menu title'),array("captionCheck",2,70,"Please enter a valid title"),array("uniqueCheck","","","Title already exist in the database"));

//ADMIN PAGES
$dBaseRules["vod_admin_pages"]["menuid"]					=	array(array("emptyCheck",'0','0','Please select a menu'),array("idCheck",1,0,"Please select a menu"));
$dBaseRules["vod_admin_pages"]["page"]						=	array(array("emptyCheck",'0','0','Please enter a page name'));//,array("pageCheck",4,0,"Please enter a valid page name")
$dBaseRules["vod_admin_pages"]["pagetitle"]					=	array(array("emptyCheck",'0','3','Please enter a pagetitle'),array("captionCheck",2,50,"Please enter a valid title"));
$dBaseRules["vod_admin_pages"]["description"]				=	array(array("descriptCheck",2,0,"Please enter valid description"));

//ADMIN PAGE ACTIONS
$dBaseRules["vod_admin_page_actions"]["pageid"]				=	array(array("emptyCheck",'0','0','Please select a page'),array("idCheck",1,0,"Please select a page"));
$dBaseRules["vod_admin_page_actions"]["actionid"]			=	array(array("emptyCheck",'0','0','Please select a page action'),array("idCheck",1,0,"Please select a page action"));

//ADMIN PAGE ACTIONS
$dBaseRules["vod_admin_permission"]["usertypeid"]			=	array(array("emptyCheck",'0','0','Please select a user-type'),array("idCheck",1,0,"Please select a user-type"));
$dBaseRules["vod_admin_permission"]["pactionid"]			=	array(array("emptyCheck",'0','0','Please enter a page permission'),array("idCheck",1,0,"Please select a page action"));

//ADMIN USERS
$dBaseRules["vod_admin_users"]["usertype"]					=	array(array("emptyCheck",'0','0','Please select a user-type'),array("idCheck",1,0,"Please select a user-type"));
$dBaseRules["vod_admin_users"]["password"]					=	array(array("emptyCheck",'0','0','Please enter a password'),array("descriptCheck",6,40,"Please enter a password of length between 6 to 12 characters"));
$dBaseRules["vod_admin_users"]["fname"]						=	array(array("emptyCheck",'0','0','Please enter a first name'),array("fnameCheck",2,40,"Please enter a valid first name of length between 2 to 40 characters"));
$dBaseRules["vod_admin_users"]["lname"]						=	array(array("emptyCheck",'0','30','Please enter a last name'),array("lnameCheck",1,40,"Please enter a valid last name of length between 1 to 40 characters"));
$dBaseRules["vod_admin_users"]["email"]						=	array(array("emptyCheck",'0','3','Please enter an email address'),array("emailCheck",6,0,"Please enter a valid email address"),array("uniqueCheck","","","Email already exists, Please provide another email address"));
$dBaseRules["vod_admin_users"]["mobile"]					=	array(array("numberCheck",10,15,"Please enter a valid mobile number of minimum 10 characters long"));
$dBaseRules["vod_admin_users"]["address"]					=	array(array("addressCheck",2,0,"Please enter a valid address"));

//ADMIN USER TYPES
$dBaseRules["vod_admin_usertype"]["typename"]				=	array(array("emptyCheck",'0','3','Please enter a user-type name'),array("nameCheck",2,40,"Please enter a valid user-type name of length between 2 to 40 characters"),array("uniqueCheck","","","Usertype already exist in the database"));

//CATEGORY
$dBaseRules["vod_category"]["category"]						=	array(array("emptyCheck",0,0,"Please enter category name"),array("nameCheck",2,35,"Please enter a valid category name of length between 2 to 35 characters"),array("uniqueCheck","","","Category already exist in the database"));
$dBaseRules["vod_category"]["image"]						=	array(array("emptyCheck",'0','0','Please upload a category image'),array("imageCheck",4,100,"Please upload a valid category image"));

//CATEGORY SUB
$dBaseRules["vod_category_sub"]["category_id"]				=	array(array("emptyCheck",0,0,"Please select a category"),array("idCheck",1,0,"Please select a valid category"));
$dBaseRules["vod_category_sub"]["subcategory"]				=	array(array("emptyCheck",0,0,"Please enter sub category name"),array("nameCheck",2,35,"Please enter a valid sub category name of length between 2 to 35 characters"));
$dBaseRules["vod_category_sub"]["image"]					=	array(array("emptyCheck",'0','0','Please upload a sub-category image'),array("imageCheck",4,100,"Please upload a valid sub-category image"));

//CMS
$dBaseRules["vod_cms"]["section_id"]						=	array(array("emptyCheck",'0','0','Please select a CMS section'),array("numberCheck",1,0,"Please select a valid CMS section"));
$dBaseRules["vod_cms"]["title"]								=	array(array("emptyCheck",'0','0','Please enter a CMS title'),array("nameCheck",2,0,"Please enter a valid CMS title"));//,array("uniqueCheck","","","Title already exist in the database")
$dBaseRules["vod_cms"]["image"]								=	array(array("imageCheck",4,100,"Please upload a valid image"));

//CMS SECTIONS 
$dBaseRules["vod_cms_section"]["section"]					=	array(array("emptyCheck",'0','0','Please enter a CMS section name'),array("nameCheck",2,35,"Please enter a CMS section name"),array("uniqueCheck","","","CMS section already exist in the database"));
$dBaseRules["vod_cms_section"]["remarks"]					=	array(array("emptyCheck",0,0,""),array("messageCheck",0,0,""));


//CONTACTUS
$dBaseRules["vod_contactus"]["name"]						=	array(array("emptyCheck",'0','0','Please enter a name'),array("nameCheck",2,35,"Please enter a valid name"));
$dBaseRules["vod_contactus"]["email"]						=	array(array("emptyCheck",'0','0','Please enter an email address'),array("emailCheck",5,0,"Please enter a valid email address"));
$dBaseRules["vod_contactus"]["phone"]						=	array(array("numberCheck",10,15,"Please enter a valid phone number of minimum 10 characters long"));
$dBaseRules["vod_contactus"]["subject"]						=	array(array("emptyCheck",'0','0','Please enter asubject'),array("nameCheck",2,100,"Please enter a valid subject"));
$dBaseRules["vod_contactus"]["message"]						=	array(array("emptyCheck",'0','0','Please enter a message'),array("nameCheck",0,0,"Please enter a valid message"));

//COUNTRY
$dBaseRules["vod_country"]["country"]						=	array(array("emptyCheck",'0','0','Please enter a country name'),array("nameCheck",2,60,"Please enter a valid country name"),array("uniqueCheck","","","Country name already exist in the database"));

//STATE
$dBaseRules["vod_country_state"]["country_id"]				=	array(array("emptyCheck",'0','0','Please select a country'),array("idCheck",1,"","Please select a country"));
$dBaseRules["vod_country_state"]["state"]					=	array(array("emptyCheck",'0','0','Please enter a state name'),array("nameCheck",2,45,"Please enter a valid state name"));

//CUSTOMER
$dBaseRules["vod_customer"]["customercode"]					=	array(array("emptyCheck",'0','0','Error occured while creating your customer account'),array("randomcodeCheck",6,12,""),array("uniqueCheck","","","Customer code already exist in the database"));
$dBaseRules["vod_customer"]["fname"]						=	array(array("emptyCheck",'0','0','Please enter your first name'),array("fnameCheck",1,40,"Please enter a valid first name"));
$dBaseRules["vod_customer"]["lname"]						=	array(array("emptyCheck",'0','0','Please enter your last name '),array("lnameCheck",1,40,"Please enter a valid last name "));
$dBaseRules["vod_customer"]["email"]						=	array(array("emptyCheck",'0','0','Please enter your email address'),array("emailCheck",5,0,"Please enter a valid email address"),array("uniqueCheck","","","Email already exists. Please provide another email address"));
$dBaseRules["vod_customer"]["password"]						=	array(array("emptyCheck",'0','0','Please enter a password'),array("passwordCheck",6,30,"Please enter a password of length between 6 to 30 characters"));
$dBaseRules["vod_customer"]["country_id"]					=	array(array("emptyCheck",'0','0','Pleaseselect a country'),array("idCheck",1,0,"Please select a country"));
$dBaseRules["vod_customer"]["state_id"]						=	array(array("emptyCheck",'0','0','Please select a state'),array("idCheck",1,0,"Please select a state"));
$dBaseRules["vod_customer"]["zip"]							=	array(array("emptyCheck",'0','0','Please enter a zip code'),array("numberCheck",5,10,"Please enter a valid zip code of length between 5 to 10 characters"));
$dBaseRules["vod_customer"]["mobile"]						=	array(array("numberCheck",10,15,"Please enter a valid mobile number of minimum 10 characters long"));

//CUSTOMER INTERESTS
$dBaseRules["vod_customer_interest"]["customer_id"]			=	array(array("emptyCheck",'0','0','Please select a customer'),array("idCheck",1,0,"Please select a customer"));
$dBaseRules["vod_customer_interest"]["subcategory_id"]		=	array(array("emptyCheck",'0','0','Please select an interested sub-category'),array("idCheck",1,0,"Please select a valid sub-category"));

//CUSTOMER INVITES
$dBaseRules["vod_customer_invites"]["customer_id"]			=	array(array("emptyCheck",'0','0','Please select a customer'),array("idCheck",1,0,"Please select a valid customer"));
$dBaseRules["vod_customer_invites"]["invite_email"]			=	array(array("emptyCheck",'0','0','Please enter an email address'),array("emailCheck",6,0,"Please enter a valid email address"));


//CUSTOMER SITE CREDITS TRANSACTION
$dBaseRules["vod_customer_sitepoint_trans"]["customer_id"]	=	array(array("emptyCheck",'0','0','Please select a customer'),array("idCheck",1,0,"Please select a valid customer"));

//CUSTOMER SITE POINTS
$dBaseRules["vod_customer_sitepoints"]["customer_id"]		=	array(array("emptyCheck",'0','0','Please select a customer'),array("idCheck",1,0,"Please select a valid customer"));
$dBaseRules["vod_customer_sitepoints"]["action_id"]			=	array(array("emptyCheck",'0','0','Please select a site point action'),array("idCheck",1,0,"Please select a site point action"));
$dBaseRules["vod_customer_sitepoints"]["point"]				=	array(array("emptyCheck",'0','0','Please enter a site point'),array("numberCheck",1,"","Please enter a valid site point"));


//CUSTOMER VOTES
$dBaseRules["vod_customer_votes"]["customer_id"]			=	array(array("emptyCheck",'0','0','Please select a customer'),array("idCheck",1,0,"Please select a valid customer"));
$dBaseRules["vod_customer_votes"]["deal_id"]				=	array(array("emptyCheck",'0','0','Please select a deal'),array("idCheck",1,0,"Please select a deal"));

//DEAL
$dBaseRules["vod_deal"]["vendor_id"]						=	array(array("emptyCheck",0,0,"Please select a vendor"),array("idCheck",1,0,"Please select a valid vendor"));
$dBaseRules["vod_deal"]["subcategory_id"]					=	array(array("emptyCheck",0,0,"Please select a sub-category"),array("idCheck",1,0,"Please select a sub-category"));
$dBaseRules["vod_deal"]["name"]								=	array(array("emptyCheck",0,0,"Please enter a deal name"),array("nameCheck",2,200,"Please enter a valid deal name"));
$dBaseRules["vod_deal"]["caption"]							=	array(array("emptyCheck",0,0,"Please enter a deal caption"),array("captionCheck",2,500,"Please enter a valid deal caption"));
//$dBaseRules["vod_deal"]["description"]					=	array(array("emptyCheck",0,0,""),array("descriptCheck",10,0,""));
$dBaseRules["vod_deal"]["deal_price"]						=	array(array("emptyCheck",0,0,"Please enter a deal price"),array("priceCheck",1,15,"Please enter a valid deal price"));
$dBaseRules["vod_deal"]["cost"]								=	array(array("emptyCheck",0,0,"Please enter a deal cost"),array("priceCheck",1,15,"Please enter a valid deal cost"));
$dBaseRules["vod_deal"]["unlockvote"]						=	array(array("emptyCheck",0,0,"Please enter a number of votes to unlock"),array("numberCheck",1,15,"Please enter a valid unlock vote number"));
$dBaseRules["vod_deal"]["activation_date"]					=	array(array("emptyCheck",0,0,"Please enter an activation date"),array("dateCheck","","","Please enter a valid activation date"));
$dBaseRules["vod_deal"]["total_quanity"]					=	array(array("emptyCheck",0,0,"Please enter a total quantity"),array("numberCheck",1,15,"Please enter a valid total quantity"));
$dBaseRules["vod_deal"]["cust_maxbuy"]						=	array(array("emptyCheck",0,0,"Please enter customer maximum buy limit"),array("numberCheck",1,15,"Please enter a valid customer maximum buy limit"));
$dBaseRules["vod_deal"]["cust_maxbuy_gift"]					=	array(array("emptyCheck",0,0,"Please enter customer maximum gift purchase limit"),array("numberCheck",1,15,"Please enter a valid customer maximum gift purchase limit"));
$dBaseRules["vod_deal"]["deal_days"]						=	array(array("emptyCheck",0,0,"Please enter number of deal days"),array("numberCheck",1,15,"Please enter a valid number of deal days"));
//$dBaseRules["vod_deal"]["rules"]							=	array(array("descriptCheck",1,0,"Please enter valid rules"));
//$dBaseRules["vod_deal"]["highlights"]						=	array(array("descriptCheck",1,0,"Please enter valid highlights"));
$dBaseRules["vod_deal"]["get_directions"]					=	array(array("urlCheck",0,0,"Please enter a valid link"));
$dBaseRules["vod_deal"]["image"]							=	array(array("emptyCheck",0,0,"Please upload a deal image"),array("imageCheck",4,0,"Please upload a valid deal image"));
$dBaseRules["vod_deal"]["thumb_image"]						=	array(array("emptyCheck",0,0,"Please upload a deal thumb image"),array("imageCheck",4,0,"Please upload a valid deal thumb image"));
$dBaseRules["vod_deal"]["cooldown_days"]					=	array(array("numberCheck",1,15,"Please enter a valid number of cool down days"));
$dBaseRules["vod_deal"]["coupon_active_hour"]				=	array(array("emptyCheck",0,0,"Please enter number of coupon activation hours"),array("numberCheck",1,15,"Please enter a valid number of coupon activation hours"));
$dBaseRules["vod_deal"]["coupon_expiry_days"]				=	array(array("emptyCheck",0,0,"Please enter number of coupon expiry days"),array("numberCheck",1,15,"Please enter a valid number of coupon expiry days"));

//DEAL ORDER
$dBaseRules["vod_deal_order"]["deal_id"]					=	array(array("emptyCheck",0,0,"Please select a deal"),array("idCheck",1,0,"Please select a deal"));
$dBaseRules["vod_deal_order"]["customer_id"]				=	array(array("emptyCheck",0,0,"Please select a customer"),array("idCheck",1,0,"Please select a customer"));
$dBaseRules["vod_deal_order"]["quantity"]					=	array(array("emptyCheck",0,0,"Please enter a quantity"),array("quantityCheck",1,"","Please enter a valid quantity"));
$dBaseRules["vod_deal_order"]["unit_price"]					=	array(array("emptyCheck",0,0,"Please enter a deal price"),array("priceCheck",1,0,"Please enter a valid unit price"));
$dBaseRules["vod_deal_order"]["total_amount"]				=	array(array("emptyCheck",0,0,"Please enter a total amount"),array("priceCheck",1,0,"Please enter a valid total amount"));
$dBaseRules["vod_deal_order"]["coupon_code"]				=	array(array("emptyCheck",'0','0','Error occured while purchasing this deal'),array("randomcodeCheck",6,12,"Error occured while creating coupon for this purchase"),array("uniqueCheck","","","Error occured while creating coupon for this purchase. Please try after some time"));



//DEAL PAYMENTS
$dBaseRules["vod_deal_payments"]["deal_id"]					=	array(array("emptyCheck",0,0,"Please select a deal"),array("idCheck",1,0,"Please select a deal"));
$dBaseRules["vod_deal_payments"]["sold_quantity"]			=	array(array("emptyCheck",0,0,"Please enter a deal quantity"),array("quantityCheck",1,0,"Please enter a valid sold quantity"));

//DEAL PAYMENTS TRANSACTION
$dBaseRules["vod_deal_payments_trans"]["deal_payment_id"]	=	array(array("emptyCheck",'0','0','Please select a deal payment'),array("idCheck",1,0,"Please enter a deal payment id"));
$dBaseRules["vod_deal_payments_trans"]["payment_date"]		=	array(array("emptyCheck",'0','0','Please select a payment date'),array("dateCheck",1,0,"Please enter a valid payment date"));
$dBaseRules["vod_deal_payments_trans"]["amount"]			=	array(array("emptyCheck",'0','0','Please enter an amount'),array("priceCheck",1,15,"Please enter a valid amount"));

//DEAL SEND TO FRIEND
//$dBaseRules["vod_deal_sendfriend"]["dealcoupon_id"]			=	array(array("emptyCheck",0,0,"Please select a deal coupon"),array("idCheck",1,0,"Please select a  coupon"));
$dBaseRules["vod_deal_sendfriend"]["sent_from"]				=	array(array("emptyCheck",0,0,"Please select a customer"),array("idCheck",1,0,"Please select a valid customer"));
$dBaseRules["vod_deal_sendfriend"]["sent_toemail"]			=	array(array("emptyCheck",0,0,"Please enter an email address"),array("emailCheck",6,0,"Please enter a valid  email "));

//DEFAULT
$dBaseRules["vod_defaults"]["caption"]						=	array(array("emptyCheck",'','','Please enter caption'),array("captionCheck",2,0,"Please enter a valid caption"));
$dBaseRules["vod_defaults"]["group_id"]						=	array(array("emptyCheck",'','','Please select a group'),array("idCheck",1,0,"Please select a default group"));
$dBaseRules["vod_defaults"]["name"]							=	array(array("emptyCheck",'','','Please enter a name'),array("nameCheck",1,0,"Please enter a valid name"),array("uniqueCheck","","","Name already exist in the database"));
$dBaseRules["vod_defaults"]["value"]						=	array(array("emptyCheck",'0','','Please enter a value'));

//DEFAULT GROUP
$dBaseRules["vod_defaults_group"]["group"]					=	array(array("emptyCheck",0,0,"Please enter a group name"),array("nameCheck",2,60,"Please enter a Group name"));

//ECOMM CART
$dBaseRules["vod_ecomm_cart"]["customer_id"]				=	array(array("emptyCheck",0,0,"Please select a customer"),array("idCheck",1,0,"Please select a valid customer"));
$dBaseRules["vod_ecomm_cart"]["quantity"]					=	array(array("emptyCheck",0,0,"Please enter a quantity"),array("quantityCheck",1,0,"Please enter a valid quantity"));
$dBaseRules["vod_ecomm_cart"]["prod_amount"]				=	array(array("emptyCheck",0,0,"Please enter product points"),array("priceCheck",1,15,"Please enter valid product points"));
$dBaseRules["vod_ecomm_cart"]["ship_fname"]					=	array(array("emptyCheck",0,0,"Please enter a shipping first name"),array("fnameCheck",1,40,"Please enter a valid shipping first name"));
$dBaseRules["vod_ecomm_cart"]["ship_lname"]					=	array(array("emptyCheck",0,0,"Please enter a shipping last name"),array("lnameCheck",1,40,"Please enter a valid shipping last name"));
$dBaseRules["vod_ecomm_cart"]["ship_addr1"]					=	array(array("emptyCheck",0,0,"Please enter a shipping address"),array("addressCheck",1,0,"Please enter a valid shipping address"));
$dBaseRules["vod_ecomm_cart"]["ship_addr2"]					=	array(array("addressCheck",1,0,"Please enter a valid shipping address"));
$dBaseRules["vod_ecomm_cart"]["ship_phone"]					=	array(array("emptyCheck",0,0,"Please enter a shipping phone number"),array("numberCheck",10,15,"Please enter a valid mobile number of minimum 10 characters long"));
$dBaseRules["vod_ecomm_cart"]["ship_state"]					=	array(array("emptyCheck",0,0,"Please select a shipping state"),array("idCheck",1,0,"Please select a shipping state"));
$dBaseRules["vod_ecomm_cart"]["ship_country"]				=	array(array("emptyCheck",0,0,"Please select a shipping country"),array("idCheck",1,0,"Please select a country"));
$dBaseRules["vod_ecomm_cart"]["ship_zip"]					=	array(array("emptyCheck",0,0,"Please enter a shipping zip code"),array("numberCheck",5,10,"Please enter a valid shipping zip code"));

//ECOMM CART DETAILS
$dBaseRules["vod_ecomm_cartdetail"]["cart_id"]				=	array(array("emptyCheck",0,0,"Please select your cart"),array("idCheck",1,0,""));
$dBaseRules["vod_ecomm_cartdetail"]["ecomm_prodid"]			=	array(array("emptyCheck",0,0,"Please select a product"),array("idCheck",1,0,"Please select an ecommerce product"));
$dBaseRules["vod_ecomm_cartdetail"]["quantity"]				=	array(array("emptyCheck",0,0,"Please enter a quantity"),array("quantityCheck",1,0,"Please enter valid quantity"));
$dBaseRules["vod_ecomm_cartdetail"]["unit_price"]			=	array(array("emptyCheck",0,0,"Please enter points"),array("priceCheck",1,15,"Please enter valid points"));	
$dBaseRules["vod_ecomm_cartdetail"]["prod_price"]			=	array(array("emptyCheck",0,0,"Please enter total points"),array("priceCheck",1,15,"Please enter valid total points"));

//ECOMM ORDER
$dBaseRules["vod_ecomm_order"]["customer_id"]				=	array(array("emptyCheck",0,0,"Please select a customer"),array("idCheck",1,0,"Please select a valid customer"));
$dBaseRules["vod_ecomm_order"]["ship_fname"]				=	array(array("emptyCheck",0,0,"Please enter a shipping first name"),array("fnameCheck",1,40,"Please enter a valid shipping first name"));
$dBaseRules["vod_ecomm_order"]["ship_lname"]				=	array(array("emptyCheck",0,0,"Please enter a shipping last name"),array("lnameCheck",1,40,"Please enter a valid shipping last name"));
$dBaseRules["vod_ecomm_order"]["ship_addr1"]				=	array(array("emptyCheck",0,0,"Please enter a shipping address"),array("addressCheck",1,0,"Please enter a valid shipping address"));
$dBaseRules["vod_ecomm_order"]["ship_addr2"]				=	array(array("addressCheck",1,0,"Please enter a valid shipping address"));
$dBaseRules["vod_ecomm_order"]["ship_phone"]				=	array(array("emptyCheck",0,0,"Please enter a shipping phone number"),array("numberCheck",10,15,"Please enter a valid shipping phone number of minimum 10 characters long"));
$dBaseRules["vod_ecomm_order"]["ship_state"]				=	array(array("emptyCheck",0,0,"Please select a shipping state"),array("idCheck",1,0,"Please select a valid shipping state"));
$dBaseRules["vod_ecomm_order"]["ship_country"]				=	array(array("emptyCheck",0,0,"Please select a shipping country"),array("idCheck",1,0,"Please select a valid shipping country"));
$dBaseRules["vod_ecomm_order"]["ship_zip"]					=	array(array("emptyCheck",0,0,"Please enter a shipping zip code"),array("numberCheck",5,10,"Please enter a valid shipping zip code"));
$dBaseRules["vod_ecomm_order"]["quantity"]					=	array(array("emptyCheck",0,0,"Please select atleast one product"),array("quantityCheck",1,0,"Please select atleast one product"));
$dBaseRules["vod_ecomm_order"]["paid_point"]				=	array(array("emptyCheck",0,0,"Please select atleast one product with more than one points"),array("priceCheck",1,15,"Please enter valid total points"));

//ECOMM ORDER DETAILS
$dBaseRules["vod_ecomm_orderdetail"]["order_id"]			=	array(array("emptyCheck",0,0,"Please select an order"),array("idCheck",1,0,"Order not placed correctly"));
$dBaseRules["vod_ecomm_orderdetail"]["ecomm_prodid"]		=	array(array("emptyCheck",0,0,"Please select a product"),array("idCheck",1,0,"Please select an ecommerce product"));
$dBaseRules["vod_ecomm_orderdetail"]["quanity"]				=	array(array("emptyCheck",0,0,"Please enter a quantity"),array("quantityCheck",1,0,"Please enter valid product quantity"));
$dBaseRules["vod_ecomm_orderdetail"]["unit_price"]			=	array(array("emptyCheck",0,0,"Please enter unit price in points"),array("priceCheck",1,15,"Please enter valid unit price in points"));	
$dBaseRules["vod_ecomm_orderdetail"]["prod_price"]			=	array(array("emptyCheck",0,0,"Please enter total points"),array("priceCheck",1,15,"Please enter valid total price in points"));

//ECOMM PRODUCT CATEGORY
$dBaseRules["vod_ecomm_prodcategory"]["category"]			=	array(array("emptyCheck",0,0,"Please enter a category name"),array("nameCheck",2,40,"Please enter a valid category name"));

//ECOMM PRODUCT 
$dBaseRules["vod_ecomm_product"]["category_id"]				=	array(array("emptyCheck",'0','0','Please select a category'),array("idCheck",1,0,"Please select a valid category"));
$dBaseRules["vod_ecomm_product"]["product"]					=	array(array("emptyCheck",'0','0','Please enter a product name'),array("captionCheck",2,90,"Please enter a valid product name"));
$dBaseRules["vod_ecomm_product"]["image"]					=	array(array("emptyCheck",0,0,"Please upload a category image"),array("imageCheck",4,60,"Please upload a valid image"));
$dBaseRules["vod_ecomm_product"]["price_points"]			=	array(array("emptyCheck",'0','3','Please enter a price in points'),array("priceCheck",1,15,"Please enter valid price"));	
$dBaseRules["vod_ecomm_product"]["total_quantity"]			=	array(array("emptyCheck",'0','3','Please enter a quantity'),array("quantityCheck",1,15,"Please enter  total quantity"));

//FAQ
$dBaseRules["vod_faq"]["group_id"]							=	array(array("emptyCheck",'','','Please select a group'),array("idCheck",1,0,"Please select a FAQ group"));
$dBaseRules["vod_faq"]["question"]							=	array(array("emptyCheck",'0','',"Please enter a question"));
$dBaseRules["vod_faq"]["answer"]							=	array(array("emptyCheck",'0','',"Please enter an answer"));

$dBaseRules["vod_faq_group"]["group"]						=	array(array("emptyCheck",0,0,"Please enter a group name"),array("nameCheck",2,60,"Please enter a Group name"));

//INDUSTRY
$dBaseRules["vod_industry"]["industry"]						=	array(array("emptyCheck",0,0,"Please enter an industry name "),array("nameCheck",2,40,"Please enter a valid industry name of length between 2 to 40 characters"));

//PRODUCT
$dBaseRules["vod_product"]["product"]						=	array(array("emptyCheck",0,0,"Please enter a product name"),array("nameCheck",2,40,"Please enter a valid product name of length between 2 to 40 characters"));

//SITE POINT ACTION
$dBaseRules["vod_sitepoint_action"]["action"]				=	array(array("emptyCheck",'0','3','Please enter a site point action'),array("nameCheck",2,40,"Please enter a valid site point action of length between 2 to 40 characters"));
$dBaseRules["vod_sitepoint_action"]["remarks"]				=	array(array("descriptCheck",2,200,"Please enter a valid remark"));

//VENDOR
$dBaseRules["vod_vendor"]["vendorcode"]						=	array(array("emptyCheck",'0','0','Error occured while creating your vendor account'),array("randomcodeCheck",6,12,"Vendor code did not create"),array("uniqueCheck","","","Vendor code already exist in the database"));
$dBaseRules["vod_vendor"]["business_name"]					=	array(array("emptyCheck",'0','3','Please enter a bussiness name'),array("captionCheck",1,50,"Please enter a valid business name of length between 1 to 50 characters"));
$dBaseRules["vod_vendor"]["contact_person"]					=	array(array("emptyCheck",'0','3','Please enter a contact person'),array("nameCheck",1,50,"Please enter a valid contact person's name"));
$dBaseRules["vod_vendor"]["email"]							=	array(array("emptyCheck",0,0,"Please enter an email address"),array("emailCheck",5,0,"Please enter a valid email address"),array("uniqueCheck","","","Email already exist in the database"));
$dBaseRules["vod_vendor"]["password"]						=	array(array("emptyCheck",'0','3','Please enter a password'),array("passwordCheck",6,12,"Please enter a password of length between 6 to 12 characters"));
$dBaseRules["vod_vendor"]["address"]						=	array(array("emptyCheck",'0','5','Please enter an address'),array("addressCheck",2,0,"Please enter a valid address"));
$dBaseRules["vod_vendor"]["city"]							=	array(array("emptyCheck",'0','3','Please enter a city name'),array("nameCheck",1,100,"Please enter a valid city name"));
$dBaseRules["vod_vendor"]["country_id"]						=	array(array("emptyCheck",'0','3','Please select a country'),array("idCheck",1,0,"Please select a valid country"));
$dBaseRules["vod_vendor"]["state_id"]						=	array(array("emptyCheck",'0','0','Please select a state'),array("idCheck",1,0,"Please select a state"));
$dBaseRules["vod_vendor"]["zip"]							=	array(array("emptyCheck",'0','0','Please enter a zip code'),array("numberCheck",5,10,"Please enter a valid zip code of length between 5 to 10 characters"));
$dBaseRules["vod_vendor"]["latitude"]						=	array(array("negativeFloatCheck",1,25,"Please enter a valid latitude"));
$dBaseRules["vod_vendor"]["longitude"]						=	array(array("negativeFloatCheck",1,25,"Please enter a valid longitude"));
$dBaseRules["vod_vendor"]["website"]						=	array(array("urlCheck",0,0,"Please enter a valid website address"));
$dBaseRules["vod_vendor"]["mobile"]							=	array(array("numberCheck",10,15,"Please enter a valid mobile number of minimum 10 characters long"));
$dBaseRules["vod_vendor"]["phone"]							=	array(array("emptyCheck",'0','0','Please enter your phone number'),array("numberCheck",10,10,"Please enter a valid phone number of 10 characters long"));

//VENDOR INDUSTRY
$dBaseRules["vod_vendor_industry"]["vendor_id"]				=	array(array("emptyCheck",0,0,"Please select a vendor"),array("idCheck",1,0,"Please select a valid vendor"));
$dBaseRules["vod_vendor_industry"]["industry_id"]			=	array(array("emptyCheck",0,0,"Please select an industry"),array("idCheck",1,0,"Please select a valid industry"));

//VENDOR PRODUCT
$dBaseRules["vod_vendor_product"]["vendor_id"]				=	array(array("emptyCheck",0,0,"Please select a vendor"),array("idCheck",1,0,"Please select a valid vendor"));
$dBaseRules["vod_vendor_product"]["product_id"]				=	array(array("emptyCheck",0,0,"Please select a product"),array("idCheck",1,0,"Please select a valid product"));


?>
