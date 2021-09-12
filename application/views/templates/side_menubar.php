
<style>
	
	.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all {
		width:100% !important;
		background-color:transparent !important;
		color:#fff !important;
		border-radius:0px;
		border:none;
	}
	
	.ui-datepicker-header.ui-widget-header.ui-helper-clearfix.ui-corner-all {
		background-color:transparent !important;
		color:#fff;
		border:none;
	}
	
	.ui-state-default {
		background-color:transparent !important;
		border:none !important;
		color:#fff !important;
		
	}
	
	.ui-icon.ui-icon-circle-triangle-w, .ui-icon.ui-icon-circle-triangle-e {
		background-color: orange;
		border-radius: 2px;
	}
	
	 .ui-datepicker-days-cell-over.ui-datepicker-current-day.ui-datepicker-today {
		 background-color:orange !important;
		 border-radius:4px;
	 }
</style>

<!--style>
	.datepicker-switch { color:silver; } .datepicker-switch:hover { color:black; }
	.next { color: #fff; } .next:hover { color: black; }
	.prev { color: #fff; } .prev:hover { color: black; }
	.dow { color: #fff; }
	.day { color: silver; }
	.month { color: #fff; } .month:hover { color: black; } .month.focused { color:grey; }
	.year { color: #fff; } .year:hover { color: black; } .year.focused { color:grey; }
</style-->


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<aside class="main-sidebar" style="position:fixed;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if($user_permission): ?>
          <?php /* if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li class="treeview" id="userMainNav">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createUser', $user_permission)): ?>
                <li id="createUserSubNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                <?php endif; ?>

                <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                <li id="manageUserSubNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
              <?php endif; ?>
              </ul>
            </li>
          <?php endif; */ ?>

          <?php /* if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="groupMainNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Groups</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="createGroupSubMenu"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Add Group</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupSubMenu"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Manage Groups</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; */ ?>
        

        

        <!-- <li class="header">Settings</li> -->
        <?php /* if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
          <li id="storesMainNav"><a href="<?php echo base_url('stores/') ?>"><i class="fa fa-files-o"></i> <span>Stores</span></a></li>
        <?php endif; */ ?>

        <?php /* if(in_array('createTable', $user_permission) || in_array('updateTable', $user_permission) || in_array('viewTable', $user_permission) || in_array('deleteTable', $user_permission)): ?>
          <li id="tablesMainNav"><a href="<?php echo base_url('tables/') ?>"><i class="fa fa-files-o"></i> <span>Tables</span></a></li>
        <?php endif; */ ?>

        <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
          <li id="categoryMainNav"><a href="<?php echo base_url('category/') ?>"><i class="fa fa-files-o"></i> <span>Categories</span></a></li>
        <?php endif; ?>

        

        <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li class="treeview" id="productMainNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Items</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createProduct', $user_permission)): ?>
                  <li id="createProductSubMenu"><a href="<?php echo base_url('products/create') ?>"><i class="fa fa-circle-o"></i> Add new item</a></li>
                <?php endif; ?>
                <?php if(in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductSubMenu"><a href="<?php echo base_url('products') ?>"><i class="fa fa-circle-o"></i> Manage items</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li class="treeview" id="OrderMainNav">
              <?php if(in_array('createOrder', $user_permission)): ?>
              <li id="createOrderSubMenu"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-files-o"></i> Generate Bill</a></li>
              <?php endif; ?>
              <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
              <li id="manageOrderSubMenu"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> Manage Bills</a></li>
              <?php endif; ?>
              
              <!--a href="#">
                <i class="fa fa-files-o"></i>
                <span>Bill</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a-->
              <!--ul class="treeview-menu">
                <?php if(in_array('createOrder', $user_permission)): ?>
                  <li id="createOrderSubMenu"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-circle-o"></i> Generate Bill</a></li>
                <?php endif; ?>
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrderSubMenu"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> Manage Orders</a></li>
                <?php endif; ?>
              </ul-->
            </li>
          <?php endif; ?>

          <?php if(in_array('viewReport', $user_permission)): ?>
            <li class="treeview" id="ReportMainNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <!--<li id="productReportSubMenu"><a href="<?php echo base_url('reports/date_wise') ?>"><i class="fa fa-circle-o"></i> Date Wise</a></li>-->
                  <li id="productReportSubMenu"><a href="<?php echo base_url('reports') ?>"><i class="fa fa-circle-o"></i> Month Wise</a></li>
                  <!--li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li-->
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
		
		<div class="calendarview" style="border-top:1px solid orange; border-bottom:1px solid orange;">
			<div id="holder"></div>
			<div id="sidebardatepicker"></div>						
		</div>
		
		<div style="position: absolute; bottom: 0px; width:100%;">
		
          <?php if(in_array('updateCompany', $user_permission)): ?>
            <abbr title="Company info"><a href="<?php echo base_url('company/') ?>"><div class="col-md-3 col-xs-3 btn btn-info" style="border-radius:0px; padding:10px 0px;"><center><i class="fa fa-info"></i></center></div></a></abbr>
          <?php endif; ?>

          <?php if(in_array('viewProfile', $user_permission)): ?>
            <abbr title="Profile details"><a href="<?php echo base_url('users/profile/') ?>"><div class="col-md-3 col-xs-3 btn btn-primary" style="border-radius:0px; padding:10px 0px;"><center><i class="fa fa-user"></i> </center></div></a></abbr>
          <?php endif; ?>
		  
          <?php if(in_array('updateSetting', $user_permission)): ?>
            <abbr title="Settings"><a href="<?php echo base_url('users/setting/') ?>"><div class="col-md-3 col-xs-3 btn btn-warning" style="border-radius:0px; padding:10px 0px;"><center><i class="fa fa-wrench"></i> </center></div></a></abbr>
          <?php endif; ?>

        <?php endif; ?>
        
			<abbr title="Sign-out"><a onclick="return confirm_logout()" href="#"><div class="col-md-3 col-xs-3 btn btn-danger" style="border-radius:0px; padding:10px 0px;"><center><i class="glyphicon glyphicon-log-out"></i> </center></div></a></abbr>
			<a id="logoutoriginalbtn" href="<?php echo base_url('auth/logout') ?>" style="display:none;"><div class="col-md-3 col-xs-3 btn btn-danger" style="border-radius:0px;"><center><i class="glyphicon glyphicon-log-out"></i> </center></div></a>
		</div>
		
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
  <script>	
		function confirm_logout()
		{
			if(confirm('Are you sure you want to logout?') == true) {
				//$("#logoutoriginalbtn").click();
				window.location.href='<?php echo base_url('auth/logout') ?>';
			} else {
				return false;
			}				
		}
  </script>
  
	<script type="text/javascript">
	  $(function() {
		$("#sidebardatepicker").datepicker({
		  numberOfMonths:1		  
		});
	  });
	</script>