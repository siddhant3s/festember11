/*
 * jQuery Illuminate v0.7 - http://www.tonylea.com/
 *
 * Illuminate elements in jQuery, Function takes the background color of an element
 * and illuminates the element.
 *
 * TERMS OF USE - jQuery Illuminate
 * 
 * Open source under the BSD License. 
 *
 * Currently incompatible with FireFox v.4
 * 
 * Copyright Â© 2011 Tony Lea
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 	
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 * GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

(function($){
	$.fn.illuminate = function(options) {
	    
	    /* set the defaults */
		var defaults = {
			intensity: '0.05',
			color: '',
			blink: 'true',
			blinkSpeed: '600',
			outerGlow: 'true',
			outerGlowSize: '30px',
			outerGlowColor: ''
		};
	  
	  	/* extend the defaults and the user options */
		var options = $.extend(defaults, options);
		
		var original_color = '';
		var new_color = '';
		var dead = false;
		
		/* kill the illumination */
		$.fn.illuminateDie = function()
		{
			dead = true;
			options.intensity = '0.05';
			options.color = '';
			options.blink = 'true';
			options.blinkSpeed = '600';
			options.outerGlow = 'true';
			options.outerGlowSize = '30px';
			options.outerGlowColor = '';
			$(this).css({'boxShadow': '0px 0px 0px', 'background-color': "#" + original_color});
		}
		
		function toggleIllumination(obj, original_color, new_color, outerGlow)
		{
			if(rgb2hex(obj.css('background-color')).toUpperCase() == original_color.toUpperCase())
			{	
				
				obj.animate({"background-color": "#" + new_color, 'boxShadowBlur': outerGlow }, parseInt(options.blinkSpeed), 
					function(){
						if(!dead)
							toggleIllumination($(this), original_color, new_color, outerGlow);
					});
			}
			
			if(rgb2hex(obj.css('background-color')).toUpperCase() == new_color.toUpperCase())
			{	
				obj.animate({"background-color": "#" + original_color, 'boxShadowBlur': '0px' }, parseInt(options.blinkSpeed), 
					function(){
						if(!dead)
							toggleIllumination($(this), original_color, new_color, outerGlow);
					});
			}
		}
	
		function colorAdd(hex, percent)
		{
			percentHex = parseInt(Math.round(parseFloat(percent)*16));
			return hexAdd(hex[0], percentHex) + hexAdd(hex[1], percentHex) + hexAdd(hex[2], percentHex) + hexAdd(hex[3], percentHex) + hexAdd(hex[4], percentHex) + hexAdd(hex[5], percentHex);
			
		}
		
		function hexAdd(val, val2)
		{
			result = parseInt(val, 16) + val2;
			if(result > 15) return 'F';
			return result.toString(16).toUpperCase();
		}
	
	
	
		function rgb2hex(rgb) {
		    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		    function hex(x) {
		        return ("0" + parseInt(x).toString(16)).slice(-2);
		    }
		    return hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
		}
		
		
		
		return this.each(function() {
			obj = $(this);
			if(obj.is("input")){
				if(obj.css('border') == ''){ obj.css('border', 'none') };
			}
			dead = false;
			original_color = rgb2hex(obj.css('background-color'));
			if(options.color == ''){
				new_color = colorAdd(original_color, options.intensity);
			} else
			{
				new_color = options.color.replace('#', '');
			}
			
			var BlurColor = '';
			
			if(options.outerGlowColor == ''){
				BlurColor = new_color;
			} else {
				BlurColor = options.outerGlowColor.replace('#', '');
			}
			
			
				
			obj.css('boxShadow','0px 0px 0px #'+BlurColor);
			
			var firstColor = '';
			var firstBlur = '';
			
			if(options.blink == 'true'){
				firstColor = original_color;
				firstBlur = '0px';
			} else {
				firstColor = new_color;
				firstBlur = options.outerGlowSize;
			}
			
			var outerGlow = '';
			if(options.outerGlow == 'true'){
				outerGlow = options.outerGlowSize;
			} else {
				outerGlow = '0px';
			}
			
			obj.animate({"background-color": "#" + firstColor, 'boxShadowBlur': firstBlur }, parseInt(options.blinkSpeed), 
				function(){
					if(options.blink == 'true')
						toggleIllumination($(this), original_color, new_color, outerGlow);
				});
		});
		

	};
	
	
	
	
	/* Functionality to extend the Blur Animation */
 
    // boxShadow get hooks
    var div = document.createElement('div'),
        divStyle = div.style,
        support = $.support,
        rWhitespace = /\s/,
        rParenWhitespace = /\)\s/;

    support.boxShadow =
        divStyle.MozBoxShadow     === ''? 'MozBoxShadow'    :
        (divStyle.MsBoxShadow     === ''? 'MsBoxShadow'     :
        (divStyle.WebkitBoxShadow === ''? 'WebkitBoxShadow' :
        (divStyle.OBoxShadow      === ''? 'OBoxShadow'      :
        (divStyle.boxShadow       === ''? 'BoxShadow'       :
        false))));

    div = null;

    // helper function to inject a value into an existing string
    // is there a better way to do this? it seems like a common pattern
    function insert_into(string, value, index) {
        var parts  = string.split(rWhitespace);
        parts[index] = value;
        return parts.join(" ");
    }

    if ( support.boxShadow ) {
    
    
        $.cssHooks.boxShadow = {
            get: function( elem, computed, extra ) {
                return $.css(elem, support.boxShadow);
            },
            set: function( elem, value ) {
                elem.style[ support.boxShadow ] = value;
            }
        };

      

        $.cssHooks.boxShadowBlur = {
            get: function ( elem, computed, extra ) {
                return $.css(elem, support.boxShadow).split(rWhitespace)[5];
            },
            set: function( elem, value ) {
                elem.style[ support.boxShadow ] = insert_into($.css(elem, support.boxShadow), value, 5);
                
            }
        };

        $.fx.step[ "boxShadowBlur" ] = function( fx ) {
            $.cssHooks[ "boxShadowBlur" ].set( fx.elem, fx.now + fx.unit );
        };
    }

})(jQuery);
