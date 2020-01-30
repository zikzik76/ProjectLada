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
                    <h3>Stock Price Form</h3>
                </div>
            </div>
        </div>
    </nav>
	<div class="conteiner">
		<div class="well well-lg">
			<div class="row">
				<div>
					<?php echo form_open_multipart('index.php/c_ppa_01_stock_price/update_stock_price'); ?>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Business Date </label>
					    <div class="col-sm-12">
					      <input type="Date" class="form-control" id="date_stp" name="date_stp" >
					    </div>
					  </div>
					  <div class="form-group row">
					  		<label class="col-sm-12 col-form-label"> Clearing Member</label>
					  		<div class="col-sm-12">
					            <select data-placeholder="Pilih Clearing Member" name="cm_chb_stp" class="chosen-select-deselect form-control " tabindex="7">
					            <option value=""></option>
					            <?php foreach ($value AS $row){ ?>
					            <option value="<?php echo $row['id'];?>"><?php echo $row['clearingmembername'];?></option>
					            <?php } ?>
					          </select>
					  		</div>
					  	</div>
					 <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Gold Type</label>
					    <div class="col-sm-12">
					      <select  id="gt_bbox" name="gt_bbox" class="form-control" required="required">
					      	<option value="#">-</option>
					      	<option value="ANTAM">ANTAM</option>
					      	<option value="UBS">UBS</option>
					      </select>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Volume</label>
					    <div class="col-sm-12">
					      <input type="number" class="form-control" id="vol_val" name="vol_val" >
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Price</label>
					    <div class="col-sm-12">
					      <input type="number" class="form-control" id="price_val_tsp" name="price_val_tsp" >
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
                    <th>Clearing Member Code</th>
                    <th>Gold Type</th>
                    <th>Volume</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1 ;?>
            	<?php foreach ($value_table as $row){ ?>
	            	<tr>
	            		<td></td>
	            		<td><?php echo $no;?></td>
	            		<td><?php echo $row['businessdate'];?> </td>
	            		<td><?php echo $row['code'];?> </td>
	            		<td><?php echo $row['goldtype'];?> </td>
	            		<td><?php echo $row['volume'];?> </td>
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