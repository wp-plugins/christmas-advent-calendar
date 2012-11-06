var MakenewsmailJulekalender = (function( $ ) {

	function Julekalender(numCalendars, lang) {
		this.numCalendars = numCalendars || 3;
		this.lang = lang;
		this.apiurl = 'https://tiltnes.julekalender.com/api/calendars.json?callback=?';
		this.init();
		
	}

	Julekalender.prototype.init = function() {
		var self = this;
		
		this.getCalendars().then(
			function( json ) { self.writePage(json);  }, function(error) { alert("opps"); }
		);
	};

	Julekalender.prototype.getCalendars = function() {
		var dfd = new $.Deferred();
		return $.ajax({
			dataType: 'jsonp',
			url: this.apiurl,
			crossDomain: true,
			success: dfd.resolve
		}).promise();
	};

	Julekalender.prototype.writePage = function( json ) {
		var local = json,
			newarr = [],
			counter = 1;
		
						
			(this.numCalendars > local.length) ? counter = local.length : counter = this.numCalendars;
			
			for(i=0;i<counter;i++) {
				local_language = local[i].language.substring(0, 2);
				
				if( this.lang === local_language ) {
					newarr.push(local[i]);
				}
			}
			
			template = Handlebars.compile($('#template').html());
			var temp = template(this.shuffle(newarr));
			
			$('ul#julekalender').append(temp);
	};

	Julekalender.prototype.shuffle = function(arr) {
		for(var j, x, i = arr.length; i; j = parseInt(Math.random() * i), x = arr[--i], arr[i] = arr[j], arr[j] = x);
    	return arr;
    };

	return Julekalender;
	
}( jQuery ));







