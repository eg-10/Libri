<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBooks = Book::all();
        return view('books.index')->with('allBooks',$allBooks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'description' => 'required',
            'cover_image' => 'image|nullable',
            'main_file' => 'required|mimetypes:application/pdf'
        ]);

        // Upload Book
        $book = new Book;
        $book->name = $request->input('name');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $mainFilename = str_replace(' ', '_', $book->name).time().'.pdf';
        $path = $request->file('main_file')->storeAs('public/main_files', $mainFilename);
        $book->main_file = $mainFilename;
        // // Get filename with the extension
        // $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // // Get just filename
        // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // // Get just ext
        // $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        // $fileNameToStore= $mainFilename.time().'.pdf';
        // Upload Book File
        

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            $book->cover_image = $fileNameToStore;
        }

        $book->save();

        return redirect('/')->with('success', 'Book Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show')->with('book',$book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        
        //Check if post exists before editing
        if (!isset($book)){
            return redirect('/')->with('error', 'Book Not Found');
        }

        // Check for correct user
        // if(auth()->user()->id !==$post->user_id){
        //     return redirect('/posts')->with('error', 'Unauthorized Page');
        // }

        return view('books.edit')->with('book', $book);
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
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'description' => 'required',
            // 'cover_image' => 'image|nullable|max:1999'
        ]);
        $book = Book::find($id);

        // Update Book
        $book->name = $request->input('name');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        
        if ($request->hasFile('main_file')) {
            $mainFilename = str_replace(' ', '_', $book->name).time().'.pdf';
            $path = $request->file('main_file')->storeAs('public/main_files', $mainFilename);
            $book->main_file = $mainFilename;
        }

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            $book->cover_image = $fileNameToStore;
        }

        $book->save();

        return redirect('/')->with('success', 'Book Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        
        //Check if post exists before deleting
        if (!isset($book)){
            return redirect('/')->with('error', 'Book Not Found');
        }

        // Check for correct user
        // if(auth()->user()->id !==$post->user_id){
        //     return redirect('/posts')->with('error', 'Unauthorized Page');
        // }

        if($book->cover_image){
            // Delete Image
            Storage::delete('public/cover_images/'.$book->cover_image);
        }

        Storage::delete('public/main_files/'.$book->main_file);
        
        $book->delete();
     
        return redirect('/')->with('success', 'Book Removed');
    }
}
