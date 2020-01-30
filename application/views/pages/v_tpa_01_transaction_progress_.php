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
                    <h3>Transaction Progress</h3>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <div>
    	<h3>Transaction Progress Table</h3>
    </div>
    <br><hr>
	<div class="container" style="width: 100%">
		<table id="example" class="display stripe" >
            <thead>
                <tr>
                
                  <th></th>
					<th>Business Date</th>
					<th>ExchangeRef</th>
					<th>TradeTime</th>
					<th>Kode Buyer</th>
					<th>Kode Produk</th>
					<th>Contract Month</th>
					<th>Volume</th>
					<th>Price</th>
					<th>Contract Size</th>
					<th>Amount</th>
                </tr>
            </thead>
        </table>
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
                     { "data": "TradeTime" },
                     { "data": "KodeBuyer" },
                     { "data": "KodeProduk" },
                     { "data": "ContractMonth" },
                     { "data": "Volume" },
                     { "data": "Price" },
                     { "data": "ContractSize" },
                     { "data": "Amount" },
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

             var x = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                 '<tr>' +
                    '<th rowspan="7">Detail Status</th>' +
                    '<td>Buyer Invoice :</td>'+
                    '<td colspan="3">'+d.BuyerInvoice+'</td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>Buyer Payment Due</td>'+
                    	'<td>'+d.BuyerPaymentDue+'</td>'+
                  '</tr>'+
                 '<tr>' +
                    '<td>Buyer Payment Date:</td>' +
                    '<td>'+ d.BuyerPaymentDate +'</td>'+
                 '</tr>' +
                 '<tr>' +
                    '<td>Buyer Full Payment :</td>' +
                    '<td>'+ d.BuyerFullPayment +'</td>' +

                 '</tr>' +
                 '<tr>' +
                    '<td>Full Delivery:</td>' +
                    '<td>'+d.FullDelivery+'</td>' +
                 '</tr>' +
                  '<tr>' +
                    '<td>Done:</td>' +
                    '<td>'+d.Done+'</td>' +
                 '</tr>' +
             '</table>';  
             return x;
        }
        var testdata = {
        "data": [
 		// "<?php foreach($value as $val) { ?>",
        {
        "BusinessDate": "<?php echo $val['BuyerId'];?>",
        "ExchangeRef": "<?php echo $val['ExchangeRef']; ?>",
        "TradeTime": "<?php echo $val['TradeTime']; ?>",
        "KodeBuyer": "<?php echo $val['BuyerId']; ?>",
        "KodeProduk": "<?php echo $val['ProductCode']; ?>",
        "ContractMonth": "<?php echo $val['ContractMonth']; ?>",
        "Volume": "<?php echo $val['Volume']; ?>",
        "Price" : "<?php echo $val['Price']; ?>",
        "ContractSize": "<?php echo $val['ContractSize']; ?>",
        "Amount": "<?php echo $val['Amount']; ?>",
        "BuyerInvoice": "<?php echo $val['BuyerInvoice']; ?>",
        "BuyerPaymentDue": "<?php echo $val['BuyerPaymentDue']; ?>",
        "BuyerPaymentDate": "<?php echo $val['BuyerPaymentDate']; ?>",
        "BuyerFullPayment": "<?php echo $val['BuyerFullPayment']; ?>",
        "FullDelivery": "<?php echo $val['FullDelivery']; ?>",
        "Done": "<?php echo $val['Done']; ?>",
        },
   		// "<?php } ?>"
        ]
        };
    </script>