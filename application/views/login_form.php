

<!DOCTYPE html>
<html lang="en">
  <head>
  <title>TIN MEMBERSHIP</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/style.css'); ?>" > 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.min.css'); ?>">

    <script src="<?php echo base_url('/application/asset/js/prefixfree.min.js'); ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery-1.12.4.js');?>"></script>
    <script type="text/javascript">	
      $(document).on("keydown", function (e) {
        if (e.which === 8 && !$(e.target).is("input, textarea")) {
          e.preventDefault();
        }
      });
    </script>
  </head>

  <body>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="inner cover">
           	<div class="container" style="width: 500px;">

              <div class="body"></div>
              <div class="grad"></div>
              <div id="header">
                <div class="row">TIN</div> 
              </div>
              <div id="header2">
                 <div class="row"><span>MARKET</span></div>
              </div>
              <div id="header3">
                <div class="row">
                  <div class="col-lg=3" id="cp">
                    <label style="text-align: center"><h3>Contact Person : </h3></label>
                  </div>
                </div>
                  <!-- <div class="row">
                    <label style="color:white"><h3>PT KLiring Berjangka Indonesia (<em>021 - 39833066 Ext. 424</em>)</h3></label>
                  </div>
                  <div class="row">
                     <label style="color:white"><h3>Contact Person : PT KLiring Berjangka Indonesia (<em>021 - 39833066 Ext. 424</em>)</h3></label>
                  </div> -->
                    
              </div>
              <div id="header5">
                <div class="row">
                  <div class="col-lg=3" id="cp">
                    <label style="color:white; font-size: 20px">PT Kliring Berjangka Indonesia (Persero) (<em>021 - 39833066 Ext. 424</em>)</label> 
                  </div>
                </div>
              </div>
              <div id="header6">
                <div class="row">
                  <label style="color:white; font-size: 20px">Jakarta Futures Exchange (<em>021 - 31996030 Ext.801</em>)</label> 
                </div>
              </div>
              <div id="header4">
                 <div class="row"> <a href="http://www.ptkbi.com" style="color:white" >PT Kliring Berjangka Indonesia (Persero) </a>| <span> <a href="http://www.jfx.co.id">Jakarta Futures Exchange</a></span></div>
              </div>
              <div class="login">
        				<form action="" method="POST" role="form">
        					<div class="form-group">
        						<!-- <label for="">Username</label> -->
        						<input type="text" class="form-control" name="input_kbi_user" id="n_usrn" placeholder="Username" autocomplete="off">
        					</div>
        					<div class="form-group">
        						<!-- <label for="">Password</label> -->
        						<input type="password" class="form-control" name="input_kbi_pswd" id="n_pswd" placeholder="Password" autocomplete="off">
        					</div>
                  <input id="submit" type="submit" class="btn btn-primary" value="Submit">
        					
                  <a class="btn btn-info" role="button" href="<?php echo base_url('index.php/c_tpa_01_register_form');?>">Register</a>
          
                  <br>
                  <br>
                  <!-- <hr > -->
                </form>
              </div>
			       </div>
          </div>
        </div>
      </div>
    </div>
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




	