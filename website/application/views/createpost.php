<section class="fea_sec">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="fea_sec_in">
						
						<div class="sec_head">
                        <h2>Post an item</h2>
                        </div>
						<div class="fea_sec_in_bot">
							
							<div class="row">
                           <div class="col-md-6">

						<div class="contact_frm_part">
									<div class="form-box2"><!-- Add "dark" class to make formbox dark -->
				                        <form action="" method="post" id="contact-form" enctype="multipart/form-data">
				                        <input type="hidden" name="action" value="Process"/>
				                            <div class="form-group">
                                                <label>Title*</label>
				                                <input type="text" class="form-control" id="title" value="<?php echo set_value('title');?>" name="title">
				                            </div><!-- End .from-group -->
                                            <div class="form-group">
                                                <label>Description*</label>
				                                <textarea class="form-control" rows="6" id="description" value="<?php echo set_value('description');?>" name="description"></textarea>
				                            </div>
                                            <div class="form-group">
                                                <label>Price*</label>
				                                <input type="text" class="form-control" id="price" value="<?php echo set_value('price');?>" name="price">
				                            </div>
                                            <div class="form-group">
                                                <label>Location</label>
				                                <input type="text" class="form-control" id="location" value="<?php echo set_value('location');?>" name="location">
				                            </div>
                                             <div class="form-group">
                                                <label>Contact Email*</label>
				                                <input type="text" class="form-control" id="email" value="<?php echo set_value('email');?>" name="email">
				                            </div>
				                            <div class="form-group">
				                               <label>Picture File</label>
                                               <input type="file"  class="form-control" name="image_name[]">
				                            </div>
				                            <div class="form-group">
				                               <label>Please Tell Me You're not a Robot:</label>
                                               <img src="<?php echo FRONT_IMAGE_PATH;?>captcha.jpg" >
				                            </div>
				
				                            <div class="mb10"></div><!-- space -->
				
				                            <div class="form-group">
				                                <input type="submit" class="btn btn-custom sub_btn" data-loading-text="Sending..." value="Send Message">
				                            </div><!-- End .from-group -->
				                        </form>
				                	</div><!-- End .form-box -->
								</div>
                        

                    </div>

                    <div class="mb60 clearfix visible-sm visible-xs"></div><!-- space -->
					<div class="col-md-4"></div>
                    <aside class="col-md-2 sidebar" role="complementary">
                        

                        <div class="widget">
                           <img src="<?php echo FRONT_IMAGE_PATH;?>ad1.png" alt="event">
                        </div><!-- End .widget -->

                        <div class="widget">
                           <img src="<?php echo FRONT_IMAGE_PATH;?>ad2.png" alt="event">
                        </div><!-- End .widget -->
                        
                        <!-- End .widget -->
                    </aside><!-- End .col-md-3 -->
                </div>
							
							
						</div>
						
						
						
						
						
						
						
						
					</div>
				</div>
			</div>
		</div>
	</section>