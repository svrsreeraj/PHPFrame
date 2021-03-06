<?php
/**************************************************************************************
 Created by :Sreeraj
 Created on :2011-07-17
 Purpose    :DB Mandatory model page
 ******************* *******************************************************************/
class dbMandatoryModel extends modelclass
	{
				
		public function Listing()
			{
				$finalArray	=	array();
				$tables		=	$this->getAllTables();
				foreach($tables	as	$key=>$val)
					{
						$finalArray["$val"]	=	$this->getAllFields($val);
					}
				$coreAdminUserObj	=	new coreAdminUser();
				$dbRulesModel		=	$coreAdminUserObj->getAllDbMandatoryRows("1 order by table_name,field_name asc");
				return array("datas"=>$dbRulesModel,"tables" => json_encode($finalArray));
			}
		public function Submit()
			{
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray(constant("CONST_ADMIN_CORE_TABLE_DB_MANDATORY"),$data);
				$indId		=	$this->db_insert(constant("CONST_ADMIN_CORE_TABLE_DB_MANDATORY"),$dataIns);
				if($indId)
					{
						$this->executeAction(array("navigate"=>true,"action"=>"Listing"));
					}
				else
					{
						$this->setPageError($this->getDbErrors());
						$this->executeAction(array("navigate"=>true,"action"=>"Listing"));
					}
			}
		public function DeleteRule()
			{
				$data		=	$this->getData("request");
				$id			=	$data["id"];
				$sql		=	"delete from ".constant("CONST_ADMIN_CORE_TABLE_DB_MANDATORY"). " where 1 and". $this->dbSearchCond("=","id",$id);
				if($this->db_query($sql))
					{
						$this->setPageError("Deleted successfully");
					}
				else
					{
						$this->setPageError("Something went wrong");
					}
				$this->executeAction(array("navigate"=>true,"action"=>"Listing"));
			}
		public function getAllTables()
			{
				$finalArray	=	array();
				$sql		=	"SHOW TABLES FROM ". CONST_DB_NAME;
				$data		=	$this->getdbcontents_sql($sql);
				foreach($data	as	$key=>$val)
					{
						$finalArray[]	=	end($val);
					}
				sort($finalArray);
				return	$finalArray;
			}
		public function getAllFields($table)
			{
				$finalArray	=	array();
				$sql		=	"select * from `$table` where 0";
				$result		=	$this->db_query($sql);
				$num		=	mysql_num_fields($result);
				for($i=0;$i<$num;$i++)
					{
						$finalArray[]	=	mysql_field_name($result, $i);
					}
				sort($finalArray);
				return	$finalArray;
			}
		public function getAllValidationMethods()
			{
				$finalArray	=	array();
				$data		=	get_class_methods($this->validationClassName);
				foreach($data	as	$key=>$val)
					{
						if(!in_array(trim($val),$this->validationclassExceptions))
							{
								$finalArray[]	=	$val;
							}								
					}
				sort($finalArray);
				return	$finalArray;
			}
		
	}
