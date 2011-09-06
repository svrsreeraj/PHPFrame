<?php
/**************************************************************************************
Done On :06-09-2011
@Author	:Sreeraj VR
Purpose	:Initial variables
**************************************************************************************/

$localHost	=	$localHostFromUser	=	trim("http://192.168.0.8/PHPFrame");
$onlineHost	=	$onlineHostFromUser	=	trim("http://www.phpframe.info");

$localHost	=	str_replace("http://","", $localHost);
$localHost	=	str_replace("https//","", $localHost);
if($pos = strpos($localHost, "/"))	$localHost	=	substr($localHost,0,$pos);

$onlineHost	=	str_replace("http://","", $onlineHost);
$onlineHost	=	str_replace("https//","", $onlineHost);
if($pos = strpos($onlineHost, "/"))	$onlineHost	=	substr($onlineHost,0,$pos);

$localHostFromUser	=	strrev($localHostFromUser);
if($localHostFromUser{0}	!=	"/")	$localHostFromUser	=	strrev($localHostFromUser)."/";
else 									$localHostFromUser	=	strrev($localHostFromUser);

$onlineHostFromUser	=	strrev($onlineHostFromUser);
if($onlineHostFromUser{0}	!=	"/")	$onlineHostFromUser	=	strrev($onlineHostFromUser)."/";
else 									$onlineHostFromUser	=	strrev($onlineHostFromUser);


if($_SERVER["HTTP_HOST"]	==	$localHost)	
	{
		define('WHERE_AM_I',"local");
		$rootURL		=	$localHostFromUser;
		$host			=	"http://192.168.0.8";
		$absPath		=	$_SERVER["DOCUMENT_ROOT"]."/PHPFrame/";
		$rootURLhttps	=	"http://192.168.0.8/PHPFrame/";	
		$httpsHost		=	"http://192.168.0.8";
	}	
elseif($_SERVER["HTTP_HOST"]	==	$onlineHost)		
	{
		define('WHERE_AM_I',"online");
		$rootURL		=	"";
		$host			=	"http://www.phpframe.info/";
		$absPath		=	$_SERVER["DOCUMENT_ROOT"]."/";
		$rootURLhttps	=	"http://www.phpframe.info/";
		$httpsHost		=	"http://www.phpframe.info/";
	}
else
	{
		exit("Error in configurations");		
	}

if(!defined("ROOT_URL"))	define('ROOT_URL',$rootURL);
define('ROOT_HTTP_URL',$rootURL);
define('ROOT_HTTPS_URL',$rootURLhttps);
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