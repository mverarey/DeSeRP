<div id="administrar">
	<p>Seleccione campo y despu&eacute;s d&eacute; click sobre la acci&oacute;n que desee realizar.</p>
	<table id="tbldatab72484a1261a244a50ab35a51e3194de7" data-toggle="table" data-url="/wsdl/<?=$this->os(2)?>/obtenertabla" data-pagination="true"
	   data-method="post" data-side-pagination="server" data-page-list="[5, 10, 20, 50, 100, 200, 300, 400, 500, 1000, 5000, 10000]" data-toolbar="#toolbar-bootstrapTable"
	   data-search="true" data-striped="true" data-height="500" data-cache="true" data-show-refresh="true"
	   data-click-to-select="true" data-select-item-name="id" data-show-toggle="true" data-show-columns="true" >
	<thead>
	<tr>
		<th data-field="null" data-radio="true"></th>
			<th data-field="id" data-sortable="true">No</th>
	<th data-field="campo" data-sortable="true" data-visible="true">campo</th>
	<th data-field="numero" data-sortable="true" data-visible="true">numero</th>
	<th data-field="textolargo" data-sortable="true" data-visible="true">textolargo</th>

	</tr>
	</thead>
	</table>
	<div id="toolbar-bootstrapTable" class="btn-group">
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#crear"><i class="fa fa-plus"></i> Nuevo registro</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmActualizar"><i class="fa fa-pencil"></i> Modificar</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmEliminar"><i class="fa fa-trash"></i> Eliminar</button>
		<a href='/wsdl/<?=$this->os(2)?>/exportar' class='btn btn-default'><i class='fa fa-download'></i> Exportar</a>
	</div>
</div>

<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel">
	<form method="post">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="crearLabel"><?php echo _("Nuevo campo")?></h4>
				</div>
				<div class="modal-body">
					<div class="col-xs-12 caja_mediana">
						<h2><?php echo _("Instrucciones")?></h2>
						<ul class="nostyle">
							<li>* <?php echo _("Campos requeridos")?></li>
						</ul>
					</div>
					<div class="col-xs-12">
						<div class="form-horizontal">
							<div class="form-group">
	<label for="txtcampo" class="col-sm-2 control-label">campo</label>
	<div class="col-sm-10">
		<input id="txtcampo" name="txtcampo" type="text" class="form-control" placeholder="campo" />
	</div>
</div>
<div class="form-group">
	<label for="txtnumero" class="col-sm-2 control-label">numero</label>
	<div class="col-sm-10">
		<input id="txtnumero" name="txtnumero" type="text" class="form-control" placeholder="numero" />
	</div>
</div>
<div class="form-group">
	<label for="txttextolargo" class="col-sm-2 control-label">textolargo</label>
	<div class="col-sm-10">
		<input id="txttextolargo" name="txttextolargo" type="text" class="form-control" placeholder="textolargo" />
	</div>
</div>

						</div>
						<br style="clear:both;"/>
						<input type="hidden" name="acc" value="crear" />
					</div>

					<br style="clear:both" />
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _("Cancelar")?></button>
					<button type="submit" class="btn btn-primary"><?php echo _("Crear campo")?></button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="frmActualizar" tabindex="-1" role="dialog" aria-labelledby="frmActualizarLabel">
	<form method="post">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="frmActualizarLabel"><?php echo _("Modificar campo")?></h4>
				</div>
				<div class="modal-body">
					<div id="camposobjeto" class="form-horizontal" title="<?php echo _("Modificar campo")?>">
						<div class="form-group">
	<label for="dtxtcampo" class="col-sm-2 control-label">campo</label>
	<div class="col-sm-10">
		<input id="dtxtcampo" type="text" class="form-control" name="txtcampo" />
	</div>
</div>
<div class="form-group">
	<label for="dtxtnumero" class="col-sm-2 control-label">numero</label>
	<div class="col-sm-10">
		<input id="dtxtnumero" type="text" class="form-control" name="txtnumero" />
	</div>
</div>
<div class="form-group">
	<label for="dtxttextolargo" class="col-sm-2 control-label">textolargo</label>
	<div class="col-sm-10">
		<input id="dtxttextolargo" type="text" class="form-control" name="txttextolargo" />
	</div>
</div>

						<br style="clear:both"/>
						<input type="hidden" name="acc" value="actualizar" />
						<input type="hidden" name="idObjeto" id="idObjeto"/>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _("Cancelar")?></button>
					<button type="button" id="btnActualizar" class="btn btn-primary"><?php echo _("Modificar campo")?></button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="frmEliminar" tabindex="-1" role="dialog" aria-labelledby="frmEliminarLabel">
  <form method="post">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<p class="modal-title" id="frmEliminarLabel"><?php echo _("Eliminar campo")?></p>
		  </div>
		  <div class="modal-body">
			<p><?php echo _("&iquest;Est&aacute; seguro que desea eliminar campo?")?></p>
			<input type="hidden" name="acc" value="eliminar" />
			<input type="hidden" name="idObjeto" id="eidObjeto"/>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _("Cancelar")?></button>
			<button type="submit" id="btnEliminar" class="btn btn-primary"><?php echo _("Eliminar")?></button>
		  </div>
		</div>
	  </div>
  </form>
</div>