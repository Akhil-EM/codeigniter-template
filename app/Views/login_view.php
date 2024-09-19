<div>
   <form method="post" action="<?= base_url("/login") ?>">
      <?= csrf_field(); ?>
      <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= $data['email'] ?>">
            <?php if ($validation && $validation->getError('email')): ?>
                <div class="text-danger">
                    <?= $validation->getError('email') ?>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" value="<?= $data['password'] ?>">
            <?php if ($validation && $validation->getError('password')): ?>
                <div class="text-danger">
                    <?= $validation->getError('password') ?>
                </div>
            <?php endif; ?>
        </div>
      <input type="submit" value="Login">
   </form>
   <div>
      Or Login with <a href="<?= base_url("/login/google") ?>">Google</a>
      <br>
      <a href="<?= base_url("/register") ?>">Register</a>
   </div>
</div>