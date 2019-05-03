<?php

namespace src\index;

use function core\view\view;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PDO;

const BOOKS_PER_PAGE = 2;

/**
 * @return Response
 */

function books()
{
    /** @var Request $request */
    global $request;

    $criteria = [
        'q' => $request->get('q', null),
        'sort' => $request->get('sort', 'date'),
        'tag' => $request->get('tag', null),
        'limit' => BOOKS_PER_PAGE,
        'offset' => ceil((int)$request->get('page', 0) * BOOKS_PER_PAGE),
    ];

    $result = filterByCriteria($criteria);

    return view(['default_layout.php', 'books/index.php'], $result);
}

/**
 * @param $id
 *
 * @return Response
 */
function bookById($id)
{
    $book = current(filterByCriteria(['id' => $id])['books']);

    return view(['default_layout.php', 'books/book_by_id.php'], compact('book'));
}

/**
 * @param array $criteria
 *
 * @return array
 */
function filterByCriteria(array $criteria)
{
    global $app;
    $criteria = array_merge([
        'q' => null,
        'tag' => null,
        'sort' => null,
        'limit' => 3,
        'offset' => 0,
        'total' => 0
    ], $criteria);
    $newArr = [];

    try {
        $books = $app['books'];
        $con = $books->query('SELECT * FROM books');
        $con->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($con as $row) {

            //print_r($row);
            if (!in_array($row, $newArr)) {
                array_push($newArr, $row);
            }
        }
    } catch (PDOException $e) {
        print "Error !! " . $e->getMessage() . "<br />";
        die();
    };
    $books = $newArr;


    if (!empty($criteria['id'])) {
        $id = $criteria['id'];
        /*$con = $books -> query('SELECT id FROM books');
        $result = $con -> fetch(PDO::FETCH_BOTH);*/
        $books = array_filter($books, function ($book) use ($id) {
            return $book['id'] == $id;
        });
    }

    if (!empty($criteria['q'])) {
        $q = $criteria['q'];
        $books = array_filter($books, function ($book) use ($q) {
            return preg_match('/' . $q . '/i', $book['name']);
        });
    }

    if (!empty($criteria['tag'])) {
        $tag = $criteria['tag'];
        $books = array_filter($books, function ($book) use ($tag) {
            return !empty($book['tags']) && in_array($tag, (array)$book['tags']);
        });
    }

    if (!empty($criteria['sort'])) {
        $key = trim($criteria['sort'], '-');
        $direction = substr($criteria['sort'], 0, 1) == '-' ? 1 : -1;
        usort($books, function ($a, $b) use ($key, $direction) {
            if (!array_key_exists($key, $a) || !array_key_exists($key, $b)) {
                return 0;
            }
            return $a[$key] == $b[$key] ? 0 : ($a[$key] > $b[$key] ? 1 * $direction : -1 * $direction);
        });
    }

    $criteria['total'] = sizeof($books);

    return [
        'criteria' => $criteria,
        'books' => array_slice($books, $criteria['offset'], $criteria['limit']),
    ];
}


