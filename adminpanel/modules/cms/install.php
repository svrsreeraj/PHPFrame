<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-09-26
Purpose    :CMS install page
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(false);
$obj->executeAction(array("loadData"=>true));
?>
