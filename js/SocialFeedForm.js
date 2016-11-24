(function($) {
	$(document).ready(function() {
		var ss = ss || {};		
	    $.entwine('ss', function($) {
	        $('#instafeed').entwine({
	        	onmatch: function(){
	        		loadInstagramSearch();
	        	}
	        });
		});
	});
})(jQuery);

function loadInstagramSearch(){
    var feed = new Instafeed({
        get: 'tagged',
        tagName: 'awesome',
        clientId: 'd228eeacb98242e096cbbed7f41ca180'
    });
    feed.run();
}
