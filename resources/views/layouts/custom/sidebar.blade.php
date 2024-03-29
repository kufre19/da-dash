  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-surehelp sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
          <div class="sidebar-brand-icon rotate-n-15">
              {{-- <i class="fas fa-laugh-wink"></i>
             --}}

          </div>
          <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }} <sup>{{ Auth::user()->name }}</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link" href="{{ url('/dashboard') }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Navigations
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
              aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-tshirt"></i>
              <span>Laundry</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Laundry section:</h6>
                  <a class="collapse-item" href="{{ url('/dashboard/laundry/create') }}">New</a>
                  <a class="collapse-item" href="{{ url('/dashboard/laundry/basket/gallery/upload') }}">Add Images to Laundry</a>
                  <a class="collapse-item" href="{{ url('/dashboard/laundry/orders') }}">Laundry Orders</a>

              </div>
          </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
              aria-expanded="true" aria-controls="collapseThree">
              <i class="fas fa-user"></i>
              <span>User setting</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">User settings section:</h6>
                  <a class="collapse-item" href="{{ url('/dashboard/account/create') }}">Add New Account</a>
                  <a class="collapse-item" href="{{ url('/dashboard/account/list') }}">Accounts</a>
                  {{-- <a class="collapse-item" href="#">Rejected</a> --}}
              </div>
          </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
              aria-expanded="true" aria-controls="collapseFour">
              <i class="fas fa-wrench"></i>
              <span>Services</span>
          </a>
          <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Service section:</h6>
                  <a class="collapse-item" href="{{ url('/dashboard/service/create') }}">Add New Service</a>
                  <a class="collapse-item" href="{{ url('/dashboard/service/list') }}">Services Offered</a>
                  {{-- <a class="collapse-item" href="#">Rejected</a> --}}
              </div>
          </div>
      </li>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven"
            aria-expanded="true" aria-controls="collapseSeven">
            <i class="fas fa-table"></i>
            <span>Shelves</span>
        </a>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Shelf section:</h6>
                <a class="collapse-item" href="{{ url('/dashboard/shelves/create') }}">Add New Shelf</a>
                  <a class="collapse-item" href="{{ url('/dashboard/shelves/list') }}">Shelves Available</a>
            </div>
        </div>
    </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-users"></i>
            <span>Customers</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customers section:</h6>
                <a class="collapse-item" href="{{ url('/dashboard/customers/create') }}">Add New Customer</a>
                <a class="collapse-item" href="{{ url('/dashboard/customers/list/') }}"> Customer List</a>
                {{-- <a class="collapse-item" href="#">Rejected</a> --}}
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
            aria-expanded="true" aria-controls="collapseSix">
            <i class="fas fa-coins"></i>
            <span>Sales</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sales section:</h6>
                <a class="collapse-item" href="{{ url('/dashboard/sales/index') }}">Sales</a>
                
            </div>
        </div>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight"
            aria-expanded="true" aria-controls="collapseEight">
            <i class="fas fa-power-off"></i>
            <span>Reset</span>
        </a>
        <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Reset section:</h6>
                <a class="collapse-item" href="{{ url('/dashboard/reset') }}">Reset System</a>
                
            </div>
        </div>
    </li> --}}








      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

  </ul>
  <!-- End of Sidebar -->
