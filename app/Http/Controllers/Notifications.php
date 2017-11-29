<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fcm\Fcm;
use App\Http\Requests\Cms\GeneralNews;

class Notifications extends Controller
{
    //The notification types
    const NEW_VERSION = 0;

    const NEW_PRODUCTS = 1;

    const GENERAL_NEWS = 2;

    //notify users of the new version
    public function pleaseUpdateApplication()
    {
      $fcm = new Fcm();

      $data = array();
      $data["type"] = self::NEW_VERSION;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = "New Version";
      $data["message"] = "A new version with more features, tap to view";

      //sending push message to users who subscribed to the topic 'all'
      $status = $fcm->sendToTopic('all', $data);

      if($status) {
        session(['message' => 'Notification sent', ]);
        return redirect()->route('notifications');
      }
      else if ($status == 0){
        session(['message' => 'Sending failed', ]);
      }

    }

    //notify users of the new version
    public function updateApplication($version)
    {
      $fcm = new Fcm();

      $data = array();
      $data["type"] = self::NEW_VERSION;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = "New Version";
      $data["message"] = "New Features: " . $version->features;

      //sending push message to users who subscribed to the topic 'all'
      return $fcm->sendToTopic('all', $data);
    }

    //notify users of new products
    public function newProducts()
    {
      $fcm = new FCM();

      $data = array();
      $data["type"] = self::NEW_PRODUCTS;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = "New Products";
      $data["message"] = "New Products were added, tap to view!";

      //sending push message to users who subscribed to the topic 'all'
      $status = $fcm->sendToTopic('all', $data);

      if($status) {
        session(['message' => 'Notification sent', ]);
        return redirect()->route('notifications');
      }
      else if ($status == 0){
        session(['message' => 'Sending failed', ]);
      }

    }

    //notify users on some new (important) information
    public function generalNews(GeneralNews $request)
    {
      $fcm = new FCM();

      $data = array();
      $data["type"] = self::GENERAL_NEWS;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = $request->title;
      $data["message"] = $request->news;

      //sending push message to users who subscribed to the topic 'all'
      $status = $fcm->sendToTopic('all', $data);

      if($status) {
        session(['message' => 'Notification sent', ]);
        return redirect()->route('notifications');
      }
      else if ($status == 0){
        session(['message' => 'Sending failed', ]);
      }

    }
}
