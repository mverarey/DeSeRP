<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Variables en el sistema</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-primary">Variables</span>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <form class="form-horizontal" method="post">
      <h2>Pantalla de inicio</h2>
      <div class="form-group">
        <label for="sistema_iniciotitulo" class="col-sm-2 control-label">Título</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="sistema_iniciotitulo" value="{@pag->sistema_iniciotitulo}" name="sistema_iniciotitulo">
        </div>
      </div>
      <div class="form-group">
        <label for="sistema_iniciomensaje" class="col-sm-2 control-label">Mensaje</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="sistema_iniciomensaje" value="{@pag->sistema_iniciomensaje}" name="sistema_iniciomensaje">
        </div>
      </div>
      <div class="form-group">
        <label for="sistema_iniciobotonleyenda" class="col-sm-2 control-label">Leyenda (botón)</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="sistema_iniciobotonleyenda" name="sistema_iniciobotonleyenda" value="{@pag->sistema_iniciobotonleyenda}">
        </div>
      </div>
      <div class="form-group">
        <label for="sistema_iniciobotonurl" class="col-sm-2 control-label">URL (botón)</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="sistema_iniciobotonurl" name="sistema_iniciobotonurl" value="{@pag->sistema_iniciobotonurl}">
        </div>
      </div>

      <input type="hidden" name="acc" value="actualizar" />
      <input type="hidden" name="listaVars" value="{@pag->listaVars}" />
      <button class="btn btn-lg btn-primary" type="submit">Actualizar información</button>
    </form>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
