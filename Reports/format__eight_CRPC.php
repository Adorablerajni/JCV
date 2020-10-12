<?php
    require_once('../Connections/dbconnect-m.php');
     
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
        <title>Format8-CRPC| File Tracking & Crime Analysis Application </title>
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
                    <input type='button' value='Print this page' onClick='window.print()' class="btn btn-warning">   </span>
                </p>
            </form>
        </div>
        <div class="row">
        <div class="col-lg-12 label-primary" style="color:#FFF">
            <form action="" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
                <div class="col-lg-12 navStuff" style="padding:15px 5px;margin:0px auto;width:960px;">
                    <div class="col-lg-12 navStuff">
                        &nbsp; 
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
        <div class="">
            <div class="clearfix"></div>
            <br />
            <div id="download">
                <?php
                    if(isset($_POST['Search'])!='')
                    {
                    ?>
                <!--<p align="left" style="float:left;margin-left:-30px;">format8-CRPC</p>-->
                <p align="right"></p>
                <div class="mar10">
                    <?php 
                        $sp='SP';
                        $police_tracking->select_db("ftcaaazc_epfts");
                        $stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
                           $stmt1->bind_param("s", $sp);
                           $stmt1->execute();
                           $stmt1->store_result();
                           //if($stmt1->num_rows === 0) exit('No rows');
                           $stmt1->bind_result($branch_id, $branch_name, $city);
                        ?>
                    <p align="center"><span>&nbsp;&nbsp;&nbsp;&nbsp;(7). (अ) प्रतिबन्धात्मक कार्यवाही  <br /> दिनांक - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d/m/Y', strtotime($_POST['datef']));
                        }?> से <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d/m/Y', strtotime($_POST['datel']));}?>&nbsp;&nbsp;तक  इन्दौर जोन</span></p>
                    <br />
                    <?php	  
                        $datef = $_POST['datef'];
                        $date1 = $_POST['datel'];
                        $newDate1 =date ("Y-m-d", strtotime ($datef ."-16 days"));
                        $newyear1=date ("Y", strtotime ($datef ."-16 days"));
                        $newDate2 =date ("Y-m-d", strtotime ($datef ."-1 day")); 
                        $newDate3 =date ("Y-m-d", strtotime ($datef ."-1year"));
                        $newyear2=date ("Y", strtotime ($datef ."-1year"));
                        $newDate4 =date ("Y-m-d", strtotime ($date1 ."-1year"));
                        ?>
                    <table border="1" cellspacing="0" cellpadding="5" style="margin-left:30px;text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
                        <tr>
                            <td rowspan="2">क्र.</td>
                            <td rowspan="2" width="120px">शीर्ष</td>
                            <?php 
                                while($stmt1->fetch())
                                {
                                $idcheck = $branch_id;
                                ?>
                            <td colspan="3"><?php echo $branch_name; echo ","; echo $city; ?></td>
                            <?php } //stmt1 while end here?>
                            <td colspan="3">जोन का योग</td>
                        </tr>
                        <tr>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                            <td>आलौच्य पक्ष</td>
                            <td>गत पक्ष</td>
                            <td>गत वर्ष का अलौच्य पक्ष</td>
                        </tr>
                        <?php
                            $ipc =array("109 दप्रस","110 दप्रस","107]116(3)दप्रस","145दप्रस","151 दप्रस","रा.सु.का.","जिलाबदर");//"  अन्य जा.फौ."
                            $ipc1 =array(31,30,33,99,32,100,34);	//'101'  
                            $arrlength=count($ipc);
                            for($i=0;$i<$arrlength;$i++)
                            {
                            ?>
                        <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $ipc[$i]; ?></td>
                            <?php 
                                $sp1='SP';
                                $police_tracking->select_db("ftcaaazc_epfts");
                                $st1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
                                   $st1->bind_param("s", $sp1);
                                   $st1->execute();
                                   $st1->store_result();
                                   //if($st1->num_rows === 0) exit('No rows');
                                   $st1->bind_result($branch_id1, $branch_name1, $city1);
                                  $l=0;	 
                                  while($st1->fetch())
                                  {
                                     $l++;
                                  ?>
                            <td>
                                <?php
                                    if($ipc1[$i]=='100')
                                    {
                                     $police_dsr->select_db("ftcaaazc_dsr");
                                     $preventive_type =$ipc1[$i];
                                     $preventive_type1 ='35';
                                     if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND (preventive_type = ? OR preventive_type = ?) GROUP BY istagasa_no, istagasa_year") ) 
                                        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                        if ( !$stmt2->bind_param("issii",$branch_id1,$datef, $date1,$preventive_type,$preventive_type1) )
                                        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";			
                                    }
                                    else
                                    {
                                     $police_dsr->select_db("ftcaaazc_dsr");
                                     $preventive_type=$ipc1[$i];
                                     if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_type=? GROUP BY istagasa_no, istagasa_year") ) 
                                        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                        if ( !$stmt2->bind_param("issi",$branch_id1,$datef, $date1,$preventive_type) )
                                        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
                                    }
                                    if ( !$stmt2->execute() ) 
                                      echo "Execute Error: ($stmt2->errno)  $stmt2->error";
                                    if ( !$stmt2->store_result() ) //Only for select with bind_result()
                                      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                      //if($stmt3->num_rows === 0) { echo "No Results"; }
                                      $stmt2->bind_result($cid2); 
                                      $stmt2->fetch();
                                    $ip[$l]=$cid2;
                                    $bc[$i][$l]=$cid2;
                                    ?>
                                <span><?php if($cid2 >0){ echo $cid2;} else{ echo '0';}?></span>
                            </td>
                            <td>
                                <?php 
                                    if($ipc1[$i]=='100')
                                    {
                                     $police_dsr->select_db("ftcaaazc_dsr");
                                     $preventive_type =$ipc1[$i];
                                     $preventive_type1 ='35';
                                     if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND (preventive_type = ? OR preventive_type = ?) GROUP BY istagasa_no, istagasa_year") ) 
                                        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                        if ( !$stmt17->bind_param("issii",$branch_id1,$newDate1,$newDate2,$preventive_type,$preventive_type1) )
                                        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                          else
                                    {
                                     $police_dsr->select_db("ftcaaazc_dsr");
                                     $preventive_type=$ipc1[$i];
                                     if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_type=? GROUP BY istagasa_no, istagasa_year") ) 
                                        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                        if ( !$stmt17->bind_param("issi",$branch_id1,$newDate1,$newDate2,$preventive_type) )
                                        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
                                    }	
                                    if ( !$stmt17->execute() ) 
                                      echo "Execute Error: ($stmt17->errno)  $stmt17->error";
                                    if ( !$stmt17->store_result() ) //Only for select with bind_result()
                                      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                      //if($stmt3->num_rows === 0) { echo "No Results"; }
                                      $stmt17->bind_result($cid17); 
                                      $stmt17->fetch();
                                    $ip1[$l]=$cid17;
                                    $ic[$i][$l]=$cid17;
                                    ?>
                                <span><?php if($cid17 >0){ echo $cid17; } else{ echo '0'; } ?></span>
                            </td>
                            <?php if($newyear2=='2018')
                                {?>		
                            <td>
                                <?php 
                                    if($ipc1[$i]=='100')
                                    {
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $preventive_type=$ipc1[$i];
                                    $preventive_type1 ='35';
                                       if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND (preventive_type = ? OR preventive_type = ?) GROUP BY istagasa_no, istagasa_year") ) 
                                          echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                          if ( !$stmt18->bind_param("issii",$branch_id1,$newDate3, $newDate4,$preventive_type,$preventive_type1) )
                                          echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";			
                                    }
                                    else
                                    {
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $preventive_type=$ipc1[$i];
                                       if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_type=? GROUP BY istagasa_no, istagasa_year") ) 
                                          echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                          if ( !$stmt18->bind_param("issi",$branch_id1,$newDate3, $newDate4,$preventive_type) )
                                          echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    if ( !$stmt18->execute() ) 
                                      echo "Execute Error: ($stmt18->errno)  $stmt18->error";
                                    if ( !$stmt18->store_result() ) //Only for select with bind_result()
                                      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                      //if($stmt18->num_rows === 0) { echo "No Results"; }
                                      $stmt18->bind_result($cid18); 
                                      $stmt18->fetch();
                                    $ip2[$l]=$cid18;
                                    $c[$i][$l]=$cid18;
                                    ?>
                                <span><?php if($cid18 >0){ echo $cid18;} else{ echo '0';}?><?php// echo $cid18;?></span>
                            </td>
                            <?php 
                                }    //if($newyear2=='2018') end here
                                else{?>
                            <td>
                                <?php 
                                    if($ipc1[$i]=='100')
                                    {
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $preventive_type=$ipc1[$i];
                                    $preventive_type1 ='35';
                                       if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND ( start_date >= ? and start_date <= ?) AND (dsr_vidhan_preventive = ? OR dsr_vidhan_preventive = ?)") ) 
                                          echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                          if ( !$stmt18->bind_param("issii",$branch_id1,$newDate3, $newDate4,$preventive_type,$preventive_type1) )
                                          echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    else
                                    {
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $preventive_type=$ipc1[$i];
                                       if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND ( start_date >= ? and start_date <= ?) AND dsr_vidhan_preventive=?") ) 
                                          echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                          if ( !$stmt18->bind_param("issi",$branch_id1,$newDate3, $newDate4,$preventive_type) )
                                          echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    if ( !$stmt18->execute() ) 
                                      echo "Execute Error: ($stmt18->errno)  $stmt18->error";
                                    if ( !$stmt18->store_result() ) //Only for select with bind_result()
                                      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                      //if($stmt18->num_rows === 0) { echo "No Results"; }
                                      $stmt18->bind_result($cid18); 
                                      $stmt18->fetch();
                                    $ip2[$l]=$cid18;
                                    $c[$i][$l]=$cid18;
                                    ?>
                                <span><?php if($cid18 >0){ echo $cid18;} else{ echo '0';}?> <?php  // echo $cid18; ?></span>
                            </td>
                            <?php }//else close ?>
                            <?php } //st1 end here?>
                            <td>
                                <?php 
                                    $v=$ip[1]+$ip[2]+$ip[3]+$ip[4]+$ip[5]+$ip[6]+$ip[7]+$ip[8]+$ip[9]+$ip[10];
                                    echo $v;
                                    ?>
                            </td>
                            <td>
                                <?php 
                                    $t=$ip1[1]+$ip1[2]+$ip1[3]+$ip1[4]+$ip1[5]+$ip1[6]+$ip1[7]+$ip1[8]+$ip1[9]+$ip1[10];
                                    echo $t;
                                    ?>
                            </td>
                            <td>
                                <?php 
                                    $u=$ip2[1]+$ip2[2]+$ip2[3]+$ip2[4]+$ip2[5]+$ip2[6]+$ip2[7]+$ip2[8]+$ip2[9]+$ip2[10];
                                    echo $u;
                                    ?>
                            </td>
                        </tr>
                        <?php } //for loop end here ?>
                        <tr>
                            <td><?php echo 8; ?></td>
                            <td><?php echo  "अन्य जा.फौ." ; ?></td>
                            <?php 
                                $sp2='SP';
                                $police_tracking->select_db("ftcaaazc_epfts");
                                $st2 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
                                   $st2->bind_param("s", $sp2);
                                   $st2->execute();
                                   $st2->store_result();
                                   //if($st2->num_rows === 0) exit('No rows');
                                   $st2->bind_result($branch_id2, $branch_name2, $city2);
                                  $l=0;	 
                                  while($st2->fetch())
                                  {
                                     $l++;
                                  ?>
                            <td>
                                <?php
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $a1='31';
                                    $a2='30';
                                    $a3='33';
                                    $a4='99';
                                    $a5='32';
                                    $a6='100';
                                    $a7='34';
                                    $a8='35';
                                    if ( !$stmt22 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type is not NULL AND preventive_type != '' ") ) 
                                     echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt22->bind_param("issiiiiiiii",$branch_id2,$datef, $date1,$a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
                                     echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt22->execute() ) 
                                     echo "Execute Error: ($stmt22->errno)  $stmt22->error";
                                    if ( !$stmt22->store_result() ) //Only for select with bind_result()
                                     echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                     //if($stmt3->num_rows === 0) { echo "No Results"; }
                                     $stmt22->bind_result($cid22); 
                                     $stmt22->fetch();
                                    $ip[$l]=$cid22;
                                    $bc[7][$l]=$cid22;
                                    ?>
                                <span><?php echo $cid22;?></span>
                            </td>
                            <td>
                                <?php 
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $a1='31';
                                    $a2='30';
                                    $a3='33';
                                    $a4='99';
                                    $a5='32';
                                    $a6='100';
                                    $a7='34'; 
                                    $a8='35';
                                    if ( !$stmt27 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type is not NULL AND preventive_type != '' ") ) 
                                     echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt27->bind_param("issiiiiiiii",$branch_id2,$newDate1,$newDate2,$a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
                                     echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt27->execute() ) 
                                     echo "Execute Error: ($stmt27->errno)  $stmt27->error";
                                    if ( !$stmt27->store_result() ) //Only for select with bind_result()
                                     echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                     //if($stmt27->num_rows === 0) { echo "No Results"; }
                                     $stmt27->bind_result($cid27); 
                                     $stmt27->fetch();
                                    $ip1[$l]=$cid27;
                                    $ic[7][$l]=$cid27;
                                    ?>
                                <span><?php echo $cid27;?></span>
                            </td>
                            <?php if($newyear2=='2018')
                                {?>		
                            <td>
                                <?php 
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $a1='31';
                                    $a2='30';
                                    $a3='33';
                                    $a4='99';
                                    $a5='32';
                                    $a6='100';
                                    $a7='34';
                                    $a8='35';
                                    if ( !$stmt28 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type !=? AND preventive_type is not NULL AND preventive_type != '' ") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt28->bind_param("issiiiiiiii",$branch_id2,$newDate3, $newDate4,$a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt28->execute() ) 
                                      echo "Execute Error: ($stmt28->errno)  $stmt28->error";
                                    if ( !$stmt28->store_result() ) //Only for select with bind_result()
                                      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                      //if($stmt28->num_rows === 0) { echo "No Results"; }
                                      $stmt28->bind_result($cid28); 
                                      $stmt28->fetch();
                                    $ip2[$l]=$cid28;
                                    $c[7][$l]=$cid28;
                                    ?>
                                <span><?php echo $cid28;?></span>
                            </td>
                            <?php 
                                }    //if($newyear2=='2018') end here
                                else{?>
                            <td>
                                <?php 
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $a1='31';
                                    $a2='30';
                                    $a3='33';
                                    $a4='99';
                                    $a5='32';
                                    $a6='100';
                                    $a7='34';
                                    $a8='35';
                                    if ( !$stmt28 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND ( start_date >= ? and start_date <= ?) AND dsr_vidhan_preventive !=? AND dsr_vidhan_preventive !=? AND dsr_vidhan_preventive !=? AND dsr_vidhan_preventive !=? AND dsr_vidhan_preventive !=? AND dsr_vidhan_preventive !=? AND dsr_vidhan_preventive !=? AND dsr_vidhan_preventive !=? AND dsr_vidhan_preventive is not NULL AND dsr_vidhan_preventive != '' ") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt28->bind_param("issiiiiiiii",$branch_id2,$newDate3, $newDate4,$a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt28->execute() ) 
                                      echo "Execute Error: ($stmt28->errno)  $stmt28->error";
                                    if ( !$stmt28->store_result() ) //Only for select with bind_result()
                                      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                      //if($stmt28->num_rows === 0) { echo "No Results"; }
                                      $stmt28->bind_result($cid28); 
                                      $stmt28->fetch();
                                    $ip2[$l]=$cid28;
                                    $c[7][$l]=$cid28;
                                    ?>
                                <span><?php echo $cid28;?></span>
                            </td>
                            <?php }//else close ?>
                            <?php } //st1 end here?>
                            <td>
                                <?php 
                                    $v=$ip[1]+$ip[2]+$ip[3]+$ip[4]+$ip[5]+$ip[6]+$ip[7]+$ip[8]+$ip[9]+$ip[10];
                                    echo $v;
                                    ?>
                            </td>
                            <td>
                                <?php 
                                    $t=$ip1[1]+$ip1[2]+$ip1[3]+$ip1[4]+$ip1[5]+$ip1[6]+$ip1[7]+$ip1[8]+$ip1[9]+$ip1[10];
                                    echo $t;
                                    ?>
                            </td>
                            <td>
                                <?php 
                                    $u=$ip2[1]+$ip2[2]+$ip2[3]+$ip2[4]+$ip2[5]+$ip2[6]+$ip2[7]+$ip2[8]+$ip2[9]+$ip2[10];
                                    echo $u;
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">योग</td>
                            <td>
                                <?php $s=$bc[0][1]+$bc[1][1]+$bc[2][1]+$bc[3][1]+$bc[4][1]+$bc[5][1]+$bc[6][1]+$bc[7][1];
                                    echo $s;?>
                            </td>
                            <td>
                                <?php $sc=$ic[0][1]+$ic[1][1]+$ic[2][1]+$ic[3][1]+$ic[4][1]+$ic[5][1]+$ic[6][1]+$ic[7][1];
                                    echo $sc;?>
                            </td>
                            <td>
                                <?php $pc=$c[0][1]+$c[1][1]+$c[2][1]+$c[3][1]+$c[4][1]+$c[5][1]+$c[6][1]+$c[7][1];
                                    echo $pc;?>	
                            </td>
                            <td> 
                                <?php $s1=$bc[0][2]+$bc[1][2]+$bc[2][2]+$bc[3][2]+$bc[4][2]+$bc[5][2]+$bc[6][2]+$bc[7][2];
                                    echo $s1;?>
                            </td>
                            <td>
                                <?php $sc1=$ic[0][2]+$ic[1][2]+$ic[2][2]+$ic[3][2]+$ic[4][2]+$ic[5][2]+$ic[6][2]+$ic[7][2];
                                    echo $sc1;?>
                            </td>
                            <td>
                                <?php $pc1=$c[0][2]+$c[1][2]+$c[2][2]+$c[3][2]+$c[4][2]+$c[5][2]+$c[6][2]+$c[7][2];
                                    echo $pc1;?>
                            </td>
                            <td>
                                <?php
                                    $s2=$bc[0][3]+$bc[1][3]+$bc[2][3]+$bc[3][3]+$bc[4][3]+$bc[5][3]+$bc[6][3]+$bc[7][3];
                                    echo $s2;?>
                            </td>
                            <td>
                                <?php
                                    $sc2=$ic[0][3]+$ic[1][3]+$ic[2][3]+$ic[3][3]+$ic[4][3]+$ic[5][3]+$ic[6][3]+$ic[7][3];
                                    echo $sc2;?>
                            </td>
                            <td>
                                <?php
                                    $pc2=$c[0][3]+$c[1][3]+$c[2][3]+$c[3][3]+$c[4][3]+$c[5][3]+$c[6][3]+$c[7][3];
                                    echo $pc2;?>
                            </td>
                            <td>
                                <?php
                                    $s3=$bc[0][4]+$bc[1][4]+$bc[2][4]+$bc[3][4]+$bc[4][4]+$bc[5][4]+$bc[6][4]+$bc[7][4];
                                    echo $s3;?>
                            </td>
                            <td>
                                <?php
                                    $sc3=$ic[0][4]+$ic[1][4]+$ic[2][4]+$ic[3][4]+$ic[4][4]+$ic[5][4]+$ic[6][4]+$ic[7][4];
                                    echo $sc3;?>
                            </td>
                            <td>
                                <?php
                                    $pc3=$c[0][4]+$c[1][4]+$c[2][4]+$c[3][4]+$c[4][4]+$c[5][4]+$c[6][4]+$c[7][4];
                                    echo $pc3;?>
                            </td>
                            <td>
                                <?php
                                    $s4=$bc[0][5]+$bc[1][5]+$bc[2][5]+$bc[3][5]+$bc[4][5]+$bc[5][5]+$bc[6][5]+$bc[7][5];
                                    	echo $s4;?>
                            </td>
                            <td>
                                <?php
                                    $sc4=$ic[0][5]+$ic[1][5]+$ic[2][5]+$ic[3][5]+$ic[4][5]+$ic[5][5]+$ic[6][5]+$ic[7][5];
                                    	echo $sc4;?>
                            </td>
                            <td>
                                <?php
                                    $pc4=$c[0][5]+$c[1][5]+$c[2][5]+$c[3][5]+$c[4][5]+$c[5][5]+$c[6][5]+$c[7][5];
                                    	echo $pc4;?>
                            </td>
                            <td>
                                <?php
                                    $s5=$bc[0][6]+$bc[1][6]+$bc[2][6]+$bc[3][6]+$bc[4][6]+$bc[5][6]+$bc[6][6]+$bc[7][6];
                                    echo $s5;?>
                            </td>
                            <td>
                                <?php
                                    $sc5=$ic[0][6]+$ic[1][6]+$ic[2][6]+$ic[3][6]+$ic[4][6]+$ic[5][6]+$ic[6][6]+$ic[7][6];
                                    echo $sc5;?>
                            </td>
                            <td>
                                <?php
                                    $pc5=$c[0][6]+$c[1][6]+$c[2][6]+$c[3][6]+$c[4][6]+$c[5][6]+$c[6][6]+$c[7][6];
                                    echo $pc5;?>
                            </td>
                            <td>
                                <?php
                                    $s6=$bc[0][7]+$bc[1][7]+$bc[2][7]+$bc[3][7]+$bc[4][7]+$bc[5][7]+$bc[6][7]+$bc[7][7];
                                    echo $s6;?>
                            </td>
                            <td>
                                <?php
                                    $sc6=$ic[0][7]+$ic[1][7]+$ic[2][7]+$ic[3][7]+$ic[4][7]+$ic[5][7]+$ic[6][7]+$ic[7][7];
                                    echo $sc6;?>
                            </td>
                            <td>
                                <?php
                                    $pc6=$c[0][7]+$c[1][7]+$c[2][7]+$c[3][7]+$c[4][7]+$c[5][7]+$c[6][7]+$c[7][7];
                                    echo $pc6;?>
                            </td>
                            <td>
                                <?php
                                    $s7=$bc[0][8]+$bc[1][8]+$bc[2][8]+$bc[3][8]+$bc[4][8]+$bc[5][8]+$bc[6][8]+$bc[7][8];
                                    echo $s7;?>
                            </td>
                            <td>
                                <?php
                                    $sc7=$ic[0][8]+$ic[1][8]+$ic[2][8]+$ic[3][8]+$ic[4][8]+$ic[5][8]+$ic[6][8]+$ic[7][8];
                                    echo $sc7;?>
                            </td>
                            <td>
                                <?php
                                    $pc7=$c[0][8]+$c[1][8]+$c[2][8]+$c[3][8]+$c[4][8]+$c[5][8]+$c[6][8]+$c[7][8];
                                    echo $pc7;?>
                            </td>
                            <td>
                                <?php
                                    $s8=$bc[0][9]+$bc[1][9]+$bc[2][9]+$bc[3][9]+$bc[4][9]+$bc[5][9]+$bc[6][9]+$bc[7][9];
                                    echo $s8;?>
                            </td>
                            <td>
                                <?php
                                    $sc8=$ic[0][9]+$ic[1][9]+$ic[2][9]+$ic[3][9]+$ic[4][9]+$ic[5][9]+$ic[6][9]+$ic[7][9];
                                    echo $sc8;?>
                            </td>
                            <td>
                                <?php
                                    $pc8=$c[0][9]+$c[1][9]+$c[2][9]+$c[3][9]+$c[4][9]+$c[5][9]+$c[6][9]+$c[7][9];
                                    echo $pc8;?>
                            </td>
                            <td>
                                <?php
                                    $s9=$bc[0][10]+$bc[1][10]+$bc[2][10]+$bc[3][10]+$bc[4][10]+$bc[5][10]+$bc[6][10]+$bc[7][10];
                                    echo $s9;?>
                            </td>
                            <td>
                                <?php
                                    $sc9=$ic[0][10]+$ic[1][10]+$ic[2][10]+$ic[3][10]+$ic[4][10]+$ic[5][10]+$ic[6][10]+$ic[7][10];
                                    echo $sc9;?>
                            </td>
                            <td>
                                <?php
                                    $pc9=$c[0][10]+$c[1][10]+$c[2][10]+$c[3][10]+$c[4][10]+$c[5][10]+$c[6][10]+$c[7][10];
                                    echo $pc9;?>
                            </td>
                            <td>
                                <?php 
                                    $sum1=$s+$s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8+$s9;
                                    echo $sum1;
                                    ?>
                            </td>
                            <td>
                                <?php 
                                    $sum2=$sc+$sc1+$sc2+$sc3+$sc4+$sc5+$sc6+$sc7+$sc8+$sc9;
                                    echo $sum2;
                                    ?>
                            </td>
                            <td>
                                <?php 
                                    $sum3=$pc+$pc1+$pc2+$pc3+$pc4+$pc5+$pc6+$pc7+$pc8+$pc9;
                                    echo $sum3;
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">कमी/वृद्धि प्रतिशत</td>
                            <td colspan="3"><?php
                                if($pc > 0)
                                {	
                                $percentage =($s-$pc)*100/$pc ;
                                echo ROUND(ABS($percentage),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc1 > 0)
                                {	
                                $percentage1 =($s1-$pc1)*100/$pc1 ;
                                echo ROUND(ABS($percentage1),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc2 > 0)
                                {	
                                $percentage2 =($s2-$pc2)*100/$pc2 ;
                                echo ROUND(ABS($percentage2),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc3 > 0)
                                {	
                                $percentage3 =($s3-$pc3)*100/$pc3 ;
                                echo ROUND(ABS($percentage3),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc4 > 0)
                                {	
                                $percentage4 =($s4-$pc4)*100/$pc4 ;
                                echo ROUND(ABS($percentage4),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc5 > 0)
                                {	
                                $percentage5 =($s5-$pc5)*100/$pc5 ;
                                echo ROUND(ABS($percentage5),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc6 > 0)
                                {	
                                $percentage6 =($s6-$pc6)*100/$pc6 ;
                                echo ROUND(ABS($percentage6),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc7 > 0)
                                {	
                                $percentage7 =($s7-$pc7)*100/$pc7 ;
                                echo ROUND(ABS($percentage7),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc8 > 0)
                                {	
                                $percentage8 =($s8-$pc8)*100/$pc8 ;
                                echo ROUND(ABS($percentage8),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($pc9 > 0)
                                {	
                                $percentage9 =($s9-$pc9)*100/$pc9 ;
                                echo ROUND(ABS($percentage9),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                            <td colspan="3"><?php
                                if($sum3 > 0)
                                {	
                                $percentage10 =($sum1-$sum3)*100/$sum3 ;
                                echo ROUND(ABS($percentage10),2); echo "%";
                                }
                                else
                                {	
                                echo "0%";	
                                }	
                                ?></td>
                        </tr>
                    </table>
                    <br /><br />
                    <br /><br />
                    <p style="float:right" align="center"></p>
                </div>
                <?php } //search end here ?>
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