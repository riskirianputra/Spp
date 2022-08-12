<?php
    include '../../config/Config.php';
    $page       = "Laporan Isedentil";
    $menu       = "Laporan Isedentil";
    $submenu    = "Laporan";
    $config = new Config();
    include "hak-akses.php";
    

    if (($_POST['id_kelas']<>'all') OR ($_POST['aktif_siswa']<>'all') OR ($_POST['angkatan_siswa']) OR ($_POST['tingkat_kelas']<>'all')) {

        $where = " WHERE";
        
    }

    else {
        $where = "";
    }

    if($_POST['id_kelas']=='all') {
        $id_kelas = "";
    }
    else {
        $id_kelas = " AND tbl_siswa.id_kelas='" . $_POST['id_kelas'] . "'";
    }

   

    if($_POST['aktif_siswa']=='all') {
        $aktif_siswa = "";
    }
    else {
        $aktif_siswa = " AND tbl_siswa.aktif_siswa='" . $_POST['aktif_siswa'] . "'";
    }

    if($_POST['angkatan_siswa']=='all') {
        $angkatan_siswa = "";
    }
    else {
        $angkatan_siswa = " AND tbl_siswa.angkatan_siswa='" . $_POST['angkatan_siswa'] . "'";
    }

    if($_POST['tingkat_kelas']=='all') {
        $tingkat_kelas = "";
    }
    else {
        $tingkat_kelas = " AND tbl_kelas.tingkat_kelas='" . $_POST['tingkat_kelas'] . "'";
    }

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

        <div class="row">
            <div class="col-md-12">
                <?= @$_SESSION['status']; 
                    unset($_SESSION['status']);
                ?>
                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">                                
                        <h3 class="panel-title">Data <?= $page; ?></h3>

                        <div class="btn-group pull-right">
                            
                                <li><a href="cetak.php?tingkat_kelas=<?= $_POST['tingkat_kelas']; ?>&id_kelas=<?= $_POST['id_kelas']; ?>&angkatan_siswa=<?= $_POST['angkatan_siswa']; ?>&id_pembayaran_isedentil=<?= $_POST['id_pembayaran_isedentil']; ?>&aktif_siswa=<?= $_POST['aktif_siswa']; ?>&status_lunas=<?= $_POST['status_lunas']; ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak</a>
                                </li>
                            
                        </div>

                                                       
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table datatable" id="pembayaran">
                            <thead>
                                <tr>
                                    
                                    <th><center>Nama</center></th>
                                    <th><center>Kelas</center></th>
                                    <th><center>Angkatan</center></th>
                                    <th><center>Nama Pembayaran</center></th>
                                    <th><center>Total Pembayaran</center></th>
                                    <th><center>Sisa Pembayaran</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            <tbody>
                
    <?php
        if($_POST['id_pembayaran_isedentil']=='all') {
            $pembayaran = $config->getData("SELECT * FROM tbl_pembayaran_isedentil"); 
        } else {
            $pembayaran = $config->getData("SELECT * FROM tbl_pembayaran_isedentil WHERE id_pembayaran_isedentil='". $_POST['id_pembayaran_isedentil'] ."'");
        }

        foreach ($pembayaran as $p) {
            $id_kelas_pembayaran = $config->clean_json($p['id_kelas']);
            $query = "SELECT * FROM tbl_siswa INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas $where tbl_siswa.foto_siswa <> 'sdjhashahsghdvhhdbagusgantengamatbshdhavhs' $id_kelas  $aktif_siswa $angkatan_siswa $tingkat_kelas AND tbl_siswa.id_kelas IN (". $id_kelas_pembayaran .") "; 
            $result = $config->getData($query);
            foreach ($result as $r) {
                $transaksi = $config->getData("SELECT * FROM tbl_transaksi_isedentil WHERE id_siswa='". $r['id_siswa'] ."' AND id_pembayaran_isedentil='". $p['id_pembayaran_isedentil'] ."' GROUP BY id_pembayaran_isedentil");

                if(!empty($transaksi)) {
                    foreach ($transaksi as $t) {
                        $kurang = $config->getData("SELECT SUM(nominal_transaksi) as nominal FROM tbl_transaksi_isedentil WHERE id_siswa='". $r['id_siswa'] ."' AND id_kelas='". $r['id_kelas'] ."' AND id_pembayaran_isedentil='". $p['id_pembayaran_isedentil'] ."'");
                        foreach ($kurang as $k) {
                            $nilai_pembayaran = $p['nominal_pembayaran'];
                            $sisa_pembayaran = $nilai_pembayaran  - $k['nominal'];
                            if ($sisa_pembayaran<=0) {
                               $keterangan_pembayaran = "LUNAS";
                            } 
                            else if($sisa_pembayaran>0) {
                                $keterangan_pembayaran = "BELUM LUNAS";
                            }

                            if(($_POST['status_lunas']==$keterangan_pembayaran) OR ($_POST['status_lunas']=='all')){
                
    ?>

    <tr >
        
        <td><?= ucfirst($r['nama_siswa']); ?></td>
        <td align="center"><?= $config->format_romawi(ucfirst($r['tingkat_kelas'])); ?> <?= ucfirst($r['nama_kelas']); ?></td>
        <td align="center"><?= ucfirst($r['angkatan_siswa']); ?></td>
        <td align="center"><?= ucfirst($p['nama_pembayaran']); ?> (<?= $config->format_rupiah(ucfirst($p['nominal_pembayaran'])); ?>)</td>
        <td align="center"><?= $config->format_rupiah($k['nominal']); ?></td>
        <td align="center"><?= $config->format_rupiah($sisa_pembayaran); ?></td>
        <td align="center"><?= $keterangan_pembayaran; ?></td>
    </tr>

    <?php
                            }
                        }
                    }
                }
                else {

                   if(($_POST['status_lunas']<>'LUNAS')){
    ?>

    <tr>
        
        <td><?= ucfirst($r['nama_siswa']); ?></td>
        <td align="center"><?= $config->format_romawi(ucfirst($r['tingkat_kelas'])); ?> <?= ucfirst($r['nama_kelas']); ?></td>
        <td align="center"><?= ucfirst($r['angkatan_siswa']); ?></td>
        <td align="center"><?= ucfirst($p['nama_pembayaran']); ?> (<?= $config->format_rupiah(ucfirst($p['nominal_pembayaran'])); ?>)</td>
        <td align="center">Rp. 0</td>
        <td align="center"><?= $config->format_rupiah(ucfirst($p['nominal_pembayaran'])); ?></td>
        <td align="center">BELUM LUNAS</td>
    </tr>

    <?php 
                    }
                }
            }
        }
    ?>
                                





                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END DEFAULT DATATABLE -->
            </div>
        </div>                                
        
    </div>
    <!-- PAGE CONTENT WRAPPER -->

<?php
    include "../../layout/footer.php";
} else {
    header("Location:" . $base_url . "login.php");
}

?>