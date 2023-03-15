<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="{{asset('melody/images/faces/face5.jpg')}}" alt="image"/>
              </div>
              <div class="profile-name">
                <p class="name">
                  Bienvenido Usuario
                </p>
                <p class="designation">
                  Super Admin
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
            <a class="nav-link" href="{{route('categories.index')}}">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Categorías</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" href="{{route('clients.index')}}">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Clientes</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" href="{{route('products.index')}}">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Productos</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" href="{{route('providers.index')}}">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Proveedores</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" href="{{route('purchases.index')}}">
              <i class="fas fa-shopping-cart menu-icon"></i>
              <span class="menu-title">Compras</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" href="{{route('sales.index')}}">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Ventas</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
              <i class="fab fa-trello menu-icon"></i>
              <span class="menu-title">Configuración</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('business.index')}}">Empresa</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('printers.index')}}">Impresora</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Usuarios</span>
            </a>
          </li> 

          <li class="nav-item">
            <a class="nav-link" href="{{route('roles.index')}}">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Roles</span>
            </a>
          </li> 


          <li class="nav-item d-none d-lg-block">
            <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
              <i class="fas fa-columns menu-icon"></i>
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
              <i class="far fa-file-alt menu-icon"></i>
              <span class="menu-title">Manual</span>
            </a>
          </li>
        </ul>
      </nav>