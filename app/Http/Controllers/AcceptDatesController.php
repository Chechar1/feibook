<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Date;
use Illuminate\Http\Request;

class AcceptDatesController extends Controller
{
    public function store(User $sender)
    {
        Date::where([
            'sender_id' => $sender->id,
            'recipient_id' => auth()->id(),
            ])->update(['status' => 'accepted']);
        }

        public function destroy(User $sender)
        {
            Date::where([
                'sender_id' => $sender->id,
                'recipient_id' => auth()->id(),
            ])->update(['status' => 'denied']);
        }

}
