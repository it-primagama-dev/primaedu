/************************************************
 * Author       : hamzah                        *
 * Email        : if.hamzah93@gmail.com         *
 * Blogger      : hamzahkerenz.blogspot.com     *
 ************************************************/

(function ($) {
	"use strict";

	$(document).ready(function () {
		$("#sideNav").click(function(){
			if($('#sidebar').hasClass('active')){
				$('#sidebar').removeClass('active');
				$('#page-wrapper').animate({'margin-left' : '230px'});
			} else {
				$('#sidebar').toggleClass('active');
				$('#page-wrapper').animate({'margin-left' : '0px'});
			}
		});

		$('#sidebar ul li a').click(function(){ 
			$('#sidebar ul').removeClass('in');
			$('#sidebar ul li .active').attr('aria-expanded','false');
		});
	});
	
	// $(window).scroll(function() {
	// 	if ($(window).scrollTop() >= 900) {    // offset?
	// 	  $('.navbar-side').css({'position':'fixed','top':'22px','bottom':'auto'});
	// 	} else {
	// 	  $('.navbar-side').css({'position':'absolute','top':'auto','bottom':'15px'});
	// 	}
	// });
	$(function(){
	   var scroll_pos=(0);
	   $('html, body').animate({scrollTop:(scroll_pos)}, '2000');
	});

}(jQuery));

$(function() {
	$('.loader').css({"position":"fixed","z-index":"5000","top":"0","left":"0","height":"100%","width":"100%","background":"rgba( 255, 255, 255, .8 ) url('"+base_url+"assets/images/pIkfp.gif') 50% 50% no-repeat"});
	$('.loader').hide();
	$(document).bind('ajaxStart',function() {
		$('.loader').show();
	}).bind('ajaxStop',function(){
		$('.loader').hide();
	}).bind('ajaxError',function(jqXHR, exception){
		$('.loader').hide();
		var msg = '';
		if (jqXHR.status === 0) {
			msg = 'Koneksi anda terputus.';
		} else if (jqXHR.status == 404) {
			msg = 'Halaman yang diminta tidak ditemukan [404]';
		} else if (jqXHR.status == 500) {
			msg = 'Terjadi kesalahan sistem [500].';
		} else if (exception === 'parsererror') {
			msg = 'Gagal meminta data dari server';
		} else if (exception === 'timeout') {
			msg = 'Waktu eksekusi anda sudah habis.';
		} else if (exception === 'abort') {
			msg = 'Gagal meminta data dari server.';
		} else {
			msg = /*'Terdapat data yang tidak sesuai format.';*/null;
		}
		$.notify(msg,'error');
	});
});

function has_duplicates(arr) {
	arr.sort();
	var last = arr[0];
	var getData = [];
	for (var i=1; i<arr.length; i++) {
		if (arr[i] == last)
		getData.push(last);
		last = arr[i];
	}
	return getData;
}

function in_array(needle, haystack, argStrict) {
  var key = '',
	strict = !! argStrict;

  if (strict) {
	for (key in haystack) {
	  if (haystack[key] === needle) {
		return true;
	  }
	}
  } else {
	for (key in haystack) {
	  if (haystack[key] == needle) {
		return true;
	  }
	}
  }

  return false;
}

function angka(e) {
	if (!/^[0-9]+$/.test(e.value)) {
		e.value = e.value.substring(0,e.value.length-1);
	}
};

function convertToRupiah(angka){
	var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
	var rev2    = '';
	for(var i = 0; i < rev.length; i++){
		rev2  += rev[i];
		if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
			rev2 += '.';
		}
	}
	return 'Rp ' + rev2.split('').reverse().join('') + ',00';
}
function convertToAngka(rp){return parseInt(rp.replace(/,.*|\D/g,''),10)}


function splitMulti(str, tokens){
	// ex => splitMulti(userInput, ['-','/'])[1]
	var tempChar = tokens[0];
	for(var i = 0; i < tokens.length; i++){
		str = str.split(tokens[i]).join(tempChar);
	}
	str = str.split(tempChar);
	return str;
}

function strtotime(date) {
	var now = new Date(date);
	var y = now.getFullYear().toString().substr(2,2);
	var m = now.getMonth() + 1;
	var d = now.getDate();
	var mm = m < 10 ? '0' + m : m;
	var dd = d < 10 ? '0' + d : d;
	return mm+'-'+y;
}

function tgl_indo(date) {
	var now = new Date(date);
	var yy = now.getFullYear();
	var m = now.getMonth() + 1;
	var d = now.getDate();
	var mm = m < 10 ? '0' + m : m;
	var dd = d < 10 ? '0' + d : d;
	return dd+'/'+mm+'/'+yy;
}

function decode(data) {
	/*
	var x = document.createElement("SCRIPT");
	var t = document.createTextNode(decrypt(data));
	x.appendChild(t);
	document.body.appendChild(x);
	*/
	eval(decrypt(data));
}

function decode64(text) {
	eval(atob('dGV4dCA9IHRleHQucmVwbGFjZSgvXHMvZywgIiIpOwoKICAgIGlmICghKC9eW2EtejAtOVwrXC9cc10rXD17MCwyfSQvaS50ZXN0KHRleHQpKSB8fCB0ZXh0Lmxlbmd0aCAlIDQgPiAwKSB7CiAgICAgICAgdGhyb3cgbmV3IEVycm9yKCJOb3QgYSBiYXNlNjQtZW5jb2RlZCBzdHJpbmcuIik7CiAgICB9CiAgICB2YXIgZGlnaXRzID0gIkFCQ0RFRkdISUpLTE1OT1BRUlNUVVZXWFlaYWJjZGVmZ2hpamtsbW5vcHFyc3R1dnd4eXowMTIzNDU2Nzg5Ky8iLAogICAgICAgIGN1ciwgcHJldiwgZGlnaXROdW0sIGkgPSAwLAogICAgICAgIHJlc3VsdCA9IFtdOwoKICAgIHRleHQgPSB0ZXh0LnJlcGxhY2UoLz0vZywgIiIpOwoKICAgIHdoaWxlIChpIDwgdGV4dC5sZW5ndGgpIHsKCiAgICAgICAgY3VyID0gZGlnaXRzLmluZGV4T2YodGV4dC5jaGFyQXQoaSkpOwogICAgICAgIGRpZ2l0TnVtID0gaSAlIDQ7CgogICAgICAgIHN3aXRjaCAoZGlnaXROdW0pIHsKCiAgICAgICAgICAgIC8vY2FzZSAwOiBmaXJzdCBkaWdpdCAtIGRvIG5vdGhpbmcsIG5vdCBlbm91Z2ggaW5mbyB0byB3b3JrIHdpdGgKICAgICAgICBjYXNlIDE6CiAgICAgICAgICAgIC8vc2Vjb25kIGRpZ2l0CiAgICAgICAgICAgIHJlc3VsdC5wdXNoKFN0cmluZy5mcm9tQ2hhckNvZGUocHJldiA8PCAyIHwgY3VyID4+IDQpKTsKICAgICAgICAgICAgYnJlYWs7CgogICAgICAgIGNhc2UgMjoKICAgICAgICAgICAgLy90aGlyZCBkaWdpdAogICAgICAgICAgICByZXN1bHQucHVzaChTdHJpbmcuZnJvbUNoYXJDb2RlKChwcmV2ICYgMHgwZikgPDwgNCB8IGN1ciA+PiAyKSk7CiAgICAgICAgICAgIGJyZWFrOwoKICAgICAgICBjYXNlIDM6CiAgICAgICAgICAgIC8vZm91cnRoIGRpZ2l0CiAgICAgICAgICAgIHJlc3VsdC5wdXNoKFN0cmluZy5mcm9tQ2hhckNvZGUoKHByZXYgJiAzKSA8PCA2IHwgY3VyKSk7CiAgICAgICAgICAgIGJyZWFrOwogICAgICAgIH0KCiAgICAgICAgcHJldiA9IGN1cjsKICAgICAgICBpKys7CiAgICB9'));
	return result.join("");
}

eval(decode64('DQpmdW5jdGlvbiBvcmQoc3RyaW5nKSB7DQoNCiAgICB2YXIgc3RyID0gc3RyaW5nICsgJycsDQogICAgICAgIGNvZGUgPSBzdHIuY2hhckNvZGVBdCgwKTsNCiAgICBpZiAoMHhEODAwIDw9IGNvZGUgJiYgY29kZSA8PSAweERCRkYpIHsNCiAgICAgICAgdmFyIGhpID0gY29kZTsNCiAgICAgICAgaWYgKHN0ci5sZW5ndGggPT09IDEpIHsNCiAgICAgICAgICAgIHJldHVybiBjb2RlOw0KICAgICAgICB9DQogICAgICAgIHZhciBsb3cgPSBzdHIuY2hhckNvZGVBdCgxKTsNCiAgICAgICAgcmV0dXJuICgoaGkgLSAweEQ4MDApICogMHg0MDApICsgKGxvdyAtIDB4REMwMCkgKyAweDEwMDAwOw0KICAgIH0NCiAgICBpZiAoMHhEQzAwIDw9IGNvZGUgJiYgY29kZSA8PSAweERGRkYpIHsNCiAgICAgICAgcmV0dXJuIGNvZGU7DQogICAgfQ0KICAgIHJldHVybiBjb2RlOw0KfQ0KDQpmdW5jdGlvbiBkZWNyeXB0KHNEYXRhKSB7DQogICAgdmFyIHNLZXkgPSAnQ3IzNHQzZF9ieS5IQG1aNGgnOw0KICAgIHZhciBzUmVzdWx0ID0gJyc7DQogICAgc0RhdGEgPSBkZWNvZGU2NChzRGF0YSk7DQogICAgdmFyIGkgPSAwOw0KICAgIGZvciAoaSA9IDA7IGkgPCBzRGF0YS5sZW5ndGg7IGkrKykgew0KICAgICAgICB2YXIgc0NoYXIgPSBzRGF0YS5zdWJzdHIoaSwgMSk7DQogICAgICAgIHZhciBzS2V5Q2hhciA9IHNLZXkuc3Vic3RyKGkgJSBzS2V5Lmxlbmd0aCAtIDEsIDEpOw0KICAgICAgICBzQ2hhciA9IE1hdGguZmxvb3Iob3JkKHNDaGFyKSAtIG9yZChzS2V5Q2hhcikpOw0KICAgICAgICBzQ2hhciA9IFN0cmluZy5mcm9tQ2hhckNvZGUoc0NoYXIpOw0KICAgICAgICBzUmVzdWx0ID0gc1Jlc3VsdCArIHNDaGFyOw0KICAgIH0NCiAgICByZXR1cm4gc1Jlc3VsdDsNCn0NCg=='));

function disableSelection(e) {
	if(typeof e.onselectstart!="undefined")e.onselectstart=function(){
		return false
	};
	else if(typeof e.style.MozUserSelect!="undefined")e.style.MozUserSelect="none";
	else e.onmousedown=function() {
		return false
	};
	e.style.cursor="default"
}

function mousedwn(e) {
	try{
		if(event.button==2||event.button==3)return false
	}
	catch(e){
		if(e.which==3)
			return false
	}
}

function intervalnotif() {
setInterval(function() {
		$(document).ready(function() {
			var formData = new FormData();
			formData.append("token", window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="));
			var xhr = new XMLHttpRequest();
			xhr.responseType = 'json';
			xhr.open('POST', base_url+"payment/check_notify", true);
			xhr.onload  = function() {
			   var response = xhr.response;
			   $('#count_msg').text(response.count);
				$('#notif_msg').text('You have '+response.count+' messages');
				var jml_data = Object.keys(response.data).length;
				if (jml_data > 0) {
					var html = ''+
					'<li>';
					$.each(response.data, function(i, item) {
						if(item.RESULTMSG=='SUCCESS'){
							html += '<ul style="margin: 0px;padding:5px;text-align:center">'+
								'<button type="button" class="btn btn-info btn-xs" data-toggle="modal" onclick="modalNotipy(\''+item.Invoice_Number+'\')">'+item.Invoice_Number+' Pembayaran '+item.RESULTMSG+'</button>'+
							'</ul>';
						} else {
							html += '<ul style="margin: 0px;padding:5px;text-align:center">'+
								'<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" onclick="modalNotipy(\''+item.Invoice_Number+'\')">'+item.Invoice_Number+' Pembayaran '+item.RESULTMSG+'</button>'+
							'</ul>';
						}
						$('.data_notify').html(html);
					});
					html += '</li>';
				}
			};
			xhr.send(formData);
		});
}, 15000);
}

function intervalonline() {
setInterval(function() {
	if (checkOnline() == true) {
		document.getElementById("connection_status").className = "fa fa-wifi";
		$('#welcomeToWebApp').modal('hide');
		// console.clear();
	} else {
		document.getElementById("connection_status").className = "fa fa-exclamation-circle";
		$('#welcomeToWebApp').modal('show');
		$('#welcomeToWebApp').css({position:'fixed',opacity:'.75',background:'#1d1d1d'});
		$('#kontenWebApp').html('<h1 style="text-align:center;color:red">Ops.. Sorry koneksi anda terputus.</h1>');
		jQuery(document).ready(function($) {
			if (window.history && window.history.pushState) {
				window.history.pushState('forward', null,null);
				$(window).on('popstate', function() {
					window.history.pushState(null, null,null);
				});
			}
		});
		disableSelection(document.body)
		document.oncontextmenu=function(){
			return false
		};
		
		function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
		$(document).ready(function(){
			$(document).on("keydown", disableF5);
		});

		document.ondragstart=function(){
			return false
		};
		document.onmousedown=mousedwn;
		window.addEventListener("keydown",function(e) {
			if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)) {
				e.preventDefault()
			}
		});
		document.keypress=function(e) {
			if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)) {
				//no comment
			}
			return false
		}
		document.onkeydown=function(e){
			e=e||window.event;if(e.keyCode==123||e.keyCode==18) {
				return false
			}
		}
	}
}, 30000);
}

var isApp = false;
window.onload = function() {
	document.addEventListener("deviceready", onDeviceReady, false);
}

function onDeviceReady() {
	isApp = true;
}

function redirectPost(url, data) {
	var form = document.createElement('form');
	document.body.appendChild(form);
	form.method = 'post';
	form.action = url;
	for (var name in data) {
		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = name;
		input.value = data[name];
		form.appendChild(input);
	}
	form.submit();
}

function modalNotipy(Invoice_Number) {
	redirectPost(base_url+'Logistics/inv',{inv:window.btoa(Invoice_Number),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")})
}

function checkOnline(){

	if(isApp)
	{
		var xhr = new XMLHttpRequest();
		var file = "http://dexheimer.cc/apps/kartei/neu/dot.png";

		try {
			xhr.open('HEAD', file , false); 
			xhr.send(null);

			if (xhr.status >= 200 && xhr.status < 304) {
				return true;
			} else {
				return false;
			}
		} catch (e) 
		{
			return false;
		}
	}else
	{
		var tmpIsOnline = false;

		tmpIsOnline = navigator.onLine;

		if(tmpIsOnline || tmpIsOnline == "undefined")
		{
			try{
				//Didnt work local
				//Need "firefox.php" in root dictionary
				var xhr = XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHttp');
				xhr.onload = function(){
					tmpIsOnline = true;
				}
				xhr.onerror = function(){
					tmpIsOnline = false;
				}
				xhr.open("GET",base_url+"master/checkconnection");
				xhr.send();
			}catch (e){
				tmpIsOnline = false;
			}
		}
		return tmpIsOnline;

	}
}


$(document).ready(function(){
	var logger = function()
	{
		var oldConsoleLog = null;
		var pub = {};

		pub.enableLogger =  function enableLogger() 
		{
			if(oldConsoleLog == null)
				return;
				window['console']['log'] = oldConsoleLog;
		};

		pub.disableLogger = function disableLogger()
		{
			oldConsoleLog = console.log;
			window['console']['log'] = function() {};
		};

		return pub;
	}();

	$(document).ready(function() {
		console.log('WARNING !!!');

		logger.disableLogger();
		console.log("%cDILARANG MENDUPLIKASI SOURCODE INI !!!", "font: 4em sans-serif; color: yellow; background-color: red;");
		console.log("%cJika ingin memberi masukkan mengenai aplikasi ini silakan kontak www.primagama.co.id/kontak.html", "font: 1.5em sans-serif; color: black;");

		logger.enableLogger();
		console.log("%cDILARANG MENDUPLIKASI SOURCODE INI !!!", "font: 4em sans-serif; color: yellow; background-color: red;");
		console.log("%cJika ingin memberi masukkan mengenai aplikasi ini silakan kontak www.primagama.co.id/kontak.html", "font: 1.5em sans-serif; color: black;");
	});
});

function tgl_indo(date) {
	var now = new Date(date);
	var yy = now.getFullYear();
	var m = now.getMonth() + 1;
	var d = now.getDate();
	var mm = m < 10 ? '0' + m : m;
	if (mm=='01') {
		var mmText = "Januari";
	} else if (mm=='02') {
		var mmText = "Februari";
	} else if (mm=='03') {
		var mmText = "Maret";
	} else if (mm=='04') {
		var mmText = "April";
	} else if (mm=='05') {
		var mmText = "Mei";
	} else if (mm=='06') {
		var mmText = "Juni";
	} else if (mm=='07') {
		var mmText = "Juli";
	} else if (mm=='08') {
		var mmText = "Agustus";
	} else if (mm=='09') {
		var mmText = "September";
	} else if (mm=='10') {
		var mmText = "Oktober";
	} else if (mm=='11') {
		var mmText = "November";
	} else if (mm=='12') {
		var mmText = "Desember";
	}
	var dd = d < 10 ? '0' + d : d;
	return dd+' '+mmText+' '+yy;
}

function tgl_indo_time(time){
	var time = new Date(time);
	var Y = time.getFullYear();
	var m = time.getMonth() + 1;
	var d = time.getDate();
	var mm = m < 10 ? '0' + m : m;
	if (mm=='01') {
		var mmText = "Januari";
	} else if (mm=='02') {
		var mmText = "Februari";
	} else if (mm=='03') {
		var mmText = "Maret";
	} else if (mm=='04') {
		var mmText = "April";
	} else if (mm=='05') {
		var mmText = "Mei";
	} else if (mm=='06') {
		var mmText = "Juni";
	} else if (mm=='07') {
		var mmText = "Juli";
	} else if (mm=='08') {
		var mmText = "Agustus";
	} else if (mm=='09') {
		var mmText = "September";
	} else if (mm=='10') {
		var mmText = "Oktober";
	} else if (mm=='11') {
		var mmText = "November";
	} else if (mm=='12') {
		var mmText = "Desember";
	}
	var dd = d < 10 ? '0' + d : d;
	var tgl_indon = dd+' '+mmText+' '+Y;

	var hours = time.getHours();
	var minutes = time.getMinutes();
	var ampm = hours >= 12 ? 'pm' : 'am';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	minutes = minutes < 10 ? '0'+minutes : minutes;

	return tgl_indon+"<br/>"+ ( hours + ':' + minutes + ' ' + ampm);
}

function tgl_indo_time2(time){
	var time = new Date(time);
	var Y = time.getFullYear();
	var m = time.getMonth() + 1;
	var d = time.getDate();
	var mm = m < 10 ? '0' + m : m;
	if (mm=='01') {
		var mmText = "Januari";
	} else if (mm=='02') {
		var mmText = "Februari";
	} else if (mm=='03') {
		var mmText = "Maret";
	} else if (mm=='04') {
		var mmText = "April";
	} else if (mm=='05') {
		var mmText = "Mei";
	} else if (mm=='06') {
		var mmText = "Juni";
	} else if (mm=='07') {
		var mmText = "Juli";
	} else if (mm=='08') {
		var mmText = "Agustus";
	} else if (mm=='09') {
		var mmText = "September";
	} else if (mm=='10') {
		var mmText = "Oktober";
	} else if (mm=='11') {
		var mmText = "November";
	} else if (mm=='12') {
		var mmText = "Desember";
	}
	var dd = d < 10 ? '0' + d : d;
	var tgl_indon = dd+' '+mmText+' '+Y;

	var hours = time.getHours();
	var minutes = time.getMinutes();
	var ampm = hours >= 12 ? 'pm' : 'am';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	minutes = minutes < 10 ? '0'+minutes : minutes;

	return tgl_indon+" "+ ( hours + ':' + minutes + ' ' + ampm);
}

