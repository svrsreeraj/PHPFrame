<?php
/****************************************************************************************
Created by	:	Sreeraj
Created on	:	2010-12-14
Purpose		:	Model class for AppProcess
****************************************************************************************/
class appProcess extends modelclass
	{
		public function appProcessListing()
			{
				$this->executeAction(true,'Classdata','',true);
			}
		public function appProcessClassdata()
			{
				/*if(!($this->getApplication()	==	"2"	||	$this->getApplication()	==	"2"))
					{
						exit("Authentication Failed");	
					}*/
				$data		=	$this->getData("request");
				$data		=	array("data"=>json_decode($data["Data"]));
				extract($data);
				if(trim($data->className))
					{
						$obj		=	new $data->className;
						$methdName	=	$data->methodName;
						$argsArray	=	$data->argsArray;
						function callBackFnConvertToArray(&$item, $key)
							{
								if(is_object($item))	$item	=	(array)$item;
								
							}
						array_walk_recursive($argsArray,"callBackFnConvertToArray");
						$rtData		=	call_user_func_array(array($obj, $methdName), $argsArray);
						$var		=	$data->indexArray;
						if($var)
							{
								foreach($var as $key)	$temp[$key]	=	$rtData[$key];
								$rtData	=	$temp;
							}
						function callBackFnLastArray(&$item, $key)
							{
								$item	=	strip_tags($item);									
							}
						array_walk_recursive($rtData,"callBackFnLastArray");
					}
				ob_clean();
				if($rtData) $json_data	=	json_encode($rtData);
				if(!$json_data)				
					{
						echo "false";
						exit;	
					}	
				if($json_data != "null")	echo $json_data;
				else						echo "false";
				exit;
			}
		public function __construct()
			{
				$this->setClassName();
			}
		public function executeAction($loadData=true,$action="",$navigate=false,$sameParams=false,$newParams="",$excludParams="",$page="")
			{
				if(trim($action))	$this->setAction($action);//forced action
				$methodName	=		(method_exists($this,$this->getMethodName()))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
				$this->actionToBeExecuted($loadData,$methodName,$action,$navigate,$sameParams,$newParams,$excludParams,$page);
				$this->actionReturn		=	call_user_func(array($this, $methodName));				
				$this->actionExecuted($methodName);
				return $this->actionReturn;
			}
		public function __destruct() 
			{
				parent::childKilled($this);
			}
	}
