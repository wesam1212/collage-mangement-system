<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My System</title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}" />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-home"></i> Home</a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link text-center">
      <span class="brand-text font-weight-light">My System</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Doctors -->
          <li class="nav-item {{ Request::is('doctors/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('doctors/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-md"></i>
              <p>Doctors<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/doctors/add') }}" class="nav-link {{ Request::is('doctors/add') ? 'active' : '' }}">➕ Add Doctor</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/doctors/list') }}" class="nav-link {{ Request::is('doctors/list') ? 'active' : '' }}">📋 Doctors List</a>
              </li>
            </ul>
          </li>

          <!-- Students -->
          <li class="nav-item {{ Request::is('students/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('students/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>Students<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/students/add') }}" class="nav-link {{ Request::is('students/add') ? 'active' : '' }}">➕ Add Student</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/students/list') }}" class="nav-link {{ Request::is('students/list') ? 'active' : '' }}">📋 Students List</a>
              </li>
            </ul>
          </li>

          <!-- Courses -->
          <li class="nav-item {{ Request::is('courses/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('courses/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>Courses<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/courses/add') }}" class="nav-link {{ Request::is('courses/add') ? 'active' : '' }}">➕ Add Course</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/courses/list') }}" class="nav-link {{ Request::is('courses/list') ? 'active' : '' }}">📋 Courses List</a>
              </li>
            </ul>
          </li>

          <!-- Departments -->
          <li class="nav-item {{ Request::is('departments/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('departments/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>Departments<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/departments/add') }}" class="nav-link {{ Request::is('departments/add') ? 'active' : '' }}">➕ Add Department</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/departments/list') }}" class="nav-link {{ Request::is('departments/list') ? 'active' : '' }}">📋 Departments List</a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content -->
  <div class="content-wrapper p-4">
    @yield('content')
  </div>

</div>

<!-- AdminLTE Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
