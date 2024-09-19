<div>
    <p class="underline bg-green-800 ">Note page</p>
    <a href="<?= base_url() ?>">Notes</a>
    <a href="<?= base_url("/logout")?>">Logout</a>
</div>
<h5><?= $data["note"]["title"] ?></h5>
<p><?= $data["note"]["content"] ?></p>
<div>
    <a href="<?= base_url("notes/update/".$data["note"]["id"]) ?>">Edit</a>
    <a href="<?= base_url("notes/delete/".$data["note"]["id"]) ?>">Delete</a>
</div>