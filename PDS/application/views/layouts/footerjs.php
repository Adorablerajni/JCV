<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<!-- Jquery Core Js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/node-waves/waves.js"></script>



<!-- Validation Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.js"></script>


<!-- Custom Js -->
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custome.js"></script>
<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e)
    {
        $('.page-content div.tab-pane').hide();
        $('#qa div.tab').hide();
        showActiveContent();
        showActiveQA();
        $('.custom-menu li a').click(function()
        {
            $('.custom-menu li').removeClass('active');
            $(this).addClass('active');
            
            let selector = $(this).attr('href');
            $('.page-content .tab-pane').hide();
            $('.page-content '+selector).show();
        });   
        $('.custom-quest-menu li a').click(function()
        {
            $('.custom-quest-menu li').removeClass('active');
            $(this).addClass('active');
            
            let selector = $(this).attr('href');
            $('#qa .tab').hide();
            $('#qa '+selector).show();
        }); 
        
    });
    function showActiveContent()
    {
        $('.page-content div.active').show();
    }
    function showActiveQA()
    {       
        //console.log( $('#qa div.active'));
        $('#qa div.active').show();
    }
    
    
    
</script>

