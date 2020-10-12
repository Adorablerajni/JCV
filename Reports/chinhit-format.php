<?php require_once('../Connections/dbconnect-m.php'); 

if(!isset($_SESSION['MM_UserGroup'])) 
    { 
        header("location:../logout.php");
    }

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Format-Chinhit | File Tracking & Crime Analysis Application </title>
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
      <form action="chinhit-format.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-12 navStuff" style="padding:15px 5px;margin:0px auto;width:960px;">    
        <div class="col-lg-12 navStuff">  &nbsp; 
         <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datef']) ? $_POST['datef'] : '' ?>" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datel']) ? $_POST['datel'] : '' ?>" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

    <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:none;width:220px;">
    <option value="0"></option>
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
<p align="left" style="float:left;margin-left:-30px;">Chinhit Format</p>
<p align="right"></p>
  <div class="mar10">
  <?php   	
    $sp='SP';
    $sp_id = '6';
    $stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ? and zone = ?"); // and id != ?
    $stmt1->bind_param("ss", $sp, $_SESSION['MM_Zone']); //, $sp_id
    $stmt1->execute();
    $stmt1->store_result();
    if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name, $city);
  ?>
    <p align="center"><span>चिन्हित जघन्य / सनसनीखेज अपराधों की जानकारी दि <?php if ($_POST['datef'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?>  से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> तक &nbsp;&nbspकी स्थिति  इंदौर जोन इंदौर </span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $chinhit ='हाँ';
  $month = date('m', strtotime($date1));
  $year = date('Y', strtotime($date1));
  $testing = "535";
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
        <td width="200px">जिला</td>
        <td>वर्ष का लक्ष्य</td>
        <td>वर्ष में चिन्हित</td>
        <td>माह का निर्धारित लक्ष्य</td>
        <td>माह में चिन्हित</td>
        <td>माह में निर्णित</td>
        <td>सजा</td>
        <td>बरी</td>
        <td>सजा का प्रतिशत</td>
        <td>बरी का प्रतिशत</td>
        <td>आगामी माह का निर्धारित लक्ष्य </td>
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
      </tr>
	  <?php 
	  $i=0;	 
	  while($stmt1->fetch())
	  {
           $i++;
	  ?>
            <tr>
            <td><?php echo $i; ?></td>

            <td class="" style="text-align:left"><?php echo $branch_name; echo ", "; echo $city;?></td>

            <td>15</td>

            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            //$year18 ='2018';
            $like = "%" . $year . "%";
            if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_chinhit_date LIKE ? AND office_id != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt2->bind_param("issi", $branch_id, $chinhit, $like, $testing) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt2->execute() ) 
            echo "Execute Error: ($stmt2->errno)  $stmt2->error";
            if ( !$stmt2->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt2->num_rows === 0) { echo "No Results"; }
            $stmt2->bind_result($cid2); 
            $stmt2->fetch();
            $ipc1[$i]=$cid2;
            ?>
            <span><?php echo $cid2;?></span>
            <?php
            $stmt2->fetch();
            ?>
            </td>
            
            <td align="center">
            <?php 
            if($month=='03' OR $month=='06' OR $month=='09')
            {
            echo '2'; 
            }
            else
            {
            echo '1'; 
            }
            ?>
            </td>
            
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit_date BETWEEN ? AND ? AND dsr_chinhit = ? AND office_id != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt3->bind_param("isssi", $branch_id, $datef, $date1, $chinhit, $testing) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt3->execute() ) 
            echo "Execute Error: ($stmt3->errno)  $stmt3->error";
            if ( !$stmt3->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt3->bind_result($cid3); 
            $stmt3->fetch();
            $ipc3[$i]=$cid3;
            ?>
            <span><?php echo $cid3;?></span>
            <?php
            $stmt3->close();
            ?>		
            </td>

            <td>
            <?php
            $nirakrat='निराकृत';
            $police_dsr->select_db("ftcaaazc_dsr");
            if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND c_status_date BETWEEN ? AND ? AND c_status = ? AND dsr_chinhit = ? AND dsr_chinhit_date is not null AND office_id != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt4->bind_param("issssi", $branch_id, $datef, $date1, $nirakrat, $chinhit, $testing) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt4->execute() ) 
            echo "Execute Error: ($stmt4->errno)  $stmt4->error";
            if ( !$stmt4->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt4->num_rows === 0) { echo "No Results"; }
            $stmt4->bind_result($cid4); 
            $stmt4->fetch();
            $ipc4[$i]=$cid4;
            ?>
            <span><?php echo $cid4;?></span>
            <?php
            $stmt4->close();
            ?>		
            </td>
            
            <td>
            <?php
            $saja='सजा';
            $police_dsr->select_db("ftcaaazc_dsr");
            if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND c_status_date BETWEEN ? AND ? AND c_decision = ? AND dsr_chinhit = ? AND dsr_chinhit_date is not null AND office_id != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt5->bind_param("issssi", $branch_id, $datef, $date1, $saja, $chinhit, $testing) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt5->execute() ) 
            echo "Execute Error: ($stmt5->errno)  $stmt5->error";
            if ( !$stmt5->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt5->num_rows === 0) { echo "No Results"; }
            $stmt5->bind_result($cid5); 
            $stmt5->fetch();
            $ipc5[$i]=$cid5;
            ?>
            <span><?php echo $cid5;?></span>
            <?php
            $stmt5->close();
            ?>		
            </td>
            
            <td>
            <?php
            $doshmukt='दोषमुक्त';
            $police_dsr->select_db("ftcaaazc_dsr");
            if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND c_status_date BETWEEN ? AND ? AND c_decision = ? AND dsr_chinhit = ? AND dsr_chinhit_date is not null AND office_id != ?") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt6->bind_param("issssi", $branch_id, $datef, $date1, $doshmukt, $chinhit, $testing) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt6->execute() ) 
            echo "Execute Error: ($stmt6->errno)  $stmt6->error";
            if ( !$stmt6->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt6->num_rows === 0) { echo "No Results"; }
            $stmt6->bind_result($cid6); 
            $stmt6->fetch();
            $ipc6[$i]=$cid6;
            ?>
            <span><?php echo $cid6;?></span>
            <?php
            $stmt6->close();
            ?>		
            </td>
            
            <td>
            <?php	
            $x7 = $cid5;
            $y7 = $cid4;
            if($y7!=0){
            $percent7 = $x7/$y7;
            }
            else 
            {
            $percent7 = 0;
            }
            $percent_friendly7 = number_format( $percent7 * 100, 2 ) . ' %' ;
            echo $percent_friendly7 ;
            ?>
            </td>
            
            <td>
            <?php	
            $x8 = $cid6;
            $y8 = $cid4;
            if($y8!=0){
            $percent8 = $x8/$y8;
            }
            else 
            {
            $percent8 = 0;
            }
            $percent_friendly8 = number_format( $percent8 * 100, 2 ) . ' %' ;
            echo $percent_friendly8 ;
            ?>
            </td>
            
            <td align="center">
            <?php 
            if($month=='02' OR $month=='05' OR $month=='08')
            {
            echo '2'; 
            }
            else
            {
            echo '1'; 
            }
            ?>
            </td>

            </tr>
            <?php 
            } //stmt1 end here
            $stmt1->close();
            ?>
        
            <tr>
            <td colspan="2">योग</td>
            <td>135
            <?php// $s=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10];
            //echo $s;?></td>

            <td>
            <?php $n=$ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6]+$ipc1[7]+$ipc1[8]+$ipc1[9]+$ipc1[10];
            echo $n;?></td>

            <td>
            <?php 
            if($month=='03' OR $month=='06' OR $month=='09')
            {
            echo '18'; 
            }
            else
            {
            echo '9'; 
            }
            ?>
            <?php// $r=$ipc2[1]+$ipc2[2]+$ipc2[3]+$ipc2[4]+$ipc2[5]+$ipc2[6]+$ipc2[7]+$ipc2[8]+$ipc2[9]+$ipc2[10];
            //echo $r;?></td>

            <td>
            <?php $t=$ipc3[1]+$ipc3[2]+$ipc3[3]+$ipc3[4]+$ipc3[5]+$ipc3[6]+$ipc3[7]+$ipc3[8]+$ipc3[9]+$ipc3[10];
            echo $t;?>
            </td>

            <td>
            <?php $u=$ipc4[1]+$ipc4[2]+$ipc4[3]+$ipc4[4]+$ipc4[5]+$ipc4[6]+$ipc4[7]+$ipc4[8]+$ipc4[9]+$ipc4[10];
            echo $u;?>
            </td>

            <td>
            <?php $v=$ipc5[1]+$ipc5[2]+$ipc5[3]+$ipc5[4]+$ipc5[5]+$ipc5[6]+$ipc5[7]+$ipc5[8]+$ipc5[9]+$ipc5[10];
            echo $v;?>
            </td>

            <td>
            <?php $w=$ipc6[1]+$ipc6[2]+$ipc6[3]+$ipc6[4]+$ipc6[5]+$ipc6[6]+$ipc6[7]+$ipc6[8]+$ipc6[9]+$ipc6[10];
            echo $w;?>
            </td>

            <td>
            <?php	
            $x9 = $v;
            $y9 = $u;
            if($y9!=0){
            $percent9 = $x9/$y9;
            }
            else 
            {
            $percent9 = 0;
            }
            $percent_friendly9 = number_format( $percent9 * 100, 2 ) . ' %' ;
            echo $percent_friendly9 ;
            ?>
            </td>

            <td>
            <?php	
            $x10 = $w;
            $y10 = $u;
            if($y10!=0){
            $percent10 = $x10/$y10;
            }
            else 
            {
            $percent10 = 0;
            }
            $percent_friendly10 = number_format( $percent10 * 100, 2 ) . ' %' ;
            echo $percent_friendly10 ;
            ?>
            </td>
            
            <td>
            <?php 
            if($month=='02' OR $month=='05' OR $month=='08')
            {
            echo '18'; 
            }
            else
            {
            echo '9'; 
            }
            ?>
            <?php// $z=$ipc9[1]+$ipc9[2]+$ipc9[3]+$ipc9[4]+$ipc9[5]+$ipc9[6]+$ipc9[7]+$ipc9[8]+$ipc9[9]+$ipc9[10];
            //echo $z;?>
            </td>

            </tr>
    </table>
    
    <br /><br />
  
    <br /><br />
    <p style="float:right" align="center"></p>
  </div>
  <?php } //search end here ?></div>
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
