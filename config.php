<?php
/**************************************************************************************
Done On :26-10-2010
@Author	:Sreeraj VR
Purpose	:Initial variables
**************************************************************************************/
if($_SERVER["HTTP_HOST"]	==	"192.168.0.8")	
	{
		define('WHERE_AM_I',"local");
		$rootURL		=	"http://192.168.0.8/PHPFrame/";
		$host			=	"http://192.168.0.8";
		$absPath		=	$_SERVER["DOCUMENT_ROOT"]."/PHPFrame/";
		$rootURLhttps	=	"http://192.168.0.8/PHPFrame/";	
		$httpsHost		=	"http://192.168.0.8";
	}	
else	
	{
		define('WHERE_AM_I',"online");
		$rootURL		=	"";
		$host			=	"http://www.phpframe.info/";
		$absPath		=	$_SERVER["DOCUMENT_ROOT"]."/";
		$rootURLhttps	=	"http://www.phpframe.info/";
		$httpsHost		=	"http://www.phpframe.info/";
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