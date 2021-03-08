<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spinwheel - Emdee Clinic</title>
  <!-- plugins:css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
      <!-- <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
      <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css"> -->
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url(); ?>/assets/fav.png"/>

  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/spinwheel.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/jquery-3.1.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css">
      .the_wheel
      {
          background : url(<?php echo base_url(); ?>/assets/wheel_back.png) no-repeat;
          background-position : center;
      }
      @media only screen and (min-width: 767px) {
        .btnSpin {
          padding-top: 325px;
        }
      }
      .page-body-wrapper {
         background-color: transparent;!important;
      }
      body {
        background: url("<?php echo base_url(); ?>/assets/reg-bg.png") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
  </style>

</head>

<body>
  <div class="container-scroller">
    <!-- partial:../partials/_horizontal-navbar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../partials/_settings-panel.html -->
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">					
					
					<div class="row">
						
						<div class="col-md-6 col-sm-12 grid-margin stretch-card" style="margin-left: -75px;">
							<div class="card text-center" style="background-color: transparent!important; border: 0px!important">
								<div class="card-body" style="margin: -35.5px 0;">
									
                  <!-- PUT HERE -->
                  <table cellspacing="0" border="0" cellpadding="0">
                      <tr>
                          <td width="520" height="565" class="the_wheel" align="center" valign="center">
                            <a href="javascript:void(0);" onClick="theWheel.stopAnimation(false); theWheel.rotationAngle=0; theWheel.draw(); bigButton.disabled=false;">&nbsp;&nbsp;&nbsp;</a>
                              <canvas id="canvas" class="tutCanvas" width="550" height="515">Canvas not supported</canvas>
                          </td>
                      </tr>
                  </table>
                  <!-- END HERE -->

								</div>
							</div>
						</div>

            <div class="col-md-6 col-sm-12 grid-margin stretch-card" style="margin-left: 75px">
              <div class="card text-center" style="background-color: transparent!important; border: 0px!important">
                <div class="card-body">
                  
                  <!-- PUT HERE -->
                  <table cellspacing="0" border="0" cellpadding="0">
                      <tr>
                          <td width="25%" class="btnSpin">
                              <button class="btn btn-rounded btn-danger" id='bigButton' class='bigButton' onClick="calculatePrize(); this.disabled=true;" style="margin-left: 40px">Spin sekarang !</button>
                          </td>
                      </tr>
                  </table>
                  <!-- END HERE -->

                </div>
              </div>
            </div>
						
					</div>
					
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <script type="text/javascript">
    // $(document).ready(function(){
    	var theWheel;
    	// var calcualtePrize;
  		$.ajax({
  			method	: 'GET',
  			dataType: 'json',
  			url		  : "<?php echo base_url('C_Spinwheel/getHadiah'); ?>",
  			success	: function(prize) {
  				theWheel = new Winwheel({
			          'numSegments'       : 5,                 // Specify number of segments.
			          'outerRadius'       : 200,               // Set outer radius so wheel fits inside the background.
			          'drawText'          : true,              // Code drawn text can be used with segment images.
			          'textFontSize'      : 16,
			          'centerY'           : 265,
			          'textOrientation'   : 'curved',
			          'textAlignment'     : 'inner',
			          'textMargin'        : 90,
			          'textFontFamily'    : 'monospace',
			          'textStrokeStyle'   : 'black',
			          'textLineWidth'     : 3,
			          'textFillStyle'     : 'white',
			          'drawMode'          : 'segmentImage',    // Must be segmentImage to draw wheel using one image per segemnt.
			          'animation' :
			          {
			              'type'          : 'spinToStop',
			              'duration'      : 5,
			              'spins'         : 5,
			              'callbackFinished' : alertPrize
			          },
			          'segments'          : prize                // Define segments including image and text.
			      });
  				// console.log(prize.caption)
  			}
  		});	

      function calculatePrize()
      {
          var winWheel;
          let stopAt = 0
          do {
              stopAt = Math.floor((Math.random() * 359))
          }
          while (stopAt > 70 && stopAt < 145) // untuk 1 hadiah yang ditolak
          // while ((stopAt > 90 && stopAt < 135) || (stopAt > 315 && stopAt < 360)) // untuk 2 hadiah yang ditolak
          // while (stopAt > 360) // untuk bebas hadiah manapun

          theWheel.animation.stopAngle = stopAt;
          theWheel.startAnimation();
      }

      function alertPrize(indicatedSegment)
      {
          swal("Selamat!", "Kamu dapat " + indicatedSegment.caption, "warning");
          // alert("Selamat, kamu dapat " + indicatedSegment.caption);
          var idhadiah = indicatedSegment.idhadiah;
          $.ajax({
            url     : '<?php echo base_url('C_Spinwheel/winPrize') ?>',
            method  : 'POST',
            data    : { idhadiah : idhadiah},
            success : function(e) {
                console.log(e);
            }
          }); 
      }


   	// });
  </script>
  
</body>

</html>
