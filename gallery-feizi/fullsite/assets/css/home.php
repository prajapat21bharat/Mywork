<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$site=site_url()."home/index/";
 ?>
<script>

</script>
<?php $st_date=explode('-',$current[0]->start_date) ?>
<?php $nd_date=explode('-',$current[0]->end_date) ?>
<?php $st1_date=explode('-',$next[0]->start_date) ?>
<?php $nd1_date=explode('-',$next[0]->end_date) ?>

<div class="main-content">
  <div class="current-exhibition">
	  <div class="title">CURRENT EXHIBITIONS :</div>
	  <div class="current-title"><?php echo $current[0]->title ?> :</div>
	  <div class="current-date"><?php echo $st_date[2].'.'.$st_date[1].'.'.$st_date[0]; ?> > <?php echo $nd_date[2].'.'.$nd_date[1].'.'.$nd_date[0]; ?></div>
  </div>
  <div class="current-img"><img src="<?php echo base_url().'uploads/'.$current[0]->image ; ?>" alt="" width="566" height="367" /></div>
  <div class="upcoming-exhibition">
	  <div class="up-title">UPCOMING EXHIBITIONS :</div>
	  <div class="upcoming-title"><?php echo $next[0]->title ?> :</div>
	  <div class="upcoming-date">GROUP EXHIBITIONS : <?php echo $st1_date[2].'.'.$st1_date[1].'.'.$st1_date[0]; ?> > <?php echo $nd1_date[2].'.'.$nd1_date[1].'.'.$nd1_date[0]; ?></div>
  </div>
</div>
