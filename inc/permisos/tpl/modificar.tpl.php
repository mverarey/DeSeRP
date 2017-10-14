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
				<input class="btn btn-default btn-lg" type="submit" value="Guardar cambios" />
			</div>
		</form>
		
	</div>
</div>
<p><a class="Regresar" href="../administrar">Regresar</a></p>