<div class="t">
<div class="b">
<div class="l">
<div class="r">
<div class="bl">
<div class="br">
<div class="tl">
<div class="tr">
<div class="y">

<?php
   $_sql         = "SELECT * FROM set_tahun";
   $hasil        = bukaquery($_sql);
   $baris        = mysql_fetch_row($hasil);
   $tahun         = $baris[0];
   $bulan          = $baris[1];
?>

<div id="post">
    <h1 class="title">::[ Input Pendapatan Tahun <?php echo$tahun ;?> Bulan <?php echo$bulan ;?> ]::</h1>
    <div align="center" class="link">
        <a href=?act=ListInsentif>| List Insentif |</a>
    </div>  
    <div class="entry">
        <form name="frm_pelatihan" onsubmit="return validasiIsi();" method="post" action="" enctype=multipart/form-data>
            <?php
                echo "";
                $action      =$_GET['action'];
                $pendapatan     =str_replace("_"," ",$_GET['pendapatan']);
                if($action == "TAMBAH"){
                    $pendapatan      = str_replace("_"," ",$_GET['pendapatan']);
                    $persen      = "";
					$total_insentif="";
                }else if($action == "UBAH"){
                    $_sql         = "SELECT pendapatan,persen FROM set_insentif WHERE tahun='$tahun' and bulan='$bulan'";
                    $hasil        = bukaquery($_sql);
                    $baris        = mysql_fetch_row($hasil);
                    $pendapatan         = $baris[0];
                    $persen          = $baris[1];
					$total_insentif=$baris[2];
                }
                echo"<input type=hidden name=pendapatan value=$pendapatan><input type=hidden name=action value=$action>";
            ?>
            <table width="100%" align="center">
                <tr class="head">
                    <td width="31%" >Pendapatan</td><td width="">:</td>
                    <td width="67%">Rp.<input name="pendapatan" class="text" onkeydown="setDefault(this, document.getElementById('MsgIsi1'));" type=text id="TxtIsi1" class="inputbox" value="<?php echo $pendapatan;?>" size="30" maxlength="15">
                    <span id="MsgIsi1" style="color:#CC0000; font-size:10px;"></span>
                    </td>
                </tr>
                <tr class="head">
                    <td width="31%" >Prosentase Insentif</td><td width="">:</td>
                    <td width="67%"><input name="persen" class="text" onkeydown="setDefault(this, document.getElementById('MsgIsi2'));" type=text id="TxtIsi2" class="inputbox" value="<?php echo $persen;?>" size="10" maxlength="6" />%
                    <span id="MsgIsi2" style="color:#CC0000; font-size:10px;"></span>
                    </td>
                </tr>
            </table>
            <div align="center"><input name=BtnSimpan type=submit class="button" value="SIMPAN">&nbsp<input name=BtnKosong type=reset class="button" value="KOSONG"></div><br>
            <?php
                $BtnSimpan=$_POST['BtnSimpan'];
			
				$_sql         = "SELECT * FROM set_tahun";
				$hasil        = bukaquery($_sql);
				$baris        = mysql_fetch_row($hasil);
				$tahun         = $baris[0];
				$bulan          = $baris[1];

                if (isset($BtnSimpan)) {
                    $pendapatan    = trim($_POST['pendapatan']);
                    $persen    = trim($_POST['persen']);
					$total_insentif=($persen/100)*$pendapatan;
                    if ((!empty($pendapatan))&&(!empty($persen))) {
                        switch($_GET['action']) {
                            case "TAMBAH":
                                Tambah(" set_insentif ","'$tahun','$bulan','$pendapatan','$persen','$total_insentif' ", " Pendapatan " );
                                echo"<html><head><title></title><meta http-equiv='refresh' content='1;URL=?act=InputInsentif&action=TAMBAH'></head><body></body></html>";
                                break;
                            case "UBAH":
                                Ubah(" set_insentif ","pendapatan='$pendapatan',persen='$persen',total_insentif='$total_insentif' WHERE tahun='$tahun' and bulan='$bulan'  ", " Pendapatan ");
                                echo"<html><head><title></title><meta http-equiv='refresh' content='2;URL=?act=ListInsentif'></head><body></body></html>";
                                break;
                        }
                    }else if ((empty($pendapatan))||(empty($persen))){
                        echo '<b>Semua field harus isi..!!</b>';
                    }
                }
            ?>
        </form>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>