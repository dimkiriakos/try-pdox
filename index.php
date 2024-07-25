<?php
require_once __DIR__ . '/functions.php';
$users = get_users();

if ($_POST['insert']) {
    create_user(
        filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS),
        filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
    );

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if ($_POST['update']) {
    $data = [
        'name' => filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS),
        'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
    ];

    update_user((int) abs($_POST['user_id']), $data);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if ($_POST['delete']) {
    delete_user(
        (int)abs($_POST['id'])
    );
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDOX</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <h1 class="text-center">Test PDOX</h1>
    <div class="contaier">
        <div class="row">
            <div class="col-md-6 col-12 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Insert Data</h2>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th colspan="2" class="text-center">Actions</th>
                            </thead>
                            <tbody>
                                <?php if (count($users) > 0) : ?>
                                    <?php foreach ($users as $key => $user) : ?>
                                        <tr>
                                            <td><?= ++$key; ?></td>
                                            <td><?= htmlspecialchars($user->name); ?></td>
                                            <td><?= htmlspecialchars($user->email); ?></td>
                                            <td class="d-flex gap-2">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?= (int)abs($user->id) ?>">
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="updateModal<?= (int)abs($user->id) ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= (int)abs($user->id) ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="updateModalLabel<?= (int)abs($user->id) ?>">Modal title</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="/" method="post">
                                                                <input type="hidden" name="update" value="1">
                                                                <input type="hidden" name="user_id" value="<?= (int) abs($user->id); ?>">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="name-<?= (int) abs($user->id) ?>">Name</label>
                                                                        <input type="text" class="form-control" name="name" id="name-<?= (int) abs($user->id) ?>" value="<?= htmlspecialchars($user->name); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email-<?= (int) abs($user->id) ?>">Email</label>
                                                                        <input type="text" class="form-control" name="email" id="email-<?= (int)abs($user->id) ?>" value="<?= htmlspecialchars($user->email) ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="/" method="post">
                                                    <input type="hidden" name="delete" value="1">
                                                    <input type="hidden" name="id" value="<?= (int) abs($user->id); ?>">
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <form action="/" method="post">
                            <input type="hidden" name="insert" value="1">
                            <div class="form-group my-3">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" name="name" type="text">
                            </div>
                            <div class="form-group my-3">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" name="email" type="text">
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="/assets/js/jquery-3.7.1.js"></script>
    <script src="/assets/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/script.js"></script>
</body>

</html>