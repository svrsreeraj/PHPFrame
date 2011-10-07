<?php
/**************************************************************************************
 Created by :Sreeraj
 Created on :2011-10-12
 Purpose    :Admin Home Model Page
 ******************* *******************************************************************/
class configModel extends modelclass
	{
		public $configPath			=	"../config.inc.php";
		public $lineBreak			=	"\r\n";
		public $bcpDirs				=	"../Backup/Config";
		public $byProductsConst		=	array();
		public $adminPanel			=	"adminpanel";
		public $adminPanelModules	=	"modules";
	
		public function Listing()
			{
				if(is_file($this->configPath))	require_once $this->configPath;
			}
		public function Submit()
			{
				if(is_dir($this->bcpDirs)	&&	is_file($this->configPath))
					{
						copy($this->configPath, $this->bcpDirs."/config.inc.".strtotime("now").".php");
					}
				
				siteclass::addHook(array("fromClass"=>"configModel","fromFunction"=>"GetFooter","toClass"=>"siteclass","toFunction"=>"testHook"));
				
				$data	=	$this->getData("post");
				
				$fp 	= 	fopen($this->configPath, 'w');
				fwrite($fp, $this->GetHeader());
				fwrite($fp, $this->GetProcessedValues($data,$exceptions=array("actionvar")));
				fwrite($fp, $this->GetProcessedValues($this->byProductsConst));
				fwrite($fp, $this->GetFooter());
				fclose($fp);
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
			}
		public function GetHeader()
			{
				$string	.=	"<?php" . $this->lineBreak;
				$string	.=	"/**********************************************************************" . $this->lineBreak;
				$string	.=	"Author - System" . $this->lineBreak;
				$string	.=	"Date - " .  date('l jS \of F Y h:i:s A').$this->lineBreak;
				$string	.=	"Purpose - Main configuration file" . $this->lineBreak;
				$string	.=	"**********************************************************************/" . $this->lineBreak;
				return $string;
			}
		public function GetFooter()
			{
				$string	.=	"?>";
				return $this->returnVal($string);
			}
		public function GetProcessedValues($data,$exceptions=array())
			{
				foreach ($data as $key=> $val)
					{
						if(!in_array(trim($key), $exceptions))
						if(trim($val))	$string	.=	"define('".strtoupper(trim($key))."','". $this->OverRideValue(trim($key),trim($val))."');". $this->lineBreak;
						else			$string	.=	"define('".strtoupper(trim($key))."','". "" ."');". $this->lineBreak;
					}
				$string	.=	$this->lineBreak.$this->lineBreak;
				return $string;
			}
		public function OverRideValue($key,$value)
			{
				switch (trim(strtoupper($key)))
					{
						case "CONST_SITE_ADDRESS":
							$userHost	=	trim($value);
							$userHost	=	str_replace("http://","", $userHost);
							$userHost	=	str_replace("https//","", $userHost);
							if($pos = strpos($userHost, "/"))	$userHost	=	substr($userHost,0,$pos);
								
							$this->byProductsConst["CONST_SITE_ADDRESS_HOST"]		=	$userHost;
								
							$value	=	strrev(trim($value));
							if($value{0}	!=	"/")	$value	=	strrev($value)."/";
							else 						$value	=	strrev($value);
							
							$this->byProductsConst["CONST_SITE_ADMIN_ADDRESS"]		=	$value.$this->adminPanel."/";
							$this->byProductsConst["CONST_SITE_ADMIN_MODULE_ADDRESS"]		=	$value.$this->adminPanel."/".$this->adminPanelModules."/";
							
							return $value;
							break;
						case "CONST_SITE_ABSOLUTE_PATH":
							$userAbs	=	trim($value);
							$userAbsFromUser	=	strrev($userAbs);
							if($userAbsFromUser{0}	!=	DIRECTORY_SEPARATOR)	$userAbsFromUser	=	strrev($userAbsFromUser).DIRECTORY_SEPARATOR;
							else 												$userAbsFromUser	=	strrev($userAbsFromUser);
							return $userAbsFromUser;
							break;
						case "CONST_LOCAL_OR_ONLINE":
							if (strtolower(trim($value)) != "local"	&&	strtolower(trim($value)) != "online")	$value	=	"local";
							else	$value 	=	strtolower(trim($value));
							$this->byProductsConst["WHERE_AM_I"]		=	$value;
							return $value;
							break;
					}
				return $value;
			}
	}
