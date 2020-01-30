<!DOCTYPE html>
<html>
<head>
<?php
// session_cache_limiter('private');
/* set the cache expire to 30 minutes */
// session_cache_expire(1);    
// session_start();
unset($_SESSION['PHPSESSID']);
setcookie('PHPSESSID','','300','/','tinmarket.id','TRUE','TRUE');
?>

	<!-- <meta http-equiv="refresh" content="60"/> -->
	<title>LADA MEMBERSHIP</title>
  <!-- <script type="text/javascript"></script> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.min.css'); ?>">
<!-- 

	<!-- Data Tables -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.css'); ?>">
<!--    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.min.css'); ?>"> -->
<!--    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/jquery.dataTables.min.css'); ?>"> -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/style5.css'); ?>">
<!--   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/all.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/all.min.css'); ?>"> -->


	<style type="text/css" class="init">


	
	</style>

	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery-1.12.4.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/bootstrap.js');?>">
    </script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/bootstrap.min.js');?>">
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
 <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/all.js');?>">
    </script>
 <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/all.min.js');?>">
    </script>


	<script>
//   console.clear();
  // $this->output->delete_cache();
// $("form").submit(function(){
//     $(this).blockUI({ message: '<img src="/application/asset/image/loading2.gif" width="200" height="200"/><br/><h4>Saving data in progress, Please wait a moment...</h4>' });
// });
    
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });

    $(document).on("keydown", function (e) {
		if (e.which === 8 && !$(e.target).is("input, textarea")) {
			e.preventDefault();
		}
	});
</script>
</head>
  <br/>

<body>
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img style="width: 80%" class="img-fluid center-block" src="<?php echo base_url('application/asset/image/logolada.png');?>" >
                    <!-- <img style="width: 80%; height: 20%;"  class="img-fluid center-block" src="#" > -->
                </div>

                <ul class="list-unstyled components" style="">
                    <!-- <img src="" st> -->
                    <p class="text-center"><b>Lada Exchange System</b></p>

                    <hr>
 

                      <?php
                      $cieling_str_replace = strpos('.', 0);
                      $date = substr($stat_bd,0,strpos($stat_bd," "));
                      $get_stringtotime = date_create($date);
                      $convert_date = date_format($get_stringtotime,'d-M-Y');
                      // str_replace(search, replace, subject)
                      // print_r($flag_user);
                      // print_r($stat_app);
                      // exit();
                       switch(true){ 
                        case ($user_cm !== NULL ) AND ($flag_user == '101'):
                          $display_menu_1 = '<div class="well well-sm">
                                                <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                            </div>
                          <li class="active">
                                        <a href="#submenumember" data-toggle="collapse" aria-expanded="false"><i class="fas fa-building"></i> Member</a>
                                           <ul class="collapse list-unstyled" id="submenumember">
                                              <li>
                                                <a href="'. base_url('index.php/c_tpa_01_form_keanggotaan').'">Member Dashboard</a>
                                              </li>
                                               <li>
                                                  <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                               </li>
                                           </ul>
                                         </li>';
                          echo $display_menu_1;
                          break;
                        case ($user_cm !== NULL ) AND ($flag_user === '201') AND ($stat_app === 'P' OR $stat_app === 'R'):
                        // print_r('masuk sini 1');
                        // exit();
                          $display_menu_2 =   '<div class="well well-sm">
                                                <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                                <label class="center-block" style="text-align:center;color:black">Business Date</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$convert_date.'</em></span>
                                               <label class="center-block" style="text-align:center;color:black"> Ceiling Price </label>
                                                <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielp,0,strpos($stat_cielp,".")).'</em></span>
                                                <label class="center-block" style="text-align:center;color:black"> Floor Price </label>
                                                 <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielf,0,strpos($stat_cielf,".")).'</em></span>
                                                </p>

                                              </div>
                                             <li class="active">
                                              <a href="#submenumember" data-toggle="collapse" aria-expanded="false"><i class="fas fa-building"></i> Member</a>
                                                 <ul class="collapse list-unstyled" id="submenumember">
                                                     <li><a href="'. base_url('index.php/c_tpa_01_status_clearing_member'). '">Member Status</a></li>
                                                     <li>
                                                      <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                                   </li>
                                                    <li><a href="'. base_url('index.php/c_tpa_01_report_status').'"> Reports</a></li>
                                                 </ul>
                                               </li> 
                                               <li class="active">
                                                <a class="well well-sm" href="https://physicalmarket.jfx.co.id/tin" target="blank_"><i class="fab fa-stack-exchange"></i> View Trade On Exchange</a>
                                             </li>';
                          echo $display_menu_2;
                          // exit();
                          break;
                        case ($user_cm !== NULL ) AND ($flag_user === '201') AND ($stat_app === 'A'):
                          $display_menu_3 =   '<div class="well well-sm">
                                                  <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                                <label class="center-block" style="text-align:center;color:black">Business Date</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$convert_date.'</em></span>
                                               <label class="center-block" style="text-align:center;color:black"> Ceiling Price </label>
                                                <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielp,0,strpos($stat_cielp,".")).'</em></span>
                                                <label class="center-block" style="text-align:center;color:black"> Floor Price </label>
                                                 <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielf,0,strpos($stat_cielf,".")).'</em></span>
                                                </p>

                                              </div>
                                        
                                            <li class="active">
                                              <a href="#submenumember" data-toggle="collapse" aria-expanded="false"><i class="fas fa-building"></i> Member</a>
                                                 <ul class="collapse list-unstyled" id="submenumember">
                                                     <li><a href="'. base_url('index.php/c_tpa_01_status_clearing_member'). '">Member Status</a></li>
                                                     <li>
                                                      <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                                   </li>
                                                 </ul>
                                               </li>
                                              <li class="active">
                                                 <a href="#submenutransaction" data-toggle="collapse" aria-expanded="false"><i class="fas fa-comments-dollar"></i> Transaction</a>
                                                 <ul class="collapse list-unstyled" id="submenutransaction">
                                                    <li><a href="'. base_url('index.php/c_tpa_01_tradefeed'). '"> Upload Shipping Instruction</a></li>
                                                   <li><a href="'. base_url('index.php/c_tpa_01_transaction_progress'). '"> Progress </a></li>
                                                    
                                                    <li><a href="'. base_url('index.php/c_tpa_01_report_status').'"> Reports</a></li>
                                                 </ul>
                                              </li> 
                                              <li class="active">
                                                 <a href="#submenurulesandform" data-toggle="collapse" aria-expanded="false"><i class="fas fa-paste"></i> Rules And Form</a>
                                                 <ul class="collapse list-unstyled" id="submenurulesandform">
                                                    <li><a href="'.base_url('index.php/c_tpa_01_download_form').'">Form</a></li>
                                                     <li><a href="'.base_url('index.php/c_tpa_01_download_rules').'">Rules</a></li>
                                                 </ul>
                                              </li> 
                                              <li class="active">
                                                <a class="well well-sm" href="https://physicalmarket.jfx.co.id/tin" target="blank_"><i class="fab fa-stack-exchange"></i> View Trade On Exchange</a>
                                             </li>';
                          echo $display_menu_3;
                          break;
                        case ($user_cm === 'admin') OR ($flag_user === '100'):

                          $display_menu_4 =   '<div class="well well-sm">
                                                  <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                                <label class="center-block" style="text-align:center;color:black">Business Date</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$convert_date.'</em></span>
                                               <label class="center-block" style="text-align:center;color:black"> Ceiling Price </label>
                                                <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielp,0,strpos($stat_cielp,".")).'</em></span>
                                                <label class="center-block" style="text-align:center;color:black"> Floor Price </label>
                                                 <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielf,0,strpos($stat_cielf,".")).'</em></span>
                                                </p>

                                              </div>

                          <li class="active">
                                             <a href="#submenumember" data-toggle="collapse" aria-expanded="false"><i class="fas fa-building"></i> Member</a>
                                                <ul class="collapse list-unstyled" id="submenumember">
                                                   <li><a href="'. base_url('index.php/c_tpa_01_form_keanggotaan').'">Member Dashboard</a></li>
                                                    <li><a href="'. base_url('index.php/c_tpa_01_status_clearing_member'). '">Member Status</a></li>
                                                    <li>
                                                      <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                                   </li>
                                                </ul>
                                              </li>
                                             <li class="active">
                                                <a href="#submenutransaction" data-toggle="collapse" aria-expanded="false"><i class="fas fa-comments-dollar"></i> Transaction</a>
                                                <ul class="collapse list-unstyled" id="submenutransaction">
                                                   <li><a href="'. base_url('index.php/c_tpa_01_tradefeed'). '"> Upload Shipping Instruction</a></li>
                                                   <li><a href="'. base_url('index.php/c_tpa_01_transaction_progress'). '"> Progress </a></li>
                                                   <li><a href="'.base_url('index.php/c_tpa_01_noticeofshipment').'"> Upload Notice Of Shipment</a></li>
                                                    <li><a href="'. base_url('index.php/c_tpa_01_report_status').'"> Reports</a></li>
                                                </ul>
                                             </li>
                                             <li class="active">
                                                <a href="#submenubgr" data-toggle="collapse" aria-expanded="false"><i class="fas fa-industry"></i> BGR Dashoard</a>
                                                <ul class="collapse list-unstyled" id="submenubgr">
                                                    <li><a href="'. base_url('index.php/c_tpa_01_report_status_bgr').'"> Reports</a></li>
                                                </ul>
                                             </li>
                                             <li class="active">
                                                 <a href="#submenurulesandform" data-toggle="collapse" aria-expanded="false"><i class="fas fa-paste"></i> Rules And Form</a>
                                                 <ul class="collapse list-unstyled" id="submenurulesandform">
                                                    <li><a href="'.base_url('index.php/c_tpa_01_download_form').'">Form</a></li>
                                                     <li><a href="'.base_url('index.php/c_tpa_01_download_rules').'">Rules</a></li>
                                                 </ul>
                                              </li>
                                              <li class="active">
                                                <a href="#submenusuco" data-toggle="collapse" aria-expanded="false"><i class="fas fa-poll-h fa-1x"></i> SUCOFINDO Dashboard</a>
                                                <ul class="collapse list-unstyled" id="submenusuco">
                                                    <li><a href="'. base_url('index.php/c_tpa_01_coa').'"> COA Input</a></li>
                                                </ul>
                                             </li>
                                              <li class="active">
                                                 <a href="#submenuwarehouse" data-toggle="collapse" aria-expanded="false"><i class="fa fa-warehouse"></i> Warehouse Management</a>
                                                 <ul class="collapse list-unstyled" id="submenuwarehouse">
                                                    <li><a href="'. base_url('index.php/c_tpa_01_warehouse_management'). '"><i class="fa fa-warehouse"></i> Warehouse</a></li>
                                                 </ul>
                                              </li>

                                             <li class="active">
                                                <a class="well well-sm" href="https://physicalmarket.jfx.co.id/tin" target="blank_"><i class="fab fa-stack-exchange"></i> View Trade On Exchange</a>
                                             </li>';
                                             

                          echo $display_menu_4;
                          break;
                         case ($user_cm !== NULL ) AND ($flag_user === '202') AND ($stat_app === 'P' OR $stat_app === 'R'):
                          $display_menu_5 =   '<div class="well well-sm">
                                                  <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                                <label class="center-block" style="text-align:center;color:black">Business Date</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$convert_date.'</em></span>
                                               <label class="center-block" style="text-align:center;color:black"> Ceiling Price </label>
                                                <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielp,0,strpos($stat_cielp,".")).'</em></span>
                                                <label class="center-block" style="text-align:center;color:black"> Floor Price </label>
                                                 <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielf,0,strpos($stat_cielf,".")).'</em></span>
                                                </p>

                                              </div>
                                              <li class="active">
                                                <a href="#submenumember" data-toggle="collapse" aria-expanded="false"><i class="fas fa-building"></i> Member</a>
                                                 <ul class="collapse list-unstyled" id="submenumember">
                                                     <li><a href="'. base_url('index.php/c_tpa_01_status_clearing_member'). '">Member Status</a></li>
                                                     <li>
                                                      <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                                   </li>
                                                    <li><a href="'. base_url('index.php/c_tpa_01_report_status').'"> Reports</a>
                                                    </li>
                                                 </ul>
                                               </li> 
                                                <li class="active">
                                                 <a href="#submenurulesandform" data-toggle="collapse" aria-expanded="false"><i class="fas fa-paste"></i> Rules And Form</a>
                                                 <ul class="collapse list-unstyled" id="submenurulesandform">
                                                    <li><a href="'.base_url('index.php/c_tpa_01_download_form').'">Form</a></li>
                                                     <li><a href="'.base_url('index.php/c_tpa_01_download_rules').'">Rules</a></li>
                                                 </ul>
                                              </li>
                                               <li class="active">
                                                <a class="well well-sm" href="https://physicalmarket.jfx.co.id/tin" target="blank_"><i class="fab fa-stack-exchange"></i> View Trade On Exchange</a>
                                             </li>';
                          echo $display_menu_5;
                          break;
                        case ($user_cm !== NULL ) AND ($flag_user === '202') AND ($stat_app === 'A'):
                          $display_menu_5 =   '<div class="well well-sm">
                                                  <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                                <label class="center-block" style="text-align:center;color:black">Business Date</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$convert_date.'</em></span>
                                               <label class="center-block" style="text-align:center;color:black"> Ceiling Price </label>
                                                <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielp,0,strpos($stat_cielp,".")).'</em></span>
                                                <label class="center-block" style="text-align:center;color:black"> Floor Price </label>
                                                 <span class="label label-success center-block" style="text-align:center;"><em> USD $ '.substr($stat_cielf,0,strpos($stat_cielf,".")).'</em></span>
                                                </p>

                                              </div>

                          <li class="active">
                                              <a href="#submenumember" data-toggle="collapse" aria-expanded="false"><i class="fas fa-building"></i> Member</a>
                                                 <ul class="collapse list-unstyled" id="submenumember">
                                                     <li><a href="'. base_url('index.php/c_tpa_01_status_clearing_member'). '">Member Status</a></li>
                                                     <li>
                                                      <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                                   </li>
                                                 </ul>
                                               </li>
                                              <li class="active">
                                                 <a href="#submenutransaction" data-toggle="collapse" aria-expanded="false"><i class="fas fa-comments-dollar"></i> Transaction</a>
                                                 <ul class="collapse list-unstyled" id="submenutransaction">
                                                    <li><a href="'. base_url('index.php/c_tpa_01_tradefeed'). '"> Upload Shipping Instruction</a></li>
                                                   <li><a href="'. base_url('index.php/c_tpa_01_transaction_progress'). '"> Progress </a></li>
                                                    <li><a href="'. base_url('index.php/c_tpa_01_report_status').'"> Reports</a></li>
                                                 </ul>
                                              </li>
                                              <li class="active">
                                                 <a href="#submenuwarehouse" data-toggle="collapse" aria-expanded="false"><i class="fa fa-warehouse"></i> Warehouse Management</a>
                                                 <ul class="collapse list-unstyled" id="submenuwarehouse">
                                                    <li><a href="'. base_url('index.php/c_tpa_01_warehouse_management'). '"><i class="fa fa-warehouse"></i> Warehouse</a></li>
                                                 </ul>
                                              </li>
                                              <li class="active">
                                                 <a href="#submenurulesandform" data-toggle="collapse" aria-expanded="false"><i class="fas fa-paste"></i> Rules And Form</a>
                                                 <ul class="collapse list-unstyled" id="submenurulesandform">
                                                    <li><a href="'.base_url('index.php/c_tpa_01_download_form').'">Form</a></li>
                                                     <li><a href="'.base_url('index.php/c_tpa_01_download_rules').'">Rules</a></li>
                                                 </ul>
                                              </li>
                                              <li class="active">
                                                <a class="well well-sm" href="https://physicalmarket.jfx.co.id/tin" target="blank_"><i class="fab fa-stack-exchange"></i> View Trade On Exchange</a>
                                             </li>';
                          echo $display_menu_5;
                          break;
                        case ($user_cm == 'ADMBGR') AND ($flag_user === '500'):
                          $display_menu_7 =  '<div class="well well-sm">
                                                  <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                                </div>
                                                <li class="active">
                                                <a href="#submenubgr" data-toggle="collapse" aria-expanded="false"><i class="fas fa-industry"></i> Dashboard</a>
                                                <ul class="collapse list-unstyled" id="submenubgr">
                                                    <li><a href="'. base_url('index.php/c_tpa_01_report_status_bgr').'"> Reports</a></li>
                                                    <li>
                                                      <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                                   </li>
                                                </ul>
                                             </li>';
                          echo $display_menu_7;
                          break;
                        case ($user_cm == 'ADMSUCO') AND ($flag_user === '600'):
                          $display_menu_7 = '<div class="well well-sm">
                                                  <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                                </div>
                                                <li class="active">
                                                <a href="#submenusuco" data-toggle="collapse" aria-expanded="false"><i class="fas fa-industry"></i> Dashboard</a>
                                                <ul class="collapse list-unstyled" id="submenusuco">
                                                    <li><a href="'. base_url('index.php/c_tpa_01_coa').'"> COA Input</a></li>
                                                    <li>
                                                      <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                                   </li>
                                                </ul>
                                             </li>';
                          echo $display_menu_7;
                          break;
                         case ($user_cm == NULL) AND ($flag_user === NULL):
                            redirect(base_url('index.php'),'refresh');
                          break;
                        default :
                        // print_r('masuk sini 2');
                        // exit();
                          $display_menu_6 = '<div class="well well-sm">
                                                  <label class="center-block" style="text-align:center;color:black">Username</label>
                                                <span class="label label-success center-block" style="text-align:center;"><em>'.$user_cm.'</em></span>
                                              </div>
                                              <li class="active">
                                        <a href="#submenumember" data-toggle="collapse" aria-expanded="false"><i class="fas fa-building"></i> Member</a>
                                           <ul class="collapse list-unstyled" id="submenumember">
                                              <li><a href="'. base_url('index.php/c_tpa_01_form_keanggotaan').'">Member Dashboard</a></li>
                                              <li>
                                                      <a href="'. base_url('index.php/c_tpa_01_change_password'). '">Change Password</a>
                                                   </li>
                                           </ul>
                                         </li>';
                          echo $display_menu_6;
                          break;
                      }
                      ?>


                </ul>
                <ul class="list-unstyled components">
                    <li style="text-align: center"><a href="<?php echo base_url('index.php');?>"><i class="fas fa-sign-out-alt"></i> LOGOUT</a></li>
                </ul>

            </nav>
