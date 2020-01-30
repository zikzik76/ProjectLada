<section id="content">
	<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h3>Depository Form</h3>
                </div>
            </div>
        </div>
    </nav>
	<div class="conteiner">
		<div class="well well-lg">
			<div class="row">
				<div>
					<?php echo form_open_multipart('index.php/c_ppa_01_depositories/update_depo'); ?>
					<div class="form-group row">
					    <label for="inputPassword3" class="col-sm-12 col-form-label">Depository Code</label>
					    <div class="col-sm-12">
					      <input type="test" class="form-control" id="depo_code" name="depo_code">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label">Clearing Member</label>
					    <div class="col-sm-12">
					      <select name="cm_bbox" id="cm_bbox" class="form-control" required="required">
					      	<option value="#">-</option>
					      	<?php foreach ($value as $row) { ?>
					      		<option value="<?php echo $row['clearingmembercode'];?>"><?php echo $row['clearingmembername'];?></option>
					      	<?php } ?>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword3" class="col-sm-12 col-form-label">Businens Date</label>
					    <div class="col-sm-12">
					      <input type="date" class="form-control" id="d_picker" name="d_picker">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword3" class="col-sm-12 col-form-label">Gold Type</label>
					    <div class="col-sm-12">
					      <select name="gt_bbox" id="gt_bbox" class="form-control" required="required">
					      	<option value="#">-</option>
					      	<option value="ANTAM">ANTAM </option>
					      	<option value="ANTAM">UBS</option>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword3" class="col-sm-12 col-form-label">Saldo</label>
					    <div class="col-sm-12">
					      <input type="test" class="form-control" id="saldo_tb" name="saldo_tb">
					    </div>
					  </div>
					  <div class="form-group row">
					    <div class="col-sm-12">
					      <button type="submit" class="btn btn-primary">Save</button>
					      <button type="submit" class="btn btn-warning">Cancel</button>
					    </div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- </section> -->
<br>
<div>
		 <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>NO</th>
                    <th>Depository Code</th>
                    <th>Clearing Member code</th>
                    <th>Business Date</th>
                    <th>Gold Type</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1;?>
            	<?php foreach ($value_table as $row2){ ?>
	            	<tr>
	            		<td></td>
	            		<td><?php echo $no;?></td>
	            		<td><?php echo $row2['depo_id'];?> </td>
	            		<td><?php echo $row2['cm_code'];?> </td>
	            		<td><?php echo $row2['businessdate'];?> </td>
	            		<td><?php echo $row2['gd'];?> </td>
	            		<td><?php echo $row2['saldo'];?> </td>
	            		<?php $no++; ?>
	            	</tr>

            	<?php } ?>
            </tbody>
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
<!-- </section> -->
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "paging":   true,
        "ordering": true,
        "info":     true
    } );
} );  
</script>