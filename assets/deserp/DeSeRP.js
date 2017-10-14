/*
 * DeSeRP
 * 0.1 beta
 *
 * @author Mauricio Vera
 */  
function EsNumero(texto){var ValidChars="0123456789.";var EsNumero=true;var Char;for(i=0;i<texto.length&&EsNumero==true;i++){Char=texto.charAt(i);if(ValidChars.indexOf(Char)==-1){EsNumero=false}}return EsNumero}

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

/*
 * Jquery Plugin : DeSeRP
 * @author Mauricio Vera
 */
(function($){  
 $.fn.extend({   
      DeSeRP: function() { 
          $("textarea").addClass('ui-state-default ui-corner-all');$("textarea").bind({focusin: function() {$(this).toggleClass('ui-state-focus');},focusout: function() {$(this).toggleClass('ui-state-focus');}});
          $(".btncerrar").click(function(){$(this).parent().parent().slideUp();});$("input[type='submit']").addClass("ui-button");$("input[type='button']").addClass("ui-button");$("input[type='reset']").addClass("ui-button");

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
          
          $(document).scrollTop(0); $("#cargando").height($(window).height()); $("#msgflo").desplegar();$(".divcargador").cargador();$(".btncerrar").click(function(){$(this).parent().parent().slideUp();});
          $("#btnAbrirCerrar").click(function(){if( $(this).hasClass('abierto') ){$(this).removeClass('abierto');$(this).addClass('cerrado');$( "#aside" ).show( "slide", {direction:'left'}, 500);$( "#imgLogo").slideUp();
          $( "#content" ).css("margin", "0");}else{$(this).removeClass('cerrado');$(this).addClass('abierto');$( "#aside" ).hide();$( "#imgLogo" ).slideDown();$( "#content" ).css("margin", "0px 0px 0px 20px");}});
          return true;  
      }
 });     
})(jQuery);

function actualizarSesion(){
    $.ajax({ url: "/wsdl/principal/sesion", cache: false, dataType:"json" }).done(function( data ) {
        try {
            $.parseJSON(data);
            if(data.ack == 200){
                $( "#sesion" ).html( data.ultimaActualizacion );
            }else{
                $( "#sesion" ).html( "<a target='_blank' href='/' class='btn btn-danger'>Debe actualizar su sesi&oacute;n antes de realizar cualquier solicitud</a>" );
            }
        } catch(e) {
           $( "#sesion" ).html( "<a target='_blank' href='/' class='btn btn-danger'>Debe actualizar su sesi&oacute;n antes de realizar cualquier solicitud</a>" );
        }
            setTimeout(function(){ actualizarSesion(); }, 60000);
    });
}
setTimeout(function(){ actualizarSesion(); }, 10000);
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-9173022-6', 'auto'); ga('send', 'pageview');