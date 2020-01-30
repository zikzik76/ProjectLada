<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kliring </title>
<!--     <link href="<?php //echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php //echo base_url('css/all.css'); ?>" rel="stylesheet">
    <link href="<?php //echo base_url('css/all.min.css'); ?>" rel="stylesheet">
    <link href="<?php //echo base_url('css/font-awesome-animation.css'); ?>" rel="stylesheet">
    <link href="<?php //echo base_url('css/font-awesome-animation.min.css'); ?>" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>
<body>
<section>
    <div><h1>PT Kliring Berjangka Indonesia (Persero)</h1></div>
    <div><h3>Activation Password TIS PTKBI</h3></div>
    <br/>
    Username : <?php echo $user;?>
    <!-- Password : <?php echo $password;?> -->
    <br/>
    <!-- <p>klik Link Di bawah ini untuk Aktifasi Account anda pada applikasi TIMAH PTKBI</p> -->
    <p>Click Link below to activated the Account</p>
    <br/>

    <em style="font-size: 10px">
    <?php 
    $query_string = 'foo=' .$val;
    // echo 'https://tis.ptkbi.com/index.php/c_tpa_01_register_form/aktifasi_account?'.$query_string ;
    echo base_url('index.php')."/c_tpa_01_register_form/aktifasi_account?".$query_string ;
    ?>
    </em>
    <br>
    <br>
   <!-- <?php //echo $val ?></p> -->
   <span>Take good care of your password, never share or tell your password to other people or to any party. We need to inform you that PT KLIRING BERJANGKA INDONESIA (PERSERO) has never asked for a password to the participants. so that any risks that occur as a result of these actions are not the responsibility of INDONESIA KLIRING BERJANGKA</span>
   <br>
   <br>
   <span>Jaga dengan baik password anda, jangan pernah share atau memberitahu password anda kepada orang lain atau kepada pihak manapun.Perlu Kami informasikan bahwa PT KLIRING BERJANGKA INDONESIA (PERSERO) tidak pernah meminta password kepada peserta. sehingga Resiko apapun yang terjadi akibat tindakan tersebut bukan merupakan tanggung jawab dari PT KLIRING BERJANGKA INDONESIA</span>
   <br>
   <hr>
</section>
<footer class="py-0" style="bottom: 0px">
    <div>
        
    </div>
        <div style="background-color: #061e42">
        <div class="container">
            <text style="color:white;">Hak Cipta © 2019 PT Kliring Berjangka Indonesia (Persero).</text>
        </div>
    </div>
</footer>
</body>
</html>