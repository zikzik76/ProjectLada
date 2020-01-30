<style type="text/css">
	#center_text{
		text-align: center;

	}
</style>
<script type="text/javascript">	
// PAGING DATATABLE START
$(document).ready(function() {
	var table = $('#example').DataTable( {
		"scrollY": true,
		"scrollX": false,
		"paging": true,
		"orderCellsTop": true,
		 dom: 'Brftip',
        buttons: [
            {
                text: 'Add New',
                action: function ( e, dt, node, config ) {
                	combobox_risiko('s')
                   // $('#modal-id').modal('show');
                }
            }
        ]
	} );
} );
</script>
<div class="container">
	<div id="page-content-wrapper">
		<div class="row">
			<div class="col-sm-12">
			<table id="example" class="display" cellspacing="" >
				<thead>
					<tr>
						<th>NO</th>
						<th>ID Risiko</th>
						<th>Risiko</th>
						<th>Type Resiko</th>
						<th>Category Risiko</th>
						<th style="width: 100px;">Action</th>
					</tr> 
				</thead>					
				<tbody>
					<?php 
					$no = 1;
					foreach($value as $rows) { ?>
					<tr>
						<td><?=$no++;?></td>
						<td><?=$rows['id_risiko'];?></td>
						<td><?=$rows['risiko'];?></td>
						<td><?=$rows['risiko_type'];?></td>
						<td><?=$rows['category_name'];?></td>
						<td>
							<div class="btn-group" style="width: 100px;">
								<button type="button" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></button>
								<button type="button" class="btn btn-primary"><i class="fa fa-trash-o"></i></button>
							</div>
						</td>
					</tr>
					<?php } ;?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->
<div class="modal fade" id="modal-id">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add New Risiko</h4>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="col-lg-12">
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-3"><label>Risiko</label></div>
								<div class="col-lg-3">
									<textarea style="max-width: 600px; width: 600px;" id="risiko_"></textarea>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="col-lg-3"><label>Type Risiko</label></div>
								<div class="col-lg-3">
									<select id="type_risiko">
										<option value="1"> --- SELECT --- </option>
										<option value="2">Internal</option>
										<option value="3">External</option>
									</select>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="col-lg-3"><label>Category Resiko</label></div>
								<div class="col-lg-3">
									<select id="category_risiko_">
										<option value="1"> --- SELECT --- </option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="save_risiko()">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function combobox_risiko(a){
		$.ajax({
         url : "<?php echo site_url('index.php/master_risiko/new_risiko');?>",
         type : "POST",
         data : {
         	send_data : 'send'
         },
         dataType : "JSON",
         error : function(xhr){
         	// alert(data)
         },
         success : function(data){
         	// alert(data);
         	

        	 var select = document.getElementById('category_risiko_');
		// var select_ = document.getElementById('risiko_cbb');
			
			for(var i = 0; i < data.category_risiko.length; i++){
				var val_opt = data.category_risiko[i].id_category_risiko;
				var opt = data.category_risiko[i].category_name;
				var el = document.createElement('option');
				el.textContent = opt;
				el.value = val_opt;
				select.appendChild(el);

			};

			$('#modal-id').modal('show');
        }
    })
	}

	function save_risiko(){
		var risiko = document.getElementById('risiko_').value;
		var type_risiko = document.getElementById('type_risiko').value;
		var category_risiko_ = document.getElementById('category_risiko_').value;

		$.ajax({
			url : "<?php echo site_url('index.php/master_risiko/input_data_risiko');?>",
			type : "POST",
			data : {

				risiko__ : risiko,
				type_risiko_ : type_risiko,
				category_risiko : category_risiko_
			},
			dataType : "JSON",
			error : function(xhr){
				//
			},
			success : function(data){
				alert(data);
				window.location.reload();
			}
		})

	}
</script>