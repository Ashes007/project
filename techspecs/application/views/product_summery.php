<section class="search_category">

	<div class="container">

		<div class="search_category_inner">

			<div class="row">

				<div class="col-sm-4">

					<div class="row">

						<div class="search_category_box search_box_catgry1">

							<h5>Categories: </h5>

							<ul>

							<?php 							

								if(is_array($category_list)){

									foreach($category_list as $key => $category) {

										

							?>

								<li><a href="<?php echo FRONTEND_URL."product?cat=".$category['slug']; ?>"><?php echo $category['category_name'];?></a></li>

							<?php }} ?>

							</ul>

						</div>

					</div>

				</div>



				<div class="col-sm-4">

					<div class="row">

						<div class="search_category_box search_box_catgry2">

							<h5>Brands: </h5>

							<ul>

								<?php 

								if(is_array($brand_list)){

									foreach($brand_list as $key => $brand) {

										

							?>

								<li><a href="<?php echo FRONTEND_URL."product?brand=".$brand['slug']; ?>"><?php echo $brand['category_name'];?></a></li>

							<?php }} ?>

							</ul>

						</div>

					</div>

				</div>



				<div class="col-sm-4">

					<div class="row">

						<div class="search_category_box search_box_catgry3 scrollbar" id="scrollbar-custom">

							<h5>Product: </h5>

							<ul>

								<?php 

								if(is_array($product_list)){

									foreach($product_list as $key => $product) {

										

							?>

								<li><a href="<?php echo  FRONTEND_URL."product/details/".$product['slug']; ?>"><?php echo $product['product_name'];?></a></li>

							<?php }} ?>

							</ul>

						</div>

					</div>

				</div>



			</div>

			

		</div>

	</div>

</section>
<style type="text/css">
	/* container properties */
	.scrollbar {
		width:100%;
		max-width:100%;
		height:392px;
		/*background-color:#7bd6fc;*/
		overflow-y:scroll;
	}
	
	/* customize scrollbar css */
	#scrollbar-custom::-webkit-scrollbar{
		width:12px;
		background-color:#000;
	}
	#scrollbar-custom::-webkit-scrollbar:horizontal{
		height:12px;
	}
	#scrollbar-custom::-webkit-scrollbar-track{
		border:1px #000 solid;
		border-radius:10px;
		-webkit-box-shadow:0 0 6px #000 inset;
	}
	#scrollbar-custom::-webkit-scrollbar-thumb{
		background-color:#000;
		border:1px solid #000;
		border-radius:16px;
	}
	#scrollbar-custom::-webkit-scrollbar-thumb:hover{
		background-color:#000;
		border:1px solid #000;
	}
	#scrollbar-custom::-webkit-scrollbar-thumb:active{
		background-color:#000;
		border:1px solid #000;
	}

</style>