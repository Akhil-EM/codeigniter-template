<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add Note </h4>
            <form class="forms-sample" method="post" action="<?= $extraData["noteId"] ? base_url("/notes/update/" . $extraData["noteId"]) : base_url("/notes/create") ?>">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="exampleInputCity1">Title</label>
              <input type="text" class="form-control <?= $validation && $validation->getError('title') ? 'form-control-error' : '' ?>" name="title" placeholder="Title" value="<?= $data["title"] ?>">
              <?php if ($validation && $validation->getError('title')): ?>
                <div class="text-danger">
                  <?= $validation->getError('title') ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="exampleTextarea1">Content</label>
              <textarea class="form-control <?= $validation && $validation->getError('content') ? 'form-control-error' : '' ?>" name="content" rows="8"><?= $data["content"] ?></textarea>
              <?php if ($validation && $validation->getError('content')): ?>
                <div class="text-danger">
                  <?= $validation->getError('content') ?>
                </div>
              <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:../../partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
    </div>
  </footer>
  <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="/admin/vendors/js/vendor.bundle.base.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/admin/js/off-canvas.js"></script>
<script src="/admin/js/hoverable-collapse.js"></script>
<script src="/admin/js/template.js"></script>
<script src="/admin/js/settings.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="/admin/js/dashboard.js"></script>

</body>

</html>