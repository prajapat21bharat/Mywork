<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$site=site_url().'contact/';
	$name = $this->uri->segment(2);
	//print_r($publications);
?>
<div class="main-content">
	<div class="row">
		<div class="span3 left-side"></div>
		<div class="span9 inner-content">	
			<div class="span3">
				<div class="red-bg"><a href="<?php echo $site; ?>" alt="" >CONTACT</a></div>
			</div>		
			<div class="span9" >             
				<div class="inner-contents"><!--	
					<div class="top-con">
						<div class="in-cont">				
							<div class="title-blk">BRUSSELS HEADQUARTERS AND GALLERY:</div>
							<div class="in-txt">8B rue de L’Abbaye, 1060 Brussels</div>
							<div class="in-txt">Tel. +32 2 647 55 16</div>
						</div>
						<div class="in-cont">				
							<div class="title-red">Irene Laub, Owner</div>
							<div class="in-txt">Mobile: +32 473 91 85 06</div>
							<div class="in-txt">irenelaub@gallery-feizi.com	</div>
						</div>
						<div class="in-cont">				
							<div class="title-red">Alexandra Decraene, Assistant</div>
							<div class="in-txt">Mobile:  +33 6 33 68 95 71</div>
							<div class="in-txt">mailto:alexandra@gallery-feizi.com</div>
						</div>
					</div>
					<div class="bot-con">
						<div class="in-cont">				
							<div class="title-blk">SHANGHAI OFFICE:</div>
							<div class="title-red">Sandra Yin, Director</div>
							<div class="in-txt">Mobile: +86 139 0194 2604</div>
							<div class="in-txt">sandrayin@gallery-feizi.com</div>
						</div>
						<div class="in-cont">				 
							<div class="title-red">Queenie Zhou, Assistant</div>
							<div class="in-txt">Mobile: +86 152 2109 2226</div>
							<div class="in-txt">queeniezhou@gallery-feizi.com</div>
						</div>
					</div>-->
					<?php echo $contact_data[0]->contact_data; ?>
					<div class="google-map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2520.6513156856927!2d4.369112000000008!3d50.8190987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c4ee51afdd3f%3A0x8355fcbc00503edc!2sRue+de+l&#39;Abbaye+8%2C+1050+Ixelles%2C+Belgium!5e0!3m2!1sen!2sin!4v1405073863731" width="600" height="200" frameborder="0" style="border:0"></iframe>
					</div>
				</div>			
			</div>        
		</div>
	</div>
</div>
