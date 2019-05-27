<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Friendship;

class UsersController extends Controller
{
    public function show(User $user)
    {
        $friendshipStatus = optional(Friendship::where([
            'recipient_id' => $user->id,
            'sender_id' => auth()->id()
        ])->first())->status;

        return view('users.show', compact('user', 'friendshipStatus'));
    }
    public function store(){
        // ruta de las imagenes guardadas
        $ruta = public_path().'/avatar/';

        // recogida del form
        $imagenOriginal = $request->file('avatar');

        // crear instancia de imagen
        $imagen = Image::make($imagenOriginal);

        // generar un nombre aleatorio para la imagen
        $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();

        $imagen->resize(300,300);

        // guardar imagen
        // save( [ruta], [calidad])
        $imagen->save($ruta . $temp_name, 100);


        $personaje = new Personaje;
        $personaje->filename = $temp_name;
        $personaje->save();
        return view('users.avatar', compact('avatar'));
    }
}
