<link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/datatables/css/jquery.dataTables.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('/application/asset/css/font-awesome.min.css'); ?>">
    <script type="text/javascript" language="javascript" src="<?php echo base_url('/application/asset/js/jquery.blockUI.js');?>">
    </script>
<section id="content" style="width: 100%">
	<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h2>Download Rules</h2>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <hr>
<div class="container" style="width: 100%">
    <header><b>Rules & Regulations <br><small><em>Peraturan & Tata Tertib (PTT)</em></small></b></header>
    <hr>
    <br>
  <?php echo form_open_multipart('index.php/c_tpa_01_download_rules/download_doc'); ?>
    <input type="hidden" name="seed" id="seed" value="">
		<table id="example" class="display select" >
            <thead>
                <tr>
                  <!-- <th><input name="select_all" id="select_all" value="0" type="checkbox" onclick="get_check()"></th> -->
                    <th>#</th>
                    <th>Document Number</th>
                    <th>About</th>
                    <th>Action</th>
            
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>633/BAPPEBTI/SD/07/2019</td>
                <td>Approval of Physical Market Rules and Regulations of Indonesian Clearing Derivative Chapter 10 concerning the Physical Market for Pure Tin Bars <br><small><em>Persetujuan Peraturan Dan Tata Tertib (PTT) Pasar Fisik PT. Kliring Berjangka Indonesia Bab 10 tentang Pasar Fisik Timah Murni Batangan</em></small></td>
                <td><button class="btn btn-primary" href="#" onclick="rules_download('PTTKBI')" ><i class="fa fa-download" ></i> Download</button></td>
              </tr>
              <tr>
                <td>2</td>
                <td>634/BAPPEBTI/SD/07/2019</td>
                <td>Approval of the Physical Future Rules and Regulations (PTT) of the Jakarta Future Exchange Pure Tin Bars <br><small><em>Persetujuan Peraturan dan Tata Tertib (PTT) Pasa Fisik Timah Murni Batangan PT Bursa Berjangka Jakarta</em></small></td>
                <td><button class="btn btn-primary" href="#" onclick="rules_download('PTTBBJ')"><i class="fa fa-download" ></i> Download</button></td>
              </tr>
            </tbody>
    </table>
</form>
<hr>
<div id="dommessage" style="display: none"> 
    <img src="/application/asset/image/LOGO_TIS.gif" width="100%" height="100%"/>
    <br/>
    <h4>Saving data in progress, Please wait a moment...</h4>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var example = $('#example').DataTable({
        columnDefs: [{
            "scrollY": 100,
            "scrollX": true,
            "scrollCollapse": true,
            "fixedHeader": true,
            "bInfo": true,
            scrollResize: true,
            lengthChange: false,
            searching: false,
            paging: true,
            orderable: true,
            targets: 0,
        }],
        order: [
            [1, 'asc']
        ]
    });
});

function rules_download(a){
  $.blockUI({ message: $('#dommessage')});
  document.getElementById('seed').value = a;
  setTimeout($.unblockUI, 5000); 
}

// function rules_download(a){
//   var value = a;
//   alert(value);
//   // // break;
//   //   $.blockUI({ message: $('#dommessage')});
//   $.ajax({
//       url: "<?php echo base_url();?>index.php/c_tpa_01_download_rules/download_doc",
//       // cache: false,
//       // contentType: false,
//       // processData: false,
//       type: 'POST',
//       data : {
//         seed : value
//       },
//       dataType : 'JSON',
//         // data : $(this).serialize(),
//       error: function(xhr){
//         // console.log(err);
//         // alert("ownload Success, Please cek your Download folder");
//         alert(data.xhr);
//         // window.location.replace("http://tis.ptkbi.com");
//         // $.unblockUI();
//       },
//       success: function(data){
//         // alert("Download Success, Please cek your Download folder");
//         alert(data.status);
//         // window.location.replace("http://tis.ptkbi.com");
//         // $.unblockUI();
//       }
//   });
// }
</script>
