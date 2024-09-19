
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
<?php 
 if($error || $success || session()->getFlashdata('error') || session()->getFlashdata('success')){
?>
<script>
      const success = <?= json_encode($success ?? session()->getFlashdata('success') ?? '') ?>;
      const error = <?= json_encode($error ?? session()->getFlashdata('error') ?? '') ?>;
      const baseUrl = "<?= base_url('notes/update') ?>";
      const currentUrl = window.location.href.split('/').slice(0, -1).join('/'); 
    swal({
        text:"<?= $error ?? $success ?? session()->getFlashdata('error') ?? session()->getFlashdata('success') ?>",
        icon:"<?= ($error || session()->getFlashdata('error')) ? 'error' : 'success' ?>",
        button:"Ok",
        timer:2000
    });

    setTimeout(()=>{
        
     if(window.location.href === "<?= base_url("register") ?>") window.location.href = "<?= base_url("login") ?>";
     if(success && baseUrl === currentUrl) window.location.href = "<?= base_url("") ?>";
    },1000);
</script>
<?php } ?>
</body>

</html>