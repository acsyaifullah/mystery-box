<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Emdee Fortune Cookie</title>
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
    .card {
      min-height: 287px;
      border: none;
      background-color: transparent;
    }
    .page-body-wrapper {
       background-color: transparent!important;
    }
    body {
      background: url("<?php echo base_url(); ?>/assets/images/hadiah/background.jpg") no-repeat center center fixed;
      /*background: url("https://i.gifer.com/U57E.gif") no-repeat center center fixed;*/
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
    .bg-trans {
      border : none;
      background: none;
      background-color: transparent!important;
      border-color: transparent!important;
      outline: none!important;
    }
    h4 {
     /*font-family: "Brittany Signature";*/
     /*font-weight: 450;*/
     /*font-size: 30px;*/
     line-height: 1.4em;
     color: white;
    }
    #swal2-content {
      /*font-family: "Brittany Signature";*/
      font-size: 20px;
      /*color: orange;*/
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
        <div align="center" style="padding-top: 0px">
          <a href="<?php echo base_url(); ?>/C_Mysterybox/listHadiahBLT" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
        <div class="content-wrapper" style="padding-top: 220px;">
          <div class="row">

            <?php 
              foreach ($hadiah as $key => $value) { 
                $randRow = rand(0,9999); 
                // for ($i=1; $i <= $value['jumlah'] ; $i++) { 
                //   if ($i <= $value['jumlah']) {
            ?>
            
            <div class="col-md-4 col-sm-6 grid-margin row<?php echo $randRow ?>">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                      <div class="wrapper text-center">
                        <!-- <h4 class="card-title">Pilih Mystery Gift !</h4> -->
                        <p class="card-description"><img src="" width="250px" id="mb<?php echo $randRow ?>"></p>
                        <!-- kalau mau beda2 gambar depan -->
                        <!-- <span id="span<?php echo $randRow ?>"><button class="btn bg-trans" onclick="suwal('<?php echo $value['idhadiah'] ?>', '<?php echo $randRow ?>')" id="btn<?php echo $randRow ?>"><img src="<?php echo base_url(); ?>/assets/images/hadiah/planet<?= $key ?>.png" width="250px" id="mb<?php echo $randRow ?>"></button></span> -->
                        <!-- end kalau mau beda2 gambar depan -->
                        <span id="span<?php echo $randRow ?>"><button class="btn bg-trans" onclick="suwal('<?php echo $value['idhadiah'] ?>', '<?php echo $randRow ?>')" id="btn<?php echo $randRow ?>"><img src="<?php echo base_url(); ?>/assets/images/hadiah/BLT/Closed.png" width="320px" id="mb<?php echo $randRow ?>"></button></span>
                        <!-- <p class="card-description"><img src="<?php echo base_url(); ?>/assets/images/hadiah/mb.png" width="250px" id="mb<?php echo $randRow ?>"></p> -->
                        <input type="hidden" class="idhadiah" value="<?php echo $value['idhadiah'] ?>">
                        <!-- <span id="span<?php echo $randRow ?>"><button class="btn btn-outline-danger" onclick="suwal('<?php echo $value['idhadiah'] ?>', '<?php echo $randRow ?>')" id="btn<?php echo $randRow ?>">Buka Box !</button></span> -->
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
        <!-- <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021 <a style="color: #ff7474" href="<?php echo base_url(); ?>/C_Mysterybox/listHadiahMG">The Emdee Skin Clinic</a>.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made seriously with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer> -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <script type="text/javascript">      
      function swlinfo() {
        Swal.fire({
          title: 'Kuota kesempatan ...',
          // text: "gambar aja disini",
          imageUrl: '<?php echo base_url(); ?>/assets/images/hadiah/kuota.png',
          imageWidth: 381,
          imageHeight: 381,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Tutup'
        })
      }

      function suwal(id, randRow) {
        $.ajax({
            method  : 'POST',
            dataType: 'json',
            data    : {id : id},
            url     : "<?php echo base_url('C_Mysterybox/getHadiahBLT'); ?>",
            success : function(prize) {
              if (prize.status == 1) {
                  if (prize.data.idhadiah!=16 && prize.data.jumlah > 0) {
                    Swal.fire({
                      // title: 'Selamat Emdeers, kamu dapat ...',
                      // text: prize.data.nama_hadiah,
                      imageUrl: '<?php echo base_url(); ?>/assets/images/hadiah/BLT/'+prize.data.gambar,
                      imageWidth: 320,
                      imageHeight: 320,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Tutup'
                    }).then(function(){ 
                        location.reload();
                        // $(".loader").show(); //loader aja
                    // then((result) => {
                    //   if (result.isConfirmed) {
                    //     $("#mb"+randRow).attr('src','<?php echo base_url(); ?>/assets/images/hadiah/'+prize.data.gambar);
                    //     $("#btn"+randRow).hide();
                    //     // $("#span"+randRow).append('<h4>'+prize.data.nama_hadiah+'</h4>');
                    //   }
                    });
                    minKuota(prize.data.idhadiah);
                    console.log(randRow);
                  } else if(prize.data.idhadiah==16 && prize.data.jumlah > 0) {
                    Swal.fire({
                      // title: 'Sayang sekali, ',
                      // text: prize.data.nama_hadiah,
                      imageUrl: '<?php echo base_url(); ?>/assets/images/hadiah/BLT/'+prize.data.gambar,
                      imageWidth: 320,
                      imageHeight: 320,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Tutup'
                    }).then(function(){
                        location.reload();
                        // $(".loader").show(); //loader aja
                    // then((result) => {
                    //   if (result.isConfirmed) {
                    //     $("#mb"+randRow).attr('src','<?php echo base_url(); ?>/assets/images/hadiah/'+prize.data.gambar);
                    //     $("#btn"+randRow).hide();
                    //     // $("#span"+randRow).append('<h4>'+prize.data.nama_hadiah+'</h4>');
                    //   }
                    });
                    minKuota(prize.data.idhadiah);
                  } else {
                    Swal.fire({
                      // title: 'Sayang sekali, disini kosong ...',
                      // text: prize.nama_hadiah,
                      imageUrl: '<?php echo base_url(); ?>/assets/images/hadiah/BLT/sorry.png',
                      imageWidth: 320,
                      imageHeight: 320,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Tutup'
                    }).then(function(){ 
                        location.reload();
                        // $(".loader").show(); // loader aja
                    // then((result) => {
                    //   if (result.isConfirmed) {
                    //     $("#mb"+randRow).attr('src','<?php echo base_url(); ?>/assets/images/hadiah/sorry.png');
                    //     $("#btn"+randRow).hide();
                    //     // $("#span"+randRow).append('<h4>Sorry ..</h4>');
                    //   }
                    });
                  }
              }else{
                Swal.fire({
                      // title: 'Sayang sekali, disini kosong ...',
                      // text: prize.nama_hadiah,
                      imageUrl: '<?php echo base_url(); ?>/assets/images/hadiah/BLT/sorry.png',
                      imageWidth: 320,
                      imageHeight: 320,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Tutup'
                    }).then(function(){ 
                        location.reload();
                        // $(".loader").show(); // loader aja
                    // then((result) => {
                    //   if (result.isConfirmed) {
                    //     $("#mb"+randRow).attr('src','<?php echo base_url(); ?>/assets/images/hadiah/sorry.png');
                    //     $("#btn"+randRow).hide();
                    //     // $("#span"+randRow).append('<h4>Sorry ..</h4>');
                    //   }
                    });
              }
              
            }
        });

        // Swal.fire({
        //   title: 'Yeay, kamu dapat ...',
        //   text: 'Calmiderm Mask',
        //   imageUrl: '<?php echo base_url(); ?>/assets/images/hadiah/calmiderm-mask.jpg',
        //   imageWidth: 250,
        //   imageHeight: 250,
        //   confirmButtonColor: '#3085d6',
        //   confirmButtonText: 'Ok'
        // }).then((result) => {
        //   if (result.isConfirmed) {
        //     $("#mb1").attr('src','<?php echo base_url(); ?>/assets/images/hadiah/calmiderm-mask.jpg');
        //     $("#btn1").hide();
        //     $("#span1").append('<h4>Calmiderm Mask</h4>');
        //   }
        // });
      }

      function minKuota(id) {
        var id = id;
        $.ajax({
          method  : 'POST',
          data    : {id:id},
          url     : "<?php echo base_url('C_Mysterybox/minKuotaBLT'); ?>"
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
