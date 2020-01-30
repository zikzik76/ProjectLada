<!DOCTYPE html>
<html>
<head>
	<!-- <meta http-equiv="refresh" content="30"/> -->
	<title>KBITIMAH</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.min.css'); ?>">
<!-- 

	<!-- Data Tables -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.min.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/jquery.dataTables.min.css'); ?>">
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
  // console.clear();
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
</head>
<body>
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <!-- <h3>logo KBI</h3> -->
                    <img style="width: 80%" class="img-fluid" src="<?php echo base_url('application/asset/image/LOGO.png');?>" >
                </div>

                <ul class="list-unstyled components" style="">
                    <p><b>TIMAH KBI</b></p>
                    <hr>

                        <?php $val_approval = $_SESSION['val']['approval'];?>
                        <?php switch ($val_approval) {
                                        case 'P':
                                           echo'<li class="active">';
                                           echo  '<a href="#submenumember" data-toggle="collapse" aria-expanded="false">Member</a>';
                                           echo     '<ul class="collapse list-unstyled" id="submenumember">';

                                           echo         '<li><a href="'. base_url('index.php/c_tpa_01_status_clearing_member'). '">Member Status</a></li>';
                                           echo     '</ul>';
                                           echo   '</li>';
                                            break;
                                        case 'A':
                                         echo'<li class="active">';
                                           echo  '<a href="#submenumember" data-toggle="collapse" aria-expanded="false">Member</a>';
                                           echo     '<ul class="collapse list-unstyled" id="submenumember">';
                                           echo         '<li><a href="'. base_url('index.php/c_tpa_01_status_clearing_member'). '">Member Status</a></li>';
                                           echo     '</ul>';
                                           echo   '</li>';
                                           echo  '<li class="active">';
                                           echo     '<a href="#submenutransaction" data-toggle="collapse" aria-expanded="false">Transaction</a>';
                                           echo     '<ul class="collapse list-unstyled" id="submenutransaction">';
                                           echo        '<li><a href="'. base_url('index.php/c_tpa_01_transaction_progress'). '"> Progress</a></li>';
                                           echo         '<li><a href="'. base_url('index.php/c_tpa_01_report_status').'"> Reports</a></li>';
                                           echo     '</ul>';
                                           echo  '</li>';
                                            break;
                                        case 'S':
                                         echo'<li class="active">';
                                           echo  '<a href="#submenumember" data-toggle="collapse" aria-expanded="false">Member</a>';
                                           echo     '<ul class="collapse list-unstyled" id="submenumember">';
                                           echo        '<li><a href="'. base_url('index.php/c_tpa_01_form_keanggotaan').'">Member Dashboard</a></li>';
                                           echo     '</ul>';
                                           echo   '</li>';
                                          echo'<li class="active">';
                                           echo  '<a href="#submenumember" data-toggle="collapse" aria-expanded="false">Member</a>';
                                           echo     '<ul class="collapse list-unstyled" id="submenumember">';
                                           echo         '<li><a href="'. base_url('index.php/c_tpa_01_status_clearing_member'). '">Member Status</a></li>';
                                           echo     '</ul>';
                                           echo   '</li>';
                                           echo  '<li class="active">';
                                           echo     '<a href="#submenutransaction" data-toggle="collapse" aria-expanded="false">Transaction</a>';
                                           echo     '<ul class="collapse list-unstyled" id="submenutransaction">';
                                           echo        '<li><a href="'. base_url('index.php/c_tpa_01_transaction_progress'). '"> Progress</a></li>';
                                           echo         '<li><a href="'. base_url('index.php/c_tpa_01_report_status').'"> Reports</a></li>';
                                           echo     '</ul>';
                                           echo  '</li>';
                                            break;
                                        default:
                                          echo'<li class="active">';
                                           echo  '<a href="#submenumember" data-toggle="collapse" aria-expanded="false">Member</a>';
                                           echo     '<ul class="collapse list-unstyled" id="submenumember">';
                                           echo        '<li><a href="'. base_url('index.php/c_tpa_01_form_keanggotaan').'">Member Dashboard</a></li>';
                                           echo     '</ul>';
                                           echo   '</li>';

                                        break;
                                    }?>
                </ul>
                <ul class="list-unstyled components">
                    <li style="text-align: center"><a href="<?php echo base_url('index.php');?>">LOGOUT</a></li>
                </ul>

            </nav>
