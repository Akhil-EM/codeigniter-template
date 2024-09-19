<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <?php if (!session()->get("user")["passwordUpdated"]) { ?>
        <div class="col-md-12 grid-margin">
          <div class="card">
            <div class="card-body">click <a href="/profile">here</a> to add a password and secure your profile.</p>
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="col-md-12 stretch-card grid-margin">
        <div class="card">
          <div class="card-body">
            <p class="card-title mb-0">Notes</p>
            <div class="table-responsive">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th class="pl-0  pb-2 border-bottom" style="width:30px">Sl No</th>
                    <th class="border-bottom pb-2">Title</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($data["notes"] as $key => $note) : ?>
                  <tr>
                    <td class="pl-0"><?= $key + 1 ?></td>
                    <td>
                      <p class="mb-0">
                        <span class="font-weight-bold mr-2">
                        <a href="<?= base_url("notes/get/" . $note["id"]) ?>"><?= $note["title"] ?></a>
                      </span>
                    </p>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
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