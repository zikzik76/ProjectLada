<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">

<form method="POST" name="form_transaction" id="form_transaction" enctype="multipart/form-data" data-toggle="validator" role="form">
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
                    <h2>Transaction History</h2>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 mb-12">
                <label class="form-control-label">
                    Buyer
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-6 mb-6">
                <select name="buyer_select" id="buyer_select" class="form-control" required="required">
                    <option value=""> - </option>
                     <?php foreach($buyer as $val_buyer){?>
                        <option value="<?php echo $val_buyer['Buyer_id']?>"><?php echo $val_buyer['Buyer_id']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
                <div class="col-xs-12 col-md-12 mb-12">
                    <label class="form-control-label">
                        Start Date
                    </label>
                </div>
        </div>
         <div class="row">
                <div class="col-xs-12 col-md-12 mb-12 mb-5">
                    <input type="date" name="input_start_date" id="input_start_date">        
                </div>
        </div>
        <br>
        <div class="row">
                <div class="col-xs-12 col-md-12 mb-12 mb-5">
                    <label class="form-control-label">
                        End Date
                    </label>
                </div>
        </div>
         <div class="row">
                <div class="col-xs-12 col-md-12 mb-12">
                    <input type="date" name="input_end_date" id="input_end_date">
                </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-3">
                <button class="btn btn-primary btn-block" type="button" name="btn_search" id="btn_search" onclick="post_data()" >Save</button>
            </div>
            <div class="col-lg-3">
                <button class="btn btn-warning btn-block" type="button" name="btn_reset" id="btn_reset">Reset</button>
            </div>
        </div>
        <br>
        <hr>
        <div class="row">
            <table id="example" class="display select" >
                <thead>

                    <tr>
                        <th rowspan="2">No</th>
                        <th colspan="2" style="text-align: center">Periode</th>
                        <th rowspan="2">Brand</th>
                        <th rowspan="2">Settlement Price</th>
                        <th rowspan="2">Average Price</th>
                        <th rowspan="2">Tonase</th>
                    </tr>
                    <tr>
                        <th>Tanggal Start</th>
                        <th>Tanggal End</th>
                    </tr>
                </thead>
            </table>    
        </div>
    </div>
<hr>
<br>
<br>
<br>
</form>
<div id="dommessage" style="display: none"> 
    <img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
    <br/>
    <h4>Saving data in progress, Please wait a moment...</h4>
  </div>
<script type="text/javascript">

$('#submit').click(function(){
  $.blockUI({ message: $('#dommessage')});
});

function post_data(){

    var formdata = new FormData(document.getElementById('form_transaction'));
    $(document).ready(function(){

   
        $.ajax({
            url: '<?php echo base_url();?>index.php/c_tpa_01_transaction_/get_data_transaction',
            cache: false,
            contentType: false,
            processData: false,
            method :'POST',
            type: 'POST',
            data : formdata,
            dataType : 'JSON',

            success: function(data){
                var No = 0;
               $(document).ready(function() {
                 // alert(data[1].brand_);
                    $('#example').dataTable( {
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        data: data,
                         columns: [
                            { data: "No" },
                            { data: "startdate_"},
                            { data: "enddate_"},
                            { data: "brand_" },
                            { data: "Sp" },
                            { data: "average_" },
                            { data: "volume_" }
                        ],
                    } );
                } );
            },
            error: function(data){
                alert("failed");   
            }
        })
    // return true;
     });
}
</script>