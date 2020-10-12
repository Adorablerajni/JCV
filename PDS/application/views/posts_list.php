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
                               Posts List
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
								<a href="<?php echo base_url(); ?>/Posts/add_post">
                                    <button type="button" class="btn bg-deep-orange waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">add</i>
                                    <span>Add Post</span>
                                </button>
								</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Post Type</th>                                            
											<th>Post Content</th>
											<th>Post Date</th>
											<th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
            <?php  /*echo "<pre>"; print_r($get_question);  echo "</pre>" */?>
                                    <?php
                                        $i=1;
                                        if($get_post['flag']==1)  {
                                        foreach($get_post['get_post'] as $value){
                                            
                                            
                                    ?>  
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><a href="<?php echo base_url(); ?><?php echo $value['post_image'];?>" target="_new"><img src="<?php echo base_url(); ?><?php echo $value['post_image'];?>" width="80px" height="80px" /></a></td>
                                        <td><?php echo $value['post_type'];?></td>
                                       <td><?php echo $value['post_content'];?></td>
                                       <td><?php echo $value['updation_date'];?></td>
                                        <td><a href="<?php echo site_url(); ?>Posts/edit_post/<?php echo $value['id'];?>" >Edit</a></td>
                                        <td><a href="<?php echo site_url(); ?>Posts/delete_post/<?php echo $value['id'];?>" onclick="return confirm('Are you sure want to delete');">Delete</a></td>
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
