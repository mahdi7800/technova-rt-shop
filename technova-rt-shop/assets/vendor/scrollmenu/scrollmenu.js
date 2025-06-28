/*!
 * jQuery serialscrolling
 * https://github.com/kevinmeunier/jquery-serialscrolling
 *
 * Copyright 2022 Meunier Kévin
 * https://www.meunierkevin.com
 *
 * Released under the MIT license
 */
(function(jQuery){
  'use strict';

  jQuery.fn.serialscrolling = function(options){
    const settings = jQuery.extend({}, jQuery.fn.serialscrolling.defaults, options);
    const jQuerytargetSelector = jQuery(settings.targetSelector);
    const jQuerywindow = jQuery(window);
    const jQuerystack = jQuery(this);
    const base = this;
    let jQuerycurrent = false;

    jQuery.extend(this, {
      init: function(){
        // Add selected class on scroll
        jQuerywindow.off('scroll.serialscrolling').on('scroll.serialscrolling', this.handleCurrent).trigger('scroll');

        // Handle & bind the event on links
        this.off('click.serialscrolling').on('click.serialscrolling', this.handleEvent);
      },

      handleCurrent: function(){
        let target;
        let jQuerytrigger;

        jQuerytargetSelector.each(function(){
          const jQuerypage = jQuery(this);
          if( (jQuerypage.offset().top - jQuerywindow.height()/2) < jQuerywindow.scrollTop() ){
            jQuerytrigger = settings.getTrigger(jQuerypage, jQuerystack);
          }
        });

        if( jQuerytrigger && !jQuerytrigger.is(jQuerycurrent) ){
          base.setCurrent(jQuerytrigger);

          if( settings.callback )
            settings.callback(id);
        }
      },

      handleEvent: function(){
        const jQuerytrigger = jQuery(this);
        const jQuerytarget = settings.getTarget(jQuerytrigger);

        base.scrollTo(jQuerytarget, settings.duration, settings.easing);
        return false;
      },

      setCurrent: function(jQuerytrigger){
        // Remove selected behavior from the previous
        if(jQuerycurrent) jQuerycurrent.removeClass('is-current');

        // Set current data in the container
        jQuerycurrent = jQuerytrigger;

        // Add selected behavior to the target
        jQuerytrigger.addClass('is-current');
      },

      scrollTo: function(jQuerytarget, duration, easing){
        // Animated scrolling
        jQuery('body, html').animate({
          scrollTop: jQuerytarget.offset().top  + settings.offsetTop
        }, duration, easing);
      }
    });

    this.init();
    return this;
  };


  jQuery.fn.serialscrolling.defaults = {
    targetSelector: '[data-serialscrolling-target]',
    getTarget: function(jQueryelement){
      const target = jQueryelement.attr('data-serialscrolling');
      return jQuery('[data-serialscrolling-target="'+ target +'"]');
    },
    getTrigger: function(jQuerypage, jQuerystack){
      const target = jQuerypage.attr('data-serialscrolling-target');
      return jQuerystack.filter('[data-serialscrolling="'+ target +'"]');
    },
    duration: 800,
    easing: 'easeInOutExpo',
    offsetTop: -107,
    callback: false
  };

})(jQuery);

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 *
 * Open source under the BSD License.
 *
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
  *
*/
jQuery.easing.easeInOutExpo = function (x, t, b, c, d){
  if (t==0) return b;
  if (t==d) return b+c;
  if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
  return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
};
