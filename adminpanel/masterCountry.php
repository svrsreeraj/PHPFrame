<?php
/**************************************************************************************
Created by :Meghna
Created on :2010-11-12
Purpose    :Country listing
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Territory- Country");err_status("header included");

$tpls		=	array();
$def_data	=	array();

//page details
$tpls["norecords"]				=	"No Records Found!";
$tpls["heading"]				=	"Manage Country";
$tpls["pagename"]				=	"masterCountry.php"; 
$tpls["parentpagename"]			=	"";
$tpls["childpagename"]			=	"masterState.php";
$tpls["childpagevar"]			=	"id";
$tpls["parentpagevar"]			=	"";
$tpls["parentBtnBack"]			=	"";

//database details
$def_data["table"]				=	"vod_country";
$def_data["primary"]			=	"id";
$def_data["name"]				=	"country";
$def_data["prference"]			=	"preference";
$def_data["foreign"]			=	"";
$def_data["status"]				=	"status";

$def_data["parent_table"]		=	"";
$def_data["parent_primary"]		=	"";
$def_data["parent_name"]		=	"";
$def_data["parent_foreign"]		=	"";

$def_data["child_table"]		=	"vod_country_state";
$def_data["child_primary"]		=	"id";
$def_data["child_foreign"]		=	"country_id";

//add area
$tpls["addcaption"]				=	"Add Country";
$tpls["addcount"]				=	15;
$tpls["addsplit"]				=	3;
$tpls["addbtnvalue"]			=	"Add Country";
$tpls["savebtnvalue"]			=	"Save";
$tpls["btnsavecancelvalue"]		=	"Cancel";

//update area
$tpls["edithead"]				=	"Edit Country";
$tpls["editcaption"]			=	"Country";
$tpls["updatebtnvalue"]			=	"Update";
$tpls["btnupdatecancelvalue"]	=	"Cancel";

//listing area
$tpls["listcaption"]			=	"Country";
$tpls["listoptions"]			=	"Options";
$tpls["preference"]				=	"Order";
$tpls["img_sortup"]				=	"images/up.gif";
$tpls["img_sortdown"]			=	"images/down.gif";

$page_cnt						=	GLB_PAGE_CNT;
require_once("tpl_template.php");
$smarty->display('tpl_template1.tpl.html');
?>
