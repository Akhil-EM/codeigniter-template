<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/admin/vendors/feather/feather.css">
  <link rel="stylesheet" href="/admin/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/admin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/admin/images/favicon.png" />
  <link rel="stylesheet" href="/admin/css/main.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h4>Notes App</h4>
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post" action="<?= base_url("/login") ?>">
                <?= csrf_field(); ?>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg <?= $validation && $validation->getError('email') ?'form-control-error':'' ?>" name="email" placeholder="Email" value="<?= $data['email'] ?>">
                  <?= $validation &&$validation->getError('email') ? '<p class="text-danger">' . $validation->getError('email') . '</p>' : '' ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg <?= $validation && $validation->getError('password') ?'form-control-error':'' ?>" name="password" placeholder="Password" value="<?= $data['password'] ?>">
                  <?= $validation &&$validation->getError('password') ? '<p class="text-danger">' . $validation->getError('password') . '</p>' : '' ?>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                </div>
                <div class="mt-2">
                  <a type="button" class="btn btn-block btn-danger auth-form-btn"
                     href="<?= base_url("/login/google") ?>">
                    <i class="ti-google mr-2"></i>Login using google
                  </a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="/register" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- endinject -->
</body>

</html>
