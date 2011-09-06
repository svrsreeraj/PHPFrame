<?php /* Smarty version 2.6.19, created on 2011-03-07 16:12:26
         compiled from pod_listing.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>

<?php echo '
<script type="text/javascript" src="js/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.sortable.js"></script>

<script type="text/javascript">
function getStates(cid,changeId)
	{
		$("#"+changeId).html("Loading...");
		$.ajax({
			   type	: "GET",
			   url	: "pod_listing.php",
			   data	: "actionvar=Getstatecombo&cid="+cid,
			   dataType: "html",
			   success: function(msg){
				 $("#"+changeId).html(msg); 	
				}
			 });
	}
	function display(id,status)
		{
			jConfirm(\'Are you sure you want to change Coupon Status?\', \'Confirmation Dialog\', 
			function(stat) 
				{
					if(stat==true)	
						{
							window.location="pod_listing.php?actionvar=Statuschange&id="+id+"&status="+status;
						}
					else
						{
							return false;
						}	
				});
		}
$(document).ready(function() {
	$("#dealid").tooltip();
	$("#couponname").tooltip();
	$("#couponcaption").tooltip();
	$("#vendor").tooltip();
	$("#activationdate").tooltip();
	$("#coupondays").tooltip();
	$("#dateadded").tooltip();
	$("#image").tooltip();
	$("#couponexpirydays").tooltip();
	$("#description").tooltip();
	$("#highlights").tooltip();
	$("#rules").tooltip();
	$("#category").tooltip();
	$("#subcategory").tooltip();
	$("#caption").tooltip();
	$("#interestedcategories").tooltip();
	$("#totalsitepoint").tooltip();
	$("#balancesitepoint").tooltip();
		
	$("#txt_join_from").datepicker();
	$("#txt_join_from").datepicker(\'option\',
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

	$("#txt_join_to").datepicker();
	$("#txt_join_to").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});
	$("#ActivationDate").datepicker();
	$("#ActivationDate").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});
	$("#expirydate").datepicker();
	$("#expirydate").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});
	$("#addeddate").datepicker();
	$("#addeddate").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});
	$("#couponexpirydate").datepicker();
	$("#couponexpirydate").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});

});
</script>

<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.datepicker.js"></script>

'; ?>


<!--<form action="" name="fromName" method="post" enctype="multipart/form-data">-->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">

<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><span id="customerdetails"><strong>Coupon<?php if (( $this->_tpl_vars['obj']->currentAction == 'Listing' )): ?>Listing<?php endif; ?><?php if (( $this->_tpl_vars['obj']->currentAction == 'Addnew' )): ?> Add New<?php endif; ?><?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?> Edit  <?php echo $this->_tpl_vars['actionReturn']['data']['fname']; ?>
<?php endif; ?> </strong></span></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addnew' )): ?>
	
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<form action="" name="formName" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Add Coupon </th>
			</tr>
			<tr>
			<tr>
				<td><span id="dealid">Deal Id </span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the a deal id"  name="vod_deal_id" value="<?php echo $this->_tpl_vars['actionReturn']['data']['vod_deal_id']; ?>
" id="vod_deal_id" readonly=""  /></td>
			</tr>
			<tr>
				<td width="150"><span id="couponname">Coupon name: </span></td>
				<td><input type="text"  name="name" valtype="emptyCheck-Please enter the name "  value="<?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
"   size="60"/></td>
			</tr>
			
				<td><span id="couponcaption">Coupon caption </span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the coupon caption"  name="caption" value="<?php echo $this->_tpl_vars['actionReturn']['data']['caption']; ?>
" id="lanmeId"  size="60"/></td>
			</tr>
			<tr>
				<td><span id="activationdate">Activation Date</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the Activation Date"   name="activation_date" value="<?php echo $this->_tpl_vars['actionReturn']['data']['activation_date']; ?>
" id="ActivationDate" readonly=""  /></td>
			</tr>
			<tr>
				<td><span id="coupondays">Coupon Days</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter Coupon Days|checkNumber-Please enter a valid number"   name="coupon_days" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_days']; ?>
" id="coupon_days" class="nummberOnly"  /></td>
			</tr>
			<tr>
				<td><span id="couponexpirydays">Coupon Expiry Date</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter Coupon Days"   name="coupon_expiry_date" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_expiry_date']; ?>
" id="couponexpirydate"  readonly="" /></td>
			</tr>		
			<!--<tr><tr>
				<td>Sub category </td>
				<td><?php echo $this->_tpl_vars['actionReturn']['subcat']; ?>
</td>
			</tr>
			<tr>
				<td>Coupon Price </td>
				<td><input type="text" valtype="emptyCheck-Please enter the coupon price"   name="coupon_price" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_price']; ?>
"  /></td>
			</tr>
			<tr>
				<td>Cost  </td>
				<td><input type="text" valtype="emptyCheck-Please enter the cost"   value="<?php echo $this->_tpl_vars['actionReturn']['data']['cost']; ?>
" id="cost" name="cost"  /></td>
			
			
			
			<tr>
				<td>Image</td>
					<td>
					<input type="file"  name="fileImage" value="<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" id="fileImageId" />&nbsp;
					<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
						<a  href="..images/picondeals/thumb<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
						<img src="../images/picondeals/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="25" height="25" ; />
						</a><?php endif; ?>
						</td>
				</tr>
			<tr>
				<td>Description</td>
				<td><textarea  name="description" id="descriptionId" valtype="emptyCheck-Please enter a coupon description"  cols="54" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['description']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Highlights</td>
				<td><textarea  name="highlights" id="descriptionId" valtype="emptyCheck-Please enter coupon Highlights"  cols="54" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['highlights']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Rules</td>
				<td><textarea  name="rules" id="rules" valtype="emptyCheck-Please enter the rules"  cols="54" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['highlights']; ?>
</textarea></td>
			</tr>	</tr>-->		
			<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Addnew'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
					<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Save" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
		</form>
	</td>
</tr>

	
	
<?php endif; ?>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>

<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td><?php if ($this->_tpl_vars['actionReturn']['data']): ?>
		<form action="" name="formName" method="post" enctype="multipart/form-data">	
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Edit Coupon </th>
			</tr>
			<tr>
			<tr>
				<td><span id="dealid">Deal Id </span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the a deal id"  name="vod_deal_id" value="<?php echo $this->_tpl_vars['actionReturn']['data']['vod_deal_id']; ?>
" id="vod_deal_id" readonly=""  /></td>
			</tr>
			<tr>
				<td width="150"><span id="couponname">Coupon name: </span></td>
				<td><input type="text"  name="name" valtype="emptyCheck-Please enter the name "  value="<?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
"  size="60"/></td>
			</tr>
			<tr>
				<td><span id="couponcaption">Coupon caption </span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the caption"  name="caption" value="<?php echo $this->_tpl_vars['actionReturn']['data']['caption']; ?>
" id="lanmeId"  size="60"/></td>
			</tr>
			<tr>
				<td><span id="vendor">Vendor</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the vendor name"   name="vendor" value="<?php echo $this->_tpl_vars['actionReturn']['data']['business_name']; ?>
" id="vendorname" readonly="" /></td>
			</tr>
			<tr>
				<td><span id="activationdate">Activation Date</span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the Activation Date"   name="activation_date" value="<?php echo $this->_tpl_vars['actionReturn']['data']['activation_date']; ?>
" id="ActivationDate" readonly=""  /></td>
			</tr>
		<!--	<tr>
				<td>Coupon Price </td>
				<td><input type="text" valtype="emptyCheck-Please enter the cupon price"   name="coupon_price" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_price']; ?>
"  /></td>
			</tr>
			<tr>
				<td>Cost  </td>
				<td><input type="text" valtype="emptyCheck-Please enter the cost"   value="<?php echo $this->_tpl_vars['actionReturn']['data']['cost']; ?>
" id="cost" name="cost"  /></td>
			</tr>
			
			<tr>
				<td>Activation Date</td>
				<td><input type="text" valtype="emptyCheck-Please enter the Activation Date"   name="activation_date" value="<?php echo $this->_tpl_vars['actionReturn']['data']['activation_date']; ?>
" id="ActivationDate" readonly=""  /></td>
			</tr>
			<tr>
				<td>Print Count  </td>
				<td><input type="text" valtype="emptyCheck-Please enter the print count"    value="<?php echo $this->_tpl_vars['actionReturn']['data']['print_count']; ?>
" name="print_count" id="Activation Date"  /></td>
			</tr>
			<tr>
				<td><span id="dateadded">Date added </span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the Email address"   name="date_added" value="<?php echo $this->_tpl_vars['actionReturn']['data']['date_added']; ?>
" id="addeddate" readonly="" /></td>
			</tr>
			
			-->
			<tr>
				<td><span id="coupondays">Coupon Days </span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the coupon days|checkNumber-Please enter a valid number" name="coupon_days" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_days']; ?>
" id="coupondays"  /></td>
			</tr>
			<tr>
				<td><span id="couponexpirydays">Coupon Expiry Date </span></td>
				<td><input type="text" valtype="emptyCheck-Please enter the coupon expiry date"   name="coupon_expiry_date" value="<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_expiry_date']; ?>
" id="couponexpirydate" readonly=""  /></td>
			</tr>
			
			<tr>
				<td><span id="image">Image</span></td>
					<td>
					<input type="file"  name="fileImage" value="<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" id="fileImageId" />&nbsp;
					<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
						<a  href="	../images/picondeals/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
						<img src="../images/picondeals/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="25" height="25" ; />
						</a><?php endif; ?>
						</td>
				</tr>
			<tr>
				<td><span id="description">Description</span></td>
				<td><textarea  name="description" id="descriptionId" valtype="emptyCheck-Please enter a coupon description"  cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['description']; ?>
</textarea></td>
			</tr>
			<tr>
				<td><span id="highlights">Highlights</span></td>
				<td><textarea  name="highlights" id="descriptionId" valtype="emptyCheck-Please enter a coupon highlights"  cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['highlights']; ?>
</textarea></td>
			</tr>
			<tr>
				<td><span id="rules">Rules</span></td>
				<td><textarea  name="rules" id="rules" valtype="emptyCheck-Please enter a coupon rules"  cols="50" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['rules']; ?>
</textarea></td>
			</tr>		
						
			<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
					<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Update" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
		</form>
	</td>
	<?php endif; ?>
	<?php if (! $this->_tpl_vars['actionReturn']['data']): ?>
	<span style="color:red;">invalid id</span>
	<?php endif; ?>
</tr>
<?php endif; ?>	


<?php if (( $this->_tpl_vars['obj']->currentAction == 'Viewform' )): ?>

<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<form action="" name="formName" method="post" enctype="multipart/form-data">	
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
		<tr ><td colspan="2" > <div align="center"><strong><?php echo $this->_tpl_vars['actionReturn']['data']['caption']; ?>
</strong></div></td></tr>
		<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
		<tr>
		<td width="50%">
			<div class="boxList">
				
					<div>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						
						<tr>
							<th colspan="3" >Coupon details</th>
						</tr>
							<?php if ($this->_tpl_vars['actionReturn']['data']['business_name']): ?>
							<tr>
								<td><span id="vendor">Vendor</span></td>
								<td ><?php echo $this->_tpl_vars['actionReturn']['data']['business_name']; ?>
 </td>
								
							</tr>
							<?php endif; ?>
								
							<?php if ($this->_tpl_vars['actionReturn']['data']['name']): ?>
							<tr>
								<td><span id="couponname">Coupon name</span></td>
								<td ><?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
</td>
								
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['data']['category']): ?>
							<tr>
								<td><span id="category">Category</span></td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['category']; ?>
</td>
								
							</tr>
							
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['data']['subcategory_id']): ?>
							<tr>
								<td><span id="subcategory">Sub category</span></td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['subcategory']; ?>
</td>
							</tr>
							<?php endif; ?>
							
							<?php if ($this->_tpl_vars['actionReturn']['data']['activation_date']): ?>
							<tr>
								<td><span id="activationdate">Activation date</span></td>
								<td colspan="2"><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['actionReturn']['data']['activation_date']); ?>
</td>
							</tr>
							<tr>
								<td><span id="activationdate">Coupon Expiry date</span></td>
								<td colspan="2"><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['actionReturn']['data']['coupon_expiry_date']); ?>
</td>
							</tr>
							<?php endif; ?>
							<!--<?php if ($this->_tpl_vars['actionReturn']['data']['cost']): ?>
							<tr>
								<td>Coupon Cost</td>
								<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['data']['cost']; ?>
</td>
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['data']['coupon_price']): ?>
							<tr>
								<td>Coupon Price</td>
								<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['data']['coupon_price']; ?>
</td>
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['data']['offer_rate']): ?>
							<tr>
								<td>Offer Rate</td>
								<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['data']['offer_rate']; ?>
</td>
							</tr>
							<?php endif; ?>-->
		
							
							<?php if ($this->_tpl_vars['actionReturn']['state']): ?>
							<tr>
								<td><span id="state">State</span></td>
								<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['state']; ?>
</td>
							</tr>
							<?php endif; ?>
							
							
							<?php if ($this->_tpl_vars['actionReturn']['data']['zip']): ?>
							<tr>
								<td><span id="zip">Zip</span></td>
								<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['data']['zip']; ?>
</td>
							</tr>
							<?php endif; ?>
							
							<?php if ($this->_tpl_vars['actionReturn']['data']['catData']): ?>
							<tr>
								<td><span id="interestedcategories">Interested Categories </span></td>
								<td>
									<?php $_from = $this->_tpl_vars['actionReturn']['data']['catData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cdata']):
        $this->_foreach['i']['iteration']++;
?>
										<?php echo $this->_tpl_vars['cdata']['category']; ?>
 - <?php echo $this->_tpl_vars['cdata']['subcatlist']; ?>
 
										<br />
									<?php endforeach; endif; unset($_from); ?>
								</td>
							</tr>
							<?php endif; ?>
						</table>
					</div>
				
							
				
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['data']['highlights']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3"><span id="highlights">Highlights</span></th>
						</tr>
						
						<tr>							
							<td colspan="3">
							<?php echo $this->_tpl_vars['actionReturn']['data']['highlights']; ?>

							</td>
						 </tr>
						
						</table>
						<?php endif; ?>
					</div>
					
					
				</div>
			</td>
			<td>
				<div class="boxList">
					<div>
						
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Coupon details</th>
							</tr>
						<tr>
							<td><span id="totalsitepoint">Total print Count:</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['data']['print_count']; ?>
</td>
						 </tr>
						<tr>
							<td><span id="balancesitepoint">Hit Count</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['data']['hit_count']; ?>
</td>
						 </tr>
						
						</table>
						
					</div>
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['data']['description']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3"><span id="description">Description</span></th>
						</tr>
							<tr>							
								<td colspan="3">
									<p >
									<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
									<a  href="<?php echo @ROOT_URL; ?>
images/picondeals/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
									<img src="<?php echo @ROOT_URL; ?>
images/picondeals/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="100" height="125" style="float:right;"/>
									</a><?php endif; ?><?php echo $this->_tpl_vars['obj']->nl2br($this->_tpl_vars['actionReturn']['data']['description']); ?>
 
									</p>
									<!--<?php echo $this->_tpl_vars['actionReturn']['data']['description']; ?>
-->
								</td>
							 </tr>							
						</table>
						<?php endif; ?>
						
						</div>
					
<div>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
					<tr>
							<th colspan="3" ><div align="left">Coupon Status Details</div></th>
						</tr>					
						
						<?php if ($this->_tpl_vars['actionReturn']['data']['status_updateby'] <> 0): ?>	
						<tr>
							<td width="150">Coupon Status Updated By  </td>
							<td colspan="2">						
							<?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\' \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['status_updateby'])); ?>

</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['status_updatedate'] <> 0): ?>	
						<tr>
							<td>Coupon Status Updated Date  </td>
							<td colspan="2" ><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['status_updatedate']); ?>
</td>
						</tr>
						<?php endif; ?>						
						<tr>
							<td>Coupon Status </td>
							<td >
								<?php if ($this->_tpl_vars['actionReturn']['data']['status'] == 0): ?> Under Review								
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == 1): ?> Approved & in Queue
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == 2): ?> Running
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == 3): ?> Rejected
							<?php elseif ($this->_tpl_vars['actionReturn']['data']['status'] == 4): ?> Expired
							<?php endif; ?></td>
							<td>
								<?php if ($this->_tpl_vars['actionReturn']['data']['status'] == 0): ?> 				
								   <strong> <a href="#" onclick="display(<?php echo $this->_tpl_vars['actionReturn']['data']['couponid']; ?>
,<?php echo 1; ?>
);" style="color:#669933"> Accept </a> |  <a  href="#"  onclick="display(<?php echo $this->_tpl_vars['actionReturn']['data']['id']; ?>
,<?php echo 3; ?>
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
					
			</div>
		</td>
		</tr>
		
		<tr>
		<td></td>
			<td >
				<input type="submit" class="butsubmit"  name="actionvar" value="Back" id="cancelId" />
			</td>
		</tr>
		<?php endif; ?>
		<?php if (! $this->_tpl_vars['actionReturn']['data']): ?>
			<span style="color:red;">invalid id</span>
		<?php endif; ?>
		</table>
		</form>
	</td>
	
</tr>

<?php endif; ?>	

<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<td>
		<form action="" name="formName" method="post" enctype="multipart/form-data">	
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'pod_listing.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th colspan="2"><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=fullname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('fullname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=email&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Coupons
							<?php echo $this->_tpl_vars['obj']->getSortImage('email',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th>days</a></th>	
                            
							 <th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=date_added&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Activation Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('date_added',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>
							 <th>Status</th>		
							<th>Blocked </th>							 
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
							<td colspan="2"><?php echo $this->_tpl_vars['data']['business_name']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['caption']; ?>
</td>
							
                            <td><?php echo $this->_tpl_vars['data']['coupon_days']; ?>
</td>
                            
                            <td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['activation_date']); ?>
</td>
							 <td>
							 
							 <?php if ($this->_tpl_vars['data']['status'] == 0): ?> Under Review								
							<?php elseif ($this->_tpl_vars['data']['status'] == 1): ?> Approved & in Queue
							<?php elseif ($this->_tpl_vars['data']['status'] == 2): ?> Running
							<?php elseif ($this->_tpl_vars['data']['status'] == 3): ?> Rejected
							<?php elseif ($this->_tpl_vars['data']['status'] == 4): ?> Expired
							<?php endif; ?>
							 
							 </td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Blockstatuschange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<?php endif; ?>
									<?php if ($this->_tpl_vars['data']['block_status'] == 1): ?> 
									<img src="images/active.gif" border="0" title="Click here to unblock this coupon" alt="Blocked Coupon">
									 <?php else: ?> 							 
									 <img src="images/inactive.gif" border="0" title="Click here to block this coupon" alt="Visible Coupon">
									 <?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
							 </a> 
							<?php endif; ?>
							</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('viewform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/view.gif" border="0" title="Click here to view"> </a>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit"></a> 
							<?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('deleteform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/delete.gif" border="0" title="Click here to delete"> </a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td></td>
						<td colspan="10"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
				</td>
			</tr>
		<?php endif; ?>
		
		</table>
		</form>
	</td>
	
	<?php endif; ?>
</tr>
</table>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
