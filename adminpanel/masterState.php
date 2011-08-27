<?php
/**************************************************************************************
Created by :Meghna
Created on :2010-11-12
Purpose    :State listing
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Territory - State");err_status("header included");

$tpls		=	array();
$def_data	=	array();

//page details
$tpls["norecords"]				=	"No Records Found!";
$tpls["heading"]				=	"Manage States";
$tpls["pagename"]				=	"masterState.php";
$tpls["parentpagename"]			=	"masterCountry.php";
$tpls["childpagename"]			=	"masterCity.php";
$tpls["childpagevar"]			=	"id";
$tpls["parentpagevar"]			=	"id";
$tpls["parentBtnBack"]			=	"Back";

//database details
$def_data["table"]				=	"vod_country_state";
$def_data["primary"]			=	"id";
$def_data["name"]				=	"state";
$def_data["prference"]			=	"preference";
$def_data["foreign"]			=	"country_id";
$def_data["status"]				=	"status";

$def_data["parent_table"]		=	"vod_country";
$def_data["parent_primary"]		=	"id";
$def_data["parent_name"]		=	"country";
$def_data["parent_foreign"]		=	"";

$def_data["child_table"]		=	"vod_country_state_city";
$def_data["child_primary"]		=	"id";
$def_data["child_foreign"]		=	"state_id";

//add area
$tpls["addcaption"]				=	"Add State";
$tpls["addcount"]				=	15;
$tpls["addsplit"]				=	3;
$tpls["addbtnvalue"]			=	"Add State";
$tpls["savebtnvalue"]			=	"Save";
$tpls["btnsavecancelvalue"]		=	"Cancel";

//update area
$tpls["edithead"]				=	"Edit State";
$tpls["editcaption"]			=	"State";
$tpls["updatebtnvalue"]			=	"Update";
$tpls["btnupdatecancelvalue"]	=	"Cancel";

//listing area
$tpls["listcaption"]			=	"State";
$tpls["listoptions"]			=	"Options";
$tpls["preference"]				=	"Order";
$tpls["img_sortup"]				=	"images/up.gif";
$tpls["img_sortdown"]			=	"images/down.gif";

$page_cnt						=	GLB_PAGE_CNT;
require_once("tpl_template.php");
$smarty->display('tpl_template1.tpl.html');
?>
