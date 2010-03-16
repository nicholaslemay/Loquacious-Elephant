/*
	Sleep by Mark Hughes
	http://www.360Gamer.net/

	Usage:
		jQuery.sleep ( 3, function()
		{
		});
	Use at free will, distribute free of charge
*/
;(function(jQuery)
{
	jQuery.sleep = function( time2sleep, callback )
	{
		jQuery.sleep._cback = callback;
	}
	jQuery.extend (jQuery.sleep, {
		_sleeptimer : 0,
		_cback : null,
		timer : null,
		count : function()
		{
			if ( jQuery.sleep.current_i === jQuery.sleep._sleeptimer )
			{
				clearInterval(jQuery.sleep.timer);
				jQuery.sleep._cback.call(this);
			}
			jQuery.sleep.current_i++;
		}
	});
})(jQuery);