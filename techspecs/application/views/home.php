<section class="mid_sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="mid_inner">
					<h3>Techspecs</h3>
					<p><?php echo stripslashes($sitesetting['sitesettings_value']);?></p>
					<div class="mid_product_sec">

					<?php 
						if(count($parent_category)>0 ){
							foreach ($parent_category as $key => $category) {
						?>
						
						<div class="mid_product_box">
							<a href="<?php echo FRONTEND_URL."product?cat=".$category['slug']; ?>">
								<h4><?php echo stripslashes($category['category_name']);?></h4>
								<img src="<?php echo FILE_UPLOAD_URL."category/thumb/".$category['image_name'];?>" alt="" />
							</a>
						</div>
						<?php		
							}
						}
					?>
							
						<div class="all_links">
							<a href="<?php echo  FRONTEND_URL."product/summery"?>">All trending specs <img src="<?php echo FRONT_IMAGE_PATH;?>arrow.svg" alt="" /></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>