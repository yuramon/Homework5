<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" />
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        </div>
    </div>

</nav>
<hr>

<form class="text-center" action="<?= \core\router\generate('admin1') ?>" method="post">
    <div class="media "><b><big><i>Admin Panel</i></big></b></div>
    <label>
        <input type="text" name="name" placeholder="login" required="">
    </label><br>
    <label>
        <input type="password" name="pas" placeholder="password" required="">
    </label><br>
    <button class="media" type="submit" name="send" value="1">log in</button>
</form>
</div>
</body>
</html>
