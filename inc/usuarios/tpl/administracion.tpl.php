<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">usuario</h3>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body with-border">

    <div id="administrar">
	<p>Seleccione usuario y despu&eacute;s d&eacute; click sobre la acci&oacute;n que desee realizar.</p>
	<table id="tbldatab03f996214fba4a1d05a68b18fece8e71" data-toggle="table" data-url="/wsdl/usuarios/obtenertabla" data-pagination="true"
	   data-method="post" data-side-pagination="server" data-page-list="[5, 10, 20, 50, 100, 200, 300, 400, 500, 1000, 5000, 10000]" data-toolbar="#toolbar-bootstrapTable"
	   data-search="true" data-striped="true" data-height="500" data-cache="true" data-show-refresh="true"
	   data-click-to-select="true" data-select-item-name="id" data-show-toggle="true" data-show-columns="true" >
	<thead>
	<tr>
		<th data-field="null" data-radio="true"></th>
		<th data-field="id" data-sortable="true">No</th>
		<th data-field="usuario" data-sortable="true" data-visible="true">Usuario</th>
		<th data-field="nombre" data-sortable="true" data-visible="true">Nombre</th>
		<th data-field="email" data-sortable="true" data-visible="true">Email</th>
		<th data-field="servidorSMTP" data-sortable="true" data-visible="false">ServidorSMTP</th>
		<th data-field="tema" data-sortable="true" data-visible="false">Tema</th>
		<th data-field="fecha_creacion" data-sortable="true" data-visible="false">Fecha de creación</th>
		<th data-field="activo" data-sortable="true" data-visible="true">Activo</th>

	</tr>
	</thead>
	</table>
	<div id="toolbar-bootstrapTable" class="btn-group">
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#crear"><i class="fa fa-plus"></i> Nuevo registro</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmActualizar"><i class="fa fa-pencil"></i> Modificar</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmEliminar"><i class="fa fa-trash"></i> Cambiar estado</button>

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
					<h4 class="modal-title" id="crearLabel">Nuevo usuario</h4>
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
              <h2>Datos de acceso</h2>
            </div>

						<div class="form-group">
							<label for="txtusuario" class="col-sm-2 control-label">Usuario</label>
							<div class="col-sm-10">
								<input id="txtusuario" name="txtusuario" type="text" class="form-control" placeholder="usuario" maxlength="10" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtpassword" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input id="txtpassword" name="txtpassword" type="password" class="form-control" placeholder="password" />
							</div>
						</div>

            <div class="form-group">
							<h2>Datos generales</h2>
						</div>

						<div class="form-group">
							<label for="txtnombre" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-10">
								<input id="txtnombre" name="txtnombre" type="text" class="form-control" placeholder="nombre" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtemail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input id="txtemail" name="txtemail" type="text" class="form-control" placeholder="email" />
							</div>
						</div>

            <div class="form-group">
							<h2>Servidor SMTP</h2>
						</div>

						<div class="form-group">
							<label for="txtservidorSMTP" class="col-sm-2 control-label">Servidor</label>
							<div class="col-sm-10">
								<input id="txtservidorSMTP" name="txtservidorSMTP" type="text" class="form-control" placeholder="servidorSMTP" />
							</div>
						</div>

						<div class="form-group">
							<label for="txtpasswordSMTP" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input id="txtpasswordSMTP" name="txtpasswordSMTP" type="password" class="form-control" placeholder="passwordSMTP" />
							</div>
						</div>

            <div class="form-group">
              <h2>Personalización</h2>
            </div>

						<div class="form-group">
							<label for="txttema" class="col-sm-2 control-label">Tema</label>
							<div class="col-sm-10">
                <select id="txttema" name="txttema" class="form-control">
									<option value="skin-yellow">Amarillo</option>
									<option value="skin-yellow-light">Amarillo / Menú claro</option>
									<option value="skin-blue" selected="">Azul [Predeterminado]</option>
									<option value="skin-blue-light">Azul / Menú claro</option>
									<option value="skin-black">Blanco</option>
									<option value="skin-black-light">Blanco / Menú claro</option>
									<option value="skin-purple">Morado</option>
									<option value="skin-purple-light">Morado / Menú claro</option>
									<option value="skin-red">Rojo</option>
									<option value="skin-red-light">Rojo / Menú claro</option>
									<option value="skin-green">Verde</option>
									<option value="skin-green-light">Verde / Menú claro</option>
								</select>
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
					<button type="submit" class="btn btn-primary">Crear usuario</button>
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
					<h4 class="modal-title" id="frmActualizarLabel">Modificar usuario</h4>
				</div>
				<div class="modal-body">
					<div id="camposobjeto" class="form-horizontal" title="Modificar usuario">

            <input id="dtxtfecha_creacion" type="text" class="form-control" name="txtfecha_creacion" disabled />

						<div class="form-group">
							<h2>Datos de acceso</h2>
						</div>

						<div class="form-group">
							<label for="dtxtusuario" class="col-sm-2 control-label">Usuario</label>
							<div class="col-sm-10">
								<input id="dtxtusuario" type="text" class="form-control" name="txtusuario" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtpassword" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input id="dtxtpassword" type="text" class="form-control" name="txtpassword" />
							</div>
						</div>

            <div class="form-group">
							<h2>Datos generales</h2>
						</div>

						<div class="form-group">
							<label for="dtxtnombre" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-10">
								<input id="dtxtnombre" type="text" class="form-control" name="txtnombre" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtemail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input id="dtxtemail" type="text" class="form-control" name="txtemail" />
							</div>
						</div>

            <div class="form-group">
							<h2>Servidor SMTP</h2>
						</div>

						<div class="form-group">
							<label for="dtxtservidorSMTP" class="col-sm-2 control-label">Servidor</label>
							<div class="col-sm-10">
								<input id="dtxtservidorSMTP" type="text" class="form-control" name="txtservidorSMTP" />
							</div>
						</div>

						<div class="form-group">
							<label for="dtxtpasswordSMTP" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input id="dtxtpasswordSMTP" type="text" class="form-control" name="txtpasswordSMTP" />
							</div>
						</div>

            <div class="form-group">
							<h2>Personalización</h2>
						</div>

						<div class="form-group">
							<label for="dtxttema" class="col-sm-2 control-label">Tema</label>
							<div class="col-sm-10">
                <select id="dtxttema" name="txttema" class="form-control">
									<option value="skin-yellow">Amarillo</option>
									<option value="skin-yellow-light">Amarillo / Menú claro</option>
									<option value="skin-blue" selected="">Azul [Predeterminado]</option>
									<option value="skin-blue-light">Azul / Menú claro</option>
									<option value="skin-black">Blanco</option>
									<option value="skin-black-light">Blanco / Menú claro</option>
									<option value="skin-purple">Morado</option>
									<option value="skin-purple-light">Morado / Menú claro</option>
									<option value="skin-red">Rojo</option>
									<option value="skin-red-light">Rojo / Menú claro</option>
									<option value="skin-green">Verde</option>
									<option value="skin-green-light">Verde / Menú claro</option>
								</select>
							</div>
						</div>

						<br style="clear:both"/>
						<input type="hidden" name="acc" value="actualizar" />
						<input type="hidden" name="idObjeto" id="idObjeto"/>
					</div>
				</div>
				<div class="modal-footer bg-gray">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="btnActualizar" class="btn btn-primary">Modificar usuario</button>
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
			<p class="modal-title" id="frmEliminarLabel">Cambiar estado</p>
		  </div>
		  <div class="modal-body">
			<p>&iquest;Est&aacute; seguro que desea cambiar el estado del usuario?</p>
			<input type="hidden" name="acc" value="eliminar" />
			<input type="hidden" name="idObjeto" id="eidObjeto"/>
		  </div>
		  <div class="modal-footer bg-gray">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="button" id="btnEliminar" class="btn btn-primary">Cambiar</button>
		  </div>
		</div>
	  </div>
  </form>
</div>
