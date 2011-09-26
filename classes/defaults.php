<?php
/**************************************************************************************
Created By 	:	hari krishna
Created On	:	2010-11-05
Purpose		:	functions for groups
**************************************************************************************/

class defaults extends siteclass
	{
		//select all from table name php_defaults_group
		public function getAllGroups($stat="") 
			{
				if($stat)	$cond	=	" status='1' ";
				$data				=	$this->getdbcontents_cond("php_defaults_group",$cond." ORDER BY preference ASC");
				return $data; 
			}
		//select all from table name php_defaults
		public function getAllConstants($args="1")
			{
				$data				=	$this->getdbcontents_cond('php_defaults',$args);
				return $data; 
			}
		//return all constants where group id =$gId			
		public function getConstantsByGroup($gId)
			{	
				$data				=	$this->getdbcontents_cond('php_defaults','group_id ='.$gId);
				return $data; 
			}
		//return the parent name
		public function getGroupByConstant($id)
			{
				$data				=	$this->getdbcontents_cond('php_defaults_group',"status=1 AND id =".$id);		
				return $data; 
			}
		public function defineConstants()
			{ 
				$data		=		$this->getdbcontents_cond('php_defaults');	
				foreach ($data as $value)
					{
						define($value["name"],$value["value"]);
						define($value["value"],$value["value"]);
					}
			} 
		public function insertDefaults($dataArray)
			{
				$this->dbStartTrans();
				$default_id				=	$this->db_insert('php_defaults',$dataArray);
				if(!$default_id) 
					{
						$this->dbRollBack();
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $default_id;
			}	
		public function updateDefaults($dataArray,$id)
			{				
				$data					=	$this->db_update('php_defaults',$dataArray,"id=$id");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
				return true;	 
					
			}	
		public function insertDefaultGroup($dataArray)
			{
				$this->dbStartTrans();
				$group_id				=	$this->db_insert('php_defaults_group ',$dataArray);
				if(!$group_id) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $group_id;
			}	
		public function updateDefaultGroup($dataArray,$id)
			{				
				$data					=	$this->db_update("php_defaults_group",$dataArray,"id='$id'");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
				else return true;
			}	
	}
?>
