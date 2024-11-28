<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-newspaper"></i>


        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @can('home')
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard Home</span></a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>


    <!-- admins -->
    @can('admins')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminManagement"
                aria-expanded="true" aria-controls="adminManagement">
                <i class="fas fa-user-shield"></i>

                <span>Admins Management</span>
            </a>
            <div id="adminManagement" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Admin Management:</h6>
                    <a class="collapse-item" href="{{ route('admin.admins.index') }}">Admins</a>
                    <a class="collapse-item" href="{{ route('admin.admins.create') }}">Create New Admin</a>


                </div>
            </div>
        </li>
    @endcan



    <!-- authorizations -->
    @can('authorizations')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#authorizationManagment"
                aria-expanded="true" aria-controls="authorizationManagment">
                <i class="fas fa-unlock"></i>

                <span>Authorizations </span>
            </a>
            <div id="authorizationManagment" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Roles Management:</h6>
                    <a class="collapse-item" href="{{ route('admin.authorizations.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('admin.authorizations.create') }}">Create New Role</a>


                </div>
            </div>
        </li>
    @endcan

       <!-- Nav Item - Pages Users Menu -->
       @can('users')
       <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true" aria-controls="collapsePages">
               <i class="fas fa-fw fa-users"></i>
               <span>Users Mangement</span>
           </a>
           <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">

                   <a class="collapse-item" href="{{ route('admin.users.index') }}">Users</a>
                   <a class="collapse-item" href="{{ route('admin.users.create') }}">Create Users</a>


               </div>
           </div>
       </li>
   @endcan



    <!-- Nav Item - Pages Collapse Menu -->
    @can('posts')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-newspaper"></i>
                <span>Post Management</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ route('admin.posts.index') }}">Posts</a>
                    <a class="collapse-item" href="{{ route('admin.posts.create') }}">Create Post</a>
                </div>
            </div>
        </li>
    @endcan






    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Addons
    </div> --}}


    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - categories -->
    @can('categories')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Categories</span></a>
        </li>
    @endcan

    <!-- settings -->
    @can('settings')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Settings</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Settings Management:</h6>
                    <a class="collapse-item" href="{{ route('admin.setting.index') }}">Update Settings</a>
                    <a class="collapse-item" href="{{ route('admin.related-sites.index') }}">Related Sites</a>


                </div>
            </div>
        </li>
    @endcan
    <!-- settings -->
    @can('contacts')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contact_id"
                aria-expanded="true" aria-controls="contact_id">
                <i class="fas fa-envelope"></i>
                <span>Contacts</span>
            </a>
            <div id="contact_id" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contacts Management:</h6>
                    <a class="collapse-item" href="{{ route('admin.contact.index') }}"> Contacts</a>

                </div>
            </div>
        </li>
    @endcan

    @can('notifications')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.notification.index') }}">
                <i class="fas fa-bell"></i>
                <span>Notification</span></a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
