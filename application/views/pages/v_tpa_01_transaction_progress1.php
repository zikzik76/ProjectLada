<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.blockUI.js');?>">
    </script>
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
                    <h3>Transaction Progress</h3>
                </div>
                <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo base_url('index.php/c_tpa_01_tradefeed');?>" >Document Upload Shipping Instruction</a></li>
                        <li><a href="<?php echo base_url('index.php/c_tpa_01_transaction_progress'); ?>">Transaction Progress</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </nav>
    <br>
    <div class="container" style="width: 100%">
        <div class="well well-sm">
            <div class="row" style="text-align: center">
                <div class="col-lg-12" >
                    <label><h3>Account Type Information</h3></label> 
                </div>
            </div>
            <!-- <hr> -->
            <div class="row center-block" style="text-align: center">
                <!-- <div class=".col-md-3 .col-md-offset-3">
                    <label>RS</label>
                </div> -->
                <div class=".col-md-3 .col-md-offset-3">
                    <label>Rekening Settlement (<em>RS</em>)</label>
                    <p>account used for settlement of transactions</p>
                </div>
            </div>
            <div class="row" style="text-align: center">
 <!--                <div class=".col-md-3 .col-md-offset-3">
                    <label>RD</label>
                </div> -->
                <div class=".col-md-3 .col-md-offset-3">
                    <label>Rekening Deposit (<em>RD</em>)</label>
                    <p>An account used to make a transaction risk guarantee deposit</p>
                </div>
            </div>
        </div>
        <br>
        <table id="example2" class="display stripe">
            <thead>
                <tr>
                    <th>Account VA Number</th>
                    <th>Account Stats</th>
                    <th>Investor Code</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($val as $keys) { ?>
                <tr>
                    <td><?php echo $keys['AccountNo'];?></td>
                    <td><?php echo $keys['AccountType'];?></td>
                    <td><?php echo $keys['Investorcode'];?></td>
                    <td><?php echo $keys['description'];?></td>
                </tr>
            <?php }?> 
            </tbody>
        </table>
    </div>
    <div id="dommessage" style="display: none"> 
        <img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
        <br/>
        <h4>Saving data in progress, Please wait a moment...</h4>
</div>
<!--     <div>
    	<h3>Transaction Progress Table</h3>
    </div>
    <br> -->
    <br>
    <hr>
	<div class="container" style="width: 100%">
    <form method="POST" name="form_upload_" id="form_upload_" enctype="multipart/form-data">
		<table id="example" class="display stripe" >
            <thead>
                <tr>
                    <th></th>
					<th>Business Date</th>
					<th>Exchange Ref</th>
					<th>Investor Code</th>
					<th>Produk Code</th>
					<th>Volume (Ton)</th>
					<th>Price (USD)</th>
					<th>Amount (USD)</th>
                </tr>
            </thead>
        </table>
    </form>
	</div>

<!-- </section> -->
<script type="text/javascript">
 // $.ajax({
 //        url: "http://10.15.10.21/DTIAPI/api/dti/decrypt",
 //        type : "GET",
 //        data : {
 //          "seed" : "ZllpUnBoSUdqVXFDNVJqVzFEWVZMZz09" 
 //        },
 //        dataType : "JSON",
 //        error : function(xhr){
 //        	console.log(xhr.data);
 //        },
 //        success : function(data){
 //          alert(data);
 //          // console.clear();
 //        },
 //      });


// </script>
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
                     { "data": "BusinessDate" },
                     { "data": "ExchangeRef" },
                     { "data": "KodeBuyer" },
                     { "data": "KodeProduk" },
                     { "data": "Volume" },
                     { "data": "Price" },
                     { "data": "Amount" },
                 ],
                 "order": [[1, 'asc']]
             });

            $('#example2').DataTable({
                 select:"single",
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

             var x = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                 '<tr>' +
                    '<th rowspan="8">Detail Status</th>' +
                    '<td>Buyer Outstanding :</td>'+
                    '<td colspan="3">'+d.BuyerOutStanding+'</td>'+
                    '<td></td>'+
                    '<td>Upload APP Form</td>'+
                    '<td>'+
                        '<div class="input-group">'+
                            '<div class="custom-file col-sm-12">'+
                                '<input type="file" class="custom-file-input" name="app_form_upload'+d.ExchangeRef+'" id="app_form_upload'+d.ExchangeRef+'" required="required" accept="application/pdf">'+
                            '</div>'+
                        '</div>'+
                    '</td>'+
                    '<td><button type="button" class="btn btn-primary" onclick="upload_app();">Upload</button></td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>Buyer Invoice</td>'+
                        '<td >'+d.BuyerInvoice+'</td>'+
                        '<td colspan="3" width="200px"></td>'+

                  '</tr>'+
                 '<tr>' +
                    '<td>Buyer Payment Due</td>'+
                    	'<td>'+d.BuyerPaymentDue+'</td>'+
                  '</tr>'+
                 '<tr>' +
                    '<td>Buyer Full Payment:</td>' +
                    '<td>'+ d.BuyerFullPayment +'</td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>Seller Receive Payment :</td>' +
                    '<td>'+ d.SellerFullReceive +'</td>' +
                 '</tr>' +
                  '<tr>' +
                    '<td>Shipping Instruction Approval :</td>' +
                    '<td>'+ d.ShippingInstructionApprovalUpdate +'</td>' +
                 '</tr>' +
                 '<tr>' +
                    '<td>Full Delivery:</td>' +
                    '<td>'+d.FullDelivery+'</td>' +
                 '</tr>' +
                  '<tr>' +
                    '<td>Done:</td>' +
                    '<td>'+d.Done+'</td>' +
                    '<td style="display : none" ><input type="text" id="exchange_upload" name="exchange_upload" value="'+d.ExchangeRef+'"/> </td>' +
                 '</tr>' +
             '</table>';  
             return x;
        }
        var testdata = {
            "data": [
     		// "<?php foreach($value as $val) { ?>",
                {
                "BusinessDate": "<?php echo date("d-m-Y",strtotime($val['BusinessDate']));?>",
                "ExchangeRef": "<?php echo $val['ExchangeRef']; ?>",
                "TradeTime": "<?php echo date("d-m-Y",strtotime($val['TradeTime'])); ?>",
                "KodeBuyer": "<?php echo strtoupper($val['BuyerId']); ?>",
                "KodeProduk": "<?php echo $val['ProductCode']; ?>",
                "ContractMonth": "<?php echo $val['ContractMonth']; ?>",
                "Volume": "<?php echo number_format($val['Volume'],3); ?>",
                "Price" : "<?php echo number_format($val['Price'],0); ?>",
                "Amount": "<?php echo number_format($val['Amount'],0); ?>",
                "BuyerInvoice": "<?php echo date("d-m-Y",strtotime($val['BuyerInvoice'])); ?>",
                "BuyerPaymentDue": "<?php echo date("d-m-Y",strtotime($val['BuyerPaymentDue'])); ?>",
                "BuyerPaymentDate": "<?php echo date("d-m-Y",strtotime($val['BuyerPaymentDate'])); ?>",
                "BuyerFullPayment": "<?php if(date("d-m-Y",strtotime($val['BuyerFullPayment'])) == '01-01-1970')
                                            {
                                                echo ('');
                                            } else {
                                                echo date("d-m-Y",strtotime($val['BuyerFullPayment']));
                                            }; ?>",
                "FullDelivery": "<?php if(date("d-m-Y",strtotime($val['FullDelivery'])) == '01-01-1970')
                                            {
                                                echo ('');
                                            } else {
                                                echo date("d-m-Y",strtotime($val['FullDelivery']));
                                            }; ?>",
                "BuyerOutStanding": "<?php echo number_format($val['BuyerOutStanding']); ?>",
                // "Done": "<?php echo date("d-m-Y",strtotime($val['Done'])); ?>",
                "Done": "<?php if(date("d-m-Y",strtotime($val['Done'])) == '01-01-1970')
                                            {
                                                echo ('');
                                            } else {
                                                echo date("d-m-Y",strtotime($val['Done']));
                                            }; ?>",
                // "SellerFullReceive": "<?php echo date("d-m-Y",strtotime($val['SellerFullReceive'])); ?>",
                "SellerFullReceive": "<?php if(date("d-m-Y",strtotime($val['SellerFullReceive'])) == '01-01-1970')
                                            {
                                                echo ('');
                                            } else {
                                                echo date("d-m-Y",strtotime($val['SellerFullReceive']));
                                            }; ?>",
                // "ShippingInstructionApprovalUpdate": "<?php echo date("d-m-Y",strtotime($val['ShippingInstructionApproveDate'])); ?>"
                "ShippingInstructionApprovalUpdate": "<?php if(date("d-m-Y",strtotime($val['ShippingInstructionApproveDate'])) == '01-01-1970')
                                            {
                                                echo ('');
                                            } else {
                                                echo date("d-m-Y",strtotime($val['ShippingInstructionApproveDate']));
                                            }; ?>",
                "upload_app_form" : "<?php echo $val['ExchangeRef']; ?>"
                },
       		// "<?php } ?>"
            ]
        };

        function upload_app(){
             $.blockUI({ message: $('#dommessage')});
            var formdata = new FormData(document.getElementById('form_upload_'));
            // console.log(control);

            $.ajax({
                url : '<?php echo base_url();?>index.php/c_tpa_01_transaction_progress/apload_form_app',
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                data : formdata,
                // dataType : 'JSON',
                success: function(data, textStatus, jqXHR){ 
                    alert("upload_success");
                    // onClick="this.form.reset()"
                    // var control = document.getElementById('app_form_upload'+exref);
                    var exref = document.getElementById('exchange_upload').value;
                    document.getElementById('app_form_upload'+exref).value = '';
                    // control.replaceWith( control.val('').clone( true ) );

                    // window.location.replace("https://tinmarket.id");
                    $.unblockUI();
                },
                error: function(jqXHR, textStatus, errorThrown){
                   alert("upload_success");
                    // onClick="this.form.reset()"
                    // var control = document.getElementById('app_form_upload'+exref);
                    var exref = document.getElementById('exchange_upload').value;
                    document.getElementById('app_form_upload'+exref).value = '';
                    // control.replaceWith( control.val('').clone( true ) );

                    // window.location.replace("https://tinmarket.id");
                    $.unblockUI();
                }
            });
        }
    </script>