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
          <h4 class="page-title">Dashboard <?php echo HEADER;?></h4>
        </div>
      </div>
      <!-- you can delete start from this line and replace with new form.-->
      <!--row -->
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
          <div class="white-box">
            <div class="row row-in">
              <!-- this function is for the toast to take the value -->
              <input type = "hidden" name = "names" id="names" value="<?php if($name){echo $name;}else{echo "Admin";}  ?>">
              <input type = "hidden" name = "dashboard" id="dashboard" value="<?php echo "dashboard" ?>">

            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!--row -->
      <div class="row">
      <!-- /.row -->
      <?php 
      
       ?>
     </div>
      <!-- /.row -->
      
       <!-- .right-sidebar -->
      <?php require dirname(__FILE__)."/right-sidebar.php"; ?>
      <!-- /.right-sidebar -->
    </div>
    <!-- /.container-fluid -->
    <footer class="footer text-center"><a href="#" id="sa-basic"> <?php echo FOOTER;?></a> </footer>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- footer -->
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- toast effect -->
<script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<script src="js/toastr.js"></script>
<!--Counter js -->
<script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!--Morris JavaScript -->
<script src="../plugins/bower_components/raphael/raphael-min.js"></script>
<script src="../plugins/bower_components/morrisjs/morris.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.js"></script>
<script src="js/dashboard1.js"></script>
<script src="../plugins/bower_components/switchery/dist/switchery.min.js"></script>
<script src="../plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
<script src="../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
<!-- Sweet-Alert  -->
<script src="../plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="../plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>

<!-- Sparkline chart JavaScript -->
<script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>

<script type="text/javascript">

$(document).ready(function() {
  //get the value inside the input in html
  var name = document.getElementById("names").value;
  var dashboard = document.getElementById("dashboard").value;
  if (dashboard = "dashboard") {
    $.toast({
        heading: 'Welcome ' + name,
        text: 'This is HSM System. You are in the main page.',
        position: 'top-right',
        loaderBg:'#b51eed',
        icon: 'info',
        hideAfter: 2500, 
        
        stack: 6
      })
  }else{}

      
    });

// Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });
</script>

<script type="text/javascript">
//this funcion is to prevent user from back button
        if (window.history) {
          window.history.forward(1);
        }
</script>
<!-- Datatable -->
<script src="../plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->

<script>
    $(document).ready(function(){
      $('#myTable').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          "columnDefs": [
          { "visible": false, "targets": 2 }
          ],
          "order": [[ 2, 'asc' ]],
          "displayLength": 25,
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

                last = group;
              }
            } );
          }
        } );

    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.group', function () {
      var currentOrder = table.order()[0];
      if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
        table.order( [ 2, 'desc' ] ).draw();
      }
      else {
        table.order( [ 2, 'asc' ] ).draw();
      }
    });
  });
    });
    $('#example23').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
  </script>

<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
<!--/.footer -->
