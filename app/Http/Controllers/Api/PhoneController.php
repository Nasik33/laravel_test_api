<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhoneResource;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhoneController extends Controller
{
    public function index()
    {
        $phones = Phone::get();
        if ($phones->count() > 0) {

            return PhoneResource::collection($phones);
        } else {
            return response()->json(['message' => 'No records available'], 200);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required',
            'size' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
               'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }
        $book =  Phone::create([
            'name' => $request->name,
            'price' => $request->price,
            'size' => $request->size,

        ]);
        return response()->json([
            'message' => 'phoned created successfully',
            'data' => new  PhoneResource($phone)
        ], 200);
    }
    public function show(Phone $phone) {
        return new PhoneResource($phone);
    }
    public function update(Request $request,Phone $phone) {


    }
    public function destroy() {}
}
