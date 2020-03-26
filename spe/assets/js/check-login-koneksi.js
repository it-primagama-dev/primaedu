/************************************************
 * Author       : hamzah                        *
 * Email        : if.hamzah93@gmail.com         *
 * Blogger      : hamzahkerenz.blogspot.com     *
 ************************************************/
 
/*function IdleTimeout() {
    window.location = base_url+'master/logout';
}*/

$(document).ready(function(){

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

    //note jika setInterval 1000 timer=10 detik dst.
    /*var timer = 90000; //waktu yg ditentukan untuk logout
    setInterval(function() {*/
        if (navigator.onLine == true) {
            document.getElementById("connection_status").className = "fa fa-wifi";
            /*timer--;
            if (!timer) {
                $('#welcomeToWebApp').modal('show');
                $('#kontenWebApp').html('<h1 style="text-align:center;color:red">Redirecting now!</h1>');
                document.getElementById('button_close1').style.display = 'block';
                document.getElementById('button_close2').style.display = 'block';
                timer = 90000; // set ulang waktu yg ditentukan untuk logout
                IdleTimeout();
            } else if (timer <= 5) {
                $('#welcomeToWebApp').modal('show');
                $('#kontenWebApp').html('<h1 style="text-align:center;color:blue;">Redirecting in ' + timer + ' seconds</h1>');
                document.getElementById('button_close1').style.display = 'block';
                document.getElementById('button_close2').style.display = 'block';
            }*/
            
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
    /*}, 1000); // perhitungan */

    /*$(document).on('blur contextmenu cancel input keydown keyup loadeddata scroll submit select click change load ready keypress mousemove focus', function() {
        timer = 90000; // set ulang waktu yg ditentukan untuk logout
        if (navigator.onLine == true) {
            $('#welcomeToWebApp').modal('hide');
        }
    });*/

    /*var isApp = false;

    function onLoad() {
        document.addEventListener("deviceready", onDeviceReady, false);
    }

    function onDeviceReady() {
        isApp = true;
    }

    function isBrowserOnline(no,yes){
        //Didnt work local
        //Need "firefox.php" in root dictionary
        var xhr = XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHttp');
        xhr.onload = function(){
            if(yes instanceof Function){
                yes();
            }
        }
        xhr.onerror = function(){
            if(no instanceof Function){
                no();
            }
        }
        xhr.open("GET",base_url+"master/checkconnection",true);
        xhr.send();
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
                    xhr.open("GET",base_url+"master/checkconnection",false);
                    xhr.send();
                }catch (e){
                    tmpIsOnline = false;
                }
            }
            return tmpIsOnline;

        }
    }*/

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

    $(document).ready(
        function()
        {
            console.log('WARNING !!!');

            logger.disableLogger();
            console.log("%cDILARANG MENDUPLIKASI SOURCODE INI !!!", "font: 4em sans-serif; color: yellow; background-color: red;");
            console.log("%cJika ingin memberi masukkan mengenai aplikasi ini silakan kontak www.primagama.co.id/kontak.html", "font: 1.5em sans-serif; color: black;");

            logger.enableLogger();
            console.log("%cDILARANG MENDUPLIKASI SOURCODE INI !!!", "font: 4em sans-serif; color: yellow; background-color: red;");
            console.log("%cJika ingin memberi masukkan mengenai aplikasi ini silakan kontak www.primagama.co.id/kontak.html", "font: 1.5em sans-serif; color: black;");
        }
    );
});