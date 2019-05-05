<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" />

    <title><?= $app['name'] ?></title>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= \core\router\generate('books') ?>">
                <span class="glyphicon glyphicon-book"></span>
                <?= $app['name'] ?>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-left" action="<?= \core\router\generate('books') ?>">
                <div class="form-group">
                    <input placeholder="Search" name="q" value="<?= isset($criteria['q']) ? $criteria['q'] : '' ?>" required class="form-control">
                </div>
                <button class="btn btn-default">Search</button>
            </form>

        </div>
    </div>
</nav>

<div class="container">
    <form class="navbar-form navbar-right" action="<?= \core\router\generate('books') ?>">
        <button class="btn btn-default" name="sort" value="Name">Sort</button>
    </form>
    <?= $content ?>
</div>

<hr>

<footer class="footer">
    <div class="container">
        <p class="text-muted">© <?= date_format(date_create(),'Y') ?> Company, Inc.</p>
    </div>
</footer>

</body>
</html>
