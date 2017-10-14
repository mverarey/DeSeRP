<style>
.campos input[type="text"],.campos input[type="password"]{
	width: 180px;
}
</style>
<div width="100%" style="text-align: center;">
<div style="width:300px; margin:70px auto 70px; text-align:left;">

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Login</h3>
		</div>
		<div class="box-body">

			<fieldset class="login">
				<form action="/app/principal/login" method="POST">
				{@pag->msg}
				  <div class="form-group">
				    <label for="txtusuario">Usuario</label>
				    <input type="text" class="form-control" id="txtusuario" name="usuario" placeholder="Usuario" value="<?=$_REQUEST['usuario']?>">
				  </div>
				  <div class="form-group">
				    <label for="txtcontrasena">Contraseña</label>
				    <input type="password" class="form-control" id="txtcontrasena" name="password" placeholder="Contraseña" value="<?=$_REQUEST['password']?>">
				  </div>
				  <div class="row"><button type="submit" class="btn btn-primary col-xs-6 col-xs-offset-3">Ingresar</button></div>
				  <p style="margin-top: 15px;">En caso de haber olvidado su contase&ntilde;a de click <a href="mailto:contacto@depotserver.com">aqu&iacute;</a></p>
				  <input type="hidden" name="ruta" value="{@pag->ruta}" />
				  <input type="hidden" name="validacion" value="<?=md5(date("dmY"))?>" />
				</form>

			</fieldset>

		</div>
		<!-- /.box-body -->
	</div>

</div>
</div>