/**
 * Handles mobile menus.
 */
jQuery(document).ready(function($){
	$("#sidemenu_show").click(function(){
	$("#mobile-menu-wrapper").animate({ left: "0px" }, 500);
	});
});

jQuery(document).ready(function($){
	$("#sidemenu_hide").click(function(){
	$("#mobile-menu-wrapper").animate({ left: "-300px" },500);
	});
});