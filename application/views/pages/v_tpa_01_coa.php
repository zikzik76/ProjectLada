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
                    <h3>Certificate Of Analysis (COA)</h3>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
    <div class="container-fluid center"> 
        <p>Please Select Entry Type <br><small><em>Silahkan Pilih Type Entri</em></small></p>       
        <!-- <form method="POST" name="form_regis" id="form_regis" enctype="multipart/form-data" data-toggle="validator" role="form">        -->
            <div class="radio">
                <label><input type="radio" name="optradio_coa" id="optradio_single" value="Single" >&nbsp; Single | <small><em>Data Tunggal</em></small></label>
            </div>
            <div class="radio">
                <label><input type="radio" name="optradio_coa" id="optradio_multiple" value="Multiple" >&nbsp; Multiple | <small><em>Data Excel</em></small></label>
            </div>
            <br>
            <!-- <div id="status_negeri" class="row">
                
            </div>
            <div id="form_anggota" class="row"> 

            </div> -->
           
        <!-- </form> -->

    </div> 
    <!-- end radio btn -->
    <br>
    <br>
        <div class="form-group" id="formMultiple">
        <form method="post" id="import_form" enctype="multipart/form-data">
			<p><label>Select Excel File</label>
			<input type="file" name="file" id="file" required accept=".xls, .xlsx" /><br />
			<input type="submit" class="btn btn-primary" name="import" value="Import" class="btn btn-info" />
		</form>
        </div>

        <div class="form-group" id="formSingle">
        <form id="form-single">
            <div class="row">
                <div class="col-lg-3">
                    <label> No. Reg. Bukti Simpan Timah (BST)</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="bstno" id="bstno" required/>

                </div>
                <div class="col-lg-3">
                    <label> Depositor </label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="deposi" id="deposi" required/>

                </div>
                
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <label class="#"> COA NO.</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="coano" id="coano" required/>

                </div>
                 <div class="col-lg-3">
                    <label>Level Of Purity (Sn)</label>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" class="form-control" id="lopnumber" name="lopnumber" placeholder="Amount" required />
                            <div class="input-group-addon">%</div>

                    </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-3">
                    <label class="#"> Trade Account Number</label>
                </div>
                <div class="col-lg-3">
                    <input type="number" class="form-control" name="tradeaccountnumber" id="tradeaccountnumber" required/>

                </div>
                <div class="col-lg-3">
                    <label>Contract Code</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="contractcode" id="contractcode" required />

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <label> Ware House Location</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="warehouseloc" id="warehouseloc" required />
                </div>
                 <div class="col-lg-3">
                    <label>Brand</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="brand" id="brand" required>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-3">
                    <label>Batch Number</label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="batchnumber" id="batchnumber" required />

                </div>
                <div class="col-lg-3">
                    <label> PIC/Position </label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="pic" id="pic" required/>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <label>Quantity</label>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Amount" required />
                            <div class="input-group-addon">Kg</div>

                    </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label> Date of Analysis </label>
                </div>
                <div class="col-lg-3">
                    <input type="date" class="form-control" name="DoAnalis" id="DoAnalis"/>

                </div>
            </div>
            <div class="row">                
                <div class="col-lg-3">
                    <label> COMMODITY </label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="commodity" id="commodity" required />
                    
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary" id="addRows"><i class="fa fa-plus"></i> ADD New Marking</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="well well-lg">
            		<table id="examples" class="display stripe" >
                        <thead>
                            <tr>
                                <th disabled>NO</th>
                                <th>Name</th>
            					<th>Number</th>
                            </tr>
                        </thead>
                        
                    </table>
                    <!-- <button type="button" id="btn" name="btn" onclick="get_array()"></button> -->
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary" id="addRow"><i class="fa fa-plus"></i> ADD New Bundle</button>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="well well-lg">
            		<table id="example" class="display stripe" >
                        <thead>
                            <tr>
                                <th disabled>NO</th>
                                <th>BUNDLE CODE</th>
            					<th>WEIGHT (Kgs)</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th colspan="2">TOTAL</th>
                            <th></th>
                        </tfoot>
                    </table>
                    <!-- <button type="button" id="btn" name="btn" onclick="get_array()"></button> -->
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary" id="addRow2"><i class="fa fa-plus"></i> ADD New Bundle Code</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="well well-lg">
                    <div class="col-lg-12 center"><h3>OTHER MINERAL CONTENTS (Max.) in %</h3></div>
                    <hr>
                    <br>
                    <table id="example2" class="display stripe" >
                        <thead>
                            <tr>
                                <th class="col-lg-2" disabled>No.</th>
                                <th class="col-lg-2">Mineral Name</th>
                                <th class="col-lg-2">Contents ( % )</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        
        <br>
        <div class="row">
            <div class="center">
                <div class="col-lg-2"></div>
                <div class="col-lg-2 pull-right">
                    <!-- <button type="submit" class="btn btn-primary" onclick="get_array();">Save</button> -->
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="cancel" class="btn btn-warning">Cancel</button>
                </div>
                <div class="col-lg-4"></div>
               
            </div>
        </div>
        </form>
        </div>
        <br>
        <br>
    </div>
    <div id="dommessage" style="display: none"> 
        <img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
        <br/>
        <h4>Saving data in progress, Please wait a moment...</h4>
    </div>


<!-- </section> -->
    <script type="text/javascript">
       $('#import_form').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url:"<?php base_url(); ?>c_tpa_01_COA/insert_excel",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success:function(data){
				$('#file').val('');
				alert(data);
			}
		})
	});


        $(document).ready(function() {
            document.getElementById('formSingle').style.display = 'none';       
            document.getElementById('formMultiple').style.display = 'none'; 

            $('input[type=radio][name=optradio_coa]').change(function() {
            if (this.value == 'Single') {
                document.getElementById('formSingle').style.display = 'block'; 
                document.getElementById('formMultiple').style.display = 'none';     
            }
            else if (this.value == 'Multiple') {
                
                document.getElementById('formSingle').style.display = 'none';                
                document.getElementById('formMultiple').style.display = 'block'; 
            }
        });
            var t = $('#example').DataTable();

            var counter = 1;
         
            $('#addRow').on( 'click', function () {
                t.row.add( [
                    counter,
                    'B'+counter,
                    0,
                ] ).draw( false );
         
                counter++;
            } );
 
            // Automatically add a first row of data
            $('#addRow').click();

            var table = $('#example').DataTable();

            table.MakeCellsEditable({
                "onUpdate": myCallbackFunction
            });
        });

        $(document).ready(function() {
            var t = $('#example2').DataTable();

            var counter = 1;
         
            $('#addRow2').on( 'click', function () {
                t.row.add( [
                    counter,
                    '',
                    0,
                ] ).draw( false );
         
                counter++;
            } );
 
            // Automatically add a first row of data
            $('#addRow2').click();

            var table = $('#example2').DataTable();

            table.MakeCellsEditable({
                "onUpdate": myCallbackFunction2
            });
        });

        $(document).ready(function() {
            var t = $('#examples').DataTable();

            var counter = 1;
         
            $('#addRows').on( 'click', function () {
                t.row.add( [
                    counter,
                    '',
                    0,
                ] ).draw( false );
         
                counter++;
            } );
 
            // Automatically add a first row of data
            $('#addRows').click();

            var table = $('#examples').DataTable();

            table.MakeCellsEditable({
                "onUpdate": myCallbackFunction3
            });
        });

   $('#example').DataTable( {
    'footerCallback': function ( row, data, start, end, display ) {
            var api = this.api(), data;
  
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
  
            var counter = 1;
             total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            counter++;  
            // Total over this page
  
            // Update footer
            $( api.column( 2 ).footer() ).html(
                total +' Kg'
            );
        }
    } );



function myCallbackFunction(updatedCell, updatedRow, oldValue) {
    var bundle_array = pupdatedCell.data()[2];
    console.log("The old value for that cell was: " + oldValue);
    var array = [updatedRow.data()[2]];
    // alert(updatedRow.data());
    console.log(array);
};
function myCallbackFunction3(updatedCell, updatedRow, oldValue) {
    var bundle_array = pupdatedCell.data()[2];
    console.log("The old value for that cell was: " + oldValue);
    var array = [updatedRow.data()[2]];
    // alert(updatedRow.data());
    console.log(array);
};
function myCallbackFunction2(updatedCell, updatedRow, oldValue) {
    console.log("The new value for the cell is: " + updatedCell.data());
    console.log("The old value for that cell was: " + oldValue);
    console.log("The values for each cell in that row are: " + updatedRow.data());
};

$('#form-single').on('submit', function (e) {
    e.preventDefault();
    get_array();
});
function get_array(){
    $.blockUI({ message: $('#dommessage')});
    var bstNo = document.getElementById('bstno').value;
    var depo = document.getElementById('deposi').value;
    var coaNo = document.getElementById('coano').value;  
    var lopNumber = document.getElementById('lopnumber').value; 
    var tradeAccountNumber = document.getElementById('tradeaccountnumber').value;
    var contractCode = document.getElementById('contractcode').value;
    var wareHouseLoc = document.getElementById('warehouseloc').value;
    var batchNumber = document.getElementById('batchnumber').value;
    var quantity_ = document.getElementById('quantity').value;
    var brand = document.getElementById('brand').value;
    var pic = document.getElementById('pic').value;
    var commodity = document.getElementById('commodity').value;
    var DoAnalis = document.getElementById('DoAnalis').value;

    var myTable = $("#example").DataTable();
    var form_data = myTable.rows().data();

     var myTable2 = $("#example2").DataTable();
    var form_data2 = myTable2.rows().data();

    var myTables = $("#examples").DataTable();
    var form_datas = myTables.rows().data();


    var get_Bundle = '';
    var get_mineral = '';
    var get_Marking = '';

    for (var i = 0; i < form_data.length; i++) {
        get_Bundle += form_data[i]+'|';
    }

    for (var i = 0; i < form_data2.length; i++) {
        get_mineral += form_data2[i]+'|';
        // console.log(get_mineral);
    }

    for (var i = 0; i < form_datas.length; i++) {
        get_Marking += form_datas[i]+'|';
        // console.log(get_Marking);
    }

    $.ajax({
        url: "<?php base_url();?>c_tpa_01_COA/insert_data_coa",
        type : "POST",
        data : {
          bundle : get_Bundle,
          bundle_mineral : get_mineral,
          bundle_marking : get_Marking,
          bst_no : bstNo,
          depositor : depo,
          coa_bst_no : coaNo,
          lop_number : lopNumber,
          trade_AccountNumber : tradeAccountNumber,
          contract_Code : contractCode,
          warehouse_loc : wareHouseLoc,
          batch_Number : batchNumber,
          quantity : quantity_, 
          brand_ : brand,
          pic : pic,
          commodity : commodity,
          DoAnalis : DoAnalis
        },
        dataType : "JSON",
        error : function(xhr){
            // window.location.replace("https://tinmarket.id");
         console.log(xhr.data);
         $.unblockUI();
        },
        success : function(data){
          alert(data);
            $.unblockUI();
        },
    });
}

</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/datatables/js/dataTables.cellEdit.js'); ?>">
</script>