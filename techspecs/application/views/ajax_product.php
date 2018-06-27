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

  <?php }}?> 