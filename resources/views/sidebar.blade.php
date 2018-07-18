<nav class="sidebar-nav">
  
  <ul class="nav">
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute('dashboard') }}" href="{{url('/')}}">
        <i class="nav-icon fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    
    <li class="nav-title">Transactions</li>
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute('all_payments') }}" 
         href="{{ route('all_payments') }}">
      <i class="nav-icon icon-drop"></i>Payments</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute('payments_page') }}" 
         href="{{ route('payments_page') }}">
      <i class="nav-icon icon-drop"></i>Send</a>
    </li>
    
    <li class="nav-title">Stock</li>
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute('categories.index') }}" 
         href="{{ route('categories.index') }}">
      <i class="nav-icon icon-drop"></i>Categories</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute('cms_pricelists.index') }}" 
         href="{{ route('cms_pricelists.index') }}">
      <i class="nav-icon icon-drop"></i>PriceLists</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute('products.index') }}" 
         href="{{ route('products.index') }}">
      <i class="nav-icon icon-drop"></i>Products</a>
    </li>
    
    {{-- Learn Nav With DropDown Menu --}}
    <li class="nav-item nav-dropdown">
      
      <a class="nav-link nav-dropdown-toggle" href="#">
        Account
      </a>
    
      <ul class="nav-dropdown-items">
        
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}"
            method="POST" style="display: none;">{{ csrf_field() }}</form>
        </li>
        
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('change_password') }}">
            Change password
          </a>
        </li>
        
      </ul>
      
    </li>
    
  </ul>
  
</nav>
