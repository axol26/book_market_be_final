<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Book;

class BasketController extends Controller
{
    public function index() {
        $basketItems = Basket::all();
        return response()->json($basketItems);
    }

    // public function store(Request $request) {
    //     $request->validate([
    //         "book_id" => "required",
    //         "book_name" => "required",
    //         "quantity" => "required",
    //         "price" => "required"
    //     ]);

    //     $basketItems = Basket::create($request->all());
    //     return response()->json($basketItems, 201);
    // }

    // public function show($id) {
    //     $basketItems = Basket::findOrFail($id);
    //     return response()->json($basketItems);
    // }

    // public function update(Request $request, $id) {
    //     $basketItems = Basket::findOrFail($id);
    //     $basketItems->update($request->all());
    //     return response()->json($basketItems);
    // }

    public function destroy($id) {
        $basketItems = Basket::findOrFail($id);
        $basketItems->delete();
        return response()->json(["message" => "Basket Item deleted."]);
    }

    public function addBook(Request $request, $bookId) {
        $basketItems = Basket::where("book_id", $bookId)->first();

        if ($basketItems) {
            $basketItems->quantity += 1;
            $basketItems->save();
            return response()->json($basketItems);
        } else {
            $bookItems = Book::where("book_id", $bookId)->first();
            $basketItems = Basket::create([
                "book_id" => $bookId, 
                "book_name" => $bookItems->book_name, 
                "quantity" => 1, 
                "price" => $bookItems->price,
                "image" => $bookItems->image
            ]);
        }

        return response()->json(["message" => "Book added to basket"]);
    }

    public function removeBook(Request $request, $bookId) {
        $basketItems = Basket::where("book_id", $bookId)->first();

        if ($basketItems->quantity == 1) {
            $basketItems->delete();
            return response()->json(["message" => "Book removed from basket"]);
        } else if ($basketItems->quantity > 1) {
            $basketItems->quantity -= 1;
            $basketItems->save();
            return response()->json($basketItems);
        } else {
            return response()->json(["message" => "Book not found in basket"]);
        }
    }

    public function deleteBasket(Request $request) {
        Basket::truncate();
        return response()->json(["message" => "Basket deleted"]);
    }
}
