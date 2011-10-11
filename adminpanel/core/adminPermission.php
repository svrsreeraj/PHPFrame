<?
/**************************************************************************************
Created by 	:Anith M.S
Created on 	:2009-11-12
Purpose		:To set permission to different users.
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Admin Permission");err_status("header included");

$role			=	$_REQUEST["role"];
$flag			=	$_REQUEST["flag"];

$objCls			= 	new adminUser();

if($flag)
	{		
		$menuval	=	$objCls->getAllMenus("status=1 ORDER BY preference ASC");
		foreach ($menuval as $key => $value)
			{
				$menuid						=	$value["id"];
				$menuval[$key]["pages"]		=	$objCls->getAllPages(" menuid='$menuid' and status='1' ORDER BY preference ASC");
				
				foreach ($menuval[$key]["pages"] as $key1 => $value1)
					{	
						$pageid										=	$value1["id"];
						$menuval[$key]["pages"][$key1]["action"]	=	$objCls->getPageActionDetails("pg.pageid='$pageid' ORDER BY act.preference ASC");
						
						foreach($menuval[$key]["pages"][$key1]["action"] as $key2=>$value2)
							{
								$pactionid	=	$value2["id"];
								$act		=	$value2["action"];
								$perCnt		=	count($objCls->getPermission("pactionid ='$pactionid' and usertypeid='$flag'"));
								if($perCnt	>	0)																			
									{
										$menuval[$key]["pages"][$key1]["action"][$key2]["checked"] = "1";
										$menuval[$key]["checked"] 								   = "1";
									}
								else 	$menuval[$key]["pages"][$key1]["action"][$key2]["checked"] = "0";	
							}
					}	
			}
	}
if(isset($_POST['Submit']))
	{	
		$objCls->permissionCheck("Edit",1);
		if(!$flag)	exit("unknown error occured");
		$objCls->db_query("delete from php_admin_permission where usertypeid='$flag'");
		
		foreach ($menuval as $key => $value)
			{	
				$mnid				=	$value["id"];
				$postgip			=	$_POST["group$mnid"];
				if($postgip)
					{
						foreach ($value["pages"] as $key1 => $value1)
							{
								$pageid			=	$value1["id"];									
								$dataArr		=	array();
								foreach ($value1["action"] as $key2 => $value2)
									{
										$actid			=	$value2["id"];
										$pactid			=	$_POST["group_".$mnid."_".$pageid."_".$actid];
										if($pactid)
											{														
												$dataArr["usertypeid"]	=	$flag;
												$dataArr["pactionid"]	=	$pactid;													
												$pid					=	$objCls->insertPermission($dataArr);
											}
									}
							}
					}
			}
		$_SESSION['sess_message']= "Permission updated successfully";	
		header("location:adminPermission.php?flag=$flag");exit;
	}
	
$rol			=	$objCls->getAllUsertypes("status=1");
$role			=	$objCls->get_combo_arr("role",$rol,"id","typename","$flag","onchange=\"return fun(this.value);\"");
$smarty->assign("TPL_ROLE",$role);
$smarty->assign("menus",$menuval);
$smarty->assign("TPL_MESSAGE",$_SESSION['sess_message']);	
$_SESSION['sess_message']="";	
$smarty->assign("obj",$objCls);
$smarty->display('adminPermission.tpl.html');
?>
