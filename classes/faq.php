<?php
/**************************************************************************************
Created By 	:	hari krishna
Created On	:	2010-11-05
Purpose		:	functions for faq
**************************************************************************************/
class faq_class extends siteclass
	{
		public function getAllFaq($status="1") 
			{
				$data				=	$this->getdbcontents_cond("vod_faq","status = ".$status." ORDER BY preference ASC",true);
				return $data; 
			}
		public function getAllFaqGroups($stat="") 
			{
				if($stat)	$cond	=	" status='1' ";
				$data				=	$this->getdbcontents_cond("vod_faq_group ",$cond." ORDER BY preference ASC");
				return $data; 
			}
		public function getFaqById($Id)
			{	
				$data				=	$this->getdbcontents_cond('vod_faq'," id='$Id'");
				return $data; 
			}	
			
		public function getFaq($groupId)
			{	
				$data				=	$this->getdbcontents_cond('vod_faq'," group_id='$groupId' and status = 1 ORDER BY preference ASC");
				return $data; 
			}
		public function insertfaq($dataArray)
			{
				$this->dbStartTrans();
				$default_id			=	$this->db_insert('vod_faq',$dataArray);
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
				$data				=	$this->db_update('vod_faq',$dataArray,"id=$id");
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
				return true;	 
			}	
	}
?>
