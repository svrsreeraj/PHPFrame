<?php
/**************************************************************************************
Created by :hari krishna s
Created on :2010-11-29
Purpose    :Questionnaire
**************************************************************************************/
class questionnaire extends modelclass
	{
		public function questionnaireListing()
			{
				if($this->permissionCheck("View",1))
						$searchData			=	$this->getData("post","Search");
						$sortData			=	$this->getData("request","Search");	
						if(!trim($sortData["sortField"]))
							{
								$this->addData(array("sortField"=>"id"),"request","Search");
								$this->addData(array("sortMethod"=>"desc"),"request","Search");
								$sortData	=	$this->getData("request","Search");//refreshing the variable
							}
						if(trim($searchData["keyword"]))
							{
								$sqlCond	.=	" And ( ";
								$sqlCond	.=	$this->dbSearchCond("like", "question", "%".$searchData["keyword"]."%");
								$sqlCond	.=	") ";
							}
						$data2				=	array();	
						$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
						$sql				=	"select * from vod_questionnaire WHERE 1 $sqlCond";
						$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
						$data				=	$this->getdbcontents_sql($spage->finalSql());
						foreach($data as $key=>$val)
							{		
								$qid		=	$val['id'];
								$sql		=	"select options from  vod_questionnaire_options where question_id=$qid";
								$optArr		=	$this->getdbcontents_sql($sql);									
								$data[$key]["answers"]	=	$optArr;						
							}
						$links				=	$spage->s_get_links();
						if(!$data)	$this->setPageError("No records found !");
						$searchData			=	$this->getHtmlData($this->getData("post","Search",false));
						$searchData["sortData"]	=	$sortData;							
						return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function questionnaireAddformbtn()
			{
				if($this->permissionCheck("Add",1))
				$this->executeAction(false,"Addform",true,true);
			}
		public function questionnaireCancel()
			{
				$this->executeAction(false,"Listing",true,true);	
			}
		public function questionnaireReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function questionnaireSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function questionnaireEditform()
			{
				if($this->permissionCheck("Edit",1))
				$data							=	$this->getData("get");
				$defaultObj						=	new Questionnaire_class;
				$dataArr						=	end($defaultObj->getQuestionnaire($data["id"]));
				$optionAr						=	$defaultObj->getoptions($data["id"]);
				
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				
				return array("data"=>$this->getHtmlData($dataArr),"data2"=>$optionAr);
			}
		public function questionnaireAddform()
			{
				
			}
		public function questionnaireStatuschange()
			{	
				$data		=	$this->getData("request");		
				if($this->statusChange("vod_questionnaire",$data["id"]))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','status,id');
					}
			}
		public function questionnaireSavedata()
			{
				$data		=	$this->getData("post");
				$data['ip']=$_SERVER['REMOTE_ADDR'];
				$defaultObj	=	new questionnaire_class();
				$ins=$defaultObj->insertQuestionnaire($data);
				if($ins)	
					{
						$this->setPageError("Inserted Successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
						return $this->executeAction(false,"Listing",true);
					}
				else
					{
						$this->setPageError("Please enter valid data");
						$this->executeAction(true,"Addform",true);
					}	
			}
		public function questionnaireUpdatedata()
			{
				$data					=	$this->getData("post");
				foreach($data as $value)
					{
						if(trim($value)=="")
						{
							$this->setPageError("Please fill all datas");
							$this->executeAction(false,"Editform",true,true);
						}
					
					}
				$id						=	$data[id];
				$question				=	array();
				$question['question']	=	$data['question'];
				$question['choice']		=	$data['choice'];
				$question['date_added']	=	"escape now() escape";
				$customer				=	new customer();
				$question['ip']			=	$customer->getCustomerIp();
				if($question['question']=="")
					{
						$this->setPageError("Please fill all data");
						$this->executeAction(false,"Editform",true,true);
					}	
				$con					=	"id=".$id;	
				$this->db_update("vod_questionnaire",$question,$con,true);
				$option['question_id']	=	$data['id'];
				unset($data['id']);
				unset($data['actionvar']);
				unset($data['question']);
				unset($data['choice']);
				unset($data['PHPSESSID']);
				$option					=	array();
				$sql="DELETE FROM  vod_questionnaire_options WHERE question_id  =".$id;
				mysql_query($sql);
				$defaultObj				=	new questionnaire_class();
				$insert=$defaultObj->vod_questionnaire_update($data,$id);
				if(!$insert)	
					{
						$this->setPageError("Please fill all data");
						$this->executeAction(false,"Editform",true,true);
					}
				else
					{
						$this->setPageError("Successfully updated ");
						$this->executeAction(false,"Listing",true);
					}
				
			}
			
		public function questionnaireDelete()
			{
				$data					=	$this->getData("post");
				
				if($data["checkone"])	
					{
						$this->db_delete_combo("vod_questionnaire","id",$data["checkone"]);
						$this->setPageError("Deleted Successfully");
					}
				else	$this->setPageError("No records selected");	
				return $this->executeAction(false,"Listing",true,true);
			}
		public function __construct()
			{
				$this->setClassName();
			}
		public function executeAction($loadData=true,$action="",$navigate=false,$sameParams=false,$newParams="",$excludParams="",$page="")
			{
				{
					if(trim($action))	$this->setAction($action);//forced action
					$methodName			=		(method_exists($this,$this->getMethodName()))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
					$this->actionToBeExecuted($loadData,$methodName,$action,$navigate,$sameParams,$newParams,$excludParams,$page);
					$this->actionReturn	=	call_user_func(array($this, $methodName));				
					$this->actionExecuted($methodName);
					return $this->actionReturn;
			}
			}
		public function __destruct()
			{
				parent::childKilled($this);
			}
	}
