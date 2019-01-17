<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookPost;
use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return view('books.index', array('books' => $books));
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
    public function store(StoreBookPost $request)
    {
        Book::create($request->all());
        return redirect()->route('books.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', array('book' => $book));
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
        $new_data = $request->all();
        unset($new_data['_token'], $new_data['_method']);
        Book::where('id', $id)->update($new_data);

        return redirect()->route('books.show', [$id])->with('message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where('id', $id)->delete();

        return redirect()->route('books.index');
    }

    public function changeStatus(Request $request) {
        $user_id = $request->has('user_id') ? $request->get('user_id') : 0;
        Book::where('id', $request->get('id_book'))->update(['user_id' => $user_id]);

        return redirect()->route('books.show', $request->get('id_book'))->with('message', 'Status changed!');
    }
}
