<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Cita;

class UsersController extends Controller
{
    public function show(User $user)
    {
        $citaStatus = optional(Cita::where([
            'recipient_id' => $user->id,
            'sender_id' => auth()->id()
        ])->first())->status;

        return view('users.show', compact('user', 'citaStatus'));
    }
}
