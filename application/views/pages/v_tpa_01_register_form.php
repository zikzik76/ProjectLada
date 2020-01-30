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
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.blockUI.js');?>">
    </script>


<script type="text/javascript">	
	function validatorUsername(){
		var regex = RegExp("^[a-zA-Z0-9]*$");
		var test = regex.test($("#usr_cm").val());
		if(!test){
			$("#usr_cm").val($("#usr_cm").val().replace(/[^a-zA-Z0-9]/g, ''));
		}
 	}
</script>


</head>
<body>
<section style="margin-top: 1em">
	<div class="container">
		<h2>Registrasi Akun</h2>
		<br />

		<!-- <form method="POST" name="form_regis" id="form_regis" onsubmit="return (function(form) { var c = confirm('Are you sure?'); if(!c) { $(form).addClass('skip'); } return c; })(this);" action="<?php echo base_url();?>index.php/c_tpa_01_register_form" > -->
		<form method="POST" name="form_regis" id="form_regis" >
		<?php $this->load->library('session');?>	
		<?php $val = $this->session->all_userdata();?>
			<div class="form-group">
			    <label for="usr_cm">Username:</label>
			    <input type="text" class="form-control username" name="usr_cm" id="usr_cm" placeholder="Username May Not Contain Special Character" onkeyup="javascript:validatorUsername();" required>

			</div>
			<div class="form-group">
				<label for="pwd_cm">Password</label>
				<input type="password" class="form-control" name="pwd_cm" id="pwd_cm" autocomplete="off" required placeholder="Password Minimum 8 digits">

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
				<p>Can't read the image? click <a type="button" href="javascript:void(0);" class="refreshCaptcha btn btn-primary">here</a> to refresh.</p> 

			</div>
			<input type="text" name="captcha" id="captcha" value="" required />

			<br>
			<br>
		  	<!-- <input type="submit" name="submit" id="submit" class="btn btn-primary" value="SUBMIT" onclick="javascript:register();" /> -->
		  	<input type="button" name="submit" id="submit" class="btn btn-primary" value="SUBMIT" />
		  	<!-- <input type="submit" name="submit" id="submit" class="btn btn-primary" value="SUBMIT"  /> -->
		  	<button type="button" name="cancel_btn" id="cancel_btn" class="btn btn-warning" onclick="cancel()"/> Cancel </button>
		</form>
	</div>
	<div id="dommessage" style="display: none"> 
		<img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
		<br/>
		<h4>Saving data in progress, Please wait a moment...</h4>
	</div>
</section>
<br>
<br>
<script>
$(document).on("keydown", function (e){
	if (e.which === 8 && !$(e.target).is("input, textarea")) {
		e.preventDefault();
	}
});

$('#submit').click(function(){
  // return c;
	var username = document.getElementById('usr_cm').value;
	var password = document.getElementById('pwd_cm').value;
	var cpassword = document.getElementById('cpwd_cm').value;
	var email = document.getElementById('email_cm').value; 
	var tlp = document.getElementById('tlp_cm').value;
	var capt = document.getElementById('capt').value;
	var captcha = document.getElementById('captcha').value;

        if(username == ''){
    	alert('Please fill The username');
    	// document.getElementById('usr_cm').value = '';
    	return false;
	    } else{
	    	if(password == ''){
	    		alert('Please fill The password');
	    		return false;
	    	} else {
	    		if(password == username){
	    			alert('password not allowed contain username');
	    			return false;
	    		} else {
	    			length_pass = password.length;
	    			if(password.length < 8 ){
	    				alert('password must be minimal 8 digit');
	    				return false;
	    			} else {
	    				var check_alpha_num = checkPasswordComplexity(password);
	    				// 
	    				if(check_alpha_num == false){
	    					alert('Make Sure The password contain Alpa Numeric Ex : Xyz123 or X1yz2');
	    					return false
	    				} else {
					    	if(password != cpassword){
					    		alert('password not match');
					    		return false;
					    	} else {
					    		if(email == ''){
					    			alert('Please fill the email');
					    			return false
					    		} else {
					    			if(tlp == ''){
					    				alert('Please fill the phone number');
					    			} else {
					    				if(captcha == ''){
					    					alert('captcha cannot be empty')
					    				} else {

							    		 var c = confirm('Are you sure?'); 
										    if(!c){ 
										  		return false;
											} else {
												$.blockUI({ message: $('#dommessage')});
								 				$.ajax({
												    url: "<?php echo base_url();?>index.php/c_tpa_01_register_form/account_created",
												    type: 'POST',
												    data: {
												  		usr_cm : username,
														pwd_cm : password,
														cpwd_cm : cpassword,
														email_cm : email,
														tlp_cm : tlp,
														capt : capt,
														captcha : captcha
												    },
												    dataType : 'JSON',
												    success: function(data, textStatus, jqXHR){ 
													   	alert("TIS account Success created, check Your email continuesly");
														window.location.replace("https://tinmarket.id");
														$.unblockUI();
												    },
												    error: function(jqXHR, textStatus, errorThrown){
												    	alert("TIS account Success created, check Your email continuesly");
														window.location.replace("https://tinmarket.id");
														// alert(data);
												        $.unblockUI();
												    }
												});	
											}
					    					
					    				}
					    			}
					    		}
					    	}
	    				}
	    			}
	    		}
	    	}
	    }
	});


function checkPasswordComplexity(pwd) {
    var letter = /[a-zA-Z]/; 
    var number = /[0-9]/;
    var valid = number.test(pwd) && letter.test(pwd); //match a letter _and_ a number

    return valid;
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