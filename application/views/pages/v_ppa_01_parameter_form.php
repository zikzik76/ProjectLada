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
                    <h3>Parameter Form</h3>
                </div>
            </div>
        </div>
    </nav>
	<div class="conteiner">
		<div class="well well-lg">
			<div class="row">
				<div>
					<?php echo form_open_multipart('index.php/c_ppa_01_parameter/update_paramenter'); ?>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Paramenter Name </label>
					    <div class="col-sm-12">
					      <input type="text" class="form-control" id="pm_name_tb"  name="pm_name_tb">
					    </div>
					  </div>
					 <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Paramenter value 1</label>
					    <div class="col-sm-12">
					      <input type="text" class="form-control" id="pmval_1_tb" name"pmval_1_tb">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Paramenter value 2</label>
					    <div class="col-sm-12">
					      <input type="text" class="form-control" id="pmval_2_tb" name="pmval_2_tb" >
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
	<br>
	<div>
		 <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>NO</th>
                    <th>name</th>
                    <th>Gold Type</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1;?>
            	<?php foreach ($value as $row){ ?>
	            	<tr>
	            		<td></td>
	            		<td><?php echo $no;?></td>
	            		<td><?php echo $row['name'];?> </td>
	            		<td><?php echo $row['value1'];?> </td>
	            		<td><?php echo $row['value2'];?> </td>
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