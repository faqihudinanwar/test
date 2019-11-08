<?php
require_once("koneksi.php");
if (!isset($_SESSION)) {
    session_start();
}
$id_anggota = $_GET['id'];
require_once('db_login.php');
$db =  new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno) {
    die("could not connect to the database : <br/>" . $db->connect_error);
}
if ($id_anggota == '') { } else {


    $query02 = "SELECT * FROM anggota where id_anggota='$id_anggota'";
    // Execute the query
    $result02 = mysqli_query($koneksi, $query02);
    if (!$result02) {
        die("Could not query the database: <br />" . mysqli_error($koneksi));
    }
    //fetch and display the result
    while ($row_02 = $result02->fetch_object()) {
        $id_anggota        = $row_02->id_anggota;
        $nik               = $row_02->nik;
        $nama              = $row_02->nama;
        $tgl_lahir         = $row_02->tgl_lahir;
        $jenkel            = $row_02->jenkel;
        $alamat            = $row_02->alamat;
    }
}
include('layout.php');
?>
<style>
    .form_style {
        width: 58%;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    div.upload {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        display: inline-block;
        padding: 3px 40px 3px 3px;
        position: relative;
        width: auto;
    }

    div.upload:hover {
        opacity: 0.95;
    }

    div.upload input[type="file"] {
        display: inline-block;
        width: 100%;
        opacity: 0;
        cursor: pointer;
        position: absolute;
        left: 0;
        font-size: 11px;
    }

    div.upload input[type="button"] {
        font-size: 11px;
    }

    .fileName {
        font-family: Arial;
        font-size: 14px;
    }

    .upload+.uploadButton {
        height: auto;
    }
    .stylefoto{
      position: relative;
      float: left;
      width: 100%;
    }

    #foto_trf{
        width: 500px;
        height: 200px;
      }

 .fileUpload {
          position: relative;
          overflow: hidden;
          margin-bottom: 10px;
          height: 30px;
          padding: auto;
      }
      .fileUpload input.upload {
          position: absolute;
          top: 0;
          right: 0;
          margin: 0;
          padding: 0;
          font-size: 20px;
          cursor: pointer;
          opacity: 0;
          filter: alpha(opacity=0);
      }
      #butt_foto_trf{
        height: 40px;
      }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Koperasi Simpan Pinjam Mitra Usaha</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Data Anggota">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">.</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Foto Anggota Koperasi</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!---->
                        <!-- =============== -->
                        <div class="stylefoto" >
                          <div class="panel-body">
                      <?php
                        //assign a query
                        $query = "SELECT * FROM anggota where id_anggota='$id_anggota'";
                        // Execute the query
                        // echo  $query;
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                            die("Could not query the database: <br />" . mysqli_error($koneksi));
                        }
                        $row = $result->fetch_object();                        
                      ?>
                          
                        <form action="" method="post" name="up_dokfoto" id="up_dokfoto" enctype='multipart/form-data'>
                           <div class="col-md-3" style="width: 100%; height: 75%;">
                              <input type="hidden" name="id_anggota" id="id_anggota" value="<?php echo $row->id_anggota ?>"/>
                              <input type="hidden" name="namafile1" id="namafile1" value="<?php echo $row->nik; ?>"/>

                                <?php
                                  if($row->foto == "" || $row->foto == " "){
                                    $foto = "images/no_image_cam.png";
                                    $text_foto="Pilih Foto";
                                  }
                                  else{
                                    $foto = "uploaded/".$row->foto;
                                    $text_foto="Ubah Foto";
                                  }
                                  //echo $foto;
                                  $hostname="http://localhost/siskop/public";

                                 ?>
                                 <div class="" style="margin-bottom: 5px;">
                                   <img src="<?php echo $hostname."/".$foto; ?>" alt="Profile" id="foto_trf" name="foto_trf" class="img-thumbnail foto">
                                 </div>
                                 <strong style="font-size: 15px; margin-left: 80px;">Foto Anggota</strong>

                                 <div class="fileUpload btn btn-primary btn-block" style="font-size: 12px; padding: 3px;">
                                     <input type="file" name="profil" id="profil" class="upload" accept="image/jpeg" onchange="getImagetrf(this);">
                                     <i class="icon-upload2" id="butt_pilih_trf"> </i> <span id="text_trf" style="font-size: 12px;"><?php echo $text_foto; ?></span>
                                 </div>
                                 <div style="font-size: 12px;">
                                    <input type="submit" value="Upload" id="butt_foto_trf" disabled class="fileUpload btn button -krem center btn-block" />
                                 </div>                                
                              </div>
                            </form>
                          
                            </div>
                          </div>
                      <!-- =============== -->
                        <?php include('footer.php'); ?>
                        <!--
                  </div>
                </div>
              </div>
            </div>
         page content -->

                        </body>
    <script type="text/javascript">
  function getImagetrf(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#foto_trf')
                  .attr('src', e.target.result)
                  .width(500)
                  .height(200);
                  $("#butt_foto_trf").prop('disabled',false);
                  $("#butt_foto_trf").removeClass('btn -krem').addClass('btn -darkphoenix');
                  $("#text_trf").remove();
                  $("#butt_pilih_trf").html('<span id="text_trf" style="font-size: 12px; font-style: normal;"> Ubah Foto</span>');

          };

          reader.readAsDataURL(input.files[0]);
      }
  }

   $("#up_dokfoto").submit(function(e){
        var form        = $('#up_dokfoto')[0];
        var ds          = new FormData(form);
        var fototrf      = 'profil';
        var id_anggota       = $("#id_anggota").val();
        var namafile    = $("#namafile1").val();
        

        $.ajax({
            url: "script.php?act=upload_foto_anggota&id_anggota="+id_anggota+"&jenis="+namafile+"&idfoto="+fototrf,
            type: "POST",
            // dataType: "JSON",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: ds,
            cache: false,

            success: function(data){
             if (data==0) {
              alert("Upload Foto Gagal");
             }else{
              $("#butt_foto_trf").prop('disabled',true);
              alert("Upload Foto Berhasil");
              window.location.href = "http://localhost/siskop/public/data_anggota.php";
             }
            }
          });

        e.preventDefault();
      });
      </script>

                        </html>