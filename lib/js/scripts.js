
jQuery().ready(function() { 
    jquery_dropdown();    
});
 
/**
 * drop down menu
 */
function jquery_dropdown(){

    jQuery("ul.js-jquery-dropdown li.menu-item-has-children , ul.js-jquery-dropdown li.page_item_has_children").hover(function(){
        var dropMenu = jQuery('ul:first',this);
        dropMenu.fadeIn(100);
        var dropMenuOffset = dropMenu.offset(); 
        if ((dropMenuOffset.left + dropMenu.width()) > jQuery(window).width() - 10) {
            // the menu is out of screen, reposition it
            dropMenu.addClass("dropdown-menu-moved");
        } 
        //add the hover class only after the main manu appeard, to prevent the shadow from showing up
        jQuery(this).delay(50).queue(function(){ 
            jQuery(this).addClass("hover"); 
            jQuery(this).dequeue(); 
        });
    }, function(){
        jQuery('ul:first',this).removeClass("dropdown-menu-moved"); //reposition the menu to it's default location'
        
        jQuery(this).removeClass("hover"); //remove hover class
        jQuery('ul:first',this).hide(); //hide the menu
        
    
        //double check that we don't have the hover class
        jQuery(this).delay(100).queue(function(){ 
            jQuery(this).removeClass("hover");
            jQuery(this).dequeue(); 
        });
    });
    jQuery("ul.js-jquery-dropdown li ul li:has(ul)").find("a:first").append(" &raquo; ");
};