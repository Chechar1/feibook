<?php

namespace App\Http\Controllers;

use Auth;
use Image;
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
    public function update_avatar(Request $request)
    {
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/img/users/' . $filename ) );
    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}
        return redirectTo('@{user}', compact('user'));
    }
}
