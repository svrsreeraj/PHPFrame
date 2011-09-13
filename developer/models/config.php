<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-10-12
Purpose    :Admin Home Model Page
******************* *******************************************************************/
class config extends modelclass 
	{
		public $configPath	=	"../config.inc.php";
		public $lineBreak	=	"\r\n";
		public $bcpDirs		=	"../Backup/Config";
		
		public function configListing()
			{
				if(is_file($this->configPath))	require_once $this->configPath;
			}
		public function configSubmit()
			{
				if(is_dir($this->bcpDirs)	&&	is_file($this->configPath)) 
					{
						copy($this->configPath, $this->bcpDirs."/config.inc.".strtotime("now").".php");
					}
				$data	=	$this->getData("post");
				$fp 	= 	fopen($this->configPath, 'w');
				fwrite($fp, $this->configGetHeader());
				fwrite($fp, $this->configGetProcessedValues($data,$exceptions=array("actionvar")));
				fwrite($fp, $this->configGetFooter());
				fclose($fp);
				$this->executeAction($loadData=false,$action="Listing",$navigate=true);
			}
		public function configGetHeader()
			{
				$string	.=	"<?php" . $this->lineBreak;
				$string	.=	"/**********************************************************************" . $this->lineBreak;
				$string	.=	"Author - System" . $this->lineBreak;
				$string	.=	"Date - " .  date('l jS \of F Y h:i:s A').$this->lineBreak;
				$string	.=	"Purpose - Main configuration file" . $this->lineBreak;
				$string	.=	"**********************************************************************/" . $this->lineBreak;
				return $string;
			}
		public function configGetFooter()
			{
				$string	.=	"?>";
				return $string;
			}
		public function configGetProcessedValues($data,$exceptions=array())
			{
				foreach ($data as $key=> $val)
					{
						if(!in_array(trim($key), $exceptions))
							if(trim($val))	$string	.=	"define('".strtoupper(trim($key))."','". trim($val)."');". $this->lineBreak;
							else			$string	.=	"define('".strtoupper(trim($key))."','". "" ."');". $this->lineBreak;
					}
				return $string;
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
