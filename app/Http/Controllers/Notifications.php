<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fcm\Fcm;

class Notifications extends Controller
{
    //The notification types
    const NEW_VERSION = 0;

    const NEW_PRODUCTS = 1;

    const GENERAL_NEWS = 2;

    const PAYMENT_CONFIRMED = 3;

    const CLARIFY_PAYMENT = 4;

    public function sendNotification(Request $request) {
      switch($request->type) {
        case self::NEW_VERSION: {
          return $this->pleaseUpdateApplication();
          break;
        }
        case self::NEW_PRODUCTS: {
          return $this->newProducts();
          break;
        }
        case self::GENERAL_NEWS: {
          return $this->generalNews($request);
          break;
        }
      }
    }

    //notify users of the new version
    public function pleaseUpdateApplication()
    {
      $fcm = new Fcm();

      $data = array();
      $data["type"] = self::NEW_VERSION;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = "New Version";
      $data["message"] = "A new version with more features is now available tap to update!";

      //sending push message to users who subscribed to the topic 'all'
      return $status = $fcm->sendToTopic('all', $data);
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
      return $status = $fcm->sendToTopic('all', $data);
    }

    //notify users of new products
    public function newProducts()
    {
      $fcm = new FCM();

      $data = array();
      $data["type"] = self::NEW_PRODUCTS;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = "New Products";
      $data["message"] = "New products were added, tap to view!";

      //sending push message to users who subscribed to the topic 'all'
      return $status = $fcm->sendToTopic('all', $data);

    }

    //notify users on some new (important) information
    public function generalNews(Request $request)
    {
      $fcm = new FCM();

      $data = array();
      $data["type"] = self::GENERAL_NEWS;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = $request->title;
      $data["message"] = $request->news;

      //sending push message to users who subscribed to the topic 'all'
      return $status = $fcm->sendToTopic('all', $data);
    }

    //notify users on some new (important) information
    public function paymentConfirmed($user)
    {
      $fcm = new FCM();

      $data = array();
      $data["type"] = self::PAYMENT_CONFIRMED;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = "Payment Confirmed";
      $data["message"] = "Thank you for your payment, you are now a premium " .
                         "user until " .
                         \Carbon\Carbon::parse($user->subscription_end_date)
                                       ->format('d M Y');
      $data["data"] = $user;

      $device_ids = $this->getDeviceIds($user);

      return $status = $fcm->sendMultiple($device_ids, $data);
    }

    private function getDeviceIds($user) {
      $device_ids = [];

      foreach($user->devices()->get() as $index => $device) {
        $device_ids[$index] = $device->device_id;
      }

      return $device_ids;
    }

    //Notify IPF_PAY of a payment that needs clarification
    public function clarifyPayment($reference_no, $email)
    {
      $fcm = new FCM();

      $data = array();
      $data["type"] = self::CLARIFY_PAYMENT;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = "Clarify Payment";
      $data["message"] = "Please clarify payment by user with email " . $email .
                         " and the reference no: " . $reference_no;

      $data["data"] = [
          'email' => $email,
          'reference_no' => $reference_no
      ];

      //sending push message to users who subscribed to the topic 'clarifications'
      return $status = $fcm->sendToTopic('clarifications', $data);
    }
}
