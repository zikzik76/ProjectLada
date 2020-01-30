<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap-chosen.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>

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
                    <h3>Reporting</h3>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
    <?php echo form_open_multipart('index.php/c_tpa_01_report_status_bgr/download_report'); ?>
        <div class="row">
        	<h3>Transactional Reporting</h3>
            <hr>
            <br>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <label>Date Of Reporting</label>
            </div>
            <div class="col-sm-3">
                <input type="date" name="st_date">
            </div>
        </div>
        <!-- <br>
         <div class="row">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Status:</label>
                <div class="col-sm-4">
                    <select name="typeOfStat" id="typeOfStat" onchange="change_opt_stat()" class="form-control"  required="required" style="width: 200px">
                        <option value="">-</option>
                        <option value="BU">BADAN USAHA</option>
                        <option value="Per">PERORANGAN</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div class="row" id="member">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Member:</label>
                <div class="col-sm-4">
                    <select name="typeOfmember" id="typeOfmember" class="form-control" required="required" style="width: 200px" tabindex="2">
                        <option value=""> - </option>
                    </select>
                </div>
            </div>
        </div> -->
        <br>
        <div class="row">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Reporting Option:</label>
                <div class="col-sm-4">
                    <select name="typeOfReport" id="typeOfReport" class="form-control"  required="required" style="width: 200px">
                        <option value="">-</option>
                        <option value="SI">Shipping Instruction</option>
                        <option value="NOS">Notice Of Instruction</option>
                        <option value="TR">Trade Allocation</option>
                        <option value="KE">BPTB</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <button type="submit" name="btn_DFS" id="btn_DFS" class="btn btn-primary"> Download file</button>
                </div>
            </div>
        </div>
    </form>
    </div>
<br>

<script>
function change_opt_stat(){
    var name_stat = document.getElementById('typeOfStat').value;

    $.ajax({
        url : '<?php echo base_url("index.php/c_tpa_01_report_status_bgr/get_ak"); ?>',
        dataType : 'JSON',
        data : {
            stat_val : name_stat
        },
        type : 'POST',
        error : function(xhr){
        alert('error chuy', xhr);
        },
        success : function(data, jqXHR){
            // alert(data);
             // var data_ak = {data : "name_ak"};
             console.log(data[0]['empty_val']);

            var select = document.getElementById("typeOfmember");
              while (typeOfmember.options.length) {
                typeOfmember.remove(0);
              }
             for(var i = 0;i < data.length;  i++){
                var member_name = document.getElementById('typeOfStat').value;
                if(data[0]['empty_val'] == ""){
                     select.innerHTML +=  '<option value="#"> - </option>';
                } else {

                    select.innerHTML +=  '<option value="'+data[i]['name_code']+'">'+data[i]['name_ak']+'</option>';
                }
               
             }
        }
    });
}


</script>
 <script>
    $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
    });
</script>



