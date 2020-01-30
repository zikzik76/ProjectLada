<!DOCTYPE html>
<html>
<head>
    <!-- <meta http-equiv="refresh" content="30"/> -->
    <title>KBIHRIS</title>
    <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('/application/asset/style5.css'); ?>"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.min.css'); ?>">
<!-- 
    <link rel="stylesheet" type="text/css" href="<?php //echo base_url('/application/asset/css/b4/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php //echo base_url('/application/asset/css/b4/css/bootstrap.min.css'); ?>"> -->

    <!-- Data Tables -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.min.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/jquery.dataTables.min.css'); ?>">
   <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('/application/asset/datatables/css/dataTables.bootstrap.css'); ?>"> -->
   <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('/application/asset/datatables/css/dataTables.bootstrap.min.css'); ?>">  -->
   <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('/application/asset/datatables/css/buttons.dataTables.min.css'); ?>"> -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/style5.css'); ?>">


    <style type="text/css" class="init">


    
    </style>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery-1.12.4.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/bootstrap.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/bootstrap.min.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.min.js');?>">
    </script>    
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/datatables/js/jquery.dataTables.js'); ?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/datatables/js/jquery.dataTables.min.js'); ?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/datatables/js/dataTables.buttons.min.js'); ?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.js'); ?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.min.js'); ?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/b4/js/bootstrap.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/b4/js/bootstrap.min.js');?>">
    </script>


    <script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
<script type="text/javascript"> 
// PAGING DATATABLE START
// $(document).ready(function() {
//  var table = $('#example').DataTable( {
//      "scrollY": true,
//      "scrollX": true,
//      "paging": true,
//      "orderCellsTop": true,
//      "columnDefs":[{
//          "visible" : false,
//          "targets" : -1
//      }]
//  } );
// } );
</script>


</head>
<body>
  


        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <!-- <h3>logo KBI</h3> -->
                    <img style="width: 80%" class="img-fluid" src="<?php echo base_url('application/asset/image/LOGO.png');?>" >
                </div>

                <ul class="list-unstyled components" style="">
                    <p><b>TIMAH KBI</b></p>
                    <hr>
                   <!--  <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="#">Home 1</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
                    </li> -->
                    <li class="active">
                        <!-- <a href="<?php echo base_url('index.php/c_ppa_01_clearing_member')?>">Dashboard</a> -->
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Keanggotaan</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="<?php echo base_url('index.php/c_tpa_01_form_keanggotaan')?>">Dashboard Keanggotaan</a></li>
                            <li><a href="<?php echo base_url('index.php/c_tpa_01_status_clearing_member')?>">Status Keaggotaan</a></li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="<?php //echo base_url('index.php/c_ppa_01_depositories')?>">Depository Form</a>
                    </li>
                    <li>
                        <a href="<?php //echo base_url('index.php/c_ppa_01_investor')?>">Insvestor Form</a>
                    </li>
                    <li>
                        <a href="<?php //echo base_url('index.php/c_ppa_01_parameter')?>">Parameter Form</a>
                    </li>
                    <li>
                        <a href="<?php //echo base_url('index.php/c_ppa_01_settlement')?>">Settlement Price Form</a>
                    </li>
                    <li>
                        <a href="<?php //echo base_url('index.php/c_ppa_01_tradefeed')?>">Tradefeed Form</a>
                    </li>
                     <li>
                        <a href="<?php //echo base_url('index.php/c_ppa_01_stock_price')?>">Stock Price From</a>
                    </li> -->

                </ul>
                <!-- <ul class="list-unstyled components">
                     <p><b>Employee Viwer</b></p>
                     <hr>
                     <li>
                         <a href="<?php //echo base_url('index.php/vw_employee_profile')?>">Employee Profile</a>
                     </li>
                     <li>
                         <a href="#">Salaries</a>
                     </li>
                      <li>
                         <a href="#">Reimbustment</a>
                     </li>
                      <li>
                         <a href="#">Attendance</a>
                     </li>
                </ul> -->

            </nav>
        </div>
<!-- <nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><img src=""></a>
		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo base_url('index.php/main_form');?>">Add Uraian Status</a></li>
				<li class=" dropdown">
				    <a class="nav-link dropdown-toggle" data-toggle="dropdown"  href="#" role="button" aria-haspopup="true">Dropdown</a>
				    <div class="dropdown-menu">
				      <a class="dropdown-item" href="#">Action</a>
				      <a class="dropdown-item" href="#">Another action</a>
				      <a class="dropdown-item" href="#">Something else here</a>
				      <div class="dropdown-divider"></div>
				      <a class="dropdown-item" href="#">Separated link</a>
				    </div>
				 </li>
				<li><a href="<?php echo base_url('index.php/add_process'); ?>">Master Proses</a></li>
				<li><a href="<?php echo base_url('index.php/master_risiko'); ?>">Master Risiko</a></li>
				<li><a href="<?php echo base_url('index.php/master_control'); ?>">Master Pengendalian</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a id="user_active"><?=$this->session->userdata('user_login')?></a></li>
				<li><a href="<?php echo base_url(); ?>">Logout</a></li>
			</ul>
		</div>
	</div>
</nav> -->
