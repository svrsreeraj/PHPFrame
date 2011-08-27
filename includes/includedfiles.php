<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2010-11-04
Purpose    :Including Classes
**************************************************************************************/
require_once	$projectPath.'classes/ipcountry.php';
require_once	$projectPath.'classes/territory.php';
require_once	$projectPath.'classes/masters.php';
require_once	$projectPath.'classes/industry.php';
require_once	$projectPath.'classes/product.php';
require_once	$projectPath.'classes/cms.php';
require_once	$projectPath.'classes/defaults.php';
require_once	$projectPath.'classes/ecommProducts.php';
require_once	$projectPath.'classes/siteCreditAction.php';
require_once	$projectPath.'classes/vendor.php';
require_once	$projectPath.'classes/deals.php';
require_once	$projectPath.'classes/vote.php';
require_once	$projectPath.'classes/customer.php';
require_once	$projectPath.'classes/adminUser.php';
require_once	$projectPath.'classes/faq.php';
require_once	$projectPath.'classes/contact.php';
require_once	$projectPath.'classes/questionnaire.php';
require_once	$projectPath.'classes/emailTemplate.php';
require_once	$projectPath.'classes/emailNewsletter.php';
require_once	$projectPath.'libs/recaptcha/recaptchalib.php';
require_once	$projectPath.'libs/paypalpro/paypal_pro.inc.php';
require_once	$projectPath.'classes/dealsOrder.php';
require_once	$projectPath.'classes/podCoupons.php';
require_once	$projectPath.'classes/pod.php';

//Default Value Settings
$defaultsObj	=	new defaults();
$defaultsObj->defineConstants();

?>