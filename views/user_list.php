<?php ob_start(); ?>
<!-- header -->
<?php 
require dirname(__FILE__)."/header.php"; ?>
<!--/.header -->

<body class="fix-sidebar">
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
  <!-- Navigation -->
 <?php require dirname(__FILE__)."/navigation.php"; ?>
  <!-- navigation -->

  <!-- Left-sidebar -->
<?php require dirname(__FILE__)."/left-sidebar.php"; ?>
<!--/.Left-sidebar -->
  

  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">User List Page</h4>
        </div>
      </div>
      <!-- you can delete start from this line and replace with new form.-->
      <!--row -->
      <div class="row">
        <?php 
        if(isset($_GET["studentlist"])){
          require dirname(__FILE__)."/datatable_student.php"; 
        }
        ?>
      </div>
      <!-- /.row -->
     
      <!--row -->
      
      <!-- /.row -->
     
      
       <!-- .right-sidebar -->
      <?php require dirname(__FILE__)."/right-sidebar.php"; ?>
      <!-- /.right-sidebar -->
    </div>
    <!-- /.container-fluid -->
    <footer class="footer text-center"> <?php echo FOOTER;?> </footer>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- footer -->
<?php 
require dirname(__FILE__)."/footer.php"; ?>
<!--/.footer -->
