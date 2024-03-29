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
if($stmt->num_rows === 0) exit('No rows');
$stmt->bind_result($id,$branch_name,$city);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Format-17 | File Tracking & Crime Analysis Application </title>
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
      <form action="format17.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
  <option value="<?php echo $id; //echo $get_sql_data['id']?>"><?php echo $branch_name; //echo $get_sql_data['branch_name']?>, <?php echo $city; //echo $get_sql_data['city']?></option>
  <?php
   /*
  } while ($get_sql_data = mysql_fetch_assoc($get_sql));
  $rows = mysql_num_rows($get_sql);
  if($rows > 0) {
      mysql_data_seek($get_sql, 0);
	  $get_sql_data = mysql_fetch_assoc($get_sql);
  }
  */
  }$stmt->close(); //id,branch_name,city FROM branch_tbl close
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
<p align="left" style="float:left;margin-left:-30px;">Format -17</p>
<p align="right"></p>
  <div class="mar10">
  <?php
								//$result1=mysql_query("");
//$data1=mysql_fetch_assoc($result1);
								?>
    <p align="center"><span>अनु.जाति/अनु जनजाति {अत्याचार निवारण} अधिनियम - 1989 के अंतर्गत पंजीबद्ध प्रकरणों के तीस दिवस के अवधि समय में निराकृत न किये जाने वाले प्रकरणों की जानकारी <br /> दि <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
      
<?php
$branch_id = $_POST['sp_office'];
$datef = $_POST['datef'];
  $date1 = $_POST['datel'];	  
  $c_status='निराकृत';
  $a='SC';
  $b='ST';
  $atyachar ='हाँ';
      ?><br/>
<table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
  <tr>
    <td rowspan="">क्र.</td>
    <td colspan="">मियाद प्रकरण</td>
    <td colspan="">थाना</td>
    <td colspan="">अपराध क्रमांक</td>
    <td colspan="">धारा</td>
    <td colspan="">अजा/जजा</td>
    <td colspan="">रिपोर्ट दिनांक</td>
    <td colspan="">अंतिम विवेचना दिनांक</td>
    <td colspan="">विवेचना अधिकारी का नाम एवं पद </td>
    <td colspan="">लंबित रहने का औचित्य/कारण</td>
  </tr>
  
  <tr>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
    <td>9</td>
    <td>10</td>
  </tr>
  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt2 = $police_dsr->prepare("SELECT id,user_id,dsr_crime_no,dsr_crime_year,dsr_main_dhara,dsr_other_dhara,dsr_caste,dsr_kaymi_date,dsr_investigator FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND c_status !=? AND (dsr_caste=? OR dsr_caste=?) AND atyachar_adhiniyam = ?") )  
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("issssss",$branch_id,$datef, $date1,$c_status,$a,$b, $atyachar) )//
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($id,$u_id,$crime,$year,$m_d,$o_d,$dsr_caste,$dsr_kaymi_date,$dsr_investigator); 
	 $j=0;	 
	  while($stmt2->fetch())
	  {
		$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt3 = $police_dsr->prepare("SELECT last_invest_date,lambit_reason FROM lambit_details WHERE dsr_id = ? AND last_invest_date BETWEEN ? AND ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("iss",$id,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($last_invest_date,$lambit_reason); 
    $stmt3->fetch(); 
  $j++;
	?>
  <tr>
    <td><?php echo $j?></td>
    <td>0</td>
    <td><?php 
	$police_dsr->select_db("ftcaaazc_epfts");
	if ( !$stmt4 = $police_dsr->prepare("SELECT branch_name FROM branch_tbl WHERE id = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("i",$u_id) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($branch_name); 
    $stmt4->fetch();?>
	<span><?php echo $branch_name;?></span></td>
    <td><?php echo $crime;?>/<?php echo $year;?></td>
    <td><?php echo $m_d;?>,<?php echo $o_d;?></td>
    <td><?php echo $dsr_caste;?></td>
    <td><?php echo $dsr_kaymi_date;?></td>
	
    <td><?php echo $last_invest_date;?></td>
    <td>
	<?php 
	$police_dsr->select_db("ftcaaazc_epfts");
	if ( !$stmt4 = $police_dsr->prepare("SELECT staff_name FROM staff_details WHERE id = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("i",$u_id) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($staff_name); 
    $stmt4->fetch();?>
	<?php echo $staff_name;?></td>
    <td><?php echo $lambit_reason;?></td>
  </tr>
	  <?php }?>
</table>

    <br /><br />
  
    <br /><br />
    <p style="float:right" align="center"></p>
  </div>
  <?php } ?></div>
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