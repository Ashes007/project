<?php 	if(is_array($category_list)){ ?>
	<div class="col-sm-3 col-xs-6">
		<div class="advnce_fild_search_btm_box">
			<ul>
				<?php 											      
			      foreach ($category_list as $key => $category) {	    
			      			
			      ?>
				<li><a href="<?php echo FRONTEND_URL."product?cat=".$category['slug']; ?>"><?php echo $category['category_name'];?></a></li>
				<?php if(($key+1)%15 == 0) {?>
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