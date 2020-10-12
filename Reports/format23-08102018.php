<?php require_once('../Connections/dbconnect-m.php');  ?>
<?php
if(!isset($_SESSION['MM_UserGroup'])) 
    { 
        header("location:../logout.php");
    }

$a='SP';
$police_tracking->select_db("ftcaaazc_epfts");
$stmt = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE designation = ?");
$stmt->bind_param("s", $a);
$stmt->execute();
$stmt->store_result();
//if($stmt->num_rows === 0) exit('No rows');
$stmt->bind_result($id,$branch_name,$city); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>P-23 | File Tracking & Crime Analysis Application </title>
<!-- GLOBAL STYLES -->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="../assets/css/main.css" />
<link rel="stylesheet" href="../assets/css/theme.css" />
<link rel="stylesheet" href="../assets/css/MoneAdmin.css" />
<link rel="stylesheet" href="../assets/plugins/Font-Awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="../assets/css/autocom.css" />
<!--END GLOBAL STYLES -->

<!-- PAGE LEVEL STYLES -->
<link href="../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/plugins/datepicker/css/datepicker.css" />
<link rel="stylesheet" href="../assets/plugins/validationengine/css/validationEngine.jquery.css" />
<!-- END PAGE LEVEL  STYLES -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<style media='all'>
body {
	font-size:12px;
}
.notice_all {
	min-height:600px;
	width:900px;
	margin:0 auto;
	/*border:dotted 1px #666;*/
	position:relative;
}
#print tr td {
	vertical-align:top
}
</style>
<style media='print'>
.navStuff {
	display: none
}
.mar10 {
	margin-top:-10px
}
</style>
</head>

<body>
<div class="notice_all">
  <div align='right' class='navStuff'>
    <form action="exporttoexcel.php" method="post" 
onsubmit='$("#datatodisplay").val( $("<div>").append( $("#download").eq(0).clone() ).html() )'>  
<p align="" class="hprtbtn">
<span style="float:right;margin-right:-25px"> <input type="hidden" id="datatodisplay" name="datatodisplay" style="" /> <input type="submit" value="Export to Excel"/>
  <input type='button' value='Print this page' onClick='window.print()'>   </span></p></form>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <form action="format23.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
          <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datef']) ? $_POST['datef'] : '' ?>" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datel']) ? $_POST['datel'] : '' ?>" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

    <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:inline-block;width:220px;" readonly="readonly">
    <?php 
	$stmt_jila = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?");
    $stmt_jila->bind_param("s", $_POST['sp_office']);
    $stmt_jila->execute();
    $stmt_jila->store_result();
    //if($stmt_jila->num_rows === 0) exit('No rows');
    $stmt_jila->bind_result($branch_id_jila, $branch_name_jila, $city_jila);
    $stmt_jila->fetch();
	$stmt_jila->close();
	$jila = $branch_name_jila.",".$city_jila ;
    ?>
	<option value="<?php echo $branch_id_jila ;?>"><?php echo isset($_POST['sp_office']) ? $jila : '' ?></option>    
	<?php 
    while ($stmt->fetch()) 
    {  
	?>
    <option value="<?php echo $id;?>"><?php echo $branch_name; ?>, <?php echo $city; ?></option>
    <?php
    }
    $stmt->close(); //id,branch_name,city FROM branch_tbl close
    ?>
    </select>
                      
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" class="btn btn-success" id="mybutton" name="Search" style="display:inline-block">Search</button>
        </div>
      </form>
    </div>
  </div>
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
	if(isset($_POST['Search'])!='')
    {
  ?>
  <p align="left" style="float:left;margin-left:-30px;">Format-23</p>
  <p align="right"></p>
  <div class="mar10">
  <?php
    $police_tracking->select_db("ftcaaazc_epfts");
    $stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE id = ?");
    $stmt1->bind_param("s", $_POST['sp_office']);
    $stmt1->execute();
    $stmt1->store_result();
    //if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name, $city); 
    while ($stmt1->fetch())
	{
  ?>
    <p align="center"><span>बालक/बालिकाओं के विरूद्ध घटित अपराध <br /> माह - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('m/Y', strtotime($_POST['datef']));
}?> से <?php if ($_POST['datel'] == ''){echo '';} else{echo date('m/Y', strtotime($_POST['datel']));}?>&nbsp;&nbsp;&nbsp; जिला - <?php echo $city; ?></span></p>
      
  <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $avyask ='अव्यसक';
  $gum = '102';
  ?>
  
<table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
  <tr>
    <td rowspan="2">क्र.</td>
    <td colspan="1" width="120px">अपराध शीर्ष</td>
    <td rowspan="2">कुल प्रकरण</td>
    <td rowspan="2">चालान</td>
    <td rowspan="2">पेण्डिग पुलिस</td>
    <td rowspan="2">दंडित प्रकरण</td>
    <td rowspan="2">खारजी</td>
    <td rowspan="2">दोषमुक्त</td>
  </tr>
  <tr>
    <td>भादवि के अपराध</td>
  </tr>
  
  <?php 
  for ($i=1;$i<=18;$i++)
  {	 
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    
	<td align="left">
	<?php 
	if ($i===1) {$j = 1 ; echo " हत्या (302) " ;}
    elseif ($i===2){ $j = 2 ; echo " हत्या का प्रयास (307) "; }
	elseif ($i===3){ $j = 3 ; echo " डकेती (395) ";}  
	elseif ($i===4){ $j = 5 ; echo " लूट (392) ";}
	elseif ($i===5){ $j = 13 ; $k = 64 ; echo " अपहरण (363/366) ";}
	elseif ($i===6){ $j = 12 ; echo " बलात्कार (376) ";}
	elseif ($i===7){ $j = 44 ; echo " आगजनी (435/436)"; }
	elseif ($i===8){ $j = 38; echo " गंभीर चोट (325/326) ";} 
	elseif ($i===9){ $j = 37 ; echo " साधारण चोट (323) ";}
	elseif ($i===10){ $j = 92 ; echo " जमीन संबंधी (447/448) ";}
	elseif ($i===11){ $j = 93 ; echo " नुकसान रसानी (427,428,429) ";}
	elseif ($i===12){ $j = 94 ; echo " चोरी / नकबजनी (380) ";} 
	elseif ($i===13){ $j = 39 ; echo " शीलभंग (354) ";}
	elseif ($i===14){ $j = 45 ; echo " गालीगलोच / जान से मारने की धमकी (294,506) ";}
	elseif ($i===15){ $j = 11 ; echo " बलवा (147/148) ";} 
	elseif ($i===16){ $j = 95 ; echo " धोखाधड़ी (420) ";}
	elseif ($i===17){ $j = 96 ; echo " गबन (406/409) ";}
	elseif ($i===18){ $j = 19 ; echo " अन्य भादवि / अजा / अजजा ( अ. नि.)1989 ";}
	else { }
	?>
	</td>
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if($i===5)
	{
	$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_balig = ?");
	$stmt2->bind_param("iiisss", $j, $k, $branch_id,$datef, $date1, $avyask);
	}
	elseif($i===18)
	{
	$a1=1; $a2=2; $a3=3; $a4=5; $a5=13; $a6=64; $a7=12; $a8=44; $a9=38; $a10=37; $a11=92; $a12=93; $a13=94; $a14=39; $a15=45; $a16=11; $a17=95; $a18=96;
	$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND 
	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_balig = ?");
	$stmt2->bind_param("iiiiiiiiiiiiiiiiiiiisss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $gum, $branch_id,$datef, $date1, $avyask);	
	}
	else
	{
	$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_balig = ?");
	$stmt2->bind_param("iisss", $j, $branch_id,$datef, $date1, $avyask);	
	}
    $stmt2->execute();
    $stmt2->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid2); 
    $stmt2->fetch();		
    ?>
	<span><?php echo $cid2;?></span>
	<?php
    $ipc[$i]=$cid2;	
	$stmt2->close();
	?>
	</td>
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if($i===5)
	{
	$a='चालान कटा';
	$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND dsr_balig = ?");
	$stmt3->bind_param("iiissss", $j, $k, $branch_id,$datef, $date1,$a, $avyask);
	//echo $k;
	}
	elseif($i===18)
	{
    $a='चालान कटा';
	$a1=1; $a2=2; $a3=3; $a4=5; $a5=13; $a6=64; $a7=12; $a8=44; $a9=38; $a10=37; $a11=92; $a12=93; $a13=94; $a14=39; $a15=45; $a16=11; $a17=95; $a18=96;
	$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND 
	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND dsr_balig = ?");
	$stmt3->bind_param("iiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18,$gum ,$branch_id,$datef, $date1, $a, $avyask);	
	}
	else
	{
	$a='चालान कटा';
	$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND dsr_balig = ?");
	$stmt3->bind_param("iissss", $j, $branch_id,$datef, $date1,$a, $avyask);
	}
    $stmt3->execute();
    $stmt3->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid3); 
    $stmt3->fetch();		
    ?>
	<span><?php echo $cid3;?></span>
	<?php 
	$ipc1[$i]=$cid3;
	$stmt3->close();
	?></td>
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if($i===5)
	{
	$b='विवेचना में लंबित';
	$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND dsr_balig = ?");
	$stmt4->bind_param("iiissss", $j, $k, $branch_id,$datef, $date1,$b, $avyask);
	//echo $k;
	}
	elseif($i===18)
	{
	$a1=1; $a2=2; $a3=3; $a4=5; $a5=13; $a6=64; $a7=12; $a8=44; $a9=38; $a10=37; $a11=92; $a12=93; $a13=94; $a14=39; $a15=45; $a16=11; $a17=95; $a18=96;
	$b='विवेचना में लंबित';
	$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND dsr_balig = ?");
	$stmt4->bind_param("iiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $gum, $branch_id,$datef, $date1,$b, $avyask);	
	}
	else
	{
	$b='विवेचना में लंबित';
	$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND dsr_balig = ?");
	$stmt4->bind_param("iissss", $j, $branch_id,$datef, $date1,$b, $avyask);
    }
	$stmt4->execute();
    $stmt4->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid4); 
    $stmt4->fetch();		
    ?>
	<span><?php 
	$ipc2[$i]=$cid4;
	echo $cid4;?></span>
	<?php 
	$stmt4->close();
	?></td>
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if($i===5)
	{
	$saja = 'सजा';
	$nirakrit = 'निराकृत';
	$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND c_decision = ? AND dsr_balig = ?");
	$stmt5->bind_param("iiisssss", $j, $k , $branch_id, $datef, $date1, $nirakrit, $saja, $avyask);
	//echo $k;
	}
	elseif($i===18)
	{
	$a1=1; $a2=2; $a3=3; $a4=5; $a5=13; $a6=64; $a7=12; $a8=44; $a9=38; $a10=37; $a11=92; $a12=93; $a13=94; $a14=39; $a15=45; $a16=11; $a17=95; $a18=96;
	$saja = 'सजा';
	$nirakrit = 'निराकृत';
	$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND c_decision = ? AND dsr_balig = ?");
	$stmt5->bind_param("iiiiiiiiiiiiiiiiiiiisssss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18,$gum, $branch_id, $datef, $date1, $nirakrit, $saja, $avyask);
	}
	else
	{
	$saja = 'सजा';
	$nirakrit = 'निराकृत';
	$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND c_decision = ? AND dsr_balig = ?");
	$stmt5->bind_param("iisssss", $j, $branch_id, $datef, $date1, $nirakrit, $saja, $avyask);
	}
    $stmt5->execute();
    $stmt5->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid5); 
    $stmt5->fetch();		
    ?>
	<span><?php
    $ipc3[$i]=$cid5;
	echo $cid5;?></span>
	<?php 
	$stmt5->close();
	?></td>
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if($i===5)
	{
	$kharji ='ख़ारजी';
	$kharchii ='खारची';
	$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (c_status = ? or c_status = ?) AND dsr_balig = ?");
	$stmt6->bind_param("iiisssss", $j, $k, $branch_id, $datef, $date1,$kharji, $kharchii, $avyask);
	//echo $k;
	}
	elseif($i===18)
	{
	$a1=1; $a2=2; $a3=3; $a4=5; $a5=13; $a6=64; $a7=12; $a8=44; $a9=38; $a10=37; $a11=92; $a12=93; $a13=94; $a14=39; $a15=45; $a16=11; $a17=95; $a18=96;
	$kharji ='ख़ारजी';
	$kharchii ='खारची';
	$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (c_status = ? or c_status = ?) AND dsr_balig = ?");
	$stmt6->bind_param("iiiiiiiiiiiiiiiiiiiisssss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18,$gum, $branch_id, $datef, $date1,$kharji, $kharchii,$avyask);
	}
	else
	{
	$kharji ='ख़ारजी';
	$kharchii ='खारची';
	$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (c_status = ? or c_status = ?) AND dsr_balig = ?");
	$stmt6->bind_param("iisssss", $j, $branch_id, $datef, $date1,$kharji, $kharchii, $avyask);
	}
    $stmt6->execute();
    $stmt6->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid6); 
    $stmt6->fetch();		
    ?>
	<span><?php 
	$ipc4[$i]=$cid6;
	echo $cid6;?></span>
	<?php 
	$stmt6->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if($i===5)
	{
	$nirakrit2 = 'निराकृत';
	$doshmukt = 'दोषमुक्त';
	$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? ) AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND c_decision = ? AND dsr_balig = ?");
	$stmt7->bind_param("iiisssss", $j, $k, $branch_id, $datef, $date1, $nirakrit2,  $doshmukt, $avyask);
	//echo $k;
	}
	elseif($i===18)
	{
	$a1=1; $a2=2; $a3=3; $a4=5; $a5=13; $a6=64; $a7=12; $a8=44; $a9=38; $a10=37; $a11=92; $a12=93; $a13=94; $a14=39; $a15=45; $a16=11; $a17=95; $a18=96;
	$nirakrit2 = 'निराकृत';
	$doshmukt = 'दोषमुक्त';
	$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND c_decision = ? AND dsr_balig = ?");
	$stmt7->bind_param("iiiiiiiiiiiiiiiiiiiisssss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18,$gum, $branch_id, $datef, $date1, $nirakrit2,  $doshmukt, $avyask);
	}
	else
	{
	$nirakrit2 = 'निराकृत';
	$doshmukt = 'दोषमुक्त';
	$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status=? AND c_decision = ? AND dsr_balig = ?");
	$stmt7->bind_param("iisssss", $j, $branch_id, $datef, $date1, $nirakrit2,  $doshmukt, $avyask);
	}
    $stmt7->execute();
    $stmt7->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid7); 
    $stmt7->fetch();		
    ?>
	<span><?php 
	$ipc5[$i]=$cid7;
	echo $cid7;?></span>
	<?php 
	$stmt7->close();
	?>
	</td>	
  </tr>
  
  <?php } //for loop end here ?>
  
  <tr>   
	<td></td>
    <td>योग</td>
	<td>
	<?php $s=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10]+$ipc[11]+$ipc[12]+$ipc[13]+$ipc[14]+$ipc[15]+$ipc[16]+$ipc[17]+$ipc[18];
	echo $s;?></td>
	
    <td>
	<?php $n=$ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6]+$ipc1[7]+$ipc1[8]+$ipc1[9]+$ipc1[10]+$ipc1[11]+$ipc1[12]+$ipc1[13]+$ipc1[14]+$ipc1[15]+$ipc1[16]+$ipc1[17]+$ipc1[18];
	echo $n;?></td>
	
    <td>
	<?php $r=$ipc2[1]+$ipc2[2]+$ipc2[3]+$ipc2[4]+$ipc2[5]+$ipc2[6]+$ipc2[7]+$ipc2[8]+$ipc2[9]+$ipc2[10]+$ipc2[11]+$ipc2[12]+$ipc2[13]+$ipc2[14]+$ipc2[15]+$ipc2[16]+$ipc2[17]+$ipc2[18];
	echo $r;?></td>
	
    <td>
	<?php $t=$ipc3[1]+$ipc3[2]+$ipc3[3]+$ipc3[4]+$ipc3[5]+$ipc3[6]+$ipc3[7]+$ipc3[8]+$ipc3[9]+$ipc3[10]+$ipc3[11]+$ipc3[12]+$ipc3[13]+$ipc3[14]+$ipc3[15]+$ipc3[16]+$ipc3[17]+$ipc3[18];
	echo $t;?>
	</td>
    
	<td>
	<?php $u=$ipc4[1]+$ipc4[2]+$ipc4[3]+$ipc4[4]+$ipc4[5]+$ipc4[6]+$ipc4[7]+$ipc4[8]+$ipc4[9]+$ipc4[10]+$ipc4[11]+$ipc4[12]+$ipc4[13]+$ipc4[14]+$ipc4[15]+$ipc4[16]+$ipc4[17]+$ipc4[18];
	echo $u;?>
	</td>
	
    <td>
	<?php $v=$ipc5[1]+$ipc5[2]+$ipc5[3]+$ipc5[4]+$ipc5[5]+$ipc5[6]+$ipc5[7]+$ipc5[8]+$ipc5[9]+$ipc5[10]+$ipc5[11]+$ipc5[12]+$ipc5[13]+$ipc5[14]+$ipc5[15]+$ipc5[16]+$ipc5[17]+$ipc5[18];
	echo $v;?>
	</td>
  </tr>
</table>

    <br /><br />
  
    <br /><br />
    <p style="float:right" align="center"></p>
	<?php } //stmt1 while end here?>
  </div>
  <?php } //search end here?>
  </div>
 </div>
<style>
.break { page-break-before: always; }
</style>
<p class="break"></p>
<!-- GLOBAL SCRIPTS --> 
<script src="../assets/plugins/jquery-2.0.3.min.js"></script> 
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script src="../assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script> 
<!-- END GLOBAL SCRIPTS --> 
<!-- PAGE LEVEL SCRIPTS --> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="../assets/js/progressbar.js"></script> 
<script src="../assets/plugins/dataTables/jquery.dataTables.js"></script> 
<script src="../assets/plugins/dataTables/dataTables.bootstrap.js"></script> 
 
<script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script> 
 
<!-- END PAGE LEVEL SCRIPTS --> 
<script type="text/javascript" src="../assets/js/multirow.js"></script> 
<script src="../assets/plugins/validationengine/js/jquery.validationEngine.js"></script> 
<script src="../assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script> 
<script src="../assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script> 
<script src="../assets/js/validationInit.js"></script> 
<script>
        $(function () { formValidation(); });
        </script> 
<script src="../assets/js/formsInit.js"></script> 
<script>
            $(function () { formInit(); });
        </script> 

<script src="../assets/js/jquery-ui.min.js"></script> 
<script src="../assets/plugins/uniform/jquery.uniform.min.js"></script> 
<script src="../assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script> 
<script src="../assets/plugins/chosen/chosen.jquery.min.js"></script> 
<script src="../assets/plugins/colorpicker/js/bootstrap-colorpicker.js"></script> 
<script src="../assets/plugins/tagsinput/jquery.tagsinput.min.js"></script> 
<script src="../assets/plugins/validVal/js/jquery.validVal.min.js"></script> 
<script src="../assets/plugins/datepicker/js/bootstrap-datepicker.js"></script> 
<script src="../assets/plugins/autosize/jquery.autosize.min.js"></script>
</body>
</html>
