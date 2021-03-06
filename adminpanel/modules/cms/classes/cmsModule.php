<?php
/**************************************************************************************
Created By 	:Hari Krishna S
Created On	:8th november 2010
Purpose		:sorting cmd and cms_section table
**************************************************************************************/
class cmsModule extends siteclass
	{
		public $cmsId	=	"";
		
		public function setCmsId($id)
			{
				if($id)	$this->cmsId	=	$id;
			}
			
		//CMS SECTION
		public function getCMSSectionData($args="1")
			{
				$sql					=	"SELECT * FROM ".constant("CONST_MODULE_CMS_TABLE_SECTION")." WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		public function insertCMSSection($dataArray)
			{
				$this->dbStartTrans();
				$dataArray["date_added"]=	"escape now() escape";
				$section_id				=	$this->db_insert(constant("CONST_MODULE_CMS_TABLE_SECTION"),$dataArray);
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
				$dataArray["date_added"]	=	"escape now() escape";
				$data						=	$this->db_update(constant("CONST_MODULE_CMS_TABLE_SECTION"),$dataArray,"id=$id");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
					else return true;	
					
			}
		public function deleteCMSSection($id)
			{
				$data		=	$this->dbDelete_cond(constant("CONST_MODULE_CMS_TABLE_SECTION"),"id=$id");
			}
		public function getCMSSection($id)
			{
				$data		=	$this->getdbcontents_cond(constant("CONST_MODULE_CMS_TABLE_SECTION"),"id=$id");
				return $data; 	
			}
		
		//CMS	
		public function getCMSData($args="1") //to fetch all cms data
			{
				$sql					=	"SELECT * FROM ".constant("CONST_MODULE_CMS_TABLE_CMS")." WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		public function insertCMS($dataArray)
			{
				$this->dbStartTrans();
				$this->cmsId			=	$this->db_insert(constant("CONST_MODULE_CMS_TABLE_CMS"),$dataArray);
				if(!$this->cmsId) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;	
					}
				else return $this->cmsId;
			}	
		public function updateCMS($dataArray,$id)
			{
				$data					=	$this->db_update(constant("CONST_MODULE_CMS_TABLE_CMS"),$dataArray,"id=$id ");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
				else return true;
			}
		public function deleteCMS($id)
			{
				$data					=	$this->dbDelete_cond(constant("CONST_MODULE_CMS_TABLE_CMS"),"id=$id");
			}
		public function getCMS($id)
			{
				$data					=	$this->getdbcontents_cond(constant("CONST_MODULE_CMS_TABLE_CMS"),"id=$id");
				return $data; 	
			}
		public function sendMailCMS($id,$to,$from,$vars,$subject="")
			{
				$cmsArr		=	end($this->getCMS($id));//fetching email template from CMS
				$message	=	$cmsArr["description"];
				if(!$subject)	$subject	=	$cmsArr["title"];
				foreach($vars	as	$key=>$val)	$message	=	str_replace($key,$val,$message);
				foreach($vars	as	$key=>$val)	$subject	=	str_replace($key,$val,$subject);
				return $this->sendmail($to,$from,$subject,$message);
			}
	}
?>
