<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }} - Manage</title>

  <!-- Icons -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="{{ asset('css/base-manage.css') }}" rel="stylesheet">
  <link href="{{ asset('css/manage.css') }}" rel="stylesheet">

  @routes
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden footer-fixed">
  <div id="manage">

    <header class="app-header navbar">
      <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
      <a class="navbar-brand" href="#"> AffProducts - Manage </a>
      <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

    </header>

    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link {{ (request()->route()->getName() == 'manage.home') ? 'active' : '' }}" href="{{ route('manage.home') }}"><i class="icon-speedometer"></i> Home </a>
              <a class="nav-link {{ (request()->route()->getName() == 'manage.categories.view') ? 'active' : '' }}" href="{{ route('manage.categories.view') }}"><i class="icon-list"></i> Categories </a>
              <a class="nav-link {{ (request()->route()->getName() == 'manage.products.view') ? 'active' : '' }}" href="{{ route('manage.products.view') }}"><i class="icon-handbag"></i> Products </a>
              <a class="nav-link {{ (request()->route()->getName() == 'manage.admins.view') ? 'active' : '' }}" href="{{ route('manage.admins.view') }}"><i class="icon-user"></i> Admins </a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Main content -->
      <main class="main">
        <div class="container-fluid">


          @yield('content')


        </div>
        <!-- /.conainer-fluid -->
      </main>

    </div>

    <footer class="app-footer">
        <a href="#">{{ config('app.name') }}</a> © 2017.
    </footer>

    <flash></flash>

  </div>

  <!-- Scripts -->
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="{{ asset('js/manage.js') }}"></script>
</body>

</html>
