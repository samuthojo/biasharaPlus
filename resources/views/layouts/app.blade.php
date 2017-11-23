<!DOCTYPE html>
<html>
<head>
  <title>BiasharaPlus</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--Pulling Awesome Font -->
  <link
    href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
    rel="stylesheet">

  <!-- DataTable Css-->
  <link rel="stylesheet" type="text/css"
    href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

  <link rel="stylesheet"
  	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  </script>

  <!-- DataTable -->
  <script type="text/javascript" charset="utf8"
    src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

  <!-- Latest compiled JavaScript -->
  <script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script>

  <script src="{{asset('js/main.js')}}"></script>

  @yield('more')

  <style>
    body {
      margin-top: 70px;
    }
    .form-control {
      width: auto;
    }
    .alert-success {
      position: absolute;
      display: block;
      background-color: #3c763d;
      width: 50%;
      padding: 20px;
      color: #fff;
      top: 40%;
      left: 50%;
      transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
      z-index: 1;
      opacity: 0.85;
    }
    #alert-error {
      position: absolute;
      display: block;
      background-color: #f44336;
      width: 50%;
      padding: 20px;
      color: #fff;
      top: 20%;
      left: 50%;
      transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
      z-index: 1;
      opacity: 0.6;
    }
    .close {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    .loader {
      position: fixed; /* Sit on top of the page content */
      display: none; /* Hidden by default */
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5); /* Black background with opacity */
      z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */
    }
    #pre_loader {
      position: absolute;
      top: 50%;
      left: 50%;
      font-size: 16px;
      color: #3c763d;
      transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
    }
  </style>

</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{url('/')}}">BiasharaPlus</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav" id="link_section">
      <li class="active link" id="categories">
        <a href="{{url('/categories')}}">
          Categories
        </a>
      </li>
      <li class="link" id="products">
        <a href="{{url('/products')}}">
          Products
        </a>
      </li>
      <li class="link" id="priceLists">
        <a href="{{url('/priceLists')}}">
          PriceLists
        </a>
      </li>
      <li class="link" id="users">
        <a href="{{url('/users')}}">
          Users
        </a>
      </li>
      <li class="link" id="versions">
        <a href="{{url('/versions')}}">
          Versions
        </a>
      </li>
      <li class="link" id="notifications">
        <a href="{{url('/notifications')}}">
          Notifications
        </a>
      </li>
      <li class="link" id="feedback">
        <a href="{{url('/feedback')}}">
          Feedback
        </a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span> Account
          <span class="caret"></span>
          <ul class="dropdown-menu">
            <li><a href="{{ route('logout') }}">Logout</a></li>
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
  </div>
  </div>
</nav>
<div class="container-fluid">
  @include('loader')
  @yield('content')
</div>
</body>
</html>
