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
		
        $_sql 	= "SELECT nik,nama FROM pegawai where id='$id'";
        $hasil	=bukaquery($_sql);
        $baris 	= mysql_fetch_row($hasil); 
		$nik	=$baris[0];
		$nama	=$baris[1];
		
        $_sql = "select tindakan.tgl,
                        tindakan.id,
                        tindakan.tnd,
                        master_tindakan.nama,
                        tindakan.jm,
                        tindakan.nm_pasien,
                        tindakan.kamar,
                        tindakan.diagnosa,
                        tindakan.jmlh
                        from tindakan inner join master_tindakan
                        where tindakan.tnd=master_tindakan.id and tindakan.id='$id'
			    and tgl like '%".$tahun."-".$bulan."%' ORDER BY tgl ";
        $hasil=bukaquery($_sql);
        $jumlah=mysql_num_rows($hasil);
		$ttljm=0;
        if(mysql_num_rows($hasil)!=0) {
            echo "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='tbl_form'>
                    <caption><h3 class=title><font color='999999'>Laporan Tindakan Dokter ".$nik." ".$nama."<br>Tahun ".$tahun." Bulan ".$bulan."</font></h3><br>
					</caption>
                    <tr class='head'>
                        <td width='20%'><div align='center'><font size='2' face='Verdana'><strong>Jmlh.Tindakan</strong></font></div></td>
                        <td width='50%'><div align='center'><font size='2' face='Verdana'><strong>Nama Tindakan</strong></font></div></td>
                        <td width='30%'><div align='center'><font size='2' face='Verdana'><strong>JM Tindakan</strong></font></div></td>
                    </tr>";
                    while($baris = mysql_fetch_array($hasil)) {
					   $ttljm=$ttljm+$baris[4];
                        echo "<tr class='isi'>
                                <td>$baris[8]&nbsp;</td>
                                <td>$baris[3]&nbsp;</td>
                                <td>".formatDuit($baris[4])."&nbsp;</td>
                             </tr>";
                    }
            echo "</table>";
			echo "<br><font color='999999' size='3'><b>Jumlah Total JM : ".formatDuit($ttljm)."</b></font>";
        } 
    ?>
    </body>
</html>