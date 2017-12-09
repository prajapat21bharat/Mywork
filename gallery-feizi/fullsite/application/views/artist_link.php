<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$site=site_url().'artist/';	
	$name = $this->uri->segment(2);
         /****Create slugfrom Id and name******/
                   $zname_clean = strtolower($artist_data[0]->first_name);
                   $slugName = str_replace(' ','-',$zname_clean);

?>

<div class="red-bg"><a href="<?php echo $site.'works/'.$slugName; ?>" alt="" ><?php echo $artist_data[0]->first_name; ?> <label class="ini-class"><?php echo @$artist_cat; ?></label></a>
</div>
<div class="link-grp">
<div class="link"><a href="<?php echo $site.'works/'.$slugName; ?>" class="<?php if($name=='works' || $name=='detail') echo 'active';?>" alt="" >WORKS ></a></div>
<div class="link"><a href="<?php echo $site.'news/'.$slugName; ?>" class="<?php if($name=='news') echo 'active';?>" alt="" >NEWS ></a></div>
<div class="link"><a href="<?php echo $site.'bid/'.$slugName; ?>" class="<?php if($name=='bid') echo 'active';?>" alt="" >BIO ></a></div>
<div class="link"><a href="<?php echo $site.'exhibitions/'.$slugName; ?>" class="<?php if($name=='exhibitions') echo 'active';?>" alt="" >EXHIBITIONS ></a></div>
<div class="link"><a href="<?php echo $site.'press/'.$slugName; ?>" class="<?php if($name=='press') echo 'active';?>" alt="" >PRESS ></a></div>
<div class="link"><a href="<?php echo $site.'publications/'.$slugName; ?>" class="<?php if($name=='publications') echo 'active';?>" alt="" >PUBLICATIONS ></a></div>
</div>
		
