<?php

namespace src\index;

use function core\view\view;
use Symfony\Component\HttpFoundation\Response;


const BOOKS_PER_PAGE = 2;

/**
 * @param $id
 *
 * @return Response
 */
function bookById($id)
{
    $books = Book::where('id', "=", $id)->get();
    return view(['default_layout.php', 'books/book_by_id.php'], ['books' => $books]);
}


/**
 * @param array $criteria
 * @return array
 */

function filterByCriteria(array $criteria)
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
function books()
{
    global $request;
    $criteria = [
        'q' => $request->get('q', null),
        'sort' => $request->get('sort', null),
        'tags' => $request->get('tags', null),
        'limit' => BOOKS_PER_PAGE,
        'offset' => ceil((int)$request->get('page', 0) * BOOKS_PER_PAGE),
    ];
    $result = filterByCriteria($criteria);
    return view(['default_layout.php', 'books/index.php'], $result);


}




