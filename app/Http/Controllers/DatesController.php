<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Date;
use Illuminate\Http\Request;

class DatesController extends Controller
{
    public function store(User $recipient)
    {
        Date::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id
        ]);
    }

    public function destroy(User $recipient)
    {
        Date::where([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id
        ])->delete();
    }
}
