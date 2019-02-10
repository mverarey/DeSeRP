<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">contenido</h3>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div id="administrar">
	<p>Seleccione contenido y despu&eacute;s d&eacute; click sobre la acci&oacute;n que desee realizar.</p>
	<table id="tbldatab3863efa5ed398ec30b809414819a3127" data-toggle="table" data-url="/json/dstickticketcontenido/?joins=YToxOntpOjA7YTo0OntzOjU6InRhYmxhIjtzOjg6InVzdWFyaW9zIjtzOjEwOiJjb2xfb3JpZ2VuIjtzOjk6ImlkVXN1YXJpbyI7czoxMToiY29sX2Rlc3Rpbm8iO3M6MjoiaWQiO3M6MTE6ImNvbF9tb3N0cmFyIjtzOjE1OiJ1c3Vhcmlvcy5ub21icmUiO319" data-pagination="true"
	   data-method="post" data-side-pagination="server" data-page-list="[5, 10, 20, 50, 100, 200, 300, 400, 500, 1000, 5000, 10000]" data-toolbar="#toolbar-bootstrapTable"
	   data-search="true" data-striped="true" data-height="500" data-cache="true" data-show-refresh="true"
	   data-click-to-select="true" data-select-item-name="id" data-show-toggle="true" data-show-columns="true" >
	<thead>
	<tr>
		<th data-field="null" data-radio="true"></th>
		<th data-field="id" data-sortable="true">No</th>
		<th data-field="FKidTicket" data-sortable="true" data-visible="true">IdTicket</th>
		<th data-field="FKidUsuario" data-sortable="true" data-visible="true">IdUsuario</th>
		<th data-field="contenido" data-sortable="true" data-visible="true">Contenido</th>
		<th data-field="fechaPublicacion" data-sortable="true" data-visible="true">FechaPublicacion</th>
		<th data-field="adjuntos" data-sortable="true" data-visible="true">Adjuntos</th>

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
					<h4 class="modal-title" id="crearLabel">Nuevo contenido</h4>
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
							<label for="txtidTicket" class="col-sm-2 control-label">IdTicket</label>
							<div class="col-sm-10">
								<select id="txtidTicket" name="txtidTicket" class="form-control" placeholder="idTicket" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtidUsuario" class="col-sm-2 control-label">IdUsuario</label>
							<div class="col-sm-10">
								<select id="txtidUsuario" name="txtidUsuario" class="form-control" placeholder="idUsuario" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtcontenido" class="col-sm-2 control-label">Contenido</label>
							<div class="col-sm-10">
								<input id="txtcontenido" name="txtcontenido" type="text" class="form-control" placeholder="contenido" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtfechaPublicacion" class="col-sm-2 control-label">FechaPublicacion</label>
							<div class="col-sm-10">
								<input id="txtfechaPublicacion" name="txtfechaPublicacion" type="text" class="form-control" placeholder="fechaPublicacion" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtadjuntos" class="col-sm-2 control-label">Adjuntos</label>
							<div class="col-sm-10">
								<input id="txtadjuntos" name="txtadjuntos" type="text" class="form-control" placeholder="adjuntos" />
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
					<button type="submit" class="btn btn-primary">Crear contenido</button>
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
					<h4 class="modal-title" id="frmActualizarLabel">Modificar contenido</h4>
				</div>
				<div class="modal-body">
					<div id="camposobjeto" class="form-horizontal" title="Modificar contenido">
						
						<div class="form-group">
							<label for="dtxtidTicket" class="col-sm-2 control-label">IdTicket</label>
							<div class="col-sm-10">
								<select id="dtxtidTicket" type="text" class="form-control" name="txtidTicket" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtidUsuario" class="col-sm-2 control-label">IdUsuario</label>
							<div class="col-sm-10">
								<select id="dtxtidUsuario" type="text" class="form-control" name="txtidUsuario" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtcontenido" class="col-sm-2 control-label">Contenido</label>
							<div class="col-sm-10">
								<input id="dtxtcontenido" type="text" class="form-control" name="txtcontenido" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtfechaPublicacion" class="col-sm-2 control-label">FechaPublicacion</label>
							<div class="col-sm-10">
								<input id="dtxtfechaPublicacion" type="text" class="form-control" name="txtfechaPublicacion" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtadjuntos" class="col-sm-2 control-label">Adjuntos</label>
							<div class="col-sm-10">
								<input id="dtxtadjuntos" type="text" class="form-control" name="txtadjuntos" />
							</div>
						</div>

						<br style="clear:both"/>
						<input type="hidden" name="acc" value="actualizar" />
						<input type="hidden" name="idObjeto" id="idObjeto"/>
					</div>
				</div>
				<div class="modal-footer bg-gray">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="btnActualizar" class="btn btn-primary">Modificar contenido</button>
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
			<p class="modal-title" id="frmEliminarLabel">Eliminar contenido</p>
		  </div>
		  <div class="modal-body">
			<p>&iquest;Est&aacute; seguro que desea eliminar contenido?</p>
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
