<?php
 include '../../conf/conf.php';
?>
<html>
    <head>
        <link href="../../css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
   <?php
        $_sql         = "SELECT * FROM set_tahun";
        $hasil        = bukaquery($_sql);
        $baris        = mysql_fetch_row($hasil);
        $tahun         = $baris[0];
        $bln_leng=strlen($baris[1]);
        $bulan="0";
        if ($bln_leng==1){
                $bulan="0".$baris[1];
        }else{
		$bulan=$baris[1];
        }
        $id     =$_GET['id'];
        
        $_sqlc = "SELECT nik,nama FROM pegawai where id='$id'";
        $hasilc=bukaquery($_sqlc);
        $barisc = mysql_fetch_row($hasilc);
        
        $_sql = "SELECT tgl,id,jns,lembur
                from presensi where id='$id'
		and tgl like '%".$tahun."-".$bulan."%' ORDER BY tgl ASC ";
        $hasil=bukaquery($_sql);
        $jumlah=mysql_num_rows($hasil);
        $ttllembur=0;
        $ttlhr=0;
        
        if(mysql_num_rows($hasil)!=0) {
                    echo "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='tbl_form'>
                            <caption><h3 class=title><font color='999999'>Laporan Lembur ".$barisc[0]." ".$barisc[1]."<br>Tahun ".$tahun." Bulan ".$bulan."</font></h3></caption>
                            <tr class='head'>
                                <td width='90px'><div align='center'><font size='2' face='Verdana'><strong>Tgl.Lembur</strong></font></div></td>
                                <td width='110px'><div align='center'><font size='2' face='Verdana'><strong>Jns Lembur</strong></font></div></td>
                                <td width='110px'><div align='center'><font size='2' face='Verdana'><strong>Lembur</strong></font></div></td>
                            </tr>";
                    while($baris = mysql_fetch_array($hasil)) {
                        if($baris[2]=='HB'){
                            $ttllembur=$ttllembur+$baris[3];
                        }
                        if($baris[2]=='HR'){
                            $ttlhr=$ttlhr+$baris[3];
                        }
                      echo "<tr class='isi'>
                                <td>$baris[0]&nbsp;</td>
                                <td>$baris[2]&nbsp;</td>
                                <td>$baris[3] Jam &nbsp;</td>
                           </tr>";
                    }
                echo "</table>";
                echo "<br><font color='999999' size='3'><b>Ttl.Lembur HB : ".$ttllembur." , Ttl.Lembur HR : ".$ttlhr." </b></font>";
            } 
    ?>
    </body>
</html>