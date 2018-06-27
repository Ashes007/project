<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attribute Edit 
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Attribute</a></li>
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
            <form class="form-horizontal" method="post" action="">
            
              <input type="hidden" name="action" value="Process"/>
              <div class="box-body">
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">Parent Attribute</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="parent_attribute" id="parent_attribute" >
                      <option value="">--Select--</option>
                      <?php 
                          if(is_array($parent_attribute)) 
                          {
                            foreach ($parent_attribute as $key => $attribute) {              

                      ?>
                        <option value="<?php echo $attribute['id'];?>" <?php if($info['parent_id'] == $attribute['id']) echo "Selected";?>> <?php echo $attribute['attribute_name'];?></option>

                      <?php
                        }}
                      ?>

                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">Attribute Name</label>
                  <div class="col-sm-8">
                    <input class="form-control" id="inputEmail3" value="<?php echo $info['attribute_name'];?>" name="attribute_name" placeholder="Attribute Name" type="text" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">Attribute Value</label>
                  <div class="col-sm-8">
                    <input class="form-control" id="inputEmail3" value="<?php echo $info['attribute_value'];?>" name="attribute_value" placeholder="Attribute Value" type="text" >
                  </div>
                </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">Attribute Details</label>
                  <div class="col-sm-8">
                    <input class="form-control" id="inputEmail3" value="<?php echo $info['attribute_details'];?>" name="attribute_details" placeholder="Attribute Details" type="text" >
                  </div>
                </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form">View Type</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="view_type" id="view_type" required>
                      <option value="Normal" <?php if($info['view_type'] == 'Normal') echo "Selected";?>>Normal</option>
                      <option value="Color" <?php if($info['view_type'] == 'Color') echo "Selected";?>>Color</option>
                      <option value="Box Type" <?php if($info['view_type'] == 'Box Type') echo "Selected";?>>Box Type</option>
                      <option value="Double Column" <?php if($info['view_type'] == 'Double Column') echo "Selected";?>>Double Column</option>
                    </select>
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