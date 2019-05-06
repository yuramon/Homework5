<?php

namespace admin\index;

use src\index\Book;
use Symfony\Component\HttpFoundation\Request;
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
            ->orWhere('tags_name', 'LIKE', "%{$q}%");
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
    if (!empty($criteria['tags'])) {
        $search = $criteria['tags'];
        $books = Book::query()
            ->where('tags_name', 'LIKE', "%{$search}%");
        $count = $books->count();
        $books = $books->take($criteria['limit'])->skip($criteria['offset'])->get();
    }
    $criteria['total'] = $count;
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
    global $request;
    $criteria = [
        'q' => $request->get('q', null),
        'sort' => $request->get('sort', null),
        'tags' => $request->get('tags', null),
        'limit' => BOOKS_PER_PAGE,
        'offset' => ceil((int)$request->get('page', 0) * BOOKS_PER_PAGE),
    ];

    $request = Request::createFromGlobals();
    $pass = $request ->get('pas');
    $login = $request ->get('name');
    $result = view(['books/admin.php']);
    if (isset($pass) and $pass =='123' and isset($login) and $login =='admin'){

        $result = test2($criteria);
        $result =view(['default_layout.php', 'books/index.php'], $result);
    };
    if ($pass !='123' or $login != 'admin') {
        echo "Wrong login or password";
    }
    return $result;


}
