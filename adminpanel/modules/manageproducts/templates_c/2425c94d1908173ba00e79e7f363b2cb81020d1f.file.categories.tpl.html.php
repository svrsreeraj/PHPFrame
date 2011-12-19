<?php /* Smarty version Smarty-3.0.7, created on 2011-12-19 16:29:33
         compiled from "./templates/categories.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:751150074eef1915442fa4-09872501%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2425c94d1908173ba00e79e7f363b2cb81020d1f' => 
    array (
      0 => './templates/categories.tpl.html',
      1 => 1324292355,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '751150074eef1915442fa4-09872501',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Manage Category"),$_smarty_tpl);?>


<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />

<script type="text/javascript">
function deleteConfrm(id)
	{
		jConfirm('Are you sure you want to delete this details', 'Confirmation Dialog', 
		function(stat) 
			{
				if(stat==true)	
					{
						window.location="categories.php?actionvar=Deleteform&id="+id;
					}
				else
					{
						return false;
					}	
			});
	}
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
<form action="" name="fromName" method="post" enctype="multipart/form-data">

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }?>
<tr>
	<td class="pageHead"><span id="vendor"><strong>Category <?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Listing")){?>Listing<?php }?> <?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>Edit : <?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['category'];?>
  <?php }?> </strong>
</span></td></tr>
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")){?>
<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Add Category</th>
			</tr>
            <tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Category Name<samp class="txt_red">*</samp></td>
				<td><input type="text" valtype="emptyCheck-Please enter your Category Name" name="category" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['category'];?>
" id="fnameId"  />
				</td>
			</tr>
			<tr>
				<td width="150">Parent Category<samp class="txt_red">*</samp></td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['cat_combo'];?>
</td>
			</tr>
            <tr>
				<td>Description</td>
				<td>
					<textarea name="description"  cols="55" rows="20" id="description" ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['description'];?>
</textarea>
				</td>
			</tr>
			<tr><td></td><td id="errorsub"> </td></tr>
			<tr>
				<td>Image </td>
				<td><input type="file"  name="image" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" id="imageId" />
				<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['image']){?>
				<a  href="../category/images/category/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" class="highslide" onclick="return hs.expand(this)">
				 <img src="../category/images/category/thumb/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" width="25" height="25"/>
				</a>
				<?php }?>				
				</td>
			</tr>
				<td>
				</td>
			</tr>
			<tr>				
				<td>&nbsp;</td>
				<td>
					<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Save" id="saveDataId" />
					
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	</td>
</tr>
<?php }?>
<?php }?>	


<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>
<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>                                                     
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				
			</tr>
			<tr>
				<td>Category Name<samp class="txt_red">*</samp></td>
				<td><input type="text" valtype="emptyCheck-Please enter your Category Name" name="category" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['category'];?>
" id="fnameId"  />
				</td>
			</tr>
			<tr>
				<td width="150">Parent Category<samp class="txt_red">*</samp></td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['cat_combo'];?>
</td>
			</tr>
             <tr>
				<td>Description</td>
				<td>
					<textarea name="description" cols="55" rows="20"  id="description" ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['description'];?>
</textarea>
				</td>
			</tr>
			<tr><td></td><td id="errorsub"> </td></tr>
			<tr>
				<td>Image </td>
				<td><input type="file"  name="image" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" id="imageId" />
				<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['image']){?>
				<a  href="../category/images/category/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" class="highslide" onclick="return hs.expand(this)">
				 <img src="../category/images/category/thumb/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" width="25" height="25"/>
				</a>
				<?php }?>				
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Update" id="updateDataId" />
					<?php }?>
				<?php }else{ ?>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
					<?php }?>
				<?php }?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
			
	</td>
</tr>
<?php }?>	
<?php }?>



<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>
<tr>
	<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Listing"){?>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
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
                            <td>
						Category</td><td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['cat_combo'];?>

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
			<!--<tr>
				<?php $_template = new Smarty_Internal_Template("categorysearch.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			</tr>-->
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
&sortField=category&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Category
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('category',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>	
                            <th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=description&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Description
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('description',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>	
							<th>Image</th>
							<th>Action</th>
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
							<td><span title="<?php echo $_smarty_tpl->tpl_vars['data']->value['category'];?>
" ><?php echo $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['category'],300);?>
</span></td>
                            <td><span title="<?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
" ><?php echo $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['description'],25);?>
</span></td>
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['data']->value['image']){?>
                            <a  href="../category/images/category/<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
" class="highslide" onclick="return hs.expand(this)">
							<img src="../category/images/category/thumb/<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
" width="17" height="17" border="0"/>
							</a>
                            <?php }?>
                            </td>
							
							<td>
								<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>							
									
										<!--<?php if ($_smarty_tpl->tpl_vars['data']->value['status']==1){?> 
										<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('listing','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('ids=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
										<img src="images/forward.png" width="22" height="22" border="0" title="Click here to edit"></a> 
										
									<?php }else{ ?>
										&nbsp;&nbsp;
									<?php }?>-->
									<?php if ($_smarty_tpl->getVariable('actionReturn')->value['prid']>='0'){?>
									<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('listing','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('ids=',$_smarty_tpl->getVariable('actionReturn')->value['prid']));?>
" class="Second_link">
									<img src="images/backward.png" width="22" height="22" border="0" title="Click here to edit"></a> 
									<?php }else{ ?>
										&nbsp;&nbsp;
									<?php }?>
								<?php }?>
						
								<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('editform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
								<img src="images/edit.gif" border="0" title="Click here to edit"></a> 
								<?php }?>
								
								<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
									<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Stauschange','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
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
<?php echo smarty_function_call_module_footer(array(),$_smarty_tpl);?>

