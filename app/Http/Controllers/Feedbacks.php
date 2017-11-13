<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateFeedback;

class Feedbacks extends Controller
{

    public function store(CreateFeedback $request) {
      $email = $request->input('email');
      $subject = $request->input('subject');
      $feedback = $request->input('feedback');
      \App\Feedback::create(compact('email', 'subject',
                                    'feedback'));

      return response()->json([
        'message' => 'success',
      ], 201);
    }
}
