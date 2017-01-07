<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
  public function create(Request $request){

    // Validations
    $validator = Validator::make($request->all(), [
      'title' => 'max:100',
      'content' => 'required',
      'password' => 'min:8',
      'expiry' => 'date_format:Y-m-d H:i'
    ], [
      'title.max' => 'Title cannot be more than 100 characters',
      'content.required' => 'Content of message cannot be empty',
      'password.min' => 'Password must have at least 8 characters',
      'expiry.date_format' => 'Invalid format for expiration date'
    ]);

    if( $validator->fails() ){
      return response()->json([
        'status' => 0,
        'errors' => $validator->errors()
      ], 400);
    }

    try {
      $msg = new Message();

      $msg->code = "";
      while( $msg->code == "" ){
        $msg->code = Message::generateCode();
      }
      $msg->title = $request->input('title');
      $msg->content = $request->input('content');
      $msg->expires_at = $request->input('expiry');

      if( $request->input('password') ){
        $msg->password = Hash::make($request->input('password'));
      }

      $msg->save();
    }
    catch(QueryException $e){
      return response()->json([
        'status' => 0,
        'message' => 'An unexpected error occurred'
      ], 500);
    }

    return response()->json([
      'status' => 1,
      'code' => url('m/'.$msg->code),
      'message' => 'This message will expire at '.$msg->expires_at
    ], 200);
  }

  public function view($code){
    $payload = Message::where('code', $code)->first();

    $payload->encrypted = ($payload->password) ? true : false;
    unset($payload->content);

    return response()->json([
      'status' => 1,
      'payload' => $payload
    ]);
  }

  public function authenticate(Request $request, $code){
    // Validations
    $validator = Validator::make($request->all(), [
      'password' => 'required',
      'confirm_password' => 'required_with:password|same:password'
    ], [
      'password.required' => 'Password was not entered',
      'confirm_password.required_with' => 'Re-enter your password',
      'confirm_password.same' => 'Passwords do not match'
    ]);

    if( $validator->fails() ){
      return response()->json([
        'status' => 0,
        'errors' => $validator->errors()
      ], 400);
    }

    $payload = Message::where('code', $code)->first(['content', 'password']);

    if( Hash::check($request->input('password'), $payload->password) ){
      return response()->json([
        'status' => 1,
        'content' => $payload->content
      ], 200);
    }
    else {
      return response()->json([
        'status' => 0,
        'message' => 'Password incorrect'
      ], 200);
    }
  }
}
