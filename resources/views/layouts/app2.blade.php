<!doctype html>

<html lang="en">

  <head>
    
    <title>BiasharaPlus</title>
    
    {{-- Required meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    {{-- DataTable Css --}}
    <link rel="stylesheet" type="text/css"
      href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      
    <link rel="stylesheet" href="/css/app.css">
    
    <link rel="stylesheet" href="/css/biasharaplus.css">

    <script src="/js/app.js"></script>
    
    <!-- DataTable -->
    <script type="text/javascript" charset="utf8"
      src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
      
    <script src="{{asset('js/main.js')}}"></script>

    @yield('more')
      
  </head>
  
  <body class="app header-fixed sidebar-md-show sidebar-fixed">
    
    <header class="app-header navbar">
      <!-- Header content here -->
            
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/logo2.png') }}" alt="BiasharaPlus Logo">
      </a>
      
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" 
        type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <ul class="nav navbar-nav mr-auto">
        
        {{--<li class="nav-item px-3">
          <a class="btn btn-warning" href="https://coreui.io/pro/">Go Pro</a>
        </li>--}}
        
      </ul>
      
      <ul class="nav navbar-nav">
        <li class="nav-item px-3">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="fa fa-user"></span> Account
            <span class="caret"></span>
            <ul class="dropdown-menu">
              <li>
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}"
                  method="POST" style="display: none;">{{ csrf_field() }}</form>
              </li>
              <li class="divider"></li>
              <li>
                <a href="{{ route('change_password') }}">
                  Change password
                </a>
             </li>
            </ul>
          </a>
        </li>
      </ul>
      
    </header>
    
    <div class="app-body">
      
      <div class="sidebar">
        <!-- Sidebar content here -->
        @include('sidebar')
      </div>
      
      <main class="main">
        
        <!-- Main content here -->
        
        <div class="container mt-3">
          @include('loader')
          @yield('content')
        </div>
        
      </main>
      
    </div>
    
    <footer class="app-footer">
      <!-- Footer content here -->
    </footer>
    
  </body>
  
</html>