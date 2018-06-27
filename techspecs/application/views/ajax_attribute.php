<?php 					
	if(count($attrArr)>0){
		$cnt = 0;
		foreach ($attrArr as $attrname => $attr) {							
?>
<div class="product_filter_box">
	<?php if(is_array($attr)){ ?>
	<h5><?php echo $attrname;?></h5>
	
	<?php foreach($attr as $k=>$attrval){  $cnt++; ?>
	<div class="product_chk <?php if (strpos(strtolower($attrname), 'color') !== false){ echo "for_color_section";}?>">

	<?php if (strpos(strtolower($attrname), 'color') !== false){?>
							<div class="color_section">
							<input id="chk<?php echo $cnt; ?>" type="checkbox" value="<?php echo $attrval['id'];?>" name="chk[]" class="attr_check">
							<div style=" background-color: <?php echo stripslashes($attrval['attribute_value']);?>; width: 20px; height:20px; border-radius: 20px;float: left;"></div>
							</div>
							<?php } else {?>

							<input id="chk<?php echo $cnt; ?>" type="checkbox" value="<?php echo $attrval['id'];?>" name="chk[]" class="attr_check">
							<label for="chk<?php echo $cnt; ?>"><?php echo $attrval['attribute_value'];?></label> 
							<?php } ?>
	</div>	
	<?php }}?>
</div>

<?php
}}
?>

<script>
	
	$('.attr_check').on('change', function(){
			search();
		});
</script>
