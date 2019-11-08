<?php

require_once('db_login.php');
//require_once('fungsi.php');
require_once('koneksi.php');
//include_once("fungsi.php");
//include_once("dbconfig.php");
//include_once("koneksi.php");

//$id = $_SESSION['id_user'];

$act = $_GET['act'];
if (empty($act)) {
    $act = $_POST['act'];
}
switch ($act) {
    case 'simpan_anggota_baru':
        $arr = array(",", "-", "/", ":");
        $nik       = $_POST['nik'];
        $nama      = $_POST['nama'];
        $tgl_lahir      = $_POST['tgl_lahir'];
        $alamat      = $_POST['alamat'];
        $jenkel      = $_POST['jenkel'];

        $query_cek = "SELECT * FROM anggota where nik='$nik'";
        $result_cek = $koneksi->query($query_cek);
        $count = mysqli_num_rows($result_cek);
        if ($count > 0) {
            echo "99";
        } else {



            $query1 = "INSERT INTO anggota (nik, nama, tgl_lahir, jenkel, alamat) VALUES ('" . $nik . "','" . $nama . "','" . $tgl_lahir . "','" . $jenkel . "','" . $alamat . "')";

            $result1 = $koneksi->query($query1);
            if (!$result1) {
                echo "0";
            } else {
                echo "1";
            }
        }

        break;
    case 'edit_anggota_baru':
        $arr = array(",", "-", "/", ":");
        $id_anggota       = $_POST['id_anggota'];
        $nik       = $_POST['nik'];
        $nama      = $_POST['nama'];
        $tgl_lahir      = $_POST['tgl_lahir'];
        $alamat      = $_POST['alamat'];
        $jenkel      = $_POST['jenkel'];


        $query1 = "UPDATE anggota SET nik='" . $nik . "', nama='" . $nama . "',jenkel='" . $jenkel . "', tgl_lahir='" . $tgl_lahir . "', alamat='" . $alamat . "' WHERE id_anggota=" . $id_anggota . "";

        $result1 = $koneksi->query($query1);
        if (!$result1) {
            echo "0";
        } else {
            echo "1";
        }


        break;
    case 'upload_foto_anggota':
     $id_anggota = $_GET['id_anggota'];
     $namafoto = $_GET['jenis'];
     $idfile = $_GET['idfoto'];

     $query1 = "
     SELECT * from anggota where id_anggota='$id_anggota'
     ";
     $result1 = mysqli_query($koneksi, $query1);
    if (!$result1) {
        die("Could not query the database: <br />" . mysqli_error($koneksi));
    }
    $data = $result1->fetch_object();  

     // $exec_file=mssql_query($query1);
     // $data=mssql_fetch_assoc($exec_file);


     $namafile="Foto_".$id_anggota."_".$namafoto.".jpg";
     // echo  $namafile;
     $file_lama1=$data->foto;
     // echo $idfile;
        if (!empty($_FILES[$idfile]["tmp_name"])) {
                //$namafolder="/var/www/html/sismaf/lampiranbooking/";
                $namafolder="uploaded/";
                $jenis_gambar=$_FILES[$idfile]['type'];
                $nama_file=$_FILES[$idfile]['name'];
                $ukuran=$_FILES[$idfile]['size'];
                $link="http://localhost/siskop/public";
                $size=round($ukuran/1000000,2);
                // echo $namafolder;
                $typefile=strtoupper(substr($nama_file,-3));
                  if($typefile=="JPG") {
                    if($file_lama1==''){
                    }else {
                      unlink("$link/uploaded/$file_lama1");
                    }
                    $gambar = $namafolder.basename($namafile);
                    if (move_uploaded_file($_FILES[$idfile]['tmp_name'], $gambar)) {
                      //echo $nama_file;
                      // insert ke data base
                          $sql_cek="SELECT * FROM anggota WHERE id_anggota='$id_anggota'";
                          
                          $result_cek = mysqli_query($koneksi, $sql_cek);
                        if (!$result_cek) {
                            die("Could not query the database: <br />" . mysqli_error($koneksi));
                        }
                        $row_cek = $result_cek->fetch_object();  

                          $count = mysqli_num_rows($result_cek);
                            // echo $sql_cek;
                          if ($count>0) {
                            $update="UPDATE anggota set
                              foto='$namafile'
                              where id_anggota='$id_anggota'";
                          $res_update = mysqli_query($koneksi, $update);
                          // echo $update;
                          }else{
                              
                          }
                      // end insert      
                      echo "1";                                     

                     } else
                     {
                        ?>
                        <script type="text/javascript">
                          alert("1. Upload File Gagal, File harus PDF dan Maksimal Ukuran <?php echo $maks;?> Mb \n-Size :<?php echo $size;?> Mb\n-Jenis:<?php echo $typefile;?>");
                          <?php echo "Gagal unggah foto"; ?>
                        </script>
                      <?php
                  //   $redir  = "$halaman?dataid=$dataid&cabang=$Branchid";
                  //   redirMeta($redir);
                    return false;
                  }
                }else { ?>

                        <script type="text/javascript">
                          alert("2. Upload File Gagal, File harus PDF dan Maksimal Ukuran <?php echo $maks;?> Mb \n-Size :<?php echo $size;?> Mb\n-Jenis:<?php echo $typefile;?>");
                        </script>

                      <?php
                    //$redir  = "$halaman?dataid=$dataid&cabang=$Branchid";
                    //redirMeta($redir);
                   return false;

                    }
              }else{
                $unik2="";
              }
    
    // alert("Upload Sukses Ya");
    echo "1";
    break;
}
