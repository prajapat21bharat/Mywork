<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site = site_url() . 'admin/home/hometext/'; ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>
<!--------------Date and Time ---------------->
<link href="<?php echo base_url('assets/'); ?>/css/jquery.timepicker.css" rel="stylesheet" />
<link href="<?php echo base_url('assets/'); ?>/css/base.css" rel="stylesheet"/>
<!--------------END Date and Time ---------------->
<script type="text/javascript" src="<?php echo base_url('assets/js/toltip.js') ?>"></script>
<!--------------Date and Time ---------------->
<script src="<?php echo base_url('assets/js/date_time.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.timepicker.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/base.js') ?>"></script>
<!--------------END Date and Time ---------------->
<script type="text/javascript">
    $(function() {
        $('#popupDatepicker').datepick();
        
        
    });
    function goBack() {
        window.location.href = '<?php echo $site ?>';
    }
    
    
</script>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
    <div class="hero-unit">  
        

        <?php
        
        echo $msg;
        $edit = array('class' => 'edit_form white_bg');
        echo form_open_multipart('', $edit);
        ?> 

        <h3 class="title">Top Home Text</h3>      
        <div class="form-data">          


            <div class="wit">
                <label>Heading</label>
                <input type="text" name="c_exhibition"  value="<?php echo $hometext->c_exhibition; ?>" />
                <?php echo form_error('c_exhibition'); ?>			
            </div>

            <div class="wit">
                <label>Title</label>
                <input type="text" name="c_title"  value="<?php echo $hometext->c_title; ?>" />
                <?php echo form_error('c_title'); ?>			
            </div>
           
            <div class="wit">
                <div>
                    <?php   
                  $data=explode('>', $hometext->c_date)  ;  
                  ?>
                    <label>Date :</label>
                    <span class="ndatepair" data-language="javascript">
                        <input type="text" value="<?php echo $data[0]; ?>" name="c_start_date" class="date start ">			
                        to
                        <input type="text" name="c_end_date" value="<?php echo $data[1] ?>" class="date end ">
                        <?php echo form_error('c_start_date') . ' '; ?> <?php echo ' ' . form_error('c_end_date'); ?>
                    </span>     
                </div>
            </div>   


        </div>
        <h3 class="title">Bottom Home Text</h3>
        <div class="form-data">          


            <div class="wit">
                <label>Heading</label>
                <input type="text" name="u_exhibition"  value="<?php echo $hometext->u_exhibition; ?>" />
                <?php echo form_error('u_exhibition'); ?>			
            </div>

            <div class="wit">
                <label>Title</label>
                <input type="text" name="u_title"  value="<?php echo htmlentities($hometext->u_title); ?>" />
                <?php echo form_error('u_title'); ?>			
            </div>
            
            <div class="wit">
                <div>
                    <?php   
                  $data=explode('>', $hometext->u_date)  ;  
                  ?>
                    <label>Date :</label>
                    <span class="ndatepair" data-language="javascript">
                        <input type="text" value="<?php echo $data[0]; ?>" name="u_start_date" class="date start ">			
                        to
                        <input type="text" name="u_end_date" value="<?php echo $data[1] ?>" class="date end ">
                        <?php echo form_error('u_start_date') . ' '; ?> <?php echo ' ' . form_error('u_end_date'); ?>
                    </span>     
                </div>
            </div>  

            <div class="login_button">
                <input type="button" value="Cancel" class="login-btn" onclick="goBack()" />
                <input type="submit" value="Save" name=" " class="login-btn " />
            </div>
            <?php echo form_close(); ?>          
        </div>
    </div>      
</div>



