<?php
/**************************************************************************************
Done On :26-10-2010
@Author	:Sreeraj VR
Purpose	:Initial variables
**************************************************************************************/
if($_SERVER["HTTP_HOST"]	==	"192.168.0.8")	
	{
		define('WHERE_AM_I',"local");
		$rootURL		=	"http://192.168.0.8/phpframe/";
		$host			=	"http://192.168.0.8";
		$absPath		=	$_SERVER["DOCUMENT_ROOT"]."/phpframe/";
		$rootURLhttps	=	"http://192.168.0.8/phpframe/";	
		$httpsHost		=	"http://192.168.0.8";
	}	
else	
	{
		define('WHERE_AM_I',"online");
		$rootURL		=	"http://www.voteondeals.com/";
		$host			=	"http://www.voteondeals.com";
		$absPath		=	$_SERVER["DOCUMENT_ROOT"]."/";
		$rootURLhttps	=	"https://www.voteondeals.com/";
		$httpsHost		=	"https://www.voteondeals.com";
	}

$httpsArr				=	array("yourPurchase.php");
$currentPg				=	getCurrentPageName();

if(in_array($currentPg, $httpsArr))	
	{
		if(trim(strtolower($_SERVER["HTTPS"]))	==	"on")	
			{
				define('ROOT_URL',$rootURLhttps);
			}
		else
			{
				if(WHERE_AM_I	==	"online")
					{
						header("location:".$httpsHost.$_SERVER['REQUEST_URI']);exit;	
					}
				
			}
	}
if(!defined("ROOT_URL"))	define('ROOT_URL',$rootURL);

define('ROOT_HTTP_URL',$rootURL);
define('ROOT_HTTPS_URL',$rootURLhttps);
define('ROOT_VENDOR_URL',$rootURL."vendors/");
define('ROOT_ADMIN_URL',$rootURL."adminpanel/");
define('ROOT_HOST',$host);
define('ROOT_CURRENT_URL',ROOT_HOST.$_SERVER['REQUEST_URI']);
define('ROOT_ABSOLUTE_PATH',$absPath);

//ini values
ini_set("magic_quotes_gpc", "Off");

//Vendor paging Vars
$vpageArr	=	array(
					"nextCaption"=>"Next",
					"prevCaption"=>"Previous",
					"containerTag"=>"li"
					);
//Customer paging Vars
$cpageArr	=	array(
					"nextCaption"=>"Next",
					"prevCaption"=>"Previous",
					"containerTag"=>"li"
					);		
function getCurrentPageName()
	{
		$scriptName		=	$_SERVER["SCRIPT_FILENAME"];
		$scriptArray	=	explode("/",$scriptName);
		return end($scriptArray);
	}	

				
?>