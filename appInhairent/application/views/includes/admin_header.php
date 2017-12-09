<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Inhairent</title>
      <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.jpeg" type="image/jpeg" />
      
      <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/popup1.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/uncommon.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/admin-responsive.css" rel="stylesheet" type="text/css" />
      <script src="<?php echo base_url();?>assets/js/jquery-2.1.0.js"></script>
      <link href="<?php echo base_url();?>assets/css/jquery-customselect.css" rel="stylesheet" type="text/css" />
   </head>
   <body class="light_theme  fixed_header left_nav_fixed">
      <div class="wrapper">
      <!--\\\\\\\ wrapper Start \\\\\\-->
      <div class="header_bar">
         <!--\\\\\\\ header Start \\\\\\-->
         <div class="brand">
            <!--\\\\\\\ brand Start \\\\\\-->
            <div class="logo" style="display:block"><img src="<?php echo base_url();?>assets/images/logo.jpg" /></div>
            <?php /*?>
            <div class="small_logo" style="display:none"><img src="images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
            <?php */?>
         </div>
         <!--\\\\\\\ brand end \\\\\\-->
      <div class="header_top_bar">
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a class="menutoggle" href="javascript:void(0);"> <i class="fa fa-bars"></i> </a>
      <div class="top_left">
        <div class="top_left_menu">
          <ul>
            <li> <a href="#"><i class="fa fa-facebook"></i></a> </li>
            <li> <a href="#"><i class="fa fa-twitter"></i></a> </li>
             <li> <a href="#"><i class="fa fa-google-plus"></i></a> </li>
               <li> <a href="#"><i class="fa fa-linkedin"></i></a> </li>
           
          </ul>
        </div>
      </div>
    
      <div class="top_right_bar">
        <div class="top_right">
          <div class="top_right_menu">
           
          </div>
        </div>
        <div class="user_admin dropdown">
			<a data-toggle="dropdown" href="javascript:void(0);">
				<?php
					$getavtar=$this->user_model->get_sql_select_data('tbl_user', array('id'=>$this->session->userdata('id')));
				?>
				<img src="<?php echo base_url('/assets/avtars/thumbnail/113x113/'.$getavtar[0]['image']); ?>" class="user-image  img-responsive" id="user_img_avtar"/>
				<span class="user_adminname"><?php echo $getavtar[0]['firstname']." ".$getavtar[0]['lastname']; ?></span> <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <div class="top_pointer"></div>
            <li> <a href="<?php echo site_url('admin/profile');?>"><i class="fa fa-user"></i> Profile info </a></li>
            <li> <a href="<?php echo site_url('admin/avtar');?>"><i class="fa  fa-picture-o"></i> Profile Pic </a></li>
            <li> <a href="<?php echo site_url('changepassword/');?>"><i class="fa fa-cog"></i> Setting </a></li>
            <li> <a href="<?php echo site_url('account/logout');?>"><i class="fa fa-power-off"></i> Logout</a> </li>
          </ul>
        </div>
      </div>
    </div>
         <!--\\\\\\\ header top bar end \\\\\\-->
      </div>
      <!--\\\\\\\ header end \\\\\\-->
      <div class="inner">
      <!--\\\\\\\ inner start \\\\\\-->
      <div class="left_nav">
         <!--\\\\\\\left_nav start \\\\\\-->
         <div class="left_nav_slidebar">
			
			<?php
				$segment=$this->uri->segment(2);
				//echo $segment;
				if(($segment=="viewstylist")||($segment=="editstylist")||($segment=="addsubscription")||($segment=="editsubscription")||($segment=="viewsubscription")||($segment=="addstylist")||($segment=="featuredimage")||($segment=="publicimages")||($segment=="clients"))
				{
					$class="opened";
					$style="style='display:block'";
				}
				else
				{
					$class="";
					$style="style='display:none'";
				}
				
				if(($segment=="viewproduct")||($segment=="addproduct")||($segment=="editproduct"))
				{
					$viewproduct="opened";
					$viewproduct_style="style='display:block'";
				}
				else
				{
					$viewproduct="";
					$viewproduct_style="style='display:none'";
				}
				
				if(($segment=="viewbrand")||($segment=="addbrand")||($segment=="editbrand"))
				{
					$brand="opened";
					$brand_style="style='display:block'";
				}
				else
				{
					$brand="";
					$brand_style="style='display:none'";
				}
				
				if(($segment=="viewcategory")||($segment=="addcategory")||($segment=="editcategory"))
				{
					$Category="opened";
					$Category_style="style='display:block'";
				}
				else
				{
					$Category="";
					$Category_style="style='display:none'";
				}
				
				if(($segment=="viewtag")||($segment=="addtag")||($segment=="edittag"))
				{
					$Tags="opened";
					$Tags_style="style='display:block'";
				}
				else
				{
					$Tags="";
					$Tags_style="style='display:none'";
				}
				
				if(($segment=="viewethnicity")||($segment=="add_ethnicity")||($segment=="editethnicity"))
				{
					$Ethnicity="opened";
					$Ethnicity_style="style='display:block'";
				}
				else
				{
					$Ethnicity="";
					$Ethnicity_style="style='display:none'";
				}
				
				if(($segment=="viewtexture")||($segment=="addtexture")||($segment=="edittexture"))
				{
					$Texture="opened";
					$Texture_style="style='display:block'";
				}
				else
				{
					$Texture="";
					$Texture_style="style='display:none'";
				}
				
				if(($segment=="viewdensity")||($segment=="adddensity")||($segment=="editdensity"))
				{
					$Density="opened";
					$Density_style="style='display:block'";
				}
				else
				{
					$Density="";
					$Density_style="style='display:none'";
				}
				
				if(($segment=="viewcolor")||($segment=="addcolor")||($segment=="editcolor"))
				{
					$Color="opened";
					$Color_style="style='display:block'";
				}
				else
				{
					$Color="";
					$Color_style="style='display:none'";
				}
				
				if(($segment=="viewtemplate")||($segment=="add_template")||($segment=="edittemplate"))
				{
					$Email="opened";
					$Email_style="style='display:block'";
				}
				else
				{
					$Email="";
					$Email_style="style='display:none'";
				}
				if(($segment=="resources")||($segment=="add_resource")||($segment=="editresource"))
				{
					$Resources="opened";
					$Resources_style="style='display:block'";
				}
				else
				{
					$Resources="";
					$Resources_style="style='display:none'";
				}
				
				
				
				
				if(($segment=="viewtemplate")||($segment=="edittemplate"))
				{
					$a_view_temp="theme_color";
				}
				else
				{
					$a_view_temp="";
				}
				
				if($segment=="add_template")
				{
					$a_add_temp="theme_color";
				}
				else
				{
					$a_add_temp="";
				}
			
				if(($segment=="resources")||($segment=="editresource"))
				{
					$a_view_resource="theme_color";
				}
				else
				{
					$a_view_resource="";
				}
				
				if($segment=="add_resource")
				{
					$a_add_resource="theme_color";
				}
				else
				{
					$a_add_resource="";
				}

				if(($segment=="viewcolor")||($segment=="editcolor"))
				{
					$a_view_color="theme_color";
				}
				else
				{
					$a_view_color="";
				}
				
				if($segment=="addcolor")
				{
					$a_add_color="theme_color";
				}
				else
				{
					$a_add_color="";
				}
				
				if(($segment=="viewdensity")||($segment=="editdensity"))
				{
					$a_view_density="theme_color";
				}
				else
				{
					$a_view_density="";
				}
				
				if($segment=="adddensity")
				{
					$a_add_density="theme_color";
				}
				else
				{
					$a_add_density="";
				}
				
				if(($segment=="viewtexture")||($segment=="edittexture"))
				{
					$a_view_texture="theme_color";
				}
				else
				{
					$a_view_texture="";
				}
				
				if($segment=="addtexture")
				{
					$a_add_texture="theme_color";
				}
				else
				{
					$a_add_texture="";
				}
				
				if(($segment=="viewethnicity")||($segment=="editethnicity"))
				{
					$a_view_ethnicity="theme_color";
				}
				else
				{
					$a_view_ethnicity="";
				}
				
				if($segment=="add_ethnicity")
				{
					$a_add_ethnicity="theme_color";
				}
				else
				{
					$a_add_ethnicity="";
				}
				
				if(($segment=="viewtag")||($segment=="edittag"))
				{
					$a_view_tag="theme_color";
				}
				else
				{
					$a_view_tag="";
				}

				if($segment=="addtag")
				{
					$a_add_tag="theme_color";
				}
				else
				{
					$a_add_tag="";
				}
				
				if(($segment=="viewcategory")||($segment=="editcategory"))
				{
					$a_view_category="theme_color";
				}
				else
				{
					$a_view_category="";
				}

				if($segment=="addcategory")
				{
					$a_add_category="theme_color";
				}
				else
				{
					$a_add_category="";
				}
				
				if(($segment=="viewbrand")||($segment=="editbrand"))
				{
					$a_view_brand="theme_color";
				}
				else
				{
					$a_view_brand="";
				}

				if($segment=="addbrand")
				{
					$a_add_brand="theme_color";
				}
				else
				{
					$a_add_brand="";
				}
				
				
				if(($segment=="viewproduct")||($segment=="editproduct"))
				{
					$a_view_product="theme_color";
				}
				else
				{
					$a_view_product="";
				}
				
				if($segment=="addproduct")
				{
					$a_add_product="theme_color";
				}
				else
				{
					$a_add_product="";
				}
				if(($segment=="viewstylist")||($segment=="editstylist")||($segment=="featuredimage")||($segment=="publicimages")||($segment=="clients"))
				{
					$a_view_stylist="theme_color";
				}
				else
				{
					$a_view_stylist="";
				}
				
				if(($segment=="addsubscription")||($segment=="editsubscription"))
				{
					$ad_bil_info="theme_color";
				}
				else
				{
					$ad_bil_info="";
				}
				
				if($segment=="addstylist")
				{
					$ad_stylist="theme_color";
				}
				else
				{
					$ad_stylist="";
				}
				if($segment=="viewsubscription")
				{
					$a_view_bill="theme_color";
				}
				else
				{
					$a_view_bill="";
				}
			?>
			
            <ul>
				<li><a href="javascript:void(0);"><i class="fa fa-home"></i> Stylists <span class="left_nav_pointer"></span> <span class="plus"><i class="fa fa-plus"></i></span> </a>
					<ul class="<?php print $class; ?>" <?php print $style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewstylist');?>"><span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_stylist?>"></i> <b class="<?php print $a_view_stylist?>">All Stylists</b></a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/addstylist');?>"><span>&nbsp;</span> <i class="fa fa-plus-circle <?php print $ad_stylist?>"></i> <b class="<?php print $ad_stylist?>">Add Stylist</b></a>
						</li>
					<?php /* ?>	
						<li>
							<a href="<?php echo site_url('admin/viewsubscription');?>"><span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_bill?>"></i> <b class="<?php print $a_view_bill?>">View Subscription</b></a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/addsubscription');?>"><span>&nbsp;</span> <i class="fa fa-plus-circle <?php print $ad_bil_info?>"></i> <b class="<?php print $ad_bil_info?>">Add Subscription</b></a>
						</li>
					<?php */ ?>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Products <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $viewproduct; ?>" <?php print $viewproduct_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewproduct');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_product;?>"></i> <b class="<?php print $a_view_product;?>">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/addproduct');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_product;?>"></i> <b class="<?php print $a_add_product;?>">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Brands <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $brand; ?>" <?php print $brand_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewbrand');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_brand;?>"></i> <b class="<?php print $a_view_brand;?>">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/addbrand');?>"> <span>&nbsp;</span> <i class="fa fa-plus-circle <?php print $a_add_brand;?>"></i> <b class="<?php print $a_add_brand;?>">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Product Categories <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $Category; ?>" <?php print $Category_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewcategory');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_category;?>"></i> <b class="<?php print $a_view_category;?>">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/addcategory');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_category;?>"></i> <b class="<?php print $a_add_category;?>">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Product Tags <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $Tags; ?>" <?php print $Tags_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewtag');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_tag;?>"></i> <b class="<?php print $a_view_tag;?>">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/addtag');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_tag;?>"></i> <b class="<?php print $a_add_tag;?>">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Ethnicities <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $Ethnicity; ?>" <?php print $Ethnicity_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewethnicity');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_ethnicity;?>"></i> <b class="<?php print $a_view_ethnicity;?>">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/add_ethnicity');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_ethnicity;?>"></i> <b class="<?php print $a_add_ethnicity;?>">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Textures <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $Texture; ?>" <?php print $Texture_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewtexture');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_texture;?>"></i> <b class="<?php print $a_view_texture;?> ">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/addtexture');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_texture;?>"></i> <b class="<?php print $a_add_texture;?> ">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Densities <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $Density; ?>" <?php print $Density_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewdensity');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_density;?>"></i> <b class="<?php print $a_view_density;?> ">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/adddensity');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_density;?>"></i> <b class="<?php print $a_add_density;?> ">Add New</b> </a>
						</li>
					</ul>
				</li>

				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Hair Colors <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $Color; ?>" <?php print $Color_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewcolor');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_color;?> "></i> <b class="<?php print $a_view_color;?> ">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/addcolor');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_color;?>"></i> <b class=" <?php print $a_add_color;?>">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Email Templates <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $Email; ?>" <?php print $Email_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/viewtemplate');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_temp;?>"></i> <b class=" <?php print $a_view_temp;?> ">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/add_template/');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_temp;?>"></i> <b class=" <?php print $a_add_temp;?>">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Resources <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul class="<?php print $Resources; ?>" <?php print $Resources_style; ?>>
						<li>
							<a href="<?php echo site_url('admin/resources');?>"> <span>&nbsp;</span> <i class="fa fa-eye <?php print $a_view_resource;?>"></i> <b class=" <?php print $a_view_resource;?> ">View</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('admin/add_resource/');?>"> <span>&nbsp;</span><i class="fa fa-plus-circle <?php print $a_add_resource;?>"></i> <b class=" <?php print $a_add_resource;?>">Add New</b> </a>
						</li>
					</ul>
				</li>
				
				<li class="change-me">
					<a href="<?php echo site_url('admin/changepassword/');?>"><i class="fa fa-key"></i> Change Password</a>
				</li>
            </ul>
         </div>
      </div>
      <!--\\\\\\\left_nav end \\\\\\-->

