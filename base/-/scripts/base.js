/* base.js */

/* development */

	function dump(obj){
		var out = '';

		for (var i in obj){
			out += i + ": " + obj[i] + "\n";
		}

		var pre = document.createElement('pre');
			pre.innerHTML = out;

		document.body.appendChild(pre)
	}

/* layout */

	function equalizeHeight(obj){
		var obj = (obj) ? obj : $('.equalize');
		var heights = [];

		$(obj)
			.each(function(i){
				heights[i] = $(this).height();
			});

		$(obj)
			.height(Math.max.apply(Math,heights));
	}

/* utility */

	function pad(number,length){
		var str = '' + number;

		while (str.length < length){ str = '0' + str; }
		return str;
	}

	function tab(depth){
		var r = '';

		for (var i=0; i < depth; i++){ r += '\t'; }
		return r;
	}

	function toTitleCase(glue,str){
		glue = (glue) ? glue : new Array('of','for','and');
		return str.replace(/(\w)(\w*)/g,function(_,i,r){
			var j = i.toUpperCase()+(r != null ? r : '');
			return (glue.indexOf(j.toLowerCase())<0) ? j : j.toLowerCase();
		});
	}

	function inArray(needle,haystack,strict){
		// http://kevin.vanzonneveld.net
		// + original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// + improved by: vlado houba
		// + input by: Billy
		// + bugfixed by: Brett Zamir (http://brett-zamir.me)
		// * example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']);
		// * returns 1: true
		// * example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'});
		// * returns 2: false
		// * example 3: in_array(1, ['1', '2', '3']);
		// * returns 3: true
		// * example 3: in_array(1, ['1', '2', '3'], false);
		// * returns 3: true
		// * example 4: in_array(1, ['1', '2', '3'], true);
		// * returns 4: false
		var key = '';

		if (strict){
			for (key in haystack){
				if (haystack[key] === needle){
					return true;
				}
			}
		}
		else {
			for (key in haystack){
				if (haystack[key] == needle){
					return true;
				}
			}
		}
		return false;
	}

/* cookies */

	function cookieWrite(name,value,days){
		if (days){
			var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = '; expires='+date.toGMTString();
		}
		else {
			var expires = '';
		}
		document.cookie = name+'='+value+expires+'; path=/';
	}

	function cookieRead(name){
		var nameEQ = name+'=';
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++){
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}

	function cookieErase(name){
		cookieWrite(name,'',-1);
	}

/* cookies from book */
/* function cookieSet(){
		var date = new Date();
		var expire = date.setMonth(expireDate.getMonth()+6);

		document.cookie = 'visitDate=' + date + ';expires=' + expire.toGMTString();
		
		return null;
	}

	function cookieVal(cookieName){
		var thisCookie = document.cookie.split('; ');
		for (var i=0; i<thisCookie.length; i++){
			if (cookieName == thisCookie[i].split('=')[0]){
				return thisCookie[i].split('=')[1];
			}
		}
		return false;
	}

	function cookieDelete(){
		var cookieCt = 0;

		if (document.cookie != '' && confirm('Do you want to delete the cookies?')){
			var thisCookie = document.cookie.split('; ');
			cookieCt = thisCookie.length;
		
			var expireDate = new Date();
			expireDate.setDate(expireDate.getDate()-1);
						   
			for (var i=0; i<cookieCt; i++){
				var cookieName = thisCookie[i].split('=')[0];
				document.cookie = cookieName + '=;expires=' + expireDate.toGMTString();
			}
		}
		document.getElementById('cookieData').innerHTML = 'Number of cookies deleted: ' + cookieCt;
	}

	function showCookies(){
		var outMsg = '';

		if (document.cookie == ''){
			outMsg = 'You no has cookies.';
		} else {
			var thisCookie = document.cookie.split('; ');

			for (var i=0; i<thisCookie.length; i++){
				outMsg += '[ '+thisCookie[i].split('=')[0]+' = '+thisCookie[i].split('=')[1]+ ' ] \n';
			}
		}
//		document.getElementById('cookieData').innerHTML = outMsg;
		return outMsg;
	}
*/
