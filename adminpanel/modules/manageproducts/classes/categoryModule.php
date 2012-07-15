<?php
/**************************************************************************************
Created By 	:Maria Lukose
Created On	:15-12-2011
Purpose		:Category Section
**************************************************************************************/
class categoryModule extends siteclass
	{
		public $cmsId	=	"";
		
		public function setCmsId($id)
			{
				if($id)	$this->cmsId	=	$id;
			}//ml
		public function update($dataIns,$id)
			{
			
				$update				=	$this->db_update(constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY"),$dataIns," id=".$id);
				if($update)	return true;
				else
					{
							$this->setPageError($this->getPageError());
					}
			}
		public function updateproduct($updateArr,$id)
			{	
				$master_array				=	array();
				$result						=	$this->db_update(constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY"),$updateArr,"id=".$id);
				if($result)
					{
						return true;
					}
				else
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}
			}
		public function getCategoryName($aid="")
			{					
				$result			=	$this->getdbcontents_sql("SELECT parent_id,category from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." where id = $aid");
				return $result;
			}	
			
		public function getSubCategory($aid="")
			{					
				$result			=	$this->getdbcontents_sql("SELECT * from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." 
											where parent_id = $aid");	
				return $result;
			}
		public function getAllImages($args="1")
			{	
				$sql					=	"select * from  ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." where $args";
				$resultArry	=	$this->getdbcontents_sql($sql);
				return $resultArry;				
			}	
		public function getAllCategory($cond="")
			{
				if(!$cond) $cond	=	" 1";
				$sql				=	" select * from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." where ".$cond;
				$data				=	$this->getdbcontents_sql($sql);
				return $data; 
			}
			//ml
	
	}
?>
