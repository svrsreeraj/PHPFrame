<?php
/**
 * @author	Sreeraj 
 * @Date	from 20:7:2008
 * @file	siteclass.php 
 */
class siteclass extends sdbclass
	{
		public $pageError			=	""; 
		
		//method for paging
		function create_paging($varname,$tot_cnt,$per_page=10,$tot_links=10,$stable_links=3)
			{
				return 	new spaging2($varname,$tot_cnt,$per_page,$tot_links,$stable_links);
			}
		//method for uploading
		function create_upload($max_size=10,$files="")
			{
				return 	new upload($max_size,$files);
			}
		//method for xml Parsing
		function create_parse_xml($contents, $get_attributes=1) 
			{
				return 	new sxmlParse($contents, $get_attributes);
			}
		//create validation Class
		static function  create_php_validation()
			{
				return new phpValidation();
			}
		//method for paypal implementation
		function create_paypal_sd($email,$live=1)
			{
				return 	new paypal_sd($email,$live);
			}
		//method for sms api implementation
		function create_zni_sms($gb_userid,$gb_apikey,$gb_cdma,$gb_gsm,$gb_url)
			{
				return 	new znisms($gb_userid,$gb_apikey,$gb_cdma,$gb_gsm,$gb_url);
			}

			//to get trhe current page name
		public static function getPageName()
			{
				$scriptName		=	$_SERVER["SCRIPT_FILENAME"];
				$scriptArray	=	explode("/",$scriptName);
				return end($scriptArray);
			}
	   //to get trhe current page's query string
		public static function getPageQueryString()
			{
				$queryString		=	$_SERVER["QUERY_STRING"];
				return $queryString;
			}
		
		//concatenating arguments
		public static function getConcat()
			{
				$dat		=	func_get_args();
				$tempStr	=	"";	
				foreach($dat	as	$key=>$val)	$tempStr	.=	$val;
				return $tempStr;
			}

		//page error
		public function setPageError($var)
			{
				if(is_array($var))
					{
						foreach($var	as $val)	
							$this->pageError[]	=	trim($val);		
					}
				else	$this->pageError[]	=	trim($var);				
				
			}
		//page error
		public function getPageError()
			{
				return	$this->pageError;
			}
		//page error
		public function clearPageError()
			{
				$this->pageError	=	array();
			}
		
		//page error
		public function popPageError()
			{
				if($temp	=	$this->pageError)
					{
						$this->clearPageError();
						return implode("<br>", $temp);	
					}
				else
					return false;
			}
		function getMaxPreference($table,$cond="1",$preference="preference")
			{
				$sql					=	"SELECT  max($preference)+1 as pref FROM $table WHERE $cond";			
				$data					=	$this->getdbcontents_sql($sql);	
				$nxtVal					=	$data[0]['pref'];
				return $nxtVal;
			}
		
		function getSearchFilter($str)
			{
				$str	=	strtolower(trim($str));
				$str	=	str_replace("+"," ",$str);
				$compre	=	array(array("97","122"),array("48","57"),array("32","32"));
				$strcmp	=	$str;
				
				$len	=	strlen($str);
				for($i=0;$i<$len;$i++)
					{
						$temp	=	$strcmp[$i];
						$flag	=	0;
						foreach($compre	as	$key=>$val)
							{
								for($j=$val[0];$j<=$val[1];$j++)
									{
										if(ord($temp)	==	$j)	
											{
												$flag	=	1;
												break;
											}
									}
								if($flag	==	1)	break;
							}
						if($flag	==	0)	$str	=	str_replace($temp,"",$str);
					}
				return $str;
			}
		function getHtaccessFilter($str)
			{
				$str	=	$this->getSearchFilter($str);
				$str	=	str_replace(" ","+",$str);
				return $str;
			}	
				
		function getPercentage($amount,$total)
			{
				$saveAmt		=	$total - $amount;
				return $perc	=	($saveAmt * 100) / $total;				
			}
		function getTotalByPercentage($amount,$perc)
			{
				$saveAmt		=	($total * $perc)/100;
				return	  $total - $saveAmt;				
			}
				
		public static function getSortImage($fieldval1,$fieldval2,$type,$srcPrefix="")
			{
				if($fieldval1	==	$fieldval2)
					{
						if(strtolower($type	==	"asc"))		return "<img src='".$srcPrefix."images/downarrow.gif' border='0'>";
						if(strtolower($type	==	"desc"))	return "<img src='".$srcPrefix."images/uparrow.gif' border='0'>";
					}	
				return "";
			}	
		
		//date format in dd mon year hr:min
		function displayTime($date_value)
			{
				$arr	=	explode(" ",$date_value);
				$dt		=	explode("-",$arr[0]);
				$tm		=	explode(":",$arr[1]);
				return @date("d M Y h:i A",mktime($tm[0],$tm[1],$tm[0],$dt[1],$dt[2],$dt[0]));
			}
		//date format in dd mon year hr:min
		function displayDate($date_value)
			{
				if(!$date_value)	return	"";
				$arr	=	explode(" ",$date_value);
				$dt		=	explode("-",$arr[0]);
				if($arr[1])	$tm		=	explode(":",$arr[1]);
				return @date("d M Y",mktime($tm[0],$tm[1],$tm[0],$dt[1],$dt[2],$dt[0]));
			}
			
			//date format in  mon dd year hr:min
		function displayMonthFirst($date_value)
			{
				if(!$date_value)	return	"";
				$arr	=	explode(" ",$date_value);
				$dt		=	explode("-",$arr[0]);
				if($arr[1])	$tm		=	explode(":",$arr[1]);
				return @date("M d Y",mktime($tm[0],$tm[1],$tm[0],$dt[1],$dt[2],$dt[0]));
			}
				
		//date format in dd mon year hr:min
		function displayDbDate($date_value)
			{
				if(!$date_value)	return	"";
				$arr	=	explode(" ",$date_value);
				$dt		=	explode("-",$arr[0]);
				if($arr[1])	$tm		=	explode(":",$arr[1]);
				return @date("Y-m-d",mktime($tm[0],$tm[1],$tm[0],$dt[1],$dt[2],$dt[0]));
			}
		//firstday of month
		function firstOfMonth($month,$year) 
			{
				return date("Y-m-d", strtotime($month.'/01/'.$year.' 00:00:00'));
			}
		function lastOfMonth($month,$year) 
			{
				return date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime($month.'/01/'.$year.' 00:00:00'))));
			}
		function determine_age($dob)
			{
				$arr		=	explode("-",$dob);
				$birth_date	=	date("d F Y",mktime(0,0,0,$arr[1],$arr[2],$arr[0]));		
				$birth_date_time = strtotime($birth_date);
				$to_date = date('m/d/Y', $birth_date_time);
				 
				list($birth_month, $birth_day, $birth_year) = explode('/', $to_date);
				 
				$now = time();
				 
				$current_year = date("Y");
				 
				$this_year_birth_date = $birth_month.'/'.$birth_day.'/'.$current_year;
				$this_year_birth_date_timestamp = strtotime($this_year_birth_date);
				 
				$years_old = $current_year - $birth_year;
				 
				if($now < $this_year_birth_date_timestamp)
					{
						$years_old = $years_old - 1;
					}
				 
				return $years_old;
			}
			
		
		//limiting Text
		function getLimitedText($str,$limit=0,$moreChar="...")
			{
				$str	=	trim($str);				
				if($limit>0)
					{
						if(strlen($str)>$limit)	return substr($str,0,$limit).$moreChar;						
						else					return $str;
					}
				else	return $str;
					
			}
		//Display content in html for labels, text boxes
		function dispContent($str,$limit=0)
			{
				$entity	=	trim($str);
				return htmlentities($entity);
			}
		//Html will display as html
		function dispHTML($str)
			{
				$entity	=	trim($str);
				return nl2br($entity);
			}
		
		//stripslashes
		function stripslashes($str)
			{
				return stripslashes($str);
			}
		
		function comma2br($str)
			{
				$str	=	str_replace(",", "<br />", $str);
				return $str.",";
			}
		//nl2br
		function nl2br($str)
			{
				return nl2br($str);
			}
		//htmlentities
		function htmlentities($str)
			{
				$entity	=	ucfirst(stripslashes($str));
				return htmlentities($entity);
			}
		//Ucfirst
		function ucfirst($str)
			{
				return ucfirst($str);
			}
		//ucwords
		function ucwords($str)
			{
				return ucwords($str);
			}
		//print_r
		function print_r($str)
			{
			  echo "<pre/>";
			  print_r($str);
			}	
		
		//round
		function number_format($val,$decimals=0,$dec_point = '.',$thousands_sep = ',')
			{
				return number_format($val,$decimals,$dec_point,$thousands_sep);
			}
			
		//round
		function round($val,$num="0")
			{
				return round($val,$num);
			}
		//floor
		function floor($val)
			{
				return floor($val);
			}
		//ceil
		function ceil($val)
			{
				return ceil($val);
			}
		function urlencode($val)
			{
				return urlencode($val);
			}
			
		function get_fck($name,$val="")
			{
				$str	=	'<input type="hidden" id="'.$name.'" name="'.$name.'"
							 value="'.$val.'" style="display:none" />
							 <input type="hidden" id="'.$name.'___Config" value="" 
							 style="display:none" />
							 <iframe id="'.$name.'___Frame" 
							 src="../libs/FCKeditor/editor/fckeditor.html?InstanceName='.$name.'&amp;
							 Toolbar=Default" width="100%" height="400" 
							 frameborder="0" scrolling="no"></iframe>';
				return	$str;
			}	
		
							
		
		//this function will resize the image(jpg,gif,png,bmp,wbmp)
		function img_resize($widthtmp,$heighttemp,$src,$des)//this function will resize the image(jpg,gif,png,bmp,wbmp)
			{	
				$filename 	= 	$src;
				$dest_file 	= 	$des;
				$fnamerev	=	strrev($filename);
				$expfname	=	explode(".",$fnamerev);///for extension 
				$expfname1	=	$expfname[0];
				$filetype	=	strrev($expfname1);
				$ftype 		=	$filetype;
				$percent 	= 	0.5;
				
				$a			=	getimagesize($filename);// Get new sizes
				$old_w		=	$a[0];
				$old_h		=	$a[1];
				$new_w		=	$a[0];
				$new_h		=	$a[1];
			
				if($old_w	>	$widthtmp)
					{
						$new_w	=	$widthtmp; 
						$x		=	round(($new_w*100)/$old_w);
						$new_h	=	round($old_h*($x/100));
						$old_h	=	$new_h;
					}	
				if($old_h	>	$heighttemp)
					{		
						$new_h	=	$heighttemp;
						$x		=	round(($new_h*100)/$old_h);
						$new_w	=	round($new_w*($x/100)); 
					}
				list($width, $height) = getimagesize($filename);
							
				if(($a[0]>$widthtmp) or ($a[1]>$heighttemp))	$thumb 		= imagecreatetruecolor($new_w, $new_h);
				else											$thumb 		= imagecreatetruecolor($old_w, $old_h);
							
				if(strtolower($ftype)	==	'jpeg') $ftype="jpg";
				if(strtolower($ftype)	==	'bmp' )	$ftype="wbmp";
				
				if(strtolower($ftype)	==	'jpg' )	$source 	= imagecreatefromjpeg($filename);
				if(strtolower($ftype)	==	'gif' )	$source 	= imagecreatefromgif($filename);
				if(strtolower($ftype)	==	'png' )	$source 	= imagecreatefrompng($filename);
				if(strtolower($ftype)	==	'wbmp')	$source 	= imagecreatefromwbmp($filename);
		   
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_w, $new_h, $width, $height);// Resize
						
				if(strtolower($ftype)=='jpg')	imagejpeg($thumb, $dest_file); 
				if(strtolower($ftype)=='gif')	imagegif($thumb, $dest_file); 
				if(strtolower($ftype)=='png')	imagepng($thumb, $dest_file); 
				if(strtolower($ftype)=='wbmp')	imagewbmp($thumb, $dest_file); 
			}
		
			
		// name=> select box name,$arr=>data array,$valname=>value index name of arry,$dataname=> data index name of array, $selected => value to be selected,$params=> Extra params of select box(like class etc) 
		function get_combo_arr($name,$arr,$valname,$dataname,$selectd="",$params="",$name_change="Select")
			{
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}
				if(is_array($arr))
					{
						
						foreach ($arr as $key	=>	$val)
							{
								$val[$dataname]		=	stripslashes($val[$dataname]);
								
								if($selectd)
									{
										if($selectd	==	$val[$valname])
											$str		.=	"<option selected value='".$val[$valname]."'>".stripslashes($val[$dataname])."</option>";
										else
											$str		.=	"<option value='".$val[$valname]."'>".stripslashes($val[$dataname])."</option>";
									}
								else
									$str		.=	"<option value='".$val[$valname]."'>".$val[$dataname]."</option>";
							}
					}
				$str		.=	"</select>";
				return $str;
			}	
		//name=> select box name,$start=>starting number of series,$end=>ending number of series,$selected => value to be selected,$params=> Extra params of select box	
		function get_combo_int($name,$start,$end,$selectd="",$params="",$name_change="")
			{
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}
				for($i=$start;$i<=$end;$i++)
					{
						
						if($selectd	>=	0)
							{
								if($selectd	==	$i)		$str		.=	"<option selected value='".$i."'>".$i."</option>";
								else					$str		.=	"<option value='".$i."'>".$i."</option>";
							}
						else
							$str		.=	"<option value='".$i."'>".$i."</option>";
					}
				$str		.=	"</select>";
				return  $str;
			}
		//name=> select box name,$start=>starting number of series,$end=>ending number of series,$selected => value to be selected,$params=> Extra params of select box	
		function get_combo_list_array($name,$arr,$selectd="",$params="",$name_change="Select")
			{
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}
				for($i=0;$i<count($arr);$i++)
					{
						foreach ($arr[$i] as $key	=>	$val)
							{
								if($selectd	>=	0)
									{
										if($selectd	==	$key)
											$str		.=	"<option selected value='".$key."'>".stripslashes($val)."</option>";
										else
											$str		.=	"<option value='".$key."'>".stripslashes($val)."</option>";
									}
								else
									$str		.=	"<option value='".$key."'>".$val."</option>";
							}
					}
				$str		.=	"</select>";
				return  $str;
			}
		//for getting year
		function get_combo_year($name,$selectd="",$params="",$name_change="",$nos=95,$diffyear=0)
			{
			
				$endyr		=	date('Y')-$diffyear;
				$startyr	=	$endyr-$nos;
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}
				for($i = $startyr; $i <= $endyr; $i++ )
					{
						if($i	==	$selectd)	$str	.="<option value='$i' selected>$i</option>";
						else					$str	.="<option value='$i'>$i</option>";
					}
				$str		.=	"</select>";
				return  $str;
			}
		//for getting months
		function get_combo_months($name,$selectd="",$params="",$name_change="")
			{
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}		
				for($i=1;$i<=12;$i++)
					{
						if($i	==	$selectd)	$str	.="<option value='$i' selected>".date("F", mktime(0,0,0,$i+1,0,0))."</option>";
						else					$str	.="<option value='$i'>".date("F", mktime(0,0,0,$i+1,0,0))."</option>";
												
					}
				$str		.=	"</select>";
				return  $str;
			}
		//for multi selection dropdown
		function get_combo_multiple($name,$arr,$valname,$dataname,$selectd="",$params="",$name_change="")
				{
				
					$sel_arr	=	explode(",",$selectd);
					$co_arr		=	count($sel_arr);
					$str		=	"<select name='$name' $params multiple='multiple'>";
					if($name_change)
						{
							if($selectd	==	"")		$str		.=	"<option selected value='0'>".$name_change."</option>";
							else					$str		.=	"<option value='0'>".$name_change."</option>";	
						}
					if(is_array($arr))
						{
							
							foreach ($arr as $key	=>	$val)
								{
									$val[$dataname]		=	stripslashes($val[$dataname]);
									if($selectd)
										{
											$flag	=	0;
											for($a=0;$a<$co_arr;$a++)
											{
												if($val[$valname]==$sel_arr[$a])
												{
												$str		.=	"<option selected value='".$val[$valname]."'>".stripslashes($val[$dataname])."</option>";
												$flag		=	1;
												}	
											}
											if($flag!=1)
												$str		.=	"<option value='".$val[$valname]."'>".stripslashes($val[$dataname])."</option>";
											
										}
									else
										$str		.=	"<option value='".$val[$valname]."'>".$val[$dataname]."</option>";
								}
						}
					$str		.=	"</select>";
					return $str;
				}
	
		
		//Random string : excluded - o,0,1 and I
		function createRandom($no=6)
			 {
				$chars = "abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
				srand((double)microtime()*1000000);
				$i = 1;
				$pass = '' ;
				while ($i <= $no)
					{
						$num = rand() % 33;
						$tmp = substr($chars, $num, 1);
						$pass = $pass . $tmp;
						$i++;
					}			
				return $pass;
			 }
		//Random number : excluded - 0
		function createRandomNum($no=6)
			 {
				$chars = "123456789";
				srand((double)microtime()*1000000);
				$i = 1;
				$pass = '' ;
				while ($i <= $no)
					{
						$num = rand() % 9;
						$tmp = substr($chars, $num, 1);
						$pass = $pass . $tmp;
						$i++;
					}			
				return $pass;
			 }
		
		//Sending email as HTMl with files if any 
		function sendmail($to,$from,$subject,$message,$files="")
			{
				$headers 		= 	"From: $from";
				$semi_rand 		= 	md5(time());// boundary
				$mime_boundary 	= 	"==Multipart_Boundary_x{$semi_rand}x";

				// headers for attachment
				$headers 		.= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

				// multipart boundary
				$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
				$message .= "--{$mime_boundary}\n";
					
				if(is_array($files))// preparing attachments
					{
						for($x=0;$x<count($files);$x++)
							{
								$file 	=	fopen($files[$x],"rb");
								$data 	=	fread($file,filesize($files[$x]));
								$data 	=	chunk_split(base64_encode($data));
								$fname	=	end(explode("/",$files[$x]));
								fclose($file);
								$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$fname\"\n" .
											 "Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" .
											 "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
								$message .= "--{$mime_boundary}\n";
							}
					}
				$ok = @mail($to, $subject, $message, $headers);// send
				return $ok;
			}
		//zipFiles("xyz.zip",array("dir1","dir2"),array("file1","file2"));
		function zipFiles($zipname,$dir_arr,$file_arr)
			{
				$zip		= 	  new ZipArchive();   
				if($zip->open($zipname, ZIPARCHIVE::CREATE)	!=		TRUE)	exit("cannot open <$zipname>\n");
				
				$num_file	=	count($file_arr);
				for($i=0;$i<$num_file;$i++)		$zip->addFile($file_arr[$i]);
				$num_dir	=	count($dir_arr);	
				for($i=0;$i<$num_dir;$i++)
					{
						if(!is_dir($dir_arr[$i]))	return false;
						$files 		= 	  array();
						$dirs 		= 	  array($dir_arr[$i]);
						while(NULL	!==	($dir = array_pop( $dirs)))
							{
								if($dh = opendir($dir))
									{
										while(false	!==		($file	=	readdir($dh)))
											{
												if($file	==	'.' || $file	==	'..')	continue;
												$path = $dir . '/' . $file;
												if(is_dir($path))	$dirs[]		= 	$path;	
												else
													{
														$files[]	=	$path;
														$zip->addFile($path);
													}
											}	
										closedir($dh);
									}		
							}
					}
				$zip->close();
			}
		//removing an elemnt by searching its value
		function array_remove($arr,$value) 
			{
				return array_values(array_diff($arr,array($value)));
			}
				
		//checking whether the
		function isie()
			{
				if(strstr($_SERVER["HTTP_USER_AGENT"],"MSIE"))	return 1;
				else											return 0;
			}
		//server side validation - Email
		function validateEmail($email)
			{
				if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) return true;
				else return false;				
			}
			 
		//function to make CSV FILE		
		function getCsvFile($sql,$headArr,$fieldArr,$filename="ResultRecords")
			{
				ob_clean();
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment;Filename=".$filename.".csv");
				echo $this->getCSVQuotedArray($headArr);
				
				$result			=	$this->db_query($sql);
				$finalArray		=	array();
				while($dataObject = mysql_fetch_array($result)) 
					{	
						foreach($fieldArr as $key=>$val)
							{							
								 $resArr[$key] 	= 	stripslashes($dataObject[$val]);
							}
						echo $this->getCSVQuotedArray($resArr);
						unset($resArr);
					}
				exit;				
			}
		function getCSVQuotedArray($arr)
			{
				if(!function_exists('appendQuotes'))
					{
						function appendQuotes(&$item)
							{
								$item	=	'"'.$item.'"';
							}		
					}
					
				array_walk($arr,"appendQuotes");			
				return implode(",",$arr)."\n";		
			}

		//Status Change
		function statusChange($table,$id,$field="status")
			{
				if($id)
					{
						$status	 =	!$status;
						 $sql	 =	"update $table set `$field` = !($field) where id='$id'";
						return  $this->db_query($sql);
					}
			}			
			
		function permissionCheck($action,$redirect="")
			{
				$objCls		= 	new adminUser();
				return $objCls->permissionMenuCheck($action,$redirect);				
			}
		function getPopUpTable($headArray,$dataArray,$tWidth="100%",$params='class="listTablePopUp"')
			{
				foreach($headArray	as $key=>$val)	$tempTh	.=	"<th>".$val."</th>";
				if($tempTh)							$tempTh	=	'<tr align="center" valign="middle">'.$tempTh.'</tr>';
				
				$tempData	=	"";
				foreach($dataArray	as $key=>$val)
					{
						$tempTd	=	"";
						if(is_array($val))
							{
								foreach($val	as $key1=>$val1)	$tempTd	.=	"<td>".$val1."</td>";
								if($tempTd)	$tempData	.=	"<tr>".$tempTd."</tr>";	
							}
					}
				if(!$tempData)
					{
						$tempTd	=	"";
						foreach($dataArray	as $key=>$val1)			$tempTd	.=	"<td>".$val1."</td>";
						if($tempTd)	$tempData	.=	"<tr>".$tempTd."</tr>";
					}
				foreach($dataArray	as $key=>$val)	$tempTd	.=	"<td>".$val."</td>";
				$tempStr	=	'<table width="'.$tWidth.'" border="0" cellpadding="0" cellspacing="0" '.$params.'>
								'.$tempTh.$tempData.'										
								 </table>
								 ';
				$tempStr		=	str_replace("\n","",$tempStr);
				$tempStr		=	str_replace("\r","",$tempStr);
				$tempStr		=	str_replace('"','\"',$tempStr);
				$tempStr		=	str_replace('"','&quot;',$tempStr);
				return $tempStr;
			}
		function getRealEscapeData($arr,$exceptions=array())
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
		function mysqlDatetoPhp($newDate)
			{
				$newDate	=	explode(" ",$newDate);
				$date		=	$newDate[0];
				$time		=	$newDate[1];
				$dates		=	explode("-",$date);
				$times		=	explode(":",$time);
				return mktime($times[0],$times[1],$times[2],$dates[1],$dates[2],$dates[0]);
			}
		function getApplication()
			{ 
				$appln		=	$_SERVER['HTTP_USER_AGENT'];
				if(strstr($appln,'VOD IPHONE')) return 2;
				elseif(strstr($appln,'VOD ANDROID')) return 3;
				else return 1;
			}
		function getUSPhoneDisplay($phNumber)
			{
				$phNumber		=	strtolower($phNumber);
				if(strlen($phNumber)	==	10)
					{
						return  $newString	=	"(".substr($phNumber,0,3).") ".substr($phNumber,3,3)."-".substr($phNumber,6,4);
					}
				return $phNumber;
			}
		function array_replace_new($base,$new)
			{
				foreach($new	as $key=>$val)	$base[$key]	=	$val;
				return $base;
			}
	}	
//class for paging
class spaging2
	{
		public	$nextCaption			=	"<img alt='Next' title='Next' src='images/right_arrow.png' border='0'>";
		public	$prevCaption			=	"<img alt='Previous' title='Previous'  src='images/left_arrow.png'  border='0'>";
		public	$containerTag			=	"li";
		public	$containerLinkParams	=	"class='pagingLink'";
		public	$containerStatParams	=	"class='pagingStat'";
		public	$outerTag				=	"ul";
		public	$outerTagParams			=	"id='paging_ul'";
		public	$urlFformat				=	"<a href = 'xyz.php?{pageVarName}={pageVarValue}'>{pageNumberVlaue}</a>";	
		
		public $perpage					=	"";//number of records per page
		public $totcnt					=	"";//total number of records	private  $s_current_page	=	"";//current page
		public $s_stable_links			=	"";//stable links on the links
		public $s_total_links			=	"";//total links
		public $varname					=	"";//html variabe for paging
		public $sql						=	"";
		public $finalSql				=	"";
		public $limitStr				=	"";
		public $currentPage				=	"";
		public $pagingLinks				=	"";
		public $startingRow				=	"";
		
		
		function  __construct($varname,$sql,$per_page=10,$tot_links=10,$stable_links=3)
			{
				$this->set_per_page($per_page);
				$this->set_sql_tot_count($sql);
				$this->set_varname($varname);
				$this->set_total_links($tot_links);
				$this->set_stable_links($stable_links);
				$this->findURL();
				$this->finalSql	=	$this->finalSql();
				$this->setRow();
			}
		function set_sql_tot_count($sql)
			{
				global $cls_db;
				$this->sql	=	$sql;
				if(trim($sql))
					{
						$cnt		=	$cls_db->getdbcount_sql($sql);
						$this->set_tot_count($cnt);
					}
			}
		function setPagingVars($array)
			{
				foreach($array	as	$key=>$val)
					{
						$this->$key	=	$val;
					}
			}
		function setRow()
			{
				$this->startingRow	=	(($this->get_cur_page()*	$this->perpage)-$this->perpage)+1;
				$this->endingRow	=	($this->startingRow	+	$this->perpage)-1;
				if($this->totcnt	==	0)					$this->startingRow	=	0;
				if($this->totcnt	<	$this->endingRow)	$this->endingRow	=	$this->totcnt;
			}
		function finalSql()
			{
				return $this->sql.$this->s_get_limit();			
			}
		function findURL()
			{
				$fileName	= siteclass::getPageName();
				foreach($_GET as $key=>$val)	if ($key	<>	$this->varname)	$tempstr	.=	$key."=".$val."&";
				$urlFformat				=	"<a href = '$fileName?$tempstr{pageVarName}={pageVarValue}'>{pageNumberVlaue}</a>";
				$this->urlFformat		=	$urlFformat;
			}
		function getOpeningContainer($static=false)
			{
				if($static	==	true)
					{
						return "<".$this->containerTag." ".$this->containerStatParams.">";
					}
				else
					{
						return "<".$this->containerTag." ".$this->containerLinkParams.">";
					}
			}
		function getClosingContainer()
			{
				return "</".$this->containerTag.">";
			}		
		function getOpeningOuterTag()
			{
				return "<".$this->outerTag." ".$this->outerTagParams.">";
			}
		function getClosingOuterTag()
			{
				return "</".$this->outerTag.">";
			}		
		function getreplacedFormat()
			{
				$tempvar	=	$this->urlFformat;
				
				$tempvar	=	str_replace("{pageVarName}",$this->pageVarName,$tempvar);
				$tempvar	=	str_replace("{pageVarValue}",$this->pageVarValue,$tempvar);
				$tempvar	=	str_replace("{pageNumberVlaue}",$this->pageNumberVlaue,$tempvar);
				
				return 		$tempvar;		
			}
		//nextCaption
		function getNextCaption()
			{
				return	$this->nextCaption	;
			}
		function setNextCaption($str)
			{
				$this->nextCaption		=	$str;
			}
		//prevCaption
		function getPrevCaption()
			{
				return	$this->prevCaption	;
			}
		function setPrevCaption($str)
			{
				$this->prevCaption		=	$str;
			}
		//containerTag
		function getContainerTag()
			{
				return	$this->containerTag;
			}
		function setContainerTag($str)
			{
				$this->containerTag		=	$str;
			}
		//containerLinkParams
		function getContainerLinkParams()
			{
				return	$this->containerLinkParams;
			}
		function setContainerLinkParams($str)
			{
				$this->containerLinkParams	=	$str;
			}
		//containerStatParams
		function getContainerStatParams()
			{
				return	$this->containerStatParams;
			}
		function setContainerStatParams($str)
			{
				$this->containerStatParams	=	$str;
			}
		//urlFformat
		function getUrlFformat()
			{
				return	$this->urlFformat;
			}
		function setUrlFformat($str)
			{
				$this->urlFformat	=	$str;
			}
		function geturl($param,$sql)
			{
				if($param	==	"")	$param		=	"1-".$this->perpage;
				$params							=	explode("-",$param);
				$s_current_page_tmp				= 	$params["0"];
				$s_per_page						= 	$params["1"];
				$sql_limit						=	($s_per_page	*	$s_current_page_tmp)	-	$s_per_page;
				$sql_q							=	"$sql limit $sql_limit,$s_per_page";
				$res							=	mysql_query($sql_q);
				return $res;
			}
		private function s_get_nos($start,$end,$totnos)
			{
				$arraycount	=	-1;
				$arraycount++;
				$arr_data[$arraycount]	=	$start;
				$diff	=	($end-$start)/($totnos-1);
				for($i=1;$i<=$totnos-2;$i++)
					{
						$start	=	$start + $diff;
						if($start >=$end )$start	=	$end-1;
						if($arr_data[$arraycount]	>=	$end-1) $start	=	"";
						$arraycount++;
						$arr_data[$arraycount]	=	ceil($start);
					}
				$arraycount++;
				$arr_data[$arraycount]	=	$end;				
				return($arr_data);
			}
		function set_varname($name)
			{
				$this->varname	=	$name;				
			}
		function set_total_links($num)
			{
				$this->s_total_links	=	$num;
			}		
		function set_stable_links($num)
			{
				$this->s_stable_links	=	$num;
			}
		function set_per_page($num)
			{
				$this->perpage	=	$num;
			}
		function set_tot_count($num)
			{
				$this->totcnt	=	$num;
			}
		function s_get_limit()
			{
				$param	=	$_REQUEST[$this->varname];
				if($param	==	"")	$param	=	"1-".$this->perpage;
				$params						=	explode("-",$param);
				$s_current_page_tmp			= 	$params["0"];
				$s_per_page					= 	$params["1"];
				$sql_limit					=	($s_per_page	*	$s_current_page_tmp)	-	$s_per_page;
				$sql_q						=	" limit $sql_limit,$s_per_page";
				$this->limitStr				=	"$sql_limit,$s_per_page";
				return $sql_q; 
			}
		function get_cur_page()
			{
				$param	=	$_REQUEST[$this->varname];
				if($param	==	"")	$param	=	"1-0";
				$params		=	explode("-",$param);
				$s_current_page_tmp	= 	$params["0"];
				$s_per_page			= 	$params["1"];
				$this->currentPage	=	$s_current_page_tmp;
				return $s_current_page_tmp;
			}
		function get_per_page()
			{
				$param	=	$_REQUEST[$this->varname];
				if($param	==	"")	$param	=	"1-0";
				$params		=	explode("-",$param);
				$s_current_page_tmp	= 	$params["0"];
				$s_per_page			= 	$params["1"];
				$this->perPage	=	$s_per_page;
				return $s_per_page;
			}
		function s_get_links($format="")
			{
				$param					=	$_REQUEST[$this->varname];
				$s_current_page			=	$this->get_cur_page($params);
				$totcnt					=	$this->totcnt;
				$s_per_page				=	$this->perpage;
				$s_stable_links			=	$this->s_stable_links;
				$s_total_links			=	$this->s_total_links;
				$varname				=	$this->varname; 
				$s_total_rows			=	$totcnt;//getting total no of rows
				
				if($s_total_rows	==	0)	return "";//if no of total row is zero then the function will stop
				$s_arraycount	=	-1;//to increment array index
				
				//setting the start point of stavle link to sree_numbertostart_stable
				if(($s_numbertostart_stable	=	$s_current_page - intval($s_stable_links/2)) <= 0 ) $s_numbertostart_stable=1;

				//generating links order 	start:starting no of links, end ending no of links, totnos:total no of links
				if(ceil($s_total_rows/$s_per_page)<=$s_total_links)
					{
						for($i=1;$i<=ceil($s_total_rows/$s_per_page);$i++)
							{
								$s_arraycount++;
								$arr_data[$s_arraycount]	=	$i;
							}
						$varwait	=	$arr_data[(count($arr_data))-1];
					}
				else
					{
						$arr_data	=	$this->s_get_nos(1,ceil($s_total_rows/$s_per_page),$s_total_links);
						$varwait	=	$arr_data[(count($arr_data))-1];
						$s_flag	=	0;
						for($i=0;$i<count($arr_data);$i++)
							{
								if($s_flag	==	0)
									{
										if($varwait	==	$s_current_page)
											{
												for($j=1;$j<=$s_stable_links;$j++)
													{
														if($arr_data[(count($arr_data))-$j] <> "")
															{
																$arr_data[(count($arr_data))-$j] = $varwait-($j-1);
															}
														$s_flag				=	1;
													}	
												break;
											}
										if($arr_data[$i]	>=	$s_numbertostart_stable)
											{
												$s_assign_stabele	=	$i;
												$s_flag				=	1;
												for($j=1;$j<=$s_stable_links;$j++)
													{
														if($arr_data[$s_assign_stabele] <> "")
															{
																$arr_data[$s_assign_stabele] = $s_numbertostart_stable;
															}
														$s_numbertostart_stable++;
														$s_assign_stabele++;
													}
											}
									}
							}
					}
				//getting $_GET variables
				$tempstr	=	"";
				foreach($_GET as $key=>$val)
					if ($key	<>	$varname)	$tempstr	.=	$key."=".$val."&";
				if($tempstr)	$ex_params	=	"&".substr($tempstr,0,strlen($tempstr)-1);

				$arr_data[(count($arr_data))-1]	=	$varwait;	
				$flag	=	0;
				for($i=0;$i<count($arr_data);$i++)
					if($arr_data[$i]	==	$s_current_page)	$flag	=	1;
				
				if($flag	==	0)	$arr_data[(count($arr_data))-2]	=	$s_current_page;
				
				$Next		=	$this->nextCaption;
				$Previous	=	$this->prevCaption;
				
				for($i=0;$i<count($arr_data);$i++)
					{
						if($arr_data[$i] == $s_current_page)
							{
								$s_return_string	.=	$this->getOpeningContainer(true).$arr_data[$i].$this->getClosingContainer();
								continue;
							}
						if($arr_data[$i] <> "")	
							{
								$this->pageVarName		=	$varname;
								$this->pageVarValue		=	"$arr_data[$i]-$s_per_page";
								$this->pageNumberVlaue	=	"$arr_data[$i]";

								$s_return_string	.=		$this->getOpeningContainer().$this->getreplacedFormat().$this->getClosingContainer();
							}
					}
				if(end($arr_data)	<>	$s_current_page)
					{
						$s_current_page_tmp		=	$s_current_page+1;
						
						$this->pageVarName		=	$varname;
						$this->pageVarValue		=	"$s_current_page_tmp-$s_per_page";
						$this->pageNumberVlaue	=	$Next;

						$s_return_string		.=			$this->getOpeningContainer().$this->getreplacedFormat().$this->getClosingContainer();
					}
				if($arr_data[0]		<>	$s_current_page)
					{
						$s_current_page_tmp	=	$s_current_page-1;
						
						$this->pageVarName		=	$varname;
						$this->pageVarValue		=	"$s_current_page_tmp-$s_per_page";
						$this->pageNumberVlaue	=	$Previous;
						
						$s_return_string	=		$this->getOpeningContainer().$this->getreplacedFormat().$this->getClosingContainer().$s_return_string;
					}
				if(count($arr_data)	==	"1") return "";
				$tempVal	=	$this->getOpeningOuterTag().$s_return_string.$this->getClosingOuterTag();
				$this->pagingLinks	=	$tempVal;
				return($tempVal);
			}
	}
//class for uploading files
class upload
	{
		private $name		=	"";
		private $max_size	=	"";
		private $files		=	"";
		private $tmp_name	=	"";
		private $size		=	"";
		private $filename	=	"";
		private $error		=	"";
		private $des		=	"";
		private $upfile		=	"";
		
		function  __construct($max_size=10,$files="")
			{
				$this->set_max_size($max_size);
				$this->set_files($files);
			}
		public function  set_name($name)
			{
				$this->name	=	$name;
			}
		public function set_max_size($size_mb=10)
			{
				if($size	<=	0)	$size	=	10;//size in MB
				$this->max_size	=	$size * (1024 * 1024);
			}
		public function set_files($files)
			{
				$this->files	=	$files;
			}
		private function  set_error($err)
			{
				$this->error	=	$err;
			}
		public function  get_status()
			{
				if(!$this->error) return false;
				else return $this->error;
			}
		public function copy($filename,$des,$filetype="1",$name="")
			{
				//fileteype=1 for same file name,fileteype=2 for random file name
				$opath	=	$des;
				$path	=	$des;
				$this->set_error("");
				if(!$filename)	$this->set_error("Not a valid Filename");
				$this->name		=	$filename;
				$this->tmp_name	=	$_FILES[$filename]["tmp_name"];
				$this->size		=	$_FILES[$filename]["size"];
				$this->filename	=	$_FILES[$filename]["name"];
				$ext			=	pathinfo($this->filename);
				$ext			=	strtolower($ext["extension"]);

				if($this->size>$this->max_size)		$this->set_error("File size is too large!");
				$flag			=	1;
				if($this->files)
					{
						$arr_ext	=	array();
						$arr_ext	=	explode(",",$this->files);
						$flag		=	0;
						foreach ($arr_ext	as $val)	if(strtolower($val)	==	$ext)	$flag	=	1;
					}
				if($flag	!=	1)	$this->set_error("File Format is Invalid");
				if(!$this->error)
					{
						if($name)
							{
								$des	.=	"/".$name;
							}
						else
							{
								if($filetype	==	"1") $des	.=	"/".$this->name;
								if($filetype	==	"2")
									{
										$tmpfname = tempnam("$opath/","");
										rename($tmpfname,$tmpfname.".".$ext);
										$temp	=	explode("/",$tmpfname);
										$temp	=	end($temp);
										$des	.=	"/".$temp.".".$ext;
									}
							}
						if(copy($this->tmp_name,$des))
							{
								chmod("$des", 0755);
								$this->set_error("Copied Successfully");
								$temp		=	explode("/",$des);
								$this->des		=	$des;	
								$this->upfile	=	end($temp);
								return end($temp);				
							}
						else 
							{
								$this->set_error("Cannot Copy the file");
								return "0";	
							}
					}					
			}
		public function copy_spec($filename,$des,$index=0,$filetype="1",$name="")
			{
				//fileteype=1 for same file name,fileteype=2 for random file name
				$path	=	$des;
				$this->set_error("");
				if(!$filename)	$this->set_error("Not a valid Filename");
				$this->name		=	$filename;
				$this->tmp_name	=	$_FILES[$filename]["tmp_name"][$index];
				$this->size		=	$_FILES[$filename]["size"][$index];
				$this->filename	=	$_FILES[$filename]["name"][$index];
				$ext			=	pathinfo($this->filename);
				$ext			=	strtolower($ext["extension"]);

				if($this->size>$this->max_size)		$this->set_error("File size is too large!");
				$flag	=	1;
				if($this->files)
					{
						$arr_ext	=	array();
						$arr_ext	=	explode(",",$this->files);
						$flag		=	0;
						foreach ($arr_ext	as $val)	if(strtolower($val)	==	$ext)	$flag	=	1;
					}
				if($flag	!=	1)	$this->set_error("File Format is Invalid");
				if(!$this->error)
					{
						
						if($name)
							{
								$des	.=	"/".$name;
							}
						else
							{
								if($filetype	==	"1") $des	.=	"/".$this->name;
								if($filetype	==	"2")
									{
										$tmpfname = tempnam("$path/","");
										rename($tmpfname,$tmpfname.".".$ext);
										$temp	=	explode("/",$tmpfname);
										$temp	=	end($temp);
										$des	.=	"/".$temp.".".$ext;
									}
							}
						if(copy($this->tmp_name,$des))
							{
								chmod("$des", 0755);
								$this->set_error("Copied Successfully");
								$temp		=	explode("/",$des);
								if(end($temp)	==	"")	$temp		=	explode("\\",$des);
								$this->des		=	$des;	
								$this->upfile	=	end($temp);
								return end($temp);				
							}
						else 
							{
								$this->set_error("Cannot Copy the file");
								return "0";	
							}
					}					
			}
		public function img_resize($widthtmp,$heighttemp,$des="",$del="0")
			{
				if($src	==	"") $src	=	$this->des;
				if($des	==	"")	$des	=	$this->des;
				else			$des	.=	"/".$this->upfile;	
					
				$filename 	= 	$src;
				$dest_file 	= 	$des;
				$fnamerev	=	strrev($filename);
				$expfname	=	explode(".",$fnamerev);///for extension 
				$expfname1	=	$expfname[0];
				$filetype	=	strrev($expfname1);
				$ftype 		=	$filetype;
				$percent 	= 	0.5;
				
				$a			=	getimagesize($filename);// Get new sizes
				$old_w		=	$a[0];
				$old_h		=	$a[1];
				$new_w		=	$a[0];
				$new_h		=	$a[1];
			
				if($old_w	>	$widthtmp)
					{
						$new_w	=	$widthtmp; 
						$x		=	round(($new_w*100)/$old_w);
						$new_h	=	round($old_h*($x/100));
						$old_h	=	$new_h;
					}	
				if($old_h	>	$heighttemp)
					{		
						$new_h	=	$heighttemp;
						$x		=	round(($new_h*100)/$old_h);
						$new_w	=	round($new_w*($x/100)); 
					}
				list($width, $height) = getimagesize($filename);
							
				if(($a[0]>$widthtmp) or ($a[1]>$heighttemp))	$thumb 		= imagecreatetruecolor($new_w, $new_h);
				else											$thumb 		= imagecreatetruecolor($old_w, $old_h);
							
				if(strtolower($ftype)	==	'jpeg') $ftype="jpg";
				if(strtolower($ftype)	==	'bmp' )	$ftype="wbmp";
				
				if(strtolower($ftype)	==	'jpg' )	$source 	= imagecreatefromjpeg($filename);
		   		if(strtolower($ftype)	==	'gif' )	$source 	= imagecreatefromgif($filename);
		   		if(strtolower($ftype)	==	'png' )	$source 	= imagecreatefrompng($filename);
		   		if(strtolower($ftype)	==	'wbmp')	$source 	= imagecreatefromwbmp($filename);
		   
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_w, $new_h, $width, $height);// Resize
						
				if(strtolower($ftype)=='jpg')	imagejpeg($thumb, $dest_file); 
				if(strtolower($ftype)=='gif')	imagegif($thumb, $dest_file); 
				if(strtolower($ftype)=='png')	imagepng($thumb, $dest_file); 
				if(strtolower($ftype)=='wbmp')	imagewbmp($thumb, $dest_file); 
				
				if ($del	<>	"0")	unlink($this->des);
			}
		}
//class for paypal
class paypal_sd
	{
		private $email		=	"";
		private $live		=	"";
		private	$params		=	array();
		private $path		=	"";
			
		function  __construct($email,$live=1)
			{
				$this->email	=	$email;
				if($live)			$this->live		=	1;
				$this->path		=	$_SERVER["REQUEST_URI"];
				$this->add_arg("business",$this->email);
				$this->add_arg("return",$this->path);
				$this->add_arg("cancel_return",$this->path);
				$this->add_arg("no_note","1");
				$this->add_arg("currency_code","USD");
				$this->add_arg("lc","US");			
			}
		function add_arg($name,$value,$type="hidden")
			{
				$var_key	=	$this->isexist($name);
				if($var_key	==	"NA")
					$this->params[]	=	array("name"=>$name,"value"=>$value,"type"=>$type);
				else
					{
						$this->params[$var_key]["name"]		=	$name;
						$this->params[$var_key]["value"]	=	$value;
						$this->params[$var_key]["type"]		=	$type;
					}
			}
		private function isexist($name)
			{
				$flag	=	0;
				$flag2	=	0;
				foreach($this->params	as	$key	=>	$val)
					{
						if($val["name"]	==	$name) 
							{
								$flag	=	1;
								$flag2	=	$key;
								break;							
							}
					}
				if($flag)	return $flag2;
				else		return "NA";
			}
		function go($amt)
			{
				if($this->live)
					$action	=	"https://www.paypal.com/cgi-bin/webscr";
				else
					$action	=	"https://www.sandbox.paypal.com/webscr";
					
				$str	=	"<html><head><body><form name='paypal' action='$action' method='post'>";
				foreach($this->params	as	$key	=>	$val)
					{
						$str	.=	"<input type='".$val['type']."' name='".$val['name']."' value='".$val['value']."'>";
					}
				$str	.=	"</form><script>document.paypal.submit();</script></body></head></html>";
				ob_clean();
				echo $str;
			}
	}
//class for Sending SMS 
class znisms
	{
		private $gb_userid		=	"";
		private $gb_apikey		=	"";
		private $gb_cdma		=	"";
		private $gb_gsm			=	"";
		private $gb_url			=	"";	
		function  __construct($gb_userid,$gb_apikey,$gb_cdma,$gb_gsm,$gb_url)
			{
				$this->gb_userid	=	$gb_userid;
				$this->gb_apikey	=	$gb_apikey;
				$this->gb_cdma		=	$gb_cdma;
				$this->gb_gsm		=	$gb_gsm;
				$this->gb_url		=	$gb_url;
				
			}
		private function createsmsxml($rcvnos,$message)
			{
				$stringData =	'<?xml version="1.0" encoding="ISO-8859-1" ?>';
				$message	=	str_replace("×","x",$message);
				$message	=	str_replace("®","",$message);
				$message	=	str_replace("?","",$message);
				$message	=	str_replace("?","'",$message);
				$message	=	str_replace("?","'",$message);
				$message	=	str_replace("?","-",$message);
				$message	=	str_replace("?","...",$message);
				$message	=	str_replace("?","*",$message);
				$message	=	str_replace("?","'",$message);
				$message	=	str_replace("?","'",$message);
				$message	=	str_replace("?","",$message);
				$message	=	str_replace("¹","",$message);
				$message	=	str_replace("²","",$message);
				$message	=	str_replace("³","",$message);
				$message	=	str_replace("?","-",$message);
				$message	=	str_replace("â","",$message);
				$message	=	str_replace("?","",$message);
				$message	=	str_replace("?","",$message);
				// Assigning to attributes 
				$stringData	.=	"
								<push>
								<from>".$this->gb_userid."\$".$this->gb_apikey."</from>
								<gsm>".$this->gb_gsm."</gsm>
								<cdma>".$this->gb_cdma."</cdma>
								<message><![CDATA[$message]]></message>
								<mobileno>";
								
				foreach($rcvnos as $key	=>$val)	$stringData	.=	"<nos>$val</nos>";	
				$stringData	.=	"</mobileno></push>";	
				return 	$stringData;
				
				
			}
		public function sendsms($rcvnos,$message)
			{
				
				$xmlData	=	$this->createsmsxml($rcvnos,$message);
				$ch = curl_init();// create a new cURL resource
				curl_setopt($ch, CURLOPT_URL, $this->gb_url);// set URL and other appropriate options
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
				curl_exec($ch);// grab URL and pass it to the browser
				curl_close($ch);// close cURL resource, and free up system resources	
				return $ch;
			}	
			
	}
//XML Parsing
class sxmlParse
	{
		var $sxmlData	=	array();
		var $cXMLData	=	array();
		function  __construct($contents,$baseNode="") 
			{
				$get_attributes	=	1;
				if(!$contents) return array();
				
				if(!function_exists('xml_parser_create')) 
					{
						$this->sxmlData	= array();
						return;
					}
				$parser = xml_parser_create();
				xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
				xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
				xml_parse_into_struct( $parser, $contents, $xml_values );
				xml_parser_free( $parser );
				
				if(!$xml_values)
					{
						$this->sxmlData	= array();
						return;
					}
				
				//Initializations
				$xml_array 		= array();
				$parents 		= array();
				$opened_tags 	= array();
				$arr 			= array();
				$current 		= &$xml_array;
				
				//Go through the tags.
				foreach($xml_values as $data) 
					{
						unset($attributes,$value);
						extract($data);
						$result	=	'';
				
						if($get_attributes) 
							{
								$result = array();
								if(isset($value)) $result['value'] = $value;
				
								if(isset($attributes)) 
									{
										foreach($attributes as $attr => $val) 
											{
												if($get_attributes == 1) $result['attr'][$attr] = $val; 
											}
									}
							} 
						elseif(isset($value)) 
							{
								$result = $value;
							}
				
						if($type == "open") 
							{
								$parent[$level-1] = &$current;
								if(!is_array($current) or (!in_array($tag, array_keys($current)))) 
									{
										$current[$tag] 	= $result;
										$current 		= &$current[$tag];
									} 
								else 
									{ 
										if(isset($current[$tag][0])) 
											{
												array_push($current[$tag], $result);
											} 
										else 
											{
												$current[$tag] = array($current[$tag],$result);
											}
										$last		=	count($current[$tag]) - 1;
										$current	=	&$current[$tag][$last];
									}
							} 
						elseif($type == "complete") 
							{
								if(!isset($current[$tag])) 
									{
										$current[$tag] = $result;
									} 
								else 
									{
										if((is_array($current[$tag]) and $get_attributes == 0)	or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $get_attributes == 1)) 
											{
												array_push($current[$tag],$result);
											} 
										else 
											{
												$current[$tag] = array($current[$tag],$result);
											}
									}
				
							} 
						elseif($type == 'close') 
							{
								$current = &$parent[$level-1];
							}
					}
				$this->sxmlData	= $xml_array;
				if($baseNode)
					{
						if($this->sxmlData)//Finding baseNodeArray
							{
								$output			=	$this->walkXML($baseNode,$this->sxmlData);
								$this->cXMLData	=	$output;
							}
					}
			}
		
		function crawlXML($baseNode,$destNode)
			{
				$xData	=	$this->sxmlData;
				if($xData)//Finding baseNodeArray
					{
						$output	=	$this->walkXML($destNode,$this->walkXML($baseNode,$xData));
						return 	$output["value"];
					}
				else
					{
						return;
					}
			}
		function getData($destNode)
			{
				$output	=	$this->walkXML($destNode,$this->cXMLData);
				return 	$output["value"];
			}
		private function walkXML($path,$xData)
			{
				//exploding destination Tags
				$tempStr	=	explode(":",$path);
				$tempStr	=	explode("-",$tempStr[0]);
				if($tempStr)
					{
						$NodeArray	=	$xData;
						foreach($tempStr	as	$key=>$val)
							{
								$NodeArray	=	$NodeArray[$val];
							}
						
						//exploding destination attributes
						$tempStr	=	explode(":",$path);
						$tempStr	=	explode("-",$tempStr[1]);
						if(count($tempStr)	==	2)
							{
								if(!$NodeArray[0])	$NodeArray	=	array($NodeArray);
								foreach($NodeArray	as	$key=>$val)
									{
										if(strtolower(trim($val["attr"][$tempStr[0]]))	==	strtolower(trim($tempStr[1])))
											{
												$NodeArray	=	$val;
												break;
											}
									}
							}
					}
				return $NodeArray;
			}
	}
//Validations
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
				else			return true;
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
					//else return flase;			
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
