<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Book;
use App\Collection;
use Storage;

class CollectionsController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Auth::user()->collection;
        if (isset($collection)) {
            $collection = Auth::user()->collection->books()->get();
        }
        return view('collection.index')->with('books',$collection);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $user = Auth::user();
        $collection = $user->collection;
        if (!isset($collection)) {
            $collection = new Collection;
            $user->collection()->save($collection);
        }
        $book = Book::find($id);
        if (!isset($book)) {
            return back()->with('error', 'Book Not Found');
        }
        $collection->books()->attach($book);
        $collection->save();
        return back()->with('success', 'Collection Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $user = Auth::user();
        $collection = $user->collection;
        if (!isset($collection)) {
            return back();
        }
        $book = Book::find($id);
        if ((!isset($book))) {
            return back()->with('error', 'Book Not Found');
        }
        $collection->books()->detach($book);
        $collection->save();
        return back()->with('success', 'Collection Updated');
    }
}