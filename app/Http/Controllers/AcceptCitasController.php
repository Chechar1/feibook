<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Cita;
use Illuminate\Http\Request;

class AcceptCitasController extends Controller
{
    public function store(User $sender)
    {
        Cita::where([
            'sender_id' => $sender->id,
            'recipient_id' => auth()->id(),
            ])->update(['status' => 'accepted']);
        }

        public function destroy(User $sender)
        {
            Cita::where([
                'sender_id' => $sender->id,
                'recipient_id' => auth()->id(),
            ])->update(['status' => 'denied']);
        }

}
