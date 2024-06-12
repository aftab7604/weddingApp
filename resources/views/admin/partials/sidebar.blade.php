<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">{{$admin->name}}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item @active('admin')">
                <a class="sidebar-link" href="{{route('admin')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item @active('admin.users') @active('admin.users.*')">
                <a class="sidebar-link" href="{{route('admin.users')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
                </a>
            </li>

            <li class="sidebar-item @active('admin.vendors') @active('admin.vendors.*')">
                <a class="sidebar-link" href="{{route('admin.vendors')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Vendors</span>
                </a>
            </li>

            <li class="sidebar-item @active('admin.products') @active('admin.products.*')">
                <a class="sidebar-link" href="{{route('admin.products')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Products</span>
                </a>
            </li>

            <li class="sidebar-item @active('admin.services') @active('admin.services.*')">
                <a class="sidebar-link" href="{{route('admin.services')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Services</span>
                </a>
            </li>

            <li class="sidebar-item @active('admin.places') @active('admin.places.*')">
                <a class="sidebar-link" href="{{route('admin.places')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Places</span>
                </a>
            </li>s


            {{-- <li class="sidebar-header">
                Plugins & Addons
            </li> --}}

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                </a>
            </li> --}}

            
        </ul>
    </div>
</nav>
