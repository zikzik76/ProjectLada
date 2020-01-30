<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">

    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.dataTables.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.select.min.js');?>">
    </script>

<div id="content">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h3>Salaries</h3>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url('index.php/main_form'); ?>">Employee</a></li>
                    <li><a href="<?php echo base_url('index.php/salaries_form');?>" >Salaries</a></li>
                    <li><a href="<?php echo base_url('index.php/bonuses_form');?>">Bonuses</a></li>
                    <li><a href="<?php echo base_url('index.php/commision_form');?>">Commision</a></li>
                    <li><a href="#">Pension</a></li>
                    <li><a href="#">Medical Issurance</a></li>
                    <li><a href="#">Vouchers</a></li>
                </ul>
            </div>
        </div>
    </nav>
 
    <div class="container">  
    <div class="btn-group pull-right">
      <button type="button" class="btn btn-primary" onclick="">Add New</button>
    </div> 
    <br>
    <hr>
    <br>
    <div>
           <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Tahun</th>
                    <th>Bulan</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Dept / Sec</th>
                    <th>NPWP</th>
                    <th>Golongan</th>
                    <th>Cabang</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>

     <script type="text/javascript">

         $(document).ready(function () {

             var table = $('#example').DataTable({
                 "data": testdata.data,
                 select:"single",
                 "columns": [
                     {
                         "className": 'details-control',
                         "orderable": false,
                         "data": null,
                         "defaultContent": '',
                         "render": function () {
                             return '<i class="fa fa-plus-square" aria-hidden="true"></i>';
                         },
                         width:"15px"
                     },
                     { "data": "Tahun" },
                     { "data": "bulan" },
                     { "data": "NIK" },
                     { "data": "Nama" },
                     { "data": "Jabatan" },
                     { "data": "Department" },
                     { "data": "NPWP" },
                     { "data": "Gol" },
                     { "data": "Cabang" },
                 ],
                 "order": [[1, 'asc']]
             });

             // Add event listener for opening and closing details
             $('#example tbody').on('click', 'td.details-control', function () {
                 var tr = $(this).closest('tr');
                 var tdi = tr.find("i.fa");
                 var row = table.row(tr);

                 if (row.child.isShown()) {
                     // This row is already open - close it
                     row.child.hide();
                     tr.removeClass('shown');
                     tdi.first().removeClass('fa-minus-square');
                     tdi.first().addClass('fa-plus-square');
                 }
                 else {
                     // Open this row
                     row.child(format(row.data())).show();
                     tr.addClass('shown');
                     tdi.first().removeClass('fa-plus-square');
                     tdi.first().addClass('fa-minus-square');
                 }
             });

             table.on("user-select", function (e, dt, type, cell, originalEvent) {
                 if ($(cell.node()).hasClass("details-control")) {
                     e.preventDefault();
                 }
             });
         });

        function format(d){
            
             // `d` is the original data object for the row
             return '<div>'+
                          '<button type="button" class="btn btn-primary" onclick="">Edit</button>'+
                          '<button type="button" class="btn btn-danger">Delete</button>'+
                          '<button type="button" class="btn btn-warning pull right">Send Slip Gaji</button>'+
                    '</div>'+     
                    '<hr>'+
             '<table cellpadding="5" cellspacing="1" border="1" style="padding-left:50px;">' +
                 '<tr>' +
                    '<th colspan="2">PENERIMAAN</th>'+
                    '<th colspan="2">POTONGAN</th>'+    
                 '</tr>' +

                 '<tr>' +
                    '<td>Gaji Pokok :</td>' +
                    '<td>' + d.Gapok + '</td>' +
                    '<td>Absen :</td>'+
                    '<td>'+d.Absen+'</td>'+
                 '</tr>' +

                 '<tr>' +
                    '<td>Overtime :</td>' +
                    '<td>'+ d.Overtime +'</td>'+
                    '<td>Koperasi :</td>'+
                    '<td>'+d.Koperasi+'</td>'+
                 '</tr>' +

                 '<tr>' +
                    '<td>Tunjangan Tetap :</td>' +
                    '<td>'+ d.Tunjangan_Tetap+'</td>' +
                    '<td>Pengobatan :</td>'+
                    '<td>'+d.Pengobatan+'</td>'+
                 '</tr>' +

                 '<tr>' +
                    '<td>Tunjangan Perumahan :</td>' +
                    '<td>'+d.Tunjangan_Perumahan+'</td>' +
                    '<td>Iuran JHT 2% (Pegawai) :</td>'+
                    '<td>'+d.Iuran_JHT_2+'</td>'+
                 '</tr>' +

                  '<tr>' +
                    '<td>Tunjangan_Khusus_Harian:</td>' +
                    '<td>'+d.Tunjagan_Khusus_Harian+'</td>' +
                    '<td>Iuran Pensiun 1% (Pegawai) :</td>'+
                    '<td>'+d.Tunjangan_Pensiun_1+'</td>'+
                 '</tr>' +

                 '<tr>' +
                    '<td>Tunjangan Komunikasi :</td>' +
                    '<td>'+d.Tunjangan_Komunikasi+'</td>' +
                    '<td>Iuran Pensiun 2% (Perusahaan) :</td>'+
                    '<td>'+d.Iuran_Pensiun_2+'</td>'+
                 '</tr>' +

                  '<tr>' +
                    '<td>Tunjangan Cuti :</td>' +
                    '<td>'+d.Tunjangan_cuti+'</td>' +
                    '<td>BPJS TK :</td>'+
                    '<td>'+d.BPJS_TK+'</td>'+
                 '</tr>' +

                  '<tr>' +
                    '<td>Reimburst Pengobatan</td>' +
                    '<td>'+d.Reimburst_Pengobatan+'</td>' +
                    '<td>BPJS Ks :</td>'+
                    '<td>'+d.BPJS_Ks+'</td>'+
                 '</tr>' +

                  '<tr>' +
                    '<td>Tunjangan PPh 21 :</td>' +
                    '<td>'+d.Tunjangan_PPh_21+'</td>' +
                    '<td>PPh 21 Seluruh Penghasilan :</td>'+
                    '<td>'+d.PPh_21_seluruh_penghasilan+'</td>'+
                 '</tr>' +

                  '<tr>' +
                    '<td>Tunjangan BPJS TK (Perusahaan) :</td>' +
                    '<td>'+d.Tunjangan_BPJS_TK+'</td>' +
                    '<td></td>'+
                    '<td></td>'+
                 '</tr>' +

                  '<tr>' +
                    '<td>Tunjangan BPJS Ks (Perusahaan) :</td>' +
                    '<td>'+d.Tunjangan_BPJS_Ks+'</td>' +
                    '<td></td>'+
                    '<td></td>'+
                 '</tr>' +

                  '<tr>' +
                    '<td>Tunjangan Pensiun 2% :</td>' +
                    '<td>'+d.Tunjangan_pensiun_2+'</td>' +
                    '<td></td>'+
                    '<td></td>'+
                 '</tr>' +
                 '<tr >'+
                    '<th>Total Penerimaan</th>'+
                    '<th>'+d.Total_Penerimaan+'</th>'+
                    '<th>Total Potonngan</th>'+
                    '<th>'+d.Total_Potongan+'</th>'+
                 '</tr>'+
                 '<tr>'+
                    '<th>Take Home Pay</th>'+
                    '<th>'+d.Take_Home_Pay+'</th>'+
                 '</tr>'+
             '</table>';
        }


        var testdata = {
        "data": [
        {
        "NIK": "201701151 ",
        "bulan": "April",
        "Tahun": "2018",
        "Nama": "Reza Fachrizal Adnan",
        "Jabatan": "PROGRAMMER",
        "Department": "Divisi Teknologi Informasi",
        "NPWP": "781238712387",
        "Gol": "3/-",
        "Cabang": "Jakarta Karyawan",
        "Gapok" : "",
        "Overtime" : "",
        "Tunjangan_Tetap" : "",
        "Tunjangan_Perumahan" : "",
        "Tunjangan_Khusus Harian": "",
        "Tunjangan_Komunikasi": "2000000",
        "Tunjangan_Cuti": "",
        "Reimburst_Pengobatan" : "",
        "Tunjangan_PPh 21": "",
        "Tunjangan_BPJS_TK" : "",
        "Tunjangan_BPJS_Ks" : "",
        "Tunjangan_Pensiun_2" : "",
        "Absen" : "",
        "Koperasi" : "",
        "Pengobatan" : "",
        "Iuran_JHT_2" : "",
        "Iuran_Pensiun_1" : "",
        "Iuran_Pensiun_2" : "",
        "BPJS_TK" : "",
        "BPJS_Ks" : "",
        "PPh21_Seluruh_Penghasilan"  : "",
        "Total_Penerimaan"  : "",
        "Total_Potongan"  : "",
        "Take_Home_Pay"  : "",
        },
        {
        "NIK": "198501151 ",
        "bulan": "Maret",
        "Tahun": "2018",
        "Nama": "ucoxxxx",
        "Jabatan": "Infrastruktur",
        "Department": "Divisi Teknologi Informasi",
        "NPWP": "777888282828",
        "Gol": "3/-",
        "Cabang": "Jakarta Karyawan",
        "Gapok" : "",
        "Overtime" : "",
        "Tunjangan_Tetap" : "",
        "Tunjangan_Perumahan" : "",
        "Tunjangan_Khusus Harian": "",
        "Tunjangan_Komunikasi": "300000",
        "Tunjangan_Cuti": "",
        "Reimburst_Pengobatan" : "",
        "Tunjangan_PPh 21": "",
        "Tunjangan_BPJS_TK" : "",
        "Tunjangan_BPJS_Ks" : "",
        "Tunjangan_Pensiun_2" : "",
        "Absen" : "",
        "Koperasi" : "",
        "Pengobatan" : "",
        "Iuran_JHT_2" : "",
        "Iuran_Pensiun_1" : "",
        "Iuran_Pensiun_2" : "",
        "BPJS_TK" : "",
        "BPJS_Ks" : "",
        "PPh21_Seluruh_Penghasilan"  : "",
        "Total_Penerimaan"  : "",
        "Total_Potongan"  : "",
        "Take_Home_Pay"  : "",
        },
        {
        "NIK": "20150123 ",
        "bulan": "Mei",
        "Tahun": "2018",
        "Nama": "Bagus Triajie Nugroho",
        "Jabatan": "Legal Officer",
        "Department": "Divisi Sekretaris Perusahaan",
        "NPWP": "777888282828",
        "Gol": "3/-",
        "Cabang": "Jakarta Karyawan",
        "Gapok" : "",
        "Overtime" : "",
        "Tunjangan_Tetap" : "",
        "Tunjangan_Perumahan" : "",
        "Tunjangan_Khusus Harian": "",
        "Tunjangan_Komunikasi": "200000",
        "Tunjangan_Cuti": "",
        "Reimburst_Pengobatan" : "",
        "Tunjangan_PPh 21": "",
        "Tunjangan_BPJS_TK" : "",
        "Tunjangan_BPJS_Ks" : "",
        "Tunjangan_Pensiun_2" : "",
        "Absen" : "",
        "Koperasi" : "",
        "Pengobatan" : "",
        "Iuran_JHT_2" : "",
        "Iuran_Pensiun_1" : "",
        "Iuran_Pensiun_2" : "",
        "BPJS_TK" : "",
        "BPJS_Ks" : "",
        "PPh21_Seluruh_Penghasilan"  : "",
        "Total_Penerimaan"  : "",
        "Total_Potongan"  : "",
        "Take_Home_Pay"  : "",
        }
        ]
        };

    
    </script>
