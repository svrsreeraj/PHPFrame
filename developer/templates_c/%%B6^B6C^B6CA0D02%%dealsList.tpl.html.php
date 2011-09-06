<?php /* Smarty version 2.6.19, created on 2011-03-02 13:52:12
         compiled from dealsList.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'dealsList.tpl.html', 684, false),)), $this); ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript" src="js/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />

<script type="text/javascript">
	function display(id,status)
		{
			jConfirm(\'Are you sure you want to change Deal Status?\', \'Confirmation Dialog\', 
			function(stat) 
				{
					if(stat==true)	
						{
							window.location="dealsList.php?actionvar=Statuschange&id="+id+"&status="+status;
						}
					else
						{
							return false;
						}	
				});
		}

	
	function deleteRequest(id)
		{
			jConfirm(\'Are you sure you want to delete this deal?\', \'Confirmation Dialog\', 
			function(stat) 
				{
					if(stat==true)	
						{
							window.location="dealsList.php?actionvar=Deletedeal&id="+id;
						}
					else
						{
							return false;
						}	
				});
		}
		
		
</script>


<script type="text/javascript">
function getcombo(cid,changeId)
	{
		$.ajax({
			   type	: "GET",
			   url	: "dealsList.php",
			   data	: "actionvar=Getcombo&id="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
function getvalidvendor(cid,changeId)
	{
		$.ajax({
			   type	: "GET",
			   url	: "dealsList.php",
			   data	: "actionvar=Getvendor&id="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
$(document).ready(function() {
	$("#deals").tooltip();
	$("#vendor_list").tooltip();
	$("#vendorId").tooltip();
	$("#salesagent").tooltip();
	$("#category_list").tooltip();
	$("#subcatgory").tooltip();
	$("#dealname").tooltip();
	$("#dealhightlight").tooltip();
	$("#customermaximumgiftpurchase").tooltip();
	$("#dealhiglight").tooltip();
	$("#customermaxgift").tooltip();
	$("#noofdaysdealpossible").tooltip();
	$("#dealcaption").tooltip();
	$("#dealdiscription").tooltip();
	$("#dealcost").tooltip();
	$("#dealprice").tooltip();
	$("#vendorcomm").tooltip();
	$("#sitecomm").tooltip();
	$("#customermaxbuylimit").tooltip();
	$("#salesagent").tooltip();
	$("#noofvotetounlock").tooltip();
	$("#activationdate").tooltip();
	$("#dealpossiblehrs").tooltip();
	$("#noofvote").tooltip();
	$("#dealpossiblehours").tooltip();
	$("#couponexpirydays").tooltip();
	$("#customemaxbuylimit").tooltip();
	$("#totalqty").tooltip();
	$("#maximumpurchaseallowed").tooltip();
	$("#noofdayscooldown").tooltip();
	$("#couponActiv").tooltip();
	
	$("#couponactivehours").tooltip();
	
	$("#noofdaysincooldown").tooltip();
	$("#coupounExpiry").tooltip();
	$("#rules").tooltip();
	$("#imageId").tooltip();
	$("#image1Id").tooltip();
	$("#txt_date_field_from").datepicker();
	$("#txt_date_field_from").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		defaultDate:\'2010-11-24\',
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});

	$("#txt_date_field_to").datepicker();
	$("#txt_date_field_to").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		defaultDate:\'2010-12-7\',
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});
	
	$("#activation_dateId").datepicker();
		$("#activation_dateId").datepicker(\'option\',
		{
			showAnim:\'show\',
			dateFormat:\'yy-mm-dd\',
			changeMonth: true,
			changeYear: true,
			minDate: -0, 
			//maxDate: \'+1M +10D\',
			showOtherMonths: true, 
			selectOtherMonths: true,
			//defaultDate:\'2010-12-7\',
			yearRange:\'c:c+1\',
			autoSize:false
		});
		
});
</script>

<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.datepicker.js"></script>

'; ?>



<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage" colspan="2"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td align="left"  class="pageHead"><span id="deals"><strong>Deals </strong></span></td>
	<td align="right" class="pageHead" style="text-align:right">
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong>
	<?php endif; ?>
	</td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2">
		<form action="" name="formName" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Add Deals</th>
			</tr>
			<?php if (( $this->_tpl_vars['actionReturn']['sagent'] )): ?>
			
			<tr>
				<td width="230"><span id="vendor">Vendor</span></td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']['vendor']; ?>
 <span style="color:#0099CC"> [Only eligible vendors to create deal will list here] </span></td>
			</tr>		
			<?php else: ?>
			<tr>
				<td><span id="vendorId">Vendor Id</span></td>
				<td>
				<div id="divVendor">
				<input type="text"  name="vendor_id"  value="<?php echo $this->_tpl_vars['actionReturn']['data']['vendor_id']; ?>
" id="vendor_idId"   maxlength="20" class="nummberOnly" onchange="getvalidvendor(this.value,'divVendor')"/>
				</div>
				</td>
			</tr>
			
			<tr>
				<td><span id="salesagent">Sales Agent</span></td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']['sagent']; ?>
</td>
			</tr>
			
			
			<?php endif; ?>
			<tr>
				<td><span id="category">Category</span></td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']['category']; ?>
</td>
			</tr>
			<tr>
				<td><span id="subcategory">Sub-Category</span></td>
				<td><div id="subcatDivId"><?php echo $this->_tpl_vars['actionReturn']['combo']['subcat']; ?>
</div></td>
			</tr>		
			<tr>
				<td><span id="dealname">Deal Name</span></td>
				<td><input type="text"  name="name" value="<?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
" id="nameId" valtype="emptyCheck-Please enter a deal name" size="65"/></td>
			</tr>
			<tr>
				<td><span id="dealcaption">Deal Caption</span></td>
				<td><input type="text"  name="caption" value="<?php echo $this->_tpl_vars['actionReturn']['data']['caption']; ?>
" id="captionId" valtype="emptyCheck-Please enter a deal caption"  size="65"/></td>
			</tr>
		
			<tr>
				<td><span id="dealdiscription">Deal Description</span></td>
				<td><textarea  name="description" id="descriptionId" valtype="emptyCheck-Please enter a deal description"  cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['description']; ?>
</textarea></td>
			</tr>
			<tr>
				<td><span id="dealhightlight">Deal Highlights</span></td>
				<td><textarea  name="highlights" id="highlightsId" cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['highlights']; ?>
</textarea></td>
			</tr>
			<tr>
				<td><span id="directions">Vendor Get Directions Link</span></td>
				<td>
				<input name="get_directions" id="get_directionsId" value="<?php echo $this->_tpl_vars['actionReturn']['data']['get_directions']; ?>
" type="text"  size="65"/>
				
				</td>
			</tr>
			<tr>
				<td><span id="dealprice">Deal Price</span></td>
				<td><input type="text"  name="deal_price" valtype="emptyCheck-Please enter a deal price|checkNumber-Please enter a valid price" value="<?php echo $this->_tpl_vars['actionReturn']['data']['deal_price']; ?>
" id="deal_priceId"   maxlength="10" class="nummberOnly"/></td>
			</tr>
			<tr>
				<td><span id="dealcost">Deal Cost</span></td>
				<td><input type="text"  name="cost" valtype="emptyCheck-Please enter a deal cost|checkNumber-Please enter a valid cost" value="<?php echo $this->_tpl_vars['actionReturn']['data']['cost']; ?>
" id="costId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<?php if (( ! $this->_tpl_vars['actionReturn']['sagent'] )): ?>		

			<tr>
				<td><span id="vendorcomm">Vendor Commission Rate</span></td>
				<td><input type="text"  name="vendor_comm_rate" valtype="emptyCheck-Please enter  vendor commision rate|validateDecimal-Please enter a valid vendor commision rate"   id="vendor_comm_rateId" class="nummberOnly"  maxlength="5" value="<?php if ($this->_tpl_vars['actionReturn']['data']['vendor_comm_rate']): ?><?php echo $this->_tpl_vars['actionReturn']['data']['vendor_comm_rate']; ?>
<?php else: ?><?php echo @GLB_VENDOR_COMM_RATE; ?>
<?php endif; ?>" /> %</td>
			</tr>
			<tr>
				<td><span id="sitecomm">Site Commission Rate</span></td>
				<td><input type="text"  name="site_comm_rate" valtype="emptyCheck-Please enter  site commision rate|validateDecimal-Please enter a valid site commision rate" value="<?php if ($this->_tpl_vars['actionReturn']['data']['site_comm_rate']): ?><?php echo $this->_tpl_vars['actionReturn']['data']['site_comm_rate']; ?>
<?php else: ?><?php echo @GLB_ADMIN_COMM_RATE; ?>
<?php endif; ?>" id="site_comm_rateId" class="nummberOnly"  maxlength="5"/> %</td>
			</tr>
			<tr>
				<td><span id="salesagent">Sales Agent Commission Rate</span></td>
				<td><input type="text"  name="sales_comm_rate"  value="<?php if ($this->_tpl_vars['actionReturn']['data']['sales_comm_rate']): ?><?php echo $this->_tpl_vars['actionReturn']['data']['sales_comm_rate']; ?>
<?php else: ?><?php echo @GLB_AGENT_COMM_RATE; ?>
<?php endif; ?>" id="sales_comm_rateId" class="nummberOnly"  maxlength="5"/> %</td>
			</tr>			
			<?php endif; ?>
			<tr>
				<td><span id="noofvote">No of Votes to Unlock</span></td>
				<td><input type="text"  name="unlockvote" valtype="emptyCheck-Please enter the number of votes|checkNumber-Please enter a valid number" value="<?php echo $this->_tpl_vars['actionReturn']['data']['unlockvote']; ?>
" id="unlockvoteId"  maxlength="8" class="nummberOnly"/></td>
			</tr>
			<tr>
				<td><span id="activationdate">Activation Date</span></td>
				<td><input type="text"  name="activation_date" value="<?php echo $this->_tpl_vars['actionReturn']['data']['activation_date']; ?>
" id="activation_dateId" readonly="readonly"/></td>
			</tr>
			<tr>
				<td><span id="dealpossiblehours">Deal Buying Hours</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter a deal buying hours|checkNumber-Please enter a valid deal buying hour" name="unlock_active_hours" value="<?php if ($this->_tpl_vars['actionReturn']['data']['unlock_active_hours']): ?><?php echo $this->_tpl_vars['actionReturn']['data']['unlock_active_hours']; ?>
<?php else: ?><?php echo @GLB_DEAL_ACTIVE_HOURS; ?>
<?php endif; ?>" id="unlock_active_hoursId" class="nummberOnly"  maxlength="5"/></td>
			</tr>
			<tr>
				<td><span id="totalqty">Total Quantity</span></td>
				<td><input type="text"  name="total_quantity"  valtype="emptyCheck-Please enter a quantity|checkNumber-Please enter a valid quantity" value="<?php echo $this->_tpl_vars['actionReturn']['data']['total_quantity']; ?>
" id="total_quantityId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td><span id="customermaxbuylimit">Customer Maximum Buy Limit</span></td>
				<td><input type="text"  name="cust_maxbuy" valtype="emptyCheck-Please enter the maximum buy limit|checkNumber-Please enter a valid buy limit"  value="<?php echo $this->_tpl_vars['actionReturn']['data']['cust_maxbuy']; ?>
" id="cust_maxbuyId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td><span id="customermaximumgiftpurchase">Customer Maximum Gift Purchase</span></td>
				<td><input type="text"  name="cust_maxbuy_gift"  valtype="emptyCheck-Please enter the maximum Gift Purchase limit|checkNumber-Please enter a valid  limit" value="<?php echo $this->_tpl_vars['actionReturn']['data']['cust_maxbuy_gift']; ?>
" id="cust_maxbuy_giftId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td><span id="maximumpurchaseallowed">Maximum Purchases Allowed</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the maximum purchase limit|checkNumber-Please enter a valid  limit" name="cust_buylimit" value="<?php echo $this->_tpl_vars['actionReturn']['data']['cust_buylimit']; ?>
" id="cust_maxbuy_giftId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td><span id="noofdaysdealpossible">No: of days a Deal Possible</span></td>
				<td><input type="text"  name="deal_days"  valtype="emptyCheck-Please enter the number of days|checkNumber-Please enter a valid number of days"  value="<?php echo $this->_tpl_vars['actionReturn']['data']['deal_days']; ?>
" id="deal_daysId" class="nummberOnly"  maxlength="5" /></td>
			</tr>
			<tr>
				<td><span id="noofdaysincooldown">No: of days in Cool Down</span></td>
				<td><input type="text"  name="cooldown_days" valtype="emptyCheck-Please enter the number of days|checkNumber-Please enter a valid number of days"  value="<?php if ($this->_tpl_vars['actionReturn']['data']['cooldown_days']): ?><?php echo $this->_tpl_vars['actionReturn']['data']['cooldown_days']; ?>
<?php else: ?><?php echo @GLB_DEAL_COOLDOWN_DAYS; ?>
<?php endif; ?>" id="cooldown_daysId" class="nummberOnly"  maxlength="5"/></td>
			</tr>
			<tr>
				<td><span id="couponactivehours">Coupon Active Hours</span></td>
				<td><input type="text"  name="coupon_active_hour"  valtype="emptyCheck-Please enter the number of hours|checkNumber-Please enter a valid number of hours" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_active_hour']; ?>
" id="coupon_active_hourId" class="nummberOnly"  maxlength="4"/></td>
			</tr>
			<tr>
				<td><span id="couponexpirydays">Coupon Expiry Days</span></td>
				<td><input type="text"  name="coupon_expiry_days" valtype="emptyCheck-Please enter the number of days|checkNumber-Please enter a valid number of days"  value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_expiry_days']; ?>
" id="coupon_expiry_daysId" class="nummberOnly"  maxlength="5"//></td>
			</tr>
			<tr>
				<td><span id="rules">Rules</span></td>
				<td><textarea  name="rules" id="rulesId"  valtype="emptyCheck-Please enter the rules" cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['rules']; ?>
</textarea></td>
			</tr>
			<tr>
				<td><span id="imageId">Image</span></td>
				<td><input type="file"  name="fileImage" value="<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" id="fileImageId" />
				<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
				<a  href="../images/deals/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
				 <img src="../images/deals/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="25" height="25"/>
				</a>
				<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td><span id="image1Id">Thumb Image</span></td>
				<td><input type="file"  name="fileImage1" value="<?php echo $this->_tpl_vars['actionReturn']['data']['thumb_image']; ?>
" id="fileImage1Id" />
				<?php if ($this->_tpl_vars['actionReturn']['data']['thumb_image']): ?>
				 <img src="../images/deals/thumb190x80/<?php echo $this->_tpl_vars['actionReturn']['data']['thumb_image']; ?>
" width="25" height="25"/>
				
				<?php endif; ?>
				</td>
			</tr>
			<tr>				
				<td>&nbsp;</td>
				<td>
					<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Save" id="saveDataId" 
					onclick="return dealValidation();"/>
					
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
		</form>
	</td>
</tr>
<?php endif; ?>
<?php endif; ?>	


<?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2">
	<form action="" name="formEdit" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Edit Deals</th>
			</tr>
			<?php if (( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_PENDING ) || ( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_ACCEPTED ) || ( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_LOCKED )): ?>	
			<?php if (( ! $this->_tpl_vars['actionReturn']['sagent'] )): ?>
			<tr>
				<td><span id="salesagent">Sales Agent</span></td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']['sagent']; ?>
</td>
			</tr>
			<?php endif; ?>
			<?php endif; ?>
			
			<?php if (( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_PENDING ) || ( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_ACCEPTED && $this->_tpl_vars['actionReturn']['data']['today'] <= $this->_tpl_vars['actionReturn']['data']['activation_date'] )): ?>	
			<tr>
				<td><span id="category_list">Category</span> </td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']['category']; ?>
</td>
			</tr>
			<tr>
				<td><span id="subcatgory">Sub-Category </span></td>
				<td><div id="subcatDivId"><?php echo $this->_tpl_vars['actionReturn']['combo']['subcat']; ?>
</div></td>
			</tr>	
			
			
			<tr>
				<td><span id="dealname">Deal Name </span></td>
				<td><input type="text" valtype="emptyCheck-Please enter a deal name" name="name" value="<?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
" id="nameId"  size="65"/></td>
			</tr>
			<?php endif; ?>
			<tr>
				<td><span id="dealcaption">Deal Caption</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter a deal caption" name="caption" value="<?php echo $this->_tpl_vars['actionReturn']['data']['caption']; ?>
" id="captionId"  size="65"/></td>
			</tr>
		
			<tr>
				<td><span id="dealdiscription">Deal Description</span></td>
				<td><textarea  name="description" valtype="emptyCheck-Please enter a deal discription" id="descriptionId" cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['description']; ?>
 </textarea></td>
			</tr>
			<tr>
				<td><span id="dealhiglight">Deal Highlights</span></td>
				<td><textarea  name="highlights" id="highlightsId" cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['highlights']; ?>
</textarea></td>
			</tr>
			<tr>
				<td><span id="directions">Vendor Get Directions Link</span></td>
				<td>
				<input name="get_directions" id="get_directionsId" value="<?php echo $this->_tpl_vars['actionReturn']['data']['get_directions']; ?>
" type="text"  size="65"/>
				
				</td>
			</tr>
			<?php if (( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_PENDING )): ?>		
			<tr>
				<td><span id="dealprice">Deal Price</span></td>
				<td><input type="text"  name="deal_price" valtype="emptyCheck-Please enter a deal price|checkNumber-Please enter a valid price" value="<?php echo $this->_tpl_vars['actionReturn']['data']['deal_price']; ?>
" id="deal_priceId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td><span id="dealcost">Deal Cost</span></td>
				<td><input type="text"  name="cost" valtype="emptyCheck-Please enter a deal cost|checkNumber-Please enter a valid cost"  value="<?php echo $this->_tpl_vars['actionReturn']['data']['cost']; ?>
" id="costId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<?php endif; ?>	
			<?php if (( ! $this->_tpl_vars['actionReturn']['sagent'] ) && ( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_PENDING ) || ( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_ACCEPTED ) || ( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_LOCKED )): ?>		

			<tr>
				<td><span id="vendorcomm">Vendor Commission Rate</span></td>
				<td><input type="text"  name="vendor_comm_rate" valtype="emptyCheck-Please enter  vendor commision rate|validateDecimal-Please enter a valid vendor commision rate"   id="vendor_comm_rateId" class="nummberOnly"  maxlength="5" value="<?php echo $this->_tpl_vars['actionReturn']['data']['vendor_comm_rate']; ?>
" /> %</td>
			</tr>
			<tr>
				<td><span id="sitecomm">Site Commission Rate</span></td>
				<td><input type="text"  name="site_comm_rate" valtype="emptyCheck-Please enter  site commision rate|validateDecimal-Please enter a valid site commision rate" value="<?php echo $this->_tpl_vars['actionReturn']['data']['site_comm_rate']; ?>
" id="site_comm_rateId" class="nummberOnly"  maxlength="5"/> %</td>
			</tr>
			<tr>
				<td><span id="salesagent">Sales Agent Commission Rate</span></td>
				<td><input type="text"  name="sales_comm_rate"  value="<?php echo $this->_tpl_vars['actionReturn']['data']['sales_comm_rate']; ?>
" id="sales_comm_rateId" class="nummberOnly"   maxlength="5"/> %</td>
			</tr>
			<tr>
				<td><span id="noofvotetounlock">No of Votes to Unlock</span></td>
				<td><input type="text"  name="unlockvote" valtype="emptyCheck-Please enter the number of votes|checkNumber-Please enter a valid number" value="<?php echo $this->_tpl_vars['actionReturn']['data']['unlockvote']; ?>
" id="unlockvoteId" class="nummberOnly"  maxlength="8"/></td>
			</tr>
			<?php endif; ?>
			<?php if (( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_PENDING ) || ( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_ACCEPTED && $this->_tpl_vars['actionReturn']['data']['today'] <= $this->_tpl_vars['actionReturn']['data']['activation_date'] )): ?>		
			<tr>
				<td><span id="activationdate">Activation Date</span></td>
				<td><input type="text"  name="activation_date" value="<?php echo $this->_tpl_vars['actionReturn']['data']['activation_date']; ?>
" id="activation_dateId" readonly="readonly"/></td>
			</tr>
			<?php endif; ?>	
			<tr>
				<td><span id="dealpossiblehrs">Deal buying hours</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter a deal possible hours|checkNumber-Please enter a valid deal possible hour" name="unlock_active_hours" value="<?php echo $this->_tpl_vars['actionReturn']['data']['unlock_active_hours']; ?>
" id="unlock_active_hoursId" class="nummberOnly"  maxlength="5"/></td>
			</tr>
			<tr>
				<td><span id="totalqty">Total Quantity</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter a quantity|checkNumber-Please enter a valid quantity" name="total_quantity" value="<?php echo $this->_tpl_vars['actionReturn']['data']['total_quantity']; ?>
" id="total_quantityId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td><span id="customemaxbuylimit">Customer Maximum Buy Limit</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the maximum buy limit|checkNumber-Please enter a valid buy limit" name="cust_maxbuy" value="<?php echo $this->_tpl_vars['actionReturn']['data']['cust_maxbuy']; ?>
" id="cust_maxbuyId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td><span id="customermaxgift">Customer Maximum Gift Purchase</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the maximum Gift Purchase limit|checkNumber-Please enter a valid  limit" name="cust_maxbuy_gift" value="<?php echo $this->_tpl_vars['actionReturn']['data']['cust_maxbuy_gift']; ?>
" id="cust_maxbuy_giftId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td><span id="maximumpurchaseallowed">Maximum Purchases Allowed</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the maximum Purchase limit|checkNumber-Please enter a valid  limit" name="cust_buylimit" value="<?php echo $this->_tpl_vars['actionReturn']['data']['cust_buylimit']; ?>
" id="cust_maxbuy_giftId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<?php if (( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_PENDING ) || ( $this->_tpl_vars['actionReturn']['data']['status'] == @GLB_DEAL_ACCEPTED )): ?>		
			<tr>
				<td><span id="numberofdays">No: of days a Deal Possible</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the number of days|checkNumber-Please enter a valid number of days" name="deal_days" value="<?php echo $this->_tpl_vars['actionReturn']['data']['deal_days']; ?>
" id="deal_daysId" class="nummberOnly"  maxlength="5" /></td>
			</tr>
			<?php endif; ?>
			<tr>
				<td><span id="noofdayscooldown">No: of days in Cool Down</span></td>
				<td><input type="text"  name="cooldown_days" valtype="emptyCheck-Please enter the number of days|checkNumber-Please enter a valid number of days" value="<?php echo $this->_tpl_vars['actionReturn']['data']['cooldown_days']; ?>
" id="cooldown_daysId" class="nummberOnly"  maxlength="5"/></td>
			</tr>
			<tr>
				<td><span id="couponActiv">Coupon Active Hours</span></td>
				<td><input type="text"  name="coupon_active_hour" valtype="emptyCheck-Please enter the number of hours|checkNumber-Please enter a valid number of hours" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_active_hour']; ?>
" id="coupon_active_hourId" class="nummberOnly"  maxlength="4"/></td>
			</tr>
			<tr>
				<td><span id="coupounExpiry">Coupon Expiry Days</span></td>
				<td><input type="text"  name="coupon_expiry_days" valtype="emptyCheck-Please enter the number of days|checkNumber-Please enter a valid number of days" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_expiry_days']; ?>
" id="coupon_expiry_daysId" class="nummberOnly"  maxlength="5"//></td>
			</tr>
			<tr>
				<td><span id="rules">Rules</span></td>
				<td><textarea  name="rules" id="rulesId" valtype="emptyCheck-Please enter the rules" cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['rules']; ?>
 </textarea></td>
			</tr>
			<tr>
				<td><span id="imageId">Image</span></td>
				<td><input type="file"  name="fileImage" value="<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" id="fileImageId" />  				
				<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
				<a  href="../images/deals/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
				<img src="../images/deals/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="25" height="25"/>
				</a>
				<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td><span id="image1Id">Thumb Image</span></td>
				<td><input type="file"  name="fileImage1" value="<?php echo $this->_tpl_vars['actionReturn']['data']['thumb_image']; ?>
" id="fileImage1Id" />
				<?php if ($this->_tpl_vars['actionReturn']['data']['thumb_image']): ?>
				 <img src="../images/deals/thumb190x80/<?php echo $this->_tpl_vars['actionReturn']['data']['thumb_image']; ?>
" width="25" height="25"/>
				
				<?php endif; ?>
				</td>
			</tr>
			<tr>				
				<td>&nbsp;</td>
				<td>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Update" id="saveDataId" />				
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
		</form>
	</td>
</tr>
<?php endif; ?>	
<?php endif; ?>
<form action="" name="formName" method="post" enctype="multipart/form-data">	
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Viewform' )): ?>
<?php if ($this->_tpl_vars['actionReturn']['data']): ?>

<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2">
	
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<?php if ($this->_tpl_vars['actionReturn']['data']['caption']): ?>
			<tr>
				<th colspan="2"><?php echo $this->_tpl_vars['actionReturn']['data']['caption']; ?>
</th>
			</tr>
			<?php endif; ?>
				<tr>
					<td width="50%">
						<div class="boxList">
					<div>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
					<tr>
						<th colspan="3" ><div align="left"><strong> <?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
</strong></div></th>
					</tr>
					<tr>
						<td width="175" >Created On</td>
							<td colspan="2"><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['date_added']); ?>
 <strong> via 
								<?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_site_apps','apps',$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['apps_id'])); ?>

								</strong>
							</td>
						</tr>
						<td width="175" >Created By</td>
							<td ><?php if ($this->_tpl_vars['actionReturn']['data']['added_by'] == 0): ?> Self
							<?php else: ?>							
								<?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\' \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['added_by'])); ?>

								</td>
							<?php endif; ?>
							<td>
								<?php if ($this->_tpl_vars['actionReturn']['data']['added_by'] == 0): ?>
								<a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewvendor','',true); ?>
&user=<?php echo $this->_tpl_vars['actionReturn']['data']['vendor_id']; ?>
"  title="Click here to view <?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_vendor','business_name',$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['vendor_id'])); ?>
's details">
									 View More
								</a>
								
								<?php else: ?>	
								<a  target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewadmin','',true); ?>
&user=<?php echo $this->_tpl_vars['actionReturn']['data']['saleagent_id']; ?>
"  title="Click here to view <?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\' \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['added_by'])); ?>
's details">
									View More
								</a>
								<?php endif; ?>
							</td>	
						</tr>
						<?php if ($this->_tpl_vars['actionReturn']['data']['activation_date'] <> 0): ?>
						<tr>
							<td>Activated On</td>
							<td colspan="2"><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['actionReturn']['data']['activation_date']); ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['unlocked_date'] <> 0): ?>
						<tr>
							<td>Unlocked On</td>
							<td colspan="2"><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['unlocked_date']); ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['cooldown_date'] <> 0): ?>
						<tr>
							<td>Cooled Down On</td>
							<td colspan="2"><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['cooldown_date']); ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['expired_date'] <> 0): ?>
						<tr>
							<td>Expired On</td>
							<td colspan="2"><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['expired_date']); ?>
</td>
						</tr>
						<?php endif; ?>
						<tr>
							<td>Sold Quantity</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['sold_quantity']; ?>
/<?php echo $this->_tpl_vars['actionReturn']['data']['total_quantity']; ?>
 
							</td>
							<td>
							<?php if ($this->_tpl_vars['actionReturn']['data']['sold_quantity'] > 0): ?>
							 <a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewcoupon','',true); ?>
"  title="Click here to view purchase details">
								View More
							</a>
							<?php endif; ?>
							</td>
						</tr>
						
						<tr>
							<td>Votes</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['votes']; ?>
/<?php echo $this->_tpl_vars['actionReturn']['data']['unlockvote']; ?>
 
							
							</td>
							<td>
							<?php if ($this->_tpl_vars['actionReturn']['data']['votes'] > 0): ?>
							<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewvotes','',true); ?>
&deal=<?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
"  title="Click here to view voting details">
								View More
							</a>
							<?php endif; ?>
							</td>
						</tr>
					</table>
					</div>
					<div>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
								<th colspan="2" ><div align="left">Deal Condition Details</div></th>
							</tr>
							<tr>
								<td width="175">Max Purchase per Customer</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['cust_maxbuy']; ?>
</td>
							</tr>
								<td width="175">Purchase Limit</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['cust_buylimit']; ?>
</td>
							</tr>
							
							
							<tr>
								<td>Days Available</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['deal_days']; ?>
</td>
							</tr>
							<tr>
								<td>Cool Down Days </td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['cooldown_days']; ?>
</td>
							</tr>
							<tr>
								<td> Hours need to Activate Coupon </td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['coupon_active_hour']; ?>
 hrs <?php if ($this->_tpl_vars['actionReturn']['data']['unlocked_date'] <> 0): ?>from <?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['unlocked_date']); ?>
<?php endif; ?></td>
							</tr>
							<tr>
								<td>Coupon Expiry Days </td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['coupon_expiry_days']; ?>
 Days from the Coupon Activation</td>
							</tr>
							<?php if ($this->_tpl_vars['actionReturn']['data']['coupon_expiry_date'] <> 0): ?>
							<tr>
								<td>Coupon Expiry Date</td>
								<td><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['coupon_expiry_date']); ?>
 </td>
							</tr>
							<?php endif; ?>
							<tr>
								<td>Cool Down Days </td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['cooldown_days']; ?>
</td>
							</tr>
						</table>
					</div>
					
					
					
				<?php if (( $this->_tpl_vars['actionReturn']['data']['cost'] <> 0 ) || ( $this->_tpl_vars['actionReturn']['data']['deal_price'] <> 0 )): ?>
				<div>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
					<tr>
							<th colspan="2" ><div align="left">Price Details</div></th>
						</tr>
						<?php if ($this->_tpl_vars['actionReturn']['data']['cost'] <> 0): ?>
						<tr>
							<td width="175">Cost Value</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['cost']; ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if (( $this->_tpl_vars['actionReturn']['data']['cost'] <> 0 ) && ( $this->_tpl_vars['actionReturn']['data']['deal_price'] <> 0 )): ?>
						<tr>
							<td>Save Value</td>
							<td>$<?php echo smarty_function_math(array('equation' => "x-y",'x' => $this->_tpl_vars['actionReturn']['data']['cost'],'y' => $this->_tpl_vars['actionReturn']['data']['deal_price']), $this);?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['deal_price'] <> 0): ?>
						<tr>
							<td>Deal Value</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['deal_price']; ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['offer_rate'] <> 0): ?>
						<tr>
							<td>Offer Rate</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['offer_rate']; ?>
%</td>
						</tr>
						<?php endif; ?>
					</table>
				</div>
				<?php endif; ?>
					
				<div>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
					<tr>
							<th colspan="2" ><div align="left">Commission Details
							<span class="ik" closure_uid_1haz6r="564">
							<img id="upi" class="QrVm3d" name="upi" src="images/cleardot.gif" width="16" height="16" closure_uid_1haz6r="563" jid="sreerajvr.reubro@gmail.com" /></span></div></th>

						</tr>
						<tr>
							<td width="175">Vendor Commission Rate </td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['vendor_comm_rate']; ?>
%</td>
						</tr>
						<tr>
							<td>Vendor Commission per Deal </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['vendor_commision']; ?>
 </td>
						</tr>
						<tr>
							<td>Site Commission Rate </td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['site_comm_rate']; ?>
%</td>
						</tr>
						<tr>
							<td>Site Commission per Deal </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['site_commision']; ?>

							</td>
						</tr>
						<tr>
							<td>Sales Agent Commission Rate </td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['sales_comm_rate']; ?>
% of Site Commission</td>
						</tr>
						<tr>
							<td>Sales Agent Commission per Deal </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['sales_commision']; ?>
 </td>
						</tr>
					</table>
				</div>
			</div>
			</td>
			<td width="50%">
				<div class="boxList">
				<?php if (( $this->_tpl_vars['actionReturn']['data']['description'] ) || ( $this->_tpl_vars['actionReturn']['data']['subcategory_id'] <> 0 )): ?>	
						<div>
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">					
								<tr>
									<th colspan="2" ><div align="left">About Deal</div></th>
								</tr>
								<?php if ($this->_tpl_vars['actionReturn']['data']['subcategory_id'] <> 0): ?>
								<tr>
									<td width="150">Category</td>
									<td>
									<?php echo $this->_tpl_vars['actionReturn']['data']['category']; ?>
 -> 
									<?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_category_sub','subcategory',$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['subcategory_id'])); ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['description']): ?>
								<tr>
									<td colspan="2">							
									<p >
									<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
									<a  href="../images/deals/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
									<img src="../images/deals/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="100" height="125" style="float:right;"/>
									</a><?php endif; ?><?php echo $this->_tpl_vars['obj']->nl2br($this->_tpl_vars['actionReturn']['data']['description']); ?>
 
									</p>
									</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['highlights']): ?>
								<tr>
									<td width="150">Highlights</td>
									<td>						
									<?php echo $this->_tpl_vars['obj']->nl2br($this->_tpl_vars['actionReturn']['data']['highlights']); ?>
</td>
								</tr>
								<?php endif; ?>
							</table>
						</div>
					<?php endif; ?>
			
			<?php if ($this->_tpl_vars['actionReturn']['payData']): ?> 	
				<div>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th colspan="5" ><div align="left">Sold & Commission Details</div></th>
						</tr>
						<tr>
							<td>Sold Quantity</td>
							<td colspan="4"><?php echo $this->_tpl_vars['actionReturn']['payData']['sold_quantity']; ?>
</td>
						</tr>
						<tr>
							<td>Unit Deal Price</td>
							<td colspan="4">$<?php echo $this->_tpl_vars['actionReturn']['payData']['unit_amount']; ?>
</td>
						</tr>
						<tr>
							<td>Total Deal Price</td>
							<td colspan="4">$<?php echo $this->_tpl_vars['actionReturn']['payData']['total_amount']; ?>
</td>
						</tr>
						<tr>
							<th>Commission Type</th>
							<th>Total</th>
							<th>Paid</th>
							<th>Balance</th>
							<th>&nbsp;</th>
						</tr>
						<tr>
							<td>Vendor</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['total_comm_vendor']; ?>
 </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['used_comm_vendor']; ?>
 </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['balance_comm_vendor']; ?>
 </td>
							<td>
							<?php if ($this->_tpl_vars['actionReturn']['payData']['used_comm_vendor'] > 0): ?> 
						
							<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewvendorpay','',true); ?>
&deal=<?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
" title="Click here to view vendor commission details">
								View More
							</a>
							<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td>Site</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['total_comm_site']; ?>
 </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['used_comm_site']; ?>
 </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['balance_comm_site']; ?>
 </td>
						</tr>
						<tr>
							<td>Sales Agent </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['total_comm_sales']; ?>
 </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['used_comm_sales']; ?>
 </td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['payData']['balance_comm_sales']; ?>
 </td>
							<td><?php if ($this->_tpl_vars['actionReturn']['data']['saleagent_id'] <> 0 && $this->_tpl_vars['actionReturn']['payData']['used_comm_sales'] > 0): ?> 
							
								<a  class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewsalespay','',true); ?>
&deal=<?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
" 
								 title="Click here to view sales agent commission details">
								View More
								</a>
							<?php endif; ?> 
							</td>
						</tr>
						<tr>
							<td>Net Total</td>
							<td>$ <?php echo smarty_function_math(array('equation' => "x+y+z",'x' => $this->_tpl_vars['actionReturn']['payData']['total_comm_vendor'],'y' => $this->_tpl_vars['actionReturn']['payData']['total_comm_site'],'z' => $this->_tpl_vars['actionReturn']['payData']['total_comm_sales']), $this);?>

							</td>
							<td>$<?php echo smarty_function_math(array('equation' => "x+y+z",'x' => $this->_tpl_vars['actionReturn']['payData']['used_comm_vendor'],'y' => $this->_tpl_vars['actionReturn']['payData']['used_comm_site'],'z' => $this->_tpl_vars['actionReturn']['payData']['used_comm_sales']), $this);?>
</td>
							<td>$<?php echo smarty_function_math(array('equation' => "x+y+z",'x' => $this->_tpl_vars['actionReturn']['payData']['balance_comm_vendor'],'y' => $this->_tpl_vars['actionReturn']['payData']['balance_comm_site'],'z' => $this->_tpl_vars['actionReturn']['payData']['balance_comm_sales']), $this);?>
</td>
							<td>&nbsp;</td>
						</tr>
						
						
						
					</table>
				</div>
			<?php endif; ?>
				
			<?php if ($this->_tpl_vars['actionReturn']['orderData']): ?> 	
				<div>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th colspan="3" ><div align="left">Purchased Coupon Details</div></th>
						</tr>
						<tr>
							<td width="150">Total Coupons</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['orderCnt']; ?>
 </td>
							<td> <a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewcoupon','',true); ?>
" title="Click here to view coupon details">
								View More
							</a>
							</td>
						</tr>
						<tr>
							<td>Total Redeemed Coupons</td>
							<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['data']['redeemCnt']; ?>
</td>
						</tr>
						<tr>
							<td>Total Not Redeemed Coupons</td>
							<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['data']['notRedeemCnt']; ?>
</td>
						</tr>
					</table>
				</div>
			<?php endif; ?>	
				
					
				<div>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
					<tr>
							<th colspan="3" ><div align="left">Deal Status Details</div></th>
						</tr>					
						
						<?php if ($this->_tpl_vars['actionReturn']['data']['status_updateby'] <> 0): ?>	
						<tr>
							<td width="150">Deal Status Updated By  </td>
							<td>						
							<?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\' \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['status_updateby'])); ?>

</td><td>
<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewadmin','',true); ?>
&user=<?php echo $this->_tpl_vars['actionReturn']['data']['status_updateby']; ?>
"  title="Click here to view <?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\' \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['status_updateby'])); ?>
's details">
								 View More
							</a>
							</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['status_updatedate'] <> 0): ?>	
						<tr>
							<td>Deal Status Updated Date  </td>
							<td colspan="2" ><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['status_updatedate']); ?>
</td>
						</tr>
						<?php endif; ?>						
						<tr>
							<td>Deal Status </td>
							<td >
								<?php if ($this->_tpl_vars['actionReturn']['data']['status'] == GLB_DEAL_PENDING): ?>  Under Review								
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == GLB_DEAL_ACCEPTED): ?> Approved & in Queue
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == GLB_DEAL_REJECTED): ?> Rejected
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == GLB_DEAL_LOCKED): ?>   Locked for Voting
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == GLB_DEAL_UNLOCKED): ?> Unlocked for Buying
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == GLB_DEAL_COOLDOWN): ?> In Cool Down
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == GLB_DEAL_EXPIRED): ?>  Expired
							<?php endif; ?></td>
							<td>
								<?php if ($this->_tpl_vars['actionReturn']['data']['status'] == GLB_DEAL_PENDING): ?> 				
								   <strong> <a href="#" onclick="display(<?php echo $this->_tpl_vars['actionReturn']['data']['id']; ?>
,<?php echo 1; ?>
);" style="color:#669933"> Accept </a> |  <a  href="#"  onclick="display(<?php echo $this->_tpl_vars['actionReturn']['data']['id']; ?>
,<?php echo 2; ?>
);" style="color:#FF3300"> Reject </a></strong>
<!--								 <img src="images/active.gif" border="0" title="Click here to accept" onclick="display(<?php echo $this->_tpl_vars['actionReturn']['data']['id']; ?>
,<?php echo 1; ?>
);">  <img src="images/inactive.gif" border="0" title="Click here to reject" onclick="display(<?php echo $this->_tpl_vars['actionReturn']['data']['id']; ?>
,<?php echo 2; ?>
);">
-->								
								<?php endif; ?>							
							</td>
						</tr>	
						<tr>
						<td>Deal Block Status</td>
						<td><?php if ($this->_tpl_vars['actionReturn']['data']['block_status'] == 0): ?> Not Blocked
						<?php else: ?>Blocked<?php endif; ?></td>
						</tr>					
					</table>
				</div>
				
				<?php if ($this->_tpl_vars['actionReturn']['data']['vendor_id'] <> 0): ?>
					<div>
						<table  width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
								<th colspan="3" ><div align="left">Deal Owner Details</div></th>
							</tr>
							<?php if ($this->_tpl_vars['actionReturn']['data']['vendor_id'] <> 0): ?>
							<tr>
								<td width="150">Vendor</td>
								<td>
								<?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_vendor','business_name',$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['vendor_id'])); ?>

								</td>
								<td>
								
								<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewvendor','',true); ?>
&user=<?php echo $this->_tpl_vars['actionReturn']['data']['vendor_id']; ?>
"  title="Click here to view <?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_vendor','business_name',$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['vendor_id'])); ?>
's details">
									 View More
								</a>
								</td>
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['data']['get_directions']): ?>
							<tr>
								<td width="150">Get Direction Link</td>
								<td colspan="2">
								<a href="<?php echo $this->_tpl_vars['actionReturn']['data']['get_directions']; ?>
" title="Click here to get directions of vendor" target="_blank">
								
								<span title="<?php echo $this->_tpl_vars['actionReturn']['data']['get_directions']; ?>
"><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['actionReturn']['data']['get_directions'],30); ?>
</span>
								
								</a>
								</td>
								
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['data']['saleagent_id'] <> 0): ?>
							<tr>
								<td >Sales Incharge</td>
								<td>
								<?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\' \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['saleagent_id'])); ?>

								</td><td>
								<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewadmin','',true); ?>
&user=<?php echo $this->_tpl_vars['actionReturn']['data']['saleagent_id']; ?>
" title="Click here to view <?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\' \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['saleagent_id'])); ?>
's details">
									View More
								</a>
								</td>
							</tr>
							<?php endif; ?>
						</table>					
					</div>
				<?php endif; ?>				
					
				<?php if ($this->_tpl_vars['actionReturn']['data']['rules']): ?>	
					<div>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th colspan="2" ><div align="left">Rules & Regulations</div></th>
						</tr>
						<tr>
							<td colspan="2"><?php echo $this->_tpl_vars['obj']->nl2br($this->_tpl_vars['actionReturn']['data']['rules']); ?>
</td>
						</tr>
					</table>
					</div>
				<?php endif; ?>

				</div>
			</td>
		</tr>
								
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" class="butsubmit"  name="actionvar" value="Back" id="cancelId" />
				</td>
			</tr>
		</table>
		
	</td>
</tr>
<?php endif; ?>	
<?php endif; ?>

<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>

<tr>
	
	<td colspan="2">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'dealSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<!--<th width="70"><input type="checkbox" name="checkall" id="id_check_all" ></th>-->
							<th>No</th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Name
							<?php echo $this->_tpl_vars['obj']->getSortImage('name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=business_name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('business_name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=deal_price&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Price
							<?php echo $this->_tpl_vars['obj']->getSortImage('deal_price',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=sold_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Sold
							<?php echo $this->_tpl_vars['obj']->getSortImage('sold_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a>/<a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=total_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total<?php echo $this->_tpl_vars['obj']->getSortImage('total_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 <th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=status&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Status
							<?php echo $this->_tpl_vars['obj']->getSortImage('status',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>	
							<th >Blocked</th>					
							<th width="90" colspan="4">Action </th>

						</tr>
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<!--<td><input type="checkbox" name="checkone" id="id_chk_checkone" ></td>-->
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['name'],30); ?>
</td>							
							<td><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['business_name'],20); ?>
</td>
							<td>$<?php echo $this->_tpl_vars['data']['deal_price']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['sold_quantity']; ?>
/<?php echo $this->_tpl_vars['data']['total_quantity']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['data']['status'] == GLB_DEAL_PENDING): ?>  	Under Review								
							<?php elseif ($this->_tpl_vars['data']['status'] == GLB_DEAL_ACCEPTED): ?> Approved & in Queue
							<?php elseif ($this->_tpl_vars['data']['status'] == GLB_DEAL_REJECTED): ?> Rejected
							<?php elseif ($this->_tpl_vars['data']['status'] == GLB_DEAL_LOCKED): ?>   Locked for Voting
							<?php elseif ($this->_tpl_vars['data']['status'] == GLB_DEAL_UNLOCKED): ?> Unlocked for Buying
							<?php elseif ($this->_tpl_vars['data']['status'] == GLB_DEAL_COOLDOWN): ?> In Cool Down
							<?php elseif ($this->_tpl_vars['data']['status'] == GLB_DEAL_EXPIRED): ?>  Expired
							<?php endif; ?>
							</td>
							<td>
							
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Blockstatuschange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<?php endif; ?>
									<?php if ($this->_tpl_vars['data']['block_status'] == 1): ?> 
									<img src="images/active.gif" border="0" title="Click here to unblock this deal" alt="Blocked Deal">
									 <?php else: ?> 							 
									 <img src="images/inactive.gif" border="0" title="Click here to block this deal" alt="Visible Deal">
									 <?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
							 </a> 
							<?php endif; ?>
							
							</td>
							<td>
							
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('viewform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/view.gif" border="0" title="Click here to view" /> </a>
							<?php endif; ?>
							</td>
							<td>
							
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
							<?php if (( $this->_tpl_vars['data']['status'] == @GLB_DEAL_PENDING ) || ( $this->_tpl_vars['data']['status'] == @GLB_DEAL_ACCEPTED ) || ( $this->_tpl_vars['data']['status'] == @GLB_DEAL_LOCKED ) || ( $this->_tpl_vars['data']['status'] == @GLB_DEAL_UNLOCKED )): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit" /></a> 
							<?php else: ?>
								<span title="No edit possible for this deal" style="cursor:pointer"> --- </span>
							<?php endif; ?>
							
							<?php endif; ?>	
							</td>
							<td>			
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
							<?php if (( $this->_tpl_vars['data']['status'] == @GLB_DEAL_PENDING )): ?>
							<a onclick="return deleteRequest(<?php echo $this->_tpl_vars['data']['id']; ?>
);"  class="Second_link"  >
							<img src="images/delete.gif" border="0" title="Click here to delete" /></a> 
							<?php else: ?>
								<span title="No delete possible for this deal" style="cursor:pointer"> --- </span>
							<?php endif; ?>
							
							<?php endif; ?>
							</td>
							<td>
							<?php if (! $this->_tpl_vars['data']['podPosted']): ?>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Topod','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link" title="Click here to post this deal in Pickondeals.com">
							<strong>POD</strong></a> 
							<?php else: ?><span title="Already posted in Pick on Deals" style="cursor:pointer"> --- </span>							
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td><!--<input class="butsubmit" value="Delete" type="submit" name="actionvar" id="id_btn_delete">--> </td>
						<td colspan="12"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
				</td>
			</tr>
		<?php endif; ?>
		
		</table>
	</td>
	
</tr>
<?php endif; ?>
</form>
</table>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>




