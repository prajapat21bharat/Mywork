<?php $site = site_url() . 'admin/press/'; ?>
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
    function togglepress() {

        var contentId = document.getElementById("form-data");
        contentId.style.display == "block" ? contentId.style.display = "none" :
                contentId.style.display = "block";

        var content = document.getElementById("work-data");
        content.style.display == "none" ? content.style.display = "block" :
                content.style.display = "none";
    }

    function press_delete(id)
    {
        var r = confirm('Are Sure Delete This Press');
        if (r == true)
        {
            var form_data = {
                work_id: id
            };
            $.ajax({
                url: '<?php echo $site . 'delete'; ?>',
                data: form_data,
                datatype: 'json',
                success: function(data) {
                    $('#' + id).hide();
                    location.reload();
                    //  $('.msg').html('User Successfully Deleted !');

                }
            });
        }
    }
    function goBack() {
        window.location.href = '<?php echo $site ?>';
    }
    function works_delete(id) {
        var r = confirm('Are Sure Delete This Press');
        if (r == true)
        {
            var form_data = {work_id: id};
            $.ajax({
                url: '<?php echo $site . 'delete'; ?>',
                data: form_data,
                datatype: 'json',
                success: function(data) {
                    $('#' + id).hide();
                    location.reload();
                }
            });
        }

    }

    function img_delete(name) {
        var a = name.split(".");
        $("#userimg option[value='" + name + "']").remove();
        $("#" + a).remove();
        $("#" + parseInt(name)).remove();
        var form_data = {
            work_id: name
        };
        $.ajax({
            url: '<?php echo $site . 'img_delete'; ?>',
            data: form_data,
            datatype: 'json',
            success: function(data) {
                $('#' + id).hide();
                location.reload();
            }
        });
    }
</script>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
    <div class="hero-unit">   
        <h3 class="title">Press Information</h3>
        <?php //$this->load->view('admin/nav');?>	    

        <div class="success_msg"> 
            <?php
            if (!empty($success)) {
                echo $success;
            }
            ?>
            <?php echo $this->session->flashdata('work_msg'); ?>      
        </div>               

        <!---its is a Profile EDIT Div---> 
        <?php $form_error = validation_errors(); ?>
        <?php
        if (empty($press)) {
            $block = 'block';
            echo "<div class='menu_itemshow show-form'><a class='login-btn' href='javascript:void(0)'>Add Press</a></div>";
        } else {
            if (!$form_error)
                $block = 'none';
            else
                $block = 'block';
            echo "<div class='menu_itemshow show-form'><a class='login-btn' href='javascript:void(0)' onclick='togglepress()'>Add Press</a></div>";
        }
        ?>

        <div class="form-data" id="form-data" style="display:<?php echo $block; ?>;">	  
            <?php
            $edit = array('class' => 'edit_form white_bg');
            echo form_open_multipart(site_url() . 'admin/press/add/' . $this->uri->segment(4), $edit);
            ?> 

            <div class="wit">
                <label>Artists :</label>
                <select name="category_type[]" id="category_type" multiple>
                    <option value="">------ Select Artists Type ------</option>
                    <?php
                    foreach ($artist as $value) {
                        if ($value->ID == set_value('category_type[]')) {
                            ?>				
                            <option <?php echo set_select('category_type[]', $value->ID, TRUE); ?> value='<?php echo $value->ID ?>'><?php echo $value->first_name ?></option>
                        <?php } else { ?>
                            <option <?php echo set_select('category_type[]', $value->ID); ?> value='<?php echo $value->ID ?>'><?php echo $value->first_name ?></option>					
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php echo form_error('category_type[]'); ?>
            </div>
            <div class="wit">
                <label>Title :</label>
                <input type="text" name="title" id="title" value="<?php echo set_value('title'); ?>" />
                <?php echo form_error('title'); ?>			
            </div>
            <div class="wit">
                <label>Sub Title :</label>
                <input type="text" name="sub_title" id="prix" value="<?php echo set_value('sub_title'); ?>" />
                <?php echo form_error('sub_title'); ?>			
            </div>
            <div class="wit">
                <div>
                    <label>Date :</label>
                    <span class="datepair" data-language="javascript">
                        <input type="text" value="<?php echo set_value('start_date'); ?>" name="start_date" class="date start ">			
                        <?php echo form_error('start_date') . ' '; ?> 
                    </span>     
                </div>
            </div>
            <div class="wit">
                <label>Upload File :</label>
                <input type="button" value="uploadfile" id="mulitplefileuploader"/>
                <!--<input  value="<?php //echo set_value('userimg');    ?>"  class="userimg" name="userimg">-->
                <select class="hide" multiple name="userimg[]" id="userimg">
                    <?php
                    if ($imgs) {
                        foreach ($imgs as $img) {
                            ?>							
                            <option selected value='<?php echo $img; ?>' ><?php echo $img; ?></option>							
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if ($imgs) {
                    foreach ($imgs as $img1) {
                        ?>				
                        <div class="edit-img" id="<?php
                        $a = explode('.', $img1);
                        echo $a[0];
                        ?>">
                            <div class="pdf-image"><img height='80' width='80' src="<?php echo base_url() . "uploads/" . $img1; ?>" /></div>
                            <div class="b-delete"><a href="javascript:void(0)" onclick="img_delete('<?php echo $img1; ?>')">Delete</a></div>
                        </div>				
                        <?php
                    }
                }
                ?>	
                <p id="files">
                    <?php
                    if (set_value('userimg[]'))
                        echo "<img height='80' width='80' src='" . base_url() . "uploads/" . set_value('userimg[]') . "'/>";
                    ?>
                </p>
                <?php echo form_error('userimg[]'); ?>
            </div>     	 
            <div class="login_button">
                <input type="button" value="Cancel" class="login-btn" onclick="goBack()" />
                <input type="submit" value="Save" name=" " class="login-btn " />
            </div>
            <?php echo form_close(); ?>  
        </div>           
        <div class="work-data" id="work-data" <?php if ($form_error) echo 'style="display:none;"'; ?>>
            <?php foreach ($press as $val) { ?>
                <div class="content">
                    <div class="up-img">				 
                        <?php
                        if (!empty($val->image)) {
                            $imgarr = explode(',', $val->image);
                            foreach ($imgarr as $imgarr) {
                                ?>				 
                                <img src="<?php echo base_url() . "uploads/pdf/pdf.jpeg" ?>" width="100" height="60" alt=""/>
                                <?php
                            }
                        }
                        ?>
                    </div>				 
                    <div class="up-data">
                        <div class="artist-type">
                            <span>Artists :</span>
                            <span class="artist-contant">
                                <?php
                                $ids = explode(',', $val->user_id);
                                $feild = array("ID", "first_name");                                
                                foreach ($ids as $id) {   
                                    $where = array("ID" => $id);
                                    $user_name = array_shift($this->query_model->get_sql_select_data('user_profile', $where, $feild));
                                    echo $user_name->first_name, ' ,';
                                    }
                              ?>
                            </span>
                        </div>
                        <div class="artist-type"><span>Title :</span><span class="artist-contant"><?php echo $val->title ?></span></div>
                        <div class="artist-type"><span>Sub Title :</span><span class="artist-contant"><?php echo $val->sub_title ?></span></div>
                        <div class="artist-type"><span>Date :</span><span class="artist-contant"><?php echo $val->start_date ?></span></div>
                        <div class="edit-del">
                            <span><a href="<?php echo $site . 'edit/' . $val->id; ?>" >Edit |</a></span> 
                            <span><a href="javascript:void(0)" onclick="press_delete('<?php echo $val->id ?>')">Delete</a></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>           
    </div>      
</div>
<script>
    $(document).ready(function() {

        var settings = {
            url: "<?php echo site_url() ?>admin/press/upload_photo_vedio",
            method: "POST",
            allowedTypes: "pdf",
            fileName: "myfile",
            multiple: true,
            onSuccess: function(data, files, xhr) {
                var str = '"' + files + '"'
                $("#files").append("<div class='edit-img' id='" + parseInt(files) + "'><div class='pdf-image'><img height='80' width='80' src='<?php echo base_url() ?>uploads/pdf/pdf.jpeg'/></div><div class='b-delete'><a href='javascript:void(0)' onclick='img_delete(" + str + ")'>Delete</a></div></div>");
                //$("#userimg").(files); 
                $("#userimg").append("<option selected value='" + files + "' >" + files + "</option>");
            },
            onError: function(files, status, errMsg) {
                $("#status").append("<font color='red'>Upload is Failed</font>");
            }
        }
        $("#mulitplefileuploader").uploadFile(settings);

    });
</script>
