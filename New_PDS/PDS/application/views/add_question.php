
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
			
                <h2>
                  Add Question 
                </h2>
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Question </h2>
                            <div class="msg"></div>
                            
                        </div>
                        <div class="body">
                            <form id="add_question_form" method="POST" action="<?php echo base_url(); ?>add_question">
                                <div class="row clearfix">
                                <!-- <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="url_title" id="url_title">
											<label class="form-label">URL Title</label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="question" id="question">
                                            <label class="form-label">Question</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button class="btn btn-warning waves-effect add_question_submit" name="add_question_submit" type="submit">ADD</button>
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

 