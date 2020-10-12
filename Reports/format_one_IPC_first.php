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
        <title>Format-1-IPC | File Tracking & Crime Analysis Application </title>
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
            <form action="format_one_IPC_first.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
                <div class="col-lg-12 navStuff" style="padding:15px 5px;margin:0px auto;width:960px;">
                    <div class="col-lg-12 navStuff">
                        &nbsp; 
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
        <div class="">
            <div class="clearfix"></div>
            <br />
            <div id="download">
                <?php
                    if(isset($_POST['Search'])!='')
                       {
                     ?>
                <!--<p align="left" style="float:left;margin-left:-50px;">Format-1-ipc</p>-->
                <p align="right"></p>
                <div class="mar10">
                    <?php   
                        //if($_POST['sp_office'] == 0)	
                        $sp='SP';
                        $police_tracking->select_db("ftcaaazc_epfts");
                        $stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ? and zone = ?");
                        $stmt1->bind_param("ss", $sp, $_SESSION['MM_Zone']);
                        $stmt1->execute();
                        $stmt1->store_result();
                        if($stmt1->num_rows === 0) exit('No rows');
                        $stmt1->bind_result($branch_id, $branch_name, $city);
                        ?>
                    <p align="center"><span>भादवि के अपराधों का तुलनात्मक नक्शा<br /> दि <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
                        }?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> &nbsp;&nbsp;&nbsp;       तक &nbsp;&nbsp;&nbsp; इन्दौर जोन</span></p>
                    <?php	  
                        $age = '18';
                        $sc = "SC";
                        $st = "ST";
                        $datef = $_POST['datef'];
                        $date1 = $_POST['datel'];
                        $newDate1 =date ("Y-m-d", strtotime ($datef ."-16 days"));
                        $newyear1=date ("Y", strtotime ($datef ."-16 days"));
                        $newDate2 =date ("Y-m-d", strtotime ($datef ."-1 day")); 
                        $newDate3 =date ("Y-m-d", strtotime ($datef ."-1 year"));
                        $newyear2=date ("Y", strtotime ($datef ."-1 year"));
                        $newDate4 =date ("Y-m-d", strtotime ($date1 ."-1 year"));
                        ?>
                    <br/>
                    <table border="1" cellspacing="0" cellpadding="5" style="margin-left:30px;text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover PrintTable">
                        <tr class="$first_row">
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
                        <tr class="$second_row">
                            <td>आलौच्य पक्ष 
                                (1)
                            </td>
                            <td>गत पक्ष
                                (2)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (3)
                            </td>
                            <td>आलौच्य पक्ष
                                (4)
                            </td>
                            <td>गत पक्ष
                                (5)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (6)
                            </td>
                            <td>आलौच्य पक्ष
                                (7)
                            </td>
                            <td>गत पक्ष
                                (8)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (9)
                            </td>
                            <td>आलौच्य पक्ष
                                (10)
                            </td>
                            <td>गत पक्ष
                                (11)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (12)
                            </td>
                            <td>आलौच्य पक्ष
                                (13)
                            </td>
                            <td>गत पक्ष
                                (14)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (15)
                            </td>
                            <td>आलौच्य पक्ष
                                (16)
                            </td>
                            <td>गत पक्ष
                                (17)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (18)
                            </td>
                            <td>आलौच्य पक्ष
                                (19)
                            </td>
                            <td>गत पक्ष
                                (20)
                            
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (21)
                            </td>
                            <td>आलौच्य पक्ष
                                (22)
                            </td>
                            <td>गत पक्ष
                                (23)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (24)
                            </td>
                            <td>आलौच्य पक्ष
                                (25)
                            </td>
                            <td>गत पक्ष
                                (26)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (27)
                            </td>
                            <td>आलौच्य पक्ष
                                (28)
                            </td>
                            
                            <td>गत पक्ष
                                (29)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (30)
                            </td>
                            <td>आलौच्य पक्ष
                                (31)
                            </td>
                            <td>गत पक्ष
                                (32)
                            </td>
                            <td>गत वर्ष का अलौच्य पक्ष
                                (33)
                            </td>
                        </tr>
                        <?php 
                            for ($i=1;$i<=28;$i++)
                            {	 
                            ?>
                        <tr class="$third_row">
                            <td><?php echo $i; ?></td>
                            <td align="left">
                                <?php 
                                    if ($i===1) {$j = 1 ; echo " हत्या (302) " ;}
                                       elseif ($i===2){ $j = 2 ; echo " हत्या का प्रयास (307) "; }
                                    elseif ($i===3){ $j = 3 ; echo " डकेती (395) ";}  
                                    elseif ($i===4){ $j = 4 ; echo " डकैती की तैयारी ";}
                                    elseif ($i===5){ $j = 5 ; echo " लूट (392) ";}
                                    elseif ($i===6){ $j = 7 ; echo " गृहभेदन ";}
                                    elseif ($i===7){ $j = 9 ; echo " चोरी ";}
                                    elseif ($i===8){ $j = 69 ; echo " वाहन चोरी (दो पहिया) ";} 
                                    elseif ($i===9){ $j = 70 ; echo " वाहन चोरी (चार पहिया) ";}
                                    elseif ($i===10){ $j = 71 ; echo " आपराधिक मानव वध ";}
                                    elseif ($i===11){ $j = 72 ; echo " घोर उपहति ";}
                                    elseif ($i===12){ $j = 11 ; echo " बलवा (147/148) ";}
                                    elseif ($i===13){ $j = 12 ; echo " बलात्कार (376) ";}
                                    elseif ($i===14){ $j = 13 ; $k = 64; $l1 = " महिलाओं का अपहरण "; echo " महिलाओं का अपहरण ";}  // same as aphharan
                                    elseif ($i===15){ $j = 13 ; $k = 64; $l1 = "बालिकाओं का व्यपहरण"; echo " बालिकाओं का व्यपहरण ";} // same as aphharan
                                    elseif ($i===16){ $j = 13 ; $k = 64; $l1 = "धन हेतु अपहरण"; echo " धन हेतु अपहरण ";} // same as aphharan
                                    elseif ($i===17){ $j = 13 ; $k = 64; $l1 = "अन्य अपहरण"; echo " अन्य अपहरण ";} // same as aphharan
                                    elseif ($i===18){ $j = 42 ; echo " दहेज मृत्यु ";}
                                    elseif ($i===19){ $j = 15 ;  $k = 39; echo " छेडछाड ";}
                                    elseif ($i===20){ $j = 73 ; echo " यौंन उत्पीडन ";}
                                    elseif ($i===21){ $j = 74 ; echo " छल ";}
                                    elseif ($i===22){ $j = 75 ; echo " आपराधिक न्यास भंग ";}
                                    elseif ($i===23){ $j = 76 ; echo " कूटकरण / कूट रचना ";}
                                    elseif ($i===24){ $j = 77 ; echo " तेजाब काण्ड ";}
                                    elseif ($i===25){ $j = 78 ; echo " रैगिंग प्रकरण ";}
                                    elseif ($i===26){ $j = 79 ; echo " संगठित गिरोह के अपराध ";}
                                    elseif ($i===27){ $j = 80 ; echo " सफेद पोश अपराध ";}
                                    elseif ($i===28){ $j = 44 ; echo " आगजनी (435/436) ";}
                                    else { }
                                    ?>
                            </td>
                            <?php 
                                $sp1='SP';
                                $police_tracking->select_db("ftcaaazc_epfts");
                                $st1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ? and zone = ?");
                                   $st1->bind_param("ss", $sp1, $_SESSION['MM_Zone']);
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
                                    // echo "<pre>";
                                    // echo "current".$datef;
                                    // echo "</pre>";
                                    // echo "<pre>";
                                    // echo "current". $date1;
                                    // echo "</pre>";
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    	if($i===14)
                                    	{
                                    $dsr_balig1 ='वयस्क';
                                    $dsr_gender ='महिला';
                                    if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age >= ? ") ) 
                                       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                       if ( !$stmt2->bind_param("isssssi",$branch_id1, $datef, $date1, $j, $k, $dsr_gender, $age) ) 
                                       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    	}
                                    	elseif($i===15)
                                    	{
                                    	$dsr_balig2 ='अव्यसक';
                                    	$dsr_gender ='महिला';
                                    if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age < ? ") ) 
                                       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                       if ( !$stmt2->bind_param("isssssi", $branch_id1, $datef, $date1, $j, $k, $dsr_gender, $age) ) 
                                       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    	}
                                    	elseif($i===16)
                                    	{
                                    $dsr_kdnp_rsn ='फिरौती के लिये';
                                    if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND dsr_kdnp_rsn = ? ") ) 
                                       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                       if ( !$stmt2->bind_param("isssss", $branch_id1, $datef, $date1, $j, $k, $dsr_kdnp_rsn) )
                                       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    	}
                                    	elseif($i===17) 
                                    	{
                                    	$dsr_kdnp_rsn ='फिरौती के लिये';
                                    	$dsr_gender ='महिला';
                                    if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender != ?") ) 
                                       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                       if ( !$stmt2->bind_param("isssss", $branch_id1, $datef, $date1, $j, $k, $dsr_gender) )
                                       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
                                    	}
                                    	elseif($i===19) 
                                    	{
                                    if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
                                       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                       if ( !$stmt2->bind_param("issss", $branch_id1, $datef, $date1, $j, $k) )
                                       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
                                    	}
                                    else
                                    {
                                    if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
                                       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                       if ( !$stmt2->bind_param("isss",$branch_id1,$datef, $date1,$j) )
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
                                    $ipc[$i][$l]=$cid2;
                                    ?>
                                <span><?php echo $cid2;?></span>
                                <?php
                                    $stmt2->close();
                                    ?>	
                            </td>
                            <td>
                                <?php 
                                    // echo "<pre>";
                                    // echo "New Date1". $newDate1;
                                    // echo "</pre>";
                                    // echo "<pre>";
                                    // echo "New Date2".$newDate2;
                                    // echo "</pre>";
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    if($i===14)
                                    {
                                    $dsr_balig1 ='वयस्क';
                                    $dsr_gender ='महिला';
                                    
                                     if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age >= ? ") ) 
                                     echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt17->bind_param("isssssi", $branch_id1, $newDate1, $newDate2, $j, $k, $dsr_gender, $age) )
                                     echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===15)
                                    {
                                    $dsr_balig2 ='अव्यसक';
                                    $dsr_gender ='महिला';
                                    if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age < ? ") ) 
                                         echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                         if ( !$stmt17->bind_param("isssssi", $branch_id1, $newDate1, $newDate2, $j, $k, $dsr_gender, $age) )
                                         echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===16)
                                    {
                                    $dsr_kdnp_rsn ='फिरौती के लिये';
                                     if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND dsr_kdnp_rsn = ? ") ) 
                                     echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt17->bind_param("isssss", $branch_id1, $newDate1, $newDate2, $j, $k, $dsr_kdnp_rsn) )
                                     echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===17) 
                                    {
                                    $dsr_kdnp_rsn ='फिरौती के लिये';
                                    $dsr_gender ='महिला';
                                    if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender != ?") ) 
                                     echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt17->bind_param("isssss", $branch_id1, $newDate1, $newDate2, $j, $k, $dsr_gender) )
                                     echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===19) 
                                    {
                                    if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
                                     echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt17->bind_param("issss", $branch_id1, $newDate1, $newDate2, $j, $k) )
                                     echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
                                    }
                                    else{
                                    if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc=?") ) 
                                     echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt17->bind_param("isss",$branch_id1,$newDate1,$newDate2,$j) )
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
                                <span><?php echo $cid17;?></span>
                                <?php
                                    $stmt17->close();
                                    ?>
                            </td>
                            <?php 
                                if($newyear2=='2018')
                                {
                                ?>		
                            <td>
                                <?php 
                                    // echo "<pre>";
                                    // echo "New Date3". $newDate3;
                                    // echo "</pre>";
                                    // echo "<pre>";
                                    // echo "New Date4".$newDate4;
                                    // echo "</pre>"; ?>
                                <?php
                                    
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    if($i===14)
                                    {
                                    $dsr_balig1 ='वयस्क';
                                    $dsr_gender ='महिला';
                                      if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age >= ? ") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isssssi", $branch_id1, $newDate3, $newDate4, $j, $k, $dsr_gender, $age) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===15)
                                    {
                                    $dsr_balig2 ='अव्यसक';
                                    $dsr_gender ='महिला';
                                    if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender = ? AND pidit_list.pidit_age < ? ") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isssssi", $branch_id1, $newDate3, $newDate4, $j, $k, $dsr_gender, $age) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===16)
                                    {
                                    $dsr_kdnp_rsn = 'फिरौती के लिये';
                                      if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?) AND dsr_kdnp_rsn = ?") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isssss", $branch_id1, $newDate3, $newDate4, $j, $k, $dsr_kdnp_rsn) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===17) 
                                    {
                                    $dsr_kdnp_rsn ='फिरौती के लिये';
                                    $dsr_gender ='महिला';
                                    if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(DISTINCT(pidit_list.dsr_id)) FROM pidit_list INNER JOIN dsr_entries ON pidit_list.dsr_id = dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND pidit_list.pidit_gender != ?") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isssss", $branch_id1, $newDate3, $newDate4, $j, $k, $dsr_gender) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===19) 
                                    {
                                    if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("issss", $branch_id1, $newDate3, $newDate4, $j, $k) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";	
                                    }
                                    else{
                                    if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc=?") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isss",$branch_id1,$newDate3, $newDate4,$j) )
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
                                <span><?php echo $cid18;?></span>
                                <?php
                                    $stmt18->close();
                                    ?>
                            </td>
                            <?php 
                                }    //if($newyear2=='2018') end here
                                   else
                                   {
                                ?>
                            <td>
                                <?php 
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    if($i===14)
                                    {
                                    $kidnap1 ='महिलाओं का अपहरण';
                                    $sql_mahila_apharan = "SELECT SUM(crime) FROM old_records WHERE district = ? AND  ( start_date >= ? AND start_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc = ?) AND kidnapping = ? ";
                                      
                                      if ( !$stmt18 = $police_dsr->prepare($sql_mahila_apharan) ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isssss",$branch_id1,$newDate3, $newDate4,$j,$k,$kidnap1) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    
                                    }
                                    elseif($i===15)
                                    {
                                    $kidnap2 ='बालिकाओं का व्यपहरण';
                                      if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND  ( start_date >= ? AND start_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc = ?) AND kidnapping = ? ") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isssss",$branch_id1,$newDate3, $newDate4,$j,$k,$kidnap2) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===16)
                                    {
                                    $kidnap3 ='धन हेतु अपहरण';
                                      if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND  ( start_date >= ? AND start_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc = ?) AND kidnapping = ? ") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isssss",$branch_id1,$newDate3, $newDate4,$j,$k,$kidnap3) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===17) 
                                    {
                                    $kidnap4 ='अन्य अपहरण';
                                      if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND  ( start_date >= ? AND start_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc = ?) AND kidnapping = ? ") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isssss",$branch_id1,$newDate3, $newDate4,$j,$k,$kidnap4) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    elseif($i===19) 
                                    {
                                    if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND  ( start_date >= ? AND start_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("issss", $branch_id1, $newDate3, $newDate4, $j, $k) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                    }
                                    else{
                                    if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND  ( start_date >= ? AND start_date <= ?) AND dsr_vidhan_ipc=?") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isss",$branch_id1,$newDate3, $newDate4,$j) )
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
                                <span><?php if($cid18>0){ echo $cid18;} else{echo 0;}?></span>
                                <?php
                                    $stmt18->close();
                                    ?>
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
                        <tr class="$fourth_row" >
                            <td><?php echo 29; ?></td>
                            <td align="left">
                                <?php echo " अन्य भादवि ";	?>
                            </td>
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
                                     //echo $l;
                                  ?>
                            <td>
                                <?php
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $gum = '102';
                                    //$nakbajni = '94';
                                    if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc is not NULL") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt2->bind_param("isss", $branch_id2, $datef, $date1, $gum) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt2->execute() ) 
                                      echo "Execute Error: ($stmt2->errno)  $stmt2->error";
                                    if ( !$stmt2->store_result() ) //Only for select with bind_result()
                                      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                      //if($stmt3->num_rows === 0) { echo "No Results"; }
                                      $stmt2->bind_result($cid2); 
                                      $stmt2->fetch();
                                    $ip12[$l]=$cid2-($ipc[1][$l]+$ipc[2][$l]+$ipc[3][$l]+$ipc[4][$l]+$ipc[5][$l]+$ipc[6][$l]+$ipc[7][$l]+$ipc[8][$l]+$ipc[9][$l]+$ipc[10][$l]+$ipc[11][$l]+$ipc[12][$l]+$ipc[13][$l]+$ipc[14][$l]+$ipc[15][$l]+$ipc[16][$l]+$ipc[17][$l]+$ipc[18][$l]+$ipc[19][$l]+$ipc[20][$l]+$ipc[21][$l]+$ipc[22][$l]+$ipc[23][$l]+$ipc[24][1]+$ipc[25][$l]+$ipc[26][$l]+$ipc[27][$l]+$ipc[28][$l]);
                                    
                                    $ipc[29][$l]=$cid2-($ipc[1][$l]+$ipc[2][$l]+$ipc[3][$l]+$ipc[4][$l]+$ipc[5][$l]+$ipc[6][$l]+$ipc[7][$l]+$ipc[8][$l]+$ipc[9][$l]+$ipc[10][$l]+$ipc[11][$l]+$ipc[12][$l]+$ipc[13][$l]+$ipc[14][$l]+$ipc[15][$l]+$ipc[16][$l]+$ipc[17][$l]+$ipc[18][$l]+$ipc[19][$l]+$ipc[20][$l]+$ipc[21][$l]+$ipc[22][$l]+$ipc[23][$l]+$ipc[24][1]+$ipc[25][$l]+$ipc[26][$l]+$ipc[27][$l]+$ipc[28][$l]);
                                    ?>
                                <span><?php echo $ipc[29][$l];?></span>
                            </td>
                            <td>
                                <?php 
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $gum = '102';
                                    //$nakbajni = '94';
                                    if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc is not NULL") ) 
                                     echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt17->bind_param("isss", $branch_id2, $newDate1, $newDate2, $gum) )
                                     echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                     if ( !$stmt17->execute() ) 
                                     echo "Execute Error: ($stmt17->errno)  $stmt17->error";
                                    if ( !$stmt17->store_result() ) //Only for select with bind_result()
                                     echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                     //if($stmt3->num_rows === 0) { echo "No Results"; }
                                     $stmt17->bind_result($cid17); 
                                     $stmt17->fetch();
                                    $ip21[$l]=$cid17-($ic[1][$l]+$ic[2][$l]+$ic[3][$l]+$ic[4][$l]+$ic[5][$l]+$ic[6][$l]+$ic[7][$l]+$ic[8][$l]+$ic[9][$l]+$ic[10][$l]+$ic[11][$l]+$ic[12][$l]+$ic[13][$l]+$ic[14][$l]+$ic[15][$l]+$ic[16][$l]+$ic[17][$l]+$ic[18][$l]+$ic[19][$l]+$ic[20][$l]+$ic[21][$l]+$ic[22][$l]+$ic[23][$l]+$ic[24][1]+$ic[25][$l]+$ic[26][$l]+$ic[27][$l]+$ic[28][$l]);
                                    
                                    $ic[29][$l]=$cid17-($ic[1][$l]+$ic[2][$l]+$ic[3][$l]+$ic[4][$l]+$ic[5][$l]+$ic[6][$l]+$ic[7][$l]+$ic[8][$l]+$ic[9][$l]+$ic[10][$l]+$ic[11][$l]+$ic[12][$l]+$ic[13][$l]+$ic[14][$l]+$ic[15][$l]+$ic[16][$l]+$ic[17][$l]+$ic[18][$l]+$ic[19][$l]+$ic[20][$l]+$ic[21][$l]+$ic[22][$l]+$ic[23][$l]+$ic[24][1]+$ic[25][$l]+$ic[26][$l]+$ic[27][$l]+$ic[28][$l]);
                                    ?>
                                <span><?php echo $ic[29][$l];?></span>
                            </td>
                            <?php if($newyear2=='2018')
                                {?>		
                            <td>
                                <?php 
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $gum = '102';
                                    if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc is not NULL") ) 
                                      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->bind_param("isss", $branch_id2, $newDate3, $newDate4, $gum) )
                                      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                      if ( !$stmt18->execute() ) 
                                      echo "Execute Error: ($stmt18->errno)  $stmt18->error";
                                    if ( !$stmt18->store_result() ) //Only for select with bind_result()
                                      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                      //if($stmt18->num_rows === 0) { echo "No Results"; }
                                      $stmt18->bind_result($cid18); 
                                      $stmt18->fetch();
                                    $ip22[$l]=$cid18-($c[1][$l]+$c[2][$l]+$c[3][$l]+$c[4][$l]+$c[5][$l]+$c[6][$l]+$c[7][$l]+$c[8][$l]+$c[9][$l]+$c[10][$l]+$c[11][$l]+$c[12][$l]+$c[13][$l]+$c[14][$l]+$c[15][$l]+$c[16][$l]+$c[17][$l]+$c[18][$l]+$c[19][$l]+$c[20][$l]+$c[21][$l]+$c[22][$l]+$c[23][$l]+$c[24][$l]+$c[25][$l]+$c[26][$l]+$c[27][$l]+$c[28][$l]);
                                    
                                    $c[29][$l]=$cid18-($c[1][$l]+$c[2][$l]+$c[3][$l]+$c[4][$l]+$c[5][$l]+$c[6][$l]+$c[7][$l]+$c[8][$l]+$c[9][$l]+$c[10][$l]+$c[11][$l]+$c[12][$l]+$c[13][$l]+$c[14][$l]+$c[15][$l]+$c[16][$l]+$c[17][$l]+$c[18][$l]+$c[19][$l]+$c[20][$l]+$c[21][$l]+$c[22][$l]+$c[23][$l]+$c[24][$l]+$c[25][$l]+$c[26][$l]+$c[27][$l]+$c[28][$l]);
                                    ?>
                                <span><?php echo $c[29][$l]?></span>
                            </td>
                            <?php 
                                }    //if($newyear2=='2018') end here
                                else{?>
                            <td>
                                <?php 
                                    $police_dsr->select_db("ftcaaazc_dsr");
                                    $gum = '102';
                                    $nakbajni = '94';
                                    if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND  ( start_date >= ? AND start_date <= ?) AND dsr_vidhan_ipc != ? AND dsr_vidhan_ipc != '' AND dsr_vidhan_ipc is not NULL AND dsr_vidhan_ipc != ?") ) 
                                       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
                                       if ( !$stmt18->bind_param("isssi", $branch_id2, $newDate3, $newDate4, $gum, $nakbajni) )
                                       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
                                       if ( !$stmt18->execute() ) 
                                       echo "Execute Error: ($stmt18->errno)  $stmt18->error";
                                    if ( !$stmt18->store_result() ) //Only for select with bind_result()
                                       echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
                                       //if($stmt18->num_rows === 0) { echo "No Results"; }
                                       $stmt18->bind_result($cid18); 
                                       $stmt18->fetch();
                                    $ip22[$l]=$cid18-($c[1][$l]+$c[2][$l]+$c[3][$l]+$c[4][$l]+$c[5][$l]+$c[6][$l]+$c[7][$l]+$c[8][$l]+$c[9][$l]+$c[10][$l]+$c[11][$l]+$c[12][$l]+$c[13][$l]+$c[14][$l]+$c[15][$l]+$c[16][$l]+$c[17][$l]+$c[18][$l]+$c[19][$l]+$c[20][$l]+$c[21][$l]+$c[22][$l]+$c[23][$l]+$c[24][$l]+$c[25][$l]+$c[26][$l]+$c[27][$l]+$c[28][$l]);
                                    
                                    $c[29][$l]=$cid18-($c[1][$l]+$c[2][$l]+$c[3][$l]+$c[4][$l]+$c[5][$l]+$c[6][$l]+$c[7][$l]+$c[8][$l]+$c[9][$l]+$c[10][$l]+$c[11][$l]+$c[12][$l]+$c[13][$l]+$c[14][$l]+$c[15][$l]+$c[16][$l]+$c[17][$l]+$c[18][$l]+$c[19][$l]+$c[20][$l]+$c[21][$l]+$c[22][$l]+$c[23][$l]+$c[24][$l]+$c[25][$l]+$c[26][$l]+$c[27][$l]+$c[28][$l]);
                                    ?>
                                <span><?php if($c[29][$l]>0){ echo $c[29][$l];} else{echo 0;}?></span>
                            </td>
                            <?php }//else close ?>
                            <?php } //st2 end here?>
                            <td>
                                <?php 
                                    $v=$ip12[1]+$ip12[2]+$ip12[3]+$ip12[4]+$ip12[5]+$ip12[6]+$ip12[7]+$ip12[8]+$ip12[9]+$ip12[10];
                                    echo $v;
                                    ?>
                            </td>
                            <td>
                                <?php 
                                    $t=$ip21[1]+$ip21[2]+$ip21[3]+$ip21[4]+$ip21[5]+$ip21[6]+$ip21[7]+$ip21[8]+$ip21[9]+$ip21[10];
                                    echo $t;
                                    ?>
                            </td>
                            <td>
                                <?php 
                                    $u=$ip22[1]+$ip22[2]+$ip22[3]+$ip22[4]+$ip22[5]+$ip22[6]+$ip22[7]+$ip22[8]+$ip22[9]+$ip22[10];
                                    echo $u;
                                    ?>
                            </td>
                        </tr>
                        <tr class="$fifth_row">
                            <td colspan="2">योग</td>
                            <td>
                                <?php $s=$ipc[1][1]+$ipc[2][1]+$ipc[3][1]+$ipc[4][1]+$ipc[5][1]+$ipc[6][1]+$ipc[7][1]+$ipc[8][1]+$ipc[9][1]+$ipc[10][1]+$ipc[11][1]+$ipc[12][1]+$ipc[13][1]+$ipc[14][1]+$ipc[15][1]+$ipc[16][1]+$ipc[17][1]+$ipc[18][1]+$ipc[19][1]+$ipc[20][1]+$ipc[21][1]+$ipc[22][1]+$ipc[23][1]+$ipc[24][1]+$ipc[25][1]+$ipc[26][1]+$ipc[27][1]+$ipc[28][1]+$ipc[29][1];
                                    echo $s;?>
                            </td>
                            <td>
                                <?php $sc=$ic[1][1]+$ic[2][1]+$ic[3][1]+$ic[4][1]+$ic[5][1]+$ic[6][1]+$ic[7][1]+$ic[8][1]+$ic[9][1]+$ic[10][1]+$ic[11][1]+$ic[12][1]+$ic[13][1]+$ic[14][1]+$ic[15][1]+$ic[16][1]+$ic[17][1]+$ic[18][1]+$ic[19][1]+$ic[20][1]+$ic[21][1]+$ic[22][1]+$ic[23][1]+$ic[24][1]+$ic[25][1]+$ic[26][1]+$ic[27][1]+$ic[28][1]+$ic[29][1];
                                    echo $sc;?>
                            </td>
                            <td>
                                <?php $pc=$c[1][1]+$c[2][1]+$c[3][1]+$c[4][1]+$c[5][1]+$c[6][1]+$c[7][1]+$c[8][1]+$c[9][1]+$c[10][1]+$c[11][1]+$c[12][1]+$c[13][1]+$c[14][1]+$c[15][1]+$c[16][1]+$c[17][1]+$c[18][1]+$c[19][1]+$c[20][1]+$c[21][1]+$c[22][1]+$c[23][1]+$c[24][1]+$c[25][1]+$c[26][1]+$c[27][1]+$c[28][1]+$c[29][1];
                                    echo $pc;?>	
                            </td>
                            <td> 
                                <?php $s1=$ipc[1][2]+$ipc[2][2]+$ipc[3][2]+$ipc[4][2]+$ipc[5][2]+$ipc[6][2]+$ipc[7][2]+$ipc[8][2]+$ipc[9][2]+$ipc[10][2]+$ipc[11][2]+$ipc[12][2]+$ipc[13][2]+$ipc[14][2]+$ipc[15][2]+$ipc[16][2]+$ipc[17][2]+$ipc[18][2]+$ipc[19][2]+$ipc[20][2]+$ipc[21][2]+$ipc[22][2]+$ipc[23][2]+$ipc[24][2]+$ipc[25][2]+$ipc[26][2]+$ipc[27][2]+$ipc[28][2]+$ipc[29][2];
                                    echo $s1;?>
                            </td>
                            <td>
                                <?php $sc1=$ic[1][2]+$ic[2][2]+$ic[3][2]+$ic[4][2]+$ic[5][2]+$ic[6][2]+$ic[7][2]+$ic[8][2]+$ic[9][2]+$ic[10][2]+$ic[11][2]+$ic[12][2]+$ic[13][2]+$ic[14][2]+$ic[15][2]+$ic[16][2]+$ic[17][2]+$ic[18][2]+$ic[19][2]+$ic[20][2]+$ic[21][2]+$ic[22][2]+$ic[23][2]+$ic[24][2]+$ic[25][2]+$ic[26][2]+$ic[27][2]+$ic[28][2]+$ic[29][2];
                                    echo $sc1;?>
                            </td>
                            <td>
                                <?php $pc1=$c[1][2]+$c[2][2]+$c[3][2]+$c[4][2]+$c[5][2]+$c[6][2]+$c[7][2]+$c[8][2]+$c[9][2]+$c[10][2]+$c[11][2]+$c[12][2]+$c[13][2]+$c[14][2]+$c[15][2]+$c[16][2]+$c[17][2]+$c[18][2]+$c[19][2]+$c[20][2]+$c[21][2]+$c[22][2]+$c[23][2]+$c[24][2]+$c[25][2]+$c[26][2]+$c[27][2]+$c[28][2]+$c[29][2];
                                    echo $pc1;?>
                            </td>
                            <td>
                                <?php
                                    $s2=$ipc[1][3]+$ipc[2][3]+$ipc[3][3]+$ipc[4][3]+$ipc[5][3]+$ipc[6][3]+$ipc[7][3]+$ipc[8][3]+$ipc[9][3]+$ipc[10][3]+$ipc[11][3]+$ipc[12][3]+$ipc[13][3]+$ipc[14][3]+$ipc[15][3]+$ipc[16][3]+$ipc[17][3]+$ipc[18][3]+$ipc[19][3]+$ipc[20][3]+$ipc[21][3]+$ipc[22][3]+$ipc[23][3]+$ipc[24][3]+$ipc[25][3]+$ipc[26][3]+$ipc[27][3]+$ipc[28][3]+$ipc[29][3];
                                    echo $s2;?>
                            </td>
                            <td>
                                <?php
                                    $sc2=$ic[1][3]+$ic[2][3]+$ic[3][3]+$ic[4][3]+$ic[5][3]+$ic[6][3]+$ic[7][3]+$ic[8][3]+$ic[9][3]+$ic[10][3]+$ic[11][3]+$ic[12][3]+$ic[13][3]+$ic[14][3]+$ic[15][3]+$ic[16][3]+$ic[17][3]+$ic[18][3]+$ic[19][3]+$ic[20][3]+$ic[21][3]+$ic[22][3]+$ic[23][3]+$ic[24][3]+$ic[25][3]+$ic[26][3]+$ic[27][3]+$ic[28][3]+$ic[29][3];
                                    echo $sc2;?>
                            </td>
                            <td>
                                <?php
                                    $pc2=$c[1][3]+$c[2][3]+$c[3][3]+$c[4][3]+$c[5][3]+$c[6][3]+$c[7][3]+$c[8][3]+$c[9][3]+$c[10][3]+$c[11][3]+$c[12][3]+$c[13][3]+$c[14][3]+$c[15][3]+$c[16][3]+$c[17][3]+$c[18][3]+$c[19][3]+$c[20][3]+$c[21][3]+$c[22][3]+$c[23][3]+$c[24][3]+$c[25][3]+$c[26][3]+$c[27][3]+$c[28][3]+$c[29][3];
                                    echo $pc2;?>
                            </td>
                            <td>
                                <?php
                                    $s3=$ipc[1][4]+$ipc[2][4]+$ipc[3][4]+$ipc[4][4]+$ipc[5][4]+$ipc[6][4]+$ipc[7][4]+$ipc[8][4]+$ipc[9][4]+$ipc[10][4]+$ipc[11][4]+$ipc[12][4]+$ipc[13][4]+$ipc[14][4]+$ipc[15][4]+$ipc[16][4]+$ipc[17][4]+$ipc[18][4]+$ipc[19][4]+$ipc[20][4]+$ipc[21][4]+$ipc[22][4]+$ipc[23][4]+$ipc[24][4]+$ipc[25][4]+$ipc[26][4]+$ipc[27][4]+$ipc[28][4]+$ipc[29][4];
                                    echo $s3;?>
                            </td>
                            <td>
                                <?php
                                    $sc3=$ic[1][4]+$ic[2][4]+$ic[3][4]+$ic[4][4]+$ic[5][4]+$ic[6][4]+$ic[7][4]+$ic[8][4]+$ic[9][4]+$ic[10][4]+$ic[11][4]+$ic[12][4]+$ic[13][4]+$ic[14][4]+$ic[15][4]+$ic[16][4]+$ic[17][4]+$ic[18][4]+$ic[19][4]+$ic[20][4]+$ic[21][4]+$ic[22][4]+$ic[23][4]+$ic[24][4]+$ic[25][4]+$ic[26][4]+$ic[27][4]+$ic[28][4]+$ic[29][4];
                                    echo $sc3;?>
                            </td>
                            <td>
                                <?php
                                    $pc3=$c[1][4]+$c[2][4]+$c[3][4]+$c[4][4]+$c[5][4]+$c[6][4]+$c[7][4]+$c[8][4]+$c[9][4]+$c[10][4]+$c[11][4]+$c[12][4]+$c[13][4]+$c[14][4]+$c[15][4]+$c[16][4]+$c[17][4]+$c[18][4]+$c[19][4]+$c[20][4]+$c[21][4]+$c[22][4]+$c[23][4]+$c[24][4]+$c[25][4]+$c[26][4]+$c[27][4]+$c[28][4]+$c[29][4];
                                    echo $pc3;?>
                            </td>
                            <td>
                                <?php
                                    $s4=$ipc[1][5]+$ipc[2][5]+$ipc[3][5]+$ipc[4][5]+$ipc[5][5]+$ipc[6][5]+$ipc[7][5]+$ipc[8][5]+$ipc[9][5]+$ipc[10][5]+$ipc[11][5]+$ipc[12][5]+$ipc[13][5]+$ipc[14][5]+$ipc[15][5]+$ipc[16][5]+$ipc[17][5]+$ipc[18][5]+$ipc[19][5]+$ipc[20][5]+$ipc[21][5]+$ipc[22][5]+$ipc[23][5]+$ipc[24][5]+$ipc[25][5]+$ipc[26][5]+$ipc[27][5]+$ipc[28][5]+$ipc[29][5];
                                    	echo $s4;?>
                            </td>
                            <td>
                                <?php
                                    $sc4=$ic[1][5]+$ic[2][5]+$ic[3][5]+$ic[4][5]+$ic[5][5]+$ic[6][5]+$ic[7][5]+$ic[8][5]+$ic[9][5]+$ic[10][5]+$ic[11][5]+$ic[12][5]+$ic[13][5]+$ic[14][5]+$ic[15][5]+$ic[16][5]+$ic[17][5]+$ic[18][5]+$ic[19][5]+$ic[20][5]+$ic[21][5]+$ic[22][5]+$ic[23][5]+$ic[24][5]+$ic[25][5]+$ic[26][5]+$ic[27][5]+$ic[28][5]+$ic[29][5];
                                    	echo $sc4;?>
                            </td>
                            <td>
                                <?php
                                    $pc4=$c[1][5]+$c[2][5]+$c[3][5]+$c[4][5]+$c[5][5]+$c[6][5]+$c[7][5]+$c[8][5]+$c[9][5]+$c[10][5]+$c[11][5]+$c[12][5]+$c[13][5]+$c[14][5]+$c[15][5]+$c[16][5]+$c[17][5]+$c[18][5]+$c[19][5]+$c[20][5]+$c[21][5]+$c[22][5]+$c[23][5]+$c[24][5]+$c[25][5]+$c[26][5]+$c[27][5]+$c[28][5]+$c[29][5];
                                    	echo $pc4;?>
                            </td>
                            <td>
                                <?php
                                    $s5=$ipc[1][6]+$ipc[2][6]+$ipc[3][6]+$ipc[4][6]+$ipc[5][6]+$ipc[6][6]+$ipc[7][6]+$ipc[8][6]+$ipc[9][6]+$ipc[10][6]+$ipc[11][6]+$ipc[12][6]+$ipc[13][6]+$ipc[14][6]+$ipc[15][6]+$ipc[16][6]+$ipc[17][6]+$ipc[18][6]+$ipc[19][6]+$ipc[20][6]+$ipc[21][6]+$ipc[22][6]+$ipc[23][6]+$ipc[24][6]+$ipc[25][6]+$ipc[26][6]+$ipc[27][6]+$ipc[28][6]+$ipc[29][6];
                                    echo $s5;?>
                            </td>
                            <td>
                                <?php
                                    $sc5=$ic[1][6]+$ic[2][6]+$ic[3][6]+$ic[4][6]+$ic[5][6]+$ic[6][6]+$ic[7][6]+$ic[8][6]+$ic[9][6]+$ic[10][6]+$ic[11][6]+$ic[12][6]+$ic[13][6]+$ic[14][6]+$ic[15][6]+$ic[16][6]+$ic[17][6]+$ic[18][6]+$ic[19][6]+$ic[20][6]+$ic[21][6]+$ic[22][6]+$ic[23][6]+$ic[24][6]+$ic[25][6]+$ic[26][6]+$ic[27][6]+$ic[28][6]+$ic[29][6];
                                    echo $sc5;?>
                            </td>
                            <td>
                                <?php
                                    $pc5=$c[1][6]+$c[2][6]+$c[3][6]+$c[4][6]+$c[5][6]+$c[6][6]+$c[7][6]+$c[8][6]+$c[9][6]+$c[10][6]+$c[11][6]+$c[12][6]+$c[13][6]+$c[14][6]+$c[15][6]+$c[16][6]+$c[17][6]+$c[18][6]+$c[19][6]+$c[20][6]+$c[21][6]+$c[22][6]+$c[23][6]+$c[24][6]+$c[25][6]+$c[26][6]+$c[27][6]+$c[28][6]+$c[29][6];
                                    echo $pc5;?>
                            </td>
                            <td>
                                <?php
                                    $s6=$ipc[1][7]+$ipc[2][7]+$ipc[3][7]+$ipc[4][7]+$ipc[5][7]+$ipc[6][7]+$ipc[7][7]+$ipc[8][7]+$ipc[9][7]+$ipc[10][7]+$ipc[11][7]+$ipc[12][7]+$ipc[13][7]+$ipc[14][7]+$ipc[15][7]+$ipc[16][7]+$ipc[17][7]+$ipc[18][7]+$ipc[19][7]+$ipc[20][7]+$ipc[21][7]+$ipc[22][7]+$ipc[23][7]+$ipc[24][7]+$ipc[25][7]+$ipc[26][7]+$ipc[27][7]+$ipc[28][7]+$ipc[29][7];
                                    echo $s6;?>
                            </td>
                            <td>
                                <?php
                                    $sc6=$ic[1][7]+$ic[2][7]+$ic[3][7]+$ic[4][7]+$ic[5][7]+$ic[6][7]+$ic[7][7]+$ic[8][7]+$ic[9][7]+$ic[10][7]+$ic[11][7]+$ic[12][7]+$ic[13][7]+$ic[14][7]+$ic[15][7]+$ic[16][7]+$ic[17][7]+$ic[18][7]+$ic[19][7]+$ic[20][7]+$ic[21][7]+$ic[22][7]+$ic[23][7]+$ic[24][7]+$ic[25][7]+$ic[26][7]+$ic[27][7]+$ic[28][7]+$ic[29][7];
                                    echo $sc6;?>
                            </td>
                            <td>
                                <?php
                                    $pc6=$c[1][7]+$c[2][7]+$c[3][7]+$c[4][7]+$c[5][7]+$c[6][7]+$c[7][7]+$c[8][7]+$c[9][7]+$c[10][7]+$c[11][7]+$c[12][7]+$c[13][7]+$c[14][7]+$c[15][7]+$c[16][7]+$c[17][7]+$c[18][7]+$c[19][7]+$c[20][7]+$c[21][7]+$c[22][7]+$c[23][7]+$c[24][7]+$c[25][7]+$c[26][7]+$c[27][7]+$c[28][7]+$c[29][7];
                                    echo $pc6;?>
                            </td>
                            <td>
                                <?php
                                    $s7=$ipc[1][8]+$ipc[2][8]+$ipc[3][8]+$ipc[4][8]+$ipc[5][8]+$ipc[6][8]+$ipc[7][8]+$ipc[8][8]+$ipc[9][8]+$ipc[10][8]+$ipc[11][8]+$ipc[12][8]+$ipc[13][8]+$ipc[14][8]+$ipc[15][8]+$ipc[16][8]+$ipc[17][8]+$ipc[18][8]+$ipc[19][8]+$ipc[20][8]+$ipc[21][8]+$ipc[22][8]+$ipc[23][8]+$ipc[24][8]+$ipc[25][8]+$ipc[26][8]+$ipc[27][8]+$ipc[28][8]+$ipc[29][8];
                                    echo $s7;?>
                            </td>
                            <td>
                                <?php
                                    $sc7=$ic[1][8]+$ic[2][8]+$ic[3][8]+$ic[4][8]+$ic[5][8]+$ic[6][8]+$ic[7][8]+$ic[8][8]+$ic[9][8]+$ic[10][8]+$ic[11][8]+$ic[12][8]+$ic[13][8]+$ic[14][8]+$ic[15][8]+$ic[16][8]+$ic[17][8]+$ic[18][8]+$ic[19][8]+$ic[20][8]+$ic[21][8]+$ic[22][8]+$ic[23][8]+$ic[24][8]+$ic[25][8]+$ic[26][8]+$ic[27][8]+$ic[28][8]+$ic[29][8];
                                    echo $sc7;?>
                            </td>
                            <td>
                                <?php
                                    $pc7=$c[1][8]+$c[2][8]+$c[3][8]+$c[4][8]+$c[5][8]+$c[6][8]+$c[7][8]+$c[8][8]+$c[9][8]+$c[10][8]+$c[11][8]+$c[12][8]+$c[13][8]+$c[14][8]+$c[15][8]+$c[16][8]+$c[17][8]+$c[18][8]+$c[19][8]+$c[20][8]+$c[21][8]+$c[22][8]+$c[23][8]+$c[24][8]+$c[25][8]+$c[26][8]+$c[27][8]+$c[28][8]+$c[29][8];
                                    echo $pc7;?>
                            </td>
                            <td>
                                <?php
                                    $s8=$ipc[1][9]+$ipc[2][9]+$ipc[3][9]+$ipc[4][9]+$ipc[5][9]+$ipc[6][9]+$ipc[7][9]+$ipc[8][9]+$ipc[9][9]+$ipc[10][9]+$ipc[11][9]+$ipc[12][9]+$ipc[13][9]+$ipc[14][9]+$ipc[15][9]+$ipc[16][9]+$ipc[17][9]+$ipc[18][9]+$ipc[19][9]+$ipc[20][9]+$ipc[21][9]+$ipc[22][9]+$ipc[23][9]+$ipc[24][9]+$ipc[25][9]+$ipc[26][9]+$ipc[27][9]+$ipc[28][9]+$ipc[29][9];
                                    echo $s8;?>
                            </td>
                            <td>
                                <?php
                                    $sc8=$ic[1][9]+$ic[2][9]+$ic[3][9]+$ic[4][9]+$ic[5][9]+$ic[6][9]+$ic[7][9]+$ic[8][9]+$ic[9][9]+$ic[10][9]+$ic[11][9]+$ic[12][9]+$ic[13][9]+$ic[14][9]+$ic[15][9]+$ic[16][9]+$ic[17][9]+$ic[18][9]+$ic[19][9]+$ic[20][9]+$ic[21][9]+$ic[22][9]+$ic[23][9]+$ic[24][9]+$ic[25][9]+$ic[26][9]+$ic[27][9]+$ic[28][9]+$ic[29][9];
                                    echo $sc8;?>
                            </td>
                            <td>
                                <?php
                                    $pc8=$c[1][9]+$c[2][9]+$c[3][9]+$c[4][9]+$c[5][9]+$c[6][9]+$c[7][9]+$c[8][9]+$c[9][9]+$c[10][9]+$c[11][9]+$c[12][9]+$c[13][9]+$c[14][9]+$c[15][9]+$c[16][9]+$c[17][9]+$c[18][9]+$c[19][9]+$c[20][9]+$c[21][9]+$c[22][9]+$c[23][9]+$c[24][9]+$c[25][9]+$c[26][9]+$c[27][9]+$c[28][9]+$c[29][9];
                                    echo $pc8;?>
                            </td>
                            <td>
                                <?php
                                    $s9=$ipc[1][10]+$ipc[2][10]+$ipc[3][10]+$ipc[4][10]+$ipc[5][10]+$ipc[6][10]+$ipc[7][10]+$ipc[8][10]+$ipc[9][10]+$ipc[10][10]+$ipc[11][10]+$ipc[12][10]+$ipc[13][10]+$ipc[14][10]+$ipc[15][10]+$ipc[16][10]+$ipc[17][10]+$ipc[18][10]+$ipc[19][10]+$ipc[20][10]+$ipc[21][10]+$ipc[22][10]+$ipc[23][10]+$ipc[24][10]+$ipc[25][10]+$ipc[26][10]+$ipc[27][10]+$ipc[28][10]+$ipc[29][10];
                                    echo $s9;?>
                            </td>
                            <td>
                                <?php
                                    $sc9=$ic[1][10]+$ic[2][10]+$ic[3][10]+$ic[4][10]+$ic[5][10]+$ic[6][10]+$ic[7][10]+$ic[8][10]+$ic[9][10]+$ic[10][10]+$ic[11][10]+$ic[12][10]+$ic[13][10]+$ic[14][10]+$ic[15][10]+$ic[16][10]+$ic[17][10]+$ic[18][10]+$ic[19][10]+$ic[20][10]+$ic[21][10]+$ic[22][10]+$ic[23][10]+$ic[24][10]+$ic[25][10]+$ic[26][10]+$ic[27][10]+$ic[28][10]+$ic[29][10];
                                    echo $sc9;?>
                            </td>
                            <td>
                                <?php
                                    $pc9=$c[1][10]+$c[2][10]+$c[3][10]+$c[4][10]+$c[5][10]+$c[6][10]+$c[7][10]+$c[8][10]+$c[9][10]+$c[10][10]+$c[11][10]+$c[12][10]+$c[13][10]+$c[14][10]+$c[15][10]+$c[16][10]+$c[17][10]+$c[18][10]+$c[19][10]+$c[20][10]+$c[21][10]+$c[22][10]+$c[23][10]+$c[24][10]+$c[25][10]+$c[26][10]+$c[27][10]+$c[28][10]+$c[29][10];
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
                        <tr class="$sixth_row">
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
                    <?php  // } //stmt1 while end here ?>
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
        //     function getBody(element) {
        //     var divider = 2;
        //     var originalTable = element.clone();
        //     var tds = $(originalTable).children('tbody').children('tr').children('td').length;
        //     alert(tds);
        // }
        
        // getBody($('table.PrintTable'));
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