<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\CreateUser;

class Users extends Controller
{
    private $images = 'uploads/users/';

    public function checkUserExistence(Request $request)
    {
      extract($request->all(), EXTR_PREFIX_ALL, 'posted');

      try
      {
        $user = \App\User::where('email', $posted_email)
                         ->firstOrFail();
      }
      catch(ModelNotFoundException $e) {
        return response()->json([
          'message' => 'user does not exist',
        ], 404);
      }

      $token = $user->createToken($posted_email)->accessToken;

      return response()->json(compact('user', 'token'), 200);
    }

    public function sendUserDetails(CreateUser $request) {

      $user = null;

      if($request->hasFile('image_url')) {
        $imageUrl = $this->handleImage($request->file('image_url'));
        $user = $this->saveUserWithImage($imageUrl, $request);
      } else {
        $user = \App\User::create($request->all());
      }

      $posted_email = $request->input('email');
      $token = $user->createToken($posted_email)->accessToken;

      return response()->json(compact('user', 'token'), 201);
    }

    private function handleImage($image) {
      $imageName = $image->getClientOriginalName();
      $image->move($this->images, $imageName);
      return $this->images . $imageName;
    }

    private function saveUserWithImage($imageUrl, $request) {
      $data = $request->except('image_url');
      $data = array_add($data, 'image_url', $imageUrl);
      return \App\User::create($data);
    }

    public function accountDetail() {
      $user = Auth::user();
      $version = \App\Version::where('status', true)
                             ->get(['id', 'version_number', 'features']);
      return response(compact('user', 'version'), 200);
    }
}
