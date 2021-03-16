<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Emdee Mystery Gift</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>
  <style type="text/css">
    .swal2-title {
      font-size: 15px!important;
    }
    .swal2-content {
      font-size: 25px!important;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:assets/partials/_horizontal-navbar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:assets/partials/_settings-panel.html -->
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row" style="margin-top: 25px;">

            <?php 
              foreach ($hadiah as $value) { 
                // for ($i=1; $i <= $value['jumlah'] ; $i++) { 
                //   if ($i <= $value['jumlah']) {
            ?>
            
            <div class="col-md-3 col-sm-6 grid-margin">
              <div class="card" style="min-height: 287px">
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                      <div class="wrapper text-center">
                        <!-- <h4 class="card-title">Pilih Mystery Gift !</h4> -->
                        <p class="card-description"><img src="<?php echo base_url(); ?>/assets/images/hadiah/mb.png" width="150px" id="mb<?php echo $value['idhadiah'] ?>"></p>
                        <input type="hidden" class="idhadiah" value="<?php echo $value['idhadiah'] ?>">
                        <span id="span<?php echo $value['idhadiah'] ?>"><button class="btn btn-outline-danger" onclick="suwal('<?php echo $value['idhadiah'] ?>')" id="btn<?php echo $value['idhadiah'] ?>">Buka Box !</button></span>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>

            <?php 
              }
            // }} 
            ?>
            
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:assets/partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021 <a style="color: #ff7474" href="<?php echo base_url(); ?>/C_Mysterybox/listHadiahSPM">The Emdee Skin Clinic</a>.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made seriously with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  

  <script type="text/javascript">
      function suwal(id) {
        $.ajax({
            method  : 'POST',
            dataType: 'json',
            data    : {id : id},
            url     : "<?php echo base_url('C_Mysterybox/getHadiahSPM'); ?>",
            success : function(prize) {
              if (prize.jumlah > 0) {
                Swal.fire({
                  title: 'Selamat Emdeers, kamu dapat ...',
                  text: prize.nama_hadiah,
                  imageUrl: '<?php echo base_url(); ?>/assets/images/hadiah/'+prize.gambar,
                  imageWidth: 250,
                  imageHeight: 250,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $("#mb"+prize.idhadiah).attr('src','<?php echo base_url(); ?>/assets/images/hadiah/'+prize.gambar);
                    $("#btn"+prize.idhadiah).hide();
                    $("#span"+prize.idhadiah).append('<h4>'+prize.nama_hadiah+'</h4>');
                  }
                });
              } else {
                Swal.fire({
                  title: 'Yaah, Hadiah ini habis ...',
                  text: prize.nama_hadiah,
                  imageUrl: '<?php echo base_url(); ?>/assets/images/hadiah/mb.png',
                  imageWidth: 250,
                  imageHeight: 250,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $("#mb"+prize.idhadiah).attr('src','<?php echo base_url(); ?>/assets/images/hadiah/mb.png');
                    $("#btn"+prize.idhadiah).hide();
                    $("#span"+prize.idhadiah).append('<h4>Hadiah ini habis</h4>');
                  }
                });
              }
            }
        });
      }
  </script>
  <!-- plugins:js -->
  <script src="<?php echo base_url(); ?>/assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url(); ?>/assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url(); ?>/assets/js/alerts.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/avgrund.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
