<?php
/**************************************************************************************
Created by :Sreeraj
Created on :25-10-2010
Purpose    :Database details page
**************************************************************************************/
if($_SERVER['HTTP_HOST']=="192.168.0.8") //if local server
	{
		$cfg["DB_SERVER"]	=	"localhost";
		$cfg["DB_USER"]		=	"root";
		$cfg["DB_PASSWORD"]	=	"";
		$cfg["DB"]			=	"phpframe";
	}
else
	{
		$cfg["DB_SERVER"]	=	"localhost";
		$cfg["DB_USER"]		=	"voteonde";
		$cfg["DB_PASSWORD"]	=	"123456";
		$cfg["DB"]			=	"databaseHere";		
	}
	
$con	=	mysql_pconnect($cfg["DB_SERVER"],$cfg["DB_USER"],$cfg["DB_PASSWORD"]) or die("Cannot connect to server");
mysql_select_db($cfg["DB"],$con) or die("Cannot connect to Database");
?>
