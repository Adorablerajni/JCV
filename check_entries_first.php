<?php require_once('../Connections/dbconnect-m.php');  session_start(); ?>
<?php
    // echo $_SESSION['MM_Zone'];
    if(!isset($_SESSION['MM_Zone']))
    {
        header("Location:../logout.php");
    }
    
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
      $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
    
      switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;    
        case "long":
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "double":
          $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
          break;
        case "date":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "defined":
          $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
          break;
      }
      return $theValue;
    }
    
    $editFormAction = $_SERVER['PHP_SELF'];
    if (isset($_SERVER['QUERY_STRING'])) {
      $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
    }
    
    mysqli_select_db($police_tracking, $database_police_tracking);
    $sql = "SELECT * FROM branch_tbl WHERE id='".$_SESSION['MM_User_Id']."'";
    $get_sql = mysqli_query($police_tracking, $sql) or die(mysqli_error($police_tracking));
    $get_sql_data = mysqli_fetch_assoc($get_sql);
    //echo $sql;
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="robots" content="noindex" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Entry Check | File And Crime Tracking System - FACTS</title>
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
            body
            {
            font-size:12px;
            }
            .notice_all
            {
            height:650px;
            width:900px;
            margin:0 auto;
            /*border:dotted 1px #666;*/
            position:relative;
            }
            .crime_number{
            display:none;
            }
            #print tr td{vertical-align:top}
        </style>
        <style media='print'>
            .navStuff
            {
            display: none
            }
        </style>
    </head>
    <body>
        <?php
            // echo $_SESSION['MM_Zone'];
            $query_get_shakha = "SELECT * FROM branch_tbl where designation = 'SP' and zone = '".$_SESSION['MM_Zone']."'";
            $get_shakha = mysqli_query($police_tracking, $query_get_shakha) or die(mysqli_error($police_tracking));
            $row_get_shakha = mysqli_fetch_assoc($get_shakha);
            $totalRows_get_shakha = mysqli_num_rows($get_shakha);
            // echo $query_get_shakha;
            ?>
        <div class="notice_all">
            <div align='right' class='navStuff'>
                <form action="../DE/police/exporttoexcel.php" method="post" 
                    onsubmit='$("#datatodisplay").val( $("<div>").append( $("#download").eq(0).clone() ).html() )'>
                    <p align="" class="hprtbtn">
                        <span style="float:right;margin-right:-25px"> <input type="hidden" id="datatodisplay" name="datatodisplay" style="" /> <input type="submit" value="Export to Excel"/>
                        <input type='button' value='Print this page' onClick='window.print()'>   </span>
                    </p>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
                        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">
                            &nbsp;
                            <label>दिनांक:</label>
                            <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" /> &nbsp;से&nbsp;
                            <label>दिनांक:</label>
                            <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />&nbsp; तक  &nbsp;&nbsp;
                            <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:inline-block;width:220px;">
                                <?php
                                    do {  
                                    ?>
                                <option value="<?php echo $row_get_shakha['id']?>"><?php echo $row_get_shakha['branch_name']?>, <?php echo $row_get_shakha['city']?></option>
                                <?php
                                    } while ($row_get_shakha = mysqli_fetch_assoc($get_shakha));
                                      $rows = mysqli_num_rows($get_shakha);
                                      if($rows > 0) {
                                          mysqli_data_seek($get_shakha, 0);
                                    	  $row_get_shakha = mysqli_fetch_assoc($get_shakha);
                                      }
                                    ?>
                            </select>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="submit" class="btn btn-success" name="Search" id="mybutton" style="display:inline-block">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <br /> <br />
            <div id="download">
                <?php
                    if(isset($_POST['Search'])!='')
                    {
                    ?>
                <p align="left" style="float:left;margin-left:-30px;"></p>
                <?php
                    $result1=mysqli_query("SELECT * from branch_tbl where id = '".$_POST['sp_office']."'");
                    $data1=mysqli_fetch_assoc($result1);
                    
                    						?>
                <p align="right"><span> अवधि <?php if ($_POST['datef'] == '')
                    {
                    	echo '';
                      
                    } else
                    {
                      
                      echo date('d-m-Y', strtotime($_POST['datef']));
                    }?> से <?php if ($_POST['datel'] == '')
                    {
                    	echo '';
                      
                    } else
                    {
                      
                      echo date('d-m-Y', strtotime($_POST['datel']));
                    }?> तक </span><br />
                    <?php if($get_sql_data['user_type']=="SP"){?>
                    <span>जिला <?php echo $data1['city'] ;?></span> <?php } ?>
                </p>
                <p align="center"><strong></strong></p>
                <table border="1" cellspacing="0" cellpadding="5"  style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
                    <td class="vertical-txt" style="vertical-align:middle" align="center" >क्र</td>
                    <td class="vertical-txt" style="vertical-align:middle" align="center">थाने का नाम</td>
                    <td><strong>डीएसआर</strong></td>
                    <td><strong>लंबित कार्यवाही</strong></td>
                    <td><strong>गुम इंसान</strong></td>
                    <td><strong>संपत्ति</strong></td>
                    <td><strong>वारंट</strong></td>
                    <td colspan="11" ><strong>DSR Status</strong></td>
                    <td><strong>Criminal List</strong></td>
                    <td style="display:none"><strong>माह वार प्रगति</strong></td>
                    <td style="display:none"><strong>उपपत्ति</strong></td>
                    <td style="display:none"><strong>निर्णय</strong></td>
                    <td style="display:none"><strong>निलंबन</strong></td>
                    <td style="display:none"><strong>पुनरीक्षण</strong></td>
                    <td style="display:none"><strong>अपील</strong></td>
                    <td style="display:none"><strong>दयायाचिका</strong></td>
                    <td style="display:none"><strong>रिट पिटीशन</strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="6"></td>
                        <td>विवेचना में लंबित  </td>
                        <td> बंदी आरोपी</td>
                        <td>ख़ारजी</td>
                        <td>न्यायालय में लंबित </td>
                        <td>न्यायालय में लंबित खात्मा प्रकरण  </td>
                        <td> थाने में लंबित खात्मा प्रकरण  </td>
                        <td> खात्मा</td>
                        <td> न्यायालय में प्रस्तुत</td>
                        <td> निराकृत </td>
                        <td> चालान कटा </td>
                        <td>  समिति द्वारा पृथक </td>
                        <td></td>
                    </tr>
                    <?php $j=0;
                        mysqli_select_db($police_tracking, $database_police_tracking);
                        
                        $query_Recordset1 = "SELECT * FROM branch_tbl where SP ='".$_POST['sp_office']."' and designation = 'TI'";
                         
                        $Recordset1 = mysqli_query($police_tracking, $query_Recordset1) or die(mysqli_error($police_tracking));
                        $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
                        $totalRows_Recordset1 = mysqli_num_rows($Recordset1);
                        //echo $query_Recordset1;
                        if($totalRows_Recordset1>0){
                         do {  $j++; ?>
                    <tr>
                        <td class=""><?php echo $j; ;?></td>
                        <td class="" style="text-align:left"><?php echo $row_Recordset1['branch_name'] ;?></td>
                        <td class="">
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset5 = "SELECT * FROM dsr_entries where office_id ='".$row_Recordset1['id']."' and DATE(creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset5 = mysqli_query($police_dsr, $query_Recordset5) or die(mysqli_error($police_dsr));
                                $row_Recordset5 = mysqli_fetch_assoc($Recordset5);
                                $totalRows_Recordset5 = mysqli_num_rows($Recordset5);
                            ?>
                            <span class="view_crime_number"  data-id="<?php echo $totalRows_Recordset5; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset5; ?></span>
                            <div class="crime_number"  id="dsr_entries_<?php echo $totalRows_Recordset5.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset5; ?>">
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset5['id'] ?>" target="_blank" ><?php echo $row_Recordset5['dsr_crime_no']."/".$row_Recordset5['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset5 = mysqli_fetch_assoc($Recordset5));
                                      ?>
                            </div>
                        </td>
                        <td class="">
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset5a = "SELECT * FROM lambit_details left join dsr_entries on dsr_entries.id=lambit_details.dsr_id  where lambit_details.office_id ='".$row_Recordset1['id']."' and DATE(lambit_details.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset5a = mysqli_query($police_dsr, $query_Recordset5a) or die(mysqli_error($police_dsr));
                                $row_Recordset5a = mysqli_fetch_assoc($Recordset5a);
                                $totalRows_Recordset5a = mysqli_num_rows($Recordset5a);
                                //echo $query_Recordset5a;
                                ?>
                            <span class="lambit_details"  data-id="<?php echo $totalRows_Recordset5a; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset5a; ?></span>
                            <div class="crime_number"  id="lambit_detail_<?php echo $totalRows_Recordset5a.'_'.$j;  ?>" data-id="<?php echo $totalRows_Recordset5a; ?>">  
                                <?php 
                                    // echo "<pre>";
                                    // print_r($row_Recordset5a);
                                    // echo "</pre>";
                                     do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset5a['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset5a['dsr_crime_no']."/".$row_Recordset5a['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset5a = mysqli_fetch_assoc($Recordset5a));
                                      ?>
                            </div>
                        </td>
                        <td class="">
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset6 = "SELECT * FROM gum_details LEFT JOIN dsr_entries on gum_details.dsr_id=dsr_entries.id  where gum_details.office_id ='".$row_Recordset1['id']."' and DATE(gum_details.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset6 = mysqli_query( $police_dsr, $query_Recordset6) or die(mysqli_error($police_dsr));
                                $row_Recordset6 = mysqli_fetch_assoc($Recordset6);
                                $totalRows_Recordset6 = mysqli_num_rows($Recordset6);
                                //echo $query_Recordset6;
                                ?>
                            <span class="gum_details"  data-id="<?php echo $totalRows_Recordset6; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset6; ?></span>
                            <div class="crime_number"  id="gum_detail_<?php echo $totalRows_Recordset6.'_'.$j;  ?>" data-id="<?php echo $totalRows_Recordset6; ?>">
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset6['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset6['dsr_crime_no']."/".$row_Recordset6['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset6 = mysqli_fetch_assoc($Recordset6));
                                      ?>
                            </div>
                        </td>
                        <td class="">
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset6b = "SELECT dsr_entries.id as id_dsr ,dsr_entries.*,property_details.* FROM property_details LEFT JOIN dsr_entries on property_details.dsr_id =dsr_entries.id   where property_details.office_id ='".$row_Recordset1['id']."' and DATE(property_details.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."' and property_details.got_property != '' and property_details.lost_property !=''";
                                $Recordset6b = mysqli_query($police_dsr, $query_Recordset6b) or die(mysqli_error($police_dsr));
                                $row_Recordset6b = mysqli_fetch_assoc($Recordset6b);
                                $totalRows_Recordset6b = mysqli_num_rows($Recordset6b);
                                //echo $query_Recordset6b;
                                ?>
                            <span class="property_details"  data-id="<?php echo $totalRows_Recordset6b; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset6b; ?></span>
                            <div class="crime_number"  id="property_detail_<?php echo $totalRows_Recordset6b.'_'.$j;  ?>" data-id="<?php echo $totalRows_Recordset6b; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset6b['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset6b['dsr_crime_no']."/".$row_Recordset6b['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset6b = mysqli_fetch_assoc($Recordset6b));
                                      ?>
                            </div>
                        </td>
                        <td class="">
                            <?php
                                mysqli_select_db($police_summons, $database_police_summon);
                                $query_Recordset7b = "SELECT * FROM summon_list where office_id ='".$row_Recordset1['id']."' and DATE(creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset7b = mysqli_query($police_summons, $query_Recordset7b) or die(mysqli_error($police_summons));
                                $row_Recordset7b = mysqli_fetch_assoc($Recordset7b);
                                $totalRows_Recordset7b = mysqli_num_rows($Recordset7b);
                            ?>
                            <span class="summon_lists"  data-id="<?php echo $totalRows_Recordset7b; ?>"data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset7b; ?></span>
                        </td>
                        <td class="">
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset1a = "SELECT dsr_entries.id as id_dsr,dsr_status.*,dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id  where dsr_status.office_id ='".$row_Recordset1['id']."' AND s_status ='विवेचना में लंबित' AND DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset1a = mysqli_query($police_dsr, $query_Recordset1a) or die(mysqli_error($police_dsr));
                                $row_Recordset1a = mysqli_fetch_assoc($Recordset1a);
                                $totalRows_Recordset1a = mysqli_num_rows($Recordset1a);
                                //echo $query_Recordset1a;
                                ?>
                            <span class="dsr_status_vivechanas"  data-id="<?php echo $totalRows_Recordset1a; ?>"data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset1a; ?></span>
                            <div class="crime_number"  id="dsr_status_vivechana_<?php echo $totalRows_Recordset1a.'_'.$j;  ?>" data-id="<?php echo $totalRows_Recordset1a; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset1a['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset1a['dsr_crime_no']."/".$row_Recordset1a['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset1a = mysqli_fetch_assoc($Recordset1a));
                                      ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset2b = "SELECT dsr_entries.id as id_dsr,dsr_status.*,dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id  where dsr_status.office_id ='".$row_Recordset1['id']."'AND dsr_status.s_status ='बंदी आरोपी' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset2b = mysqli_query($police_dsr, $query_Recordset2b) or die(mysqli_error($police_dsr));
                                $row_Recordset2b = mysqli_fetch_assoc($Recordset2b);
                                $totalRows_Recordset2b = mysqli_num_rows($Recordset2b);
                                //echo $query_Recordset2b;
                            ?>
                            <span class="dsr_status_bandis"  data-id="<?php echo $totalRows_Recordset2b; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset2b; ?></span>
                            <div class="crime_number"  id="dsr_status_bandi_<?php echo $totalRows_Recordset2b.'_'.$j;  ?>" data-id="<?php echo $totalRows_Recordset2b; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset2b['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset2b['dsr_crime_no']."/".$row_Recordset2b['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset2b = mysqli_fetch_assoc($Recordset2b));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset3b = "SELECT dsr_status.*, dsr_entries.id as id_dsr , dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='ख़ारजी' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset3b = mysqli_query($police_dsr, $query_Recordset3b) or die(mysqli_error($police_dsr));
                                $row_Recordset3b = mysqli_fetch_assoc($Recordset3b);
                                $totalRows_Recordset3b = mysqli_num_rows($Recordset3b);
                                //echo $query_Recordset3b;
                                ?>
                            <span class="dsr_status_kharjis"  data-id="<?php echo $totalRows_Recordset3b; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset3b; ?></span>
                            <div class="crime_number"  id="dsr_status_kharji_<?php echo $totalRows_Recordset3b.'_'.$j;  ?>" data-id="<?php echo $totalRows_Recordset3b; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset3b['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset3b['dsr_crime_no']."/".$row_Recordset3b['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset3b = mysqli_fetch_assoc($Recordset3b));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset1c = "SELECT dsr_status.*, dsr_entries.id as id_dsr , dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='न्यायालय में लंबित' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset1c = mysqli_query($police_dsr, $query_Recordset1c) or die(mysqli_error($police_dsr));
                                $row_Recordset1c = mysqli_fetch_assoc($Recordset1c);
                                $totalRows_Recordset1c = mysqli_num_rows($Recordset1c);
                          
                              //echo $query_Recordset1c;
                                ?>
                            <span class="dsr_status_nyayalay_me_lambit"  data-id="<?php echo $totalRows_Recordset1c; ?>"data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset1c; ?></span>
                            <div class="crime_number"  id="dsr_status_nyayalay_lambit_<?php echo $totalRows_Recordset1c.'_'.$j;  ?>" data-id="<?php echo $totalRows_Recordset1c; ?>">  
                                <?php 
                                    do { 
                                        
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset1c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset1c['dsr_crime_no']."/".$row_Recordset1c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset1c = mysqli_fetch_assoc($Recordset1c));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset2c = "SELECT dsr_status.*, dsr_entries.id as id_dsr , dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='न्यायालय में लंबित खात्मा प्रकरण' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset2c = mysqli_query($police_dsr, $query_Recordset2c) or die(mysqli_error($police_dsr));
                                $row_Recordset2c = mysqli_fetch_assoc($Recordset2c);
                                $totalRows_Recordset2c = mysqli_num_rows($Recordset2c);
                                //echo $query_Recordset2c;
                                ?>
                            <span class="dsr_status_nyayalay_me_lambit_khatma"  data-id="<?php echo $totalRows_Recordset2c; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset2c; ?></span>
                            <div class="crime_number"  id="dsr_status_nyayalay_lambit_khatma_<?php echo $totalRows_Recordset2c.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset2c; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset2c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset2c['dsr_crime_no']."/".$row_Recordset2c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset2c = mysqli_fetch_assoc($Recordset2c));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset3c = "SELECT dsr_entries.id as id_dsr,dsr_status.*,dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='थाने में लंबित खात्मा प्रकरण' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset3c = mysqli_query($police_dsr, $query_Recordset3c) or die(mysqli_error($police_dsr));
                                $row_Recordset3c = mysqli_fetch_assoc($Recordset3c);
                                $totalRows_Recordset3c = mysqli_num_rows($Recordset3c);
                               // echo $query_Recordset3c;
                                ?>
                            <span class="dsr_status_thane_me_lambit"  data-id="<?php echo $totalRows_Recordset3c; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset3c; ?></span>
                            <div class="crime_number"  id="dsr_status_thane_lambit_<?php echo $totalRows_Recordset3c.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset3c; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset3c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset3c['dsr_crime_no']."/".$row_Recordset3c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset3c = mysqli_fetch_assoc($Recordset3c));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset4c = "SELECT dsr_entries.id as id_dsr,dsr_status.*,dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='खात्मा' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset4c = mysqli_query($police_dsr, $query_Recordset4c) or die(mysqli_error($police_dsr));
                                $row_Recordset4c = mysqli_fetch_assoc($Recordset4c);
                                $totalRows_Recordset4c = mysqli_num_rows($Recordset4c);
                                //echo $query_Recordset4c;
                                ?>
                            <span class="dsr_status_khatmas"  data-id="<?php echo $totalRows_Recordset4c; ?>" data-number="<?php echo $j; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset4c; ?></span>
                            <div class="crime_number"  id="dsr_status_khatma_<?php echo $totalRows_Recordset4c.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset4c; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset4c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset4c['dsr_crime_no']."/".$row_Recordset4c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset4c = mysqli_fetch_assoc($Recordset4c));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset5c = "SELECT dsr_entries.id as id_dsr,dsr_status.*,dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='न्यायालय में प्रस्तुत' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset5c = mysqli_query($police_dsr, $query_Recordset5c) or die(mysqli_error($police_dsr));
                                $row_Recordset5c = mysqli_fetch_assoc($Recordset5c);
                                $totalRows_Recordset5c = mysqli_num_rows($Recordset5c);
                                //echo $query_Recordset5c;
                                ?>
                            <span class="dsr_status_nyayalay_me_presents" data-number="<?php echo $j ;?>"   data-id="<?php echo $totalRows_Recordset5c; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset5c; ?></span>
                            <div class="crime_number"  id="dsr_status_nyayalay_me_present_<?php echo $totalRows_Recordset5c.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset5c; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset5c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset5c['dsr_crime_no']."/".$row_Recordset5c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset5c = mysqli_fetch_assoc($Recordset5c));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset6c = "SELECT dsr_entries.id as id_dsr,dsr_status.*,dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='निराकृत'  and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset6c = mysqli_query($police_dsr, $query_Recordset6c) or die(mysqli_error($police_dsr));
                                $row_Recordset6c = mysqli_fetch_assoc($Recordset6c);
                                $totalRows_Recordset6c = mysqli_num_rows($Recordset6c);
                                // echo $query_Recordset6c;
                                ?>
                            <span class="dsr_status_nirakrats" data-number="<?php echo $j ;?>"  data-id="<?php echo $totalRows_Recordset6c; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset6c; ?></span>
                            <div class="crime_number"  id="dsr_status_nirakrat_<?php echo $totalRows_Recordset6c.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset6c; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset6c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset6c['dsr_crime_no']."/".$row_Recordset6c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset6c = mysqli_fetch_assoc($Recordset6c));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset7c = "SELECT dsr_entries.id as id_dsr,dsr_status.*,dsr_entries.*  FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='चालान कटा' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset7c = mysqli_query($police_dsr, $query_Recordset7c) or die(mysqli_error($police_dsr));
                                $row_Recordset7c = mysqli_fetch_assoc($Recordset7c);
                                $totalRows_Recordset7c = mysqli_num_rows($Recordset7c);
                                //echo $query_Recordset7c;
                                ?>
                            <span class="dsr_status_chalans" data-number="<?php echo $j; ?>"  data-id="<?php echo $totalRows_Recordset7c; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset7c; ?></span>
                            <div class="crime_number"  id="dsr_status_chalan_<?php echo $totalRows_Recordset7c.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset7c; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset7c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset7c['dsr_crime_no']."/".$row_Recordset7c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset7c = mysqli_fetch_assoc($Recordset7c));
                                ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset8c = "SELECT dsr_entries.id as id_dsr,dsr_status.*,dsr_entries.* FROM  dsr_status LEFT JOIN dsr_entries on dsr_entries.id=dsr_status.dsr_id where dsr_status.office_id ='".$row_Recordset1['id']."' AND dsr_status.s_status ='समिति द्वारा पृथक' and DATE(dsr_status.creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset8c = mysqli_query($police_dsr, $query_Recordset8c) or die(mysqli_error($police_dsr));
                                $row_Recordset8c = mysqli_fetch_assoc($Recordset8c);
                                $totalRows_Recordset8c = mysqli_num_rows($Recordset8c);
                                // echo $query_Recordset8c;
                                ?>
                            <span class="dsr_status_samiti_dwara_prathak" data-number=<?php echo $j; ?>  data-id="<?php echo $totalRows_Recordset8c; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset8c; ?></span>
                            <div class="crime_number"  id="dsr_status_samiti_prathak_<?php echo $totalRows_Recordset8c.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset8c; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset8c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset8c['dsr_crime_no']."/".$row_Recordset8c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset8c = mysqli_fetch_assoc($Recordset8c));
                                ?>
                            </div>
                        </td>
                        <td class="">
                            <?php
                                mysqli_select_db($police_dsr, $database_police_dsr);
                                $query_Recordset9b = "SELECT * FROM  criminal_list where office_id ='".$row_Recordset1['id']."' and DATE(creation_date) between '".$_POST['datef']."' and '".$_POST['datel']."'";
                                $Recordset9b = mysqli_query($police_dsr, $query_Recordset9b) or die(mysqli_error($police_dsr));
                                $row_Recordset9b = mysqli_fetch_assoc($Recordset9b);
                                $totalRows_Recordset9b = mysqli_num_rows($Recordset9b);
                                // echo $query_Recordset9b;
                                
                                ?>
                            <span class="criminal_lists" data-number=<?php echo $j; ?>  data-id="<?php echo $totalRows_Recordset8c; ?>" data-thana="<?php echo $row_Recordset1['branch_name']; ?>" ><?php echo $totalRows_Recordset8c; ?></span>
                            <div class="crime_number"  id="criminal_lists_<?php echo $totalRows_Recordset8c.'_'.$j; ?>" data-id="<?php echo $totalRows_Recordset8c; ?>">  
                                <?php 
                                    do { 
                                    ?>
                                <a href="add-details.php?edt=<?php echo $row_Recordset8c['dsr_id'] ?>" target="_blank" ><?php echo $row_Recordset8c['dsr_crime_no']."/".$row_Recordset8c['dsr_crime_year']; ?></a>
                                <?php 
                                    } while ($row_Recordset8c = mysqli_fetch_assoc($Recordset8c));
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
                        }else { ?>
                    <tr>
                        <td colspan="19"><?php echo "No Records Found !!!"; ?></td>
                    </tr>
                    <?php }
                        ?>
                </table>
                <?php } ?>
                </table><br /><br /><br />
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
        <script type="text/javascript" runat="server">
            $(function() {
            	$("#row1").hide();
            $("#row2").hide();
            $("#row3").hide();
            $('.crime_number').hide();
            $("#nilamban_status").change(function(){
                if ($(this).val() === "है"){
                    $("#row1").show();
            $("#row2").show();
            $("#row3").show();
                }else{
            		$("#row1").hide();
            $("#row2").hide();
            $("#row3").hide();
                }
            })
            })
        </script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script> 
        <script type="text/javascript" runat="server">
            $(function() {
                    $('#criminal_age').keyup(function() {
                        if (this.value.match(/[^0-9]/g)) {
                            this.value = this.value.replace(/[^0-9]/g, '');
                        }
            			
              });  
              $('#criminal_mob').keyup(function() {
                        if (this.value.match(/[^0-9]/g)) {
                            this.value = this.value.replace(/[^0-9]/g, '');
                        }
              });
              $('#istagasa_no').keyup(function() {
                        if (this.value.match(/[^0-9]/g)) {
                            this.value = this.value.replace(/[^0-9]/g, '');
                        }
              });    
              $('#old_crime_no').keyup(function() {
                        if (this.value.match(/[^0-9]/g)) {
                            this.value = this.value.replace(/[^0-9]/g, '');
                        }
              });  
              $('#sathi_age').keyup(function() {
                        if (this.value.match(/[^0-9]/g)) {
                            this.value = this.value.replace(/[^0-9]/g, '');
                        }
              });    
              
              $('#sathi_mob').keyup(function() {
                        if (this.value.match(/[^0-9]/g)) {
                            this.value = this.value.replace(/[^0-9]/g, '');
                        }
              });    
               
               
              
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
        <script>
            $('.view_crime_number').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_thana = $(this).attr('data-thana');
                var data_number = $(this).attr('data-number');
               // alert('#dsr_entries_'+data_id+'_'+data_thana);
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_entries_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.lambit_details').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_thana = $(this).attr('data-thana');
                 var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#lambit_detail_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.gum_details').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#gum_detail_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.property_details').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#property_detail_'+data_id+'_'+data_number).toggle();
                
                
            });
            
            $('.dsr_status_vivechanas').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_vivechana_'+data_id+'_'+data_number).toggle();
                
                
            });
            
            $('.dsr_status_bandis').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_bandi_'+data_id+'_'+data_number).toggle();
                
                
            }); 
            $('.dsr_status_kharjis').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_kharji_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.dsr_status_nyayalay_me_lambit').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_nyayalay_lambit_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.dsr_status_nyayalay_me_lambit_khatma').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_nyayalay_lambit_khatma_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.dsr_status_thane_me_lambit').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_thane_lambit_'+data_id+'_'+data_number).toggle();
                
                
            });
           
            $('.dsr_status_khatmas').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_khatma_'+data_id+'_'+data_number).toggle();
                
                
            });
           
            $('.dsr_status_nyayalay_me_presents').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_nyayalay_me_present_'+data_id+'_'+data_number).toggle();
                
                
            }); 
            $('.dsr_status_nirakrats').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_nirakrat_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.dsr_status_chalans').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_chalan_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.dsr_status_samiti_dwara_prathak').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                if(data_id == 0)
                {
                    return false;
                }
                $('#dsr_status_samiti_prathak_'+data_id+'_'+data_number).toggle();
                
                
            });
            $('.criminal_lists').click( function(){
                var data_id =  $(this).attr('data-id');
                var data_number = $(this).attr('data-number');
                // if(data_id == 0)
                // {
                //     return false;
                // }
                $('#criminal_list_'+data_id+'_'+data_number).toggle();
                
                
            });
                
            
            
        </script>
    </body>
</html>