<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product List

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Product</a></li>
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
                  <th>Category</th>
                  <th>Brand</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Is Featured</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($data_list)) 
                  {
                    foreach ($data_list as $key => $list) {
                      $editlink = str_replace('{ID}',$list['id'],$edit_link);
                      $deletelink = str_replace('{ID}',$list['id'],$delete_link);
                      $addimage = str_replace('{ID}',$list['id'],$addimage_link);
                      $attributelink = str_replace('{ID}',$list['id'],$attribute_link);
                      $attributelink = str_replace('{CATID}',$list['category_id'],$attributelink);
                ?>
                <tr>
                  <td><?php echo $this->Model_basic->getCategoryName($list['parent_id']); ?></td>
                  <td><?php echo $this->Model_basic->getCategoryName($list['category_id']); ?></td>
                  <td><?php echo $list['product_name']; ?></td>
                  <td><?php echo $list['product_code']; ?></td>
                  <td><?php echo $list['is_featured']; ?></td>
                  <td><?php echo $list['status']; ?></td>
                  <td>
                      <a href="<?php echo $editlink; ?>" title="Edit"><i class="fa fa-edit"></i></a> 
                      <a href="<?php echo $deletelink; ?>" title="Delete" onclick="return confirm('Are You Sure!')"><i class="fa fa-trash"></i></a>
                      <a href="<?php echo $addimage; ?>" title="Edit"><i class="fa fa-image"></i></a> 
                      <a href="<?php echo $attributelink; ?>" title="Edit"><i class="fa fa-plus"></i></a>  
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