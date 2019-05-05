<?php

namespace admin\index;

use src\index\Book;
use Symfony\Component\HttpFoundation\Response;
use function core\view\view;
use function core\view\view1;


const BOOKS_PER_PAGE = 2;

/**
 *
 * @return array
 */


function test2(array $criteria)
{
    $count = Book::where('id', '>', 0)->count();
    $criteria = array_merge([
        'limit' => 3,
        'offset' => 0,
        'total' => 0
    ], $criteria);
    $books = Book::take($criteria['limit'])->skip($criteria['offset'])->get();
    if (!empty($criteria['q'])) {
        $q = $criteria['q'];
        $books = Book::query()
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhere('tags', 'LIKE', "%{$q}%");
        $count = $books->count();
        $books = $books->take($criteria['limit'])->skip($criteria['offset'])->get();
    }
    if (!empty($criteria['sort'])) {
        if ($criteria['sort'] == 'Name') {
            $books = Book::orderBy('name');
            $count = $books->count();
            $books = $books->take($criteria['limit'])->skip($criteria['offset'])->get();
        } elseif ($criteria['sort'] == 'Price') {
            $books = Book::orderBy('price');
            $count = $books->count();
            $books = $books->take($criteria['limit'])->skip($criteria['offset'])->get();
        }

    }
    $criteria['total'] = $count;
    /*$sql = "SELECT count(info) FROM books ";
    $count = $app['books']->prepare($sql);
    $count->execute();
    $number_of_rows = $count->fetchColumn();*/


    /*$STH = $app['books']->prepare("SELECT * from books limit :page, :per_page");
    $STH->bindParam(':page', $criteria['offset'], PDO::PARAM_INT);
    $STH->bindParam(':per_page', $criteria['limit'], PDO::PARAM_INT);
    $STH->execute();
    $result = $STH->fetchAll(PDO::FETCH_ASSOC);*/
    return [
        'criteria' => $criteria,
        'books' => $books
    ];


}

/**
 * @return Response
 */

function admin()
{
    /*global $request;
    $testArr = [];
    $pageNumber = ceil((int)$request->get('page', 0));
    echo $pageNumber;
    $book = Book::all();
    foreach ($book as $books) {
        $newArr = $books->name;
        array_push($testArr, $newArr);

    }

    SELECT *
FROM books
INNER JOIN tags
ON books.tags = tags.tags_id
WHERE books.tags_name = 'php, laravel'
    print_r($testArr);

    return view(['default_layout.php', 'books/index.php'], $testArr);*/
    global $request;
    $criteria = [
        'q' => $request->get('q', null),
        'sort' => $request->get('sort', null),
        'limit' => BOOKS_PER_PAGE,
        'offset' => ceil((int)$request->get('page', 0) * BOOKS_PER_PAGE),
    ];
    $result = test2($criteria);
    return view(['default_layout.php', 'books/index.php'], $result);


}

/**
 * @return Response
 */
function admin1()
{
    return view(['books/admin.php']);
}