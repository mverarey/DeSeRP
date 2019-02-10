<?
$this->establecerTitulo("Administrador de tickets");

$bd = new DepotServer\BaseDatos();
switch( $_REQUEST['acc'] ){
	case "crear":
		$res = $bd::table("dstick_ticket")->insertGetId([ 'idCategoria' => $_REQUEST['txtidCategoria'], 'idPrioridad' => $_REQUEST['txtidPrioridad'], 'idVisibilidad' => $_REQUEST['txtidVisibilidad'], 'idClienteUsuario' => $_REQUEST['txtidClienteUsuario'], 'idAutor' => $_REQUEST['txtidAutor'], 'idProyecto' => $_REQUEST['txtidProyecto'], 'titulo' => $_REQUEST['txttitulo'], 'fechaPublicacion' => $_REQUEST['txtfechaPublicacion'], 'fechaLimite' => $_REQUEST['txtfechaLimite'], 'estado' => $_REQUEST['txtestado'],  ]);
		if($res){
			echo $this->msgOK("Se registro el ticket correctamente con el id ".$res.".");
		}else{
			echo $this->msgError("Ocurri&oacute; un error, intentelo nuevamente.");
		}
	break;
}

$script = <<<EOM
	$('#tbldatabefff0dbe5aea3c45db0e35f6f5e6b605').bootstrapTable( 'resetView' , {height: $( document ).height() - 120 } );

	$('#frmActualizar').on('show.bs.modal', function (event) {    $("#cargando").show();    $("#cargandodiv").show(); $('#frmActualizar form')[0].reset(); var ids = $.map($("#tbldatabefff0dbe5aea3c45db0e35f6f5e6b605").bootstrapTable('getSelections'), function (row) {	return row.id });    var opc=ids[0];     if(opc>0){	$.ajax({ method: 'POST', dataType:'json', url: '/json/{$this->os(2)}/obtenerobjetos/'+opc }).done(function( wsdl ) { var data = wsdl['rows'][0]; $("#cargando").hide(); $("#cargandodiv").hide(); 	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_0/'+ data.idAutor }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidAutor').append(option).trigger('change'); $('#dtxtidAutor').trigger({ type: 'select2:select', params: { data: data } }); });	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_1/'+ data.idCategoria }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidCategoria').append(option).trigger('change'); $('#dtxtidCategoria').trigger({ type: 'select2:select', params: { data: data } }); });	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_2/'+ data.idPrioridad }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidPrioridad').append(option).trigger('change'); $('#dtxtidPrioridad').trigger({ type: 'select2:select', params: { data: data } }); });	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_3/'+ data.idVisibilidad }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidVisibilidad').append(option).trigger('change'); $('#dtxtidVisibilidad').trigger({ type: 'select2:select', params: { data: data } }); });	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_4/'+ data.idClienteUsuario }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidClienteUsuario').append(option).trigger('change'); $('#dtxtidClienteUsuario').trigger({ type: 'select2:select', params: { data: data } }); });	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_5/'+ data.idProyecto }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidProyecto').append(option).trigger('change'); $('#dtxtidProyecto').trigger({ type: 'select2:select', params: { data: data } }); }); $("#idObjeto").val(data.id); 
 $("#dtxttitulo").val(data.titulo);  $("#dtxtfechaPublicacion").val(data.fechaPublicacion);  $("#dtxtfechaLimite").val(data.fechaLimite);  $("#dtxtestado").val(data.estado);  });  }else{ 	alert("Debe seleccionar ticket primero.");	$("#cargando").hide(); $("#cargandodiv").hide(); return false; } });
	$("#btnActualizar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {}; var nombres = ["idCategoria","idPrioridad","idVisibilidad","idClienteUsuario","idAutor","idProyecto","titulo","fechaPublicacion","fechaLimite","estado"]; var campos = ["dtxtidCategoria","dtxtidPrioridad","dtxtidVisibilidad","dtxtidClienteUsuario","dtxtidAutor","dtxtidProyecto","dtxttitulo","dtxtfechaPublicacion","dtxtfechaLimite","dtxtestado"];  jQuery.each( campos, function( i , campo){ valores[nombres[i]] = $("#"+campo).val(); }); valores["idObjeto"] = $("#idObjeto").val(); valores["acc"] = "actualizar"; $.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success");$("#tbldatabefff0dbe5aea3c45db0e35f6f5e6b605").bootstrapTable('refresh'); $('#frmActualizar').modal('hide'); }else if(data.ack == 201){ $.notify(data.msg, "warn"); }else{ $.notify(data.msg, "error"); } }).fail(function() { alert( "error" ); $.notify(data.msg, "success"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide(); });
	});
	$("#frmActualizar input").keypress( function( event ) { if ( event.which === 13 ) { event.preventDefault(); $("#btnActualizar").click(); return false; } });

	$("#btnEliminar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {"idObjeto": $("#eidObjeto").val(), "acc": "eliminar" };
		$.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success"); $("#tbldatabefff0dbe5aea3c45db0e35f6f5e6b605").bootstrapTable('refresh'); $('#frmEliminar').addClass("animated hinge").modal('hide').removeClass("animated hinge"); }else{ $.notify(data.msg, "error"); } }).fail(function() { $.notify(data.msg, "error"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide();  });
	});
	$("#frmEliminar").on('show.bs.modal', function (event) {	var ids = $.map($("#tbldatabefff0dbe5aea3c45db0e35f6f5e6b605").bootstrapTable('getSelections'), function (row) { return row.id }); 		var opc=ids[0]; 		if(opc>0){ 			$("#eidObjeto").val(opc);		}else{		alert("Debe seleccionar ticket primero."); 			return false;		}	});

	$("#dtxtidAutor,#txtidAutor").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_0" }; return query; } }, language: "es" });	$("#dtxtidCategoria,#txtidCategoria").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_1" }; return query; } }, language: "es" });	$("#dtxtidPrioridad,#txtidPrioridad").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_2" }; return query; } }, language: "es" });	$("#dtxtidVisibilidad,#txtidVisibilidad").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_3" }; return query; } }, language: "es" });	$("#dtxtidClienteUsuario,#txtidClienteUsuario").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_4" }; return query; } }, language: "es" });	$("#dtxtidProyecto,#txtidProyecto").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_5" }; return query; } }, language: "es" });

EOM;
$this->agregarScript($script);
?>
