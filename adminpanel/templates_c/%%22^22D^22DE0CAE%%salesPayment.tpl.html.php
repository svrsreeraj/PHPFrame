<?php /* Smarty version 2.6.19, created on 2011-01-24 16:19:12
         compiled from salesPayment.tpl.html */ ?>
<?php echo '
<script language="javascript" type="text/javascript">
function getcombo(cid,changeId)
	{
	$.ajax({
			   type	: "GET",
			   url	: "salesPayment.php",			 
			   data	: "actionvar=Getcombo&id="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			});
	}
function displaypayment(cid,changeId)
	{
		$.ajax({
			   type	: "GET",
			   url	: "salesPayment.php",			 
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
$("#Salesagent").tooltip();

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
	<td class="pageHead"><span  id="Salesagent"><strong>Sales Agent Payments </strong></div></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>

<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="3">Payment Details</th>
			</tr>
			<tr>
				<td width="150">Sales Agent</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']; ?>
</td>
			</tr>
			<tr>
				<td>Deals</td>
				<td>
					<div id="dealDivId">
					<select name="deals" >
					<option value='' >Select</option></select>
					</div>
				</td>
			</tr>
			
			
			<tr><td colspan="2">
				<div id="paymentdtails"> 
					<div align="middle"><input name="actionvar" type="submit" class="butsubmit" value="Cancel" /></div>
					
					
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
				
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td><strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong></td>
							<td>Sales Agent:</td>
							<td>
								<?php echo $this->_tpl_vars['actionReturn']['searchdata']['searchCombo']; ?>

							</td>
							<td>Deals:</td>
							<td>							
							<div id="dealDiv">
							<?php echo $this->_tpl_vars['actionReturn']['searchdata']['searchCombo1']; ?>

							</div>
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
&sortField=salesagentname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Sales Agent
							<?php echo $this->_tpl_vars['obj']->getSortImage('salesagentname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

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
							
							<th>Action 	</th>
						</tr>
					
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>	
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td> <?php echo $this->_tpl_vars['data']['salesagentname']; ?>
 </td>
							<td><a class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['totDet']; ?>
')">$<?php echo $this->_tpl_vars['data']['total']; ?>
</a></td>
							<td><a class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['payDet']; ?>
')">$<?php echo $this->_tpl_vars['data']['used']; ?>
</a></td>
							<td><a class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['balDet']; ?>
')">$<?php echo $this->_tpl_vars['data']['balance']; ?>
</a></td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Listing','salesPaymentDetail.php',true,$this->_tpl_vars['obj']->getConcat('sid=',$this->_tpl_vars['data']['saleagent_id'])); ?>
" class="Second_link">
							<img src="images/view.gif" border="0" title="Click here to view payment details of <?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\'  \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['saleagent_id'])); ?>
 ">
							
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
</table>
</form>
<?php echo '
<script type="text/javascript" src="js/tooltip.js"></script>		
'; ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
