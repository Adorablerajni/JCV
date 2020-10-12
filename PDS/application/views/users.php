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
                               Users
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th> 
                                            <th>Mobile</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>DOB</th>
                                            <th>Birth Place</th>
                                            <th>Birth Time</th>
                                            <th>Source</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            <?php  /*echo "<pre>"; print_r($get_question);  echo "</pre>" */?>
                                    <?php
                                        $i=1;
                                        if($get_users['flag']==1)  {
                                        foreach($get_users['get_users'] as $value){
                                            
                                            
                                    ?>  
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $value['u_name'];?></td>
                                        <td><?php echo $value['u_email'];?></td>
                                       <td><?php echo $value['u_mobile'];?></td>
                                       <td><?php echo $value['u_city'];?></td>
                                       <td><?php echo $value['u_state'];?></td>
                                       <td><?php echo $value['u_dob'];?></td>
                                       <td><?php echo $value['u_birth_place'];?></td>
                                       <td><?php echo $value['u_birth_time'];?></td>
                                       <td><?php echo $value['u_device_type'];?></td>
                                       <td><?php echo $value['u_payment_status'];?></td>
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
