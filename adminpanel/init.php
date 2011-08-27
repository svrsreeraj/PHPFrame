<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	25-10-2010
Purpose		:	Initial functions
****************************************************************************************/
ob_start();
session_start();

if($_SERVER['HTTP_HOST']=="192.168.0.8") //local
	{
		$projectPath	=	$_SERVER["DOCUMENT_ROOT"]."/voteondeal/";
		$runningPath	=	$_SERVER["DOCUMENT_ROOT"]."/voteondeal/adminpanel/";
	}
else
	{
		$projectPath	=	$_SERVER["DOCUMENT_ROOT"]."/";
		$runningPath	=	$_SERVER["DOCUMENT_ROOT"]."/adminpanel/";

	}
//error handling
set_error_handler("customError");//setting error handler
error_reporting(~E_NOTICE); 



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
	
//including necessary files
require_once	($projectPath.'config.php');						err_status("Config Included");
require_once	($projectPath.'includes/db.php');					err_status("Db connected");
require_once	($projectPath.'libs/smarty-3.0.7/libs/Smarty.class.php');	err_status("Smarty Class Included");
require_once	($projectPath.'library/dbclass.php');				err_status("Db Class dbclass.php Included");
require_once	($projectPath.'library/siteclass.php');				err_status("site Class siteclass.php Included");
require_once	($projectPath.'library/modelclass.php');			err_status("Model Class modelclass.php Included");
require_once 	($projectPath.'includes/includedfiles.php');		err_status("includedfiles.php included");
require_once 	($projectPath.'includes/database_rules.php');		err_status("database_rules.php included");

//smarty object creation
$smarty					= 	new Smarty;								err_status("Smarty class object 'smarty' created");
$smarty->compile_check	= 	true;

//dbclasss and siteclass
$cls_db		=	new sdbclass;err_status("Db class object 'cls_db' created");
$cls_site	=	new siteclass("voteondeal.com","sess_admin","cls_db","vod_admin");err_status("site class object 'cls_site' created");

//time zone settings
if(WHERE_AM_I	==	"online")
	{
		//time zaone settings for php and mysql
		date_default_timezone_set('Pacific/Honolulu');//setting time zone
		mysql_query("SET time_zone = '-10:00'");//MY SQL	
	}
else
	{
		//time zaone settings for php and mysql
		date_default_timezone_set('Asia/Calcutta');//setting time zone
		mysql_query("SET time_zone = '+5:30'");//MY SQL
	}

//setting error status
if($_REQUEST['debug']	==	"1") $_SESSION['debug']	=	"1";
if($_REQUEST['debug']	==	"0") $_SESSION['debug']	=	"0";


$smarty->assign("cls_db",$cls_db);
$smarty->assign("cls_site",$cls_site);


function header_view($title="")
	{
		if(!$title)	$title	=	"voteondeal.com";
		define("_HEAD_TITLE",$title);
		include("header.php");
	}
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
function err_status($msg) 
	{
		if($_SESSION['debug'])	echo "<br>".$msg;
	}
function loadModelClass($session=true,$page="")
	{
		$modFolder	=	"models";
		if(!trim($page))	$page	=	siteclass::getPageName();
		$fileArray	=	pathinfo($page);
		require_once($modFolder."/".$fileArray["basename"]);
		$obj		=	 new $fileArray["filename"];
		if($session	==	true)	
			{
				$obj	=	$obj->getSessionObj()?$obj->getSessionObj():$obj;
				$obj->clearAction();
				if($obj->getRealAction())	
					{
						$obj->findAction();
					}
			}
		return $obj;
	}
?>