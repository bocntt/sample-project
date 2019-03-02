<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
use App\Message;

class ChatController extends Controller
{
    public function index() {
      return view('chat.index');
    }

    public function getMessages(Request $request) {
      if (! $request->ajax()) {
        throw new UnauthorizedException;
      }

      $messages = Message::with('user')->MostRecent()->get();
      $messages = array_reverse($messages->toArray());

      return $messages;
    }

    public function postMessages(Request $request) {
      if (! $request->ajax()) {
        throw new UnauthorizedException;
      }

      $user = Auth::user();
      $message = $user->messages()->create([
        'message' => request()->get('message')
      ]);

      broadcase(new MessagePosted($message, $user))->toOthers();
      // or
      // event(new MessagePosted($message, $user));

      return ['status' => 'OK'];
    }
}
