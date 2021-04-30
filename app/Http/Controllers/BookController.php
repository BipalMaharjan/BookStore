<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index','show']]);
         $this->middleware('permission:book-create', ['only' => ['create','store']]);
         $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Books = Book::all();
        return view('books.index',compact('Books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole("Admin")) {
            $sellers = Seller::all();
            $countries = Country::all();
            $genres = Genre::all();
            return view('books.create',compact('sellers','countries','genres'));
        }else{
            $countries = Country::all();

            $user = auth()->user()->id;
            $sellerId=Seller::where('user_id',$user)->first()->id;
            $genres = Genre::all();

            return view('books.create',compact('sellerId','countries','genres'));
        }




    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        // if ($file = $request->file('file')) {
        //     $name = $file->getClientOriginalName();
        //     if($file->move('images', $name)){
        //         $post = new Book();
        //         $post->image = $name;
        //     }
        // }

        $imagePath =$request['file']->store('book_image','public');
      $book_id=Str::random(16);
      $book=  Book::create([
            'book_id'=>$book_id,
            'image' =>  $imagePath ,
            'name'=>$request['name'],
            'author'=>$request['author'],
            'price'=>$request['price'],
            'seller_id'=>$request['seller_id'],
            // 'genre'=>$request['genre'],
            'description'=>$request['description']
        ]);
        $book->countries()->attach($request['country']);
        $book->genres()->attach($request['genre']);
        $i=1;
        return redirect()->route('books.index')
                        ->with('success','Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $Book)
    {
        return view('books.show',compact('Book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $sellers = Seller::all();
        $countries = Country::all();
        $genres = Genre::all();
        // $sellerId=Seller::where('user_id',$sellers)->first()->id;
        return view('books.edit',compact('book','sellers','countries','genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $Book)
    {
         request()->validate([
            'name' => 'required',
            'file',
            'author' => 'required',
            'price' => 'required',
            'country' => 'required',
            'genre' => 'required',
            'seller_id'=>'required',
        ]);

        $Book->update([
            'name'=>$request['name'],
            'author'=>$request['author'],
            'price'=>$request['price'],
            'seller_id'=>$request['seller_id'],
            // 'genre'=>$request['genre'],
            'description'=>$request['description']
        ]);
        $Book->countries()->attach($request['country']);
        $Book->genres()->attach($request['genre']);
        return redirect()->route('books.index')
                        ->with('success','Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $Book)
    {
        $Book->delete();

        return redirect()->route('books.index')
                        ->with('success','Book deleted successfully');
    }
}
