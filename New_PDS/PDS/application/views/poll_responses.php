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
                               Polls List
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Respondent Name</th>
                                            <th>Poll Question</th>
											<th>Option 1</th>
											<th>Option 2</th>
											<th>Option 3</th>
											<th>Option 4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            <?php  /*echo "<pre>"; print_r($get_question);  echo "</pre>" */?>
                                    <?php
                                        $i=1;
                                        if($get_poll_response['flag']==1)  {
                                        foreach($get_poll_response['get_poll_response'] as $value){
                                            
                                            
                                    ?>  
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td style="text-transform: capitalize;"><?php echo $value['u_name'];?></td>
                                        <td><?php echo $value['poll_question_id'];?></td>
                                       <td><?php echo $value['poll_option1'];?></td>
                                       <td><?php echo $value['poll_option2'];?></td>
                                       <td><?php echo $value['poll_option3'];?></td>
                                       <td><?php echo $value['poll_option4'];?></td>
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
