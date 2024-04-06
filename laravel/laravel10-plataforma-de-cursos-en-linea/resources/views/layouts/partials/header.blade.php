<!-- header -->
<header>
    <h1>Cursos en linea</h1>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link {{request()->routeIs('home') ? 'active' : ''}}">Home</a>
              </li>
              <li class="nav-item">
                <a  href="{{route('cursos.index')}}" class="nav-link {{request()->routeIs('cursos.*') ? 'active' : ''}}">Cursos</a>
              </li>
              <li class="nav-item">
                <a href="{{route('nosotros')}}" class="nav-link {{request()->routeIs('nosotros') ? 'active' : ''}}">Nosotros</a>
              </li>
              <li class="nav-item">
                <a href="{{route('contactanos.index')}}" class="nav-link {{request()->routeIs('contactanos.index') ? 'active' : ''}}">Contactanos</a>
              </li>
              <li class="nav-item">
                <a  href="{{route('dashboard.index')}}" class="nav-link {{request()->routeIs('dashboard.*') ? 'active' : ''}}">Dashboard</a>
              </li>
            </ul>

            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
          </div>
        </div>
      </nav>
</header>



