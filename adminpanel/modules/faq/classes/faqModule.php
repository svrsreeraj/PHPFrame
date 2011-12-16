<?php
/**************************************************************************************
Created By 	:	Maria Lukose
Created On	:	15-12-2011
Purpose		:	functions for faq
**************************************************************************************/
class faqModule extends siteclass
	{
		public function getAllFaq($status="1") 
			{
				$data				=	$this->getdbcontents_cond("CONST_MODULE_FAQ_TABLE_FAQ","status = ".$status." ORDER BY preference ASC",true);
				return $data; 
			}
			public function getAllFaqGroup($args="1")
			{
				$sql					=	"SELECT * FROM ".constant("CONST_MODULE_FAQ_TABLE_SECTION")." WHERE $args";			
				$data					=	$this->getdbcontents_sql($sql);	
				return $data;
			}
		public function getFaqById($Id)
			{	
				$data				=	$this->getdbcontents_cond(constant("CONST_MODULE_FAQ_TABLE_FAQ")," id='$Id'");
				return $data; 
			}	
			
		public function getFaq($groupId)
			{	
				$data				=	$this->getdbcontents_cond('CONST_MODULE_FAQ_TABLE_FAQ'," group_id='$groupId' and status = 1 ORDER BY preference ASC");
				return $data; 
			}
		public function insertfaq($dataArray)
			{
				$this->dbStartTrans();
				$default_id			=	$this->db_insert(constant("CONST_MODULE_FAQ_TABLE_FAQ"),$dataArray);
				if(!$default_id) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $default_id;
			}	
		public function updatefaq($dataArray,$id)
			{			
				$data				=	$this->db_update(constant("CONST_MODULE_FAQ_TABLE_FAQ"),$dataArray,"id=$id");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
				return true;	 
			}
		public	function getMaxPreference($table,$cond="1",$preference="preference")
			{
				$sql					=	"SELECT  max($preference)+1 as pref FROM $table WHERE $cond";			
				$data					=	$this->getdbcontents_sql($sql);	
				$nxtVal					=	$data[0]['pref'];
				return $nxtVal;
			}	
	}
?>
