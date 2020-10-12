<?php
require_once('../Connections/dbconnect-m.php');
 
if(!isset($_SESSION['MM_UserGroup'])) 
    { 
        header("location:../logout.php");
    } 
?>
<?php
$police_tracking->select_db("ftcaaazc_epfts");
$a='SP';
$stmt = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE designation = ? and zone = ?");
$stmt->bind_param("ss", $a, $_SESSION['MM_Zone']);
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
<title>Format-1-IPC-PATARSI | File Tracking & Crime Analysis Application </title>
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

<body style="background:#FFF">
<div align='right' class='navStuff container'>
    <form action="exporttoexcel.php" method="post" 
onsubmit='$("#datatodisplay").val( $("<div>").append( $("#download").eq(0).clone() ).html() )'>  
<p align="" class="hprtbtn">
<span style="float:right;margin-right:-25px"> <input type="hidden" id="datatodisplay" name="datatodisplay" style="" /> <input type="submit" value="Export to Excel" class="btn btn-warning"/>
  <input type='button' value='Print this page' onClick='window.print()' class="btn btn-warning">   </span></p></form>
 </div>
 <div class="row">
    <div class="col-lg-12 label-primary" style="color:#FFF">
      <form action="format1-ipc-patarsi.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
      <div class="col-lg-12 navStuff" style="padding:15px 5px;margin:0px auto;width:960px;">    
        <div class="col-lg-12 navStuff">  &nbsp; 
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
<div class="notice_all">
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
	if(isset($_POST['Search'])!='')
    {
  ?>
  <!--<p align="left" style="float:left;margin-left:-30px;">Format-1-ipc-patarsi</p>-->
  <p align="right"></p>
  <div class="mar10">
  <?php
  //$result1=mysql_query("");
  //$data1=mysql_fetch_assoc($result1);
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
      <br /><br />
    <p align="center"><span>भादवि के अपराधों का पतारसी का प्रतिशत <br /> दि <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>तक &nbsp;&nbsp इन्दौर जोन</span></p>
      
  <?php	
  $age = '18';  
  $sc = "SC";
  $st = "ST";
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  ?>
  <br/>
<table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
  <tr>
    <td rowspan="2">क्र.</td>
    <td rowspan="2" width="120px">शीर्ष</td>
    <td colspan="5"><?php echo $branch_name; echo ","; echo $city; ?></td>    
  </tr>
  <tr>
  
    <td>कुल पंजीबद्ध प्रकरण</td>
    <td>पक्ष में पते में लाये गये प्रकरण</td>
    <td>पतारसी का लक्ष्य</td>
    <td>जोन का पतारसी प्रतिशत</td>
    <td>पक्ष में पते में लाये गये प्रकरणों का प्रतिशत</td>   
  </tr>
  
  <?php 
  for ($i=1;$i<=28;$i++)
  {	 
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    
	<td align="left">
	<?php 
	if ($i===1) {$j = 1 ; echo " हत्या (302) " ;}
    elseif ($i===2){ $j = 2 ; echo " हत्या का प्रयास (307) "; }
	elseif ($i===3){ $j = 3 ; echo " डकेती (395) ";}  
	elseif ($i===4){ $j = 4 ; echo " डकैती की तैयारी ";}
	elseif ($i===5){ $j = 5 ; echo " लूट (392) ";}
	elseif ($i===6){ $j = 7 ; echo " गृहभेदन ";}
	elseif ($i===7){ $j = 9 ; echo " चोरी ";}
	elseif ($i===8){ $j = 69 ; echo " वाहन चोरी (दो पहिया) ";} 
	elseif ($i===9){ $j = 70 ; echo " वाहन चोरी (चार पहिया) ";}
	elseif ($i===10){ $j = 71 ; echo " आपराधिक मानव वध ";}
	elseif ($i===11){ $j = 72 ; echo " घोर उपहति ";}
	elseif ($i===12){ $j = 11 ; echo " बलवा (147/148) ";}
	elseif ($i===13){ $j = 12 ; echo " बलात्कार (376) ";}
	elseif ($i===14){ $j = 13 ; $k = 64; $l = " महिलाओं का अपहरण "; echo " महिलाओं का अपहरण ";}  // same as aphharan
	elseif ($i===15){ $j = 13 ; $k = 64; $l = "बालिकाओं का व्यपहरण"; echo " बालिकाओं का व्यपहरण ";} // same as aphharan
	elseif ($i===16){ $j = 13 ; $k = 64; $l = "धन हेतु अपहरण"; echo " धन हेतु अपहरण ";} // same as aphharan
	elseif ($i===17){ $j = 13 ; $k = 64; $l = "अन्य अपहरण"; echo " अन्य अपहरण ";} // same as aphharan
	elseif ($i===18){ $j = 42 ; echo " दहेज मृत्यु ";}
	elseif ($i===19){ $j = 15 ; $k = 39; echo " छेडछाड ";}
	elseif ($i===20){ $j = 73 ; echo " यौंन उत्पीडन ";}
	elseif ($i===21){ $j = 74 ; echo " छल ";}
	elseif ($i===22){ $j = 75 ; echo " आपराधिक न्यास भंग ";}
	elseif ($i===23){ $j = 76 ; echo " कूटकरण / कूट रचना ";}
	elseif ($i===24){ $j = 77 ; echo " तेजाब काण्ड ";}
	elseif ($i===25){ $j = 78 ; echo " रैगिंग प्रकरण ";}
	elseif ($i===26){ $j = 79 ; echo " संगठित गिरोह के अपराध ";}
	elseif ($i===27){ $j = 80 ; echo " सफेद पोश अपराध ";}
	elseif ($i===28){ $j = 44 ; echo " आगजनी (435/436) "; }
	//elseif ($i===29){ $j = 19 ; echo " अन्य भादवि ";}
	else { }
	?>
	</td>
    
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
		if($i===14)
		{
	$dsr_balig1 ='वयस्क';
	$dsr_gender ='महिला';
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age >= ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("isssssi",$branch_id, $datef, $date1, $j, $k, $dsr_gender, $age) ) 
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
		}
		elseif($i===15)
		{
		$dsr_balig2 ='अव्यसक';
		$dsr_gender ='महिला';
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age < ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("isssssi", $branch_id, $datef, $date1, $j, $k, $dsr_gender, $age) ) 
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
		}
		elseif($i===16)
		{
	$dsr_kdnp_rsn ='फिरौती के लिये';
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND dsr_kdnp_rsn = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("isssss", $branch_id, $datef, $date1, $j, $k, $dsr_kdnp_rsn) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
		}
		elseif($i===17) 
		{
		$dsr_kdnp_rsn ='फिरौती के लिये';
		$dsr_gender ='महिला';
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender != ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("isssss", $branch_id, $datef, $date1, $j, $k, $dsr_gender) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
		}
		elseif($i===19) 
		{
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("issss", $branch_id, $datef, $date1, $j, $k) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
		}
	else
	{
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("isss",$branch_id,$datef, $date1,$j) )
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
        if($i===14)
        {
        $dsr_balig1 = 'वयस्क';
        $dsr_gender = 'महिला';
        $arrest_status ='गिरफ़्तार';
        $stmt3 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id JOIN pidit_list ON dsr_entries.id = pidit_list.dsr_id WHERE criminal_list.sp_id = ? AND  (criminal_list.criminal_arrest_date between ? and ?) AND criminal_list.arrest_status = ? AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age >= ? and dsr_entries.dsr_kaymi_date between ? and ?"); //dsr_entries.dsr_gender = ? AND dsr_entries.dsr_balig = ?
        $stmt3->bind_param("isssiisiss", $branch_id, $datef, $date1, $arrest_status, $j, $k, $dsr_gender, $age,$datef, $date1);
        }
        elseif($i===15)
        {
        $dsr_balig2 = 'अव्यसक';
        $dsr_gender = 'महिला';
        $arrest_status ='गिरफ़्तार';
        $stmt3 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id JOIN pidit_list ON dsr_entries.id = pidit_list.dsr_id WHERE criminal_list.sp_id = ? AND  (criminal_list.criminal_arrest_date between ? and ?) AND criminal_list.arrest_status = ? AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age < ? and dsr_entries.dsr_kaymi_date between ? and ?");
        $stmt3->bind_param("isssiisiss", $branch_id,$datef, $date1,$arrest_status,$j,$k,$dsr_gender, $age,$datef, $date1);

        }
        elseif($i===16)
        {
        $dsr_kdnp_rsn = 'फिरौती के लिये';
        $arrest_status ='गिरफ़्तार';
        $stmt3 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE criminal_list.sp_id = ? AND  ( criminal_list.criminal_arrest_date between ? and ?) AND criminal_list.arrest_status = ? AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND dsr_entries.dsr_kdnp_rsn = ? and dsr_entries.dsr_kaymi_date between ? and ?");
        $stmt3->bind_param("isssiisss", $branch_id,$datef, $date1,$arrest_status,$j,$k,$dsr_kdnp_rsn,$datef, $date1);

        }
        elseif($i===17)
        {
        $dsr_kdnp_rsn = 'फिरौती के लिये';
        $dsr_gender = 'महिला';
        $arrest_status ='गिरफ़्तार';
        $stmt3 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id JOIN pidit_list ON dsr_entries.id = pidit_list.dsr_id WHERE criminal_list.sp_id = ? AND  (criminal_list.criminal_arrest_date between ? and ?) AND criminal_list.arrest_status = ? AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender != ? and dsr_entries.dsr_kaymi_date between ? and ?"); //AND dsr_entries.dsr_kdnp_rsn != ? 
        $stmt3->bind_param("isssiisss", $branch_id,$datef, $date1,$arrest_status,$j,$k,$dsr_gender,$datef, $date1); //$dsr_kdnp_rsn
        }
        elseif($i===19) 
        {
        $arrest_status ='गिरफ़्तार';
        $stmt3 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE criminal_list.sp_id = ? AND  ( criminal_list.criminal_arrest_date between ? and ? ) AND criminal_list.arrest_status = ? AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) and dsr_entries.dsr_kaymi_date between ? and ?");
        $stmt3->bind_param("isssiiss", $branch_id,$datef, $date1,$arrest_status, $j, $k,$datef, $date1);	
        }
        else{
        $arrest_status ='गिरफ़्तार';
        $stmt3 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE criminal_list.sp_id = ? AND (criminal_list.criminal_arrest_date between ? and ?) AND criminal_list.arrest_status = ? AND dsr_entries.dsr_vidhan_ipc = ? and dsr_entries.dsr_kaymi_date between ? and ?"); // GROUP BY criminal_list.dsr_id
        $stmt3->bind_param("isssiss", $branch_id,$datef, $date1,$arrest_status,$j,$datef, $date1);
        }

        $stmt3->execute();
        $stmt3->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt3->bind_result($cid2); 
        $stmt3->fetch();
        $ipc1[$i]=$cid2;	
        ?>
        <span><?php if($stmt3->num_rows > 0) { echo $cid2; } else { echo "0";}?></span>
        <?php 
        $stmt3->close();
        ?>
        </td>
	
    <td>0
	<?php
 	/*$police_dsr->select_db("ftcaaazc_dsr");
	$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ");
	$stmt4->bind_param("iiss", $j, $branch_id, $datef, $date1);
    $stmt4->execute();
    $stmt4->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid3); 
    $stmt4->fetch();		
    ?>
	<span><?php echo $cid3;?></span>
	<?php 
	$stmt4->close();*/
	?>
	</td>
	
    <td>0
	<?php
 	/*$police_dsr->select_db("ftcaaazc_dsr");
	$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ");
	$stmt5->bind_param("iiss", $j, $branch_id,$datef, $date1);
    $stmt5->execute();
    $stmt5->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid4); 
    $stmt5->fetch();		
    ?>
	<span><?php echo $cid4;?></span>
	<?php 
	$stmt5->close();*/
	?>
	</td>
    
	<td>
	<?php
 	$x6 = $ipc1[$i];
$y6 = $ipc[$i];
if($y6!=0){
$percent6 = $x6/$y6;
}
else {
	$percent6 = 0;
}

$percent_friendly6 = number_format( $percent6 * 100, 2 ) . ' %' ;
$ipc2[$i] = $percent_friendly6;
echo $percent_friendly6 ;
	?>
	</td>
    

    

	

	
  </tr>
  
  <?php } //for loop end here ?>
    
        <tr>
            
        <td><?php echo 29; ?></td>

        <td align="left">
        <?php echo " अन्य भादवि ";?>
        </td>

        <td>
        <?php
        $gum = '102';
        $police_dsr->select_db("ftcaaazc_dsr");
        //$stmt22 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries where sp_id = ? and (dsr_vidhan_ipc is not NULL OR dsr_vidhan_ipc != '') AND dsr_vidhan_ipc != ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
        $stmt22 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date BETWEEN ? and ?) AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc is not NULL");
        $stmt22->bind_param("issi", $branch_id, $datef, $date1, $gum);
        $stmt22->execute();
        $stmt22->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt22->bind_result($cid22);
        $stmt22->fetch();
        //echo $cid22;
        $ipc[29]= $cid22 - ($ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10]+$ipc[11]+$ipc[12]+$ipc[13]+$ipc[14]+$ipc[15]+$ipc[16]+$ipc[17]+$ipc[18]+$ipc[19]+$ipc[20]+$ipc[21]+$ipc[22]+$ipc[23]+$ipc[24]+$ipc[25]+$ipc[26]+$ipc[27]+$ipc[28]);
        ?>
        <span><?php echo $ipc[29];?></span>
        <?php 
        $stmt22->close();
        ?>
        </td>

        <td>
        <?php 	
        $police_dsr->select_db("ftcaaazc_dsr");
        $gum = '102';
        $arrest_status ='गिरफ़्तार';
        //$stmt23 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE criminal_list.sp_id = ? AND  ( criminal_list.criminal_arrest_date>= ? AND criminal_list.criminal_arrest_date<= ?) AND criminal_list.arrest_status = ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != '' AND dsr_entries.dsr_vidhan_ipc is not null");
        $stmt23 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE criminal_list.sp_id = ? AND  ( criminal_list.criminal_arrest_date BETWEEN ? AND ?) AND criminal_list.arrest_status = ? AND dsr_entries.dsr_vidhan_ipc != ? AND dsr_entries.dsr_vidhan_ipc != '' AND dsr_entries.dsr_vidhan_ipc is not null and dsr_entries.dsr_kaymi_date between ? and ?");
        $stmt23->bind_param("isssiss", $branch_id, $datef, $date1, $arrest_status, $gum, $datef, $date1);
        $stmt23->execute();
        $stmt23->store_result();
        //if($stmt23->num_rows === 0) { echo "No Results"; }
        $stmt23->bind_result($cid23); 
        $stmt23->fetch();
        //echo $cid23;
        $ipc1[29]=$cid23-($ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6]+$ipc1[7]+$ipc1[8]+$ipc1[9]+$ipc1[10]+$ipc1[11]+$ipc1[12]+$ipc1[13]+$ipc1[14]+$ipc1[15]+$ipc1[16]+$ipc1[17]+$ipc1[18]+$ipc1[19]+$ipc1[20]+$ipc1[21]+$ipc1[22]+$ipc1[23]+$ipc1[24]+$ipc1[25]+$ipc1[26]+$ipc1[27]+$ipc1[28]);	
        ?>
        <span><?php echo $ipc1[29];?></span>
        <?php 
        $stmt23->close();
        ?>
        </td>

        <td>0
        <?php
        /*$police_dsr->select_db("ftcaaazc_dsr");
        $stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ");
        $stmt4->bind_param("iiss", $j, $branch_id, $datef, $date1);
        $stmt4->execute();
        $stmt4->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt4->bind_result($cid3); 
        $stmt4->fetch();		
        ?>
        <span><?php echo $cid3;?></span>
        <?php 
        $stmt4->close();*/
        ?>
        </td>

        <td>0
        <?php
        /*$police_dsr->select_db("ftcaaazc_dsr");
        $stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ");
        $stmt5->bind_param("iiss", $j, $branch_id,$datef, $date1);
        $stmt5->execute();
        $stmt5->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt5->bind_result($cid4); 
        $stmt5->fetch();		
        ?>
        <span><?php echo $cid4;?></span>
        <?php 
        $stmt5->close();*/
        ?>
        </td>

        <td>
        <?php
        $x26 = $ipc1[29];
        $y26 = $ipc[29];
        if($y26!=0){
        $percent26 = $x26/$y26;
        }
        else {
        $percent26 = 0;
        }

        $percent_friendly26 = number_format( $percent26 * 100, 2 ) . ' %' ;
        $ipc2[$i] = $percent_friendly26;
        echo $percent_friendly26 ;
        ?>
        </td>

        </tr>
        <tr>

        <td colspan="2">योग</td>

        <td>
        <?php $s=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10]+$ipc[11]+$ipc[12]+$ipc[13]+$ipc[14]+$ipc[15]+$ipc[16]+$ipc[17]+$ipc[18]+$ipc[19]+$ipc[20]+$ipc[21]+$ipc[22]+$ipc[23]+$ipc[24]+$ipc[25]+$ipc[26]+$ipc[27]+$ipc[28]+$ipc[29];
        echo $s;?></td>
        <td>
        <?php $s1=$ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6]+$ipc1[7]+$ipc1[8]+$ipc1[9]+$ipc1[10]+$ipc1[11]+$ipc1[12]+$ipc1[13]+$ipc1[14]+$ipc1[15]+$ipc1[16]+$ipc1[17]+$ipc1[18]+$ipc1[19]+$ipc1[20]+$ipc1[21]+$ipc1[22]+$ipc1[23]+$ipc1[24]+$ipc1[25]+$ipc1[26]+$ipc1[27]+$ipc1[28]+$ipc1[29];
        echo $s1;?>
        </td>
        <td>0</td>
        <td>0</td>
        <td><?php 
        $x4 = $s1;
        $y4 = $s;
        if($y4!=0){
        $percent4 = $x4/$y4;
        }
        else {
        $percent4 = 0;
        }
        $percent_friendly4 = number_format( $percent4 * 100, 2 ) . ' %' ;
        echo $percent_friendly4 ;

        ?></td>
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
