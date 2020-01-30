$(document).on("keydown", function(e) {
    if (e.which === 8 && !$(e.target).is("input, textarea")) {
        e.preventDefault();
    }
});

$('#submit').click(function() {
    // return c;
    var username = document.getElementById('usr_cm').value;
    var password = document.getElementById('pwd_cm').value;
    var cpassword = document.getElementById('cpwd_cm').value;
    var email = document.getElementById('email_cm').value;
    var tlp = document.getElementById('tlp_cm').value;
    var capt = document.getElementById('capt').value;
    var captcha = document.getElementById('captcha').value;

    // var alphanumericRGEX = /^[a-zA-Z0-9]*$/;
    // var usernametest = alphanumericRGEX.test(username);
    //    // alert(usernametest);
    if (username == '') {
        alert('Please fill The username');
        // document.getElementById('usr_cm').value = '';
        return false;
    } else {
        if (password == '') {
            alert('Please fill The password');
            return false;
        } else {
            if (password == username) {
                alert('password not allowed contain username');
                return false;
            } else {
                length_pass = password.length;
                if (password.length < 8) {
                    alert('password must be minimal 8 digit');
                    return false;
                } else {
                    if (password != cpassword) {
                        alert('password not match');
                        return false;
                    } else {

                        var c = confirm('Are you sure?');
                        if (!c) {
                            // $(form).addClass('skip'); 
                            return false;
                        } else {
                            $.blockUI({
                                message: $('#dommessage')
                            });
                            // setTimeout($.unblockUI, 5000); 
                            $.ajax({
                                url: "<?php echo base_url();?>index.php/c_tpa_01_register_form/account_created",
                                type: 'POST',
                                data: {
                                    usr_cm: username,
                                    pwd_cm: password,
                                    cpwd_cm: cpassword,
                                    email_cm: email,
                                    tlp_cm: tlp,
                                    capt: capt,
                                    captcha: captcha
                                },
                                dataType: 'JSON',
                                success: function(data, textStatus, jqXHR) {
                                    alert("TIS account Success created, check Your email continuesly");
                                    window.location.replace("https://tinmarket.id");
                                    $.unblockUI();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    alert("TIS account Success created, check Your email continuesly");
                                    window.location.replace("https://tinmarket.id");
                                    $.unblockUI();
                                }
                            });
                        }
                    }
                }
            }
        }
    }
});
$(document).ready(function() {
    $('.refreshCaptcha').on('click', function() {
        $.get('<?php echo base_url().'
            index.php / c_tpa_01_register_form / refresh '; ?>',
            function(data) {
                $('#captImg').html(data);
            });
    });
});

function cancel() {
    window.location.href = "<?php echo base_url('index.php'); ?>";
}