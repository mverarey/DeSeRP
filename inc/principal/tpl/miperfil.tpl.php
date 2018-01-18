<div class="row">
	<div class="col-md-3">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Foto</h3>
			</div>
			<div class="box-body box-profile">
				<div class="perfilActual">
					<img class="profile-user-img img-responsive img-circle" src="{@pag->fotoperfil}" alt="Foto de perfíl">
					<div class="clearfix" style="margin:4px;"></div>
					<a href="#" class="btn btn-primary btn-block" id="btnFoto"><b>Cambiar</b></a>
					<div class="clearfix" style="margin:4px;"></div>
				</div>
				<form action="/wsdl/principal/miperfil" class="dropzone hidden" id="frmFoto">
					<span class="dz-message" style="margin: 2em 0;">Arrastre su nueva imagen.</span>
					  <div class="fallback">
					    <input name="file" type="file" />
					  </div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<form method="POST">
		<div style="background-color:#f9f9f9;">
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Perfíl</a></li>
		    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Historial</a></li>
		    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Configuración</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="profile" style="margin:5px;">
		    	<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos Generales</h3>
				</div>
				<div class="box-body">
					<p style="text-align:right">Id: {@pag->id} <input type="hidden" name="id" value="{@pag->id}"/></p>
					<div class="form-horizontal">
						<div class="form-group">
							<label for="nombre" class="col-sm-2 control-label">Nombre *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="{@pag->nombre}">
							</div>
						</div>
						<div class="form-group">
							<label for="txtemail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txtemail" placeholder="Email" name="email" value="{@pag->email}">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos acceso</h3>
				</div>
				<div class="box-body">

					<div class="form-horizontal">
						<div class="form-group">
							<label for="usuario" class="col-sm-2 control-label">Usuario</label>
							<div class="col-sm-10">
								<input type="text" class="form-control required" id="usuario" placeholder="Usuario" name="usuario" value="{@pag->usuario}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-sm-2 control-label">Contrase&ntilde;a</label>
							<div class="col-sm-5">
								<div class="input-group">
									<input type="password" class="form-control password" id="password" placeholder="Password" disabled name="password">
									<div class="input-group-addon"><a href="#password" class="passt" title="Modificar"><i class="fa fa-edit"></i></a></div>
								</div>
							</div>
							<div class="col-sm-5">
								<input type="password" class="form-control rpassword" id="repassword" placeholder="Repetir Password" disabled>
							</div>
						</div>
					</div>

				</div>
				<!-- /.box-body -->
			</div>

			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos de correo</h3>
				</div>
				<div class="box-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label for="txtservidor" class="col-sm-2 control-label">Servidor POP3/SMTP</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txtservidor" placeholder="Servidor" name="servidor" value="{@pag->servidor}">
							</div>
						</div>
						<div class="form-group">
							<label for="txtpassmail" class="col-sm-2 control-label">Contraseña POP3/SMTP</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txtpassmail" placeholder="Password" name="passmail" value="{@pag->passmail}">
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="messages"  style="margin:5px;">
		    	<ul class="timeline timeline-inverse" style="margin-top:15px">
		                  <!-- timeline time label -->
		                  <li class="time-label">
		                        <span class="bg-red">
		                          10 Oct. 2017
		                        </span>
		                  </li>
		                  <!-- /.timeline-label -->
		                  <!-- timeline item -->
		                  <li>
		                    <i class="fa fa-envelope bg-blue"></i>

		                    <div class="timeline-item">
		                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

		                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

		                      <div class="timeline-body">
		                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
		                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
		                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
		                        quora plaxo ideeli hulu weebly balihoo...
		                      </div>
		                      <div class="timeline-footer">
		                        <a class="btn btn-primary btn-xs">Read more</a>
		                        <a class="btn btn-danger btn-xs">Delete</a>
		                      </div>
		                    </div>
		                  </li>
		                  <!-- END timeline item -->
		                  <!-- timeline item -->
		                  <li>
		                    <i class="fa fa-user bg-aqua"></i>

		                    <div class="timeline-item">
		                      <span class="time"><i class="fa fa-clock-o"></i> hace 5 mins</span>

		                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
		                      </h3>
		                    </div>
		                  </li>
		                  <!-- END timeline item -->
		                  <li>
		                    <i class="fa fa-clock-o bg-gray"></i>
		                  </li>
		                </ul>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="settings"  style="margin:5px;">
		    	<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos Generales</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="txttema" class="col-sm-2 control-label">Tema</label>
						<div class="col-sm-10">
							<select id="txttema" name="tema" class="form-control">
								<option value="skin-yellow" >Amarillo</option>
								<option value="skin-yellow-light" >Amarillo / Menú claro</option>
								<option value="skin-blue" {@pag->temaPred}>Azul [Predeterminado]</option>
								<option value="skin-blue-light" >Azul / Menú claro</option>
								<option value="skin-black" >Blanco</option>
								<option value="skin-black-light" >Blanco / Menú claro</option>
								<option value="skin-purple" >Morado</option>
								<option value="skin-purple-light" >Morado / Menú claro</option>
								<option value="skin-red" >Rojo</option>
								<option value="skin-red-light" >Rojo / Menú claro</option>
								<option value="skin-green" >Verde</option>
								<option value="skin-green-light" >Verde / Menú claro</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		    </div>
		  </div>

		  <div style="padding-bottom:50px">
		    	<button type="submit" class="btn btn-primary col-xs-12 col-sm-6 col-sm-offset-3"><i class="fa fa-floppy-o"></i> Guardar cambios</button>
		    </div>

		</div>
		</form>

	</div>
</div>
