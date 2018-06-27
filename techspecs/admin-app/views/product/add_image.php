<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Image Add 
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Product Image</a></li>
        <li class="active">Add</li>
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
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">Image<span style="color: red;">*</span></label>
                  <div class="col-sm-8">
                    <input class="form-control" id="inputEmail3" name="image_name[]" multiple="multiple" type="file" required>
                  </div>
                </div>

                
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo $return_url;?>" class="btn btn-default">Cancel</a> 
                <button type="submit" class="btn btn-info pull-right">Add</button>
              </div>
              <!-- /.box-footer -->

              <?php if(is_array($details)){ ?>
  <div class="form-group">
    <div class="col-md-12">
      <?php foreach($details as $del){ ?>
      <div class="col-md-3">
        <?php if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'product/thumb/'.$del['image_name']) && $del['image_name'] != ''){ ?>
        <img src="<?php echo FILE_UPLOAD_URL.'product/thumb/'.$del['image_name']; ?>">
        <?php } ?>
        <br>
          <!-- <input type="radio" name="is_featured" data-url="<?php echo $featured_link;?>" data-id="<?php echo $del['product_id'];?>" value="<?php echo $del['id'];?>" class="is_featured" <?php if($del['is_featured'] == 'Yes') echo "checked";?>> Featued -->
        <a href="<?php echo BACKEND_URL.'product/delete_image/'.$del['id'].'/'.$info['id'].'/'; ?>" onclick="javascript:return confirm('Are You Sure to DELETE it.')" v>Delete</a>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
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