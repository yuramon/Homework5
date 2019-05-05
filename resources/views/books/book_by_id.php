<ol class="breadcrumb">
    <li><a href="<?= \core\router\generate('books') ?>">Books</a></li>
    <li class="active"><?= $books[0]['name'] ?></li>
</ol>

<div class="media">
    <div class="media-left">
        <img src="<?= $books[0]['poster'] ?>" alt="<?= $books[0]['name'] ?>" class="media-object">

        <div class="text-center" style="margin-top: 25px">
            <a href="<?= $books[0]['link'] ?>" class="btn btn-lg btn-success"><span
                        class="glyphicon glyphicon-info-sign"></span> See more</a>
        </div>
    </div>

    <div class="media-body">
        <h2 class="media-heading">
            <?= $books[0]['name'] ?>
        </h2>

        <p><b>Author</b>: <?= $books[0]['author'] ?></p>

        <p><b>Price</b>: <span class="text-success" style="font-size: large"><?= sprintf("$ %01.2f",
                    $books[0]['price']) ?></span></p>

        <p><b>Date</b>: <?= date_format(date_create($books[0]['date']), 'd/m/Y') ?></p>

        <?php if (isset($books[0]['tags'])): ?>
            <p>
                <b>Tags</b>:
                <?php foreach ((array)$books[0]['tags'] as $tag): ?>
                    <span class="label label-primary"><?= $tag ?></span>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>

        <?= $books[0]['info'] ?>
    </div>
</div>