
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
                              Articles
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
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>
