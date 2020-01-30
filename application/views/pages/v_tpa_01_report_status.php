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
                    <h3>Reporting</h3>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
    <?php echo form_open_multipart('index.php/c_tpa_01_report_status/download_report'); ?>
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
                <!-- <input type="date" name="st_date" id="st_date" required > -->
                <input type="date" name="st_date" id="st_date" required >
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Reporting Option:</label>
                <div class="col-sm-4">
                    <select name="typeOfReport" id="typeOfReport" class="form-control"  required="required" style="width: 200px">
                        <option value="">-</option>
                        <option value="DFS">Daily Financial Statement</option>
                        <option value="TR">Trade Allocation</option>
                        <option value="TC">Trade Confirmation</option>
                        <option value="NP">Invoice Transaction</option>
                        <option value="KE">BPTB</option>
                        <option value="CM">Report Collateral</option>
                        <option value="SF">List Security Fund</option>
                        <option value="NOS">Notice Of Shipment</option>
                        <option value="IMM">Invoice Membership</option>
                        <option value="IFK">Invoice Fee</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <button type="submit" name="btn_DFS" id="btn_DFS" class="btn btn-primary"> Download file</button>
                </div>
            </div>
        </div>
        <br>
        <div class="row" style="display:none;">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">NOS Number:</label>
                <div class="col-sm-4">
                    <select name="siNumber" id="siNumber" class="form-control" style="width: 200px">
                        <?php foreach($rcd_nosi as $val){ ?>
                            <option value="<?php echo $val['NoSI']; ?>"><?php echo $val['NoSI']; ?></option>
                        <?php } ?>
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
<div id="dommessage" style="display: none"> 
    <img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
    <br/>
    <h4>Saving data in progress, Please wait a moment...</h4>
  </div>
<script>
    $('#st_date').datepicker({
      format: 'dd-mm-yyyy'
    });

$('#btn_DFS').click(function(){

  $.blockUI({ message: $('#dommessage')});
});
</script>



