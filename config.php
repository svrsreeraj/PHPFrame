<?php
/**************************************************************************************
Done On :06-09-2011
@Author	:Sreeraj VR
Purpose	:Initial variables
**************************************************************************************/
$userHost	=	trim(CONST_SITE_ADDRESS);
$userAbs	=	trim(CONST_SITE_ABSOLUTE_PATH);
$userHost	=	str_replace("http://","", $userHost);
$userHost	=	str_replace("https//","", $userHost);
if($pos = strpos($userHost, "/"))	$userHost	=	substr($userHost,0,$pos);

//Finding actual host
$userHostFromUser	=	strrev($userHost);
if($userHostFromUser{0}	!=	"/")	$userHostFromUser	=	strrev($userHostFromUser)."/";
else 								$userHostFromUser	=	strrev($userHostFromUser);

//finding actul absolute path
$userAbsFromUser	=	strrev($userAbs);
if($userAbsFromUser{0}	!=	"/")	$userAbsFromUser	=	strrev($userAbsFromUser)."/";
else 								$userAbsFromUser	=	strrev($userAbsFromUser);

echo $userAbsFromUser;exit;

if(constant("CONST_LOCAL_OR_ONLINE")	==	"local")	define('WHERE_AM_I',"local");
	
if($_SERVER["HTTP_HOST"]	==	$onlineHost)		
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