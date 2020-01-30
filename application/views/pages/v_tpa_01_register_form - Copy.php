<!DOCTYPE html>
<html>
<head>
	<!-- <meta http-equiv="refresh" content="30"/> -->
	<title>TIN MEMBERSHIP</title>
   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap.min.css'); ?>">


	<!-- Data Tables -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/dataTables.min.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/jquery.dataTables.min.css'); ?>">
 
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/style5.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/bootstrap-chosen.css'); ?>">


	<style type="text/css" class="init">
	
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.blockUI.js');?>">
    </script>
   <!--  <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/chosen.jquery.js');?>">
    </script> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
    <!-- <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>   -->



	<script>

    //   $(function() {
    //     $('.chosen-select').chosen();
    //     $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
    //   });

    // $(document).ready(function () {
    //     $('.dropdown-toggle').dropdown();
    // });
</script>
<script type="text/javascript">	
// PAGING DATATABLE START
// $(document).ready(function() {
// 	var table = $('#example').DataTable( {
// 		"scrollY": true,
// 		"scrollX": true,
// 		"paging": true,
// 		"orderCellsTop": true,
// 		"columnDefs":[{
// 			"visible" : false,
// 			"targets" : -1
// 		}]
// 	} );
// } );

// BlockingUI


	
	

	// function validatorUsername(){
	// 	var regex = RegExp("^[a-zA-Z0-9]*$");
	// 	var test = regex.test($("#usr_cm").val());
	// 	if(!test){
	// 		$("#usr_cm").val($("#usr_cm").val().replace(/[^a-zA-Z0-9]/g, ''));
	// 	}
 // 	}
</script>


</head>
<body>
<section style="margin-top: 1em">
	<div class="container">
		<h2>Registrasi Akun</h2>
		<br />
<?php echo form_open_multipart('index.php/c_tpa_01_register_form','id="form_regis"', 'class="form_regis"', 'name="form_regis"', 'data-toggle="validator"'); ?> 
		<!-- <form type="POST" name="form_regis" id="form_regis" action="javascript:register()"> -->
		<?php $this->load->library('session');?>	
		<?php $val = $this->session->all_userdata();?>
			<div class="form-group">
			    <label for="usr_cm">Username:</label>
			    <input type="text" class="form-control username" name="usr_cm" id="usr_cm" placeholder="penulisan username tidak mengandung titik(.), Koma(,), Kutip/appostrop('), dan spasi " onkeyup="javascript:validatorUsername();" required>

			</div>
			<div class="form-group">
				<label for="pwd_cm">Password</label>
				<input type="password" class="form-control" name="pwd_cm" id="pwd_cm" required>

			</div>
			<div class="form-group">
				<label for="cpwd_cm">Confirm Password</label>
				<input type="password" class="form-control" id="cpwd_cm" name="cpwd_cm" data-match="#pwd_cm" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
        		<div class="help-block with-errors"></div>
        	
			</div>

			<div class="form-group">
			    <label for="email">email</label>
			    <input type="email" class="form-control" id="email_cm" name="email_cm" required>

			</div>
			<div class="form-group">
				<label for="tlp">No Tlp</label>
				<input type="text" class="form-control" name="tlp_cm" id="tlp_cm" required>
				<small><em>Contoh : 082112221122</em></small>
				
			</div>
			<div>
				<h4>Submit Captcha Code</h4>
				<p id="captImg"><?php echo $captchaImg; ?></p>
				<input type="hidden" name="capt" id="capt" value="<?php echo $val['captchaCode'];?>" required>
				<p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p> 

			</div>
			<input type="text" name="captcha" id="captcha" value="" required />

			<br>
			<br>
		  	<!-- <input type="submit" name="submit" id="submit" class="btn btn-primary" value="SUBMIT" onclick="javascript:register();" /> -->
		  	<input type="submit" name="submit" id="submit" class="btn btn-primary" value="SUBMIT"  />
		  	<!-- <input type="submit" name="submit" id="submit" class="btn btn-primary" value="SUBMIT"  /> -->
		  	<button type="button" name="cancel_btn" id="cancel_btn" class="btn btn-warning" onclick="cancel()"/> Cancel </button>
		</form>
	</div>
</section>
<br>
<br>
<script>
$(document).on("keydown", function (e) {
	if (e.which === 8 && !$(e.target).is("input, textarea")) {
		e.preventDefault();
	}
});

$('#submit').click(function(){
	// $.blockUI({ message: '<img src="/application/asset/image/loading2.gif" width="200" height="200"/><br/><h4>Saving data in progress, Please wait a moment...</h4>' });
    			// setTimeout($.unblockUI, 2000); 
	var username = document.getElementById('usr_cm').value;
	var password = document.getElementById('pwd_cm').value;
	var cpassword = document.getElementById('cpwd_cm').value;

    var alphanumericRGEX = /^[a-zA-Z0-9]*$/;
    var usernametest = alphanumericRGEX.test(username);
    // alert(usernametest);
    if(usernametest == false){
    	alert('username have spesial character, please add another username');
    	document.getElementById('usr_cm').value = '';
    	return false;
    } else{
    	var passwordtest = alphanumericRGEX.test(password);
    	if(passwordtest == false){
    		alert('password have spesial character, please fill the password with Alpha Numeric');
    		document.getElementById('pwd_cm').value = '';
    		return false;
    	} else{
    		if(password != cpassword){
    			alert('password not match');
    			return false;
    		} else {
    			// $.blockUI({ message: '<img src="/application/asset/image/loading2.gif" width="200" height="200"/><br/><h4>Saving data in progress, Please wait a moment...</h4>' });
    			// setTimeout($.unblockUI, 5000); 
    			document.getElementById('form_regis').addEventListener("submit",register);
    			return true;
    		}
    	}
    }
});



// 	$.ajax({
//         url: "<?php echo base_url();?>index.php/c_tpa_01_register_form",
//         type: 'POST',
//         data: {
//         		submit : 'submit',
//         		usr_cm : usr_cm,
// 				pwd_cm : pwd_cm,
// 				cpwd_cm : cpwd_cm,
// 				email_cm : email_cm,
// 				tlp_cm : tlp_cm,
// 				capt : capt,
// 				captcha : captcha
//         },
//         mimeType: "multipart/form-data",
//         contentType: false,
//         cache: false,
//         processData: false,
//         success: function(data, textStatus, jqXHR){     	
// 			$.unblockUI();
//         },
//         error: function(jqXHR,xhr, textStatus, errorThrown){
// 			alert('error : ' + errorThrown);
//         	$.unblockUI();
//         }
// 	});
// }
function register(){
	$.blockUI({ message: '<img src="/application/asset/image/loading2.gif" width="200" height="200"/><br/><h4>Saving data in progress, Please wait a moment...</h4>' });
}



$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'index.php/c_tpa_01_register_form/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});

function cancel(){
	window.location.href = "<?php echo base_url('index.php'); ?>";
}
</script>