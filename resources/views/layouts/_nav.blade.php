<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="{{asset('melody/images/faces/user.png')}}" alt="image"/>
              </div>
              <div class="profile-name">
                <p class="name">
                {{ Auth::user()->name }}
                </p>
                <p>
                {{ Auth::user()->username }}
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Inicio</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts2" aria-expanded="false" aria-controls="page-layouts2">
            <i class="fa fa-shopping-basket menu-icon"></i>
              <span class="menu-title">Productos</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('categories.index')}}">Categorías</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('products.index')}}">Productos</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('clients.index')}}">
              <i class="fa fa-users menu-icon"></i>
              <span class="menu-title">Clientes</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts1" aria-expanded="false" aria-controls="page-layouts1">
            <i class="fa fa-shopping-bag menu-icon"></i>
              <span class="menu-title">Compras</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('providers.index')}}">Proveedores</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('purchases.index')}}">Compras</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('sales.index')}}">
              <i class="fa fa-plus-circle menu-icon"></i>
              <span class="menu-title">Ventas</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
            <i class="fa fa-cogs menu-icon"></i>
              <span class="menu-title">Configuración</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('business.index')}}">Empresa</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('printers.index')}}">Impresora</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('users.index')}}">Usuarios</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('roles.index')}}">Roles</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
              <i class="fa fa-tasks menu-icon"></i>
              <span class="menu-title">Reportes</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sidebar-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('reports.day')}}">Reportes por día</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('reports.date')}}">Reportes por fecha</a></li>
              </ul>
            </div>
          </li>

        
          <li class="nav-item">
            <a class="nav-link" href="pages/documentation.html">
              <i class="far fa-file-pdf menu-icon"></i>
              <span class="menu-title">Manual</span>
            </a>
          </li>
        </ul>
      </nav>