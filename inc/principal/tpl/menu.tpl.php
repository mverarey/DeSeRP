<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Menú principal</li>
  <li class="treeview">
    <a href="/">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>
{% for key, modulo in menu %}
  <li class="treeview">
    <a href="#{{ modulo.nombre | url_encode }}">
      <i class="fa fa-{{ modulo.icono }}"></i> <span>{{modulo.nombre}}</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      {% for nombre, path in modulo.elementos %}
      <li {% if path == urlActual %} class="active" {% endif %}><a href="{{path}}"><i class="fa fa-circle-o"></i> {{ nombre }} </a></li>
      {% endfor %}
    </ul>
  </li>
  {% endfor %}
</ul>

