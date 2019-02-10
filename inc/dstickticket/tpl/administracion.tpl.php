<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">ticket</h3>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div id="administrar">
	<p>Seleccione ticket y despu&eacute;s d&eacute; click sobre la acci&oacute;n que desee realizar.</p>
	<table id="tbldatabefff0dbe5aea3c45db0e35f6f5e6b605" data-toggle="table" data-url="/json/dstickticket/?joins=YToxOntpOjA7YTo0OntzOjU6InRhYmxhIjtzOjE1OiJkc3RpY2tfcHJveWVjdG8iO3M6MTA6ImNvbF9vcmlnZW4iO3M6MTA6ImlkUHJveWVjdG8iO3M6MTE6ImNvbF9kZXN0aW5vIjtzOjI6ImlkIjtzOjExOiJjb2xfbW9zdHJhciI7czoyMjoiZHN0aWNrX3Byb3llY3RvLm5vbWJyZSI7fX0=" data-pagination="true"
	   data-method="post" data-side-pagination="server" data-page-list="[5, 10, 20, 50, 100, 200, 300, 400, 500, 1000, 5000, 10000]" data-toolbar="#toolbar-bootstrapTable"
	   data-search="true" data-striped="true" data-height="500" data-cache="true" data-show-refresh="true"
	   data-click-to-select="true" data-select-item-name="id" data-show-toggle="true" data-show-columns="true" >
	<thead>
	<tr>
		<th data-field="null" data-radio="true"></th>
		<th data-field="id" data-sortable="true">No</th>
		<th data-field="FKidCategoria" data-sortable="true" data-visible="true">IdCategoria</th>
		<th data-field="FKidPrioridad" data-sortable="true" data-visible="true">IdPrioridad</th>
		<th data-field="FKidVisibilidad" data-sortable="true" data-visible="true">IdVisibilidad</th>
		<th data-field="FKidClienteUsuario" data-sortable="true" data-visible="true">IdClienteUsuario</th>
		<th data-field="FKidAutor" data-sortable="true" data-visible="true">IdAutor</th>
		<th data-field="FKidProyecto" data-sortable="true" data-visible="true">IdProyecto</th>
		<th data-field="titulo" data-sortable="true" data-visible="true">Titulo</th>
		<th data-field="fechaPublicacion" data-sortable="true" data-visible="true">FechaPublicacion</th>
		<th data-field="fechaLimite" data-sortable="true" data-visible="true">FechaLimite</th>
		<th data-field="estado" data-sortable="true" data-visible="true">Estado</th>

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
					<h4 class="modal-title" id="crearLabel">Nuevo ticket</h4>
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
							<label for="txtidCategoria" class="col-sm-2 control-label">IdCategoria</label>
							<div class="col-sm-10">
								<select id="txtidCategoria" name="txtidCategoria" class="form-control" placeholder="idCategoria" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtidPrioridad" class="col-sm-2 control-label">IdPrioridad</label>
							<div class="col-sm-10">
								<select id="txtidPrioridad" name="txtidPrioridad" class="form-control" placeholder="idPrioridad" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtidVisibilidad" class="col-sm-2 control-label">IdVisibilidad</label>
							<div class="col-sm-10">
								<select id="txtidVisibilidad" name="txtidVisibilidad" class="form-control" placeholder="idVisibilidad" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtidClienteUsuario" class="col-sm-2 control-label">IdClienteUsuario</label>
							<div class="col-sm-10">
								<select id="txtidClienteUsuario" name="txtidClienteUsuario" class="form-control" placeholder="idClienteUsuario" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtidAutor" class="col-sm-2 control-label">IdAutor</label>
							<div class="col-sm-10">
								<select id="txtidAutor" name="txtidAutor" class="form-control" placeholder="idAutor" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtidProyecto" class="col-sm-2 control-label">IdProyecto</label>
							<div class="col-sm-10">
								<select id="txtidProyecto" name="txtidProyecto" class="form-control" placeholder="idProyecto" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txttitulo" class="col-sm-2 control-label">Titulo</label>
							<div class="col-sm-10">
								<input id="txttitulo" name="txttitulo" type="text" class="form-control" placeholder="titulo" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtfechaPublicacion" class="col-sm-2 control-label">FechaPublicacion</label>
							<div class="col-sm-10">
								<input id="txtfechaPublicacion" name="txtfechaPublicacion" type="text" class="form-control" placeholder="fechaPublicacion" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtfechaLimite" class="col-sm-2 control-label">FechaLimite</label>
							<div class="col-sm-10">
								<input id="txtfechaLimite" name="txtfechaLimite" type="text" class="form-control" placeholder="fechaLimite" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtestado" class="col-sm-2 control-label">Estado</label>
							<div class="col-sm-10">
								<input id="txtestado" name="txtestado" type="text" class="form-control" placeholder="estado" />
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
					<button type="submit" class="btn btn-primary">Crear ticket</button>
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
					<h4 class="modal-title" id="frmActualizarLabel">Modificar ticket</h4>
				</div>
				<div class="modal-body">
					<div id="camposobjeto" class="form-horizontal" title="Modificar ticket">
						
						<div class="form-group">
							<label for="dtxtidCategoria" class="col-sm-2 control-label">IdCategoria</label>
							<div class="col-sm-10">
								<select id="dtxtidCategoria" type="text" class="form-control" name="txtidCategoria" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtidPrioridad" class="col-sm-2 control-label">IdPrioridad</label>
							<div class="col-sm-10">
								<select id="dtxtidPrioridad" type="text" class="form-control" name="txtidPrioridad" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtidVisibilidad" class="col-sm-2 control-label">IdVisibilidad</label>
							<div class="col-sm-10">
								<select id="dtxtidVisibilidad" type="text" class="form-control" name="txtidVisibilidad" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtidClienteUsuario" class="col-sm-2 control-label">IdClienteUsuario</label>
							<div class="col-sm-10">
								<select id="dtxtidClienteUsuario" type="text" class="form-control" name="txtidClienteUsuario" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtidAutor" class="col-sm-2 control-label">IdAutor</label>
							<div class="col-sm-10">
								<select id="dtxtidAutor" type="text" class="form-control" name="txtidAutor" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtidProyecto" class="col-sm-2 control-label">IdProyecto</label>
							<div class="col-sm-10">
								<select id="dtxtidProyecto" type="text" class="form-control" name="txtidProyecto" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxttitulo" class="col-sm-2 control-label">Titulo</label>
							<div class="col-sm-10">
								<input id="dtxttitulo" type="text" class="form-control" name="txttitulo" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtfechaPublicacion" class="col-sm-2 control-label">FechaPublicacion</label>
							<div class="col-sm-10">
								<input id="dtxtfechaPublicacion" type="text" class="form-control" name="txtfechaPublicacion" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtfechaLimite" class="col-sm-2 control-label">FechaLimite</label>
							<div class="col-sm-10">
								<input id="dtxtfechaLimite" type="text" class="form-control" name="txtfechaLimite" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtestado" class="col-sm-2 control-label">Estado</label>
							<div class="col-sm-10">
								<input id="dtxtestado" type="text" class="form-control" name="txtestado" />
							</div>
						</div>

						<br style="clear:both"/>
						<input type="hidden" name="acc" value="actualizar" />
						<input type="hidden" name="idObjeto" id="idObjeto"/>
					</div>
				</div>
				<div class="modal-footer bg-gray">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="btnActualizar" class="btn btn-primary">Modificar ticket</button>
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
			<p class="modal-title" id="frmEliminarLabel">Eliminar ticket</p>
		  </div>
		  <div class="modal-body">
			<p>&iquest;Est&aacute; seguro que desea eliminar ticket?</p>
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
