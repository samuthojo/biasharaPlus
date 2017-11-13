<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Payments extends Controller
{
    public function __invoke(Request $request) {
      \App\Payment::create($request->all());
      return response()->json([
        'message' => 'success',
      ], 201);
    }
}
