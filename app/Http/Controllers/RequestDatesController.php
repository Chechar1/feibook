<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Date;
use Illuminate\Http\Request;

class RequestDatesController extends Controller
{
    public function store(User $sender)
    {
        Date::where([
            'sender_id' => $sender->id,
            'recipient_id' => auth()->id(),
            'accepted' => false
        ])->update(['accepted' => true]);
    }

}
