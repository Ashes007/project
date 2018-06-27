<section class="product_heading catgry_product">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="product_heading_inner2">
					<h3>Search results for: <strong><?php if($searchKey != '') echo  $searchKey; if($searchType != '') echo  $searchType;  ?></strong></h3>
					<input type="hidden" name="searchKey" id="searchKey" value="<?php echo $searchKey; ?>">
					<input type="hidden" name="brand_id" id="brand_id" value="<?php echo $brand_id; ?>">
					<div class="catgry_product_rt">
						<div class="slect_box1">
						<span class="catgry">category</span>
							<select class="form-control selectpicker" name="category" id="categoryList">
						      <option value="">All</option>
						      	<?php 
								if(is_array($category_list)) {									
									foreach ($category_list as $key => $category) {				
								?>
						      			<option <?php if($cat_id == $category['id']) echo "selected";?> value="<?php echo $category['id'];?>"><?php echo $category['category_name'];?></option>

						      <?php }} ?>
						     
						    </select>
						</div>	
						<div class="slect_box1">
						<span class="catgry">Sort by</span>
							<select class="form-control selectpicker" id="sort_by">
						      <option value="ASC">Name A-Z</option>
						      <option value="DESC">Name Z-A</option>
						    </select>
						</div>			
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="product_category_part">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-8">
				<div class="product_category_left ajax_part">
				<?php if(count($productArr)>0){ 
						foreach ($productArr as $key => $product_list) {
							
					?>

					<div class="product_category_box">
						<h3><?php echo $this->Model_basic->getCategoryName($key);?></h3>
						<?php foreach($product_list as $product) {?>
						<div class="media">
						  <div class="media-left">
						      <a href="<?php echo  FRONTEND_URL."product/details/".$product['slug']; ?>"><img class="media-object" src="<?php echo $this->Model_basic->getProductImage($product['product_id']); ?>" alt="" /></a>
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading"><a href="<?php echo  FRONTEND_URL."product/details/".$product['slug']; ?>"><?php echo $product['product_name'];?></a></h4>
						  </div>
						</div>

						<?php }?>
						
					</div>

				  <?php }
				} else {
					echo "No Product Found";
				}

				  ?> 
	
				</div>
			</div>

			<div class="col-md-3 col-sm-4">
				<div class="product_category_rt">
					<div id="attribute_section">
					<?php 					
						if(count($attrArr)){
							$cnt = 0;
							foreach ($attrArr as $key => $attr) {	
							$attrInfo 		= $this->Model_basic->getAttributeInfo($key);	
							$attrname 	= $attrInfo['attribute_name'];
							$view_type 		= $attrInfo['view_type'];

					?>
					<div class="product_filter_box <?php if ($view_type == 'Double Column'){ echo "half_box";}?>">
						<?php if(is_array($attr)){ ?>
						
						<h5><?php echo $attrname;?></h5>
						
						<?php foreach($attr as $k=>$attrval){  $cnt++; ?>
						<div class="product_chk <?php if ($view_type == 'Color'){ echo "for_color_section";}?>">
							
							
							<?php if  ( $view_type == 'Color'){ ?>
							<div class="color_section">
							<input id="chk<?php echo $cnt; ?>" type="checkbox" value="<?php echo $attrval['id'];?>" name="chk[]" class="attr_check">
							<label for="chk<?php echo $cnt; ?>" style=" background-color: <?php echo stripslashes($attrval['attribute_value']);?>; width: 20px; height:20px; border-radius: 20px;float: left;"></label>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){

		$('.attr_check').on('change', function(){
			search();
		});

		$('#sort_by').on('change', function(){
			search();
		});

		$('#categoryList').change(function(){
			var catId = $(this).val();
			search();
			// $.ajax({
			// 	type: 'post',
			// 	url: '<?php //echo FRONTEND_URL."product/ajax_attribute"; ?>',
			// 	data: {catId:catId},
			// 	success: function(msg)
			// 	{					
			// 		$('#attribute_section').html(msg);
			// 	} 
			// });
		});
	});

	function search()
	{
			var attr_id = [];
			$('.attr_check').each(function(){
				if($(this).is(':checked'))
					attr_id.push($(this).val());
			});

			var search 	= $('#searchKey').val();
			var cat_id 	= $('#categoryList').val();
			var sort_by = $('#sort_by').val();
			var brand_id = $('#brand_id').val();
			
			$.ajax({
				type: 'post',
				url: '<?php echo FRONTEND_URL."product/ajax_product"; ?>',
				data: {attr_id:attr_id,search:search,cat_id:cat_id,sort_by:sort_by,brand_id:brand_id},
				success: function(msg)
				{					
					$('.ajax_part').html(msg);					
				} 
			});
	}

</script>