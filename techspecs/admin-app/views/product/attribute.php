<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Attribute Add 
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Product Attribute</a></li>
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
            <form class="form-horizontal" method="post" action="">

              <input type="hidden" name="action" value="Process"/>
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label hor-form"></label>
                  <div class="col-sm-8">
                  <ul>
                      <?php 
                        if(count($attribute_list)>0){
                          foreach ($attribute_list as $key => $attribute) {
                            if(is_array($attribute)){
                      ?>
                          <li> <?php echo $key; ?>
                            <ul>
                            <?php foreach($attribute as $k=>$attr){ ?>
                                <li><input type="checkbox" name="attr_id[]" value="<?php echo $attr['id'];?>" <?php if(in_array($attr['id'],$productAttributeArr)) echo "checked";?>> <?php echo $attr['attribute_name']." : ".$attr['attribute_value']; ?></li>
                            <?php }?>
                            </ul>
                          </li>
                      <?php
                            }
                          }
                        }
                      ?>
                  </ul>
                  </div>
                </div>               
              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo $return_url;?>" class="btn btn-default">Cancel</a> 
                <button type="submit" class="btn btn-info pull-right">Add</button>
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