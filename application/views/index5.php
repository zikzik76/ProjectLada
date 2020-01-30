<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">

    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.dataTables.js');?>">
    </script> 
   <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.select.min.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.buttons.min.js');?>">
    </script>

<script type="text/javascript" language="javascript" src="<?php echo base_url('application/asset/editor/js/dataTables.editor.js'); ?>"></script>


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
                    <h3>Employee</h3>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url('index.php/main_form'); ?>">Employee</a></li>
                    <li><a href="<?php echo base_url('index.php/salaries_form');?>" >Salaries</a></li>
                    <li><a href="#" id="bonuses">Bonuses</a></li>
                    <li><a href="#">Commision</a></li>
                    <li><a href="#">Pension</a></li>
                    <li><a href="#">Medical Issurance</a></li>
                    <li><a href="#">Vouchers</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="body-content" class="container">
    <div class="btn-group pull-right">
      <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add New</button> -->
        <!-- <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal-insert">Add New Employee</button> -->
        <button type="submit" class="btn btn-warning" id="new_e" onclick="add_new();">Add New Employee</button>
    </div> 
    <br>
    <hr>
    <br>
    <div>
          <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Dept / Sec</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade " id="myModal-insert">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Insert New Employee</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3"><label>NIK</label></div>
                                <div class="col-md-3"><input type="text" name="" placeholder="3999999"></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3"><label>Nama</label></div>
                                <div class="col-md-3"><input type="text" name="" placeholder="Eusi somaliah"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><label>jabatan</label></div>
                                <div class="col-md-3"><input type="text" name="" placeholder="Legal Officer"></div>
                            </div>
                        </div>
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

<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->


<script type="text/javascript">
    var editor;

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
                     { "data": "NIK" },
                     { "data": "Nama" },
                     { "data": "Jabatan" },
                     { "data": "Department" },
                     { "data": "tglmasuk" },
                     { "data": "Statuskrj" },
                 ],
            
                 "order": [[1, 'asc']]
                 // select: {
                 //    style: 'os',
                 //    selector : 'td:first-child'
                 // },
                 // buttons:[
                 //    {extend: "create". editor:editor},
                 //    {extend: "edit", editor:editor},
                 //    {extend: "remove", editor:editor}
                 //    ]
             });

             // Add event listener for opening and closing details
             $('#example tbody').on('click','tr',function(){
                var tr_ = $(this).closest('tr');
                console.log(tr_);
             })
             $('#example tbody').on('click', 'td.details-control', function () {
                 var tr = $(this).closest('tr');
                 var tdi = tr.find("i.fa");
                 var row = table.row(tr);
                 // console.log(tr);

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
             // var table = $('#example').dataTable();
             // $('example tbody').on('click','tr',function(){
             //    console.log(table.row(this).data());
             // });
         });

    function format(d){
            
             // `d` is the original data object for the row
             return '<div>'+
                          '<button type="button" class="btn btn-primary" onclick="update_employee('+d.NIK+')">Edit</button>'+
                          '<button type="button" class="btn btn-danger" onclick="delete_employee('+d.NIK+')">Non Active</button>'+
                    '</div>'+     
                    '<hr>'+
                '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; ">' +
                 '<tr>' +
                    '<th rowspan="7">Detail Profile</th>' +
                    '<td>NIK :</td>'+
                    '<td>'+d.NIK+'</td>'+
                    '<td rowspan="7"> - </tds>'+
                    '<td>No KTP :</td>'+
                    '<td>'+d.noktp+'</td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>Nama</td>' +
                    '<td>' + d.Nama + '</td>' +
                    '<td>No. BPJS Ketenagakerjaan :</td>'+
                    '<td>'+d.nobpjskrj+'</td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>Jabatan:</td>' +
                    '<td><b>'+ d.Jabatan +'</b></td>'+
                    '<td>No. BPJS Kesehatan :</td>'+
                    '<td>'+d.nobpjsks+'</td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>Dept/Sect:</td>' +
                    '<td>'+ d.Department +'</td>' +
                    '<td>Tempat/Tgl Lahir :</td>'+
                    '<td>'+d.tmpttgllhr+'</td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>NPWP:</td>' +
                    '<td>'+d.NPWP+'</td>' +
                    '<td>Jenis Kelamin :</td>'+
                    '<td>'+d.jk+'</td>'+
                 '</tr>' +
                  '<tr>' +
                    '<td>Gol:</td>' +
                    '<td>'+d.Gol+'</td>' +
                    '<td>Agama :</td>'+
                    '<td>'+d.agama+'</td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>Cabang:</td>' +
                    '<td style="max-width:100px;">'+d.Cabang+'</td>' +
                    '<td>Status Perkawinan :</td>'+
                    '<td>'+d.status+'</td>'+
                 '</tr>' +
             '</table>';  
        }


        var testdata = {
        "data": [
        {
        "NIK": "201701151 ",
        "Nama": "Reza Fachrizal Adnan",
        "Jabatan": "PROGRAMMER",
        "Department": "Divisi Teknologi Informasi",
        "NPWP": "781238712387",
        "Gol": "3/-",
        "Cabang": "Jakarta Karyawan",
        "noktp" : "12123123",
        "nobpjskrj": "1591239910",
        "nobpjsks": "1591239910",
        "tmpttgllhr": "8 Januari 1987",
        "jk": "Laki - Laki",
        "agama": "Islam",
        "status": "Belum Kawin",
        "tglmasuk": "26 Januari 2016",
        "Statuskrj": "Active",
        },
        {
        "NIK": "198501151 ",
        "Nama": "ucoxxxx",
        "Jabatan": "Infrastruktur",
        "Department": "Divisi Teknologi Informasi",
        "NPWP": "777888282828",
        "Gol": "3/-",
        "Cabang": "Jakarta Karyawan",
        "noktp" : "12123123",
        "nobpjskrj": "1591239910",
        "nobpjsks": "1591239910",
        "tmpttgllhr": "8 Januari 1987",
        "jk": "Laki - Laki",
        "agama": "Islam",
        "status": "Belum Kawin",
         "tglmasuk": "26 Januari 2016",
        "Statuskrj": "Active",
        },
        {
        "NIK": "20150123 ",
        "Nama": "Bagus Triajie Nugroho",
        "Jabatan": "Legal Officer",
        "Department": "Divisi Sekretaris Perusahaan",
        "NPWP": "777888282828",
        "Gol": "3/-",
        "Cabang": "Jakarta Karyawan",
        "noktp" : "12123123",
        "nobpjskrj": "1591239910",
        "nobpjsks": "1591239910",
        "tmpttgllhr": "8 Januari 1987",
        "jk": "Laki - Laki",
        "agama": "Islam",
        "status": "Belum Kawin",
         "tglmasuk": "26 Januari 2016",
        "Statuskrj": "Active",
        }
        ]
        };
</script>

<script type="text/javascript">

function add_new(){
    window.open('<?php echo base_url("index.php/main_form/insert_new_employee");?>','_self')
}
function update_employee(a){
    // alert(a);
    $.ajax({
        url : '<?php echo base_url("index.php/main_form/update_emp"); ?>',
        dataType : 'JSON',
        data : {
            nik : a
        },
        type : 'POST',
        error : function(){
            //
        },
        success : function(data){
            // window.open('<?php //echo base_url("index.php/main_form/update_emp");?>');
        }
    })
    // window.open('<?php //echo base_url('index.php/main_form/update_emp');?>','_self');
}

function delete_employee(a){
    alert(a+' non active the employee');
}
</script>


<!-- </html> -->
