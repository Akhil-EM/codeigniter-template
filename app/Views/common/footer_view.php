
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
