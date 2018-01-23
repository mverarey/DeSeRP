<?
$this->establecerTitulo("Administrar permisos");

//$c = new \DepotServer\Conexion();
$db = new \DepotServer\BaseDatos();
$usuarios = $db::table('usuarios')->select('id', 'usuario', 'nombre')->where('activo', '=', '1')->orderBy('nombre', 'asc')->get()->all();

$mod2 = $this->os(2);

foreach ($usuarios as $key => $usuario) {
  $tabla .= <<<EOM
  <div class="col-md-4 col-xs-12">
  <a href="/app/{$mod2}/modificar/{$usuario->id}">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <div class="pull-right"><i class="fa fa-share"></i></div>
        <span class="info-box-text">{$usuario->usuario}</span>
        <span class="info-box-number">{$usuario->nombre}</span>
      </div>
    </div>
  </a>
  </div>
EOM;
  $listaUsuarios .= ',{"nombre":"'.$usuario->nombre.'","id":"'.$usuario->id.'"}';
}
$this->ev("lista_usuarios", "var lista_usuarios = [{'nombre':'', 'id':''}".$listaUsuarios."];");
$this->ev("tablaUsuarios",$tabla);

$this->agregarArchivoScript("/assets/typeahead.js/dist/typeahead.bundle.min.js");
$this->agregarArchivoScript("/assets/typeahead.js/dist/bloodhound.min.js");
$script = <<<EOM

var my_Suggestion_class = new Bloodhound({ limit: 10, datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'), queryTokenizer: Bloodhound.tokenizers.whitespace, local: $.map(lista_usuarios, function(item) { return {value: item.nombre, id: item.id}; }) }); my_Suggestion_class.initialize();
var typeahead_elem = $('.typeahead');
typeahead_elem.typeahead({ hint: true, highlight: true, minLength: 1 },{
	name: 'value', displayKey: 'value', limit: 10, source: my_Suggestion_class.ttAdapter(),
	templates: { empty: [ '<div class="noitems">', 'No se ha encontrado ningúna usuario con ese término.', '</div>' ].join("\\n") }
});
$('.typeahead').on('typeahead:selected', function (e, datum) { if(datum.id.length > 0){ window.location.assign("/app/permisos/modificar/"+datum.id); } });

EOM;
$this->agregarScript($script);

?>
