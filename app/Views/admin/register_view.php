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
  <link rel="stylesheet" href="/admin/css/main.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/admin/images/favicon.png" />
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
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" action="<?= base_url("/register") ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg <?= $validation && $validation->getError('name') ?'form-control-error':'' ?>" name="name" placeholder="Name" value="<?= $data['name'] ?>">
                  <?= $validation && $validation->getError('name') ? '<p class="text-danger">' . $validation->getError('name') . '</p>' : '' ?>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg <?= $validation && $validation->getError('email') ?'form-control-error':'' ?>" name="email" placeholder="Email" value="<?= $data['email'] ?>">
                  <?= $validation &&$validation->getError('email') ? '<p class="text-danger">' . $validation->getError('email') . '</p>' : '' ?>
                </div>
                
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg <?= $validation && $validation->getError('password') ?'form-control-error':'' ?>" name="password" placeholder="Password" value="<?= $data['password'] ?>">
                  <?= $validation && $validation->getError('password') ? '<p class="text-danger">' . $validation->getError('password') . '</p>' : '' ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg <?= $validation && $validation->getError('confirm_password') ?'form-control-error':'' ?>" name="confirm_password" placeholder="Confirm Password" value="<?= $data['confirm_password'] ?>">
                  <?= $validation && $validation->getError('confirm_password') ? '<p class="text-danger">' . $validation->getError('confirm_password') . '</p>' : '' ?>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="mt-2">
                  <a href="<?= base_url("/register/google") ?>" type="button" class="btn btn-block btn-danger auth-form-btn">
                    <i class="ti-google mr-2"></i>Register using google
                  </a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="/login" class="text-primary">Login</a>
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
