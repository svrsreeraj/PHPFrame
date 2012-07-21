<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	25-10-2010
Purpose		:	Initial functions
****************************************************************************************/
ob_start();
session_start();
ini_set("magic_quotes_gpc", "Off");
error_reporting(1); //error handling

if($_REQUEST["safemode"]	==	"true")		$_SESSION["reu_dev_safe_mode"]	=	true;
if($_REQUEST["safemode"]	==	"false")	$_SESSION["reu_dev_safe_mode"]	=	false;
if(($_SESSION["reu_dev_safe_mode"]	!= true) && is_file("../config.inc.php"))	require_once	("../init.php");
else
	{
		define("DEVELOER_LIMITED_ACCESS",true);
		function err_status($msg) 
			{
				if($_SESSION['debug'])	echo "<br>".$msg;
			}
		function header_view($title="")
			{
				if(!$title)	$title	=	"Developer Board";
				define("_HEAD_TITLE",$title);
				include("header.php");
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
						$obj	=	$obj->getSessionObj()?$obj->getSessionObj():$obj;
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
		//including necessary files
		require_once	('../config.php');								
		require_once	('../libs/smarty-3.0.7/libs/Smarty.class.php');	
		require_once	('../library/dbclass.php');						
		require_once	('../library/siteclass.php');					
		require_once	('../library/modelclass.php');				
		require_once	('../includes/smarty.plugin.php');				
		
		$cls_db		=	new sdbclass;err_status("Db class object 'cls_db' created");
		$cls_site	=	new siteclass("","","cls_db","");err_status("site class object 'cls_site' created");
		
		
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
		$smarty		= 	new Smarty;
		$smarty->compile_check	= 	true;
	}
?>
