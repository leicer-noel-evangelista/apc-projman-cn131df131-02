<?php
	$listOfCss = array();
	$active = "inventories";
	include("header.php");
	
	$id = $_GET['item_id'];
	$totalSupply = BPHIMS::getAllItemViaCategoryCount(BPHIMS_CATEGORY_SUPPLY);
	$totalEquipment = BPHIMS::getAllItemViaCategoryCount(BPHIMS_CATEGORY_EQUIPMENT);
	$totalRecords = $totalSupply+$totalEquipment;
	$categoryList = BPHIMS::getAllCategory();
	$info = BPHIMS::getItemInformation($id);
	$cancelURL = ($info['category_id']==BPHIMS_CATEGORY_SUPPLY)?"inventories_supply":"inventories_equipment";
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Update Item</h4>
			<p>
				The page will update the current item record. There are currently <b><?php echo $totalRecords; ?></b> items recorded.<br/>
				Supply <b>(<?php echo $totalSupply; ?>)</b> Equipment <b>(<?php echo $totalEquipment; ?>)</b>
			</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="<?php echo $cancelURL; ?>.php"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
		</div>
		
		<div class="clearfix"></div>

		<hr/>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<!-- Forms -->
		<form action="php/action.php" method="post">
			<input type="hidden" name="action" value="item_update"/>
			<input type="hidden" name="item_id" value="<?php echo $info['item_id']; ?>"/>
			<div class="col-md-6">
				<div class="form-group">
					<label for="category_id">Category</label>
					<select  class="form-control" id="category_id" name="category_id" required>
					<?php
						foreach($categoryList as $category) {
							$selected = ($category['category_id']==$info['category_id'])?'selected="selected"':'';
							echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['name'].'</option>';
						}
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" value="<?php echo $info['name']; ?>" required />
				</div>
				<div class="form-group">
					<label for="code">Code</label>
					<input type="text" class="form-control" id="code" name="code" value="<?php echo $info['code']; ?>" required />
				</div>
				<div class="form-group">
					<label for="critical_level">Critical Level</label>
					<input type="text" class="form-control" id="critical_level" name="critical_level" value="<?php echo $info['critical_level']; ?>" required />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control default-textarea" id="description" name="description"><?php echo $info['description']; ?></textarea>
				</div>
				<button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Update Item</button>
			</div>
		</form>
		
	</div>
</div>
<?php
	$listOfJS = array('deliveries_create');
	include("footer.php");
?>