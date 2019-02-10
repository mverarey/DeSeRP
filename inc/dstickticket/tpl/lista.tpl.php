<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Tickets</h3>
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