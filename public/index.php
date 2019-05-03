<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../app/app.php';
require_once '../app/Db.php';

use Symfony\Component\HttpFoundation\Request;
use function core\handle;

/*try {
    $db = Db::getConnection();
    foreach ($db->query('SELECT * FROM books') as $row) {
        print_r($row);
    }
    $db = null;
} catch (PDOException $e) {
    print "Error". $e->getMessage(). "<br/>";
    die();
}*/

/*$result = $db ->query('SELECT * FROM books');
$result ->setFetchMode(2);
$items = $result->fetch();
return $items;*/
$request = Request::createFromGlobals();
$response = handle($request);
$response->send();
