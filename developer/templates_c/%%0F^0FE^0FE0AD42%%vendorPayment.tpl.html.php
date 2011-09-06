<?php /* Smarty version 2.6.19, created on 2011-03-04 11:11:07
         compiled from vendorPayment.tpl.html */ ?>
<?php echo '
<script language="javascript" type="text/javascript">

function displaypayment(cid,changeId)
	{
		$.ajax({
			   type	: "GET",
			   url	: "vendorPayment.php",			 
			   data	: "actionvar=Getcombodeal&dealid="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#vendorpay").tooltip();

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
	<td class="pageHead"><span id="vendorpay"><strong>Vendor Payments </strong></span></td>
</tr>

<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Fetch' )): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td align="center">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="3">Payment Details</th>
			</tr>
			
			<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>
			<tr>
				<td width="100">Vendor ID</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']; ?>

				<input type="text" class="nummberOnly" name="vendor" value="<?php echo $this->_tpl_vars['actionReturn']['data']['vendor']; ?>
" id="vendorId" valtype="emptyCheck-Please enter vendor Id" onchange="getcombo(this.value,'dealDiv');" />
				
				<input name="actionvar" type="submit" class="butsubmit" value="Fetch" /></td>
			</tr>
			<?php endif; ?>
			<?php if (( $this->_tpl_vars['obj']->currentAction == 'Fetch' )): ?>
			<?php if ($this->_tpl_vars['actionReturn']['vdata']): ?>
			<tr>
				<td  width="100">Vendor Name</td>
				<td >
				<?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_vendor',$this->_tpl_vars['obj']->getConcat('business_name'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['vdata']['0']['vendor_id'])); ?>

				</td>
			</tr>
			
			<tr>
				<td>Deals</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['dcombo']; ?>
</td>
			</tr>			
			<?php endif; ?>
			<?php endif; ?>
			<tr><td  colspan="2">
				<div id="paymentdtails"> 
					
				<div align="center"><?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?><input name="actionvar" type="submit" class="butsubmit" value="Cancel" /><?php else: ?><input name="actionvar" type="submit" class="butsubmit" value="Back" /> <?php endif; ?></div>	
					
				</div><td>
			</tr>	
		</table>
	</td>
</tr>	
<?php endif; ?>


<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
		<!--	<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>Viewing  - <strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong></td>
							<td>Keyword</td>	
							<td>
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
							<td>
								<a href="javascript:;" id="id_search_link">
									<img src="images/search.png" border="0" width="16" height="16" />
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<td>
					<div id="id_search_block" class="cls_search_block">
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
							<tr>
							<td>Vendor</td>
							<td>
								<?php echo $this->_tpl_vars['actionReturn']['searchdata']['searchCombo']; ?>

							</td>
							<td>Deals:</td>
							<td>							
							<div id="dealDiv">
							<?php echo $this->_tpl_vars['actionReturn']['searchdata']['searchCombo1']; ?>

							</div>
							</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>-->
						<!--<tr><td>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
				<tr><td width="110">Total Commission:</td><td><strong>$ </strong></td><td width="110">Paid Commission:</td><td><strong>$ </strong></td><td width="110">Balance to Pay:</td><td><strong>$ </strong></td></tr>
			</table>
			</td></tr>
			<tr>
				<td>&nbsp;</td>
			</tr>-->
						<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td><strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong></td>
							<td>Vendor ID/Email</td>
							<td>
								<input type="text" name="vendor" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['vendor']; ?>
" id="vendorId"  />
							</td>							
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" size="13"/>
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
&sortField=business_name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('business_name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a>
							</th>
							
							<th>														
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=total&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total Commission
							<?php echo $this->_tpl_vars['obj']->getSortImage('total',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a>							
							</th>
							
							<th>	
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=used&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Paid Commission
							<?php echo $this->_tpl_vars['obj']->getSortImage('used',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a>
							</th>
							
							<th>	
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=balance&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Balance to Pay
							<?php echo $this->_tpl_vars['obj']->getSortImage('balance',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a> 
							</th>
							
							<th colspan="2">Action 	</th>
						</tr>
					
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>	
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['business_name']; ?>
 </td>
							<td><a class="helpText"  onmouseover="return escape('<?php echo $this->_tpl_vars['data']['totDet']; ?>
')">$<?php echo $this->_tpl_vars['data']['total']; ?>
</a></td>
							<td><a  class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['payDet']; ?>
')">$<?php echo $this->_tpl_vars['data']['used']; ?>
</a></td>
							<td><a  class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['balDet']; ?>
')">$<?php echo $this->_tpl_vars['data']['balance']; ?>
</a></td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Listing','vendorPaymentDetail.php',true,$this->_tpl_vars['obj']->getConcat('vid=',$this->_tpl_vars['data']['vendor_id'])); ?>
" class="Second_link">
							<img src="images/view.gif" border="0" title="Click here to view payment details of <?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_vendor','business_name',$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['vendor_id'])); ?>
 ">
							</a>  
							<?php endif; ?>							
							</td>
							<td>
							<?php if ($this->_tpl_vars['data']['balance'] > 0): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Commisionpay','',true); ?>
&id=<?php echo $this->_tpl_vars['data']['vendor_id']; ?>
" class="Second_link"  title="Click here to make balance payment">
								Pay </a>
							<?php else: ?> <span title="Sorry! No balance to pay "> ---
							<?php endif; ?>
							</td>
						
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="7"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
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
</table>
</form>
<?php echo '
<script type="text/javascript" src="js/tooltip.js"></script>		
'; ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
