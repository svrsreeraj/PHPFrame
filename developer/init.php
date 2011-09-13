<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	25-10-2010
Purpose		:	Initial functions
****************************************************************************************/
if(is_file("config.inc.php"))	require_once	("../init.php");
else
	{
		ob_start();
		session_set_cookie_params(10*60*60);
		ini_set('session.gc_maxlifetime', '36000');
		session_start();
		ini_set("magic_quotes_gpc", "Off");
		error_reporting(1); //error handling
		
		function err_status($msg) 
			{
				if($_SESSION['debug'])	echo "<br>".$msg;
			}
		function header_view($title="")
			{
				if(!$title)	$title	=	"voteondeals.com";
				define("_HEAD_TITLE",$title);
				include("header.php");
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