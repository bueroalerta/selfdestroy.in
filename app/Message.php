<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
  protected $hidden = array('password');

  public static function generateCode( $length = 10 ){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $code = '';
    for ($i = 0; $i < $length; $i++) {
      $code .= $characters[rand(0, $charactersLength - 1)];
    }

    // check if code is a duplicate
    if( DB::table('messages')->where('code', $code)->exists() ){
      $code = "";
    }

    return $code;
  }
}
