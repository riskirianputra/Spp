<?php
    include '../../config/Config.php';
    $page       = "Laporan Pembayaran";
    $menu       = "Laporan Pembayaran";
    $submenu    = "Laporan";
    $config = new Config();
    include "hak-akses.php";
    $query = "SELECT * FROM tbl_transaksi t, tbl_siswa s, tbl_pegawai p, tbl_pembayaran pn, tbl_kelas k WHERE t.id_siswa = s.id_siswa AND t.id_pegawai = p.id_pegawai AND t.id_pembayaran = pn.id_pembayaran AND t.id_kelas = k.id_kelas ORDER BY t.id_transaksi DESC";
    $result = $config->getData($query);  


// Jika Sudah Login
if(!empty($_SESSION['kodeakses'])) {   
    include "../../layout/header.php";    
?>      
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="<?= $base_url; ?>">Home</a></li>
        <li><?= $submenu; ?></li>    
        <li class="active"><?= $page; ?></li>
    </ul>
    <!-- END BREADCRUMB -->    

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">                
<div class="modal-body">
                <form action="lap_per_tanggal.php" method="post" target="blank">
                    <div class="form-group">
                        <table  width="500px">
                            <tr>
                                <td>
                                    <div class="form-group">Dari Tanggal</div>
                                </td>
                                <td align="center">
                                    <div class="form-group">     &nbsp;: &nbsp;</div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" id="example-date-input" class="form-control" name="tanggal_a" required="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">Sampai Tanggal</div>
                                </td>
                                <td align="center">
                                    <div class="form-group">&nbsp;:&nbsp;</div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="tanggal_b" required="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    &nbsp;<input type="submit" name="cetak" class="btn btn-primary btn-sm" value="CETAK">
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>              
            </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Riwayat <?= $page; ?></h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body table-responsive">
                        <table id="#example" class="ui celled table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th><center>Waktu</center></th>
                                    <th><center>Siswa</center></th>
                                    <th><center>Kelas</center></th>
                                    <th><center>Pembayaran</center></th>
                                    <th><center>Metode</center></th>
                                    <th><center>Nominal</center></th>
                                    <th><center>Opsi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i=1;
                                    foreach ($result as $r) {
                                    $kelas=$config->format_romawi($r['tingkat_kelas']);
                                ?>

                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= date("d-m-Y", strtotime(ucfirst($r['waktu_transaksi']))); ?></td>
                                    <td><?= ucfirst($r['nama_siswa']); ?></td>
                                    <td><?= $kelas." - ".ucfirst($r['nama_kelas']); ?></td>
                                    <td><?= ucfirst($r['nama_pembayaran']); ?></td>
                                    <?php
                                        if($r['file_foto']<>'0') {
                                    ?>
                                    <td><a href="<?= $base_url . 'assets/img/bukti_pembayaran/' . $r['file_foto']; ?>" target='_blank' ><?= $r['pembayaran_melalui']; ?></a></td>
                                    <?php
                                        } else {
                                    ?>
                                        <td><?= $r['pembayaran_melalui']; ?></td>
                                    <?php
                                        }
                                    ?>

                                    <td><?= $config->format_rupiah($r['nominal_transaksi']); ?></td>
                                    <td align="center">
                                    <?php 
                                        $enidtransaksi1=base64_encode($r['id_transaksi']);
                                        $enidtransaksi2=base64_encode($enidtransaksi1);
                                        $enidtransaksi3=base64_encode($enidtransaksi2);
                                        
                                        $enidsiswa1=base64_encode($r['id_siswa']);
                                        $enidsiswa2=base64_encode($enidsiswa1);
                                        $enidsiswa3=base64_encode($enidsiswa2);
                                        

                                        $enidkelas=base64_encode(base64_encode(base64_encode($r['id_kelas'])));

                                        $enidpembayaran1=base64_encode($r['id_pembayaran']);
                                        $enidpembayaran2=base64_encode($enidpembayaran1);
                                        $enidpembayaran3=base64_encode($enidpembayaran2);
                                        
                                        $encicilan1=base64_encode($r['cicilan_transaksi']);
                                        $encicilan2=base64_encode($encicilan1);
                                        $encicilan3=base64_encode($encicilan2);
                                    ?>
                                        <a href="cetak.php?id=<?= $enidtransaksi3; ?>&siswa=<?= $enidsiswa3; ?>&pembayaran=<?= $enidpembayaran3; ?>&cicilan=<?= $encicilan3; ?>&id_kelas=<?= $enidkelas; ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i></a>
                                    </td>
                                </tr>

                                <?php
                                    $i++;
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                        
    </div>
    <!-- PAGE CONTENT WRAPPER -->
<?php
    include "../../layout/footer.php";
} else {
    header("Location:" . $base_url . "login.php");
}

?>

