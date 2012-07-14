<?php
/**************************************************************************************
Created By 	:Hari Krishna S
Created On	:8th november 2010
Purpose		:sorting cmd and cms_section table
**************************************************************************************/
class defaultModule extends siteclass
	{
		public $cmsId	=	"";
		
		public function setCmsId($id)
			{
				if($id)	$this->cmsId	=	$id;
			}
			

		public function getDefaultGroupData($args="1")
			{
				$sql					=	"SELECT * FROM ".constant("CONST_MODULE_DEFAULT_TABLE_GROUP")." WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
			
		public function defineConstants()
			{ 
				$data		=		$this->getDefaultData();
				foreach ($data as $value)
					{
						define($value["name"],$value["value"]);
					}
			} 

		public function getDefaultData($args="1") 
			{
				$sql					=	"SELECT * FROM ".constant("CONST_MODULE_DEFAULT_TABLE_DEFAULT")." WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		public function insertDefaultValue($dataArray)
			{
				$this->dbStartTrans();
				$this->defId			=	$this->db_insert(constant("CONST_MODULE_DEFAULT_TABLE_DEFAULT"),$dataArray);
				if(!$this->defId) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;	
					}
				else return $this->defId;
			}	
		public function updateDefaultValue($dataArray,$id)
			{
				$data					=	$this->db_update(constant("CONST_MODULE_DEFAULT_TABLE_DEFAULT"),$dataArray,"id=$id ");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
				else return true;
			}
	}
?>
