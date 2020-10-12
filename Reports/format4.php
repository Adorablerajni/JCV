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
<title>P4 | File Tracking & Crime Analysis Application </title>
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
      <form action="format4.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
       <div class="col-lg-12 navStuff" style="padding:15px 5px;margin:0px auto;width:960px;">    
        <div class="col-lg-12 navStuff">  &nbsp; 
         <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datef']) ? $_POST['datef'] : '' ?>" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datel']) ? $_POST['datel'] : '' ?>" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

            <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:inline-block;width:220px;" >
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
	<option value="0"></option>
 <?php 
  //do {  
  while ($stmt->fetch()) 
  {
 ?>  
  <option value="<?php echo $id; //echo $get_sql_data['id']?>"><?php echo $branch_name; //echo $get_sql_data['branch_name']?>, <?php echo $city;//echo $get_sql_data['city']?></option>
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
<p align="left" style="float:left;margin-left:-30px;">Format -4</p>
<p align="right"></p>
  <div class="mar10">
    <?php
	if($_POST['sp_office'] != 0)	
	{
    $stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE id = ?");
    $stmt1->bind_param("i", $_POST['sp_office']);
	}
	else
	{ 
	$sp='SP';
	$stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
    $stmt1->bind_param("s", $sp);
	}
    $stmt1->execute();
    $stmt1->store_result();
    //if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name, $city);       	
    ?>
    <p align="center"><span>चोरियों का वर्गीकरण दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
      

    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
        <td>जिला</td>
        <td>तांबा तार</td>
        <td>मवेशी</td>
        <td>मोटर वाहन <br /> एवं सामग्री</td>
        <td>सायकिल</td>
        <td>शस्त्र</td>
        <td>विस्फोटक पदार्थ</td>
        <td>सांस्कृतिक एवं पुरातत्व <br />महत्व की संपत्ति</td>
        <td>अन्य प्रकार की चोरी</td>
        <td>योग</td>     
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
      
      </tr>
	  
     <?php  
     $j=0;	 
	 while($stmt1->fetch())
	 {
		 $j++;
	 ?>
      <tr>
        <td><?php echo $j; ?></td>	  
        
		<td class=""><?php echo $branch_name; echo ","; echo $city;?></td>

        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$a='तांबा तार' ;
		if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
		echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->bind_param("siss", $a, $branch_id, $_POST['datef'], $_POST['datel']) )
		echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
		if ( !$stmt2->execute() ) 
        echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	    if ( !$stmt2->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt2->bind_result($id1); 
        $stmt2->fetch();
        $sum2 = $id1;		
		?>
		<span><?php echo $id1;?></span>
		<?php 
		$stmt2->close();
		?>
		</td>
        
		<td class="">
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$b ='मवेशी' ;
		$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt3->bind_param("siss", $b, $branch_id, $_POST['datef'], $_POST['datel']);
        $stmt3->execute();
        $stmt3->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt3->bind_result($id2); 
        $stmt3->fetch();
        $sum3 = $id2;		
		?>
		<span><?php echo $id2;?></span>
		<?php 
		$stmt3->close();
		?>
		</td>
		
        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$c ='सामग्री' ;
		$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt4->bind_param("siss", $c, $branch_id, $_POST['datef'], $_POST['datel']);
        $stmt4->execute();
        $stmt4->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt4->bind_result($id3); 
        $stmt4->fetch(); 
        $sum4 =	$id3;	
        
        $two_wheeler = '69';
	    $four_wheeler = '70';
		$stmt5n = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? or dsr_vidhan_ipc = ?)");
		$stmt5n->bind_param("issii",  $branch_id, $_POST['datef'], $_POST['datel'], $two_wheeler, $four_wheeler);
        $stmt5n->execute();
        $stmt5n->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt5n->bind_result($id4n); 
        $stmt5n->fetch();
         $sum5n = $id4n;
        //echo "-";
		?>
		<span><?php echo $ttl = $id4n + $id3;?></span>
		<?php 
		$stmt5n->close();
		$stmt4->close();
		?>
		</td>
        
		<td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$d ='साइकिल' ;
		$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt5->bind_param("siss", $d, $branch_id, $_POST['datef'], $_POST['datel']);
        $stmt5->execute();
        $stmt5->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt5->bind_result($id4); 
        $stmt5->fetch();
        $sum5 = $id4;
        
        
		?>
		<span><?php echo $id4;?></span>
		<?php 
		
		$stmt5->close();
		?>
		</td>
		
        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$e ='शस्त्र' ;
		$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt6->bind_param("siss", $e, $branch_id, $_POST['datef'], $_POST['datel']);
        $stmt6->execute();
        $stmt6->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt6->bind_result($id5); 
        $stmt6->fetch(); 
        $sum6 = $id5;
		?>
		<span><?php echo $id5;?></span>
		<?php 
		$stmt6->close();
		?>
		</td>
        
		<td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$f ='विस्फोटक पदार्थ' ;
		$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt7->bind_param("siss", $f, $branch_id, $_POST['datef'], $_POST['datel']);
        $stmt7->execute();
        $stmt7->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt7->bind_result($id6); 
        $stmt7->fetch();
        $sum7 = $id6;		
		?>
		<span><?php echo $id6;?></span>
		<?php 
		$stmt7->close();
		?>
		</td>
        
		<td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$g ='सांस्कृतिक एवं पुरातत्व महत्व की' ;
		$stmt8 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt8->bind_param("siss", $g, $branch_id, $_POST['datef'], $_POST['datel']);
        $stmt8->execute();
        $stmt8->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt8->bind_result($id7); 
        $stmt8->fetch(); 
        $sum8 = $id7;		
		?>
		<span><?php echo $id7;?></span>
		<?php 
		$stmt8->close();
		?>
		</td>
		
        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$h ='अन्य प्रकार की चोरी' ;
		$stmt9 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt9->bind_param("siss", $h, $branch_id, $_POST['datef'], $_POST['datel']);
        $stmt9->execute();
        $stmt9->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt9->bind_result($id8); 
        $stmt9->fetch();
        $sum9 = $id8;
        
        $theft = '9';
        $two_wheeler = '69';
	    $four_wheeler = '70';
        $stmt9_others = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (theft_category ='' or theft_category is null) and sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? and dsr_vidhan_ipc != ? and dsr_vidhan_ipc != ?)");
		$stmt9_others->bind_param("issiii", $branch_id, $_POST['datef'], $_POST['datel'], $theft, $two_wheeler, $four_wheeler);
        $stmt9_others->execute();
        $stmt9_others->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt9_others->bind_result($id8_others); 
        $stmt9_others->fetch();
        $sum9_others = $id8_others;
        //echo "-";
		?>
		<span><?php echo $other_ttl = $id8_others- ($id1 + $id2 + $id4 + $id5 + $id6 + $id7);?></span>
		<?php 
		$stmt9_others->close();
		$stmt9->close();
		?>
		</td>
		
        <td>
		<?php 
		$total = $sum9_others+$sum5n;
		echo $total;
		?>
		</td>
        
      </tr>
      
     <?php 
	 }	  
     ?>

      <?php 
	  if($_POST['sp_office'] === '0')	
	  {
	   ?>
      <tr>
        
        <td colspan="2">योग</td>
        
		<td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$aa ='तांबा तार' ;
		$stmt22 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt22->bind_param("sss", $aa, $_POST['datef'], $_POST['datel']);
        $stmt22->execute();
        $stmt22->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt22->bind_result($id11); 
        $stmt22->fetch(); 
        $tamba_sum = $id11 ;		
		?>
		<span><?php echo $id11;?></span>
		<?php 
		$stmt22->close();
		?>
		</td>
        
		<td class="">
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$bb ='मवेशी' ;
		$stmt33 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt33->bind_param("sss", $bb, $_POST['datef'], $_POST['datel']);
        $stmt33->execute();
        $stmt33->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt33->bind_result($id22); 
        $stmt33->fetch(); 
		$maveshi_sum = $id22 ;
		?>
		<span><?php echo $id22;?></span>
		<?php 
		$stmt33->close();
		?>
		</td>
        
		<td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$cc ='सामग्री' ;
		$stmt44 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt44->bind_param("sss", $cc, $_POST['datef'], $_POST['datel']);
        $stmt44->execute();
        $stmt44->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt44->bind_result($id33); 
        $stmt44->fetch(); 
        $samagri_sum = $id33 ;	
        
        $two_wheeler = '69';
	    $four_wheeler = '70';
		$stmt5m = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? or dsr_vidhan_ipc = ?)");
		$stmt5m->bind_param("ssii", $_POST['datef'], $_POST['datel'], $two_wheeler, $four_wheeler);
        $stmt5m->execute();
        $stmt5m->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt5m->bind_result($id4m); 
        $stmt5m->fetch();
         $sum5m = $id4m;
		?>
		<span><?php echo $ttl1 = $id4m + $id33;?></span>
		<?php 
		$stmt5m->close();
		$stmt44->close();
		?>
		</td>
		
        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$dd ='साइकिल' ;
		$stmt55 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt55->bind_param("sss", $dd, $_POST['datef'], $_POST['datel']);
        $stmt55->execute();
        $stmt55->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt55->bind_result($id44); 
        $stmt55->fetch(); 
 		$cycle_sum = $id44 ;
		?>
		<span><?php echo $id44;?></span>
		<?php 
		$stmt55->close();
		?>
		</td>
		
        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$ee ='शस्त्र' ;
		$stmt66 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt66->bind_param("sss", $ee, $_POST['datef'], $_POST['datel']);
        $stmt66->execute();
        $stmt66->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt66->bind_result($id55); 
        $stmt66->fetch();
        $shastra_sum = $id55 ;		
		?>
		<span><?php echo $id55;?></span>
		<?php 
		$stmt66->close();
		?>
		</td>
		
        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$ff ='विस्फोटक पदार्थ' ;
		$stmt77 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt77->bind_param("sss", $ff, $_POST['datef'], $_POST['datel']);
        $stmt77->execute();
        $stmt77->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt77->bind_result($id66); 
        $stmt77->fetch(); 
		$visfotak_sum = $id66 ;
		?>
		<span><?php echo $id66; ?></span>
		<?php 
		$stmt77->close();
		?>
		</td>
		
        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$gg ='सांस्कृतिक एवं पुरातत्व महत्व की' ;
		$stmt88 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt88->bind_param("sss", $gg, $_POST['datef'], $_POST['datel']);
        $stmt88->execute();
        $stmt88->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt88->bind_result($id77); 
        $stmt88->fetch();
        $sanskrtik_sum = $id77 ;		
		?>
		<span><?php echo $id77;?></span>
		<?php 
		$stmt88->close();
		?>
        </td>
		
        <td>
		<?php
		$police_dsr->select_db("ftcaaazc_dsr");
		$hh ='अन्य प्रकार की चोरी' ;
		$stmt99 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE theft_category = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
		$stmt99->bind_param("sss", $hh, $_POST['datef'], $_POST['datel']);
        $stmt99->execute();
        $stmt99->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt99->bind_result($id88); 
        $stmt99->fetch(); 
        $anyachori_sum = $id88 ;	
        
        $theft = '9';
        $two_wheeler = '69';
	    $four_wheeler = '70';
        $stmt9_others_ttl = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (theft_category ='' or theft_category is null) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? and dsr_vidhan_ipc != ? and dsr_vidhan_ipc != ?)");
		$stmt9_others_ttl->bind_param("ssiii", $_POST['datef'], $_POST['datel'], $theft, $two_wheeler, $four_wheeler);
        $stmt9_others_ttl->execute();
        $stmt9_others_ttl->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt9_others_ttl->bind_result($id8_others_ttl); 
        $stmt9_others_ttl->fetch();
        $sum9_others_ttl = $id8_others_ttl;
        //echo "-";
		?>
		<span><?php echo $sum_other_ttl = $id8_others_ttl - ($id11 + $id22 + $id44 + $id55 + $id66 + $id77);?></span>
		
		<?php 
		$stmt9_others_ttl->close();
		$stmt99->close();
		?>
		</td>
		
        <td>
		<?php 
		$all_total = $ttl1+ $sum9_others_ttl;
		echo $all_total;
		?>
		</td>
      
	  </tr>
	<?php
	}
	?>
    </table>
    
    <br /><br />
  
    <br /><br />
    <p style="float:right" align="center"></p>
	  <?php //} ?>
  </div>
  <?php } // search query end?> 
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