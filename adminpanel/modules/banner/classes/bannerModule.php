<?php
/**************************************************************************************
Created By 	:Maria Lukose
Created On	:15-12-2011
Purpose		:Banner Section
**************************************************************************************/
class bannerModule extends siteclass
	{
		public $cmsId	=	"";
		
		public function setCmsId($id)
			{
				if($id)	$this->cmsId	=	$id;
			}
		public function getAllBannerAdCategory($cond="")
			{
				if(!$cond) $cond	=	" 1";
				$sql				=	" select * from ".constant("CONST_MODULE_BANNER_TABLE_GROUP")." where ".$cond;
				$data				=	$this->getdbcontents_sql($sql);
				return $data; 
			}
		public function insertBanner($dataArray)
			{
				$this->dbStartTrans();
				$default_id			=	$this->db_insert(constant("CONST_MODULE_BANNER_TABLE_BANNER"),$dataArray);
				if(!$default_id) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $default_id;
			}	
		public function getBannerAdsDetailsById($id)
			{
				if(!$id)
					return "invalid Id";
				$sql				=	"select * from ".constant("CONST_MODULE_BANNER_TABLE_BANNER")."  where id=".$id;
				$data				=	$this->getdbcontents_sql($sql);
				return $data; 
			}
		public function update($dataIns,$id)
			{
			
				$update				=	$this->db_update(constant("CONST_MODULE_BANNER_TABLE_BANNER"),$dataIns," id=".$id);
				if($update)	return true;
				else
					{
							$this->setPageError($this->getPageError());
					}
			}
	}
?>
