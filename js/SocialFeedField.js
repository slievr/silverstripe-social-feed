(function($) {
	$(document).ready(function() {
		var ss = ss || {};
	    $.entwine('ss', function($) {
	        $('#socialfeed').entwine({
	        	onmatch: function(){
					loadFeed();
					//loadFacebookSearch();
					//loadTwiiterSearch();
	        		//loadInstagramSearch();
	        	}
	        });
		});
	});

	function loadFeed(){
		var target = $('#socialfeed').attr('socialfeed-url');

		$.ajax({
			url: target,
			dataType: 'json',
			type: 'GET',
			success: function(data){
				console.log(data);
				//$('#socialfeed').append(data);

				for(var item in data.data){
					if(data.data[item].type == 'photo'){
						console.log(data.data[item]);
						$('#socialfeed').append('<div class="social-feed__item"><img class="social-feed__image" src="https://graph.facebook.com/'+data.data[item].object_id+'/picture">						<span>updated: '+data.data[item].updated_time+'</span></div>');
					}
				}
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function loadInstagramSearch(){
		var token = '2136707.4dd19c1.d077b227b0474d80a5665236d2e90fcf',
	    hashtag = 'beautifulaberdeen', // hashtag without # symbol
	    num_photos = 4;

		$.ajax({
			url: 'https://api.instagram.com/v1/tags/' + hashtag + '/media/recent',
			dataType: 'json',
			type: 'GET',
			data: {access_token: token, count: num_photos},
			success: function(data){
				console.log(data);

				for(var item in data.data){
					$('#socialfeed').append('<div><img src="'+data.data[item].images.standard_resolution.url+'"></div>');
				}
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function loadFacebookSearch(){
		console.log('test');

		var token = '1420972004865719|h5UMQRraPJEPBuQxgrr80fpqZ9A',
	    user = '297934263641339';

		$.ajax({
			url: 'https://graph.facebook.com/'+ user +'/posts?access_token=' + token,
			dataType: 'json',
			type: 'GET',
			success: function(data){
				for(var item in data.data){
					if(data.data[item].type == 'photo'){
						console.log(data.data[item]);
						$('#socialfeed').append('<div class="social-feed__item">\
						<img class="social-feed__image" src="https://graph.facebook.com/'+data.data[item].object_id+'/picture">\
						<span>updated: '+data.data[item].updated_time+'</span>\
						</div>');
					}
				}
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function loadTwiiterSearch(){
		console.log('test');

		var query = '#visitabdn'; // hashtag without # symbol

		query = encodeURIComponent(query);



		var oauth = OAuth({
		    consumer: {
		        key: 'mP57wuetw2Vi7cUK4xjvR59Rx',
		        secret: '45zSQ2QkjU96GjoaLDSvBk10hFzS838NkL2Zp6VcAnafKKoyuD'
		    },
		    signature_method: 'HMAC-SHA1',
		    hash_function: function(base_string, key) {
				var hmac = forge.hmac.create();
				hmac.start('sha1', key);
				hmac.update(base_string);
				return hmac.digest().toHex();
		    }
		});

		var request_data = {
		    url: 'https://api.twitter.com/1.1/search/tweets.json?q='+query,
		    method: 'GET',
		    data: {
		        status: 'Hello Ladies + Gentlemen, a signed OAuth request!'
		    }
		};

		$.ajax({
			url: request_data.url,
			xhrFields: {
			  withCredentials: true
			},
			dataType: 'json',
			type: request_data.method,
			headers: oauth.toHeader(oauth.authorize(request_data)),
			success: function(data){
				console.log(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function addToSubmission(){
		//socailitems[item][property]
	}

})(jQuery);
