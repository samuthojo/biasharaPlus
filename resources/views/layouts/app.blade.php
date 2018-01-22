<!DOCTYPE html>
<html>
<head>
  <title>BiasharaPlus</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
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
      font-weight: bold;
      width: 50%;
      text-align: center;
      padding: 20px;
      color: #fff;
      top: 40%;
      left: 50%;
      transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
      z-index: 1;
      opacity: 0.85;
    }
    .panel-heading h3 {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: normal;
      width: 75%;
      padding-top: 8px;
    }
    .panel-title {
      color: #f0ad4e;
    }
    .modal-title {
      color: #3c763d;
    }
    .loader {
        z-index: 9999;
        text-align: center;
        align-content: center;
        padding-bottom: 10px;
        display: none;
    }
    .navbar-default .navbar-nav>li>a {
      color: #3c763d;
      /*color: #555;*/
      /*color: #777;*/
    }
    .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover {
      color: #f0ad4e;
      background-color: #e7e7e7;
      font-weight: bold;
    }
    .navbar-default .navbar-nav>li>a:hover {
      /*color: #f0ad4e;*/
      color: #777;
    }
    .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
      color: #f0ad4e;
      background-color: #e7e7e7;
    }
    .navbar-default .navbar-nav .open .dropdown-menu>li>a {
        /*color: #555;*/
        color: #3c763d;
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
      <a class="navbar-brand" href="{{url('/')}}"
        style="color: #3c763d; font-family: Brush Script MT,cursive;
        font-size: 20px; font-weight: bold;">BiasharaPlus</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav" id="link_section">
      <li class="{{ (request()->is('categories*') || request()->is('/')) ? 'active' : '' }}"
        id="categories">
        <a href="{{url('/categories')}}">
          Categories
        </a>
      </li>
      <li class="{{ request()->is('products*') ? 'active' : '' }}"
         id="products">
        <a href="{{url('/products')}}">
          Products
        </a>
      </li>
      <li class="{{ request()->is('pricelists*') ? 'active' : '' }}"
        id="priceLists">
        <a href="{{url('/pricelists')}}">
          PriceLists
        </a>
      </li>
      <li class="{{ request()->is('users*') ? 'active' : '' }}"
        id="users">
        <a href="{{url('/users')}}">
          Users
        </a>
      </li>
      <li class="{{ request()->is('versions*') ? 'active' : '' }}"
        id="versions">
        <a href="{{url('/versions')}}">
          Versions
        </a>
      </li>
      <li class="{{ request()->is('notifications*') ? 'active' : '' }}"
        id="notifications">
        <a href="{{url('/notifications')}}">
          Notifications
        </a>
      </li>
      <li class="{{ request()->is('feedback*') ? 'active' : '' }}"
        id="feedback">
        <a href="{{url('/feedback')}}">
          Feedback
        </a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">More
          <span class="caret"></span>
          <ul class="dropdown-menu">
            <li>
              <a href="{{url('/bundles')}}">
                Bundles
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{url('/pay_bill_numbers')}}">
                PayBill Numbers
              </a>
           </li>
           <li class="divider"></li>
            <li>
              <a href="{{url('/send_payments')}}">
                Send Payments
              </a>
           </li>
           <li class="divider"></li>
            <li>
              <a href="{{url('/all_payments')}}">
                All Payments
              </a>
           </li>
          </ul>
        </a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span> Account
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
  </div>
  </div>
</nav>
<div class="container-fluid">
  @include('loader')
  @yield('content')
</div>
</body>
</html>
