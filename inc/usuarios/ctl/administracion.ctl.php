<?
$this->establecerTitulo("Administrador de usuarios");

$bd = new DepotServer\BaseDatos();
switch( $_REQUEST['acc'] ){
	case "crear":
		$res = $bd::table("usuarios")->insertGetId([ 'usuario' => strtoupper($_REQUEST['txtusuario']), 'password' => md5($_REQUEST['txtpassword']), 'nombre' => $_REQUEST['txtnombre'], 'email' => $_REQUEST['txtemail'], 'servidorSMTP' => $_REQUEST['txtservidorSMTP'], 'passwordSMTP' => $_REQUEST['txtpasswordSMTP'], 'tema' => $_REQUEST['txttema'], 'fecha_creacion' => date("Y-m-d H:i:s"), 'activo' => 1  ]);
		if($res){
			echo $this->msgOK("Se registro el usuario correctamente con el id ".$res.".");
			header("Location: /app/permisos/modificar/".$res );
		}else{
			echo $this->msgError("Ocurri&oacute; un error, intentelo nuevamente.");
		}
	break;
}

$script = <<<EOM
	$('#tbldatab03f996214fba4a1d05a68b18fece8e71').bootstrapTable( 'resetView' , {height: $( document ).height() - 120 } );

	$('#frmActualizar').on('show.bs.modal', function (event) {    $("#cargando").show(); $("#cargandodiv").show(); $('#frmActualizar form')[0].reset(); var ids = $.map($("#tbldatab03f996214fba4a1d05a68b18fece8e71").bootstrapTable('getSelections'), function (row) {	return row.id });    var opc=ids[0];     if(opc>0){	$.ajax({ method: 'POST', dataType:'json', url: '/wsdl/{$this->os(2)}/obtenerobjetos/'+opc }).done(function( data ) { $("#cargando").hide(); $("#cargandodiv").hide();  $("#idObjeto").val(data.id);
     $("#dtxtnombre").val(data.nombre); $("#dtxtusuario").val(data.usuario);  $("#dtxtemail").val(data.email);  $("#dtxtservidorSMTP").val(data.servidorSMTP);  $("#dtxtpasswordSMTP").val(data.passwordSMTP);  $("#dtxttema").val(data.tema); });  }else{ 	alert("Debe seleccionar usuario primero.");	$("#cargando").hide(); $("#cargandodiv").hide(); return false; } });

		 /* $("#dtxtpassword").val(data.password); */
	$("#btnActualizar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {}; var nombres = ["password","nombre","email","servidorSMTP","passwordSMTP","tema"]; var campos = ["dtxtpassword","dtxtnombre","dtxtemail","dtxtservidorSMTP","dtxtpasswordSMTP","dtxttema"];  jQuery.each( campos, function( i , campo){ valores[nombres[i]] = $("#"+campo).val(); }); valores["idObjeto"] = $("#idObjeto").val(); valores["acc"] = "actualizar"; $.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success");$("#tbldatab03f996214fba4a1d05a68b18fece8e71").bootstrapTable('refresh'); $('#frmActualizar').modal('hide'); }else if(data.ack == 201){ $.notify(data.msg, "warn"); }else{ $.notify(data.msg, "error"); } }).fail(function() { alert( "error" ); $.notify(data.msg, "success"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide(); });
	});
	$("#frmActualizar input").keypress( function( event ) { if ( event.which === 13 ) { event.preventDefault(); $("#btnActualizar").click(); return false; } });

	$("#btnEliminar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {"idObjeto": $("#eidObjeto").val(), "acc": "eliminar" };
		$.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success"); $("#tbldatab03f996214fba4a1d05a68b18fece8e71").bootstrapTable('refresh'); $('#frmEliminar').addClass("animated hinge").modal('hide').removeClass("animated hinge");
		}else{ $.notify(data.msg, "error"); } }).fail(function() { $.notify(data.msg, "error"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide();  });
	});
	$("#frmEliminar").on('show.bs.modal', function (event) {	var ids = $.map($("#tbldatab03f996214fba4a1d05a68b18fece8e71").bootstrapTable('getSelections'), function (row) { return row.id }); 		var opc=ids[0]; 		if(opc>0){ 			$("#eidObjeto").val(opc);		}else{		alert("Debe seleccionar usuario primero."); 			return false;		}	});



EOM;
$this->agregarScript($script);
?>
