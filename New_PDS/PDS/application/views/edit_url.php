
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
			
                <h2>
                   YouTube Link
                </h2>
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add YouTube Link</h2>
                            <div class="msg"></div>
                            
                        </div>
                        <?php $link_id =  urldecode($this->uri->segment(2)); ?>
                        <div class="body">
                            <form id="add_url_form" method="POST" action="<?php echo base_url(); ?>edit_url/<?php echo $link_id ?>">
                                <div class="row clearfix">
                                <div class="col-md-6">
                                    
                                    <?php if ($get_url['flag'] == 1) { ?>
                                        
                                    
                                    
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="url_title" id="url_title" value="<?php echo  $get_url['youtube_link'][0]['video_title']; ?>">
											<label class="form-label">URL Title</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="url_link" id="url_link" value="<?php echo $get_url['youtube_link'][0]['youtube_link']; ?>">
                                            <label class="form-label">URL Link</label>
                                        </div>
                                    </div>
                                </div>
                            <?php }  ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button class="btn btn-warning waves-effect add_url_submit" name="add_url_submit" type="submit">Update</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                               
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            </div>
        </div>
    </section>

 