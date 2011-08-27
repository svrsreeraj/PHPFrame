<?php
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-04
Purpose    :Testing purpose
**************************************************************************************/
require_once 'init.php';err_status("init.php included");


$obj					=	new phpValidation();
$res					=	$obj->dateCheck('2011-03-05');

print_r($res);
exit;

$dataArr				= 	array();
$dataArr["agree"]		= 	"1";
$dataArr["password"]	= 	"123456";
$dataArr["repassword"]	= 	"123456";

$res		=	$obj->customerSignUpApi($dataArr);
//$res		=	$obj->createDeal($dataArr);
echo $res;
/*header_view();err_status("header included");


//echo $availQty	=	$obj->getAvailableDealQuantity($userSess["id"],$data["deal"],1);
$creditArr				=	$dealObj->dealSitePointConvertionToSiteCreditArray($userSess["balance_points"],$deal_id);
								
	$obj		=	new dealsOrder();
    
	echo $availQty	=	$obj->getAvailableDealQuantity(1001,17,1);
	
	
	$data[deal_id] = 17;  
    $data[quantity] = 1;   
    $data[first_name] = 'testnew';
    $data[last_name] = 'testnew';
    $data[card_type] = 'MasterCard';
    $data[credit_card] = '5465410000031771';
    $data[expiry_month] = '8';
    $data[expiry_year] = '2013';
    $data[ccv] = '945';
    $data[billing_address] = 'Billing Address1new'; 
    $data[billing_city] = 'City1new';
    $data[billing_country] = 2;
    $data[billing_zip] = '365758';
    $data[billing_state] = '12';
    $data[privacy] = '1';    
    $data[paid_sitecredit] = '0.00';
    $data[customer_id] = '1003';
	
    //$data[gift_order] = '1';
	    //$data[paid_cardamount] = '60';
   // $data[paid_point] = '0';
   // $data[pay_option] = '1';
    //$data[total_amount] = '65';
	
	$data["paid_cardamount"]	=	$obj->getCardAmount($data["paid_sitecredit"],$data["customer_id"],$data["quantity"],$data["deal_id"]);

	$giftArr[send_from_name] = 'gift from1';
	$giftArr[to_name] = 'gift to1';
	$giftArr[sent_toemail] = 'gift@email1.c0m';
	$giftArr[message] = 'this is a giftit\'s';
	$giftArr[apps_id] = 2;
	$giftArr[sent_from] = '1003';
	$giftArr[sent_date] = 'escape now() escape';
        


$check		=	$obj->canBuyDealAfterSubmit($data["customer_id"],$data["deal_id"],$data["quantity"],$data["paid_sitecredit"],$giftArr="");
//if($check)
//$test	=	$obj->getDealOrderAPIArray($data,$giftArr1="");

exit;












/*



	public function dealOrderAPI($deal_array)
			{
				$deal_order							=	array();				
				$result								=	end($this->getdbcontents_cond('vod_deal ','id='.$deal_array['deal_id']));
				
				//for inserting data into deal_order table
				$this->dbStartTrans();
				$deal_order['apps_id']				=	$this->getApplication();
				$deal_order["deal_id"]				=	$deal_array['deal_id'];
				$deal_order["customer_id"]			=	$deal_array['customer_id'];
				$deal_order["last_owner"]			=	$deal_array['last_owner'];
				$deal_order["current_owner"]		=	$deal_array['current_owner'];
				$deal_order['pay_option']			=	$deal_array["pay_option"];
				$deal_order['quantity']				=	$deal_array["quantity"];
				$deal_order['balance_coupons']		=	$deal_array["quantity"];
				$deal_order['unit_price']			=	$result['deal_price'];					
				$deal_order['total_amount']			=	$deal_array['total_amount'];	
				$deal_order['paid_point']			=	$deal_array['paid_point'];				
				$deal_order['paid_sitecredit']		=	$deal_array["paid_sitecredit"];
				$deal_order['paid_cardamount']		=	$deal_array["paid_cardamount"];
				$deal_order['payment_type']			=	GLB_DEAL_PAY_PAYPAL;
				$deal_order['paid_status']			=	GLB_DEAL_PAID;
				$deal_order['paid_date']			=	"escape now() escape";
				$deal_order['orderDate']			=	"escape now() escape";
				$deal_order['paymentData']			=	$deal_array["paymentData"];
				$deal_order['privacy']				=	$deal_array["privacy"];
				do	
					{
						$couponcode					=	$this->createRandom(GLB_QRCODE_LIMIT);	
					}			
				while($this->getdbcount_sql("select coupon_code from vod_deal_order where `coupon_code`='$couponcode'") >0);
				
				$deal_order['coupon_code']			=	$couponcode;
				
				if($deal_array["gift_order"] || $deal_array["last_id"])	
					$deal_order['gift_order']		=	GLB_DEAL_TYPE_GIFT;				
				$deal_order['billing_fname']		=	$deal_array['first_name'];
				$deal_order['billing_lname']		=	$deal_array['last_name'];	
				$deal_order['billing_address']		=	$deal_array['billing_address'];
				$deal_order['billing_city']			=	$deal_array['billing_city'];
				$deal_order['billing_country']		=	$deal_array['billing_country'];
				$deal_order['billing_state']		=	$deal_array['billing_state'];
				$deal_order['billing_zip']			=	$deal_array['billing_zip'];	
				$deal_order['ip']					=	$_SERVER['REMOTE_ADDR'];
				
				
				$deal_order_id						=	$this->db_insert('vod_deal_order',$deal_order); //Deal Order table
				
				if($deal_order_id)
					{
						$dealPayments		=	$this->insertDealPayments($deal_array,$deal_order_id); //Deal Payments & Commission Tables
						if($dealPayments)
							{
								$dealUpdate	=	$this->updateDealQuantity($deal_array); //Deal table
								if($dealUpdate)
									{
										if($deal_array["gift_order"] || $deal_array["last_id"])	
											$giftSend				=	$this->insertDealSendFriend($deal_array['last_id'],$deal_order_id); // Deal send friend table
										if($deal_array['paid_cardamount']!='0.00')
											$customerCreditCard		=	$this->insertCustomerCreditCard($deal_array); //Customer credit card table
										if($deal_array['paid_sitecredit'] && $deal_order['paid_point']) 
											$customerSiteCredit		=	$this->insertCustomerSiteCredit($deal_array,$deal_order_id); // Customer sitepoint transaction table & customer table
										if($deal_array["paid_cardamount"] > 0)
										$cusPointUpdate				=	$this->customerPointUpdate($deal_array); //Customer site point
										
										//EMAIL CONFIRMATIONS Starts
										
										$validCoupon					=	end($this->getdbcontents_cond('vod_deal_order ','id='.$deal_order_id));
										
										$cmsObj							=	new cms();	
										$to								=	$this->getdbsinglevalue_cond("vod_customer","email"," id=".$validCoupon['customer_id']);
										$from							=	GLB_SITE_EMAIL;
										$subject						=	"Voteondeals.com - Your Deal Order Details";
										$ordArr							=	array();
										$caption						=	$this->getdbsinglevalue_cond("vod_deal","caption"," id=".$validCoupon['deal_id']);
										$ordArr["{TPL_NAME}"]			=	$this->getdbsinglevalue_cond("vod_customer","concat(fname,\" \",lname)"," id=".$validCoupon['customer_id']);
										$ordArr["{TPL_ORDERID}"]		=	$deal_order_id;
										$ordArr["{TPL_DEAL}"]			=	$caption;
										$ordArr["{TPL_DEAL_LINK}"]		=	ROOT_URL."deals/".$this->getHtaccessFilter($caption)."-".$validCoupon['deal_id']."/";
										$ordArr["{TPL_QTY}"]			=	$validCoupon['quantity'];
										$ordArr["{TPL_AMOUNT}"]			=	$validCoupon['total_amount'];
										if($validCoupon['pay_option']	==	  GLB_DEAL_PAY_SCREDIT)  	$payopt	=	"Using Site Points";
										else if($validCoupon['pay_option']	==	GLB_DEAL_PAY_GATEWAY)   $payopt	=	"Using Paypal Pro";
										else if($validCoupon['pay_option']	==	GLB_DEAL_PAY_BOTH)  	$payopt	=	"Using both Site Points & Paypal Pro";										
										$ordArr["{TPL_PAYOPTION}"]		=	$payopt;
										$ordArr["{TPL_ORDERDATE}"]		=	$this->displayTime($validCoupon['orderDate']);
										
										$send							=	$cmsObj->sendMailCMS("46",$to,$from,$subject,$ordArr,5); 
										
										if($validCoupon["gift_order"]	==	1)
											{
												$validGift						=	end($this->getdbcontents_cond('vod_deal_sendfriend ','id='.$giftSend));
												$to1							=	$validGift["sent_toemail"];
												$from1							=	$this->getdbsinglevalue_cond("vod_customer","email"," id=".$validGift['sent_from']);
												$subject						=	"Voteondeals.com - Gift Coupon";
												$giftArr						=	array();
												$giftArr["{TPL_DEAL}"]			=	$caption;
												$giftArr["{TPL_DEAL_LINK}"]		=	ROOT_URL."deals/".$this->getHtaccessFilter($caption)."-".$validCoupon['deal_id']."/";
												$giftArr["{TPL_TO_NAME}"]		=	stripslashes($validGift["to_name"]);
												$giftArr["{TPL_FROM_NAME}"]		=	stripslashes($validGift["send_from_name"]);
												$giftArr["{TPL_QTY}"]			=	$validCoupon['quantity'];
												$giftArr["{TPL_PRICE}"]			=	$validCoupon['unit_price'];
												$giftArr["{TPL_TOTAL}"]			=	$validCoupon['total_amount'];
												$giftArr["{TPL_MESSAGE}"]		=	nl2br(stripslashes($validGift['message']));
												if($validGift["sent_to"])	$send1	=	$cmsObj->sendMailCMS("48",$to1,$from1,$subject,$giftArr,5); 
												else
													{
														$giftArr["{TPL_INVITATION_LINK}"]	=	ROOT_URL.'signup/?vod_invited_user='.$this->getdbsinglevalue_cond("vod_customer","customercode"," id=".$validGift['sent_from']);
														$send1								=	$cmsObj->sendMailCMS("36",$to1,$from1,$subject,$giftArr,5); 
													}
											}
										//Ends										
										return $deal_order_id;
									}
								else
									{
										$this->dbRollBack();
										$this->setPageError($this->getDbErrors());
										return false;			
									}
							}
						else
							{
								$this->dbRollBack();
								$this->setPageError($this->getDbErrors());
								return false;			
							}
					}
				else
					{
						$this->dbRollBack();
						$this->setPageError($this->getDbErrors());
						return false;			
					}
			}	
		
		
		
		
		
		
				*/






/*

$sql		=	"SELECT  *	FROM  vod_ip_to_country_all";
//$spage		=	$cls_site->create_paging("n_page",$sql,15);
//$data		=	$cls_site->getdbcontents_sql($spage->finalSql());
//$cls_site->print_r($data);

/*
echo $s		=	getCSV($data);


*/

//echo $ts= statusChange("vod_admin_actions",6,0,$field="status");

/*function statusChange($table,$id,$status,$field="status")
	{
		global  $cls_db;
		$status	 =	!$status;
		$sql	 =	"update $table set `$field` = '$status' where id='$id'";
		return  $cls_db->db_query($sql);
	}
*/








/*

$headArr	=	array('COUNTRY CODE','COUNTRY');
$fieldArr	=	array('country_code','country_name');

$s			=	getCsvFile($sql,$headArr,$fieldArr,"test");

function getCsvFile($sql,$headArr,$fieldArr,$filename="ResultRecords")
	{	
		global  $cls_db;
		ob_clean();
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment;Filename=".$filename.".csv");
		echo getQuotedArray($headArr);
		
		$result			=	$cls_db->db_query($sql);
		$finalArray		=	array();
		while($dataObject = mysql_fetch_array($result)) 
			{	
				foreach($fieldArr as $key=>$val)
					{							
						 $resArr[$key] 	= 	$dataObject[$val];
					}
				echo getQuotedArray($resArr);
				unset($resArr);
			}
		exit;
		
	}
function getQuotedArray($arr)
	{
		if(!function_exists('appendQuotes'))
			{
				function appendQuotes(&$item)
					{
						$item	=	'"'.$item.'"';
					}		
			}
		array_walk($arr,"appendQuotes");			
		return implode(",",$arr)."\n";		
	}*/

/*function getQuotedArray($arr)
	{
		array_walk($arr, 'addQuote');
		function addQuote(&$item)
			{
				$item	=	'"'.$item.'"';
			}
		return implode(",",$arr)."\n";
		
		
		function test_alter(&$item)
			{
				$item = '"'.$item.'"';
			}
		
		function test_print($item)
			{
				echo "$item";
			}
		
			function test_alter(&$item)
			{
				$item = '"'.$item.'"';
			}
		
		function test_print($item)
			{
				echo "$item";
			}
		
		
	}*/


/*
function getCsvFile1($sql,$headArr,$fieldArr)
	{	
		global  $cls_db;
		$filename 	= tempnam(sys_get_temp_dir(), "csv");
		$file 		= fopen($filename,"w");	
		fputcsv($file,$headArr);
		$result		=	$cls_db->db_query($sql);
		while($dataObject	= 	mysql_fetch_array($result)) 
			{	
				foreach($fieldArr as $key=>$val)
					{							
						 $resArr[$key] 	= 	$dataObject[$val];
					}
			}
			
		print_r($resArr); exit;
			
		foreach ($resArr as $key=>$val) 
			{				
				fputcsv($file,$val);
			}
		fclose($file);
		$filename = "Users_List_".date("d-m-Y");
		header("Content-Type: application/csv");
		header("Content-Disposition: attachment;Filename=".$filename.".csv");
		ob_clean();
		readfile($filename);
		unlink($filename);
		exit;
		
	}





function getCsvFile2($table,$sql)
	{
		$filename 	= tempnam(sys_get_temp_dir(), "csv");
		$file 		= fopen($filename,"w");
		$result = mysql_query("show columns from $table");
		for ($i = 0; $i < mysql_num_rows($result); $i++) 
			{
				$colArray[$i] 	= mysql_fetch_assoc($result);
				$fieldArray[$i] = $colArray[$i]['Field'];
			}
		fputcsv($file,$fieldArray);
		$result = mysql_query($sql);
		for ($i = 0; $i < mysql_num_rows($result); $i++)
			{
				$dataArray[$i] = mysql_fetch_assoc($result);
			}
		foreach ($dataArray as $line) 
			{
				fputcsv($file,$line);
			}
		fclose($file);
		$filename = "Users_List_".date("d-m-Y H:i:s");
		header("Content-Type: application/csv");
		header("Content-Disposition: attachment;Filename=".$filename.".csv");
		ob_clean();
		readfile($filename);
		unlink($filename);
		exit;
	}

*/
/*
$filename 	= tempnam(sys_get_temp_dir(), "csv");
$file 		= fopen($filename,"w");

// Write column names
$result = mysql_query("show columns from vod_admin_users");
for ($i = 0; $i < mysql_num_rows($result); $i++) 
	{
		$colArray[$i] 	= mysql_fetch_assoc($result);
		$fieldArray[$i] = $colArray[$i]['Field'];
	}
fputcsv($file,$fieldArray);

// Write data rows
$result = mysql_query("select * from vod_admin_users");
for ($i = 0; $i < mysql_num_rows($result); $i++)
	{
		$dataArray[$i] = mysql_fetch_assoc($result);
	}
foreach ($dataArray as $line) 
	{
		fputcsv($file,$line);
	}
fclose($file);
$filename = "Users_List_".date("d-m-Y H:i:s");
header("Content-Type: application/csv");
header("Content-Disposition: attachment;Filename=UsersList.csv");
ob_clean();
readfile($filename);
unlink($filename);
exit;








*/





/*

function sortingRecords1($table,$id,$nPVal,$preference="preference")
	{
		global $cls_db;
		$curRow		=	$cls_db->getdbcontents_id($table,$id);
		$pVal		=	$curRow[0][$preference];
		
		if($nPVal	>	$pVal)
			{
				
				$sql	=	"update $table set `$preference`=`$preference`-1 where $preference > $pVal and $preference<=$nPVal";
				mysql_query($sql);
				$sql	=	"update $table set `$preference`='$nPVal' where $preference=$pVal and id='$id'";
				mysql_query($sql);
			}
		else	
			{
				$sql	=	"update $table set `$preference`=`$preference`+1 where $preference < $pVal and $preference>=$nPVal";
				mysql_query($sql);
				
				$sql	=	"update $table set `$preference`='$nPVal' where $preference=$pVal and id='$id'";
				mysql_query($sql);
			}
			
			
	}

function sortingRecords2($table,$id,$nPVal,$preference="preference")
	{
		global $cls_db;
		$curRow		=	$cls_db->getdbcontents_id($table,$id);
		$pVal		=	$curRow[0][$preference];
		if($nPVal	>	$pVal)
			{
				$nextp	=	$cls_db->getdbcontents_cond($table,"$preference>$pVal and $preference<=$nPVal order by $preference desc limit 1",true);
			}
		else	
			{
				$nextp	=	$cls_db->getdbcontents_cond($table,"$preference<$pVal and $preference>=$nPVal order by $preference asc limit 1",true);
			}
		echo "<br>";	
		print_r($nextp);
		$nextid						=	$nextp[0]["id"];	
		//$nextp						=	$nextp[0][$preference]; //equal to nPVal
		$pref1						=	$nPVal;
		$pref2						=	$pVal;
		
		
		$sql1						=	"update $table set `$preference`='$pref1' where id='$id'";
		$sql2						=	"update $table set `$preference`='$pref2' where id='$nextid' ";
		echo "<br>";
		$update1					=	$cls_db->db_query($sql1,true);
		echo "<br>";
		$update2					=	$cls_db->db_query($sql2,true);
	}
	
function getCSV($keyArr,$dataArr)
	{
		foreach($dataArr as $key=>$val)
			{				
				foreach($val as $key1=>$val1)
					{
						$keys[]		=	$key1;
						$vals[]		=	$val1;
						$list		=	implode(",",$keys);
						$list	   .=	" \n";
						$list	   .=	implode(",",$vals);
						$list	   .=	" \n";
					}
			}
		
		$filename = "list_".date("d-m-Y H:i:s").".csv";
		header("Content-type: application/csv");
		header("Content-disposition:csv" .date("d-m-Y").".csv");
		header("Content-disposition: filename=".$filename);
		ob_clean();
		echo $list;exit;	
	}
*/

//$cls_db->sortingRecords("vod_admin_actions ","5","5");

$smarty->assign("tpl_note","$note");
//$smarty->display('testAnith.tpl.html');
?>