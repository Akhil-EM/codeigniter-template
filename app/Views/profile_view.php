<div>
    <p class="underline bg-green-800 ">Profile</p>
    <a href="<?= base_url("/") ?>">Home</a>
    <a href="<?= base_url("/logout") ?>">Logout</a>
</div>
<form action="<?= base_url("/profile/image") ?>" method="post">
    <?= csrf_field() ?>
    <div>
        <img src="<?= $data["profile"]["profileImage"] ?>" style="height:100px;width:100px;border-radius:50%;border:1px solid black;"
            onclick="document.querySelector('input[type=file]').click()">
        <input type="file" name="image" onchange="handleFileSelect(event)" accept="image/png, image/jpeg" style="display: none;" />
    </div>
    <input type="submit" value="Update profile image">
</form>

<form method="post" action="<?= base_url("/profile") ?>" enctype="multipart/form-data">
    <? csrf_field(); ?>
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= $data["profile"]["name"] ?? null ?>">
        <?php if ($validation && $validation->getError('name')): ?>
            <div class="text-danger">
                <?= $validation->getError('name') ?>
            </div>
        <?php endif; ?>
    </div>
    <div>
        <?php if (session()->get("user")["passwordUpdated"]) { ?>
            <p>You have added a password to your account already. You can update the password below.</p>
        <?php } ?>
        <label for="password">Password</label>
        <input type="password" name="password" value="<?= $data["profile"]["password"] ?>">
        <?php if ($validation && $validation->getError('password')): ?>
            <div class="text-danger">
                <?= $validation->getError('password') ?>
            </div>
        <?php endif; ?>
    </div>
    <div>
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirm_password" value="<?= $data["profile"]["confirm_password"] ?>">
        <?php if ($validation && $validation->getError('confirm_password')): ?>
            <div class="text-danger">
                <?= $validation->getError('confirm_password') ?>
            </div>
        <?php endif; ?>
    </div>
    <div>
        <input type="submit" value="Update">
    </div>
</form>

<script>
    function handleFileSelect(event) {
        const file = event.target.files[0];
        const imageRef = document.querySelector('img');
        imageRef.src = URL.createObjectURL(file);
    }
</script>