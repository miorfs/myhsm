
<?php require dirname(__FILE__)."../../config/define.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="plugins/images/hsmlogo.png">
<title><?php echo HEADER;?></title>
<!-- Bootstrap Core CSS -->
<link href="views/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- toast CSS -->
<link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
<!-- animation CSS -->
<link href="views/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="views/css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="views/css/colors/blue.css" id="theme"  rel="stylesheet">
</head>
<body>
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" method="post" action="controllers/logincontroller.php" >
      <?php
                    session_start();
                    if(isset($_SESSION['name']) && isset($_SESSION['role'])) {
                    header("location: views/index.php");
                    }

                    if(isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) 
                    {
                    foreach($_SESSION['ERRMSG_ARR'] as $msg) 
                    {
                    echo '<div class="alert alert-danger alert-dismissable">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo  $msg; 
                    echo '</div>';
                    }
                    unset($_SESSION['ERRMSG_ARR']);
                    }
                  ?>

        <h3 class="box-title m-b-20">Sign In</h3>

        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control form-control-line" type="text" required="" placeholder="Email" name="email" id="email">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control form-control-line" type="password" required="" placeholder="Password" name="password" id="password">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="login" id="login">Log In</button>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Go back to landing page? <a href="../index.php" class="text-danger m-l-5"><b>- Back -</b></a></p>
          </div>
        </div>
      </form>                    
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="views/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!-- toast effect -->
<script src="plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<script src="views/js/toastr.js"></script>

<!--slimscroll JavaScript -->
<script src="views/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="views/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="views/js/custom.js"></script>
<!--Style Switcher -->
<script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

</body>
</html>
