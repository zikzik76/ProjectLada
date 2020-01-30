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
                    <h3>Investor Form</h3>
                </div>
            </div>
        </div>
    </nav>
	<div class="conteiner">
		<div class="well well-lg">
			<div class="row">
				<div>
					<?php echo form_open_multipart('index.php/c_ppa_01_investor/update_investor'); ?>
					  	<div class="form-group row">
					  		<label class="col-sm-12 col-form-label"> Clearing Member</label>
					  		<div class="col-sm-12">
					            <select data-placeholder="Pilih Clearing Member" name="cm_chb" class="chosen-select-deselect form-control " tabindex="7">
					            <option value=""></option>
					            <?php foreach ($value AS $row){ ?>
					            <option value="<?php echo $row['id'];?>"><?php echo $row['clearingmembername'];?></option>
					            <?php } ?>
					          </select>
					  		</div>
					  	</div>
					  <div class="form-group row">
					    <label  class="col-sm-12 col-form-label">Inverstor</label>
					    <div class="col-sm-12">
					      <input type="text" class="form-control" id="inv_code_tb" name="inv_code_tb">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label class="col-sm-12 col-form-label">Investor Name</label>
					    <div class="col-sm-12">
					      <input type="text" class="form-control" id="inv_name_tb" name="inv_name_tb">
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
<!-- </section> -->
<br>
<div>
		 <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>NO</th>
                    <th>Clearing Member Code</th>
                    <th>investor Code</th>
                    <th>Investor Name</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1;?>
            	<?php foreach ($value_table as $row2){ ?>
	            	<tr>
	            		<td></td>
	            		<td><?php echo $no;?></td>
	            		<td><?php echo $row2['code'];?> </td>
	            		<td><?php echo $row2['inv_code'];?> </td>
	            		<td><?php echo $row2['inv_name'];?> </td>
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
