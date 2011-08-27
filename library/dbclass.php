<?php
/*
 * @author	Sreeraj
 * @Date	25-10-2010
 * @file	dbclass.php	
 */
class sdbclass 
	{
		private $dbErrors	=	array();
		private $dbTrans	=	array();
		
		//fetching with conditions 
		public function getdbcontents_cond($table,$cond="1",$echo=false)
			{
				$fn_sql		=	"select * from $table where $cond";
				$fn_res		=	$this->db_query($fn_sql,$echo);
				$arrcnt		=	-1;
				$dataarr	=	array();
				while($temp	= mysql_fetch_assoc($fn_res))
					{
						foreach($temp	as $key=>$val)	$temp[$key]	=	stripslashes($val);
						$arrcnt++;
						$dataarr[$arrcnt]	=	$temp;
					}
				return $dataarr;
			}
		//fetching with query
		public function getdbcontents_sql($sql,$echo=false)
			{
				$fn_res		=	$this->db_query($sql,$echo);
				$arrcnt		=	-1;
				$dataarr	=	array();
				while($temp	= mysql_fetch_assoc($fn_res))
					{
						foreach($temp	as $key=>$val)	$temp[$key]	=	stripslashes($val);
						$arrcnt++;
						$dataarr[$arrcnt]	=	$temp;
					}
				return $dataarr;
			}
		//fetching with res
		public function getdbcontents_res($res)
			{
				$arrcnt		=	-1;
				$dataarr	=	array();
				while($temp	= mysql_fetch_assoc($res))
					{
						foreach($temp	as $key=>$val)	$temp[$key]	=	stripslashes($val);
						$arrcnt++;
						$dataarr[$arrcnt]	=	$temp;
					}
				return $dataarr;
			}
		//fetching without fieldname (using primary key)
		public function getdbcontents_id($table,$cond,$echo=false)
			{
				$tmpstr		=	$this->get_primarykey($table);
				if($tmpstr	<>	"")
					{
						if($cond == "")  $cond	= '1';
						else $cond	= "$tmpstr = '$cond'"; 			
						$fn_sql	=	"select * from $table where $cond";
						$fn_res		=	$this->db_query($fn_sql,$echo);
						$arrcnt		=	-1;
						$dataarr	=	array();
						while($temp	= mysql_fetch_assoc($fn_res))
							{
								foreach($temp	as $key=>$val)	$temp[$key]	=	stripslashes($val);
								$arrcnt++;
								$dataarr[$arrcnt]	=	$temp;
							}
					} 
				return $dataarr;
			}		
		//fetching a single field value with conditions
		public function getdbsinglevalue_cond($table,$field,$cond="1",$echo=false)
			{
				$sql	=	"select $field as fieldname from $table where $cond";
				$data	=	$this->getdbcontents_sql($sql,$echo);
				if($data)	return stripslashes($data[0]["fieldname"]);
				else		return false;
			}
		//fetching with condition
		public function getdbcount_cond($table,$cond="",$echo=false)
			{
		      	if($cond == "")  $cond	= '1';			
				$fn_sql		=	"select * from $table where $cond";
				$fn_res		=	$this->db_query($fn_sql,$echo);
				return mysql_num_rows($fn_res);
			}
		//fetching with query
		public function getdbcount_sql($sql,$echo=false)
			{
				$fn_res		=	$this->db_query($sql,$echo);
				return mysql_num_rows($fn_res);
			}
		//fetching with res
		public function getdbcount_res($res)
			{
				return mysql_num_rows($fn_res);
			}
		
		//sorting
		public function sortingRecords($table,$id,$nPVal,$preference="preference")
			{
				$curRow		=	$this->getdbcontents_id($table,$id);
				$pVal		=	$curRow[0][$preference];
				if(($pVal	!=	$nPVal)	&&	$nPVal	>	0)
					{
						if($curRow)
							{
								if($nPVal	>	$pVal)
									{
										$sql	=	"update $table set `$preference`=`$preference`-1 where $preference>$pVal and $preference<=$nPVal";
										$this->db_query($sql);
										
										$sql	=	"update $table set `$preference`='$nPVal' where $preference=$pVal and id='$id'";
										$this->db_query($sql);
									}
								else	
									{
										$sql	=	"update $table set `$preference`=`$preference`+1 where $preference < $pVal and 	$preference>=$nPVal";						
										$this->db_query($sql);
										
										$sql	="update $table set `$preference`='$nPVal' where $preference=$pVal and id='$id'";
										$this->db_query($sql);
									}
							}
						
					}
			}
		//inserting
		public function db_insert($table,$data=array(),$echo=false)
			{
				$this->clearDbErrors();
				if($data)
					{						
						$valObj		=	siteclass::create_php_validation();
						if($valObj->dbValidateArray($table,$data))
							{
								$valuesArr	=	array();
								foreach($data	as	$key=>$val)	
									{
										
										if(strtolower(substr($val,-6))	==	"escape" &&	strtolower(substr($val,0,6))	==	"escape")
											{
												$val			=	str_replace("escape","",strtolower($val));
												$valuesArr[] 	=	$val;	
											}
										else
											{
												$val	=	 mysql_real_escape_string($val);
												$valuesArr[] 	=	"'".$val."'";
											}
									}
								$keyData	=	array_keys($data);
								foreach($keyData	as $key=>$val)	$keyData[$key]	=	"`".trim($val)."`";
								$fields		=	implode(",",$keyData);
								$values		=	implode(",",$valuesArr);
								$sql		=	"insert into $table($fields) values($values)";
								$returnId	= 	($this->db_query($sql,$echo)) ? mysql_insert_id() : false;
								if($returnId)
									{
										$this->dbTrans[]	=	array("table"=>$table,"id"=>$returnId);
										return $returnId;
									}
								else
									{
										return false;
								}
							}
						else
							{
								$this->setDbErrors($valObj->getError());
								return false;
							}
					}
			}
		//updating
		public function db_update($tbname,$data=array(),$cond="1",$echo=false)
			{	
				$this->clearDbErrors();
				if($data)
					{
						$valObj		=	siteclass::create_php_validation();
						if($valObj->dbValidateArray($tbname,$data,$cond))
							{
								$valuesArr	=	array();
								foreach($data	as	$key=>$val)	
									{
										if(strtolower(substr($val,-6))	==	"escape" &&	strtolower(substr($val,0,6))	==	"escape")
											{
												$val			=	str_replace("escape","",strtolower($val));
												$valuesArr[] 	=	$val;	
											}
										else
											{
												$val	=	 mysql_real_escape_string($val);
												$valuesArr[] 	=	"'".$val."'";
											}
									}
								
								$keyData		=	array_keys($data);
								foreach($keyData	as $key=>$val)	$keyData[$key]	=	"`".trim($val)."`";
									
								$fields			=	$keyData;
								foreach($fields	as $key=>$val)	$newArr[]	=	$val."=".$valuesArr[$key];
								$upString		=	implode(",",$newArr);
								$updatequery	=	"update $tbname set $upString where $cond";
								$query       	= 	$this->db_query($updatequery,$echo);
								if($query)			return true;
							}
						else
							{
								$this->setDbErrors($valObj->getError());
								return false;
							}
					}
			}
		//query
		public function db_query($qry,$echo=false)
			{
				if($echo)	echo $qry;
				$res	=	mysql_query($qry);
				$this->setDbErrors(mysql_error());
				return $res;
			}
		//deleting query
		public function dbDelete_cond($table,$cond,$echo=false)
			{
		      	if($table	&&	 $cond)
			      	{				      		
						$fn_sql	=	"delete from $table where $cond";
						$fn_res		=	$this->db_query($fn_sql,$echo);
						return	true;
			      	}
			     return false;			
			}
		//To get the primary key of a table
		public function get_primarykey($table,$echo=false)
			{
				$result	=	$this->db_query("SELECT * FROM $table where 0",$echo);
				$num	=	mysql_num_fields($result);
				for($i=0;$i<$num;$i++)
					{
						if(strstr(mysql_field_flags($result, $i),"primary_key"))
							return mysql_field_name($result, $i);
					}
			}
		//delete all for checkboxes		
		public function db_delete_combo($tbname,$fieldname,$arr_checkone,$ret_field="",$echo=false)
			{
				$comma_separated = implode(",", $arr_checkone);
				if($ret_field	<>	"")
					{
						$gets		= 	$this->getdbcontents_cond($tbname,"$fieldname in($comma_separated)");
						$arr_cnt	=	-1;
						$ret_arr	=	array();	
						for($i=0;$i<count($gets);$i++)
							{
								$arr_cnt++;
								$ret_arr[$arr_cnt]	=	$gets[$i][$ret_field];
							}
					}
				$deletequery	= "delete from $tbname where $fieldname in($comma_separated)"; 
				if(!$queries    = $this->db_query($deletequery,$echo));				
				if($ret_field	<>	"")	return $ret_arr;
			}
		//setting errors
		public function setDbErrors($var)
			{
				if(is_array($var)	&&	$var)
					{
						foreach($var	as $val)
							$this->dbErrors[]	=	trim($val);		
					}
				elseif(trim($var))	
					{
						$this->dbErrors[]	=	trim($var);				
					}
			}
		//getting Db Errors
		public function getDbErrors()
			{
				return $this->dbErrors;
			}
		//clearing Db Errors
		public function clearDbErrors()
			{
				$this->dbErrors	=	array();
			}
		public function dbStartTrans()
			{
				$this->dbTrans	=	array();
			}
		public function dbClearTrans()
			{
				$this->dbTrans	=	array();
			}
		public function dbRollBack()
			{
				$delArray	=	$this->dbTrans;
				if($delArray)
					{
						foreach($delArray	as	$key=>$val)
							{
								$this->dbDelete_cond($val["table"],$this->get_primarykey($val["table"])."='".$val["id"]."'");	
							}	
					}
				$this->dbClearTrans();
			}
		public function checkfields($tablename,$field,$value,$returnfield)
			{
				$sql	=	"select * from $tablename where `$field`	=	'".mysql_real_escape_string($value)."'";
				$data	=	$this->getdbcontents_sql($sql);
				if($data)	return $data[0][$returnfield];
				else		return false;
			}
		public function dbChangeStatus($table,$statusFiled)
			{
				
			}
		public function getDbFields($table,$primaryKey=true)
			{
				$finalArray	=	array();
				$result		=	$this->db_query("SELECT * FROM $table where 0");
				$num		=	mysql_num_fields($result);
				for($i=0;$i<$num;$i++)
					{
						if(strstr(mysql_field_flags($result, $i),"primary_key"))
							{
								if($primaryKey)	$finalArray[]	=	mysql_field_name($result, $i);
							}
						else	$finalArray[]	=	mysql_field_name($result, $i);
					}
				return $finalArray;
		
			} 
		function populateDbArray($table,$dbArray)
			{
				$finalArray	=	array();
				$fieldsArr	=	$this->getDbFields($table,false);
				foreach($fieldsArr	as	$key=>$val)
					if(array_key_exists($val, $dbArray)) $finalArray[trim($val)]	=	$dbArray[trim($val)];
				return	$finalArray;			
			}
		function dbSearchCond($operator,$field,$value,$mysqlFun=false,$escapeData=true)
			{
				if($escapeData)
					{
						return $tempstr	=	" $field $operator ".$temp	=	($mysqlFun)?mysql_real_escape_string($value):"'".mysql_real_escape_string($value)."' "; 
					}
				else
					{
						return $tempstr	=	" $field $operator ".$temp	=	($mysqlFun)?$value:"'$value' ";
					}
				
			}
	}
?>
