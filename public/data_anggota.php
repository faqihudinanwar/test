<?php
include('layout.php');
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Anggota Koperasi Mitra Usaha</small></h3>
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
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Anggota</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></a>
                        </li>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons-new" class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th style="width: 70px;">
                                    <center>NIK</center>
                                </th>
                                <th>
                                    <center>Nama</center>
                                </th>
                                <th style="width: 100px;">
                                    <center>Jenis Kelamin</center>
                                </th>
                                <th>
                                    <center>Tanggal Lahir</center>
                                </th>
                                <th style="width: 100px;">
                                    <center>Alamat</center>
                                </th>
                                <th>
                                    <center>Foto</center>
                                </th>
                                <th>
                                    <center>Ubah</center>
                                </th>
                                <th>
                                    <center>Hapus</center>
                                </th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            //connect database
                            require_once('db_login.php');
                            $db = new mysqli($db_host, $db_username, $db_password, $db_database);
                            if ($db->connect_errno) {
                                die("Could not connect to database: <br/>" . $db->connect_errno);
                            }
                            //assign a query
                            $query = "SELECT * FROM anggota";
                            // Execute the query
                            $result = mysqli_query($koneksi, $query);
                            if (!$result) {
                                die("Could not query the database: <br />" . mysqli_error($koneksi));
                            }
                            //fetch and display the result
                            $i = 1;
                            while ($row = $result->fetch_object()) {
                                echo '<tr>';
                                echo '<td><center>' . $i . '</center></td>';
                                echo '<td><center>' . $row->nik . '</center></td>';
                                echo '<td><left>' . $row->nama . '</center></td>';
                                echo '<td><center>' . $row->jenkel . '</center></td>';
                                $format = date('d-m-Y', strtotime($row->tgl_lahir));
                                echo '<td><center>' . $format . '</center></td>';
                                echo '<td><left>' . $row->alamat . '</center></td>';
                                echo '<td><center><a href="upload_foto.php?id=' . $row->id_anggota . '">Lihat Foto </center></a></center></td>';
                                echo '<td><center><a href="tambah_anggota.php?sts=edit&id=' . $row->id_anggota . '">Ubah </center></a></td>';
                                echo '<td><center><a href="hapus_anggota.php?id=' . $row->id_anggota . '"onclick="return checkDelete()">Hapus </center></a></td>';
                                echo '</tr>';
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <ul>
            <i class="glyphicon glyphicon-plus"></i>
            <a href="tambah_anggota.php?sts=input&id=">Tambah Anggota</a>
            <i class="icon-angle-left"></i>
        </ul>
    </div>
    <?php include('footer.php'); ?>
</div>
<!-- Modal Popup untuk detail aktivitas-->
<div id="Modalshow_add" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<!--end modal-->


<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- Datatables -->
<script>
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#datatable-buttons-new").length) {
                $("#datatable-buttons-new").DataTable({
                    dom: "Bfrtip",
                    buttons: [

                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons();
                }
            };
        }();

        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

        TableManageButtons.init();
    });
</script>
<!-- /Datatables -->
<script type="text/javascript">
    $(document).ready(function() {

        // $("#f_input button[type='submit']").click(function(e){
        //  alert("HALO TES HALO");
        // });

        var buttonnewdefault;
        $("#f_input5 button[type='submit']").click(function(e) {
            buttonnewdefault = this.value;
            // alert("NGANU");
            if (buttonnewdefault == 'Lanjut2') {
                // alert("BISA");
                var spj_id = $("#f_input5 input[name='spj_idnew']").val();
                var tgltransaksi = $("#f_input5 input[name='tgltransaksi11']").val();
                var kep_transaksi = $("#f_input5 input[name='kep_transaksi']").val();
                var picperiksa11 = $("#myModal3 #f_input5 #t_modal5 #controls_52 .entry_1 #picperiksa11").val();
                var picperiksa22 = $("#myModal3 #f_input5 #t_modal5 #controls_52 .entry_2 #picperiksa22").val();
                var picperiksa33 = $("#myModal3 #f_input5 #t_modal5 #controls_52 .entry_3 #picperiksa33").val();
                var picperiksa44 = $("#myModal3 #f_input5 #t_modal5 #controls_52 .entry_4 #picperiksa44").val();
                var picperiksa55 = $("#myModal3 #f_input5 #t_modal5 #controls_52 .entry_5 #picperiksa55").val();
                $.ajax({
                    url: "module/finance/spj/script.php?act=simpan_pic_realisasi",
                    type: "POST",
                    dataType: "JSON",
                    // data:
                    // $("#f_input").serialize(),
                    data: {
                        spj_id: spj_id,
                        tgltransaksi: tgltransaksi,
                        kep_transaksi: kep_transaksi,
                        picperiksa11: picperiksa11,
                        picperiksa22: picperiksa22,
                        picperiksa33: picperiksa33,
                        picperiksa44: picperiksa44,
                        picperiksa55: picperiksa55
                    },
                    cache: false,
                    success: function(data) {
                        if (data == 0) {
                            alert("Data GAGAL Disimpan.");
                        } else if (data == 99) {
                            alert("Tanggal Sudah Ada");
                        } else {
                            alert("Data Berhasil Disimpan.");
                            window.location = window.location.href + "&openmodal=1&spj_aktv=" + data;
                        }
                    }
                });
                e.preventDefault();
            }
        });

        var buttonnewdefault2;
        $("#f_input52 button[type='submit']").click(function(e) {
            buttonnewdefault2 = this.value;
            // alert("NGANU");
            if (buttonnewdefault2 == 'Simpan2' || buttonnewdefault2 == 'Simpan2x') {
                // alert("BISA");
                var spj_id2 = $("#myModal52 #f_input52 #f_masuk2 #spj_id2").val();
                var spj_aktv_id = $("#myModal52 #f_input52 #f_masuk2 #spj_aktv_id").val();
                var aktivitasid2 = $("#myModal52 #f_input52 #f_masuk2 #aktivitasid2").val();
                var nominal2 = $("#myModal52 #f_input52 #f_masuk2 #nominal2").val();
                var nopol2 = $("#myModal52 #f_input52 #f_masuk2 #nopol2").val();
                // alert(aktivitasid2);
                $.ajax({
                    url: "module/finance/spj/script.php?act=simpan_realisasi_rinci",
                    type: "POST",
                    dataType: "JSON",
                    // data:
                    // $("#myModal2 #f_input2 #f_masuk2").serialize(),
                    data: {
                        spj_id2: spj_id2,
                        spj_aktv_id: spj_aktv_id,
                        aktivitasid2: aktivitasid2,
                        nominal2: nominal2,
                        nopol2: nopol2
                    },
                    cache: false,
                    success: function(data) {

                        if (data == 0) {
                            alert("Data GAGAL Disimpan.");
                        } else {
                            alert("Data Berhasil Disimpan.");
                            // $(".tab_uploadfoto").slideDown("fast");
                            {
                                window.location.href = "http://192.168.1.26/sismaf/isi.php?pid=940&sts=rlss&id=" + data;
                            }
                        }
                    }
                });
                e.preventDefault();
            }
        });

        $(".hapus_aktivitas_rls").click(function(event) {
            var idaktvitashapus = $(this).closest('tr').find('.idaktvitashapus_rls').val();
            var id_spj = $(this).closest('tr').find('.id_spj').val();
            // alert(idaktvitashapus);
            $.ajax({
                url: "module/finance/spj/script.php?act=rls_hapus_aktivitas_rinci",
                type: "POST",
                // data: $("#form_marketing").serialize(),
                data: {
                    idaktvitashapus: idaktvitashapus,
                    id_spj: id_spj
                },
                cache: false,
                success: function(data) {
                    if (data == 0) {
                        alert("Data GAGAL Dihapus.");
                    } else {
                        alert("Data Berhasil Dihapus."); {
                            window.location.href = "http://192.168.1.26/sismaf/isi.php?pid=940&sts=rlss&id=" + data;
                        }
                    }
                }
            });
            event.preventDefault();
        });

        $(".hapus_aktivitas_new").click(function(event) {
            var idaktvitasdetail = $(this).closest('tr').find('.idaktvitasdetail').val();
            var id_spj_02 = $(this).closest('tr').find('.id_spj_02').val();
            // alert(idaktvitasdetail);
            // alert(id_spj_02);
            $.ajax({
                url: "module/finance/spj/script.php?act=rls_hapus_aktivitas_peraktivitas",
                type: "POST",
                // data: $("#form_marketing").serialize(),
                data: {
                    idaktvitasdetail: idaktvitasdetail,
                    id_spj_02: id_spj_02
                },
                cache: false,
                success: function(data) {
                    if (data == 0) {
                        alert("Data GAGAL Dihapus.");
                    } else {
                        alert("Data Berhasil Dihapus."); {
                            window.location.href = "http://192.168.1.26/sismaf/isi.php?pid=940&sts=rlss&id=" + data;
                        }
                    }
                }
            });
            event.preventDefault();
        });

        $(".tambah_data_anggota").click(function(e) {
            var m = $(this).attr("id");
            // alert(m);
            $.ajax({
                url: "modal_add.php",
                type: "GET",
                data: {
                    modal_id: m,
                },
                success: function(ajaxData) {
                    //  alert(m);
                    var modal = document.getElementById('Modalshow_add');
                    $("#Modalshow_add").html(ajaxData);
                    $("#Modalshow_add").modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        });

        $(".buka_detail_rinci_realisasi").click(function(e) {
            var m = $(this).attr("id");
            // alert(m);
            $.ajax({
                url: "module/finance/spj/modal_detail_rinci_realisasi.php",
                type: "GET",
                data: {
                    modal_id: m,
                },
                success: function(ajaxData) {
                    //  alert(m);
                    var modal = document.getElementById('Modalshowdetailrinci_realisasi');
                    $("#Modalshowdetailrinci_realisasi").html(ajaxData);
                    $("#Modalshowdetailrinci_realisasi").modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        });

        var defaultButton;
        $("#realisasi_pengajuan button[type='submit']").click(function() {
            defaultButton = this.value;
        });

        $("#realisasi_pengajuan").submit(function(e) {

            if (defaultButton == 'Simpan') {
                $.ajax({
                    url: "module/finance/spj/script.php?act=simpan_realisasi",
                    type: "POST",
                    // dataType: "JSON",
                    data: $("#realisasi_pengajuan").serialize(),
                    cache: false,
                    success: function(data) {
                        if (data == 0) {
                            alert("Data GAGAL Disimpan.");
                        } else {
                            alert("Data Berhasil Disimpan."); {
                                window.location.href = "http://192.168.1.26/sismaf/isi.php?pid=940&sts=rlss&y=y&id=" + data;
                            }
                        }
                    }
                });
                e.preventDefault();
            } else if (defaultButton == 'Simpan_tanpaum') {
                $.ajax({
                    url: "module/finance/spj/script.php?act=simpan_realisasi_tanpaum",
                    type: "POST",
                    // dataType: "JSON",
                    data: $("#realisasi_pengajuan").serialize(),
                    cache: false,
                    success: function(data) {
                        if (data == 0) {
                            alert("Data GAGAL Disimpan.");
                        } else {
                            alert("Data Berhasil Disimpan."); {
                                window.location.href = "http://192.168.1.26/sismaf/isi.php?pid=940&sts=rlss&id=" + data;
                            }
                        }
                    }
                });
                e.preventDefault();
            } else if (defaultButton == 'Update') {
                $.ajax({
                    url: "module/finance/spj/script.php?act=update_realisasi",
                    type: "POST",
                    // dataType: "JSON",
                    data: $("#realisasi_pengajuan").serialize(),
                    cache: false,
                    success: function(data) {
                        if (data == 0) {
                            alert("Data GAGAL Disimpan.");
                        } else {
                            alert("Data Berhasil Disimpan."); {
                                window.location.href = "http://192.168.1.26/sismaf/isi.php?pid=940&sts=rlss&id=" + data;
                            }
                        }
                    }
                });
                e.preventDefault();
            } else if (defaultButton == 'Proceed') {
                $.ajax({
                    url: "module/finance/spj/script.php?act=update_kirim_realisasi",
                    type: "POST",
                    // dataType: "JSON",
                    data: $("#realisasi_pengajuan").serialize(),
                    cache: false,
                    success: function(data) {
                        if (data == 0) {
                            alert("Data GAGAL Disimpan.");
                        } else {
                            alert("Data Berhasil Disimpan."); {
                                window.location.href = "http://192.168.1.26/sismaf/isi.php?pid=878";
                            }
                        }
                    }
                });
                e.preventDefault();

            }
            e.preventDefault();
        });







    });
</script>
</body>

</html>