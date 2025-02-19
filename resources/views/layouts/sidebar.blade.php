<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <i class="fas fa-warehouse"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Warehouse</div>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} d-flex align-items-center"
            href="{{ route('dashboard') }}"><span>{{ __('Home') }}</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }} d-flex align-items-center"
            href="{{ route('products') }}">
            <span>{{ __('Products') }}</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed d-flex align-items-center" href="#" data-bs-toggle="collapse"
            data-bs-target="#transactionHistoryCollapse" aria-expanded="true" aria-controls="transactionHistoryCollapse">
            <span>{{ __('Transactions') }}</span>
            <i class="fas fa-chevron-down ml-auto"></i>
        </a>
        <div id="transactionHistoryCollapse" class="collapse" data-bs-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('transaction.in') ? 'active' : '' }}"
                    href="{{ route('transaction.in') }}">
                    <span>{{ __('Transaction In') }}</span>
                </a>
                <a class="collapse-item {{ request()->routeIs('transaction.out') ? 'active' : '' }}"
                    href="{{ route('transaction.out') }}">
                    <span>{{ __('Transaction Out') }}</span>
                </a>
            </div>
        </div>
    </li>

    @if(Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('create-user') ? 'active' : '' }} d-flex align-items-center"
            href="{{ route('create-user') }}">
            <span>{{ __('Register Form') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('customers') ? 'active' : '' }} d-flex align-items-center"
            href="{{ route('customers') }}">
            <span>{{ __('Customers') }}</span>
        </a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('suppliers') ? 'active' : '' }} d-flex align-items-center"
            href="{{ route('suppliers') }}">
            <span>{{ __('Suppliers') }}</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">


</ul>

<!-- End of Sidebar -->
