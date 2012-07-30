<?php
/**
 * @author	Anith 
 * @Date	from 20:7:2008
 * @file	phpValidations.php 
 */
//class for PHP Validation
class phpValidation
	{
		private $errorMsgs		=	array();
		private $errors			=	array();
		
		function  __construct($error=array())
			{
				$this->errorMsgs	=	$this->loadErrorMessages();				
			}
		function dbValidateArray($table,$dbarray,$cond="")
			{
				global $dBaseRules;
				$this->clearError();
				if(($rules	=	$dBaseRules[trim($table)])	&&	$dbarray)
					{
						foreach($dbarray	as 	$key=>$value)
							{	
								$passString		=	$value;	
								$validations	=	$rules[$key];
								$filedName		=	$key;
								if($validations)
									{
										foreach($validations	as 	$key=>$args)
											{
												$methodName		=	$args[0]?$args[0]:'';
												$minimumStr		=	$args[1]?$args[1]:'';
												$maximumStr		=	$args[2]?$args[2]:'';
												$errorMessage	=	$args[3]?$args[3]:'';
												if(method_exists($this,$methodName))
													{
														call_user_func_array(array($this, $methodName), array($passString,$minimumStr,$maximumStr,$errorMessage,$table,$filedName,$cond));
													}									
											}
									}		
							}
					}
				if(!$this->getError())	return true;
				else 					return false;
			} 
		function dbCheckMandatoryFields($table,$dbarray)
			{
				global $dBaseMandatory;
				$this->clearError();
				$checklFlag	=	true;
				if(($rules	=	$dBaseMandatory[trim($table)])	&&	$dbarray)
					{
						$toBeInsertedArr	=	array_keys($dbarray);
						$rulesKeysArr		=	array_keys($rules);

						foreach($rulesKeysArr as	$key=>$val)
							{
								if(!in_array($val,$toBeInsertedArr))
									{
										$checklFlag	=	false;
										break;
									}
								else
									{
										if(!$dbarray[$val])
											{
												$checklFlag	=	false;
												break;
											}
									}
							}
					}
				if(!$checklFlag)
					{
						$this->setError("$val is a mandatory field");
					}
				if(!$this->getError())	return true;
				else 					return false;
			} 
			
		function setError($err)
			{
				if(trim($err))	$this->errors[]	=	$err;
			}
		function getError()
			{
				return	$this->errors;
			}
		function clearError()
			{
				$this->errors	=	array();
			}
		//Validation Methods
	   function emptyCheck($str,$min="0",$max="0",$errMessage="")
			{
			
				if(trim($str == ""))	
					{
						if(trim($errMessage))	$this->setError($errMessage);
						else					$this->setError($this->getErrorMessage(__FUNCTION__));
						return false;
					}
				else
					{
						return $this->lengthCheck($str,$min,$max);	
					}
			}	
	 	function lengthCheck($str,$min="0",$max="0")
			{
				$flag		=	0;
				if($min <= strlen(trim($str)))
					{
						if($max <=0)	if(strlen(trim($str))>= $max) $flag=1 ;
						if($max != 0)	if(strlen(trim($str))<= $max) $flag=1;
					}				
				if($flag==0)	return false;
				else			return true;
			}
		
		//Validation Methods
	  	function nameCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag		=	0;
				$var		=	0;
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))	
							{
								if (preg_match('|^[a-zA-Z0-9 \'\&\_\-]*$|',$str))	$flag=1;
							}
						if($flag==0)		
							{
								if(trim($errMessage))$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;
							}
						return true;	
					}			
			}
		 function imageCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag		=	0;
				$var		=	0;
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))	
							{
								if (preg_match('|^[-_a-zA-Z0-9.]*$|',$str))	$flag=1;
							}
						if($flag==0)		
							{
								if(trim($errMessage))$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;
							}
						return true;	
					}			
			}
		function fnameCheck($str,$min="0",$max="0",$errMessage="")
				{
					$flag	=	0;					
					if(!empty($str) and !is_null($str))
						{								
							if($this->lengthCheck($str,$min,$max))	
								{
									if (preg_match('|^[-a-zA-Z ]*$|',$str))$flag=1;
								}							
							if($flag==0)		
								{
									if(trim($errMessage))	$this->setError($errMessage);
									else $this->setError($this->getErrorMessage(__FUNCTION__));
									return false;	
								}
							return true;	
						}			
				}
		function lnameCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag	=	0;					
				if(!empty($str) and !is_null($str))
					{								
						if($this->lengthCheck($str,$min,$max))	
							{
								if (preg_match('|^[-a-zA-Z ]*$|',$str))$flag=1;
							}							
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	

							}
						return true;	
					}			
			}
		function pageCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag	=	0;					
				if(!empty($str) and !is_null($str))
					{								
						if($this->lengthCheck($str,$min,$max))	
							{ 
								if (preg_match('|^[a-zA-Z\._\=?&]*$|',$str))	$flag=1;
									/*{
										$arr	=	explode(".",$str);
										if($arr[1] == "php")	$flag=1;
									}*/
							}							
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}			
			}
		function captionCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;	
				if(!empty($str) and !is_null($str))
					{					
						if($this->lengthCheck($str,$min,$max))
							{										
								if(preg_match('|^[0-9a-zA-Z _/\:\;\-\=\+\#\*\^\[\]\$!@%\(\)\'\"\&\,\.)]*$|',$str))	$flag	=	1;
							}				
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}	
				else return false;		
			}
		function emailCheck($str,$min="0",$max="0",$errMessage="")
			{			
				 $flag	=	0;				
				 if(!empty($str) and !is_null($str))
				 	{					
						if($this->lengthCheck($str,$min,$max))	
							{
								$rg = '#^([a-zA-Z0-9_\\-\\.]+)@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.)|(([a-zA-Z0-9\\-]'.
											  '+\\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$#';
								if(preg_match($rg,$str)) $flag	=	1;	
							}
			
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}			
			}
		function urlCheck($str,$min="0",$max="0",$errMessage="")
			{ 
				 $flag	=	0;				
				 if(!empty($str) and !is_null($str))
					 {
						if($this->lengthCheck($str,$min,$max))	
							{
								if(preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $str)) 
								$flag	=	1;	
							}
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}			
			}
		function usernameCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag	=	0;				
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))
							{
								if (preg_match('|^[a-zA-Z0-9\._-]*$|',$str))$flag	=	1;
							}					
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}						
			}
		function passwordCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))
							{
								if (preg_match('|^[0-9a-zA-Z _/\:\;\-\=\+\#\*\^\[\]\$!@%\(\)\'\"&\,\.)]*$|',$str))$flag	=	1;
							}				
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}		
				
			}
		function idCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;
				if(!empty($str) and !is_null($str))
					{					
						if($this->lengthCheck($str,$min,$max))
							{								
								if($str > 0 and $str!='')
									{										
										if (!preg_match('/[^0-9\]+$/',$str))	$flag	=	1;
									}
							}
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						else return true;						
					}	
				else return flase;			
			}
		function numberCheck($str,$min="0",$max="0",$errMessage="")
			{			
				$flag=0;				
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))
							{
								if($str > 0 and $str!='')
									{
										if (preg_match('|^[0-9]*$|',$str))	$flag	=	1;
									}								
							}
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}	
						else return true;
					}					
				
			}
		function randomcodeCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))
							{
								if (preg_match('|^[a-zA-Z0-9]*$|',$str))$flag	=	1;
							}
						
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}	
						return true;	
					}				
			}
		function floatCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;				
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))
							{
								if (preg_match('|^[0-9\.]*$|',$str))$flag	=	1;
							}
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}	
						return true;	
					}					
			}
		function negativeFloatCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;				
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))
							{
								if (preg_match('|^[0-9\.-]*$|',$str))$flag	=	1;
							}
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}	
						return true;	
					}					
			}
		function addressCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;				
				if(!empty($str) and !is_null($str))
					{					
						if($this->lengthCheck($str,$min,$max))
							{										
								if(preg_match('|^[a-zA-Z0-9\s\:\;\.\-\,/\#\'\"\_]*$|',$str))	$flag	=	1;
							}				
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}			
			}
		function quantityCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;				
				if(!empty($str) and !is_null($str))
					{				
						if($this->lengthCheck($str,$min,$max))
							{
								if(preg_match('|^[0-9]*$|',$str))	$flag	=	1;
							}					
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}			
			}		
		function priceCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;				
				if(!empty($str) and !is_null($str))
					{				
						if($this->lengthCheck($str,$min,$max))
							{
								if(preg_match('|^[0-9.]*$|',$str))	$flag	=	1;
							}					
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}			
			}	
		function descriptCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;					
				if(!empty($str) and !is_null($str))
					{					
						if($this->lengthCheck($str,$min,$max))
							{
								//if(preg_match('|^[0-9a-zA-Z _/\!\:\'\"\-\(\)\#\$\;()]*$|',$str))	
								$flag	=	1;
							}
						if($flag==0)		
							{
							if(trim($errMessage))	$this->setError($errMessage);
							else $this->setError($this->getErrorMessage(__FUNCTION__));
							return false;	
							}					
						return true;	
					}			
			}

		function datetimeCheck($str,$min="0",$max="0",$errMessage="")
			{
				$flag=0;					
				if(!empty($str) and !is_null($str))
					{					
						if($this->lengthCheck($str,$min,$max))
							{
								 $pattern = "/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/";
								 if (preg_match($pattern,$str, $match)) 
									 {
        								if (checkdate($match[2], $match[3], $match[1])) 	$flag	=	1;
   									 } 
							}
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}			
			}

		function dateCheck($str,$min="10",$max="10",$errMessage="")
			{
				$flag=0;
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))
							{								
								$pattern = '/\.|\/|-/i';    // . or / or -
								preg_match($pattern, $str, $char);								
								$array = preg_split($pattern, $str, -1, PREG_SPLIT_NO_EMPTY);								
								
								// yyyy-mm-dd    # iso 8601
								if(strlen($array[0]) == 4 && $char[0] == "-")
									{
										$month		= $array[1];
										$day 		= $array[2];
										$year 		= $array[0];
									}
								if(checkdate($month, $day, $year))	$flag	=	1;								
							}
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}	
						return true;	
					}			
			}
			

		function messageCheck($str,$min="0",$max="0",$errMessage="")
			{			
				$flag=0;			
				if(!empty($str) and !is_null($str))
					{
						if($this->lengthCheck($str,$min,$max))
							{	
								if(preg_match('|^[a-zA-Z0-9 \,\.\!_-\(\)&$"%]*$|',$str))	$flag	=	1;
							}
						if($flag==0)		
							{
								if(trim($errMessage))	$this->setError($errMessage);
								else $this->setError($this->getErrorMessage(__FUNCTION__));
								return false;	
							}
						return true;	
					}			
			}
		function uniqueCheck($str,$min="0",$max="0",$errMessage="",$table="",$field="",$cond="")
			{
				global $cls_db;
				if(trim($table)	&&	trim($field)	&&	$cond)//updating
					$sql	=	"select * from $table where `$field`='$str' and !($cond)";
				else//inserting
					$sql	=	"select * from $table where `$field`='$str'";
			
				if($cls_db->getdbcount_sql($sql))
					{
						if(trim($errMessage))	$this->setError($errMessage);
						else $this->setError($this->getErrorMessage(__FUNCTION__));	
						return false;
					}
				return true;
			}
		function getErrorMessage($func)
			{
				return $this->errorMsgs[$func];
			}		
		function loadErrorMessages()
			{	
				$errorMsgArr						=	array();
				$errorMsgArr["nameCheck"]			=	"Please enter a valid name";
				$errorMsgArr["imageCheck"]			=	"Please enter a valid image";
				$errorMsgArr["fnameCheck"]			=	"Please enter a valid first name";
				$errorMsgArr["lnameCheck"]			=	"Please enter a valid last name";
				$errorMsgArr["pageCheck"]			=	"Please enter a valid page name";
				$errorMsgArr["captionCheck"]		=	"Please enter a valid caption";
				$errorMsgArr["emailCheck"]			=	"Please enter a valid email";
				$errorMsgArr["urlCheck"]			=	"Please enter a valid url";
				$errorMsgArr["usernameCheck"]		=	"Please enter a valid username";
				$errorMsgArr["passwordCheck"]		=	"Please enter a valid password";
				$errorMsgArr["idCheck"]				=	"Please enter a valid id";
				$errorMsgArr["numberCheck"]			=	"Please enter a valid number";
				$errorMsgArr["randomcodeCheck"]		=	"Please enter a valid code";
				$errorMsgArr["floatCheck"]			=	"Please enter a valid value";
				$errorMsgArr["negativeFloatCheck"]	=	"Please enter a valid value";
				$errorMsgArr["addressCheck"]		=	"Please enter a valid address";
				$errorMsgArr["quantityCheck"]		=	"Please enter a valid quantity";
				$errorMsgArr["priceCheck"]			=	"Please enter a valid price";
				$errorMsgArr["descriptCheck"]		=	"Please enter a valid description";
				$errorMsgArr["messageCheck"]		=	"Please enter a valid message";
				$errorMsgArr["datetimeCheck"]		=	"Please enter a valid date time";
				$errorMsgArr["dateCheck"]			=	"Please enter a valid date";
				$errorMsgArr["emptyCheck"]			=	"Please enter a data";
				$errorMsgArr["uniqueCheck"]			=	"Data is already exists";
				return $errorMsgArr;
			}
	}
?>
