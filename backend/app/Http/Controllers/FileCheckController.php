<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileCheckController extends Controller
{
    public function checkExtensi(Request $request)
    {
        // Validate the incoming files
        $request->validate([
            'files.*' => 'required|image|mimes:jpeg,png,jpg|max:2048', // max size in KB
        ]);

        // If validation passes, return a success response
        return response()->json(['message' => 'File extensions are valid!']);
    }
}
