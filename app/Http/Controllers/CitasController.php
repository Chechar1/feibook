<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Cita;

class CitasController extends Controller
{
    public function store(User $recipient)
    {
        Cita::firstOrCreate([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id
        ]);

        return response()->json([
           'date_status' => 'pending'
        ]);
    }

    public function destroy(User $recipient)
    {
        Cita::where([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id
        ])->delete();

        return response()->json([
            'date_status' => 'deleted'
        ]);
    }
}
