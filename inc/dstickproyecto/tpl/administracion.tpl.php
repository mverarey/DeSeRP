<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">proyecto</h3>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div id="administrar">
	<p>Seleccione proyecto y despu&eacute;s d&eacute; click sobre la acci&oacute;n que desee realizar.</p>
	<table id="tbldatab0d48d5325dfbacbe15be19c115a681d8" data-toggle="table" data-url="/json/dstick_proyecto/?joins=YToxOntpOjA7YTo0OntzOjU6InRhYmxhIjtzOjg6InVzdWFyaW9zIjtzOjEwOiJjb2xfb3JpZ2VuIjtzOjE1OiJpZExpZGVyUHJveWVjdG8iO3M6MTE6ImNvbF9kZXN0aW5vIjtzOjI6ImlkIjtzOjExOiJjb2xfbW9zdHJhciI7czoxNToidXN1YXJpb3Mubm9tYnJlIjt9fQ==" data-pagination="true"
	   data-method="post" data-side-pagination="server" data-page-list="[5, 10, 20, 50, 100, 200, 300, 400, 500, 1000, 5000, 10000]" data-toolbar="#toolbar-bootstrapTable"
	   data-search="true" data-striped="true" data-height="500" data-cache="true" data-show-refresh="true"
	   data-click-to-select="true" data-select-item-name="id" data-show-toggle="true" data-show-columns="true" >
	<thead>
	<tr>
		<th data-field="null" data-radio="true"></th>
		<th data-field="id" data-sortable="true">No</th>
		<th data-field="FKidLiderProyecto" data-sortable="true" data-visible="true">IdLiderProyecto</th>
		<th data-field="FKidCategoria" data-sortable="true" data-visible="true">IdCategoria</th>
		<th data-field="FKidCliente" data-sortable="true" data-visible="true">IdCliente</th>
		<th data-field="nombre" data-sortable="true" data-visible="true">Nombre</th>
		<th data-field="descripcion" data-sortable="true" data-visible="true">Descripcion</th>
		<th data-field="fechaCreacion" data-sortable="true" data-visible="true">FechaCreacion</th>
		<th data-field="fechaInicio" data-sortable="true" data-visible="true">FechaInicio</th>
		<th data-field="fechaFin" data-sortable="true" data-visible="true">FechaFin</th>
		<th data-field="estado" data-sortable="true" data-visible="true">Estado</th>

	</tr>
	</thead>
	</table>
	<div id="toolbar-bootstrapTable" class="btn-group">
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#crear"><i class="fa fa-plus"></i> Nuevo registro</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmActualizar"><i class="fa fa-pencil"></i> Modificar</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmEliminar"><i class="fa fa-trash"></i> Eliminar</button>
		<a href='/xlsx/dstick_proyecto/?joins=YToxOntpOjA7YTo0OntzOjU6InRhYmxhIjtzOjg6InVzdWFyaW9zIjtzOjEwOiJjb2xfb3JpZ2VuIjtzOjE1OiJpZExpZGVyUHJveWVjdG8iO3M6MTE6ImNvbF9kZXN0aW5vIjtzOjI6ImlkIjtzOjExOiJjb2xfbW9zdHJhciI7czoxNToidXN1YXJpb3Mubm9tYnJlIjt9fQ==' class='btn btn-default'><i class='fa fa-download'></i> Exportar</a>
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
					<h4 class="modal-title" id="crearLabel">Nuevo proyecto</h4>
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
							<label for="txtidLiderProyecto" class="col-sm-2 control-label">IdLiderProyecto</label>
							<div class="col-sm-10">
								<select id="txtidLiderProyecto" name="txtidLiderProyecto" class="form-control" placeholder="idLiderProyecto" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtidCategoria" class="col-sm-2 control-label">IdCategoria</label>
							<div class="col-sm-10">
								<select id="txtidCategoria" name="txtidCategoria" class="form-control" placeholder="idCategoria" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtidCliente" class="col-sm-2 control-label">IdCliente</label>
							<div class="col-sm-10">
								<select id="txtidCliente" name="txtidCliente" class="form-control" placeholder="idCliente" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txtnombre" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-10">
								<input id="txtnombre" name="txtnombre" type="text" class="form-control" placeholder="nombre" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtdescripcion" class="col-sm-2 control-label">Descripcion</label>
							<div class="col-sm-10">
								<input id="txtdescripcion" name="txtdescripcion" type="text" class="form-control" placeholder="descripcion" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtfechaCreacion" class="col-sm-2 control-label">FechaCreacion</label>
							<div class="col-sm-10">
								<input id="txtfechaCreacion" name="txtfechaCreacion" type="text" class="form-control" placeholder="fechaCreacion" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtfechaInicio" class="col-sm-2 control-label">FechaInicio</label>
							<div class="col-sm-10">
								<input id="txtfechaInicio" name="txtfechaInicio" type="text" class="form-control" placeholder="fechaInicio" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtfechaFin" class="col-sm-2 control-label">FechaFin</label>
							<div class="col-sm-10">
								<input id="txtfechaFin" name="txtfechaFin" type="text" class="form-control" placeholder="fechaFin" />
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
					<button type="submit" class="btn btn-primary">Crear proyecto</button>
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
					<h4 class="modal-title" id="frmActualizarLabel">Modificar proyecto</h4>
				</div>
				<div class="modal-body">
					<div id="camposobjeto" class="form-horizontal" title="Modificar proyecto">
						
						<div class="form-group">
							<label for="dtxtidLiderProyecto" class="col-sm-2 control-label">IdLiderProyecto</label>
							<div class="col-sm-10">
								<select id="dtxtidLiderProyecto" type="text" class="form-control" name="txtidLiderProyecto" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtidCategoria" class="col-sm-2 control-label">IdCategoria</label>
							<div class="col-sm-10">
								<select id="dtxtidCategoria" type="text" class="form-control" name="txtidCategoria" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtidCliente" class="col-sm-2 control-label">IdCliente</label>
							<div class="col-sm-10">
								<select id="dtxtidCliente" type="text" class="form-control" name="txtidCliente" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtnombre" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-10">
								<input id="dtxtnombre" type="text" class="form-control" name="txtnombre" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtdescripcion" class="col-sm-2 control-label">Descripcion</label>
							<div class="col-sm-10">
								<input id="dtxtdescripcion" type="text" class="form-control" name="txtdescripcion" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtfechaCreacion" class="col-sm-2 control-label">FechaCreacion</label>
							<div class="col-sm-10">
								<input id="dtxtfechaCreacion" type="text" class="form-control" name="txtfechaCreacion" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtfechaInicio" class="col-sm-2 control-label">FechaInicio</label>
							<div class="col-sm-10">
								<input id="dtxtfechaInicio" type="text" class="form-control" name="txtfechaInicio" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtfechaFin" class="col-sm-2 control-label">FechaFin</label>
							<div class="col-sm-10">
								<input id="dtxtfechaFin" type="text" class="form-control" name="txtfechaFin" />
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
					<button type="button" id="btnActualizar" class="btn btn-primary">Modificar proyecto</button>
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
			<p class="modal-title" id="frmEliminarLabel">Eliminar proyecto</p>
		  </div>
		  <div class="modal-body">
			<p>&iquest;Est&aacute; seguro que desea eliminar proyecto?</p>
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
