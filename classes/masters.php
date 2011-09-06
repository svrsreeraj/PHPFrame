<?php
/**************************************************************************************
Created By 	:M S Anith
Created On	:2010-12-1	
Purpose		:Master Tables
**************************************************************************************/
class masters extends siteclass
	{
		public function getAllDetails($table,$args="1")
			{	
				$sql			=	"SELECT * FROM `$table` WHERE $args"; 
				$dataArr		=	$this->getdbcontents_sql($sql);
				return $dataArr;
			}
		public function getName($table,$field,$args="1")
			{
				$sql			=	"SELECT `$field` FROM `$table` WHERE $args"; 
				$dataArr		=	$this->getdbcontents_sql($sql);
				return stripslashes($dataArr[0][$field]);
			}		
		public function insertMasterData($table,$dataArr)
			{
				$masterId		=	$this->db_insert($table,$dataArr);
				if(!$masterId) 
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}					
				else return $masterId;
				
			}
		public function updateMasterData($table,$dataArr,$Id)
			{
				$data			=	$this->db_update($table,$dataArr,'id ='.$Id);
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
				else return true;	
			}
	}
?>
