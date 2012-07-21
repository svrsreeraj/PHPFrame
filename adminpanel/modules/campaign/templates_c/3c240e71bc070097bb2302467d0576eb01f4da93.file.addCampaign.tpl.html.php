<?php /* Smarty version Smarty-3.0.7, created on 2012-07-21 16:52:43
         compiled from "./templates/addCampaign.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1597305031500a9103976e63-20930661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c240e71bc070097bb2302467d0576eb01f4da93' => 
    array (
      0 => './templates/addCampaign.tpl.html',
      1 => 1342430627,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1597305031500a9103976e63-20930661',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Campaign"),$_smarty_tpl);?>


<script type="text/javascript">
$(document).ready(function(){
	$("#content").tooltip();
	$("#grp").tooltip();
	$("#camp").tooltip();	
	$("#addbtn").tooltip();	
	$("#srchbtn").tooltip();	
	$("#rstbtn").tooltip();	
	$("#tusrs").tooltip();	
	$("#tzip").tooltip();
	$("#tdis").tooltip();
	
	$("#txt_join_from").datepicker();
	$("#txt_join_from").datepicker('option',
	{
		showAnim:'show',
		dateFormat:'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: '+1M +10D',
		showOtherMonths: true, 
		selectOtherMonths: true,
		//yearRange:'c-50:c+10',
		autoSize:false
	});

$("#txt_join_to").datepicker();
	$("#txt_join_to").datepicker('option',
	{
		showAnim:'show',
		dateFormat:'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: '+1M +10D',
		showOtherMonths: true, 
		selectOtherMonths: true,
		//yearRange:'c-50:c+10',
		autoSize:false
	});

});
</script>

<script type="text/javascript" src="{$smarty.const.CONST_SITE_ADDRESS}js/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="{$smarty.const.CONST_SITE_ADDRESS}js/highslide/highslide.css" />
<link type="text/css" href="{$smarty.const.CONST_SITE_ADDRESS}js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="{$smarty.const.CONST_SITE_ADDRESS}js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="{$smarty.const.CONST_SITE_ADDRESS}js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="{$smarty.const.CONST_SITE_ADDRESS}js/ui/ui/jquery.ui.datepicker.js"></script>

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>
<form action="" name="fromName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }?>
<tr>
	<td class="pageHead"><span id="content"><strong><?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>Edit<?php }?><?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")){?>Add<?php }?> Campaign </strong></span></td>
</tr>
<!--<?php echo print_r($_smarty_tpl->getVariable('actionReturn')->value['data']['image']);?>
;exit;-->
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"||$_smarty_tpl->getVariable('obj')->value->currentAction=="Copyform")){?>
<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
			
				<th colspan="2">Edit Campaign</th>
			</tr>
			<tr>
				<td width="100px"><span id ="grp">Group</span></td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo']['addsCategory'];?>
</td>
			</tr>
			<tr>
				<td><span id ="camp">Name </span> </td>
				<td><input type="text" name="name" valtype="emptyCheck-please enter a name" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
"></td>
			</tr>
			
			<tr>
				<td>Description </td>
				<td><textarea rows="10" cols="60" valtype="emptyCheck-please enter Description"  name="description"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['description'];?>
</textarea></td>
			</tr>
			
			<tr>			
				<td>Start Date </td>
				<td><input type="text" valtype="emptyCheck-please enter start date" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['start_date'];?>
" name="start_date" class="dateTextBox" id="txt_join_from" readonly="" ></td>
			</tr>
			
			<tr>
				<td>End Date</td>
				<td><input type="text" valtype="emptyCheck-please enter end date" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['end_date'];?>
" name="end_date" class="dateTextBox"  id="txt_join_to" readonly="" /></td>
			</tr>
			
			<tr>
				<td><span id ="tusrs">Target User Ids </span></td>
				<td><textarea name="target_users"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['target_users'];?>
</textarea> </td>
			</tr>
			<tr>
				<td><span id ="tzip">Target Zip Codes</span></td>
				<td><textarea name="target_zip" ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['target_zip'];?>
</textarea></td>
			</tr>
			<tr>
				<td>Target Latitude </td>
				<td><input type="text" name="target_latitude" size="100" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['target_latitude'];?>
"></td>
			</tr>
			<tr>
				<td>Target Longitude </td>
				<td><input type="text" name="target_longitude" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['target_longitude'];?>
"></td>
			</tr>
			<tr>
				<td><span id ="tdis">Target Distance </span></td>
				<td><input type="text" name="target_distance" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['target_distance'];?>
"></td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
					
					<input type="submit" valcheck="true"  class="butsubmit"  name="actionvar" value="Update" id="saveDataId" />
				<?php }?>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Copyform"){?>
					<input type="submit" valcheck="true"  class="butsubmit"  name="actionvar" value="Copy" id="copyDataId" />
				<?php }?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	</td>
</tr>	
<?php }?>
<?php }?>

<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")){?>
<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
			
				<th colspan="2">Add Campaign</th>
			</tr>
			<tr>
				<td width="100px"><span id ="grp">Group</span></td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo'];?>
</td>
			</tr>			
			<tr>
				<td> <span id ="camp">Name </span></td>
				<td><input type="text" name="name" valtype="emptyCheck-please enter a name" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
"></td>
			</tr>
			<tr>
				<td>Description </td>
				<td><textarea rows="10" cols="60" valtype="emptyCheck-please enter description"  name="description"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['code'];?>
</textarea></td>
			</tr>
			<tr>			
				<td>Start Date </td>
				<td><input type="text" value="" valtype="emptyCheck-please enter start date"  name="start_date" class="dateTextBox" id="txt_join_from" readonly="" ></td>
			</tr>
			<tr>
				<td>End Date</td>
				<td><input type="text" valtype="emptyCheck-please enter end date" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['txt_join_to'];?>
" name="end_date" class="dateTextBox"  id="txt_join_to" readonly="" /></td>
			</tr>
			<tr>
				<td> <span id ="tusrs">Target User Ids</span> </td>
				<td><textarea name="target_users" ></textarea> </td>
			</tr>
			<tr>
				<td><span id ="tzip">Target Zip Codes</span></td>
				<td><textarea name="target_zip"></textarea></td>
			</tr>
			<tr>
				<td>Target Latitude </td>
				<td><input type="text" name="target_latitude" size="100" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
"></td>
			</tr>
			<tr>
				<td>Target Longitude </td>
				<td><input type="text" name="target_longitude" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
"></td>
			</tr>
			<tr>
				<td><span id ="tdis">Target Distance </span></td>
				<td><input type="text" name="target_distance" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" valcheck="true"  class="butsubmit"  name="actionvar" value="Save" id="saveDataId" />
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	</td>
</tr>	
<?php }?>
<?php }?>
<tr>
	<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Listing"){?>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>Viewing  <strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
 </strong> 
							of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong>  </td>
							
							<td>
								<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['keyword'];?>
" />
							</td>
							<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo'];?>

							</td>
							<td>
							<span id="srchbtn"><input name="actionvar" type="submit" class="butsubmit" value="Search" /></span>
							</td>
							<td>
							<span id="rstbtn"><input name="actionvar" type="submit" class="butsubmit" value="Reset" /></span>
							</td>
							<td>
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
							<span id="addbtn"><input name="actionvar" type="submit" class="butsubmit" value="Add New" /></span>
							<?php }?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']){?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							
							<th>No</th>
							<th><span id="grp"><a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=category_id&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
							Group<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('category_id',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a></span></th>
							<th><a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=name&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
							<span id="camp">Name</span>
							<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('name',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							<th>
								Start Date
							</th>
							<th>
								End Date
							</th>							
							<!--<th>
								Impression  
							</th>-->
							<th>Action </th>
						</tr>
					<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actionReturn')->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']++;
?>
						<tr>
							
							<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow+$_smarty_tpl->getVariable('smarty')->value['foreach']['i']['index'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['category'];?>
</td>
							<td>
								<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>

							</td>
								
							<td>
								<?php echo $_smarty_tpl->tpl_vars['data']->value['start_date'];?>

							</td>
							<td>
								<?php echo $_smarty_tpl->tpl_vars['data']->value['end_date'];?>

							</td>							
						<!--	<td>
								<?php echo $_smarty_tpl->tpl_vars['data']->value['impression'];?>

							</td>-->
							<td>
							
							 <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
                          				  <a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Stauschange','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
                            <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['data']->value['status']==1){?> 
                                    	<img src="images/active.gif" border="0" title="Click here to inactivate">
                                     <?php }else{ ?> 							 
                                     	<img src="images/inactive.gif" border="0" title="Click here to activate">
                                     <?php }?>
                            <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
                             </a> 
                            <?php }?>	
							
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('editform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit">							
							</a> 
								<?php }?>    
								
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('copyform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
							<img src="images/copy.png" border="0" title="Click here to Copy">							
							</a> 
								                   
							
								
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('','addCampaignAdds.php',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
							<img src="images/fast_forward.png" border="0" alt="view"title="Click here to view Adds">							
							</a> 			
							</td>
						</tr>
					<?php }} ?>
					<tr>
						<td>
						</td>
						<td colspan="7"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->s_get_links();?>
</td>
					</tr>
				</table>
				</td>
			</tr>
			<?php }?>
		</table>
	</td>
	<?php }?>
</tr>
</table>
</form>
<?php echo smarty_function_call_module_footer(array(),$_smarty_tpl);?>

