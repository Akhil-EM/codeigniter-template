<div>
    <p class="underline bg-green-800 ">Notes page</p>
    <a href="<?= base_url("notes/create") ?>">Add Note</a>
    <a href="<?= base_url("profile") ?>">Profile</a>
    <a href="<?= base_url("/logout") ?>">Logout</a>
</div>
<?php print_r($validation); ?>
<?php if (!session()->get("user")["passwordUpdated"]) { ?>
    <p>click <a href="/profile">here</a> to add a password and secure your profile.</p>
<?php } ?>
<table>
    <tr>
        <th>Sl no</th>
        <th>Title</th>
    </tr>
    <?php foreach ($data["notes"] as $key => $note) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><a href="<?= base_url("notes/get/" . $note["id"]) ?>"><?= $note["title"] ?></a></td>
        <?php endforeach; ?>
    <?= count($data["notes"]) == 0 ? "<tr><td colspan='2'>No notes found</td></tr>" : ""  ?>
</table>