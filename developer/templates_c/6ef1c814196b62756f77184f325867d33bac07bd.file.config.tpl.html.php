<?php /* Smarty version Smarty-3.0.7, created on 2012-07-07 16:57:35
         compiled from "./templates/config.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:3961015054ff81d277ea522-13527446%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ef1c814196b62756f77184f325867d33bac07bd' => 
    array (
      0 => './templates/config.tpl.html',
      1 => 1341660454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3961015054ff81d277ea522-13527446',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_header(array('title'=>"Developer Basic Configurations"),$_smarty_tpl);?>


<style type="text/css" media="screen">
input[type=text]
	{
		min-width:300px;
	}
select
	{
		width:300px;
	}
.grayVal
	{
		text-align : left;
		color : #676767;
		font-size:12px;
	}
</style>

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>

<form action="" name="formName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
  	<td align="center">
    	<table width="90%" border="0" cellspacing="4" cellpadding="4">
    		<tr>
				<td colspan="2"><strong>Database Details</strong></td>
				<td width="30%" class="">Example</td>
			</tr>
    		<tr>
    			<td width="40%">Host</td>
    			<td><input type="text" name="const_db_host" id="id_txt_db_host" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_host','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">localhost</td>
    		</tr>
    		<tr>
    			<td>UserName</td>
    			<td><input type="text" name="const_db_username" id="id_txt_db_username" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_username','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">root</td>
    		</tr>
    		<tr>
    			<td>Password</td>
    			<td><input type="text" name="const_db_password" id="id_txt_db_password" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_password','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">123456</td>
    		</tr>
    		<tr>
    			<td>DataBase Name</td>
    			<td><input type="text" name="const_db_name" id="id_txt_db_name" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_name','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">MyDb</td>
    		</tr>
    		<tr>
    			<td>Table  Prefix</td>
    			<td><input type="text" name="const_db_table_prefix" id="id_txt_db_table_prefix" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_table_prefix','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">prefex_</td>
    		</tr>
    	</table>
    </td>
  </tr>
   <tr>
  	<td align="center">
    	<table width="90%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>Domain And File Paths</strong></td></tr>
    		<tr>
    			<td width="40%">Site Address</td>
    			<td><input type="text" name="const_site_address" id="id_txt_site_address" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_site_address','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">http://localhost/phpframe/</td>
    		</tr>
    		<tr>
    			<td>Absolutre site path</td>
    			<td><input type="text" name="const_site_absolute_path" id="id_txt_absolute_path" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_site_absolute_path','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">/var/www/phpframe/</td>
    		</tr>
    		
    	</table>
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<table width="90%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>TimeZones</strong></td></tr>
    		<tr>
    			<td width="40%">PHP TimeZone</td>
    			<td><input type="text" name="const_time_zone_php" id="id_txt_time_zone_php" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_time_zone_php','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">Asia/Culcatta</td>
    		</tr>
    		<tr>
    			<td>Mysql TimeZone (GMT)</td>
    			<td>
    	<?php echo smarty_function_get_conf_const(array('const'=>'const_time_zone_mysql','returnVar'=>'tempVal'),$_smarty_tpl);?>

    <select name="const_time_zone_mysql" id="id_txt_time_zone_mysql">
      <option value="">Select</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-12:00"){?> selected="selected" <?php }?> value="-12:00">(GMT -12:00) Eniwetok, Kwajalein</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-11:00"){?> selected="selected" <?php }?> value="-11:00">(GMT -11:00) Midway Island, Samoa</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-10:00"){?> selected="selected" <?php }?> value="-10:00">(GMT -10:00) Hawaii</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-9:00"){?> selected="selected" <?php }?> value="-9:00">(GMT -9:00) Alaska</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-8:00"){?> selected="selected" <?php }?> value="-8:00">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-7:00"){?> selected="selected" <?php }?>value="-7:00">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-6:00"){?> selected="selected" <?php }?>value="-6:00">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-5:00"){?> selected="selected" <?php }?>value="-5:00">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-4:00"){?> selected="selected" <?php }?>value="-4:00">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-3:30"){?> selected="selected" <?php }?>value="-3:30">(GMT -3:30) Newfoundland</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-3:00"){?> selected="selected" <?php }?>value="-3:00">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-2:00"){?> selected="selected" <?php }?>value="-2:00">(GMT -2:00) Mid-Atlantic</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="-1:00"){?> selected="selected" <?php }?>value="-1:00">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="0:00"){?> selected="selected" <?php }?>value="0:00">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="1:00"){?> selected="selected" <?php }?>value="1:00">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="2:00"){?> selected="selected" <?php }?>value="2:00">(GMT +2:00) Kaliningrad, South Africa</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="3:00"){?> selected="selected" <?php }?>value="3:00">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="3:30"){?> selected="selected" <?php }?>value="3:30">(GMT +3:30) Tehran</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="4:00"){?> selected="selected" <?php }?>value="4:00">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="4:30"){?> selected="selected" <?php }?>value="4:30">(GMT +4:30) Kabul</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="5:00"){?> selected="selected" <?php }?>value="5:00">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="5:30"){?> selected="selected" <?php }?>value="5:30">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="5:45"){?> selected="selected" <?php }?>value="5:45">(GMT +5:45) Kathmandu</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="6:00"){?> selected="selected" <?php }?>value="6:00">(GMT +6:00) Almaty, Dhaka, Colombo</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="7:00"){?> selected="selected" <?php }?>value="7:00">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="8:00"){?> selected="selected" <?php }?>value="8:00">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="9:00"){?> selected="selected" <?php }?>value="9:00">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="9:30"){?> selected="selected" <?php }?>value="9:30">(GMT +9:30) Adelaide, Darwin</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="10:00"){?> selected="selected" <?php }?>value="10:00">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="11:00"){?> selected="selected" <?php }?>value="11:00">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
      <option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="12:00"){?> selected="selected" <?php }?>value="12:00">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
</select>
    				
    		
    		
    		</td>
    		<td width="30%" class="grayVal">(GMT +5:30)</td>
    		</tr>
    		
    	</table>
    </td>
  </tr>
  <tr>
  	
  	<td align="center">
    	<table width="90%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>Miscellaneous</strong></td></tr>
    		<tr>
    			<td width="40%">Local Or Online</td>
    			<td>
    				<?php echo smarty_function_get_conf_const(array('const'=>'const_local_or_online','returnVar'=>'tempVal'),$_smarty_tpl);?>

    				<?php echo $_smarty_tpl->getVariable('sreeVariable')->value;?>

    				<select name="const_local_or_online" id="id_txt_local_or_online">
    					<option value="local">Select</option>
    					<option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="local"){?> selected="selected" <?php }?> value="local">local</option>
    					<option <?php if ($_smarty_tpl->getVariable('tempVal')->value=="online"){?> selected="selected" <?php }?> value="online">online</option>
    				</select>
    				
    				
    			</td>
    			<td width="30%" class="grayVal">local</td>
    		</tr>
    		
    		
    	</table>
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<table width="90%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>Project Details</strong></td></tr>
    		<tr>
    			<td width="40%">Project Name</td>
    			<td><input type="text" name="const_project_name" id="id_txt_project_name" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_project_name','returnVar'=>'tempVal'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('tempVal')->value;?>
"></td>
    			<td width="30%" class="grayVal">My Project</td>
    		</tr>
    	</table>
    </td>
  </tr>
  <tr>
  	<td align="center"><input type="submit" value="Submit" class='butsubmit' name="actionvar"></td>
  </tr>
  
</table>
</form>
      

<?php echo smarty_function_call_footer(array(),$_smarty_tpl);?>

