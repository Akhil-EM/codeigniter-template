<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/admin/vendors/feather/feather.css">
  <link rel="stylesheet" href="/admin/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/admin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="/admin/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="/admin/text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/admin/images/favicon.png" />
  <link rel="stylesheet" href="/admin/css/main.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html">Notes App</a>
        <a class="navbar-brand brand-logo-mini" href="index.html">NA</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="/admin/images/faces/face28.jpg" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-user text-primary"></i>
                Profile
              </a>
              <a class="dropdown-item" href="<?= base_url("/logout")?>">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->


      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <?php
            $currentUri = uri_string();
            $isActive = ((uri_string() == null) || (str_contains($currentUri, 'notes/get')));
            ?>
            <a class="nav-link <?= $isActive ?> " href="/" <?= $isActive ?'style="background-color:#5E50F9;color:white"':null ?>>
              <i class="icon-paper menu-icon" <?= $isActive ?'style="color:white;"':null ?>></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/notes/create" <?= (str_contains($currentUri, 'notes/create') || str_contains($currentUri, 'notes/update')) ?'style="background-color:#5E50F9;color:white"':null ?>>
              <i class="icon-plus menu-icon" <?= (str_contains($currentUri, 'notes/create') || str_contains($currentUri, 'notes/update')) ?'style="color:white;"':null ?>></i>
              <span class="menu-title">Add Note</span>
            </a>
          </li>
        </ul>
      </nav>