<div class="btn-group pull-right">
      <button type="button" class="btn btn-primary" onclick="">Add New</button>
      <button type="button" class="btn btn-warning">Edit</button>
      <button type="button" class="btn btn-danger">Delete</button>
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
           <!--  <tfoot>
                <tr>
                    <th></th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Dept / Sec</th>
                </tr>
            </tfoot> -->
        </table>
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
                     { "data": "NIK" },
                     { "data": "Nama" },
                     { "data": "Jabatan" },
                     { "data": "Department" },
                     { "data": "tglmasuk" },
                     { "data": "Statuskrj" },
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
             return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
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