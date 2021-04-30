<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Sales;
use App\Models\ShowBook;
use App\Models\Book_view;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookShowController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:book-buy',['only' => ['index','store']]);
    }
    public function index()
    {
       $book =  Book::where('status','0')->orderBy('price','DESC')->paginate(15);
       if (Auth::check()) {
        $filterBook= auth()->user()->books->pluck('id','id');
        $book =  Book::where('status','0')->whereNotIn('id',$filterBook)->orderBy('price','DESC')->paginate(15);
        }
        $data=Sales::select('book_id', DB::raw('COUNT(book_id) as count'))
        ->groupBy('book_id')
        ->orderBy('count', 'desc')
        ->take(5)->get();
        return view("ShowBook",compact('book','data'))->with('i','0');
    }


    public function store(Request $request,Book $book)
    {
       ShowBook::create([
        'name' => $book->name,
        'author' => $book->author,
        'price' => $book->price,
       ]);

        return back();
    }

    function detail(Book $book){
        if(Auth::check()){
            $filterBook= auth()->user()->books->pluck('id','id');
        }

            if(Auth::check()){
            if(auth()->user()->hasRole('Customer')){
                if(auth()->user()->viewedBooks->contains($book)){

                }else{
                    auth()->user()->viewedBooks()->attach($book);

                }
            }
            else{

            }
        }


    	return view("detail",compact('book','filterBook'));
    }

    public function getMoreUser(Request $request){
        if($request->ajax()){
            $book =  Book::where('status','0')->paginate(15);
            return view('pages.user_data', compact('book'))->render();
        }
    }

    public function search(Request $request){
        // return $request->input();
        // return view('ShowBook');

        // $data=Book::where('name', 'like'  , '%'.$request->input('query').'%')->get();
        // $book =  Book::where('status','0')->paginate(15);
        // return view('search',compact('data','book'));

        if($request->has('q')){
            $q=$request->q;
            return response()->json($q);
        }
        else{
            return view('search');
        }
    }
}
