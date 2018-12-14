<?php 
include "../../config/define.php"; 
// include "../function/session_custom.php";
// sec_session_start();
session_start();

 if(isset($_SESSION['name']) && isset($_SESSION['role'])) {
 	$name = $_SESSION['name'];
	$role = $_SESSION['role'];
	$id = $_SESSION['userid'];
 }else{
 	header("location: ../index.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/hsmlogo.png">
<title><?php echo HEADER;?></title>
<!-- TEMPLATE INVOICE -->
<link rel="stylesheet" href="css/template.css" media="all" />
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Datatable CSS -->
<link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- Menu CSS -->
<link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
<link rel="stylesheet" href="../plugins/bower_components/dropify/dist/css/dropify.min.css">
<!-- toast CSS -->
<link href="../plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
<!-- morris CSS -->
<link href="../plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
<!-- page CSS -->
<link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
<link href="../plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="../plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="../plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<link href="../plugins/bower_components/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
<!-- Footable CSS -->
<link href="../plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
<!-- animation CSS -->
<link href="css/animate.css" rel="stylesheet">
<!--alerts CSS -->
<link href="../plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="css/colors/purple.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>