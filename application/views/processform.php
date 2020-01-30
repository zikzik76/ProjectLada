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

                	combobox_divisi('s');
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
						<th>ID Divisi</th>
						<th>Nama Divisi</th>
						<th>Proses Pada Divisi</th>
						<th>Created Date</th>
						<th style="width: 100px;">Action</th>
					</tr> 
				</thead>					
				<tbody>
					<?php 
					$no = 1;
					foreach($value as $rows) { ?>
					<tr>
						<td><?=$no++;?></td>
						<td><?=$rows['id_divisi'];?></td>
						<td><?=$rows['name_divisi'];?></td>
						<td><?=$rows['proses_divisi'];?></td>
						<td><?=$rows['create_date'];?></td>
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
				<h4 class="modal-title">Add New Proses</h4>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="col-lg-12">
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-3"><label>Nama Divisi</label></div>
								<div class="col-lg-3">
									<select name="" id="input_divisi" class="form-control" required="required" style="width: 500px;">
										<option> -- SELECT --</option>
									</select>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="col-lg-3"><label>Proses Pada Divisi</label></div>
								<div class="col-lg-3"><textarea id="proses_pada_divisi" style="width: 600px;max-width: 600px; height: 200px;"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="save_process()">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function combobox_divisi(){
		// alert('success');
		// return false;
		$.ajax({
         url : "<?php echo site_url('index.php/Add_process/new_proses');?>",
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
         	

         var select = document.getElementById('input_divisi');
		// var select_ = document.getElementById('risiko_cbb');
			
			for(var i = 0; i < data.get_divisi.length; i++){
				var val_opt = data.get_divisi[i].id_divisi;
				var opt = data.get_divisi[i].name_divisi;
				var el = document.createElement('option');
				el.textContent = opt;
				el.value = val_opt;
				select.appendChild(el);

			};

			$('#modal-id').modal('show');
        }
    })
      
	}

	function save_process(){
		var id = document.getElementById('input_divisi').value;
		var proses_pada_divisi = document.getElementById('proses_pada_divisi').value;

		// alert(proses_pada_divisi);
		// return false;

		$.ajax({
		 url : "<?php echo site_url('index.php/Add_process/input_data_proses');?>",
         type : "POST",
         data : {
         	id_divisi : id,
         	proses : proses_pada_divisi
		},
		dataType : "JSON",
		error : function(xhr){

		},
		success : function(data){
			alert('successs')
			window.location.reload();
		}
		});
	}

</script>