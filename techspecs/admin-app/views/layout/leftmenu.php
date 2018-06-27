<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

        </div>

        <div class="pull-left info">

          <!-- <p>Alexander Pierce</p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->

        </div>

      </div>

     

      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">

       

        <li class="treeview">

          <a href="#">

            <i class="fa fa-dashboard"></i> <span>Category</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li><a href="<?php echo BACKEND_URL."category/"; ?>"><i class="fa fa-circle-o"></i> List</a></li>

            <li><a href="<?php echo BACKEND_URL."category/add"; ?>"><i class="fa fa-circle-o"></i> Add</a></li>

          </ul>

        </li>



        <li class="treeview">

          <a href="#">

            <i class="fa fa-dashboard"></i> <span>Product</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li><a href="<?php echo BACKEND_URL."product/"; ?>"><i class="fa fa-circle-o"></i> List</a></li>

            <li><a href="<?php echo BACKEND_URL."product/add"; ?>"><i class="fa fa-circle-o"></i> Add</a></li>

          </ul>

        </li>



        <li class="treeview">

          <a href="#">

            <i class="fa fa-dashboard"></i> <span>Attribute</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li><a href="<?php echo BACKEND_URL."attribute/"; ?>"><i class="fa fa-circle-o"></i> List</a></li>

            <li><a href="<?php echo BACKEND_URL."attribute/add"; ?>"><i class="fa fa-circle-o"></i> Add</a></li>

          </ul>

        </li>



        <li>

        <a href="<?php echo BACKEND_URL."cms/"; ?>">

            <i class="fa fa-dashboard"></i> <span>CMS</span>

            

          </a>

        </li>

        <li>

        <a href="<?php echo BACKEND_URL."search/"; ?>">

            <i class="fa fa-dashboard"></i> <span>Search List</span>

            

          </a>

        </li>

        <li>

        <a href="<?php echo BACKEND_URL."sitesettings/"; ?>">

            <i class="fa fa-gear"></i> <span>Sitesettings</span>

            

          </a>

        </li>

        

      </ul>

    </section>

    <!-- /.sidebar -->

  </aside>