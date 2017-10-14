<fieldset>
<legend>Registrar usuario nuevo</legend>
<form id="agregarUsuario" class="agregarUsuario" method="POST" >
	<div class="caja_mediana" style="float:right">
		<h2>Ayuda</h2>
		<ul>
			<li>El usuario debe tener tama&ntilde;o entre 4 y 12 caracteres.</li>
			<li>La contrase&ntilde;a debe tener al menos un n&uacute;mero y una letra min&uacute;scula.</li>
			<li>* Campos necesarios.</li>
		</ul>
	</div>
	
	
	<div class="campos">
		<label for="txtusuario">Usuario *</label>
		<input id="txtusuario" type="text" class="required" name="txtusuario" maxlength="12" />

		<label for="txtpassword">Contrase&ntilde;a *</label>
		<input id="txtpassword" type="password" class="required password" name="txtpassword" />		

		<label for="txtpassword_conf">Confirmar contrase&ntilde;a *</label>
		<input id="txtpassword_conf" type="password" class="required" equalTo="#txtpassword" name="txtpassword_conf" />
		
	</div>
	<hr style="margin-top: 10px; clear:both"/>
	<div class="campos">	
		<label for="txtnombre">Nombre *</label>
		<input type="text" id="txtnombre" class="required" name="txtnombre" />
		
		<label for="txtemail">Email</label>
		<input type="text" id="txtemail" name="txtemail" class="email" />
		
		<label for="txtservidor">Servidor POP3/SMTP</label>
		<input type="text" id="txtservidor" name="txtservidor" class="" />
		
		<label for="txtpassmail">Contrase&ntilde;a POP3/SMTP</label>
		<input type="password" id="txtpassmail" name="txtpassmail" class="" />
		
		<label for="txttema">Tema</label>
		<select id="txttema" name="txttema"><option value="">Predeterminado</option><option value="fincomun">Fin Com&uacute;n</option><option value="buap">BUAP</option></select>		
	</div>
	<br style="clear:both;"/>
	<input type="hidden" name="fecha_creacion" value="{@sistema->ahora}" />
	<input type="submit" value="Registrar" class="submit" style="margin-left:150px;width:150px"/>
</form>
</fieldset>