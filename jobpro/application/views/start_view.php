<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job</title>

<link rel="stylesheet" href="<?php echo base_url()?>ast/css/style.css" />
<script>
function search()
{
	var searcitem=document.getElementById("searchbar").value;
	if(searcitem=="")
	{
		document.getElementById("err_search").style.display = "block";
		document.getElementById("err_search").innerHTML = "Please Enter a Language";
		return false;
	}
}
</script>
</head>

<body>
<!--wrapper start-->
<div id="wrapper">
<!--header start-->
<div id="header">

<div class="inner-header">
<div class="logo"><img src="<?php echo base_url()?>ast/images/logo 7.png" alt="logo"></div>
<div class="search-section">
<div class="welcome">
  <h1>Welcome to Lorem Iplsum</h1>
  <p>Need A Helper For Your Job Carrer ?</p>
</div>
<div class="search">

<span id="err_search" "display:none;" class="error" ></span>
<form class="form-wrapper cf" method="post" action="<?php echo site_url()?>/start/search" onsubmit="return search()">
	<input type="text" id="searchbar" name="searchbar" placeholder="Search here..." >
	<button id="search" name="search" type="submit">Search</button>
<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
</form>

</div>
<div class="example">
<p>Example : Filed, Experience, Company, Location</p></div>
</div>

<div class="nav">
<div class="inner_nav">
<a href="#"><div class="job">Job Seekers</div></a>
<a href="<?php  echo site_url().'/mentors'?>"><div class="mentor">Mentor</div></a>
</div>
</div>

</div>

<!--header end-->
</div>

<!--contant start-->
<div id="contant">

<div class="inner_contant">

<!--accuont section-->

<div class="Create_Account_section">

<div class="Create_Account">


<a href="<?php  echo site_url().'/account'?>"><div class="Account_icon"></div></a>

<h3>Create Account</h3>

<p>
Fusce facilisis velit libero, nec 
dignissim lacus sagittis non. 
Sed nec porta ante. Pellentesque 
habitant morbi tristique senectus et.</p>

</div>

<div class="find_mentor">

<a href="<?php  echo site_url().'/mentors'?>"><div class="mentor_icon"></div></a>
<h3>Find Mentor</h3>

<p>
Fusce facilisis velit libero, nec 
dignissim lacus sagittis non. 
Sed nec porta ante. Pellentesque 
habitant morbi tristique senectus et.</p>

</div>

<div class="them">

<a href="<?php  echo site_url().'/team'?>"><div class="them_icon"></div></a>
<h3>Consult with Them</h3>

<p>
Fusce facilisis velit libero, nec 
dignissim lacus sagittis non. 
Sed nec porta ante. Pellentesque 
habitant morbi tristique senectus et.</p>

</div>

<div class="skills">

<a href="<?php  echo site_url().'/skill'?>"><div class="skill_icon"></div></a>
<h3>Get Your Skills Improved</h3>

<p>
Fusce facilisis velit libero, nec 
dignissim lacus sagittis non. 
Sed nec porta ante. Pellentesque 
habitant morbi tristique senectus et.</p>

</div>

</div>

<!--accuont section end-->

<!--video section-->

<div class="Video_section">

<div class="inner_video_section">

<div class="video_headeing"><h3>Video</h3></div>



<div class="video">
<video width="654" height="503" controls poster="images/video-img.png">
  <source src="movie.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">

</video></div>

<div class="how_it_works">
<h1>How It Works</h1>
<p>Aliquam metus neque, bibendum sit amet porta at, consequat et 
enim. In ut turpis non ipsum rhoncus porttitor vel ac nunc. 
Maecenas interdum dignissim lorem quis auctor. Donec sit amet 
nulla nisl, aliquam pretium ipsum. Pellentesque sodales ipsum et 
enim rutrum adipiscing. Quisque tincidunt mattis sapien, 
vel posuere.</p>

<div class="learn_more"><a href="#">Learn more</a></div>

</div>

</div>


</div>

<!--video section end-->
<div class="gray_blank">

<div class="mentor_by_category">

<div class="mentor_heading"><h1>Mentor by Ca<span>tegory</span></h1></div>

<div class="category_section">

<div class="category">

<div class="it_supprot">IT Support</div>

<div class="it">IT</div>

<div class="it">BFSI</div>

<div class="it">Chemical</div>

</div>

<div class="category_gallery">

<div class="it-category"><img src="<?php echo base_url()?>ast/images/it-1.png" alt="it"> <p>Neque Porro Quisquam<br>

<span>apps, icons, ui</span></p></div>

<div class="it-category"><img src="<?php echo base_url()?>ast/images/it-2.png" alt="it"> <p>Neque Porro Quisquam<br>

<span>apps, icons, ui</span></p></div>

<div class="it-category"><img src="<?php echo base_url()?>ast/images/it-3.png" alt="it"> <p>Neque Porro Quisquam<br>

<span>apps, icons, ui</span></p></div>

<div class="it-category"><img src="<?php echo base_url()?>ast/images/it-4.png" alt="it"> <p>Neque Porro Quisquam<br>

<span>apps, icons, ui</span></p></div>

<div class="it-category"><img src="<?php echo base_url()?>ast/images/it-5.png" alt="it"> <p>Neque Porro Quisquam<br>

<span>apps, icons, ui</span></p></div>

<div class="it-category"><img src="<?php echo base_url()?>ast/images/it-6.png" alt="it"> <p>Neque Porro Quisquam<br>

<span>apps, icons, ui</span></p></div>

<div class="watch_more_button">

<div class="watch_more"><a href="#">Watch more</a></div>
</div>
</div>

</div>

</div>
</div>

</div>

<!--contant end-->
</div>

<!--footer start-->
<div id="footer_node1">

<div class="inner_footer_node1">

<div class="home_section_footer">

Home	<br />
			     
Quem Somos		<br />
	    													
Conheca Jesus		<br />
	      												
Quem Somos		<br />
	    													
Conheca Jesus
	

</div>


<div class="home_section_footer">

			      
Assista ao Vivo<br />

 Series atual	<br />

 Outras series	<br />

 Series atual	<br />

Outras series
</div>

<div class="home_section_footer">

Home	<br />
			     
Quem Somos		<br />
	    													
Conheca Jesus		<br />
	      												
Quem Somos		<br />
	    													
Conheca Jesus
	

</div>


<div class="home_section_footer">

			      
Assista ao Vivo<br />

 Series atual	<br />

 Outras series	<br />

 Series atual	<br />

Outras series
</div>

<div class="home_section_footer">

Home	<br />
			     
Quem Somos		<br />
	    													
Conheca Jesus		<br />
	      												
Quem Somos		<br />
	    													
Conheca Jesus
	

</div>


<div class="home_section_footer">

			      
Assista ao Vivo<br />

 Series atual	<br />

 Outras series	<br />

 Series atual	<br />

Outras series
</div>

</div>
<div class="copy">Text messaging, or texting, is the act - 2017</div>
<!--footer end-->
</div>

<!--wrapper end-->
</div>
</body>
</html>
