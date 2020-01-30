<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">
<section id="content" style="width: 100%">
	<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h3>Warehouse Management</h3>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <div class="container" style="width: 100%">
        <div class="row">
            <div class="col-lg-2">
                <label>Business Date</label>
            </div>
             <div class="col-sm-4">
                <input id="datepicker" type="date" name="st_date">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Warehouse Location</label>
                <div class="col-sm-4">
                    <select name="locationwarehouse" id="locationwarehouse" class="form-control" required="required" style="width: 200px">
                        <option value="">-</option>
                        <?php foreach($val as $value){?>
                        <option value="<?php echo $value['location'];?>"><?php echo $value['location']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-primary" onclick="change_of_data();"> Submit</button>
                </div>
                <br>
            </div>
        </div>
        <br>

        <table id="example" class="display stripe">
            <thead>
                <tr>
                    <!-- <th>NO</th> -->
                    <th>Location</th>
                    <th>BST Number</th>
                    <th>Brand</th>
                    <th>COA</th>
                    <th>Quantity</th>
                    <th>Download</th>
                </tr>
            </thead>

   <!--         <tfoot>
                <th colspan="2">TOTAL</th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot> -->
        </table>
    </div>
<!--     <div>
    	<h3>Transaction Progress Table</h3>
    </div>
    <br> -->

<!-- </section> -->
<script type="text/javascript">


 </script>
    <script type="text/javascript">

        

          // var table = $('#example').DataTable();
          //   table.column( 3 ).data().sum();
            // console.log(table);
         // var table = $('#example').DataTable();
         //    table.column( 4 ).data().sum();
         //  $('#datepicker').datepicker({
         //    format: 'dd/mm/yyyy'
         // });

        function change_of_data(){
            var date = document.getElementById('datepicker').value;
            var warehouse = document.getElementById('locationwarehouse').value;

            $.ajax({
                url : '<?php echo base_url("index.php/c_tpa_01_warehouse_management/get_data_warehouse"); ?>',
                dataType : 'JSON',
                data : {
                    date_ : date,
                    warehouse_code : warehouse
                },
                type : 'POST',
                error : function(xhr){
                    alert(xhr);
                },
                success : function(data){

                    var table = $("#example tbody");
                    // var table_ = $("#example tfoot");
                    table.empty();
                    $.each(data, function (a, b) {
                        table.append("<tr><td>"+b.location+"</td>" +

                            "<td>"+b.bstno+"</td>"+
                            "<td>" + b.brand + "</td>" +
                            "<td>" + b.coano + "</td>" +
                            "<td>" + formatNumber(b.quantity) + "</td>"+
                            "<td><a href='#' type='button' class='btn btn-outline-primary' style='color:blue' onclick='download_bst_coa(\""+b.bstno+"\")'>Download BST & COA</a></td></tr>");
                    });
                }
            });

        }
        function formatNumber(num) {
          return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
         $(document).ready(function () {
            $('#example').DataTable({
                 select:"single",
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                 "searching": true,
                 "order": [[1, 'asc']],
                 "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                 
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                 
                            // Total over all pages
                            total = api
                                .column( 4 )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                        // alert(data);
                            // Total over this page
                            // pageTotal = api
                            //     .column( 4, { page: 'current'} )
                            //     .data()
                            //     .reduce( function (a, b) {
                            //         return intVal(a) + intVal(b);
                            //     }, 0 );
                 
                            // Update footer
                            $( api.column(4 ).footer() ).html(
                                // '$'+pageTotal +' ( $'+ total +' total)'
                                total
                            );
                        }

             });
         });

         function download_bst_coa(a){
             $.ajax({
                url : '<?php echo base_url("index.php/c_tpa_01_warehouse_management/get_coa_bst_download"); ?>',
                dataType : 'JSON',
                data : {
                    data : a
                },
                type : 'POST',
                error : function(xhr){
                    alert(xhr);
                },
                success : function(data){
                   console.log(data[0][DownloadPath]);
                }
            });

         }
    </script>