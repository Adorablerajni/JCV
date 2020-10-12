<?php include('after_login_header.php') ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
			
                <h2>
                    
                </h2>
				
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               User's Queries
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>User</th>                                            
											<th>Query</th>
											<th>Birth Date</th>
											<th>Birth Place</th>
											<th>Birth Time</th>
											<th>Reply</th>
											<th>Datetime</th>
										
                                        </tr>
                                    </thead>
                                    <tbody>
            <?php  /*echo "<pre>"; print_r($get_question);  echo "</pre>" */?>
                                    <?php
                                        $i=1;
                                        if($get_queries['flag']==1)  {
                                        foreach($get_queries['get_queries'] as $value){   
                                    ?>  
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td style="text-transform: capitalize;"><?php echo $value['u_name'];?></td>
                                        <td><?php echo $value['user_ques'];?></td>
                                        <td><?php echo $value['u_dob'];?></td>
                                        <td><?php echo $value['u_birth_place'];?></td>
                                        <td><?php echo $value['u_birth_time'];?></td>
                                        <td><?php 
                                        if($value['answer_desc']!=''){
                                        echo $value['answer_desc'];
                                        echo "<br />";
                                        ?>
                                        <a data-toggle='modal' data-target='#defaultModal<?php echo $i; ?>'>Edit</a>
                                        
                                        <?php
                                        } else {
                                        ?>
                                        <button type="button" class="m-r-20" data-toggle="modal" data-target="#defaultModal<?php echo $i; ?>">Reply</button>
                                        <?php } ?>
                                        <!-- Default Size -->
            <div class="modal fade" id="defaultModal<?php echo $i; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"><?php echo $value['u_name'];?></h4>
                        </div>
                        <div class="modal-body">
                            <p><b class="text-primary"><?php echo $value['user_ques'];?></b></p>
                            <p><b>Date of Birth</b>: <?php echo $value['u_dob'];?></p>
                            <p><b>Birth Place</b>: <?php echo $value['u_birth_place'];?></p>
                            <p><b>Birth Time</b>: <?php echo $value['u_birth_time'];?></p>
                            <input type="hidden" id="userque<?php echo $i;?>" name="userque<?php echo $i;?>" value="<?php echo $value['userque_id'];?>" />
                            <textarea id="reply<?php echo $i; ?>" name="reply<?php echo $i; ?>" rows="6" class="form-control" style="width:100%"><?php echo $value['answer_desc'];?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submit_ajax<?php echo $i; ?>" class="btn bg-green waves-effect">SAVE</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
            <script type="text/javascript"> 
            $(document).ready(function() {
                $("#submit_ajax<?php echo $i; ?>").click(function() {
            			 var userque=$("#userque<?php echo $i;?>").val(); //r_issue_id
                         var reply=$("#reply<?php echo $i; ?>").val();
            			 //alert(userque);
            			 //alert(reply);
            			 //$("#msg_wait<?php //echo $val['issue_id']; ?>").show();
                  $.ajax({
                    type: "POST",
                    url: "<?php echo site_url();?>Query/query_response",
                    data: {"userque":userque,"reply":reply},
            		dataType:"text",  
                                 success:function(data)  
                                 {  
            					    
            						 //$("#display_msg<?php //echo $val['issue_id']; ?>").hide(); //r_issue_id
            						 //$("#msg_dsply<?php //echo $val['issue_id']; ?>").show();
            						 
            						 if(data === 'Success')  
                                     {  
                                         window.location.replace("https://jyotishvidhya.com/PDS/Query");
            							
                                    }  
            					 }
                  });
                });
              });	
            		
            
            </script>
            
                                        </td>
                                        <td><?php echo $value['creation_date'];?></td>
                                        
                                         </tr>
                        
                                   	<?php } } ?>    	
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>
<?php include('after_login_footer.php') ?>
