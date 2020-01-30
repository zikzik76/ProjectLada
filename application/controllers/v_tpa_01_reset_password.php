

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
                    <h3>FORM PENGISIAN ANGGOTA</h3>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo base_url('index.php/c_tpa_01_form_keanggotaan'); ?>">Form Pengisian Anggota</a></li>
                        <li><a href="<?php echo base_url('index.php/c_tpa_01_reset_password');?>" >Reset Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container"> 
        <div class="form-group"> 
            <div class="row">
                <div class="col-lg-3">
                    <label>CURRENT EMAIL</label>
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="email" name="" class="form-control" />
                </div> 
            </div>
            <br> 
            <div class="row"> 
                <div class="col-lg-3"> 
                    <label>OLD PASSWORD</label>
                </div>
            </div>
            <br> 
            <div class="row">
                <div class="col-lg-3"> 
                    <input type="Password" name="Reset_pass_old_pass"> 
                </div>
            </div>
            <br> 
            <div class="row">
                <div class="col-lg-3">
                    <label>NEW PASSWORD</label>
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="password" name="">
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label>CONFIRM NEW PASSWORD</label>
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="password" name="">
                </div> 
            </div>
        </div>

    </div>