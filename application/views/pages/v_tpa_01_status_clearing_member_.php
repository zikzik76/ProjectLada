<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">

    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.dataTables.js');?>">
    </script> 
   <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.select.min.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.buttons.min.js');?>">
    </script>

<!-- <script type="text/javascript" language="javascript" src="<?php //echo base_url('application/asset/editor/js/dataTables.editor.js'); ?>"></script> -->
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
                    <h3>STATUS KEANGGOTA</h3>
                </div>
            </div>
        </div>
    </nav>
<div id="body-content" class="container"> 

    <br>
    <div>
          <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Jenis Keanggotaan</th>
                    <th>Tanggal Daftar</th>
                    <th>Status Anggota</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($value as $val) { ?>
              <tr>
                <td></td>
                <td><?php echo $val['Code'];?></td>
                <td><?php echo $val['Name'];?></td>
                <td><?php echo $val['MemberType'];?></td>
                <td><?php echo $val['CreatedDate'];?></td>
                <td><?php echo $val['MemberStat'];?></td>
                <?php if($val['ApprovalStatus'] === 'P'){ 
                  echo '<td style="color: red"><b>Pending</b></td>';
                } else {
                  echo '<td style="color: green"><b>Approve</b></td>';
                } ?>
              </tr>
              <tr>
                <table cellpadding="1" cellspacing="1" border="0" >
                  <tr style="height: 50px"></tr>
                  <tr>
                     <!-- <th style="width: 140px" rowspan="7"></th> -->
                     <th style="width: 50px" rowspan="7"></th>
                     <th style="width: 200px" rowspan="7">Document Status</th>
                     <td style="width: 200px">No Akta Pendiri</td>
                     <?php If($val['NoAktaPendiri'] === NULL) {
                        echo '<td style="width: 50px;">:</td><td style="color : red;width : 200px">Failed Upload</td>
                              <td style="width= 200px;"><button><i class="fa fa-edit"> EDIT </button></td>';
                      } else {
                        echo '<td style="width: 50px;">:</td><td style="color : Green">OK</td>';
                      } ?>

                  </tr>
                  <tr>
                    <td style="width: 200px">No Akta Perubahan</td>
                     <?php If($val['NoAktaPerubahan'] === '') {
                        echo '<td style="width: 50px;">:</td><td style="color : red;width : 200px">Failed Upload</td>';
                      } else {
                        echo '<td style="width: 50px;">:</td><td style="color : Green"width : 200px">OK</td>';
                      } ?>
                  </tr>

                  <tr>
                    <td style="width: 200px">Domisili Perusahaan</td>
                     <?php If($val['DomisiliPerusahaan'] === '') {
                        echo '<td style="width: 50px;">:</td><td style="color : red;width : 200px">Failed Upload</td>';
                      } else {
                        echo '<td style="width: 50px;">:</td><td style="color : Green"width : 200px">OK</td>';
                      } ?>
                  </tr>
                  <tr>
                    <td style="width: 200px">No NPWP</td>
                     <?php If($val['NPWP'] === NULL) {
                        echo '<td style="width: 50px;">:</td><td style="color : red;width : 200px">Failed Upload</td>';
                      } else {
                        echo '<td style="width: 50px;">:</td><td style="color : Green"width : 200px">OK</td>';
                      } ?>
                  </tr>
                      <?php if($val['CMType'] === 'B'){
                          echo '<tr style="display:none"></tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px">No Identitas Kepabean</td>';
                              If($val['IdentitasKepabean'] === '') {
                                echo '<td style="width: 50px;">:</td><td style="color : red;width : 200px">Failed Upload</td>';
                              } else {
                                echo '<td style="width: 50px;">:</td><td style="color : Green"width : 200px">OK</td>';
                              } 
                          echo '</tr>';
                        } ?>
                        <?php if($val['CMType'] === 'B'){
                          echo '<tr style="display:none"></tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px">Eksportir Terdaftar Timah Murni Batangan</td>';
                              If($val['EksportirTerdaftarTimah'] === '') {
                                echo '<td style="width: 50px;">:</td><td style="color : red;width : 200px">Failed Upload</td>';
                              } else {
                                echo '<td style="width: 50px;">:</td><td style="color : Green"width : 200px">OK</td>';
                              } 
                          echo '</tr>';
                        } ?>
                        <?php if($val['CMType'] === 'B'){
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px"> Izin Dari Instansi Yang Berwenang </td>';
                              If($val['PerizinanInstansiEksportir'] === '') {
                                echo '<td style="width: 50px;">:</td><td style="color : red;width : 200px">Failed Upload</td>';
                                // '<td style="width= 200px;"><a class="btn btn-primary" data-toggle="modal" href="#modal-id"><i class="fa fa-edit"></i>Edit</a></td>';
                              } else {
                                echo '<td style="width: 50px;">:</td><td style="color : Green"width : 200px">OK</td>';
                              } 
                          echo '</tr>';
                        } else {
                          echo '<tr>';
                            echo '<td style="width: 200px; height: 50px">Perizinan Timah Murni Batangan Yang Masih Berlaku</td>';
                              If($val['PerizinanInstansiEksportir'] === '') {
                                echo '<td style="width: 50px;">:</td><td style="color : red;width : 200px">Failed Upload</td>';
                              } else {
                                echo '<td style="width: 50px;">:</td><td style="color : Green"width : 200px">OK</td>';
                              } 
                          echo '</tr>';
                        } ?>
                </table>
              </tr>
            <?php } ?>
            </tbody>
        </table>
        <br>
    </div>
    
</div>
<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->
<!-- <div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Upload dokumen Izin Dari Instansi Yang Berwenang </h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
           <div class="custom-file col-sm-12">
              <input type="file" class="custom-file-input" name="peizinan_seller" id="peizinan_seller" required="required">
            </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
 -->
 <script type="text/javascript">

  $(document).ready(function () {
    var table = $('#example').DataTable({
      select:"single",
      "columns" : [{width :"15px"}],
      "order":[[1,'asc']]
    });
  });

  $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
     $('#sidebar').toggleClass('active');
      $(this).toggleClass('active');
    });
  });
</script>