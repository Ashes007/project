<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Search List

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Search</a></li>
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
                    <th>Sl No</th>
                    <th>Search Key</th>
                    <th>Count</th>
                </tr>
              </thead>
               <tbody>
                <?php
                if(is_array($list)){
                    foreach($list as $k => $v)
                    {
                        
                ?>
                <tr>
                      <td><?php echo $start+$k+1;?></td>
                      <td><?php echo stripslashes($v['search_key']); ?></td>
                      <td><?php echo $v['cnt'];?></td>
                      
                </tr>
                <?php }
                }else{ ?>
                <tr><td colspan="5">No record found</td></tr>
                <?php } ?>
              </tbody>
                
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