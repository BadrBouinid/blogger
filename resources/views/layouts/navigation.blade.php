<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/')}}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Articles</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Compte
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          @auth
          <li><a class="dropdown-item">{{Auth::user()->name}}</a></li>
          <div class="dropdown-divider"></div>
          <li><a class="dropdown-item" href="{{route('users.logout')}}">Déconnection</a></li>
          @else
       
            <li><a class="dropdown-item" href="{{route('users.create')}}">Inscription</a></li>
            <li><a class="dropdown-item" href="{{route('users.login')}}">Connection</a></li>
           @endauth
          </ul>
        </li>
        @auth
@if(Auth::user()->is_admin)
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestion Articles
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('posts.create')}}">Ajouter</a></li>
          </ul>
        </li>
        @endif
        @endauth
      </ul>
      <form class="d-flex" action="{{route('posts.search')}}" method="post">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Recherche">
        <input type="hidden" name="_token" value="{{Session::token()}}">
        <button class="btn btn-dark" type="submit">Recherche</button>
      </form>
    </div>
  </div>
</nav>