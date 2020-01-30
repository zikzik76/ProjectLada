<!DOCTYPE html>
<html lang="en">
<head>
	<title>LADA MEMBER</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery-1.12.4.js');?>">
    </script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/style.css'); ?>" > 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.min.css'); ?>">

	<link rel="icon" type="image/png" href="<?php echo base_url('application/asset/image/KBI.png')?>">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/asset/css/font-awesome.min.css') ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/asset/css/util.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/asset/css/main.css')?>">
	<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/dataTables.responsive.css"> -->

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
<!-- <script type="text/javascript" language="javascript" src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js">
	</script> -->

    <script type="text/javascript">	
      $(document).ready(function() {
            $('#example').dataTable({
            	'pagging': 2
            });
        });

      $(document).on("keydown", function (e) {
        if (e.which === 8 && !$(e.target).is("input, textarea")) {
          e.preventDefault();
        }
      });
    </script>

</head>
<body>
	<section>
		<div class="col-lg-4">
			<div class="row" >
				<div class="limiter">
					<div class="container-login100">
						<div class="wrap-login100 p-t-50 p-b-30">
							<form class="login100-form validate-form" method="POST" action="<?php echo base_url('index.php/reporting_login');?>">
								<div class="login100-form-avatar">
									<img src="<?php echo base_url('application/asset/image/logolada.png')?>" alt="AVATAR">
								</div>

								<span class="login100-form-title p-t-20 p-b-45 col-xs-4">
									LADA MARKET MEMBERSHIP
								</span>

								<div class="wrap-input100 validate-input m-b-10 col-xs-4" data-validate = "Username is required">
									<input class="input100" type="text" name="input_kbi_user" id="n_usrn" placeholder="Username">
									<span class="focus-input100 col-xs-4"></span>
									<span class="symbol-input100 col-xs-4">
										<i class="fa fa-user"></i>
									</span>
								</div>

								<div class="wrap-input100 validate-input m-b-10 col-xs-4" data-validate = "Password is required">
									<input class="input100" type="password" name="input_kbi_pswd" id="n_pswd" placeholder="Password">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-lock"></i>
									</span>
								</div>

								<div class="container-login100-form-btn p-t-10 col-xs-4">
									<button  id="submit" type="submit" class="login100-form-btn">
										Login
									</button>
								</div>
								<br>
								<div class="container-login100-form-btn p-t-10 col-xs-4">
									<a class="login100-form-btn" role="button" href="<?php echo base_url('index.php/c_tpa_01_register_form');?>">
										Create new account&nbsp; <i class="fa fa-long-arrow-right"></i>						
									</a>
								</div>
								<hr>
								<br>
								<div class="login100-form-contant-person  p-t-20 col-xs-4">
									<label style="color: black ;font-size: 14px; font-weight: 1">Contact Person :</label>
									<br>
									<label style="color: black ;font-size: 14px; font-weight: 1">PT Kliring Berjangka Indonesia (Persero) (<em>021 - 39833066 Ext. 424</em>)</label> 
									<br>
									<label style="color:black; font-size: 14px; font-weight: 1">Jakarta Futures Exchange (<em>021 - 31996030 Ext.801</em>)</label> 
								</div>
								<br>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8" >
			<div class="row">
				<div class="container p-t-50 col-xs-12">
					<div class="mx-auto">
						<header style="text-align: center"><b><h1>Table  Price</h1></b></header>
						<hr>	
					</div>
				</div>
				<div class="container p-t-50 col-xs-12">
					<table id="example" class="display striped table-responsive" >
			            <thead>
			                <tr>
			                    <th>Business Date</th>
			                    <th>Product</th>

			                    <th>Price</th>
			                </tr>
			            </thead>
			            <tbody>
			            	<?php foreach($trans as $val){ ?>
			            	<tr>
			            		<td><?php echo $val['BusinessDate'];?></td>
			            		<td><?php echo $val['productid'];?></td>
			            		<td><?php echo number_format($val['Price'],0); ?></td>
			            	</tr>
			            	<?php } ?>
			            </tbody>
			        </table>
				</div>
			</div>
			<footer class="form-control-range" style="position: fixed; width: 65%" class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- <strong class="text-center">Divisi Teknologi Informasi &copy; 2019 &nbsp; &nbsp; &nbsp;<a href="http://www.ptkbi.com" style="color: #4269f5"> PT Kliring Berjangka Indonesia (Persero)</a>. -->
                <strong class="text-center"><a href="http://www.ptkbi.com" class="btn btn-outline-primary">PT Kliring Berjangka Indonesia (Persero)</a> | <a href="#" class="btn btn-outline-info">Jakarta Futures Exchanges</a></strong>
            </div>
        </div>        
    </footer>
		</div>
	</section>
	

	

  <script>window.jQuery || document.write('<script src=" <?php echo base_url('/application/asset/js/jquery.min.js'); ?>"><\/script>')</script>
    <script src="<?php echo base_url('/application/asset/js/bootstrap.min.js'); ?>"></script>

    <script type="text/javascript">

    // $('#submit').click(function(){
    //   $.blockUI({ message: '<img src="/application/asset/image/loading2.gif" width="200" height="200"/><br/><h4>Saving data in progress, Please wait a moment...</h4>' });
    // }

      

    function ipLookUp (){
      $.ajax('http://ip-api.com/json').then(

          function success(response) {
              console.log('User\'s Location Data is ', response);
              // console.log('User\'s Location Data is ', response);
            var response_loc = response;
              // console.log('User\'s Country', response.country);
            var response_country = response.country;
      },

          function fail(data, status) {
              console.log('Request failed.  Returned status of',
                          status);
          }
      );
    }
   
    // // function getAddress (latitude, longitude) {
    // //   $.ajax('https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latitude + ',' + longitude + '&key=' + GOOGLE_MAP_KEY +'&callback=initialize').then(
    // //     function success (response) {
    // //       console.log('User\'s Address Data is ', response)
    // //     },
    // //     function fail (status) {
    // //       console.log('Request failed.  Returned status of', status)
    // //     }
    // //    )

    // // }

    if ("geolocation" in navigator) {
      // check if geolocation is supported/enabled on current browser
      navigator.geolocation.getCurrentPosition(
       function success(position) {
         console.log('latitude', position.coords.latitude,'longitude', position.coords.longitude);
         

       },

      function error(error_message) {
          console.error('An error has occured while retrieving location', error_message)
          ipLookUp();
       }

      );

    } else {
      // geolocation is not supported
      // get your location some other way
      console.log('geolocation is not enabled on this browser')
      ipLookUp();

    }; 

    </script>

</body>
</html>