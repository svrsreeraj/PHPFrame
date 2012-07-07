<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	2012-04-03
Description	:	Trainees Model
 **************************************************************************************/
class usersModel extends modelclass
	{
		public function Listing()
			{
				$sql		=	"select * from  test_users";
				$spage		=	$this->create_paging("n_page",$sql,10);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
				return array("data" => $data, "spage" => $spage);
			}
		public function Addform()
			{
				return array();
			}
		public function Save()
			{
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray("test_users",$data);
				$insId		=	$this->db_insert("test_users",$dataIns);
				if($insId)
					{
						$this->setPageError("Inserted Successfully");
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
				else
					{
						$this->setPageError("Somwthing went wrong");
					}
				
			}
		public function Editform()
			{
				$data	=	$this->getData("request");
				$sql	=	"select * from  test_users where ".$this->dbSearchCond("=", "id", $data["id"]);
				$data	=	end($this->getdbcontents_sql($sql));
				return array("data"=>$data);
			}
		public function Update()
			{
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray("test_users",$data);
				$insId		=	$this->db_update("test_users",$dataIns,$this->dbSearchCond("=", "id", $data["id"]));
				if($insId)
					{
						$this->setPageError("Updated Successfully");
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
				else
					{
						$this->setPageError("Somwthing went wrong");
					}
				
			}
		public function Delete()
			{
				$data	=	$this->getData("request");
				$sql	=	"delete from test_users where ".$this->dbSearchCond("=", "id", $data["id"]);
				$retVal	=	$this->db_query($sql);
				if($retVal)
					{
						$this->setPageError("Deleted Successfully");
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
				else
					{
						$this->setPageError("Somwthing went wrong");
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
			}
	}
?>
