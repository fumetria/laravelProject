<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;

class StaticController extends Controller
{

    public static function getStatics()
    {
        $users = User::getStatics();
        $books = Book::getStatics();
        $author = Author::getStatics();
        $loans = Loan::getStatics();
    }
}
