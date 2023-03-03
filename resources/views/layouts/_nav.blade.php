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
            <a class="nav-link" href="index-2.html">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Inicio</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="pages/widgets.html">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Widgets</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
              <i class="fab fa-trello menu-icon"></i>
              <span class="menu-title">Opciones</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> 
                    <a class="nav-link" href="{{route('products.index')}}">Producto</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('categories.index')}}">Categorías</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('providers.index')}}">Proveedores</a></li>
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