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
    
    <script type="text/javascript">
      window.base_url = '{{ asset('') }}'
      window.images_base_url = '{{ asset('uploads/products') }}'
    </script>

    <script src="/js/app.js"></script>
    
    <!-- DataTable -->
    <script type="text/javascript" charset="utf8"
      src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
      
    <script src="{{asset('js/main.js')}}"></script>

    @yield('more')
      
  </head>
  
  <body class="app header-fixed sidebar-lg-show sidebar-fixed">
    
    <header class="app-header navbar">
      
      <!-- Header content here -->
            
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/logo2.png') }}" alt="BiasharaPlus Logo">
      </a>
      
      <button class="d-none d-lg-inline navbar-toggler sidebar-toggler" 
        type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <button class="d-lg-none navbar-toggler sidebar-toggler" 
        type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
              
      <ul class="nav navbar-nav mr-auto d-none d-lg-flex">
        
        <li class="nav-item px-3">
          <a class="nav-link {{ isActiveRoute('users.index') }}" 
             href="{{ route('users.index') }}">Users</a>
        </li>
        
        <li class="nav-item px-3">
          <a class="nav-link {{ isActiveRoute('versions.index') }}" 
             href="{{ route('versions.index') }}">Versions</a>
        </li>
        
        <li class="nav-item px-3">
          <a class="nav-link {{ isActiveRoute('notifications') }}" 
             href="{{ route('notifications') }}">Notifications</a>
        </li>
        
        <li class="nav-item px-3">
          <a class="nav-link {{ isActiveRoute('cms_feedback.index') }}" 
             href="{{ route('cms_feedback.index') }}">Feedback</a>
        </li>
        
        {{--<li class="nav-item px-3">
          <a class="btn btn-warning" href="https://coreui.io/pro/">Go Pro</a>
        </li>--}}
        
      </ul>
      
      <ul class="nav navbar-nav d-none d-lg-flex">
        
        <li class="nav-item px-3">
          
          <div class="dropdown">
            <a href="#" class="btn btn-light dropdown-toggle text-success" 
               data-toggle="dropdown">
              <span class="fa fa-user"></span> Account
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item text-success" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}"
                method="POST" style="display: none;">{{ csrf_field() }}</form>
              <a class="dropdown-item text-success" href="{{ route('change_password') }}">
                Change password
              </a>
            </div>
          </div>
          
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
        
        @yield('breadcrumb')
        
        <div class="container mt-3 mb-3">
          @include('loader')
          @yield('content')
        </div>
        
      </main>
      
    </div>
    
    <footer class="app-footer d-flex justify-content-center">
      
      <!-- Footer content here -->
      All Rights Reserved &copy; BiasharaPlus {{date('Y')}}
      
    </footer>
    
  </body>
  
</html>