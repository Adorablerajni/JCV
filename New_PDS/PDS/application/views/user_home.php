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
        <title>Polls | Jyotish Vidhya</title>
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
            .nav-left{
                float:none;
                line-height:40px;
                border-bottom:1px solid #FFF;
                width:100%;
                color:#FFF !important;
            }
        </style>
    </head>
    <body class="theme-cyan">
        <?php include_once('layouts/user_header.php'); ?>
        <div align="center" class="col-lg-12" style="background:#ffbe90;height:400px;display:none">
            <img src="" />
        </div>
        <section class="content2">
            <div class="row">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs custom-menu" style="">
                            <li class="nav-left active" style="float:none"><a data-toggle="tab" href="#articles"> <i class="material-icons">vpn_key</i> Articles </a></li>
                            <li class="nav-left"><a data-toggle="tab" href="#quotes"> Quotes </a></li>
                            <li class="nav-left"><a data-toggle="tab" href="#polls"> Polls</a></li>
                            <li class="nav-left"><a data-toggle="tab" href="#qa"> Question/Answer </a></li>
                            <li class="nav-left"><a data-toggle="tab" href="#my_profile"> My Profile </a></li>
                            <li class="nav-left">
                        <a href="<?php echo site_url()?>User/change_password"><i class="material-icons">vpn_key</i> Change Password</a>
                    </li>
                    <li class="nav-left">
                        <a href="https://jyotishvidhya.com/PDS/logout"><i class="material-icons">lock</i> Logout</a>
                    </li>
                        </ul>
                        
                    </div>
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
                                    <div id="articles"  class="tab-pane active">
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
                                                        <?php
                                                                        $i=1;
                                                                        if($get_article['flag']==1)  {
                                                                        foreach($get_article['articles'] as $value){   
                                                                        ?>
                                                        <div class="panel panel-default panel-post">
                                            <div class="panel-heading">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img src="https://jyotishvidhya.com/PDS/assets/images/user.png" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <a href="#">Pt. RC Ameta</a>
                                                        </h4>
                                                        Shared publicly - <?php echo date("d-m-Y H:i:s ", strtotime($value['creation_date'])) ;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="post">
                                                    <div class="post-heading">
                                                        <p><?php echo $value['post_content'];?></p>
                                                    </div>
                                                    <div class="post-content" align="center">
                                                        <img src="<?php echo $value['post_image'];?>" style="width:200px" class="img-responsive" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer" style="display:none">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">thumb_up</i>
                                                            <span>12 Likes</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">comment</i>
                                                            <span>5 Comments</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">share</i>
                                                            <span>Share</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Type a comment" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                                                        <?php } } ?>
                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div id="quotes"  class="tab-pane">
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
                                                        <?php
                                                                        $i=1;
                                                                        if($get_quote['flag']==1)  {
                                                                        foreach($get_quote['quotes'] as $value){   
                                                                        ?>  
                                                        <div class="panel panel-default panel-post">
                                            <div class="panel-heading">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img src="https://jyotishvidhya.com/PDS/assets/images/user.png" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <a href="#">Pt. RC Ameta</a>
                                                        </h4>
                                                        Shared publicly - <?php echo date("d-m-Y H:i:s ", strtotime($value['creation_date'])) ;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="post">
                                                    <div class="post-heading">
                                                        <p><?php echo $value['post_content'];?></p>
                                                    </div>
                                                    <div class="post-content" align="center">
                                                        <img src="<?php echo $value['post_image'];?>" style="width:200px" class="img-responsive" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer" style="display:none">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">thumb_up</i>
                                                            <span>12 Likes</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">comment</i>
                                                            <span>5 Comments</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="material-icons">share</i>
                                                            <span>Share</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Type a comment" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } ?> 
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div id="polls"  class="tab-pane " >
                                        <section class="">
                                            <div class="">
                                                <div class="">
                                                    <div class="row">
                                                        <div class="header">
                                                        <h2>
                                                            Polls
                                                        </h2>
                                                    </div>
                                                    <hr />
                                                        <?php $i= 1;
                                                            if(!$poles_response)  {
                                                            
                                                            ?>
                                                        <form action="<?php echo site_url(); ?>User/save_response" method="POST" >
                                                            <?php
                                                                $i=1;
                                                                if($get_poles['flag']==1)  {
                                                                foreach($get_poles['poles'] as $value){   
                                                                ?> 
                                                            <div class="col-md-12">
                                                                <h2><?php echo $value['poll_title'];?></h2><br />
                                                                <div style="margin-left:30px">
                                                                <div class="row">
                                                                <input class="form-check-label" type = "radio" name = "poll_option" id = "yes_id" value = "poll_option1" /><label for="yes_id"><?php echo $value['poll_option1']; ?> </label>
                                                                    </div><br />
                                                                    <div class="row">
                                                                <input class="form-check-label" type = "radio" name = "poll_option" id = "no_id" value = "poll_option2" /><label for="no_id"><?php echo $value['poll_option2']; ?></label>
                                                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid']; ?>" >
                                                                <input type="hidden" name="question_id" value="<?php echo $value['id']; ?>" >
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <?php } } ?>
                                                            
                                                            <div class="col-md-12">
                                                                <br />
                                                                <button type="submit" class="btn btn-primary xlarge" style="padding:20px 40px"> Submit Response </button>
                                                            </div>
                                                        </form>
                                                        <?php } else { ?>
                                                        <div class="">
                                                            
                                                            <?php
                                                                $i=1;
                                                                if($get_poles['flag']==1)  {
                                                                foreach($get_poles['poles'] as $value){   
                                                                ?> 
                                                            <center>
                                                                <h3><? echo $value['poll_title'];?></h3>
                                                            </center>
                                                            <?php } } ?>
                                                            <br />
                                                            <div class="row">
                                                            <div class="col-md-12">
                                                            <canvas id="myChart"></canvas>
                                                            </div>
                                                            </div>
                                                            <br />
                                                        </div>
                                                        <?php }   ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div id="qa"  class="tab-pane" >
                                        <h2>Q/A</h2>
                                        <ul class="nav nav-tabs custom-quest-menu">
                                            <li class="active"><a data-toggle="tab" href="#our_quest"> हमारे प्रश्न  </a></li>
                                            <li><a data-toggle="tab" href="#your_quest"> आपके प्रश्न  </a></li>
                                            <li><a data-toggle="tab" href="#your_ans">  आपके  पूछे गए प्रश्नो के उत्तर   </a></li>
                                        </ul>
                                        <div id="our_quest" class="tab active " >
                                            <section class="our_question">
                                                <div class="">
                                                    <div class="header">
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
                                                                    <br />
                                                                    <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="poll_question"><?php echo $value['question']; ?> </label> 
                                                                    <br/>
                                                                    <?   
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
                                                                </div><hr />
                                                                <?php } } ?>
                                                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid']; ?>" >
                                                                <div class="col-md-12">
                                                                    <br/><br/>
                                                                    <button type="submit" class="btn btn-primary" style="display: <?php echo $submit_hide; ?>;padding:20px 30px">Submit Response</button>
                                                                </div>
                                                                
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section><br /><br />
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
                                        <div id="your_ans" class="tab">
                                            <section class="your_answer">
                                                <div class="">
                                                    <div class="block-header">
                                                       आपके  पूछे गए प्रश्नो के उत्तर 
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="header">
                                                            <?php 
                                                                    // echo "<pre>";
                                                                    // print_r($get_qa['flag'] == 1);
                                                                    // echo "</pre>";
                                                                    $i =1 ;
                                                                    if($get_qa['flag'] == 1) {
                                                                        foreach($get_qa['ques_with_ans'] as $index=>$value) {
                                                                            
                                                                    
                                                                ?>
                                                            <div class="col-md-6">
                                                                <label for="user_question_ans"> Question: <?php echo $value['user_ques']; ?> </label><br/>
                                                                <strong>Answer :</strong>
                                                                <input type="text" class="form-control" id="user_question_ans <?php echo $value['userque_id']; ?> " name="user_question_ans" value="<?php echo $value['answer_desc']; ?>" readonly>
                                                                
                                                            </div>
                                                               
                                                            <?php         
                                                                        }
                                                                    }
                                                                ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <div id="my_profile"  class="tab-pane" >
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
                                                            <? } ?> 
                                                            </div>
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
                    <div class="col-lg-3" style="background:#FFF;display:none">
                        <h2>TV/Channel</h2>
                        <hr />
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/nFpO2TVHMd4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <br /><br />
                        <h4>Advertisement here</h4>
                        <hr />
                        <img src="https://berlinatv.com/wp-content/uploads/2019/05/new_banner_240x400.png" width="230px" />
                        <br /><br />
                    </div>
                    </div>
                <!-- #END# Line Chart -->
            </div>
        </section>
                    
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
        <?php include_once('layouts/footerjs.php'); ?>
        <script>
                Chart.pluginService.register({
                  beforeDraw: function(chart) {
                    if (chart.config.options.elements.center) {
                      // Get ctx from string
                      var ctx = chart.chart.ctx;
            
                      // Get options from the center object in options
                      var centerConfig = chart.config.options.elements.center;
                      var fontStyle = centerConfig.fontStyle || 'Arial';
                      var txt = centerConfig.text;
                      var color = centerConfig.color || '#000';
                      var maxFontSize = centerConfig.maxFontSize || 75;
                      var sidePadding = centerConfig.sidePadding || 20;
                      var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
                      // Start with a base font of 30px
                      ctx.font = "30px " + fontStyle;
            
                      // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                      var stringWidth = ctx.measureText(txt).width;
                      var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;
            
                      // Find out how much the font can grow in width.
                      var widthRatio = elementWidth / stringWidth;
                      var newFontSize = Math.floor(30 * widthRatio);
                      var elementHeight = (chart.innerRadius * 2);
            
                      // Pick a new font size so it will not be larger than the height of label.
                      var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
                      var minFontSize = centerConfig.minFontSize;
                      var lineHeight = centerConfig.lineHeight || 25;
                      var wrapText = false;
            
                      if (minFontSize === undefined) {
                        minFontSize = 20;
                      }
            
                      if (minFontSize && fontSizeToUse < minFontSize) {
                        fontSizeToUse = minFontSize;
                        wrapText = true;
                      }
            
                      // Set font settings to draw it correctly.
                      ctx.textAlign = 'center';
                      ctx.textBaseline = 'middle';
                      var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                      var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                      ctx.font = fontSizeToUse + "px " + fontStyle;
                      ctx.fillStyle = color;
            
                      if (!wrapText) {
                        ctx.fillText(txt, centerX, centerY);
                        return;
                      }
            
                      var words = txt.split(' ');
                      var line = '';
                      var lines = [];
            
                      // Break words up into multiple lines if necessary
                      for (var n = 0; n < words.length; n++) {
                        var testLine = line + words[n] + ' ';
                        var metrics = ctx.measureText(testLine);
                        var testWidth = metrics.width;
                        if (testWidth > elementWidth && n > 0) {
                          lines.push(line);
                          line = words[n] + ' ';
                        } else {
                          line = testLine;
                        }
                      }
            
                      // Move the center up depending on line height and number of lines
                      centerY -= (lines.length / 2) * lineHeight;
            
                      for (var n = 0; n < lines.length; n++) {
                        ctx.fillText(lines[n], centerX, centerY);
                        centerY += lineHeight;
                      }
                      //Draw text in center
                      ctx.fillText(line, centerX, centerY);
                    }
                  }
                });


                var config = {
                      type: 'doughnut',
                      data: {
                        labels: [
                          "Yes %",
                          "No %"
                        ],
                        datasets: [{
                          data: [<?php echo $pole_percent['yes']; ?> ,<?php  echo  $pole_percent['no']; ?>],
                          backgroundColor: [
                            "#1E90FF",
                            "#ffd547",
                           
                          ],
                          hoverBackgroundColor: [
                            "#1E90FF",
                            "#ffd547",
                           
                          ]
                        }]
                      },
                      options: {
                        elements: {
                          center: {
                            text: 'ASTRO- METER',
                            color: '', // Default is #000000
                            fontStyle: 'Arial', // Default is Arial
                            sidePadding: 20, // Default is 20 (as a percentage)
                            minFontSize: 25, // Default is 20 (in px), set to false and text will not wrap.
                            lineHeight: 25 // Default is 25 (in px), used for when text wraps
                          }
                        }
                      }
                    };

                var ctx = document.getElementById("myChart").getContext("2d");
                var myChart = new Chart(ctx, config);
            //     var ctx = document.getElementById("myChart").getContext('2d');
            //     var myChart = new Chart(ctx, {
            //       type: 'pie',
            //       data: {
            //         labels: ["Yes %" ,"No %"],
            //         datasets: [{
            //           backgroundColor: [ "#1E90FF" , "#ffd547" ],
            //           data: [<?php echo $pole_percent['yes']; ?> ,<?php  echo  $pole_percent['no']; ?> ]
            //         }]
            //     },
                 
            // });
        </script>