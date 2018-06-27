<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category Edit 
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Category</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">

              <?php echo validation_errors('<div class="form-group has-error"><label class="form-control1">', '</label></div>'); ?>
              <?php if($succmsg!=''){?>
              <div class="form-group has-success"><label class="form-control1"><?php echo $succmsg;?></label></div>
              <?php } if($errmsg != ''){?>           
              <div class="form-group has-error"><label class="form-control1"><?php echo $errmsg;?></label></div>
              <?php }?>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">

              <input type="hidden" name="action" value="Process"/>
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">Parent Category</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="parent_category">
                      <option value="">--Select--</option>
                      <?php 
                          if(is_array($parent_category)) 
                          {
                            foreach ($parent_category as $key => $category) {              

                      ?>
                        <option value="<?php echo $category['id'];?>" <?php if($info['parent_id'] == $category['id']) echo "Selected";?>> <?php echo $category['category_name'];?></option>

                      <?php
                        }}
                      ?>

                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">Category Name</label>
                  <div class="col-sm-8">
                    <input class="form-control" id="inputEmail3" value="<?php echo $info['category_name'];?>" name="category_name" placeholder="Category Name" type="text"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label hor-form" required>Status</label>
                  <div class="col-sm-8">
                    <select name="status" class="form-control" required>
                      <option value="" >Select</option>
                      <option value="Active" <?php if($info['status'] == 'Active') echo "Selected";?>>Active</option>
                      <option value="Inactive" <?php if($info['status'] == 'Inactive') echo "Selected";?>>Inactive</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">Image</label>
                  <div class="col-sm-8">
                    <input class="form-control" id="inputEmail3" name="image_name[]" type="file">
                    <img src="<?php echo FILE_UPLOAD_URL."category/thumb/".$info['image_name']; ?>">
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo $return_url;?>" class="btn btn-default">Cancel</a>                
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>