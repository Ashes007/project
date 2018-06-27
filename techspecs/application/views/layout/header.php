<header class="header_sec">

	<div class="header_top">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="logo">

						<a href="<?php echo FRONTEND_URL;?>"><img src="<?php echo FRONT_IMAGE_PATH;?>logo2.png" alt="" /></a>

					</div>

					<a href="#" class="request_btn" data-toggle="modal" data-target="#myModal2">
						<span class="norml">Request specs</span>
						<span class="cancl">Cancel</span>
					</a>
                    

				</div>
			</div>
		</div>

	</div>
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="advance_seach request_serch">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="advnce_fild">
							<div class="slect_box1">
							<span class="catgry">Your email address</span>
								<input type="email" placeholder="uiuxua@icloud" id="request_email" />
							</div>
							<div class="slect_box1 slect_box2">
							<span class="catgry">category</span>
								<select class="form-control selectpicker" id="request_category">
							      <option value="">All</option>
							      <?php 
							      	if(is_array($main_category_list)){
							      		foreach ($main_category_list as $key => $category) {	    			
							      ?>
							      <option value="<?php echo $category['category_name'];?>"><?php echo $category['category_name'];?></option>
							      <?php }}?>
							
							    </select>
							</div>
							<div class="slect_box1 slect_box3">
							<span class="catgry">Name of device</span>
								<input type="text" placeholder="Enter the name of devise" id="request_device" />
							</div>
							<div class="slect_box4">
								<input type="submit" value="Send" id="send_request" />
							</div>
							<div id="request_message"></div>
						</div>

						<div class="advnce_fild_search">
							<div class="advnce_fild_search_top">
								<div class="advnce_fild_search_top_left">
									<p>POPULAR</p>
									<img src="<?php echo FRONT_IMAGE_PATH;?>loading24px.gif" class="loading_img" style="display:none;">
								</div>	
								<div class="advnce_fild_search_top_rt">
									<ul>
										<?php 
											$range = range('A','Z');
											foreach ($range as $key => $rng) {										
										?>
										<li><a href="javascript:void(0);" class="alpha_search"><?php echo $rng; ?></a></li>
										<?php }?>
									</ul>
								</div>
							</div>
							
							<div class="advnce_fild_search_btm">
								<div class="row" id="alpha_search_sec">
								<?php 	if(is_array($all_category_list)){ ?>
									<div class="col-sm-3 col-xs-6">
										<div class="advnce_fild_search_btm_box">
											<ul>
												<?php 											      
											      foreach ($all_category_list as $key => $category) {	    
											      	if($category['parent_id'] == 0 ){		
											      ?>
												<li><a href="<?php echo FRONTEND_URL."product?cat=".$category['slug']; ?>"><?php echo $category['category_name'];?></a></li>
												<?php }else {?>
													<li><a href="<?php echo FRONTEND_URL."product?brand=".$category['slug']; ?>"><?php echo $category['category_name'];?></a></li>
												<?php }?>
												<?php if(($key+1)%10 == 0) {?>
													</ul>
												</div>
											</div>
											<div class="col-sm-3 col-xs-6">
												<div class="advnce_fild_search_btm_box">
													<ul>
												<?php }?>
												<?php }?>
											</ul>
										</div>
									</div>
								<?php }?>

								</div>
							</div>						
						</div>

					</div>
					
				</div>
			</div>
		</div>
	</div>
	<?php if($this->router->fetch_method() != 'details' && $this->router->fetch_method() != 'summery' && $this->router->fetch_class() != 'cms'){?>



	<div class="search_sec">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="search_inner">

						<form id="search_frm" action="<?php echo FRONTEND_URL."product"; ?>" method="get">

							<div class="search_top">

								<input type="submit" value="" />

								<input type="text" id="product_search_field" name="s" placeholder="Enter the name of your device here" />

							</div>

							<div class="search_btm">

								<div class="search_btm_left">

									<p>Trending: 
									<?php if(count($featured_product) > 0){
										foreach ($featured_product as $key => $product) {
																
									?>
									<a href="<?php echo  FRONTEND_URL."product/details/".$product['slug']; ?>"><?php echo stripcslashes($product['product_name']) ?></a>,
									<?php }} ?>
									</p>

								</div>

								<?php /*?><div class="search_btm_rt">

									<a href="#">ADVANCED SEARCH</a>

								</div><?php */?>

							</div>

						</form>

					</div>

				</div>

			</div>

		</div>

	</div>

	<?php } ?>



	

</header>