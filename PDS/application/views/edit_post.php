
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
			
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Post </h2>
                            <div class="msg"></div>
                            
                        </div>
                        <div class="body">
                             <?php $post_id =  urldecode($this->uri->segment(3)); ?>
                            <form id="add_post_form" method="POST" action="<?php echo base_url(); ?>Posts/edit_post/<? echo $post_id; ?>"  enctype="multipart/form-data">
                                <div class="row clearfix">
                                <div class="col-md-12">
                                    <? 
                                        // echo "<pre>";
                                        // print_r($get_post);
                                        // echo "</pre>";
                                        
                                    ?>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="post_type" name="post_type">
                                                <option <?php echo ($get_post['post'][0]['post_type'] == "Quote" )? "selected" :"" ?> >Quote</option>
                                                <option <?php echo ($get_post['post'][0]['post_type'] == "Article" )? "selected" :"" ?> >Article</option>
                                            </select>
                                            <label class="form-label">Post Type</label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea class="form-control" rows=6 name="post_content" id="post_content" multiple > <? echo $get_post['post'][0]['post_content']  ?></textarea>
                                            <label class="form-label">Post Content</label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="file" name="file" class="form-control" />
                                            <? 
                                                if($get_post['post'][0]['post_image'] != ''  ) { ?>
                                                <img src="<?php echo base_url(); ?><?php echo $get_post['post'][0]['post_image'];?>" width="80px" height="80px" />    
                                            <?
                                                }
                                                
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button class="btn btn-warning waves-effect add_post_submit" name="add_post_submit" type="submit">Update</button>
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
    </section>

 