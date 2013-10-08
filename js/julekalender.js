var MakenewsmailJulekalender = (function( w, $, undefined ) {
	function Julekalender(numCalendars, lang) {
		this.numCalendars = numCalendars || 3;
		this.lang = lang;
		this.apiurl = 'https://tiltnes.julekalender.com/api/calendars.json?callback=tiltnes';
		this.init();
	}

	Julekalender.prototype.generatePNG = function(url) {
		var URL2PNG_APIKEY = "P4F33918CBA1A4",
		    URL2PNG_SECRET = "S96C086057F262",
			query_str = "url=" + encodeURIComponent(url) + "&fullscreen=false&thumbnail_max_width=61&format=png",
			token = hex_md5(query_str + URL2PNG_SECRET);
								
			return 'http://beta.url2png.com/v6/' + URL2PNG_APIKEY + '/' + token + '/png/?' + query_str;  
	};

	Julekalender.prototype.init = function() {
		this.getCalendars();
	}
	
	Julekalender.prototype.getCalendars = function() {
		var self = this;
		$.ajax({
			type: 'get',
			async: false,
			contentType: 'application/json',
			dataType: 'jsonp',
			url: this.apiurl,
			crossDomain: true,
			jsonpCallback: 'tiltnes',
		}).done(function(json) { self.writePage(json);})
	}

	Julekalender.prototype.writePage = function( json ) {
		var local = json.sort(),
			newarr = [], 
			counter = 1;

			(this.numCalendars > local.length) ? counter = local.length : counter = this.numCalendars;

			for(i=0;i<counter;i++) { 
				local_language = local[i].language.substring(0, 2);
				
				if( this.lang === local_language ) {
					if(local[i].title.indexOf(" ") !== -1) {
						var title = local[i].title.split(" ");
						local[i].title = title[0];
					}else{
						local[i].title = local[i].title;
					}
					
					thumb = this.generatePNG(local[i].path);
					local[i].thumbnail = thumb;
					
					newarr.push(local[i]);
				}
			}

			template = Handlebars.compile($('#template').html());
			var temp = template(this.shuffle(newarr));

			$('ul#julekalender').append(temp)
	}

	Julekalender.prototype.shuffle = function(arr) {
		for(var j, x, i = arr.length; i; j = parseInt(Math.random() * i), x = arr[--i], arr[i] = arr[j], arr[j] = x);
    	return arr;
	}

	return Julekalender;
}( window, jQuery, undefined ));