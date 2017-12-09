<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$site=site_url().'artist/';?>

<?php 
$invitedUsers = array();
foreach($artist as $data){ 
$invitedUsers[] = $data->typeOfRep;
}

?>

<div class="main-content">
	<div class="inner-content container isotope" id="beta">
       <div class="row">
         <div align="left" style="color:#cf2027"><span>REPRESENTED</span></div>
       <?php $l=0; $p=1;?>
		<?php foreach($artist as $data){ 
		
                  /****Create slugfrom Id and name******/
                   $zname_clean = strtolower($data->first_name);
                   $slugName = str_replace(' ','-',$zname_clean);

                    ?>
            <?php if($data->typeOfRep!='ini'){?> 
            <?php if($l == 4){ echo '</div><div  class="row">';}?>
            
			<div class='ap-data'>
				<div class="name-chaina">
					<h3 class="title"><a href="<?php echo $site.'works/'.$slugName; ?>"><?php echo $data->first_name;?></a></h3>
					<div class="chaina"><?php echo $data->last_name;?></div>
				</div>
				<div class="<?php echo 'link-'.$p; ?>">
					<div class="link"><a href="<?php echo $site.'works/'.$slugName; ?>">works</a></div>
					<div class="link"><a href="<?php echo $site.'news/'.$slugName; ?>">news</a></div>
				</div>
			</div>
           
         	<?php if($l == 4){  $l=0;}?> 
		  
            <?php }?>
            <?php $l++; $p++; ?>
           <?php } ?>
        </div>
         <!--------------ADD Code for INVITED ARTISTS---------->
        <?php if(count($invitedUsers)>0){?>
         <div class="row">
        <div align="left" style="color:#cf2027"><span>EXHIBITED</span></div>
        
       <?php $j=0; $q=1; ?>
		<?php foreach($artist_ini as $data){ 
		
                  /****Create slugfrom Id and name******/
                   $zname_clean = strtolower($data->first_name);
                   $slugName = str_replace(' ','-',$zname_clean);

                    ?>
            <?php if($data->typeOfRep=='ini'){?>     
            <?php if($j == 4){ echo '</div><div  class="row">';}?>
			<div class='ap-data'>
				<div class="name-chaina">
					<h3 class="title"><a href="<?php echo $site.'works/'.$slugName; ?>"><?php echo $data->first_name;?></a></h3>
					<div class="chaina"><?php echo $data->last_name;?></div>
				</div>
				<div class="<?php echo 'link-'.$q; ?>">
					<div class="link"><a href="<?php echo $site.'works/'.$slugName; ?>">works</a></div>
					<div class="link"><a href="<?php echo $site.'news/'.$slugName; ?>">news</a></div>
				</div>
			</div>
            
           
         	<?php if($j == 4){  $j=0;}?> 
            <?php }?>
		<?php $j++; $q++; } ?>
        </div>
        <?php }?>
         <!--------------END Code for INVITED ARTISTS---------->
        
        

	</div>
</div>
<style>
.link-11 {
    margin-top: -20px;
}	
</style>	
