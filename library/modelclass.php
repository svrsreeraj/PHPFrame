<?php
/**
 * @author	Sreeraj
 * @Date	2010-11-07
 * @file	modelclass.php	
 */
class modelclass extends siteclass
	{
		public $actionVar			=	"actionvar";
		public $redirectvar			=	"redirecturl";
		public $defaultActionVal	=	"Listing";
		public $classPostfix		=	"Model";
		public $maxSessionCount		=	100;
		public $actionVal			=	"";
		public $childClass			=	"";
		public $_data				=	array();
		public $actionReturn		=	"";
		public $currentAction		=	"";
		public $previousAction		=	"";
		public $pageError			=	"";

		//return which action to be executed
		public function getAction()
			{
				if(!$this->actionVal)	$this->findAction();
				return					$this->actionVal;
			}
		//set action	
		public function setAction($str)
			{
				$this->actionVal	=	ucwords($str);
			}
		//Clear action
		public function clearAction()
			{
				$this->actionVal	=	"";
			}
		//return default Actipn
		public function getDefaultAction()
			{
				return $this->defaultActionVal;
			}
		//finding currect Action
		public function findAction()
			{
				if(trim($_REQUEST[$this->actionVar])	!=	"")	$this->setAction(trim($_REQUEST[$this->actionVar]));
				else											$this->setAction($this->getDefaultAction());
			}
		//collecting from REQUEST var
		public function getRealAction()
			{
				return trim($_REQUEST[$this->actionVar]);
			}
		//it wil return the specified method name to be called
		public function getMethodName($default=false)
			{
				if(!$this->childClass)	$this->setClassName();
				if($default	==	false)	return ucwords($this->getAction());
				else					return ucwords($this->getDefaultAction());
			}
		//setting the child class name
		public function setClassName($className)
			{
				if($className)	$this->childClass	=	$className;
				else
					{
						$traceArray			=	debug_backtrace();
						$this->childClass	=	$traceArray[1]["class"];	
					}
				
			}
		//find class name from page name
		public function getClassNameByPageName($page)
			{
				$fileArray	=	pathinfo($page);
				return $className	=	$fileArray["filename"]."Model";	
			}
		//loading data
		public function loadData($methodName,$page="")
			{
				if(trim($page))
					{
						$tempObj			=	loadModelClass(true,$page);
						$loadObject			=	&$tempObj;
					}
				else	$loadObject			=	&$this;
				if(trim($methodName))
					{
						if(!(count($_POST)		==	1 &&	$_POST[$loadObject->actionVar]	!=""))		if($_POST)		$loadObject->_data[$methodName]["post"]		=	$_POST;
						if(!(count($_GET)		==	1 &&	$_GET[$loadObject->actionVar]		!=""))	if($_GET)		$loadObject->_data[$methodName]["get"]		=	$_GET;
						if(!(count($_REQUEST)	==	1 &&	$_REQUEST[$loadObject->actionVar]	!=""))	if($_REQUEST)	$loadObject->_data[$methodName]["request"]	=	$_REQUEST;
						if($_FILES)	$loadObject->_data[$methodName]["files"]	=	$_FILES;
					}
			}
		//add data
		public function addData($dataArr=array(),$actionData="all",$methodName="",$escapeData=false,$page="")
			{
				$traceArray			=	debug_backtrace();
				$calledFunction		=	$traceArray["1"]["function"];
				if(trim($page))
					{
						$calledFunction		=	ucwords($methodName);
						$tempObj			=	loadModelClass(true,$page);
						$addObject			=	&$tempObj;	
					}
				else
					{
						if(trim($methodName))	$calledFunction		=	ucwords($methodName);
						$addObject		=	&$this;	
					}
				foreach($dataArr	as $addKey=>$addVal)
					{
						if($escapeData	==	true)	$addVal	=	mysql_real_escape_string($addVal);
						if(trim(strtolower($actionData))	==	"post")		$addObject->_data[$calledFunction]["post"][$addKey]		=	$addVal;
						if(trim(strtolower($actionData))	==	"get")		$addObject->_data[$calledFunction]["get"][$addKey]		=	$addVal;
						if(trim(strtolower($actionData))	==	"request")	$addObject->_data[$calledFunction]["request"][$addKey]	=	$addVal;
						if(trim(strtolower($actionData))	==	"files")	$addObject->_data[$calledFunction]["files"][$addKey]	=	$addVal;
						if(trim(strtolower($actionData))	==	"all")
							{
								$addObject->_data[$calledFunction]["post"][$addKey]		=	$addVal;
								$addObject->_data[$calledFunction]["get"][$addKey]		=	$addVal;
								$addObject->_data[$calledFunction]["request"][$addKey]	=	$addVal;
								$addObject->_data[$calledFunction]["files"][$addKey]	=	$addVal;									
							}
					}
				if(trim($page))	$this->setSessionObj($this->getClassNameByPageName($page),$addObject);
			}
		//retrieve data
		public function getData($actionData="all",$methodName="",$escapeData=false,$page="")
			{
				$traceArray			=	debug_backtrace();
				$calledFunction		=	$traceArray["1"]["function"];
				if(trim($methodName))	$calledFunction		=	ucwords($methodName);
				
				if(trim($page))
					{
						$calledFunction		=	$this->getClassNameByPageName($page).ucwords($methodName);
						$tempObj			=	loadModelClass(true,$page);
						$getObject			=	&$tempObj;	
					}
				else	$getObject	=	&$this;
				if($escapeData	==	true)
					{
						$temp	=	$getObject->_data[$calledFunction];
						if($temp)
							{
								$temp	=	$this->getRealEscapeData($temp);
								if(trim(strtolower($actionData))	==	"post")		$temp	=	$temp["post"];
								if(trim(strtolower($actionData))	==	"get")		$temp	=	$temp["get"];
								if(trim(strtolower($actionData))	==	"request")	$temp	=	$temp["request"];
								if(trim(strtolower($actionData))	==	"files")	$temp	=	$temp["files"];
								return	$temp;
							}	
					}
				else
					{
						if($getObject->_data[$calledFunction])	
							{
								$temp	=	$getObject->_data[$calledFunction];
								if(trim(strtolower($actionData))	==	"post")		$temp	=	$temp["post"];
								if(trim(strtolower($actionData))	==	"get")		$temp	=	$temp["get"];
								if(trim(strtolower($actionData))	==	"request")	$temp	=	$temp["request"];
								if(trim(strtolower($actionData))	==	"files")	$temp	=	$temp["files"];
								return	$temp;
							}
					}
					
				return array();
			}
		//clear Data
		public function clearData($methodName="",$actionData="all",$page="")
			{
				$traceArray			=	debug_backtrace();
				$calledFunction		=	$traceArray["1"]["function"];
				if(trim($page))
					{
						$calledFunction		=	ucwords($methodName);
						$tempObj			=	loadModelClass(true,$page);
						$clearObject		=	&$tempObj;	
					}
				else
					{
						if(trim($methodName))	$calledFunction		=	ucwords($methodName);
						$clearObject		=	&$this;
					}
				
				
				if(trim(strtolower($actionData))	==	"post")		unset($clearObject->_data[$calledFunction]["post"]);
				if(trim(strtolower($actionData))	==	"get")		unset($clearObject->_data[$calledFunction]["get"]);
				if(trim(strtolower($actionData))	==	"request")	unset($clearObject->_data[$calledFunction]["request"]);
				if(trim(strtolower($actionData))	==	"files")	unset($clearObject->_data[$calledFunction]["files"]);
				if(trim(strtolower($actionData))	==	"all")		unset($clearObject->_data[$calledFunction]);
				if(trim($page))	$this->setSessionObj($this->getClassNameByPageName($page),$clearObject);
			}
		
		//do all things when child distructed
		public function childKilled($obj)
			{
				if($this->childClass)	$this->setSessionObj($this->childClass,$obj);
				$this->checkRedirection();	
			}
		//session handling
		public function getSessionObj($className="")
			{
				if(trim($className))
					if($_SESSION["models"][$className])	
						return unserialize($_SESSION["models"][$className]);
					
				if($this->childClass)	
					if($_SESSION["models"][$this->childClass])	
						return unserialize($_SESSION["models"][$this->childClass]);
				
				return false;
			}
		public function saveMeNow($obj)
			{
				if($this->childClass)	$this->setSessionObj($this->childClass,$obj);
			}
		public function setSessionObj($className,$obj)
			{
				if($className)	
					{
						$_SESSION["models"][$className]	=	serialize($obj);
						if(count($_SESSION["models"])	>	$this->maxSessionCount)	
							array_shift($_SESSION["models"]);//removeing old sessions
					}
			}
		//before action execution
		public function actionToBeExecuted($loadData,$methodName,$action,$navigate,$sameParams,$newParams="",$excludParams="",$page="",$ufURL="")
			{
				$action			=	ucwords($action);
				if($loadData)		$this->loadData($methodName,$page);
				if($this->currentAction)	$this->previousAction	=	$this->currentAction;	
				$this->currentAction	=	$methodName;
				if($ufURL)					$this->redirectPage(constant("CONST_SITE_ADDRESS").$ufURL);
				//navigations
				if($navigate)	
					{
						$this->childKilled($this);
						$this->redirectPage($this->getLink($action,$page,$sameParams,$newParams,$excludParams));
					}
			}
		//after action execution
		public function actionExecuted()
			{
				//$this->childKilled($this);	
			}
		public function __destruct()
			{
				$this->childKilled($this);		
			}
		//returns prvious Action executed
		public function getCalledAction()
			{
				return $this->previousAction;
			}
		//creating link
		public function getLink($action="",$page="",$sameParams=true,$newParams="",$excludParams="")
			{
				if(!$page)		
					{
						$page	=	siteclass::getPageName();
						if(!$action)	$action	=	$this->currentAction;
					}
				elseif(!$action)	$action	=	$this->getDefaultAction();

				$action		=	ucwords($action);
				
				$tempstr	.=	$this->actionVar."=".$action;				
				
				if($sameParams	==	true)
					foreach($_GET as $key=>$val)	
						if ($key	<>	$this->actionVar)	
							$tempstr	.=	"&".$key."=".$val;		
					
				$tempstr	.=	"&".$newParams;
				$argArray		=	explode("&",$tempstr);

				$argArrayFinal	=	array();
				foreach($argArray	as $key=>$val)
					{
						$temp						=	explode("=", $val);
						$keyString					=	$temp[0];
						array_shift($temp);//throwing the first index
						if($temp)	$argArrayFinal[$keyString]	=	implode("=",$temp);//xyz.php?a=fgdg=dfhfh.. chance is there...!
						
					}
				if($excludParams)
					{
						$excludeArray	=	explode(",",$excludParams);
						foreach($excludeArray	as	$key=>$val)	unset($argArrayFinal[$val]);
					}
				foreach($argArrayFinal	as $key=>$val)	$argFinalStringArr[]	=	$key."=".$val;	
				return $argFinalString	=	$page."?".implode("&", $argFinalStringArr);
			}
		//just redirecting
		public function redirectPage($url)
			{
				if($url)
					{
						header("location:".$url);
						exit;		
					}
			}
		public function getHtmlData($arr,$exceptions=array())
			{
				if(!function_exists("callBackFngetHtmlData"))
					{
						function callBackFngetHtmlData(&$item, $key,$exceptions)
							{
								if($exceptions)	if(in_array($key, $exceptions))	return;
								$item	=	htmlentities($item);
							}
					}
				
				if(is_array($arr))
					{
						array_walk_recursive($arr,"callBackFngetHtmlData",$exceptions);
						return $arr;
					}
				else	return htmlentities($arr);
			}
		public function getRealEscapeData($arr,$exceptions=array())
			{
				if(!function_exists("callBackFngetRealEscapeData"))
					{
						function callBackFngetRealEscapeData(&$item, $key,$exceptions)
							{
								if($exceptions)	if(in_array($key, $exceptions))	return;
								$item	=	mysql_real_escape_string($item);
							}
					}
				if(is_array($arr))
					{
						array_walk_recursive($arr,"callBackFngetRealEscapeData",$exceptions);
						return $arr;
					}
				else	return mysql_real_escape_string($arr);
			}
		public function getstripData($arr,$exceptions=array())
			{
				if(!function_exists("callBackFnGetstripData"))
					{
						function callBackFnGetstripData(&$item, $key,$exceptions)
							{
								if($exceptions)	if(in_array($key, $exceptions))	return;
								$item	=	stripcslashes($item);
							}
					}
				if(is_array($arr))
					{
						array_walk_recursive($arr,"callBackFnGetstripData",$exceptions);
						return $arr;
					}
				else	return stripcslashes($arr);
			}
		public function setModelClassObject($page)
			{
				if($page)
					{
						if(!$this->getSessionObj($page))
							{
								$newObj		=	loadModelClass(false,$page);
								$className	=	$this->getClassNameByPageName($page);
								$this->setSessionObj($className,$newObj);
							}
					}
			}
		public function getNegativeSort($str)
			{
				if(!$str)	return "asc";
				elseif($str	==	"asc")	return "desc";
				else 					return "asc";	
			}
		//it will redirect the page to the specified URL after the specified action
		public function checkRedirection()
			{
				if(trim($_REQUEST[$this->redirectvar])	!=	"")
					{
						$this->redirectPage(trim($_REQUEST[$this->redirectvar]));
					}
			}
		//to access methods from the specified modelclass
		public function getModelAccess($page,$method,$args=array(),$indexArray=array())
			{
				$pageName	=	trim($page);
				$objnew		=	loadModelClass(true,$pageName);
				$methdName	=	$method;
				$argsArray	=	$args;
				if(!$argsArray)	$argsArray	=	array();
				$res		=	call_user_func_array(array($objnew,$methdName),$argsArray);
				$var		=	$indexArray;
				if($var){foreach($var as $key){	$temp[$key]	=	$res[$key];	}}
				if($temp) return $temp; else return $res;
			}
		public function executeAction($argsArray=array())
			{
				$defaultArray	=	array("loadData"=>false,"action"=>"","navigate"=>false,"sameParams"=>false,"newParams"=>"","excludeParams"=>"","page"=>"","ufURL"=>"");
				$mergedArray	=	array_merge($defaultArray, $argsArray);
				extract($mergedArray);
				if(trim($action))	$this->setAction($action);//forced action
				$classNameToBeCalled	=	end(pathinfo(siteclass::getPageName())).$this->classPostfix;
				$this->setClassName($classNameToBeCalled);
				$methodName	=		in_array($this->getMethodName(), get_class_methods($classNameToBeCalled))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
				$this->actionToBeExecuted($loadData,$methodName,$action,$navigate,$sameParams,$newParams,$excludeParams,$page,$ufURL);
				$this->actionReturn		=	call_user_func(array($this, $methodName));
				$this->actionExecuted($methodName);
				return $this->actionReturn;	
			}
		public function returnVal($value)
			{
				global $hookSessionName;
				$debugBackTrace	=	debug_backtrace();
				$fromClass		=	$debugBackTrace[1]["class"];
				$fromFunction	=	$debugBackTrace[1]["function"];
				
				foreach($hookSessionName as	$key=>$val)
					{
						if ($fromClass	==	$val["fromClass"]	&& $fromFunction	==	$val["fromFunction"])
							{
								if($val["toClass"])	$value	=	call_user_func(array($val["toClass"], $val["toFunction"]),$value);
								else				$value	=	call_user_func($val["toFunction"],$value);
							}
					}
				return $value;
			}
	}
?>
