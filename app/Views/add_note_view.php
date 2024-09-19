<div >
    <h4>Add Notes</h4>
    <a href="<?= base_url("/")?>">Notes</a>
    <a href="<?= base_url("/logout")?>">Logout</a>
        
</div>
<form method="post" action="<?= $extraData["noteId"] ? base_url("/notes/update/".$extraData["noteId"]) : base_url("/notes/create") ?>">
      <?= csrf_field(); ?>
      <div>
            <label for="content">Title</label>
            <input type="text" name="title" id="title" value="<?= $data['title'] ?>">
            <?php if ($validation && $validation->getError('title')): ?>
                <div class="text-danger">
                    <?= $validation->getError('title') ?>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10"><?= $data['content'] ?></textarea>
            <?php if ($validation && $validation->getError('content')): ?>
                <div class="text-danger">
                    <?= $validation->getError('content') ?>
                </div>
            <?php endif; ?>
        </div>
      <input type="submit" value="Submit">
      <input type="reset" value="Reset">
   </form>