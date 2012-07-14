<?php /* Smarty version Smarty-3.0.7, created on 2011-12-20 17:37:06
         compiled from "./templates/products.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:17549185774ef07a6a7a8038-52943985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fc51dac6fe4ee508fa17738eb65244df41ac439' => 
    array (
      0 => './templates/products.tpl.html',
      1 => 1324382808,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17549185774ef07a6a7a8038-52943985',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Manage Category"),$_smarty_tpl);?>


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
						window.location="products.php?actionvar=Deleteform&id="+id;
					}
				else
					{
						return false;
					}	
			});
	}

</script>
<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>



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
	<td class="pageHead"><span id="vendor"><strong>Product <?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Listing")){?>Listing<?php }?> <?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>Edit  : <?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['product'];?>
  <?php }?> </strong>
</span></td></tr><?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>
<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>                                                     
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<td width="150">Product Name<samp class="txt_red">*</samp></td>
				<td><input type="text" name="product" valtype="emptyCheck-Please enter a product name"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['product'];?>
" id="nameId" size="50" class="validateText"/></td>
			</tr>
			<tr>
				<td>Category <samp class="txt_red">*</samp></td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['cat_combo'];?>
</td>
			</tr>
         
			    <tr>
            	<td>Model No</td>
                <td><input type="text" name="model_no" valtype="emptyCheck-Please enter a model no"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['model_no'];?>
" id="nameId" size="50" class="validateText"/></td>
			<tr>
				<td>Description</samp></td>
				<td>
					<textarea name="description" cols="25" rows="10" id="description"  ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['description'];?>
</textarea>
				</td>
			</tr>
            <tr>
            	<td>Product Price</td>
                <td><input type="text" name="price" valtype="emptyCheck-Please enter a price"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['price'];?>
" id="nameId" size="50" class="validateText"/></td>
			<tr>
			<tr>
            
				<td>Image </td>
				<td><input type="file"  name="image" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
"  id="fileImageId" />
				<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['image']){?>
				<a  href="../manageproducts/images/product/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" class="highslide" onclick="return hs.expand(this)">
				 <img src="../manageproducts/images//product/thumb/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
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
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Update" id="saveDataId" />
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
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Viewform")){?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
		<tr>
		<td width="50%">
			<div class="boxList">
				
					<div>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th colspan="3" >Products Details</th>
						</tr>
							<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['product']){?>
						<tr>
							<td>Product</td>
							<td ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['product'];?>
 </td>
						</tr>
						<?php }?>
                        <?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['category']){?>
							<tr>
								<td>Category</td>
								<td colspan="2"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['category'];?>
</td>
							</tr>
							<?php }?>
							<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['price']){?>
							<tr>
								<td>Price</td>
								<td ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['price'];?>
</td>
							</tr>							
							<?php }?>
							
                            <?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['description']){?>
								<tr>
									<td>Description</td>
									<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['description'];?>
</td>
								</tr>
							<?php }?>
							<tr>
								<td>Status</td>
								<td colspan="2">
                                
								<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['status']==1){?>
									<img src="images/active.gif" border="0" title="Active user" alt="Active user"  />
								<?php }else{ ?>
									<img src="images/inactive.gif" border="0" title="Inactive User" alt="Inactive User"  />
								<?php }?>
								</td>
							</tr>
							<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['date_added']){?>
							<tr>
								<td>Joined Date</td>
								<td colspan="2"><?php echo $_smarty_tpl->getVariable('obj')->value->displayDate($_smarty_tpl->getVariable('actionReturn')->value['data']['date_added']);?>
</td>
							</tr>
							<?php }?>
						</table>
					</div>
				</div>
			</td>
			<td>
				
		</td>
		</tr>
		<tr>
		<td></td>
			<td >
				<input type="submit" class="butsubmit"  name="actionvar" value="Back" id="cancelId" />
			</td>
		</tr>
		</table>
	</td>
</tr>
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
                <th colspan="2">Add  Products</th>
             </tr>
             <tr>
                 <td>&nbsp;</td>
             </tr>
             <tr>
				<td width="150">Product Name<samp class="txt_red">*</samp></td>
				<td><input type="text" name="product" valtype="emptyCheck-Please enter a product name"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['product'];?>
" id="nameId" size="50" class="validateText"/></td>
			</tr>
			<tr>
				<td> Category <samp class="txt_red">*</samp></td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['cat_combo'];?>

				</td>
			</tr>
            <tr>
            	<td>Model No</td>
                <td><input type="text" name="model_no"   value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['model_no'];?>
" id="model_Id" size="50" class="validateText"/></td>
			<tr>
				<td>Description</td>
				<td>
					<textarea name="description" cols="25" rows="10" id="description" ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['description'];?>
</textarea>
				</td>
			</tr>
            <tr>
            	<td>Product Price<samp class="txt_red">*</samp></td>
                <td><input type="text" name="price" valtype="emptyCheck-Please enter a price"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['price'];?>
" id="nameId" size="50" class="validateText"/></td>
			<tr>
            
			<tr>
				<td>Image </td>
				<td><input type="file"  name="image"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" id="fileImageId" />
				<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['image']){?>
				<a  href="../manageproducts/images/product/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" class="highslide" onclick="return hs.expand(this)">
				 <img src="../manageproducts/images/product/thumb/<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['image'];?>
" width="25" height="25"/>
				</a>
				<?php }?>				
				</td>
			</tr>
            
		
			<tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
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
&sortField=product&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Product
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('product',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>	
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
&sortField=image&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Image
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('phone',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>	
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=date_added&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Date Added
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('date_added',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

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
							<td><span title="<?php echo $_smarty_tpl->tpl_vars['data']->value['product'];?>
" ><?php echo $_smarty_tpl->tpl_vars['data']->value['product'];?>
</span>
							</td>
							<td><span title="<?php echo $_smarty_tpl->tpl_vars['data']->value['category'];?>
" ><?php echo $_smarty_tpl->tpl_vars['data']->value['category'];?>
</span>
							</td>
							<td>
							<a  href="../manageproducts/images/product/<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
" class="highslide" onclick="return hs.expand(this)">
							<img src="../manageproducts/images/product/thumb/<?php echo $_smarty_tpl->tpl_vars['data']->value['image'];?>
" width="17" height="17" border="0"/>
							</a>
							</td>
							<td><?php echo $_smarty_tpl->getVariable('obj')->value->displayDate($_smarty_tpl->tpl_vars['data']->value['date_added']);?>
</td>
							<td>
								<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('editform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
								<img src="images/edit.gif" border="0" title="Click here to edit"></a> 
								<?php }?>
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
                                <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>
									<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('viewform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
									<img src="images/view.gif" border="0" title="Click here to view"> </a>
								<?php }?>
								<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Delete")){?>
								<!--	<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('deleteform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link"> -->
								<a onclick="deleteConfrm(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
)" href="#" class="Second_link">
									<img src="images/delete.gif" border="0"  title="Click here to delete"> </a>
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

<?php echo smarty_function_call_module_footer(array(),$_smarty_tpl);?>

