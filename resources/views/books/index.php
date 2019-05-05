<div class="page-header">
    <h3>Books</h3>
</div>

<?php foreach ($books as $book): ?>
    <div class="media">
        <div class="media-left">
            <a href="<?= \core\router\generate('book_by_id', ['id' => $book['id']]) ?>">
                <img src="<?= $book['poster'] ?>" alt="<?= $book['name'] ?>" class="media-object" width="300">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="<?= \core\router\generate('book_by_id', ['id' => $book['id']]) ?>"><?= $book['name'] ?></a>
            </h4>

            <p><b>Author</b>: <?= $book['author'] ?></p>

            <p><b>Price</b>: <span class="text-success" style="font-size: large"><?= sprintf("$ %01.2f", $book['price']) ?></span></p>

            <p><b>Date</b>: <?= date_format(date_create($book['date']),'d/m/Y') ?></p>

            <?php if (isset($book['tags'])): ?>
                <p>
                    <b>Tags</b>:
                    <?php foreach ((array)$book['tags'] as $tag): ?>
                        <span class="label label-primary"><?= $tag ?></span>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>

            <a href="<?= \core\router\generate('book_by_id', ['id' => $book['id']]) ?>" class="btn btn-primary">Details</a>
        </div>
    </div>
<?php endforeach; ?>

<nav class="text-center">
    <?php
    $pages = ceil($criteria['total'] / $criteria['limit']);

    $current = ($criteria['offset'] / $criteria['limit']);
    ?>
    <ul class="pagination">
        <?php for ($i = 0; $i < $pages; $i++): ?>
            <li class="<?= $i == $current ? 'active' : '' ?>">
                <?php
                $params = array_filter(array_merge($_GET, ['page' => $i]), function ($value) {
                    return !empty($value);
                });
                $page = !empty($params) ? \core\router\generate('books') . '?' . http_build_query($params) : \core\router\generate('books');
                ?>
                <a href="<?= $page ?>">
                    <?= ($i + 1) ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
