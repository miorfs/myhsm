<!-- Left navbar-header -->
  <div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
      <ul class="nav" id="side-menu">
        <li class="sidebar-search hidden-sm hidden-md hidden-lg">
          <!-- input-group -->
          <div class="input-group custom-search-form">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
          <!-- /input-group -->
        </li>
        <li class="user-pro"> <a href="#" class="waves-effect"><img src="../plugins/images/hsmlogo.png" alt="user-img"  class="img-circle"> <span class="hide-menu"><?php if($name){echo $name;}else{echo "Admin";}  ?><span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
            <!-- <li><a href="admin_profile.php?user_id=<?php echo $id; ?>"><i class="ti-user"></i> My Profile</a></li> -->
            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
            <li><a href="../controllers/logincontroller.php"><i class="fa fa-power-off"></i> Logout</a></li>
          </ul>
        </li>
        <li class="nav-small-cap m-t-10">--- Main Menu</li>
        <li><a href="index.php" class="waves-effect"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">Dashboard</span></a></li>
        <li class="nav-small-cap m-t-10">--- Registrations</li>
        <?php
        $role = $_SESSION['role'];
            if($role == "Superadmin"){
              echo '<li><a href="#" class="waves-effect"><i class="icon-user fa-fw"></i> <span class="hide-menu">Administrator</span></a></li>';                      
            } 

        ?>
        
        <li><a href="#" class="waves-effect"><i class="icon-people fa-fw"></i> <span class="hide-menu">Student</span></a></li>

        <li class="nav-small-cap">--- Student</li>
        <li><a href="inbox.html" class="waves-effect"><i data-icon=")" class="icon-people fa-fw"></i> <span class="hide-menu">Student <span class="fa arrow"></span><span class="label label-rouded label-primary pull-right">1</span></span></a>
          <ul class="nav nav-second-level">
            <li><a href="user_list.php?studentlist" class="waves-effect">Student List</a></li>
            
          </ul>
        </li>
        
      </ul>
    </div>
  </div>
  <!-- Left navbar-header end -->