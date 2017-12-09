/*
 * Url preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.themeScreenshotPreview = function(){	
	$("#theme_list a.screenshot").hover(function(e){
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("#theme_list").append("<p id='themescreenshot'><img src='"+ $(this).attr('data-rel') +"' alt='' /></p>");								 
		$("#themescreenshot").fadeIn("fast");						
    },
	function(){
		$("#themescreenshot").remove();
    });			
};

this.pluginScreenshotPreview = function(){	
	$("#plugin_list a.screenshot").hover(function(e){
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("#plugin_list").append("<p id='pluginscreenshot'><img src='"+ $(this).attr('data-rel') +"' alt='' /></p>");								 
		$("#pluginscreenshot").fadeIn("fast");						
    },
	function(){
		$("#pluginscreenshot").remove();
    });			
};



// starting the script on page load
$(document).ready(function(){
	themeScreenshotPreview();
	pluginScreenshotPreview();
});