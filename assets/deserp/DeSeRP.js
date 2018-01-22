/*
 * DeSeRP
 * 0.1 beta
 *
 * @author Mauricio Vera
 */
function EsNumero(texto){var ValidChars="0123456789.";var EsNumero=true;var Char;for(i=0;i<texto.length&&EsNumero==true;i++){Char=texto.charAt(i);if(ValidChars.indexOf(Char)==-1){EsNumero=false}}return EsNumero}

// Configuraciones de corrección
$.fn.modal.Constructor.prototype.enforceFocus = function () {};

/*
 * Jquery Plugin : Cargador
 * @author Mauricio Vera
 */
(function($){$.fn.extend({cargador:function(){return this.each(function(){$(this).fadeIn().delay(500).fadeOut('slow')})}})})(jQuery);(function($){$.fn.extend({cargar:function(){return this.each(function(){$(this).fadeIn()})}})})(jQuery);

/*
 * Jquery Plugin : Ocultar mensaje
 * @author Mauricio Vera
 */
(function($){$.fn.extend({desplegar:function(vel){return this.each(function(){$(this).fadeIn().delay(500).fadeOut('slow')})}})})(jQuery);

/*!
* screenfull
* v3.3.2 - 2017-10-27
* (c) Sindre Sorhus; MIT License
*/

!function(){"use strict";var a="undefined"!=typeof window&&void 0!==window.document?window.document:{},b="undefined"!=typeof module&&module.exports,c="undefined"!=typeof Element&&"ALLOW_KEYBOARD_INPUT"in Element,d=function(){for(var b,c=[["requestFullscreen","exitFullscreen","fullscreenElement","fullscreenEnabled","fullscreenchange","fullscreenerror"],["webkitRequestFullscreen","webkitExitFullscreen","webkitFullscreenElement","webkitFullscreenEnabled","webkitfullscreenchange","webkitfullscreenerror"],["webkitRequestFullScreen","webkitCancelFullScreen","webkitCurrentFullScreenElement","webkitCancelFullScreen","webkitfullscreenchange","webkitfullscreenerror"],["mozRequestFullScreen","mozCancelFullScreen","mozFullScreenElement","mozFullScreenEnabled","mozfullscreenchange","mozfullscreenerror"],["msRequestFullscreen","msExitFullscreen","msFullscreenElement","msFullscreenEnabled","MSFullscreenChange","MSFullscreenError"]],d=0,e=c.length,f={};d<e;d++)if((b=c[d])&&b[1]in a){for(d=0;d<b.length;d++)f[c[0][d]]=b[d];return f}return!1}(),e={change:d.fullscreenchange,error:d.fullscreenerror},f={request:function(b){var e=d.requestFullscreen;b=b||a.documentElement,/ Version\/5\.1(?:\.\d+)? Safari\//.test(navigator.userAgent)?b[e]():b[e](c&&Element.ALLOW_KEYBOARD_INPUT)},exit:function(){a[d.exitFullscreen]()},toggle:function(a){this.isFullscreen?this.exit():this.request(a)},onchange:function(a){this.on("change",a)},onerror:function(a){this.on("error",a)},on:function(b,c){var d=e[b];d&&a.addEventListener(d,c,!1)},off:function(b,c){var d=e[b];d&&a.removeEventListener(d,c,!1)},raw:d};if(!d)return void(b?module.exports=!1:window.screenfull=!1);Object.defineProperties(f,{isFullscreen:{get:function(){return Boolean(a[d.fullscreenElement])}},element:{enumerable:!0,get:function(){return a[d.fullscreenElement]}},enabled:{enumerable:!0,get:function(){return Boolean(a[d.fullscreenEnabled])}}}),b?module.exports=f:window.screenfull=f}();

/*
 * Jquery Plugin : DeSeRP
 * @author Mauricio Vera
 */
(function($){
 $.fn.extend({
      DeSeRP: function() {
          $("textarea").addClass('ui-state-default ui-corner-all');$("textarea").bind({focusin: function() {$(this).toggleClass('ui-state-focus');},focusout: function() {$(this).toggleClass('ui-state-focus');}});
          $(".btncerrar").click(function(){$(this).parent().parent().slideUp();});
          /*$(".ui-widget-content").addClass("ui-corner-left").addClass("ui-corner-right");*//*$("input[type='text']").css("text-transform","uppercase");*/
          /*$("form").each(function (i) { $(this).validate(); });
          $(".date").datepicker({showOn: 'both',  buttonImage: 'imagenes/calendar16.png', buttonImageOnly: true, changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});var ahora = new Date();
          $(".datetime").dateplustimepicker({ timeText: 'Hora', hourText: 'Horas', minuteText: 'Minutos', timeFormat: 'hh:mm:ss', secondText: 'Segundos', dateFormat: 'yy-mm-dd', showButtonPanel: true, changeMonth: true, changeYear: true, currentText:'Ahora' });*/
          $("body").on("submit", "form", function(){ $(document).scrollTop(0); $(".divcargador").show(); });
          $(".tbldatos").bootstrapTable({
               striped: true, pagination: true, pageSize: 10,
               pageList: [10, 25, 50, 100, 200],
               search: true, showColumns: true, clickToSelect: true
          });
          $(window).resize(function () {
               $('.tbldatos').bootstrapTable('resetView');
          });
          $(".select2").select2({theme: "bootstrap", width: '100%'});

          $(document).scrollTop(0); $("#cargando").height($(window).height()); $("#msgflo").desplegar();$(".divcargador").cargador();$(".btncerrar").click(function(){$(this).parent().parent().slideUp();});
          $("#btnAbrirCerrar").click(function(){if( $(this).hasClass('abierto') ){$(this).removeClass('abierto');$(this).addClass('cerrado');$( "#aside" ).show( "slide", {direction:'left'}, 500);$( "#imgLogo").slideUp();
          $( "#content" ).css("margin", "0");}else{$(this).removeClass('cerrado');$(this).addClass('abierto');$( "#aside" ).hide();$( "#imgLogo" ).slideDown();$( "#content" ).css("margin", "0px 0px 0px 20px");}});

          $('#btnToggleFullscreen').on('click', event => {
          	if (screenfull.enabled) {
          		screenfull.toggle();
          	}
          });

          $.ajaxSetup({ type: "POST" });
          return true;
      }
 });
})(jQuery);

function actualizarSesion(){
    $.ajax({ url: "/wsdl/principal/sesion/", cache: false, dataType:"json" }).done(function( data ) {
        try {
            if(data.ack == 200){
                $( "#sesion" ).html( '<a href="#Conectado" title="Ultima actualización: '+ data.ultimaActualizacion +'"><i class="fa fa-circle text-success"></i> Conectado</a>' );
            }else{
                $( "#sesion" ).html( '<a target="_blank" href="/" title="De click aquí para actualizar" class="animated flash infinite"><i class="fa fa-circle text-danger"></i> Desconectado</a>' );
            }
        } catch(e) {
           $( "#sesion" ).html( '<a target="_blank" href="/" title="De click aquí para actualizar" class="animated flash infinite"><i class="fa fa-circle text-danger"></i> Desconectado</a>' );
        }
            setTimeout(function(){ actualizarSesion(); }, 60000);
    });
}
setTimeout(function(){ actualizarSesion(); }, 10000);
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-9173022-6', 'auto'); ga('send', 'pageview');
