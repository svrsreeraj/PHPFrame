<?php /* Smarty version Smarty-3.0.7, created on 2012-07-07 16:27:23
         compiled from "./templates/addBannerAdds.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:20056522354ff81613d776a5-89757106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da59ed9b13c0204bb4f31180d29217f42b8cbf0a' => 
    array (
      0 => './templates/addBannerAdds.tpl.html',
      1 => 1341654755,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20056522354ff81613d776a5-89757106',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Banner Adds"),$_smarty_tpl);?>


<script type="text/javascript">
$(document).ready(function(){
	$("#question").tooltip();
	$("#link").hide();
	$("#code").hide();
	$("#files").hide();
	
	var val	=	$("#type").val();
	if(val==1)
			{
				$("#code").hide();
				$("#link").show();
				$("#files").show();
			}
		if(val==3)
			{
				$("#link").hide();
				$("#files").hide();
				$("#files").show();
			}
		if(val==2)
			{
				$("#code").show();
				$("#files").hide();
				$("#link").hide();
			}	
	
	$("#type").change(function(){
		var val	=	$("#type").val();
			
		if(val==1)
			{
				$("#code").hide();
				$("#link").show();
				$("#files").show();
			}
		if(val==3)
			{
				$("#link").hide();
				$("#code").hide();
				$("#files").show();
			}
		if(val==2)
			{
				$("#code").show();
				$("#files").hide();
				$("#link").hide();
			}	
	});
	
});
</script>

<script type="text/javascript" src="{$smarty.const.CONST_SITE_ADDRESS}js/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="{$smarty.const.CONST_SITE_ADDRESS}js/highslide/highslide.css" />

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
	<td class="pageHead"><span id="question"><strong><?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>Edit<?php }?><?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")){?>Add<?php }?> Banner Ads  </strong></span></td>
</tr>
<!--<?php echo print_r($_smarty_tpl->getVariable('actionReturn')->value['data']['image']);?>
;exit;-->
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>
<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
			
				<th colspan="2">Edit Ads</th>
			</tr>
			<tr>
				<td width="100px">Ad Category</td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo']['addsCategory'];?>
</td>
			</tr>
			<tr>
				<td width="100px">Ad Type</td>
				<td>
					<?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo']['type'];?>

				</td>
			</tr>
			<tr>
				<td>Name </td>
				<td><input type="text" name="name" valtype="emptyCheck-please enter a name" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
"></td>
			</tr>
			
			<tr id="link">
				<td >Link </td>
				<td><input type="text" name="link" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['link'];?>
"></td>
			</tr>
			
			<tr id="code" >
				<td >Code </td>
				<td><textarea rows="10" cols="60" name="code"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['code'];?>
</textarea></td>
			</tr>
			
			<tr id="files" >
				<td >Image</td>
					<td><input type="file"  name="fileImage" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" id="fileImageId" />&nbsp;
					<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['image']){?>
						<a  href="../banner/images/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" class="highslide" onclick="return hs.expand(this)">
						<img src="../banner/images/thumb/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" width="25" height="25" ; />
						</a><?php }?>
						</td>
			</tr>
			<tr>
				<td>Height </td>
				<td><input type="text" name="height" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['height'];?>
">&nbsp;px</td>
			</tr>
			<tr>
				<td>Width</td>
				<td><input type="text" name="width" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['width'];?>
">&nbsp;px</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
					
					<input type="submit" valcheck="true"  class="butsubmit"  name="actionvar" value="Update" id="saveDataId" />
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
			
				<th colspan="2">Add Ads</th>
			</tr>
			<tr>
				<td width="100px">Ad Category</td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo'];?>
</td>
			</tr>
			<tr>
				<td width="100px">Ad Type</td>
				<td>
					<select name="types" id="type" valtype="emptyCheck-please select a type" >
					<option value="">select type</option>
					<option value="1">Image</option>
					<option value="2">Html</option>
					<option value="3">Flash</option>
					</select>
				</td>
			<tr>
				<td>Name </td>
				<td><input type="text" name="name" valtype="emptyCheck-please enter a name" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
"></td>
			</tr>
			<tr id="link" >
				<td >Link </td>
				<td><input type="text" name="link"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['link'];?>
"></td>
			</tr>
			<tr id="code">
				<td>Code </td>
				<td><textarea rows="10" cols="60" name="code"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['code'];?>
</textarea></td>
			</tr>
			<tr id="files">
				<td>Files </td>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<td>Height </td>
				<td><input type="text" name="height" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['height'];?>
">&nbsp;px</td>
			</tr>
			<tr>
				<td>Width</td>
				<td><input type="text" name="width" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['width'];?>
">&nbsp;px</td>
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
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
							<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
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
							<th><a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=category_id&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
							Category<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('category_id',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a></th>
							<th><a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=name&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
							Name
							<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('name',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							<th>
								Image/Code
							</th>
							<th>
								Height
							</th>
							<th>
								Width 
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
							<td><?php if ($_smarty_tpl->tpl_vars['data']->value['types']==1){?>
								<a  href="../banner/images/<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
" class="highslide" onclick="return hs.expand(this)">
									<img src="../banner/images/thumb/<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
"  width="17" height="17" border="0" />
								</a><?php }elseif($_smarty_tpl->tpl_vars['data']->value['types']==2){?><?php echo $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['code'],40);?>
<?php }elseif($_smarty_tpl->tpl_vars['data']->value['types']==3){?>FLASH<?php }else{ ?>Unknown Type<?php }?></td>
							<td>
								<?php echo $_smarty_tpl->tpl_vars['data']->value['height'];?>
 
							</td>
							<td>
								<?php echo $_smarty_tpl->tpl_vars['data']->value['width'];?>
 
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
                                
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Delete")){?>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('delete','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
							<img src="images/delete.gif" border="0" alt="delete"title="Click here to edit">							
							</a> 
								<?php }?>				
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

