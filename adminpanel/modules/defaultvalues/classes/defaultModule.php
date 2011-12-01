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
			
		//CMS SECTION
		public function getDefaultGroupData($args="1")
			{
				$sql					=	"SELECT * FROM ".constant("CONST_MODULE_DEFAULT_TABLE_GROUP")." WHERE $args";			
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
		public function getDefaultData($args="1") //to fetch all cms data
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
		public function deleteCMS($id)
			{
				$data					=	$this->dbDelete_cond(constant("CONST_MODULE_CMS_TABLE_CMS"),"id=$id");
			}
		public function getCMS($id)
			{
				$data					=	$this->getdbcontents_cond(constant("CONST_MODULE_CMS_TABLE_CMS"),"id=$id");
				return $data; 	
			}
		public function sendMailCMS($id,$to,$from,$subject,$vars,$priority=0)
			{
				$cmsArr		=	end($this->getCMS($id));//fetching email template from CMS
				$message	=	$cmsArr["description"];
				foreach($vars	as	$key=>$val)	$message	=	str_replace($key,$val,$message);
				return $this->mailContentToDb($to,$from,$subject,$message,$priority);
			}
		public function mailContentToDb($to,$from,$subject,$message,$priority=0)
			{
				$dataArray	=	array(
									"to"=>$to,
									"from"=>$from,
									"subject"=>$subject,
									"message"=>$message,
									"priority"=>$priority,
									"date_added"=>"escape now() escape"
								);
				$this->db_insert('php_email_pending',$dataArray);
				return true;
				
			}
	}
?>
