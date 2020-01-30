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
    <form method="POST" name="form_warehouse" id="form_warehouse" enctype="multipart/form-data" data-toggle="validator" role="form">
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
                <!-- <div class="col-sm-4">
                    <button class="btn btn-primary" onclick="change_of_data();"> Submit</button>
                </div> -->
                <!-- <br> -->
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">BRAND</label>
                <div class="col-sm-4">
                    <select name="brand" id="brand" class="form-control" required="required" style="width: 200px">
                        <option value="">-</option>
                        <?php foreach($value_brand as $val_brand){?>
                        <option value="<?php echo $val_brand['brand'];?>"><?php echo $val_brand['brand']?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-4">
                    <button type="button" class="btn btn-primary" onclick="change_of_data();"> Submit</button>
                </div>
                <br>
            </div>
        </div>
        </form>
        <br>
        <input type="HIDDEN" name="bst_num" id="bst_num" value=""/>
          <table id="example1" class="display stripe">
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Brand</td>
                    <td>Metric Ton</td>
                    <td>Lot</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product</td>
                    <td>Brand</td>
                    <td>Metric Ton</td>
                    <td>Lot</td>
                </tr>
            </tbody>
        </table>
         <table id="example" class="display stripe">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Location</th>
                    <th>BST Number</th>
                    <th>Brand</th>
                    <th>COA</th>
                    <th>Quantity</th>
                    <th>LOT</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tfoot>
                <th colspan="2">TOTAL</th>
                <th></th>
                <th></th>
                <th></th>
                <th><label id="total"></label></th>
                <th><label id="total2"></label></th>
                <th></th>
            </tfoot>
        </table>
      







<!--         <br>
            <?php echo form_open_multipart('index.php/c_tpa_01_warehouse_management/get_coa_bst_download'); ?>
            <form method="POST" name="form_download" id="form_regis" enctype="multipart/form-data" data-toggle="validator" role="form">
            <input type="HIDDEN" name="bst_num" id="bst_num" value=""/>

        <table id="example" class="display stripe">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>BST Number</th>
                    <th>Brand</th>
                    <th>COA</th>
                    <th>Quantity</th>
                    <th>LOT</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tfoot>
                <th colspan="2">TOTAL</th>
                <th></th>
                <th></th>
                <th><label id="total"></label></th>
                <th><label id="total2"></label></th>
                <th></th>
            </tfoot>
        </table>
        </form>
    </div> -->

<!--     <div>
    	<h3>Transaction Progress Table</h3>
    </div>
    <br> -->

<!-- </section> -->
<script type="text/javascript">


 </script>
    <script type="text/javascript">
        function change_of_data(){
           var formdata = new FormData(document.getElementById('form_warehouse'));
            $(document).ready(function(){

           
                $.ajax({
                    url: '<?php echo base_url("index.php/c_tpa_01_warehouse_management/get_data_warehouse"); ?>',
                    cache: false,
                    contentType: false,
                    processData: false,
                    method :'POST',
                    type: 'POST',
                    data : formdata,
                    dataType : 'JSON',

                    success: function(data){
                        // var No = 0;
                       $(document).ready(function() {
                        // alert(data.bstno);
                       // $('#example').dataTable().empty();
                         // alert(data[1].brand_);
                    //       var table = $("#example tbody");
                    // table.empty();
                            $('#example').dataTable( {
                                destroy : true,
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ],
                                data: data,
                                 columns: [
                                    { data: "No" },
                                    { data: "location"},
                                    { data: "bstno"},
                                    { data: "brand" },
                                    { data: "coano" },
                                    { data: "quantity" },
                                    { data: "lot" },
                                    { data: "bstno" ,
                                        "render": function ( data, type, row, meta ) {
                                        return  "<button type='submit' id='btn_"+data.replace(/\//g,'_')+"' type='button' class='btn btn-outline-primary' style='color:blue' onclick='download_bst_coa(\""+data+"\")'>Download BST & COA</button>"
                                        }
                                    } 
                                ],
                                footerCallback: function ( row, data, start, end, display ) {
                                    var api = this.api();
                                    // Remove the formatting to get integer data for summation
                                    var intVal = function ( i ) {
                                        return typeof i === 'string' ?
                                            i.replace(/[\$,]/g, '')*1 :
                                            typeof i === 'number' ?
                                                i : 0;
                                    };
                          
                                    // Total over all pages
                                    var total = api
                                        .column( 5 )
                                        .data()
                                        .reduce( function (a, b) {
                                            return intVal(a) + intVal(b);
                                        } );
                          
                                    // Total over this page
                                    var pageTotal = api
                                        .column( 6)
                                        .data()
                                        .reduce( function (a, b) {
                                            return intVal(a) + intVal(b);
                                        } );
                          
                                    // Update footer
                                    $( api.column( 5 ).footer() ).html(
                                        total
                                    );
                                    $( api.column( 6 ).footer() ).html(
                                        pageTotal
                                    );

                                }
                            } );
                        } );

                        // var num = data[0].total;
                        // var n = (num/1000).toFixed(2);
                        // var res = n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                        // var num2 = data[0].total2;
                        // var n2 = (num2/1).toFixed(0);
                        // var res2 = n2.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                        // $("#total").html(""+res+"");
                        // $("#total2").html(""+res2+"");
                    },
                    error: function(xhr){
                        alert("failed");   
                    }
                })
            // return true;
             });


            // var date = document.getElementById('datepicker').value;
            // var warehouse = document.getElementById('locationwarehouse').value;
            // var brand = document.getElementById('brand').value;

            $.ajax({
                url : '<?php echo base_url("index.php/c_tpa_01_warehouse_management/get_summary_warehouse"); ?>',
                // dataType : 'JSON',
                // data : {
                //     date_ : date,
                //     warehouse_code : warehouse,
                //     brand_ : brand
                // },
                // type : 'POST','
                 cache: false,
                    contentType: false,
                    processData: false,
                    method :'POST',
                    type: 'POST',
                    data : formdata,
                    dataType : 'JSON',
                error : function(xhr){
                    alert('data summary not available');
                },
                success : function(data){

                    $(document).ready(function() {
                        // alert(data.bstno);
                         // alert(data[1].brand_);
                            $('#example1').dataTable( {
                                destroy : true,
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ],
                                data: data,
                                 columns: [
                                    { data: "product" },
                                    { data: "brand" },
                                    { data: formatNumber("tonase")},
                                    { data: formatNumber("lot") }
                                ]
                //     var table = $("#example1 tbody");
                //     table.empty();
                //     $.each(data, function (a, b) {
                //     table.append("<tr><td>"+b.product+"</td>" +
                //         "<td>"+b.brand+"</td>"+
                //         "<td>" + formatNumber(b.tonase/1000) + "</td>"+
                //         "<td>" + formatNumber(b.lot) + "</td>"+
                //         "</tr>"
                //     );
                // });
                        })
                    });
                }
            })
        }
        // function change_of_data(){
        //     var date = document.getElementById('datepicker').value;
        //     var warehouse = document.getElementById('locationwarehouse').value;
        //     var brand = document.getElementById('brand').value;
        //     // $('#example').DataTable( {
        //     // serverSide: true,
        //     $.ajax({
        //         url : '<?php echo base_url("index.php/c_tpa_01_warehouse_management/get_data_warehouse"); ?>',
        //         dataType : 'JSON',
        //         data : {
        //             date_ : date,
        //             warehouse_code : warehouse,
        //              brand_ : brand
        //         },
        //         type : 'POST',
        //         error : function(xhr){
        //             alert('data not available');
        //         },
        //         success : function(data){
        //             var table = $('#example tbody');
        //             table.empty();
        //             $("#total").html("0");
        //             $("#total2").html("0");

        //             var num = data[0].total;
        //             var n = (num/1000).toFixed(2);
        //             var res = n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

        //             var num2 = data[0].total2;
        //             var n2 = (num2/1).toFixed(0);
        //             var res2 = n2.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

        //             $("#total").html(""+res+"");
        //             $("#total2").html(""+res2+"");
        //             $.each(data, function (a, b) {
        //                 var str = b.bstno;
        //                 var delim = '/'
        //                 var str_replace = str.replace(/\//g,'_');
        //                 table.append("<tr><td>"+b.location+"</td>" +
        //                     "<td>"+b.bstno+"</td>"+
        //                     "<td>" + b.brand + "</td>" +
        //                     "<td>" + b.coano + "</td>" +
        //                     "<td>" + formatNumber(b.quantity) + "</td>"+
        //                     "<td>" + b.lot + "</td>"+
        //                     "<td>"+
        //                         "<button type='submit' id='btn_"+str_replace+"' type='button' class='btn btn-outline-primary' style='color:blue' onclick='download_bst_coa(\""+b.bstno+"\")'>Download BST & COA</button>"+
        //                     "</td>"+
        //                     "</tr>"
        //                 );
        //             });
        //         }
        //     })

        //     $.ajax({
        //         url : '<?php echo base_url("index.php/c_tpa_01_warehouse_management/get_summary_warehouse"); ?>',
        //         dataType : 'JSON',
        //         data : {
        //             date_ : date,
        //             warehouse_code : warehouse,
        //             brand_ : brand
        //         },
        //         type : 'POST',
        //         error : function(xhr){
        //             alert('data summary not available');
        //         },
        //         success : function(data){
        //             var table = $("#example1 tbody");
        //             table.empty();
        //             $.each(data, function (a, b) {
        //             table.append("<tr><td>"+b.product+"</td>" +
        //                 "<td>"+b.brand+"</td>"+
        //                 "<td>" + formatNumber(b.tonase/1000) + "</td>"+
        //                 "<td>" + formatNumber(b.lot) + "</td>"+
        //                 "</tr>"
        //             );
        //         });
        //         }
        //     })
        // }

        function formatNumber(num) {
          return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example1').DataTable();
        } );


         function download_bst_coa(a){
            // alert(a);
            var str = a;
            var delim = '/'
            var str_replace = str.replace(/\//g,'_');
            window.open('<?php echo base_url()?>application/download/BST/'+str_replace+'.zip');
    

         }
    </script>