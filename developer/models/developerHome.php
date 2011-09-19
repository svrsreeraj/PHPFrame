<?php
/**************************************************************************************
Created by :hari krishna
Created on :2010-11-16
Purpose    :Admin Home Model Page
******************* *******************************************************************/
class developerHomeModel extends modelclass 
	{
		public function developerHomeListing()
			{
				return array();
			}
		public function __destruct()
			{
				parent::childKilled($this);
			}
	}
