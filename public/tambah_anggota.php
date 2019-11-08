<?php
require_once("koneksi.php");
if (!isset($_SESSION)) {
    session_start();
}
$id_anggota = $_GET['id'];
$sts = $_GET['sts'];
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
                        <input type="text" class="form-control" placeholder="Tambah Data Anggota">
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
                        <h2>Form Tambah Data Anggota Koperasi </h2>
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
                        <form class="" action="" id="form_tambah" method="post" enctype="multipart/form-data">

                            <div>
                                <label class="control-label  col-sm-3 col-xs-12" for="nik">NIK <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <input name="nik" type="text" autofocus id="nik" required="required" value="<?php if ($id_anggota == '') { } else {
                                                                                                                    echo $nik;
                                                                                                                } ?>" placeholder='Masukkan NIK' class="form-control col-md-7 col-xs-12 form_style">
                                    <input name="id_anggota" type="hidden" value="<?php echo $id_anggota ?>" class="form-control col-md-7 col-xs-12 form_style">
                                    <td><span class="error"></span></td>
                                </div>
                            </div>
                            <div>
                                <label class="control-label  col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <input name="nama" type="text" autofocus id="nama" required="required" value="<?php if ($id_anggota == '') { } else {
                                                                                                                        echo $nama;
                                                                                                                    } ?>" placeholder='Masukkan Nama' class="form-control col-md-7 col-xs-12 form_style">
                                    <td><span class="error"></span></td>
                                </div>
                            </div>
                            <div>
                                <label for="jenkel" class="control-label  col-sm-3 col-xs-12">jenis kelamin</label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <select name="jenkel" id="jenkel" required onChange="showUser(this.value)" class="form-control" style="width:58%; margin-top: 10px; margin-bottom: 10px; form_style">
                                        <option value="none">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" <?php if ($id_anggota == '') { } else {
                                                                        echo ($jenkel == 'laki-laki') ? 'selected' : '';
                                                                    } ?>>Laki-Laki</option>
                                        <option value="perempuan" <?php if ($id_anggota == '') { } else {
                                                                        echo ($jenkel == 'perempuan') ? 'selected' : '';
                                                                    } ?>>Perempuan</option>

                                    </select>
                                    <td><span class="error"></span></td>
                                </div>
                            </div>
                            <div>
                                <label class="control-label col-sm-3 col-xs-12" for="tgl_lahir">Tanggal Lahir <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <input name="tgl_lahir" type="date" autofocus id="tgl_lahir" value="<?php if ($id_anggota == '') { } else {
                                                                                                            echo $tgl_lahir;
                                                                                                        } ?>" required="required" placeholder='Masukkan Tanggal Lahir' class="form-control col-md-7 col-xs-12 form_style">
                                    <td><span class="error"></span></td>
                                </div>
                            </div>
                            <div>
                                <label class="control-label  col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <textarea name="alamat" type="textmessage" autofocus id="alamat" required="required" placeholder='Masukkan Alamat Anggota' class="form-control col-md-7 col-xs-12"><?php if ($id_anggota == '') { } else {
                                                                                                                                                                                                            echo $alamat;
                                                                                                                                                                                                        } ?></textarea>
                                    <td><span class="error"></span></td>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <?php if ($sts == 'edit') {
                                        ?>
                                        <button class="btn btn-sm btn-success" type="submit" id="Edit" onclick="return confirm('Apakah Data Sudah Benar?');" value="Edit" name="edit">Edit</button>
                                    <?php
                                    } else {
                                        ?>
                                        <button class="btn btn-sm btn-success" type="submit" id="simpan" onclick="return confirm('Apakah Data Sudah Benar?');" value="Simpan" name="simpan">Simpan</button>
                                    <?php
                                    } ?>

                                </div>
                            </div>

                        </form>
                        <?php include('footer.php'); ?>
                        <!--
                  </div>
                </div>
              </div>
            </div>
         page content -->

                        </body>
                        <script type="text/javascript">
                            $(document).ready(function() {

                                var defaultButton;
                                $("#form_tambah button[type='submit']").click(function() {
                                    defaultButton = this.value;
                                    if (defaultButton == 'Simpan') {
                                        $("#form_tambah input").attr("required", true);
                                    }
                                });

                                $("#form_tambah").submit(function(e) {

                                    if (defaultButton == 'Simpan') {
                                        $.ajax({
                                            url: "script.php?act=simpan_anggota_baru",
                                            type: "POST",
                                            // dataType: "JSON",
                                            data: $("#form_tambah").serialize(),
                                            cache: false,
                                            success: function(data) {
                                                if (data == 1) {
                                                    alert("Data Berhasil Disimpan."); {
                                                        window.location.href = "http://localhost/siskop/public/data_anggota.php";
                                                    }
                                                } else if (data == 0) {
                                                    alert("Data GAGAL Disimpan.");
                                                } else {
                                                    alert("Nik Sudah Ada");
                                                }
                                            }
                                        });
                                        e.preventDefault();
                                    } else if (defaultButton == 'Edit') {
                                        $.ajax({
                                            url: "script.php?act=edit_anggota_baru",
                                            type: "POST",
                                            // dataType: "JSON",
                                            data: $("#form_tambah").serialize(),
                                            cache: false,
                                            success: function(data) {
                                                if (data == 1) {
                                                    alert("Data Berhasil Disimpan."); {
                                                        window.location.href = "http://localhost/siskop/public/data_anggota.php";
                                                    }
                                                } else {
                                                    alert("Data GAGAL Disimpan.");
                                                }
                                            }
                                        });
                                    }
                                    e.preventDefault();
                                });

                            });
                        </script>

                        </html>