<?php session_start() ?>
<?php include_once ("dbconfig.php"); ?>
<?php include_once ("lib.inc.php"); ?>
<?php
	//date_default_timezone_set("America/Los_Angeles");
	date_default_timezone_set("Asia/Jakarta");
// COMMON FUNCTIONS

function execute($sql){
	$mq = mssql_query($sql);
	return $mq;
}

function filter($word) {
	  $word = stripslashes(trim($word));
	  $word = htmlentities($word);
	  $word = nl2br($word);
	  //$word = htmldecode($word);
	  return $word ;
}

function cekNumRow($table, $param){
	$sql ="SELECT * FROM ".$table." ".$param;
	$mq = mysql_query($sql) or die (mysql_error());
	$mnr = mysql_num_rows($mq);
	return $mnr;
}

function getValue($tbname,$field,$param){
	$sql="SELECT ".$field." FROM ".$tbname." ".$param;
	//echo $sql;
	$mq=execute($sql);
	$mfa=mysql_fetch_array($mq);
	return $mfa[$field];
}
function redirJava($location){
	?>
	<script>
		top.location="<?php echo $location?>";
	</script>
	<?php
}

function redirHeader($location){
	header("Location: ".$location);
}


function createCombo($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createComboNoAll($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createCombo2($tbname,$pkfield,$textfield,$textfield2,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield.",".$textfield2." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mysql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mysql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield2]."-".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function createCombo3($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$pilih){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=mysql_query($sql);
	if (mysql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">".$pilih."</option>";
	while ($mfa=mysql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createCombo4($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=mssql_query($sql);
	$onklik	="document.form1.submit()";
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" onChange=\"".$onklik."\">";
	$retstr .= "<option value=\"\">- PILIH -</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$vfield	= $mfa[$pkfield];
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if($selvalue == $vfield){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function createCombo6($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		//sengaja dibuat salah .. biar kosong//
	};
	return $retstr."</select>";
}
function createCombo5($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">- PILIH -</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createComboDisabled($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" onfocus=\"this.defaultIndex=this.selectedIndex;\" onchange=\"this.selectedIndex=this.defaultIndex;\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createComboDisabled2($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" disabled>";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

// END COMMON FUNCTION

// FORMATTING FUNCTIONS

function formatDate($date){
	$aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$thn = substr($date,0,4);
	$bln = substr($date,5,2);
	$bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
	$tgl = substr($date,8,2);
	$jam = substr($date,10,9);
	$date = $tgl." ".$aBulan[$bln]." ".$thn.", ".$jam." WIB";
	return $date;
}


function ceklogin()
    {
        if (isset($_SESSION["login"])) {
            $ok = true;
            return $ok;
        } else {
        }
    }
function cekadmin()
    {
        if (isset($_SESSION["userid"])) {
            $ok = true;
            return $ok;
        } else {
        }
    }
function cekuser($nik, $password){
	$result=0;
	$nikz = filter($nik);
	$passz = md5(filter($password));

			//$sql		= "SELECT nik,username,branchid,login FROM maf_user WHERE nik='".$nikz."' AND password='".$passz."' and active=1";
			$sql		= "SELECT nik,groupuserid,username,branchid,login FROM maf_user WHERE nik=replace('$nikz','-','') AND password='".$passz."' and active=1 and isnull(deletests,'0')!='1'";
			$mq			= mssql_query($sql);
			$fields		= mssql_fetch_assoc($mq);
			$count 		= mssql_num_rows($mq);

				if($count){
					$_SESSION['nik']		= $fields[nik];
					$_SESSION['username']	= $fields[username];
					$_SESSION['branchid']	= $fields[branchid];
					$_SESSION['login']		= true;
                    $_SESSION['groupuserid']= $fields[groupuserid];
						$tanggal	= date("d");
						$bulan		= date("m");
						$tahun		= date("Y");
						$time		= date("H:i:s");
						$today		= "$tahun-$bulan-$tanggal $time";
						$sql2		= "UPDATE maf_user set login='".$today."',lastlogin='".$fields[login]."' WHERE nik='".$fields[nik]."'";
						$mq2		= mssql_query($sql2);
					$result=1;
					}
		return $result;
	}
function logout($logout)
  	{
  		if (isset($logout)) {
			session_unregister("userid");
			//session_unregister("titel");
			//session_unregister("nama");
			session_destroy();
			?>
			<script>
			top.location ="index.php";
			</script>
			<?php
			}
  	}
function alert($pesan)
    {
        $alert = "\n<script language=\"javascript\">alert('$pesan');</script>";
		echo $alert;
		return $alert;
		//exit();
    }

function redirMeta($location){
		$redirMeta = "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=".$location."\">";
		echo $redirMeta;
		return $redirMeta;
		//exit();
	}

function aturhari($date)
		{
			$aturhari=substr($date,8,2)."-".substr($date,5,2)."-".substr($date,0,4);
			return $aturhari;
		}
function aturhariJam($date)
		{
			$aturhari=substr($date,8,2)."-".substr($date,5,2)."-".substr($date,0,4)." ".substr($date,11,2).":".substr($date,14,2).":".substr($date,17,2);
			return $aturhari;
		}

function pilahhari($tgl)
		{
				$dd	= substr($tgl,8,2);
				$mm	= substr($tgl,5,2);
				$yy	= substr($tgl,0,4);
				return $tgl;
		}
function hari()
        {
            include $HOST."include/lib.inc.php";
            $hari   = $days[date("D")];
            $tanggal= date("d");
            $bulan  = date("M");
            $bulan  = $month[$bulan];
            $tahun  = date("Y");
            $time   = date('h:i:s a');
            $today  = "$hari, $tanggal $bulan $tahun    $time";
						$today  = strtoupper($today);
						echo $today;
        }

function createCombox($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$default){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	//echo $sql;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">".$default."</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createCombow($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	//echo $sql;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\"> -- ALL --</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		//$retstr .= ">".$mfa[$textfield]."</option>";
		//$retstr .= ">".$mfa[$pkfield]." - ".$mfa[$textfield]."</option>";
		$retstr .= ">".$mfa[$textfield]." - ".$mfa[$pkfield]."</option>";
	};
	return $retstr."</select>";
}

function createComboUpper($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$default){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	//echo $sql;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">".$default."</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".strtoupper($mfa[$textfield])."</option>";
	};
	return $retstr."</select>";
}

function createComboz($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"%\">--- PILIH ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function checkSingleQuotes($str){
	$str = stripslashes(trim($str));
    $str = str_replace("'", "''", $str);
  	return $str;
}

function SingleQuotesToUpper($str){
	$str = strtoupper($str);
	$str = stripslashes(trim($str));
    $str = str_replace("'", "''", $str);
  	return $str;
}

function createComboReq($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$id){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$id."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function dateSQL($date){
			if($date!=''){
				$dateSQL	= substr($date,6,4)."-".substr($date,3,2)."-".substr($date,0,2);
				return $dateSQL;
			}else{
				$dateSQL	= "";
				return $dateSQL;
			}
		}

function reDateSQL($date){
			if($date!=''){
				$dateSQL	= substr($date,8,2)."/".substr($date,5,2)."/".substr($date,0,4);
				return $dateSQL;
			}else{
				$dateSQL	= "";
				return $dateSQL;
			}
		}
function dateSQLKaco($date){
//date_default_timezone_set("Asia/Jakarta");
			if($date!=''){
				$tgl	= date("d/m/Y",strtotime($date));
				if($tgl=='01/01/1970'){
					$tgl = "";
				}else if($tgl=='01/01/1900'){
					$tgl = "";
				}else{
					$tgl = $tgl;
				}
				return $tgl;
			}else{
				$tgl	= "";
				return $tgl;
			}
		}

	function dateSQLKacoMonth($date){
	//date_default_timezone_set("Asia/Jakarta");
				if($date!=''){
					$tgl	= date("m/d/Y",strtotime($date));
					if($tgl=='01/01/1970'){
						$tgl = "";
					}else if($tgl=='01/01/1900'){
						$tgl = "";
					}else{
						$tgl = $tgl;
					}
					return $tgl;
				}else{
					$tgl	= "";
					return $tgl;
				}
			}
function dateSQLKacoMin($date){
//date_default_timezone_set("Asia/Jakarta");
			if($date!=''){
				$tgl	= date("d-m-Y",strtotime($date));
				if($tgl=='01-01-1970'){
					$tgl = "";
				}else if($tgl=='01-01-1900'){
					$tgl = "";
				}else{
					$tgl = $tgl;
				}
				return $tgl;
			}else{
				$tgl	= "";
				return $tgl;
			}
		}

function dateTimeSQLKaco($date){
			//date_default_timezone_set("Asia/Jakarta");
			include $HOST."include/lib.inc.php";
			$tgl	= date("D/M/Y H:i:s A",strtotime($date));
			$tgl2	= date("d/m/Y H:i:s",strtotime($date));

            $tanggal= substr($tgl, 0,3);
            $bulan  = substr($tgl, 4,3);
			$tahun  = substr($tgl, 8,4);
			$time   = substr($tgl, 13,11);
            $tanggal2 = substr($tgl2, 0,2);

			$hari   = $days[$tanggal];
			$bulan  = $month[$bulan];

            $tampil	= "$hari, $tanggal2 $bulan $tahun. $time";
			$tampil	= strtoupper($tampil);

			return $tampil;
		}

function createRadio($idfield,$namafield,$tbname,$param,$idradio,$selvalue,$class){
	$sql	= "SELECT ".$idfield.",".$namafield." FROM ".$tbname." ".$param;
	$mq		= mssql_query($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	while ($mfa=mssql_fetch_array($mq)){
			$retstr .= "<input name=\"".$idradio."\" type=\"radio\" value=\"".$mfa[$idfield]."\" class=\"".$class."\"";
		if($selvalue == $mfa[$idfield]){
			$retstr	.= " checked";
		};
			$retstr	.= ">".$mfa[$namafield]." ";
	}
	return $retstr;
}
function createRadioDisable($idfield,$namafield,$tbname,$param,$idradio,$selvalue,$class){
	$sql	= "SELECT ".$idfield.",".$namafield." FROM ".$tbname." ".$param;
	$mq		= mssql_query($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	while ($mfa=mssql_fetch_array($mq)){
			$retstr .= "<input disabled name=\"".$idradio."\" type=\"radio\" value=\"".$mfa[$idfield]."\" class=\"".$class."\"";
		if($selvalue == $mfa[$idfield]){
			$retstr	.= " checked";
		};
			$retstr	.= ">".$mfa[$namafield]." ";
	}
	return $retstr;
}
function nik($data){
	if(isset($data)){
		$str	= substr($data, 0,5)."-".substr($data, 5,4);
	}else{
		$str	= "";
	}
	return $str;
}
function rupiah($duit){
	setlocale(LC_MONETARY, "ID");
	if(isset($duit)){
		$str	= money_format("%i", $duit);
	}else{
		$str	= "Rp.0,-";
	}
	return $str;
}

function createComboJoin($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT a.".$pkfield.",a.".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	//if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">[".$mfa[$pkfield]."] - ".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createComboJoin2($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT a.".$pkfield.",a.".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	//if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function createComboJoin_($tbname,$pkfield,$textfield1,$textfield2,$param,$idcombo,$selvalue,$class){
	$sql="SELECT a.".$pkfield.", a.".$textfield1.", c.".$textfield2." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo "<br>".$sql."<br>";
	//if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- PILIH NO FPB ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield1]." -- ".$mfa[$textfield2]."</option>";
	};
	return $retstr."</select>";
}
function createComboJoin_2($tbname,$pkfield,$textfield1,$textfield2,$param,$idcombo,$selvalue,$class){
	$sql="SELECT distinct a.".$pkfield.", a.".$textfield1.", c.".$textfield2." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo "<br>".$sql."<br>";
	//if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield2]." -- ".$mfa[$textfield1]."</option>";
	};
	return $retstr."</select>";
}
function createComboJoin3($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT a.".$pkfield.",a.".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	//if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]." - [".$mfa[$pkfield]."]"."</option>";
	};
	return $retstr."</select>";
}
// FUCNTION TO FIX PHP_INT_SIZE //
// USE THIS FUNCTION //
function bcconv($fNumber)
{
    $sAppend = '';
    $iDecimals = ini_get('precision') - floor(log10(abs($fNumber)));
    if (0 > $iDecimals)
    {
        $fNumber *= pow(10, $iDecimals);
        $sAppend = str_repeat('0', -$iDecimals);
        $iDecimals = 0;
    }
    return number_format($fNumber, $iDecimals, '.', '').$sAppend;
}
// TES RESULT //
/*
$myVal 	= "5,000,000,000";
$num 	= str_replace(',', '', $myVal);
print "<BR>".bcconv($num);
*/

function doUploadx($fileName,$fileSize,$fileType,$fileTmp,$fileRenameto,$sizeAproved,$typeAproved){
//function doUploadx($fileTmp){
	$lokasi 	= $DOCUMENTROOT."/uploadDir/";
//	$fileRenameto	= "123".".pdf";
//	$fileTmp		= move_uploaded_file ($fileTmp, "$lokasi/$fileRenameto");
//	return $fileTmp;
	 //This is our size condition
	 if ($fileSize > $sizeAproved)
	 {
		 $message	= "Your file is too large.";
		 $ok=0;
		 return $message;
	 }
	 //This is our limit file type condition
	 // php = "text/php"     //	pdf = "application/pdf" 	 // jpg	= "image/jpg"
	 if ($fileType != $typeAproved)
	 {
		$message = "Must a ".$typeAproved.".";
	 	$ok=0;
		return $message;
	 }
	 //Here we check that $ok was not set to 0 by an error
	 if ($ok==0)
	 {
	 	$message = "Sorry your file was not uploaded";
		return $message;
	}
	 //If everything is ok we try to upload it
	 else
	 {
	 	$result		= copy ($fileTmp, "$lokasi/$fileRenameto");
		$message	= ($result)?"Success uploaded file." : "Failed uploaded file.";
    	return $message;
	 }
//	 return $message;
}

function createCombo7($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=mssql_query($sql);
	$onklik	="document.form1.submit()";
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" onChange=\"".$onklik."\">";
	$retstr .= "<option value=\"\">- PILIH -</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$vfield	= $mfa[$pkfield];
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if($selvalue == $vfield){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$pkfield]." - ".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createCombo8($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=mysql_query($sql);
	$onklik	="document.form1.submit()";
	if (mysql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" onChange=\"".$onklik."\">";
	$retstr .= "<option value=\"\">- PILIH -</option>";
	while ($mfa=mysql_fetch_array($mq)){
		$vfield	= $mfa[$pkfield];
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if($selvalue == $vfield){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}


function dateSQLKaco2($date){
		//date_default_timezone_set("Asia/Jakarta");
		include $HOST."include/lib.inc.php";
		$tgl	= date("D/M/Y H:i:s A",strtotime($date));
		$tgl2	= date("d/m/Y H:i:s",strtotime($date));

		$tanggal= substr($tgl, 0,3);
		$bulan  = substr($tgl, 4,3);
		$tahun  = substr($tgl, 8,4);
		$time   = substr($tgl, 13,11);
		$tanggal2 = substr($tgl2, 0,2);

		$hari   = $days[$tanggal];
		$bulan  = $month[$bulan];

		$tampil	= "$tanggal2 $bulan $tahun";
		$tampil	= $tampil;

		return $tampil;
	}

function createComboTanpaPilih($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function hari_server()
        {
            include $HOST."include/lib.inc.php";
			$sql	= execute("SELECT 	dayname = LEFT(datename(dw, getdate()),3),
										tgl = substring(LEFT(CONVERT(VARCHAR, getdate(), 120), 10), 9, 2),
										bln = substring(LEFT(CONVERT(VARCHAR, getdate(), 120), 10), 6, 2),
										tahun = substring(LEFT(CONVERT(VARCHAR, getdate(), 120), 10), 1, 4),
										jam = substring(RIGHT(CONVERT(VARCHAR, getdate(), 120), 10),3, 20)");
			$field	= mssql_fetch_assoc($sql);

            $hari   = $days[$field['dayname']];
            $tanggal= $field['tgl'];
            $bulan  = $field['bln'];
            $bulan  = $bln[$bulan];
            $tahun  = $field['tahun'];
            $time   = $field['jam'];
            $today  = "$hari, $tanggal $bulan $tahun";//    $time
						$today  = strtoupper($today);
						echo $today;
        }
//tgl 12/06/2015
//untuk menampilkan combo yang ada "all" nya
function createCombo7all($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=mssql_query($sql);
	$onklik	="document.form1.submit()";
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" onChange=\"".$onklik."\">";
	$retstr .= "<option value=\"\">- PILIH -</option>";
	$retstr .= "<option value=\"\">- ALL -</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$vfield	= $mfa[$pkfield];
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if($selvalue == $vfield){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$pkfield]." - ".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
//untuk mengubah   jan-20-2016   ke 20/01/2016
function dateSQL22($date){
			if($date!=''){
				$bln=substr($date,0,3);
				switch($bln){
					case "Jan":$bl='01';break;
					case "Feb":$bl='02';break;
					case "Mar":$bl='03';break;
					case "Apr":$bl='04';break;
					case "May":$bl='05';break;
					case "Jun":$bl='06';break;
					case "Jul":$bl='07';break;
					case "Aug":$bl='08';break;
					case "Sep":$bl='09';break;
					case "Oct":$bl='10';break;
					case "Nov":$bl='11';break;
					case "Dec":$bl='12';break;
					default: break;
				}
				$date1	= substr($date,4,2)."/".$bl."/".substr($date,7,4);
				$tim	= date("H:i:s",strtotime($date));
				$dateSQL=$date1;
				return $dateSQL;
			}else{
				$dateSQL	= "";
				return $dateSQL;
			}
		}
//untuk rumus hitung angsuran
function PMT ($Rate, $Nper, $Pv, $Fv, $myType)
{
  $gd_i = $Rate/12;
  $gd_i100 = $gd_i/100;
  $gd_i1 = $gd_i100+1;
  $gd_ipow = 1/pow( $gd_i1, $Nper );
  $gd_p0 = -$Pv-$Fv*$gd_ipow;
  $gd_p100 = $gd_p0*$gd_i100;

  $nachschuss = $gd_p100/(1-$gd_ipow);
  return ($nachschuss/(1+$gd_i100*$myType))*-1;
}
//untuk konversi eff ke flate rate
function flaterate($plafon,$tenor,$anguran){
    $hasil=((($anguran*$tenor)-$plafon)/($plafon*($tenor/12)));
    return $hasil;
}
//tambahan agus 20/03/2016
//untuk hitung NPV dari persent ke nominal
function npv($ph,$flatdealer,$flatmaf,$tenor){
    $rp=$ph*((($flatdealer-$flatmaf)*$tenor/12)/(1+($flatmaf*$tenor/12)));
    return $rp;
}
function hostname(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST']."/sismaf"; //. $_SERVER['REQUEST_URI'];
}
function hostname_andro(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST']."/andromaf"; //. $_SERVER['REQUEST_URI'];
}
function createCombodisable($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" disabled>";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
//end hitung npv
function createComboJoinXXX($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT b.".$pkfield.",b.".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	//echo $selvalue;
	//if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
	//echo $mfa[$pkfield];
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function createComboxrequired($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$default){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	//echo $sql;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select required class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">".$default."</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function createComboxrequired2($tbname,$pkfield,$textfield,$param,$idcombon,$idcombo,$selvalue,$class,$default){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	//echo $sql;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select required class=\"".$class."\" name=\"".$idcombon."\" id=\"".$idcombo."\">";
	$retstr .= "<option value=\"\">".$default."</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function createComborequired($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" required='required'\" >";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function persen_digit2($angka,$digit){
	$angka = number_format(round($angka,$digit),$digit);

	return $angka;
}
function dateSQLKacotime($date){
//date_default_timezone_set("Asia/Jakarta");
			if($date!=''){
				$tgl	= date("d/m/Y",strtotime($date));
				$tgl2	= date("D/M/Y H:i:s",strtotime($date));
				if($tgl=='01/01/1970'){
					$tgl = "";
				}else if($tgl=='01/01/1900'){
					$tgl = "";
				}else{
					$time   = substr($tgl2, 13,8);
					$tgl = $tgl." ".$time;
				}
				return $tgl;
			}else{
				$tgl	= "";
				return $tgl;
			}
}
function dateSQLKacotime2($date){
//date_default_timezone_set("Asia/Jakarta");
			if($date!=''){
				//$tgl	= date("d/m/Y",strtotime($date));
				$tgl	= date("Y-m-d",strtotime($date));
				$tgl2	= date("D/M/Y H:i:s",strtotime($date));
				if($tgl=='01/01/1970'){
					$tgl = "";
				}else if($tgl=='01/01/1900'){
					$tgl = "";
				}else{
					$time   = substr($tgl2, 13,8);
					$tgl = $tgl." ".$time;
				}
				return $tgl;
			}else{
				$tgl	= "";
				return $tgl;
			}
}
function dateexcel($date){
			if($date!=''){
				$tgl	= date("Y/m/d",strtotime($date));
				if($tgl=='1970/01/01'){
					$tgl = "";
				}else{
					$tgl = $tgl;
				}
				return $tgl;
			}else{
				$tgl	= "";
				return $tgl;
			}
}
//tambahan agus. tgl 16/06/2016
//untuk otomatisasi tanggal rencana cair
function namahari($date){
			if($date!=''){
				$tgl	= date("Y-m-d",strtotime($date));
				if($tgl=='1970/01/01'){
					$tgl = "";
				}else{
					$day = date('D', strtotime($tgl));
					$dayList = array(
						'Sun' => 'Minggu',
						'Mon' => 'Senin',
						'Tue' => 'Selasa',
						'Wed' => 'Rabu',
						'Thu' => 'Kamis',
						'Fri' => 'Jumat',
						'Sat' => 'Sabtu'
					);

					$tgl = $dayList[$day];;
				}
				return $tgl;
			}else{
				$tgl	= "";
				return $tgl;
			}
}
function haricair($date){
	$hari=namahari($date);
	$tgl= date("Y-m-d",strtotime($date));
	if($hari=='Senin'||$hari=='Selasa'||$hari=='Rabu'){
			$tgl=date('d/m/Y', strtotime('+2 days', strtotime($tgl)));
		}else if($hari=='Kamis'||$hari=='Jumat'){
			$tgl=date('d/m/Y', strtotime('+4 days', strtotime($tgl)));
		}else if($hari=='Sabtu'){
			$tgl=date('d/m/Y', strtotime('+3 days', strtotime($tgl)));
		}else{
			$tgl="";
		}
	return $tgl;
}

function fl_apldate($date)
{
         $tahun = substr($date,0,4);
         $bulan = substr($date,4,2);
         $tanggal = substr($date,6,2);
         $fl_apldate = $tanggal."/".$bulan."/".$tahun;

         return $fl_apldate;
}

//end tambahan
//tambahan untukmenampilkan nama bulan:2016-11-04:agus waluyo
function formatDate2($date){
	$aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$thn = substr($date,0,4);
	$bln = substr($date,5,2);
	$bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
	$tgl = substr($date,8,2);
	$jam = substr($date,10,9);
	$date = $tgl." ".$aBulan[$bln]." ".$thn;
	return $date;
}
//tambahan untukmenampilkan nama bulan:2016-11-04:agus waluyo
function formatDate2x($date){
	$aBulan = array(1=> "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Oktr", "Nov", "Des");
	$thn = substr($date,0,4);
	$bln = substr($date,5,2);
	$bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
	$tgl = substr($date,8,2);
	$jam = substr($date,10,9);
	$date = $tgl." ".$aBulan[$bln]." ".$thn;
	return $date;
}
//tambahan untuk membuat no surat :2016-11-04:agus waluyo
function no_surat($date){
	$aBulan = array(1=> "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
	$thn = substr($date,0,4);
	$bln = substr($date,5,2);
	$bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
	$tgl = substr($date,8,2);
	$jam = substr($date,10,9);
	$date = $aBulan[$bln]."/".$thn;
	return $date;
}
	//tambahan untuk combo propinsi tidak mandatory
	function Combonotrequiredalias($tbname,$pkfield,$textfield,$alias,$param,$idcombo,$selvalue,$class){
			$sql="SELECT ".$pkfield.",".$alias." FROM ".$tbname." ".$param;
			$mq=execute($sql);
			//echo $sql;
			if (mssql_num_rows($mq) < 1) { return ""; };
			$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" \" >";
			$retstr .= "<option value=\"\">--- ALL ---</option>";
			while ($mfa=mssql_fetch_array($mq)){
				$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
				if ($selvalue == $mfa[$pkfield]){
					$retstr .= " selected";
				};
				$retstr .= ">".$mfa[$textfield]."</option>";
			};
			return $retstr."</select>";
		}
	function Combonotrequiredbedaid($tbname,$pkfield,$textfield,$alias,$param,$idcombo,$namacombo,$selvalue,$class){
			$sql="SELECT ".$pkfield.",".$alias." FROM ".$tbname." ".$param;
			$mq=execute($sql);
			//echo $sql;
			if (mssql_num_rows($mq) < 1) { return ""; };
			$retstr .= "<select class=\"".$class."\" name=\"".$namacombo."\" id=\"".$idcombo."\" \" >";
			$retstr .= "<option value=\"\">--- ALL ---</option>";
			while ($mfa=mssql_fetch_array($mq)){
				$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
				if ($selvalue == $mfa[$pkfield]){
					$retstr .= " selected";
				};
				$retstr .= ">".$mfa[$textfield]."</option>";
			};
			return $retstr."</select>";
		}
	function Comborequiredalias($tbname,$pkfield,$textfield,$alias,$param,$idcombo,$selvalue,$class){
			$sql="SELECT ".$pkfield.",".$alias." FROM ".$tbname." ".$param;
			$mq=execute($sql);
			//echo $sql;
			if (mssql_num_rows($mq) < 1) { return ""; };
			$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" required='required'\" >";
			$retstr .= "<option value=\"\">--- ALL ---</option>";
			while ($mfa=mssql_fetch_array($mq)){
				$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
				if ($selvalue == $mfa[$pkfield]){
					$retstr .= " selected";
				};
				$retstr .= ">".$mfa[$textfield]."</option>";
			};
			return $retstr."</select>";
		}
	//2017/04/19--- tambhan agus waluyo, yg defaulnta baris pertama
		function createCombopertama($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$event){
			$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
			//echo $sql;
			$mq=execute($sql);
			if (mssql_num_rows($mq) < 1) { return ""; };
			$retstr .= "<select onchange=\"".$event."\" class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
			while ($mfa=mssql_fetch_array($mq)){
				$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
				if ($selvalue == $mfa[$pkfield]){
					$retstr .= " selected";
				};
				$retstr .= ">".$mfa[$textfield]."</option>";
			};
			return $retstr."</select>";
		}

        function hapus_user($nikx){
			$nik=str_replace('-','',$nikx);

			//mssql_query("delete from maf_pagesubuser where nik='$nik'");
			//mssql_query("delete from maf_pageuser where nik='$nik'");
			//mssql_query("delete from maf_branchuser where nik='$nik'");
			mssql_query("update maf_user set deletests='1',active='0',groupuserid='',groupbranchid='',groupstatusid='' where nik='$nik'");
            return 'SUKSES';
		}
        function religion($id){
            switch ($id){
                case '1' :
                    $nilai= 'ISLAM';
                break;
                case '2' :
                    $nilai= 'KRISTEN';
                break;
                case '3' :
                    $nilai= 'KATOLIK';
                break;
                case '4' :
                    $nilai= 'BUDHA';
                break;
                case '5' :
                    $nilai= 'HINDU';
                break;
                case '6' :
                    $nilai= 'OTHER';
                break;
                default:
                    $nilai='';
                break;
            }
            RETURN $nilai;

		  }

function Comborequireddisabled($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$id){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$id."\" required='required'\" disabled >";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function Combodisabledx($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$id){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$id."\" disabled >";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}

function Createcombo2x($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$id){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$id."\" >";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function comboidtext($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class,$id){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$id."\" >";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield].'-'.$mfa[$pkfield]."</option>";
	};
	return $retstr."</select>";
}
function ComborequiredaliasRO($tbname,$pkfield,$textfield,$alias,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$alias." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	//echo $sql;
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\" required='required'\" disabled>";
	$retstr .= "<option value=\"\">--- ALL ---</option>";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
function uploadx($fupload,$namafile,$lokasi,$tipe){
	$namafolder=$lokasi;
	$jenis_gambar=$fupload['type'];
	$nama_file=$fupload['name'];
	$ukuran=$fupload['size'];
	$size=round($ukuran/1000000,2);
	$typefile=strtoupper(substr($nama_file,-3));
	$unik2=$namafile;
	 if($typefile==$tipe) {
  $gambar = $namafolder . basename($unik2);
  //UploadImage($unik2[0]);
  if (move_uploaded_file($fupload['tmp_name'], $gambar))
  {
  //echo $gambar;
  return  $namafile;
  }
  else
  {
	  return "ERROR-GAGAL UPLOAD";
  }
	}else {
		return "ERROR-FORMAT SALAH".$typefile."-".$tipe;
	}
return  $namafile;
}

function tanggalstring($date){
	date_default_timezone_set("Asia/Jakarta");
			if($date!=''){
			  $tgl  = date("Y-m-d",strtotime($date));
			  if($tgl=='01/01/1970'){
				 $tgl = "";
			  }else{
				 $tgl = formatDate2($tgl);
			  }
			  return $tgl;
			}else{
			  $tgl  = "";
			  return $tgl;
			}
		 }

		 function in_array_d($text, $array, $strict = false) {
 			foreach ($array as $item) {
 		    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_d($needle, $item, $strict))) {
 		        return true;
 		    }
 			}

 			return false;
 		}

 		function getNamaBulan($bulan){
 			if($bulan == "1"){return "Januari";}
 			else if($bulan == "2"){return "Februari";}
 			else if($bulan == "3"){return "Maret";}
 			else if($bulan == "4"){return "April";}
 			else if($bulan == "5"){return "Mei";}
 			else if($bulan == "6"){return "Juni";}
 			else if($bulan == "7"){return "Juli";}
 			else if($bulan == "8"){return "Agustus";}
 			else if($bulan == "9"){return "September";}
 			else if($bulan == "10"){return "Oktober";}
 			else if($bulan == "11"){return "November";}
 			else if($bulan == "12"){return "Desember";}
		 }
		 function kekata($x) {
			$x = abs($x);
			$angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima",
			"Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
			$temp = "";
			if ($x <12) {
				 $temp = " ". $angka[$x];
			} else if ($x <20) {
				 $temp = kekata($x - 10). " Belas";
			} else if ($x <100) {
				 $temp = kekata($x/10)." Puluh". kekata($x % 10);
			} else if ($x <200) {
				 $temp = " Seratus" . kekata($x - 100);
			} else if ($x <1000) {
				 $temp = kekata($x/100) . " Ratus" . kekata($x % 100);
			} else if ($x <2000) {
				 $temp = " Seribu" . kekata($x - 1000);
			} else if ($x <1000000) {
				 $temp = kekata($x/1000) . " Ribu" . kekata($x % 1000);
			} else if ($x <1000000000) {
				 $temp = kekata($x/1000000) . " Juta" . kekata($x % 1000000);
			} else if ($x <1000000000000) {
				 $temp = kekata($x/1000000000) . " Milyar" . kekata(fmod($x,1000000000));
			} else if ($x <1000000000000000) {
				 $temp = kekata($x/1000000000000) . " Trilyun" . kekata(fmod($x,1000000000000));
			}
				 return $temp;
		}


		function terbilang($x, $style=4) {
			if($x<0) {
				 $hasil = "minus ". trim(kekata($x));
			} else {
				 $hasil = trim(kekata($x));
			}
			switch ($style) {
				 case 1:
					  $hasil = strtoupper($hasil);//        SERIBU DUA RATUS LIMA PULUH
					  break;
				 case 2:
					  $hasil = strtolower($hasil);//        seribu dua ratus lima puluh
					  break;
				 case 3:
					  $hasil = ucwords($hasil);//        Seribu Dua Ratus Lima Puluh
					  break;
				 default:
					  $hasil = ucfirst($hasil);//        Seribu dua ratus lima puluh
					  break;
			}
			return $hasil;
		}
    function roundUpToAny($n,$x=5) {
        return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
	 }
	 function bulatkan5ratus($rp){
		 $bulat =round($rp/500,0)*500;
		 $selisih=$rp-$bulat;
		 if($selisih>0){
			 return $bulat+500;
		 }else{
			 return $bulat;
		 }
	 }
	 function isnull($param,$nilai){
		 if(Empty($param)){
			 return $nilai;
		 }else{
			 return $param;
		 }
	 }
	 //tambahan untukmenampilkan 13 Januari 2019,inputan dari table langsung:agus waluyo
function formatDateName($date_source){
	$date=date("Y-m-d", strtotime($date_source));
	$aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$thn = substr($date,0,4);
	$bln = substr($date,5,2);
	$bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
	$tgl = substr($date,8,2);
	$jam = substr($date,10,9);
	$date = $tgl." ".$aBulan[$bln]." ".$thn;
	return $date;
}
function angkasaja($karakter,$default)
{
	if(isset($karakter)||$karakter<>" "){
	return preg_replace("/[^0-9]/", "",$karakter);
	}
	else {
		return $default;
	}
}
function createComboJoinTanpaPilih($tbname,$pkfield,$textfield,$param,$idcombo,$selvalue,$class){
	$sql="SELECT ".$pkfield.",".$textfield." FROM ".$tbname." ".$param;
	$mq=execute($sql);
	if (mssql_num_rows($mq) < 1) { return ""; };
	$retstr .= "<select class=\"".$class."\" name=\"".$idcombo."\" id=\"".$idcombo."\">";
	while ($mfa=mssql_fetch_array($mq)){
		$retstr .= "<option value=\"".$mfa[$pkfield]."\"";
		if ($selvalue == $mfa[$pkfield]){
			$retstr .= " selected";
		};
		$retstr .= ">[".$mfa[$pkfield]."] - ".$mfa[$textfield]."</option>";
	};
	return $retstr."</select>";
}
?>
