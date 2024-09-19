<div>
    <h4>Register</h4>
    <form action="<?= base_url("/register") ?>" method="post">
        <?= csrf_field(); ?>

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= $data['name'] ?>">
            <?php if ($validation && $validation->getError('name')): ?>
                <div class="text-danger">
                    <?= $validation->getError('name') ?>
                </div>
            <?php endif; ?>
        </div>

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

        <div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" value="<?= $data['confirm_password'] ?>">
            <?php if ($validation && $validation->getError('confirm_password')): ?>
                <div class="text-danger">
                    <?= $validation->getError('confirm_password') ?>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </form>
    <div>
        Or Register with <a href="<?= base_url("/register/google") ?>">Google</a>
        <br>
        <a href="<?= base_url("/login") ?>">Login</a>
    </div>
</div>