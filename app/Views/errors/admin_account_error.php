<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account not found</title>
</head>

<body>
    <h1>
        <?php if(isset($account_not_found)): ?>
        <?= $account_not_found ?>
        <?php endif ?>
    </h1>
    <a href="/admin/login">Login Again</a>
    <a href="/admin/register/admin">Register</a>

</body>

</html>