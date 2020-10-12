
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
			
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Post </h2>
                            <div class="msg"></div>
                            
                        </div>
                        <div class="body">
                            <form id="add_post_form" method="POST" action="<?php echo base_url(); ?>Posts/add_post"  enctype="multipart/form-data">
                                <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="post_type" name="post_type">
                                                <option>Quote</option>
                                                <option>Article</option>
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
                                            <textarea class="form-control" name="post_content" id="post_content" multiple ></textarea>
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
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button class="btn btn-warning waves-effect add_post_submit" name="add_post_submit" type="submit">ADD</button>
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

 