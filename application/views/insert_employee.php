    <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('/application/asset/style5.css'); ?>"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.min.css'); ?>">

	<!-- Data Tables -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.min.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.searchPane.min.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/jquery.dataTables.min.css'); ?>">

   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.min.css'); ?>">


	</style>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery-1.12.4.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/bootstrap.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/bootstrap.min.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.min.js');?>">
    </script>    
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/datatables/js/jquery.dataTables.js'); ?>">
	</script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/datatables/js/jquery.dataTables.min.js'); ?>">
	</script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/datatables/js/dataTables.buttons.min.js'); ?>">
	</script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.js'); ?>">
	</script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/dataTables.min.js'); ?>">
	</script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/b4/js/bootstrap.js');?>">
    </script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/b4/js/bootstrap.min.js');?>">
    </script>  
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/b4/js/dataTables.searchPane.min.js');?>">
    </script>


<div class="container">
	<div class="content">
  		<div class="page-header">
		  	<h1 class="center">New Employee Form</h1>
		</div>
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="pills-detail-profile-tab" data-toggle="pill" href="#pills-detail-profile" role="tab" aria-controls="pills-detail-profile" aria-selected="true">Detail Profile</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-pendidikan-tab" data-toggle="pill" href="#pills-pendidikan" role="tab" aria-controls="pills-pendidikan" aria-selected="false">Pendidikan</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-kursus-tab" data-toggle="pill" href="#pills-kursus" role="tab" aria-controls="pills-kursus" aria-selected="false">Kursus/Latihan di dalam atau di luar negeri</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-experience-tab" data-toggle="pill" href="#pills-experience" role="tab" aria-controls="pills-experience" aria-selected="false">Riwayat Pekerjaan</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-family-tab" data-toggle="pill" href="#pills-family" role="tab" aria-controls="pills-family" aria-selected="false">Riwayat Keluarga</a>
		  </li>
		  <li class="nav-item">
		    <a class="btn btn-primary" href="<?php echo base_url('index.php/main_form'); ?>" ><i class="fa fa-arrow-left"></i> &nbsp; Back to Employee Form</a>
		  </li>
		</ul>
		<br>
		<div class="tab-content" id="pills-tabContent">
		  	<div class="tab-pane fade show active" id="pills-detail-profile" role="tabpanel" aria-labelledby="pills-detail-profile-tab">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-3">
								<img src="<?php echo base_url('application/asset/image/user-1.png'); ?>" style="width: 195px; height: 219px;">
								<br>
								<input type="file" name="">
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-3">
										<label>NIK</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label >Status</label>
									</div>
									<div class="col-lg-3">
										<select name="" id="input" class="form-control" required="required">
											<option value="">Aktif</option>
											<option value="">Non Aktif</option>
										</select>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label >Tanggal Aktif per tanggal</label>
									</div>
									<div class="col-lg-3">
										<input type="date" name="">
									</div>
								</div>
								<br>
								<div id="deactive" class="row">
									<div class="col-lg-3">
										<label >Tanggal non Aktif per Tanggal</label>
									</div>
									<div class="col-lg-3">
										<input type="date" name="">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<HEADER><h3>Detail Profil</h3></HEADER>
						<hr>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-6">	
								<div class="row">
									<div class="col-lg-3">
										<label>Nama Lengkap</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>Nama Panggilan</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>No KTP</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>No NPWP</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>No BPJS Ketenagakerjaan</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>No BPJS Kesehatan</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>Tempat Tanggal Lahir</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
										<input type="date" name="">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-3">
										<label>Jenis Kelamin</label>
									</div>
									<div class="col-lg-3">
										<select name="" id="input" class="form-control" required="required">
											<option value="">Pria</option>
											<option value="">Wanita</option>
										</select>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>Agama</label>
									</div>
									<div class="col-lg-3">
										<select name="" id="input" class="form-control" required="required">
											<option value="">Islam</option>
											<option value="">Keristen Protestan</option>
											<option value="">Katolik</option>
											<option value="">Budha</option>
											<option value="">Hindu</option>
											<option value="">Konghucu</option>
										</select>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>Status Perkawinan</label>
									</div>
									<div class="col-lg-3">
										<select name="" id="input" class="form-control" required="required">
											<option value="">Belum Kawin</option>
											<option value="">Kawin</option>
											<option value="">Janda</option>
											<option value="">Duda</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="row">
									<span><h3><b>Alamat Rumah</b></h3></span>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-3">
										<label>Jalan</label>
									</div>
									<div class="col-lg-3">
										<textarea style="width: 735px;height: 142px;"></textarea>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>Kelurahan / Desa</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>Kecamatan</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>Kabupaten / Kota</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<label>Provinsi</label>
									</div>
									<div class="col-lg-3">
										<input type="text" name="">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="row">
									<div><h3><b>Keterangan Badan</b></h3></div>
								</div>
								<hr>
								<div class="col-lg-6">
									<div class="row">
										<div class="col-lg-3">
											<label>Tinggi (cm)</label>
										</div>
										<div class="col-lg-3">
											<input type="text" name="">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<label>Berat Badan (kg)</label>
										</div>
										<div class="col-lg-3">
											<input type="text" name="">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<label>Rambut</label>
										</div>
										<div class="col-lg-3">
											<input type="text" name="">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<label>Bentuk Muka</label>
										</div>
										<div class="col-lg-3">
											<input type="text" name="">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="row">
										<div class="col-lg-3">
											<label>Warna Kulit</label>
										</div>
										<div class="col-lg-3">
											<input type="text" name="">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<label>Ciri - Ciri Khas</label>
										</div>
										<div class="col-lg-3">
											<input type="text" name="">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<label>Cacat Tubuh</label>
										</div>
										<div class="col-lg-3">
											<input type="text" name="">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<label>kegemaran (Hoby)</label>
										</div>
										<div class="col-lg-3">
											<input type="text" name="">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
				<br>
		  	</div>
		  	<div class="tab-pane fade" id="pills-pendidikan" role="tabpanel" aria-labelledby="pills-pendidikan-tab">
		  		<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div><h2><b>Pendidikan</b></h2></div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-3">
								<header><h3><b>Strata - 2</b></h3></header>
							</div>	
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Nama Pendidikan</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Jurusan</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>STTB Tanda Lulus/Ijazah Tahun</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Tempat</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Nama Kepala Sekolah/ Direktur/ Dekan/ Promotor</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<header><h3><b>Strata - 1</b></h3></header>
							</div>	
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Nama Pendidikan</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Jurusan</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>STTB Tanda Lulus/Ijazah Tahun</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Tempat</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Nama Kepala Sekolah/ Direktur/ Dekan/ Promotor</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-lg-6">
								<header><h3><b>Sekolah Menengah Atas (SMA)</b></h3></header>
							</div>
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Nama Pendidikan</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>STTB Tanda Lulus/Ijazah Tahun</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Tempat</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Nama Kepala Sekolah/ Direktur/ Dekan/ Promotor</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-lg-6">
								<header><h3><b>Sekolah Menengah Pertama (SMP)</b></h3></header>
							</div>
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Nama Pendidikan</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>STTB Tanda Lulus/Ijazah Tahun</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Tempat</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<span>Nama Kepala Sekolah/ Direktur/ Dekan/ Promotor</span>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
					</div>
				</div>
				<br>
		  	</div>
		  	<div class="tab-pane fade" id="pills-kursus" role="tabpanel" aria-labelledby="pills-kursus-tab">
		  		<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<button type="button" class="btn btn-primary" onclick="fnClickAddRowKursus();">Add New Kursus / Pelatihan</button>
							<button type="button" class="btn btn-success" onclick="">Save Experiences</button>
						</div>
						<br>
						<hr>
						<div class="row">
							 <table id="example1" class="display" style="width:100%">
					            <thead>
					                <tr>
					                    <th>No</th>
					                    <th> Nama Kursus / Pelatihan</th>
					                    <th> Lamanya Kursus / Pelatihan </th>
					                    <th> Ijazah/ Tanda Lulus / Surat / Keterangan tahun</th>
					                    <th> Tempat Instansi Penyedia</th>
					                    <th> Keterangan</th>
					                    <th> Action</th>
					                </tr>
					            </thead>
					        </table>
						</div>
					</div>
					<script type="text/javascript">
						var giCount1 = 1;
 
						$(document).ready(function() {
						    $('#example1').dataTable({
						    	"bProcessing": true,
						    });
						} );
						 
						function fnClickAddRowKursus() {
						    $('#example1').dataTable().fnAddData( [
						        giCount1,
						       	'<input type="text" name="">',
						        '<input type="text" name="">',
						        '<input type="text" name="">',
						        '<input type="text" name="">',
						       	'<input type="text" name="">',
						       	'<div class="btn-group" role="group" aria-label="Basic example">'+
								  '<button type="button" class="btn btn-Primary"><i class="fa fa-pencil"></i></button>'+
								  '<button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>'+
								'</div>' ] 
						        );
						     giCount1++;
						}
					</script>
				</div>
			</div>
		  	<div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab">
		  		<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<button type="button" class="btn btn-primary" onclick="fnClickAddRow();">Add New Experiences</button>
							<button type="button" class="btn btn-success" onclick="">Save Experiences</button>
						</div>
						<br>
						<hr>
						<div class="row">
							 <table id="example" class="display" style="width:100%">
					            <thead>
					                <tr>
					                    <th>No</th>
					                    <th>Jabatan / Pekerjaan</th>
					                    <th>Lama Pekerjaan</th>
					                    <th>Golongan</th>
					                    <th>Gaji Pokok</th>
					                    <th>Surat Keputusan (SK)</th>
					                    <th>Action</th>
					                </tr>
					            </thead>
					        </table>
						</div>
					</div>
					<script type="text/javascript">
						var giCount = 1;
 
						$(document).ready(function() {
						    $('#example').dataTable({
						    	"bProcessing": true,
						    });
						} );
						 
						function fnClickAddRow() {
						    $('#example').dataTable().fnAddData( [
						        giCount,
						       	'<input type="text" name="">',
						        '<input type="text" name="">',
						        '<input type="text" name="">',
						        '<input type="text" name="">',
						       	'<input type="text" name="">',
						       	'<div class="btn-group" role="group" aria-label="Basic example">'+
								  '<button type="button" class="btn btn-Primary"><i class="fa fa-pencil"></i></button>'+
								  '<button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>'+
								'</div>' ] 
						        );
						     giCount++;
						}
					</script>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="pills-family" role="tabpanel" aria-labelledby="pills-family-tab">
		  		<div class="row">
		  			<div class="col-lg-12">
		  				<div class="row">
							<button type="button" class="btn btn-success" onclick="">Save Keterangan Keluarga</button>
						</div>
						<br>
						<br>
						<div class="row">
							<header><h3>Form Keterangan Suami/Istri</h3></header>
						</div>
						<hr>
		  				<div class="row">
		  					<div class="col-lg-3">
		  						<label>Nama Suami / Istri</label>
		  					</div>
		  					<div class="col-lg-3">
		  						<input type="text" name="" />
		  					</div>
		  				</div>
		  				<br>
		  				<div class="row">
		  					<div class="col-lg-3">
		  						<label>Tempat / Tanggal Lahir</label>
		  					</div>
		  					<div class="col-lg-3">
		  						<input type="text" name="" />
		  						<input type="date" name="" />
		  					</div>
		  				</div>
		  				<br>
		  				<div class="row">
		  					<div class="col-lg-3">
		  						<label>Tanggal Nikah</label>
		  					</div>
		  					<div class="col-lg-3">
		  						<input type="date" name="" />
		  					</div>
		  				</div>
		  				<br>
		  				<div class="row">
		  					<div class="col-lg-3">
		  						<label>Pekerjaan</label>
		  					</div>
		  					<div class="col-lg-3">
		  						<input type="date" name="" />
		  					</div>
		  				</div>
		  				<br>
		  				<div class="row">
		  					<div class="col-lg-3">
		  						<label>Keterangan</label>
		  					</div>
		  					<div class="col-lg-3">
		  						<input type="date" name="" />
		  					</div>
		  				</div>
		  				<br>
		  				<br>
		  				<hr>
		  				<div class="row">
							<header><h3>Form Keterangan Anak</h3></header>
						</div>
						<hr>
		  				<div class="row">
		  					<button type="button" class="btn btn-primary" onclick="fnClickAddRowFamily();">Tambah Anak</button>
		  				</div>
		  				<br>
		  				<div class="row">
							 <table id="example2" class="display" style="width:100%">
					            <thead>
					                <tr>
					                    <th>No</th>
					                    <th>Nama</th>
					                    <th style="width: 20px;">Jenis Kelamin</th>
					                    <th>tanggal lahir</th>
					                    <th>Anak Ke</th>
					                    <th>dari</th>
					                    <th>Pekerjaan</th>
					                    <th>Keterangan</th>
					                    <th>Action</th>
					                </tr>
					            </thead>
					        </table>
						</div>
						<br>
						<br>
						<div class="row">
							<header><h3>Form Keterangan Ayah dan Ibu Kandung</h3></header>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-3">
								<label>Nama Ayah</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Tanggal Lahir / Umur</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Pekerjaan</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Keterangan</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-3">
								<label>Nama Ibu</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Tanggal Lahir / Umur</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Pekerjaan</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Keterangan</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<br>
						<div class="row">
							<header><h3>Form Keterangan Ayah dan Ibu Mertua</h3></header>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-3">
								<label>Nama Ayah</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Tanggal Lahir / Umur</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Pekerjaan</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Keterangan</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-3">
								<label>Nama Ibu</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Tanggal Lahir / Umur</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Pekerjaan</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<label>Keterangan</label>
							</div>
							<div class="col-lg-3">
								<input type="text" name="">
							</div>
						</div>
						<div class="row">
							<header><h3>Form Keterangan Suadara</h3></header>
						</div>
						<hr>
		  				<div class="row">
		  					<button type="button" class="btn btn-primary" onclick="fnClickAddRowSiblings();">Tambah Saudara</button>
		  				</div>
		  				<br>
		  				<div class="row">
							 <table id="example3" class="display" style="width:100%">
					            <thead>
					                <tr>
					                    <th>No</th>
					                    <th>Nama</th>
					                    <th style="width: 20px;">Jenis Kelamin</th>
					                    <th>tanggal lahir</th>
					                    <th>Pekerjaan</th>
					                    <th>Keterangan</th>
					                    <th>Action</th>
					                </tr>
					            </thead>
					        </table>
						</div>
		  			</div>
		  			<script type="text/javascript">
		  				var giCount2 = 1;
						var giCount3 = 1;
 
						$(document).ready(function() {
						    $('#example3').dataTable({
						    	"bProcessing": true,
						    });
						} );
						$(document).ready(function() {
						    $('#example2').dataTable({
						    	"bProcessing": true,
						    });
						} );
						
						function fnClickAddRowSiblings() {
						    $('#example3').dataTable().fnAddData( [
						        giCount3,
						       	'<input type="text" name="">',
						        '<input type="text" name="">',
						        '<input type="text" name="">',
						        '<input type="text" name="">',
						       	'<input type="text" name="">',
						       	'<div class="btn-group" role="group" aria-label="Basic example">'+
								  '<button type="button" class="btn btn-Primary"><i class="fa fa-pencil"></i></button>'+
								  '<button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>'+
								'</div>' ] 
						        );
						     giCount3++;
						}

						function fnClickAddRowFamily() {
						    $('#example2').dataTable().fnAddData( [
						        giCount2,
						       	'<input type="text" name="">',
						        '<input type="text" name="">',
						        '<input type="text" name="">',
						        '<input type="text" name="">',
						       	'<input type="text" name="">',
						       	'<input type="text" name="">',
						       	'<input type="text" name="">',
						       	'<div class="btn-group" role="group" aria-label="Basic example">'+
								  '<button type="button" class="btn btn-Primary"><i class="fa fa-pencil"></i></button>'+
								  '<button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>'+
								'</div>' ] 
						        );
						     giCount2++;
						}
					</script>
		  		</div>
		  	</div>
		</div>
	</div>
</div>
<br>
<br>
