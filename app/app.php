<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once '../app/Db.php';
require_once '../vendor/fzaninotto/faker/src/autoload.php';
$app = [
    'name' => 'Book Store',

    'routes' => [
        'books' => [
            'path' => '/',
            'file' => 'books.php',
            'function' => 'src\\index\\testBook',

        ],
        'book_by_id' => [
            'path' => '/books/{id}.html',
            'file' => 'books.php',
            'function' => 'src\\index\\bookById',
        ],
        'admin' => [
            'path' => '/admin/login',
            'file' => 'index.php',
            'function' => 'admin\\index\\admin1',
        ],
        'tags_sort' => [
            'path' => '/<',
            'file' => 'books.php',
            'function' => 'src\\index\\testBook'
        ]

        /*
        'test' => [
            'path' => '/',
            'file' => 'books.php',
            'function' => 'src\\index\\books',

        ],*/

    ],
];

$app['books'] = Db::getConnection();
$i = 0;
$capsule = new Capsule;


$capsule->addConnection([

    "driver" => "mysql",

    "host" => "localhost",

    "database" => "myPageDB",

    "username" => "root",

    "password" => "yuramon1998"

]);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();








/*while ($i!=2) {
    $book = new \src\index\Book();
    $faker = Faker\Factory::create();
    $number = random_int(0, 3);
    $name = $faker->name;
    $poster = $faker->imageUrl(300, 480, 'technics', true, 'Faker', true);
    $date = $faker->date();
    $link = $faker->domainName;
    $price = $faker->randomFloat(2, 10, 30);
    $author = $faker->name;
    $tags = implode(" ", $faker->words($number, false));
    $info = $faker->text;
    $book ->name =$name;
    $book ->poster =$poster;
    $book ->date =$date;
    $book ->link =$link;
    $book ->price =$price;
    $book ->author =$author;
    $book ->tags =$tags;
    $book ->info =$info;
    $book->save();

    $statement = $app['books']->prepare('INSERT INTO books (name, poster, date, link, price, author, tags, info)
    VALUES (:fname, :sname, :age, :link, :price, :author, :tags, :info)');

    $statement->execute([
        'fname' => "$name",
        'sname' => "$poster",
        'age' => "$date",
        'link' => "$link",
        'price' => "$price",
        'author' => "$author",
        'tags' => "$tags",
        'info' => "$info"
    ]);
    $i++;

}*/
//print_r($book);


/*$books = new FakeBooks();
$info = $books->setInfo($faker->info);
$name = $books->setName($faker->name);
$date = $books->setDate($faker->date);
$poster = $books->setPoster($faker->poster);*/
