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
                    <h3>Sattlement Price Form</h3>
                </div>
            </div>
        </div>
    </nav>
	<div class="conteiner">
		<div class="well well-lg">
			<div class="row">
				<div>
					<?php echo form_open_multipart('index.php/c_ppa_01_settlement/update_settlement'); ?>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Business Date </label>
					    <div class="col-sm-12">
					      <input type="Date" class="form-control" id="date_sp" name="date_sp" >
					    </div>
					  </div>
					 <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Gold Type</label>
					    <div class="col-sm-12">
					      <select  id="cm_bbox" name="cm_bbox" class="form-control" required="required">
					      	<option value="#">-</option>
					      	<option value="ANTAM">ANTAM</option>
					      	<option value="UBS">UBS</option>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Price</label>
					    <div class="col-sm-12">
					      <input type="number" class="form-control" id="price_val" name="price_val" >
					    </div>
					  </div>
					  <div class="form-group row">
					    <div class="col-sm-12">
					      <button type="submit" class="btn btn-primary">Save</button>
					      <button type="cancel" class="btn btn-warning">Cancel</button>
					    </div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<div>
		 <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>No</th>
                    <th>Business Date</th>
                    <th>Gold Type</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1 ;?>
            	<?php foreach ($value as $row){ ?>
	            	<tr>
	            		<td></td>
	            		<td><?php echo $no;?></td>
	            		<td><?php echo $row['businessdate'];?> </td>
	            		<td><?php echo $row['goldtype'];?> </td>
	            		<td><?php echo $row['price'];?> </td>
	            		<?php $no++ ?>
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
	<br>
	<br>

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