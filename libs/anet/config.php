<?php
/**
 * This file contains config info for the sample app.
 */

// Adjust this to point to the Authorize.Net PHP SDK
require_once 'anet_php_sdk/AuthorizeNet.php';

//define("AUTHORIZENET_API_LOGIN_ID","8aJ3cjQ9R");
//define("AUTHORIZENET_TRANSACTION_KEY","98R7TJDT8cd42qMd");

define("AUTHORIZENET_API_LOGIN_ID","5g8qN6Jt");
define("AUTHORIZENET_TRANSACTION_KEY","74T88h29uy9GCa55");

define("AUTHORIZENET_SANDBOX",false);

$METHOD_TO_USE = "AIM";

// To use Direct Post Method, uncomment the line below and update the $site_root variable.
// $METHOD_TO_USE = "DIRECT_POST";
$site_root = "http://192.168.0.8/voteondeal/anet/your_store/";
define("AUTHORIZENET_MD5_SETTING",""); // Update this with your MD5 Setting.



if (AUTHORIZENET_API_LOGIN_ID == "") {
    die('Enter your merchant credentials in config.php before running the sample app.');
}
