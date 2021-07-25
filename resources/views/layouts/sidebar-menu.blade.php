<nav id="sidebarMenu" class="col-md-3 col-lg-1 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky p-0">
        <ul class="nav flex-column">
            {{-- <li class="nav-item bg-dark text-white m-0 p-2 pl-3">Toner Management</li> --}}
            <li class="nav-item bg-dark text-white"><a class="nav-link text-white" href="/dashboard"><i class="fas fa-bars"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('locations.index') }}"><i class="fas fa-location-arrow"></i> Locations</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('suppliers.index') }}"><i class="fas fa-people-carry"></i> Suppliers</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('toners.index') }}"><i class="fas fa-boxes"></i> Toners</a></li>
        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Transactions</span>
            <i class="d-flex align-items-center text-muted"><i class="fa fa-plus-circle"></i></i>
        </h6>
        <ul class="nav flex-column mb-2">
            @can('checkin-list')
            <li class="nav-item"><a class="nav-link" href="{{ route('checkins.index') }}"><i class="fas fa-sign-in-alt"></i> In</a></li>
            @endcan
            @can('checkout-list')
            <li class="nav-item"><a class="nav-link" href="{{ route('checkouts.index') }}"><i class="fas fa-sign-out-alt"></i> Out</a></li>
            @endcan
            <li class="nav-item"><a class="nav-link" href="{{ route('returnReceive.index') }}"><i class="fas fa-exchange-alt"></i> Returns</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('offTheRecord.index') }}"><i class="fas fa-list"></i> Off record</a></li>
        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Reports</span>
            <i class="d-flex align-items-center text-muted"><i class="fa fa-plus-circle"></i></i>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item"><a class="nav-link" href="/reports/master-list"><i class="fas fa-clipboard-list"></i> Master List</a></li>
            <li class="nav-item"><a class="nav-link" href="/reports/stocks"><i class="fas fa-cubes"></i> Stocks</a></li>
            <li class="nav-item"><a class="nav-link" href="/reports/checkins"><i class="fas fa-sign-in-alt"></i> Check-in</a></li>
            <li class="nav-item"><a class="nav-link" href="/reports/checkouts"><i class="fas fa-sign-out-alt"></i> Check-out</a></li>
            <li class="nav-item"><a class="nav-link" href="/reports/returnReceive"><i class="fas fa-exchange-alt"></i> Returns</a></li>
        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Others</span>
            <i class="d-flex align-items-center text-muted"><i class="fa fa-plus-circle"></i></i>
        </h6>
        <ul class="nav flex-column mb-2">
            @can('user-list')
            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i>Users</a></li>
            @endcan
            @can('role-list')
            <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}"><i class="fas fa-users"></i>Roles</a></li>
            @endcan
        </ul>
    </div>
</nav>