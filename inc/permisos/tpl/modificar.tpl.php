<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Usuarios</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<form method="POST">
					<table class="datos table">
					<thead>
					<tr>
						<th>M&oacute;dulo</th>
						<th>Permiso / Nivel</th>
					</tr>
					</thead>
					<tbody>
					{@pag->permisos}
					</tbody>
					</table>

					<div class="text-center">
						<button class="btn btn-default btn-lg" type="submit"><i class="fa fa-save"></i> Guardar cambios</button>
					</div>
				</form>

			</div>
		</div>
		<p><a class="Regresar btn btn-default" href="../administrar"><i class="fa fa-arrow-left"></i> Regresar</a></p>
	</div><!-- /.box-body -->
</div>
