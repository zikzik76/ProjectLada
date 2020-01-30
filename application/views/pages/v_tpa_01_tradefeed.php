<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">
<style type="text/css">
 table.dataTable tr th.select-checkbox.deselect::before {
    content: "+";
    margin-top: -11px;
    margin-left: -4px;
    text-align: center;
    text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
    /* text-shadow: black 1px 1px,black -1px -1px, black 1px -1px, black -1px 1px; */
    color : black;
}
  table.dataTable tr th.select-checkbox.selected::after {
    /*content: "✔"; */
    margin-top: -11px;
    margin-left: -4px;
    text-align: center;
    text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
    /* text-shadow: black 1px 1px,black -1px -1px, black 1px -1px, black -1px 1px; */
    color : black;
}

</style>
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
                    <h2>Update Shipping Instruction</h2>
                </div>
            </div>
        </div>
    </nav>
    <br>
<!--     <div>
    	<h3>Transaction Progress Table</h3>
    </div>
    <br> -->
    <hr>
<div class="container" style="width: 100%">
 <?php echo form_open_multipart('index.php/c_tpa_01_tradefeed/upload_doc','id="frm-example"','name="frm-example"'); ?>
    <!-- <form id="frm-example" name="frm-example" action="/path/to/your/script" method="POST"> -->
    <!-- <form method="POST" name="form_upload" id="form_upload"  enctype="multipart/form-data"> -->
    <header><b>Upload Shipping Instruction for Selected items</b></header>
    <hr>
    <br>
    
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-3">
            <label>Shipping Instruction Number</label>
          </div>
          <div class="col-lg-3">
            <input type="text" name="input_si_num" id="input_si_num" value="" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
            <label>Term Of Transaction</label>
          </div>
          <div class="col-lg-3">
            <b><input type="text" name="tof" id="tof" value="ADP" required></b>

          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
            <label>No. Form ADP</label>
          </div>
          <div class="col-lg-3">
            <b><input type="text" name="boc" id="boc" value="Based On Contract" required></b>
          </div>
            
        </div>
        <br>
         <div class="row">
          <div class="col-lg-3">
            <label>Shipper Name</label>
          </div>
          <div class="col-lg-3">
            <textarea name="sh_name" id="sh_name" style="max-width: 300px;min-width: 300px" required></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
            <label>Shipper Address</label>
          </div>
          <div class="col-lg-3">
            <textarea name="sh" id="sh" style="max-width: 300px;min-width: 300px" required></textarea>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-3">
            <label>Consignee Name</label>
          </div>
          <div class="col-lg-3">
            <textarea id="cs_name" name="cs_name" style="max-width: 300px; min-width: 300px" required></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
            <label>Consignee Address</label>
          </div>
          <div class="col-lg-3">
            <textarea id="cs" name="cs" style="max-width: 300px;min-width: 300px" required></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
            <label>Port Of Dischange</label>
          </div>
          <div class="col-lg-3">
            <input type="text" id="pod" name="pod" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
              <label >Part of loading</label>
          </div>
          <div class="col-lg-3">
            <select name="pol" id="pol" class="form-control" required="required" style="width: 200px" >
              <option value="">-</option>
            <?php foreach($wh as $keys){?>
                <option value="<?php echo $keys['location'];?>"><?php echo $keys['location']?></option>
            <?php } ?>
            </select>

          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
              <label >Warehouse Location</label>
          </div>
          <div class="col-lg-3">
            <select name="locationwarehouse" id="locationwarehouse" class="form-control" required="required" style="width: 200px">
              <option value="">-</option>
            <?php foreach($wh1 as $keys1){?>
                <option value="<?php echo $keys1['location'];?>"><?php echo $keys1['location']?></option>
            <?php } ?>
            </select>
          </div>
        </div>
        <input type="HIDDEN" name="array_bst" id="array_bst" value="">
        <input type="HIDDEN" name="array_id" id="array_id" value="">
      </div>
    </div>
    <hr>
    <div class="row well well-lg">
    <br>
      <div class="col-lg-12">
        <h3>Upload Shipping Instruction</h3>
      </div>
    <br>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-3">
            <label>Upload Multiple Shipping Instruction</label>
          </div>
          <div class="col-lg-3">
            <input type="file" class="custom-file-input" id="inputGroup'" name="inputGroup" accept="application/pdf" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
            <input type="button" id="submit_btn_validate" name="submit_btn_validate" class="btn btn-warning" value="Validate" onclick="GetSelected()">
<!--           </div> 
          <div class="col-lg-3"> -->
            <input type="submit" id="submit_btn" name="submit_btn" class="btn btn-primary" value="Submit Data" disabled> 
          </div>  
        </div>
      </div>
  </div>
    <br>
    <hr>
<!--     <small class="col-lg-12 well well-lg"><b><em>Hold SHIFT Button for multiple selected row</em></b></small>
    <br> -->
		<table id="example" class="display select" >
            <thead>
                <tr>
                  <!-- <th><input name="select_all" id="select_all" value="0" type="checkbox" onclick="get_check()"></th> -->
                  <th><a class="btn btn-primary btn-xs" type="button"><i class="far fa-check-square"></i></a></th>
                    <th>Business Date</th>
                    <th>BST NO.</th>
                    <th>Exchange Ref</th>
                    <!-- <th>Approval Status</th> -->
                    <th>Trade Time</th>
                    <th>Contract ID </th>
                    <th>Price (USD)</th>
                    <th>Quantity (LOT)</th>
                    <th>Buyer</th>
                    <th>Shipping Instruction Approval</th>
                    <th>Shipping Instruction Upload</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($value AS $val){ ?>
              <tr>
                <!-- <td><input id="td_select<?php echo $val['TradeFeedID']?>" name="chk[]" value="'<?php echo $val['SellerRef']?>'" type="checkbox" onchange="GetSelected()"></td> -->
                <td></td>
                <td><?php echo date("d-m-Y",strtotime($val['BusinessDate']));?></td>
                <td><?php echo $val['SellerRef'];?></td>
                <td><?php echo $val['ExchangeRef'];?></td>
                <!-- <td><?php echo $val['ApprovalStatus'];?></td> -->
                <td><?php echo date("d-m-Y",strtotime($val['TradeTime']));?></td>
                <td><?php echo $val['ContractID'];?></td>
                <td><?php echo number_format($val['Price']);?></td>
                <td><?php echo number_format($val['Quantity']);?></td>
                <td><?php echo $val['Name'];?></td>
                <td><?php echo $val['ShippingInstructionFlag'];?></td>
                
                <?php if($val['ShippingInstructionFlag'] == ''){ ?>
                <td></td> 
                <?php } else if($val['ShippingInstructionFlag'] == 'P') { ?>
                  <td colspan="3" style="color : Green;width: 300px;">
                      <div class="input-group mb-3">
                          <div class="custom-file">
                              <span class="badge badge-primary">On Progress Approval <i class="glyphicon glyphicon-ok"></i></span>
                          </div>
                      </div>
                  </td>
                <?php } else if($val['ShippingInstructionFlag'] == 'A') { ?>
                  <td colspan="3" style="color : Green;width: 300px;">
                      <div class="input-group mb-3">
                          <div class="custom-file">
                              <span class="badge badge-primary">Approved <i class="glyphicon glyphicon-ok"></i></span>
                          </div>
                      </div>
                  </td>
                <?php } else if($val['ShippingInstructionFlag'] == 'R'){ ?>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" class="btn btn-primary" href="#mymodal" name="button_up" id="button_up" onclick="post_var('<?php echo $val['SellerRef'];?>','<?php echo $val['TradeFeedID'];?>')">Edit Shipping Instruction</button>
                </td> 
                <?php } ?>
                <td style="display: none"><?php echo $val['TradeFeedID'];?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
<hr>
<br>
    </form>
</div>
<hr>
<header><b>Shipping Instruction Status Approved</b></header>
<hr>
<table id="example_1" class="display select" >
            <thead>
                <tr>
                    <th>Business Date</th>
                    <th>BST NO.</th>
                    <th>Exchange Ref</th>
                    <!-- <th>Approval Status</th> -->
                    <th>Trade Time</th>
                    <th>Contract ID </th>
                    <th>Price (USD)</th>
                    <th>Quantity (LOT)</th>
                    <th>Buyer</th>
                    <th>Shipping Instruction Approval</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($value_1 AS $val_1){ ?>
              <tr>
                <td><?php echo date("d-m-Y",strtotime($val_1['BusinessDate']));?></td>
                <td><?php echo $val_1['SellerRef'];?></td>
                <td><?php echo $val_1['ExchangeRef'];?></td>
                <!-- <td><?php echo $val_1['ApprovalStatus'];?></td> -->
                <td><?php echo date("d-m-Y",strtotime($val_1['TradeTime']));?></td>
                <td><?php echo $val_1['ContractID'];?></td>
                <td><?php echo number_format($val_1['Price']);?></td>
                <td><?php echo number_format($val_1['Quantity']);?></td>
                <td><?php echo $val_1['Name'];?></td>
                <!-- <td><?php echo $val_1['ShippingInstructionFlag'];?></td> -->
                <?php if($val_1['ShippingInstructionFlag'] == 'A') { ?>
                  <td colspan="3" style="color : Green;width: 300px;">
                      <div class="input-group mb-3">
                          <div class="custom-file">
                              <span class="badge badge-primary">Approved <i class="glyphicon glyphicon-ok"></i></span>
                          </div>
                      </div>
                  </td>
                <?php } else { ?>
                  <td></td>
                <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
<br><br><br>

<div class="modal fade" id="mymodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Update Files</h4>
      </div>
      <?php echo form_open_multipart('index.php/c_tpa_01_tradefeed/updloaddoc'); ?>
      <div class="modal-body">
        <div class="input-group">
           <div class="custom-file col-sm-12">
              <input type="HIDDEN" name="bookId_code" id="bookId_code" value="">
              <input type="HIDDEN" name="bookId_" id="bookId_" value="">
              <!-- <input type="HIDDEN" name="NoAktaPendiri" id="NoAktaPendiri" value="no_akta"> -->
              <label id="title"></label>
              <br>
              <label>Input Shipping Instruction Number</label>
              <br>
              <input type="text" name="si_num" id="si_num">
              <br>
              <input type="file" class="custom-file-input" name="upload_field" id="upload_field" required="required" accept="application/pdf"/>

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
document.getElementById('array_bst').value = '';
document.getElementById('array_id').value = '';

let example = $('#example').DataTable({

    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }],
    select: {
        style: 'multi',
        selector: 'td:first-child'
    },

    order: [
        [1, 'asc']
    ]
} );

// let example_1 = $('#example_1').DataTable({
//    columnDefs: [{
//       "scrollY": 100,
//             "scrollX": true,
//             "scrollCollapse": true,
//             "fixedHeader": true,
//             "bInfo": true,
//             scrollResize: true,
//             lengthChange: false,
//             searching: true,
//             "paging": true,
//             orderable: true,
//             targets: 0,
//    }],

//     order: [
//         [1, 'asc']
//     ]
//   } );
// $('<div class="loading">Loading</div>').appendTo('body');
 
// $('#example_1').dataTable( {
//   "initComplete": function( settings, json ) {
//     $('div.loading').remove();
//   }
// } );

example.on('select.dt', function() {
  var array = [];
  var array_ = [];
  example.rows('.selected').every(function(rowIdx) {
     array.push(example.row(rowIdx).data()[2])
  }) ;
  example.rows('.selected').every(function(rowIdx) {
     array_.push(example.row(rowIdx).data()[11])
  }) ;  
  document.getElementById('array_bst').value = array;
  document.getElementById('array_id').value = array_;
})
example.on('deselect.dt', function() {
  var array = [];
  var array_ = [];
  example.rows('.selected').every(function(rowIdx) {
     array.push(example.row(rowIdx).data()[2])
  }) ;
  example.rows('.selected').every(function(rowIdx) {
     array_.push(example.row(rowIdx).data()[11])
  }) ;  
  document.getElementById('array_bst').value = array;
  document.getElementById('array_id').value = array_;
})



example.on("click", "th.select-checkbox", function() {
    if ($("th.select-checkbox").hasClass("selected")) {
        example.rows().deselect();
        $("th.select-checkbox").removeClass("selected");
    } else {
        example.rows().select();
        $("th.select-checkbox").addClass("selected");
    }
}).on("select deselect", function() {
    ("Some selection or deselection going on")
    if (example.rows({
            selected: true
        }).count() !== example.rows().count()) {
        $("th.select-checkbox").removeClass("selected");
    } else {
        $("th.select-checkbox").addClass("selected");
    }
});

$(document).ready(function(){
    var example_1 = $('#example_1').DataTable({
      
        columnDefs: [{
            "scrollY": 100,
            "scrollX": true,
            "scrollCollapse": true,
            "fixedHeader": true,
            "bInfo": true,
            scrollResize: true,
            lengthChange: false,
            searching: true,
            "paging": true,
            orderable: true,
            targets: 0,
        }],
     
        order: [
            [1, 'asc']
        ]
    });
});
// $(document).ready(function() {
//     $('#example1').DataTable( {
//         paging: true,
//         //pageLength: '10',
//     });
// });


function GetSelected(){
   document.getElementById("submit_btn").disabled = false;
};


function post_var(n, y) {
    document.getElementById('bookId_').value = n;
    document.getElementById('bookId_code').value = y;
    document.getElementById('upload_field').id = 'upload_field' + y;
    document.getElementById('upload_field' + y).name = 'upload_field' + y;

}

function post_var_(n, y, z) {
    document.getElementById('send_bst').value = n;
    document.getElementById('tdid_').value = y;
    document.getElementById('upload_field_new').id = 'upload_field_new' + y;
    document.getElementById('upload_field_new' + y).name = 'upload_field_new' + y;


}
$('#submit').click(function(){
  $.blockUI({ message: $('#dommessage')});
});
    </script>

