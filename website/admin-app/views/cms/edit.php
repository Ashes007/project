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
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">

              <input type="hidden" name="action" value="Process"/>
              <div class="box-body">

             <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Title</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="cms_title" name="cms_title" placeholder="Title" required value="<?php echo $info['cms_title']?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Content</label>
                <div class="col-sm-8">
                  <textarea class="form-control textarea" id="inputEmail3" name="cms_content" id="cms_content" placeholder="Content" required><?php echo $info['cms_content']?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Title</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="cms_meta_title" name="cms_meta_title" placeholder="Meta Title" required value="<?php echo $info['cms_meta_title']?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Keyword</label>
                <div class="col-sm-8">
                  <textarea class="form-control" id="cms_meta_key" name="cms_meta_key" placeholder="Meta Keyword" required><?php echo $info['cms_meta_key']?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Description</label>
                <div class="col-sm-8">
                  <textarea class="form-control" id="cms_meta_desc" name="cms_meta_desc" placeholder="Meta Description" required><?php echo $info['cms_meta_desc']?></textarea>
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