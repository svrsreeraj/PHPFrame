<?php
/**************************************************************************************
Created By 	:Maria Lukose
Created On	:15-12-2011
Purpose		:Product Section
**************************************************************************************/
class productModule extends siteclass
	{
		public $cmsId	=	"";
		
		public function setCmsId($id)
			{
				if($id)	$this->cmsId	=	$id;
			}//ml
	
		public function createproduct($dataArr)
			{	
				$this->dbStartTrans();
				$master_array						=	$dataArr;
				$master_array['date_added']			=	"escape now() escape";
				$domainArry							= 	end($this->getdbcontents_sql("select * from idp_domain where domain = '".$_SERVER['HTTP_HOST']."'"));	
				//$master_array['domain_id']			=	$domainArry["id"];
				//$master_array['ip']					=	$_SERVER['REMOTE_ADDR'];
				$this->id							=	$this->db_insert(constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT"),$master_array);
				if(!$this->id) 
					{
						$this->dbRollBack();
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else
					{ 
						return $this->id; 
					}
			}
		public function updateproduct($updateArr,$id)
			{	
				$master_array				=	array();
				$result						=	$this->db_update(constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT"),$updateArr,"id=".$id);
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
		
		public function getProductDetails($pId="")
			{	
				$result						=	$this->getdbcontents_cond(constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT"),"id=".$pId);	
				return $result;
			}	
		public function getName($table,$field,$args="1")
			{
				$sql			=	"SELECT `$field` FROM `$table` WHERE $args"; 
				$dataArr		=	$this->getdbcontents_sql($sql);
				return stripslashes($dataArr[0][$field]);
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
