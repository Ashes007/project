<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CMS Edit 
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">CMS</a></li>
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
            <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
  <input type="hidden" name="action" value="Process"/>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Sitesettings Lebel</label>
    <div class="col-sm-8">
      <input class="form-control" id="inputEmail3" value="<?php echo stripslashes($info['sitesettings_lebel']);?>" name="sitesettings_lebel" type="text" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Sitesettings Value</label>
    <div class="col-sm-8">
      <?php if($info['sitesettings_type'] == 'TEXTAREA'){ ?>
      <textarea class="form-control" id="inputEmail3" name="sitesettings_value" placeholder="Sitesettings Value"><?php echo stripslashes($info['sitesettings_value']);?></textarea>
    <?php } elseif ($info['sitesettings_type'] == 'IMG') {?> 
    <input type="file" name="image_name" required/>
    <?php  if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."sitesettings/thumb/".$info['sitesettings_value']))
      {
        $image_path = FILE_UPLOAD_URL."sitesettings/thumb/".$info['sitesettings_value'];  
        
        
   ?>
    <br />
     <img src="<?php echo $image_path; ?>" /> 
      <?php } }else{ ?>
      <input class="form-control" id="inputEmail3" value="<?php echo stripslashes($info['sitesettings_value']);?>" name="sitesettings_value" placeholder="Sitesettings Value" type="text" required>
      <?php } ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button class="btn-primary btn">Submit</button>
      <a href="<?php echo $return_url;?>" class="btn-primary bg-danger btn">Cancel</a>
    </div>
  </div>
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