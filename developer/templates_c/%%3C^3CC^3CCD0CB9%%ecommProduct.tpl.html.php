<?php /* Smarty version 2.6.19, created on 2011-01-28 14:37:51
         compiled from ecommProduct.tpl.html */ ?>
<?php echo '
<script type="text/javascript" src="js/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
<script type="text/javascript">
$(document).ready(function(){
$("#ecom").tooltip();
});
</script>
'; ?>

<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<form action="" name="fromName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><span id="ecom"><strong><?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>Add <?php endif; ?><?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>Edit <?php endif; ?>Ecommerce Products </strong></span></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
			

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage Ecommerce Products</th>
			</tr>
			<?php if ($this->_tpl_vars['actionReturn']['combo']): ?>
			<tr>
				<td>Select Category</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']; ?>
</td>
			</tr>
			<?php endif; ?>
			
			<tr>
				<td width="150">Product </td>
				<td><input type="text" valtype="emptyCheck-Please enter a product name" name="product" value="<?php echo $this->_tpl_vars['actionReturn']['data']['product']; ?>
" id="productId" class="validateText" /></td>
			</tr>
		
			<tr>
				<td width="150">Description </td>
				<td><textarea  name="description" id="descriptionId" valtype="emptyCheck-Please enter a product description" cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['description']; ?>
</textarea>
				</td>
			</tr>
		
			<tr>
				<td>Price in Points</td>
				<td><input type="text"  name="price_points" valtype="emptyCheck-Please enter a price|checkNumber-Please enter a valid price" value="<?php echo $this->_tpl_vars['actionReturn']['data']['price_points']; ?>
" id="price_pointsId" class="nummberOnly"  maxlength="10" /></td>
			</tr>
	
			
			<tr>
				<td>Total Quantity</td>
				<td><input type="text" valtype="emptyCheck-Please enter a quantity|checkNumber-Please enter a valid quantiy" name="total_quantity" value="<?php echo $this->_tpl_vars['actionReturn']['data']['total_quantity']; ?>
" id="total_quantityId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			
			<tr>
				<td>Image</td>
				<td><input type="file"  name="fileImage" value="<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" id="fileImageId" />
				<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
				<a  href="../images/ecomProducts/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
				<img src="../images/ecomProducts/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="25" height="25" border="0"/>
				</a>
				<?php endif; ?>
				</td></tr>
				
		
			
			<tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
					<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Update" id="saveDataId" />
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
		
	</td>
</tr>	

<?php endif; ?>

<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>

<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<td id="testidhere">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" >
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			
			<tr>
				<td>
			

					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>Viewing  - <strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong> </td>
							
							<td>
								<?php echo $this->_tpl_vars['actionReturn']['searchdata']['searchCombo']; ?>

							</td>
							<td>
							Keyword&nbsp;
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
							<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
							<?php endif; ?>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					

					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=pd.product&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Product
								<?php echo $this->_tpl_vars['obj']->getSortImage('pd.product',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>							
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=p.category&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Category
								<?php echo $this->_tpl_vars['obj']->getSortImage('p.category',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>Image </th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=pd.sold_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Sold
								<?php echo $this->_tpl_vars['obj']->getSortImage('pd.sold_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>/
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=pd.total_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Total Qty
								<?php echo $this->_tpl_vars['obj']->getSortImage('pd.total_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=pd.price_points&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Price Points
								<?php echo $this->_tpl_vars['obj']->getSortImage('pd.price_points',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							
							<th>Action </th>

						</tr>
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['product']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['category']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['data']['image']): ?>
							<a  href="../images/ecomProducts/<?php echo $this->_tpl_vars['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
							<img src="../images/ecomProducts/thumb/<?php echo $this->_tpl_vars['data']['image']; ?>
" width="17" height="17" border="0"/>
							</a><div class="highslide-caption"><?php echo $this->_tpl_vars['data']['product']; ?>
</div>
							<?php else: ?> ---
							<?php endif; ?>
							</td>
							<td><?php echo $this->_tpl_vars['data']['sold_quantity']; ?>
/<?php echo $this->_tpl_vars['data']['total_quantity']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['price_points']; ?>
</td>
							
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Stauschange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<?php endif; ?>
							<?php if ($this->_tpl_vars['data']['status'] == 1): ?> 
							<img src="images/active.gif" border="0" title="Click here to inactivate">
							 <?php else: ?> 							 
							 <img src="images/inactive.gif" border="0" title="Click here to activate">
							 <?php endif; ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
					 </a> 
					<?php endif; ?>	 
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit">
							</a> 							
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="6"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
				</td>
			</tr>
		<?php endif; ?>
		<?php endif; ?>
		</table>
	</td>
	<?php endif; ?>
</tr>
<?php endif; ?>
</table>
</form>
<?php echo '
<script language="javascript" type="text/javascript">
hs.htmlExpand(document.getElementById("testidhere"), { outlineType: \'rounded-white\', wrapperClassName: \'draggable-header\',
	headingText: \'Full HTML content\' } )
</script>
'; ?>


<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
