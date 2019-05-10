<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$app = [
    'name' => 'Book Store',
    'adminPanel' => 'Admin Panel',

    'routes' => [
        'books' => [
            'path' => '/',
            'file' => 'books.php',
            'function' => 'src\\index\\books',

        ],
        'book_by_id' => [
            'path' => '/books/{id}.html',
            'file' => 'books.php',
            'function' => 'src\\index\\bookById',
        ],
        'book_by_id_admin' => [
            'path' => '/admin/{id}.html',
            'file' => 'index.php',
            'function' => 'admin\\index\\bookById',
        ],
        'admin' => [
            'path' => '/admin/login',
            'file' => 'index.php',
            'function' => 'admin\\index\\admin1',
        ],
        'admin1' => [
            'path' => '/admin/',
            'file' => 'index.php',
            'function' => 'admin\\index\\admin',
        ],
    ],
];
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



