<?php
/**************************************************************************************
Created by :Meghna
Created on :2010-11-12
Purpose    :Admin user types listing
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Admin User Types");err_status("header included");

$tpls		=	array();
$def_data	=	array();

//page details
$tpls["norecords"]				=	"No Records Found!";
$tpls["heading"]				=	"Manage Admin Usertypes";
$tpls["pagename"]				=	"masterAdminUserType.php";
$tpls["parentpagename"]			=	"";
$tpls["childpagename"]			=	"";
$tpls["childpagevar"]			=	"";
$tpls["parentpagevar"]			=	"";
$tpls["parentBtnBack"]			=	"";

//database details
$def_data["table"]				=	constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERTYPE");
$def_data["primary"]			=	"id";
$def_data["name"]				=	"typename";
$def_data["prference"]			=	"preference";
$def_data["foreign"]			=	"";
$def_data["status"]				=	"status";

$def_data["parent_table"]		=	"";
$def_data["parent_primary"]		=	"";
$def_data["parent_name"]		=	"";
$def_data["parent_foreign"]		=	"";

$def_data["child_table"]		=	"";
$def_data["child_primary"]		=	"";
$def_data["child_foreign"]		=	"";

//add area
$tpls["addcaption"]				=	"Add Admin Usertypes";
$tpls["addcount"]				=	15;
$tpls["addsplit"]				=	3;
$tpls["addbtnvalue"]			=	"Add Admin Usertypes";
$tpls["savebtnvalue"]			=	"Save";
$tpls["btnsavecancelvalue"]		=	"Cancel";

//update area
$tpls["edithead"]				=	"Edit Admin Usertypes";
$tpls["editcaption"]			=	"Admin Usertypes";
$tpls["updatebtnvalue"]			=	"Update";
$tpls["btnupdatecancelvalue"]	=	"Cancel";

//listing area
$tpls["listcaption"]			=	"Admin Usertypes";
$tpls["listoptions"]			=	"Options";
$tpls["preference"]				=	"Order";
$tpls["img_sortup"]				=	"images/up.gif";
$tpls["img_sortdown"]			=	"images/down.gif";

$page_cnt						=	GLB_PAGE_CNT;
require_once("tpl_template.php");
$smarty->display('tpl_template1.tpl.html');
?>
