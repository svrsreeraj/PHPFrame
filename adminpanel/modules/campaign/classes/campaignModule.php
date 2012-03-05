<?php
/**************************************************************************************
Created by :Anu
Created on :28-2-2011
Purpose    :Manage Campaign
**************************************************************************************/
class campaignModule extends siteclass
	{
		public $cmsId	=	"";
		
		public function setCmsId($id)
			{
				if($id)	$this->cmsId	=	$id;
			}
		public function getAllCampaignCategory($cond="")
			{
				if(!$cond) $cond	=	" 1";
				$sql				=	" select * from ".constant("CONST_MODULE_CAMPAIGN_TABLE_GROUP")." where ".$cond;
				$data				=	$this->getdbcontents_sql($sql);
				return $data; 
			}
		public function getAllCampaignAdsCategory($cond="")
			{
				if(!$cond) $cond	=	" 1";
				$sql				=	" select * from ".constant("CONST_MODULE_CAMPAIGN_TABLE")." where ".$cond;
				$data				=	$this->getdbcontents_sql($sql);
				return $data; 
			}
		public function insertCampaign($dataArray)
			{				
				$this->dbStartTrans();
				$default_id			=	$this->db_insert(constant("CONST_MODULE_CAMPAIGN_TABLE"),$dataArray);
				if(!$default_id) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $default_id;
			}	
		public function insertCampaignAdds($dataArray)
			{				
				$this->dbStartTrans();
				$default_id			=	$this->db_insert(constant("CONST_MODULE_CAMPAIGN_ADS"),$dataArray);
				if(!$default_id) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $default_id;
			}	
		public function getcampaignAdsDetailsById($id)
			{
				if(!$id)
					return "invalid Id";
				$sql				=	"select * from ".constant("CONST_MODULE_CAMPAIGN_ADS")."  where id=".$id;
				$data				=	$this->getdbcontents_sql($sql);
				return $data; 
			}
		public function getcampaignDetailsById($id)
			{
				if(!$id)
					return "invalid Id";
				$sql				=	"select * from ".constant("CONST_MODULE_CAMPAIGN_TABLE")."  where id=".$id;
				$data				=	$this->getdbcontents_sql($sql);
				return $data; 
			}
		public function updateCampaign($dataIns,$id)
			{
			
				$update				=	$this->db_update(constant("CONST_MODULE_CAMPAIGN_TABLE"),$dataIns," id=".$id);
				if($update)	return true;
				else
					{
							$this->setPageError($this->getPageError());
					}
			}
		public function updateCampaignAds($dataIns,$id)
			{
			
				$update				=	$this->db_update(constant("CONST_MODULE_CAMPAIGN_ADS"),$dataIns," id=".$id);
				if($update)	return true;
				else
					{
							$this->setPageError($this->getPageError());
					}
			}
	}
?>
