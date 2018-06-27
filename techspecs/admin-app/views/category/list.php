<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category List

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Category</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->
              

              <?php if($succmsg!=''){?>
              <div class="form-group has-success"><label class="form-control1"><?php echo $succmsg;?></label></div>
              <?php } if($errmsg != ''){?>           
              <div class="form-group has-error"><label class="form-control1"><?php echo $errmsg;?></label></div>
              <?php }?>
          <div class="box">
            <div class="box-header">


            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Parent Category</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($data_list)) 
                  {
                    foreach ($data_list as $key => $list) {
                ?>
                <tr>
                  <td><?php echo $this->Model_basic->getCategoryName($list['parent_id']); ?></td>
                  <td><?php echo $list['category_name']; ?></td>
                  <td><?php echo $list['status']; ?></td>
                  <td>
                      <a href="<?php echo BACKEND_URL."category/edit/".$list['id']; ?>" title="Edit"><i class="fa fa-edit"></i></a> 
                      <a href="<?php echo BACKEND_URL."category/delete/".$list['id']; ?>" title="Delete" onclick="return confirm('Are You Sure!')"><i class="fa fa-trash"></i></a> 
                  </td>
                
                </tr>

                <?php
                  }}
                ?>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>