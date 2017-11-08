<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateFeedback;

class Feedbacks extends Controller
{
  
    public function store(CreateFeedback $request) {
      $user_id = $request->input('user_id');
      $subject = $request->input('subject');
      $feedback = $request->input('feedback');
      \App\Feedback::create(compact('user_id', 'subject',
                                    'feedback'));

      return response()->json([
        'message' => 'success',
      ], 201);
    }
}
