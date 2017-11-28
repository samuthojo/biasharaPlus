<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsFeedback extends Controller
{
    public function index()
    {
      $feedbacks = \App\Feedback::latest('created_at')->get();
      return view('feedback', compact('feedbacks'));
    }
}
