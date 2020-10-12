<?php 
    if (!isset($_SESSION['userid'])) {
        redirect('home');
    }
    
    
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Dashboard | Jyotish Vidhya</title>
        <!-- Favicon-->
        <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA==" crossorigin="anonymous" />
        <?php include_once('layouts/headerlinks.php'); ?>
        <style>
            section.content2 {
            margin: 20px 15px 0 100px;
            -moz-transition: 0.5s;
            -o-transition: 0.5s;
            -webkit-transition: 0.5s;
            transition: 0.5s;
            }
            body.theme-cyan {
            overflow-x: hidden;
            }
        </style>
    </head>
    <body class="theme-cyan">
        <div align="center">
            <h1 style="color:#ff7600">Jyotish Vidhya</h1>
        </div>
        <?php include_once('layouts/user_header.php'); ?>
        <div style="margin-left:0px">
            <img src="https://images.astroyogi.com/astroyogi2017/english/images/banner/Desktop_New_Homepage.jpg" class="col-lg-11" />
        </div>
        <section class="content2">
            <div class="row">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                    <div class="col-lg-9">
                        <div class="">
                            <div class="">
                                <div class='page-content'>
                                    <?php if($this->session->flashdata('error')) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <div class=""> <?php echo $this->session->flashdata('error'); ?>  </div>
                                    </div>
                                    <?php  } ?>
                                    <?php if($this->session->flashdata('success')) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <div class=""> <?php echo $this->session->flashdata('success'); ?>  </div>
                                    </div>
                                    <?php } ?>
                                    <div id="articles"  class="tab-pane active " >
                                         <div class="body" style= "display:none;">
                                            <div class="row">
                                                <?php
                                                    $i=1;
                                                    if($get_article['flag']==1)  {
                                                    foreach($get_article['articles'] as $value){   
                                                    ?> 
                                                    <div class="col-sm-6 col-md-3">
                                                    <div class="thumbnail">
                                                        <img src="<?php echo $value['post_image'];?>"  >
                                                        <div class="caption">
                                                            <h3><?php echo $value['post_type'];?></h3>
                                                            <p>
                                                                <?php echo $value['post_content'];?>
                                                            </p>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } } ?>     
                                            </div>
                                        </div>
                                        <section class="">
                                            <div class="">
                                                <div class="block-header">
                                                </div>
                                                <!-- Exportable Table -->
                                                <div class="row clearfix">
                                                    <div class="header">
                                                        <h2>
                                                            Articles
                                                        </h2>
                                                    </div>
                                                    <div class="start_table_with_body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Post </th>
                                                                        <th>Type</th>
                                                                        <th>Image</th>
                                                                        <th>Datetime</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php  /*echo "<pre>"; print_r($get_question);  echo "</pre>" */?>
                                                                    <?php
                                                                        $i=1;
                                                                        if($get_article['flag']==1)  {
                                                                        foreach($get_article['articles'] as $value){   
                                                                        ?>  
                                                                    <tr>
                                                                        <td><?php echo $i++; ?></td>
                                                                        <td><?php echo $value['post_content'];?></td>
                                                                        <td><?php echo $value['post_type'];?></td>
                                                                        <td><img src="<?php echo $value['post_image'];?>"  width="200" height="150"></td>
                                                                        <td><?php echo date("d-m-Y H:i:s ", strtotime($value['creation_date'])) ;?></td>
                                                                    </tr>
                                                                    <?php } } ?>        
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div id="quotes"  class="tab-pane " >
                                        <div class="body" style= "display:none;">
                                            <div class="row">
                                                <?php
                                                    $i=1;
                                                    if($get_quote['flag']==1)  {
                                                    foreach($get_quote['quotes'] as $value){   
                                                    ?> 
                                                    <div class="col-sm-6 col-md-3">
                                                    <div class="thumbnail">
                                                        <img src="<?php echo $value['post_image'];?>"  >
                                                        <div class="caption">
                                                            <h3><?php echo $value['post_type'];?></h3>
                                                            <p>
                                                                <?php echo $value['post_content'];?>
                                                            </p>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } } ?>     
                                            </div>
                                        </div>
                                        <section class="">
                                            <div class="">
                                                <div class="block-header">
                                                    <h2>
                                                    </h2>
                                                </div>
                                                <!-- Exportable Table -->
                                                <div class="row clearfix">
                                                    <div class="header">
                                                        <h2>
                                                            Quotes
                                                        </h2>
                                                    </div>
                                                    <div class="body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Post </th>
                                                                        <th>Type</th>
                                                                        <th>Image</th>
                                                                        <th>Datetime</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php  /*echo "<pre>"; print_r($get_question);  echo "</pre>" */?>
                                                                    <?php
                                                                        $i=1;
                                                                        if($get_quote['flag']==1)  {
                                                                        foreach($get_quote['quotes'] as $value){   
                                                                        ?>  
                                                                    <tr>
                                                                        <td><?php echo $i++; ?></td>
                                                                        <td><?php echo $value['post_content'];?></td>
                                                                        <td><?php echo $value['post_type'];?></td>
                                                                        <td><img src="<?php echo $value['post_image'];?>"  width="200" height="150"></td>
                                                                        <td><?php echo $value['creation_date'];?></td>
                                                                    </tr>
                                                                    <?php } } ?>        
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div id="polls"  class="tab-pane " >
                                        <section class="">
                                            <div class="">
                                                <div class="container">
                                                    <div class="row">
                                                        <?php $i= 1;
                                                            if(!$poles_response)  {
                                                            
                                                            ?>
                                                        <form action="<?php echo site_url(); ?>User/save_response" method="POST" >
                                                            <?php
                                                                $i=1;
                                                                if($get_poles['flag']==1)  {
                                                                foreach($get_poles['poles'] as $value){   
                                                                ?> 
                                                            <div class="col-md-6">
                                                                <label for="poll_question"><?php echo $value['poll_title'];    ?> </label>
                                                                <input class="form-check-label" type = "radio"
                                                                    name = "poll_option"
                                                                    id = "yes_id"
                                                                    value = "poll_option1" /> <?php echo $value['poll_option1']; ?> 
                                                                <input class="form-check-label" type = "radio"
                                                                    name = "poll_option"
                                                                    id = "no_id"
                                                                    value = "poll_option2" /><?php echo $value['poll_option2']; ?>
                                                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid']; ?>" >
                                                                <input type="hidden" name="question_id" value="<?php echo $value['id']; ?>" >
                                                            </div>
                                                            <?php } } ?>
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                        <?php } else { ?>
                                                        <div class="container" >
                                                            <center>
                                                                <h3> ASTRO-METER </h3>
                                                            </center>
                                                            <?php
                                                                $i=1;
                                                                if($get_poles['flag']==1)  {
                                                                foreach($get_poles['poles'] as $value){   
                                                                ?> 
                                                            <center>
                                                                <h3><? echo $value['poll_title'];    ?></h3>
                                                            </center>
                                                            <?php } } ?>
                                                            <canvas id="myChart"></canvas>
                                                        </div>
                                                        <?php }   ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div id="qa"  class="tab-pane " >
                                        <ul class="nav nav-tabs custom-quest-menu">
                                            <li class="active"><a data-toggle="tab" href="#our_quest"> हमारे प्रश्न  </a></li>
                                            <li><a data-toggle="tab" href="#your_quest"> आपके प्रश्न  </a></li>
                                        </ul>
                                        <div id="our_quest" class="tab active " >
                                            <section class="our_question">
                                                <div class="">
                                                    <div class="block-header">
                                                        हमारे प्रश्न 
                                                    </div>
                                                    <?php  $readonly ="";
                                                        $submit_hide= "block";
                                                    ?>
                                                    <div class="row clearfix">
                                                        <div class="header">
                                                            <form action="<?php echo site_url(); ?>User/save_our_ans" method="POST" >
                                                                <?php
                                                                    $i=1;
                                                                    if($get_ques['q_flag']==1)  {
                                                                    foreach($get_ques['questions'] as $index=> $value){   
                                                                    ?> 
                                                                <div class="col-md-6">
                                                                    <label for="poll_question"><?php echo $value['question']; ?> </label> 
                                                                    <br/>
                                                                    <?php   
                                                                        $result = $this->User_model->get_user_answers($value['question_id']);
                                                                        if($result['flag'] == 1 ) {
                                                                            $readonly ="readonly";
                                                                            $submit_hide =  "none";
                                                                        }
                                                                        //print_r($result);
                                                                            
                                                                    ?>
                                                                    <input type="text" class="form-control" name="answers[]" value="<?php echo ( isset( $result['user_answer'] ) )?  $result['user_answer']: ''  ?>" required <?echo $readonly; ?>>
                                                                    <input type="hidden" name="question_id[]" value="<? echo $value['question_id']; ?>" >
                                                                </div>
                                                                <?php } } ?>
                                                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid']; ?>" >
                                                                <div class="col-md-6">
                                                                    <br/>
                                                                    <button type="submit" class="btn btn-primary" style="display: <?php echo $submit_hide; ?>">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        <div id="your_quest" class="tab">
                                            <section class="your_question">
                                                <div class="">
                                                    <div class="block-header">
                                                        आपके प्रश्न 
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="header">
                                                            <form id="save_your_question" method="post" action="<?php echo site_url(); ?>User/check_our_ans "  >
                                                                <div class="col-md-6">
                                                                    <label for="poll_question">Your Question </label>
                                                                    <input type="text" class="form-control" id="user_question" name="user_question" value="">
                                                                    <input type="hidden" name="user_id" id="u_sess_id" value="<?php echo $_SESSION['userid']; ?>" >
                                                                    <input type="hidden" name="check_url" id="check_qa_url" value="<?php echo site_url(); ?>User/check_our_ans" >
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <br/>
                                                                    <button type="submit" id="check_our_ans" class="btn btn-success">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <div id="my_profile"  class="tab-pane " >
                                        <section class="">
                                            <div class="">
                                                <div class="block-header">
                                                    My Profile
                                                </div>
                                                <!-- Exportable Table -->
                                                <div class="row clearfix">
                                                    <div class="header">
                                                        <?php 
                                                          /*   echo "<pre>";
                                                            print_r($get_user_details['flag']);
                                                            echo "</pre>";*/
                                                            
                                                        ?>
                                                        <div class="container">
                                                            <div class="row">
                                                                <?php  
                                                                    if($get_user_details['flag'] == 1) {
                                                                    
                                                                ?>
                                                               <div class="col-sm-6 col-md-3">
                                                                    <div> Name  :   <?php  echo ucfirst($get_user_details['get_user_details'][0]['u_name']); ?></div> 
                                                                </div>
                                                               <div class="col-sm-6 col-md-3">
                                                                     <div>Date Of Birth : <?php  echo $get_user_details['get_user_details'][0]['u_dob']; ?> </div>
                                                                </div>
                                                               <div class="col-sm-6 col-md-3">
                                                                     <div> Birth Time :  <?php  echo $get_user_details['get_user_details'][0]['u_birth_time']; ?> </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-3">
                                                                     <div> Birth Place : <?php  echo $get_user_details['get_user_details'][0]['u_birth_place']; ?>   </div>
                                                                </div>                                                          
                                                            <?php } ?> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3" style="background:#FFF">
                        <h4>TV/Channel</h4>
                        <hr />
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/nFpO2TVHMd4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <br /><br />
                        <h4>Advertisement here</h4>
                        <hr />
                        <img src="https://berlinatv.com/wp-content/uploads/2019/05/new_banner_240x400.png" width="230px" />
                        <br /><br />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Chat with our Experts!
                                    <small>Consult with our experienced astrologers to know about your stars!</small>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="thumbnail">
                                            <img src="https://99pandits.in/sites/default/files/s4-pandit-ji.png">
                                            <div class="caption">
                                                <h3>Pt. Ramchandraji Ameta</h3>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                    text ever since the 1500s
                                                </p>
                                                <p>
                                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect" role="button">Call Now</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="thumbnail">
                                            <img src="https://99pandits.in/sites/default/files/s4-pandit-ji.png">
                                            <div class="caption">
                                                <h3>Pt. Ramchandraji Ameta</h3>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                    text ever since the 1500s
                                                </p>
                                                <p>
                                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect" role="button">Call Now</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="thumbnail">
                                            <img src="https://99pandits.in/sites/default/files/s4-pandit-ji.png">
                                            <div class="caption">
                                                <h3>Pt. Ramchandraji Ameta</h3>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                    text ever since the 1500s
                                                </p>
                                                <p>
                                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect" role="button">Call Now</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="thumbnail">
                                            <img src="https://99pandits.in/sites/default/files/s4-pandit-ji.png">
                                            <div class="caption">
                                                <h3>Pt. Ramchandraji Ameta</h3>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                    text ever since the 1500s
                                                </p>
                                                <p>
                                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect" role="button">Call Now</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
            </div>
        </section>
        <?php include_once('layouts/footerjs.php'); ?>
        <script>
           
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                        labels: ["Yes %" ,"No %"],
                        datasets: [{
                          backgroundColor: [ "#1B75CF" , "#FFB501" ],
                          data: [<?php echo $pole_percent['yes']; ?> , <?php  echo $pole_percent['no']; ?> ]
                        }]
                    }
            });
        </script>  