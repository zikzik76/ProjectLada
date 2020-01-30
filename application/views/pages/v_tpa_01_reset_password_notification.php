<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kliring </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>
<body>
<section>
    <div><h1>PT Kliring Berjangka Indonesia (Persero)</h1></div>
    <div><h3>Activation Change Password TIS PTKBI</h3></div>
    <br/>
    <!-- <p>klik Link Di bawah ini untuk reset password anda pada applikasi TIMAH PTKBI</p> -->
    <br/>

    <?php 
        // foreach ($val as $key => $value) {
        //     $email = $value['email'];
        //     $old_pass = $value['old_pass'];
        //     $new_pass = $value['new_pass'];
        //     $new_pass_ = $value['new_pass_'];
        //     $c_new_pass = $value['c_new_pass'];
        //     $username = $value['username'];
        //     $username_ = $value['username_'];
        // }
        $query_string = 'foo='.$email.'&&'.$old_pass.'&&'.$new_pass.'&&'.$c_new_pass.'&&'.$username;

        echo 'usename : '. $username_;
    ?>
    <br>
    <?php echo 'New Password : '. $new_pass_; ?>
    <br>

    <?php echo '<p>Click Link below to activated the TIS Account</p>'; ?>
    <br>
    <br>
    <hr>
    <em style="font-size: 10px">
    <?php echo 'http://tis.ptkbi.com/index.php/c_tpa_01_change_password/reset_password_validation?'.$query_string ;
        echo '<br>';

    ?>
    </em>
    <hr>
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