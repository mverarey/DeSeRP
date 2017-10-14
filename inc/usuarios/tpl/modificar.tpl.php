<style>
fieldset{ width: 350px; float: left; margin-left: 20px !important;}
</style>
<form id="frm" method="POST">
<p style="text-align:right">Id: {@pag->id} <input type="hidden" name="id" value="{@pag->id}"/></p>
<fieldset>
<legend>Datos Generales</legend>
<div class="campos">	
	<label for="txtnombre">Nombre *</label>
	<input type="text" id="txtnombre" class="required" name="nombre" value="{@pag->nombre}" />
	
	<label for="txtemail">Email</label>
	<input type="text" id="txtemail" name="email" class="email" value="{@pag->email}" />

</div>
</fieldset>
<fieldset>
<legend>Datos acceso</legend>
<div class="campos">
	<label>Usuario</label>
	<input type="text" class="required" name="usuario" value="{@pag->usuario}"/>
	
	<label>Contrase&ntilde;a <a href="#" class="passt">[Modificar]</a></label>
	<input class="password" id="txtpass" type="password" disabled name="password" value=""/>

	<label>Repetir contrase&ntilde;a</label>
	<input class="rpassword" equalTo="#txtpass" type="password" disabled name="password" value=""/>
</div>
</fieldset>

<fieldset style="clear:left">
<legend>Datos de correo</legend>
<div class="campos">		
	<label for="txtservidor">Servidor POP3/SMTP</label>
	<input type="text" id="txtservidor" name="servidor" class="" value="{@pag->servidor}" />
	
	<label for="txtpassmail">Contrase&ntilde;a POP3/SMTP</label>
	<input type="password" id="txtpassmail" name="passmail" class="" value="{@pag->passmail}" />
	
	<label for="txttema">Tema</label>
	<select id="txttema" name="tema"><option value="" {@pag->temaPred}>Predeterminado</option><option value="fincomun" {@pag->temaFinC}>Fin Com&uacute;n</option><option value="buap">BUAP</option><option value="cnnm" {@pag->temaCnnm}>CNNM</option><option value="beta">Beta</option></select>
</div>
</fieldset>
<center><input type="submit" value="Guardar cambios" style="width:85%" /></center>
</form>