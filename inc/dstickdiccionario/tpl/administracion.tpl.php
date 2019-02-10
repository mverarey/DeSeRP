<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">definicion</h3>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div id="administrar">
	<p>Seleccione definicion y despu&eacute;s d&eacute; click sobre la acci&oacute;n que desee realizar.</p>
	<table id="tbldatab29669ff055f1f92544a978930d2561bc" data-toggle="table" data-url="/json/dstick_diccionario/?joins=" data-pagination="true"
	   data-method="post" data-side-pagination="server" data-page-list="[5, 10, 20, 50, 100, 200, 300, 400, 500, 1000, 5000, 10000]" data-toolbar="#toolbar-bootstrapTable"
	   data-search="true" data-striped="true" data-height="500" data-cache="true" data-show-refresh="true"
	   data-click-to-select="true" data-select-item-name="id" data-show-toggle="true" data-show-columns="true" >
	<thead>
	<tr>
		<th data-field="null" data-radio="true"></th>
		<th data-field="id" data-sortable="true">No</th>
		<th data-field="FKdiccionario" data-sortable="true" data-visible="true">Diccionario</th>
		<th data-field="titulo" data-sortable="true" data-visible="true">Titulo</th>

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
					<h4 class="modal-title" id="crearLabel">Nuevo definicion</h4>
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
							<label for="txtdiccionario" class="col-sm-2 control-label">Diccionario</label>
							<div class="col-sm-10">
								<select id="txtdiccionario" name="txtdiccionario" class="form-control" placeholder="diccionario" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="txttitulo" class="col-sm-2 control-label">Titulo</label>
							<div class="col-sm-10">
								<input id="txttitulo" name="txttitulo" type="text" class="form-control" placeholder="titulo" />
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
					<button type="submit" class="btn btn-primary">Crear definicion</button>
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
					<h4 class="modal-title" id="frmActualizarLabel">Modificar definicion</h4>
				</div>
				<div class="modal-body">
					<div id="camposobjeto" class="form-horizontal" title="Modificar definicion">
						
						<div class="form-group">
							<label for="dtxtdiccionario" class="col-sm-2 control-label">Diccionario</label>
							<div class="col-sm-10">
								<select id="dtxtdiccionario" type="text" class="form-control" name="txtdiccionario" style="width:100%"></select>
							</div>
						</div>

						<div class="form-group">
							<label for="dtxttitulo" class="col-sm-2 control-label">Titulo</label>
							<div class="col-sm-10">
								<input id="dtxttitulo" type="text" class="form-control" name="txttitulo" />
							</div>
						</div>

						<br style="clear:both"/>
						<input type="hidden" name="acc" value="actualizar" />
						<input type="hidden" name="idObjeto" id="idObjeto"/>
					</div>
				</div>
				<div class="modal-footer bg-gray">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="btnActualizar" class="btn btn-primary">Modificar definicion</button>
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
			<p class="modal-title" id="frmEliminarLabel">Eliminar definicion</p>
		  </div>
		  <div class="modal-body">
			<p>&iquest;Est&aacute; seguro que desea eliminar definicion?</p>
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
