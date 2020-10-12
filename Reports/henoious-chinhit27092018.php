<?php require_once('../Connections/dbconnect-m.php');  ?>

<?php 
//ini_set('display_errors', 1);
//error_reporting(-1);
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
<title>DSR - Chinhit Report | File Tracking & Crime Analysis Application </title>
<!-- GLOBAL STYLES -->
<link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
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
      <!--<form action="chinhit-report.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
          <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:110px; display:inline-block" value="<?php echo isset($_POST['datef']) ? $_POST['datef'] : '' ?>" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:110px; display:inline-block" value="<?php echo isset($_POST['datel']) ? $_POST['datel'] : '' ?>" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

        <select name="sp" id="sp" class="validate[required] text-input form-control" style="display:inline-block;width:200px;">
        <option></option>
        <option value="0">ALL</option>
        <?php 
        //while ($stmt->fetch()) 
        //{
        //$id;
        //$branch_name;
        //$city;
        ?>           
        <option value="<?php// echo $id;?>"><?php// echo $branch_name; ?>, <?php// echo $city; ?></option>
        <?php
        //}
        //$stmt->close(); //id,branch_name,city FROM branch_tbl close
        ?>
        </select>
          
        <div class="container" style="width:130px; display:inline-block; text-align:right" id ="office">
        <div class="row">
        <div class="col-lg-12">
        <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" ><span>Select</span> <span class="caret"></span></button> <!--class="glyphicon glyphicon-cog"
        <ul class="dropdown-menu" style="text-align:left">
        <span class="text-danger"  style="font-size:15px">&nbsp;&nbsp;&nbsp; जिला चुने पहले। &nbsp;&nbsp;</span>
        </ul>
        </div>
        </div>
        </div>
        </div>
                      
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" class="btn btn-success" id="mybutton" name="Search" style="display:inline-block">Search</button>
        </div>
      </form>-->
    </div>
  </div>
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
    if(isset($_GET['sp'])!='')
    {
  ?>
  <p align="left" style="float:left;margin-left:-30px;"></p>
  <p align="right"></p>
  <div class="mar10">

  <p align="center"><span>चिन्हित अपराध की जानकारी <br />वर्ष : <?php echo $_GET['year'];?> <br /> ज़ोन इन्दौर </span></p>
      
    
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-100px;text-align:center;" id="print" width="960px">
      <tr>
        <td>क्र.</td>
        <td>जिला</td>
        <td>थाना</td>
        <td>थाना अपराध/मर्ग क्रमांक</td>
        <td>धारा</td>
        <td>फरियादी का नाम एवं पता</td>
        <td>आरोपी का नाम एवं पता</td>
        <td>घटना स्थल</td>
        <td>घटना दिनांक व समय</td>
        <td>कायमी दिनांक व समय</td>
        <td>विलंब से कायमी का कारण</td>
        <td>विवेचक</td>
        <td>घटना के कारण सहित विवरण</td>
        <td>आरोपी गिरफ्तार/फरार</td>
        <td>आरोपी का पूर्व रिकार्ड</td>
        <td>गुण्डा सूचीबद्ध या निगरानी बदमाश है</td>
        <td>क्या उक्त अपराध बाउण्ड ओवर की अवधि में किया गया है</td>
        <td>फरियादी का मोबाईल नम्बर</td>
        <td>एमएलसी में आई चोटों का संक्ष‍िप्त विवरण</td>
        <td>चिन्हित अपराध</td>
        <td></td>
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
      </tr>
        <?php 
        $j=0;	 
        $chinhit="हाँ";
        //$testing = "535";
        $like = "%".$_GET['year']."%";
        $zero = "0";
        if($_GET['sp']==="ALL")
        {
        $police_dsr->select_db("ftcaaazc_dsr");    
        $stmt2 = $police_dsr->prepare("SELECT id,dsr_crime_no,dsr_crime_year,dsr_main_dhara,dsr_other_dhara,dsr_fariyadi_name,dsr_father_name,dsr_address,dsr_crime_place,dsr_crime_date,dsr_crime_time_hhf,dsr_crime_time_mmf,dsr_crime_time_hht,dsr_crime_time_mmt,dsr_kaymi_date,dsr_kaymi_hh,dsr_kaymi_mm,dsr_late_reason,dsr_investigator,dsr_crime_details,dsr_mob_num,dsr_mlc_chot,office_id,dsr_chinhit,sp_id,user_id, dsr_chinhit_date FROM dsr_entries WHERE sp_id != ? AND dsr_chinhit_date LIKE ? AND dsr_chinhit = ? order by office_id,dsr_crime_year");
        $stmt2->bind_param("iss", $zero, $like, $chinhit); // $testing,
        }
        else 
        {
        $police_dsr->select_db("ftcaaazc_dsr");   
        $stmt2 = $police_dsr->prepare("SELECT id,dsr_crime_no,dsr_crime_year,dsr_main_dhara,dsr_other_dhara,dsr_fariyadi_name,dsr_father_name,dsr_address,dsr_crime_place,dsr_crime_date,dsr_crime_time_hhf,dsr_crime_time_mmf,dsr_crime_time_hht,dsr_crime_time_mmt,dsr_kaymi_date,dsr_kaymi_hh,dsr_kaymi_mm,dsr_late_reason,dsr_investigator,dsr_crime_details,dsr_mob_num,dsr_mlc_chot,office_id,dsr_chinhit,sp_id,user_id,dsr_chinhit_date FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit_date LIKE ? AND office_id != ? AND dsr_chinhit = ? order by office_id,dsr_crime_year");
        $stmt2->bind_param("isis",$_GET['sp'], $like, $testing, $chinhit);
        }
        $stmt2->execute();
        $stmt2->store_result();	  
        //if($stmt2->num_rows === 0) exit('No rows');	  
        $stmt2->bind_result($dsr_id, $dsr_crime_no, $dsr_crime_year, $dsr_main_dhara, $dsr_other_dhara, $dsr_fariyadi_name, $dsr_father_name, $dsr_address, $dsr_crime_place, $dsr_crime_date, $dsr_crime_time_hhf, $dsr_crime_time_mmf, $dsr_crime_time_hht, $dsr_crime_time_mmt, $dsr_kaymi_date, $dsr_kaymi_hh, $dsr_kaymi_mm, $dsr_late_reason, $dsr_investigator, $dsr_crime_details, $dsr_mob_num, $dsr_mlc_chot, $office_id1, $dsr_chinhit, $sp_id1, $user_id1, $dsr_chinhit_date);      
        // echo $entries = $stmt2->num_rows;
        while ($stmt2->fetch()) 	  
        {
           
        $j++; 
        $inves = $dsr_investigator ;	   
        ?>
      <tr>

        <td><?php echo $j; ?></td>
        
        <td class="">
        <?php 
        $police_tracking->select_db("ftcaaazc_epfts");
        $stmt = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE id = ?");
        $stmt->bind_param("i", $sp_id1);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows === 0) exit('No rows');
        $stmt->bind_result($id_sp,$branch_name_sp,$city_sp); 
        $stmt->fetch();
        ?>
        <span><?php echo $branch_name_sp; ?>, <?php echo $city_sp; ?></span>
        <?php
        $stmt->close();
        ?>
        </td>
        <td>
        <?php
        //echo $office_id1; 
        $police_tracking->select_db("ftcaaazc_epfts");
        $stmt13 = $police_tracking->prepare("SELECT branch_name FROM branch_tbl WHERE id = ?");
        $stmt13->bind_param("i", $office_id1);
        $stmt13->execute();
        $stmt13->store_result();
        //if($stmt13->num_rows === 0) { echo "No Results"; }
        $stmt13->bind_result($branch_name1); 
        while ($stmt13->fetch()) 
        {					
        ?>
        <span><?php echo $branch_name1;?> <br /></span>
        <?php 
        } $stmt13->close();
        ?>
        </td>
        
        <td class="" style="word-break: break-all;"><?php echo $dsr_crime_no; ?>/<?php echo $dsr_crime_year;?></td>

        <td style="word-break: break-all;"><?php echo $dsr_main_dhara; ?>, <?php echo $dsr_other_dhara; ?></td>
        <td style="word-break: break-all;"><?php echo $dsr_fariyadi_name; ?> पिता/पति <?php echo $dsr_father_name; ?> निवासी <?php echo $dsr_address; ?> </td>
        <td style="word-break: break-all;">
        <?php
        $stmt3 = $police_dsr->prepare("SELECT criminal_name,criminal_add FROM criminal_list WHERE dsr_id = ?");
        $stmt3->bind_param("i", $dsr_id);
        $stmt3->execute();
        $stmt3->store_result();
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt3->bind_result($criminal_name,$criminal_add); 
        while ($stmt3->fetch()) 
        {	
        $criminal_name;   
        $criminal_add;				
        ?>
        <?php echo $criminal_name; echo"-"; echo $criminal_add;	?>,
        <?php 
        } $stmt3->close();
        ?>
        </td>
        <td class="" style="word-break: break-all;"><?php echo $dsr_crime_place;?></td>
        <td class="">
        <?php 
        if ($dsr_crime_date == '')
        {
        echo ''; 
        } else
        { 
        echo date('d-m-y', strtotime($dsr_crime_date));
        }
        ?> 
        <?php echo $dsr_crime_time_hhf;?>:<?php echo $dsr_crime_time_mmf; ?> के <?php echo $dsr_crime_time_hht;?>:<?php echo $dsr_crime_time_mmt;?> बीच 
        </td>
        <td class="">
        <?php 

        if ($dsr_kaymi_date == '')
        {
        echo '';
        } else
        {
        echo date('d-m-y', strtotime($dsr_kaymi_date));
        }
        ?>  

        <?php echo $dsr_kaymi_hh;?>:<?php echo $dsr_kaymi_mm;?> 
        </td>
        <td class=""><?php echo $dsr_late_reason; ?></td>
		
        <td class="" style="word-break: break-all;">
        <?php 
        $police_tracking->select_db("ftcaaazc_epfts");
        //echo $dsr_investigator; 
        $stmt8 = $police_tracking->prepare("SELECT desig, staff_name FROM staff_details WHERE id = ?");
        $stmt8->bind_param("i", $inves);
        $stmt8->execute();
        $stmt8->store_result();		
        //if($stmt7->num_rows === 0) exit('No rows');
        $stmt8->bind_result($desig,$staff_name); 
        while ($stmt8->fetch()) 
        {	     
        ?>
        <?php echo $desig; echo "-"; echo $staff_name;?>,
        <?php 
        } $stmt8->close(); 
        ?>
        </td>
        
	<td class="" style="word-break:break-all;"><?php echo $dsr_crime_details; ?></td>
        <td class="" style="word-break: break-all;">
        <?php
        $stmt4 = $police_dsr->prepare("SELECT criminal_name,arrest_status FROM criminal_list WHERE dsr_id = ?");
        $stmt4->bind_param("i", $dsr_id);
        $stmt4->execute();
        $stmt4->store_result();
        //if($stmt4->num_rows === 0) exit('No rows');
        $stmt4->bind_result($criminal_name,$arrest_status); 
        while ($stmt4->fetch()) 
        {	
        $criminal_name;
        $arrest_status;      
        ?>
        <?php echo $criminal_name; echo "-"; echo $arrest_status;?>,
        <?php 
        } $stmt4->close(); 
        ?>
        </td>
        
        <td class="" style="word-break: break-all;">
        <?php 
        $stmt5 = $police_dsr->prepare("SELECT old_record FROM criminal_list WHERE dsr_id = ?");
        $stmt5->bind_param("i", $dsr_id);
        $stmt5->execute();
        $stmt5->store_result();
        //if($stmt5->num_rows === 0) exit('No rows');
        $stmt5->bind_result($old_record); 
        while ($stmt5->fetch()) 
        {	
        $old_record;      
        ?>
        <?php echo $old_record; ?>,
        <?php  
        } $stmt5->close(); 
        ?>
        </td>
		
        <td class="" style="word-break: break-all;">
        <?php 
        $stmt6 = $police_dsr->prepare("SELECT hs_listed FROM criminal_list WHERE dsr_id = ?");
        $stmt6->bind_param("i", $dsr_id);
        $stmt6->execute();
        $stmt6->store_result();
        //if($stmt6->num_rows === 0) exit('No rows');
        $stmt6->bind_result($hs_listed); 
        while ($stmt6->fetch()) 
        {	
        $hs_listed;      
        ?>
        <?php echo $hs_listed;?>,
        <?php 
        } $stmt6->close(); 
        ?>
        </td>
		
        <td class="" style="word-break: break-all;">
        <?php 
        $stmt7 = $police_dsr->prepare("SELECT bond_over_break FROM criminal_list WHERE dsr_id = ?");
        $stmt7->bind_param("i", $dsr_id);
        $stmt7->execute();
        $stmt7->store_result();
        //if($stmt7->num_rows === 0) exit('No rows');
        $stmt7->bind_result($bond_over_break); 
        while ($stmt7->fetch()) 
        {	
        $bond_over_break;      
        ?>
        <?php echo $bond_over_break;?>,
        <?php 
        } $stmt7->close(); 
        ?>
        </td>
		
        <td style="word-break: break-all;"> <?php echo $dsr_mob_num; ?> </td>
        
        <td class="">
        <?php
        echo $dsr_mlc_chot;
        ?>
        </td>
        
        <td><?php echo $dsr_chinhit; ?> <br /> <?php 

        if ($dsr_chinhit_date == '')
        {
        echo '';
        } else
        {
        echo date('d-m-y', strtotime($dsr_chinhit_date));
        }
        ?> </td>
        

        <td>
        <?php
        if(($_SESSION['MM_UserGroup']==="OM" && $_SESSION['SP']==$sp_id1 )|| $office_id1==$_SESSION['MM_User_Id'] || $office_id1==$_SESSION['Branch Name'])
        {
        ?>
            <a href="../DSR/add-details.php?edt=<?php echo $dsr_id; ?>">Add Details</a>
        <?php
        }
        ?>
        </td>

	</tr>
	<?php 
        } 
        $stmt2->close();	
	?>
    </table>
    <br /><br />
    <br /><br />

          <?php } else{ echo "NO RECORDS!!";} ?>
  </div>

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
 <script>
$("#sp").change(function() {
  $("#office").load("getter.php?choice=" + $("#sp").val());
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