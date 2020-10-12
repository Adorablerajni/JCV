<?php require_once('../Connections/dbconnect-m.php');  ?>
<?php

if(!isset($_SESSION['MM_UserGroup'])) 
    { 
        header("location:../logout.php");
    }
	
	
$police_tracking->select_db("ftcaaazc_epfts");
$a='SP';
$stmt = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE designation = ?");
$stmt->bind_param("s", $a);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows === 0) exit('No rows');
$stmt->bind_result($id,$branch_name,$city);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>P-13 | File Tracking & Crime Analysis Application </title>
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
      <form action="format13.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
    //do {
    while ($stmt->fetch()) 
    { 		
    ?>
    <option value="<?php echo $id; //echo $get_sql_data['id']?>"><?php echo $branch_name;//echo $get_sql_data['branch_name']?>, <?php echo $city; //echo $get_sql_data['city']?></option>
    <?php
	/*
    } while ($get_sql_data = mysql_fetch_assoc($get_sql));
    $rows = mysql_num_rows($get_sql);
    if($rows > 0) {
      mysql_data_seek($get_sql, 0);
	  $get_sql_data = mysql_fetch_assoc($get_sql);
    }
    */
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
<p align="left" style="float:left;margin-left:-30px;">Format -13</p>
<p align="right"></p>
  <div class="mar10">
  <?php
								//$result1=mysql_query("");
//$data1=mysql_fetch_assoc($result1);
								?>
    <p align="center"><span>अजा/अजजा की शिकायत पर पंजिबद्ध अपराध जिनके साथ अन्य अधिनियम की धाराएं लगाई गई हैं । <br /> दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
    <?php 
	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $inactive ='Inactive';  
    ?><br/>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td rowspan="2">क्र.</td>
        <td rowspan="2">अपराध शीर्ष</td>
        <td colspan="2">प्रकरण की संख्या</td>
        <td colspan="2">विवेचना	</td>
        <td colspan="2">बंदी आरोपी</td>
        <td colspan="2">खात्मा</td>
        <td colspan="2">खारजी</td>
        <td colspan="2">न्याया. में प्रस्तुत</td>
        <td colspan="2">दण्डित</td>
        <td colspan="2">दोषमुुक्त</td>
        <td colspan="2">न्याया.में लंबित</td>
        <td colspan="2">विवेचनाधीन</td>
      </tr>
      
      <tr>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      </tr>
        
      <tr>
      <td><strong>(1)</strong></td>
      <td><strong>(2)</strong></td>
      <td><strong>(3)</strong></td>
      <td><strong>(4)</strong></td>
      <td><strong>(5)</strong></td>
      <td><strong>(6)</strong></td>
      <td><strong>(7)</strong></td>
      <td><strong>(8)</strong></td>
      <td><strong>(9)</strong></td>
      <td><strong>(10)</strong></td>
      <td><strong>(11)</strong></td>
      <td><strong>(12)</strong></td>
      <td><strong>(13)</strong></td>
      <td><strong>(14)</strong></td>
      <td><strong>(15)</strong></td>
      <td><strong>(16)</strong></td>
      <td><strong>(17)</strong></td>
      <td><strong>(18)</strong></td>
      <td><strong>(19)</strong></td>
      <td><strong>(20)</strong></td>
      <td><strong>(21)</strong></td>
      <td><strong>(22)</strong></td>
      </tr>
        
        <?php
        $ipc =array('नागरिक अधिकार संरंक्षण अधिनियम 1995','बंधित श्रम पध्दति उत्पादन अधिनियम 1976 सहपठित धारा 370 से 374 तक भादवि','कर्जदार सहायता अधिनियम-1967');	  
        $arrlength=count($ipc);
        for($x=0;$x<$arrlength;$x++)
        {
        ?>
        <tr>
            <td><?php echo $x+1; ?></td>
            <td ><?php echo $ipc[$x];  ?></td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste='SC';
            if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt2->bind_param("issss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt2->execute() ) 
            echo "Execute Error: ($stmt2->errno)  $stmt2->error";
            if ( !$stmt2->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt2->bind_result($cid2); 
            $stmt2->fetch();
            $total[$x+1]=$cid2;
            ?>
            <span><?php echo $cid2;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste='ST';
            if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt3->bind_param("issss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt3->execute() ) 
            echo "Execute Error: ($stmt3->errno)  $stmt3->error";
            if ( !$stmt3->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt3->bind_result($cid3); 
            $stmt3->fetch();
            $total1[$x+1]=$cid3;
            ?>
            <span><?php echo $cid3;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste='SC';
            $c_status="विवेचना में लंबित";
            if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ? AND dsr_status.status != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt4->bind_param("issssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x],$inactive) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt4->execute() ) 
            echo "Execute Error: ($stmt4->errno)  $stmt4->error";
            if ( !$stmt4->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt4->bind_result($cid4); 
            $stmt4->fetch();
            $total2[$x+1]=$cid4;
            ?>
            <span><?php echo $cid4;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste='ST';
            $c_status='विवेचना में लंबित';
            if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ? AND dsr_status.status != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt5->bind_param("issssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x],$inactive) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt5->execute() ) 
            echo "Execute Error: ($stmt5->errno)  $stmt5->error";
            if ( !$stmt5->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt5->bind_result($cid5); 
            $stmt5->fetch();
            $total3[$x+1]=$cid5;
            ?>
            <span><?php echo $cid5;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'SC';
            $c_status='बंदी आरोपी';
            if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt6->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt6->execute() ) 
            echo "Execute Error: ($stmt6->errno)  $stmt6->error";
            if ( !$stmt6->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt6->bind_result($cid6); 
            $stmt6->fetch();
            $total4[$x+1]=$cid6;
            ?>
            <span><?php echo $cid6;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'ST';
            $c_status='बंदी आरोपी';
            if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt7->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt7->execute() ) 
            echo "Execute Error: ($stmt7->errno)  $stmt7->error";
            if ( !$stmt7->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt7->bind_result($cid7); 
            $stmt7->fetch();
            $total5[$x+1]=$cid7;
            ?>
            <span><?php echo $cid7;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'SC';
            $c_status='खात्मा';
            if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt8->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt8->execute() ) 
            echo "Execute Error: ($stmt8->errno)  $stmt8->error";
            if ( !$stmt8->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt8->bind_result($cid8); 
            $stmt8->fetch();
            $total6[$x+1]=$cid8;
            ?>
            <span><?php echo $cid8;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'ST';
            $c_status='खात्मा';
            if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt9->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt9->execute() ) 
            echo "Execute Error: ($stmt9->errno)  $stmt9->error";
            if ( !$stmt9->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt9->bind_result($cid9); 
            $stmt9->fetch();
            $total7[$x+1]=$cid9;
            ?>
            <span><?php echo $cid9;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'SC';
            $c_status ='खारची';
	    $c_status1 ='ख़ारजी';
            if ( !$stmt10 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND (dsr_status.s_status = ? OR dsr_status.s_status = ?) AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt10->bind_param("issssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$c_status1,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt10->execute() ) 
            echo "Execute Error: ($stmt10->errno)  $stmt10->error";
            if ( !$stmt10->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt10->bind_result($cid10); 
            $stmt10->fetch();
            $total8[$x+1]=$cid10;
            ?>
            <span><?php echo $cid10;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'ST';
            $c_status ='खारची';
	    $c_status1 ='ख़ारजी';
            if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND (dsr_status.s_status = ? OR dsr_status.s_status = ?) AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt11->bind_param("issssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$c_status1,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt11->execute() ) 
            echo "Execute Error: ($stmt11->errno)  $stmt11->error";
            if ( !$stmt11->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt11->bind_result($cid11); 
            $stmt11->fetch();
            $total9[$x+1]=$cid11;
            ?>
            <span><?php echo $cid11;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'SC';
            $c_status='न्यायालय में प्रस्तुत';
            if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt12->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt12->execute() ) 
            echo "Execute Error: ($stmt12->errno)  $stmt12->error";
            if ( !$stmt12->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt12->bind_result($cid12); 
            $stmt12->fetch();
            $total10[$x+1]=$cid12;
            ?>
            <span><?php echo $cid12;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'ST';
            $c_status='न्यायालय में प्रस्तुत';
            if ( !$stmt13 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt13->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt13->execute() ) 
            echo "Execute Error: ($stmt13->errno)  $stmt13->error";
            if ( !$stmt13->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt13->bind_result($cid13); 
            $stmt13->fetch();
            $total11[$x+1]=$cid13;
            ?>
            <span><?php echo $cid13;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'SC';
            $c_decision='सजा';
            if ( !$stmt14 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_decision = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt14->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_decision,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt14->execute() ) 
            echo "Execute Error: ($stmt14->errno)  $stmt14->error";
            if ( !$stmt14->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt14->bind_result($cid14); 
            $stmt14->fetch();
            $total12[$x+1]=$cid14;
            ?>
            <span><?php echo $cid14;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'ST';
            $c_decision='सजा';
            if ( !$stmt15 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_decision = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt15->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_decision,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt15->execute() ) 
            echo "Execute Error: ($stmt15->errno)  $stmt15->error";
            if ( !$stmt15->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt15->bind_result($cid15); 
            $stmt15->fetch();
            $total13[$x+1]=$cid15;
            ?>
            <span><?php echo $cid15;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'SC';
            $c_decision='दोषमुक्त';
            if ( !$stmt16 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_decision = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt16->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_decision,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt16->execute() ) 
            echo "Execute Error: ($stmt16->errno)  $stmt16->error";
            if ( !$stmt16->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt16->bind_result($cid16); 
            $stmt16->fetch();
            $total14[$x+1]=$cid16;
            ?>
            <span><?php echo $cid16;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'ST';
            $c_decision='दोषमुक्त';
            if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_decision = ? AND dsr_entries.sc_st_act = ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt17->bind_param("isssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_decision,$ipc[$x]) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt17->execute() ) 
            echo "Execute Error: ($stmt17->errno)  $stmt17->error";
            if ( !$stmt17->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt17->bind_result($cid17); 
            $stmt17->fetch();
            $total15[$x+1]=$cid17;
            ?>
            <span><?php echo $cid17;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'SC';
            $c_status='न्यायालय में लंबित';
            if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ? AND dsr_status.status != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt18->bind_param("issssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x],$inactive) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt18->execute() ) 
            echo "Execute Error: ($stmt18->errno)  $stmt18->error";
            if ( !$stmt18->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt18->bind_result($cid18); 
            $stmt18->fetch();
            $total16[$x+1]=$cid18;
            ?>
            <span><?php echo $cid18;?></span>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $dsr_caste= 'ST';
            $c_status='न्यायालय में लंबित';
            if ( !$stmt19 = $police_dsr->prepare("SELECT COUNT(DISTINCT(dsr_status.dsr_id)) FROM dsr_status INNER JOIN pidit_list ON dsr_status.dsr_id = pidit_list.dsr_id INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND pidit_list.pidit_caste = ? AND dsr_status.s_status = ? AND dsr_entries.sc_st_act = ? AND dsr_status.status != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt19->bind_param("issssss",$_POST['sp_office'],$datef, $date1,$dsr_caste,$c_status,$ipc[$x],$inactive) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt19->execute() ) 
            echo "Execute Error: ($stmt19->errno)  $stmt19->error";
            if ( !$stmt19->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt19->bind_result($cid19); 
            $stmt19->fetch();
            $total17[$x+1]=$cid19;
            ?>
            <span><?php echo $cid19;?></span>
            </td>
            
            <td>
            <?php
            $vivechna_dhin_sc =$cid2-($cid8+$cid10+$cid12);

            $total18[$x+1]=$vivechna_dhin_sc;	
            ?>
            <span><?php echo $vivechna_dhin_sc;?></span>

            </td>

            <td>
            <?php
            $vivechna_dhin_st =$cid3-($cid9+$cid11+$cid13);

            $total19[$x+1]=$vivechna_dhin_st;	
            ?>
            <span><?php echo $vivechna_dhin_st;?></span>

            </td>           
            
        </tr>
    <?php }?>
	
 <tr>
    <td colspan="2">योग</td>
    <td>
	<?php $s=$total[1]+$total[2]+$total[3];
	echo $s;?></td>
	
    <td>
	<?php $n=$total1[1]+$total1[2]+$total1[3];
	echo $n;?></td>
	
    <td>
	<?php $r=$total2[1]+$total2[2]+$total2[3];
	echo $r;?></td>
	
    <td>
	<?php $t=$total3[1]+$total3[2]+$total3[3];
	echo $t;?>
	</td>
    
	<td>
	<?php $u=$total4[1]+$total4[2]+$total4[3];
	echo $u;?>
	</td>
	
    <td>
	<?php $v=$total5[1]+$total5[2]+$total5[3];
	echo $v;?>
	</td>
	
    <td>
	<?php $w=$total6[1]+$total6[2]+$total6[3];
	echo $w;?>
	</td>
	
    <td>
	<?php $x=$total7[1]+$total7[2]+$total7[3];
	echo $x;?>
	</td>
	
    <td>
	<?php $y=$total8[1]+$total8[2]+$total8[3];
	echo $y;?>
	</td>
    <td>
	<?php $z=$total9[1]+$total9[2]+$total9[3];
	echo $z;?>
	</td>
	<td>
	<?php $z1=$total10[1]+$total10[2]+$total10[3];
	echo $z1;?>
	</td>
	<td>
	<?php $z2=$total11[1]+$total11[2]+$total11[3];
	echo $z2;?>
	</td>
	<td>
	<?php $z3=$total12[1]+$total12[2]+$total12[3];
	echo $z3;?>
	</td>
	<td>
	<?php $z4=$total13[1]+$total13[2]+$total13[3];
	echo $z4;?>
	</td>
	<td>
	<?php $z5=$total14[1]+$total14[2]+$total14[3];
	echo $z5;?>
	</td>
	<td>
	<?php $z6=$total15[1]+$total15[2]+$total15[3];
	echo $z6;?>
	</td>
	<td>
	<?php $z7=$total16[1]+$total16[2]+$total16[3];
	echo $z7;?>
	</td>
	<td>
	<?php $z8=$total17[1]+$total17[2]+$total17[3];
	echo $z8;?>
	</td>
	<td>
	<?php $z9=$total18[1]+$total18[2]+$total18[3];
	echo $z9;?>
	</td>
	<td>
	<?php $z10=$total19[1]+$total19[2]+$total19[3];
	echo $z10;?>
	</td>
  </tr>
    </table> <br /><br />
    <?php //} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
}else { ?>

<?php }
	   ?>
   
  
    <br /><br />
    <p style="float:right" align="center"></p>
  </div>
  <?php // } ?></div>
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
