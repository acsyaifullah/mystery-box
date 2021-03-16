
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
  <style type="text/css">
    .imghadiah {
      width : 150px!important;
      height: 150px!important;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body id="showHadiah">
  <div class="container-scroller">
    <!-- partial:<?php echo base_url(); ?>/assets/partials/_horizontal-navbar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     
      <!-- partial -->
      <div class="main-panel">

        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Daftar Hadiah 
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#AddHadiah">Tambah Hadiah</button>
              </h4>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>Nama Hadiah</th>
                          <th>Kuota</th>
                          <th>Gambar</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no = 1;
                        foreach ($hadiah as $value) { 
                      ?>
                      <tr>
                          <td><?php echo $no++ ?></td>
                          <td>
                            <?php 
                              if ($value->jumlah > 0) {
                                echo $value->nama_hadiah;
                              } else {
                                echo $value->nama_hadiah." <p style='color:red; font-weight: bold'>(Habis)</p>";
                              }
                            ?>
                          </td>
                          <td><?php echo $value->jumlah ?></td>
                          <td><img class="imghadiah" src="<?php echo base_url('/assets/images/hadiah/'.$value->gambar); ?>"></td>
                          <td>
                            <a style="color: black" class="btn btn-warning upd" data-toggle="modal" data-target="#updHadiah"
                            data-idhadiah="<?php echo $value->idhadiah; ?>"
                            data-namahadiah="<?php echo $value->nama_hadiah; ?>"
                            data-jumlah="<?php echo $value->jumlah; ?>"
                            data-gambar="<?php echo $value->gambar; ?>">
                            Ubah</a>
                            <a style="color: black" href="<?php echo base_url('C_Mysterybox/delHadiahMG/'.$value->idhadiah); ?>" class="btn btn-danger">Hapus</a>
                          </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:<?php echo base_url(); ?>/assets/partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021 <a style="color: #ff7474" href="https://www.emdeeclinic.com" target="_blank">The Emdee Skin Clinic</a>.</span>
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
  <script src="<?php echo base_url(); ?>/assets/js/data-table.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/file-upload.js"></script>
  <!-- End custom js for this page-->

  <!-- START MODAL ADD HADIAH -->
  <div class="modal modal-success fade" id="AddHadiah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">TAMBAH HADIAH</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formAddHadiah">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <label>Nama Produk</label>
                <input type="text" class="form-control" name="nama_hadiah" id="nama_hadiah" required>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-12">
                <label>Kuota (hanya angka)</label>
                <input type="text" class="form-control" name="jumlah" id="jumlah" required>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-12">
                <label>Gambar Hadiah</label>
                <input type="file" name="gambar" id="gambar" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-default" type="button">Browse</button>
                  </span>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="submit">Submit</button>
        </div>
        </form>      
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- END MODAL ADD HADIAH -->

  <!-- START MODAL UBAH HADIAH -->
  <div class="modal fade" id="updHadiah" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">UBAH HADIAH</h4>
              </div>
              <form id="formUpdHadiah">
              <div class="modal-body">
                    <input type="hidden" name="idpaket" class="idhadiah">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Nama Hadiah</label>
                          <input type="text" class="form-control nama_hadiah" id="nama_hadiah" name="nama_hadiah">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Kuota</label>
                          <input type="text" class="form-control jumlah" id="jumlah" name="jumlah">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label class="control-label">Gambar</label>
                        <div class="form-group">
                          <img class="gambar" width="200px">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label>Gambar Hadiah</label>
                        <input type="file" name="gambar" id="gambar" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-default" type="button">Browse</button>
                          </span>
                        </div>
                      </div>
                    </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Simpan</button>
                  <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
              </div>
              </form>
          </div>
      </div>
  </div>
  <!-- END MODAL UBAH HADIAH -->

  <script type="text/javascript">
    $(document).ready(function(){
      // AJAX ADD HADIAH
      $('#formAddHadiah').submit(function(e) {
          e.preventDefault();
          $.ajax({
              url         : '<?php echo base_url('C_Mysterybox/addHadiahMG') ?>',
              type        : 'POST',
              data        : new FormData(this),
              processData : false,
              contentType : false,
              cache       : false,
              async       : false,        
              success     : function(data) {
                  $('#showHadiah').html(data);
                  $('#addHadiah').modal('hide');
                  $('.form-control').val("");
              }
          });
      });
    });
  </script>

</body>

</html>
