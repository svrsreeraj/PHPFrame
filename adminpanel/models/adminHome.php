<?php
/**************************************************************************************
Created by :hari krishna
Created on :2010-11-16
Purpose    :Admin Home Model Page
******************* *******************************************************************/
class adminHomeModel extends modelclass 
	{
		public function Listing()
			{
				$moduleClass	=	 new moduleclass();
				$moduleClass->installModule("cms");
				print_r($moduleClass->errorArray);
				exit;
				return array();
			}
		
	}
