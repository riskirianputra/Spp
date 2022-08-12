<?php
    include '../../config/Config.php';
    $page       = "Laporan Pembayaran";
    $menu       = "Laporan Pembayaran";
    $submenu    = "Laporan";
    $config = new Config();
    include "hak-akses.php";
    
    if(($_GET['id_kelas']<>'all') OR ($_GET['aktif_siswa']<>'all') OR ($_GET['angkatan_siswa']) OR ($_GET['tingkat_kelas']<>'all')) {

        $where = " WHERE";
        
    }

    else {
        $where = "";
    }

    

    if($_GET['id_kelas']=='all') {
        $id_kelas = "";
    }
    else {
        $id_kelas = " AND tbl_siswa.id_kelas='" . $_GET['id_kelas'] . "'";
    }

    

    if($_GET['aktif_siswa']=='all') {
        $aktif_siswa = "";
    }
    else {
        $aktif_siswa = " AND tbl_siswa.aktif_siswa='" . $_GET['aktif_siswa'] . "'";
    }

    if($_GET['angkatan_siswa']=='all') {
        $angkatan_siswa = "";
    }
    else {
        $angkatan_siswa = " AND tbl_siswa.angkatan_siswa='" . $_GET['angkatan_siswa'] . "'";
    }

    if($_GET['tingkat_kelas']=='all') {
        $tingkat_kelas = "";
    }
    else {
        $tingkat_kelas = " AND tbl_kelas.tingkat_kelas='" . $_GET['tingkat_kelas'] . "'";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cetak <?= $page; ?></title>
         <link rel="icon" href="../../assets/man2.jpg">
        <style>
        #watermark { position: absolute; bottom: 0px; right: 155px; width: 60%; top: 0px; opacity: .1; }
       @page { margin: 5mm; top: 100px; }
                img{ text-align: center; } table {
                border-collapse: collapse;
                }
        body {
        font-family: "Arial";
                font-size:5;
                width:99%;
                height:100%;
                }
        .header, .footer {
        width: 100%;
        text-align: right;
        position: fixed;
        }
        .footer2 {
        width: 100%;
        text-align: left;
        position: fixed;
        }
        .header {
        top: 0px;
        }
        .footer {
        bottom: 0px;
        }
        .footer2 {
        bottom: 0px;
        }
         table{
        font-size:10px;
        }
        th {
        height: 10px;
        }
         hr.new4 {
        border: 2px solid black;
        }
        .pagenum:before {
        content: counter(page);
        }

       
        </style>

    </head>

    <body onload="window.print()">
        <?php
        $html ='
      
        <div class="footer">
            
        </div>
        <div class="footer2"><i>Dicetak pada : '.  date("d-m-Y H:i:s").'</i></div>
        <div class="">
            <img src="../../assets/man2.jpg" height="80" width="80" align="left">
        </div>
        <div class="" >
                            <h3 style="margin:0px;" align="CENTER">PENGURUS KOMITE <br>
                                MADRASAH ALIYAH NEGERI 2 PAYAKUMBUH<br>                               
                            </h3>
                        </div>
                        <div class="" align="center" >
                            <h5 style="margin:0px;" align="CENTER">Jalan Soekarno Hatta Kelurahan Balai Nan Duo Kecamatan Payakumbuh barat <br>
                            </h5>
                             <h5 style="margin: 0px;" align="center"> &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; Website : man2kotapayakumbuh.sch.id Email : mandua_pyk@yahoo.com <br></h5>
                              <h5 style="margin: 0px;" align="center"> &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; Kode Pos : 26224 Telepon (0752) 92152<br>
                            </h5>
                        </div>                      
                        <hr class="new4">
                        <div style="clear:both;"></div>
                        
                        <div style="clear:both;"></div>
        <br>

        
        <table border="1" align="center" width="100%" cellpadding="10">
            <thead>
                <tr>
                    <th><center>NIS</center></th>
                    <th><center>Nama</center></th>
                    <th><center>Kelas</center></th>
                    <th><center>Nama Pembayaran</center></th>
                    <th><center>Total Pembayaran</center></th>
                    <th><center>Sisa Pembayaran</center></th>
                    <th><center>Status</center></th>
                </tr>
            </thead>
            <tbody>';


        if($_GET['id_pembayaran_isedentil']=='all') {
            $pembayaran = $config->getData("SELECT * FROM tbl_pembayaran_isedentil"); 
        } else {
            $pembayaran = $config->getData("SELECT * FROM tbl_pembayaran_isedentil WHERE id_pembayaran_isedentil='". $_GET['id_pembayaran_isedentil'] ."'");
        }

        foreach ($pembayaran as $p) {
            $id_kelas_pembayaran = $config->clean_json($p['id_kelas']);
            $query = "SELECT * FROM tbl_siswa INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas  $where tbl_siswa.foto_siswa <> 'sdjhashahsghdvhhdbagusgantengamatbshdhavhs' $id_kelas  $aktif_siswa $angkatan_siswa $tingkat_kelas  AND tbl_siswa.id_kelas IN (". $id_kelas_pembayaran .") "; 
            $result = $config->getData($query);
            foreach ($result as $r) {
                $transaksi = $config->getData("SELECT * FROM tbl_transaksi_isedentil WHERE id_siswa='". $r['id_siswa'] ."' AND id_pembayaran_isedentil='". $p['id_pembayaran_isedentil'] ."' GROUP BY id_pembayaran_isedentil");

                if(!empty($transaksi)) {
                    foreach ($transaksi as $t) {
                        $kurang = $config->getData("SELECT SUM(nominal_transaksi) as nominal FROM tbl_transaksi_isedentil WHERE id_siswa='". $r['id_siswa'] ."' AND id_pembayaran_isedentil='". $p['id_pembayaran_isedentil'] ."'");
                        foreach ($kurang as $k) {
                            $nilai_pembayaran = $p['nominal_pembayaran'];
                            $sisa_pembayaran = $nilai_pembayaran  - $k['nominal'];
                            if ($sisa_pembayaran<=0) {
                               $keterangan_pembayaran = "LUNAS";
                            } 
                            else if($sisa_pembayaran>0) {
                                $keterangan_pembayaran = "BELUM LUNAS";
                            }

                            if(($_GET['status_lunas']==$keterangan_pembayaran) OR ($_GET['status_lunas']=='all')){

                $html .= '
                <tr>
                    <td>' . ucfirst($r['nis']) . '</td>
                    <td>' . ucfirst($r['nama_siswa']) . '</td>
                    <td>' . $config->format_romawi(ucfirst($r['tingkat_kelas'])) . " " . ucfirst($r['nama_kelas']) . '</td>
                   
                    <td>' . ucfirst($p['nama_pembayaran']). '</td>
                    <td>' . $config->format_rupiah($k['nominal']) . '</td>
                    <td>' . $config->format_rupiah($sisa_pembayaran) . '</td>
                    <td>' . $keterangan_pembayaran . '</td>
                </tr>
                ';
                            }
                       }
                    }
                }
                else {
                    if(($_GET['status_lunas']<>'LUNAS')){
            $html .= '
                <tr>
                    <td>' . ucfirst($r['nis']) . '</td>
                    <td>' . ucfirst($r['nama_siswa']) . '</td>
                    <td>' . $config->format_romawi(ucfirst($r['tingkat_kelas'])). " " . ucfirst($r['nama_kelas']) . '</td>
                   
                    <td>' . ucfirst($p['nama_pembayaran']). '</td>
                    <td>Rp. 0</td>
                    <td>'. $config->format_rupiah(ucfirst($p['nominal_pembayaran'])) .'</td>
                    <td>BELUM LUNAS</td>
                </tr>';
                    }
                }
            }
        }
            $html .='
            </tbody>
        </table>
        </center>';

        echo $html;
        ?>
    </body>
    
</html>
