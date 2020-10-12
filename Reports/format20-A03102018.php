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
<title>Format-20-A | File Tracking & Crime Analysis Application </title>
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
      <form action="format20-A.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
  <p align="left" style="float:left;margin-left:-30px;">Format-20-A</p>
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
    <p align="center"><span>अनुसूचित जाति की महिलाओ पर घटित अपराधों की मासिक जानकारी। <br /> माह - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('m/Y', strtotime($_POST['datef']));
}?> से <?php if ($_POST['datel'] == ''){echo '';} else{echo date('m/Y', strtotime($_POST['datel']));}?> तक  <?php echo " ";?> जिला - <?php echo $city;?></span></p>
      
  <?php	  
  $gender = 'महिला';
  $sc = 'SC';
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  ?>
  
<table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
  <tr>
    <td>क्र.</td>
    <td>अपराध शीर्ष</td>
    <td>प्रकरण संख्या</td>
  </tr>
  
  <?php 
  for ($i=1;$i<=12;$i++)
  {
  ?>
  <tr>
    <td><?php echo $i; ?></td>
	
	<td align="left">
	<?php 
	if ($i===1) { $j = 12 ; echo "बलात्कार 376  क,ख,ग,घ,ड भादवि"; }
    elseif ($i===2){ $j = 59 ; echo "बलात्कार का प्रयास धारा 376, 511 भादवि"; }
	elseif ($i===3){ $j = 40; echo "सामुहिक बलात्‍कार 376 घ भादवि";}  
	elseif ($i===4){ $j = 13 ; $k = 64 ; echo "अपहरण एवं व्यपहरण- 363, 364, 366 भादवि";}
	elseif ($i===5){ $j = 42 ; echo "दहेज हत्या 304 बी भादवि";}
	elseif ($i===6){ $j = 15 ; echo "छेडछाड-धारा 354 क,ख,ग,घ भादवि";}
	elseif ($i===7){ $j = 39 ; echo "लज्जा भंग करना-धारा 509 भादवि"; }
	elseif ($i===8){ $j = 43 ; echo "दहेज प्रताडना 498ए भादवि";}
	elseif ($i===9){ $j = 60 ; echo "विदेश से महिला का आयात करना-धारा 366 बी भादवि";}
	elseif ($i===10){ $j = 41 ; echo "आत्महत्या - धारा 306 भादवि";}
	elseif ($i===11){ $j = 49 ; echo "भ्रूण हत्‍या धारा 312 से 318 भादवि";}
	elseif ($i===12){ $j = 46 ; echo "मानव दुर्व्यापार के अपराध (370, 371, 372, 373 भादवि)";} 
	else { }
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ($i===4)
	{
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND sp_id = ? AND dsr_gender = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("iiissss", $j, $k, $branch_id, $gender, $datef, $date1, $sc) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
	}
    else{
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND dsr_gender = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("iissss", $j, $branch_id, $gender, $datef, $date1, $sc) )
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
	
  </tr>
  
  <?php } //for loop end here ?>

  <tr>
  <td></td>
    <td>विविध अधिनियम के अपराध</td>
  </tr>
  
  <?php 
  for ($m=13;$m<=18;$m++)
  {
  ?>
  <tr>
     
	<td><?php echo $m; ?></td>
	
	<td align="left">
	<?php 
	if ($m===13) { $n = 53 ; echo "बाल विवाह अधिनियम 1929 यथा संशोधित 1976 धारा (3,4,5,6) ";}
    elseif ($m===14){$n = 51 ; echo "दहेज प्रतिषेध अधिनियम 3/4 (1961)" ;}
	elseif ($m===15){ $n = 55 ; echo "सती (निवारण) अधिनियम (1987)";}  
	elseif ($m===16){ $n = 52 ; echo "अनैतिक व्यापार अनिवारण अधिनियम 1956.1986 धारा (3,4,7,8,9)"; }
	elseif ($m===17){ $n = 56 ; echo "घरेलू हिन्‍सा अधिनियम - 2005";}
	elseif ($m===18){ $n = 58 ; echo "लैंगिंक अपराधों से बालकों का संरक्षण अधिनियम (पॉक्सो एक्ट)";}
	else { }
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_minor = ? AND sp_id = ? AND dsr_gender = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->bind_param("iissss", $n, $branch_id, $gender, $datef, $date1, $sc) )
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
	
  </tr>
  
  <?php } // 2 for loop end here ?> 
  
  <tr>
    
    <td colspan="2">योग</td>
    <td>
	<?php $s=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10]+$ipc[11]+$ipc[12]+$ipc10[13]+$ipc10[14]+$ipc10[15]+$ipc10[16]+$ipc10[17]+$ipc10[18];
	echo $s;?></td>
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