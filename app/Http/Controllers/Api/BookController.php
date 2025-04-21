<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // அனைத்து புத்தகங்களையும் காட்டும் method
    public function index()
    {
        $books = Book::get();
        if ($books->count() > 0) {
            return BookResource::collection($books);
        } else {
            return response()->json(['message' => 'No records available'], 200);
        }
    }

    // புத்தகம் சேர்க்கும் method
    public function store(Request $request)
    {
        // தரவுகளை சரிபார்ப்பு
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'colour' => 'required',
            'category' => 'required|integer',
        ]);

        // validation தோல்வியடைந்தால்
        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandatory',
                'errors' => $validator->errors(),
            ], 422);
        }

        // புத்தகம் உருவாக்கம்
        $book = Book::create([
            'name' => $request->name,
            'colour' => $request->colour,
            'category' => $request->category,
        ]);

        return response()->json([
            'message' => 'Book created successfully',
            'data' => new BookResource($book),
        ], 200);
    }

    // இன்னும் எழுதப்படாத method-கள்
    public function show(Book $book)
    {

        return new BookResource($book);
    }
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'colour' => 'required',
            'category' => 'required|integer',
        ]);

        // validation தோல்வியடைந்தால்
        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandatory',
                'errors' => $validator->errors(),
            ], 422);
        }

        // புத்தகம் உருவாக்கம்
        $book->update([
            'name' => $request->name,
            'colour' => $request->colour,
            'category' => $request->category,
        ]);

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => new BookResource($book),
        ], 200);
    }
    public function destroy(Book $book) {
   $book->delete();
   return response()->json([
    'message' => 'Book deleted successfully',
], 200);
    }
}
