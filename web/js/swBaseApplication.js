/*
 * This file is part of the swBaseApplicationPlugin package.
 *
 * (c) 2008 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
jQuery(window).bind('load', function(){
  
  // compatible with 1.2
  jQuery("ul.ui-tabs-nav").tabs();
  
  // new with 1.3
  jQuery('div.ui-auto-tabs').tabs();
  
  
  //
  jQuery('div.sw-filters-top-auto').each(function() {
    
    var elm_show = jQuery('<a href="" class="sw-filter-show" style="display:none; float: right">display filters</a>');
    var elm_hide = jQuery('<a href="" class="sw-filter-hide" style="display:none; float: right">hide filters</a>');
    var filter_open = jQuery('<input type="hidden" name="__filter_open" value="1" class="sw-filter-state" />');
    
    // display filter elements
    elm_show.click(function(event) {
      event.preventDefault();
      
      var div = jQuery(this).parents('div.sw-filters-top-auto');
      jQuery('form.sw-base-filter-form', div).show();
      jQuery('a.sw-filter-hide', div).show();
      jQuery('a.sw-filter-show', div).hide();
      jQuery('input.sw-filter-state', div).val(1);
      
    });
    
    // hide filter elements
    elm_hide.click(function(event) {
      event.preventDefault();
      
      var div = jQuery(this).parents('div.sw-filters-top-auto');
      jQuery('form.sw-base-filter-form', div).hide();
      jQuery('a.sw-filter-hide', div).hide();
      jQuery('a.sw-filter-show', div).show();
      jQuery('input.sw-filter-state', div).val(0);
    });
    
    jQuery('form.sw-base-filter-form', this).append(filter_open);
    jQuery(this).append(elm_hide);
    jQuery(this).append(elm_show);

    if(document.location.href.substr(document.location.href.length - "__filter_open=1".length) == "__filter_open=1")
    {
      elm_show.click();
    }
    else
    {
      elm_hide.click();
    }
    
  });
})
