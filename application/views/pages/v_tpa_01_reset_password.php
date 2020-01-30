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
                    <h3>FORM CHANGE PASSWORD </h3>
                    <br><h3><small><em>FORM GANTI PASSWORD</em></small><h3>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php echo form_open_multipart('index.php/c_tpa_01_change_password/validation_reset'); ?> 
            <div class="form-group">    
                <div class="row">
                    <div class="col-lg-3">
                        <label>CURRENT EMAIL</label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="email" name="rst_email"  id="rst_email" class="form-control">
                    </div> 
                </div>
                <br>
                <div class="row"> 
                    <div class="col-lg-3"> 
                        <label>OLD PASSWORD</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6"> 
                        <input type="Password" name="rst_pass_old" id="rst_pass_old" class="form-control"> 
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        <label>NEW PASSWORD</label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="password" name="rst_pass_new" id="rst_pass_new" class="form-control">
                    </div> 
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        <label>CONFIRM NEW PASSWORD</label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="password" name="rst_c_pass_new" id="rst_c_pass_new" class="form-control">
                    </div> 
                </div>
                <br>

                <button type="submit" name="" id="" class="btn btn-primary"> Change</button>
                <button type="button" name="" id="" class="btn btn-primary"> Cancel</button>
            </div>
        <form>
    </div>
    <script type="text/javascript">
        // $.ajax({
        //     url: "<?php base_url();?>/c_tpa_01_change_password/validation_reset";,
        //     type : "POST",
        //     data : {
        //         user : "<?php $priv['username']?>", 
        //     },
        //     dataType : "JSON",
        //     error : function(xhr){
        //      console.log(xhr.data);
        //     },
        //     success : function(data){
        //       alert(data);
        //       // console.clear();
        //     },
        // });
 //    </script>