/* 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 

$(".navbar-left").accordion({
   closeAny: true 
});*/
$(document).ready(function(){
    $("#sidebar-toggle").click(function(){
      c = "no-width"; x = "#sidebar-wrapper";
      if($(x).hasClass(c)){
        $(x).removeClass(c);
      } else {
        $(x).addClass(c);
      }
    });
    $("input[type=submit]").click(function(){
      $(".loader").show();
    });
    $(".sidebar.custom").slimScroll({height: '100%'});
    $(".content-wrapper").on("scroll", function(){
        if($(".content").height() <= $(".content-wrapper").height() + $(".content-wrapper").scrollTop()) {
            //alert("OK");
        }
    });
    $(".idrCurrency").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
	$(".alert").click(function(){$(this).slideUp(400)});
//    if($(".content").height() < $(".content-wrapper").height()) {
//        alert("OK");
//    }
});
//$("td input").datepicker({
//        date: "2013-01-01", // set init date
//        format: "y-m-d", // set output format
//        effect: "none", // none, slide, fade
//        position: "bottom", // top or bottom,
//        locale: 'en'
//});