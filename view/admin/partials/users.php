<?php
    $url = $this->di->get("url");
    $session = $this->di->get("session");
?>

<h4>Users</h4>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= ucfirst($user->username) ?></td>
                <td><?= $user->email ?></td>
                <td><?= ucfirst($user->address) ?>, <?= ucfirst($user->city) ?></td>
                <td><?= $user->admin === 0 ? 'Customer' : 'Admin' ?></td>
                <td><a href="<?= $url->create("admin/edit/user/$user->id")?>">Edit</a> | <a href="<?= $url->create("admin/delete/user/$user->id")?>">Delete</a></td>
            <tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3"><p class="text-info"><?= $session->getOnce("message") ?></p></th>
            <th colspan="3">
                <a href="<?= $url->create("admin/add/user")?>" class="btn btn-primary float-right">Add User</a>
            </th>
        </tr>
    </tfoot>
</table>
