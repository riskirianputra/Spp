<!DOCTYPE html>
    <html moznomarginboxes mozdisallowselectionprint> 
    <?php 

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "adm";

        $koneksi = mysqli_connect($host,$user,$password,$database);
        include '../../config/Config.php';
        $page       = "";
        $menu       = "Transaksi";
        $submenu    = "";
        $config = new Config();

        include "hak-akses.php";

        if($koneksi->connect_error)
        {
            die("Koneksi gagal");
        }


        //proses jika sudah klik tombol pencarian data
        if(isset($_POST['cetak']))
        {
        //menangkap nilai form
            $tanggal_a=$_POST['tanggal_a'];
            $tanggal_b=$_POST['tanggal_b'];
            if(empty($tanggal_a) || empty($tanggal_b))
            {
            //jika data tanggal kosong
        
            }
            else
            {
    
                $sql = "SELECT * FROM tbl_transaksi t, tbl_siswa s, tbl_pegawai p, tbl_pembayaran pn, tbl_kelas k WHERE t.waktu_transaksi BETWEEN '$tanggal_a' AND '$tanggal_b' AND t.id_siswa = s.id_siswa AND t.id_pegawai = p.id_pegawai AND t.id_pembayaran = pn.id_pembayaran AND t.id_kelas = k.id_kelas ORDER BY t.id_transaksi DESC";
                $query=mysqli_query($koneksi, $sql);
        // die($sql);
                // var_dump($query); die();
            }
        ?>        
            <head>
                <title>Cetak Laporan Sesuai Tanggal</title>
                <link rel="icon" href="../../assets/man2.jpg">
                <style>
                #watermark { position: absolute; bottom: 0px; right: 155px; width: 60%; top: 0px; opacity: .1; }
                @page { margin: 5mm; top: 100px; }
                img{ text-align: center; } table {
                border-collapse: collapse;
                }
                body {
                font-family: "Arial";
                font-size:10;
                width:99%;
                height:100%;
                }
                .responsive {
                  width: auto;
                  height: auto;
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
                .pagenum:before {
                content: counter(page);
                }
                table{
                    font-size:10px;
                }
                th {
                height: 10px;
                }
                .bagiansetengah{
                    width:50%;
                    float:left;
                    margin:0px;
                    padding:0px;
                }
                .tes{
                    width:95%;
                    position:center;
                    float:left;
                    padding:10px;
                    border:1px;
                    border-style:dashed;
                    border-color:#000;
                }
                hr.new4 {
                     border: 2px solid black;
                }
                .tes2{
                    width:46%;
                    position:relative;
                    float:right;
                    padding:10px;
                    border:1px;
                    border-style:dashed;
                    border-color:#000;
                }
                </style>

            </head>
        <body onload="window.print()">
            
                <div class="container">
                    <div class="tes">
                        <!-- <div id="watermark">
                            <img src="../../assets/man2.jpg"   class="responsive">
                        </div> -->
                        
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
                        <table width="100%" border="1" cellpadding="5">
                            <tr>
                                <th align="center">No</th>
                                <th align="center">Waktu</th>
                                <th align="center">Siswa</th>
                                <th align="center">Kelas</th>
                                <th align="center">Pembayaran</th>
                                <th align="center">Metode</th>
                                <th align="center">Nominal</th>            
                            </tr>
                <?php 
                $i=1;
                $total = 0;
                while($r = mysqli_fetch_array($query))
                {
                    // echo $r['id_transaksi']; die();
                    // var_dump($r); die();
                    $kelas=$config->format_romawi($r['tingkat_kelas']);
                    $total += $r['nominal_transaksi'];
                                ?>
                    <tr>
                        <td align="center"><?= $i; ?></td>
                        <td align="center"><?php echo date("d-m-Y ", strtotime(ucfirst($r['waktu_transaksi']))) ?></td>
                        <td align="center"><?php echo ucfirst($r['nama_siswa']) ?></td>
                        <td align="center"><?php echo $kelas." - ".ucfirst($r['nama_kelas']) ?></td>
                        <td align="center"><?php echo ucfirst($r['nama_pembayaran']) ?></td>
                        <?php
                            if($r['file_foto']<>'0') {
                            ?>
                            <td><?php echo $r['pembayaran_melalui'] ?></td>
                            <?php
                                } else {
                            ?>
                                <td><?php echo $r['pembayaran_melalui']?></td>
                            <?php
                                }
                            ?>

                            <td><?php echo $config->format_rupiah($r['nominal_transaksi']) ?></td>
                        </tr>

                        
                <?php
                    $i++;
                } 
                ?>
                        <tr>
                            <td colspan="6" align="right">Total :</td>
                            <td colspan=""><?php echo $config->format_rupiah($total)?></td>
                        </tr>
        
                </tbody>
            </table>
            <br>
            <br>
            <br><br>

            <table width="90%" style="margin-top:-25px;">
                <tr>
                    <td align="center">
                       Mengetahui, <br>
                        Kepala Madrasah
                    </td>
                    <td align="center">
                   Ketua Komite
                    </td>
                     <td align="center">Bendahara</td>
                </tr>

                <tr>
                    <td align="center">
                        <br/><br/><br/><br/><br/><br/>
                        Sahidin 
                    </td>
                    <td align="center">
                        <br/><br/><br/><br/><br/><br/>
                        Zuhirman, S.Pd
                        <br/>   
                    </td>
                    <td align="center">
                        <br/><br/><br/><br/><br/><br/>
                      Delminar
                    </td>

                </tr>

                
            </table>
        </div>
                        
        </div>
    </body>
</html>

<?php
     }
 

        else {
            unset($_POST['pencarian']);
        }


        ?>




        

