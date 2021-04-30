<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Book;
use App\Models\Book_view;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewedController extends Controller
{
    public function index()
    {
        return view('/ShowBook');
    }

    public function store(Request $request,Book $book)
    {
        Book_view::create([
            'user_id' => auth()->user()->id,
            'book_id' => $book->id,
           ]);
            // return redirect('/showBook');
            return redirect()->back();
    }
}
