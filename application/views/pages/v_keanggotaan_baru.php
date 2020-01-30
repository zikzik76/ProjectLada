<style type="text/css">
/* body {
    margin:0;
    padding:0;
    background:#111;
} */
.text_h1 {
    position:absolute;
    top:50%;
    left:50%;
    z-index:-1;
    font-size:70px;
    transform:translate(-50%,-50%);
    color:#fff;
}
 .loader {
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:100%;
    height:10px;
    text-align:center;
}
.loader span {
    width:30px;
    height:30px;
    background:#fff;
    display:inline-block;
    border-radius:50%;
    animation:animate 2s linear infinite;
    opacity:0;
}
.loader span:nth-child(1) {
    animation-delay:0.8s;
    background:#243971;
}
.loader span:nth-child(2) {
    animation-delay:0.4s;
    background:#B5911E;
}
.loader span:nth-child(3) {
    animation-delay:0.2s;
    background:#97BCD2;
}

@keyframes animate {
    0% {
        transform: translateX(-200px);
        opacity:0;
    }
    25% {
        transform: translateX(-100px);
        opacity:1;
    }
    50% {
        transform: translateX(0);
        opacity:1;
    }
    75% {
        transform: translateX(0);
        opacity:1;
    }
    100% {
        transform: translateX(100px);
        opacity:0;
    }
    90% {
        transform: translateX(100px);
        opacity:0;
    }
}
</style>
<!-- statrt buat loading-->
<div id="dommessage" style="display: none"> 
        <img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
        <br/>
        <h4>Saving data in progress, Please wait a moment...</h4>
</div>
<!-- END Loading -->
<section id="content">
    
    <!-- Start untuk side bar dan header -->
    <nav class="navbar navbar-default" >
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h3>FORM FILLING PARTICIPANTS <br><small><em>FORM PENGISIAN PESERTA</em></small></h3>
                </div>
            </div>
        </div>
    </nav>
    <!-- end sidebar dan header -->

    <!-- untuk radio btn -->
    <div class="container-fluid center"> 
        <p>Please Select Participation Type <br><small><em>Silahkan Pilih Type Kepesertaan</em></small></p>       
        <form method="POST" name="form_regis" id="form_regis" enctype="multipart/form-data" data-toggle="validator" role="form">       
            <div class="radio">
                <label><input type="radio" name="optradio_anggota" id="optradio_pembeli" value="Buyer" onchange="change_opt('pembeli')">&nbsp; Buyer | <small><em>Pembeli</em></small></label>
            </div>
            <div class="radio">
                <label><input type="radio" name="optradio_anggota" id="optradio_penjual" value="Seller" onchange="change_opt('penjual')">&nbsp; Seller | <small><em>Penjual</em></small></label>
            </div>
            <br>
            <div id="status_negeri" class="row">
                
            </div>
            <div id="form_anggota" class="row"> 

            </div>
           
        </form>

    </div> 
    <!-- end radio btn -->
    <br>
    <br>

<script type="text/javascript">


$(document).on("keydown", function (e) {
        if (e.which === 8 && !$(e.target).is("input, textarea")) {
            e.preventDefault();
            }
            // getData();
        });

        document.getElementById('optradio_pembeli').checked = false;
        document.getElementById('optradio_penjual').checked = false;
        document.getElementById('optradio_status_usaha_dlm').checked = false;
        document.getElementById('optradio_status_usaha_lr').checked = false;

        // function getData() {
          
        

        function change_opt(a){
            
            if(a === 'pembeli'){
                document.getElementById('form_anggota').innerHTML = ""; 
                var negeri = '<div class="col-lg-12">'+
                '<p>Please Select a Business Place </br> <small></em>Silahkan Pilih Tempat Usaha</em></small></p>'+
                    '<div class="row container ">'+
                    '<div class="radio">'+
                        '<label><input type="radio" name="optradio_status_usaha" id="optradio_status_usaha_dlm" value="dalam" onchange="change_status(\'pembeli\',\'dalam\')">&nbsp;Domestic | <small><em>Dalam Negeri</em></small></label>'+
                    '</div>'+
                    '<div class="radio">'+
                        '<label><input type="radio" name="optradio_status_usaha" id="optradio_status_usaha_lr" value="luar" onchange="change_status(\'pembeli\',\'luar\')">&nbsp;Foreign | <small><em>Luar Negeri</small></em></label>'+
                    '</div>';
                    document.getElementById('status_negeri').innerHTML = negeri;                  
            }
            else  if(a === 'penjual')
            {
                // alert("tampilkan form");
                $('#form_anggota').load("<?php echo site_url('index.php/c_keanggotaan_baru/getDataList');?>")
                document.getElementById('status_negeri').innerHTML = ""; 
                
            }
        }
        function change_status(b,c)
        {
            if (b === 'pembeli'){
                if(c === 'dalam'){
                    $('#form_anggota').load("<?php echo site_url('index.php/c_keanggotaan_baru/getDomesticForm');?>")                    
                }
                else if (c == 'luar')
                {
                    $('#form_anggota').load("<?php echo site_url('index.php/c_keanggotaan_baru/getForignForm');?>")                    
                }
            }
        }
</script>
        
           
           

        
        
<!-- </script> -->
