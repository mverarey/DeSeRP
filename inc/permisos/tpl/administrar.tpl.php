<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Usuarios</h3>
		<div class="pull-right col-md-4 col-sm-12 col-xs-12">
			<input class="typeahead" type="text" placeholder="Nombre del usuario" autofocus id="tpah" style="width:100%;">
		</div>
	</div>
	<div class="box-body">
		<p>Seleccione el usuario a modificar:</p>
		{@pag->tablaUsuarios}
	</div><!-- /.box-body -->
</div>
<script>{@pag->lista_usuarios}</script>
