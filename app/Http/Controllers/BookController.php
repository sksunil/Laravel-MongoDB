<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\book;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $books = DB::connection('mongodb')->collection('books')->get();
      //dd($books);
      return view('bookindex', compact('books'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $book = new book;
      // $book->title =  $request->input('title');
      // $book->isbn =  $request->input('isbn');
      // $book->author =  $request->input('author');
      // $book->category = $request->input('category') ;
       //dd($book);
      //$book->save();
      DB::connection('mongodb')->collection('books')->insert(array(
               'isbn' => $request->input('isbn') ,'title' =>  $request->input('title'), 'author' =>  $request->input('author'),
               'category' =>  $request->input('category')
              ));

      $books = DB::collection('books')->get();
      return view('bookindex', compact('books'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $book = DB::connection('mongodb')->collection('books')->where('_id', $id)->get();
      return view('bookview', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $book = DB::collection('books')->where('_id', $id)->get();
      return view('bookedit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      DB::collection('books')->where('_id', $id)->update([
        'title' => $request->input('title'),
        'isbn' => $request->input('isbn'),
        'author' => $request->input('author'),
        'category' => $request->input('category')
  ] );
      $books = DB::collection('books')->get();
      return view('bookindex', compact('books'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DB::collection('books')->where('_id', $id)->delete();
	    $books = DB::collection('books')->get();
        return view('bookindex', compact('books'));
    }
}
