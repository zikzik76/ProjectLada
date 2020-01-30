<section id="content">
	<nav class="navbar navbar-default" >
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h3>Tradefeed From</h3>
                </div>
            </div>
        </div>
    </nav>
	<div class="conteiner">
		<div class="well well-lg">
			<div class="row">
				<div>
					<?php echo form_open_multipart('index.php/c_ppa_01_tradefeed/upload_data'); ?>
					  <!-- <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> Business Date </label>
					    <div class="col-sm-12">
					      <input type="Date" class="form-control" id="date_tf" name="date_tf">
					    </div>
					  </div> -->
					  <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-12 col-form-label"> File upload Tradefeed</label>

					   <div class="input-group">
						  <div class="custom-file col-sm-12">
						    <input type="file" class="custom-file-input" name="userfile" id="userfile">
						  </div>
						</div>
					</div>
					  <div class="form-group row">
					    <div class="col-sm-12">
					      <button type="submit" class="btn btn-primary">Save</button>
					      <button type="button" class="btn btn-warning" onclick="clearall()">Cancel</button>
					    </div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	

<!-- </section> -->
<br>
<script type="text/javascript"> 
	
// $(document).ready(function() {
//     $('#example').DataTable( {
//         "paging":   true,
//         "ordering": true,
//         "info":     true
//     } );
// } );        
</script>