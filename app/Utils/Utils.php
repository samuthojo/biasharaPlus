<?php

namespace App\Utils;

class Utils
{
  public static function timestampConverter($dateString)
  {
    $dateArray = explode('-', trim($dateString));
    return mktime(0, 0, 0, $dateArray[1], $dateArray[0], $dateArray[2]);
  }

  public static function handleImage($image, $location) {
    $imageName = $image->getClientOriginalName();
    $image->move($location, $imageName);
    return asset($location . $imageName);
  }
}
