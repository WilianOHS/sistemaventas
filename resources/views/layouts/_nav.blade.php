<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="{{asset('melody/images/faces/user.png')}}" alt="image"/>
              </div>
              <div class="profile-name">
              <div style="width: 1px; margin: 2px;">
              <p class="name" style="word-break: break-all; overflow-wrap: break-word; font-size: 16px;">
                {{ Auth::user()->username}}
              </p>
              <p style="word-wrap: break-word; font-size: 12px;">
                {{ Auth::user()->name }}
              </p>
            </div>

          </div>

            </div>
          </li>
          @can('home.index')
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('home') }}">
                      <i class="fa fa-home menu-icon"></i>
                      <span class="menu-title">Inicio</span>
                  </a>
              </li>
          @endcan
          <li class="nav-item">
                  <a class="nav-link" href="{{ route('cotizaciones.index') }}">
                      <i class="fa fa-edit menu-icon"></i>
                      <span class="menu-title">Cotizaciones</span>
                  </a>
              </li>

          <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#page-layouts3" aria-expanded="false" aria-controls="page-layouts3">
              <i class="fa fa-money menu-icon"></i>
              <span class="menu-title">Caja</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="page-layouts3">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('cashopening.index') }}">Apertura de caja</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('cashclosing.index') }}">Cierre de caja c</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('cashclosingz.index') }}">Cierre de caja z</a>
                  </li>
              </ul>
          </div>
      </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts2" aria-expanded="false" aria-controls="page-layouts2">
            <i class="fa fa-shopping-basket menu-icon"></i>
              <span class="menu-title">Productos</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts2">
              <ul class="nav flex-column sub-menu">
              @can('categories.index')
                <li class="nav-item"> <a class="nav-link" href="{{route('categories.index')}}">Categorías</a></li>
                @endcan
                @can('product.index')
                <li class="nav-item"> <a class="nav-link" href="{{route('products.index')}}">Productos</a></li>
                @endcan
              </ul>
            </div>
          </li>

          @can('clients.index')
          <li class="nav-item">
            <a class="nav-link" href="{{route('clients.index')}}">
              <i class="fa fa-users menu-icon"></i>
              <span class="menu-title">Clientes</span>
            </a>
          </li> 
          @endcan

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts1" aria-expanded="false" aria-controls="page-layouts1">
            <i class="fa fa-shopping-bag menu-icon"></i>
              <span class="menu-title">Compras</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts1">
              <ul class="nav flex-column sub-menu">
              @can('providers.index')
                <li class="nav-item"> <a class="nav-link" href="{{route('providers.index')}}">Proveedores</a></li>
                @endcan
                @can('purchases.index')
                <li class="nav-item"> <a class="nav-link" href="{{route('purchases.index')}}">Compras</a></li>
                @endcan
              </ul>
            </div>
          </li>

          @can('sales.index')
          <li class="nav-item">
            <a class="nav-link" href="{{route('sales.index')}}">
              <i class="fa fa-plus-circle menu-icon"></i>
              <span class="menu-title">Ventas</span>
            </a>
          </li> 
          @endcan

          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                  <i class="fa fa-cogs menu-icon"></i>
                  <span class="menu-title">Configuración</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="page-layouts">
                  <ul class="nav flex-column sub-menu">
                      @can('printers.index')
                          <li class="nav-item"> <a class="nav-link" href="{{ route('printers.index') }}">Impresora</a></li>
                      @endcan
                      @can('business.index')
                          <li class="nav-item"> <a class="nav-link" href="{{ route('business.index') }}">Empresa</a></li>
                      @endcan
                      @can('users.index')
                          <li class="nav-item"> <a class="nav-link" href="{{ route('users.index') }}">Usuarios</a></li>
                      @endcan
                      @can('roles.index')
                          <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                      @endcan
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
              <li class="nav-item"> <a class="nav-link" href="{{route('reports_sales_purchases.index')}}">Reportes Ventas y Compras</a></li>
              @can('reports.day')
                <li class="nav-item"> <a class="nav-link" href="{{route('reports.day')}}">Reportes por día</a></li>
                @endcan
                @can('reports.date')
                <li class="nav-item"> <a class="nav-link" href="{{route('reports.date')}}">Reportes por fecha</a></li>
                @endcan
              </ul>
            </div>
          </li>

        
          <li class="nav-item">
            <a class="nav-link" href="{{ asset('manual_de_usuario.pdf') }}" target="_blank">
              <i class="far fa-file-pdf menu-icon"></i>
              <span class="menu-title">Manual</span>
            </a>
          </li>

        </ul>
      </nav>