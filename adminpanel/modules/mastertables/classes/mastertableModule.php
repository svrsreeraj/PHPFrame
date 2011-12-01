<?php
/**************************************************************************************
Created By 	:Meghna
Created On	:8th november 2010
Purpose		:sorting cmd and cms_section table
**************************************************************************************/
class masterModule extends siteclass
	{
		public $cmsId	=	"";
		
		public function setCmsId($id)
			{
				if($id)	$this->cmsId	=	$id;
			}
			
		//CMS SECTION
		public function getMasterSectionData($args="1")
			{
				$sql					=	"SELECT * FROM ".constant("CONST_MODULE_MASTER_TABLE_SECTION")." WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		public function insertCMSSection($dataArray)
			{
				$this->dbStartTrans();
				$section_id				=	$this->db_insert(constant("CONST_MODULE_MASTER_TABLE_SECTION"),$dataArray);
				if(!$section_id) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $section_id;
			}	
		public function updateCMSSection($dataArray,$id)
			{
				$data						=	$this->db_update(constant("CONST_MODULE_MASTER_TABLE_SECTION"),$dataArray,"id=$id");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
					else return true;	
					
			}
		public function deleteCMSSection($id)
			{
				$data		=	$this->dbDelete_cond(constant("CONST_MODULE_MASTER_TABLE_SECTION"),"id=$id");
			}
		public function getCMSSection($id)
			{
				$data		=	$this->getdbcontents_cond(constant("CONST_MODULE_MASTER_TABLE_SECTION"),"id=$id");
				return $data; 	
			}
		
		//CMS	
		public function getCMSData($args="1") //to fetch all cms data
			{
				$sql					=	"SELECT * FROM ".constant("CONST_MODULE_CMS_TABLE_CMS")." WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		public function insertMasterDetails($dataArray)
			{
				$this->dbStartTrans();
				$dataArray["date_added"]	=	"escape now() escape";
				$this->msId					=	$this->db_insert(constant("CONST_MODULE_MASTER_TABLE"),$dataArray);
				if(!$this->msId) 
					{
						$this->dbRollBack;
						return false;	
					}
				else return $this->msId;
			}	
		public function updateMasterDetails($dataArray,$id)
			{
				$data					=	$this->db_update(constant("CONST_MODULE_MASTER_TABLE"),$dataArray,"id=$id ");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
				else return true;
			}
		public function deleteCMS($id)
			{
				$data					=	$this->dbDelete_cond(constant("CONST_MODULE_MASTER_TABLE"),"id=$id");
			}
		public function getMasterDetails($id)
			{
				$data					=	$this->getdbcontents_cond(constant("CONST_MODULE_MASTER_TABLE"),"id=$id",true);
				return $data; 	
			}
	}
?>
