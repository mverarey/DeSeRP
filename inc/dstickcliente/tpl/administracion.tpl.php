<script>
function logotipo(v,r){
	if(v.length > 0){
		return "<img src='" + v + "' class='img-responsive vcenter center-block' style='max-height:50px' />";
	}else{
		return "";
	}
}

function empresa(v,r){
	return '<div class="container-fluid"><div class="row">\
		<div class="col-md-2">' + logotipo(r.logotipo, r) + '</div>\
		<div class="col-md-7"><h2>' + r.nombre + '</h2><br/>' + r.razonSocial + '</div>\
		<div class="col-md-3"><a class="btn btn-block btn-primary vcenter" href="/app/dstickcliente/usuarios/'+ r.id +'" >' + r.id + ' usuarios</a></div>\
	</div></div>';

}

function usuarios(v,r){
	return "";
}
</script>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">cliente</h3>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div id="administrar">
	<p>Seleccione cliente y despu&eacute;s d&eacute; click sobre la acci&oacute;n que desee realizar.</p>
	<table id="tbldatabcf44986c63bd375c5b2e2d4baf6f551e" data-toggle="table" data-url="/json/dstickcliente/?joins=" data-pagination="true"
	   data-method="post" data-side-pagination="server" data-page-list="[5, 10, 20, 50, 100, 200, 300, 400, 500, 1000, 5000, 10000]" data-toolbar="#toolbar-bootstrapTable"
	   data-search="true" data-striped="true" data-height="500" data-cache="true" data-show-refresh="true"
	   data-click-to-select="true" data-select-item-name="id" data-show-toggle="true" data-show-columns="true" >
	<thead>
	<tr>
		<th data-field="null" data-radio="true"></th>
		<th data-field="id" data-sortable="true">No</th>
		<th data-field="empresa" data-sortable="true" data-visible="true" data-formatter="empresa">Cliente</th>
	</tr>
	</thead>
	</table>
	<div id="toolbar-bootstrapTable" class="btn-group">
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#crear"><i class="fa fa-plus"></i> Nuevo registro</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmActualizar"><i class="fa fa-pencil"></i> Modificar</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmEliminar"><i class="fa fa-trash"></i> Eliminar</button>
		
	</div>
    </div>

  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

<div class="modal fade" id="crear" role="dialog" aria-labelledby="crearLabel">
	<form method="post">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-light-blue">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="crearLabel">Nuevo cliente</h4>
				</div>
				<div class="modal-body">
					<div class="col-xs-12 caja_mediana">
						<h2>Instrucciones</h2>
						<ul class="nostyle">
							<li>* Campos requeridos</li>
						</ul>
					</div>
					<div class="col-xs-12">
						<div class="form-horizontal">
							
						<div class="form-group">
							<label for="txtnombre" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-10">
								<input id="txtnombre" name="txtnombre" type="text" class="form-control" placeholder="nombre" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtrazonSocial" class="col-sm-2 control-label">RazonSocial</label>
							<div class="col-sm-10">
								<input id="txtrazonSocial" name="txtrazonSocial" type="text" class="form-control" placeholder="razonSocial" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtlogotipo" class="col-sm-2 control-label">Logotipo</label>
							<div class="col-sm-10">
								{@pag->txtlogotipo}
							</div>
						</div>

						</div>
						<br style="clear:both;"/>
						<input type="hidden" name="acc" value="crear" />
					</div>

					<br style="clear:both" />
				</div>
				<div class="modal-footer bg-gray">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Crear cliente</button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="frmActualizar" role="dialog" aria-labelledby="frmActualizarLabel">
	<form method="post">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-light-blue">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="frmActualizarLabel">Modificar cliente</h4>
				</div>
				<div class="modal-body">
					<div id="camposobjeto" class="form-horizontal" title="Modificar cliente">
						
						<div class="form-group">
							<label for="dtxtnombre" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-10">
								<input id="dtxtnombre" type="text" class="form-control" name="txtnombre" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtrazonSocial" class="col-sm-2 control-label">RazonSocial</label>
							<div class="col-sm-10">
								<input id="dtxtrazonSocial" type="text" class="form-control" name="txtrazonSocial" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtlogotipo" class="col-sm-2 control-label">Logotipo</label>
							<div class="col-sm-10">
								<input id="dtxtlogotipo" type="text" class="form-control" name="txtlogotipo" />
							</div>
						</div>

						<br style="clear:both"/>
						<input type="hidden" name="acc" value="actualizar" />
						<input type="hidden" name="idObjeto" id="idObjeto"/>
					</div>
				</div>
				<div class="modal-footer bg-gray">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="btnActualizar" class="btn btn-primary">Modificar cliente</button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="frmEliminar" tabindex="-1" role="dialog" aria-labelledby="frmEliminarLabel">
  <form method="post">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header bg-light-blue">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<p class="modal-title" id="frmEliminarLabel">Eliminar cliente</p>
		  </div>
		  <div class="modal-body">
			<p>&iquest;Est&aacute; seguro que desea eliminar cliente?</p>
			<input type="hidden" name="acc" value="eliminar" />
			<input type="hidden" name="idObjeto" id="eidObjeto"/>
		  </div>
		  <div class="modal-footer bg-gray">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="button" id="btnEliminar" class="btn btn-primary">Eliminar</button>
		  </div>
		</div>
	  </div>
  </form>
</div>
