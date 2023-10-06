<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $bookItems = Book::all();
        return response()->json($bookItems);
    }

    public function store(Request $request) {
        $request->validate([
            'book_id' =>'required',
            'book_name' =>'required',
            'author' =>'required',
            'genre' =>'required',
            'description' =>'required',
            'price' =>'required',
            'image' =>'required'
        ]);
        $bookItems = Book::create($request->all());
        return response()->json($bookItems);
    }

    public function show($id) {
        $bookItems = Book::findOrFail($id);
        return response()->json($bookItems);
    }

    public function update(Request $request, $id) {
        $bookItems = Book::findOrFail($id);
        $bookItems->update($request->all());
        return response()->json($bookItems);
    }

    public function destroy($id) {
        $bookItems = Book::findOrFail($id);
        $bookItems->delete();
        return response()->json(["message" => "Basket Item deleted."]);
    }
}
