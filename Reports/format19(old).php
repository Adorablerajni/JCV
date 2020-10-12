<?php require_once('../Connections/dbconnect-m.php'); 
if(!isset($_SESSION['MM_UserGroup'])) 
    { 
        header("location:../logout.php");
    }
?>
<?php 
$police_tracking->select_db("ftcaaazc_epfts");
$a='SP';
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
<title>Format-19 | File Tracking & Crime Analysis Application </title>
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
      <form action="format19.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
          <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

    <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:inline-block;width:220px;">
    <?php  
    while ($stmt->fetch()) 
    { 
	?>
    <option value="<?php echo $id; //echo $get_sql_data['id']?>"><?php echo $branch_name; //echo $get_sql_data['branch_name']?>, <?php echo $city; //echo $get_sql_data['city']?></option>
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
  <p align="left" style="float:left;margin-left:-30px;">Format -19</p>
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
    <p align="center"><span>कुल महिलाओं पर घटित अपराधों की मासिक जानकारी। <br /> माह - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('m/Y', strtotime($_POST['datef']));
}?> से  <?php if ($_POST['datel'] == ''){echo '';} else{echo date('m/Y', strtotime($_POST['datel']));}?> तक  जिला - <?php echo $city;?></span></p>
      
  <?php	  
  $gender = 'महिला';
  $gum = '102';
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  ?>
  
<table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
  <tr>
    <td>क्र.</td>
    <td width="120px">अपराध शीर्ष</td>
    <td>कुल प्रकरण</td>
    <td>विवेचना</td>
    <td>बंदी आरोपी</td>
    <td>खात्मा</td>
    <td>खारजी</td>
    <td>न्याया. में प्रस्तुत</td>
    <td>दण्डित</td>
    <td>दोषमुक्त</td>
    <td>न्याया. में लंबित</td>
    <td>विवेचनाधीन</td>
  </tr>
  
  <?php 
  for ($i=1;$i<=20;$i++)
  {
  ?>
  <tr>
    <td><?php echo $i; ?></td>
	
	<td align="left">
	<?php 	
	if ($i===1) {$j = 1 ; echo " हत्या (302) " ;}
    elseif ($i===2){ $j = 2 ; echo " हत्या का प्रयास (307) "; }
	elseif ($i===3){ $j = 37 ; echo " साधारण चोट (323) ";}  
	elseif ($i===4){ $j = 38 ; echo " गंभीर चोट (325/326) ";}
	elseif ($i===5){ $j = 39 ; echo " शीलभंग (354) ";}
	elseif ($i===6){ $j = 13 ; $k = 64 ; echo " अपहरण (363/366) ";}
	elseif ($i===7){ $j = 12 ; echo " बलात्कार (376) "; }
	elseif ($i===8){ $j = 40; echo " सामुहिक बलात्‍कार 376 2जी भादवि ";} 
	elseif ($i===9){ $j = 41 ; echo "आत्महत्या 306 भादवि ";}
	elseif ($i===10){ $j = 42 ; echo " दहेज हत्या 304बी भादवि ";}
	elseif ($i===11){ $j = 43 ; echo " दहेज प्रताडना 498ए भादवि ";}
	elseif ($i===12){ $j = 5 ; echo " लूट (392) ";} 
	elseif ($i===13){ $j = 44 ; echo " आगजनी (435/436) ";}
	elseif ($i===14){ $j = 45 ; echo " गालीगलोच / जान से मारने की धमकी (294,506) ";}
	elseif ($i===15){ $j = 46 ; echo " मानव र्दुव्यापार के अपराध (370ए 370कए 372ए 373) ";} 
	elseif ($i===16){ $j = 47 ; echo "अश्लील पुस्तकों  का चित्रण 292 भादवि ";}
	elseif ($i===17){ $j = 48 ; echo " महिलाओं को नग्न कर घुमाना 354ख भादवि ";}
	elseif ($i===18){ $j = 49 ; echo " भ्रूण हत्‍या 312 से 318 भादवि ";}
	elseif ($i===19){ $j = 50 ; echo " प्रकृति के विरूद्ध अपराध 377 भादवि ";}
	elseif ($i===20){ $j = 19 ; echo " अन्य अपराध ";}
	else { }
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("iiisss", $j, $k, $branch_id, $gender, $datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("iiiiiiiiiiiiiiiiiiiiiisss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20,$gum, $branch_id, $gender, $datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
    else
	{
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("iisss", $j, $branch_id, $gender, $datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid1); 
    $stmt2->fetch();
	$ipc[$i]=$cid1;
	?>
	<span><?php echo $cid1;?></span>
	<?php 
	$stmt2->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$vivechna = 'विवेचना में लंबित';
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("iiissss", $j, $k, $branch_id, $gender, $datef, $date1, $vivechna) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$vivechna = 'विवेचना में लंबित';
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("iiiiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20,$gum, $branch_id, $gender, $datef, $date1, $vivechna) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";		
	}
    else
	{
	$vivechna = 'विवेचना में लंबित';
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("iissss", $j, $branch_id, $gender, $datef, $date1, $vivechna) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid2); 
    $stmt3->fetch();
$ipc1[$i]=$cid2;	
    ?>
	<span><?php echo $cid2;?></span>
	<?php 
	$stmt3->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$bandi = 'गिरफ़्तार' ;
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND criminal_list.sp_id = ? AND criminal_list.criminal_gender = ? AND dsr_entries.dsr_kaymi_date BETWEEN ? AND ? AND criminal_list.arrest_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("iiissss", $j, $k, $branch_id, $gender, $datef, $date1, $bandi) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$bandi = 'गिरफ़्तार' ;
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != ? AND 
	dsr_entries.dsr_vidhan_ipc is not NULL AND dsr_entries.dsr_vidhan_ipc != '' AND dsr_entries.dsr_vidhan_ipc != ? AND criminal_list.sp_id = ? AND criminal_list.criminal_gender = ? AND dsr_entries.dsr_kaymi_date BETWEEN ? AND ? AND criminal_list.arrest_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("iiiiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20,$gum, $branch_id, $gender, $datef, $date1, $bandi) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	
    else
	{
	$bandi = 'गिरफ़्तार' ;
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE dsr_entries.dsr_vidhan_ipc = ? AND criminal_list.sp_id = ? AND criminal_list.criminal_gender = ? AND dsr_entries.dsr_kaymi_date BETWEEN ? AND ? AND criminal_list.arrest_status = ?") )
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("iissss", $j, $branch_id, $gender, $datef, $date1, $bandi) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt4->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid3); 
    $stmt4->fetch();
$ipc2[$i]=$cid3;	
    ?>
	<span><?php echo $cid3 ;?></span>
	<?php 
	$stmt4->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$khatma = 'खात्मा';
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("iiissss", $j, $k, $branch_id, $gender, $datef, $date1, $khatma) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$khatma = 'खात्मा';
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("iiiiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20,$gum, $branch_id, $gender, $datef, $date1, $khatma) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";		
	}
    else
	{
	$khatma = 'खात्मा';
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("iissss", $j, $branch_id, $gender, $datef, $date1, $khatma) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt5->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid4); 
    $stmt5->fetch();
$ipc3[$i]=$cid4;	
    ?>
	<span><?php echo $cid4 ;?></span>
	<?php 
	$stmt5->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$kharji = 'ख़ारजी';
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("iiissss", $j, $k, $branch_id, $gender, $datef, $date1, $kharji) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$kharji = 'ख़ारजी';
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("iiiiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20,$gum, $branch_id, $gender, $datef, $date1, $kharji) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";		
	}
	
    else
	{
	$kharji = 'ख़ारजी';
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("iissss", $j, $branch_id, $gender, $datef, $date1, $kharji) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt6->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid5); 
    $stmt6->fetch();
$ipc4[$i]=$cid5;	
    ?>
	<span><?php echo $cid5 ;?></span>
	<?php 
	$stmt6->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$nyay = 'न्यायालय में प्रस्तुत';
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("iiissss", $j, $k, $branch_id, $gender, $datef, $date1, $nyay) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$nyay = 'न्यायालय में प्रस्तुत';
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("iiiiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $gum, $branch_id, $gender, $datef, $date1, $nyay) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";		
	}
	
    else
	{
	$nyay = 'न्यायालय में प्रस्तुत';
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("iissss", $j, $branch_id, $gender, $datef, $date1, $nyay) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt7->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid6); 
    $stmt7->fetch();
 $ipc5[$i]=$cid6;	
    ?>
	<span><?php echo $cid6;?></span>
	<?php 
	$stmt7->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$dandit = 'सजा';
	$nirakrit = 'निराकृत';
	if ( !$stmt8=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_decision = ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("iiisssss", $j, $k, $branch_id, $gender, $datef, $date1, $dandit, $nirakrit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$dandit = 'सजा';
	$nirakrit = 'निराकृत';
	if ( !$stmt8=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_decision = ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("iiiiiiiiiiiiiiiiiiiiiisssss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $gum, $branch_id, $gender, $datef, $date1, $dandit, $nirakrit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";		
	}
    else
	{
	$dandit = 'सजा';
	$nirakrit = 'निराकृत';
	if ( !$stmt8=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_decision = ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("iisssss", $j, $branch_id, $gender, $datef, $date1, $dandit, $nirakrit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt8->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid7); 
    $stmt8->fetch();
$ipc6[$i]=$cid7;	
    ?>
	<span><?php echo $cid7;?></span>
	<?php 
	$stmt8->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$doshmukt = 'दोषमुक्त';
	$nirakrit = 'निराकृत';
	if ( !$stmt9=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_decision = ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("iiisssss", $j, $k, $branch_id, $gender, $datef, $date1, $doshmukt, $nirakrit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$doshmukt = 'दोषमुक्त';
	$nirakrit = 'निराकृत';
	if ( !$stmt9=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_decision = ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("iiiiiiiiiiiiiiiiiiiiiisssss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $gum , $branch_id, $gender, $datef, $date1, $doshmukt, $nirakrit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";		
	}
    else
	{
	$doshmukt = 'दोषमुक्त';
	$nirakrit = 'निराकृत';
	if ( !$stmt9=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_decision = ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("iisssss", $j, $branch_id, $gender, $datef, $date1, $doshmukt, $nirakrit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
	if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt9->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid8); 
    $stmt9->fetch();
$ipc7[$i]=$cid8;	
    ?>
	<span><?php echo $cid8;?></span>
	<?php 
	$stmt9->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$nyay_lambit = 'न्यायालय में लंबित';
	if ( !$stmt10=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("iiissss", $j, $k, $branch_id, $gender, $datef, $date1, $nyay_lambit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$nyay_lambit = 'न्यायालय में लंबित';
	if ( !$stmt10=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("iiiiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $gum, $branch_id, $gender, $datef, $date1, $nyay_lambit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";		
	}
	
    else
	{
	$nyay_lambit = 'न्यायालय में लंबित';
	if ( !$stmt10=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("iissss", $j, $branch_id, $gender, $datef, $date1, $nyay_lambit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt10->execute() ) 
    echo "Execute Error: ($stmt10->errno)  $stmt10->error";
	if ( !$stmt10->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt10->num_rows === 0) { echo "No Results"; }
    $stmt10->bind_result($cid9); 
    $stmt10->fetch();
$ipc8[$i]=$cid9;	
    ?>
	<span><?php echo $n_lambit = $cid6 - ($cid7+ $cid8) ?></span>
	<?php 
	$stmt10->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===6)
	{
	$vivechna_dhin = 'विवेचनाधीन';
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("iiissss", $j, $k, $branch_id, $gender, $datef, $date1, $vivechna_dhin) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
	elseif ($i===20) 
	{	
    $a1=1; $a2=2; $a3=37; $a4=38; $a5=39; $a6=13; $a7=64; $a8=12; $a9=40; $a10=41; $a11=42; $a12=43; $a13=5; $a14=44; $a15=45; $a16=46; $a17=47; $a18=48; $a19=49; $a20=50;
	$vivechna_dhin = 'विवेचनाधीन';
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND
    dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != ? AND	dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc != ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("iiiiiiiiiiiiiiiiiiiiiissss", $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $gum, $branch_id, $gender, $datef, $date1, $vivechna_dhin) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";		
	}
	
    else
	{
	$vivechna_dhin = 'विवेचनाधीन';
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("iissss", $j, $branch_id, $gender, $datef, $date1, $vivechna_dhin) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    }
	if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
	if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt11->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid10); 
    $stmt11->fetch();
$ipc9[$i]=$cid10;	
    ?>
	<span><?php echo $vivechnadhin = $cid1 - ($cid4 + $cid5 + $cid6);?></span>
	<?php 
	$stmt11->close();
	?>
	</td>
	
  </tr>
  
  <?php } //for loop end here ?>

  <tr>
  <td></td>
    <td colspan="11" align="left">विविध अधिनियम के अपराध</td>
  </tr>
  
  <?php 
  for ($m=21;$m<=26;$m++)
  {
  ?>
  <tr>
     
	<td><?php echo $m; ?></td>
	
	<td align="left">
	<?php 
	if ($m===21) {$n = 51 ; echo " दहेज प्रतिषेध अधिनियम " ;}
    elseif ($m===22){ $n = 52 ; echo " अनैतिक व्यापार अनिवारण अधिनियम 1956,1986 "; }
	elseif ($m===23){ $n = 53 ; echo "बाल विवाह अधिनियम 1929 यथा संशोधित 1976";}  
	elseif ($m===24){ $n = 54 ; echo " अशिष्ट रूपेण प्रतिषेध अधिनियम 1986 ";}
	elseif ($m===25){ $n = 55 ; echo " द कमीशन आॅफ सती एक्ट ";}
	elseif ($m===26){ $n = 56 ; echo " घरेलू हिन्‍सा ";}
	else { }
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->bind_param("iisss", $n, $branch_id, $gender, $datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->execute() ) 
    echo "Execute Error: ($stmt12->errno)  $stmt12->error";
	if ( !$stmt12->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt12->num_rows === 0) { echo "No Results"; }
    $stmt12->bind_result($cid11); 
    $stmt12->fetch();
	$ipc10[$m]=$cid11;
	?>
	<span><?php echo $cid11;?></span>
	<?php 
	$stmt12->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$vivechna = 'विवेचना में लंबित';
	if ( !$stmt13 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->bind_param("iissss", $n, $branch_id, $gender, $datef, $date1, $vivechna) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
	if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt13->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid12); 
    $stmt13->fetch();
$ipc11[$m]=$cid12;	
    ?>
	<span><?php echo $cid12;?></span>
	<?php 
	$stmt13->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$bandi = 'गिरफ़्तार' ;
	if ( !$stmt14 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE dsr_entries.dsr_vidhan_minor = ? AND criminal_list.sp_id = ? AND criminal_list.criminal_gender = ? AND dsr_entries.dsr_kaymi_date BETWEEN ? AND ? AND criminal_list.arrest_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->bind_param("iissss", $n, $branch_id, $gender, $datef, $date1, $bandi) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
	if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt14->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid13); 
    $stmt14->fetch();
$ipc12[$m]=$cid13;	
    ?>
	<span><?php echo $cid13 ;?></span>
	<?php 
	$stmt14->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$khatma = 'खात्मा';
	if ( !$stmt15 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->bind_param("iissss", $n, $branch_id, $gender, $datef, $date1, $khatma) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->execute() ) 
    echo "Execute Error: ($stmt15->errno)  $stmt15->error";
	if ( !$stmt15->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt15->num_rows === 0) { echo "No Results"; }
    $stmt15->bind_result($cid14); 
    $stmt15->fetch();
$ipc13[$m]=$cid14;	
    ?>
	<span><?php echo $cid14 ;?></span>
	<?php 
	$stmt15->close();
	?>
	</td>
	
    <td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$kharji = 'ख़ारजी';
	if ( !$stmt16 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->bind_param("iissss", $n, $branch_id, $gender, $datef, $date1, $kharji) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->execute() ) 
    echo "Execute Error: ($stmt16->errno)  $stmt16->error";
	if ( !$stmt16->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt16->num_rows === 0) { echo "No Results"; }
    $stmt16->bind_result($cid15); 
    $stmt16->fetch();
$ipc14[$m]=$cid15;	
    ?>
	<span><?php echo $cid15 ;?></span>
	<?php 
	$stmt16->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$nyay = 'न्यायालय में प्रस्तुत';
	if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->bind_param("iissss", $n, $branch_id, $gender, $datef, $date1, $nyay) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->execute() ) 
    echo "Execute Error: ($stmt17->errno)  $stmt17->error";
	if ( !$stmt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt17->num_rows === 0) { echo "No Results"; }
    $stmt17->bind_result($cid16); 
    $stmt17->fetch();
$ipc15[$m]=$cid16;	
    ?>
	<span><?php echo $cid16;?></span>
	<?php 
	$stmt17->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$dandit = 'सजा';
	$nirakrit = 'निराकृत';
	if ( !$stmt18=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_decision = ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("iisssss", $n, $branch_id, $gender, $datef, $date1, $dandit, $nirakrit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt18->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid17); 
    $stmt18->fetch();
 $ipc16[$m]=$cid17;	
    ?>
	<span><?php echo $cid17;?></span>
	<?php 
	$stmt18->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$doshmukt = 'दोषमुक्त';
	$nirakrit = 'निराकृत';
	if ( !$stmt19=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_decision = ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt19->bind_param("iisssss", $n, $branch_id, $gender, $datef, $date1, $doshmukt, $nirakrit))
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt19->execute() ) 
    echo "Execute Error: ($stmt19->errno)  $stmt19->error";
	if ( !$stmt19->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt19->num_rows === 0) { echo "No Results"; }
    $stmt19->bind_result($cid18); 
    $stmt19->fetch();
$ipc17[$m]=$cid18;	
    ?>
	<span><?php echo $cid18;?></span>
	<?php 
	$stmt19->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$nyay_lambit = 'न्यायालय में लंबित';
	if ( !$stmt20=$police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->bind_param("iissss", $n, $branch_id, $gender, $datef, $date1, $nyay_lambit) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->execute() ) 
    echo "Execute Error: ($stmt20->errno)  $stmt20->error";
	if ( !$stmt20->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt20->num_rows === 0) { echo "No Results"; }
    $stmt20->bind_result($cid19); 
    $stmt20->fetch();
$ipc18[$m]=$cid19;	
    ?>
	<span><?php echo $cid19;?></span>
	<?php 
	$stmt20->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$vivechna_dhin = 'विवेचनाधीन';
	if ( !$stmt21 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND dsr_kaymi_date BETWEEN ? AND ? AND c_status = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->bind_param("iissss", $n, $branch_id, $gender, $datef, $date1, $vivechna_dhin) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->execute() ) 
    echo "Execute Error: ($stmt21->errno)  $stmt21->error";
	if ( !$stmt21->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";	
    //if($stmt21->num_rows === 0) { echo "No Results"; }
    $stmt21->bind_result($cid20); 
    $stmt21->fetch();
$ipc19[$m]=$cid20;	
    ?>
	<span><?php echo $cid20;?></span>
	<?php 
	$stmt21->close();
	?>
	</td>
	
  </tr>
  
  <?php } // 2 for loop end here ?> 
  
  <tr>
    
    <td colspan="2">योग</td>
     <td>
	<?php $s=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10]+$ipc[11]+$ipc[12]+$ipc[13]+$ipc[14]+$ipc[15]+$ipc[16]+$ipc[17]+$ipc[18]+$ipc[19]+$ipc[20]+$ipc10[21]+$ipc10[22]+$ipc10[23]+$ipc10[24]+$ipc10[25]+$ipc10[26];
	echo $s;?></td>
	
    <td>
	<?php $n=$ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6]+$ipc1[7]+$ipc1[8]+$ipc1[9]+$ipc1[10]+$ipc1[11]+$ipc1[12]+$ipc1[13]+$ipc1[14]+$ipc1[15]+$ipc1[16]+$ipc1[17]+$ipc1[18]+$ipc1[19]+$ipc1[20]+$ipc11[21]+$ipc11[22]+$ipc11[23]+$ipc11[24]+$ipc11[25]+$ipc11[26];
	echo $n;?></td>
	
    <td>
	<?php $r=$ipc2[1]+$ipc2[2]+$ipc2[3]+$ipc2[4]+$ipc2[5]+$ipc2[6]+$ipc2[7]+$ipc2[8]+$ipc2[9]+$ipc2[10]+$ipc2[11]+$ipc2[12]+$ipc2[13]+$ipc2[14]+$ipc2[15]+$ipc2[16]+$ipc2[17]+$ipc2[18]+$ipc2[19]+$ipc2[20]+$ipc12[21]+$ipc12[22]+$ipc12[23]+$ipc12[24]+$ipc12[25]+$ipc12[26];
	echo $r;?></td>
	
    <td>
	<?php $t=$ipc3[1]+$ipc3[2]+$ipc3[3]+$ipc3[4]+$ipc3[5]+$ipc3[6]+$ipc3[7]+$ipc3[8]+$ipc3[9]+$ipc3[10]+$ipc3[11]+$ipc3[12]+$ipc3[13]+$ipc3[14]+$ipc3[15]+$ipc3[16]+$ipc3[17]+$ipc3[18]+$ipc3[19]+$ipc3[20]+$ipc13[21]+$ipc13[22]+$ipc13[23]+$ipc13[24]+$ipc13[25]+$ipc13[26];
	echo $t;?>
	</td>
    
	<td>
	<?php $u=$ipc4[1]+$ipc4[2]+$ipc4[3]+$ipc4[4]+$ipc4[5]+$ipc4[6]+$ipc4[7]+$ipc4[8]+$ipc4[9]+$ipc4[10]+$ipc4[11]+$ipc4[12]+$ipc4[13]+$ipc4[14]+$ipc4[15]+$ipc4[16]+$ipc4[17]+$ipc4[18]+$ipc4[19]+$ipc4[20]+$ipc14[21]+$ipc14[22]+$ipc14[23]+$ipc14[24]+$ipc14[25]+$ipc14[26];
	echo $u;?>
	</td>
	
    <td>
	<?php $v=$ipc5[1]+$ipc5[2]+$ipc5[3]+$ipc5[4]+$ipc5[5]+$ipc5[6]+$ipc5[7]+$ipc5[8]+$ipc5[9]+$ipc5[10]+$ipc5[11]+$ipc5[12]+$ipc5[13]+$ipc5[14]+$ipc5[15]+$ipc5[16]+$ipc5[17]+$ipc5[18]+$ipc5[19]+$ipc5[20]+$ipc15[21]+$ipc15[22]+$ipc15[23]+$ipc15[24]+$ipc15[25]+$ipc15[26];
	echo $v;?>
	</td>
	
    <td>
	<?php $w=$ipc6[1]+$ipc6[2]+$ipc6[3]+$ipc6[4]+$ipc6[5]+$ipc6[6]+$ipc6[7]+$ipc6[8]+$ipc6[9]+$ipc6[10]+$ipc6[11]+$ipc6[12]+$ipc6[13]+$ipc6[14]+$ipc6[15]+$ipc6[16]+$ipc6[17]+$ipc6[18]+$ipc6[19]+$ipc6[20]+$ipc16[21]+$ipc16[22]+$ipc16[23]+$ipc16[24]+$ipc16[25]+$ipc16[26];
	echo $w;?>
	</td>
	
    <td>
	<?php $x=$ipc7[1]+$ipc7[2]+$ipc7[3]+$ipc7[4]+$ipc7[5]+$ipc7[6]+$ipc7[7]+$ipc7[8]+$ipc7[9]+$ipc7[10]+$ipc7[11]+$ipc7[12]+$ipc7[13]+$ipc7[14]+$ipc7[15]+$ipc7[16]+$ipc7[17]+$ipc7[18]+$ipc7[19]+$ipc7[20]+$ipc17[21]+$ipc17[22]+$ipc17[23]+$ipc17[24]+$ipc17[25]+$ipc17[26];
	echo $x;?>
	</td>
	
    <td>
	<?php $y=$ipc8[1]+$ipc8[2]+$ipc8[3]+$ipc8[4]+$ipc8[5]+$ipc8[6]+$ipc8[7]+$ipc8[8]+$ipc8[9]+$ipc8[10]+$ipc8[11]+$ipc8[12]+$ipc8[13]+$ipc8[14]+$ipc8[15]+$ipc8[16]+$ipc8[17]+$ipc8[18]+$ipc8[19]+$ipc8[20]+$ipc18[21]+$ipc18[22]+$ipc18[23]+$ipc18[24]+$ipc18[25]+$ipc18[26];
	echo $y;?>
	</td>
    <td>
	<?php $z=$ipc9[1]+$ipc9[2]+$ipc9[3]+$ipc9[4]+$ipc9[5]+$ipc9[6]+$ipc9[7]+$ipc9[8]+$ipc9[9]+$ipc9[10]+$ipc9[11]+$ipc9[12]+$ipc9[13]+$ipc9[14]+$ipc9[15]+$ipc9[16]+$ipc9[17]+$ipc9[18]+$ipc9[19]+$ipc9[20]+$ipc19[21]+$ipc19[22]+$ipc19[23]+$ipc19[24]+$ipc19[25]+$ipc19[26];
	echo $z;?>
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