
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
<script type="text/javascript">
// $("form").submit(function(){
//     $.blockUI({ message: '<img src="/application/asset/image/loading2.gif" width="200" height="200"/><br/><h4>Saving data in progress, Please wait a moment...</h4>' });

//      var c = confirm('Are you sure?'); 
//         if(!c){ 
//                     // $(form).addClass('skip'); 
//             return false;
//         } else {
//              $.blockUI({ message: $('#dommessage')});
//         };
// });
    
</script>
<!-- <?php 
// if (isset($_SERVER['HTTP_COOKIE'])) {
//     $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
//     foreach($cookies as $cookie) {
//         $parts = explode('=', $cookie);
//         $name = trim($parts[0]);
//         setcookie($name, '', time()-1000);
//         setcookie($name, '', time()-1000, '/');
//     }
//}
?> -->
<!-- <button id="hide">Hide</button>
<button id="show">Show</button> -->
<!-- <div id="loading" style="z-index: 5000; width: 100%;height: 100%;position: fixed;display: none">
    <div class="loader">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div> -->
<div id="dommessage" style="display: none"> 
        <img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
        <br/>
        <h4>Saving data in progress, Please wait a moment...</h4>
</div>
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
                    <h3>FORM FILLING PARTICIPANTS <br><small><em>FORM PENGISIAN PESERTA</em></small></h3>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid center"> 
        <p>Please Select Participation Type <br><small><em>Silahkan Pilih Type Kepesertaan</em></small></p>
        <!-- <?php echo form_open_multipart('index.php/c_tpa_01_form_keanggotaan/regist_anggota_profile'); ?> -->
        <!-- <form method="POST" name="form_regis" id="form_regis" onsubmit="return (function(form) { var c = confirm('Are you sure?'); if(!c) { $(form).addClass('skip'); } return get_loader();})(this);" action="<?php echo base_url();?>index.php/c_tpa_01_form_keanggotaan/regist_anggota_profile" enctype="multipart/form-data" > -->
        <form method="POST" name="form_regis" id="form_regis" enctype="multipart/form-data" data-toggle="validator" role="form">
        <!-- <form method="POST" name="form_regis" id="form_regis" action="" enctype="multipart/form-data" > -->
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
    <br>
    <br>

<script>

$(document).on("keydown", function (e) {
   if (e.which === 8 && !$(e.target).is("input, textarea")) {
    e.preventDefault();
    }
});

document.getElementById('optradio_pembeli').checked = false;
document.getElementById('optradio_penjual').checked = false;
document.getElementById('optradio_status_usaha_dlm').checked = false;
document.getElementById('optradio_status_usaha_lr').checked = false;


function change_opt(a){
    if(a === 'pembeli'){
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
            // $('#DataProses').click(function(){
            //     $.blockUI({ message: '<img src="/application/asset/image/loading2.gif" width="200" height="200"/><br/><h4>Saving data in progress, Please wait a moment...</h4>' }); 
            //     setTimeout($.unblockUI, 2000); 
            // });

    } else  if(a === 'penjual'){
       var negeri = '<br>'+
                        '<hr>'+ 
                        '<div class="col-lg-12">'+
                            '<p>Seller Profile Form Attachment <br> <small><em>Lampiran Form Profile Penjual</em></small></p>'+
                            // '<hr/>'+
                            '<div class="form-group class="col-lg-12">'+
                                '<label>Participant Name <br> <small><em>Nama Calon Peserta </em></small> :</label>'+
                                '<input type="text" class="form-control" id="n_calon_penjual" name="n_calon_seller" required = "required">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Company Status <br> <small><em>Status Perusahaan</em></small> :</label>'+
                                '<select name="st_calon_seller" id="st_calon_seller" class="form-control" required="required">'+
                                    '<option value="">-</option>'+
                                    // '<option value="Perorangan">Perorangan</option>'+
                                    '<option value="Badan Usaha">Badan Usaha</option>'+
                                '</select>'+
                            '</div>'+
                             '<div class="form-group">'+
                                '<label>Bank Account Number <br> <small><em>Nomor Akun Bank </em></small> : </label>'+
                                '<input type="number" class="form-control" id="no_account_bank_seller" name="no_account_bank_seller" required="required">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Bank Account Name <br> <small><em> Nama Akun Bank </em></small>: </label>'+
                                '<input type="text" class="form-control" id="account_name_seller" name="account_name_seller" required="required" placeholder="BANK ACCOUNT NAME">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Bank Name <br> <small><em>Nama Bank</em></small> :</label>'+
                                 '<input type="text" class="form-control" id="bank_name_seller" name="bank_name_seller" required="required">'+
                                // '<select name="bank_name_seller" id="bank_name_seller" class="form-control" required="required" onchange="myfunction()">'+
                                //     '<option value="">-</option>'+
                                //     '<option value="Mandiri">Bank Mandiri</option>'+
                                //     '<option value="BNI">Bank Negara Indonesia</option>'+
                                //     '<option value="CCB">CCB</option>'+
                                //     '<option value="CIMB">CIMB NIAGA</option>'+
                                //     '<option value="BCA">Bank Central Asia</option >'+
                                //     '<option value="BAG">Bank Artha Graha</option>'+
                                // '</select>'+
                            '</div>'+
                             '<div class="form-group">'+
                                '<label>Address <br> <small><em>Alamat</em></small>:</label>'+
                                '<input type="text" class="form-control" id="address_seller" name="address_Seller" required="required" placeholder="COMPANY ADDRESS">'+
                            '</div>'+
                            '<label>To upload, the file format file used is .PDF</label><br>'+
                             '<small><em>Untuk Upload file format file yang digunakan adalah file .PDF</em></small>'+
                            '<table class="table table-striped table-hover">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th> About <br> <small><em>Perihal</em></small></th>'+
                                        '<th>Action</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<td>Number of Deed of Establishment <br> <small><em>No Akta Pendirian</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="ak_pen_seller" id="ak_pen_seller" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Amendment Number <br> <small><em>No Akta Perubahan</em></small> <br>(<small>if there is no change then upload with the same document | bila tidak ada perubahan maka upload dengan dokumen akta yang existing / sama </small>)</td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="ak_per_seller" id="ak_per_seller" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Firm address <br> <small><em>Domisili Perusahaan</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="dom_seller" id="dom_seller" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Taxpayer Number <br> <small></em> No Pokok Wajib Pajak (NPWP) </em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="npwp_seller" id="npwp_seller" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Customs Registration Number <br><small><em> No Identitas Kepabean</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="id_kep_seller" id="id_kep_seller" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Registered Pure TIN bar Exporters that are Still Valid <br></small><em>Eksportir Terdaftar Timah Murni Batang Yang Masih Berlaku</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="ekspor_timah" id="ekspor_timah" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Licensing Pure Tin Bars Exporters that Are Still valid <br><small><em>Perizinan Ekspor Timah Murni Batangan Yang Masih Berlaku</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="peizinan_seller" id="peizinan_seller" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+

                                    '<tr>'+
                                        '<td>Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="nib_seller" id="nib_seller" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="idp_seller" id="idp_seller" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Financial statements <br> <small><em>Laporan Keuangan</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="lk_seller" id="lk_seller" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                '</tbody>'+
                            '</table>'+
                            '<div>'+
                                 '<button type="button" class="btn btn-primary" id="DataProses" onclick="post_data(\'S\');">Submit</button>'+
                                '<button type="Cancel" class="btn btn-warning">Cancel</button>'+
                            '</div>'+
                        '</div>';

                        document.getElementById('status_negeri').innerHTML = negeri;
                        change_status('penjual','dalam');
    }else{
        alert('status belum memilih jenis kepesertaan');
    }
    // return true;
}
 function change_status(b,c)
 {
    if (b === 'pembeli'){
        if(c === 'dalam'){
            var result ='<div class="col-lg-12">'+
                        '<div class="row">'+
                          '<div><input type="HIDDEN" id="optradio_jenis" name="optradio_jenis" value="peserta"/></div>'+
                        '</div>'+
                        '<br>'+
                        '<hr>'+
                        '<div>'+
                            '<P>Buyer Profile Form Attachment <br> <small><em>Lampiran Form Profile Pembeli</em></small></p>'+
                            '<div class="form-group">'+
                                '<label>Participant Name <br> <small><em>Nama Calon Peserta :</em></small></label>'+
                                '<input type="text" class="form-control" id="n_calon" name="n_calon" required placeholder="Example : PT CALON TIMAH  (Firm Name)  ">'+
                            '</div>'+
                            '<div class="form-group">'+
                            '<label>Company Status <br> <small><em>Status Perusahaan</em></small> :</label>'+
                                '<select name="st_calon" id="st_calon" class="form-control" required="required">'+
                                    '<option value="">-</option>'+
                                    '<option value="Badan Usaha"><b>Business Entity</b> | <small><em>Badan Usaha</em></small></option>'+
                                '</select>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Bank Account Number <br> <small><em>Nomor Akun Bank </em></small> : </label>'+
                                '<input type="number" class="form-control" id="no_account_bank" name="no_account_bank" required="required" placeholder=" Example : 123456789012"'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Bank Account Name <br> <small><em> Nama Akun Bank </em></small>: </label>'+
                                '<input type="text" class="form-control" id="account_name" name="account_name" required="required" placeholder="Example : BANK ACCOUNT NAME">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Bank Name <br> <small><em>Nama Bank</em></small> :</label>'+
                                 '<input type="text" class="form-control" id="bank_name" name="bank_name" required="required">'+
                                // '<select name="bank_name" id="bank_name" class="form-control" required="required">'+
                                //     '<option value="">-</option>'+
                                //     '<option value="Mandiri">Bank Mandiri</option>'+
                                //     '<option value="BNI">Bank BNI</option>'+
                                //     '<option value="CCB">Bank CCB</option>'+
                                //     '<option value="CIMB">CIMB NIAGA</option>'+
                                //     '<option value="BCA">Bank Central Asia</option>'+
                                //     '<option value="BAG">Bank Artha Graha</option>'+
                                // '</select>'+
                            '</div>'+
                             '<div class="form-group">'+
                                '<label>Address <br> <small><em>Alamat</em></small>:</label>'+
                                '<input type="text" class="form-control" id="address" name="address" required="required" placeholder="Example : COMPANY ADDRESS">'+
                            '</div>'+
                            '<label>To upload, the file format file used is .PDF</label><br>'+
                             '<small><em>Untuk Upload file format file yang digunakan adalah file .PDF</em></small>'+
                            '<table class="table table-striped table-hover">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th> About <br> <small><em>Perihal</em></small></th>'+
                                        '<th> Action </th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<td>Number of Deed of Establishment <br> <small><em>No Akta Pendirian</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="ak_pen" id="ak_pen" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Amendment Number <br> <small><em>No Akta Perubahan</em></small> <br>(<small>if there is no change then upload with the same document | bila tidak ada perubahan maka upload dengan dokumen akta yang existing / sama </small>)</td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="ak_per" id="ak_per" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Firm address <br> <small><em>Domisili Perusahaan</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="domi_per" id="domi_per" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Taxpayer Number <br> <small></em> No Pokok Wajib Pajak (NPWP) </em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="npwp" id="npwp" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Permission from Authorized Agency <br> <small><em>Izin Dari Instansi Yang Berwenang</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="izin_instansi" id="izin_instansi" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="nib" id="nib" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="idp" id="idp" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Financial statements <br> <small><em>Laporan Keuangan</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="lk" id="lk" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                '</tbody>'+
                            '</table>'+
                             '<div>'+
                             '<br>'+

                                 '<button type="button" class="btn btn-primary" id="DataProses" onclick="post_data(\'PD\');">Submit</button>'+
                                '<button type="Cancel" class="btn btn-warning">Cancel</button>'+
                            '</div>'+
                        '</div>'+
                        '</div>'+
                        '<br>';
                document.getElementById('form_anggota').innerHTML = result;
        } else if(c === 'luar') {
             var result ='<br>'+
                            '<div class="col-lg-12">'+
                            '<div>'+
                                '<label>Country of origin <br><small><em>Negara Asal</em></small></label>'+
                                '<br>'+
                                '<small>Fill in if the choice of the above option is Foreign | <em>( Di isikan jika pilihan dari opsi di atas adalah Luar Negeri ) :</em></small>'+
                                '<input type="text" class="form-control" id="negara_asal" name="negara_asal" required />'+
                            '</div>'+
                            '<div class="row">'+
                          '<div><input type="HIDDEN" id="optradio_jenis" name="optradio_jenis" value="peserta"></div>'+
                        '</div>'+
                        '<br>'+
                        '<hr>'+
                        '<div>'+
                            '<P>Buyer Profile Form Attachment <br><small><em>Lampiran Form Profile Pembeli</em></small> :</p>'+
                            '<div class="form-group">'+
                                '<label>Participant Name <br> <small><em>Nama Calon Peserta </em></small> :</label>'+
                                '<input type="text" class="form-control" id="n_calon" name="n_calon" required placeholder="Example : PT CALON TIMAH  (Firm Name)  ">'+
                            '</div>'+
                            '<div class="form-group">'+
                            '<label>Company Status <br> <small><em>Status Perusahaan</em></small> :</label>'+
                                '<select name="st_calon" id="st_calon" class="form-control" required="required">'+
                                    '<option value="">-</option>'+
                                    // '<option value="Perorangan">Perorangan</option>'+
                                    '<option value="Badan Usaha"><b>Business Entity</b> | <small><em>Badan Usaha</em></small></option>'+
                                '</select>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>No AccounBank Account Number <br> <small><em>Nomor Akun Bank </em></small> : </label>'+
                                '<input type="number" class="form-control" id="no_account_bank" name="no_account_bank" required="required" placeholder=" Example : 123456789012">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Bank Account Name <br> <small><em> Nama Akun Bank </em></small>: </label>'+
                                '<input type="text" class="form-control" id="account_name" name="account_name" required="required" placeholder=" Example : BANK ACCOUNT NAME">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label>Bank Name <br> <small><em>Nama Bank</em></small> :</label>'+
                                 '<input type="text" class="form-control" id="bank_name" name="bank_name" required="required">'+
                                // '<select name="bank_name" id="bank_name" class="form-control" required="required">'+
                                //     '<option value="">-</option>'+
                                //     '<option value="Mandiri">Bank Mandiri</option>'+
                                //     '<option value="BNI">Bank BNI</option>'+
                                //     '<option value="CCB">Bank CCB</option>'+
                                //     '<option value="CIMB">CIMB NIAGA</option>'+
                                //     '<option value="BCA">Bank Central Asia</option>'+
                                //     '<option value="BAG">Bank Artha Graha</option>'+
                                // '</select>'+
                            '</div>'+
                             '<div class="form-group">'+
                                '<label>Address <br> <small><em>Alamat</em></small>:</label>'+
                                '<input type="text" class="form-control" id="address" name="address" required="required" placeholder="Example : COMPANY ADDRESS">'+
                            '</div>'+
                            '<label>To upload, the file format file used is .PDF</label><br>'+
                             '<small><em>Untuk Upload file format file yang digunakan adalah file .PDF</em></small>'+
                            '<table class="table table-striped table-hover">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th> About <br> <small><em>Perihal</em></small></th>'+
                                        '<th>Action</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<td>Number of Deed of Establishment <br> <small><em>No Akta Pendirian</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="ak_pen" id="ak_pen" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Amendment Number <br> <small><em>No Akta Perubahan</em></small> <br>(<small>if there is no change then upload with the same document | bila tidak ada perubahan maka upload dengan dokumen akta yang existing / sama </small>)</td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="ak_per" id="ak_per" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Firm address <br> <small><em>Domisili Perusahaan</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="domi_per" id="domi_per" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Taxpayer Number <br> <small></em> No Pokok Wajib Pajak (NPWP) </em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="npwp" id="npwp" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Permission from Authorized Agency <br> <small><em>Izin Dari Instansi Yang Berwenang</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="izin_instansi" id="izin_instansi" required="required" accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                     '<tr>'+
                                        '<td>board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="idp" id="idp" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                     '<tr>'+
                                        '<td>Bank Reference Letter <br> <small><em>Surat Referensi Bank </em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="rfbn" id="rfbn" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Financial statements <br> <small><em>Laporan Keuangan</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="lk" id="lk" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                     '<tr>'+
                                        '<td>Company Profile <br><small><em>Profil Perusahaan</em></small></td>'+
                                        '<td>'+
                                            '<div class="input-group">'+
                                                '<div class="custom-file col-sm-12">'+
                                                    '<input type="file" class="custom-file-input" name="compro" id="compro" required accept="application/pdf">'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'+
                                '</tbody>'+
                            '</table>'+
                             '<div>'+
                                '<button type="button" class="btn btn-primary" id="DataProses" onclick="post_data(\'PL\');">Submit</button>'+
                                '<button type="Cancel" class="btn btn-warning">Cancel</button>'+
                            '</div>'+
                            '</div>'+
                        '</div>';

                        // '<div>';
            document.getElementById('form_anggota').innerHTML = result;

            }
        }else if(b === 'penjual'){
            if(c === 'dalam'){
                document.getElementById('form_anggota').innerHTML = '';
            }
        }

   
}

function post_data(val){
    if(val == 'S'){
        var ak_pen_seller = document.getElementById('ak_pen_seller').files.length;
        var ak_per_seller = document.getElementById('ak_per_seller').files.length;
        var dom_seller = document.getElementById('dom_seller').files.length;
        var npwp_seller = document.getElementById('npwp_seller').files.length;
        var id_kep_seller = document.getElementById('id_kep_seller').files.length;
        var ekspor_timah = document.getElementById('ekspor_timah').files.length;
        var peizinan_seller = document.getElementById('peizinan_seller').files.length;
        var idp_seller = document.getElementById('idp_seller').files.length;
        var lk_seller = document.getElementById('lk_seller').files.length;
        if(ak_pen_seller == 0 || ak_per_seller == 0 || dom_seller == 0 || npwp_seller == 0 || id_kep_seller == 0 || ekspor_timah == 0 || peizinan_seller == 0 || idp_seller == 0 || lk_seller == 0)
        {
            alert('please check your data again, fill in the data completely');
            return false;
        } else {
            $.blockUI({ message: $('#dommessage')});    
            var formdata = new FormData(document.getElementById('form_regis'));
            $.ajax({
                url: '<?php echo base_url();?>index.php/c_tpa_01_form_keanggotaan/regist_anggota_profile',
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                data : formdata,
                // data : $(this).serialize(),
                success: function(result){
                    alert("Send Data Success, approval will be send to your email, check your email continuesly");
                    window.location.replace("https://tinmarket.id");
                    $.unblockUI();
                },
                error: function(err){
                    alert("Send Data Success, approval will be send to your email, check your email continuesly");
                    window.location.replace("https://tinmarket.id");
                    $.unblockUI();
                }
            });
            return true;
        }
        // alert('seller');
    } else if(val == 'PD'){
            var ak_pen = document.getElementById('ak_pen').files.length;
            var ak_per =  document.getElementById('ak_per').files.length;
            var domi_per =  document.getElementById('domi_per').files.length;
            var npwp =  document.getElementById('npwp').files.length;
            var izin_instansi =  document.getElementById('izin_instansi').files.length;
            var ak_pniben =  document.getElementById('nib').files.length;
            var idp =  document.getElementById('idp').files.length;
            var lk =  document.getElementById('lk').files.length;

        if(ak_pen == 0 || ak_per == 0 || domi_per == 0 || npwp == 0 || izin_instansi == 0 || nib == 0 || idp == 0 || lk == 0)
        {
            alert('please check your data again, fill in the data completely');
            return false;
        } else {
            $.blockUI({ message: $('#dommessage')});    
            var formdata = new FormData(document.getElementById('form_regis'));
            $.ajax({
                url: '<?php echo base_url();?>index.php/c_tpa_01_form_keanggotaan/regist_anggota_profile',
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                data : formdata,
                // data : $(this).serialize(),
                success: function(result){
                    alert("Send Data Success, approval will be send to your email, check your email continuesly");
                    window.location.replace("https://tinmarket.id");
                    $.unblockUI();
                },
                error: function(err){
                    alert("Send Data Success, approval will be send to your email, check your email continuesly");
                    window.location.replace("https://tinmarket.id");
                    $.unblockUI();
                }
            });
            return true;
        } 
    } else {
        var ak_pen = document.getElementById('ak_pen').files.length;
        var ak_per =  document.getElementById('ak_per').files.length;
        var domi_per =  document.getElementById('domi_per').files.length;
        var npwp =  document.getElementById('npwp').files.length;
        var izin_instansi =  document.getElementById('izin_instansi').files.length;
        var lk =  document.getElementById('lk').files.length;
        var rfbn =  document.getElementById('rfbn').files.length;
        var compro =  document.getElementById('compro').files.length;
        var idp =  document.getElementById('idp').files.length;
       if(ak_pen == 0 || domi_per==0 || ak_per == 0 || npwp == 0 || izin_instansi == 0 || rfbn == 0 || lk == 0 || compro == 0 || idp == 0)
       {
        alert('please check your data again, fill in the data completely');
            return false;
       } else {
            $.blockUI({ message: $('#dommessage')});    
            var formdata = new FormData(document.getElementById('form_regis'));
            $.ajax({
                url: '<?php echo base_url();?>index.php/c_tpa_01_form_keanggotaan/regist_anggota_profile',
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                data : formdata,
                // data : $(this).serialize(),
                success: function(result){
                    alert("Send Data Success, approval will be send to your email, check your email continuesly");
                    window.location.replace("https://tinmarket.id");
                    $.unblockUI();
                },
                error: function(err){
                    alert("Send Data Success, approval will be send to your email, check your email continuesly");
                    window.location.replace("https://tinmarket.id");
                    $.unblockUI();
                }
            });
            return true;
       }
    }
};
</script>
<script type="text/javascript">


function register(){
    console.log('success');
}
</script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.blockUI.js');?>">
    </script>
