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
                    <h3>Clearing Member Form</h3>
                </div>
            </div>
        </div>
    </nav>
	<div class="container">
		<div class="well well-lg">
			<div class="row">
				<div>
					<?php echo form_open_multipart('index.php/c_ppa_01_clearing_member/update_clearing'); ?>
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label">Clearing Member Code</label>
					    <div class="col-sm-12">
					      <input type="text" class="form-control" id="cm_code" name="cm_code">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword3" class="col-sm-12 col-form-label">Clearing Member Name</label>
					    <div class="col-sm-12">
					      <input type="text" class="form-control" id="cm_name" name="cm_name">
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
<br>
<div>
		 <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>NO</th>
                    <th>Clearing Member Code</th>
                    <th>Clearing Member Name</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1;?>
            	<?php foreach ($value as $row2){ ?>
	            	<tr>
	            		<td></td>
	            		<td><?php echo $no;?></td>
	            		<td><?php echo $row2['clearingmembercode'];?> </td>
	            		<td><?php echo $row2['clearingmembername'];?> </td>
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