<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">

    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.dataTables.js');?>">
    </script> 
   <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.select.min.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.buttons.min.js');?>">
    </script>

<!-- <script type="text/javascript" language="javascript" src="<?php //echo base_url('application/asset/editor/js/dataTables.editor.js'); ?>"></script> -->
<!-- <?php 
// if (isset($_SERVER['HTTP_COOKIE'])) {
//     $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
//     foreach($cookies as $cookie) {
//         $parts = explode('=', $cookie);
//         $name = trim($parts[0]);
//         setcookie($name, '', time()-1000);
//         setcookie($name, '', time()-1000, '/');
 //   }
?> -->
<div id="content">
  <nav class="navbar navbar-default" >
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h3>MEMBERSHIP DASHBOARD</h3>
                </div>
            </div>
        </div>
  </nav>
<div id="body-content" class="container"> 
    <br>
    <div>
        <?php foreach ($value as $val) { ?>
        <?php if($val['ApprovalStatus_'] == 'R'){
          echo ('<button type="button" class="btn btn-warning pull-right" onclick="validate_data(\''.$val['Code'].'\')">Validate Data</button>');
          } else {
            //nothing;
          }
        ?> 
          <table id="example" name ="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Membership Type</th>
                    <th>Registration Date</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td><?php echo strtoupper($val['Code']);?></td>
                <td><?php echo $val['Name'];?></td>
                <td><?php if(substr($val['Code'], 0, 1) === 'B'){echo 'Buyer <br><small><em>Peserta Beli</em></small>';}else{echo 'Seller<br><small><em> Peserta Jual</em></small>';}?></td>
                <td><?php echo date("d-m-Y",strtotime($val['CreatedDate']));?></td>
                <?php if($val['MemberStat'] === 'Badan Usaha'){ 
                    echo '<td> business entity <br><small><em>Badan Usaha</em></small></td>';
                    } else {
                    echo '<td> business entity <br><small><em>Badan Usaha</em></small></td>';
                    } ?>
                <!-- <td><?php echo $val['MemberStat'];?></td> -->
                <?php if($val['ApprovalStatus'] === 'P'){ 
                  echo '<td style="color: red"><b>Pending</b></td>';
                } else if($val['ApprovalStatus'] === 'A'){
                  echo '<td style="color: green"><b>Approve</b></td>';
                } else {
                   echo '<td style="color: red"><b>Reject</b></td>';
                } ?>
              </tr>
              <tr>
<?php if(($val['ApprovalStatus_'] == 'P')  ){ ?>
                <table cellpadding="1" cellspacing="1" border="0" >
                  <tr style="height: 50px"></tr>
                  <tr>
                     <!-- <th style="width: 140px" rowspan="7"></th> -->
                     <th style="width: 50px" rowspan="20"></th>
                     <th style="width: 200px" rowspan="20">Document Status</th>
                     <td style="width: 200px"><br>Number of Deed of Establishment <br> <small><em>No Akta Pendirian</em></small></td>
                     <?php If($val['NoAktaPendiri'] == NULL) {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                      } else {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : Green"><br>OK</td>';
                      } ?>

                  </tr>
                  <tr>
                    <td style="width: 200px"><br>Amendment Number <br> <small><em>No Akta Perubahan</em></small></td>
                     <?php If($val['NoAktaPerubahan'] == NULL) {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                      } else {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                      } ?>
                  </tr>

                  <tr>
                    <td style="width: 200px"><br>Firm address <br> <small><em>Domisili Perusahaan</em></small></td>
                     <?php If($val['DomisiliPerusahaan'] == NULL) {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                      } else {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                      } ?>
                  </tr>
                  <tr>
                    <td style="width: 200px"><br>Taxpayer Number <br> <small></em> No Pokok Wajib Pajak (NPWP) </em></small></td>
                     <?php If($val['NPWP'] == NULL) {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                      } else {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                      } ?>
                  </tr>
                  <tr>
                      <?php if($val['CMType'] === 'B'){
                          echo '<tr style="display:none"></tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"><br>Customs Registration Number <br><small><em> No Identitas Kepabean</em></small></td>';
                              If($val['IdentitasKepabean'] == NULL) {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                              } else {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                              } 
                          echo '</tr>';
                        } ?>
                  </tr>
                  <tr>
                        <?php if($val['CMType'] === 'B'){
                          echo '<tr style="display:none"></tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"><br>Registered Pure TIN bar Exporters that are Still Valid <br></small><em>Eksportir Terdaftar Timah Murni Batang Yang Masih Berlaku</em></small></td>';
                              If($val['EksportirTerdaftarTimah'] == NULL) {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                              } else {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                              } 
                          echo '</tr>';
                        } ?>
                  </tr>
                  <tr>
                        <?php if($val['CMType'] === 'B'){
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"><br>Permission from Authorized Agency <br> <small><em>Izin Dari Instansi Yang Berwenang</em></small></td>';
                              If($val['PerizinanInstansiEksportir'] == NULL) {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                              } else {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                              } 
                          echo '</tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"><br>Licensing Pure Tin Bars Exporters that Are Still valid <br><small><em>Perizinan Ekspor Timah Murni Batangan Yang Masih Berlaku</em></small></td>';
                              If($val['PerizinanInstansiEksportir'] == NULL) {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                              } else {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                              } 
                          echo '</tr>';
                        } ?>
                    </tr>
                    <tr>
                      <?php 
                      // if(($val['CMType'] == 'B') AND ($val['dom_stat'] == 'D')) {
                      //         if($val['SIUP'] == NULL){
                      //           $display_field_1 = '<td style="width:200px;"><br>Surat Izin Perdagangan (SIUP)</td>
                      //                               <td style="width:50px"><br>:</td>
                      //                               <td style="color : red;width : 200px"><br>Failed Upload</td>';
                      //           echo $display_field_1;
                      //         } else {
                      //           $display_field_1 = '<td style="width:200px;"><br>Surat Izin Perdagangan (SIUP)</td>
                      //                               <td style="width:50px"><br>:</td>
                      //                               <td style="color : green;width : 200px"><br>OK</td>';
                      //           echo $display_field_1;
                      //         }
                      //   } else 
                        if($val['CMType'] === 'B' AND $val['dom_stat'] === 'L'){
                              if($val['suratRef'] == NULL)
                              {
                                $display_field_1 = '<td style="width:200px;"><br>Foreign Bank Reference Letter <br> <small><em>Surat Referensi Bank Luar Negeri</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="color : red; width: 200px"><br>Failed Upload</td>';
                                echo $display_field_1;
                              } else {
                                  $display_field_1 = '<td style="width:200px;"><br>Foreign Bank Reference Letter <br> <small><em>Surat Referensi Bank Luar Negeri</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="color : green; width: 200px"><br>OK</td>';
                                echo $display_field_1;
                              }
                        } 
                        // else if($val['CMType'] == 'S'){
                        //   if($val['SIUP'] == NULL){
                        //         $display_field_1 = '<td style="width:200px;"><br>Surat Izin Perdagangan (SIUP)</td>
                        //                             <td style="width:50px"><br>:</td>
                        //                             <td style="color : red;width : 200px"><br>Failed Upload</td>';
                        //         echo $display_field_1;
                        //       } else {
                        //         $display_field_1 = '<td style="width:200px;"><br>Surat Izin Perdagangan (SIUP)</td>
                        //                             <td style="width:50px"><br>:</td>
                        //                             <td style="color : green;width : 200px"><br>OK</td>';
                        //         echo $display_field_1;
                        //       }
                        // }
                        ?>
                    </tr>
                    <tr>
                      <?php if(($val['CMType'] === 'B') AND ($val['dom_stat'] === 'D')){
                              if($val['NIB'] == NULL){
                                $display_field_2 = '<td style="width:200px">Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color: red;"><br>Failed Upload</td>';
                                echo $display_field_2;
                              } else {
                                 $display_field_2 = '<td style="width:200px">Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color: Green;"><br>OK</td>';
                                echo $display_field_2;
                              }
                            } else if($val['CMType'] === 'S'){
                              if($val['NIB'] == NULL){
                                $display_field_2 = '<td style="width:200px">Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color: red;"><br>Failed Upload</td>';
                                echo $display_field_2;
                              } else {
                                 $display_field_2 = '<td style="width:200px">Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color: Green;"><br>OK</td>';
                                echo $display_field_2;
                              }
                            }?>
                    </tr>
                    <tr>
                      <?php if(($val['CMType'] === 'B') AND ($val['dom_stat'] === 'D')){
                              if($val['IdentitasPengurus'] == NULL){
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:red">Failed Upload</td>';
                                echo $display_field_3;
                              } else {
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:Green"><br>OK</td>';
                                echo $display_field_3;                               
                              }
                        } else if(($val['CMType'] === 'B') AND ($val['dom_stat'] === 'L')){
                             if($val['IdentitasPengurus'] == NULL){
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:red">Failed Upload</td>';
                                echo $display_field_3;
                              } else {
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:Green"><br>OK</td>';
                                echo $display_field_3;                               
                              }
                        } else if($val['CMType'] === 'S'){
                            if($val['IdentitasPengurus'] == NULL){
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:red">Failed Upload</td>';
                                echo $display_field_3;
                              } else {
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:Green"><br>OK</td>';
                                echo $display_field_3;                               
                              }
                        }?>
                    </tr>
                    <tr>
                      <td style="width: 200px"><br>Financial statements <br> <small><em>Laporan Keuangan</em></small></td>
                       <?php If($val['LaporanKeuangan'] == NULL) {
                          echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>';
                        } else {
                          echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                        } ?>
                    </tr>
                    <tr>
                      <?php if($val['CMType'] === 'B' AND $val['dom_stat'] === 'L'){
                              if($val['CompanyProfile'] == NULL){
                                $display_field_4 = '<td style="width: 200px"><br>Company Profile <br><small><em>Profil Perusahaan</em></small></td>
                                                    <td style="width:50px"><br>:</td> 
                                                    <td style="width:200px; color : red;"><br>Failed Upload</td>';
                                echo $display_field_4;
                              } else {
                                 $display_field_4 = '<td style="width: 200px"><br>Company Profile <br><small><em>Profil Perusahaan</em></small></td>
                                                    <td style="width:50px"><br>:</td> 
                                                    <td style="width:200px; color : Green;"><br>OK</td>';
                                echo $display_field_4;
                              }
                        } else if($val['CMType'] === 'S' ){
                          $display_field_4 = '';
                          echo $display_field_4;
                        }else{
                          //nothing
                        }?>
                    </tr>
                </table>
<?php } else if(($val['ApprovalStatus_'] == 'R') OR  ($val['ApprovalStatus_'] == 'A')) { ?>
<!--                 <div class="row">
                  <button class="btn btn-warning pull-right" onclick="validate_data()">Validate Data</button>
                </div> -->
                <br>
                <table cellpadding="1" cellspacing="1" border="0" >
                  <tr style="height: 50px"></tr>
                  <tr>
                     <!-- <th style="width: 140px" rowspan="7"></th> -->
                     <th style="width: 50px" rowspan="20"></th>
                     <th style="width: 200px" rowspan="20">Document Status</th>
                     <td style="width: 200px"><br>Number of Deed of Establishment <br> <small><em>No Akta Pendirian</em></small></td>
                     <?php If($val['NoAktaPendiri'] == NULL OR $val['NoAktaPendiri'] == '') {
                        echo '<td style="width: 50px;"><br>:</td>
                        <td style="color : red;width : 200px"><br>Failed Upload</td>
                        <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'NoAktaPendiri\');"><i class="fa fa-edit"> EDIT </button></td>';
                        // td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"> Download to view files </button></td>';

                      } else {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : Green"><br>OK</td>';
                        //<td style="width= 200px;"><br>';
                        // <button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="btn-noaktapendiri" id="btn-noaktapendiri" onclick="post_var(\'NoAktaPendiri\');"><i class="fa fa-edit"> EDIT </button></td>';
                      } ?>
                      <td style="width: 300px;text-align: center;" rowspan="20" colspan="2">
                      <p class="well well-lg"><b>Document Description : </b></p>
                      <p><span><?php echo $val['ApprovalDesc']?></span></p></td>
                  </tr>
                  <tr>
                    <td style="width: 200px"><br>Amendment Number <br> <small><em>No Akta Perubahan</em></small></td>
                     <?php If($val['NoAktaPerubahan'] == NULL OR $val['NoAktaPerubahan'] == '') {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>
                      <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'NoAktaPerubahan\');"><i class="fa fa-edit"> EDIT </button></td>';
                      } else {
                        echo '<br><td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                        // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'NoAktaPerubahan\');"><i class="fa fa-edit"> EDIT </button></td>';
                      } ?>
                  </tr>

                  <tr>
                    <td style="width: 200px"><br>Firm address <br> <small><em>Domisili Perusahaan</em></small></td>
                     <?php If($val['DomisiliPerusahaan'] == NULL OR $val['DomisiliPerusahaan'] == '') {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>
                         <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'DomisiliPerusahaan\');"><i class="fa fa-edit"> EDIT </button></td>';
                      } else {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : Green;width : 200px"><br>OK</td>';
                        // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'DomisiliPerusahaan\');"><i class="fa fa-edit"> EDIT </button></td>';
                      } ?>
                  </tr>
                  <tr>
                    <td style="width: 200px"><br>Taxpayer Number <br> <small></em> No Pokok Wajib Pajak (NPWP) </em></small></td>
                     <?php If($val['NPWP'] == NULL OR $val['NPWP'] == '') {
                        echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>
                       <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'NPWP\');"><i class="fa fa-edit"> EDIT </button></td>';
                      } else {
                        echo '<td style="width: 50px;"><br>:</td>
                        <td style="color : Green;width : 200px"><br>OK</td>';
                        // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'NPWP\');"><i class="fa fa-edit"> EDIT </button></td>';
                      } ?>
                  </tr>
                  <tr>
                      <?php if($val['CMType'] === 'B'){
                          echo '<tr style="display:none"></tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"><br>Customs Registration Number <br><small><em> No Identitas Kepabean</em></small></td>';
                              If($val['IdentitasKepabean'] == NULL OR $val['IdentitasKepabean'] == '' ) {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>
                               <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'IdentitasKepabean\');"><i class="fa fa-edit"> EDIT </button></td>';
                              } else {
                                echo  '<td style="width: 50px;"><br>:</td><td style="width:200px; color : Green;"><br>OK</td>';
                                // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'IdentitasKepabean\');"><i class="fa fa-edit"> EDIT </button></td>';
                              } 
                          echo '</tr>';
                        } ?>
                  </tr>
                  <tr>
                        <?php if($val['CMType'] === 'B'){
                          echo '<tr style="display:none"></tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"><br>Registered Pure TIN bar Exporters that are Still Valid <br></small><em>Eksportir Terdaftar Timah Murni Batang Yang Masih Berlaku</em></small></td>';
                              If($val['EksportirTerdaftarTimah'] == NULL OR $val['EksportirTerdaftarTimah'] == '') {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>
                                 <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'EksportirTerdaftarTimah\');"><i class="fa fa-edit"> EDIT </button></td>';
                              } else {
                                echo '<td style="width: 50px;"><br>:</td><td style="width:200px; color : Green;"><br>OK</td>';
                                // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'EksportirTerdaftarTimah\');"><i class="fa fa-edit"> EDIT </button></td>';
                              } 
                          echo '</tr>';
                        } ?>
                  </tr>
                  <tr>
                        <?php if($val['CMType'] === 'B'){
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"><br> Permission from Authorized Agency <br> <small><em>Izin Dari Instansi Yang Berwenang</em></small> </td>';
                              if($val['PerizinanInstansiEksportir'] == NULL OR $val['PerizinanInstansiEksportir'] == '') {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>
                                <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'PerizinanInstansiEksportir\');"><i class="fa fa-edit"> EDIT </button></td>';
                              } else {
                                echo '<td style="width: 50px;"><br>:</td><td style="width:200px; color : Green;"><br>OK</td>';
                                // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'PerizinanInstansiEksportir\');"><i class="fa fa-edit"> EDIT </button></td>';
                              } 
                          echo '</tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"><br>Licensing Pure Tin Bars Exporters that Are Still valid <br><small><em>Perizinan Ekspor Timah Murni Batangan Yang Masih Berlaku</em></small></td>';
                              if($val['PerizinanInstansiEksportir'] == NULL OR $val['PerizinanInstansiEksportir'] == '') {
                                echo '<td style="width: 50px;"><br>:</td><td style="color : red;width : 200px"><br>Failed Upload</td>
                               <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'PerizinanInstansiEksportir\');"><i class="fa fa-edit"> EDIT </button></td>';
                              } else {
                                echo '<td style="width: 50px;"><br>:</td><td style="width:200px; color : Green;"><br>OK</td>';
                                // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'PerizinanInstansiEksportir\');"><i class="fa fa-edit"> EDIT </button></td>';
                              } 
                          echo '</tr>';
                        } ?>
                    </tr>
                    <tr>
                      <?php 
                      // if(($val['CMType'] == 'B') AND ($val['dom_stat'] == 'D')) {
                      //         if($val['SIUP'] == NULL OR $val['SIUP'] == ''){
                      //           $display_field_1 = '<td style="width:200px;"><br>Surat Izin Perdagangan (SIUP)</td>
                      //                               <td style="width:50px"><br>:</td>
                      //                               <td style="color : red;width : 200px"><br>Failed Upload</td>
                      //                               <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'siup\');"><i class="fa fa-edit"> EDIT </button></td>';
                      //           echo $display_field_1;
                      //         } else {
                      //           $display_field_1 = '<td style="width:200px;"><br>Surat Izin Perdagangan (SIUP)</td>
                      //                               <td style="width:50px"><br>:</td>
                      //                               <td style="width:200px; color : Green;">OK</td>';
                      //                               // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'siup\');"><i class="fa fa-edit"> EDIT </button></td>';
                      //           echo $display_field_1;
                      //         }
                      //   } else 
                        if($val['CMType'] === 'B' AND $val['dom_stat'] === 'L'){
                              if($val['suratRef'] == NULL OR $val['suratRef'] == '')
                              {
                                $display_field_1 = '<td style="width:200px;"><br>Foreign Bank Reference Letter <br> <small><em>Surat Referensi Bank Luar Negeri</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="color : red; width: 200px"><br>Failed Upload</td>
                                                    <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'suratRefBankNegeri\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_1;
                              } else {
                                  $display_field_1 = '<td style="width:200px;"><br>Foreign Bank Reference Letter <br> <small><em>Surat Referensi Bank Luar Negeri</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color : Green;"><br>OK</td>';
                                                    // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'suratRefBankNegeri\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_1;
                              }
                        } 
                        // else if($val['CMType'] == 'S'){
                        //   if($val['SIUP'] == NULL OR $val['SIUP'] == ''){
                        //         $display_field_1 = '<td style="width:200px;"><br>Surat Izin Perdagangan (SIUP)</td>
                        //                             <td style="width:50px"><br>:</td>
                        //                             <td style="color : red;width : 200px"><br>Failed Upload</td>
                        //                             <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'siup\');"><i class="fa fa-edit"> EDIT </button></td>';
                        //         echo $display_field_1;
                        //       } else {
                        //         $display_field_1 = '<td style="width:200px;"><br>Surat Izin Perdagangan (SIUP)</td>
                        //                             <td style="width:50px"><br>:</td>
                        //                             <td style="width:200px; color : Green;">OK</td>';
                        //                             // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'siup\');"><i class="fa fa-edit"> EDIT </button></td>';
                        //         echo $display_field_1;
                        //       }
                        // }
                        ?>
                    </tr>
                    <tr>
                      <?php if(($val['CMType'] === 'B') AND ($val['dom_stat'] === 'D')){
                              if($val['NIB'] == NULL OR $val['NIB'] == ''){
                                $display_field_2 = '<td style="width:200px">Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color: red;"><br>Failed Upload</td>
                                                    <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'nib\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_2;
                              } else {
                                 $display_field_2 = '<td style="width:200px">Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color : Green;">OK</td>';
                                                    // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'nib\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_2;
                              }
                            } else if($val['CMType'] === 'S'){
                              if($val['NIB'] == NULL){
                                $display_field_2 = '<td style="width:200px">Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color: red;"><br>Failed Upload</td>
                                                    <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'nib\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_2;
                              } else {
                                 $display_field_2 = '<td style="width:200px">Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color : Green;">OK</td>';
                                                    // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'nib\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_2;
                              }
                            }?>
                    </tr>
                    <tr>
                      <?php if(($val['CMType'] === 'B') AND ($val['dom_stat'] === 'D')){
                              if($val['IdentitasPengurus'] == NULL OR $val['IdentitasPengurus'] == ''){
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:red">Failed Upload</td>
                                                    <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'IdentitasDiriPengurus\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_3;
                              } else {
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color : Green;">OK</td>';
                                                    // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'IdentitasPengurus\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_3;                               
                              }
                        } else if(($val['CMType'] === 'B') AND ($val['dom_stat'] === 'L')){
                              if($val['IdentitasPengurus'] == NULL OR $val['IdentitasPengurus'] == ''){
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:red">Failed Upload</td>
                                                    <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'IdentitasDiriPengurus\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_3;
                              } else {
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color : Green;">OK</td>';
                                                    // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'IdentitasPengurus\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_3;                               
                              }
                        } else if($val['CMType'] === 'S'){
                            if($val['IdentitasPengurus'] == NULL OR $val['IdentitasPengurus'] == ''){
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px;color:red">Failed Upload</td>
                                                    <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'IdentitasDiriPengurus\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_3;
                              } else {
                                $display_field_3 = '<td style="width:200px">board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                                                    <td style="width:50px"><br>:</td>
                                                    <td style="width:200px; color : Green;">OK</td>';
                                                    // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'IdentitasPengurus\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_3;                               
                              }
                        }?>
                    </tr>
                    <tr>
                      <td style="width: 200px"><br>Financial statements <br> <small><em>Laporan Keuangan</em></small></td>
                       <?php if($val['LaporanKeuangan'] === NULL OR $val['LaporanKeuangan'] === '') {
                          echo '<td style="width: 50px;"><br>:</td>
                                <td style="color : red;width : 200px"><br>Failed Upload</td>
                         <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'LaporanKeuangan\');"><i class="fa fa-edit"> EDIT </button></td>';
                        } else {
                          echo '<td style="width:50px"><br>:</td><td style="width:200px; color : Green;"><br>OK</td>';
                          // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'LaporanKeuangan\');"><i class="fa fa-edit"> EDIT </button></td>';
                        } ?>
                    </tr>
                    <tr>
                      <?php if($val['CMType'] === 'B' AND $val['dom_stat'] === 'L'){
                              if($val['CompanyProfile'] == NULL OR $val['CompanyProfile'] == ''){
                                $display_field_4 = '<td style="width: 200px"><br>Company Profile <br><small><em>Profil Perusahaan</em></small></td>
                                                    <td style="width:50px"><br>:</td> 
                                                    <td style="width:200px; color : red;"><br?Failed Upload</td>
                                                    <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'CompanyProfile\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_4;
                              } else {
                                 $display_field_4 = '<td style="width: 200px"><br>Company Profile <br><small><em>Profil Perusahaan</em></small></td>
                                                    <td style="width:50px"><br>:</td> 
                                                    <td style="width:200px; color : Green;"><br>OK</td>';
                                                    // <td style="width= 200px;"><br><button type="button" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="" onclick="post_var(\'CompanyProfile\');"><i class="fa fa-edit"> EDIT </button></td>';
                                echo $display_field_4;
                              }
                        } else if($val['CMType'] === 'S' ){
                           $display_field_4 = '';
                          echo $display_field_4;
                        } else {
                          //nothing
                        }?>
                    </tr>
                </table>
              <?php } ?>

              </tr>
            </tbody>
        </table>
        <br>
            <?php } ?>
    </div>
    
</div>
<!-- <div><button type="button" data-toggle="modal" class="btn btn-primary" href="#modal-noaktapendiri" name="" onclick="post_var("NoAktaPendiri");">click me</button> -->
<div class="modal fade" id="mymodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Update Files</h4>
      </div>
      <?php echo form_open_multipart('index.php/c_tpa_01_status_clearing_member/updatedoc'); ?>
      <div class="modal-body">
        <div class="input-group">
           <div class="custom-file col-sm-12">
              <input type="HIDDEN" name="bookId_code" id="bookId_code" value="<?php echo $val['Code']; ?>">
              <input type="HIDDEN" name="bookId_" id="bookId_" value="">
              <!-- <input type="HIDDEN" name="NoAktaPendiri" id="NoAktaPendiri" value="no_akta"> -->
              <label id="title"></label>
              <br>
              <input type="file" class="custom-file-input" name="upload_field" id="upload_field" required="required" accept="application/pdf">
            </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="dommessage" style="display: none"> 
        <img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
        <br/>
        <h4>Saving data in progress, Please wait a moment...</h4>
</div>

 <script type="text/javascript">
 
  function validate_data(e){
        $.blockUI({ message: $('#dommessage')});
    var e_ = e;
    // alert('HELLLO');
    $.ajax({
        url: "<?php base_url();?>c_tpa_01_status_clearing_member/validate_files",
        type : "POST",
        data : {
         seed : e_,
        },
        dataType : "JSON",
        error : function(xhr){
          // alert('Upload Failed, Please Validate again...');
          document.location.reload();
          // window.location.replace("<?php base_url();?>index.php/v_tpa_01_status_clearing_member");
          $.unblockUI();
         // console.log(xhr.data);
        },
        success : function(data){
          // alert('Upload Success, Please Wait Approval...');
          document.location.reload();
          // window.location.replace("<?php base_url();?>v_tpa_01_status_clearing_member");
          $.unblockUI();
          // alert(data.status);
          // data;
        },
    });
  }


  $(document).ready(function () {
     $('#sidebarCollapse').on('click', function () {
     $('#sidebar').toggleClass('active');
      $(this).toggleClass('active');
    });
     
    var table = $('#example').DataTable({
      select:"single",
      "columns" : [{width :"15px"}],
      target : 2,
      className: 'row-border',
      "order":[[1,'asc']]
    });
  });

  // $(document).ready(function () {
   
  // });

  // $('#mymodal').on('Show.bs.modal',function(e){
  //   var bookId = $(this).data('id');
  //   $(e.currentTarget).find('input[name="bookId"]').val(bookId);
  //  })

  function post_var(n){
    // alert(n);
   document.getElementById('bookId_').value = n;
   document.getElementById('title').innerHTML = 'upload Files '+n;

  }


</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.blockUI.js');?>">
</script>