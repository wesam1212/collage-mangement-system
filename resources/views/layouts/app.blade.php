<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>College System</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Main Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link text-center">
            <span class="brand-text font-weight-light">College System</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>

                    <li class="nav-header">Doctors</li>
                    <li class="nav-item">
                        <a href="{{ url('/doctors/add') }}" class="nav-link">
                            <i class="fas fa-user-plus nav-icon"></i>
                            <p>Add Doctor</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/doctors/list') }}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Doctors List</p>
                        </a>
                    </li>

                    <li class="nav-header">Students</li>
                    <li class="nav-item">
                        <a href="{{ url('/students/add') }}" class="nav-link">
                            <i class="fas fa-user-graduate nav-icon"></i>
                            <p>Add Student</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/students/list') }}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Students List</p>
                        </a>
                    </li>

                    <li class="nav-header">Departments</li>
                    <li class="nav-item">
                        <a href="{{ url('/departments/add') }}" class="nav-link">
                            <i class="fas fa-building nav-icon"></i>
                            <p>Add Department</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/departments/list') }}" class="nav-link">
                            <i class="fas fa-list nav-icon"></i>
                            <p>Departments List</p>
                        </a>
                    </li>

                    <li class="nav-header">Courses</li>
                    <li class="nav-item">
                        <a href="{{ url('/courses/add') }}" class="nav-link">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Add Course</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/courses/list') }}" class="nav-link">
                            <i class="fas fa-list nav-icon"></i>
                            <p>Courses List</p>
                        </a>
                    </li>

                    <li class="nav-header">Employees</li>
                    <li class="nav-item">
                        <a href="{{ url('/employees/add') }}" class="nav-link">
                            <i class="fas fa-user-tie nav-icon"></i>
                            <p>Add Employee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/employees/list') }}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Employees List</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper p-3">
        @yield('content')
    </div>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@yield('scripts')

</body>
</html>
