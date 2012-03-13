<?php /* Smarty version Smarty-3.0.7, created on 2012-03-13 05:40:50
         compiled from "./templates/contentManagement.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:8223434344f5e908ac28c74-35943978%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f93de7fe77d45c5882cedde29051d8a6749643f' => 
    array (
      0 => './templates/contentManagement.tpl.html',
      1 => 1331597448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8223434344f5e908ac28c74-35943978',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Content Management"),$_smarty_tpl);?>


<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../../libs/ckeditor_3.5.1/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$("#heading").tooltip();
$("[valcheck='true']").click(function()
	{
		jsArticleBody	=	CKEDITOR.instances.description.getData();	
		var len			=	jsArticleBody.length;
		if(len==0)
			{
				$("#errorsub").append("<span class='val_error_alert'>&nbsp;please enter a description</span>");
				return false;
			}

	});

});
</script>


<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>
<form action="" name="formName" method="post" enctype="multipart/form-data" onsubmit="return validatefck()">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }?>
<tr>
	<td class="pageHead"><span id="heading"><strong>Content Management </strong></span></td>
</tr>
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")||($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage CMS</th>
			</tr>
		
			<tr>
				<td width="150">Title</td>
				<td><input type="text" name="title" valtype="emptyCheck-please enter a title"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['title'];?>
" id="captionId" size="50" class="validateText"/></td>
			</tr>
			<tr>
				<td>Description</td>
				<td>
					<textarea name="description" cols="75" rows="50" id="description" ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['description'];?>
</textarea>
				</td>
			</tr>
			<tr><td></td><td id="errorsub"> </td></tr>
			
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['combo']){?>
				<tr>
				<td>Section</td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo'];?>
</td>
			</tr>
			<?php }?>
			 <!-- <tr>
				<td>Image</td>
				<td><input type="file"  name="fileImage" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" id="fileImageId" />
				<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['image']){?>
				<a  href="../images/cms/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" class="highslide" onclick="return hs.expand(this)">
				<img src="../images/cms/thumb/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" border="0" width="25" height="25"/>
				</a>
				<?php }?>
				</td></tr> -->		
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
					<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Update" id="saveDataId" />
				<?php }else{ ?>
					<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Save" id="saveDataId"  />
				<?php }?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	
	</td>
</tr>	
<?php }?>

<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>
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
						<td> <strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong> </td>							
						<td>CMS Section:</td>
							<td>
								<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['searchCombo'];?>

							</td>
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['keyword'];?>
" />
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
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=vs.title&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Title
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('vs.title',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=vs.description&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Description
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('vs.description',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
								<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=vod.section&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Section
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('vod.section',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=vs.date_added&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Date
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('vs.date_added',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							
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
							<td><?php echo $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['title'],100);?>
</td>
							<td ><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['description'],60));?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['section'];?>
</td>
							<td><?php echo $_smarty_tpl->getVariable('obj')->value->displayDate($_smarty_tpl->tpl_vars['data']->value['date_added']);?>
</td>
							<td>
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('editform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link"> <img src="images/edit.gif" border="0" title="Click here to edit"></a> 
							<?php }?>
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Stauschange','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id'],'&status=',$_smarty_tpl->tpl_vars['data']->value['status']));?>
" class="Second_link">
							<?php if ($_smarty_tpl->tpl_vars['data']->value['status']==1){?> 
							<img src="images/active.gif" border="0" title="Click here to inactivate">
							 <?php }else{ ?> 							 
							 <img src="images/inactive.gif" border="0" title="Click here to activate">
							 <?php }?>
							 </a> 
							<?php }?>
														
							</td>
						</tr>
					<?php }} ?>
					<tr>
						<td colspan="6"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->s_get_links();?>
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
<?php }?>
</table>
	</form>
<script type="text/javascript">
CKEDITOR.replace('description');
</script>
<?php echo smarty_function_call_module_footer(array(),$_smarty_tpl);?>

