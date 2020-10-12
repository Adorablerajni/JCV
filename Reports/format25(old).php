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
<title>Format-25 | File Tracking & Crime Analysis Application </title>
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
      <form action="format25.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
          <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
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
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
   if(isset($_POST['Search'])!='')
   {
  ?>
<p align="left" style="float:left;margin-left:-30px;">Format-25</p>
<p align="right"></p>
  <div class="mar10">

    <p align="center"><span>अजा. / अजजा. वर्ग के व्यक्तियों एवं सभी वर्ग की महिलाओं पर घटित गंभीर अपराधों एवं मर्ग के संबंध में एफएसएल युनिट अधिकारी द्वारा किये गये घटनास्थल के निरीक्षण का विवरण दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
      <tr>
        <td rowspan="2">क्र.</td>
        <td rowspan="2">जिला</td>
        <td rowspan="2">थाना</td>
        <td rowspan="2">मर्ग क्र./अपराध क्र.</td>
		<td rowspan="2">धारा</td>
        <td colspan="2">अजा/अजजा. के अप. जिनमें एफएसएल. अधिकारी द्वारा घटनास्थल का निरीक्षण </td>
		<td colspan="2">महिलाओं पर घटित अपराध जिनमें एफएसएल. अधिकारी द्वारा घटनास्थल का निरीक्षण </td>
		<td colspan="2">अजा/अजजा. के मर्ग से संबंधित घटनाऐं जिनका निरीक्षण एफएसएल. अधिकारी द्वारा</td>
		<td colspan="2">महिलाओं से संबंधित मर्गों के घटनास्थल का निरीक्षण एफएसएल. अधिकारी द्वारा</td>
		<td rowspan="2">रिमार्क</td>
      </tr>
      <tr>
      <td>किया गया</td>
	  <td>नहीं किया गया तो कारण</td>
	  <td>किया गया</td>
	  <td>नहीं किया गया तो कारण</td>
	  <td>किया गया</td>
	  <td>नहीं किया गया तो कारण</td>
	  <td>किया गया</td>
	  <td>नहीं किया गया तो कारण</td> 
      </tr>
	  <?php
      $police_dsr->select_db("ftcaaazc_dsr");	  
	  $j=0;
	  if ( !$stmt1 = $police_dsr->prepare("SELECT `id`, `marg_no`, `marg_crime_year`, `main_dhara`, `other_dhara`, `sp_id`, `office_id` FROM marg_profarma WHERE marg_date BETWEEN ? AND ? ORDER BY office_id ") ) 
      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt1->bind_param("ss",$datef, $date1) )
      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt1->execute() ) 
      echo "Execute Error: ($stmt1->errno)  $stmt1->error";
	  if ( !$stmt1->store_result() ) //Only for select with bind_result()
      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
      //if($stmt1->num_rows === 0) { echo "No Results"; }
      $stmt1->bind_result($id,$marg_no,$marg_crime_year,$main_dhara,$other_dhara,$sp_id,$office_id); 
	  while($stmt1->fetch())
	  {
      $j++;
	  ?>
      <tr>
        <td><?php echo $j; ?></td>
        
		<td class="">
	<?php
$police_tracking->select_db("ftcaaazc_epfts");	
	if ( !$stmt2 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?") ) 
    echo "Prepare Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt2->bind_param("i", $sp_id) )
    echo "Binding Parameter Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_tracking->errno) $police_tracking->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($branch_id, $branch_name, $city); 
	$stmt2->fetch();
    ?>
		<span><?php echo $branch_name; echo ","; echo $city;?></span>
		<?php
		$stmt2->close();
		?>
		</td>
		
        <td>
	<?php 
$police_tracking->select_db("ftcaaazc_epfts");   	
	if ( !$stmt3 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?") ) 
    echo "Prepare Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt3->bind_param("i", $office_id) )
    echo "Binding Parameter Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_tracking->errno) $police_tracking->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($branch_id1, $branch_name1, $city1); 
	$stmt3->fetch();
    ?>
		<span><?php echo $branch_name1; echo ","; echo $city1;?></span>
		<?php
		$stmt3->close();
		?>		
		</td>
		
		<td><?php echo $marg_no; echo "/"; echo $marg_crime_year;?></td>
		
		<td><?php echo $main_dhara; echo "/"; echo $other_dhara;?></td>
		
		<td>0</td>
		
		<td>0</td>
		
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>

        
      </tr>
      <?php } //stmt1 end here?>
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
