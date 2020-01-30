<!-- <section> -->
    <footer style="position: fixed; width: 65%" class="container">
        <div class="row">
            <div class="col-lg-7">
                <!-- <strong class="text-center">Divisi Teknologi Informasi &copy; 2019 &nbsp; &nbsp; &nbsp;<a href="http://www.ptkbi.com" style="color: #4269f5"> PT Kliring Berjangka Indonesia (Persero)</a>. -->
                <strong class="text-center">Copyright &copy; 2019 Tin Exchange System. All Rights Reserved. &nbsp;</strong>
            </div>
            <div class="col-lg-4">
                    <p class="text-right"><b>Version</b> 1.0</p>
            </div>
        </div>        
    </footer>
</section>
         <script type="text/javascript">
            $(document).ready(function(){
              $("#usr_cm").change(function(){
                    var str = document.getElementById('usr_cm').value;
                   var alphanumericRGEX = '/^[a-zA-Z0-9]*$';
                   var strtest = alphanumericRGEX.test(str);
                   alert(strtest);
              });
            });

             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
