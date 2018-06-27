<section class="product_heading">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<div class="product_heading_inner">

					<span><?php echo stripslashes($product_info['product_name']);?></span>

					<div class="product_heading_rt">

						<div class="pro_pic">

							<img src="<?php echo $this->Model_basic->getProductImage($product_info['id']);?>" alt="" />

						</div>

						<div class="pro_pic_txt">

							<h5>Product Code</h5>

							<a href="#" data-toggle="modal" data-target="#myModal3"><?php echo stripslashes($product_info['product_code']);?> <img src="<?php echo FRONT_IMAGE_PATH;?>plus3.png" alt="" /></a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="modal fade pro_details" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		<div class="product_descrption">

			<div class="container">

				<div class="row">

					<div class="col-sm-12">

						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?php echo FRONT_IMAGE_PATH;?>close_btn.png" alt="" /></button>

						<div class="product_descrption_box">

							<div class="product_descrption_rt">

								<!-- Tab panes -->

								  <div class="tab-content">

								  <?php

								  if(is_array($product_images))

								  {

								  	foreach ($product_images as $key => $imageInfo) { 	

								  	$image = FRONT_IMAGE_PATH."no_image.jpg";	

								  	if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."product/".$imageInfo['image_name']))

										{

											$image = FILE_UPLOAD_URL."product/".$imageInfo['image_name'];

										}

								  ?>

								    <div role="tabpanel" class="tab-pane fade in <?php if($key == 0) {?> active <?php }?>" id="img<?php echo $imageInfo['id'];?>">

								    	<img src="<?php echo $image;?>" alt="" />

								    </div>

								  <?php 

									}}

								  ?>  

								  </div>

							</div>

							<div class="product_descrption_left">

								 <!-- Nav tabs -->

								  <ul class="nav nav-tabs" role="tablist">

								  <?php

								  if(is_array($product_images))

								  {

								  	foreach ($product_images as $key => $imageInfo) { 	

								  	$image = FRONT_IMAGE_PATH."no_image.jpg";	

								  	if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."product/thumb/".$imageInfo['image_name']))

										{

											$image = FILE_UPLOAD_URL."product/thumb/".$imageInfo['image_name'];

										}

								  ?>

								    <li role="presentation" <?php if($key == 0) {?> class="active" <?php }?>>

								    	<a href="#img<?php echo $imageInfo['id'];?>" aria-controls="img<?php echo $imageInfo['id'];?>" role="tab" data-toggle="tab">

								    		<img src="<?php echo $image;?>" alt="" />

								    	</a>

								    </li>

								  <?php 

									}}

								  ?>

								  </ul>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

<section class="product_category_part info_sec">

	<div class="container">

		<div class="row">

			<div class="col-md-9 col-sm-8">

				<div class="product_info_left">

					<?php 						

						if(count($productArr)){

							foreach ($productArr as $key => $product) {	

							//$mainAttrName = $this->Model_basic->getAttributeName($key);		

							$attrInfo 		= $this->Model_basic->getAttributeInfo($key);	

							$mainAttrName 	= $attrInfo['attribute_name'];

							$view_type 		= $attrInfo['view_type'];	

						?>

					<?php if ( $view_type == 'Color'){ ?>

					<div class="product_info_left_box">

						<div class="row">

							<div class="col-sm-6">

								<h5><?php echo $mainAttrName;?></h5>

							</div>

							<div class="col-sm-6">

							<?php foreach($product as $prod){?>

								<div class="color_box">

									<div style=" background-color: <?php echo stripslashes($prod['attribute_value']);?>; width: 20px; height:20px; border-radius: 20px;float: left;"></div> <p style="float: left; padding-left: 5px;"><?php echo stripslashes($prod['attribute_value']);?></p>

								</div>

							<?php  }?>

								

							</div>

						</div>

					</div>

					<?php } elseif($view_type == 'Box Type') {?>

						<div class="product_info_left_box">

						<div class="row">

							<div class="col-sm-6">

								<h5><?php echo $mainAttrName; ?></h5>

							</div>

							<div class="col-sm-6">

								<ul class="memary2">

								<?php foreach($product as $prod){?>

									<li><a href="#"><?php echo stripslashes($prod['attribute_value']);?></a></li>

								<?php  }?>										

								</ul>

							</div>

						</div>

					</div>

					<?php } else {?>

					<div id="<?php echo strtolower($mainAttrName);?>"> <h4><?php echo $mainAttrName;?></h4></div>

					<?php foreach($product as $prod){?>

					<div class="product_info_left_box">					

						<div class="row">

							<div class="col-sm-6">

								<h5><?php echo stripslashes($prod['attribute_name']);?></h5>

							</div>

							<div class="col-sm-6">

								<p><?php echo stripslashes($prod['attribute_value']);?> <?php echo stripslashes($prod['attribute_details']);?></p>

							</div>

						</div>

					

					</div>

						<?php }?>

						<?php }?>



					<?php }}?>

					

				</div>

			</div>	

			<div class="col-md-3 col-sm-4">

				<div class="product_info_rt">

					<div class="product_info_rt_box">

						<ul>

						<?php

							if(count($productArr)){

							foreach ($productArr as $key => $product) {

							$attrname = $this->Model_basic->getAttributeName($key);	

						?>

							<li><a href="#<?php echo strtolower($attrname);?>"><?php echo $attrname;?></a></li>

						<?php }}?>	

						</ul>

					</div>

				</div>

			</div>

		</div>

	</div>

	

	<div class="social_icon">
	
		<ul class="social_box" id="hide">
        
        <li>

				<a href="javascript:void(0);" onclick="$('#embaded_section').toggle();"><img src="<?php echo FRONT_IMAGE_PATH;?>embed.png" alt="Embeded Code"/></a>

			<!-- <a href="#"><img src="<?php //echo FRONT_IMAGE_PATH;?>sos_new1.png" alt="" /></a> -->

			</li>
        
           <li>
			<textarea class="js-copytextarea" style="resize: none;"><?php echo $readMoreLink;?></textarea>
			<button class="js-textareacopybtn open-intro" style="vertical-align:top;">Copy Textarea</button>
  			
			

			</li>

			<li>

				<a href="https://plus.google.com/share?url=<?php echo $readMoreLink;?>" onclick="javascript:window.open(this.href,

  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img

  src="<?php echo FRONT_IMAGE_PATH;?>sos_new1.png" alt="Share on Google+"/></a>

			<!-- <a href="#"><img src="<?php //echo FRONT_IMAGE_PATH;?>sos_new1.png" alt="" /></a> -->

			</li>

			<li>

				<a class="twitter-share-button"

  href="https://twitter.com/share"

  data-size="large"

  data-text="<?php echo stripslashes($product_info['product_name']);?>"

  data-url="https://dev.twitter.com/web/tweet-button"

  data-hashtags="techspecs"

  data-via="twitterdev"

  data-related="twitterapi,twitter" onclick="javascript:window.open(this.href,

  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">

<img src="<?php echo FRONT_IMAGE_PATH;?>sos_new2.png" alt="" />

</a>

			<!-- <a href="#"><img src="<?php //echo FRONT_IMAGE_PATH;?>sos_new2.png" alt="" /></a> -->

			</li>

			<li>

		<div class="fbShare">

		<a href="javascript:void(0);" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $readMoreLink;?>','facebook-share-dialog','width=626,height=436');return false;"><img src="<?php echo FRONT_IMAGE_PATH;?>sos_new3.png"></a>

		</div>

			</li>

		</ul>

		<div class="open_sos" id="open">

			<img src="<?php echo FRONT_IMAGE_PATH;?>open_sos.png" alt="" class="btn1"/>

			<img src="<?php echo FRONT_IMAGE_PATH;?>close_sos.png" alt="" class="btn2"/>

		</div>
		<div id="result">
        
        </div>
	</div>

</section>

<div class="embaded_section" id="embaded_section" style="display: none;">
	<textarea class="embaded_txt" style="resize: none;" id="embaded_txt">
	<iframe width="560" height="315" src="<?php echo $readMoreLink;?>" frameborder="0" allowfullscreen></iframe>
	</textarea>
	<a href="javascript:void(0);" id="copy_embaded" class="copy_embaded" onclick="myFunction()">Copy</a>
	<a href="javascript:void(0);" id="cancel_embaded" class="cancel_embaded" onclick="$('#embaded_section').hide();">Cancel</a>
</div>

<script type="text/javascript">
	function myFunction() {
		var copyText = document.getElementById("embaded_txt");
		copyText.select();
		document.execCommand("Copy");
	}

	
</script>