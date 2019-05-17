<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Cita;

class CitasController extends Controller
{
    public function store(User $recipient)
    {
        $cita = Cita::firstOrCreate([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id
        ]);

        return response()->json([
            'cita_status' => $cita->fresh()->status
        ]);
    }

    public function destroy(User $user)
    {
        $deleted = Cita::where([
            'sender_id' => auth()->id(),
            'recipient_id' => $user->id
            ])->orWhere([
                'sender_id' => $user->id,
                'recipient_id' => auth()->id()
            ])->delete();

        return response()->json([
            'cita_status' => $deleted ? 'deleted' : ''
        ]);
    }
}
