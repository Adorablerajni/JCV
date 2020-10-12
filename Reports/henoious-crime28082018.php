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
<title>Format-Henoious-Crime| File Tracking & Crime Analysis Application </title>
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
      <form action="henoious-crime.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
          <!--<label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datef']) ? $_POST['datef'] : '' ?>" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datel']) ? $_POST['datel'] : '' ?>" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;-->
          &nbsp;&nbsp;&nbsp;&nbsp;
    <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:inline-block;width:320px;" readonly="readonly">
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
        <option value="0">All</ooption>
	<?php
    while ($stmt->fetch()) 
    { 	
    ?>
    <option value="<?php echo $id; //echo $get_sql_data['id']?>"><?php echo $branch_name; //echo $get_sql_data['branch_name']?>, <?php echo $city; //echo $get_sql_data['city']?></option>
    <?php
   
    }$stmt->close(); //id,branch_name,city FROM branch_tbl close
    ?>
    </select>
                      
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
<p align="left" style="float:left;margin-left:-30px;"></p>
<p align="right"></p>
  <div class="mar10">
  <?php 
    $stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?");
    $stmt1->bind_param("s", $_POST['sp_office']);
    $stmt1->execute();
    $stmt1->store_result();
    //if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name1, $city1);
    $stmt1->fetch();
  ?>
    <?php /* <p align="center"><span>माह - <?php if ($_POST['datef'] == ''){echo '';} else{echo date('m/Y', strtotime($_POST['datef']));
}?> से  <?php if ($_POST['datel'] == ''){echo '';} else{echo date('m/Y', strtotime($_POST['datel']));}?><br /><?php if ($_POST['sp_office'] != 0){ ?> जिला - <?php echo $branch_name1; echo ", "; echo $city1; } else { echo "इन्दौर जोन"; }?> </span></p> */ ?>
 
    <p align="center"><span> चिन्हित अपराध <br /> वर्ष : 2008 - 2018 <br /><?php if ($_POST['sp_office'] != 0){ ?> जिला - <?php echo $branch_name1; echo ", "; echo $city1; } else { echo "इन्दौर जोन"; }?> </span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $chinhit ='हाँ';
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
    <tr>
    <td>क्र.</td>
    <td>विषय</td>
    <td>2008</td>
    <td>2009</td>
    <td>2010</td>
    <td>2011</td>
    <td>2012</td>
    <td>2013</td>
    <td>2014</td>
    <td>2015</td>
    <td>2016</td>
    <td>2017</td>
    <td>2018</td>
    <td>कुल योग</td>
    </tr>
	  
	 <?php 
  for ($i=1;$i<=13;$i++)
  {	 
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    
	<td align="left">
	<?php 
	if ($i===1) { $j = 'NULL' ; $l='c_status'; echo "कुल चिन्हित प्रकरण" ;}
        elseif ($i===2){$j ='विवेचना में लंबित' ; $l='c_status'; echo "विवेचना में लंबित प्रकरण"; }
	elseif ($i===3){$j ='खात्मा' ; $l='c_status'; echo "खात्मा";}  
	elseif ($i===4){ $j ='न्यायालय में प्रस्तुत' ; $l='c_status'; echo "न्यायालय में प्रस्तुत प्रकरण";}
	elseif ($i===5){$j ='निराकृत' ; $l='c_status'; echo "निराकृत प्रकरण";}
	elseif ($i===6){$j ='न्यायालय में लंबित' ; $l='c_status'; echo "न्यायालय में लंबित प्रकरण";}
	elseif ($i===7){$j ='सजा' ; $l='c_decision'; echo "सजा हुए प्रकरण";}
	elseif ($i===8){$j ='आजीवन कारावास' ; $l='c_punish'; echo "कुल आजीवन करावास (आरोपियो की संख्या)";} 
	elseif ($i===9){$j ='मृत्युदण्ड' ; $l='c_punish'; echo "कुल म़त्यू दण्ड (आरोपियो की संख्या)";}
	elseif ($i===10){$j ='अन्य दोषसिद्धि' ; $l='c_punish'; echo "अन्य दोषसिद्धी के प्रकरण";}
	elseif ($i===11){$j ='दोषमुक्त' ; $l='c_decision'; echo " दोषमुक्त हुये प्रकरण";}
	elseif ($i===12){$j ='नस्तीबद्ध' ; $l='c_decision'; echo "न्यायालय द्वारा नस्तीबद्ध";}
	elseif ($i===13){$j ='समिति द्वारा पृथक' ; $l='c_decision'; echo "समिति द्वारा पृथक किये गये";}
	
	else { }
	?>
	</td>
	<?php
        if($_POST['sp_office'] != 0)	
        {
            $year='2008';
            for($k=0;$k<=10;$k++)
            {
        ?>
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            //$year18 ='2018';
            $like = "%" . $year . "%";
            if($i===1)
            {
            if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(DISTINCT(id)) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_chinhit_date LIKE ? and dsr_chinhit_date !='' ") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt12->bind_param("iss", $branch_id, $chinhit, $like) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            }
            else
            {
            if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(DISTINCT(id)) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_chinhit_date LIKE ? AND $l = ? and dsr_chinhit_date !='' ") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt12->bind_param("isss", $branch_id, $chinhit, $like, $j) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            }
            if ( !$stmt12->execute() ) 
            echo "Execute Error: ($stmt11->errno)  $stmt11->error";
            if ( !$stmt12->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt12->bind_result($cid12); 
            $stmt12->fetch();
            $result[$k]=$cid12;
            if($i===1)
            {
            ?>
            <span><a href="henoious-chinhit.php?year=<?php echo $year ;?>&sp=<?php echo $branch_id ;?>" target="_new"><?php echo $cid12;?></a></span><br />
            <?php
            }
            else 
            {
            ?>
            <span><?php echo $cid12;?></span><br />
            <?php
            }
            ?>
            </td>
	<?php
            $year++;
            }
        }
        else   
        {
            $year='2008';
            for($k=0;$k<=10;$k++)
            {
        ?>
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            //$year18 ='2018';
            $like = "%" . $year . "%";
            if($i===1)
            {
            if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(DISTINCT(id)) FROM dsr_entries WHERE dsr_chinhit = ? AND dsr_chinhit_date LIKE ? and dsr_chinhit_date !='' ") )  //sp_id = ? AND 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt12->bind_param("ss", $chinhit, $like) ) //$branch_id, 
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            }
            else
            {
            if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(DISTINCT(id)) FROM dsr_entries WHERE dsr_chinhit = ? AND dsr_chinhit_date LIKE ? AND $l = ? and dsr_chinhit_date !='' ") )  //sp_id = ? AND 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt12->bind_param("sss", $chinhit, $like, $j) ) //$branch_id,
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            }
            if ( !$stmt12->execute() ) 
            echo "Execute Error: ($stmt11->errno)  $stmt11->error";
            if ( !$stmt12->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt12->bind_result($cid12); 
            $stmt12->fetch();
            $result[$k]=$cid12;
            if($i===1)
            {
            ?>
            <span><a href="henoious-chinhit.php?year=<?php echo $year ;?>&sp=<?php echo "ALL" ;?>" target="_new"><?php echo $cid12;?></a></span><br />
            <?php
            }
            else 
            {
            ?>
            <span><?php echo $cid12;?></span><br />
            <?php
            }
            ?>
            </td>
        <?php
            $year++;
            }
        }
        ?>
    
	<td>
	<?php 
	$sum = $result[0]+$result[1]+$result[2]+$result[3]+$result[4]+$result[5]+$result[6]+$result[7]+$result[8]+$result[9]+$result[10]; 
	echo $sum;
	?>
	</td>
    </tr>
	<?php } //for loop end here ?>
	
	<tr style="display:none">
	 <td>14</td>
	 <td align="left"><?php echo "सजा का प्रतिशत";?></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	 <td></td>
	  </tr>
      <?php //} //stmt1 end here?>
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
