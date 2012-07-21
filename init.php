<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	25-10-2010
Purpose		:	Initial functions
****************************************************************************************/
ob_start();
session_start();
ini_set("magic_quotes_gpc", "Off");
error_reporting(~E_NOTICE); //error handling
set_error_handler("customError");//setting error handler


//including necessary files
if(is_file(dirname(__FILE__)."/config.inc.php"))	require_once("config.inc.php");//for adminpanel,developers etc
else
	{
		header("location:developer/");exit;
	}

require_once	(CONST_SITE_ABSOLUTE_PATH.'config.php');								err_status("Config Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'includes/db.php');							err_status("Db connected");

require_once	(CONST_SITE_ABSOLUTE_PATH.'library/dbclass.php');						err_status("Db Class dbclass.php Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'library/siteclass.php');						err_status("site Class siteclass.php Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'library/spaging.php');						err_status("paging Class spaging.php Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'library/upload.php');						err_status("upload Class upload.php Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'library/phpValidations.php');				err_status("validation Class phpValidations.php Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'library/modelclass.php');					err_status("Model Class modelclass.php Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'library/moduleclass.php');					err_status("Module Class moduleclass.php Included");

require_once 	(CONST_SITE_ABSOLUTE_PATH.'includes/includedfiles.php');				err_status("includedfiles.php included");
require_once 	(CONST_SITE_ABSOLUTE_PATH.'includes/database_rules.php');				err_status("database_rules.php included");


require_once	(CONST_SITE_ABSOLUTE_PATH.'libs/smarty-3.0.7/libs/Smarty.class.php');	err_status("Smarty Class Included");

require_once	(CONST_SITE_ABSOLUTE_PATH.'includes/smarty.plugin.php');				err_status("Smarty Plugin Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'adminpanel/core/classes/coreAdminUser.php');	err_status("Core class Included");
require_once	(CONST_SITE_ABSOLUTE_PATH.'adminpanel/core/conf/coreGlobalConfig.php');			err_status("Core global Config Included");


//disabling magic quotes in run time
if (get_magic_quotes_gpc()) 
	{
	    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
	    while (list($key, $val) = each($process)) 
		    {
		        foreach ($val as $k => $v) 
			        {
			            unset($process[$key][$k]);
			            if (is_array($v)) 
				            {
				                $process[$key][stripslashes($k)] = $v;
				                $process[] = &$process[$key][stripslashes($k)];
				            } 
			            else 
				            {
				                $process[$key][stripslashes($k)] = stripslashes($v);
				            }
			        }
		    }
	    unset($process);
	}



//smarty object creation
$smarty		= 	new Smarty;	err_status("Smarty class object 'smarty' created");
$smarty->compile_check	= 	true;

//dbclasss and siteclass
$cls_db		=	new sdbclass;err_status("Db class object 'cls_db' created");
$cls_site	=	new siteclass(constant("CONST_SITE_ADDRESS"),"sess_customer","cls_db","");err_status("site class object 'cls_site' created");

//time zone settings
if(constant("CONST_TIME_ZONE_PHP"))		date_default_timezone_set(constant("CONST_TIME_ZONE_PHP"));//setting time zone
if(constant("CONST_TIME_ZONE_MYSQL"))	mysql_query("SET time_zone = '".constant("CONST_TIME_ZONE_PHP")."'");//MY SQL	
	
//setting error status
if($_REQUEST['debug']	==	"1") $_SESSION['debug']	=	"1";
if($_REQUEST['debug']	==	"0") $_SESSION['debug']	=	"0";

//Assigning siteclass to Smarty
$smarty->assign("cls_site",$cls_site);

//If we need to shutdown the site for some reason uncomment the header path
if(WHERE_AM_I	==	"online")
	{
		if($_REQUEST["showme"]	!=	"")	$_SESSION["showme"]	=	"1";
		if(!$_SESSION["showme"])
			{
				//header("location:http://www.example.com/underConstruction/");exit;
			}
	}
	
//this is our Custom error handler
function customError($error_level,$error_message,$error_file,$error_line,$error_context)
 	{ 
	 	if($error_level	<>	8)
	 		{
				 if($_SESSION['debug'])
			 		{
						echo "<br><b>error_level:</b> : $error_level";
					 	echo "<br><b>error_message:</b> : $error_message";
					 	echo "<br><b>error_file:</b> : $error_file";
					 	echo "<br><b>error_line:</b> : $error_line";
					}
			}
	}
//Keeping and displaying the status 
function err_status($msg) 
	{
		if($_SESSION['debug'])	echo "<br>".$msg;
	}

//Key function to load model class
function loadModelClass($session=true,$page="")
	{
		$modFolder	=	getcwd().DIRECTORY_SEPARATOR."models";
		if(!trim($page))	$page	=	siteclass::getPageName();
		$fileArray	=	pathinfo($page);
		require_once($modFolder.DIRECTORY_SEPARATOR.$fileArray["basename"]);
		$className	=	$fileArray["filename"]."Model";
		$obj		=	new $className;
		if($session	==	true)	
			{
				$obj	=	$obj->getSessionObj($className)?$obj->getSessionObj($className):$obj;
				$obj->clearAction();
				if($obj->getRealAction())	$obj->findAction();
			}
		return $obj;
	}
function loadView($vars=array(),$userPage="")
	{
		if(!trim($page))	$page	=	siteclass::getPageName();
		$fileArray	=	pathinfo($page);
		$tplFile	=	$fileArray["filename"].".tpl.html";
		if(!$userPage)	$userPage	=	$tplFile;
		global $smarty,$obj;
		$smarty->assign('obj',$obj);
		foreach($vars as	$key=>$val)	$smarty->assign($key,$GLOBALS[$val]);
		$smarty->display($userPage);
	}
//loading Heeder file
function header_view($title="",$file="header.php")
	{
		if(!$title)	$title	=	constant("CONST_SITE_ADDRESS");
		define("_HEAD_TITLE",$title);
		if(is_file(getcwd().DIRECTORY_SEPARATOR.$file)) include(getcwd().DIRECTORY_SEPARATOR.$file);
	}
?>
