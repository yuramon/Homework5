<?php

namespace admin\index;

use src\index\Admin;
use src\index\Book;
use Symfony\Component\HttpFoundation\Response;
use function core\view\view;


const BOOKS_PER_PAGE = 2;
/**
 * @param $id
 *
 * @return Response
 */
function bookById($id)
{
    $books = Book::where('id', "=", $id)->get();
    return view(['default_layout_admin.php', 'books/book_by_id_admin.php'], ['books' => $books]);
}


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
    if (!empty($criteria['delete'])) {
        $id =$criteria['delete'];

        Book::query()
            ->where('id','=', "$id")
            ->delete();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        $books = Book::$books->take($criteria['limit'])->skip($criteria['offset'])->get();
    }
    if (isset($criteria['log_out'])) {
        session_destroy();
        header("Refresh:0");

    }
    if (!empty($criteria['tags'])) {
        $search = $criteria['tags'];
        $books = Book::query()
            ->where('tags_name', 'LIKE', "%{$search}%");
        $count = $books->count();
        $books = $books->take($criteria['limit'])->skip($criteria['offset'])->get();
    }
    echo 'loh';
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
    session_start();
    $criteria = [
        'q' => $request->get('q', null),
        'sort' => $request->get('sort', null),
        'tags' => $request->get('tags', null),
        'log_out' => $request->get('log_out', null),
        'delete' => $request->get('delete', null),
        'limit' => BOOKS_PER_PAGE,
        'offset' => ceil((int)$request->get('page', 0) * BOOKS_PER_PAGE),
    ];
    $pass = $request ->get('pas');
    $login = $request ->get('name');
    $loginButton =$request ->get('send');
    $result = view(['books/admin.php']);
   /* $passs = Admin::where('id', 1)
        ->get(['pass']);*/
    if (isset($_SESSION['admin']) and $_SESSION['admin'] === 'admin') {
        $adm = Admin::all()
            ->where('id',1);
        foreach ($adm as $admin){
            $login = $admin->login;
            $passHesh = $admin->pass;
        }
        $tryPass = $pass;
        if (password_verify($tryPass, $passHesh) === true) {
            $pass = $tryPass;
        }

    }
    //Hesh my password
    /*$log_pass[1] = password_hash($log_pass[1], PASSWORD_DEFAULT);
        $adm = Admin::find(1);
        $adm->pass = $log_pass[1];
        $adm->save();*/

    if (isset($pass)  and isset($login) ) {
        $log_pass= [];
        $adm = Admin::all()
            ->where('id', 1);
        foreach ($adm as $admin) {
            $loginBd = $admin->login;
            $passBd = $admin->pass;
            array_push($log_pass, $loginBd, $passBd);
        }
        if (password_verify($pass, $log_pass[1]) === true and $login === $log_pass[0]) {
            $_SESSION['admin'] = 'admin';
            $result = test2($criteria);
            $result = view(['default_layout_admin.php', 'books/index_admin.php'], $result);
        }
        if (isset($loginButton)) {
            if ($pass !== $log_pass[1] or $login !== $log_pass[0]) {
                echo "Wrong login or password";
            }
        }

    }
    return $result;


}
