<? namespace DepotServer;

class Migracion{

  public function probarConexion(){
    $db = new BaseDatos();
    return $db::connection()->getDatabaseName();
  }

  public function crearTablas() {
    try{
      $db = new BaseDatos();
      $db::schema()->dropIfExists('accesos_schema');
      $db::schema()->create('accesos_schema', function ($table) {
        $table->integer('idUsuario');
        $table->string('area');
        $table->timestamp('fecha');
      });
      $db::schema()->dropIfExists('preferencias_schema');
      $db::schema()->create('preferencias_schema', function ($table) {
        $table->string('variable');
        $table->string('valor');
      });
      $db::schema()->dropIfExists('usuarios_schema');
      $db::schema()->create('usuarios_schema', function ($table) {
        $table->increments('id');
        $table->string('usuario', 30);
        $table->string('password');
        $table->string('nombre');
        $table->string('email', 100);
        $table->string('servidorSMTP');
        $table->string('passwordSMTP');
        $table->string('tema');
        $table->timestamp('fecha_creacion');
        $table->tinyInteger('activo')->default(1);
      });
      $db::schema()->dropIfExists('usuarios_permisos_schema');
      $db::schema()->create('usuarios_permisos_schema', function ($table) {
        $table->integer('idUsuario');
        $table->string('modulo');
        $table->enum('nivel', ['0','1','2','3']);
      });
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  public function crearUsuario($usuario, $password = ""){
    $db = new BaseDatos();
    $idUsuario = $db::table('usuarios_schema')->insertGetId(
        ['usuario' => $usuario, 'password' => md5($password), 'nombre' => 'Administrador del sistema', 'email' => 'no-reply@localhost', 'servidorSMTP' => '', 'passwordSMTP' => '', 'tema' => 'blue', 'fecha_creacion' => date('Y-m-d H:i:s'), 'activo' => 1]
    );
    $db::table('usuarios_permisos_schema')->insert([
      ['idUsuario' => $idUsuario, 'modulo' => 'permisos', 'nivel' => '3'],
      ['idUsuario' => $idUsuario, 'modulo' => 'usuarios', 'nivel' => '3'],
      ['idUsuario' => $idUsuario, 'modulo' => 'configuracion', 'nivel' => '3'],
      ['idUsuario' => $idUsuario, 'modulo' => 'formbuilder', 'nivel' => '3']
    ]);
    $db::table('preferencias_schema')->insert([
      ['variable' => "sistema_iniciotitulo", 'valor' => "Bienvenid@ a DeSeRP"],
      ['variable' => "sistema_iniciomensaje", 'valor' => "Modifique este mensaje de bienvenida desde la sección, Configuración > Mensaje inicio."],
      ['variable' => "sistema_iniciobotonleyenda", 'valor' => "Leer más"],
      ['variable' => "sistema_iniciobotonurl", 'valor' => "#"],
    ]);
  }
}
